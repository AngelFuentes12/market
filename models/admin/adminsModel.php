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
			$query = $this->db->connection()->prepare("UPDATE users SET status = :status WHERE id_user = :id");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id");

			try {
				$query_val->execute(['id' => $id]);

				$row = $query_val->fetch();

				if ($row['status'] == 2) {
					$case = "invalid";
				} else {
					if ($row['level'] == 1 && $row['status'] != $status) {
						$query->execute([
							'id' => $id,
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
			$query = $this->db->connection()->prepare("DELETE FROM users WHERE id_user = :id");
			$query_val = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id");

			try {
				$query_val->execute(['id' => $id]);

				$row = $query_val->fetch();

				if ($row['level'] == 1) {
					$query->execute(['id' => $id]);

					$case = "success";
				} else {
					$case = "invalid";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function edit($id)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id");

			try {
				$query->execute(['id' => $id]);

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
	}

?>