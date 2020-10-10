<?php 

	/**
	* @author: Angel Fuentes
	*/
	class Database
	{
		private $host;
		private $user;
		private $password;
		private $db;
		private $charset;

		function __construct()
		{
			$this->host = constant('HOST');
			$this->user = constant('USER');
			$this->password = constant('PASSWORD');
			$this->db = constant('DB');
			$this->charset = constant('CHARSET');
		}

		function connection()
		{
			try {
				$connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charser=" . $this->charset;
				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => false,
				];
				$pdo = new PDO($connection, $this->user, $this->password, $options);

				return $pdo;
			}catch(PDOException $e){
				print_r('Error connection: ' . $e->getMessage());
			}
		}
	}

?>