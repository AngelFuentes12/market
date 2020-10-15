<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Products extends Controller
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
			$this->view->title = "Productos";
			$this->view->render('admin/products/show');
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
					$this->errors([
						'alert' => 'alert-danger',
						'message' => 'Ocurrio un error, vuelva a interntarlo más tarde'
					]);
					$this->view->title = "Bienvenido";
					$this->view->render('admin/index');
				}
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