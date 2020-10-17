<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class AdminModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function logout()
		{
			$query = $this->db->connection()->prepare("UPDATE users SET sessions = sessions - 1 WHERE id_user = :id_user");

			try {
				$id = isset($_SESSION['admin']) ? $_SESSION['admin'] : $_SESSION['secretary'];

				$query->execute(['id_user' => $id]);
				
				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>