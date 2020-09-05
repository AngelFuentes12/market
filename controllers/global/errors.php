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
			$this->cleanError();
			$this->view->render('error/404');
		}

		function cleanError()
		{
			$this->view->alert = [
				'class' => '',
				'message' => ''
			];
		}
	}

?>