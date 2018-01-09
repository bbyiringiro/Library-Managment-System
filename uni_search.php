<?php
include_once 'include/func.php';
	session_start();
  

unset($_SESSION['temp']);
?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import materialize.css-->
       
	<link rel="stylesheet" href="assets/css/style.css"> <!-- Resource style -->
    
	
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css"  media="screen,projection"/>
        <link rel="icon" href="assets/img/lib.ico">
        
	<link rel="stylesheet" href="assets/css/main.css">

    

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="js/modernizr.js"></script> <!-- Modernizr -->
        <style>
            body{
                overflow-x:hidden;
            }
#look_up{
    margin-top:-60px;
}

#look_up .btn{
    
    background-color:rgba(34, 33, 33, 0.51);
}
            #look_up .btn:hover{
    background-color:rgba(34, 33, 33, 0.85);
}
            #form-box{
                margin-top:-60px;
                padding:30px 0px;
                padding-top:60px;
            }
            .collapsible-body{
                background-color:rgba(131, 151, 133, 0.89);
            }
            #searching{
                margin-top:-60px;font-size:30px;font-weight:300px; background-color:rgba(48, 43, 43, 0.72);border-radius:10px;
            }
                    .cd-3d-nav li {
    height: 100%;
    width: 32%;
    float: left;
}
        </style>
      </head>

<body>
    <div class="se-pre-con"></div>
    
<header class="cd-header">
		
		<a href="#0" class="cd-3d-nav-trigger left">
			Menu
			<span></span>
		</a>
    
     <dropdown id="dropdown" style="position:absolute;right:-100px;">
  <input id="toggle2" type="checkbox">
  <label for="toggle2" style="position:absolute;right:0;top:-0.5em;"><i class="label mdi-navigation-arrow-drop-down-circle" style="font-size:2em;padding:0px;"></i></label>
  <ul class="animate">
    
    <a href="index1.php" style="color:black"><li class="animate">login (<i style="color:blue;font-size:10px">only admins</i>)<i class="fa fa-cog float-right"></i></li></a>
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
				<a href="outsider.php">Teacher and others</a>
			</li>
            <li>
				<a href="uni_search.php">search(Books)</a>
			</li>

			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->
    
    
    
    

<div class="overlay"></div>
    
    <div class="wrapper">
        <div class="row" style="position:absolute;width:100%; margin-left:2em;">
            <div class="col s8 offset-s1">
                <div class="card-panel" id="form-box">
    <form class="col s12" id="look_up">
      <div class="row" style="margin:0;margin-top: -10px;">
        <div class="input-field col s10">
          <input id="look_box" type="text" class="validate" autocomplete="off">
          <label for="look_box">search</label>
        </div>
          <div class="input-field col s1 offset-s1" style="margin-left:-5px;">
              <button type="submit" class="btn"><i class="mdi-action-search"></i></button>
        </div>
          <div id="suggest" style="position:absolute"></div>
          
      </div>
        <div class="row" style="margin:0">
            <div class="col m1 s12"><input name="group1" data-name="4" type="radio" id="all" checked="checked">
      <label for="all">All</label></div>
            <div class="col m2 s12"><input name="group1" data-name="1" type="radio" id="cat">
      <label for="cat">Category</label></div>
            <div class="col m2 s12"><input name="group1" data-name="2" type="radio" id="auth">
      <label for="auth">Author</label></div>
            <div class="col m2 s12"><input name="group1" data-name="3" type="radio" id="pub">
      <label for="pub">publisher</label></div>
        </div>
    </form>
            </div>
                </div>
            
        </div>
        
    </div>
    
   <div class="container" style="margin-top:100px;">
       <div class="row">
           <h4 id="searching" class="grey-text" ></h4>
           
                <div class="search_results" id="search_results" style="margin-top:60px;" ></div>  

       </div>
   </div> 
   
    
    
    
      <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason</a> 
				in <a>Fi.inc</a></div>
    
    
    
    
    
    
    
        <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

    <script type="text/javascript">
       
	var input = document.getElementById('look_box'),
		form = document.getElementById('look_up'),
		resultDiv = document.getElementById('search_results'),
		result = '',
		resultMarkup = '';

	form.addEventListener('submit', function(e){
                 var category=$('input[type="radio"]:checked').data("name");
        

		//prevent form from submition
		e.preventDefault();
		resultDiv.innerHTML = '<center><img src="test/Preloader_1.gif"></center>';

		var search = input.value;
		//creating a ajax request
		var xhr = new XMLHttpRequest();
		xhr.open("GET" ,"ajax/cat_fetch.php?type="+category+"&s="+search+"");
		xhr.addEventListener('readystatechange', function(){
			if(xhr.readyState === 4){
				if(xhr.status === 200){
					result = JSON.parse(xhr.response);
					//format the result and display them
					if(result.length){
						for (var i = 0; i < result.length; i++) {
							var title = result[i].book_title;
							var no = result[i].book_no;
							var cat = result[i].book_cat;
							var pub = result[i].publisher;
							var auth = result[i].book_author;
							var number = result[i].number;
							resultMarkup += ' <ul class="collapsible popout" data-collapsible="accordion"><li><div class="collapsible-header"><i class="mdi-av-my-library-books"></i>'+title+'<span class="right">'+number+'</span></div><div class="collapsible-body"><p><span>publisher:<b>'+pub+'</b></span><br><span><b>category:'+cat+'</span><br><span >book number: '+no+'</span><br><span >author: '+auth+'</span></p></div></li></ul>';
						};

						//append the results to the results div
						resultDiv.innerHTML = resultMarkup;
						//empty the resultMarkup variable
						resultMarkup = '';
                        if(category==4)
                            var searching="in All";
                        else if(category==1)
                            var searching="according to categories";
                        else if(category==2)
                            var searching="according to Authors";
                        else
                            var searching="accoording to Publishers";
                        
                        $('#searching').html('Searching '+searching+'<hr>');
					}else{
						resultDiv.innerHTML = 'No Result Found';
					}
                      $('.collapsible').collapsible({
      accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
				}
			}

		}, false);
		xhr.send();
	}, false);
       
	</script>    
    
    
      <script src="js/main.js"></script> <!-- Resource jQuery -->
    </body>
  </html>

