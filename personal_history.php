<?php
include_once 'include/func.php';
islogged();
?>
<!DOCTYPE html>
  <html>
    <head>
           <script>
</script>
      <!--Import materialize.css-->
       
	<link rel="stylesheet" href="assets/css/style.css"> <!-- Resource style -->
    
	
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/home.css"  media="screen,projection"/>
        <link rel="icon" href="assets/img/lib.ico">
        
	<link rel="stylesheet" href="assets/css/main.css">

    

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <style>
           
      .preloader-wrapper{
      position:absolute;
      bottom:0px;
      right:0px;
      }


     
      
            


.cd-3d-nav li {
    height: 100%;
    width: 32%;
    float: left;
}




        </style>
        <title>history page</title>
      </head>

<body>
<h2><a href="index.php" id="link" style="position:absolute;left:10px;top:10px;box-shadow: 0 0 5px;
 box-shadow:0 0 50px;color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>

    <div class="se-pre-con"></div>
    
<header class="cd-header">
		
		<a href="#0" class="cd-3d-nav-trigger left">
			Menu
			<span></span>
		</a>
    <a href="#0" class="cd-logo"><img src="img/lib.ico" alt="Logo"></a>
    
     <dropdown id="dropdown" style="position:absolute;right:-100px;">
  <input id="toggle2" type="checkbox">
  <label for="toggle2" style="position:absolute;right:0;top:-0.5em;"><i class="label mdi-navigation-arrow-drop-down-circle" style="font-size:2em;padding:0px;"></i></label>
  <ul class="animate">
    
    <a href="index1.php" style="color:black"><li class="animate">login (<i style="color:blue;font-size:10px">only admins</i>)<i class="fa fa-cog float-right"></i></li></a>
  </ul>
</dropdown>
     
    <!-- top quick search -->
    
    <div id="search-container">
		
	        <form action="check_stud.php" method="get">
			<input id="search" type="search" placeholder="Quick Search" name="id" autocomplete="off"/>
                </form>
			<ul style="position:absolute;width:250px;" class="z-depth-3">
			</ul>
		</div>
         
   
    
	</header> <!-- .cd-header -->
	
	
	<nav class="cd-3d-nav-container">
		<ul class="cd-3d-nav">
            <li>
				<a href="personal_history.php">personal history</a>
			</li>
            <li>
				<a href="history.php?id=hist">library history</a>
			</li>
<li class="cd-selected">
				<a href="home.php">home</a>
			</li>

			
			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->
    
    
    
    

<div class="overlay"></div>
<div class="pat">
 
  <div class="wrapper">
 <h1>C.S.A LIBRARY</h1>  
      
      
       <div class="form search" id="form">
           <form action="history.php" method="get">
  <label for="search_bar">Search</label>
  <input class="search_bar search" id="searchbox"
         type="search" 
         placeholder="Find... to see the Full Personal History" name="id" autocomplete="off">
           </form>

      
      
           </div>
    </div>
 
  
</div>
<div class="preloader-wrapper big ">
    <div class="spinner-layer spinner-green-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div>
    

    
    
    
     <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason&Ndigande alain</a> 
				in <a href="about.php" style="color:blue;" class="tick waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="This is Future Intelligents group composed by 7 students ,studied in college saint andre(click for more info) ">Fi.inc</a></div>
    
    
    
    
    
    
    
        <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
          <script src="js/main.js"></script> <!-- Resource jQuery -->


        <script type="text/javascript">
  //ready the dom.
$(document).ready(function(){
  
  //when the search box is entered
  $(".search").focus(function(){
    //slideDown the results div
  
    //animate the form to the top
    $(".form").animate({
      top:"-390px",
    });
   
    //when the search box is unfocused:
  });

	


    
    
  
});
//making auto _suggest
$('#searchbox').keyup(function() {
	var keyword=$('#searchbox').val();
	if(isNaN(keyword)){
if (keyword.length >= 2) {
	if ($('#suggest').length < 1) {
        $('#form').append('<ul id="suggest"></ul>');
    }
	$.ajax({
		url: 'search.php',
		type: 'GET',
		data: { s: keyword},
		beforeSend: function(){
			$('#suggest').html('');
			$('.preloader-wrapper').addClass("active");
		},
		success: function(data){
			var results =jQuery.parseJSON(data);
			$(results).each(function(key, value) {
				
				$('#suggest').append('<li class="item" onClick="direct_history('+value.s_id+')"><a href="history.php?id='+value.s_id+'"><span class="name">' + value.s_name.toUpperCase() + '</span><span class="right">'+value.class.toUpperCase()+ ' '+value.section.toUpperCase()+'</span></a></li>');
                
                
                $('.item').hover(function() {
	    	
	    })
                $('.item').on('mouseover mouseout', function(event) {

if (event.type == 'mouseover') {
    var res=$(this).find('.name').text();
	    	$('#searchbox').val(res);

} else if (event.type == 'mouseout') {
    $('#searchbox').val('  ');

}
});
        
				
			});
			$('.preloader-wrapper').removeClass("active");
		}
	});

		
	
}else{
	$('#suggest').html('');

	
}
	}//end of is number
	 

    });
            
            
            $(document).keypress(function(evt){
   
                    $('#searchbox').focus();
                
          });
            $('#search').keypress(function(evt){
   
                     $(document).keypress(function(evt){
   
                    $('#search').focus();
                
          });
                
          });
    
function direct_history(id,e){
    window.location='history.php?id='+id+'';
    
}

      </script>
      <script type="text/javascript">
          
	</script>
    </body>
  </html>


