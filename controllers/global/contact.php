<?php

	/**
	* @author: Angel Fuentes
	*/
	class Contact extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->title = "Contacto";
			$this->view->render('user/contact/show');
		}

		function send()
		{
			$this->view->title = "Contacto";

			$name = isset($_POST['name']) ? $_POST['name'] : '';
			$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
			$email = isset($_POST['email']) ? $_POST['email'] : '';
			$response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
			$description = isset($_POST['description']) ? $_POST['description'] : '';

			if ($name != '' && $telephone != '' && $email != '' && $response != '' && $description != '') {

				$response = $_POST['g-recaptcha-response'];
				$ip = $_SERVER['REMOTE_ADDR'];
				$password='6LfkDdcZAAAAALvCupYPHNO8HsjF7Uz2Ywr-opUh';
				$recaptcha = "https://www.google.com/recaptcha/api/siteverify?secret=$password&response=$response&remoteip=$ip";

				$response = file_get_contents($recaptcha) ;

				$dividir = explode('"success":', $response);
				$data = explode(',', $dividir[1]);

				$status = trim($data[0]);

				if ($status=='true'){
					$this->errors([
						'alert' => 'alert-success', 
						'message' => 'Tu mensaje a sido enviado'
					]);
					$this->view->render('user/contact/show');
				} else if ($status=='false'){
					$this->errors([
						'alert' => 'alert-danger', 
						'message' => 'Ocurrio un error, vuelva a intentarlo más tarde'
					]);
					$this->view->render('user/contact/show');
				}
			} else {
				$this->errors([
					'c4' => 'is-invalid', 'm4' => 'Debe verificar la captcha',
					'name' => $name,
					'telephone' => $telephone,
					'email' => $email,
					'description' => $description
				]);
				$this->view->render('user/contact/show');
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
			$c5 = isset($error['c5']) ? $error['c5'] : "";
			$m5 = isset($error['m5']) ? $error['m5'] : "";

			$name = isset($error['name']) ? $error['name'] : "";
			$telephone = isset($error['telephone']) ? $error['telephone'] : "";
			$email = isset($error['email']) ? $error['email'] : "";
			$description = isset($error['description']) ? $error['description'] : "";

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'c5' => $c5, 'm5' => $m5,
				'name'  => $name,
				'telephone'  => $telephone,
				'email' => $email,
				'description' => $description,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>