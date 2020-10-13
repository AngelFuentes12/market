<?php 

	/**
	* @author: Angel Fuentes
	*/
	class User extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->url = "Bienvenido";
			$this->view->render('user/index');
		}

		function logout()
		{
			session_start();
			session_unset();
			session_destroy();
			$this->view->url = "Bienvenido";
			$this->view->render('index');
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