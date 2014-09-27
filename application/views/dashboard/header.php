<html ng-app="myApp" ng-app lang="en">
    <meta charset="utf-8">
    <style type="text/css">
    ul>li, a{cursor: pointer;}
    </style>
    <head>
        <title>Bus Ticketing</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/dashboardStyles.css' ?>" />
   <link href="<?php echo base_url() . 'contents/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
   <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>

</head>
<body>
    <div id="navigation">

        <div id="brand"><img style="float: left; padding: 10px 0px 0px 0px;" src="<?php echo base_url() . "contents/images/logo.png"; ?>"height="30" alt="bus sewa"/><h3>Bus Sewa</h3></div>
        <div id="navigationTop">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>
                <li><a href="#">HOME</a></li>

            </ul>

        </div> 
        
        <div id="logOut" style="float: left; width: 9%;">
            <a href="<?php echo base_url().'index.php/login/logout' ?>"><img style="float: left;padding: 15px 0px 0px 0px;" src="<?php echo base_url() . "contents/images/logout.png"; ?>"height="20" alt="bus sewa"/></a>
            <p><?php echo $this->session->userdata('username'); ?></p>
        </div>
        
        
        
        
    </div>


