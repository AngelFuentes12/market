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
			$this->view->title = "Iniciar Sesión";
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
				$secretPassword='6LfkDdcZAAAAALvCupYPHNO8HsjF7Uz2Ywr-opUh';
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=$secretPassword&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status=='true'){
					switch ($this->model->login($email, $password)) {
						case 'user':
							$this->errors([]);
							$this->view->title = "Bienvenido";
							$this->view->render('user/index');
							break;

						case 'admin':
							$this->errors([]);
							$this->view->title = "Bienvenido";
							$this->view->render('admin/index');
							break;

						case 'secretary':
							$this->errors([]);
							$this->view->title = "Bienvenido";
							$this->view->render('admin/index');
							break;

						case 'verification':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Revisa tu bandeja de correo electronico',
								'email' => $email
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;

						case 'suspended':
							$this->errors([
								'c1' => 'is-invalid',
								'c2' => 'is-invalid', 'm2' => 'Acceso restringido',
								'email' => $email
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;

						case 'password':
							$this->errors([
								'c1' => 'is-invalid',
								'c2' => 'is-invalid', 'm2' => 'La contraseña es invalida',
								'email' => $email
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;

						case 'email':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'El correo electronico es invalido',
								'c2' => 'is-invalid', 
								'email' => $email
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;

						case 'credentials':
							$this->errors([
								'c1' => 'is-invalid', 'm1' => 'Estas credenciales son incorrectas',
								'c2' => 'is-invalid', 
								'email' => $email
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;

						default:
							$this->errors([
								'alert' => 'alert-danger', 
								'message' => 'Ocurrio un error vuelva a intentarlo mas tarde'
							]);
							$this->view->title = "Iniciar Sesión";
							$this->view->render('auth/login');
							break;
					}
				} else if ($status=='false'){
					$this->errors([
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Iniciar Sesión";
					$this->view->render('auth/login');
				}
			} else {
				$this->errors([
					'c3' => 'is-invalid', 'm3' => 'Debe validar la captcha',
					'email' => $email
				]);
				$this->view->title = "Iniciar Sesión";
				$this->view->render('auth/login');
			}
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
			$email = isset($_POST['email']) ? $_POST['email'] : '';

			if ($email != '') {
				switch ($this->model->reset($email)) {
					case 'register':
						$this->sendEmailReset($email);
						echo '<br>'.$email . ' reset';
						break;

					case 'email':
						$this->errors([
							'c1' => 'is-invalid', 
							'm1' => 'El correo electronico es invalido',
							'email' => $email
						]);
						$this->view->title = "Restablecer contraseña";
						$this->view->render('auth/reset');
						break;

					case 'credentials':
						$this->errors([
							'c1' => 'is-invalid', 
							'm1' => 'Esta credencial es incorrecta',
							'email' => $email
						]);
						$this->view->title = "Restablecer contraseña";
						$this->view->render('auth/reset');
						break;
					
					default:
						$this->errors([
							'alert' => 'alert-danger', 
							'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
						]);
						$this->view->title = "Restablecer contraseña";
						$this->view->render('auth/reset');
						break;
				}
			} else {
				$this->errors([
					'c1' => 'is-invalid', 
					'm1' => 'Debe completar este campo',
					'email' => $email
				]);
				$this->view->title = "Restablecer";
				$this->view->render('auth/reset');
			}	
		}

		function sendEmailReset($email)
		{
			echo $email . ' sendEmailReset';
			/*switch ($this->model->sendEmailReset($email)) {
				case 'send':
					$this->errors([
						'alert' => 'alert-success', 
						'message' => 'Se envio un correo electronico a ' . $email . ' con mas instrucciones',
						'email' => $email
					]);
					$this->view->title = "Iniciar Sesión";
					$this->view->render('auth/login');
					break;

				case 'failed':
					$this->errors([
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Restablecer contraseña";
					$this->view->render('auth/reset');
					break;
				
				default:
					$this->errors([
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Restablecer contraseña";
					$this->view->render('auth/reset');
					break;
			}*/
		}

		function email()
		{
			$email = isset($_GET['email']) ? $_GET['email'] : '';
			$token = isset($_GET['token']) ? $_GET['token'] : '';
			
			if ($email != '' && $token != '') {
				switch ($this->model->validationToken($email, $token)) {
					case 'valid':
						$this->errors([
							'email' => $email,
							'token' => $token
						]);
						$this->view->title = "Cambiar contraseña";
						$this->view->render('auth/email');
						break;

					case 'invalid':
						$this->errors([]);
						$this->view->title = "Ups...";
						$this->view->render('error/404');
						break;
					
					default:
						$this->errors([]);
						$this->view->title = "Cambiar contraseña";
						$this->view->render('auth/reset');
						break;
				}
			} else {
				$this->errors([]);
				$this->view->title = "Cambiar contraseña";
				$this->view->render('auth/reset');
			}
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
				$secretPassword='6LfkDdcZAAAAALvCupYPHNO8HsjF7Uz2Ywr-opUh';
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=$secretPassword&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status == 'true'){
					if ($email != '') {
						if ($token != '') {
							if ($password != '') {
								if ($confirmpassword != '') {
									if ($password === $confirmpassword) {
										switch ($this->model->password($email, $token, $confirmpassword)) {
											case 'change':
												$this->errors([
													'email' => $email,
													'alert' => 'alert-success', 
													'message' => 'La contraseña fue actualizada exitosamente'
												]);
												$this->view->title = "Iniciar Sesión";
												$this->view->render('auth/login');
												break;

											case 'invalid':
											default:
												$this->errors([
													'email' => $email,
													'alert' => 'alert-danger', 
													'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
												]);
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
										$this->view->title = "Cambiar contraseña";
										$this->view->render('auth/email');
									}
								} else {
									$this->errors([
										'c3' => 'is-invalid', 'm3' => 'Confirme su contraseña',
										'email' => $email,
										'password' => $password,
										'token' => $token
									]);
									$this->view->title = "Cambiar contraseña";
									$this->view->render('auth/email');
								}
							} else {
								$this->errors([
									'c2' => 'is-invalid', 'm2' => 'Ingrese una contraseña',
									'email' => $email,
									'token' => $token
								]);
								$this->view->title = "Cambiar contraseña";
								$this->view->render('auth/email');
							}
						}
					}
					$this->errors([
						'email' => $email,
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Cambiar contraseña";
					$this->view->render('auth/reset');
				} else if ($status == 'false'){
					$this->errors([
						'email' => $email,
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->title = "Cambiar contraseña";
					$this->view->render('auth/reset');
				}
			} else {
				$this->errors([
					'c4' => 'is-invalid', 'm4' => 'Debe validar la captcha',
					'email' => $email,
					'password' => $password,
					'token' => $token
				]);
				$this->view->title = "Cambiar contraseña";
				$this->view->render('auth/email');
			}
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