<script>
    $(document).ready(function() {

        $('#Sseats').click(function() {
            var from = $('#from').val();
            var to = $('#to').val();
            var depDate = $('#fromDate').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/home/index' ?>",
                data: {
                    'from': from,
                    'to': to,
                    'depDate': depDate},
                success: function(msg)
                {
                    $('#form-side-content-all').css({'display': 'block'});
                    $('#form-side-content-all').html(msg);
                }

            });

        });



    });
</script>
<style>
    #top-search-result-full
    {width: 100%; height: 80px; background-color: #428bca; margin: 0 auto 0 auto; border-bottom: 1px solid #ddd;}
    #top-from-to-date-show
    {height: 43px; margin: 0px; padding: 1% 3% 1% 3%; widows: 90%;}
</style>


<div id="top-search-result-full">
    <h1 style="text-align: center; margin: 0px; color: #fff; padding: 15px 0px 10px 0px;">Search Results</h1>
</div>

<div id="top-from-to-date-show"><table style="border-collapse: collapse; padding: 5px 0px 5px 0px;" width="100%">
        <tr id="checkinStyle">
            <td><b>From:</b><input type="text" id="checkin" value="Kathmandu" readonly class="textInput" /></td>
            <td><b>To:</b><input type="text" id="checkout" value="Pokhara" readonly class="textInput"/></td>
            <td><b>Date:</b><input type="text" id="adult" value="2014-09-12" readonly class="textInput"/></td>      
        </tr>
    </table>
</div>

<table style="border-collapse: collapse" width="100%">
    <tbody><?php if (!empty($busInfos)) { ?>
        <tr style="background-color: #428bca; height: 40px; border-bottom: 1px solid #ccc;">
            <th>Bus Name</th>
            <th>Bus Type</th>
            <th>Leaving From</th>
            <th>Departing To</th>
            <th>Image</th>
            <th>Price per Seat</th>
        </tr>
            <?php
            foreach ($busInfos as $buses) {
                $busname = $buses->bus_name;
                $from = $buses->from;
                $fromTime = $buses->from_time;
                $to = $buses->to;
                $toTime = $buses->to_time;
                $image = $buses->image;
                $busType = $buses->bus_type;
                ?>
                <tr style="background-color: #428bca;text-align: center; border-bottom: 1px solid #ccc;">
                    <td><?php echo $busname; ?></td>
                    <td><?php echo $busType; ?></td>
                    <td><?php echo $from; ?><?php echo " (" . $fromTime . ")"; ?></td>
                    <td><?php echo $to; ?><?php echo " (" . $toTime . ")"; ?></td>
                    <td><img src="<?php echo base_url().'contents/uploads/'.$image; ?>" alt="" width="80" height="80"/></td>
                    <td><p style="margin: 0px;">Rs.800.00</p><input type="submit" value="Select Seats" id="Sseats"/></td>

                </tr>

            <?php
            }
        } else {
            echo '<h3>Sorry! no vehicles are available for your query.</h3>';
        }
        ?>
    </tbody>
</table>