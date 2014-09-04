<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {
    
    
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
    
     public function addSeats()
	{
         $seats = $_POST['selected'];       
         $id= "1";
       
         $this->dashboard_model->add_new_booking_seats($seats, $id);
         var_dump($seats);
        // echo 'inserted';
		//$this->load->view('templates/header');
               // $this->load->view('dashboard/sideNavigation');
                
	
    }
    
    
    
    
    
    
    
}