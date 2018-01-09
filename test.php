


 <?php 
include_once 'include/func.php';
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
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" href="assets/css/materialize.min.css">
</head>
<body>


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
<div class="container">
    <form action="test.php" method="get">
    author <input type="text" name="author">
    name:<input type="text" name="title">
    categories:<input type="text" name="cat">
    nbr:<input type="text" name="nbr">
    publisher:<input type="text" name="pub">
    number:<input type="text" name="num">
        
    <input type="submit" class="btn" name="submit" value="enter">
        
    </form>
    </div>
    <h1><?php echo getenv("HOMEDRIVE").getenv("HOMEPATH") ?></h1>
</body>
</html>

<?php 
include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';


$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);



if(isset($_GET["submit"])){
	$nbr=$_GET["nbr"];
	$title=$_GET["title"];
	$cat=$_GET["cat"];
	$auth=$_GET["author"];
	$pub=$_GET["pub"];
	$num=$_GET["num"];
	
	
$sql="insert into books(book_no,book_title,book_cat,book_author,publisher)values(?,?,?,?,?)";
for ($i=1;$i<=$num;$i++){
      $stmt=$pdo->prepare($sql);
            $stmt->execute(array($nbr.'/'.$i,$title,$cat,$auth,$pub));
}

   
}
$db=new dbHandler(DB_HOST,DB_USER,DB_PWD);
$sql="select * from students s join activity a on s.s_id=a.s_id and a.fine=0 order by s.class asc,s.section asc";
$res=$db->getRows($sql);
print_r($res);


		
	
	



?>