<?php
class Ajax_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
  }

  function get_state($params = array())
  {
    $this->db
      ->select('ft.*')
      ->from('state as ft')
      ->where('ft.status', 1)
      ->order_by('ft.name ASC');
    if (!empty($params['country_id']))
      $this->db->where('ft.country_id', $params['country_id']);
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      $result = $result->result();
      return $result;
    } else {
      return false;
    }
  }


  function get_property_sub_type($params = array())
  {
    $this->db
      ->select('ft.*')
      ->from('property_sub_type as ft')
      ->where('ft.status', 1)
      ->order_by('ft.name ASC');

    if (!empty($params['property_type_id']))
      $this->db->where('ft.property_type_id', $params['property_type_id']);
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      $result = $result->result();
      return $result;
    } else {
      return false;
    }
  }




  function get_city($params = array())
  {
    $this->db
      ->select('ft.*')
      ->from('city as ft')
      ->where('ft.status', 1)
      ->order_by('ft.name ASC');
    if (!empty($params['state_id']))
      $this->db->where('ft.state_id', $params['state_id']);
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      $result = $result->result();
      return $result;
    } else {
      return false;
    }
  }




  function get_data_by_table_name($params = array())
  {
    $this->db
      ->select('ft.*')
      ->from('city as ft')
      ->where('ft.status', 1)
      ->order_by('ft.name ASC');
    if (!empty($params['id']))
      $this->db->where('ft.id', $params['id']);
    $result = $this->db->get();
    if ($result->num_rows() > 0) {
      $result = $result->result();
      return $result;
    } else {
      return false;
    }
  }



}

?>