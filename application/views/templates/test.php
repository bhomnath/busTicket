<script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>
<script src="<?php echo base_url() . 'contents/scripts/apiused.js' ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url() . "contents/styles/jquery-ui.css"; ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url() . "contents/styles/tableStyles.css"; ?>"/>
<script src="<?php echo base_url() . "contents/scripts/jquery1.10.2.js"; ?>"></script>
<script src="<?php echo base_url() . "contents/scripts/jquery-ui.js"; ?>"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
    $(function() {

        $("#from").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'index.php/home/fromQuery'; ?>",
                    dataType: "json",
                    data: {'userA': request.term},
                    success: function(msgs)
                    {
                        response(msgs);
                    }
                });
            }

        });

    });

    $(function() {

        $("#to").autocomplete({
            source: function(request, response) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'index.php/home/toQuery'; ?>",
                    dataType: "json",
                    data: {'userA': request.term},
                    success: function(msgs)
                    {
                        response(msgs);
                    }
                });
            }

        });

    });


</script>

          <!--      <script>
                    function openPopUp() {
                        
                         $('#loading').show();
                        var checkin = $("#fromDate").val();
                        var checkout = $("#toDate").val();
                        var adult = $("#adults").val();
                        var child = $("#childs").val();
                        var hotelId = $("#tags").val();
                        // alert( adult);
                        $.ajax({
                            type: "POST",
                            url: "<?php //echo base_url() . 'index.php/room_booking/post_action';  ?>",
                            data: {
                                'checkin': checkin,
                                'checkout': checkout,
                                'adult': adult,
                                'child': child,
                                'hotelId': hotelId
                            },
                            
                                success: function(msg)
        {

            $("#replaceMe").html(msg);

        },
         complete: function(){
        $('#loading').hide();
      }
    });
}

$(document).ready(function(event){
    
    $("#fromDate").click(function(){
        $(".errormsgs").fadeOut(2000);
    });
    
     $("#toDate").click(function(){
        $(".errormsgs").fadeOut(2000);
    });
    
    $("#tags").click(function(){
        $(".errormsgs").fadeOut(2000);
    });
    
    
     var replaced = $("#changePopup").html();
         $("#search").click(function(){
             
      // checks for valid date code part
     
   var dtVal=$('#fromDate').val();
   if(ValidateDate(dtVal))   //calling ValidateDate function
   {
      $('.errormsgs').hide();
   }
   else
   {
     $('.errormsgs').fadeIn(1500);
     event.preventDefault();
   }
             
             
              var dtVal=$('#toDate').val();
   if(ValidateDate(dtVal))   //calling ValidateDate function
   {
      $('.errormsgs').fadeOut(1500);
   }
   else
   {
     $('.errormsgs').fadeIn(1500);
     event.preventDefault();
   }
   
   var hotel=$('#tags').val();
   if(hotel!=="")   //calling ValidateDate function
   {
      $('.errormsgs').fadeOut(1500);
   }
   else
   {
     $('.errormsgs').fadeIn(1500);
     event.preventDefault();
   }
   
   var adult=$('#adults').val();
   if(adult > "0")   //calling ValidateDate function
   {
      $('.errormsgs').fadeOut(1500);
   }
   else
   {
     $('.errormsgs').fadeIn(1500);
     event.preventDefault();
   }
    // end for checks for valid date code part         
             
             
      $("#changePopup").html(replaced); 
$(".middleLayer").fadeToggle(1000);
        $(".popup").fadeToggle(1300);
                path();
                $('#one').css({'background-color': '#0077b3'});
                $('.first').css({'color': '#0077b3'});
                $('.first').css({'font-weight': 'bold'});
                openPouUp(); // function show popup
    });
});


$(document).keydown(function(e){
if (e.keyCode == 27)
{
$(".popup").hide();
        $(".middleLayer").fadeOut(300);
}
});



function path() {
$("#path").show();
}

                </script>    -->     

<!--<span class="errormsgs"><span class="error_sign">!</span>&nbsp;Please select hotel, from, to date and no of person. </span>-->
<div class="ui-widget">
    <p>
        <label for="from">From:</label>
        <input class="textInput" placeholder="From" id="from" >
    </p>
</div>

<div class="ui-widget">
    <p>
        <label for="to">To:</label>
        <input class="textInput" placeholder="To" id="to" >
    </p>
</div>
<!-- till here-->
<div class="input-prepend input-append">
                <span class="add-on">Check In</span>
                <input name="CheckIn" type="text" required="required" style="width:185px; cursor:pointer;" id="fromDate">
                <span onclick="movecursor()" class="add-on" style="width:auto; cursor:pointer; "><img src='<?php echo base_url().'contents/images/ParkReserve.png' ;?>' alt="" width="15" height="20" ></span>
                </div> 



<input name="CheckOut" type="text" placeholder="To"  value="" id="toDate"  required="required">





<input type ="button" id="search" class="search" onclick="openPopUp()"  value="PROCEED TO BOOKING" />
