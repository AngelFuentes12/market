<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class  extends Controller
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
			$this->view->title = "";
			$this->view->render('user/');
		}

		function validation()
		{
			require_once 'models/user/validation.php';
			$validation = new Validation();
			if ($validation->validationSession() == false) {
				require_once 'models/user/userModel.php';
				$logout = new UserModel();
				if ($logout->logout()) {
					session_unset();
					session_destroy();
					header("Location: " . constant('URL'));
				} else {
					$this->errorMessage();
					$this->view->title = "Bienvenido";
					$this->view->render('user/index');
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
			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>