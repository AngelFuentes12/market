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
			$this->view->title = "Proveedores";
			$this->getStates();
			$this->view->render('admin/vendors/show');
		}

		function register()
		{
			$name = isset($_POST['name']) ? preg_replace('/\s\s+/', ' ', trim($_POST['name'])) : '';
			$email = isset($_POST['email']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email'])) : '';
			$email2 = isset($_POST['email2']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email2'])) : '';
			$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$telephone2 = isset($_POST['telephone2']) ? $_POST['telephone2'] : '';
			$id_state = isset($_POST['id_state']) ? $_POST['id_state'] : '';
			$id_municipality = isset($_POST['id_municipality']) ? $_POST['id_municipality'] : '';
			$id_colony = isset($_POST['id_colony']) ? $_POST['id_colony'] : '';
			$id_postcode = isset($_POST['id_postcode']) ? $_POST['id_postcode'] : '';
			$street = isset($_POST['street']) ? preg_replace('/\s\s+/', ' ', trim($_POST['street'])) : '';
			$inside = isset($_POST['inside']) ? $_POST['inside'] : '';
			$outside = isset($_POST['outside']) ? $_POST['outside'] : '';
		}

		function getStates()
		{
			require_once 'models/admin/statesModel.php';
			$state = new StatesModel();
			$states = $state->getStates();
			$this->view->states = $states;
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

			$name = isset($error['name']) ? $error['name'] : "";
			$email = isset($error['email']) ? $error['email'] : "";
			$email2 = isset($error['email2']) ? $error['email2'] : "";
			$telephone = isset($error['telephone']) ? $error['telephone'] : "";
			$telephone2 = isset($error['telephone2']) ? $error['telephone2'] : "";
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

				'name'  => $name,
				'email'  => $email,
				'email2'  => $email2,
				'telephone'  => $telephone,
				'telephone2'  => $telephone2,
				'street'  => $street,
				'outside'  => $outside,
				'inside'  => $inside,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>