<style>
    table, th, td{
      border-collapse: collapse; border: 1px solid #000; 
      padding: 5px;
    }
    </style>   
 <?php if(!empty($bookingInfoC)){
     foreach ($bookingInfoC as $booker){
         $date = $booker->depart_date;
         $busId = $booker->bus_id;
     }
     $busInforms = $this->dashboard_model->find_bus($busId);
                    foreach ($busInforms as $data){
                     $name= $data->bus_name;
                     $number = $data->bus_number;
                     $pricePseat = $data->price_per_seat;
                        }
?>  
<h3>Bus Name: <?php echo $name; ?></h3>
<h3>Bus Number: <?php echo $number; ?></h3>
<h3>Depart. Date: <?php echo $date; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>index.php/prtscreen/printChhalan/<?php echo $busId.'/'.$date; ?>">Print</a></h3>
    <table width="90%;">
        <tr style="border-bottom: 1px solid #ccc; text-align: left; background-color: #000; color: #fff;">
            <th>Passenger Name</th>
            <th>From</th>
            <th>To</th>
            <th>Booked Seats</th>
            <th>Price Per Seat</th>
            <th>Total Price</th>
        </tr>
   <?php $total_price_sum = 0; 
   foreach ($bookingInfoC as $booker){
       $id = $booker->Id;
       $name = $booker->Booking_person_name;
       $from = $booker->departing_from;
       $to = $booker->departing_to;
       $date = $booker->depart_date;
       $seats = $booker->seats_numbers;
       $result = count(explode(',',$seats));
       $noOfSeats = $result - 1;
       $busId = $booker->bus_id;
       $totalPrice = $pricePseat*$noOfSeats;
      
       $total_price_sum = $total_price_sum + $totalPrice;
       ?>
   
        <tr style="border-bottom: 1px solid #ccc; text-align: left;">
            <td><?php echo $name; ?></td>
            <td><?php echo $from; ?></td>
            <td><?php echo $to; ?></td>
           
            <td><?php echo $seats; ?></td>
            <td><?php echo 'Rs.'.$pricePseat; ?></td>
            <td><?php echo 'Rs.'.$totalPrice; ?></td>
       </tr>
       
   <?php } ?>
       <tr>
           <td colspan="5">Total Amount:</td>
           <td><?php echo 'Rs.'.$total_price_sum; ?></td>
       </tr>
    </table>     
        
        
 <?php }else{
     echo "<h3>Sorry! there is no booking for this bus</h3>";
 } ?>
</div>
</div>
</body>
</html>