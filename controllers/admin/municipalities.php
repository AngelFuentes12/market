<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Municipalities extends Controller
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
			$this->getMunicipalities();
		}

		function register()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$municipality = isset($_POST['municipality']) ? preg_replace('/\s\s+/', ' ', trim($_POST['municipality'])) : '';

			if (is_numeric($id_state) && $id_state > 0 && $municipality != '') {
				switch ($this->model->register($id_state, $municipality)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Municipio registrado exitosamente'
						]);
						break;

					case 'municipality':
						$this->errors([
							'c2' => 'is-invalid',
							'm2' => 'Este municipio ya fue registrado',
							'municipality' => $municipality,
							'id_state' => $id_state,
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

				if (!is_numeric($id_state)) {
					$c1 = "is-invalid";
					$m1 = "Seleccione un estado";
				}

				if ($municipality == "") {
					$c2 = "is-invalid";
					$m2 = "Ingrese un municipio";
				}
				
				$this->errors([
					'c1' => $c1,
					'm1' => $m1,
					'c2' => $c2,
					'm2' => $m2,
					'municipality' => $municipality,
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getMunicipalities();
		}

		function edit()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$state = isset($_POST['state']) ? preg_replace('/\s\s+/', ' ', trim($_POST['state'])) : '';
			$municipality = isset($_POST['municipality']) ? preg_replace('/\s\s+/', ' ', trim($_POST['municipality'])) : '';

			if (is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && $municipality != "") {
				if ($this->model->edit($id_state, $id_municipality, $municipality)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'El municipio ' . $municipality . ' ya fue registrado en el estado de ' . $state
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getMunicipalities();
		}

		function store()
		{
			$this->validation();

			$id_municipality = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_municipality) && $id_municipality > 0) {
				$municipality = $this->model->store($id_municipality);

				if (sizeof($municipality) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar Municipio";
					$this->view->municipalities = $municipality;
					$this->view->render('admin/municipalities/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getMunicipalities();
		}

		function delete()
		{
			$id_municipality = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_municipality) && $id_municipality > 0) {
				if ($this->model->delete($id_municipality)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Municipio eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getMunicipalities();
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

		function getMunicipalities()
		{
			require_once 'models/admin/statesModel.php';
			$state = new StatesModel();
			$states = $state->getStates();
			$this->view->states = $states;

			$this->view->title = "Municipios";
			$municipalities = $this->model->getMunicipalities();
			$this->view->municipalities = $municipalities;
			$this->view->render('admin/municipalities/show');
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

			$id_state = isset($error['id_state']) ? $error['id_state'] : '';
			$municipality = isset($error['municipality']) ? $error['municipality'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'id_state' => $id_state,
				'municipality' => $municipality,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>