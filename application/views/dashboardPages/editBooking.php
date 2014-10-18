<script type="text/javascript">

    $(document).ready(function(){

        $('input[type="radio"]').click(function(){

            if($(this).attr("value")=="Paid"){
                $(".amt").show();
            }

            if($(this).attr("value")=="Not Paid"){
                $(".amt").hide();
            }

        });

    
    var amt= $('input#totalAmt').val(); 
    var a = parseInt(amt);

    $(('input#amountGiven')).bind('keyup', function(e){
       var b = parseInt($(this).val());
        var c = ( b - a );
        $('input#amountToret').val(c);

    });

});


</script>
<style>
    .amt
    {
       display: none;
    }
</style>
<div id="right">

    <h4>Edit Booking&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/dashboard/bookingInfo'; ?>">View Booking</a></h4><hr class="topLine" />

    <!-- hotel selection -->
    <div class="sucessmsg"> 
        <?php
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        echo validation_errors();
        if (isset($error)) {
            echo $error;
        }
        ?>

    </div>
    <?php if(!empty($bookingInfo)){
        foreach ($bookingInfo as $booker){
       $id = $booker->Id;
       $name = $booker->Booking_person_name;
       $userfrom = $booker->departing_from;
       $userto = $booker->departing_to;
       $date = $booker->depart_date;
       $seatsNo = $booker->seats_numbers;
       $result = count(explode(',',$seatsNo));
       $noOfSeats = $result - 1;
       $busId = $booker->bus_id;
       $payment = $booker->payment_status;
       $amtPaid = $booker->amount_paid;
       $return = $booker->return_status;
        }
        
       $busInfo = $this->dashboard_model->find_bus($busId);
       foreach ($busInfo as $bus)
       {
       $busName = $bus->bus_name;
       $busNumber = $bus->bus_number;
       $from = $bus->from;
       $fromTime = $bus->from_time;
       $to = $bus-> to;
       $toTime = $bus->to_time;
       $route = $bus->route;
       $seats = $bus->total_seats;
       $pricePseat = $bus->price_per_seat;
        $image = $bus->image;
       }
       $totalPrice = $noOfSeats*$pricePseat;
        ?>
    
    <?php echo form_open_multipart('dashboard/updateBooking'); ?>


    <p class="sucessmsg">All fields are mandatory.</p>
    <div style="float: left; width: 300px;">
        <input type="hidden" value="<?php echo $id; ?>" name="bookingId">
        <p>
            <label for="user_pass">Bus Name/ Number: <br>
                <input id="busname" class="textInput" type="text" size="20" value="<?php echo $busName. '-'. $busNumber ?>" name="busname" required readonly>
            </label>
        </p>



        <p>
            <label for="user_pass">From: <br>
                <input id="from" class="textInput" type="text" size="20" value="<?php echo $userfrom; ?>" name="from" required readonly>
            </label>
        </p>

        <p>
            <label for="user_pass">To: <br>
                <input id="to" class="textInput" type="text" size="20" value="<?php echo $userto; ?>" name="to" required readonly>
            </label>
        </p>

         <p>
            <label for="user_pass">Passenger's Name: <br>
                <input id="passengerName" class="textInput" type="text" size="20" value="<?php echo $name; ?>" name="passengerNAme" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Price per Seat: <br>
                <input id="pricePSear" class="textInput" type="text" size="20" value="<?php echo $pricePseat; ?>" name="pricePSeat" required readonly>
            </label>
        </p>
        
        
       <?php if($payment=="Paid"){ ?>
        <p>
            <label for="user_pass"><input id="paid" name="payment" type="radio" value="Paid" checked> Paid: <br>
                <input id="notpaid" name="payment" type="radio" value="Not Paid"> Not Paid: <br>
            </label>
        </p><div class="amt" style="display:block;"><p>
            <label for="user_pass">Amount to return: <br>
                <input id="amountToret" id="to" class="textInput" type="text" size="20"  name="amtToRet" readonly>
            </label>
       </p></div> <?php }else { ?>
           <p>
            <label for="user_pass"><input id="paid" name="payment" type="radio" value="Paid"> Paid: <br>
                <input id="notpaid" name="payment" type="radio" value="Not Paid" checked> Not Paid: <br>
            </label>
        </p>
           <div class="amt"><p>
            <label for="user_pass">Amount to return: <br>
                <input id="amountToret" id="to" class="textInput" type="text" size="20"  name="amtToRet" readonly>
            </label>
       </p></div> 
           
           
    <?php   } ?>
        
    </div>
    <div style="float: left; width: 300px;">

        <p>
            <label for="user_pass">Date: <br>
                <input id="date" class="textInput" type="text" size="20" value="<?php echo $date; ?>" name="date" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Depart Time: <br>
                <input id="departTime" class="textInput" type="text" size="20" value="<?php echo $fromTime; ?>" name="fromTime" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass">To Time: <br>
                <input id="toTime" class="textInput" type="text" size="20" value="<?php echo $toTime; ?>" name="toTime" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Booked Seats No.: <br>
                <input id="seats" class="textInput" type="text" size="20" value="<?php echo $seatsNo; ?>" name="seats" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Total Price: <br>
                <input id="totalAmt" id="seats" class="textInput" type="text" size="20" value="<?php echo $totalPrice; ?>" name="totalPrice" required readonly>
            </label>
        </p>
        
         <?php if($payment=="Paid"){ ?> <div class="amt" style="display:block;"><p>
            <label for="user_pass">Paid Amount: <br>
                <input id="amountGiven" value="<?php echo $amtPaid; ?>"  class="textInput" type="number" size="20" name="amtPaid">
            </label>
            </p>
        
        <p>
            
            <label for="user_pass"><input id="return" name="return" <?php if($return=="Returned"){ echo "checked";} ?> type="radio" value="Returned"> Returned <br>
                <input id="notreturn" name="return" type="radio" <?php if($return=="Not Returned"){ echo "checked";} ?> value="Not Returned"> Not Returned <br>
            </label>
        </p></div><?php }else { ?>
           
           <div class="amt"><p>
            <label for="user_pass">Paid Amount: <br>
                <input id="amountGiven"  class="textInput" type="number" size="20" name="amtPaid">
            </label>
            </p>
        
        <p>
            <label for="user_pass"><input id="return" name="return" <?php if($return=="Returned"){ echo "checked";} ?> type="radio" value="Returned"> Returned <br>
                <input id="notreturn" name="return" <?php if($return=="Not Returned"){ echo "checked";} ?> type="radio" value="Not Returned"> Not Returned <br>
            </label>
        </p></div>
           
           
    <?php   } ?>

    </div>
    
    <div class="clear"></div>
    <input type="submit" value="Update" class="send"/>
    <?php echo form_close(); ?>
    <?php } ?>
</div>
</div>
</body>
</html>