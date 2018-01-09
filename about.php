<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
?>
<!Doctype html>
<html>
    <head>
    <link rel="icon" href="assets/img/lib.ico">
        <title>
            
        </title>
        <link rel="stylesheet" href="assets/css/materialize.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <style>
.card-panel{
    background-color:rgba(33, 33, 33, 0.55);
    color:white;
}
            .row .col {
                padding:0;
            }

        </style>
    </head>
    <body style="overflow-x:hidden;">
    <div class="overlay"></div>
        
      <header class="cd-header">
		
		<a href="#0" class="cd-3d-nav-trigger left">
			Menu
			<span></span>
		</a>
        <dropdown style="position:absolute;right:-100px;">
  <input id="toggle2" type="checkbox">
  <label for="toggle2" style="position:absolute;right:0;top:-0.5em;"><i class="label mdi-navigation-arrow-drop-down-circle" style="font-size:2em;padding:0px;"></i></label>
  <ul class="animate">
    <a href="index1.php" style="color:black"><li class="animate">login (<i style="color:blue;font-size:10px">only admins</i>)<i class="fa fa-cog float-right"></i></li></a>
  </ul>
</dropdown>
     
    <!-- top quick search -->
    
    <div id="search-container">
		
	        <form action="student.php" method="get">
			<input id="search" type="search" placeholder="Quick Search" name="stud"/>
                </form>
			<ul style="position:absolute;width:250px;" class="z-depth-3">
			</ul>
		</div>
          
    
	</header> <!-- .cd-header -->
	
	
	<nav class="cd-3d-nav-container">
		<ul class="cd-3d-nav">
			<li class="cd-selected">
				<a href="home.php">Search</a>
			</li>
            <li>
				<a href="outsider.php">Teacher and others</a>
			</li>
            <li>
				<a href="uni_search.php">search(Books)</a>
			</li>

			<li>
				<a href="addstud.php">Add student</a>
			</li>

			<li>
				<a href="addbook.php">Add books</a>
			</li>

			<li>
				<a href="admin-log.php">Admin</a>
			</li>
			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->
        <div class="container">
            <div class="row">
                	            <h1 class=" grey-text" style="font-size:50px;font-weight:300;margin-left:25%" > About this library app</h1>
                 <hr class="s10">

            </div>
            <div class="row">
                <div class="col s6">
                    <div class="card-panel grey-text">
                        <p>
                            future  intelligents (fi ) is a group of 
                                innovative students who  creates and study about
                               different projects related to technology.
                                      "OUR POWER IS OUR MINDS"
                        </p>
                    </div>
                    
                </div>
                <div class="col s6">
                     <ul class="collapsible popout" data-collapsible="accordion">
             <li><div class="collapsible-header">Byiringiro billy
                 </div><div class="collapsible-body">
                    <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/785.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            <p class="grey-text">
                                This the one in Developer of this web application ,and he has studied in College Saint Andre for three(3) years
                            </p>
                        </div>
                    </div>

                 </div>
             </li><li><div class="collapsible-header">Alain eros prestige
                 </div><div class="collapsible-body">
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/821.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            <p class="grey-text">
                            HE is Fi group designer ,he is good at Indesign and web designing he alsostudied in COLLEGE SAINT ANDRE for 3years</p>
                            
                        </div>
                    </div>
                 </div>
             </li><li><div class="collapsible-header">Nshimiyimana Willy
                 </div><div class="collapsible-body">
                         
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/819.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            <p class="grey-text">
                         HE is also a member of FI group, and he did many things and he was a leader  of magis tournament in 2015</p>
                        </div>
                    </div>
                 </div>
             </li><li><div class="collapsible-header">Ishimwe Christian
                 </div><div class="collapsible-body">
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/792.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            
                        </div>
                    </div>
                 </div>
             </li><li><div class="collapsible-header">Iradukunda applolinaire
                 </div><div class="collapsible-body">
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/789.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            
                        </div>
                    </div>
                 </div>
             </li><li><div class="collapsible-header">Uwase nawal
                 </div><div class="collapsible-body">
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/825.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                            
                        </div>
                    </div>
                 </div>
             </li><li><div class="collapsible-header">Ndigande Alain Patrick
                 </div><div class="collapsible-body">
                         <div class="row valign-wrapper card-panel">
                        <div class="col s2">
                            <img src="pictures/814.JPG" class="responsive-img circle">
                        </div>
                        <div class="col s8">
                        </div>
                    </div>
                 </div>
             </li>
                         
                         
        </ul>
                </div>
                
            </div>
        </div>
	
       
        
        
        
        

	
	 
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
        </script>
        </body>
    </html>
