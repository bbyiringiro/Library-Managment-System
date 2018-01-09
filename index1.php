<?php
include_once 'include/func.php';
session_start();
if(isset($_SESSION['name']))
    header("location:home.php");

?>


<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
   <link rel="stylesheet" href="assets/css/main.css">
            <link rel="icon" href="assets/img/lib.ico">

  <title>login</title>
    

    <style>
    
        


input {
  outline: none;
}



body {
  font-family: 'Roboto', sans-serif;
  background: -webkit-linear-gradient(315deg, rgba(36, 46, 77, 0.9), rgba(137, 126, 121, 0.9));
  background: linear-gradient(135deg, rgba(36, 46, 77, 0.9), rgba(137, 126, 121, 0.9));
  background: -moz-linear-gradient(315deg, rgba(36, 46, 77, 0.9), rgba(137, 126, 121, 0.9));
  background: -o-linear-gradient(315deg, rgba(36, 46, 77, 0.9), rgba(137, 126, 121, 0.9));
  
    
  overflow: hidden;
    
    
}
        


.panel {
  width: 400px;
  height: 500px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  border-radius: 10px;
  -webkit-box-shadow: 0 0 10px black;
  -moz-box-shadow: 0 0 10px black;
  box-shadow: 0 0 10px black;
  background: #141519;
  margin: 100px auto;
  text-align: center;
    margin-top: 10px;
}

.panel .state {
  margin-top: 5px;
  width: 100%;
  height: 155px;
  color: white;
  font-size: 20px;
}

.panel .state i.fa-ban {
  font-size: 40px;
}

.panel .state i.fa-unlock-alt {
  font-size: 25px;
  color: white;
  line-height: 33px;
  height: 30px;
  width: 30px;
  display: inline-block;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  border: 2px solid;
}

.panel .state h2 {
  font-weight: 400;
}

.panel .form {
  width: 340px;
  margin: 5px auto;
}

.panel .login {
  height: 45px;
  width: 100%;
  background-color: #8bc34a;
  -webkit-border-radius: 45px;
  -moz-border-radius: 45px;
  border-radius: 45px;
  position: relative;
  line-height: 45px;
  text-align: center;
  font-weight: bold;
  color: white;
  margin-top: 10px;
  -webkit-transition: background .2s;
  -moz-transition: background .2s;
  -o-transition: background .2s;
  transition: background .2s;
  cursor: pointer;
}

.panel .login:active {
  -webkit-transform: translateY(2px);
  -moz-transform: translateY(2px);
  -ms-transform: translateY(2px);
  -o-transform: translateY(2px);
  transform: translateY(2px);
}

.panel .login:hover {
  background-color: #599b2d;
}

.panel .login:after {
  content: "\f084";
  font-family: 'FontAwesome';
  position: absolute;
  width: 45px;
  height: 45px;
  background-color: #599b2d;
  color: #fff;
  text-shadow: 1px -1px #467a23, 2px -2px #487d24, 3px -3px #4a8025, 4px -4px #4b8326, 5px -5px #4d8627, 6px -6px #4f8928, 7px -7px #508c28, 8px -8px #528f29, 9px -9px #54922a, 10px -10px #55952b, 11px -11px #57982c;
  left: 0;
  top: 0;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  text-align: center;
  line-height: 45px;
}

.panel input[type='text'],.panel input[type='password'] {
  background-color: #22232a;
  -webkit-border-radius: 45px;
  -moz-border-radius: 45px;
  border-radius: 45px;
  font-size: 15px;
  height: 45px;
  border: none;
  padding-left: 15px;
  width: -webkit-calc(100% - 15px);
  width: -moz-calc(100% - 15px);
  width: calc(100% - 15px);
  margin-bottom: 10px;
}

.panel input[type='text'][placeholder] {
  color: #656d79;
  font-size: 15px;
  font-weight: 500;
}

.panel .fack {
  margin-top: 30px;
  font-size: 14px;
}

.panel .fack i.fa {
  text-decoration: none;
  color: #fff;
  vertical-align: middle;
  font-size: 20px;
  margin-right: 5px;
}

.panel .fack a:link {
  color: #616973;
}

.panel .fack a:visited {
  color: #555c65;
}
        
    
       

    </style>
    </head>
<body>
<?php 

if(isset($_SESSION['error']))
echo '<input type="hidden" value="1" id="error">';

?>
<div class="se-pre-con"></div>
    <div class="overlay"></div>
<div class="panel">
  <div class="state">
    <br><i class="fa fa-unlock-alt"></i>
    <br>
    <h1>Log in</h1></div>
    <span style="color:rgb(176, 176, 176">College Library System</span>
    
  <div class="form">
  <form action="login.php" method="post">
    <input placeholder='username' type="text" name="username" required="required" id="username" style="color:white;" autocomplete="off">
    <input placeholder='Password' type="password" required="required" name="pwd" style="color:white;">
    <input type="submit" class="login" value="Login">
    </form>
  </div>
  <div class="fack"><a href="#"><i class="fa fa-question-circle"></i>Forgot password?</a></div>
</div>

    

    <div class="footer center">
								Copyright &copy; 2015, Designed by 
                                <a title="web designer" data-container="body" data-toggle="popover" data-placement="top" data-content="This web was designed by billy jason ,who's student and he has worked on many geek projects, he is good at both front-end  and server-side" rel="designer">Billy jason</a> in<a> Fi.inc</a> 
				</div>
    
    

    

 
    
    
    
    
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').focus();
            if($('#error').val()=='1'){
            $('.panel').effect("shake", { direction: "horizontal" }, 1000);
            return $('.state').html('<br><i class="fa fa-ban"></i><br><p>enter correct ones</p>').css({
                color: '#eb5638'
              });
            }
           
  return $('.login').click(function(event) {
      
	  
  });

});

        
  </script> 
    <script src="js/main.js"></script> <!-- Resource jQuery -->

    </body>
        
</html>


