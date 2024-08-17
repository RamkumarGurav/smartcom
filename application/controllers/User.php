<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');


include_once('Main.php');
class User extends Main
{

  public function __construct()
  {
    parent::__construct();

    //models
    $this->load->model('Common_model');
    $this->load->model('User_model');


    //headers
    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $this->output->set_header("Pragma: no-cache");

  }

  public function index()
  {

    $this->data['meta_title'] = _project_name_;
    $this->data['meta_description'] = _project_name_;
    $this->data['meta_keywords'] = _project_name_;
    $this->data['meta_others'] = "";



    // $this->data['completed_project_home_data'] = $this->User_model->get_project([
    //   "project_variant" => 2,
    //   "is_home_display" => 1,
    //   "sort_by_home_position" => 1,
    //   "details" => 1
    // ]);

    // $this->data['ongoing_project_home_data'] = $this->User_model->get_project([
    //   "project_variant" => 1,
    //   "is_home_display" => 1,
    //   "sort_by_home_position" => 1,
    //   "details" => 1
    // ]);


    $this->data['direct_css'] = array(
      'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
      'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',
      'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css',

    );//

    $this->data['direct_js'] = array(
      'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js',
      'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js',
      "https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js",

    );//, 'js/all-scripts.js'
    $this->data['js'] = array("js/home.js", );//, 'js/all-scripts.js'


    parent::get_header('header', $this->data);
    $this->load->view('home', $this->data);
    parent::get_footer('footer', $this->data);
  }




  function category_list($cat_slug = "")
  {


    // $this->data['category_data'] = $this->User_model->get_category_data(
    //   array(
    //     "slug_url" => $cat_slug,
    //     "record_status" => 1,
    //     "is_display" => 1,
    //     "details" => 1
    //   )
    // );

    // if (!empty(count($this->data['category_data']))) {
    //   $this->data['category_data'] = $this->data['category_data'][0];
    // }



    $this->data['product_data'] = $this->User_model->get_product_data(
      array(
        "category_slug_url" => $cat_slug,
        "record_status" => 1,
        "is_display" => 1,
        // "details" => 1
      )
    );


    echo "<pre> <br>";
    print_r($this->data['product_data']);
    exit;




    parent::get_header('header', $this->data);
    $this->load->view('category_list', $this->data);
    parent::get_footer('footer', $this->data);



  }


  function sub_category_list($cat_slug = "")
  {


    $this->data['category_data'] = $this->User_model->get_product_data(
      array(
        "category_slug_url" => $cat_slug,
        "record_status" => 1,
        "is_display" => 1,
        "details" => 1
      )
    );


    echo "<pre> <br>";
    print_r($this->data['category_data']);
    exit;

    // if (!empty(count($this->data['category_data']))) {
    //   $this->data['category_data'] = $this->data['category_data'][0];
    // }



    $this->data['product_data'] = $this->User_model->get_product_data(
      array(
        "category_slug_url" => $cat_slug,
        "record_status" => 1,
        "is_display" => 1,
        // "details" => 1
      )
    );


    echo "<pre> <br>";
    print_r($this->data['product_data']);
    exit;




    parent::get_header('header', $this->data);
    $this->load->view('product_sub_category_list', $this->data);
    parent::get_footer('footer', $this->data);



  }


  function products_details($product_slug = "")
  {

    $this->data['product_data'] = $this->User_model->get_product_data(
      array(
        "slug_url" => $product_slug,
        "record_status" => 1,
        "is_display" => 1,
        "details" => 1
      )
    );



    if (!empty(count($this->data['product_data']))) {
      $this->data['product_data'] = $this->data['product_data'][0];
    }




    parent::get_header('header', $this->data);
    $this->load->view('product_details', $this->data);
    parent::get_footer('footer', $this->data);
  }





  function host_captcha_validation()
  {
    if (true) {
      if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '') {
        $link = $_SERVER['HTTP_REFERER'];
        $link_array = explode('/', $link);
        $page_action = end($link_array);
        $parts = parse_url($link);
        $page_host = $parts['host'];
        if (strpos($parts["host"], 'www.') !== false) { //echo 'yes<br>';
          $parts1 = explode('www.', $parts["host"]);
          $page_host = $parts1[1];
        }

        // $host='steelagebuildingsystem.com';
        $host = _mainsite_host_;

        if ($page_host != $host) {
          echo '<script language="javascript">';
          echo 'alert("Host validation failed! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: HTTP_REFERER failed! Please try again.")';
        echo '</script>';
        echo "<script>location.href='error'</script>";
        die();
      }

      $request = '';


      if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        $param['secret'] = _google_recaptcha_secret_key_;
        $param['response'] = $_POST['g-recaptcha-response'];
        $param['remoteip'] = $_SERVER['REMOTE_ADDR'];
        foreach ($param as $key => $val) {
          $request .= $key . "=" . $val;
          $request .= "&";
        }
        $request = substr($request, 0, strlen($request) - 1);
        $url = "https://www.google.com/recaptcha/api/siteverify?" . $request;
        //echo $url; exit;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result_data = curl_exec($ch);
        if (curl_exec($ch) === false) {
          $error_info = curl_error($ch);
        }
        curl_close($ch);

        $response = json_decode($result_data);
        if ($response->success != 1) {
          echo '<script language="javascript">';
          echo 'alert("google recaptcha validation failed! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      } else {
        echo '<script language="javascript">';
        echo 'alert("Error: google recaptcha post validation failed! Please try again.")';
        echo '</script>';
        echo "<script>location.href='error'</script>";
        die();
      }
    }

  }




  function do_enquiry()
  {


    date_default_timezone_set('Asia/Kolkata');
    $timestamp = date("Y-m-d H:i:s");

    //echo '<pre>'; print_r($_POST); echo '</pre>'; exit; 

    $this->host_captcha_validation();
    //exit;
    //echo "2";
    if (
      !empty($_POST['enq_type']) && !empty($_POST['name_contact_us']) && !empty($_POST['email_contact_us']) && !empty($_POST['contact_contact_us'])
      && !empty($_POST['qualification_contact_us']) && !empty($_POST['appliedfor_contact_us']) && !empty($_POST['experience_contact_us']) && $_SERVER['REQUEST_METHOD'] == 'POST'
    ) {
      $full_name = '';
      if (isset($_POST['name_contact_us']) && !empty($_POST['name_contact_us'])) {
        $full_name = trim($_POST['name_contact_us']);
      }

      $pagelink = '';
      if (isset($_POST['pagelink']) && !empty($_POST['pagelink'])) {
        $pagelink = trim($_POST['pagelink']);
      }

      $email = '';
      if (isset($_POST['email_contact_us']) && !empty($_POST['email_contact_us'])) {
        $email = trim($_POST['email_contact_us']);
      }

      $contact = '';
      if (isset($_POST['contact_contact_us']) && !empty($_POST['contact_contact_us'])) {
        $contact = trim($_POST['contact_contact_us']);
      }

      $qualification = '';
      if (isset($_POST['qualification_contact_us']) && !empty($_POST['qualification_contact_us'])) {
        $qualification = trim($_POST['qualification_contact_us']);
      }

      $appliedfor = '';
      if (isset($_POST['appliedfor_contact_us']) && !empty($_POST['appliedfor_contact_us'])) {
        $appliedfor = trim($_POST['appliedfor_contact_us']);
      }

      $experience = '';
      if (isset($_POST['experience_contact_us']) && !empty($_POST['experience_contact_us'])) {
        $experience = trim($_POST['experience_contact_us']);
      }

      $ip_address = $this->Common_model->get_client_ip();

      $userfile = $mail_userfile = '';

      if (isset($_FILES['userfile_contact_us']['name']) && !empty($_FILES['userfile_contact_us']['name']))
        $userfile = $_FILES['userfile_contact_us']['name'];
      if (!empty($userfile)) {
        $temp_var = explode(".", strtolower($userfile));
        $timage_ext = end($temp_var);

        $temp_name = 'RESUME-';
        if (!empty($full_name)) {
          $temp_full_name = str_replace(' ', '_', $full_name);
          $temp_name = ucwords($temp_full_name) . '-RESUME-';
        }
        // echo "UploadedFiles - " . _uploaded_files_;
        $main_img = $temp_name . $this->n_digit_random(4) . '.' . $timage_ext;
        // echo "main_img : $main_img";
        $target_folder_name = "career_resume";
        if (!is_dir(_uploaded_temp_files_ . $target_folder_name)) {
          mkdir(_uploaded_temp_files_ . './' . $target_folder_name, 0777, TRUE);

        }
        // move_uploaded_file($_FILES['userfile_contact_us']['tmp_name'], "E:/xampp/htdocs/xampp/MARS/steelagebuildingsystem/assets/uploads/" . $main_img);

        move_uploaded_file($_FILES['userfile_contact_us']['tmp_name'], _uploaded_temp_files_ . $target_folder_name . "/" . $main_img);
        //$mail_userfile = MAINSITE . $target_folder_name . "/" . $main_img;
        $mail_userfile = _uploaded_files_ . $target_folder_name . "/" . $main_img;
      }

      // $ip_address = $this->Common_model->get_client_ip();
      $date = date('D dS M, Y h:i a');

      $mailMessage = file_get_contents(APPPATH . 'mailer/career.html');
      $mailMessage = preg_replace('/\\\\/', '', $mailMessage); //Strip backslashes
      $mailMessage = str_replace("#enq_date#", stripslashes($date), $mailMessage);
      $mailMessage = str_replace("#name#", stripslashes($full_name), $mailMessage);
      $mailMessage = str_replace("#contact#", stripslashes($contact), $mailMessage);
      $mailMessage = str_replace("#qualification#", stripslashes($qualification), $mailMessage);
      $mailMessage = str_replace("#appliedfor#", stripslashes($appliedfor), $mailMessage);
      $mailMessage = str_replace("#experience#", stripslashes($experience), $mailMessage);
      $mailMessage = str_replace("#email#", stripslashes($email), $mailMessage);
      $mailMessage = str_replace("#ip_address#", stripslashes($ip_address), $mailMessage);
      $mailMessage = str_replace("#page_url#", stripslashes($pagelink), $mailMessage);
      $mailMessage = str_replace("#mainsite#", MAINSITE, $mailMessage);
      $mailMessage = str_replace("#company_name#", _project_complete_name_, $mailMessage);


      $to_name = $from_name = "Steel Age Building System";
      $subject = "New Inquiry From www.steelagebuildingsystem.com";
      if ($_POST['enq_type'] == 'careers') {
        $subject = "New Career Contact Inquiry - " . $from_name;
      }
      //$address = $from_email = "clientnoreply@webdesigncompanybangalore.com";
      $address = $from_email = "clientnoreply@webdesigncompanybangalore.com";
      $to = "abhishek.khandelwal82@gmail.com";
      // $to = "steelagebuildingsystem@gmail.com";





      $mailStatus = $this->Common_model->send_mail(
        array(
          "template" => $mailMessage,
          "subject" => $subject,
          "to" => "$to",
          "name" => $to_name,
          "attachment" => $main_img
        )
      );



      //exit;
      $_SESSION['is_thank_you_page'] = 1;
      $location = MAINSITE . 'thank-you';

      //header('Location: '.$location);
      //exit;
      echo "<script>location.href='thank-you'</script>";
      die();
    } else if (!empty($_POST['enq_type']) && !empty($_POST['name_contact_us']) && !empty($_POST['email_contact_us']) && !empty($_POST['contact_contact_us']) && !empty($_POST['message_contact_us']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
      //echo "2";
      if (isset($_POST['message_contact_us']) && !empty($_POST['message_contact_us'])) {
        if (preg_match('/http|www/i', $_POST['message_contact_us'])) {
          echo '<script language="javascript">';
          echo 'alert("Something Went Wrong! Please try again.")';
          echo '</script>';
          echo "<script>location.href='error'</script>";
          die();
        }
      }

      $full_name = '';
      if (isset($_POST['name_contact_us']) && !empty($_POST['name_contact_us'])) {
        $full_name = trim($_POST['name_contact_us']);
      }

      $pagelink = '';
      if (isset($_POST['pagelink']) && !empty($_POST['pagelink'])) {
        $pagelink = trim($_POST['pagelink']);
      }

      $email = '';
      if (isset($_POST['email_contact_us']) && !empty($_POST['email_contact_us'])) {
        $email = trim($_POST['email_contact_us']);
      }

      $contact = '';
      if (isset($_POST['contact_contact_us']) && !empty($_POST['contact_contact_us'])) {
        $contact = trim($_POST['contact_contact_us']);
      }

      $message = '';
      if (isset($_POST['message_contact_us']) && !empty($_POST['message_contact_us'])) {
        $message = trim($_POST['message_contact_us']);
      }
      $ip_address = $this->Common_model->get_client_ip();
      $date = date('D dS M, Y h:i a');

      $mailMessage = file_get_contents(APPPATH . 'mailer/enquiry.html');
      $mailMessage = preg_replace('/\\\\/', '', $mailMessage); //Strip backslashes
      $mailMessage = str_replace("#enq_date#", stripslashes($date), $mailMessage);
      $mailMessage = str_replace("#name#", stripslashes($full_name), $mailMessage);
      $mailMessage = str_replace("#contact#", stripslashes($contact), $mailMessage);
      $mailMessage = str_replace("#email#", stripslashes($email), $mailMessage);
      $mailMessage = str_replace("#ip_address#", stripslashes($ip_address), $mailMessage);
      $mailMessage = str_replace("#message#", stripslashes($message), $mailMessage);
      $mailMessage = str_replace("#page_url#", stripslashes($pagelink), $mailMessage);
      $mailMessage = str_replace("#mainsite#", MAINSITE, $mailMessage);
      $mailMessage = str_replace("#company_name#", _project_complete_name_, $mailMessage);


      $to_name = $from_name = "Steel Age Building System";
      $subject = "New Inquiry From www.steelagebuildingsystem.com";
      if ($_POST['enq_type'] == 'career') {
        $subject = "New Career Contact Inquiry - " . $from_name;
      }
      //$address = $from_email = "clientnoreply@webdesigncompanybangalore.com";
      $address = $from_email = "clientnoreply@webdesigncompanybangalore.com";
      $to = "abhishek.khandelwal82@gmail.com";
      // $to = "steelagebuildingsystem@gmail.com";


      $mailStatus = $this->Common_model->send_mail(array("template" => $mailMessage, "subject" => $subject, "to" => "$to", "name" => $to_name));
      //exit;
      $_SESSION['is_thank_you_page'] = 1;
      $location = MAINSITE . 'thank-you';

      //header('Location: '.$location);
      //exit;
      echo "<script>location.href='thank-you'</script>";
      die();
    } else {
      echo "<script>location.href='error'</script>";
      die();
    }






  }




  function n_digit_random($digits)
  {
    return rand(pow(10, $digits - 1) - 1, pow(10, $digits) - 1);
  }















  // public function testp()
  // {
  //   $this->data['meta_title'] = _project_name_ . " - TESTp";
  //   $this->data['meta_description'] = _project_name_ . " - TESTp";
  //   $this->data['meta_keywords'] = _project_name_ . " - TESTp";
  //   $this->data['meta_others'] = "";



  //   $this->load->view('testp', $this->data);
  // }
  // public function test1()
  // {
  //   $this->data['meta_title'] = _project_name_ . " - TEST";
  //   $this->data['meta_description'] = _project_name_ . " - TEST";
  //   $this->data['meta_keywords'] = _project_name_ . " - TEST";
  //   $this->data['meta_others'] = "";



  //   $this->load->view('test1', $this->data);
  // }
  // public function test2()
  // {
  //   $this->data['meta_title'] = _project_name_ . " - TEST";
  //   $this->data['meta_description'] = _project_name_ . " - TEST";
  //   $this->data['meta_keywords'] = _project_name_ . " - TEST";
  //   $this->data['meta_others'] = "";



  //   $this->load->view('test2', $this->data);
  // }
  // public function test3()
  // {
  //   $this->data['meta_title'] = _project_name_ . " - TEST";
  //   $this->data['meta_description'] = _project_name_ . " - TEST";
  //   $this->data['meta_keywords'] = _project_name_ . " - TEST";
  //   $this->data['meta_others'] = "";



  //   $this->load->view('test3', $this->data);
  // }















  public function clients()
  {
    $this->data['meta_title'] = _project_name_ . " - Clients";
    $this->data['meta_description'] = _project_name_ . " - Clients";
    $this->data['meta_keywords'] = _project_name_ . " - Clients";
    $this->data['meta_others'] = "";

    parent::get_header('header', $this->data);
    $this->load->view('clients', $this->data);
    parent::get_footer('footer', $this->data);
  }


  public function about_us()
  {
    $this->data['meta_title'] = _project_name_ . " - About Us";
    $this->data['meta_description'] = _project_name_ . " - About Us";
    $this->data['meta_keywords'] = _project_name_ . " - About Us";
    $this->data['meta_others'] = "";






    parent::get_header('header', $this->data);
    $this->load->view('about_us', $this->data);
    parent::get_footer('footer', $this->data);
  }





  public function contact_us()
  {

    $this->data['meta_title'] = _project_name_ . " - Contact Us";
    $this->data['meta_description'] = _project_name_ . " - Contact Us";
    $this->data['meta_keywords'] = _project_name_ . " - Contact Us";
    $this->data['meta_others'] = "";


    // $this->data['js'] = array('js/custom_parsley.js');//, 'js/all-scripts.js'
    // $this->data['direct_css'] = array('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');//, 'js/all-scripts.js'
    // $this->data['direct_js'] = array('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', );//, 'js/all-scripts.js'

    parent::get_header('header', $this->data);

    $this->load->view('contact_us', $this->data);

    parent::get_footer('footer', $this->data);
  }

  public function thank_you()
  {
    $this->data['meta_title'] = _project_name_ . " - Thank You";
    $this->data['meta_description'] = _project_name_ . " - Thank You";
    $this->data['meta_keywords'] = _project_name_ . " - Thank You";
    $this->data['meta_others'] = "";


    parent::get_header('header', $this->data);
    $this->load->view('thank_you', $this->data);
    parent::get_footer('footer', $this->data);
  }

  public function pageNotFound()
  {
    $this->data['meta_title'] = _project_name_ . " - Page Not Found";
    $this->data['meta_description'] = _project_name_ . " - Page Not Found";
    $this->data['meta_keywords'] = _project_name_ . " - Page Not Found";
    $this->data['meta_others'] = "";

    $this->load->view('pageNotFound', $this->data);
  }

  public function found404()
  {
    $this->data['meta_title'] = _project_name_ . " - 404 found";
    $this->data['meta_description'] = _project_name_ . " - 404 found";
    $this->data['meta_keywords'] = _project_name_ . " - 404 found";
    $this->data['meta_others'] = "";

    parent::get_header('header', $this->data);
    $this->load->view('404found', $this->data);
    parent::get_footer('footer', $this->data);
  }

  public function error()
  {
    $this->data['meta_title'] = _project_name_ . " - Error";
    $this->data['meta_description'] = _project_name_ . " - Error";
    $this->data['meta_keywords'] = _project_name_ . " - Error";
    $this->data['meta_others'] = "";

    parent::get_header('header', $this->data);
    $this->load->view('error', $this->data);
    parent::get_footer('footer', $this->data);
  }












}
