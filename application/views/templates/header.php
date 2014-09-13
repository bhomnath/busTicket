
<?php if(!empty($busInfo)){
     foreach ($busInfo as $busdata)
     {
         $id = $busdata->Id;
         $bus_name = $busdata->bus_name;
         $noOfSeats = $busdata->total_seats;
     }  
} ?>
<script>   
   var txtnext;
    txtnext = <?php echo $json . ';'; ?>;
    for (var i = 0; i < txtnext.length; i++) {
      var string = txtnext[i].seats_numbers; 
    } 
        var temp = new Array();
        temp = string.split(",");
   
    $(document).ready(function() {   
    
$('.image').click(function(){
  $("#disablebtnInfo").fadeOut(500);
 var id = $(this).attr('id');
    
    if ($(this).attr("class") == "image") {
         $(this).removeClass("image");
         $(this).addClass("image active");
         $(this).attr("src", "http://localhost/busTicket/contents/images/select.jpg");
         $("#showSelect").append("<span id=asdf"+ id + ">" + id + ",</span>");    
    } else {
        $(this).removeClass("image active");
         $(this).addClass("image");
        $(this).attr("src", "http://localhost/busTicket/contents/images/empty.jpg");
        $('#asdf'+ id).remove();
    }
  });
  
  
 $('.aaa').click(function(){
  var selected = $("#showSelect").text();
  if(selected=="" || selected==null || selected==","){
      $("#disablebtnInfo").html('<span class="error_sign">!</span>&nbsp;' + 'Please select the seats');
                $("#disablebtnInfo").fadeIn(1000);
                return false;
        }
        else{
  
  $.ajax({
        type: "POST",
        url:"<?php echo base_url() .'index.php/booking/addSeats' ?>",
        data: {
            'selected': selected },
        success: function(msg)
        {
            $('#form-side-content-all').css({'display': 'block'});
                    $('#form-side-content-all').html(msg);

        }
         
    });
    }
}); 

}); 

</script>
<body>
    <?php
    $left = ($noOfSeats + 1) / 2;
    $right = ($noOfSeats + 1) / 2;
    ?>
    <style>
    #top-search-result-full
    {width: 100%; height: 80px; background-color: #428bca; margin: 0 auto 0 auto; border-bottom: 1px solid #ddd;}
    #top-from-to-date-show
    {height: 43px; margin: 0px; padding: 1% 3% 1% 3%; widows: 90%;}
</style>
    <div id="top-search-result-full">
    <h1 style="text-align: center; margin: 0px; color: #fff; padding: 15px 0px 10px 0px;">Select Seats</h1>
</div>
<div id="top-from-to-date-show"><table style="border-collapse: collapse; padding: 5px 0px 5px 0px;" width="100%">
        <tr id="checkinStyle">
            <td><b>From:</b><input type="text" id="checkin" value="Kathmandu" readonly class="textInput" /></td>
            <td><b>To:</b><input type="text" id="checkout" value="Pokhara" readonly class="textInput"/></td>
            <td><b>Date:</b><input type="text" id="adult" value="2014-09-12" readonly class="textInput"/></td>      
        </tr>
    </table>
</div>
<span id="disablebtnInfo"></span>

               
                
    <div id="image" style="width: 50%; border: 1px solid #ccc; margin: 0 auto 0 auto;">
    
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

<div id="top-from-to-date-show"><table style="border-collapse: collapse; padding: 5px 0px 5px 0px;float:none; margin:0 auto;" width="70%" align="center">
        <tr id="checkinStyle">
            <td><div id="showSelect" style="height:30px; width: 180px; border: 2px solid #ccc; margin: 0 auto 0 auto; color: red; background-color: #e6e6e6;"></div></td>
            <td><input type="submit" value="Book Now" class="aaa"/></td>
                  
        </tr>
    </table>
</div>    


