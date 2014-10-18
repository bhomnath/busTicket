<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        //$this->load->model('login_model');
        $this->load->model('dashboard_model');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url', 'date'));
       // $this->load->library("pagination", 'form_validation');
    }
    
    
    
    public function index(){
     $this->load->view('templates/bootstrap');
     
    }

        public function fromQuery(){
     
        $userPart = $_POST['userA'];
        $result = $this->dashboard_model->search_from($userPart) ;
     $list = array();
     foreach ($result as $finaldata)
     {
         $data= $finaldata->from;
         array_push($list, $data);
     }
     $query = array_unique($list);
     echo json_encode($query);
    }      
    
    public function toQuery(){
     
        $userPart = $_POST['userA'];
        $result = $this->dashboard_model->search_to($userPart) ;
     $list = array();
     foreach ($result as $finaldata)
     {
         $data= $finaldata->to;
         array_push($list, $data);
     }
     $query = array_unique($list);
     echo json_encode($query);
    } 
    
    
    public function showBuses()
    {
        if(isset($_POST['from']))
        {
        $from = $_POST['from'];
        }
         if(isset($_POST['to']))
         {
       $to = $_POST['to'];
         }
          if(isset($_POST['depDate']))
          {
        $depDate = $_POST['depDate'];
          }
        
         $data['abc']=array(
            'from' => $from,
            'to' => $to,
            'depDate' => $depDate);
        
        $data['busInfos']= $this->dashboard_model->get_bus_info_by_route($from, $to);
        
         $this->load->view('templates/busSearchresult', $data);
    }
    
     public function selectSeats()
	{
        if(isset($_POST['busId']))
        {
            $id= $_POST['busId'];
        }
        if(isset($_POST['from']))
        {
        $from = $_POST['from'];
        }
         if(isset($_POST['to']))
         {
       $to = $_POST['to'];
         }
          if(isset($_POST['depDate']))
          {
        $depDate = $_POST['depDate'];
          }
        
         $data['abc']=array(
            'from' => $from,
            'to' => $to,
            'depDate' => $depDate);

         $data['busInfo']= $this->dashboard_model->find_bus($id);
        
         $data['reservationInfo'] = $this->dashboard_model->get_booked_seats_info($id, $depDate);
         $arr ="";
         foreach ($data['reservationInfo'] as $reserved)
             {
         $arr .= $reserved->seats_numbers;  
            }
         $data['reservedRoom'] = explode(',', $arr);
        
		$this->load->view('templates/selectSeats', $data);
                
	
    }
    
    
    public function personalInfo()
	{
        if(isset($_POST['busId']))
        {
            $id= $_POST['busId'];
        }
        if(isset($_POST['busName']))
          {
            $busName = $_POST['busName'];
          }
        if(isset($_POST['from']))
        {
        $from = $_POST['from'];
        }
         if(isset($_POST['to']))
         {
       $to = $_POST['to'];
         }
          if(isset($_POST['depDate']))
          {
        $depDate = $_POST['depDate'];
          }
          if(isset($_POST['selected']))
          {
              $seats = $_POST['selected'];
          }
        
         $data['abc']=array(
            'from' => $from,
            'to' => $to,
            'depDate' => $depDate,
             'busName' => $busName,
             'busId' => $id,
             'seats' => $seats);   
        // $this->dashboard_model->add_new_booking_seats($seats, $id);
		$this->load->view('templates/personalInfo', $data);
            
    }
    
    public function thankYou()
                {
        if(isset($_POST['from']))
        {
            $from= $_POST['from'];
        }
        if(isset($_POST['to']))
        {
            $to= $_POST['to'];
        }
        if(isset($_POST['depDate']))
        {
            $depDate= $_POST['depDate'];
        }
        if(isset($_POST['busName']))
        {
            $busName= $_POST['busName'];
        }
        if(isset($_POST['busId']))
        {
            $busId= $_POST['busId'];
        }
        if(isset($_POST['seats']))
        {
            $seats= $_POST['seats'];
        }
        if(isset($_POST['name']))
        {
            $name= $_POST['name'];
        }
        if(isset($_POST['address']))
        {
            $address= $_POST['address'];
        }
        if(isset($_POST['email']))
        {
            $email= $_POST['email'];
        }
        if(isset($_POST['phone']))
        {
            $phone= $_POST['phone'];
        }
        if(isset($_POST['food']))
        {
            $food= $_POST['food'];
        }
        if(isset($_POST['remarks']))
        {
            $remarks= $_POST['remarks'];
        }
        $se = explode(',', $seats);
        $no = count($se);
        $no_of_seat = $no - "1";
        $user = $this->dashboard_model->get_user_by_bus_id($busId);
        foreach ($user as $users)
        {
            $user_id = $users-> user_id;
        }
         $this->dashboard_model->add_new_booking_seats($busId, $user_id, $no_of_seat, $seats,$from, $to, $depDate, $name, $address, $email, $phone,$food, $remarks);
         $this->bookingEmail($busName, $name, $from, $to, $depDate, $seats, $email);
       $this->load->view('templates/thankYou');
          }
    
    function bookingEmail($busName, $name, $from, $to, $depDate, $seats, $email){        
   $this->load->helper('email_helper');
   $subject = "Bus seats Booking Successful";
   $imglink = base_url() . "contents/images/logo.png";
   $message = seat_book_email($busName, $name, $from, $to, $depDate, $seats, $imglink);       
    send_seat_book_email($email,$subject,$message);      
 }
 
 public function addMsg()
 {
     if(isset($_POST['name']))
        {
            $name= $_POST['name'];
        }
        if(isset($_POST['email']))
        {
            $email= $_POST['email'];
        }
        if(isset($_POST['message']))
        {
            $msg= $_POST['message'];
        }
        $this->dashboard_model->add_new_query($name, $email, $msg);
        echo 'Thank you for your message !';
 }
 
    
 
 
 
}