<?php 

	require_once 'models/admin/colony.php';
	/**
	 * @author: Angel Fuentes
	 */
	class ColoniesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getColonies()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT colonies.id_colony, state, municipality, colony FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Colony();
					$item->id_colony = $row['id_colony'];
					$item->state = $row['state'];
					$item->municipality = $row['municipality'];
					$item->colony = $row['colony'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function getColoniesSpecific($id_municipality)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT colonies.id_colony, state, municipality, colony FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies WHERE id_municipality = :id_municipality");

			try {
				$query->execute(['id_municipality' => $id_municipality]);

				while ($row = $query->fetch()) {
					$item = new Colony();
					$item->id_colony = $row['id_colony'];
					$item->state = $row['state'];
					$item->municipality = $row['municipality'];
					$item->colony = $row['colony'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($id_state, $id_municipality, $colony)
		{
			$case = "";
			$query = $this->db->connection()->prepare("INSERT INTO colonies (colony) VALUES (:colony)");
			$query_val = $this->db->connection()->prepare("SELECT colonies.id_colony, state, colony, colony FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies WHERE id_state = :id_state AND id_municipality = :id_municipality AND colony = :colony");
			$query_max = $this->db->connection()->prepare("SELECT MAX(id_colony) AS id_colony FROM colonies");
			$query_reg = $this->db->connection()->prepare("INSERT INTO municipalities_colonies  (id_municipality, id_colony) VALUES (:id_municipality, :id_colony)");

			try {
				$query_val->execute([
					'id_state' => $id_state,
					'id_municipality' => $id_municipality,
					'colony' => $colony
				]);

				$row = $query_val->fetch();
				if ($row['id_colony'] > 0) {
					$case = "colony";
				} else {
					$query->execute(['colony' => $colony]);

					$query_max->execute();
					$row_max = $query_max->fetch();

					$query_reg->execute([
						'id_municipality' => $id_municipality,
						'id_colony' => $row_max['id_colony']
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
			$query = $this->db->connection()->prepare("DELETE FROM colonies WHERE id_colony = :id_colony");

			try {
				$query->execute(['id_colony' => $id]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>