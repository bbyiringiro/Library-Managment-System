 <?php

 

 
include_once 'include/config.php';
include_once 'include/func.php';
include_once 'include/db.class.php';
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import materialize.css-->
      <title>(0)non-checked</title>
       
<link rel="stylesheet" href="assets/css/style.css"> <!-- Resource style -->
<link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="assets/css/home.css"  media="screen,projection"/>
<link rel="icon" href="assets/img/lib.ico">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/box.css">
		<!--izi nizo  zanjye cyane-->
<link rel="stylesheet" href="assets/css/checking.css">
      <!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<script src="js/modernizr.js"></script> <!-- Modernizr -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript"src="js/checking.js"></script>
<script tyoe="text/javascript" src="js/jquery.scrollTo.min.js"></script>
<script src="js/main.js"></script> 
       
  <!-- importing javascript block -->
        <style>
        .overlay{
        -webkit-filter: blur(15px);
  filter: blur(15px);
            }
        </style>
      </head>

<body oncontextmenu="return false">
  
    <div class="se-pre-con"></div>
    <div class="overlay"></div>
	<div id="notification-box">
		<form id="notification-form" style="margin:0 auto;background-color: rgba(43, 25, 20, 0.35);">
            <div>
            <input type="text" placeholder="search" id="check-search" style="
    margin-bottom: -10px;"></div>
<div class='chat' style="width:98.8%;background-color: rgba(99, 99, 99, 0.65);">
 
  <div>
    <ul id="notif-today" style="width:100%;height:38em;overflow-x:hidden; overflow-y:auto;">
    </ul>
	   <ul id="notif-before" style="width:100%;height:41.3em;overflow-x:hidden; overflow-y:auto;">
    </ul>
  </div>
	</div>
    <input type="hidden" id="updtid" value=''><span>&nbsp</span>
		</form>
		
		<div id="switching-tabs" class="row valign-wrapper" style="width:36%;margin:0 auto;"> 
		 <!-- for holding switching tab-->	
		<div class="" style="width:91%;">
		<ul class="tabs ">
        <li class="tab"><a class="active green darken-3" href="#notif-today" id="notif-today">today</a></li>
        <li class="tab"><a class=" green darken-3 " href="#notif-before" id="notif-before" >before</a></li>
</ul>
			</div><div id ="noti-count">
			<button class=" green-grey-red darken-1 z-depth-3 circle " id="count" >...</button></div>
				</div></div>
    <script language="javascript">
    window.addEventListener("beforeunload", function (e) {
    	  var confirmationMessage = "you better don't close this tab";

    	  e.returnValue = confirmationMessage;     // Gecko and Trident
    	  return confirmationMessage; 
    	               // Gecko and WebKit
    	});
document.onmousedown=disableclick;
status="Right Click Disabled";
function disableclick(event)
{
  if(event.button==2)
   {
     
     return false;    
   }
}


</script>
		
    </body>
  </html>
<?php
 ?>