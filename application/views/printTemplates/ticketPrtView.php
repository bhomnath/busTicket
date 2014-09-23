<?php if(!empty($bookingInfo)){
 foreach ($bookingInfo as $bookingP)
 {
     $name = $bookingP->Booking_person_name;
     $address = $bookingP->address;
     $seats = $bookingP->seats_numbers;
      $result = count(explode(',',$seats));
       $noOfSeats = $result - 1;
     $from = $bookingP->departing_from;
     $to = $bookingP->departing_to;
     $date = $bookingP->depart_date;
     $phone = $bookingP->phone;
     $busId = $bookingP->bus_id;
 }
  $busdata = $this->dashboard_model->find_bus($busId);
  foreach ($busdata as $busin)
  {
      $busname = $busin->bus_name;
      $busNumber = $busin->bus_number;
      $pricePseat = $busin->price_per_seat;
  }
}
?>


<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;" >
        <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px; alignment-adjust: central; background-color: #ccc; margin: 0 auto 0 auto;">
            <img src="<?php echo base_url().'contents/images/logo.png' ?>" alt="Bus Sewa" style="height:50px; width:50px; margin:10px;"/>

            </div>

   <div style="padding: 10px 20px 10px 20px; background-color: #eee;">
       <h4>Name of Passenger: <?php echo $name; ?></h4>
       <h4>Address: <?php echo $address; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phone: <?php echo $phone; ?></h4>
       <table width="100%" border="1px">
           <tr>
               <th>From</th>
               <th>To</th>
               <th>Seat Numbers</th>
               <th>Total Seats</th>
               <th>Price per seat</th>
               <th>Total</th>
           </tr>
           <tr>
               <td><?php echo $from ?></td>
                <td><?php echo $to ?></td>
                 <td><?php echo $seats ?></td>
                 <td><?php echo $noOfSeats; ?></td>
                  <td><?php echo 'Rs.'.$pricePseat ?></td>
                  <td><?php echo 'Rs.'.$pricePseat*$noOfSeats; ?></td>
           </tr>
       </table>
    
</div>
            
            <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px; alignment-adjust: central; background-color: #ccc; margin: 0 auto 0 auto;">
           <p>&copy; Bussewa</p>

            </div>

</div>