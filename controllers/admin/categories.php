<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Categories extends Controller
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
		}

		function register()
		{
			$this->validation();

			$category = isset($_POST['category']) ? preg_replace('/\s\s+/', ' ', trim($_POST['category'])) : '';

			if ($category != '') {
				switch ($this->model->register($category)) {
					case 'success':
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Categoría registrada exitosamente'
						]);
						break;

					case 'category':
						$this->errors([
							'c1' => 'is-invalid',
							'm1' => 'Esta categoría ya fue registrada',
							'category' => $category,
							'alert' => 'alert-info',
							'message' => 'Verifique su información'
						]);
						break;
					
					default:
						$this->errorMessage();
						break;
				}
			} else {
				$this->errors([
					'c1' => 'is-invalid',
					'm1' => 'Ingrese una categoría',
					'alert' => 'alert-info',
					'message' => 'Verifique su información'
				]);
			}
			$this->getCategories();
		}

		function edit()
		{
			$this->validation();

			$id_category = isset($_POST['id']) ? $_POST['id'] : '';
			$category = isset($_POST['category']) ? preg_replace('/\s\s+/', ' ', trim($_POST['category'])) : '';

			if (is_numeric($id_category) && $id_category > 0 && $category != "") {
				if ($this->model->edit($id_category, $category)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Informacion actualizada exitosamente'
					]);
				} else {
					$this->errors([
						'alert' => 'alert-warning',
						'message' => 'La categoria ' . $category . ' ya fue registrada'
					]);
				}
			} else {
				$this->errorMessage();
			}
			$this->getCategories();
		}

		function store()
		{
			$this->validation();

			$id_category = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_category) && $id_category > 0) {
				$category = $this->model->store($id_category);

				if (sizeof($category) == 0) {
					$this->errorMessage();
				} else {
					$this->errors([]);
					$this->view->title = "Editar categoria";
					$this->view->categories = $category;
					$this->view->render('admin/categories/edit');
					return false;
				}
			} else {
				$this->errorMessage();
			}
			$this->getCategories();
		}

		function delete()
		{
			$id_category = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_category) && $id_category > 0) {
				if ($this->model->delete($id_category)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Categoría eliminada exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getCategories();
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
			$this->view->title = "Categorías";
			$categories = $this->model->getCategories();
			$this->view->categories = $categories;
			$this->view->render('admin/categories/show');
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

			$category = isset($error['category']) ? $error['category'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,
				'category' => $category,
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>