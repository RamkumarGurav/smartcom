<?php
class State_model extends CI_Model
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

	/**
	 * getting states with search ,pagination  and sorting using params ,if your using this method to find single state data with its id then it will be present int the 0th index of the resultant array
	 */
	function get_state_data($params = array())
	{
		$result = '';
		if (!empty($params['search_for'])) {
			$this->db->select("count(ft.id) as counts");
		} else {
			$this->db->select("ft.* , c.name as country_name , c.short_name as country_short_name , c.dial_code ");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name");
		}

		$this->db->from("state as ft");
		$this->db->join("country as  c", "c.id = ft.country_id", "Left");


		// Conditional logic for ordering results
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		} else {
			$this->db->order_by("ft.id desc"); // Default order by admin_user_id descending
		}


		if (!empty($params['id'])) {
			$this->db->where("ft.id", $params['id']);
		}
		if (!empty($params['country_id'])) {
			$this->db->where("ft.country_id", $params['country_id']);
		}

		if (!empty($params['start_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if (!empty($params['end_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// If 'record_status' is set in the $params array, filter results by status
		if (!empty($params['record_status'])) {
			if ($params['record_status'] == 'zero') {
				// If record_status is 'zero', filter by status = 0
				$this->db->where("ft.status = 0");
			} else {
				// Otherwise, filter by city_id equal to record_status
				$this->db->where("ft.status", $params['record_status']);
			}
		}


		if (!empty($params['is_display'])) {
			if ($params['is_display'] == 'zero') {
				// If is_display is 'zero', filter by status = 0
				$this->db->where("ft.is_display = 0");
			} else {
				// Otherwise, filter by city_id equal to is_display
				$this->db->where("ft.is_display", $params['is_display']);
			}
		}



		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		if (!empty($params['limit']) && !empty($params['offset'])) {
			$this->db->limit($params['limit'], $params['offset']);
		} else if (!empty($params['limit'])) {
			$this->db->limit($params['limit']);
		}

		$query_get_list = $this->db->get();
		$result = $query_get_list->result();

		return $result;
	}
}

?>