<?php 

	require_once 'models/admin/municipality.php';
	/**
	 * @author: Angel Fuentes
	 */
	class MunicipalitiesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getMunicipalities()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT municipalities.id_municipality, state, municipality FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Municipality();
					$item->id_municipality = $row['id_municipality'];
					$item->state = $row['state'];
					$item->municipality = $row['municipality'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function getMunicipalitiesSpecific($id_state)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT municipalities.id_municipality, municipality FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities WHERE id_state = :id_state");

			try {
				$query->execute(['id_state' => $id_state]);

				while ($row = $query->fetch()) {
					$item = new Municipality();
					$item->id_municipality = $row['id_municipality'];
					$item->municipality = $row['municipality'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($id_state, $municipality)
		{
			$case = "";
			$query = $this->db->connection()->prepare("INSERT INTO municipalities (municipality) VALUES (:municipality)");
			$query_val = $this->db->connection()->prepare("SELECT municipalities.id_municipality, state, municipality FROM states NATURAL JOIN states_municipalities NATURAL JOIN municipalities WHERE id_state = :id_state AND municipality = :municipality");
			$query_max = $this->db->connection()->prepare("SELECT MAX(id_municipality) AS id_municipality FROM municipalities");
			$query_reg = $this->db->connection()->prepare("INSERT INTO states_municipalities  (id_state, id_municipality) VALUES (:id_state, :id_municipality)");

			try {
				$query_val->execute([
					'id_state' => $id_state,
					'municipality' => $municipality
				]);

				$row = $query_val->fetch();
				if ($row['id_municipality'] > 0) {
					$case = "municipality";
				} else {
					$query->execute(['municipality' => $municipality]);

					$query_max->execute();
					$row_max = $query_max->fetch();

					$query_reg->execute([
						'id_state' => $id_state,
						'id_municipality' => $row_max['id_municipality']
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
			$query = $this->db->connection()->prepare("DELETE FROM municipalities WHERE id_municipality = :id_municipality");

			try {
				$query->execute(['id_municipality' => $id]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>