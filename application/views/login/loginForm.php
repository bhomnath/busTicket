<!Doctype html>
<html>
    <head>
        <title>Bus Ticketing</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/loginStyles.css' ?>" />
    </head>
    <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>
    <script>
         $(document).ready(function() {
            $('.textInput').click(function() {
       //   alert('here');      
       // $(this).style.border = "solid 5px red";
    });
    
    $('#log_link').click(function() {
       //  alert('here');      
        $('#login').show();
        $('#register').hide();
    });
    
    $('#reg_link').click(function() {
       //   alert('here');   
       $('#register').show();
        $('#login').hide();
    });
    
    
    $('#formLog').click(function(){
        var username= $('#username').val();
        var pass= $('#pass').val();
         var valid = true;
         
        if ((username == null) || (username == "") || (!username.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
        var err1 ="User name must be 5 character long!";
            valid = false;

        }

        if ((pass == null) || (pass == "") || (!pass.match(/^[a-z,0-9,A-Z_ ]{5,35}$/))) {
         var err2 ="password must be 5 character long!";
            valid = false;
        }
        if (valid == false) {
            $("#nameerr").html(err1);
            $("#passerr").html(err2);
        }
        else {
           
          $.ajax({
        type: "POST",
        url: <?php echo base_url()."index.php/login/authenticate"; ?>,
        data: {
            'username': username,
            'pass': pass
        },
        success: function(msg)
        {
            alert(msg);
           // $("#replaceMe").html(msg);

        },
         complete: function(){
        $('#loading').hide();
      }
    });
    
    
        }
        
    });
    
    $("#username").click(function(){
        $("#nameerr").hide();
    });
    
     $("#pass").click(function(){
        $("#passerr").hide();
    });
    
    
    
    
    });
    </script>
    <body>
        <div id="loginFull">
            <div style="margin: 0px">
                <a id="log_link" class="active">Login</a>
                <a id="reg_link">Register</a>
            </div>

            
            
            
            
            <!-- login form starts here -->
            
            <div id="login">
                <div class="sucessmsg">
            <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
              echo validation_errors(); ?> </div>
                
                <p>
                    <label for="user_login">Username <strong id="nameerr" style="color:#990000 ; font-size: 12px;"></strong><br>
                        <input id="username" class="textInput" type="text" size="20" value="" name="userName">
                    </label>
                    
                </p>
                <p>
                    <label for="user_pass">Password <strong id="passerr" style="color:#990000 ;font-size: 12px;"></strong><br>
                        <input id="pass" class="textInput" class="input" type="password" size="20" value="" name="pass">
                    </label>
                    
                </p>

                <p class="forgetmenot">
                    <label for="rememberme">
                        <input id="rememberme" type="checkbox" value="forever" name="rememberme">
                        Remember Me
                    </label>


                    <input class="submit" type="submit" value="Log In" id="formLog">

                </p>
 
            </div> 
            
            <!-- login form is closed here -->
            
            <!-- now registration form starts here -->
            <div id="register" class="login">
                <?php echo form_open_multipart('login/register'); ?>
               <p>
                    <label for="user_login">Username<br>
                        <input class="textInput" class="input" type="text" size="20" value="" name="username">
                    </label>
                </p>
                <p>
                    <label for="user_pass">Full Name<br>
                        <input class="textInput" class="input" type="text" size="20" value="" name="name">
                    </label>
                </p>
                <p>
                    <label for="user_login">Email<br>
                        <input class="textInput" class="input" type="text" size="20" value="" name="email">
                    </label>
                </p>
                <p>
                    <label for="user_pass">Password<br>
                        <input class="textInput" class="input" type="password" size="20" value="" name="pass">
                    </label>
                </p>
                <p>
                    <label for="user_pass">Re-type Password<br>
                        <input class="textInput" class="input" type="password" size="20" value="" name="re-pass">
                    </label>
                </p>
                
                <input class="submit" type="submit" value="Register" name="register">
             <?php echo form_close(); ?>   
            </div>
            <div ><p style="font-size: 10px; text-align: center;">&copy All rights reserved - 2014 meroticket.</p></div>
        </div>        
    </body>
</html>