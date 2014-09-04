<html>
    <head>
        <title>Bus Ticketing</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/dashboardStyles.css'   ?>" />

    </head>
    <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>
    <script src="<?php echo base_url() . "contents/scripts/bootstrap-jquery.js"; ?>"></script> 

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
    $(document).ready(function() {   
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#dpd1').datepicker({
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
    $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').datepicker({
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
 
 var id = $(this).attr('id');
    
    if ($(this).attr("class") == "image") {
         $(this).addClass("image active");
         $(this).attr("src", "../contents/images/select.jpg");
         $("#showSelect").append(id+",");    
    } else {
        $(this).removeClass("image active");
         $(this).addClass("image");
        $(this).attr("src", "../contents/images/empty.jpg");
        $("#showSelect").append(id+",");
    }
 //   $('.img-swap').toggleClass("on");
  //  $('#atBox').toggle(100);
  //  return false;
  });
  
  
 $('.aaa').click(function(){
  var selected = $("#showSelect").text();
  
  $.ajax({
        type: "POST",
        url:"<?php echo base_url() .'index.php/booking/addSeats' ?>",
        data: {
            'selected': selected },
        success: function(msg)
        {
            alert(msg)
            //$("#showPersonalForm").html(msg);

        }
         
    });
 
}); 



}); 

</script>
<body>
    <?php
    $left = ($noOfSeats - 1) / 4;
    $right = ($noOfSeats - 1) / 4;
    ?>

   <input id="dpd1" class="span2" type="text" value="">
   <input id="dpd2" class="span2" type="text" value="">
    
    <div id="sandbox-container" class="span5 col-md-5">
<input class="form-control" type="text">
</div>
    
    <div id="image" style="width: 50%; border: 1px solid #ccc; margin: 0 auto 0 auto;">
    
    
    
    <table class="box-border" cellspacing="0" cellpadding="0" width="80%" align="center" style="float:none; margin:0 auto;">
        <tbody>
            <!-- for right side seats -->
            <tr>  
                <?php for ($i = 1; $i <= $right; $i++) { ?>
                    <td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td>  <?php } ?></tr>
            <tr>
                <?php for ($i = 1; $i <= $right; $i++) { ?> <td>
                        <img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'B' . $i; ?>">
                    </td>  <?php } ?></tr>
            
             <!-- for last middle seats -->
            <tr>
                <td colspan="<?php echo $right-1; ?>"></td>
        <td><img class="image" id="<?php echo 'B' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="middle"></td>
            </tr>
            
            
            <!-- for left side seats -->
            <tr>  
                <?php for ($i = 1; $i <= $right; $i++) { ?>
                    <td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td>  <?php } ?></tr>
            <tr>
                <?php for ($i = 1; $i <= $right; $i++) { ?> <td>
                        <img class="image" id="<?php echo 'A' . $i; ?>" src="<?php echo base_url() . "contents/images/empty.jpg"; ?>" title="<?php echo 'A' . $i; ?>">
                    </td>  <?php } ?></tr>
    </table>

    </div>

    
    <div id="showSelect" style="height:30px; width: 100px; border: 2px solid #ccc; margin: 0 auto 0 auto; color: red; background-color: #e6e6e6;">
        
    </div>
    <input type="submit" value="Book Now" class="aaa"/>
    <div id="showPersonalForm">
        
    </div>


</body>
</html>