<?php
include_once 'include/func.php';
islogged();

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

    

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <style>
           #link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }

      .preloader-wrapper{
      position:absolute;
      bottom:0px;
      right:0px;
      }


     
      
            

#modal1{
opacity: 0.84;
    bottom: 0px;
    overflow-y: hidden;
}


            
            
            
            



        </style>
      </head>

<body>
<h2><a href="index.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>

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
    <li class="animate"><span><?php echo $_SESSION['name'];?></span><i class="fa fa-user float-right"></i></li>
    <a href="semi-login.php" style="color:black"><li class="animate">log off<i class="fa fa-arrows-alt float-right"></i></li></a>
    <a href="logout.php" style="color:black"><li class="animate">logout<i class="fa fa-cog float-right"></i></li></a>
  </ul>
</dropdown>
     
    <!-- top quick search -->
    
    <div id="search-container">
		
	        <form action="student.php" method="get">
			<input id="search" type="search" placeholder="Quick Search" name="stud" autocomplete="off"/>
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
				<a href="teacher.php">Teacher and others</a>
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
    
    
    
    

<div class="overlay"></div>
<div class="pat">
 
  <div class="wrapper">
 <h1>C.S.A LIBRARY</h1>  
      
       <div class="form search" id="form">
           <form action="student.php" method="get">
  <label for="search_bar">Search</label>
  <input class="search_bar search" id="searchbox"
         type="search" 
         placeholder="Find... by Id or Name" name="stud" autocomplete="off">
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
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason& Ndigande alain</a> 
				in <a>Fi.inc</a></div>
    
    
    
    
    
    
     <!-- Modal Trigger -->
  <a class="waves-effect waves-light btn modal-trigger blue" style="position:absolute;bottom:0;right:0" href="#modal1">Register</a>

  <!-- Modal Structure -->
  <div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <div id="container">
      <div class="row"><div class="col s8 offset-s2">
      <span style="font-size:30px;" class="grey-text">Register A teacher or an outsider</span>
        <div class="row">
    <form class="col s12" enctype="multipart/form-data">
      <div class="row">
        <div class="input-field col s12">
          <i class="mdi-action-account-circle prefix"></i>
          <input id="name" type="text" class="validate">
          <label for="name">Name</label>
        </div>
        <div class="input-field col s12">
          <i class="mdi-notification-sms-failed prefix"></i>
          <input id="func" type="text" class="validate">
          <label for="func">Function</label>
        </div>
            
        <div class="input-field col s12">
          <i class="mdi-editor-attach-file prefix"></i>
          <input id="icon_t1" type="file" class="validate">
          <label for="icon_t1">User photo</label>
        </div>
      </div>
      <div class="input-field col s6">
      <button class="btn" id="register">Register</button>
      </div>
    </form>
  </div>

      </div></div>
      

</div>
    </div>
  </div>
    
    
    
    
        <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

        <script type="text/javascript">
             $(document).ready(function(){
                 
                     $('.modal-trigger').leanModal();
      $('#register').click(function(e){

          e.preventDefault();
            var func=$('#func').val();
            var name=$('#name').val();
            
            $.ajax({
                url: 'ajax/register.php',
		    type: 'POST',
		   data: {name:name,func:func},
		   beforeSend: function(){
			$('#suggest').html('');
			$(this).css("background","#FFF url(test/loaderIcon.gif) no-repeat right");
		},
		success: function(data){
            $('#modal1').closeModal();
            
        }
            });
      });
     
                
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
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
		data: { s2: keyword},
		beforeSend: function(){
			$('#suggest').html('');
			$('.preloader-wrapper').addClass("active");
		},
		success: function(data){
			var results =jQuery.parseJSON(data);
			$(results).each(function(key, value) {
                var o_t=value.pro_id;
				
				$('#suggest').append('<li class="item" onClick="direct2('+o_t+')"><a href="outsider.php?stud='+o_t+'"><span class="name">' + value.name.toUpperCase()+ '</span><span class="right">'+value.title+'</span></a></li>');
                
                
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
   
                   // $('#searchbox').focus();
                
          });

      </script>
      <script type="text/javascript">

              

            
          
	</script>
      <script src="js/main.js"></script> <!-- Resource jQuery -->
    </body>
  </html>

