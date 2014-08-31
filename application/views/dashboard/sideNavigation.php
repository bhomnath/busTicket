<script>
    $(function () {

    $('#cssmenu ul li').click(function () {
  $("li").removeClass("has-sub");
  $(this).addClass("active has-sub");
});

});

    
    </script>
<div id="main">
<div id="left">
    <div id='cssmenu'>
<ul>
   <li class='active has-sub'><a href="<?php echo base_url().'index.php/dashboard/addNew'; ?>"><span>Add Bus</span></a>
      <ul>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
        <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href="<?php echo base_url().'index.php/application/index'; ?>"><span>View Buses</span></a>
       <ul>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href="<?php echo base_url().'index.php/documentation/index'; ?>"><span>View Booking</span></a>
   <ul>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
         <li class='has-sub'><a href="#"><span>Sub Menu1</span></a></li>
      </ul>
   
   </li>
   <li class='has-sub'><a href="<?php echo base_url().'index.php/documentation/index'; ?>"><span>Manage Booking</span></a></li>
</ul>
</div>

</div>
    
    