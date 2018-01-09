<?php
session_start();
// Include database credentials and connect to the database
include_once 'include/db.class.php';
include_once 'include/config.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);



if($_SERVER['REQUEST_METHOD'] == 'POST'
&& !empty($_POST["username"])
&& !empty($_POST["pwd"]))
{
	$name=$_POST["username"];
	$pwd=$_POST["pwd"];

$sql = "select l_id,name from librarians where name=? and pwd=? limit 1";

$stmt = $db->db->prepare($sql);
$stmt->execute(array($name,$pwd));
$row=$stmt->rowCount();
$stmt=$stmt->fetch();
	
if ($row == 0)
{
$_SESSION['error']=1;
header("location:index1.php");
}
else
{
	
	
	unset($_SESSION['error']);
$res=$stmt;
$_SESSION['id']=$res['l_id'];
$_SESSION['name'] = $res['name'];
$_SESSION['check']=false;
header('Location: home.php');
exit;
}
}
else{ 
	if (isset($_POST['pwd'])){
	//from semi-login
	$name=$_SESSION['name'];
	$pwd=$_POST['pwd'];
	$q="select * from librarians where name=? and pwd=?";
	$stmt = $db->db->prepare($q);
$stmt->execute(array($name,$pwd));
$row=$stmt->rowCount();
$stmt=$stmt->fetch();
	
if ($row == 0)
echo false; 
else{
$res=$stmt;
$_SESSION['id']=$res['l_id'];
echo true;
}
	}else 
	   header("location:404");

	
	
}