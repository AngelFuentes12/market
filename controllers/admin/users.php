<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Users extends Controller
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
			$this->getUsers();
		}

		function status()
		{
			$this->validation();

			$id_user = isset($_GET['id']) ? $_GET['id'] : '';
			$status = isset($_GET['status']) ? $_GET['status'] : '';

			if (is_numeric($id_user) && $id_user > 0) {
				if ($status == 1 || $status == 3) {
					switch ($this->model->changeStatus($id_user, $status)) {
						case 'success':
							$this->errors([
								'alert' => 'alert-success',
								'message' => 'Estatus cambiado exitosamente'
							]);
							break;

						case 'fail':
						default:
							$this->errorMessage();
							break;
					}
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getUsers();	
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

		function getUsers()
		{
			$this->view->title = "Clientes";
			$users = $this->model->getUsers();
			$this->view->users = $users;
			$this->view->render('admin/users/show');
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