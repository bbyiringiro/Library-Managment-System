<?php
include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
islogged();
?>
<!DOCTYPE html>
  <html>
    <head>
           <script>
</script>
      <!--Import materialize.css-->
	<link rel="stylesheet" href="assets/css/style.css"> 
        <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="assets/css/home.css"  media="screen,projection"/>
        <link rel="icon" href="assets/img/lib.ico">
	<link rel="stylesheet" href="assets/css/main.css">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/modernizr.js"></script> 
        <style>
            #ids_form{
                  font-size: 120%;
            }
            #picture{
                opacity:1;
            }
            #ids{
                font-weight: bold;
              
    left:30%;
    height: 10%;
	width: 40%;
	border-radius: 1px;
	border: 1px solid transparent;
	padding: 7px;
	background: rgba(8, 24, 7, 0.99);
	opacity: 0.6;
                
            }
            #link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }
            #sear{
    
	height: 25px;
	width: 180px;
	font-weight: bold;
	color: #FFF;
	border-radius: 15px;
	border: 1px solid transparent;
	outline: none;
	padding: 7px;
	background: rgba(38, 37, 37, 0.81);
	opacity: 0.6;
   
} .sear{
                position:absolute;
                 left:40%;
                 top:35%;
            }
#sear:focus{
	opacity: 1.0;
}
            #ids_form{
                background: rgba(250, 250, 250, 1);
            }
      .preloader-wrapper{
      position:absolute;
      bottom:0px;
      right:0px;
      }
             .cd-3d-nav li {
    height: 100%;
    width: 20%;
    float: left;
}
</style>
        <title>Account's settings page</title>
      </head>

<body>
    <div class="se-pre-con"></div>
    
<header class="cd-header">
		
		<a href="#0" class="cd-3d-nav-trigger left">
			Menu
			<span></span>
		</a>
    <a href="#0" class="cd-logo"><img src="img/lib.ico" alt="Logo"></a>
    
    <div id="search-container" class="sear">
	        <form action="accounts.php" method="get">
			<input id="sear" type="search" placeholder="Find a student for details" name="id" autocomplete="off"/>
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
			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->
<div class="overlay"></div>
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
  </div> <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by Ndigande alain,who is student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy  jason & Ndigande alain</a> 
				in <a href="about.php" style="color:blue;" class="tick waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="This is Future Intelligents group composed by 7 students ,studied in college saint andre(click for more info) ">Fi.inc</a></div> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
          <script src="js/main.js"></script> 
        <script type="text/javascript">
 
$(document).ready(function(){
                      $('#pwd_changer').click(function(){
       var pass=$('.pwd').text();
       var s_i=parseInt($('#s_id').attr('name'));
                
       $.ajax({
           url:'ajax/lend.php',type:'GET',data:{pass:pass,s_i:s_i},success:function(data){
               if(data==1){
                Materialize.toast('<span>password changed successfully</span>',1500);
               }else{
               
               }
           }
           
       });
    });
    $('#ids').hide();
    	$('#sear').bind('keyup', function(){
			var searchTerm = jQuery.trim($(this).val());
            if(isNaN(searchTerm)){
			if(searchTerm == ''){
				$('#search-container ul').html('');
			}else{
				//send the data to the database
				$.ajax({
					url: 'search.php',
					type: 'GET',
					data: {s:searchTerm},
					beforeSend: function(){
						$('#search-container ul').html('<li class="loading"><img src="test/Preloader_4.gif" style="width:100%;"></li>');
					},
					success: function(data){
						var res =jQuery.parseJSON(data);
						$(res).each(function(key, value) {
							$('#search-container ul').append('<li onClick="direction('+value.s_id.toUpperCase()+')"><a id="'+value.s_id+'">' + value.s_name.toUpperCase() + '<span class="right">'+value.class.toUpperCase()+ ' '+value.section.toUpperCase()+'</span></a></li>');
						});
                        $('#search-container ul .loading').hide();
					}
				});
			}
            }else $('#search-container ul').html('');
		});
  
});
            $('#sear').keypress(function(evt){
                $('#ids').hide();
                      $(this).focus();
                
          });
             $('#sear').bind('blur',function(){
            
        });
            function direction(id){
                $('#ids').hide();
             $.ajax({
                 url:"ajax/lend.php",type:"GET",data:{student:id},success:function(data){
                     if(data){ 
                         var results=jQuery.parseJSON(data);
                         $('#search-container ul').html("");
                         $('#picture').html('<img src="pictures/'+results.s_id+'.jpg" alt="" style="height:140px;width:180px;left:6px;";class="responsive-img">');
                         $('#s_id').text(results.s_id.toUpperCase()).attr("name",''+results.s_id+'');
                         $('#class').text(results.class.toUpperCase());
                         $('#section').text(results.section.toUpperCase());
                         $('#names').text(results.s_name.toUpperCase());
                         $('.pwd').text(results.pass);
       
            if(results.activate!=null){
                var act="Yes";
            } else{
                             var act="no";
                         }
                         $('#active').text(act.toUpperCase());
                         $('#ids').show();
                     }else{
                       $('#search-container ul').html("");
                       $('#sear').focus();
                     }
                 }
                 
             });
            }
    
</script>
      <script type="text/javascript">

          
	</script>
    <div class="card"id="ids">
        <div class="row valign-wrapper card">
        <div id="picture" style="width:75%;">
            </div>
        <div class="identity" style="width:25%;">
            <ul><p>S_ID:<b id="s_id"></b></p></ul>
            <ul><p>CLASS:<b id="class"></b></p></ul>
            <ul><p>SECTION:<b id="section"></b></p></ul>
            <ul><p>ACTIVE:<b id="active"></b></p></ul>
            </div>
        </div>
        <form class="row valign-wrapper" id="ids_form">
                <div style="width:80%">
                    <ul> Names:<b id="names"></b></ul>
                   <ul class="row valign-wrapper">Pass:<table><tr><td class="pwd" id=""contenteditable="true">ndigande</td></tr></table></ul>
            </div>
                <div id="pwd_change" style="width:20%;">
                    <a id="pwd_changer"class="btn-floating btn-small waves-effect waves-light tooltipped small"data-position="top" data-delay="30" data-tooltip="change password" style="position:absolute;right:10px;bottom:28px;background-color:rgba(80, 60, 14, 0.91) !important;
    "><i class="mdi-action-track-changes"></i></a>
                </div>    
        </form>
        
    </div>
    <h2><a href="admin.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
    </body>
      
  </html>

