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
	}

?>