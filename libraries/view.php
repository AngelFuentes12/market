<?php 

	/**
	* @author: Angel Fuentes
	*/
	class View
	{
		function render($name){
			session_start();
			if (isset($_SESSION['admin'])) {
				require_once 'views/layouts/admin/' . 'header.php';
			} else {
				require_once 'views/layouts/user/' . 'header.php';
			}
			
			require_once 'views/' . $name . '.php';

			if (isset($_SESSION['admin'])) {
				require_once 'views/layouts/admin/' . 'footer.php';
			} else {
				require_once 'views/layouts/user/' . 'footer.php';
			}
		}
	}

?>