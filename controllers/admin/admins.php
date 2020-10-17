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
			$this->getAdmins();
		}

		function register()
		{
			$this->validation();

			$name = isset($_POST['name']) ? preg_replace('/\s\s+/', ' ', trim($_POST['name'])) : '';
			$email = isset($_POST['email']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email'])) : '';
			$password = isset($_POST['password']) ? preg_replace('/\s\s+/', ' ', trim($_POST['password'])) : '';
			$confirmpassword = isset($_POST['confirmpassword']) ? preg_replace('/\s\s+/', ' ', trim($_POST['confirmpassword'])) : '';

			if ($email != '' && $email != '' && $password != '' && $confirmpassword != '') {
				if ($password === $confirmpassword) {
					switch ($this->model->register($name, $email, $password)) {
						case 'success':
							$this->sendEmailVerification($email);
							break;

						case 'email':
							$this->errors([
								'c2' => 'is-invalid',
								'm2' => 'Este correo ya fue registrado',
								'name' => $name,
								'email' => $email,
								'password' => $password,
								'alert' => 'alert-info',
								'message' => 'Verifiqué su información'
							]);
						break;
						
						default:
							$this->errorMessage();
							break;
					}
				} else {
					$this->errors([
						'c4' => 'is-invalid', 'm4' => 'Las contraseñas no coinciden',
						'name' => $name,
						'email' => $email,
						'password' => $password,
						'alert' => 'alert-info',
						'message' => 'Verifiqué su información'
					]);
				}
			} else {
				$c1 = ''; $m1 = '';
				$c2 = ''; $m2 = '';
				$c3 = ''; $m3 = '';
				$c4 = ''; $m4 = '';
				if ($name == '') {
					$c1 = 'is-invalid';
					$m1 = 'Debe ingresar un nombre';
				}

				if ($email == '') {
					$c2 = 'is-invalid';
					$m2 = 'Debe ingresar un correo electrónico';
				}

				if ($password == '') {
					$c3 = 'is-invalid';
					$m3 = 'Debe ingresar una contraseña';
				}

				if ($confirmpassword == '') {
					$c4 = 'is-invalid';
					$m4 = 'Debe confirmar su contraseña';
				}

				$this->errors([
					'c1' => $c1, 'm1' => $m1,
					'c2' => $c2, 'm2' => $m2,
					'c3' => $c3, 'm3' => $m3,
					'c4' => $c4, 'm4' => $m4,
					'name' => $name,
					'email' => $email,
					'password' => $password,
					'alert' => 'alert-info',
					'message' => 'Verifiqué su información'
				]);
			}
			$this->getAdmins();
		}

		function sendEmailVerification($email)
		{
			switch ($this->model->sendEmailVerification($email)) {
				case 'send':
					$this->errors([
						'alert' => 'alert-success', 
						'message' => 'Se envio un correo electrónico a ' . $email . ' con mas instrucciones',
						'email' => $email
					]);
					break;

				case 'failed':
				default:
					$this->errorMessage();
					break;
			}
		}

		function edit()
		{
			$this->validation();

			$id = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id) && $id > 0) {
				$admin = $this->model->edit($id);

				if (sizeof($admin) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar administrador";
					$this->view->admins = $admin;
					$this->view->render('admin/admins/edit');
				}
			} else {
				$this->errorMessage();
			}
			$this->getAdmins();
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
							$this->errorMessage();
							break;
					}
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getAdmins();	
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
						$this->errorMessage();
						break;
				}
			} else {
				$this->errorMessage();
			}
			$this->getAdmins();
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
		
		function getAdmins()
		{
			$this->view->title = "Administradores";
			$admins = $this->model->getAdmins();
			$this->view->admins = $admins;
			$this->view->render('admin/admins/show');
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

			$name = isset($error['name']) ? $error['name'] : "";
			$email = isset($error['email']) ? $error['email'] : "";
			$password = isset($error['password']) ? $error['password'] : "";

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'name'  => $name,
				'email'  => $email,
				'password'  => $password,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>