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
	$sql="select * from students where class=? and section=? and still is null";
	$res=$db->getRows($sql,array($class,$section));
	
	echo json_encode($res);
}

if(isset($_GET['t_ci'])&&isset($_GET['t_cn'])&&!empty($_GET['t_cn'])&&!empty($_GET['t_ci'])){
$newclass="";
    $cls=strtoupper(htmlentities(strip_tags($_GET['t_cn'])));
    $sid=htmlentities(strip_tags($_GET['t_ci']));
    switch($cls){
        case 'S1':
            $cls="S2";
            break;
        case 'S2':
            $cls="S3";
                break;
        case 'S3':
            $cls="fin";
            break;
        case 'S4':
            $cls="S5";
            break;
        case 'S5':
            $cls="S6";
                break;
        case 'S6':
            $cls="final";
            break;  
            
        default:
            $cls=htmlentities($_GET['t_cn']);
    }
    if($cls!=null){
        $sql="update students set class=?,still=1 where s_id=? ";
        $res=$db->updateRow($sql,array($cls,$sid));
        echo "1";
    }
    else{
        echo "0";
    }
}
if(isset($_GET['agreement'])&&!empty($_GET['agreement'])){
    $agreement=htmlentities($_GET['agreement']);
    if($agreement==1){
        $id=0;
        $sql="update students set still=null where s_id!=?";
        $re=$db->updateRow($sql,array($id));
        echo "1";
    }else{
        echo json_encode($agreement);
    }
}
if(isset($_GET['undo_promotions'])&&!empty($_GET['undo_promotions'])){
    $undoing=htmlentities($_GET['undo_promotions']);
$sql="select * from students where still=?";
    $selres=$db->getRows($sql,array($undoing));
    if(!empty($selres)){
        $ok=0;
        foreach($selres as $setres){
            $backto='';
            $sclass=strtoupper(htmlentities($setres['class']));
            if($sclass=='S2'){
                $backto="s1";
            }else if($sclass=='S3'){
                 $backto="s2";
            }else if($sclass=='FIN'){
                 $backto="s3";
            }else if($sclass=='S5'){
                 $backto="s4";
            }else if($sclass=='S6'){
                 $backto="s5";
            }else if($sclass=='FINAL'){
                 $backto="s6";
            }else{
                echo json_encode($setres['class']);
            }
            $sql="update students set class=?,still=null where s_id=?";
            $r=$db->updateRow($sql,array($backto,$setres['s_id']));
            $ok=1;
        }
        echo json_encode($ok);
    }else
            echo "0";
}
?>