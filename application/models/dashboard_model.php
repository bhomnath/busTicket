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
        $data = array(
            'bus_id' => $id,
            'seats_numbers' => $seats);

        $this->db->insert('reservation_info', $data);
    }
    
    
    
    
}