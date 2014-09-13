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
    
     public function index()
	{
         $id= "1";

         $data['busInfo']= $this->dashboard_model->find_bus($id);
        
         $data['reservationInfo'] = $this->dashboard_model->get_booked_seats_info($id);
         $arr ="";
         foreach ($data['reservationInfo'] as $reserved)
             {
         $arr .= $reserved->seats_numbers;  
            }
         $data['reservedRoom'] = explode(',', $arr);
         
         $data['json'] = json_encode($data['reservationInfo']);
       
		$this->load->view('templates/header', $data);
                
	
    }
    
    public function homea(){
        $this->load->view('templates/new');
    }

        public function fromQuery(){
     
        $userPart = $_POST['userA'];
        $result = $this->dashboard_model->search($userPart) ;
     $list = array();
     foreach ($result as $finaldata)
     {
         $data= $finaldata->from;
         array_push($list, $data);
     }
     echo json_encode($list);
    }      
    
    public function toQuery(){
     
        $userPart = $_POST['userA'];
        $result = $this->dashboard_model->search($userPart) ;
     $list = array();
     foreach ($result as $finaldata)
     {
         $data= $finaldata->to;
         array_push($list, $data);
     }
     echo json_encode($list);
    } 
    
    
    public function showBuses()
    {
       // $from = $_POST['from'];
       // $to = $_POST['to'];
       // $depDate = $_POST['depDate'];
        
        $from="kathmandu";
        $to="pokhara";
        $depDate="2014-09-12";
        
        $data['busInfos']= $this->dashboard_model->get_bus_info_by_route($from, $to);
        
         $this->load->view('templates/busSearchresult', $data);
    }
    
    
    
}