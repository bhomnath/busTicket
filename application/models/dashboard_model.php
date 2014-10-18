<?php

class Dashboard_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }
    
    public function add_new_bus($busName, $busNumber, $from, $fromTime, $to, $toTime, $route, $seats,$price, $image, $user_id, $busType) {
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
            'user_id'=> $user_id,
            'bus_type' => $busType);

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
    public function get_user_by_bus_id($busId)
    {
         $this->db->where('Id', $busId);
        $query = $this->db->get('bus_info');
        return $query->result();
    }

        public function delete_bus($id) {

        $this->db->delete('bus_info', array('id' => $id));
    }
    public function delete_booking_id($id, $user_id) {
         $data = array(
            'booking_status' => "Deleted");
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update('reservation_info', $data);
    }
    public function update_booking_price_status_amt_given($user_id, $id, $payment, $amtGiven, $amtRet, $return)
    {
        $data = array(
            'payment_status' => $payment,
            'amount_paid' => $amtGiven,
            'return_status' => $return);
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->update('reservation_info', $data);
    }

    public function add_new_booking_seats($busId, $user_id, $no_of_seat, $seats,$from, $to, $depDate, $name, $address, $email, $phone,$food, $remarks)
    {
        $seat = trim($seats);
        $data = array(
            'bus_id' => $busId,
            'user_id' => $user_id,
            'no_of_seats' => $no_of_seat,
            'seats_numbers' => $seat,
            'departing_from' => $from,
            'departing_to' => $to,
            'depart_date' => $depDate,
            'Booking_person_name' => $name,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'payment_status' => 'Not Paid',
            'food' => $food,
            'booking_status' => 'Active',
            'remarks' => $remarks);

        $this->db->insert('reservation_info', $data);
    }
    
    public function add_new_booking_seats_dashboard($busId,$user_id, $no_of_seat, $seats,$from, $to, $depDate, $name, $address, $email, $phone, $remarks, $payment, $amtPaid, $retStat, $food)
    {
        $seat = trim($seats);
        $data = array(
            'bus_id' => $busId,
            'user_id' => $user_id,
            'no_of_seats' => $no_of_seat,
            'seats_numbers' => $seats,
            'departing_from' => $from,
            'departing_to' => $to,
            'depart_date' => $depDate,
            'Booking_person_name' => $name,
            'address' => $address,
            'email' => $email,
            'phone' => $phone,
            'payment_status' => $payment,
            'amount_paid' => $amtPaid,
            'return_status' => $retStat,
            'food' => $food,
            'booking_status' => 'Active',
            'remarks' => $remarks);

        $this->db->insert('reservation_info', $data);
    }
    
    public function get_booking_info_by_user_id_and_booking_id($id, $user_id)
    {
        $this->db->where('Id', $id);
        $this->db->where('user_id', $user_id);
        $this->db->where('booking_status', 'Active');
        $query = $this->db->get('reservation_info');
        return $query->result();
    }

    public function get_all_passengers_list()
    {
         $this->db->where('booking_status', 'Active');
        $query = $this->db->get('reservation_info');
        return $query->result();
    }

    

    public function get_booked_seats_info($id, $depDate)
    {
        $this->db->where('bus_id', $id);
        $this->db->where('depart_date', $depDate);
        $this->db->where('booking_status', 'Active');
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
    
    public function get_booking_info($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('booking_status', 'Active');
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    
    public function record_count_all_booking_info($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('booking_status', 'Active');
        $this->db->from("reservation_info");
        return $this->db->count_all_results();
    }

        public function get_booking_info_by_id($id)
    {
         $this->db->where('Id', $id);
         $this->db->where('booking_status', 'Active');
        $query = $this->db->get('reservation_info');
        return $query->result();
    }
    public function get_booking_info_by_date_bus_id($busId, $depDate)
    {
        $this->db->where('bus_id', $busId);
        $this->db->where('depart_date', $depDate);
        $this->db->where('booking_status', 'Active');
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
    
    public function add_new_query($name, $email, $msg)
    {
         $data = array(
            'name' => $name,
            'email' => $email,
            'message' => $msg);

        $this->db->insert('message', $data);
    }
    
    public function get_all_query()
    {
        $query = $this->db->get('message');
        return $query->result();
    }
    public function delete_query_msg($id) {
        $this->db->where('Id', $id);
        $this->db->delete('message');
    }
    
    
    
    
    
}