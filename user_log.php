<?php

if(isset($_POST['pwd'])){
    // Include database credentials and connect to the database
include_once 'include/db.class.php';
include_once 'include/config.php';
    if(isset($_SESSION['temp']))
unset($_SESSION['temp']);
    
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);

    $q="select * from students where s_id=? and pass=? limit 1";
	$stmt = $db->db->prepare($q);
$stmt->execute(array($_POST['id'],$_POST['pwd']));
$row=$stmt->rowCount();
$stmt=$stmt->fetch();
	
if ($row == 0)
echo false; 
else{
    session_start();
    $_SESSION['temp']=$stmt['s_id'];
echo true;
    
}
  exit;  
    
}

    

?>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/logoff.css">
        
        <style>
        
        @import url(assets/font-awesome-4.3.0/css/font-awesome.min.css);   
        </style>
    </head>
    <body>
        <h2><a href="index.php" id="link" style="color:#37a69b;"><i class="mdi-hardware-keyboard-backspace"></i></a></h2>

        <div class="login-container"></div>
<div class="login"><img src="pictures/<?php echo $_GET['id'];?>.jpg" class="login-user-img"/>
  <p class="login-name"></p>
  <div class="input-container">
    <input id="input" type="password" placeholder="Enter Password" class="login-input"/><span class="arrow"> </span>
  </div>
</div>
        
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function(){
                
             var $input = $('#input');
var $arrow = $('.arrow');

$input.on('keyup change', function() {
  var password = $(this).val().length;
  if (password > 0) {
    $arrow.css({
      'opacity': 1
    });
  } else {
    $arrow.css({
      'opacity': 0
    });
  }
});
            $('.arrow').click(function(){

                var pwd={pwd:$input.val(),id:<?php echo $_GET['id'] ?>};

                $.post('user_log.php',pwd,function(data){

                    if(data)
                       window.location='student1.php?stud='+<?php echo $_GET['id'] ?>;
                    else
                        $('.input-container').effect("shake", { direction: "horizontal" }, 500);$('.login-input').val('');
                    
                        
                });
            })
            
            
            $(document).keypress(function(evt){
    if(evt.which==13){
         var pwd={pwd:$input.val(),id:<?php echo $_GET['id'] ?>};

                $.post('user_log.php',pwd,function(data){

                    if(data)
                       window.location='student1.php?stud='+<?php echo $_GET['id'] ?>;
                    else
                        $('.input-container').effect("shake", { direction: "horizontal" }, 500);$('.login-input').val('');
                    
                        
                });
    }
                else
                    $input.focus();
                
          });
    });
        </script>
    </body>
</html>