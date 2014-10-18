<div id="right">
    <h4>View Buses&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/dashboard/addbus'; ?>">Add New Bus</a></h4><hr class="topLine" />

    <!-- hotel selection -->
    <div class="sucessmsg"> 
        <?php
        if ($this->session->flashdata('message')) {
            echo $this->session->flashdata('message');
        }
        echo validation_errors();
        if (isset($error)) {
            echo $error;
        }
        ?>

    </div>    
 <?php if(!empty($buses));{ ?>   
    <table width="90%">
        <tr style="border-bottom: 1px solid #ccc; text-align: left;">
            <th>Bus Name</th>
            <th>Bus Number</th>
            <th>From</th>
            <th>To</th>
            <th>Route</th>
            <th>Seats</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
   <?php foreach ($buses as $bus){
       $id= $bus->Id;
       $busName = $bus->bus_name;
       $busNumber = $bus->bus_number;
       $from = $bus->from;
       $fromTime = $bus->from_time;
       $to = $bus-> to;
       $toTime = $bus->to_time;
       $route = $bus->route;
       $seats = $bus->total_seats;
       $image = $bus->image; ?>
   
        <tr style="border-bottom: 1px solid #ccc; text-align: left;">
            <td><?php echo $busName; ?></td>
            <td><?php echo $busNumber; ?></td>
            <td><?php echo $from; ?><br/>
                <?php echo $fromTime; ?></td>
            <td><?php echo $to; ?><br/>
                <?php echo $toTime; ?></td>
            <td><?php echo $route; ?></td>
            <td><?php echo $seats; ?></td>
            <td><img src="<?php echo base_url() . '/contents/uploads/' . $image; ?>" width="50" height="50"></td> 
            <td>
                <?php echo anchor('dashboard/editBus/'.$id,'<img src="'.  base_url().'contents/images/edit.png"  alt="Edit" class="edit_room">'); ?>&nbsp;&nbsp;&nbsp;/
                <?php echo anchor('dashboard/deleteBus/'.$id,'<img src="'.  base_url().'contents/images/delete.png" alt="Delete" class="delete_room">'); ?>
            </td>
            
        </tr>
   <?php } ?>
    </table>     
        
        
 <?php } ?>
</div>
</div>
</body>
</html>