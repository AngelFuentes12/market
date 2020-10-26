<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Vendors extends Controller
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
			$this->getVendors();

		}

		function register()
		{
			$this->validation();

			$emails = isset($_POST['email']) ? $_POST['email'] : null;
			$emails = rtrim($emails, ',');
			$emails = str_replace(' ', '', $emails);
			$emails = explode(',', $emails);
			$telephones = isset($_POST['telephone']) ? $_POST['telephone'] : null;
			$telephones = rtrim($telephones, ',');
			$telephones = str_replace(' ', '', $telephones);
			$telephones = explode(',', $telephones);

			$vendor = isset($_POST['vendor']) ? preg_replace('/\s\s+/', ' ', trim($_POST['vendor'])) : '';
			$name = isset($_POST['name']) ? preg_replace('/\s\s+/', ' ', trim($_POST['name'])) : '';
			$email = isset($emails[0]) ? $emails[0] : '';
			$email2 = isset($emails[1]) ? $emails[1] : '';
			$telephone = isset($telephones[0]) ? $telephones[0] : '';
			$telephone2 = isset($telephones[1]) ? $telephones[1] : '';
			$id_state = (isset($_POST['id_state']) && $_POST['id_state'] > 0) ? $_POST['id_state'] : '';
			$id_municipality = (isset($_POST['id_municipality']) && $_POST['id_municipality'] > 0) ? $_POST['id_municipality'] : '';
			$id_colony = (isset($_POST['id_colony']) && $_POST['id_colony'] > 0) ? $_POST['id_colony'] : '';
			$id_postcode = (isset($_POST['id_postcode']) && $_POST['id_postcode'] > 0) ? $_POST['id_postcode'] : '';
			$street = isset($_POST['street']) ? preg_replace('/\s\s+/', ' ', trim($_POST['street'])) : '';
			$inside = (isset($_POST['inside']) && $_POST['inside'] > 0) ? $_POST['inside'] : '';
			$outside = (isset($_POST['outside']) && $_POST['outside'] > 0) ? $_POST['outside'] : '';

			if ($vendor != '' && $name != '' && $email != '' && is_numeric($telephone) && is_numeric($id_state) && $id_state > 0 && is_numeric($id_municipality) && $id_municipality > 0 && is_numeric($id_colony) && $id_colony > 0 && is_numeric($id_postcode) && $id_postcode > 0 && $street != '' && is_numeric($inside) && is_numeric($outside)) {
				$c2 = ""; $m2 = "";
				$c3 = ""; $m3 = "";
				switch ($this->model->register($vendor, $name, $email, $email2, $telephone, $telephone2, $id_state, $id_municipality, $id_colony, $id_postcode, $street, $inside, $outside)) {
					case 'register':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Proveedor registrado exitosamente'
						]);
						$this->getVendors();
						return false;
						break;

					case 'email':
						$c2 = "is-invalid";
						$m2 = "Este correo electrónico ya fue registrado";
						break;

					case 'telephone':
						$c3 = "is-invalid";
						$m3 = "Este telefono ya fue registrado";
						break;

					case '':
					default:
						$this->errorMessage();
						$this->getVendors();
						return false;
						break;
				}
				$this->errors([
					'c2' => $c2,
					'm2' => $m2,
					'c3' => $c3,
					'm3' => $m3,
					'c4' => 'is-invalid',
					'm4' => 'Seleccione un estado',
					'c5' => 'is-invalid',
					'm5' => 'Seleccione un municipio',
					'c6' => 'is-invalid',
					'm6' => 'Seleccione una colonia',
					'c7' => 'is-invalid',
					'm7' => 'Seleccione un codigo postal',
					'vendor' => $vendor,
					'name' => $name,
					'email' => $email . ',' . $email2,
					'telephone' => $telephone . ',' . $telephone2,
					'street' => $street,
					'inside' => $inside,
					'outside' => $outside,
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			} else {
				$c1 = ""; $m1 = "";
				$c2 = ""; $m2 = "";
				$c3 = ""; $m3 = "";
				$c4 = ""; $m4 = "";
				$c5 = ""; $m5 = "";
				$c6 = ""; $m6 = "";
				$c7 = ""; $m7 = "";
				$c8 = ""; $m8 = "";
				$c9 = ""; $m9 = "";
				$c10 = ""; $m10 = "";
				$c11 = ""; $m11 = "";
				
				if ($name == '') {
					$c1 = 'is-invalid';
					$m1 = 'Ingrese un nombre';
				}

				if ($email == '') {
					$c2 = 'is-invalid';
					$m2 = 'Ingrese un correo electronico';
				}

				if ($telephone == '') {
					$c3 = 'is-invalid';
					$m3 = 'Ingrese un telefono';
				}

				if ($id_state == '') {
					$c4 = 'is-invalid';
					$m4 = 'Selecciona un estado';
				}

				if ($id_municipality == '') {
					$c5 = 'is-invalid';
					$m5 = 'Selecciona un municipio';
				}

				if ($id_colony == '') {
					$c6 = 'is-invalid';
					$m6 = 'Selecciona una colonia';
				}

				if ($id_postcode == '') {
					$c7 = 'is-invalid';
					$m7 = 'Selecciona un codigo postal';
				}

				if ($street == '') {
					$c8 = 'is-invalid';
					$m8 = 'Ingrese una calle';
				}

				if ($inside == '') {
					$c9 = 'is-invalid';
					$m9 = 'Ingresa un numero interior';
				}

				if ($outside == '') {
					$c10 = 'is-invalid';
					$m10 = 'Ingrese un numero exterior';
				}

				if ($vendor == '') {
					$c11 = 'is-invalid';
					$m11 = 'Ingrese un proveedor';
				}

				$this->errors([
					'c1' => $c1, 'm1' => $m1,
					'c2' => $c2, 'm2' => $m2,
					'c3' => $c3, 'm3' => $m3,
					'c4' => $c4, 'm4' => $m4,
					'c5' => $c5, 'm5' => $m5,
					'c6' => $c6, 'm6' => $m6,
					'c7' => $c7, 'm7' => $m7,
					'c8' => $c8, 'm8' => $m8,
					'c9' => $c9, 'm9' => $m9,
					'c10' => $c10, 'm10' => $m10,
					'c11' => $c11, 'm11' => $m11,

					'vendor'  => $vendor,
					'name'  => $name,
					'email'  => $email . ',' . $email2,
					'telephone'  => $telephone . ',' . $telephone2,
					'street'  => $street,
					'outside'  => $outside,
					'inside'  => $inside,

					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getVendors();
		}

		function getStates()
		{
			require_once 'models/admin/statesModel.php';
			$state = new StatesModel();
			$states = $state->getStates();
			$this->view->states = $states;
		}

		function getVendors()
		{
			$this->getStates();
			$vendors = $this->model->getVendors();
			$this->view->vendors = $vendors;
			$this->view->title = "Proveedores";
			$this->view->render('admin/vendors/show');
		}

		function store()
		{
			$this->validation();

			$id_vendor = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_vendor) && $id_vendor > 0) {
				$vendor = $this->model->store($id_vendor);

				if (sizeof($vendor) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar proveedor";
					$this->view->vendors = $vendor;
					$this->view->render('admin/vendors/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getVendors();
		}

		function edit()
		{
			$this->validation();

			$id_vendor = isset($_POST['id_vendor']) ? $_POST['id_vendor'] : '';
			$id_direcction		 = isset($_POST['id_direcction']) ? $_POST['id_direcction'] : '';
			$vendor = isset($_POST['vendor']) ? preg_replace('/\s\s+/', ' ', trim($_POST['vendor'])) : '';
			$name = isset($_POST['name']) ? preg_replace('/\s\s+/', ' ', trim($_POST['name'])) : '';
			$email2 = isset($_POST['email2']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email2'])) : '';
			$telephone2 = isset($_POST['telephone2']) ? $_POST['telephone2'] : '';
			$street = isset($_POST['street']) ? preg_replace('/\s\s+/', ' ', trim($_POST['street'])) : '';
			$inside = isset($_POST['inside']) ? $_POST['inside'] : '';
			$outside = isset($_POST['outside']) ? $_POST['outside'] : '';

			if (is_numeric($id_vendor) && $id_vendor > 0 && $id_direcction) && $id_direcction > 0 && $vendor != "" && $name != "" && $street != "" $$ is_numeric($inside) && $inside > 0 && is_numeric($outside) && $outside > 0) {
				if ($this->model->edit($id_direcction, $id_vendor, $vendor, $name, $email2, $telephone2, $street, $inside, $outside)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getVendors();
		}

		function delete()
		{
			$this->validation();

			$id_vendor = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_vendor) && $id_vendor > 0) {
				if ($this->model->delete($id_vendor)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Proveedor eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getVendors();
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

		function errorMessage()
		{	
			$this->errors([
				'alert' => 'alert-danger',
				'message' => 'Ocurrió un error, vuelva a interntarlo más tarde'
			]);
		}

		function errors($error)
		{
			$c1 = isset($error['c1']) ? $error['c1'] : "";
			$m1 = isset($error['m1']) ? $error['m1'] : "";
			$c2 = isset($error['c2']) ? $error['c2'] : "";
			$m2 = isset($error['m2']) ? $error['m2'] : "";
			$c3 = isset($error['c3']) ? $error['c3'] : "";
			$m3 = isset($error['m3']) ? $error['m3'] : "";
			$c4 = isset($error['c4']) ? $error['c4'] : "";
			$m4 = isset($error['m4']) ? $error['m4'] : "";
			$c5 = isset($error['c5']) ? $error['c5'] : "";
			$m5 = isset($error['m5']) ? $error['m5'] : "";
			$c6 = isset($error['c6']) ? $error['c6'] : "";
			$m6 = isset($error['m6']) ? $error['m6'] : "";
			$c7 = isset($error['c7']) ? $error['c7'] : "";
			$m7 = isset($error['m7']) ? $error['m7'] : "";
			$c8 = isset($error['c8']) ? $error['c8'] : "";
			$m8 = isset($error['m8']) ? $error['m8'] : "";
			$c9 = isset($error['c9']) ? $error['c9'] : "";
			$m9 = isset($error['m9']) ? $error['m9'] : "";
			$c10 = isset($error['c10']) ? $error['c10'] : "";
			$m10 = isset($error['m10']) ? $error['m10'] : "";
			$c11 = isset($error['c11']) ? $error['c11'] : "";
			$m11 = isset($error['m11']) ? $error['m11'] : "";

			$vendor = isset($error['vendor']) ? $error['vendor'] : "";
			$name = isset($error['name']) ? $error['name'] : "";
			$email = isset($error['email']) ? $error['email'] : "";
			$telephone = isset($error['telephone']) ? $error['telephone'] : "";
			$street = isset($error['street']) ? $error['street'] : "";
			$outside = isset($error['outside']) ? $error['outside'] : "";
			$inside = isset($error['inside']) ? $error['inside'] : "";

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'c5' => $c5, 'm5' => $m5,
				'c6' => $c6, 'm6' => $m6,
				'c7' => $c7, 'm7' => $m7,
				'c8' => $c8, 'm8' => $m8,
				'c9' => $c9, 'm9' => $m9,
				'c10' => $c10, 'm10' => $m10,
				'c11' => $c11, 'm11' => $m11,

				'vendor'  => $vendor,
				'name'  => $name,
				'email'  => $email,
				'telephone'  => $telephone,
				'street'  => $street,
				'outside'  => $outside,
				'inside'  => $inside,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>