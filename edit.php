<?php
include_once 'include/func.php';
include_once 'include/db.class.php';
include_once 'include/config.php';

islogged();
if (!isset($_SESSION['admin'])&& !$_SESSION['admin']==1)
header("location:admin-log.php");

$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['class'])){
    if($_POST['class'] != '0'){
	$arr=strip_tags($_POST['class']);
	list($class,$section)=explode('+',$arr);
	$sql="select * from students where class=? and section=?";
	$results=$db->getRows($sql,array($class,$section));
    }
}
}


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
      
.dropdown-content {
    max-height:300px;
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
    
    
    
    

<div class="overlay"></div>
    
      <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason</a> 
				in <a>Fi.inc</a></div>
    
    
    
    
    
    <div class="container">
        <div class="row">
              <div class="input-field col s5">
              <?php $db=new dbHandler(DB_HOST,DB_USER,DB_PWD,null);
              $sql="select distinct class,section from students ";
              $res=$db->getRows($sql,array());
              
              ?>
                  
    <select id="option">
      <option value="" disabled selected>Choose your class</option>
      <?php foreach ($res as $row):?>
      <option value="<?php echo $row['class'].'+'.$row['section'] ?>"><?php echo $row['class'].' '.$row['section']?></option>
      <?php endforeach;?>
    </select>
    <label>Select any class</label>
  </div>
            <div class="col s7">
                <div class="col s5">
                <form method="post">
<label for="class">Select class</label>
<select name="class">
    <option value="0" disabled selected>Choose your class</option>
<?php foreach ($res as $row):?>
      <option value="<?php echo $row['class'].'+'.$row['section'] ?>"><?php echo $row['class'].' '.$row['section']?></option>
      <?php endforeach;?>
</select>

              
                    </div>
                <div class="col s2">
                    <input type="submit" value="search" class="btn"/>
</form>
                </div>
            </div>
            
        </div>
            
            
        <div class="row card-panel " style="overflow-y:scroll;max-height:510px;">
                 <table class="tbl-qa hoverable">
		  <thead>
			  <tr>
				<th class="table-header" width="10%">class id</th>
				<th class="table-header" width="10%">student id</th>
				<th class="table-header">name</th>
				<th class="table-header">class</th>
				<th class="table-header">section</th>
			  </tr>
		  </thead>
		  <tbody id="students">
              
		  <?php 
      if (isset($results)):

$count=0;
		  foreach ($results as $dis):
		  $count++;?>
		  
		  <tr class="table-row"><td><?php echo $count;?></td>
		  <td><?php echo $dis['s_id']?></td><td contenteditable="true" onBlur="saveToDatabase(this,'<?php echo $dis['s_id']?>');" data-name="s_name" onClick="showEdit(this);"><?php echo strtoupper(strip_tags($dis['s_name']))?></td><td contenteditable="true" onBlur="saveToDatabase(this,'<?php echo $dis['s_id']?>');" data-name="class" onClick="showEdit(this);"><?php echo strtoupper($dis['class'])?></td><td contenteditable="true" onBlur="saveToDatabase(this,'<?php echo strtoupper($dis['s_id'])?>');" data-name="section" onClick="showEdit(this);"><?php echo strtoupper($dis['section'])?></td></tr>
		  
			 
              <?php endforeach; endif;?>
		  </tbody>
		</table>
            </div>
        </div>
    
        <!--Import jQuery before materialize.js-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

        <script type="text/javascript">
              </script>
      <script type="text/javascript">
                       var s_name=new String("s_name");
                        var clas='class';
                        var section='section';                 

 $(document).ready(function() {
    $('select').material_select();
     
      $('.tbl-qa').hide();
      <?php if (isset($results)){
              echo '$(".tbl-qa").show()';
      }
              ?> 
     
  });
          
          
          function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,id) {
            var column=$(editableObj).data('name');
			$(editableObj).css("background","#FFF url(test/loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "ajax/editajax.php",
				type: "POST",
				data:{column:column,editval:editableObj.innerHTML,id:id},
				success: function(data){
					$(editableObj).css("background","transparent");
				}        
		   });
		}
          
          
          
          
          
          $('#option').change(function(){
	 var option=$('#option').val();
             option=new String(option);
         
             
               $.ajax({
        	    	 url: 'ajax/editajax.php',
        	    	 type:'POST',
        	    	 data:{class:option},
                     beforeSend:function(){},
	                 success: function(data){
                         var msg =jQuery.parseJSON(data);
                         
                         $('#students').html('');
                        var count=0;
                         $(msg).each(function(key, value) {
                             count++;
                             $('.tbl-qa').show();
                            
                        
                        $('#students').append('<tr class="table-row"><td>'+count+'</td><td>'+value.s_id+'</td><td contenteditable="true" onBlur="saveToDatabase(this,'+value.s_id+');" data-name="s_name" onClick="showEdit(this);">'+value.s_name.toUpperCase()+'</td><td contenteditable="true" onBlur="saveToDatabase(this,'+value.s_id+');" data-name="class" onClick="showEdit(this);">'+value.class.toUpperCase()+'</td><td contenteditable="true" onBlur="saveToDatabase(this,'+value.s_id+');" data-name="section" onClick="showEdit(this);">'+value.section.toUpperCase()+'</td></tr>');
                         })
                         
                         
                     
                     }
        
        
        
    });
              
              
            
	});
	</script>
      <script src="js/main.js"></script> <!-- Resource jQuery -->
    </body>
  </html>

