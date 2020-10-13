<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Admins extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->title = "Administradores";
			$this->view->render('admin/admins/show');
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