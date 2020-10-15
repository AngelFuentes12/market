<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Validation extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function validationSession()
		{
			$query = $this->db->connection()->prepare("SELECT * FROM users WHERE id_user = :id_user");

			try {
				$id = isset($_SESSION['admin']) ? $_SESSION['admin'] : $_SESSION['secretary'];
				$query->execute(['id_user' => $id]);

				$row = $query->fetch();

				if ($row['status'] != "") {
					if ($row['status'] == 1) {
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>