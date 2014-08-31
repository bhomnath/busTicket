<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_model');
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
    
    public function addNew()
    {
     if ($this->session->userdata('logged_in')) {  
         
                $this->load->view('dashboard/header');
                $this->load->view('dashboard/sideNavigation');
                $this->load->view('pages/addBus');
         
     }else {

            redirect('login', 'refresh');
        }
    }
    
        
        
        
}