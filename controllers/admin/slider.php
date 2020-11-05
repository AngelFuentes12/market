<?php 

	/**
	 * @author: Angel Fuentes
	 */
	class Slider extends Controller
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
			$this->getSlider();
		}

		function register()
		{
			$this->validation();

			$file = $_FILES['slider'];
			$image = "";
			$type = $file['type'];
			$url = $file['tmp_name'];
	        $folder = 'resources/images/slider/';
	        $src = "";

			if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif'){
	           $image = $file['name'];
	           $src = $folder.$image;
	        }

	        if ($image != '') {
	        	switch ($this->model->register($image)) {
	        		case 'register':
	        			move_uploaded_file($url, $src);
	        			$this->errors([
	        				'alert' => 'alert-success',
	        				'message' => 'Imagen registrada exitosamente'
	        			]);
	        			break;

	        		case 'duplicated':
	        			$this->errors([
	        				'alert' => 'alert-warning',
	        				'message' => 'Esta imagen ya fue registrada'
	        			]);
	        			break;
	        		
	        		default:
	        			$this->errorMessage();
	        			break;
	        	}
	        } else {
				$this->errors([
					'c1' => 'is-invalid',
					'm1' => 'Ingrese un formato de imagen valido'
				]);
	        }
			$this->getSlider();
		}

		function status()
		{
			$this->validation();

			$id_slider = isset($_GET['id']) ? $_GET['id'] : '';
			$status = isset($_GET['status']) ? $_GET['status'] : '';

			if (is_numeric($id_slider) && $id_slider > 0) {
				if ($status == 1 || $status == 2) {
					if ($this->model->changeStatus($id_slider, $status)) {
						$this->errors([
							'alert' => 'alert-success',
							'message' => 'Estatus cambiado exitosamente'
						]);
					} else {
						$this->errorMessage();
					}
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getSlider();	
		}

		function delete()
		{
			$this->validation();

			$id_slider = isset($_GET['id']) ? $_GET['id'] : '';

			if (is_numeric($id_slider) && $id_slider > 0) {
				if ($this->model->delete($id_slider)) {
					$this->errors([
						'alert' => 'alert-success',
						'message' => 'Imagen eliminada exitosamente'
					]);
				} else {
					$this->errorMessage();
				}
			} else {
				$this->errorMessage();
			}
			$this->getSlider();
		}

		function getSlider()
		{
			$sliders = $this->model->getSlider();
			$this->view->sliders = $sliders;
			$this->view->title = "Slider";
			$this->view->render('admin/slider/show');
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