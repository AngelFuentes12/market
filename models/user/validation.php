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
				$query->execute(['id_user' => $_SESSION['user']]);

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