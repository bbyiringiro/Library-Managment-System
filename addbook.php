<?php

include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
islogged();

//this is when user upload file
if ( isset($_POST["submit"]) ) {
if ( isset($_FILES["file"])) {
//if there was an error uploading the file
if ($_FILES["file"]["error"] > 0) {
echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
}
else {

$file = $_FILES["file"]["tmp_name"];

import_books($file);
$uploadedStatus = 1;
}
} else {
echo "No file selected <br />";
}
}

//for multiple books



if(isset($_GET["multiple"])){
	$nbr=$_GET["nbr"];
	$title=$_GET["title"];
	$cat=$_GET["cat"];
	$auth=$_GET["author"];
	$pub=$_GET["pub"];
	$num=$_GET["num"];
    if(empty($nbr)){
        echo"fill ol stuffs";
       exit;
    }
	
	
$sql="insert into books(book_no,book_title,book_cat,book_author,publisher)values(?,?,?,?,?)";
for ($i=1;$i<=$num;$i++){
      $stmt=$pdo->prepare($sql);
            $stmt->execute(array($nbr.'/'.$i,$title,$cat,$auth,$pub));
}
}


//for one book
$db=new dbHandler(DB_HOST,DB_USER,DB_PWD);
if (isset($_POST['add_book'])){
 $nbr=$_POST["nbr"];
	$title=$_POST["title"];
	$cat=$_POST["cat"];
	$auth=$_POST["author"];
	$pub=$_POST["pub"];
	$sql="insert into books(book_no,book_title,book_cat,book_author,publisher)values(?,?,?,?,?)";
	$db->insertRow($sql, array($nbr,$title,$cat,$auth,$pub));
	if ($db->lastid()){
		echo 'done';
	}
}
else{

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

            
            
            .dropdown-content{
                max-height:200px;
            }
        </style>
    </head>
    <body style="overflow-x:hidden;">
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
    <div class="col s12">
      <ul class="tabs teal">
        <li class="tab col s3"><a class="active" href="#a">add single</a></li>
        <li class="tab col s3"><a  href="#b">add multiple</a></li>
      </ul>
    </div>
      <div id="a" class="">
          <h1>add one book</h1>
        
        <div class="container"> 
            <div class="card-panel grey lighten-5 z-depth-1">
          <div class="row valign-wrapper">
           
                
                 <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
                    <div class="input-field col m12">
                       <i class="mdi-av-my-library-books prefix"></i>
                     <input id="book_name" name="title" type="text" class="validate">
                     <label for="book_name">book title</label>
                    </div>
                    <div class="input-field col m12">
                       <i class="mdi-hardware-keyboard-hide prefix"></i>
                     <input id="book_id" name="nbr" type="text" class="validate">
                     <label for="book_id">book id</label>
                    </div>
                    <div class="input-field col m12">
                       <i class="mdi-editor-mode-edit prefix"></i>
                     <input id="author" name="author" type="text" class="validate">
                     <label for="author">Author</label>
                    </div>
                        
                    <div class="input-field col m12">
                       <i class="mdi-editor-mode-edit prefix"></i>
                     <input id="publisher" name="pub" type="text" class="validate">
                     <label for="publisher">publisher</label>
                    </div>
                    
                       <div class="input-field col s12">
    <select id="cat" name="cat">
      <option value="" disabled selected>select category</option>
      <option value="computer science">computer science</option>
      <option value="novel">novel</option>
      <option value="physics">physics</option>
      <option value="biology">biology</option>
      <option value="chemistry">chemistry</option>
      <option value="english">english</option>
    </select>
    <label>class</label>
  </div>
                    
     <button type="submit" name="add_book">Add book</button>
                    
    </form>

          </div>
        </div>
        </div>       

        
      </div>
        <div id="b">
            <h1>you can upload multiple books </h1>
            
            <div class="container ">
                <div class="row align-center card-panel">
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
                
                </div>
            </div>
            
            <!-- for multiple books -->
<div class="container card-panel" style="margin-left:15%">
          <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="get">
    author <input type="text" name="author">
    name:<input type="text" name="title">
    categories:<input type="text" name="cat">
    nbr:<input type="text" name="nbr">
    publisher:<input type="text" name="pub">
    number:<input type="text" name="num">
        
    <input type="submit" class="btn" name="multiple" value="enter">
        
    </form>
    </div>
        
        </div>
        </div>
        
       
 

	
	 
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/materialize.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">

        $(document).ready(function() {
            $('select').material_select();
              
              
          });
                     
                    $(document).ready(function(){
            $('ul.tabs').tabs();
                        $('ul.tabs').css({
                width:"50%"
            });
          }); 
                
        </script>
        </body>
    </html>
<?php }?>