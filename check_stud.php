<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';

$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);

    $sql="select * from students where s_id=? and activate=? ";
    $sqlo="select * from prof_out where pro_id=? and activate=?";
    $pro=htmlentities($_GET['id']);
if(!isset($_GET['id'])){
    
header("location:./");
}
else if(isset($_GET['id'])&&is_numeric($_GET['id'])){
    
    if(!empty($db->getRow($sql,array($_GET['id'],'1')))){
        header("location:user_log.php?id=".$_GET['id']);
        
    }


}else{
     if(!empty($db->getRow($sqlo,array($pro,'1')))){
        header("location:user_log.php?id=".$_GET['id']);
        
    }  
}
//if that id doesn't existst in database
if(is_numeric($_GET['id'])){
$sql="select * from students where s_id=?";
$res=$db->getRow($sql,array($_GET['id']));
 if(empty($res))
     header("location:./");


if(isset($_POST['pwd'])&&!empty($_POST['pwd'])){
    $sql="select s_id,activate from students where s_id=?";
$res1=$db->getRow($sql,array($_GET['id']));
    if(is_null($res1['activate'])){
$val=$_POST['pwd'];
        $id=$_GET['id'];
        $sql="update students set pass=?,activate=1 where s_id=?";
$res=$db->updateRow($sql,array($val,$id));
        header("location:user_log.php?id=".$res1['s_id']);
    }
    else
        header("location:./");
}
}
else{
    
    
   $sql="select * from prof_out where pro_id=?";
$res=$db->getRow($sql,array($pro));
 if(empty($res))
     header("location:./");


if(isset($_POST['pwd'])&&!empty($_POST['pwd'])){
    $sql="select pro_id,activate from prof_out where pro_id=?";
$res1=$db->getRow($sql,array($pro));
    if(is_null($res1['activate'])){
$val=$_POST['pwd'];
        $id=$_GET['id'];
        $sql="update prof_out set pass=?,activate=1 where pro_id=?";
$res=$db->updateRow($sql,array($val,$id));
        header("location:user_log.php?id=".$res1['pro_id']);
    }
    else
        header("location:./");
} 
    
    
}

?>
<html>
<head>
    <title>
        Admin login
    </title>
        <link rel="icon" href="assets/img/lib.ico">
 <link rel="stylesheet" href="assets/css/materialize.min.css">
    

    <style>
        html { height: 100% }
body {
  background-image: radial-gradient(rgba(92,100,111,0.5) 0%,rgba(31,35,40,1) 100%); 
    

}
        #link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }

        .overlay{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: url(img/bg.jpg) 50% 50% no-repeat;
  background-size: cover;
  -webkit-filter: blur(15px);
  filter: blur(12px);
  z-index: -1;

}
.login {
  background: #eceeee;
  border: 1px solid #42464b;
  border-radius: 6px;
  height: 300px;
  margin: 20px auto 0;
  width: 298px;
}
.login h1 {
  background-image: linear-gradient(#f1f3f3, #d4dae0);
    
  border-bottom: 1px solid #a6abaf;
  border-radius: 6px 6px 0 0;
  box-sizing: border-box;
  color: #727678;
  display: block;
  height: 43px;
  font: 600 14px/1 'Open Sans', sans-serif;
  padding-top: 14px;
  margin: 0;
  text-align: center;
  text-shadow: 0 -1px 0 rgba(0,0,0,0.2), 0 1px 0 #fff;
  user-select: none;
}
input[type="password"], input[type="text"] {
  background: url('test/ibhqW9Buanohx2.png') center left no-repeat, linear-gradient(#d6d7d7, #dee0e0);
  border: 1px solid #a1a3a3;
  border-radius: 4px;
  box-shadow: 0 1px #fff;
  box-sizing: border-box;
  color: #696969;
  height: 39px;
  margin: 31px 0 0 29px;
  padding-left: 37px;
  transition: box-shadow 0.3s;
  width: 240px;
}
input[type="password"]:focus, input[type="text"]:focus {
  box-shadow: 0 0 4px 1px rgba(55, 166, 155, 0.3);
  outline: 0;
}
.show-password {
  display: block;
  height: 16px;
  margin: 26px 0 0 28px;
  width: 87px;
}
input[type="checkbox"] {
  cursor: pointer;
  height: 16px;
  opacity: 0;
  position: relative;
  width: 64px;
}
input[type="checkbox"]:checked {
  left: 29px;
  width: 58px;
}
.toggle {
  background: url(test/ibitS19pe8PVX6.png) no-repeat;
  display: block;
  height: 16px;
  margin-top: -20px;
  width: 87px;
  z-index: -1;
}
input[type="checkbox"]:checked + .toggle { background-position: 0 -16px }
.forgot {
  color: #7f7f7f;
  display: inline-block;
  float: right;
  font: 12px/1 sans-serif;
  left: -19px;
  position: relative;
  text-decoration: none;
  top: -15px;
  transition: color .4s;
}
.forgot:hover { color: #3b3b3b }
input[type="submit"] {
  background-color: #37a69b;
  background-image: linear-gradient(#3db0a6,#319d91);
  border: 1px solid #256f67;
  border-radius: 4px;
  box-shadow: inset 0 1px rgba(255,255,255,0.3);
  box-sizing: border-box;
  color: #f8f8f8;
  font-weight: 700;
  height: 39px;
  margin: 12px 0 0 29px;
  text-shadow: 0 -1px 0 #177c6a;
  width: 240px;
}
input[type="submit"]:hover, input[type="submit"]:focus {
  background-image: linear-gradient(#4ec7c0,#31aba3)
}
input[type="submit"]:active {
  background-image: linear-gradient(#319d91, #3db0a6);
	padding: 0;
}
.shadow {
  background: #000;
  border-radius: 12px 12px 4px 4px;
  box-shadow: 0 0 20px 10px #000;
  height: 12px;
  margin: 30px auto;
  opacity: 0.2;
  width: 270px;
}
        
    </style>
</head>
    <?php if(isset($_GET['id'])&&is_numeric($_GET['id'])){?>
    <body>
        <div class="se-pre-con"></div>
<div class="overlay"></div>
<h2><a href="index.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>


<div class="login">
  
  <h1><?php echo $res['s_name'] ?><span style=" color:rgba(179, 162, 162, 0.76);"><?php echo   '  '.$res['class'].' '.strtoupper($res['section']) ?></span></h1>
  <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$_GET['id']?>" method="post" id="form">
  <input id="pass" placeholder="password" type="password" name="pwd" />
  <input id="retry" placeholder="password" type="password" />
  
  <label for="c" class="show-password">
    <input type="checkbox" id="c"/>
    <i class="toggle"></i>
  </label>
  
  <a class="forgot" href="#" >Don't forget this</a>
  
  <input type="submit" id="sub" value="Activate" />
  </form>
</div>
<div class="shadow"></div>


<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/materialize.min.js"></script>
        
<script>
    $('#c').change(function(){
  
  if (this.checked) {
    $('#pass').attr('type', 'text');
  } else {
    $('#pass').attr('type', 'password');
  }
  
});

    $('#sub').click(function(e){
        if($('#pass').val().length<=0)
            return false;
        
        if($('#pass').val()!=$('#retry').val())
        {
                $('#form').effect("shake")
                Materialize.toast('<span>Password not matched </span><a class="btn-flat yellow-text"  href="#1">Verify<a>', 1000)

            return false;
            e.preventDefault();
        }
    }
                    );
</script>
</body>
    <?php } else{ ?>
    <body>
        <div class="se-pre-con"></div>
<div class="overlay"></div>
<h2><a href="index.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>


<div class="login">
  
  <h1><?php echo $res['name'] ?><span style=" color:rgba(179, 162, 162, 0.76);"><?php echo strtoupper($res['title']) ?></span></h1>
  <form action="<?php echo $_SERVER['PHP_SELF'].'?id='.$pro?>" method="post" id="form">
  <input id="pass" placeholder="password" type="password" name="pwd" />
  <input id="retry" placeholder="password" type="password" />
  
  <label for="c" class="show-password">
    <input type="checkbox" id="c"/>
    <i class="toggle"></i>
  </label>
  
  <a class="forgot" href="#" >Don't forget this</a>
  
  <input type="submit" id="sub" value="Activate" />
  </form>
</div>
<div class="shadow"></div>


<script src="js/jquery.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/materialize.min.js"></script>
        
<script>
    $('#c').change(function(){
  
  if (this.checked) {
    $('#pass').attr('type', 'text');
  } else {
    $('#pass').attr('type', 'password');
  }
  
});

    $('#sub').click(function(e){
       
        if($('#pass').val().length<=0)
            return false;
        
        if($('#pass').val()!=$('#retry').val())
        {
                $('#form').effect("shake")
                Materialize.toast('<span>Password not matched </span><a class="btn-flat yellow-text"  href="#1">Verify<a>', 1000)

            return false;
            e.preventDefault();
        }
    }
                    );
</script>
</body>
    <?php }?>
</html>