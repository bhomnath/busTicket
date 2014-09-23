
<?php if(!empty($busInfo)){
     foreach ($busInfo as $busdata)
     {
         $id = $busdata->Id;
         $bus_name = $busdata->bus_name;
         $noOfSeats = $busdata->total_seats;
         $busType = $busdata->bus_type;
     }  
} ?>
<script>      
    $(document).ready(function() {   
    
$('.image').click(function(){
  $("#disablebtnInfo").fadeOut(500);
 var id = $(this).attr('id');
    
    if ($(this).attr("class") == "image") {
         $(this).removeClass("image");
         $(this).addClass("image active");
         $(this).attr("src", "<?php echo base_url().'contents/images/select.jpg'; ?>");
         $("#showSelect").append("<span id=asdf"+ id + ">" + id + ",</span>");    
    } else {
        $(this).removeClass("image active");
         $(this).addClass("image");
        $(this).attr("src", "<?php echo base_url().'contents/images/empty.jpg'; ?>");
        $('#asdf'+ id).remove();
    }
  });
  
  
 $('.aaa').click(function(){
  var selected = $("#showSelect").text();
  var from = $('#from').val();
            var to = $('#to').val();
            var depDate = $('#depDate').val();
            var busName = $('#busName').val();
            var busId = $('#busId').val();
  if(selected=="" || selected==null || selected==","){
      $("#disablebtnInfo").html('<span class="error_sign">!</span>&nbsp;' + 'Please select the seats');
                $("#disablebtnInfo").fadeIn(1000);
                return false;
        }
        else{
  
  $.ajax({
        type: "POST",
        url:"<?php echo base_url() .'index.php/home/PersonalInfo' ?>",
        data: {
            'selected': selected,
            'from': from,
            'to': to,
            'depDate': depDate,
            'busName': busName,
            'busId': busId},
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
            <td><b>From:</b><input type="text" id="from" value="<?php echo $abc['from']; ?>" readonly class="textInput" /></td>
            <td><b>To:</b><input type="text" id="to" value="<?php echo $abc['to']; ?>" readonly class="textInput"/></td>
            <td><b>Date:</b><input type="text" id="depDate" value="<?php echo $abc['depDate']; ?>" readonly class="textInput"/></td>
            <td><b>Bus:</b><input type="text" id="busName" value="<?php echo $bus_name; ?>" readonly class="textInput"/>
                <input type="hidden" value="<?php echo $id; ?>" id="busId"/></td>      
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
   <?php if ($busType=="A/C"){ ?> 
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
<?php } else { ?>

<table class="box-border" cellspacing="0" cellpadding="0" width="80%" align="center" style="float:none; margin:0 auto;">
        <tbody>
            <!-- for right side seats -->
            
            <tr>
                <td colspan="3"></td>
             <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='G'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'G'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'G'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'G'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'G'; ?>">
                    </td> <?php }
	 ?> 
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>      
            </tr>
            
            <tr>
                <td colspan="3"></td>
                <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='F'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'F'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'F'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'F'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'F'; ?>">
                    </td> <?php }
	 ?> 
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>"></td>
            </tr>
            
            <tr>
                <td colspan="3"></td>
                 <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='E'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'E'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'G'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'E'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'E'; ?>">
                    </td> <?php }
	 ?> 
                <td colspan="7"></td>
                <td><img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'E'; ?>"></td>
            </tr>
            
            <tr>
                <td colspan="5"></td>
                <td><img class="image" id="<?php echo 'A2'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A2'; ?>"></td>
                <td><img class="image" id="<?php echo 'A4'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A4'; ?>"></td>
                <td><img class="image" id="<?php echo 'A6'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A6'; ?>"></td>
                <td><img class="image" id="<?php echo 'A8'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A8'; ?>"></td>
                <td><img class="image" id="<?php echo 'A10'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A10'; ?>"></td>
                <td><img class="image" id="<?php echo 'A12'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A12'; ?>"></td>
                <td><img class="image" id="<?php echo 'A14'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A14'; ?>"></td>
                      
            </tr>
            
            <tr>
                 <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='A'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'A'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'A'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A'; ?>">
                    </td> <?php }
	 ?> 
                 <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='B'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'B'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'B'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'B'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B'; ?>">
                    </td> <?php }
	 ?> 
                <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='C'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'C'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'C'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'C'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'C'; ?>">
                    </td> <?php }
	 ?> 
                <?php   $a = false;
		foreach($reservedRoom as $seatb){
		if($seatb=='D'){
			$a=true;
			break;}
			     }
				 if($a==true)
				 { ?><td>
                        <img id="<?php echo 'D'; ?>" src="<?php echo base_url() . "contents/images/booked.jpg"; ?>" title="<?php echo 'D'; ?>">
                    </td> <?php }
				 else{ ?><td>
                        <img class="image" id="<?php echo 'D'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'D'; ?>">
                    </td> <?php }
	 ?> 
                <td></td>
                <td><img class="image" id="<?php echo 'A1'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A1'; ?>"></td>
                <td><img class="image" id="<?php echo 'A3'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A3'; ?>"></td>
                <td><img class="image" id="<?php echo 'A5'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A5'; ?>"></td>
                <td><img class="image" id="<?php echo 'A7'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A7'; ?>"></td>
                <td><img class="image" id="<?php echo 'A9'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A9'; ?>"></td>
                <td><img class="image" id="<?php echo 'A11'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A11'; ?>"></td>
                <td><img class="image" id="<?php echo 'A13'; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A13'; ?>"></td>      
            </tr>
            
            
            
            
        </tbody>
</table>




 <?php } ?>
    </div>

<div id="top-from-to-date-show"><table style="border-collapse: collapse; padding: 5px 0px 5px 0px;float:none; margin:0 auto;" width="70%" align="center">
        <tr id="checkinStyle">
            <td><div id="showSelect" style="height:30px; width: 180px; border: 2px solid #ccc; margin: 0 auto 0 auto; color: red; background-color: #e6e6e6;"></div></td>
            <td><input type="submit" value="Book Now" class="aaa"/></td>
                  
        </tr>
    </table>
</div>    


