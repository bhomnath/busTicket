<style>
    table, th, td{
      border: 1px solid #ccc; border-collapse: collapse;
    }
</style><div id="right">
<h4>View Message<hr class="topLine" />

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
 <?php if(!empty($query)){ ?>   
    <table width="90%" class="table table-striped table-bordered">
        <tr style="text-align: left;">
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Reply Status</th>
            <th>Action</th>
        </tr>
   <?php foreach ($query as $msg){
       $id= $msg->Id;
       $Name = $msg->name;
       $email = $msg->email;
       $message = $msg->message;
       $reply = $msg->reply_status;
        ?>
   
        <tr style="text-align: left;">
            <td><?php echo $Name; ?></td>
            <td><?php echo $email; ?></td>
            <td><?php echo $message; ?></td>
            <td><?php if($reply=="Replied"){    echo 'Replied';}else{    echo 'Not Replied';} ?></td> 
            <td>
               <?php echo anchor('dashboard/deleteMsg/'.$id,'<img src="'.  base_url().'contents/images/delete.png" alt="Delete" class="delete_room">'); ?>
            </td>
            
        </tr>
   <?php } ?>
    </table>     
        
        
 <?php }else{
     echo '<h3>Sorry! there is no data to show.</h3>';
 } ?>
</div>
</div>
</body>
</html>