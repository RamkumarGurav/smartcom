<?php
class User_model extends CI_Model
{
  function __construct()
  {
    date_default_timezone_set("Asia/Kolkata");
    $this->load->library('session');
    $this->db->query("SET sql_mode = ''");

    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");
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
      $this->db->order_by("ft.id desc");
    }

    if (!empty($params['id'])) {
      $this->db->where("ft.id", $params['id']);
    }

    if (!empty($params['slug_url'])) {
      $this->db->where("ft.slug_url", $params['slug_url']);
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
          $this->db->where("ft.status", 1);
          $this->db->where("ft.is_display", 1);
          $r->subcategories = $this->db->get()->result();


        }
      }

    }
    return $result;
  }



  function get_product_data($params = array())
  {

    $result = '';
    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.id) as counts");
    } else {
      $this->db->select("ft.*");
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name ");
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name ");
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.is_deleted_by) as deleted_by_name ");
      $this->db->select("GROUP_CONCAT(DISTINCT category.name SEPARATOR '~~~') as category_name");

    }



    $this->db->from("product as ft");
    $this->db->join("join_product_category as jpc", "jpc.product_id = ft.id", "left");
    $this->db->join("category as category", "jpc.category_id = category.id", "left");





    if (!empty($params['sort_by_position'])) {
      $this->db->order_by("ft.position ASC");
    } else if (!empty($params['order_by'])) {
      $this->db->order_by($params['order_by']);
    } else {
      $this->db->order_by("ft.id desc");
    }



    if (!empty($params['id'])) {
      $this->db->where("ft.id", $params['id']);
    }

    if (!empty($params['slug_url'])) {
      $this->db->where("ft.slug_url", $params['slug_url']);
    }

    // if (!empty($params['category_id'])) {
    // 	$this->db->where("ft.category_id", $params['category_id']);
    // }

    if (!empty($params['category_id'])) {
      $this->db->where("jpc.category_id", $params['category_id']);
    }


    if (!empty($params['category_slug_url'])) {
      $this->db->where("category.slug_url", $params['category_slug_url']);
    }

    if (!empty($params['category_id'])) {
      $this->db->where("jpc.category_id", $params['category_id']);
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



    if (!empty($params['group_by'])) {
      $this->db->group_by($params['group_by']);
    } else {
      $this->db->group_by("ft.id");
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



    if (!empty($result)) {

      if (!empty($params['details'])) {

        foreach ($result as $r) {

          $this->db->select("pgi.*");
          $this->db->from("product_gallery_image as pgi");
          $this->db->where("pgi.product_id", $r->id);
          $this->db->order_by("pgi.position ASC");
          $r->product_gallery_image = $this->db->get()->result();

          $this->db->select("pgi.*");
          $this->db->from("product_gallery_image as pgi");
          $this->db->where("pgi.product_id", $r->id);
          $this->db->where("pgi.is_default", 1);
          $r->product_gallery_image = $this->db->get()->result()[0];

        }

      }



    }

    return $result;

  }



  function get_join_product_category_data($params = array())
  {

    $result = '';

    if (!empty($params['search_for'])) {
      $this->db->select("count(ft.product_id) as counts");
    } else {
      $this->db->select("ft.*");
    }



    $this->db->from("join_product_category as ft");



    if (!empty($params['product_id'])) {
      $this->db->where("ft.product_id", $params['product_id']);
    }

    if (!empty($params['category_id'])) {
      $this->db->where("ft.category_id", $params['category_id']);
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





  function get_product_gallery_image_data($params = array())
  {
    $result = '';

    // Check if search_for parameter is provided to decide the count query
    if (!empty($params['search_for'])) {

      $this->db->select("count(ft.id) as counts"); // Select count of records
    } else {

      // Select all required fields and additional information
      $this->db->select("ft.* ");
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.added_by) as added_by_name "); // Select added_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.updated_by) as updated_by_name "); // Select updated_by user's name
      $this->db->select("(select au.name from admin_user as  au where au.id = ft.is_deleted_by) as is_deleted_by_name "); // Select updated_by user's name
    }

    // From admin_user table "ft" refers to "from table"
    $this->db->from("product_gallery_image as ft");



    // Conditional logic for ordering results
    if (!empty($params['sortByPosition'])) {
      $this->db->order_by("ft.position ASC");
    } else if (!empty($params['order_by'])) {
      $this->db->order_by($params['order_by']);
    } else {
      $this->db->order_by("ft.id desc");
    }



    // Conditions based on provided parameters
    if (!empty($params['id'])) {
      $this->db->where("ft.id", $params['id']);
    }

    if (!empty($params['product_id'])) {
      $this->db->where("ft.product_id", $params['product_id']);
    }



    if (!empty($params['start_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['start_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') >= DATE_FORMAT('$temp_date', '%Y%m%d')"); // Start date condition
    }

    if (!empty($params['end_date'])) {
      $temp_date = date('Y-m-d', strtotime($params['end_date']));
      $this->db->where("DATE_FORMAT(ft.added_on, '%Y%m%d') <= DATE_FORMAT('$temp_date', '%Y%m%d')"); // End date condition
    }

    if (!empty($params['record_status'])) {
      if ($params['record_status'] == 'zero') {
        $this->db->where("ft.status = 0"); // Status zero condition
      } else {
        $this->db->where("ft.status", $params['record_status']); // Specific status condition
      }
    }

    if (!empty($params['field_value']) && !empty($params['field_name'])) {
      $this->db->where("$params[field_name] like ('%$params[field_value]%')"); // Field name and value condition
    }

    if (!empty($params['limit']) && !empty($params['offset'])) {
      $this->db->limit($params['limit'], $params['offset']); // Limit and offset for pagination
    } else if (!empty($params['limit'])) {
      $this->db->limit($params['limit']); // Limit for number of records
    }


    // Execute query and get results
    $query_get_list = $this->db->get();
    $result = $query_get_list->result();//RESULT CONTAINS ARRAY OF ADMIN_USERS




    return $result; // Return the final result
  }


  public function set_latest_image_as_default($product_id)
  {
    // Step 1: Check if there's already a default image
    $this->db->select('id');
    $this->db->from('product_gallery_image');
    $this->db->where('product_id', $product_id);
    $this->db->where('is_default', 1);
    $query = $this->db->get();

    // If a default image exists, do nothing
    if ($query->num_rows() > 0) {
      return false; // Default image already exists, no update necessary
    }

    // Step 2: Reset all images' `is_default` to 0 for the specific product (optional)
    // Uncomment if needed to reset before setting the latest as default
    // $this->db->where('product_id', $product_id);
    // $this->db->update('product_gallery_image', array('is_default' => 0));

    // Step 3: Set the latest image as default
    $this->db->where('product_id', $product_id);
    $this->db->order_by('id', 'ASC');  // Assuming 'created_on' is the column to determine the latest image
    $this->db->limit(1);
    $status = $this->db->update('product_gallery_image', array('is_default' => 1));

    return $status;
  }


}

?>