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
           //$("#disablebtnInfo").fadeIn(1000);
            $("#disablebtnInfo").html(msg);
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
                    'remarks': remarks},
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

<style>
    #top-search-result-full
    {width: 100%; height: 80px; background-color: #428bca; margin: 0 auto 0 auto; border-bottom: 1px solid #ddd;}
    #top-from-to-date-show
    {height: 90px; margin: 0px; padding: 1% 3% 1% 3%; width: 90%;}
</style>
<div id="top-search-result-full">
    <h1 style="text-align: center; margin: 0px; color: #fff; padding: 15px 0px 10px 0px;">Personal Info</h1>
</div>

<div id="top-from-to-date-show"><table style="border-collapse: collapse; padding: 5px 0px 5px 0px;" width="100%">
        <tr id="checkinStyle">
            <td><b>From:</b><input type="text" id="from" value="<?php echo $abc['from']; ?>" readonly class="textInput" /></td>
            <td><b>To:</b><input type="text" id="to" value="<?php echo $abc['to']; ?>" readonly class="textInput"/></td>
            <td><b>Date:</b><input type="text" id="depDate" value="<?php echo $abc['depDate']; ?>" readonly class="textInput"/></td></tr>
            <tr><td><b>Bus:</b><input type="text" id="busName" value="<?php  echo $abc['busName']; ?>" readonly class="textInput"/>
                <input type="hidden" value="<?php echo $abc['busId']; ?>" id="busId"/></td>
            <td><b>Seats:</b><input type="text" id="seats" value="<?php echo $abc['seats']; ?>" readonly class="textInput"/></td>
        </tr>
    </table>
</div>
<span id="disablebtnInfo"></span>
<div style="float: left; margin:0px; padding:1% 3% 1% 3%; width:20%;">

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

<div style="float: left; margin:0px; padding:1% 3% 1% 3%; width:20%;">
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
            
                <input type="submit" value="Book Now" id="bookPersonal"/>
           
        </p>

           
    </div>
<div class="clear"></div>