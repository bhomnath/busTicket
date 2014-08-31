<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
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
		$this->load->view('login/loginForm');
	}
    
        
    public function register() {
       $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|regex_match[/^[a-z,0-9,A-Z _]{5,35}$/]|required|xss_clean');
         $this->form_validation->set_rules('name', 'Full name', 'trim|regex_match[/^[a-z,0-9,A-Z _]{5,35}$/]|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|regex_match[/^[a-z,0-9,A-Z]{5,35}$/]|required|matches[re_pass]|xss_clean');
         $this->form_validation->set_rules('re_pass', 'Re-Password', 'trim|regex_match[/^[a-z,0-9,A-Z]{5,35}$/]|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
           $this->load->view('login/loginForm');
        } else {
             if (isset($_POST['username'])){
            $uname= trim($_POST['username']);}
            
            if (isset($_POST['email'])) {
                $email = trim($_POST['email']);  
            }
            
            $userEmail = $this->login_model->check_user($email, $uname);
           
            
            if (!empty($userEmail)) {
                $data['validation_message'] = "Sorry! User Name or Email already exsists.";

           $this->load->view('login/loginForm', $data);
            } 
           
        else {
       
            $username = $this->input->post('username');
            $fullname = $this->input->post('name');
            $email = $this->input->post('email');
            $pass = $this->input->post('pass');
            

          
            

            $this->login_model->add_new_user($username, $fullname, $email, $pass);
            
             $data = array(
                    'useremail' => $email,
                    'username' => $username,
                    'logged_in' => true);
                $this->session->set_userdata($data);
           // $this->registerEmail($email, $username);
            redirect('login/index');
        } }
    }  
    
    
    
    
    function logout() {
        if ($this->session->userdata('logged_in')) {
           
        $this->session->sess_destroy();
        $this->index();
        redirect('login/index', 'refresh');
    } else {
            redirect('login/index');
        }
    }
    
    
    public function authenticate() {
            $this->load->library('form_validation');
        $this->form_validation->set_rules('userName', 'Username', 'trim|regex_match[/^[a-z,0-9,A-Z]{5,35}$/]|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|regex_match[/^[a-z,0-9,A-Z]{5,35}$/]|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
           $this->load->view('login/loginForm');
        } else {
            $username= $this->input->post('userName');
            $pass = $this->input->post('pass');
            
           $query = $this->login_model->validate_user($username, $pass);

            if (!empty($query)) { // if the user's credentials validated...
                foreach ($query as $users) {
                    $userName = $users->user_name;
                }
                $data = array(
                    'useremail' => $email,
                    'username' => $userName,
                    'logged_in' => true);

                $this->session->set_userdata($data);
                
                    redirect('dashboard/index');
                }
             else { // incorrect username or password

                $this->session->set_flashdata('message', 'Username or password incorrect');

                redirect('login', 'refresh');
            }
        }
    }

    
    
    
    
}