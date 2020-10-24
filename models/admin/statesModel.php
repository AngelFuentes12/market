<?php 

	require_once 'models/admin/state.php';
	/**
	 * @author: Angel Fuentes
	 */
	class StatesModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function getStates()
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM states");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new State();
					$item->id_state = $row['id_state'];
					$item->state = $row['state'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function register($state)
		{
			$case = "";
			$query = $this->db->connection()->prepare("INSERT INTO states (state) VALUES (:state)");
			$query_val = $this->db->connection()->prepare("SELECT * FROM states WHERE state = :state");

			try {
				$query_val->execute(['state' => $state]);

				$row = $query_val->fetch();
				if ($row['id_state'] > 0) {
					$case = "state";
				} else {
					$query->execute(['state' => $state]);
					$case = "success";
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function delete($id)
		{
			$query = $this->db->connection()->prepare("DELETE FROM states WHERE id_state = :id_state");

			try {
				$query->execute(['id_state' => $id]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function edit($id, $state)
		{
			$query = $this->db->connection()->prepare("UPDATE states SET state = :state WHERE id_state = :id_state");
			try {
				$query->execute([
					'id_state' => $id,
					'state' => $state
				]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function store($id)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT * FROM states WHERE id_state = :id_state");

			try {
				$query->execute(['id_state' => $id]);

				while ($row = $query->fetch()) {
					$item = new State();
					$item->id_state = $row['id_state'];
					$item->state = $row['state'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}
	}

?>