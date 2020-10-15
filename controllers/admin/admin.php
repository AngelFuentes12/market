<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Admin extends Controller
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
			$this->view->title = "Bienvenido";
			$this->view->render('admin/index');
		}

		function logout()
		{
			if ($this->model->logout()) {
				session_unset();
				session_destroy();
				header("Location: " . constant('URL'));
			} else {
				$this->errors([
					'alert' => 'alert-danger',
					'message' => 'Ocurrio un error, vuelva a interntarlo más tarde'
				]);
				$this->view->title = "Bienvenido";
				$this->view->render('admin/index');
			}
		}

		function validation()
		{
			require_once 'models/admin/validation.php';
			$validation = new Validation();
			if ($validation->validationSession() == false) {
				$this->logout();
			}
		}

		function errors($error)
		{
			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>