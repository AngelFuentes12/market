<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Auth extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index()
		{
			$this->view->url = "Iniciar Sesión"
			$this->view->render('auth/login');
		}

		function register()
		{
			$this->view->url = "Registrarse"
			$this->view->render('auth/register');
		}

?>