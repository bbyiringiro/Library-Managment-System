<?php
include_once '../include/manage.inc.php';
include_once '../include/config.php';

$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);

if (isset($_GET['class'])){
	
	$arr=$_GET['class'];
	list($class,$section)=explode('+',$_GET['class']);
	$class=htmlentities(strip_tags($class));
	$section=htmlentities(strip_tags($section));
	
	$sql="select * from students where class=? and section=?";

			$stmt = $db->db->prepare($sql);
$stmt->execute(array($class,$section));
$res_count=$stmt->rowCount();
$res=$stmt->fetchAll();
			echo json_encode($res);
	
	}