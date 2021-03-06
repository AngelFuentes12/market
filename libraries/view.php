<?php 

	/**
	* @author: Angel Fuentes
	*/
	class View
	{
		function render($name){
			if (isset($_SESSION['admin'])) {
				require_once 'views/layouts/admin/' . 'header.php';
			} elseif (isset($_SESSION['secretary'])) {
				require_once 'views/layouts/admin/' . 'header.php';
			} elseif (isset($_SESSION['user'])) {
				require_once 'views/layouts/user/' . 'header.php';
			} else {
				require_once 'views/layouts/user/' . 'header.php';
			}
			
			require_once 'views/' . $name . '.php';

			if (isset($_SESSION['admin'])) {
				require_once 'views/layouts/admin/' . 'footer.php';
			} elseif (isset($_SESSION['secretary'])) {
				require_once 'views/layouts/admin/' . 'footer.php';
			} elseif (isset($_SESSION['user'])) {
				require_once 'views/layouts/user/' . 'footer.php';
			} else {
				require_once 'views/layouts/user/' . 'footer.php';
			}
		}
	}

?>