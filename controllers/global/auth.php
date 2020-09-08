<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Auth extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->url = "Iniciar Sesión";
			$this->view->render('auth/login');
		}

		function login()
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			switch ($this->model->login($email, $password)) {
				case 'user':
					$this->view->url = "Bienvenido";
					$this->view->render('user/index');
					break;

				case 'admin':
					$this->view->url = "Bienvenido";
					$this->view->render('admin/index');
					break;

				case 'verification':
					$this->errors([
						'c1' => 'is-invalid', 'm1' => 'Revisa tu bandeja de correo electronico',
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				case 'suspended':
					$this->errors([
						'c1' => 'is-invalid',
						'c2' => 'is-invalid', 'm2' => 'Acceso restringido',
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				case 'password':
					$this->errors([
						'c1' => 'is-invalid',
						'c2' => 'is-invalid', 'm2' => 'La contraseña es invalida',
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				case 'email':
					$this->errors([
						'c1' => 'is-invalid', 'm1' => 'El correo electronico es invalido',
						'c2' => 'is-invalid', 
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				case 'credentials':
					$this->errors([
						'c1' => 'is-invalid', 'm1' => 'Estas credenciales son incorrectas',
						'c2' => 'is-invalid', 
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				default:
					$this->errors([
						'c1' => 'is-invalid', 'm1' => 'Ocurrio un error vuelva a intentarlo mas tarde',
						'email' => $email
					]);
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;
			}
		}

		function register()
		{
			$this->view->url = "Registrarse";
			$this->view->render('auth/register');
		}

		function errors($error)
		{
			$c1 = isset($error['c1']) ? $error['c1'] : "";
			$m1 = isset($error['m1']) ? $error['m1'] : "";
			$c2 = isset($error['c2']) ? $error['c2'] : "";
			$m2 = isset($error['m2']) ? $error['m2'] : "";

			$email = isset($error['email']) ? $error['email'] : "";

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'email'  => $email
			];
		}
	}

?>