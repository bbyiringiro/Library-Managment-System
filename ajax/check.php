<?php 
session_start();
include_once '../include/manage.inc.php';
include_once '../include/config.php';

$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);
if (isset($_POST['book_id'])){
	
	$sql="select * from books where book_no=?";
	$res=$db->getRow($sql, array($_POST['book_id']));
	if (empty($res))
		echo 0;
		else 
		echo 1;
	
    
    
}
elseif (isset($_POST['l_name'])){
	$sql="select * from librarians where name=?";
	$res=$db->getRow($sql, array($_POST['l_name']));
	if (empty($res))
		echo 0;
		else 
		echo 1;
	
}


?>