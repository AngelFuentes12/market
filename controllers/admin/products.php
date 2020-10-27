<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Products extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->validation();

			$this->errors([]);
			$this->getCategories();
			$this->getVendors();
			$this->view->title = "Productos";
			$this->view->render('admin/products/show');
		}

		function register()
		{
			$id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
			$id_subcategory = isset($_POST['id_subcategory']) ? $_POST['id_subcategory'] : '';
			$id_vendor = isset($_POST['id_vendor']) ? $_POST['id_vendor'] : '';
			$product = isset($_POST['product']) ? preg_replace('/\s\s+/', ' ', trim($_POST['product'])) : '';
			$cost = isset($_POST['cost']) ? $_POST['cost'] : '';
			$description = isset($_POST['description']) ? preg_replace('/\s\s+/', ' ', trim($_POST['description'])) : '';
			$image = "";

			echo "$id_category  $id_subcategory $id_vendor $product $cost $description" ;
		}

		function validation()
		{
			require_once 'models/admin/validation.php';
			$validation = new Validation();
			if ($validation->validationSession() == false) {
				require_once 'models/admin/adminModel.php';
				$logout = new AdminModel();
				if ($logout->logout()) {
					session_unset();
					session_destroy();
					header("Location: " . constant('URL'));
				} else {
					$this->errorMessage();
					$this->view->title = "Bienvenido";
					$this->view->render('admin/index');
				}
			}
		}

		function getCategories()
		{
			require_once 'models/admin/categoriesModel.php';
			$category = new CategoriesModel();
			$categories = $category->getCategories();
			$this->view->categories = $categories;
		}

		function getVendors()
		{
			require_once 'models/admin/vendorsModel.php';
			$vendor = new VendorsModel();
			$vendors = $vendor->getVendors();
			$this->view->vendors = $vendors;
		}

		function errorMessage()
		{	
			$this->errors([
				'alert' => 'alert-danger',
				'message' => 'Ocurrió un error, vuelva a interntarlo más tarde'
			]);
		}

		function errors($error)
		{
			$c1 = isset($error['c1']) ? $error['c1'] : "";
			$m1 = isset($error['m1']) ? $error['m1'] : "";
			$c2 = isset($error['c2']) ? $error['c2'] : "";
			$m2 = isset($error['m2']) ? $error['m2'] : "";
			$c3 = isset($error['c3']) ? $error['c3'] : "";
			$m3 = isset($error['m3']) ? $error['m3'] : "";
			$c4 = isset($error['c4']) ? $error['c4'] : "";
			$m4 = isset($error['m4']) ? $error['m4'] : "";
			$c5 = isset($error['c5']) ? $error['c5'] : "";
			$m5 = isset($error['m5']) ? $error['m5'] : "";
			$c6 = isset($error['c6']) ? $error['c6'] : "";
			$m6 = isset($error['m6']) ? $error['m6'] : "";
			$c7 = isset($error['c7']) ? $error['c7'] : "";
			$m7 = isset($error['m7']) ? $error['m7'] : "";

			$product = isset($error['product']) ? $error['product'] : "";
			$cost = isset($error['cost']) ? $error['cost'] : "";
			$description = isset($error['description']) ? $error['description'] : "";

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'c3' => $c3, 'm3' => $m3,
				'c4' => $c4, 'm4' => $m4,
				'c5' => $c5, 'm5' => $m5,
				'c6' => $c6, 'm6' => $m6,
				'c7' => $c7, 'm7' => $m7,
				'product'  => $product,
				'cost'  => $cost,
				'description'  => $description,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>