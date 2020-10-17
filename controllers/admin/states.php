<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class States extends Controller
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
			$this->getStates();
		}

		function register()
		{
			$this->validation();

			$state = isset($_POST['state']) ? preg_replace('/\s\s+/', ' ', trim($_POST['state'])) : '';

			if ($state != '') {
				switch ($this->model->register($state)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Estado registrado exitosamente'
						]);
						break;

					case 'state':
						$this->errors([
							'c1' => 'is-invalid',
							'm1' => 'Este estado ya fue registrado',
							'state' => $state,
							'alert' => 'alert-info',
							'message' => 'Verifique su información'
						]);
						break;
					
					default:
						$this->errorMessage();
						break;
				}
			} else {
				$this->errors([
					'c1' => 'is-invalid',
					'm1' => 'Ingrese un estado',
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getStates();
		}

		function delete()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				if ($this->model->delete($id)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Estado eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getStates();
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

		function getStates()
		{
			$this->view->title = "Estados";
			$states = $this->model->getStates();
			$this->view->states = $states;
			$this->view->render('admin/states/show');
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

			$state = isset($error['state']) ? $error['state'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'state' => $state,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>