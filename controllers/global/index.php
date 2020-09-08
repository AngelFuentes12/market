<?php

	/**
	 * Autor: Angel Fuentes
	 */
	class Index extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function index()
		{
			$this->view->url = 'Bienvenido';
			$this->view->render('index');
		}
	}

?>