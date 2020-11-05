<?php 

	require_once 'models/admin/sliders.php';
	/**
	 * @author: Angel Fuentes
	 */
	class SliderModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function register($image)
		{
			$case = "";

			$query = $this->db->connection()->prepare("INSERT INTO images (image, type, status) VALUES (:image, 'slider', 1)");
			$query_val = $this->db->connection()->prepare("SELECT * FROM images WHERE image = :image");

			try {
				$query_val->execute(['image' => $image]);
				$row_val = $query_val->fetch();

				if (isset($row_val['id_image']) && $row_val['id_image'] > 0) {
					$case = 'duplicated';
				} else {
					$query->execute(['image' => $image]);
					$case = 'register';
				}
				
				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function changeStatus($id_image, $status)
		{
			$query = $this->db->connection()->prepare("UPDATE images SET status = :status WHERE id_image = :id_image");

			try {
				$query->execute([
					'id_image' => $id_image,
					'status' => $status
				]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function delete($id_image)
		{
			$query = $this->db->connection()->prepare("DELETE FROM images WHERE id_image = :id_image");

			try {
				$query->execute(['id_image' => $id_image]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function getSlider()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM images WHERE type = 'slider'");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Sliders();
					$item->id_image = $row['id_image'];
					$item->image = $row['image'];
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