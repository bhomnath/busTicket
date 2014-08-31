<html>
    <head>
        <title>Bus Ticketing</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'contents/styles/dashboardStyles.css' ?>" />
    </head>
    <script src="<?php echo base_url() . "contents/scripts/jquery.js"; ?>"></script>

</head>
<body>
    <div id="navigation">

        <div id="brand"><img style="float: left;" src="<?php echo base_url() . "contents/images/logo_1.png"; ?>"height="50" alt="bus sewa"/><h3>Bus Sewa</h3></div>
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
            <img style="float: left;" src="<?php echo base_url() . "contents/images/logout.jpg"; ?>"height="50" alt="bus sewa"/><a href="<?php echo base_url().'index.php/login/logout' ?>"> <h5>Log Out</h5></a>
        </div>
        
        
        
        
    </div>
</body>
</html>

<!--
<div id="cssmenu">
                <ul>
                    <li class='active'><a href='#'><span>Home</span></a></li>
                    <li class='has-sub'><a href='#'><span>About</span></a>
                        <ul>
                            <li><a href='#'><span>MISSION</span></a></li>
                            <li class='last'><a href='#'><span>VISION</span></a></li>
                        </ul>
                    </li>
                    <li><a href='#'><span>Contact</span></a></li>
                    <li><a href='#'><span>REGISTER</span></a></li>
                    <li class='last'><a href='#'><span>LOGIN</span></a></li>
                </ul>
            </div><SCRIPT>
        $('#cssmenu').prepend('<div id="indicatorContainer"><div id="pIndicator"><div id="cIndicator"></div></div></div>');
        var activeElement = $('#cssmenu>ul>li:first');

        $('#cssmenu>ul>li').each(function() {
            if ($(this).hasClass('active')) {
                activeElement = $(this);
            }
        });


        var posLeft = activeElement.position().left;
        var elementWidth = activeElement.width();
        posLeft = posLeft + elementWidth / 2 - 6;
        if (activeElement.hasClass('has-sub')) {
            posLeft -= 6;
        }

        $('#cssmenu #pIndicator').css('left', posLeft);
        var element, leftPos, indicator = $('#cssmenu pIndicator');

        $("#cssmenu>ul>li").hover(function() {
            element = $(this);
            var w = element.width();
            if ($(this).hasClass('has-sub'))
            {
                leftPos = element.position().left + w / 2 - 12;
            }
            else {
                leftPos = element.position().left + w / 2 - 6;
            }

            $('#cssmenu #pIndicator').css('left', leftPos);
        }
        , function() {
            $('#cssmenu #pIndicator').css('left', posLeft);
        });

        $('#cssmenu>ul').prepend('<li id="menu-button"><a>Menu</a></li>');
        $("#menu-button").click(function() {
            if ($(this).parent().hasClass('open')) {
                $(this).parent().removeClass('open');
            }
            else {
                $(this).parent().addClass('open');
            }
        });

    </SCRIPT> -->