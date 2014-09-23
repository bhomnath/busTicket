<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function add_new_bus($busName, $busNumber, $from, $fromTime, $to, $toTime, $route, $seats,$price, $image, $user_id) {
        $data = array(
            'bus_name' => $busName,
            'bus_number' => $busNumber,
            'from' => $from,
            'from_time' => $fromTime,
            'to' => $to,
            'to_time' => $toTime,
            'route' => $route,
            'total_seats' => $seats,
            'price_per_seat' => $price,
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
    
    public function add_new_booking_seats($busId, $seats,$from, $to, $depDate, $name, $address, $email, $phone, $remarks)
    {
        $seat = trim($seats);
        $data = array(
            'bus_id' => $busId,
            'seats_numbers' => $seat,
            'departing_from' => $from,
            'departing_to' => $to,
            'depart_date' => $depDate,
            'Booking_person_name' => $name,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'remarks' => $remarks);

        $this->db->insert('reservation_info', $data);
    }
    
    public function get_booked_seats_info($id, $depDate)
    {
        $this->db->where('bus_id', $id);
        $this->db->where('depart_date', $depDate);
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    
    function search_from($value){
        $this->db->like('from', $value);
       $result = $this->db->get('bus_info'); 
       return $result->result();      
    }
    function search_to($value){
        $this->db->like('to', $value);
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
    
    public function get_booking_info($per_page, $start, $user_id)
    {
         $this->db->limit($per_page, $start);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    
    public function record_count_all_booking_info($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->from("reservation_info");
        return $this->db->count_all_results();
    }

        public function get_booking_info_by_id($id)
    {
         $this->db->where('Id', $id);
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    public function get_booking_info_by_date_bus_id($busId, $depDate)
    {
        $this->db->where('bus_id', $busId);
        $this->db->where('depart_date', $depDate);
        $query = $this->db->get('reservation_info');
        return $query->result();
    }

    public function search_bus_by_number($userPart)
    {
        $this->db->like('bus_number', $userPart);
       $result = $this->db->get('bus_info'); 
       return $result->result();     
    }
    
    public function find_bus_by_number($busNo) {
        $this->db->where('bus_number', $busNo);
        $query = $this->db->get('bus_info');
        return $query->result();
    }
}