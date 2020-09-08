<?php

	/**
	 * Autor: Angel Fuentes
	 */
	class Errors extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function error404()
		{
			$this->view->url = "Ups...";
			$this->view->render('error/404');
		}
	}

?>