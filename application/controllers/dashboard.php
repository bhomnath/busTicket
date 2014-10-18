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
               $busType = $this->input->post('busType');
            
             $this->dashboard_model->add_new_bus($busName, $busNumber, $from,$fromTime, $to, $toTime, $route, $seats,$price, $image, $user_id, $busType);  
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
    
    
    function editBus($busid=NULL) {
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
    
    
    
     public function deleteBus($id=NULL) {
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
  $data['bookingInfo'] = $this->dashboard_model->get_booking_info($user_id);
   $data['buses'] = $this->dashboard_model->get_all_buses_of_user($user_id);
            $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('dashboardPages/viewBooking', $data);
            }else {
            redirect('login', 'refresh');
        }
    }
    
    public function getBookingInfo()
    {if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            
           $DB_HOST = '127.0.0.1';
$DB_USER = 'root';
$DB_PASS = '';
$DB_NAME = 'bussewa';
$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME); 
 
//$query="select * from reservation_info as A inner join bus_info as B on A.bus_id = B.Id";
$query = 'SELECT a.Id, a.bus_id, a.user_id, a.no_of_seats, a.seats_numbers, a.departing_from, a.departing_to, a.depart_date, a.Booking_person_name, a.address, a.email, a.phone, a.remarks, a.payment_status, a.amount_paid, a.return_status, a.booking_status, b.bus_name, b.bus_number, b.price_per_seat
        FROM reservation_info a, bus_info b
        WHERE a.bus_id = b.Id';
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
$json_response = json_encode($arr);

// # Return the response
echo $json_response;

        }else {
            redirect('login', 'refresh');
        }
    }

    public function editBooking($id=NULL)
    {
        if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $ids) {
                $user_id = $ids->Id;
            }
            $data['bookingInfo'] = $this->dashboard_model->get_booking_info_by_user_id_and_booking_id($id, $user_id);
          
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
             $this->load->view('dashboardPages/editBooking', $data);
            
            }else {
            redirect('login', 'refresh');
        }
    }
    
    public function updateBooking()
    {
         if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $ids) {
                $user_id = $ids->Id;
            }
       $id= $this->input->post('bookingId'); 
      $data['bookingInfo'] = $this->dashboard_model->get_booking_info_by_user_id_and_booking_id($id, $user_id);
      if(!empty($data['bookingInfo'])){
        foreach ($data['bookingInfo'] as $booker){
       $id = $booker->Id;
      $busId = $booker->bus_id; }}
      
      $payment = $this->input->post('payment'); 
      $amtGiven = $this->input->post('amtPaid');
      $amtRet = $this->input->post('amtToRet');
       $return = $this->input->post('return');
       
       if($payment==null){
           $data['error']="Please select paid or not paid";
          $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
             $this->load->view('dashboardPages/editBooking', $data);
       }
       else{
       if(($amtGiven==null || $amtGiven=="" || $return==null) && $payment=="Paid"){
           $data['error']="Please fill amount given and select returned or not paid";
          $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
             $this->load->view('dashboardPages/editBooking', $data);
       }
       else{    
           $this->dashboard_model->update_booking_price_status_amt_given($user_id, $id, $payment, $amtGiven, $amtRet, $return); 
            $this->session->set_flashdata('message', 'Data Updated Sucessfully');
            redirect('dashboard/bookingInfo', 'refresh');
       }}
         }else {
            redirect('login', 'refresh');
        }
    }
    
    public function deleteBooking($id=NULL)
    {
        if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $ids) {
                $user_id = $ids->Id;
            }
          $this->dashboard_model->delete_booking_id($id, $user_id);
            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
            redirect('dashboard/bookingInfo', 'refresh');    
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
        if(isset($_POST['payment']))
        {
            $payment= $_POST['payment'];
        }
        if(isset($_POST['amtPaid']))
        {
            $amtPaid= $_POST['amtPaid'];
        }
        if(isset($_POST['retStat']))
        {
            $retStat= $_POST['retStat'];
        }
        if(isset($_POST['food']))
        {
            $food= $_POST['food'];
        }
        $busss= $this->dashboard_model->find_bus_by_number($busNo);
        foreach ($busss as $busInfo){
            $busId = $busInfo->Id;
            $busName = $busInfo->bus_name;
            $from = $busInfo->from;
            $to = $busInfo->to;
            $user_id = $busInfo->user_id;
        }
        $se = explode(',', $seats);
        $no = count($se);
        $no_of_seat = $no - "1";
        $this->dashboard_model->add_new_booking_seats_dashboard($busId,$user_id, $no_of_seat, $seats,$from, $to, $depDate, $name, $address, $email, $phone, $remarks, $payment, $amtPaid, $retStat, $food);
        $this->bookingEmail($busName, $name, $from, $to, $depDate, $seats, $email);
       $this->session->set_flashdata('message', 'Booking Added Sucessfully');
            redirect('dashboard/bookingInfo', 'refresh'); 
            
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
    
    public function viewQuery()
    {
        if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }
            $data['query'] = $this->dashboard_model->get_all_query();
             $this->load->view('dashboard/header');
            $this->load->view('dashboard/sideNavigation');
            $this->load->view('dashboardPages/queryList', $data);
            }else {
            redirect('login', 'refresh');
        } 
        }
    
        public function deleteMsg($id=NULL)
        {
            if ($this->session->userdata('logged_in')) {
         $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $ids) {
                $user_id = $ids->Id;
            }
           $this->dashboard_model->delete_query_msg($id);
            $this->session->set_flashdata('message', 'Data Deleted Sucessfully');
            redirect('dashboard/viewQuery', 'refresh'); 
            }else {
            redirect('login', 'refresh');
        }  
        }
}