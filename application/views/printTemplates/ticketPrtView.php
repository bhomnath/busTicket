<script>
    window.onload = function () {
  window.print();
  setTimeout(function(){window.close();}, 1);
} 
</script>
<style>
    table, th, td{
      border-collapse: collapse; border: 1px solid #000;  
    }
    </style>

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
      $departFrom = $busin->from;
      $departTime = $busin-> from_time;
      $departTo = $busin->to;
  }
}
?>


<div style="width: 1000px; margin: 0 auto 0 auto; padding: 0px; height: 283px;" >
    <div style="width:80%; float: left;">
        <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px;float: left; alignment-adjust: central; margin: 0 auto 0 auto;">
            <h1 style="margin: 0px;">Namaste Nepal Yatayat Byabasasi Sangh</h1>								
            <h3 style="margin: 10px;">Head Office, Kohalpur, Banke</h3>									
        </div>
    
    <div style="clear: both"></div>
        
        <div style="display:table-cell; padding-left: 50px; height: 70px; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <p>Bus No.: <?php echo $busNumber; ?> <br/>
                Booking Date: <?php echo '19/09/2014' ; ?><br/>
                Reporting Time: <?php echo $departTime - 1.00; ?></p>
        </div>
    <div style="display:table-cell; height: 70px; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <p>Ticket No: <?php echo '071A001'; ?><br/>
                Depart Date: <?php echo $date ?><br/>
                Depart Time: <?php echo $departTime; ?></p> 
        </div>
    <div style="clear: both"></div>

    <div style='border: 1px solid #000; padding: 0px 20px 0px 20px;'>
        <h4>Passenger's Name : <?php echo $name; ?><br/>
            Address : <?php echo $address; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Of Passengers : <?php echo $noOfSeats; ?><br/>
            From : <?php echo $departFrom; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To : <?php echo $departTo; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rate : <?php echo $pricePseat; ?><br/>
            Seat Numbers : <?php echo $seats; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact Number : <?php echo $phone; ?></h4>       
    </div>

</div>
    
    <div style="width: 18%; float: left; border: 1px solid#000; height: 100%;">
        <table width="100%">
            <tr><th colspan="2"><h2>Amount Rs.</h2></th></tr>
        <tr>
            <td style="padding: 15px 5px 20px 5px;"><h4>Bus Fare Rs.</h4></td>
            <td style="padding: 15px 5px 20px 5px;"><h4><?php echo $noOfSeats*$pricePseat; ?></h4></td>
        </tr>
        <tr >
            <td style="padding: 15px 5px 20px 5px;"><h4>Food Fare Rs.</h4></td>
            <td style="padding: 15px 5px 20px 5px;"><h4><?php  ?></h4></td>
        </tr>
        <tr>
            <td style="padding: 15px 5px 20px 5px;"><h4>Total Rs.</h4></td>
            <td style="padding: 15px 5px 20px 5px;"><h4><?php  ?></h4></td>
        </tr>
        </table>  
        
        
        
        
    </div>   
    <div class="clear"></div>   
    
    
    
    
</div>