<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class View
	{
		function render($name){
			require_once 'views/layouts/' . 'header.php';
			
			require_once 'views/' . $name . '.php';

			require_once 'views/layouts/' . 'footer.php';
		}
	}

?>