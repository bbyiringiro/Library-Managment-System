<?php
include_once 'include/func.php';


?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import materialize.css-->
       
	<link rel="stylesheet" href="assets/css/style.css"> <!-- Resource style -->
    
	
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/home.css"  media="screen,projection"/>
        <link rel="icon" href="assets/img/lib.ico">
        
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/box.css">

    

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <style>


            
        </style>
      </head>

<body>
    <div class="se-pre-con"></div>
 
    
    
    		
<div class='chat'>
  <header>
    <h2 class='title'>
      <a href='http://www.elegantthemes.com/'>ElegantThemes</a>
    </h2>
    <ul class='tools'>
      <li>
        <a class='fa fa-gear' href='#' id="toggle"></a>
      </li>
      <li>
        <a class='fa fa-search' href='#'></a>
      </li>
    </ul>
  </header>
  <div class='body'>
    <div class='search'>
      <input placeholder='Search...' type='text'>
    </div>
    <ul>
      <li>
        <a class='thumbnail' href='#'>
          NR
        </a>
        <div class='content'>
          <h3>dsdddbb</h3>
          <span class='preview'>hey how are things going on the...</span>
          <span class='meta'>
            2h ago &middot;
            <a href='#'>Category</a>
            &middot;
            <a href='#'>Reply</a>
          </span>
        </div>
      </li>
      <li>
        <a class='thumbnail' href='#'>
          KS
        </a>
        <div class='content'>
          <h3>Ksdhdhhdh</h3>
          <span class='preview'>make sure you take a look at the...</span>
          <span class='meta'>
            3h ago &middot;
            <a href='#'>Category</a>
            &middot;
            <a href='#'>Reply</a>
          </span>
        </div>
      </li>

    </ul>
  </div>
  <footer>
    <a href='#'>some studs</a>
  </footer>
</div>

    
    
    
      <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason</a> 
				in <a>Fi.inc</a></div>
    
    
    
    
    
    
    
        <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

        <script type="text/javascript">
              </script>
      <script type="text/javascript">
			$('.fa-search').click(function() {
  $(this).stop().toggleClass('fa-close');
  $('.search').stop().animate({
    height: "toggle",
    opacity: "toggle"
  }, 300);
});

$('.chat').draggable({
  handle: 'header'
    
});
          $('#toggle').click(function(){
              $('.body').slideToggle('down')
          })
          
	</script>
      <script src="js/main.js"></script> <!-- Resource jQuery -->
    </body>
  </html>

