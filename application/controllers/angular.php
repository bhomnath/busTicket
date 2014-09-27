<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angular extends CI_Controller {
    
    
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
        $this->load->view('dashboardPages/angularjs');
    }
    
    public function getData()
    {
        $passengers = $this->dashboard_model->get_all_passengers_list();
        $json_response = json_encode($passengers);
       
      echo $json_response; 
//$DB_HOST = '127.0.0.1';
//$DB_USER = 'root';
//$DB_PASS = '';
//$DB_NAME = 'bussewa';
//$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
//
//$query="select distinct c.customerName, c.addressLine1, c.city, c.state, c.postalCode, c.country, c.creditLimit from customers c order by c.customerNumber";
//$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
//
//$arr = array();
//if($result->num_rows > 0) {
//	while($row = $result->fetch_assoc()) {
//		$arr[] = $row;	
//	}
//}
//var_dump($arr);
//# JSON-encode the response
//$json_response = json_encode($arr);
//// # Return the response
//echo $json_response;

    }
    



    
    
    
    
    
    
    
    
    
}