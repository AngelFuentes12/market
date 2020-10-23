<?php 

	require_once 'models/admin/vendor.php';
	/**
	 * @author: Angel Fuentes
	 */
	class VendorsModel extends Model
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
	}

?>