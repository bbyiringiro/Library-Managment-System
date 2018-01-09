<?php 
session_start();
include_once '../include/manage.inc.php';
include_once '../include/config.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);
if (isset($_SESSION['admin'])&& isset($_POST['name'])&& isset($_POST['pwd'])){
	$sql="insert into librarians(name,pwd,assign) values(?,?,?)";
	
	$db->insertRow($sql, array($_POST['name'],$_POST['pwd'],$_POST['assgn']));
	echo $db->lastid();
}
if(isset($_POST['del'])&& isset($_POST['id'])){
	$sql="delete from librarians where l_id=?";
	$db->deleteRow($sql,array($_POST['id']));
	
}
?>