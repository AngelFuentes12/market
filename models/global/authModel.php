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
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM checks WHERE email = :email AND password = :password");

			try {
				$query->execute([
					'email' => $email,
					'password' => $password
				]);

				$row = $query->fetch();
				if ($row['status'] != "") {
					if ($row['status'] == "Active") {
						if ($row['email'] === $email) {
							if ($row['password'] === $password) {
								session_start();
								if ($row['type_user'] == "Admin") {
									$_SESSION['admin'] = $row['id_check'];
									$case = "admin";
								} elseif ($row['type_user'] == "User") {
									$_SESSION['user'] = $row['id_check'];
									$case = "user";
								}
							} else {
								$case = "password";
							}
						} else {
							$case = "email";
						}
					} elseif ($row['status'] == "Verification") {
						$case = "verification";
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