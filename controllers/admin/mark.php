<?php 

	/**
	 * Autor: Angel Fuentes
	 */
	class Mark extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->view->url = "Registar marca";
			$this->view->render('admin/marks/register');
		}

		function show()
		{
			$this->errors([]);
			$this->getMarks();
		}

		function register()
		{
			$mark = isset($_POST['mark']) ? $_POST['mark'] : '';
			if ($mark == "") {
				$this->errors([]);
			} else {
				switch ($this->model->register($mark)) {
					case 'register':
						$this->errors([
							'alert' => 'alert-success', 'message' => 'Marca registrada exitosamente',
						]);
						break;

					case 'duplicate':
						$this->errors([
							'c1' => 'is-invalid', 'm1' => 'Esta marca ya fue registrada',
							'mark' => $mark
						]);
						break;

					default:
						$this->errors([
							'alert' => 'alert-danger', 'message' => 'Ocurrio un error, vuelva a intentarlo mas tarde'
						]);
						break;	
				}
			}

			$this->view->url = "Ver marcas";
			$this->view->render('admin/marks/register');
		}

		function store()
		{
			$id_mark = isset($_POST['id_mark']) ? preg_replace('/\s\s+/', ' ', trim($_POST['id_mark'])) : "";
			$mark = isset($_POST['mark']) ? preg_replace('/\s\s+/', ' ', trim($_POST['mark'])) : "";

			if ($id_mark != "" && $mark != "") {
				$this->errors([
					'id_mark' => $id_mark,'mark' => $mark
				]);
				$this->view->url = "Editar marca";
				$this->view->render('admin/marks/edit');
			} else {
				$this->errors([
					'alert' => 'alert-danger', 'message' => 'Ocurrio un error, vuelva a intentarlo mas tarde'
				]);
				$this->getMarks();
			}
		}

		function edit()
		{
			$mark = isset($_POST['mark']) ? $_POST['mark'] : '';
			$new_mark = isset($_POST['new_mark']) ? preg_replace('/\s\s+/', ' ', trim($_POST['new_mark'])) : '';
			$id_mark = isset($_POST['id_mark']) ? preg_replace('/\s\s+/', ' ', trim($_POST['id_mark'])) : '';

			if ($new_mark != "" && $id_mark != "") {
				switch ($this->model->edit($id_mark, $new_mark)) {
					case 'update':
						$this->errors([
							'alert' => 'alert-success', 'message' => 'Marca actualizada exitosamente',
						]);
						$this->getMarks();
						break;

					case 'duplicate':
						$this->errors([
							'c1' => 'is-invalid', 'm1' => 'Esta marca ya fue registrada',
							'id_mark' => $id_mark,'mark' => $mark, 'new_mark' => $new_mark
						]);
						$this->view->url = "Editar marca";
						$this->view->render('admin/marks/edit');
						break;
					
					default:
						$this->errors([
							'alert' => 'alert-danger', 'message' => 'Ocurrio un error, vuelva a intentarlo mas tarde',
							'id_mark' => $id_mark,'mark' => $mark, 'new_mark' => $new_mark
						]);
						$this->view->url = "Editar marca";
						$this->view->render('admin/marks/edit');
						break;
				}
			} else {
				$this->errors([
					'id_mark' => $id_mark,'mark' => $mark, 'new_mark' => $new_mark,
					'c1' => 'is-invalid', 'm1' => 'Ingresa una nueva marca'
				]);
				$this->view->url = "Editar marca";
				$this->view->render('admin/marks/edit');
			}
		}

		function delete()
		{
			$id_mark = isset($_POST['id_mark']) ? $_POST['id_mark'] : '';

			if ($id_mark != "") {
				if ($this->model->delete($id_mark)) {
					$this->errors([
						'alert' => 'alert-success', 'message' => 'Marca eliminada exitosamente',
					]);
				} else {
					$this->errors([
						'alert' => 'alert-danger', 'message' => 'Ocurrio un error, vuelva a intentarlo mas tarde',
					]);
				}
			} else {
				$this->errors([
					'alert' => 'alert-danger', 'message' => 'Ocurrio un error, vuelva a intentarlo mas tarde',
				]);
			}
			$this->getMarks();
		}

		function getMarks()
		{
			$marks = $this->model->getMarks();
			$this->view->marks = $marks;
			$this->view->url = "Ver marcas";
			$this->view->render('admin/marks/show');
		}

		function errors($error)
		{
			$c1 = isset($error['c1']) ? $error['c1'] : '';
			$m1 = isset($error['m1']) ? $error['m1'] : '';

			$id_mark = isset($error['id_mark']) ? $error['id_mark'] : '';
			$mark = isset($error['mark']) ? $error['mark'] : '';
			$new_mark = isset($error['new_mark']) ? $error['new_mark'] : '';

			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'c1' => $c1, 'm1' => $m1,

				'id_mark' => $id_mark,
				'mark' => $mark,
				'new_mark' => $new_mark,

				'alert' => $alert, 'message' => $message
			];
		}
	}

?>