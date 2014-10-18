
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
   $('#seatError').fadeOut(500);
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
  
  
 $('#toPersonal').click(function(){
  var selected = $("#showSelect").text();
  var from = $('#from').val();
            var to = $('#to').val();
            var depDate = $('#depDate').val();
            var busName = $('#busName').val();
            var busId = $('#busId').val();
  if(selected=="" || selected==null || selected==","){
                $('#seatError').css({'display': 'block'});
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
           $('#myModal').html(msg);

        }
         
    });
    }
}); 

$(".close-error").click(function() {
                $('.alert').css({'display': 'none'});
            });




}); 

</script>

    <?php
    $left = ($noOfSeats + 1) / 2;
    $right = ($noOfSeats + 1) / 2;
    ?>        
                

<!-- fro here-->
<div class="modal-dialog" style="width:80%; margin:106px auto;">
            <div class="modal-content">
                <div class="modal-header" style="margin:0 auto 0 auto; background-color:#269abc;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title" style="margin:0 auto 0 auto; text-align: center; color: #fff;">Bus Search Result >> Select Your Seats</h2>
                </div>
                <div id="top-from-to-date-show" style="padding: 2%; font-size: 20px;"><table style="border-collapse: collapse; padding: 4%;" width="100%">
                        <tr id="checkinStyle">
            <td><b>From:</b><input type="text" id="from" value="<?php echo $abc['from']; ?>" readonly class="textInput" /></td>
            <td><b>To:</b><input type="text" id="to" value="<?php echo $abc['to']; ?>" readonly class="textInput"/></td>
            <td><b>Date:</b><input type="text" id="depDate" value="<?php echo $abc['depDate']; ?>" readonly class="textInput"/></td>
            <td><b>Bus:</b><input type="text" id="busName" value="<?php echo $bus_name; ?>" readonly class="textInput"/>
                <input type="hidden" value="<?php echo $id; ?>" id="busId"/></td>      
        </tr>
                    </table>
                </div>
                <div id="seatError" class="alert alert-error" style="display:none;">

                                <span class="close-error">&times;</span>

                                <strong>Error!</strong> Please select seats you like to book.

                </div>
                <div class="modal-body" style="width:60%; margin: 0 auto;float: left; border: 1px solid #dedede;">

                    
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
                
               <div class="modal-body" style="width:40%; margin: 0 auto;float: left;">
                  <div id="showSelect" style="height:100px; width: 80%; border: 1px solid #eee;"></div>  
                   <button type="button" id="toPersonal" style="background-color:#002166; color: #fff;" class="btn btn-default">Conyinue </button> 
                </div>  
                
                
                <div class="clearfix"></div>
            </div>
        </div>


