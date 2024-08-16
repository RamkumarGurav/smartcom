<?php
# Same Model we are using for Reports section
class Company_profile_model extends CI_Model
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

		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");

	}

	function get_company_profile_data($params = array())
	{
		$result = ''; // Initialize result variable

		if (!empty($params['search_for'])) { // Check if search_for parameter is set
			$this->db->select("count(ft.id) as counts"); // Select count of company profiles
		} else {
			// Select specific columns and additional fields for company profiles
			$this->db->select("ft.*, ci.name as city_name, s.name as state_name, c.name as country_name, 
			c.short_name as country_short_name, c.dial_code");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name");
		}


		$this->db->from("company_profile as ft"); // Select from company_profile table
		$this->db->join("country as c", "c.id = ft.country_id", "Left"); // Join country table
		$this->db->join("state as s", "s.id = ft.state_id", "Left"); // Join state table
		$this->db->join("city as ci", "ci.id = ft.city_id", "Left"); // Join city table

		// Conditional logic for ordering results
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		} else {
			$this->db->order_by("ft.id desc"); // Default order by admin_user_id descending
		}


		if (!empty($params['id'])) {
			$this->db->where("ft.id", $params['id']); // Filter by company_profile_id
		}
		if (!empty($params['country_id'])) {
			$this->db->where("ft.country_id", $params['country_id']); // Filter by country_id
		}

		if (!empty($params['state_id'])) {
			$this->db->where("ft.state_id", $params['state_id']); // Filter by state_id
		}

		if (!empty($params['city_id'])) {
			$this->db->where("ft.city_id", $params['city_id']); // Filter by city_id
		}

		if (!empty($params['start_date'])) {
			// Filter by start date formatted to Y-m-d
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if (!empty($params['end_date'])) {
			// Filter by end date formatted to Y-m-d
			$temp_date = date('Y-m-d', strtotime($params['end_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		if (!empty($params['record_status'])) {
			if ($params['record_status'] == 'zero') {
				$this->db->where("ft.status = 0"); // Filter by status equals 0
			} else {
				$this->db->where("ft.status", $params['record_status']); // Filter by company_profile_id
			}
		}

		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			// Filter by field name and value using LIKE operator
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		if (!empty($params['limit']) && !empty($params['offset'])) {
			// Apply limit and offset for pagination
			$this->db->limit($params['limit'], $params['offset']);
		} else if (!empty($params['limit'])) {
			// Apply only limit
			$this->db->limit($params['limit']);
		}

		$query_get_list = $this->db->get(); // Execute the query
		$result = $query_get_list->result(); // Fetch results into $result variable

		return $result; // Return the fetched results
	}

}

?>