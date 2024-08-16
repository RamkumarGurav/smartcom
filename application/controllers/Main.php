<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		//models
		$this->load->model('Common_model');
		$this->load->model('User_model');

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->data['active_left_menu'] = '';

		$this->data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);




	}


	public function get_header($pageName, $data)
	{
		$this->data = $data;
		if (empty($this->data['js'])) {
			$this->data['js'] = array();
		}


		$category_data = $this->User_model->get_category_data([
			"order_by" => "name ASC",
			"is_display" => 1,
			"record_status" => 1
		]);
		$this->data['category_data'] = $category_data;

		// echo "<pre> <br>";
		// print_r($this->data['category_data']);
		// exit;
		// $categories = [];
		// foreach ($category_data as $category) {
		// 	if ($category->super_category_id == 0) {
		// 		$categories[$category->id] = [
		// 			'id' => $category->id,
		// 			'name' => $category->name,
		// 			'slug_url' => $category->slug_url,
		// 			'subcategories' => []
		// 		];
		// 	} else {
		// 		$categories[$category->super_category_id]['subcategories'][] = [
		// 			'id' => $category->id,
		// 			'name' => $category->name,
		// 			'slug_url' => $category->slug_url
		// 		];
		// 	}
		// }

		// $this->data["categories"] = $categories;


		function build_category_tree($category_data)
		{
			$tree = [];

			// First pass: Create all category entries
			foreach ($category_data as $category) {
				$id = $category->id;
				$tree[$id] = [
					'id' => $id,
					'name' => $category->name,
					'slug_url' => $category->slug_url,
					'cover_image' => $category->cover_image,
					'cover_image_title' => $category->cover_image_title,
					'cover_image_alt_title' => $category->cover_image_alt_title,
					'subcategories' => []
				];
			}

			// Second pass: Build the hierarchy
			foreach ($category_data as $category) {
				$id = $category->id;
				$parentId = $category->super_category_id;

				if ($parentId !== '0' && isset($tree[$parentId])) {
					// This is a subcategory
					$tree[$parentId]['subcategories'][] = &$tree[$id];
					// Remove it from the top level
					unset($tree[$id]);
				}
			}

			return $tree;
		}

		$this->data['category_tree'] = $category_tree = build_category_tree($category_data);

		// echo "<pre> <br>";
		// print_r($this->data['category_tree']);
		// exit;

		// $this->data['check_screen'] = $this->Common_model->checkScreen();
		$this->load->view("inc/$pageName", $this->data);
	}

	public function get_footer($pageName, $data)
	{
		$this->data = $data;
		$this->load->view("inc/$pageName", $this->data);
	}







}
