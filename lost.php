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
            .item {
	padding: 3px;
	font-family: Helvetica;
    color:white;
    border-radius:15px;
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
          .sear{
     position:absolute;
    left:30%;
    top:28%;
    height:67%;
	width: 40%;
	color: #FFF;
	border-radius: 15px;
	border: 1px solid transparent;
	outline: none;
	padding: 7px;
	background: rgba(38, 37, 37, 0.81);
	opacity: 0.6;
            }
             .cd-3d-nav li {
    height: 100%;
    width: 20%;
    float: left;
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
            .book-suggest .row{
                margin-bottom:0px;
            }
            .book-suggest {
    max-height: 380px;
    overflow-y: auto;
}

.collection {
    margin: 0.5rem 0 1rem 0;
    border: 1px solid #e0e0e0;
    border-radius: 2px;
    overflow-y: auto;
    position: relative;
}
</style>
        <title>To whom  this book is for</title>
      </head>

<body>
   
    
    <div class="se-pre-con"></div>
    
<header class="cd-header">
		
		<a href="#0" class="cd-3d-nav-trigger left">
			Menu
			<span></span>
		</a>
    <a href="#0" class="cd-logo"><img src="img/lib.ico" alt="Logo"></a>
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
    <div class="sear" id="book_box">
                      <form class="col s12">
                          <div class="row">
                          <div class="input-field col m10">
          <i class="mdi-action-account-circle prefix"></i>
          <input id="icon_prefix" type="text"  class="validate" autocomplete=off>
          <label for="icon_prefix">Enter book ID</label>
        
        </div>
                          </div>
                          <div class="row">
                              <div class="collection book-suggest" id="suggestion">
                                  
                                  <a href="#!" class="collection-item"><center>FIND BOOK TO SEE THE OWNER</center></a>

   
    
  </div>
                          </div>
      
    </form>
                 </div>
                  
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
            $('#ids').hide();
                $('#pwd_changer').click(function(){
                    $('#ids').hide();
                });
            });
            $('#icon_prefix').keyup(function() {
                $('#ids').hide();
        		var keyword=$('#icon_prefix').val();
        	if (keyword.length >= 1) {
        		if ($('.book-suggest').length < 1) {
        	        $('#book_box').append('<ul id=".book-suggest"></ul>');
        	    }
        		$.get( "ajax/lend.php", { l_book: keyword } ).done(function( data ) {
                  
        			$('.book-suggest').html('');
        			var results =jQuery.parseJSON(data);
                    if($.isEmptyObject(results)){
                        $('.book-suggest').html('<div class="not-found blue-grey-text white row valign-wrapper"><div class="col s4"><i class="mdi-action-info small"> </i></div><div class="col s6">not yet borowed</div><div class="col s2"></div></div> '); $('.modal-trigger').leanModal();
                    }
                    else{
        			$(results).each(function(key, value) {
        
        				$('.book-suggest').append('<ul class="item" data-id="'+value.book_no+'" data-name="'+value.book_title+'"><div class="col s12"><div class="card-panel grey waves-effect lighten-5 z-depth-1"><div class="row valign-wrapper"><div class="col s2"><img src="pictures/phys.jpg" alt="" class=" responsive-img"> <!-- notice the "circle" class --></div><div class="col s8"><span class=" blue-grey-text"><i class="tag">Name: </i>'+value.book_title+'</span><br><span class="black-text"><i class="tag">Book-id:</i>'+value.book_no+'</span><br><span class="black-text"><i class="tag">Publisher: </i>'+value.publisher+'</span></div></div></div></div></ul>');
        			});
                         $('.item').click(function(e) {
                        e.preventDefault();
        		    	var nbr=$(this).data("id");
        		    	var name=$(this).data("name");
                             lost=1;
                             $.ajax({
                                 url:'ajax/lend.php',type:'GET',data:{lost:lost,lost_name:name,lost_nbr:nbr},success:function(data){
                                   if(data){
                                       var resultants=jQuery.parseJSON(data);
                                       $('.book-suggest').html('');
                                        $('#picture').html('<img src="pictures/'+resultants.s_id+'.jpg" alt="" style="height:140px;width:180px;left:6px;";class="responsive-img">');
                         $('#s_id').text(resultants.s_id.toUpperCase()).attr("name",''+resultants.s_id+'');
                         $('#class').text(resultants.class.toUpperCase());
                         $('#section').text(resultants.section.toUpperCase());
                         $('#names').text(resultants.s_name.toUpperCase());
                         $('#bk_names').text(resultants.book_title);
                         $('.pwd').text(resultants.book_no);
                                      $('#ids').show();
                                   }if(data==0){
                                        $('.book-suggest').html('<div class="not-found blue-grey-text white row valign-wrapper"><div class="col s4"><i class="mdi-action-info small"> </i></div><div class="col s6">not yet borowed</div><div class="col s2"></div></div> '); $('.modal-trigger').leanModal();
                                   }
                                 }
                             });
        		    });
                    }//end of else
                    
                   
        		});
        	}
          
        	    });//finding lost books 
            
            
            </script>
 
             
    <div class="card"id="ids">
        <div class="row valign-wrapper card">
        <div id="picture" style="width:75%;">
            </div>
        <div class="identity" style="width:25%;">
            <ul><p>S_ID:<b id="s_id"></b></p></ul>
            <ul><p>CLASS:<b id="class"></b></p></ul>
            <ul><p>SECTION:<b id="section"></b></p></ul>
            <ul><p>ACTIVE:<b id="active">YES</b></p></ul>
            </div>
        </div>
        <form class="row valign-wrapper" id="ids_form">
                <div style="width:80%">
                    <ul> Names:<b id="names"></b></ul>
                    <ul> BOOK:<b id="bk_names"></b></ul>
                   <ul class="row valign-wrapper">Book_no:<table><tr><td class="pwd" id=""contenteditable="false">ndigande</td></tr></table></ul>
            </div>
                <div id="pwd_change" style="width:20%;">
                    <a id="pwd_changer"class="btn-floating btn-small waves-effect waves-light tooltipped small"data-position="top" data-delay="30" data-tooltip="search for an other " style="position:absolute;right:10px;bottom:28px;background-color:rgba(80, 60, 14, 0.91) !important;
    "><i class="mdi-action-trending-up"></i></a>
                </div>    
        </form>
        
    </div>  
    <h2><a href="admin.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
    </body>
      
  </html>

