<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Product extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$marks = $this->model->getMarks();
			$this->view->marks = $marks;
			$this->view->url = "Registar producto";
			$this->view->render('admin/products/register');
		}

		function register()
		{
			
		}

		function show()
		{
			$this->errors([]);
			$this->view->url = "Ver productos";
			$this->view->render('admin/products/show');
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