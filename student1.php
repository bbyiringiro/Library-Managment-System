<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
session_start();
if (isset($_GET['stud'])&& !empty($_GET['stud'])){
    
    
    if(!isset($_SESSION['temp']) || $_SESSION['temp']!=$_GET['stud'])
                        header("location:./");
	$stud=$_GET['stud'];
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$res=$db->getRows('select *  from students where s_id=? limit 1 ',array($stud));
if(empty($res))
header("location:404");

//sql about the pending books
$sql="select b.book_title  b_name ,b.book_no 'nbr',a.due_date 'date_borrowed',a.return_date 'return' from activity a inner join books b on a.book_no=b.book_no where a.s_id=? and a.fine=0 and a.outsider=0 order by date_borrowed desc";
//sql about the the history
$sql2="select b.book_title  b_name ,b.book_no 'nbr',a.due_date 'date_borrowed',a.return_date 'return'  from activity a inner join books b on a.book_no=b.book_no where a.s_id=? and a.fine=1 and a.outsider=0 order by date_borrowed desc ";
 /* codes about fetching transaction from server --> */
//pending
         $pending=$db->getRows($sql,array($stud));
         //history
         $hist=$db->getRows($sql2,array($stud));
}//end of first if 
else header("location:home.php");


//checking if picture of user exist to set a defualt
if(file_exists('pictures/'.$res[0]['s_id'].'.jpg')){
	$studentpic='pictures/'.$res[0]['s_id'].'.jpg';
}
else 
$studentpic='pictures/'."nopic.jpg";


?>
<!Doctype html>
<html>
    <head>
    <link rel="icon" href="assets/img/lib.ico">
        
     
        <link rel="stylesheet" href="assets/css/materialize.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/studpage.css">
        <style>
            .cd-3d-nav li {
    height: 100%;
    width: 32%;
    float: left;
}
            .done:hover{
                opacity:0.5;
            }
        </style>
    </head>
    <body style="overflow:hidden">
        <div class="se-pre-con"></div>
    <div class="overlay"></div>
        
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
		
	        <form action="check_stud.php" method="get">
			<input id="search" type="search" placeholder="Quick Search" name="id" autocomplete="off"/>
                </form>
			<ul style="position:absolute;width:250px;" class="z-depth-3">
			</ul>
		</div>
         
   
    
	</header> <!-- .cd-header -->
	
	
	
<nav class="cd-3d-nav-container">
		<ul class="cd-3d-nav">
			<li class="cd-selected">
				<a href="logout.php">Search</a>
			</li>
            <li>
				<a href="outsider.php">Teacher and others</a>
			</li>
            <li>
				<a href="logout.php?dir=1">search(Books)</a>
			</li>

			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->
      
        



        
        
        
  
        <div class="container">
              <div class="row valign-wrapper card-panel">
                 <div class="col m5">
                     
                     <div class="row">
        <div class="col m10">
          <div class="card">
            <div class="card-image">
              <img src="<?php echo $studentpic ;?>">
              <span class="card-title"><?php $n=explode(' ',$res[0]['s_name']);echo $n[0];?></span>
            </div>
            <div class="card-content">
              <p><b>Name</b>:<?php echo strtoupper($res[0]['s_name']);?></p>
              <p><b>Class</b> <?php echo ucwords($res[0]['class']).' '.ucwords( $res[0]['section']);?></p>
              <p><b>Number</b> <?php echo $res[0]['s_id'] ?></p>
            </div>
            <div class="card-action">
              <div class="row valign-wrapper">
                  <div id="owe_nbr" class="col m6"><h5>0 Books</h5></div>
                  <div class="col m6">since 2015</div>
              </div>
            </div>
          </div>
        </div>
      </div>
                     

            
                 </div>
                 <div class="col m7" id="book_box">
                      <form class="col s12">
                          <div class="row">
                          <div class="input-field col m10">
          <i class="mdi-action-account-circle prefix"></i>
          <input id="icon_prefix" type="text"  class="validate">
          <label for="icon_prefix">Enter book ID</label>
        
        </div>
                              <div class="col m2">
                                  <a class=" btn">lend</a>
                              </div>
                          </div>
                          <div class="row">
                              <div class="collection book-suggest">
                                  
    <a href="#!" class="collection-item">Search for a book using it's number<span class="badge">pick</span></a>

   
    
  </div>
                              <div class="col s12" id="datepicker">
                                  <input type="date" id="date" class="datepicker">
                              </div>
                          </div>
      
    </form>
                 </div>
                  
                  
  
              </div><!-- end of first row -->
            <div class="row">
                <div class="row" >
    <div class="col s12">
      <ul class="tabs">
        <li class="tab col s3"><a class="active grey darken-1" href="#tab1" style="color:white;">Pending books</a></li>
        <li class="tab col s3"><a  href="#tab2" class=" grey darken-1" style="color:white;">History</a></li>
       
      </ul>
    </div>
    <div id="tab1" class="col s12" >
        
        <!-- about pending books -->
        <table id="pending">
        <thead>
           <tr>
              <th data-field="id" style="padding:0 5px">No</th>
              <th data-field="name">Name</th>
              <th data-field="price">ISBN</th>
              <th data-field="due_date">Due date</th>
              <th data-field="day">Return<br>
              </th> <th data-field="day">Current<br>
                  class
              </th> <th data-field="day">
              </th> <th data-field="day">
              </th>
          </tr>
        </thead>

        <tbody>
       
          
           <?php 
        
if (empty($pending))
echo '<div class="no-pending center-align blue-grey lighten-5"><h5 class="flow-text">No pending book</h5></div>';
else {
    $c=0;
foreach ($pending as $row):
	
$c++;
         ?>

        
          <tr>
            <td class="tick waves-effect waves-light" style="padding:5px 5px;"><?php echo $c ?></td>
            <td class="book-title"><?php echo $row['b_name']; ?></td>
            <td class="book-nbr"><?php echo $row['nbr'] ?></td>
            <td><?php echo $row['date_borrowed'] ?></td>
            <td><?php echo $row['return'] ?></td>
          </tr>
         
        
        
        <?php endforeach; }?>
          
        </tbody>
      </table>
        
        
    </div>
    <div id="tab2" class="col s12">
        
        <div style="overflow-y:scroll;max-height:300px;" class="hist">
               <table class="hoverable striped bordered">
        <thead>
          <tr>
              <th data-field="id">No</th>
              <th data-field="name">Name</th>
              <th data-field="price">ISBN</th>
              <th data-field="due_date">due date</th>
              <th data-field="day">returned<br>
                  day
              </th>
          </tr>
        </thead>
        
        <tbody>
        
        
         <?php 
        
if (empty($hist))
echo '<div class="no-pending center-align blue-grey lighten-5"><h5 class="flow-text">He never borrow a book</h5></div>';
else {
	$count=0;
foreach ($hist as $row2):
	$count++;

         ?>

        
          <tr >
            <td><b><?php echo $count;?></b></td>
            <td class="book-title"><?php echo $row2['b_name']; ?></td>
            <td class="book-nbr"><?php echo $row2['nbr'] ?></td>
            <td><?php echo $row2['date_borrowed'] ?></td>
            <td><?php echo $row2['return'] ?></td>
          </tr>
         
        
        
        <?php endforeach; }?>
          
         
                </tbody>
                
      </table>
      </div>
    </div>
  </div>
        
                
            </div><!--end of second row -->
            
            
            <div class="row">
                 <div class="activity card-panel">
                 
                 
        
                
 
            
            
            </div>
                
            </div>
            
           
        </div>
        
        
  <!-- Modal Trigger -->

 <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      
        <form>
                    <div class="input-field col m12">
                       <i class="mdi-av-my-library-books prefix"></i>
                     <input id="book_name" type="text" class="validate">
                     <label for="book_name">book title</label>
                    </div>
                    <div class="input-field col m12">
                       <i class="mdi-hardware-keyboard-hide prefix"></i>
                     <input id="book_id" type="text" class="validate">
                     <label for="book_id">book id</label>
                    </div>
                    <div class="input-field col m12">
                       <i class="mdi-editor-mode-edit prefix"></i>
                     <input id="author" type="text" class="validate">
                     <label for="author">Author</label>
                    </div>
                        
                    <div class="input-field col m12">
                       <i class="mdi-editor-mode-edit prefix"></i>
                     <input id="publisher" type="text" class="validate">
                     <label for="publisher">publisher</label>
                    </div>
                    
                       <div class="input-field col s12">
    <select id="cat">
      <option value="" disabled selected>select category</option>
      <option value="1">computer science</option>
      <option value="1">novel</option>
      <option value="1">physics</option>
      <option value="1">biology</option>
      <option value="1">chemistry</option>
      <option value="1">english</option>
    </select>
    <label>class</label>
  </div>
                    
     
                    
    </form>
        
        
        
    </div>
    <div class="modal-footer">
        <div class="row">
            <div class="col s2">
                
               <div id="loader">
                       <span><img src="test/load.gif"></span>
            
               </div></div>
            <div class="col s2">
                <div id="status"></div>
            </div>
            <div class="col s10">
                <a id="addbook" data-status="0" class="btn-floating btn-large waves-effect waves-light teal right" style="margin-top:-5px; right:0;"><i class="mdi-content-add"></i></a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">close</a>
            </div>
            
        </div>
        
        
        
                    
    </div>
  </div>
        
        
        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
         <a href="logout.php" class="btn-floating btn-large green done tooltipped" data-position="top" data-delay="50" data-tooltip="If you are done ">
            <i class="large mdi-action-thumb-up"></i>
          </a>
        </div>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
           
  
        $(document).ready(function(){
            /*
               $(window).ready(function(){
                $(window).on("contextmenu",function(){
                   return false;})
           
           
});
*/            
            updateP_nbr();
            //selecting book script
        	$('#icon_prefix').keyup(function() {
        		var keyword=$('#icon_prefix').val();
        	if (keyword.length >= 1) {
        		if ($('.book-suggest').length < 1) {
        	        $('#book_box').append('<ul id=".book-suggest"></ul>');
        	    }
        		$.get( "ajax/lend.php", { book: keyword } ).done(function( data ) {
        			$('.book-suggest').html('');
        			var results =jQuery.parseJSON(data);
                    if($.isEmptyObject(results)){
                        $('.book-suggest').html('<div class="not-found blue-grey-text white row valign-wrapper"><div class="col s2"><i class="mdi-action-info medium"> </i></div><div class="col s8">that book is not found, first add it  in database</div><div class="col s2"><a class="btn-floating btn-large waves-effect waves-light red modal-trigger" href="#modal1"><i class="mdi-content-add"></i></a></div></div> '); $('.modal-trigger').leanModal();
                    }
                    else{
        			$(results).each(function(key, value) {
        				
        				$('.book-suggest').append('<li class="item" data-id="'+value.book_no+'" data-name="'+value.book_title+'"><div class="col s12"><div class="card-panel grey waves-effect lighten-5 z-depth-1"><div class="row valign-wrapper"><div class="col s2"><img src="pictures/BOOK.png" alt="" class=" responsive-img"> <!-- notice the "circle" class --></div><div class="col s8 book_name"><span class=" blue-grey-text"><i class="tag">Name: </i>'+value.book_title+'</span><br><span class="black-text"><i class="tag">Book-id:</i>'+value.book_no+'</span><br><span class="black-text"><i class="tag">Publisher: </i>'+value.publisher+'</span></div><div class="col s2"><a href="#!" class="waves-effect waves-circle waves-light btn-floating secondary-content z-depth-2"><i class="mdi-content-add"></i></a></div></div></div></div></li>');
        			});
                    }//end of else
                    
                    $('.item').click(function(e) {
                        var dat=$('#date').val();
                        dat=' '+dat;
                        if(dat==' '){
                        $('#datepicker').effect('shake');
                        $('#datepicker input').css({color:'rgba(72, 8, 8, 0.92)',background:'rgba(255, 0, 0, 0.2)'})
                            return false;
                        }

            			e.preventDefault();
        		    	var nbr=$(this).data("id");
        		    	var name=$(this).data("name");
        		    	//calling function to output on screen
                        thiss=$(this);
                        $('#datepicker').css({color:'black'})
        		    	lendbook(nbr,name,dat,thiss);
                        updateP_nbr();
        		    	
        		    })
        			
        		});
        	}
          
        	    });//end of lending
            
            


    	    function lendbook(book_nbr,name,d,thiss)
    	    {
    	    	$.ajax({
        	    	 url: 'ajax/lend.php',
        	    	 type:'GET',
        	    	 data:{lend:'',book_nbr:book_nbr,user:<?php echo $stud?>,date:d},
	success: function(msg){
		if(msg==1){
            thiss.effect('shake');
			Materialize.toast('<span>you have reached the maximum books </span><a class="btn-flat yellow-text"  href="#1">bring what you have lent<a>', 5000)
			}
		else if(msg==0){
            var now=new Date();
            thiss.slideUp('5000');
            $('.no-pending').fadeOut();
			$('#pending tbody').prepend('<tr>--> <td></td><td class="book-title">'+name+'</td><td class="book-nbr">'+book_nbr+'</td><td class="truncate">'+now+'</td><td>'+d+'</td><td class="status">0</td></tr>');
                      $('.tooltipped').tooltip({delay: 50});

		}
	}
	
});
                
               
updateP_nbr();
}
           

        });
//update books pending book
    function updateP_nbr(){
        
        $.ajax({
        	    	 url: 'ajax/lend.php',
        	    	 type:'GET',
        	    	 data:{u:<?php echo $stud?>},
                     beforeSend:function(){},
	                 success: function(data){
                         var msg =jQuery.parseJSON(data);
                         $(msg).each(function(key, value) {
                             
                        $('#owe_nbr').fadeOut();
                         $('#owe_nbr').text(value.count+' Books').fadeIn();
                         })
                         
                         
                     
                     }
        
        
        
    });
        }
            
            
            

      
function undo(event){
    event.preventDefault();
    alert('you will be undoing the bring back of book');
   

}  
     $(document).ready(function() {
    $('select').material_select();
         
         
         
$('#addbook').click(function(){
    if($(this).attr('data-status')==0){
       return false;
    }
     var title=$('#book_name').val();
     var nbr=$('#book_id').val();
     var cat=$('#cat').val();
     var author=$('#author').val();
     var pub=$('#publisher').val();
   if(title.length==0 || nbr.length==0 || cat.length == 0 || author.length== 0 || pub.length== 0){
         alert("fill all box");
    return false;
     }
    $.ajax({
        
          
        	    	 url: 'addbook.php',
        	    	 type:'post',
                         data:{add_book:'',nbr:nbr,title:title,cat:cat,author:author,pub:pub},
                     beforeSend:function(){},
	                 success: function(data){
                         $('#modal1').closeModal();
                         
                     
                     }
  });     
});  
  
    
});
        
        
$('#book_id').keyup(function(){     
    var nbr=$('#book_id').val();
    $('#addbook').fadeTo('fast', 0.4);
    if (nbr.length >= 1) {
    

      $.ajax({
        
          
        	    	 url: 'ajax/check.php',
        	    	 type:'post',
                    data:{book_id:nbr},
                     beforeSend:function(){
                         $('#loader span').show();
                         
                     },
	                 success: function(data){
                        if(data==1){
                            Materialize.toast('<span>Id of a book you are trying to register is already exist( may be that book was lent )</span><a class="btn-flat yellow-text"  href="#1"><a>', 6000)
                            $('#status').html('<i class="mdi-navigation-cancel  medium red-text"></i>');
                            $('#loader span').hide();
                            $('#addbook').fadeTo('fast', 0.4);
                            $('#addbook').attr('data-status','0');
                        }
                         else{
                             $('#status').html('<i class="mdi-navigation-check  medium blue-text"></i>');
                             $('#loader span').hide();
                             $('#addbook').fadeTo('fast', 1);
                             $('#addbook').attr('data-status','1');
                         }
                     
                         
                     }
});
    
    }
});
     
        
        $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
  });
        
        

</script>
    </body>
</html>
