<style>
    table, th, td{
      border-collapse: collapse; border: 1px solid #000;  
    }
    </style>
    <?php
if (!empty($bookingInfoC)) {
    foreach ($bookingInfoC as $booker) {
        $date = $booker->depart_date;
        $busId = $booker->bus_id;
    }
    $busInforms = $this->dashboard_model->find_bus($busId);
    foreach ($busInforms as $data) {
        $name = $data->bus_name;
        $number = $data->bus_number;
        $from = $data->from;
        $fromTime = $data->from_time;
        $to = $data->to;
        $toTime = $data->to_time;
        $price = $data->price_per_seat;
    }
    ?>  

    <div style="width: 1000px; margin: 0 auto 0 auto; padding: 0px;" >
        <div style="display:table-cell; vertical-align:middle; text-align:center; height: 70px; width: 1000px;float: left; alignment-adjust: central; margin: 0 auto 0 auto;">
            <h3 style="margin: 0px;">Namaste Nepal yatayat byabasasi sangh</h3>								
            <h5 style="margin: 10px;">Head Office, Kohalpur, Banke</h5>									
        </div>
        
        <div style="clear: both"></div>
        
        <div style="display:table-cell; padding-left: 50px; height: 70px; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <p>Chalani No.: <br/>
                Driver Name: <br/>
                License No.: <br/>
                Contact No.: </p>
        </div>
        
        <div style="display:table-cell; padding-left: 130px; height: 70px; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <h1>CHHALAN</h1>
        </div>
        
        <div style="display:table-cell; height: 70px; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <p>Depart Date: <?php echo $date; ?><br/>
                Depart time: <?php echo $fromTime ?><br/>
                Bus No.: <?php echo $number ?><br/>
                Arrival time: <?php echo $toTime; ?><br/>
                Depart From: <?php echo $from; ?><br/>
                Depart To: <?php echo $to; ?></p> 
        </div>
        
        <div style="clear: both"></div>
        
        <div style="display:table-cell; vertical-align:middle; height: auto; width: 1000px; alignment-adjust: central; margin: 0 auto 0 auto;">           								
            <p style="text-align: center;"> <?php echo $from . ' to ' . $to; ?></p> 
        </div>
        
        <div style="padding: 10px 5px 10px 5px;">
            <table width="100%">
                <tr>
                    <th>S.N.</th>
                    <th>Passenger Name</th>
                    <th>Ticket No.</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Seat No.</th>
                    <th>Passengers</th>
                    <th>Amount</th>
                    <th>Total Amount</th>
                    <th>Meal</th>
                    <th>Returns</th>
                    <th>Remain</th>
                    <th>Contact No.</th>
                </tr>
                <?php $i=1;
                foreach ($bookingInfoC as $booker) {
                    $id = $booker->Id;
                    $name = $booker->Booking_person_name;
                    $from = $booker->departing_from;
                    $to = $booker->departing_to;
                    $date = $booker->depart_date;
                    $seats = $booker->seats_numbers;
                    $result = count(explode(',', $seats));
                    $noOfSeats = $result - 1;
                    $busId = $booker->bus_id;
                    $contact = $booker->phone;
                    ?>
                    <tr style="border-bottom: 1px solid #ccc; text-align: left;">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo "071A001"; ?></td>
                        <td><?php echo $from; ?></td>
                        <td><?php echo $to; ?></td>
                        <td><?php echo $seats; ?></td>
                        <td><?php echo $noOfSeats; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $price * $noOfSeats; ?></td>
                         <td><?php echo $noOfSeats; ?></td>
                          <td><?php echo "400" ?></td>
                           <td><?php echo "400" ?></td>
                            <td><?php echo $contact; ?></td>
                        
                    </tr>
                <?php $i++; } ?>
            </table> 
            <?php
        } else {
            echo "<h3>Sorry! there is no booking for this bus</h3>";
        }
        ?>

    </div>

</div>  