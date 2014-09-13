<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function add_new_bus($busName, $busNumber, $from, $fromTime, $to, $toTime, $route, $seats, $image, $user_id) {
        $data = array(
            'bus_name' => $busName,
            'bus_number' => $busNumber,
            'from' => $from,
            'from_time' => $fromTime,
            'to' => $to,
            'to_time' => $toTime,
            'route' => $route,
            'total_seats' => $seats,
            'image'=> $image,
            'user_id'=> $user_id);

        $this->db->insert('bus_info', $data);
    }
    
    public function get_all_buses_of_user($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('bus_info');
        return $query->result();
    }
    
    public function find_bus($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('bus_info');
        return $query->result();
    }
    
    public function delete_bus($id) {

        $this->db->delete('bus_info', array('id' => $id));
    }
    
    public function add_new_booking_seats($seats, $id)
    {
        $seat = trim($seats);
        $data = array(
            'bus_id' => $id,
            'seats_numbers' => $seat);

        $this->db->insert('reservation_info', $data);
    }
    
    public function get_booked_seats_info($id)
    {
        $this->db->where('bus_id', $id);
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    
    function search($value){
        $this->db->like('from', $value);
        $this->db->or_like('to', $value);
        $this->db->or_like('route', $value);
       $result = $this->db->get('bus_info'); 
       return $result->result();      
    }
    
    public function get_bus_info_by_route($from, $to)
    {
         $this->db->where('from', $from);
         $this->db->where('to', $to);
        $query = $this->db->get('bus_info');
        return $query->result();
    }
}