<?php session_start(); unset($_SESSION['id']);
if (!isset($_SESSION['name']))
header("location:./");?>



<html>
    <head>
        <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
        <link rel="stylesheet" href="assets/css/logoff.css">
        <style>
        
        @import url(assets/font-awesome-4.3.0/css/font-awesome.min.css);

body {
  margin: 0;
  padding: 0;
  background: #333;
  color: #F5F5F5;
  font-family: 'Lato', sans-serif;
  overflow:hidden;
}

.login-container {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url(img/bg.jpg) 50% 50% no-repeat;
  background-size: cover;
  -webkit-filter: blur(15px);
  filter: blur(15px);
  z-index: -1;
}
.login-container:after {
  position: absolute;
  content: '';
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(245, 245, 245, 0.2);
}

.login {
  position: relative;
  width: 100%;
  height: 100%;
  min-height: 100%;
  top: 10em;
  text-align: center;
}

.login-user-img {
  max-width: 80px;
  height: 80px;
  display: block;
  margin: 1em auto;
  border-radius: 50%;
}

::-webkit-input-placeholder {
  color: #F5F5F5;
}

.input-container {
  position: relative;
  max-width: 250px;
  margin: 0 auto;
}

.login-input {
  position: relative;
  width: 150px;
  max-width: 300px;
  display: inline-block;
  margin: 0 auto;
  color: #F5F5F5;
  background: rgba(245, 245, 245, 0.5);
  border: 0;
  outline: 0;
  border-radius: .5em;
  padding: .75em;
}

.arrow {
  cursor: pointer;
  opacity: 0;
  position: absolute;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  padding: 0.5em;
  vertical-align: middle;
  background: rgba(245, 245, 245, 0.4);
  top: 0;
  right: 0;
  font-size: 1.1em;
  font-weight: bold;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.arrow:after {
  position: absolute;
  content: '\2192';
  left: 5px;
  top: 2.4px;
}
.link{
    border-radius:5px;
            }
.link:hover{
    background-color:rgba(245, 245, 245, 0.47);
    
        
}
        
        </style>
    </head>
    <body>
        <div class="login-container"></div>
<div class="login"><img src="img/bg.jpg" class="login-user-img"/>
  <p class="login-name"><?php echo $_SESSION['name'];?></p>
  <div class="input-container">
    <input id="input" type="password" placeholder="Enter Password" class="login-input"/><span class="arrow"> </span>
  </div>
  <a href="logout.php" class="link">login with other name</a>
</div>
        
        
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script>
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
                var pwd={pwd:$input.val()};
                $.post('login.php',pwd,function(data){
                    if(data)
                        location.href='home.php';
                    else
                        $('.input-container').effect("shake", { direction: "horizontal" }, 500);$('.login-input').val('');
                    
                        
                });
            })
            
            
            $(document).keypress(function(evt){
    if(evt.which==13){
        var pwd={pwd:$input.val()};
                $.post('login.php',pwd,function(data){
                    if(data)
                        location.href='home.php';
                    else
                        $('.input-container').effect("shake", { direction: "horizontal" }, 500);$('.login-input').val('');
                    
                        
                });
        
    }
                else
                    $input.focus();
                
          });
    
        </script>
    </body>
</html>