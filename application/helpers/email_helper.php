<?php 

function send_seat_book_email($email,$subject,$message)
                {
    $headers = 'From: admin<info@homnath.com.np>' ."\r\n" ;
    $headers .="CC: sales@cosmosnepal.net"."\r\n" ;          
    $headers .="MIME-Version: 1.0" . "\r\n";
    $headers .="Content-type:text/html;charset=UTF-8" . "\r\n";

    if (mail($email, $subject, $message, $headers)) {
        //echo "Email sent successfully...";
    } else {
        echo "Message could not be sent...";
         
   }  
   }

function seat_book_email($busName, $name, $from, $to, $depDate, $seats, $imglink){
   $body = '<div style="width: 750px; margin: 0 auto 0 auto; padding: 0px;" >
        <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px; alignment-adjust: central; background-color: #ccc; margin: 0 auto 0 auto;">
            <img src="'.$imglink.'" alt="Bus Sewa" style="height:50px; width:50px; margin:10px;"/>

            </div>

   <div style="padding: 10px 20px 10px 20px; background-color: #eee;">
   
    
    <h4>Dear '.$name.'  !</h4>

  
    <h5>Thank you for your booking through Bussewa.</h5>
    <p>You have successfully booked seat number/s <b>'.$seats.'</b> form bus '.$busName.'.</p>
        <p>Your booked bus will leave from '.$from.' to '.$to.' dated on '.$depDate.'.</p>
</div>
            
            <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px; alignment-adjust: central; background-color: #ccc; margin: 0 auto 0 auto;">
           <p>&copy; Bussewa</p>

            </div>

</div>';
    return $body; 
}

