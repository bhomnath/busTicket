<html>
    <head>
        <title>Bus Ticketing</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/dashboardStyles.css'   ?>" />

    </head>
    <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>
    <script src="<?php echo base_url() . "contents/scripts/bootstrap-datepicker.js"; ?>"></script> 

</head>
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
        txtnext[i].seats_numbers = "a";
    }
   
    
    
    
    $(document).ready(function() {   
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#CheckIn').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
    }
    checkin.hide();
    $('#CheckOut')[0].focus();
    }).data('datepicker');
    var checkout = $('#CheckOut').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');

 
       $('#sandbox-container input').datepicker({
    format: "yyyy-mm-dd",
    startDate: "today",
    todayBtn: "linked",
    multidate: false,
    forceParse: false,
    autoclose: true,
    todayHighlight: true
    });     
    
    
    
$('.image').click(function(){
  $("#disablebtnInfo").fadeOut(500);
 var id = $(this).attr('id');
    
    if ($(this).attr("class") == "image") {
         $(this).removeClass("image");
         $(this).addClass("image active");
         $(this).attr("src", "../contents/images/select.jpg");
         $("#showSelect").append("<span id=asdf"+ id + ">" + id + ",</span>");    
    } else {
        $(this).removeClass("image active");
         $(this).addClass("image");
        $(this).attr("src", "../contents/images/empty.jpg");
        $('#asdf'+ id).remove();
    }
  });
  
  
 $('.aaa').click(function(){
  var selected = $("#showSelect").text();
  if(selected=="" || selected==null || selected==","){
      $("#disablebtnInfo").html('<span class="error_sign">!</span>&nbsp;' + 'Please select the rooms');
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
           // alert(msg)
            $("#showPersonalForm").html(msg);

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
<span id="disablebtnInfo"></span>
   <div id="sandbox-container">
                <span class="add-on">Check In</span>
                <input name="CheckIn" type="text" required="required" style="width:185px; cursor:pointer;" id="CheckIn">
                <span onclick="movecursor()" class="add-on" style="width:auto; cursor:pointer; "><img src='<?php echo base_url().'contents/images/ParkReserve.png' ;?>' alt="" width="15" height="20" ></span>
                </div> 

   <div id="sandbox-container">
                <span class="add-on">Check Out</span>
                <input name="CheckOut" type="text" style="width:185px; cursor:pointer;" id="CheckOut" value=""  required="required">
                <span onclick="movecursornext()" class="add-on" style="width:auto; cursor:pointer;"><img src='<?php echo base_url().'contents/images/ParkReserve.png' ;?>' alt="" width="15" height="20" ></span>
                </div>

               
                
    <div id="image" style="width: 50%; border: 1px solid #ccc; margin: 0 auto 0 auto;">
    
    <?php if(!empty($reservationInfo)){
     foreach ($reservationInfo as $reserved){
         $seatBooked = $reserved->seats_numbers;
     }
    } 
    var_dump($seatBooked);
    ?>
    
    <table class="box-border" cellspacing="0" cellpadding="0" width="80%" align="center" style="float:none; margin:0 auto;">
        <tbody>
            <!-- for right side seats -->
            
            <tr>
                <?php for ($i = 2; $i <= $right; $i += 2) { ?> <td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td>  <?php } ?></tr>
            
            <tr>  
                <?php for ($i = 1; $i < $right; $i += 2) { ?>
                    <td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td>  <?php } ?></tr>
            
             <!-- for last middle seats -->
            <tr>
                <td colspan="<?php echo ($right-3)/2; ?>"></td>
        <td><img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="middle"></td>
            </tr>
            
            
            <!-- for left side seats -->
            
            <tr>
                <?php for ($i = 2; $i <= $right; $i += 2) { ?> <td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td>  <?php } ?></tr>
            
            <tr>  
                <?php for ($i = 1; $i < $right; $i += 2) { ?>
                    <td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td>  <?php } ?></tr>
    </table>

    </div>

    
    <div id="showSelect" style="height:30px; width: 100px; border: 2px solid #ccc; margin: 0 auto 0 auto; color: red; background-color: #e6e6e6;"></div>
    <input type="submit" value="Book Now" class="aaa"/>
    <div id="showPersonalForm"></div>


</body>
</html>