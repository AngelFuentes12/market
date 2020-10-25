<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Subcategories  extends Controller
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
			$this->getSubcategories();
		}

		function register()
		{
			$this->validation();

			$id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
			$subcategory = isset($_POST['subcategory']) ? preg_replace('/\s\s+/', ' ', trim($_POST['subcategory'])) : '';

			if (is_numeric($id_category) && $id_category > 0 && $subcategory != '') {
				switch ($this->model->register($id_category, $subcategory)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Subcategoria registrada exitosamente'
						]);
						break;

					case 'subcategory':
						$this->errors([
							'c2' => 'is-invalid',
							'm2' => 'Esta subcategoria ya fue registrada',
							'subcategory' => $subcategory,
							'alert' => 'alert-info',
							'message' => 'Verifique su información'
						]);
						break;
					
					default:
						$this->errorMessage();
						break;
				}
			} else {
				$c1 = ""; $m1 = "";
				$c2 = ""; $m2 = "";

				if (!is_numeric($id_category)) {
					$c1 = "is-invalid";
					$m1 = "Seleccione una categoria";
				}

				if ($subcategory == "") {
					$c2 = "is-invalid";
					$m2 = "Ingrese un subcategoria";
				}
				
				$this->errors([
					'c1' => $c1,
					'm1' => $m1,
					'c2' => $c2,
					'm2' => $m2,
					'subcategory' => $subcategory,
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getSubcategories();
		}

		function edit()
		{
			$this->validation();

			$id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';
			$id_subcategory = isset($_POST['id_subcategory']) ? $_POST['id_subcategory'] : '';
			$category = isset($_POST['category']) ? preg_replace('/\s\s+/', ' ', trim($_POST['category'])) : '';
			$subcategory = isset($_POST['subcategory']) ? preg_replace('/\s\s+/', ' ', trim($_POST['subcategory'])) : '';

			if (is_numeric($id_category) && $id_category > 0 && is_numeric($id_subcategory) && $id_subcategory > 0 && $subcategory != "") {
				if ($this->model->edit($id_category, $id_subcategory, $subcategory)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'La subcategoria ' . $subcategory . ' ya fue registrada en la categoria ' . $category
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getSubcategories();
		}

		function store()
		{
			$this->validation();

			$id_subcategory = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_subcategory) && $id_subcategory > 0) {
				$subcategory = $this->model->store($id_subcategory);

				if (sizeof($subcategory) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar subcategoria";
					$this->view->subcategories = $subcategory;
					$this->view->render('admin/subcategories/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getStates();
		}

		function delete()
		{
			$id_subcategory = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_subcategory) && $id_subcategory > 0) {
				if ($this->model->delete($id_subcategory)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Subcategoria eliminada exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getSubcategories();
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

		function getSubcategories()
		{
			require_once 'models/admin/categoriesModel.php';
			$category = new CategoriesModel();
			$categorys = $category->getCategories();
			$this->view->categorys = $categorys;

			$this->view->title = "Subcategorias";
			$subcategories = $this->model->getSubcategories();
			$this->view->subcategories = $subcategories;
			$this->view->render('admin/subcategories/show');
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
			$c1 = isset($error['c1']) ? $error['c1'] : '';
			$m1 = isset($error['m1']) ? $error['m1'] : '';
			$c2 = isset($error['c2']) ? $error['c2'] : '';
			$m2 = isset($error['m2']) ? $error['m2'] : '';

			$subcategory = isset($error['subcategory']) ? $error['subcategory'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'c2' => $c2, 'm2' => $m2,
				'subcategory' => $subcategory,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>