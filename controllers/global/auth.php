<?php 

	/**
	* @author: Angel Fuentes
	*/
	class Auth extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->title = "Iniciar sesión";
			$this->view->render('auth/login');
		}

		function login()
		{
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$password = isset($_POST['password']) ? $_POST['password'] : '';
			$response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

			if ($response != '') {
				$response = $_POST['g-recaptcha-response'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=".constant('SCPS')."&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status=='true'){
					switch ($this->model->login($email, base64_encode($password))) {
						case 'user':
							$this->errors([]);
							$this->view->title = "Bienvenido";
							$this->view->render('user/index');
							return false;
							break;

						case 'admin':
						case 'secretary':
							$this->errors([]);
							$this->view->title = "Bienvenido";
							$this->view->render('admin/index');
							return false;
							break;

						case 'verification':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Revisa tu bandeja de correo electrónico',
								'email' => $email
							]);
							break;

						case 'suspended':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Acceso denegado',
								'email' => $email
							]);
							break;

						case 'password':
							$this->errors([
								'c2' => 'is-invalid', 'm2' => 'La contraseña es invalida',
								'email' => $email
							]);
							break;

						case 'email':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'El correo electrónico es invalido', 
								'email' => $email
							]);
							break;

						case 'credentials':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Estas credenciales son incorrectas',
								'c2' => 'is-invalid', 
								'email' => $email
							]);
							break;

						case 'sessions':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Alcanzo el número máximo de sesiones activas',
								'email' => $email
							]);
							break;

						default:
							$this->errorMessage();
							break;
					}
				} else if ($status=='false'){
					$this->errorMessage();
				}
			} else {
				$this->errors([
					'c3' => 'is-invalid', 'm3' => 'Debe validar la captcha',
					'email' => $email
				]);
			}
			$this->view->title = "Iniciar sesión";
			$this->view->render('auth/login');
		}

		function register()
		{
			$this->errors([]);
			$this->view->title = "Registrarse";
			$this->view->render('auth/register');
		}

		function reset()
		{
			$this->errors([]);
			$this->view->title = "Restablecer contraseña";
			$this->view->render('auth/reset');
		}

		function resetpassword()
		{
			$email = isset($_POST['email']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email'])) : '';
			$response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

			if ($response != '') {
				$response = $_POST['g-recaptcha-response'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=".constant('SCPS')."&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status=='true'){
					if ($email != '') {
						switch ($this->model->reset($email)) {
							case 'register':
								$this->sendEmailReset($email);
								break;

							case 'email':
								$this->errors([
									'c1' => 'is-invalid', 
									'm1' => 'El correo electrónico es invalido',
									'email' => $email
								]);
								break;

							case 'credentials':
								$this->errors([
									'c1' => 'is-invalid', 
									'm1' => 'Esta credencial es incorrecta',
									'email' => $email
								]);
								break;
							
							default:
								$this->errorMessage();
								break;
						}
					} else {
						$this->errors([
							'c1' => 'is-invalid', 
							'm1' => 'Debe ingresar un correo electrónico',
							'email' => $email
						]);
					}
				} else if ($status=='false'){
					$this->errorMessage();
				}
			} else {
				$this->errors([
					'c2' => 'is-invalid', 'm2' => 'Debe validar la captcha',
					'email' => $email
				]);
			}

			$this->view->title = "Restablecer contraseña";
			$this->view->render('auth/reset');	
		}


		function sendEmailReset($email)
		{
			switch ($this->model->sendEmailReset($email)) {
				case 'send':
					$this->errors([
						'alert' => 'alert-success', 
						'message' => 'Se envio un correo electrónico a ' . $email . ' con mas instrucciones',
						'email' => $email
					]);
					$this->view->title = "Iniciar sesión";
					$this->view->render('auth/login');
					return false;
					break;

				case 'failed':
				default:
					$this->errorMessage();
					$this->view->title = "Restablecer contraseña";
					$this->view->render('auth/reset');
					break;
			}
		}

		function email()
		{
			$email = isset($_GET['email']) ? preg_replace('/\s\s+/', ' ', trim($_GET['email'])) : '';
			$token = isset($_GET['token']) ? $_GET['token'] : '';
			
			if ($email != '' && $token != '') {
				switch ($this->model->validationTokenReset($email, $token)) {
					case 'valid':
						$this->errors([
							'email' => $email,
							'token' => $token
						]);
						$this->view->title = "Cambiar contraseña";
						$this->view->render('auth/email');
						return false;
						break;

					case 'invalid':
						$this->errors([]);
						$this->view->title = "Ups...";
						$this->view->render('error/404');
						return false;
						break;
					
					default:
				}
			}

			$this->errors([]);
			$this->view->title = "Cambiar contraseña";
			$this->view->render('auth/reset');
		}

		function password()
		{
			$email = isset($_POST['email']) ? preg_replace('/\s\s+/', ' ', trim($_POST['email'])) : '';
			$token = isset($_POST['token']) ? $_POST['token'] : '';
			$password = isset($_POST['password']) ? preg_replace('/\s\s+/', ' ', trim($_POST['password'])) : '';
			$confirmpassword = isset($_POST['confirmpassword']) ? preg_replace('/\s\s+/', ' ', trim($_POST['confirmpassword'])) : '';
			$response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

			if ($response != '') {
				$response = $_POST['g-recaptcha-response'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=".constant('SCPS')."&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status == 'true') {
					if ($email != "" && $token != "" && $password != "" && $confirmpassword != "") {
						if ($password === $confirmpassword) {
							switch ($this->model->password($email, $token, base64_encode($password))) {
								case 'change':
									$this->errors([
										'email' => $email,
										'alert' => 'alert-success', 
										'message' => 'La contraseña fue actualizada exitosamente'
									]);
									$this->view->title = "Iniciar sesión";
									$this->view->render('auth/login');
									return false;
									break;

								case 'invalid':
								default:
									$this->errorMessage();
									$this->view->title = "Cambiar contraseña";
									$this->view->render('auth/reset');
									break;
							}
						} else {
							$this->errors([
								'c2' => 'is-invalid',
								'c3' => 'is-invalid', 'm3' => 'Las contraseñas no coinciden',
								'email' => $email,
								'password' => $password,
								'token' => $token
							]);
						}
						
					} else {
						$c1 = ""; $m1 = "";
						$c2 = ""; $m2 = "";
						$c3 = ""; $m3 = "";
						if ($email == "") {
							$c1 = "is-invalid";
							$m1 = "Debe ingresar un email";
						}

						if ($password == "") {
							$c2 = "is-invalid";
							$m2 = "Debe ingresar una contraseña";
						}

						if ($confirmpassword == "") {
							$c3 = "is-invalid";
							$m3 = "Debe confirmar su contraseña";
						}

						$this->errors([
							'c1' => $c1, 'm1' => $m1,
							'c2' => $c2, 'm2' => $m2,
							'c3' => $c3, 'm3' => $m3,
							'email' => $email,
							'password' => $password,
							'token' => $token
						]);
					}
				} else if ($status == 'false') {
					$this->errorMessage();
					$this->view->title = "Cambiar contraseña";
					$this->view->render('auth/reset');
					return false;
				}
			} else {
				$this->errors([
					'c4' => 'is-invalid', 'm4' => 'Debe validar la captcha',
					'email' => $email,
					'password' => $password,
					'token' => $token
				]);
			}
			$this->view->title = "Cambiar contraseña";
			$this->view->render('auth/email');
		}

		function verification()
		{
			$email = isset($_GET['email']) ? preg_replace('/\s\s+/', ' ', trim($_GET['email'])) : '';
			$token = isset($_GET['token']) ? $_GET['token'] : '';
			
			if ($email != '' && $token != '') {
				switch ($this->model->validationTokenVerification($email, $token)) {
					case 'valid':
						if ($this->model->verification($email)) {
							$this->errors([
								'email' => $email,
								'alert' => 'alert-success',
								'message' => 'Felicitaciones ' . $email . ' tu cuenta fue verificada, ahora puedes acceder al sistema'
							]);
						} else {
							$this->errorMessage();
						}
						
						break;

					case 'invalid':
						$this->errors([]);
						$this->view->title = "Ups...";
						$this->view->render('error/404');
						return false;
						break;
					
					default:
				}
			}

			$this->view->title = "Iniciar sesión";
			$this->view->render('auth/login');
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

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$email = isset($error['email']) ? $error['email'] : "";
			$password = isset($error['password']) ? $error['password'] : "";
			$token = isset($error['token']) ? $error['token'] : "";

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'email'  => $email,
				'password'  => $password,
				'token'  => $token,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>