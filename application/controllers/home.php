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
        // $data['reservationInfo'] = $this->dashboard_model->get_booked_seats_info($id);
         
		$this->load->view('templates/header', $data);
               // $this->load->view('dashboard/sideNavigation');
                
	
    }
    
    
    
    
    
    
    
}