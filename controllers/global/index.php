<?php

	/**
	* @author: Angel Fuentes
	*/
	class Index extends Controller
	{
		
		function __construct()
		{
			parent::__construct();
			//error_reporting(0);
		}

		function index()
		{
			$this->errors([]);
			$this->getSlider();
			$this->getCategories();
			$this->view->title = 'Bienvenido';
			$this->view->render('index');
		}

		function getSubcategoriesSpecific()
		{
			$id_category = isset($_POST['id_category']) ? $_POST['id_category'] : '';

			require_once 'models/admin/subcategoriesModel.php';
			$subcategory = new SubcategoriesModel();
			$subcategories = $subcategory->getSubcategoriesSpecific($id_category);

			$data = "";
			require_once 'models/admin/subcategory.php';
			foreach ($subcategories as $row) {
				$subcat = new Subcategory();
				$subcat = $row;
				$data .= '<li class="pl-5"><a href=subcategories/search?id='.$subcat->id_subcategory.'>'.$subcat->subcategory.'</a></li>';
			}
			echo $data;
		}

		function getSlider()
		{
			require_once 'models/admin/sliderModel.php';
			$slider = new SliderModel();
			$sliders = $slider->getSlider();
			$this->view->sliders = $sliders;
		}

		function getCategories()
		{
			require_once 'models/admin/categoriesModel.php';
			$category = new categoriesModel();
			$categories = $category->getCategories();
			$this->view->categories = $categories;
		}

		function errors($error)
		{
			$alert = isset($error['alert']) ? $error['alert'] : '';
			$message = isset($error['message']) ? $error['message'] : '';

			$this->view->error = [
				'alert' => $alert, 'message' => $message
			];
		}
	}

?>