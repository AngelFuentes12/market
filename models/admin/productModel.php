<?php

	require_once 'models/admin/marks.php';
	/**
	 * Autor: Angel Fuentes
	 */
	class ProductModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
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

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];	
			}
		}
	}

?>