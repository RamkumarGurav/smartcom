<?php
class Category_model extends CI_Model
{
	public $session_auid = '';
	public $session_auname = '';
	public $session_auemail = '';
	public $session_aurid = '';

	function __construct()
	{
		$this->load->database();

		$this->db->query("SET sql_mode = ''");

		$this->session_auid = $this->session->userdata('session_auid');
		$this->session_auname = $this->session->userdata('session_auname');
		$this->session_auemail = $this->session->userdata('session_auemail');
		$this->session_aurid = $this->session->userdata('session_aurid');
	}
	function get_category_data($params = array())
	{
		$result = '';
		if (!empty($params['search_for'])) {
			$this->db->select("count(ft.id) as counts");
		} else {
			$this->db->select("ft.*");
			$this->db->select("if(ft.super_category_id = 0 , 'Parent' , cat.name) as super_category_name");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name ");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name ");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.is_deleted_by) as deleted_by_name ");
		}

		$this->db->from("category as ft");
		$this->db->join("category as cat", "ft.super_category_id = cat.id", "left");

		if (!empty($params['sortByPosition'])) {
			$this->db->order_by("ft.position ASC");
		} else if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		} else {
			$this->db->order_by("ft.super_category_id ASC");
			$this->db->order_by("ft.id desc");
		}

		if (!empty($params['id'])) {
			$this->db->where("ft.id", $params['id']);
		}



		if (!empty($params['start_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if (!empty($params['end_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if (!empty($params['record_status'])) {
			if ($params['record_status'] == 'zero') {
				$this->db->where("ft.status = 0");
			} else {
				$this->db->where("ft.status", $params['record_status']);
			}
		}

		if (!empty($params['is_display'])) {
			if ($params['is_display'] == 'zero') {
				$this->db->where("ft.status = 0");
			} else {
				$this->db->where("ft.status", $params['is_display']);
			}
		}




		if (!empty($params['limit']) && !empty($params['offset'])) {
			$this->db->limit($params['limit'], $params['offset']);
		} else if (!empty($params['limit'])) {
			$this->db->limit($params['limit']);
		}

		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}


		$query_get_list = $this->db->get();
		//echo $this->db->last_query();
		$result = $query_get_list->result();

		if (!empty($result)) {
			// For each category, we want to get details about sub-categories and the names of the users who last updated these sub-categories.
			if (!empty($params['details'])) {
				foreach ($result as $r) {
					$this->db->select("ft.* , au.name");
					$this->db->from("category as ft");
					$this->db->join("admin_user as au", "au.id = ft.updated_by", "left");
					$this->db->where("ft.super_category_id", $r->id);
					$r->roles = $this->db->get()->result();


				}
			}

		}
		return $result;
	}
}

?>