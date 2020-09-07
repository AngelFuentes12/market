<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Product extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function register()
		{
			$this->view->url = "Registar producto";
			$this->view->render('admin/products/register');
		}

		function show()
		{
			$this->view->url = "Ver productos";
			$this->view->render('admin/products/show');
		}
	}

?>