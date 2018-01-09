<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';


 
islogged();

       
      
         $db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
        
 $option="SELECT DISTINCT section FROM `students`  WHERE  'section' NOT IN(select section from students where section='fin' and section='final')";  
$options=$db->getRows($option);

$uploadedStatus = 0;




if(isset($_POST["register"])){
    if(!empty($_POST['names'])&&!empty($_POST['section'])&&!empty($_POST['class'])&&!empty($_POST['file'])){
   $name=htmlentities($_POST['names']);
   $class=htmlentities($_POST['class']);
   $section=htmlentities($_POST['section']);
        if((strtoupper($class)=='S4'||strtoupper($class)=='S5'||strtoupper($class)=='S6')&&(strtoupper($section)=='A'||strtoupper($section)=='B'||strtoupper($section)=='C')){
            echo "<span class='white'  style='position:absolute;bottom:15px;left:28%;'><b><h3>Make sure class and section make sence<b></h3></span>";
            break;
        }else{
             $tes_n="select * from students where s_name='".$name."' and class='".$class."' and section='".$section."' limit 1";
         $db=new PDO(DB_HOST, DB_USER, DB_PWD);
            $stmt=$db->prepare($tes_n);
        $stmt->execute();
        $tes_no=$stmt->rowCount();
     if($tes_no>0){
         
        echo "<span class='white'  style='position:absolute;bottom:15px;left:25%;'><b><h3>It seems this student has been  recorded before <b></h3></span>";
     
     }else{
         $insert="insert into students(s_name,class,section) values(?,?,?) ";
         $stmt=$db->prepare($insert);
         if($stmt->execute(array($name,$class,$section))){
              $get_id="select s_id from  students where s_name='".$name."' and class='".$class."' and section='".$section."' limit 1";
         $db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
             
        $get_i=$db->getRows($get_id,array($name,$class,$section));
         if(!empty($get_i)){
             list($name, $type, $tmp, $err, $size) = array_values($_FILES['profile']);
             if($err!=UPLOAD_ERR_OK){
               echo "<span class='white'  style='position:absolute;bottom:15px;left:34%;'><b><h3>an error occured while uploading you can rename this image manually<b></h3></span>"; 
            return; }
             else{
                $dir_to="/library/pictures/".$get_i[0]['s_id']."";
                 $absolute = $_SERVER['DOCUMENT_ROOT'] . $dir_to;
                 if(!move_uploaded_file($tmp, $absolute))
{
throw new Exception("Couldn't save the uploaded file!");
}
             }
          echo "<span class='white'  style='position:absolute;bottom:15px;left:29%;'><b>Successfully  recorded with this id:<h3>".$get_i[0]['s_id']."<b></h3></span>";
     }else{
             echo "<span class='white'  style='position:absolute;bottom:15px;left:34%;'><b><h3>id not found<b></h3></span>";
         }
         }
        
     }
        }
    
}else{
        
        echo "<span class='white'  style='position:absolute;bottom:15px;left:34%;'><b><h3>please provide info in all fields<b></h3></span>";
    }
}








if ( isset($_POST["submit"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {

$file = $_FILES["file"]["tmp_name"];

import_stud($file);
$uploadedStatus = 1;
}
} else {
echo "No file selected <br />";
}
}
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
        <link rel="stylesheet" href="assets/css/tuto.css">
        
        <style>
#link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }

::selection {
  background-color: #b5e2e7;
}

::-moz-selection {
  background-color: #8ac7d8;
}


h1 {
  text-align: center;
  font-size: 175%;
  color: #757575;
  font-weight: 300;
}

h1, input {
  font-family: "Open Sans", Helvetica, sans-serif;
}

.input {
  width: 75%;
  height: 50px;
  display: block;
  margin: 0 auto 15px;
  padding: 0 15px;
  border: none;
  border-bottom: 2px solid #ebebeb;
}
.input:focus {
  outline: none;
  border-bottom-color: #00796b!important;
}
.input:hover {
  border-bottom-color: #00796b;
}
.input:invalid {
  box-shadow: none;
}

.pass:-webkit-autofill {
  -webkit-box-shadow: 0 0 0 1000px white inset;
}

.inputButton {
  position: relative;
  width: 85%;
  height: 50px;
  display: block;
  margin: 30px auto 30px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  -ms-border-radius: 5px;
  border-radius: 5px;
  color: white;
  background-color: #009688 ;
  border: none;
  -webkit-box-shadow: 0 5px 0 #004d40;
  -moz-box-shadow: 0 5px 0 #004d40;
  box-shadow: 0 5px 0 #004d40;
}
.inputButton:hover {
  top: 2px;
  -webkit-box-shadow: 0 3px 0 #004d40;
  -moz-box-shadow: 0 3px 0 #004d40;
  box-shadow: 0 3px 0 #004d40;
}
.inputButton:active {
  top: 5px;
  box-shadow: none;
}
.inputButton:focus {
  outline: none;
}
#link{
            position:absolute;
            left:10px;top:10px;
            box-shadow: 0 0 5px;
        }
        #link:hover{
            box-shadow:0 0 50px;
        }

            
             .dropdown-content{
                max-height:200px;
            }

            
       



        </style>
    </head>
    <body style="overflow-x:hidden;">
<h2><a href="index.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>

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


 <div class="row">
    <div class="col s12" style="position:absolute;width:50%;left:25.5%;top:5%;">      
      <ul class="tabs teal" sytle="width:100%">
        <li class="tab col s3"><a class="active" href="#a">register single</a></li>
        <li class="tab col s3"><a  href="#b">register multiple</a></li>
      </ul> 
    </div>
      <div id="a" style='position:absolute;top:8%;left:15%'>
          <h1>Registering a student</h1>
        
        <div class="container"> 
            <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
           
                
                <form action="<?PHP echo $_SERVER["PHP_SELF"];?>"  method="POST" enctype="multipart/form-data">
                    <div class="input-field col m12">
                       <i class="mdi-action-account-circle prefix"></i>
                     <input id="icon_prefix" name="names" type="text" class="validate">
                     <label for="icon_prefix" >Names</label>
                    </div>
                      <div class="input-field col s12">
    <select name="class">
      <option value="" disabled selected>Choose class</option>
      <option value="S1">S1</option>
      <option value="S1">S2</option>
      <option value="S1">S3</option>
      <option value="S1">S4</option>
      <option value="S1">S5</option>
      <option value="S1">S6</option>
    </select>
    <label name="class">class</label>
  </div>
                     <div class="input-field col s12">
    <select name="section">
      <option value="" disabled selected>Choose section</option>
      <?php 
       foreach($options as $opt):
        ?>
        <option value="<?php echo strtoupper($opt['section']);?>"><?php echo strtoupper($opt['section']);?></option>
        <?php endforeach;
        ?>
    </select>
    <label>section</label>
  </div>
                    <div class="row input-field col s12">
    <div class="file-field input-field" >
      <input class="file-path validate" name="file"  type="text"/>
      <div class="btn">
        <span>profile<i class="mdi-file-file-upload"></i></span>
        <input type="file"  name="profile" />
      </div>
        </div>
    </div>
                    
                    
         <input type="submit" name="register" value="Register" class="inputButton"/>       
                    
    </form>

          </div>
        </div>
        </div>       

        
      </div>
        <div id="b" style="position:absolute;width:73%;top:15%;left:14%;">
            <h1>Upload excel file containing students</h1>
            <button id="cd-tour-trigger" class="waves-effect waves-teal btn-large blue-text cd-btn tooltiped "  data-position="top" data-delay="50" data-tooltip="How to"><i class="large mdi-action-help  "></i></button>
            
            <div class="container">
            <div class="white card-panel" style="max-height:200px;overflow-y:auto;">
</div>
                
                <div class="row align-center">
                
<table width="600" style="margin:115px auto; background:#f8f8f8; border:1px solid #eee; padding:20px 0 25px 0;">
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
<tr><td colspan="2" style="font:bold 21px arial; text-align:center; border-bottom:1px solid #eee; padding:5px 0 10px 0;">

<tr><td colspan="2" style="font:bold 15px arial; text-align:center; padding:0 0 5px 0;">Browse and Upload Your File </td></tr>
<tr>
<td width="50%" style="font:bold 12px tahoma, arial, sans-serif; text-align:right; border-bottom:1px solid #eee; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Select file</td>
<td width="50%" style="border-bottom:1px solid #eee; padding:5px;"><input type="file" name="file" id="file" /></td>
</tr>
<tr>
<td style="font:bold 12px tahoma, arial, sans-serif; text-align:right; padding:5px 10px 5px 0px; border-right:1px solid #eee;">Submit</td>
<td width="50%" style=" padding:5px;"><input type="submit" name="submit" /></td>
</tr>
    </td>
    </tr>
    </form>
</table>


                </div>
            </div>
        </div>
        </div>
        
       
 

	
        <!-- tour tuto -->
        <div id="tuto">
        
		

	<ul class="cd-tour-wrapper">
		<li class="cd-single-step">
			<span>Step 1</span>

			<div class="cd-more-info bottom">
				<h2>Step Number 1</h2>
				<p>make sure you have done promotions to add other classes, if ready the first step is to allocate where the file is:.</p>
				<img src="img/step-1.png" alt="step 1">
			</div>
		</li> <!-- .cd-single-step -->

		<li class="cd-single-step">
			<span>Step 2</span>

			<div class="cd-more-info top">
				<h2>Step Number 2</h2>
				<p>The second step is to click submit button</p>
				<img src="img/step-2.png" alt="step 2">
			</div>
		</li> <!-- .cd-single-step -->

		<li class="cd-single-step">
			<span>Step 3</span>

			<div class="cd-more-info right">
				<h2>Step Number 3</h2>
				<p>Make sure that ,in excel file each sheet is named the name of class like "S1  A "</br> and names of students must be in first column you  can see some samples first</p>
				<img src="img/step-3.png" alt="step 3">
			</div>
		</li> <!-- .cd-single-step -->
	</ul> <!-- .cd-tour-wrapper -->

</div>
	 
        
    
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script src="js/tuto.js" type="text/javascript"></script>
         <script type="text/javascript">

     
            $(document).ready(function() {
                $('#res_status').hide();
            $('select').material_select();
              $('#b').hide();
              
          });
                     
                    $('.tab').click(function(){
            
               
                      $('#res_status').show();
               
          }); 
            
            
           
        </script>  
        <h2><a href="home.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>



        </body>
    </html>
