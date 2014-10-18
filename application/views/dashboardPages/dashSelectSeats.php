<?php if(!empty($busInfo)){
     foreach ($busInfo as $busdata)
     {
         $id = $busdata->Id;
         $bus_name = $busdata->bus_name;
         $noOfSeats = $busdata->total_seats;
         $pricePseat = $busdata->price_per_seat;
     }  
} ?>
<script>      
    $(document).ready(function() {   
    
$('.image').click(function(){
  $("#disablebtnInfo").fadeOut(500);
 var id = $(this).attr('id');
 var seatp = $('#pricePSeaT').val();
    if ($(this).attr("class") == "image") {
         $(this).removeClass("image");
         $(this).addClass("image active");
         $(this).attr("src", "<?php echo base_url().'contents/images/select.jpg'; ?>");
         $("#showSelect").append("<span id=asdf"+ id + ">" + id + ",</span>");
         var a= $('#showSelect').text();
        var as = a.split(',').length
        var seats = as - 1;
         var c = ( seats * seatp );
        $('input#totalAmt').val(c);
    } else {
        $(this).removeClass("image active");
         $(this).addClass("image");
        $(this).attr("src", "<?php echo base_url().'contents/images/empty.jpg'; ?>");
        $('#asdf'+ id).remove();
        var a= $('#showSelect').text();
        var as = a.split(',').length
        var seats = as - 1;
         var c = ( seats * seatp );
        $('input#totalAmt').val(c);
    }
  });
  
  $('input#amountGiven').bind('keyup', function(e){
    var amt= $('input#totalAmt').val(); 
    var a = parseInt(amt);
       var b = parseInt($(this).val());
        var c = ( b - a );
        $('input#amountToret').val(c);

    });
    
     $('input[name=payment]').click(function(){

            if($(this).attr("value")=="Paid"){
                $(".amt").show();
                $('input#return').attr('checked', 'checked');
                 
            }

            if($(this).attr("value")=="Not Paid"){
                 $('input#amountGiven').val('0');
                 $('input#amountToret').val('0');
                  $('input#notreturn').attr('checked', 'checked');
                  
                $(".amt").hide();
            }

        });
    
    
  
 $('#bookNowSeats').click(function(){
 var valid = true;
        var selected = $("#showSelect").text();
            var name = $('#fullName').val();
            var address = $('#address').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var remarks = $('#remarks').val();
             var busNo = $('#busNumbers').val();
            var depDate = $('#CheckIn').val();
           var myRadio = $('input[name=payment]');
            var payment = myRadio.filter(':checked').val();
            var amtPaid = $('input#amountGiven').val();
            var amtRet = $('input#amountToret').val();
            var ret =  $('input[name=return]');
             var retStat = ret.filter(':checked').val();
            var foodRadio = $('input[name=food]');
            var food = foodRadio.filter(':checked').val();
           
            
            if ((busNo == null) || (busNo == "")) {
                $('#busNumbers').focus();
                $('#busNumbers').style.border = "solid 1px red";
                msg = "Please select Bus Number!";
                valid = false;
            }
            if ((depDate == null) || (depDate == "")) {
                $('#CheckIn').focus();
                $('#CheckIn').style.border = "solid 1px red";
                msg = "Please Select date!";
                valid = false;
            }
        if(selected=="" || selected==null || selected==","){
                 $("#disablebtnInfo").html('<span class="error_sign">!</span>&nbsp;' + 'Please select the seats');
                $("#disablebtnInfo").fadeIn(1000);
                return false;
        }
       
            
            if ((phone == null) || (phone == "") || (!phone.match(/^[0-9]{5,35}$/))) {
           $('#phone').focus();
           $('#phone').style.border = "solid 1px red";
            msg ="You need to fill the contact number field in correct format!";
            valid = false;
        }
        if ((email == null) || (email == "") || (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))) {
           $('#email').focus();
           $('#email').style.border = "solid 1px red";
            msg ="You need to fill the email field in correct format!";
            valid = false;
        }
        if ((address == null) || (address == "") || (!address.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
           $('#address').focus();
           $('#address').style.border = "solid 1px red";
            msg ="You need to fill the address field in correct format!";
            valid = false;
        }
        if ((name == null) || (name == "") || (!name.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
           $('#fullName').focus();
           $('#fullName').style.border = "solid 1px red";
            msg ="You need to fill the Full Name field in correct format!";
            valid = false;
        }
        if (valid == false) {
            alert('here');
            $("#disablebtnInfo").html(msg);
         }
        else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/dashboard/bookNow' ?>",
                data: {
                    'busNo': busNo,
                    'depDate': depDate,
                    'seats': selected,
                    'name': name,
                    'address': address,
                    'email': email,
                    'phone': phone,
                    'remarks': remarks,
                    'payment' : payment,
                    'amtPaid' : amtPaid,
                    'retStat' : retStat,
                    'food' : food},
                success: function(msg)
                {
                    $('#right').html(msg);
                }

            });
            }
}); 

}); 

</script>
<?php
    $left = ($noOfSeats + 1) / 2;
    $right = ($noOfSeats + 1) / 2;
    ?>


               
                
    <div id="image" style="width: 50%; border: 1px solid #ccc; margin: 0px;">
    
    <?php if(!empty($reservationInfo)){
     foreach ($reservationInfo as $reserved){
         $seatBooked = $reserved->seats_numbers;     
     }
    } 
    ?>
    
    <table class="box-border" cellspacing="0" cellpadding="0" width="80%" align="center" style="float:none; margin:0 auto;">
        <tbody>
            <!-- for right side seats -->
            
            <tr>
                <?php 
				
				for ($i = 2; $i <= $right; $i += 2) {
					$a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='B'.$i){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td> <?php }
	 ?>   <?php } ?></tr>
            
            <tr>  
                <?php for ($i = 1; $i < $right; $i += 2) {
                    $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='B'.$i){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td> <?php }
	 ?>   <?php } ?></tr>
            
             <!-- for last middle seats -->
            <tr><td colspan="<?php echo ($right-3)/2; ?>"></td>
                <?php
                    $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='middle'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td >
                        <img id="middle" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="middle">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="middle" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="middle">
                    </td> <?php } ?>
            </tr>
            
            
            <!-- for left side seats -->
            
            <tr>
                <?php for ($i = 2; $i <= $right; $i += 2) { $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='A'.$i){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td> <?php }
	 ?>   <?php } ?></tr>
            
            <tr>  
                <?php for ($i = 1; $i < $right; $i += 2) { $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='A'.$i){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td> <?php }
	 ?>   <?php } ?></tr>
    </table>

    </div>

<div style="float: left; margin:0px; padding:1% 3% 1% 3%; width:300px;">

        <p>
            <label for="user_name">Full Name: <br>
                <input id="fullName" class="textInput" type="text" size="20" value="<?php echo set_value('busname'); ?>" name="username" required>
            </label>
        </p>

        <p>
            <label for="user_email">Email: <br>
                <input id="email" class="textInput" type="email" size="20" value="<?php echo set_value('to'); ?>" name="email" required>
            </label>
        </p>

        <p>
            <label for="user_remarks">Remarks (optional): <br>
                <textarea id="remarks" placeholder="remarks"></textarea>
            </label>
        </p>
        
        <p>
            <label for="user_remarks">Price Per Seat<br>
                <input id="pricePSeaT" class="textInput" type="text" size="20" value="<?php echo $pricePseat; ?>" name="pricePSeat" required readonly>
            </label>
        </p>
        
        <p>
            <label for="user_pass"><input id="paid" name="payment" type="radio" value="Paid" checked> Paid: <br>
                <input id="notpaid" name="payment" type="radio" value="Not Paid"> Not Paid: <br>
            </label>
        </p>
        <div class="amt" style="display:block;"><p>
            <label for="user_pass">Amount to return: <br>
                <input id="amountToret" id="to" class="textInput" type="text" size="20"  name="amtToRet" readonly>
            </label>
       </p></div>
         <p>
            <label for="user_phone">Food:<br>
                <input id="food" type="radio" name="food" value='yes' checked > I want food.
                <input id="food" type="radio" name="food" value='no' > I don't want food.                
            </label>
        </p>
        
        
        

</div>

<div style="float: left; margin:0px; padding:1% 3% 1% 3%; width:20%;">
        <p>
            <label for="user_address">Full Address: <br>
                <input id="address" class="textInput" type="text" size="20" value="<?php echo set_value('address'); ?>" name="address" required>
            </label>
        </p>

        

        <p>
            <label for="user_phone">Phone/ Mob. No.: <br>
                <input id="phone" class="textInput" type="text" size="20" value="<?php echo set_value('phone'); ?>" name="phone" required>
            </label>
        </p>

        <p>
            <label for="selected">Selected Seats: <br>
               <div id="showSelect" style="height:30px; width: 180px; border: 2px solid #ccc; margin: 0 auto 0 auto; color: red; background-color: #e6e6e6;"></div>
            </label>
        </p>

        <p>
            <label for="user_pass">Total Price: <br>
                <input id="totalAmt" id="seats" class="textInput" type="text" size="20" name="totalPrice" required readonly>
            </label>
        </p>
        
        
        <div class="amt" style="display:block;"><p>
            <label for="user_pass">Paid Amount: <br>
                <input id="amountGiven"  class="textInput" type="number" size="20" name="amtPaid">
            </label>
            </p>
        
        <p>
            
            <label for="user_pass"><input id="return" name="return" type="radio" value="Returned" checked> Returned <br>
                <input id="notreturn" name="return" type="radio" value="Not Returned" > Not Returned <br>
            </label>
        </p></div>
           
    </div>

<div class="clear"></div>        
 
 <input type="submit" value="Book Now" class="send" id="bookNowSeats"/>
 <span id="disablebtnInfo"></span>
                  
        
    


