<?php 

	require_once 'models/admin/marks.php';
	/**
	 * Autor: Angel Fuentes
	 */
	class MarkModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function register($mark)
		{
			$case = "";
			$query_val = $this->db->connection()->prepare("SELECT COUNT(*) AS val FROM marks WHERE name = :mark");
			$query = $this->db->connection()->prepare("INSERT INTO marks (name, create_at, update_at) VALUES (:mark, NOW(), NOW())");

			try {

				$query_val->execute([
					'mark' => $mark
				]);

				$row = $query_val->fetch();
				if ($row['val'] > 0) {
					$case = "duplicate";
				} else {
					$query->execute([
						'mark' => $mark
					]);

					$case = "register";
				}

				return $case;
			} catch (PDOException $e) {
				return "";
			}
		}

		function edit($id_mark, $new_mark)
		{
			$case = "";
			$query_val = $this->db->connection()->prepare("SELECT COUNT(*) FROM marks WHERE name = :new_mark");
			$query = $this->db->connection()->prepare("UPDATE marks SET name = :new_mark, update_at = NOW() WHERE id_mark = :id_mark");
			
			try {
				$query_val->execute([
					'new_mark' => $new_mark
				]);
				
				$row = $query_val->fetch();
				if ($row['val'] > 0) {
					$case = "duplicate";
				} else {
					$query->execute([
						'id_mark' => $id_mark,
						'new_mark' => $new_mark
					]);

					$case = "update";
				}

				return $case;
			} catch (PDOException $e) {
				return "";
			}
		}

		function delete($id_mark)
		{
			$query = $this->db->connection()->prepare("DELETE FROM marks WHERE id_mark = :id_mark");

			try {
				$query->execute([
					'id_mark' => $id_mark
				]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function getMarks()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM marks");
			try {
				$query->execute();
				while ($row = $query->fetch()) {
					$item = new Marks();
					$item->id_mark = $row['id_mark'];
					$item->name = $row['name'];
					$item->create_at = $row['create_at'];
					$item->update_at = $row['update_at'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];	
			}
		}
	}

?>