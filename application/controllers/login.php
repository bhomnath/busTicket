<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library("pagination");
    }
    
    public function index()
	{
		$this->load->view('login/loginForm');
	}
    
        
    public function register() {
       
            
       
            $user_name = $this->input->post('userName');
            $userfname = $this->input->post('userFirstName');
            $userlname = $this->input->post('userLastName');
            $useremail = $this->input->post('userEmail');
            

            $userpass = $this->input->post('userPass');
            $loginStatus = "Registered";
            $loginDate = "Not logged in till";
            

            $this->dbmodel->add_new_user($user_name, $userfname, $userlname, $useremail, $userpass, $loginStatus, $loginDate);
            
             $data = array(
                    'useremail' => $useremail,
                    'username' => $user_name,
                    'logged_in' => true);
                $this->session->set_userdata($data);
            $this->registerEmail($useremail, $user_name);
            redirect('login/index');
       
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
        var_dump($_POST['username']);
        die('');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('userEmail', 'User Email', 'trim|regex_match[/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/]|required|xss_clean');
        $this->form_validation->set_rules('userPass', 'Password', 'trim|regex_match[/^[a-z,0-9,A-Z]{5,35}$/]|required|xss_clean|callback_check_database');
        if ($this->form_validation->run() == FALSE) {
           $this->load->view('template/header');
            $this->load->view('login/login');
            $this->load->view('template/reservation_template');
            $this->load->view('template/footer');
        } else {
            $email= $this->input->post('userEmail');
            $pass = $this->input->post('userPass'); 
           $query = $this->dbmodel->validate_user($email, $pass);

            if (!empty($query)) { // if the user's credentials validated...
                foreach ($query as $users) {
                    $userName = $users->user_name;
                }
                $data = array(
                    'useremail' => $email,
                    'username' => $userName,
                    'logged_in' => true);

                $this->session->set_userdata($data);
                $useremail = $this->session->userdata('useremail');
                $user = $this->dbmodel->get_user_info($useremail);
                foreach ($user as $id) {
                    $user_id = $id->login_status;
                    $user_email = $id->user_email;
                }
                if ($user_id == "Registered") {
                    $this->load->view('template/header');
                    $this->load->view('template/welcomeMessage');
                    $this->load->view('template/imageDiv');
                    $this->load->view('template/reservation_template');
                    $this->load->view('template/footer');
                    $loginStatus = 'Logged In';

                    $this->dbmodel->update_Registered_user_status($user_email, $loginStatus);
                } else {
                    $user = $this->dbmodel->get_user_info($userName);
                    foreach ($user as $id) {
                        $user_id = $id->login_status;
                        $user_email = $id->user_email;
                    }
                    if ($user_id == "Logged Out") {

                        $loginStatus = 'Logged In';
                        $this->dbmodel->update_LoggedIn_user_status($user_email, $loginStatus);
                    }
                    redirect('dashboard/index');
                }
            } else { // incorrect username or password

                $this->session->set_flashdata('message', 'Username or password incorrect');

                redirect('login/loginForm');
            }
        }
    }

    
    
    
    
}