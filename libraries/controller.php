<?php

	/**
	 * Autor: Angel Fuentes
	 */
	class Controller
	{
		
		function __construct()
		{
			$this->view = new View();
		}

		function loadModel($dir, $model)
		{
			$url = 'models/' . $dir . '/' .$model . 'Model.php';

			if (file_exists($url)) {
				require_once $url;
				$modelName = $model . 'Model';
				$this->model = new $modelName();
			}
		}
	}

?>