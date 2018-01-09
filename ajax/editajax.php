<?php
include_once '../include/manage.inc.php';
include_once '../include/config.php';

$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
if(isset($_POST['column'])){
$col=htmlentities(strip_tags($_POST['column']));
$val=strip_tags($_POST['editval']);
$id=htmlentities(strip_tags($_POST['id']));
$sql="update students set $col=? where s_id=?";
$res=$db->updateRow($sql,array($val,$id));


}
if (isset($_POST['class'])){
	
	$arr=strip_tags($_POST['class']);
	list($class,$section)=explode('+',$arr);
	$sql="select * from students where class=? and section=?";
	$res=$db->getRows($sql,array($class,$section));
	
	echo json_encode($res);
}