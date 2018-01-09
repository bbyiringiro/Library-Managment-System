<?php
include_once 'include/func.php';
include_once 'include/config.php';
include_once 'include/db.class.php';
$export_what=0;
$GLOBALS['per_html']="";
$htm="<img src='college.jpg' style='left:2px;top:2px;height:100px;width:80px;'/><p><center><u><b>Library Periodic History</b></u></center><p>";

  
//is history requested
islogged();
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id ,activity.book_no ,activity.due_date,activity.fine,activity.id,activity.current_class,students.s_name,books.book_title,activity.outsider from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id!=? ORDER BY activity.due_date ASC";
$result=array();
	$result=$db->getRows($query,array('0'));
 
?>
<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>

 <?php

if (empty($result))
$htm.='<div class="no-history center-align blue-grey lighten-5"><h5 class="flow-text">No history yet</h5></div>';
else {
foreach ($result as $res):
if($res['outsider']==1){
    $res_nam=$db->getRow('select name from prof_out where id=?',array($res['s_id']));
    $res_name=$res_nam['name'];
}else{
    $res_name=$res['s_name'];
}
    
$htm.="<tr><td class='book-title'>".$res['s_id']."</td><td class='book-title'>".$res_name."</td><td class='book-title'>".$res['book_title']."</td><td class='book-nbr'>".$res['book_no']."</td><td>". $res['current_class']."</td>";
 endforeach;
        $htm.="</tbody></table></form></div>";
$export_what=1;
}//end else 

?>
<!DOCTYPE html>
  <html>
    <head>
          <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
          <script src="js/main.js"></script> <!-- Resource jQuery -->


        <script type="text/javascript">
  //ready the dom.
$(document).ready(function(){
   
  $('#exporting').click(function(){
  var to_export=<?php echo json_encode($export_what)?>;
  
  if(to_export==1&&!isNaN(<?php echo json_encode($_GET['id'])?>)){
    window.location='export_history.php?id='+<?php echo json_encode($_GET['id'])?>
  }else{
       window.location='export_history.php?whole=1';
  }
  });
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
.card-image{

}
.all_history{ 
position:absolute;
left:5%;
top:12em;
height:32.2em;
width:90%;
box-shadow: 0 0 8px;
overflow-x:hidden;
overflow-y:auto;
}
#link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }

     #all_history{

    background-color: rgba(198, 195, 204, 0.57);
}
.personal_history{
    position:absolute;
            left:20%;top:100px;
            box-shadow: 0 0 5px;
     
    width:60%;
}
#personal_history{
     background-color: rgba(156, 181, 175, 0.72);
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
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason & Ndigande alain </a> 
				in <a href="about.php" style="color:blue;" class="tick waves-effect waves-light tooltipped" data-position="top" data-delay="50" data-tooltip="This is Future Intelligents group composed by 7 students ,studied in college saint andre(click for more info) ">Fi.inc</a></div>
<a id="exporting" class="btn-floating  green btn-large waves-effect waves-light  tooltipped "data-position="top" data-delay="50" data-tooltip="PRINT HISTORY" style="position:absolute;right:2px;bottom:2px;background-color: rgba(70, 65, 64, 0.56) !important;
    " target="_blank"><i class="large mdi-action-print"></i></a>
      </body>
  </html>
<?php
if(isset($_GET['id'])&&!empty($_GET['id'])){
//check if it is whole or personal
$id=trim(mysql_real_escape_string(htmlentities($_GET['id'])));

if($id=="hist"){
    
    //requested as whole 
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id ,activity.book_no ,activity.due_date,activity.fine,activity.id,activity.current_class,students.s_name,books.book_title,activity.outsider from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id!=?  ORDER BY activity.due_date ASC";
$result=array();
    
	$result=$db->getRows($query,array($id));
?>
<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
<div class="all_history">
<form id="all_history">
<table class="hoverable striped bordered">
        <thead>
           <tr>
               <th data-field="price">S_id</th>
               <th data-field="price">S_name</th>
               <th data-field="price">Book name</th>
		   <th data-field="id">ISBN</th>
              <th data-field="Due_date"> due date</th>
              <th data-field="day">Class</th> 
               <th data-field="day">Returned</th>
          </tr>
        </thead>
        <tbody>
           <?php 
if (empty($result))
echo '<div class="no-history center-align blue-grey lighten-5"><h5 class="flow-text">No history yet</h5></div>';
else {
foreach ($result as $res):
if($res['outsider']==1){
    $res_nam=$db->getRow('select name from prof_out where id=?',array($res['s_id']));
    $res_name=$res_nam['name'];
}else{
    $res_name=$res['s_name'];
}
         ?>
          <tr>
<td class="book-title"><?php echo $res['s_id']; ?></td>
<td class="book-title"><?php echo $res_name; ?></td>
            <td class="book-title"><?php echo $res['book_title']; ?></td>
            <td class="book-nbr"><?php echo $res['book_no'] ?></td>
            <td><?php echo $res['due_date'] ?></td>
 <td><?php echo $res['current_class'] ?></td>
              <td><b><i><?php if($res['fine']==0)echo"no"; else echo"yes";?></i></b></td>
          </tr>
        
        <?php endforeach; }?>
          
        </tbody>
      </table>
</form>
</div>
<?php

}//end if 
else{//only personal requested
    
    
    
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id 's_id' ,activity.book_no 'book_no',activity.due_date 'due_date',activity.fine 'fine',activity.current_class 'current_class',students.s_name 's_name',books.book_title 'book_title',students.class 'class',students.section 'section' from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id=? and activity.outsider=0 ORDER BY activity.fine DESC";
$result=array();
	$result=$db->getRows($query,array($id));
    
        if (empty($result))
echo '<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
<div style="position:absolute;width:60%;top:200px;left:20%;"class="no-personal center-align blue-grey lighten-5"><h5 class="flow-text">This student never borrowed a book yet</h5></div>';
else {
 

?>
<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
<div  class="personal_history card">
<div class="row valign-wrapper card-panel" style="width:100%;" id="identities">
    <div class="card-image" style="width:40%;">
<img src="pictures/college.jpg" alt="" style="width:60%;height:130px;">
</div>
<div class="card-ids" style="width:40%;">
<p><b>Name:</b><?php echo strtoupper($result[0]['s_name']);?></p>
<p><b>Class:</b><?php echo ucwords($result[0]['class']).' '.ucwords( $result[0]['section']);?></p>
<p><b>S_id:</b><?php echo $result[0]['s_id'];?></p>
</div>
<div class="card-image" style="width:20%;">
<img src="pictures/<?php $pic=".jpg"; $pic=$result[0]['s_id'].$pic;echo $pic;?>" alt="" style="width:99%;height:130px;">
</div>
</div>
<form style="height:21.7em; overflow-x:hidden; overflow-y:auto;">
<table class="hoverable striped bordered" id="personal_history">
        <thead>
           <tr>
              <th data-field="price">Book name</th>
		   <th data-field="id">ISBN</th>
              <th data-field="Due_date"> due date</th>
              <th data-field="day">Class</th> 
               <th data-field="day">Returned</th>
          </tr>
        </thead>
        <tbody>
<?php
   
foreach ($result as $res):
    
?>
           
          <tr>
            <td class="book-title"><?php echo $res['book_title']; ?></td>
            <td class="book-nbr"><?php echo $res['book_no'] ?></td>
            <td><?php echo $res['due_date'] ?></td>
 <td><?php echo $res['current_class'] ?></td>
              <td><b><i><?php if($res['fine']==0)echo"no"; else echo"yes";?></i></b></td>

          </tr>
        
        <?php
   endforeach;
}//end else
            ?>
          
        </tbody>
      </table>
</form>
</div>
<?php


}//end else 
}

?>
