<?php 
	
	/**
	* @author: Angel Fuentes
	*/
	class AuthModel extends Model
	{
		function __construct()
		{
			parent::__construct();	
		}

		function login($email, $password)
		{
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM t_usuarios WHERE correo = :email AND contrapass = :password");

			try {
				$query->execute([
					'email' => $email,
					'password' => $password
				]);

				$row = $query->fetch();
				if ($row['status'] != "") {
					if ($row['status'] == 1) {
						if ($row['correo'] === $email) {
							if ($row['contrapass'] === $password) {
								session_start();
								if ($row['nevel'] == 1) {
									$_SESSION['admin'] = $row['id_usuario'];
									$_SESSION['email'] = $row['correo'];
									$case = "admin";
								} elseif ($row['nevel'] == 2) {
									$_SESSION['secretary'] = $row['id_usuario'];
									$_SESSION['email'] = $row['correo'];
									$case = "secretary";
								} elseif ($row['nevel'] == 3) {
									$_SESSION['user'] = $row['id_usuario'];
									$_SESSION['email'] = $row['correo'];
									$case = "user";
								}
							} else {
								$case = "password";
							}
						} else {
							$case = "email";
						}
					} elseif ($row['status'] == 2) {
						$case = "verification";
					} elseif ($row['status'] == 3) {
						$case = "suspended";
					} else {
						$case = "suspended";
					}
				} else {
					$case = "credentials";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;	
			}
		}
	}

?>