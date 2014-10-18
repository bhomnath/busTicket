<script>
    $(document).ready(function() {

        $('#Sseats').click(function() {

            var from = $('#from').val();
            var to = $('#to').val();
            var depDate = $('#depDate').val();
            var id = $(this).parent().prev().prev().prev('td').parent().attr('id');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() . 'index.php/home/selectSeats' ?>",
                data: {
                    'from': from,
                    'to': to,
                    'depDate': depDate,
                    'busId': id},
                success: function(msg)
                {
                   $('#myModal').html(msg);
                }

            });

        });



    });
</script>

<style>
    table#bus, table#bus th, table#bus td{
        border-collapse: collapse;
        border: 1px solid #000;
        text-align: center;
    }
    table#bus th
    {
        background-color: #eee;
    }
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

<script type="text/javascript">
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>

    
        <div class="modal-dialog" style="width:80%; margin:106px auto;">
            <div class="modal-content">
                <div class="modal-header" style="margin:0 auto 0 auto; background-color:#269abc;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h2 class="modal-title" style="margin:0 auto 0 auto; text-align: center; color: #fff;">Bus Search Result >> Select Your Bus</h2>
                </div>
                <div id="top-from-to-date-show" style="padding: 2%; font-size: 20px;"><table style="border-collapse: collapse; padding: 4%;" width="100%">
                        <tr id="checkinStyle">
                            <td><b>From:</b><input type="text" id="from" value="<?php echo $abc['from']; ?>" readonly class="textInput" /></td>
                            <td><b>To:</b><input type="text" id="to" value="<?php echo $abc['to']; ?>" readonly class="textInput"/></td>
                            <td><b>Date:</b><input type="text" id="depDate" value="<?php echo $abc['depDate']; ?>" readonly class="textInput"/></td>      
                        </tr>
                    </table>
                </div>
                <div class="modal-body">

 
                    <table id="bus" style="width:100%;">
      <?php if (!empty($busInfos)) { ?>
<thead>
<tr>

<th class="numeric">Bus Type</th>
<th class="numeric">Departing From</th>
<th class="numeric">Departing To</th>
<th class="numeric">Image</th>
<th class="numeric">Price Per Seat</th>
</tr>
</thead>
<tbody>
     <?php
                foreach ($busInfos as $buses) {
                    $id = $buses->Id;
                    $busname = $buses->bus_name;
                    $from = $buses->from;
                    $fromTime = $buses->from_time;
                    $to = $buses->to;
                    $toTime = $buses->to_time;
                    $image = $buses->image;
                    $busType = $buses->bus_type;
                    $price = $buses->price_per_seat;
                    ?>
<tr id="<?php echo $id; ?>">
<input id="hides" type="hidden" value="<?php echo $id; ?>" />
<td data-title="Company"><?php echo $busType; ?></td>
<td data-title="Price" class="numeric"><?php echo $from; ?><?php echo " (" . $fromTime . ")"; ?></td>
<td data-title="Change" class="numeric"><?php echo $to; ?><?php echo " (" . $toTime . ")"; ?></td>
<td data-title="Change %" class="numeric"><img src="<?php echo base_url() . 'contents/uploads/' . $image; ?>" alt="" width="120"/></td>
<td data-title="Open" class="numeric"><p style="margin: 0px;"><?php echo 'Rs.'.$price; ?></p><button type="button" id="Sseats" style="background-color:#002166; color: #fff;" class="btn btn-default">Select Seats</button></td>
</tr>
<?php
        }
    } else {
        echo '<h3>Sorry! no vehicles are available for your query.</h3>';
    }
    ?>
</tbody>
</table>   
                                 
                    
                </div>
                
                    

                
            </div>
        </div>
   





    