<?php 

	require_once 'models/admin/admin.php';
	/**
	 * @author: Angel Fuentes
	 */
	class AdminsModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getAdmins()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM users WHERE level = 1");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Admin();
					$item->id_user = $row['id_user'];
					$item->name = $row['name'];
					$item->email = $row['email'];
					$item->password = $row['password'];
					$item->level = $row['level'];
					$item->status = $row['status'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function changeStatus($id, $status)
		{
			$case = "";
			$query = $this->db->connection()->prepare("UPDATE users SET status = :status WHERE id_user = :id_user");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id_user");

			try {
				$query_val->execute(['id_user' => $id]);

				$row = $query_val->fetch();

				if ($row['status'] == 2) {
					$case = "invalid";
				} else {
					if ($row['level'] == 1 && $row['status'] != $status) {
						$query->execute([
							'id_user' => $id,
							'status' => $status
						]);

						$case = "success";
					} else {
						$case = "invalid";
					}
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function delete($id)
		{
			$case = "";
			$query = $this->db->connection()->prepare("DELETE FROM users WHERE id_user = :id_user");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id_user");

			try {
				$query_val->execute(['id_user' => $id]);

				$row = $query_val->fetch();

				if ($row['level'] == 1) {
					$query->execute(['id_user' => $id]);

					$case = "success";
				} else {
					$case = "invalid";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function edit($id, $name)
		{
			$query = $this->db->connection()->prepare("UPDATE users SET name = :name WHERE id_user = :id_user");
			try {
				$query->execute([
					'id_user' => $id,
					'name' => $name
				]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function store($id)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id_user");

			try {
				$query->execute(['id_user' => $id]);

				$row = $query->fetch();

				if ($row['level'] == 1) {

					$item = new Admin();
					$item->id_user = $row['id_user'];
					$item->name = $row['name'];
					$item->email = $row['email'];
					$item->password = $row['password'];
					$item->level = $row['level'];
					$item->status = $row['status'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($name, $email, $password)
		{
			$case = "";

			$query = $this->db->connection()->prepare("INSERT INTO users (name, email, password, level, status, sessions) VALUES (:name, :email, :password, 1, 2, 0)");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE email = :email");
			$query_ver = $this->db->connection()->prepare("SELECT * FROM verifications WHERE email = :email AND status = 'valid'");
			$query_upd = $this->db->connection()->prepare("UPDATE verifications SET status = 'expired' WHERE id_verification = :id_verification ");
			$query_reg = $this->db->connection()->prepare("INSERT INTO verifications (email, token, create_at, status) VALUES(:email, :token, NOW(), 'valid')");
			$token = base64_encode(date("Y-m-d H:i:s"));

			try {
				$query_val->execute(['email' => $email]);

				$row = $query_val->fetch();

				if ($row['id_user' > 0]) {
					$case = "email";
				} else {
					$query->execute([
						'name' => $name,
						'email' => $email,
						'password' => base64_encode($password)
					]);

					$query_ver->execute(['email' => $email]);
						
					$row_ver = $query_ver->fetch();
					if ($row_ver['id_verification'] != "") {
						$query_upd->execute(['id_verification' => $row_ver['id_verification']]);

						$query_reg->execute([
							'email' => $email, 
							'token' => $token
						]);

						$case = "success";
					} else {
						$query_reg->execute([
							'email' => $email, 
							'token' => $token
						]);

						$case = "success";
					}
				}
				
				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function sendEmailVerification($email)
		{
			$case = "";
			$query = $this->db->connection()->prepare("SELECT * FROM verifications WHERE email = :email AND status = 'valid'");

			try {
				$query->execute(['email' => $email]);

				$row = $query->fetch();
				$token = $row['token'];
				$url = constant('URL') . 'auth/verification?email=' . $email . '&token=' . $token;

				$to = $email;
				$title = 'Verificación de cuenta';

				$message = '<!DOCTYPE html>
				<html lang="en">

				<head>
				    <!-- Required meta tags -->
				    <meta charset="utf-8">
				    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

				    <!-- Bootstrap CSS -->
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
				                    <h3>Hola, ' . $email . '</h3>
				                    <p class="text-email">Estas a punto de poder empezar a usar Shopping Market, ingresa al siguiente link para verificar tu cuenta. </p>
				                    <div class="acept">
				                        <center>
				                            <a href="' . $url . '">' . $url . '</a>
				                        </center>
				                    </div>
				                    <div class="cancel">
				                        <center>
				                            <p class="text-email">Si no realizaste esta acción, Ignora este email</p>
				                            <p class="copyright">Copyright © 2020 Creativa | All Rights Reserved.</p>
				                        </center>
				                    </div>

				                </div>
				            </div>
				        </div>
				    </section>
				</body>
				</html>';
				
				$from = 'MIME-Version: 1.0' . "\r\n";
				$from .= 'Content-type: text/html; charset=utf-8' . "\r\n";
				$from .= 'From: support@market.com';

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
			$query = $this->db->connection()->prepare("SELECT * FROM resets WHERE email = :email AND token = :token AND status = 'valid'");

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