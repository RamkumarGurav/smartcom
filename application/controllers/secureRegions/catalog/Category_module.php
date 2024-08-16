<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . "controllers/secureRegions/Main.php");
class Category_module extends Main
{

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('session');
		$this->load->library('User_auth');
		$this->load->helper('url');

		$this->load->model('Common_model');
		$this->load->model('secureRegions/catalog/Category_model');

		$this->load->library('pagination');


		//session data
		$session_auid = $this->data['session_auid'] = $this->session->userdata('session_auid');
		$this->data['session_auname'] = $this->session->userdata('session_auname');
		$this->data['session_auemail'] = $this->session->userdata('session_auemail');
		$this->data['session_aurid'] = $this->session->userdata('session_aurid');

		$this->data['page_module_name'] = 'Category';
		$this->data['table_name'] = 'category';
		$this->data['page_module_id'] = 10;


		$this->data['User_auth_obj'] = new User_auth();
		$this->data['user_data'] = $this->data['User_auth_obj']->check_user_status();

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

	}

	/****************************************************************
	 *HELPERS
	 ****************************************************************/

	function unset_only()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
				$this->session->unset_userdata($key);
			}
		}
	}

	/****************************************************************
	 ****************************************************************/


	function index()
	{
		parent::get_header();
		parent::get_left_nav();
		$this->load->view('secureRegions/catalog/Category_module/list', $this->data);
		parent::get_footer();
	}

	function list()
	{
		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


		if (empty($this->data['user_access'])) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}

		$search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status = "";

		if (!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if (!empty($field_name))
			$field_name = $field_name;

		if (!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if (!empty($field_value))
			$field_value = $field_value;

		if (!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];

		if (!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];

		if (!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];


		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;

		$search['field_name'] = $field_name;
		$search['field_value'] = $field_value;
		$search['start_date'] = $start_date;
		$search['end_date'] = $end_date;
		$search['record_status'] = $record_status;
		$search['search_for'] = "count";

		$data_count = $this->Category_model->get_category_data($search);
		$r_count = $this->data['row_count'] = $data_count[0]->counts;

		unset($search['search_for']);

		$offset = (int) $this->uri->segment(5); //echo $offset;
		if ($offset == "") {
			$offset = '0';
		}
		$per_page = _all_pagination_;


		$this->load->library('pagination');
		$config['base_url'] = MAINSITE_Admin . $this->data['user_access']->class_name . '/' . $this->data['user_access']->function_name . '/';
		$config['total_rows'] = $r_count;
		$config['uri_segment'] = '5';
		$config['per_page'] = $per_page;
		$config['num_links'] = 4;
		$config['first_link'] = '&lsaquo; First';
		$config['last_link'] = 'Last &rsaquo;';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['attributes'] = array('class' => 'paginationClass');


		$this->pagination->initialize($config);

		// Assigning additional data for the view
		$this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;



		$search['limit'] = $per_page;
		$search['offset'] = $offset;
		$this->data['category_data'] = $this->Category_model->get_category_data($search);


		parent::get_header();
		parent::get_left_nav();
		$this->load->view('secureRegions/catalog/Category_module/list', $this->data);
		parent::get_footer();
	}

	function list_export()
	{
		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

		if (empty($this->data['user_access'])) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}

		if ($this->data['user_access']->export_data != 1) {
			$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Export " . $user_access->name);
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}
		$search = array();
		$field_name = '';
		$field_value = '';
		$end_date = '';
		$start_date = '';
		$record_status = "";

		if (!empty($_REQUEST['field_name']))
			$field_name = $_POST['field_name'];
		else if (!empty($field_name))
			$field_name = $field_name;

		if (!empty($_REQUEST['field_value']))
			$field_value = $_POST['field_value'];
		else if (!empty($field_value))
			$field_value = $field_value;

		if (!empty($_POST['end_date']))
			$end_date = $_POST['end_date'];

		if (!empty($_POST['start_date']))
			$start_date = $_POST['start_date'];

		if (!empty($_POST['record_status']))
			$record_status = $_POST['record_status'];


		$this->data['field_name'] = $field_name;
		$this->data['field_value'] = $field_value;
		$this->data['end_date'] = $end_date;
		$this->data['start_date'] = $start_date;
		$this->data['record_status'] = $record_status;

		$search['end_date'] = $end_date;
		$search['start_date'] = $start_date;
		$search['field_value'] = $field_value;
		$search['field_name'] = $field_name;
		$search['record_status'] = $record_status;

		$this->data['category_data'] = $this->Category_model->get_category_data($search);


		$this->load->view('secureRegions/catalog/Category_module/list_export', $this->data);
	}

	function view($id = "")
	{
		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


		if (empty($id)) {
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button"
			 class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> 
			 Something Went Wrong. Please Try Again.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
			exit;
		}

		if (empty($this->data['user_access'])) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}

		// Assigning additional data for the view
		$this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;


		$this->data['category_data'] = $this->Category_model->get_category_data(array("id" => $id));
		if (empty($id)) {
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" 
			data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> 
			Something Went Wrong. Please Try Again.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
			exit;
		}

		$this->data['category_data'] = $this->data['category_data'][0];

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('secureRegions/catalog/Category_module/view', $this->data);
		parent::get_footer();
	}

	function edit($id = "")
	{
		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));


		if (empty($this->data['user_access'])) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}
		if (empty($id)) {
			if ($user_access->add_module != 1) {
				$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->name);
				REDIRECT(MAINSITE_Admin . "wam/access-denied");
			}
		}
		if (!empty($id)) {
			if ($user_access->update_module != 1) {
				$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->name);
				REDIRECT(MAINSITE_Admin . "wam/access-denied");
			}
		}

		// Assigning additional data for the view
		$this->data['page_is_master'] = $this->data['user_access']->is_master;//this is for making left menu active
		$this->data['page_parent_module_id'] = $this->data['user_access']->parent_module_id;



		if (!empty($id)) {
			$this->data['category_data'] = $this->Category_model->get_category_data(array("id" => $id));
			if (empty($this->data['category_data'])) {
				$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Record Not Found. 
				  </div>');
				REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
			}
			$this->data['category_data'] = $this->data['category_data'][0];
		}

		$this->data['category_list'] = $this->Category_model->get_category_data();

		parent::get_header();
		parent::get_left_nav();
		$this->load->view('secureRegions/catalog/Category_module/edit', $this->data);
		parent::get_footer();
	}

	function do_edit()
	{



		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));

		if (
			empty($_POST['name'])
			&& empty($_POST['description'])
			&& empty($_POST['cover_image_title'])
			&& empty($_POST['cover_image_alt_title'])
			&& empty($_POST['slug_url'])
			&& empty($_POST['meta_title'])
			&& empty($_POST['meta_description'])
			&& empty($_POST['meta_keyword'])

		) {
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" 
			class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> 
			Something Went Wrong. Please Try Again.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
			exit;
		}
		$id = $_POST['id'];


		if (empty($this->data['user_access'])) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}
		if (empty($id)) {
			if ($user_access->add_module != 1) {
				$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Add " . $user_access->name);
				REDIRECT(MAINSITE_Admin . "wam/access-denied");
			}
		}
		if (!empty($id)) {
			if ($user_access->update_module != 1) {
				$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->name);
				REDIRECT(MAINSITE_Admin . "wam/access-denied");
			}
		}

		$super_category_id = $enter_data['super_category_id'] = trim($_POST['super_category_id']);
		$name = $enter_data['name'] = get_clean_text(trim($_POST['name']));
		$cover_image_title = $enter_data['cover_image_title'] = trim($_POST['cover_image_title']);
		$cover_image_alt_title = $enter_data['cover_image_alt_title'] = trim($_POST['cover_image_alt_title']);
		$slug_url = $enter_data['slug_url'] = get_clean_text(trim($_POST['slug_url']));
		$meta_title = $enter_data['meta_title'] = trim($_POST['meta_title']);
		$meta_keyword = $enter_data['meta_keyword'] = trim($_POST['meta_keyword']);
		$meta_description = $enter_data['meta_description'] = trim($_POST['meta_description']);
		$description = $enter_data['description'] = trim($_POST['description']);
		$is_display = $enter_data['is_display'] = trim($_POST['is_display']);
		$status = $enter_data['status'] = trim($_POST['status']);


		if (empty(is_valid_slug_url($slug_url))) {

			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
        aria-hidden="true">×</button><i class="icon fas fa-ban"></i>Invalid Slug URL.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			if (!empty($id)) {
				REDIRECT(MAINSITE_Admin . $user_access->class_name . "/edit/" . $id);
			} else {
				REDIRECT(MAINSITE_Admin . $user_access->class_name . "/edit/");
			}
			exit;

		}



		$is_exist_slug_url = $this->Common_model->get_data(array('select' => '*', 'from' => 'category', 'where' => "slug_url = \"$slug_url\"  and id != $id"));


		if (!empty($is_exist_slug_url)) {
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" 
			data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Slug URL already exist in database.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			//echo $this->session->flashdata('alert_message' );
			//echo "anubhav";
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/edit/" . $id);
			exit;
		}

		$is_exist = $this->Common_model->get_data(array('select' => '*', 'from' => 'category', 'where' => "name = \"$name\" and super_category_id = $super_category_id and id != $id"));


		if (!empty($is_exist)) {
			$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Category already exist in database.</div>';
			$this->session->set_flashdata('alert_message', $alert_message);
			//echo $this->session->flashdata('alert_message' );
			//echo "anubhav";
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/edit/" . $id);
			exit;
		}



		$alert_message = '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. </div>';
		if (!empty($id)) {
			$enter_data['updated_on'] = date("Y-m-d H:i:s");
			$enter_data['updated_by'] = $this->data['session_auid'];
			$insert_status = $this->Common_model->update_operation(array('table' => 'category', 'data' => $enter_data, 'condition' => "id = $id"));



			if (!empty($insert_status)) {
				$this->upload_any_image("category", "id", $id, "cover_image", "cover_image", "cover_image_", "category_cover_image");
				$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" 
				class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fas fa-check">
				</i> Record Updated Successfully </div>';
			}

		} else {
			$enter_data['added_on'] = date("Y-m-d H:i:s");
			$enter_data['added_by'] = $this->data['session_auid'];
			$insert_status = $id = $this->Common_model->add_operation(array('table' => 'category', 'data' => $enter_data));
			if (!empty($insert_status)) {
				$this->upload_any_image("category", "id", $id, "cover_image", "cover_image", "cover_image_", "category_cover_image");
				$alert_message = '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">×</button><i class="icon fas fa-check"></i> New Record Added Successfully </div>';
			}


		}



	

		$this->session->set_flashdata('alert_message', $alert_message);

		if (!empty($_POST['redirect_type'])) {
			REDIRECT(MAINSITE_Admin . $user_access->class_name . "/edit");
		}

		REDIRECT(MAINSITE_Admin . $user_access->class_name . "/" . $user_access->function_name);
	}

	function do_update_status()
	{
		$this->data['page_type'] = "list";
		$user_access = $this->data['user_access'] = $this->data['User_auth_obj']->check_user_access(array("module_id" => $this->data['page_module_id']));



		$task = $_POST['task'];
		$id_arr = $_POST['sel_recds'];


		if (empty($user_access)) {
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}


		if ($user_access->update_module == 1) {
			$this->session->set_flashdata('alert_message', '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<i class="icon fas fa-ban"></i> Something Went Wrong Please Try Again. 
				  </div>');


			$update_data = array();
			if (!empty($id_arr)) {

				$action_taken = "";
				$ids = implode(',', $id_arr);

				if ($task == "active") {
					$update_data['status'] = 1;
					$action_taken = "Activate";
				}
				if ($task == "block") {
					$update_data['status'] = 0;
					$action_taken = "Blocked";
				}
				$update_data['updated_on'] = date("Y-m-d H:i:s");
				$update_data['updated_by'] = $this->data['session_auid'];

				$response = $this->Common_model->update_operation(array('table' => "category", 'data' => $update_data, 'condition' => "id in ($ids)"));

				if ($response) {
					$this->session->set_flashdata('alert_message', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="icon fas fa-check"></i> Records Successfully ' . $action_taken . ' 
						</div>');
				}
			}
			REDIRECT(MAINSITE_Admin . $user_access->class_name . '/' . $user_access->function_name);
		} else {
			$this->session->set_flashdata('no_access_flash_message', "You Are Not Allowed To Update " . $user_access->name);
			REDIRECT(MAINSITE_Admin . "wam/access-denied");
		}
	}


	function upload_any_image($table_name, $id_column, $id, $input_name, $target_column, $prefix, $target_folder_name)
	{
		$file_name = "";
		if (isset($_FILES[$input_name]['name'])) {
			$timg_name = $_FILES[$input_name]['name'];
			if (!empty($timg_name)) {
				$temp_var = explode(".", strtolower($timg_name));
				$timage_ext = end($temp_var);
				$timage_name_new = $prefix . $id . "." . $timage_ext;
				$image_enter_data[$target_column] = $timage_name_new;
				$imginsert_status = $this->Common_model->update_operation(array('table' => $table_name, 'data' => $image_enter_data, 'condition' => "$id_column = $id"));
				if ($imginsert_status == 1) {
					if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
						mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

					}
					move_uploaded_file($_FILES["$input_name"]['tmp_name'], _uploaded_temp_files_ . $target_folder_name . "/" . $timage_name_new);
					$file_name = $timage_name_new;
				}

			}
		}
	}



}
