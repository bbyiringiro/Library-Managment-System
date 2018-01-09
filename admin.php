<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
islogged();
if (!isset($_SESSION['admin'])&& !$_SESSION['admin']==1)
header("location:admin-log.php");
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$sql="select * from librarians";
$res=$db->getRows($sql);



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
            .header{
                font-weight:300;
                text-transform: uppercase;
                color:#616161;
            }
            tr,td,th{
                padding:0;
                border-bottom:1px black;
            }
            table{
                background-color:#bdbdbd;
                border-radius:5px;
            }
            table #sub-table tr{
                background-color:#bcaaa4;
                border-radius:10px;
            }

            
            #slide-out{
            top:72px;
              z-index:1;  
            background-color:#607d8b;
            }
            .mdi-navigation-menu{
            display:none;}
            .cd-3d-nav-trigger , .cd-header{
                              z-index:2;  

            }
            #wrapper{
                padding-bottom:50px;
                border-radius:5px;
                
            }
            
       </style>
    </head>
    <body style="overflow-x:hidden;">
        <div class="se-pre-con"></div>
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
			<li >
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

			<li class="cd-selected">
				<a href="admin-log.php">Admin</a>
			</li>
			
		</ul> <!-- .cd-3d-nav -->

		<span class="cd-marker color-1"></span>	
	</nav> <!-- .cd-3d-nav-container -->

<div class="row" id="wrapper">
    <div class="col s5 offset-m2 m4 card-panel z-depth-1" style="margin-left:241px;">
           <div class="input-field col s12">
          <i class="mdi-action-search prefix"></i>
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">user Name</label>
        </div>
                
                  <ul class="collection" style="max-height:400px;overflow-y:auto;" id="users">
                  <?php foreach ($res as $row):?>
                   <li class="collection-item avatar user" data-id="<?php echo $row['l_id'];?>" id="<?php echo 'user-'.$row['l_id']?>">
                                                <img src="pictures/nopic.jpg" alt="" class="circle responsive-img valign profile-image">

                      <i class="mdi-social-group icon blue-text"></i>
                      <span class=""><?php  echo $row["name"];?></span>
                      <p class="truncate grey-text ultra-small"><?php echo $row['assign'];?>.</p>
                      <a href="#" class="secondary-content del"><i class="mdi-content-remove-circle red-text"></i></a>

                    </li>
                    <?php endforeach;?>
                      
                    
                   
                  </ul>
                </div>
        <div class="col m5 card-panel z-depth-3" style="margin-left: 5px;">
            <h5 class="center-align grey-text">Add application user</h5>
            <hr>
            
              <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <i class="mdi-action-account-circle prefix"></i>
          <input type="text" class="validate" id="name" required>
          <label for="name">Name</label>
        </div>
        <div class="input-field col s12">
          <i class="mdi-action-lock prefix"></i>
          <input  type="password" class="validate" id="pwd" required>
          <label for="pwd">password</label>
        </div>
          <div class="input-field col s12">
          <i class="mdi-action-lock-open prefix"></i>
          <input  type="password" class="validate" id="verify" required>
          <label for="verify">password</label>
        </div>
         
          <div class="input-field col s12">
          <i class="mdi-content-sort prefix"></i>
          <input type="text" class="validate" id="assgn" required>
          <label for="assgn">user assignment</label>
        </div>
          
         
          <div class="input-field col s2 offset-s5" style="padding:0;margin-bottom:0px;" id="submit" data-status="0">
           <button type="submit" class="waves-effect waves-circle waves-light btn-floating  blue" >
    <i class="mdi-content-add"></i>
  </button>
        </div> 
          
          
          
      </div>
    </form>
                 
                  
  </div>
    </div>
  </div>
        
        
         <ul id="slide-out" class="side-nav fixed">
    <li class="user-details cyan darken-2">
                <div class="row">
                    <div class="col col s4 m4 l4">
                        <img src="pictures/nopic.jpg" alt="" class="circle responsive-img valign profile-image">
                    </div>
                    <div class="col col s8 m8 l8">
                        
                        <a class="btn-flat dropdown-button waves-effect waves-light white-text" href="#" data-activates="profile-dropdown">College<i class="mdi-navigation-arrow-drop-down "></i></a>
                            
                        <ul id="profile-dropdown" class="dropdown-content">
                            <li><a href="index.php"><i class="mdi-action-face-unlock"></i>Home</a>
                            </li>
                            <li><a href="$"><i class="mdi-action-settings"></i> Settings</a>
                            </li>
                            
                            <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                            </li>
                        </ul>
                        <p class="user-roal">Administrator</p>
                    </div>
                </div>
            </li>
             <li >
                 
             <a href="admin.php" >librarians <i class="mdi-social-people right blue-text"></i>
</a>
                 
             </li>
    <li><a href="#!" id="report">make reports                  <i class="mdi-action-view-headline right blue-text"></i>
</a></li>
    <li><a href="#!">add categories</a></li>
    <li><a href="edit.php">settings</a></li>
  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        <div class="footer center" style="margin-left:245px;">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason</a> in<a> Fi.inc</a> 
				</div>
    
        
        
        <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
          <a class="btn-floating btn-large red">
            <i class="large mdi-editor-mode-edit"></i>
          </a>
          <ul>
            
            <li><a href="export.php?allstud=1" class="btn-floating yellow darken-1 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Make report of all students(to desktop)"  style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="large mdi-editor-insert-chart"></i></a></li>
            <li><a  href="export.php?report=1" class="btn-floating green tooltipped" data-position="bottom" data-delay="50" data-tooltip="make report of these students<br> who owe the books(to desktop)" style="transform: scaleY(0.4) scaleX(0.4) translateY(40px); opacity: 0;"><i class="large mdi-editor-publish"></i></a></li>
          </ul>
        </div>
        
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
    $('#submit').click(function(e){
                if($(this).attr('data-status')==0){
                    return false;}
                e.preventDefault();
                var pwd=$('#pwd');
                var verify=$('#verify');
                var name=$('#name');
                var assgn=$('#assgn');
                if(name.val().length  == 0 || verify.val().length  == 0 || pwd.val().length  == 0 || assgn.val().length == 0){
                    alert("fill all box");return false;
                }
                
                if(pwd.val()!=verify.val()){
                    alert("password not matched");
                    $('#pwd,#verify').css({color:"red"});
                    return false;
                }
                p=pwd.val();
                     n=name.val();
                     a=assgn.val();
                
                 $.ajax({
                     
        	    	 url: 'ajax/add-admin.php',
        	    	 type:'POST',
        	    	 data:{name:n,pwd:p,assgn:a},
                     beforeSend:function(){},
	                 success: function(id){
                         name.val(''),pwd.val(''),assgn.val(''),verify.val('');
                         $('#users').prepend(' <li class="collection-item avatar user" data-id="'+id+'" id="user-'+id+'" ><img src="pictures/nopic.jpg" alt="" class="circle responsive-img valign profile-image"><i class="mdi-social-group icon blue-text"></i><span class="">'+n+'</span><p class="truncate grey-text ultra-small">'+a+'</p><a href="#" class="secondary-content del"><i class="mdi-content-remove-circle red-text"></i></a></li>');
 

                         
                           $('.user .del').click(function(){
                             
                             var id=$(this).parent().data('id');

                             $.ajax({
                                 
                    	    	 url: 'ajax/add-admin.php',
                    	    	 type:'POST',
                    	    	 data:{del:'1',id:id},
                                 beforeSend:function(){},
             	                 success: function(data){
                	                 $('#user-'+id+'').slideUp();
                                     
                                     }
                                     
                             });
                             
                             }); 
                        
                         }
                         
                 });
                         
                         
                     
        
        
        
    });
    
    
  
                
            
                    $('.fixed-action-btn').hide();

            $('#slide-out a').click(function(){
                $(this).addClass('waves-effect waves-teal');
            });
            


    
    $('.user .del').click(function(){
                             
                             var id=$(this).parent().data('id');

                             $.ajax({
                                 
                    	    	 url: 'ajax/add-admin.php',
                    	    	 type:'POST',
                    	    	 data:{del:'1',id:id},
                                 beforeSend:function(){},
             	                 success: function(data){
                	                 $('#user-'+id+'').slideUp();
                                     
                                     }
                                     
                             });
                             
                             }); 
    
    
    
    $('#report').click(function(){
        $('.footer').fadeOut();
        $('.fixed-action-btn').fadeIn();
        
         $.ajax({
                                 
                    	    	 url: 'ajax/view.php',
                    	    	 type:'POST',
                    	    	 data:{},
                                 beforeSend:function(){},
             	                 success: function(data){
                	                 $('#wrapper').html(data);
                                     
                                     }
                                     
                             });
    });
    
    
    
    $('#name').keyup(function(){     
    var name=$('#name').val();
        
    $('#submit').fadeTo('fast', 0.4);
    if (name.length >= 1) {
    

      $.ajax({
        
          
        	    	 url: 'ajax/check.php',
        	    	 type:'post',
                    data:{l_name:name},
                     beforeSend:function(){
                         
                     },
	                 success: function(data){
                        if(data==1){
                            Materialize.toast('<span>This user name is already used by other(use other)</span><a class="btn-flat yellow-text"  href="#1"><a>', 6000)
                            $('#status').html('<i class="mdi-navigation-cancel  medium red-text"></i>');
                            $('#loader span').hide();
                            $('#submit').fadeTo('fast', 0.4);
                            $('#submit').attr('data-status','0');
                        }
                         else{
                             $('#submit').fadeTo('fast', 1);
                             $('#submit').attr('data-status','1');
                         }
                     
                         
                     }
});
    
    }
});

   
       
            }); 
        </script>
        </body>
    </html>
