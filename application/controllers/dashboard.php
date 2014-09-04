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
             
             $this->dashboard_model->add_new_bus($busName, $busNumber, $from,$fromTime, $to, $toTime, $route, $seats, $image, $user_id);  
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
        
        
}