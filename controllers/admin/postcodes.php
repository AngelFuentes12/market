<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Postcodes extends Controller
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
			$this->getPostcodes();
		}

		function register()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$id_colony = isset($_POST['id_colony']) ? $_POST['id_colony'] : '';
			$postcode = isset($_POST['postcode']) ? preg_replace('/\s\s+/', ' ', trim($_POST['postcode'])) : '';

			if (is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && is_numeric($id_colony) && $id_colony > 0 && is_numeric($postcode)) {
				switch ($this->model->register($id_state, $id_municipality, $id_colony, $postcode)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Codigo postal registrado exitosamente'
						]);
						break;

					case 'postcode':
						$this->errors([
							'c4' => 'is-invalid',
							'm4' => 'Este codigo postal ya fue registrado',
							'postcode' => $postcode,
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
				$c4 = ""; $m4 = "";

				if (!is_numeric($id_state)) {
					$c1 = "is-invalid";
					$m1 = "Seleccione un estado";
				}

				if (!is_numeric($id_municipality)) {
					$c2 = "is-invalid";
					$m2 = "Seleccione un municipio";
				}

				if (!is_numeric($id_colony)) {
					$c3 = "is-invalid";
					$m3 = "Seleccione una colonia";
				}

				if ($postcode == "") {
					$c4 = "is-invalid";
					$m4 = "Ingrese un codigo postal";
				}
				
				$this->errors([
					'c1' => $c1,
					'm1' => $m1,
					'c2' => $c2,
					'm2' => $m2,
					'c3' => $c3,
					'm3' => $m3,
					'c4' => $c4,
					'm4' => $m4,
					'postcode' => $postcode,
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getPostcodes();
		}

		function edit()
		{
			$this->validation();

			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$id_colony = isset($_POST['id_colony']) ? $_POST['id_colony'] : '';
			$id_postcode = isset($_POST['id_postcode']) ? $_POST['id_postcode'] : '';
			$colony = isset($_POST['colony']) ? preg_replace('/\s\s+/', ' ', trim($_POST['colony'])) : '';
			$postcode = isset($_POST['postcode']) ? $_POST['postcode'] : '';

			if (is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && is_numeric($id_colony) && $id_colony > 0 && is_numeric($id_postcode) && $id_postcode > 0 && is_numeric($postcode) && $postcode > 0) {
				if ($this->model->edit($id_state, $id_municipality, $id_colony, $id_postcode, $postcode)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'El codigo postal ' . $postcode . ' ya fue registrado en la colonia ' . $colony
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getPostcodes();
		}

		function store()
		{
			$this->validation();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				$postcode = $this->model->store($id);

				if (sizeof($postcode) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar Codigo postal";
					$this->view->postcodes = $postcode;
					$this->view->render('admin/postcodes/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getColonies();
		}

		function delete()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				if ($this->model->delete($id)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Codigo postal eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getPostcodes();
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

		function getPostcodes()
		{
			require_once 'models/admin/statesModel.php';
			$state = new StatesModel();
			$states = $state->getStates();
			$this->view->states = $states;

			$this->view->title = "Codigos postales";
			$postcodes = $this->model->getPostcodes();
			$this->view->postcodes = $postcodes;
			$this->view->render('admin/postcodes/show');
		}

		function getColonies()
		{
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';

			require_once 'models/admin/coloniesModel.php';
			$colony = new ColoniesModel();
			$colonies = $colony->getColoniesSpecific($id_municipality);
			
			$data = '<select id="colony" class="form-control" name="id_colony" required>';
			$data .= "<option selected>Seleccionar...</option>";
			require_once 'models/admin/colony.php';
			foreach ($colonies as $row) {
				$colon = new Colony();
				$colon = $row;

				$data .= '<option value="'.$colon->id_colony.'">'.$colon->colony.'</option>';
			}
			$data .= '</select>';
			echo $data;
		}

		function getPostcode()
		{
			$id_colony = isset($_POST['id_colony']) ? $_POST['id_colony'] : '';

			$postcodes = $this->model->getPostcodesSpecific($id_colony);

			$data = '<select id="postcode" class="form-control" name="id_postcode" required>';
			$data .= "<option selected>Seleccionar...</option>";
			require_once 'models/admin/postcode.php';
			foreach ($postcodes as $row) {
				$postcode = new Postcode();
				$postcode = $row;

				$data .= '<option value="'.$postcode->id_postcode.'">'.$postcode->postcode.'</option>';
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
			$c4 = isset($error['c4']) ? $error['c4'] : '';
			$m4 = isset($error['m4']) ? $error['m4'] : '';

			$postcode = isset($error['postcode']) ? $error['postcode'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'postcode' => $postcode,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>