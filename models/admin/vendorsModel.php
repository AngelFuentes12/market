<?php 

	require_once 'models/admin/vendor.php';
	/**
	 * @author: Angel Fuentes
	 */
	class VendorsModel extends Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		function register($vendor, $name, $email, $email2, $telephone, $telephone2, $id_state, $id_municipality, $id_colony, $id_postcode, $street, $inside, $outside)
		{
			$case = "";
			$query_ema = $this->db->connection()->prepare("SELECT * FROM vendors WHERE email1 = :email1");
			$query_tel = $this->db->connection()->prepare("SELECT * FROM vendors WHERE telephone1 = :telephone1");
			$query = $this->db->connection()->prepare("INSERT INTO vendors (vendor, name, email1, telephone1, email2, telephone2) VALUES (:vendor, :name, :email1, :telephone1, :email2, :telephone2)");
			$query_dir = $this->db->connection()->prepare("INSERT INTO direcctions (id_state, id_municipality, id_colony, id_postcode, street, outside, inside) VALUES (:id_state, :id_municipality, :id_colony, :id_postcode, :street, :outside, :inside)");
			$query_max = $this->db->connection()->prepare("SELECT id_vendor FROM vendors WHERE email1 = :email1");
			$query_max_dir = $this->db->connection()->prepare("SELECT MAX(id_direcction) AS id_direcction FROM direcctions");
			$query_ins = $this->db->connection()->prepare("INSERT INTO vendors_direcctions (id_vendor, id_direcction) VALUES (:id_vendor, :id_direcction)");
			try {
				$query_ema->execute(['email1' => $email]);

				$row_ema = $query_ema->fetch();

				if (isset($row_ema['id_vendor']) && $row_ema['id_vendor'] > 0) {
					$case = 'email';
				} else {
					$query_tel->execute(['telephone1' => $telephone]);

					$row_tel = $query_tel->fetch();

					if (isset($row_tel['id_vendor']) && $row_tel['id_vendor'] > 0) {
						$case = "telephone";
					} else {
						$query->execute([
							'vendor' => $vendor,
							'name' => $name,
							'email1' => $email,
							'telephone1' => $telephone,
							'email2' => $email2,
							'telephone2' => $telephone2
						]);

						$query_dir->execute([
							'id_state' => $id_state,
							'id_municipality' => $id_municipality,
							'id_colony' => $id_colony,
							'id_postcode' => $id_postcode,
							'street' => $street,
							'outside' => $outside,
							'inside' => $inside
						]);

						$query_max->execute(['email1' => $email]);
						$row_max = $query_max->fetch();

						$query_max_dir->execute();
						$row_max_dir = $query_max_dir->fetch();

						$query_ins->execute([
							'id_vendor' => $row_max['id_vendor'],
							'id_direcction' => $row_max_dir['id_direcction']
						]);

						$case = 'register';
					}
				}

				return $case;
			} catch (PDOException $e) {
				return $case;
			}
		}

		function getVendors()
		{
			$items = [];

			$query = $this->db->connection()->prepare("SELECT vendors.id_vendor, vendor, name, email1, email2, telephone1, telephone2, CONCAT('Calle ',street,' #',inside,' interior, #',outside,' exterior,',' Colonia ',colony,' cp. ',postcode,', Municipio ',municipality,', ',state) AS direcction FROM vendors NATURAL JOIN vendors_direcctions NATURAL JOIN direcctions NATURAL JOIN states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies NATURAL JOIN colonies_postcodes NATURAL JOIN postcodes");

			try {
				$query->execute();

				while ($row = $query->fetch()) {
					$item = new Vendor();
					$item->id_vendor = $row['id_vendor'];
					$item->vendor = $row['vendor'];
					$item->name = $row['name'];
					$item->email1 = $row['email1'];
					$item->email2 = $row['email2'];
					$item->telephone1 = $row['telephone1'];
					$item->telephone2 = $row['telephone2'];
					$item->direcction = $row['direcction'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function store($id_vendor)
		{
			$items = [];
			$query = $this->db->connection()->prepare("SELECT direcctions.id_direcction, vendors.id_vendor, vendor, name, email1, email2, telephone1, telephone2, state, municipality, colony, postcode, street, inside, outside FROM vendors NATURAL JOIN vendors_direcctions NATURAL JOIN direcctions NATURAL JOIN states NATURAL JOIN states_municipalities NATURAL JOIN municipalities NATURAL JOIN municipalities_colonies NATURAL JOIN colonies NATURAL JOIN colonies_postcodes NATURAL JOIN postcodes WHERE vendors.id_vendor = :id_vendor");

			try {
				$query->execute(['id_vendor' => $id_vendor]);

				while ($row = $query->fetch()) {
					$item = new Vendor();
					$item->id_vendor = $row['id_vendor'];
					$item->id_direcction = $row['id_direcction'];
					$item->vendor = $row['vendor'];
					$item->name = $row['name'];
					$item->email1 = $row['email1'];
					$item->email2 = $row['email2'];
					$item->telephone1 = $row['telephone1'];
					$item->telephone2 = $row['telephone2'];
					$item->state = $row['state'];
					$item->municipality = $row['municipality'];
					$item->colony = $row['colony'];
					$item->postcode = $row['postcode'];
					$item->street = $row['street'];
					$item->inside = $row['inside'];
					$item->outside = $row['outside'];

					array_push($items, $item);
				}

				return $items;
			} catch (PDOException $e) {
				return [];
			}
		}

		function edit($id_direcction, $id_vendor, $vendor, $name, $email2, $telephone2, $street, $inside, $outside)
		{
			$query = $this->db->connection()->prepare("UPDATE vendors SET vendor = :vendor, name = :name, email2 = :email2, telephone2 = telephone2 WHERE id_vendor = :id_vendor");
			$query_dir = $this->db->connection()->prepare("UPDATE direcctions SET street = :street, inside = :inside, outside = :outside WHERE id_direcction = :id_direcction");

			try {
				return true;
			} catch (PDOException $e) {
				return false;
			}
		}

		function delete($id_vendor)
		{
			$query = $this->db->connection()->prepare("DELETE FROM vendors WHERE id_vendor = :id_vendor");
			$query_dir = $this->db->connection()->prepare("SELECT id_direcction FROM vendors_direcctions WHERE id_vendor = :id_vendor");
			$query_del = $this->db->connection()->prepare("DELETE FROM direcctions WHERE id_direcction = :id_direcction");

			try {
				$query_dir->execute(['id_vendor' => $id_vendor]);
				$row_dir = $query_dir->fetch();

				$query_del->execute(['id_direcction' => $row_dir['id_direcction']]);

				$query->execute(['id_vendor' => $id_vendor]);

				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
	}

?>