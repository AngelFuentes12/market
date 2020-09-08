<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Mark extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function index()
		{
			$this->view->url = "Registar marca";
			$this->view->render('admin/marks/register');
		}
	}

?>