<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Admins extends Controller
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
			$this->view->title = "Administradores";
			$admins = $this->model->getAdmins();
			$this->view->admins = $admins;
			$this->view->render('admin/admins/show');
		}

		function register()
		{
			$this->validation();

			$this->errors([]);
			$this->view->title = "Nuevo administrador";
			$this->view->render('admin/admins/register');
		}

		function edit()
		{
			$this->validation();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				$admin = $this->model->edit($id);

				if (sizeof($admin) == 0) {
					$this->errors([
						'alert' => 'alert-danger',
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Administradores";
					$admins = $this->model->getAdmins();
					$this->view->admins = $admins;
					$this->view->render('admin/admins/show');
				} else {
					$this->errors([]);
					$this->view->title = "Editar administrador";
					$this->view->admins = $admin;
					$this->view->render('admin/admins/edit');
				}
			} else {
				$this->errors([
					'alert' => 'alert-danger',
					'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
				]);
				$this->view->title = "Administradores";
				$admins = $this->model->getAdmins();
				$this->view->admins = $admins;
				$this->view->render('admin/admins/show');
			}
		}

		function status()
		{
			$this->validation();

			$id = isset($_GET['id']) ? $_GET['id'] : '';
			$status = isset($_GET['status']) ? $_GET['status'] : '';

			if (is_numeric($id) && $id > 0) {
				if ($status == 1 || $status == 3) {
					switch ($this->model->changeStatus($id, $status)) {
						case 'success':
							$this->errors([
								'alert' => 'alert-success',
								'message' => 'Estatus cambiado exitosamente'
							]);
							break;

						case 'fail':
						default:
							$this->errors([
								'alert' => 'alert-danger',
								'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
							]);
							break;
					}
					$this->view->title = "Administradores";
					$admins = $this->model->getAdmins();
					$this->view->admins = $admins;
					$this->view->render('admin/admins/show');
				}
			}
			$this->errors([
				'alert' => 'alert-danger',
				'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
			]);
			$this->view->title = "Administradores";
			$admins = $this->model->getAdmins();
			$this->view->admins = $admins;
			$this->view->render('admin/admins/show');	
		}

		function delete()
		{
			$this->validation();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				switch ($this->model->delete($id)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Administrador eliminado exitosamente'
						]);
						break;

					case 'fail':
					default:
						$this->errors([
							'alert' => 'alert-danger',
							'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
						]);
						break;
				}
				$this->view->title = "Administradores";
				$admins = $this->model->getAdmins();
				$this->view->admins = $admins;
				$this->view->render('admin/admins/show');
			} else {
				$this->errors([
					'alert' => 'alert-danger',
					'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
				]);
				$this->view->title = "Administradores";
				$admins = $this->model->getAdmins();
				$this->view->admins = $admins;
				$this->view->render('admin/admins/show');
			}
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