<?php

	/**
	* @author: Angel Fuentes
	*/
	class Errors extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function error404()
		{
			$this->errors([]);
			$this->view->title = "Ups...";
			$this->view->render('error/404');
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