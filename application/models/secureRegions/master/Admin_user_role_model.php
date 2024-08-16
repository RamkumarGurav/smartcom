<?php
class Admin_user_role_model extends CI_Model
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

	function get_admin_user_role_data($params = array())
	{
		$result = ''; // Initialize result variable

		// Check if 'search_for' parameter is provided and not empty
		if (!empty($params['search_for'])) {
			// If searching for something specific, select the count of id
			$this->db->select("count(ft.id) as counts");
		} else {
			// Otherwise, select all columns from admin_user_role table
			$this->db->select("ft.* ");
			// Also, select the name of the admin_user who added the role
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name");
			$this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name");
		}
		// Set the from table to admin_user_role with alias ft
		$this->db->from("admin_user_role as ft");

		// Conditional logic for ordering results
		if (!empty($params['order_by'])) {
			$this->db->order_by($params['order_by']);
		} else {
			$this->db->order_by("ft.id desc"); // Default order by admin_user_id descending
		}

		// Check if id is provided in the params and not empty
		if (!empty($params['id'])) {
			// Add a where clause to filter by id
			$this->db->where("ft.id", $params['id']);
		}

		// Check if start_date is provided in the params and not empty
		if (!empty($params['start_date'])) {
			// Convert start_date to 'Y-m-d' format
			$temp_date = date('Y-m-d', strtotime($params['start_date']));
			// Add a where clause to filter records added on or after start_date
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// Check if end_date is provided in the params and not empty
		if (!empty($params['end_date'])) {
			// Convert end_date to 'Y-m-d' format
			$temp_date = date('Y-m-d', strtotime($params['end_date']));
			// Add a where clause to filter records added on or before end_date
			$this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')");
		}

		// Check if record_status is provided in the params and not empty
		if (!empty($params['record_status'])) {
			// If record_status is 'zero', filter records with status = 0
			if ($params['record_status'] == 'zero') {
				$this->db->where("ft.status = 0");
			} else {
				// Otherwise, filter records by id with the given status
				$this->db->where("ft.status", $params['record_status']);
			}
		}

		// Check if both field_value and field_name are provided in the params and not empty
		if (!empty($params['field_value']) && !empty($params['field_name'])) {
			// Add a where clause to filter records with field_name containing field_value
			$this->db->where("$params[field_name] like ('%$params[field_value]%')");
		}

		// Check if limit and offset are provided in the params and not empty
		if (!empty($params['limit']) && !empty($params['offset'])) {
			// Set the limit and offset for the query
			$this->db->limit($params['limit'], $params['offset']);
		} else if (!empty($params['limit'])) {
			// If only limit is provided, set the limit for the query
			$this->db->limit($params['limit']);
		}

		// Execute the query and get the result
		$query_get_list = $this->db->get();
		$result = $query_get_list->result();



		// Return the result
		return $result;


	}

}

?>