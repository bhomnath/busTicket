<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class prtscreen extends CI_Controller {
    
    
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
    
    
    public function printTicket($id=null)
    {
        $data['bookingInfo'] = $this->dashboard_model->get_booking_info_by_id($id);
       $this->load->view('printTemplates/ticketPrtView', $data);
    }
    
     public function printChhalan($id=null, $mth=null, $day=null, $yr=null)
    {
         if(isset($id))
         {
             $busId = $id;
         }
         if(isset($mth))
         {
             $month= $mth;
         }if(isset($day))
         {
             $days = $day;
         }if(isset($yr))
         {
             $year = $yr;
         }
         $date = $month.'/'.$days.'/'.$year;
         $data['bookingInfoC'] = $this->dashboard_model->get_booking_info_by_date_bus_id($busId, $date);
        $this->load->view('printTemplates/chhalanPrtView', $data);
    }
    
}