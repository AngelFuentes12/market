<?php 

	require_once 'models/admin/user.php';
	/**
	 * @author: Angel Fuentes
	 */
	class UsersModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getUsers()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT users.id_user, rfc, name, email, status FROM users NATURAL JOIN users_clients NATURAL JOIN clients");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new User();
					$item->id_user = $row['id_user'];
					$item->rfc = $row['rfc'];
					$item->name = $row['name'];
					$item->email = $row['email'];
					$item->status = $row['status'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function changeStatus($id_user, $status)
		{
			$case = "";
			$query = $this->db->connection()->prepare("UPDATE users SET status = :status WHERE id_user = :id_user");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id_user");

			try {
				$query_val->execute(['id_user' => $id_user]);

				$row = $query_val->fetch();

				if ($row['status'] == 2) {
					$case = "invalid";
				} else {
					if ($row['level'] == 3 && $row['status'] != $status) {
						$query->execute([
							'id_user' => $id_user,
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
	}

?>