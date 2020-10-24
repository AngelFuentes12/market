<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Colonies extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->validation();

			$this->errors([]);
			$this->getColonies();
		}

		function register()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$colony = isset($_POST['colony']) ? preg_replace('/\s\s+/', ' ', trim($_POST['colony'])) : '';

			if (is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && $colony != '') {
				switch ($this->model->register($id_state, $id_municipality, $colony)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Colonia registrada exitosamente'
						]);
						break;

					case 'colony':
						$this->errors([
							'c3' => 'is-invalid',
							'm3' => 'Este colonia ya fue registrada',
							'colony' => $colony,
							'alert' => 'alert-info',
							'message' => 'Verifique su información'
						]);
						break;
					
					default:
						$this->errorMessage();
						break;
				}
			} else {
				$c1 = ""; $m1 = "";
				$c2 = ""; $m2 = "";
				$c3 = ""; $m3 = "";

				if (!is_numeric($id_state)) {
					$c1 = "is-invalid";
					$m1 = "Seleccione un estado";
				}

				if (!is_numeric($id_municipality)) {
					$c2 = "is-invalid";
					$m2 = "Seleccione un municipio";
				}

				if ($colony == "") {
					$c3 = "is-invalid";
					$m3 = "Ingrese un colonia";
				}
				
				$this->errors([
					'c1' => $c1,
					'm1' => $m1,
					'c2' => $c2,
					'm2' => $m2,
					'c3' => $c3,
					'm3' => $m3,
					'colony' => $colony,
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getColonies();
		}

		function edit()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$id_colony = isset($_POST['id_colony']) ? $_POST['id_colony'] : '';
			$municipality = isset($_POST['municipality']) ? preg_replace('/\s\s+/', ' ', trim($_POST['municipality'])) : '';
			$colony = isset($_POST['colony']) ? preg_replace('/\s\s+/', ' ', trim($_POST['colony'])) : '';

			if (is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && is_numeric($id_colony) && $id_colony > 0 && $colony != "") {
				if ($this->model->edit($id_state, $id_municipality, $id_colony, $colony)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'La colonia ' . $colony . ' ya fue registrada en el municipio de ' . $municipality
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getColonies();
		}

		function store()
		{
			$this->validation();

			$id_colony = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_colony) && $id_colony > 0) {
				$colony = $this->model->store($id_colony);

				if (sizeof($colony) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar Colonia";
					$this->view->colonies = $colony;
					$this->view->render('admin/colonies/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getColonies();
		}

		function delete()
		{
			$id_colony = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_colony) && $id_colony > 0) {
				if ($this->model->delete($id_colony)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Colonia eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getColonies();
		}

		function validation()
		{
			require_once 'models/admin/validation.php';
			$validation = new Validation();
			if ($validation->validationSession() == false) {
				require_once 'models/admin/adminModel.php';
				$logout = new AdminModel();
				if ($logout->logout()) {
					session_unset();
					session_destroy();
					header("Location: " . constant('URL'));
				} else {
					$this->errorMessage();
					$this->view->title = "Bienvenido";
					$this->view->render('admin/index');
				}
			}
		}

		function getColonies()
		{
			require_once 'models/admin/statesModel.php';
			$state = new StatesModel();
			$states = $state->getStates();
			$this->view->states = $states;

			$this->view->title = "Colonias";
			$colonies = $this->model->getColonies();
			$this->view->colonies = $colonies;
			$this->view->render('admin/colonies/show');
		}

		function getMunicipalities()
		{
			
			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';

			require_once 'models/admin/municipalitiesModel.php';
			$municipality = new MunicipalitiesModel();
			$municipalities = $municipality->getMunicipalitiesSpecific($id_state);
			
			$data = '<select id="municipality" class="form-control" name="id_municipality" required>';
			$data .= "<option selected>Seleccionar...</option>";
			require_once 'models/admin/municipality.php';
			foreach ($municipalities as $row) {
				$municip = new Municipality();
				$municip = $row;

				$data .= '<option value="'.$municip->id_municipality.'">'.$municip->municipality.'</option>';
			}
			$data .= '</select>';
			echo $data;
		}

		function errorMessage()
		{	
			$this->errors([
				'alert' => 'alert-danger',
				'message' => 'Ocurrió un error, vuelva a interntarlo más tarde'
			]);
		}

		function errors($error)
		{
			$c1 = isset($error['c1']) ? $error['c1'] : '';
			$m1 = isset($error['m1']) ? $error['m1'] : '';
			$c2 = isset($error['c2']) ? $error['c2'] : '';
			$m2 = isset($error['m2']) ? $error['m2'] : '';
			$c3 = isset($error['c3']) ? $error['c3'] : '';
			$m3 = isset($error['m3']) ? $error['m3'] : '';

			$colony = isset($error['colony']) ? $error['colony'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'colony' => $colony,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>