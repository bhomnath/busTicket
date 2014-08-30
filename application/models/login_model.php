<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
     function validate_user($email, $pass) {
    $password=md5($pass);
        $this->db->where('email',$email );
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
    
    
    
}