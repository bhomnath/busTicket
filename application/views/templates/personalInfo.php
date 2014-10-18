<script>
    $(document).ready(function() {

        $('#bookPersonal').click(function() {
            var valid = true;
            var from = $('#from').val();
            var to = $('#to').val();
            var depDate = $('#depDate').val();
            var busName = $('#busName').val();
            var busId = $('#busId').val();
            var seats = $('#seats').val();
            var name = $('#fullName').val();
            var address = $('#address').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var remarks = $('#remarks').val();
            var myRadio = $('input[name=food]');
            var food = myRadio.filter(':checked').val();

            if ((phone == null) || (phone == "") || (!phone.match(/^[0-9]{5,35}$/))) {
                $('#phone').focus();
                $('#personalError').css({'display': 'block'});
                $('#errorPer').html('Please fill phone correctly');
                valid = false;
            }
            if ((email == null) || (email == "") || (!email.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/))) {
                $('#email').focus();             
                $('#personalError').css({'display': 'block'});
                $('#errorPer').html('Please fill email correctly');
                valid = false;
            }
            if ((address == null) || (address == "") || (!address.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
                $('#address').focus();             
                $('#personalError').css({'display': 'block'});
                $('#errorPer').html('Please fill address correctly');
                valid = false;
            }
            if ((name == null) || (name == "") || (!name.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
                $('#fullName').focus();
               $('#personalError').css({'display': 'block'});
                $('#errorPer').html('Please fill name correctly');
                valid = false;
            }
            if (valid == false) {
                 
                  return false;
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url() . 'index.php/home/thankYou' ?>",
                    data: {
                        'from': from,
                        'to': to,
                        'depDate': depDate,
                        'busName': busName,
                        'busId': busId,
                        'seats': seats,
                        'name': name,
                        'address': address,
                        'email': email,
                        'phone': phone,
                        'food': food,
                        'remarks': remarks},
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
<style>
  @media only screen and (max-width: 800px) {
/* Force table to not be like tables anymore */
#no-more-tables table,
#no-more-tables thead,
#no-more-tables tbody,
#no-more-tables th,
#no-more-tables td,
#no-more-tables tr {
display: block;
}
 
/* Hide table headers (but not display: none;, for accessibility) */
#no-more-tables thead tr {
position: absolute;
top: -9999px;
left: -9999px;
}
 
#no-more-tables tr { border: 1px solid #ccc; }
 
#no-more-tables td {
/* Behave like a "row" */
border: none;
border-bottom: 1px solid #eee;
position: relative;
padding-left: 50%;
white-space: normal;
text-align:left;
}
 
#no-more-tables td:before {
/* Now like a table header */
position: absolute;
/* Top/left values mimic padding */
top: 6px;
left: 6px;
width: 45%;
padding-right: 10px;
white-space: nowrap;
text-align:left;
font-weight: bold;
}
 
/*
Label the data
*/
#no-more-tables td:before { content: attr(data-title); }
}  
    
    
</style>
<!--from here-->
<div class="modal-dialog" style="width:80%; margin:106px auto;font-size: 20px;">
    <div class="modal-content">
        <div class="modal-header" style="margin:0 auto 0 auto; background-color:#269abc;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title" style="margin:0 auto 0 auto; text-align: center; color: #fff;">Bus Search Result >> Personal Info</h2>
        </div>
        <div id="top-from-to-date-show" style="padding: 2%;">
            <table style="border-collapse: collapse; padding: 5%;">
                <tr style="height:50px;">
                    <td style="width: 100px;"><b>From:</b><input type="text" id="from" value="<?php echo $abc['from']; ?>" readonly class="textInput" /></td>
                    <td style="width: 20%;"><b>To:</b><input type="text" id="to" value="<?php echo $abc['to']; ?>" readonly class="textInput"/></td>
                    <td style="width: 20%;"><b>Date:</b><input type="text" id="depDate" value="<?php echo $abc['depDate']; ?>" readonly class="textInput"/></td></tr>
                <tr> <td style="width: 20%;"><b>Bus:</b><input type="text" id="busName" value="<?php echo $abc['busName']; ?>" readonly class="textInput"/>
                        <input type="hidden" value="<?php echo $abc['busId']; ?>" id="busId"/></td>
                    <td style="width: 20%;"><b>Seats:</b><input type="text" id="seats" value="<?php echo $abc['seats']; ?>" readonly class="textInput"/></td>
                </tr>
            </table>
        </div>
        <div id="personalError" class="alert alert-error" style="display:none;">

                                <span class="close-error">&times;</span>

                                <strong>Error ! </strong><span id="errorPer"></span>

                </div>
        <div class="modal-body" style="width:30%; margin: 0% 0% 0% 20%;float: left;"> 
            <p>
                <label for="user_name">Full Name: <br>
                    <input id="fullName" class="textInput" type="text" size="20" name="username" required>
                </label>
            </p>

            <p>
                <label for="user_email">Email: <br>
                    <input id="email" class="textInput" type="email" size="20"  name="email" required>
                </label>
            </p>

            <p>
                <label for="user_remarks">Remarks (optional): <br>
                    <textarea id="remarks" placeholder="remarks"></textarea>
                </label>
            </p>

        </div>

        <div class="modal-body" style="width:30%; margin: 0% 20% 0% 0%;float: left;"> 
            <p>
                <label for="user_address">Full Address: <br>
                    <input id="address" class="textInput" type="text" size="20" name="address" required>
                </label>
            </p>



            <p>
                <label for="user_phone">Phone/ Mob. No.: <br>
                    <input id="phone" class="textInput" type="text" size="20" name="phone" required>
                </label>
            </p>
            <p>
                <label for="user_phone">Food:<br>
                    <input id="food" type="radio" name="food" value='yes' checked > I want food.
                    <input id="food" type="radio" name="food" value='no' > I don't want food.                
                </label>
            </p>

            <p>

                <button type="button" id="bookPersonal" style="background-color:#002166; color: #fff;" class="btn btn-default">Continue</button> 

            </p>

        </div>
        <div class="clearfix"></div>

    </div>
</div>



