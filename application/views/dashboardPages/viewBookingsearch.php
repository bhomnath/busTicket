
<!--from here-->
 <?php 
 $useremail = $this->session->userdata('useremail');
            $user = $this->login_model->get_user_info($useremail);
            foreach ($user as $id) {
                $user_id = $id->Id;
            }

?>
<script>
$(document).ready(function()
{
$("#pagination li:first")
.css({'color' : '#474747'}).css({'border-radius' : '3px'});
 var id = <?php echo $user_id; ?>;
 $.ajax({
type: "POST",
url: "<?php echo base_url().'index.php/dashboard/pagination?page=1' ;?>",
data: {
     'id' : id},
success: function(msgs) 
      {
  
          $("#content").html(msgs);
      }
});



//Pagination Click
$("#pagination li").click(function(){
//Display_Load();
//CSS Styles
$("#pagination li")
.css({'border-radius' : '3px'})
.css({'color' : '#474747'});

$(this)
.css({'color' : '#474747'})
.css({'background':'#FFFFFF'})
.css({'border-radius' : '3px'});

//Loading Data
var pageNum = this.id;
 $.ajax({
type: "POST",
url: "<?php echo base_url().'index.php/dashboard/pagination?page=' ;?>"+pageNum,
data: {
     'id' : id},
success: function(msgs) 
      {
  alert('here');
          $("#tableView").html(msgs);
         // Hide_Load()
      }
});

});

});
</script>

<style>
    ul#pagination{
       margin:4px 0; padding:0px; overflow:hidden; font:12px 'Tahoma'; list-style-type:none;
       
    }
    
li.ajax_pagination
{
list-style: none;
float: left;
margin-right: 16px;

border:solid 1px  ;

color:#474747;
border:solid 1px #B6B6B6;
padding:6px 9px 6px 9px;
background:#E6E6E6;
background:-moz-linear-gradient(top, #FFFFFF 1px, #F3F3F3 1px, #E6E6E6);
background:-webkit-gradient(linear, 0 0, 0 100%, color-stop(0.02, #FFFFFF), color-stop(0.02, #F3F3F3), color-stop(1, #E6E6E6));
border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;

}
li.ajax_pagination:hover
{
color:#474747;
cursor: pointer;
}
::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }
</style>

<div id="loading" ></div>
<div id="content" ></div>

<ul id="pagination">
<?php
//var_dump($pages);
//Pagination Numbers

if($pages!=1 && $pages!=0){
   // echo '<li class="ajax_pagination" id="1">First</li>';
for($i=1; $i<=$pages; $i++)
{
echo '<li class="ajax_pagination" id="'.$i.'">'.$i.'</li>';
}
echo '<li class="ajax_pagination" id="'.$pages.'">Last</li>';
}
?>
</ul>

<!--upto here-->