<?php 

	require_once 'models/admin/category.php';
	/**
	 * @author: Angel Fuentes
	 */
	class CategoriesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getCategories()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM categories");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Category();
					$item->id_category = $row['id_category'];
					$item->category = $row['category'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($category)
		{
			$case = "";
			$query = $this->db->connection()->prepare("INSERT INTO categories (category) VALUES (:category)");
			$query_val = $this->db->connection()->prepare("SELECT * FROM categories WHERE category = :category");

			try {
				$query_val->execute(['category' => $category]);

				$row = $query_val->fetch();
				if ($row['id_category'] > 0) {
					$case = "category";
				} else {
					$query->execute(['category' => $category]);
					$case = "success";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function edit($id_category, $category)
		{
			$query = $this->db->connection()->prepare("UPDATE categories SET category = :category WHERE id_category = :id_category");
			try {
				$query->execute([
					'id_category' => $id_category,
					'category' => $category
				]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function store($id_category)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM categories WHERE id_category = :id_category");

			try {
				$query->execute(['id_category' => $id_category]);

				while ($row = $query->fetch()) {
					$item = new Category();
					$item->id_category = $row['id_category'];
					$item->category = $row['category'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function delete($id_category)
		{
			$query = $this->db->connection()->prepare("DELETE FROM categories WHERE id_category = :id_category");

			try {
				$query->execute(['id_category' => $id_category]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>