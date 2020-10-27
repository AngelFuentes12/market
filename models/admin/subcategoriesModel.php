<?php 

	require_once 'models/admin/subcategory.php';
	/**
	 * @author: Angel Fuentes
	 */
	class SubcategoriesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getSubcategories()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT subcategories.id_subcategory, category, subcategory FROM categories NATURAL JOIN categories_subcategories NATURAL JOIN subcategories");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Subcategory();
					$item->id_subcategory = $row['id_subcategory'];
					$item->category = $row['category'];
					$item->subcategory = $row['subcategory'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function getSubcategoriesSpecific($id_category)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT subcategories.id_subcategory, subcategory FROM categories NATURAL JOIN categories_subcategories NATURAL JOIN subcategories WHERE id_category = :id_category");

			try {
				$query->execute(['id_category' => $id_category]);

				while ($row = $query->fetch()) {
					$item = new Subcategory();
					$item->id_subcategory = $row['id_subcategory'];
					$item->subcategory = $row['subcategory'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($id_category, $subcategory)
		{
			$case = "";

			$query_val = $this->db->connection()->prepare("SELECT * FROM subcategories WHERE subcategory = :subcategory");
			$query = $this->db->connection()->prepare("INSERT INTO subcategories (subcategory) VALUES (:subcategory)");
			$query_ver = $this->db->connection()->prepare("SELECT subcategories.id_subcategory FROM categories NATURAL JOIN categories_subcategories NATURAL JOIN subcategories WHERE categories.id_category = :id_category AND subcategory = :subcategory");
			$query_max = $this->db->connection()->prepare("SELECT MAX(id_subcategory) AS id_subcategory FROM subcategories");
			$query_ins = $this->db->connection()->prepare("INSERT INTO categories_subcategories (id_category, id_subcategory) VALUES(:id_category, :id_subcategory)");
			$query_id = $this->db->connection()->prepare("SELECT id_subcategory FROM subcategories WHERE subcategory = :subcategory");

			try {
				$query_val->execute(['subcategory' => $subcategory]);

				$row_val = $query_val->fetch();
				if (isset($row_val['id_subcategory']) && $row_val['id_subcategory'] > 0) {
					$query_ver->execute([
						'id_category' => $id_category,
						'subcategory' => $subcategory
					]);

					$row_ver = $query_ver->fetch();

					if (isset($row_ver['id_subcategory']) && $row_ver['id_subcategory'] > 0) {
						$case = "subcategory";
					} else {
						$query_id->execute(['subcategory' => $subcategory]);
						$row_id = $query_id->fetch();
						$query_ins->execute([
							'id_category' => $id_category,
							'id_subcategory' => $row_id['id_subcategory']
						]);
						$case = "success";
					}
				} else {
					$query->execute(['subcategory' => $subcategory]);

					$query_ver->execute([
						'id_category' => $id_category,
						'subcategory' => $subcategory
					]);

					$row_ver = $query_ver->fetch();

					if (isset($row_val['id_subcategory']) &&$row_ver['id_subcategory'] > 0) {
						$case = "subcategory";
					} else {
						$query_max->execute();
						$row_max = $query_max->fetch();
						$query_ins->execute([
							'id_category' => $id_category,
							'id_subcategory' => $row_max['id_subcategory']
						]);
						$case = "success";
					}
				}
				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function edit($id_category, $id_subcategory, $subcategory)
		{
			$query = $this->db->connection()->prepare("UPDATE subcategories SET subcategory = :subcategory WHERE id_subcategory = :id_subcategory");
			$query_val = $this->db->connection()->prepare("SELECT subcategory FROM categories NATURAL JOIN subcategories NATURAL JOIN categories_subcategories WHERE categories.id_category = :id_category AND subcategory = :subcategory");
			try {
				$query_val->execute([
					'id_category' => $id_category,
					'subcategory' => $subcategory
				]);

				$row = $query_val->fetch();

				if ($row['subcategory'] == $subcategory) {
					return false;
				} else {
					$query->execute([
						'id_subcategory' => $id_subcategory,
						'subcategory' => $subcategory
					]);

					return true;
				}

				//return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function store($id_subcategory)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT categories.id_category, subcategories.id_subcategory, category, subcategory FROM categories NATURAL JOIN subcategories NATURAL JOIN categories_subcategories WHERE subcategories.id_subcategory = :id_subcategory");

			try {
				$query->execute(['id_subcategory' => $id_subcategory]);

				while ($row = $query->fetch()) {
					$item = new Subcategory();
					$item->id_category = $row['id_category'];
					$item->id_subcategory = $row['id_subcategory'];
					$item->category = $row['category'];
					$item->subcategory = $row['subcategory'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function delete($id_subcategory)
		{
			$query = $this->db->connection()->prepare("DELETE FROM subcategories WHERE id_subcategory = :id_subcategory");

			try {
				$query->execute(['id_subcategory' => $id_subcategory]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>