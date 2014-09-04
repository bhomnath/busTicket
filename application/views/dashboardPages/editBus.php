<div id="right">

    <h4>Edit Bus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url() . 'index.php/dashboard/busInfo'; ?>">View Buses</a></h4><hr class="topLine" />

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
    <?php if(!empty($buses)){
        foreach ($buses as $bus){
       $id= $bus->Id;
       $busName = $bus->bus_name;
       $busNumber = $bus->bus_number;
       $from = $bus->from;
       $fromTime = $bus->from_time;
       $to = $bus-> to;
       $toTime = $bus->to_time;
       $route = $bus->route;
       $seats = $bus->total_seats;
        $image = $bus->image; } ?>
    
    
    <?php $time= array('5.00 am', '5.30 am', '6.00 am', '6.30 am', '7.00 am', '7.30 am', '8.00 am', '8.30 am', '9.00 am', '9.30 am') ?>
    <?php echo form_open_multipart('dashboard/addNewBus'); ?>


    <p class="sucessmsg">All fields are mandatory.</p>
    <div style="float: left; width: 300px;">

        <p>
            <label for="user_pass">Bus Name: <br>
                <input id="busname" class="textInput" type="text" size="20" value="<?php echo $busName ?>" name="busname" required>
            </label>
        </p>



        <p>
            <label for="user_pass">From: <br>
                <input id="from" class="textInput" type="text" size="20" value="<?php echo $from; ?>" name="from" required>
            </label>
        </p>

        <p>
            <label for="user_pass">To: <br>
                <input id="to" class="textInput" type="text" size="20" value="<?php echo $to; ?>" name="to" required>
            </label>
        </p>

        <p>
            <label for="user_pass">Route: <br>
                <input id="route" class="textInput" type="text" size="20" value="<?php echo $route; ?>" name="route" required>
            </label>
        </p>

        

        <p>
            <label for="user_pass">Image: <br>
                <input id="file" class="textInput" type="file" size="20" value="" name="file_name" required>
            </label>
        </p>    
    </div>
    <div style="float: left; width: 300px;">

        <p>
            <label for="user_pass">Bus Number: <br>
                <input id="busnumber" class="textInput" type="text" size="20" value="<?php echo $busNumber; ?>" name="busnumber" required>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Time: <br>
                <select id="fromTime" name="fromTime" class="textInput"><?php foreach ($time as $data){ ?>
                <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php } ?>
                </select>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Time: <br>
                <select id="toTime" name="toTime" class="textInput"><?php foreach ($time as $data){ ?>
                <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php } ?>
                </select>
            </label>
        </p>
        
        <p>
            <label for="user_pass">Total Seats: <br>
                <input id="seats" class="textInput" type="number" size="20" value="<?php echo $seats; ?>" name="seats" required>
            </label>
        </p>

    </div>
    
    <div class="clear"></div>
    <input type="submit" value="submit" class="send"/>
    <?php echo form_close(); ?>
    <?php } ?>
</div>
</div>
</body>
</html>