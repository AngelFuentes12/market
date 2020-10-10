<?php

	/**
	* @author: Angel Fuentes
	*/
	class App
	{
		function __construct()
		{
			session_start();
			$url = isset($_GET['url']) ? $_GET['url'] : null;
			$url = rtrim($url, '/');
			$url = str_replace(' ', '', $url);
			$url = explode('/', $url);

			$controller = isset($url[0]) ? $url[0] : '';
			$method = isset($url[1]) ? $url[1] : '';

			if ($controller != '') {
				if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
					$dir = "";
					if (isset($_SESSION['admin'])) {
						$dir = "admin";
					} elseif (isset($_SESSION['user'])) {
						$dir = "user";
					}

					$fileController = 'controllers/'. $dir .'/'. $controller . '.php';
					if (file_exists($fileController)) {
						require_once $fileController;
						$controller = new $controller;
						$controller->loadModel($dir, $url[0]);

						if ($method == '') {
							$controller->index();
						} else {
							if (method_exists($controller, $method)) {
								$controller->$method();
							} else {
								$this->error404();
							}
						}
					} else {
						$this->error404();
					}
				} else {
					$fileController = 'controllers/global/'. $controller . '.php';
					if (file_exists($fileController)) {
						require_once $fileController;
						$controller = new $controller;
						$controller->loadModel('global', $url[0]);

						if ($method == '') {
							$controller->index();
						} else {
							if (method_exists($controller, $method)) {
								$controller->$method();
							} else {
								$this->error404();
							}
						}
					} else {
						$this->error404();
					}
				}
			} else {
				$this->validation();
			}
		}

		function validation()
		{
			$fileController = 'controllers/global/index.php';
			require_once $fileController;
			$controller = new Index();
			$controller->index();
			return false;
		}

		function error404()
		{
			require_once 'controllers/global/errors.php';
			$controller = new Errors();
			$controller->error404();
		}
	}

?>