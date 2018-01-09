<?php
// If an admin is being created, save it here
if($_SERVER['REQUEST_METHOD'] == 'POST'
&& $_POST['action'] == 'createuser'
&& !empty($_POST['username'])
&& !empty($_POST['pwd']))
{
	$name=$_POST['username'];
	$pwd=$_POST['pwd'];
// Include database credentials and connect to the database

include_once 'include/db.class.php';
include_once 'include/config.php';
include_once 'include/func.php';
    islogged();
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);
$sql = "select l_id,name from librarians where name=? and pwd= SHA1(?) limit 1";

$stmt = $db->getRow($sql, array($name, $pwd));
$row=$stmt->rowCount();
	
if ($row == 0)
{
$sql = "INSERT INTO  librarians(name, pwd)
VALUES(?, SHA1(?))";
$db->insertRow($sql,array($name, $pwd));
}

$stmt = $db->prepare($sql);
$stmt->execute(array($name, $pwd));
header('Location: login.php');
exit;
}
