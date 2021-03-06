<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     function validate_user($username, $pass) {
    $password=md5($pass);
        $this->db->where('user_name',$username );
        $this->db->where('password', $password);
        
        $query = $this->db->get('user_info');
        return $query->result();
    }
    
    public function check_user($email, $uname){
        $this->db->where('email', $email );
        $this->db->or_where('user_name', $uname);
        $query = $this->db->get('user_info');
        return $query->result();
    }
    
      public function add_new_user($username, $fullname, $email, $pass){
           $password=md5($pass);
        $data = array(
            'user_name' => $username,
            'full_name'=> $fullname,
            
            'email'=> $email,
            'password'=> $password);
        
         $this->db->insert('user_info', $data);
    }
    
     public function get_user_info($useremail){
      $this->db->where('email', $useremail);
        $query = $this->db->get('user_info');
        return $query->result();
 }
    
}