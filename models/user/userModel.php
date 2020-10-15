<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class UserModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function logout()
		{
			$query = $this->db->connection()->prepare("UPDATE users SET sessions = sessions - 1 WHERE id_user = :id_user");

			try {
				$query->execute(['id_user' => $_SESSION['user']]);
				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>