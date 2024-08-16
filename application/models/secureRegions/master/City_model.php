<?php
class City_model extends CI_Model
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
	 * getting cities with search ,pagination  and sorting using params ,if your using this method to find single city data with its id then it will be present int the 0th index of the resultant array
	 */
	function get_city_data($params = array())
	{
		$result = '';

		// Check if the 'search_for' parameter is present in the $params array
		if (!empty($params['search_for'])) {
			// If 'search_for' is set, only select the count of cities
			$this->db->select("count(ft.id) as counts");
		} else {
			// Otherwise, select detailed information about the city including state and country details
			$this->db->select("ft.*, s.name as state_name, c.name as country_name, c.short_name as country_short_name, c.dial_code");
			// Select the name of the user who added the city
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name");
		}

		// From the city table (aliased as ft)
		$this->db->from("city as ft");

		$this->db->join("country as c", "c.id = ft.country_id", "Left");
		$this->db->join("state as s", "s.id = ft.state_id", "Left");


		// Conditional logic for ordering results
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		} else {
			$this->db->order_by("ft.id desc"); // Default order by admin_user_id descending
		}

		// If 'id' is set in the $params array, filter results by id
		if (!empty($params['id'])) {
			$this->db->where("ft.id", $params['id']);
		}

		// If 'country_id' is set in the $params array, filter results by country_id
		if (!empty($params['country_id'])) {
			$this->db->where("ft.country_id", $params['country_id']);
		}
		// If 'state_id' is set in the $params array, filter results by state_id
		if (!empty($params['state_id'])) {
			$this->db->where("ft.state_id", $params['state_id']);
		}

		// If 'start_date' is set in the $params array, filter results to include only cities added on or after the start date
		if (!empty($params['start_date'])) {
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// If 'end_date' is set in the $params array, filter results to include only cities added on or before the end date
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
				// Otherwise, filter by id equal to record_status
				$this->db->where("ft.status", $params['record_status']);
			}
		}


		if (!empty($params['is_display'])) {
			if ($params['is_display'] == 'zero') {
				// If is_display is 'zero', filter by status = 0
				$this->db->where("ft.is_display = 0");
			} else {
				// Otherwise, filter by id equal to is_display
				$this->db->where("ft.is_display", $params['is_display']);
			}
		}

		// If both 'field_value' and 'field_name' are set in the $params array, filter results where the field contains the value
		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		// If 'limit' and 'offset' are set in the $params array, limit the number of results and set the offset
		if (!empty($params['limit']) && !empty($params['offset'])) {
			$this->db->limit($params['limit'], $params['offset']);
		}
		// If only 'limit' is set, just limit the number of results
		else if (!empty($params['limit'])) {
			$this->db->limit($params['limit']);
		}

		// Execute the query and get the results
		$query_get_list = $this->db->get();
		// Store the results in the $result variable
		$result = $query_get_list->result();

		// Return the result
		return $result;
	}
}

?>