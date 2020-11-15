<?php 

	require_once 'models/admin/store.php';
	/**
	 * @author: Angel Fuentes
	 */
	class StoresModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getStore()
		{
			$items = [];

			$query = $this->db->connection()->prepare("SELECT products.id_product, store.id_store, subcategory, product, cost, image, amount, date_entry FROM products NATURAL JOIN products_categories_subcategories NATURAL JOIN images NATURAL JOIN categories NATURAL JOIN categories_subcategories NATURAL JOIN subcategories NATURAL JOIN store");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Store();
					$item->id_product = $row['id_product'];
					$item->id_store = $row['id_store'];
					$item->subcategory = $row['subcategory'];
					$item->product = $row['product'];
					$item->cost = $row['cost'];
					$item->image = $row['image'];
					$item->amount = $row['amount'];
					$item->date_entry = $row['date_entry'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return $items;
			}
		}

		
	}

?>