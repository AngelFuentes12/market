<?php 

	require_once 'models/admin/product.php';
	/**
	 * @author: Angel Fuentes
	 */
	class ProductsModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function register($id_category, $id_subcategory, $id_vendor, $product, $cost, $description, $image)
		{
			$case = "";

			$query = $this->db->connection()->prepare("INSERT INTO products (product, cost, description) VALUES (:product, :cost, :description)");
			$query_val = $this->db->connection()->prepare("SELECT * FROM products WHERE product = :product");
			$query_img = $this->db->connection()->prepare("INSERT INTO images (image, type, status) VALUES (:image, 'product', 1)");
			$query_max_img = $this->db->connection()->prepare("SELECT MAX(id_image) AS id_image FROM images");
			$query_cat = $this->db->connection()->prepare("SELECT id_category_subcategory FROM categories_subcategories WHERE id_category = :id_category AND id_subcategory = :id_subcategory");
			$query_pro = $this->db->connection()->prepare("SELECT id_product FROM products WHERE product = :product");
			$query_ins_pro = $this->db->connection()->prepare("INSERT INTO products_categories_subcategories (id_product, id_category_subcategory, id_image) VALUES (:id_product, :id_category_subcategory, :id_image)");
			$query_ven = $this->db->connection()->prepare("INSERT INTO vendors_products (id_vendor, id_product) VALUES (:id_vendor, :id_product)");

			try {
				$query_val->execute(['product' => $product]);
				$row_val = $query_val->fetch();

				if (isset($row_val['id_product']) && $row_val['id_product'] > 0) {
					$case = "product";
				} else {
					$query->execute([
						'product' => $product,
						'cost' => $cost,
						'description' => $description
					]);

					$query_img->execute(['image' => $image]);

					$query_max_img->execute();
					$row_img = $query_max_img->fetch();

					$query_cat->execute([
						'id_category' => $id_category,
						'id_subcategory' => $id_subcategory
					]);
					$row_cat = $query_cat->fetch();

					$query_pro->execute(['product' => $product]);
					$row_pro = $query_pro->fetch();

					$query_ins_pro->execute([
						'id_product' => $row_pro['id_product'],
						'id_category_subcategory' => $row_cat['id_category_subcategory'],
						'id_image' => $row_img['id_image']
					]);

					$query_ven->execute([
						'id_vendor' => $id_vendor,
						'id_product' => $row_pro['id_product']
					]);

					$case = "register";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function delete($id_product)
		{
			$query = $this->db->connection()->prepare("DELETE FROM products WHERE id_product = :id_product");
			$query_img = $this->db->connection()->prepare("SELECT images.id_image, image FROM products_categories_subcategories NATURAL JOIN images WHERE id_product = :id_product");
			$query_del = $this->db->connection()->prepare("DELETE FROM images WHERE id_image = :id_image"); 

			try {
				$query_img->execute(['id_product' => $id_product]);
				$row_img = $query_img->fetch();
				
				$query_del->execute(['id_image' => $row_img['id_image']]);

				$query->execute(['id_product' => $id_product]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function getProducts()
		{
			$items = [];

			$query = $this->db->connection()->prepare("SELECT products.id_product, subcategory, vendor, name, email1, product, description, cost, image FROM products NATURAL JOIN vendors_products NATURAL JOIN vendors NATURAL JOIN products_categories_subcategories NATURAL JOIN images NATURAL JOIN categories NATURAL JOIN categories_subcategories NATURAL JOIN subcategories");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Product();
					$item->id_product = $row['id_product'];
					$item->subcategory = $row['subcategory'];
					$item->vendor = $row['vendor'];
					$item->name = $row['name'];
					$item->product = $row['product'];
					$item->email1 = $row['email1'];
					$item->description = $row['description'];
					$item->cost = $row['cost'];
					$item->image = $row['image'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}
	}

?>