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
			$query_reg = $this->db->connection()->prepare("INSERT INTO t_reset (email, token, create_at) VALUES(:email, :token, NOW())");
			$token = base64_encode(date("Y-m-d H:i:s"));

			try {
				$query->execute(['email' => $email]);

				$row = $query->fetch();
				if ($row['status'] != "") {
					if ($row['status'] == 1) {
						if ($row['correo'] === $email) {
							$query_reg->execute([
								'email' => $email,
								'token' => $token
							]);

							$case = "send";
						} else {
							$case = "email";
						}
					} else {
						$case = "";
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
			$query = $this->db->connection()->prepare("SELECT * FROM t_reset WHERE email = :email");

			try {
				$query->execute(['email' => $email]);

				$row = $query->fetch();
				$token = $row['token'];
				$url = constant('URL') . 'auth/email?email=' . $email . '&token=' . $token;

				$to = $email;
				$title = 'Solicitud de restablecimiento de contraseña';
				$from = 'MIME-Version: 1.0' . "\r\n";
				$from .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$from .= 'From: support@shoppingmarket.com';

				$message = '<!DOCTYPE html>
				<html lang="en">

				<head>
				    <meta charset="utf-8">
				    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

				    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
				        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

				    <title>Shopping Market</title>

				    <style type="text/css">
				        *{
				            margin: 0;
				            padding: 0;
				        }

				        #email{
				            border-top: 20px solid #3D465B;
				        }

				        #email h3{
				            text-align: center;
				            padding-bottom: 20px;
				        }

				        .text-email{
				            text-align: center;
				            font-size: 1.3rem;
				        }

				        .acept{
				            padding-bottom: 20px;
				        }
				        .cancel{
				            padding-top: 20px;
				            padding-bottom: 20px;
				            border-top: 1px solid #e2e0e0;
				        }

				        .copyright{
				            padding-top: 20px;
				            font-size: 12px;
				            text-align: center;
				            color: #c4c4c4;
				        }
				    </style>
				</head>

				<body>

				    <section id="email">
				        <div class="container p-5">
				            <div class="row justify-content-center">
				                <div class="col-12 col-md-8 form-color p-4 shadow-sm">
				                    <h3>Hola, '. $email .'</h3>
				                    <p class="text-email">Olvidaste tu contraseña, por favor ingresa al siguiente link y sigue los
				                        siguientes pasos. </p>
				                    <div class="acept">
				                        <center>
				                            <a href="'.$url.'">'. $url .'</a>
				                        </center>
				                    </div>
				                    <div class="cancel">
				                        <center>
				                            <p class="text-email">Si no realizaste esta acción, Ignora este correo</p>
				                            <p class="copyright">Copyright © 2020 Creativa | All Rights Reserved.</p>
				                        </center>
				                    </div>

				                </div>
				            </div>
				        </div>
				    </section>
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
			$query = $this->db->connection()->prepare("SELECT * FROM t_reset WHERE email = :email AND token = :token ORDER BY 1 DESC LIMIT 1");

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
	}

?>