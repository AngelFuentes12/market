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
			$this->view->url = "Iniciar Sesión";
			$this->view->render('auth/login');
		}

		function login()
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			switch ($this->model->login($email, $password)) {
				case 'admin':
					$this->view->url = "Bienvenido";
					$this->view->render('admin/index');
					break;

				case 'user':
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/index');
					break;
				
				default:
					$this->view->url = "Iniciar Sesión";
					$this->view->render('auth/index');
					break;
			}
		}

		function register()
		{
			$this->view->url = "Registrarse";
			$this->view->render('auth/register');
		}
	}

?>