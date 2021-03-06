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
				if (isset($row['id_municipality']) && $row['id_municipality'] > 0) {
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

		function edit($id_state, $id_municipality, $municipality)
		{
			$query = $this->db->connection()->prepare("UPDATE municipalities SET municipality = :municipality WHERE id_municipality = :id_municipality");
			$query_val = $this->db->connection()->prepare("SELECT municipality FROM states NATURAL JOIN municipalities NATURAL JOIN states_municipalities WHERE states.id_state = :id_state AND municipality = :municipality");
			try {
				$query_val->execute([
					'id_state' => $id_state,
					'municipality' => $municipality
				]);

				$row = $query_val->fetch();

				if ($row['municipality'] == $municipality) {
					return false;
				} else {
					$query->execute([
						'id_municipality' => $id_municipality,
						'municipality' => $municipality
					]);

					return true;
				}

				//return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function store($id_municipality)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT states.id_state, municipalities.id_municipality, state, municipality FROM states NATURAL JOIN municipalities NATURAL JOIN states_municipalities WHERE municipalities.id_municipality = :id_municipality");

			try {
				$query->execute(['id_municipality' => $id_municipality]);

				while ($row = $query->fetch()) {
					$item = new Municipality();
					$item->id_state = $row['id_state'];
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

		function delete($id_municipality)
		{
			$query = $this->db->connection()->prepare("DELETE FROM municipalities WHERE id_municipality = :id_municipality");

			try {
				$query->execute(['id_municipality' => $id_municipality]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>