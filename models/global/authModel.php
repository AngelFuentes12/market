<?php 
	
	/**
	 *  Autor: Angel Fuentes
	 */
	class AuthModel extends Model
	{
		function __construct()
		{
			parent::__construct();	
		}

		function login($email, $password)
		{
			$user = "";
			$sql = $this->db->connection()->prepare("SELECT * FROM checks WHERE email = :email AND password = :password");

			try {
				$sql->execute([
					'email' => $email,
					'password' => $password
				]);

				$row = $sql->fetch();

				if ($row['type_user'] == "Admin") {
					session_start();
					$_SESSION['admin'] = $row['id_check'];
					$user = "admin";
				} else {
					$user = "";
				}

				return $user;
			} catch (PDOException $e) {
				return $user;	
			}
		}
	}

?>