<?php 

	require_once 'models/admin/postcode.php';
	/**
	 * @author: Angel Fuentes
	 */
	class PostcodesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getPostcodes()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT postcodes.id_postcode, state, municipality, colony, postcode FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies NATURAL JOIN colonies_postcodes NATURAL JOIN postcodes");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Postcode();
					$item->id_postcode = $row['id_postcode'];
					$item->state = $row['state'];
					$item->municipality = $row['municipality'];
					$item->colony = $row['colony'];
					$item->postcode = $row['postcode'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function getPostcodesSpecific($id_colony)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT postcodes.id_postcode, postcode FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies NATURAL JOIN colonies_postcodes NATURAL JOIN postcodes WHERE id_colony = :id_colony");

			try {
				$query->execute(['id_colony' => $id_colony]);

				while ($row = $query->fetch()) {
					$item = new Postcode();
					$item->id_postcode = $row['id_postcode'];
					$item->postcode = $row['postcode'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($id_state, $id_municipality, $id_colony, $postcode)
		{
			$case = "";
			$query = $this->db->connection()->prepare("INSERT INTO postcodes (postcode) VALUES (:postcode)");
			$query_val = $this->db->connection()->prepare("SELECT postcodes.id_postcode, state, municipality, colony, postcode FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies NATURAL JOIN colonies_postcodes NATURAL JOIN postcodes WHERE id_state = :id_state AND id_municipality = :id_municipality AND id_colony = :id_colony AND postcode = :postcode");
			$query_max = $this->db->connection()->prepare("SELECT MAX(id_postcode) AS id_postcode FROM postcodes");
			$query_reg = $this->db->connection()->prepare("INSERT INTO colonies_postcodes  (id_colony, id_postcode) VALUES (:id_colony, :id_postcode)");

			try {
				$query_val->execute([
					'id_state' => $id_state,
					'id_municipality' => $id_municipality,
					'id_colony' => $id_colony,
					'postcode' => $postcode,
				]);

				$row = $query_val->fetch();
				if ($row['id_postcode'] > 0) {
					$case = "postcode";
				} else {
					$query->execute(['postcode' => $postcode]);

					$query_max->execute();
					$row_max = $query_max->fetch();

					$query_reg->execute([
						'id_colony' => $id_colony,
						'id_postcode' => $row_max['id_postcode']
					]);

					$case = "success";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function delete($id)
		{
			$query = $this->db->connection()->prepare("DELETE FROM postcodes WHERE id_postcode = :id_postcode");

			try {
				$query->execute(['id_postcode' => $id]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>