<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Users extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->title = "Usuarios";
			$users = $this->model->getUsers();
			$this->view->users = $users;
			$this->view->render('admin/users/show');
		}

		function status()
		{
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
					$this->view->title = "Usuarios";
					$users = $this->model->getAdmins();
					$this->view->users = $users;
					$this->view->render('admin/users/show');
					return false;
				}
			}
			$this->errors([
				'alert' => 'alert-danger',
				'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
			]);
			$this->view->title = "Usuarios";
			$users = $this->model->getUsers();
			$this->view->users = $users;
			$this->view->render('admin/users/show');	
		}

		function delete()
		{
			$id = isset($_GET['id']) ? $_GET['id'] : '';
			if (is_numeric($id) && $id > 0) {
				switch ($this->model->delete($id)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Usuario eliminado exitosamente'
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
				$this->view->title = "Usuarios";
				$users = $this->model->getUsers();
				$this->view->users = $users;
				$this->view->render('admin/users/show');
			} else {
				$this->errors([
					'alert' => 'alert-danger',
					'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
				]);
				$this->view->title = "Usuarios";
				$users = $this->model->getUsers();
				$this->view->users = $users;
				$this->view->render('admin/users/show');
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