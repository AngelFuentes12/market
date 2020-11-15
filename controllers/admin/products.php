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
			$this->getProducts();
		}

		function register()
		{
			$id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
			$id_subcategory = isset($_POST['id_subcategory']) ? $_POST['id_subcategory'] : '';
			$id_vendor = isset($_POST['id_vendor']) ? $_POST['id_vendor'] : '';
			$product = isset($_POST['product']) ? preg_replace('/\s\s+/', ' ', trim($_POST['product'])) : '';
			$cost = isset($_POST['cost']) ? $_POST['cost'] : '';
			$amount = isset($_POST['amount']) ? $_POST['amount'] : '';
			$description = isset($_POST['description']) ? preg_replace('/\s\s+/', ' ', trim($_POST['description'])) : '';

			$file = $_FILES['image'];
			$image = "";
			$type = $file['type'];
			$url = $file['tmp_name'];
	        $folder = 'resources/images/products/';
	        $src = "";

			if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
	           $image = $file['name'];
	           $src = $folder.$image;
	        }

	        if (is_numeric($id_category) && $id_category > 0 && is_numeric($id_subcategory) && $id_subcategory > 0 && is_numeric($id_vendor) && $id_vendor > 0 && $product != '' && is_numeric($cost) && $cost > 0 && is_numeric($amount) && $amount >= 0 && $description != '' && $image != '') {
	        	switch ($this->model->register($id_category, $id_subcategory, $id_vendor, $product, $cost, $amount, $description, $image)) {
	        		case 'register':
	        			move_uploaded_file($url, $src);
        				$this->errors([
        					'alert' => 'alert-success',
        					'message' => 'Producto registrado exitosamente'
        				]);
	        			break;

	        		case 'product':
	        			$this->errors([
	        				'c4' => 'is-invalid',
	        				'm4' => 'Este producto ya fue registrado',

	        				'product' => $product,
	        				'cost' => $cost,
	        				'amount' => $amount,
	        				'description' => $description,

        					'alert' => 'alert-info',
        					'message' => 'Verifique su información'
        				]);
	        			break;

	        		case '':
	        		default:
	        			$this->errorMessage();
	        			break;
	        	}
	        } else {
	        	$c1 = ""; $m1 = "";
	        	$c2 = ""; $m2 = "";
	        	$c3 = ""; $m3 = "";
	        	$c4 = ""; $m4 = "";
	        	$c5 = ""; $m5 = "";
	        	$c6 = ""; $m6 = "";
	        	$c7 = ""; $m7 = "";
	        	$c8 = ""; $m8 = "";

	        	if (!is_numeric($id_category)) {
	        		$c1 = "is-invalid";
	        		$m1 = "Seleccione una categoria";
	        	}

	        	if (!is_numeric($id_subcategory)) {
	        		$c2 = "is-invalid";
	        		$m2 = "Seleccione una subcategoria";
	        	}

	        	if (!is_numeric($id_vendor)) {
	        		$c3 = "is-invalid";
	        		$m3 = "Seleccione un proveedor";
	        	}

	        	if ($product == "") {
	        		$c4 = "is-invalid";
	        		$m4 = "Ingrese un producto";
	        	}

	        	if ($cost == "") {
	        		$c5 = "is-invalid";
	        		$m5 = "Ingrese un costo";
	        	}

	        	if ($description == "") {
	        		$c6 = "is-invalid";
	        		$m6 = "Ingrese una descripcion";
	        	}

	        	if ($image == "") {
	        		$c7 = "is-invalid";
	        		$m7 = "Seleccione un formato de imagen valido";
	        	}

	        	if ($amount == "") {
	        		$c8 = "is-invalid";
	        		$m8 = "Ingrese una existencia";
	        	}

	        	$this->errors([
	        		'c1' => $c1, 'm1' => $m1,
	        		'c2' => $c2, 'm2' => $m2,
	        		'c3' => $c3, 'm3' => $m3,
	        		'c4' => $c4, 'm4' => $m4,
	        		'c5' => $c5, 'm5' => $m5,
	        		'c6' => $c6, 'm6' => $m6,
	        		'c7' => $c7, 'm7' => $m7,
	        		'c8' => $c8, 'm8' => $m8,

	        		'product' => $product,
	        		'cost' => $cost,
	        		'amount' => $amount,
	        		'description' => $description,

	        		'alert' => 'alert-info',
	        		'message' => 'Verifique su información'

	        	]);
	        }

	        $this->getProducts();
		}

		function edit()
		{
			$this->validation();

			$id_product = isset($_POST['id_product']) ? $_POST['id_product'] : '';
			$id_vendor = isset($_POST['id_vendor']) ? $_POST['id_vendor'] : '';
			$cost = isset($_POST['cost']) ? $_POST['cost'] : '';
			$product = isset($_POST['product']) ? preg_replace('/\s\s+/', ' ', trim($_POST['product'])) : '';
			$description = isset($_POST['description']) ? preg_replace('/\s\s+/', ' ', trim($_POST['description'])) : '';
			$old_image = isset($_POST['image']) ? $_POST['image'] : '';

			$file = $_FILES['image'];
			$image = "";
			$type = $file['type'];
			$url = $file['tmp_name'];
	        $folder = 'resources/images/products/';
	        $src = "";

	        if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
	        	if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
		           $image = $file['name'];
		           $src = $folder.$image;
		        }
	        } else {
	        	$image = $old_image;
	        }

			if (is_numeric($id_product) && $id_product > 0 && is_numeric($id_vendor) && $id_vendor > 0 && $product != "" && is_numeric($cost) && $cost > 0 && $description != "" && $image != "") {
				if ($this->model->edit($id_product, $id_vendor, $product, $cost, $description, $image)) {
					if ($image != $old_image) {
						move_uploaded_file($url, $src);
					}
					
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'El producto ' . $product . ' ya fue registrado'
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getProducts();
		}

		function store()
		{
			$this->validation();

			$id_product = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_product) && $id_product > 0) {
				$product = $this->model->store($id_product);

				if (sizeof($product) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->getVendors();
					$this->view->title = "Editar producto";
					$this->view->products = $product;
					$this->view->render('admin/products/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getProducts();
		}

		function delete()
		{
			$id_product = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_product) && $id_product > 0) {
				if ($this->model->delete($id_product)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Producto eliminado exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getProducts();
			$this->model->delete($id_product);
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

		function getProducts()
		{
			$this->getCategories();
			$this->getVendors();

			$products = $this->model->getProducts();
			$this->view->products = $products;
			$this->view->title = "Productos";
			$this->view->render('admin/products/show');
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
			$c8 = isset($error['c8']) ? $error['c8'] : "";
			$m8 = isset($error['m8']) ? $error['m8'] : "";

			$product = isset($error['product']) ? $error['product'] : "";
			$cost = isset($error['cost']) ? $error['cost'] : "";
			$amount = isset($error['amount']) ? $error['amount'] : "";
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
				'c8' => $c8, 'm8' => $m8,
				'product' => $product,
				'cost' => $cost,
				'amount' => $amount,
				'description' => $description,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>