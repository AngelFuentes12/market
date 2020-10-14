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

		function reset($email)
		{
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM t_usuarios WHERE correo = :email");
			$query_val = $this->db->connection()->prepare("SELECT * FROM t_reset WHERE email = :email AND status = 'Valid'");
			$query_upd = $this->db->connection()->prepare("UPDATE t_reset SET status = 'expired' WHERE id_reset = :id_reset ");
			$query_reg = $this->db->connection()->prepare("INSERT INTO t_reset (email, token, create_at, status) VALUES(:email, :token, NOW(), 'Valid')");
			$token = base64_encode(date("Y-m-d H:i:s"));

			try {
				$query->execute(['email' => $email]);

				$row = $query->fetch();
				if ($row['status'] != "") {
					if ($row['correo'] === $email) {
						$query_val->execute(['email' => $email]);
						
						$row_val = $query_val->fetch();
						if ($row_val['id_reset'] != "") {
							$query_upd->execute(['id_reset' => $row_val['id_reset']]);

							$query_reg->execute([
								'email' => $email, 
								'token' => $token
							]);

							$case = "register";
						} else {
							$query_reg->execute([
								'email' => $email, 
								'token' => $token
							]);

							$case = "register";
						}
					} else {
						$case = "email";
					}
				} else {
					$case = "credentials";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;	
			}
		}

		function sendEmailReset($email)
		{
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM t_reset WHERE email = :email AND status = 'Valid'");

			try {
				$query->execute(['email' => $email]);

				$row = $query->fetch();
				$token = $row['token'];
				$url = constant('URL') . 'auth/email?email=' . $email . '&token=' . $token;

				$to = $email;
				$title = 'Restablecimiento de contraseña';
				$from = 'MIME-Version: 1.0' . "\r\n";
				$from .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$from .= 'From: support@market.com';

				$message = '<!DOCTYPE html>
				<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
					<title>Shopping Market</title>

					<style type="text/css">
						* {
							font-family: "Arial", sans-serif;
						}

						.container {
							width: 80%;
							margin: auto;
						}

						.title {
							font-size: 1.5em;
							color: #fff;
							text-align: center;
							padding: .4em;
							width: 80%;
							margin: auto;
							text-transform: uppercase;
							font-weight: bold;
						}

						.copy {
							text-align: center;
							color: #fff;
							padding: .5em
						}

						.content {
							text-align: center;
							padding: 2em;
							margin: 1em;
						}

						.message {
							font-size: 1em;
							text-transform: uppercase;
						}
					</style>
					
				</head>
				<body>
					<div class="container">
						<div class="row">
							<div class="col" style="background-color: #000;">
								<p class="title">Shopping Market</p>
							</div>
						</div>
					</div>

					<div class="content">
						<div class="row">
							<div class="message">
								<p><b>Restablecimiento de contraseña</b></p>
							</div>

							<div class="col-12">
								<p>
									' . $url . '
								</p>
							</div>
						</div>
					</div>

					<div class="container fixed-bottom">
						<div class="row">
							<div class="col-12 copy" style="background-color: #000;">
								<p>Copyright 2020 Creativa | All Rights Reserved</p>
							</div>
						</div>
					</div>

				</body>
				</html>';

				if (mail($to, $title, $message, $from)) {
					$case = 'send';
				} else {
					$case = 'failed';
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function validationToken($email, $token)
		{
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM t_reset WHERE email = :email AND token = :token AND status = 'Valid'");

			try {
				$query->execute([
					'email' => $email,
					'token' => $token
				]);

				$row = $query->fetch();
				if ($row['id_reset'] != "") {
					if ($row['token'] === $token && $row['email'] === $email) {
						$case = 'valid';
					}
				} else {
					$case = "invalid";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;	
			}
		}

		function password($email, $token, $password)
		{
			$case = "";
			$query = $this->db->connection()->prepare("UPDATE t_usuarios SET contrapass = :password WHERE correo = :email");

			try {
				switch ($this->validationToken($email, $token)) {
					case 'valid':
						$query->execute([
							'email' => $email,
							'password' => $password
						]);
						$case = "change";
						break;

					case 'invalid':
					default:
						$case = "invalid";
						break;
				}
				return $case;	
			} catch (PDOException $e) {
				return $case;
			}
		}
	}

?>