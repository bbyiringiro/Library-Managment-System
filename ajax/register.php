<?php 
include_once '../include/db.class.php';
include_once '../include/config.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);

if (isset($_POST['name'])){

$sql="insert into prof_out(name,title) values(?,?)";
$db->insertRow($sql,array($_POST['name'],$_POST['func']));
}
?>