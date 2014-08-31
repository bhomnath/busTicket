<div id="right">
    
    <h4>Add New Bus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'index.php/dashboard/roomInfo'; ?>">View Buses</a></h4><hr class="topLine" />
   
   <!-- hotel selection -->
    <div id="sucessmsg"> 
            <?php if($this->session->flashdata('message')){echo $this->session->flashdata('message');}
              echo validation_errors();
              if($this->session->flashdata('message')) { ?>
            <img src="<?php echo base_url() . "contents/images/success.jpg"; ?>" height="15px" width="15px"/>
            <?php echo $this->session->flashdata('message');
            }
              ?>
            
    </div>
   <table>
       <tr>
           <td><p>Bus Name: </p></td>
           <td><input id="busname" class="textInput" type="text" size="20" value="<?php ?>" name="busname"></td>
       </tr>
        
    
       <tr><td><p>Bus Number: </p>
           <td>   <input id="busnumber" class="textInput" type="text" size="20" value="" name="busnumber"></td>
       
    
    <tr><td><p>Bus Name: </p> 
        <td><input id="busname" class="textInput" type="text" size="20" value="<?php ?>" name="busname"></td>
    </tr>
    <tr>
    <td><p>
            Bus Number: </p></td>
    <td>  <input id="busnumber" class="textInput" type="text" size="20" value="" name="busnumber"></td>
    </tr>
    <tr><td>    <p>
                Bus Name: </p></td>
        <td>  <input id="busname" class="textInput" type="text" size="20" value="<?php ?>" name="busname"></td>
    </tr>
    <tr><td><p>
                Bus Number: </p></td>
        <td>  <input id="busnumber" class="textInput" type="text" size="20" value="" name="busnumber"></td>
        </tr>
    
   </table>
   <input type="submit" value="submit" class="send"/>

</div>
</div>
</body>
</html>