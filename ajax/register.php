<?php 
include_once '../include/db.class.php';
include_once '../include/config.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);

if (isset($_POST['name'])){
$query="select count(*) as 'count' from prof_out where id!=?";
    $i=0;
$res=$db->getRow($query,array($i));
    $res_count=$res['count']+1;
    $pro_id="pro_"."$res_count";
    if(isset($_POST['file'])){//for outsiders profiles
        
        
    }
$sql="insert into prof_out(pro_id,name,title) values(?,?,?)";
$db->insertRow($sql,array($pro_id,$_POST['name'],$_POST['func']));
}
?>