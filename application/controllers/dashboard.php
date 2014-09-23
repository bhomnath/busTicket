<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library("pagination", 'form_validation');
    }
    
    public function index()
	{
         if ($this->session->userdata('logged_in')) {
		$this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                
	}else {

            redirect('login', 'refresh');
        }
    }
    
    public function addbus()
    {
     if ($this->session->userdata('logged_in')) {  
         
                $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/addBus');
         
     }else {

            redirect('login', 'refresh');
        }
    }
    
    public function addNewBus()
      {
     if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
          
         $this->load->library('form_validation');
         
                $config['upload_path'] = './contents/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
                $this->load->library('upload', $config);
        $this->form_validation->set_rules('busname', 'Bus name', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{5,35}$/]|required|xss_clean');
         $this->form_validation->set_rules('busnumber', 'Bus number', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{5,35}$/]|required|xss_clean');
        $this->form_validation->set_rules('from', 'From', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{5,35}$/]|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{5,35}$/]|required|xss_clean');
         $this->form_validation->set_rules('route', 'Route', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{5,35}$/]|required|xss_clean');
          $this->form_validation->set_rules('seats', 'Seats', 'trim|regex_match[/^[a-z,0-9,A-Z _-]{2,35}$/]|required|xss_clean');
          $this->form_validation->set_rules('price', 'Price', 'trim|regex_match[/^[0-9]{2,4}$/]|required|xss_clean');
        if (($this->form_validation->run() == FALSE) || (!$this->upload->do_upload('file_name'))) {
            $data['error'] = $this->upload->display_errors();
                $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/addBus', $data);
        } else { 
               $data = array('upload_data' => $this->upload->data('file'));
                $image = $data['upload_data']['file_name'];
               $busName = $this->input->post('busname');
               $busNumber = $this->input->post('busnumber');
               $from = $this->input->post('from');
               $fromTime = $this->input->post('fromTime');
               $to = $this->input->post('to');
               $toTime = $this->input->post('toTime');
               $route = $this->input->post('route');
               $seats = $this->input->post('seats');
               $price = $this->input->post('price');
             
             $this->dashboard_model->add_new_bus($busName, $busNumber, $from,$fromTime, $to, $toTime, $route, $seats,$price, $image, $user_id);  
              $this->session->set_flashdata('message', 'Data sucessfully Added');
               redirect('dashboard/busInfo', 'refresh');
     }}else {

            redirect('login', 'refresh');
        }
    }
          
    
    public function busInfo()
    {
         if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            
            $data['buses'] = $this->dashboard_model->get_all_buses_of_user($user_id);
            
            $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/viewBus', $data);
            
            
            }else {

            redirect('login', 'refresh');
        }
    }
    
    
    function edit($busid) {
       if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            $data['buses'] = $this->dashboard_model->find_bus($busid);


            $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/editBus', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
    
    
     public function delete($id) {
       if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            $this->dashboard_model->delete_bus($id);
            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
            redirect('dashboard/busInfo', 'refresh');
        } else {
            redirect('login', 'refresh');
        }
    }
        
    
      public function bookingInfo()
    {
         if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            
             /* for pagination */
            $config = array();
            $config["base_url"] = base_url() . "index.php/dashboard/bookingInfo";
            $config["total_rows"] = $this->dashboard_model->record_count_all_booking_info($user_id);
            $config["per_page"] = 6;
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $config["num_links"] = $config["total_rows"] / $config["per_page"];
            $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
            $config['full_tag_close'] = '</ul>';
            $config['prev_link'] = 'First';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="current"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['first_link'] = '&lt;&lt;';
            $config['last_link'] = '&gt;&gt;';
            $this->pagination->initialize($config);
            /* pagination ends here */
  $data['bookingInfo'] = $this->dashboard_model->get_booking_info($config["per_page"], $page, $user_id);
  $config['display_pages'] = FALSE;
            $data["links"] = $this->pagination->create_links();
            
            $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/viewBooking', $data);
            }else {
            redirect('login', 'refresh');
        }
    }
    
    public function searchBooking()
    {
        if(isset($_POST['busNo']))
        {
        $busNo = $_POST['busNo'];
        }
         if(isset($_POST['depDate']))
         {
       $depDate = $_POST['depDate'];
         }
         die('here');
    }

        public function newBooking()
    {
         if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
            $this->load->view('dashboardPages/newBooking');
            }else {
            redirect('login', 'refresh');
        }
    }
    
    public function busNoQuery(){
     
       $userPart = $_POST['userA']; 
        $result = $this->dashboard_model->search_bus_by_number($userPart) ;
     $list = array();
     foreach ($result as $finaldata)
     {
         $data= $finaldata->bus_number;
         array_push($list, $data);
     }
     echo json_encode($list);
    }    
    
    public function selectSeatsDas()
    {
         if(isset($_POST['busNo']))
        {
        $busNo = $_POST['busNo'];
        }
         if(isset($_POST['depDate']))
         {
       $depDate = $_POST['depDate'];
         }
         
         $data['busInfo']= $this->dashboard_model->find_bus_by_number($busNo);
         if(!empty($data['busInfo'])){
             foreach ($data['busInfo'] as $buses){
                 $id= $buses->Id;
             }
         }
         
         $data['reservationInfo'] = $this->dashboard_model->get_booked_seats_info($id, $depDate);
         $arr ="";
         foreach ($data['reservationInfo'] as $reserved)
             {
         $arr .= $reserved->seats_numbers;  
            }
         $data['reservedRoom'] = explode(',', $arr); 
          
         $this->load->view('dashboardPages/dashSelectSeats', $data);
          
    }
    
     public function bookNow()
	{
        
        if(isset($_POST['busNo']))
        {
            $busNo= $_POST['busNo'];
        }
          if(isset($_POST['depDate']))
          {
        $depDate = $_POST['depDate'];
          }
          if(isset($_POST['seats']))
          {
              $seats = $_POST['seats'];
          }
          if(isset($_POST['name']))
        {
            $name= $_POST['name'];
        }
          if(isset($_POST['address']))
          {
        $address = $_POST['address'];
          }
          if(isset($_POST['email']))
          {
              $email = $_POST['email'];
          }
          if(isset($_POST['phone']))
          {
              $phone = $_POST['phone'];
          }
        if(isset($_POST['remarks']))
        {
            $remarks= $_POST['remarks'];
        }
        $busss= $this->dashboard_model->find_bus_by_number($busNo);
        foreach ($busss as $busInfo){
            $busId = $busInfo->Id;
            $busName = $busInfo->bus_name;
            $from = $busInfo->from;
            $to = $busInfo->to;
        }
         
        $this->dashboard_model->add_new_booking_seats($busId, $seats,$from, $to, $depDate, $name, $address, $email, $phone, $remarks);
        $this->bookingEmail($busName, $name, $from, $to, $depDate, $seats, $email);
        $this->load->view('dashboardPages/thankYou');
            
    }
    
    function bookingEmail($busName, $name, $from, $to, $depDate, $seats, $email){        
   $this->load->helper('email_helper');
   $subject = "Bus seats Booking Successful";
   $imglink = base_url() . "contents/images/logo.png";
   $message = seat_book_email($busName, $name, $from, $to, $depDate, $seats, $imglink);       
    send_seat_book_email($email,$subject,$message);      
 }
    
    public function viewChhalan()
    {
         if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
             $data['busInfo'] = $this->dashboard_model->get_all_buses_of_user($user_id);
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
            $this->load->view('dashboardPages/chhalanSelect', $data);
            }else {
            redirect('login', 'refresh');
        }
    }
    
    public function showChhalan()
    {
        if(isset($_POST['busNo']))
        {
        $busNo = $_POST['busNo'];
        }
         if(isset($_POST['depDate']))
         {
       $depDate = $_POST['depDate'];
         }
         $busInfo = $this->dashboard_model->find_bus_by_number($busNo);
         foreach ($busInfo as $datas)
         {
             $busId = $datas->Id;
         }
         $data['bookingInfoC'] = $this->dashboard_model->get_booking_info_by_date_bus_id($busId, $depDate);
         $this->load->view('dashboardPages/viewChhalan', $data);
    }
    
    function pagination() {
        if ($this->session->userdata('logged_in')) {
            $user_id = $_POST['id'];
            $page = $_GET['page'];
            $per_page = 9;
            $start = ($page - 1) * $per_page;
           $data['bookingInfo'] = $this->dashboard_model->get_booking_info($per_page, $start, $user_id);
           
            $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/viewBooking', $data);
        } else {
            redirect('login', 'refresh');
        }
    }
    
        
}