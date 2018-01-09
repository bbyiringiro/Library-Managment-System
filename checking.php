<?php
session_start();
	if(!isset($_SESSION['id'])){
	echo  -1;
	return false;
	}
include_once 'include/config.php';
include_once 'include/db.class.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
class  netw_notify {
public function  notify($id){
    $date=date("Y-m-d");
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$fine=0;
    
$query="select  activity.s_id ,activity.book_no ,activity.return_date,activity.due_date ,activity.id,students.s_name,students.class,students.section,books.book_title from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.checked is null and activity.id>? and activity.fine=? and activity.due_date like ?";
$result=array();
$result=$db->getRows($query,array($id,$fine,$date.'%'));
if(!empty($result)){
echo json_encode($result);
}
}//end notify 
	public function coun(){//notify to  check number
	$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
		$date=date("Y-m-d");
$fine=0;
$query="select * from  activity where checked is null  and fine=? and due_date like? ";
$result=$db->getRows($query,array($fine,$date.'%'));
		$num=0;
		foreach($result as $res){
		$num++;
		}
	
		echo $num;
		
		
	}
    public function notified($s_id,$book_no){
        $checked=1;
    $db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
        $query="update activity set checked=? where s_id=? and book_no=? ";
        $res = $db->db->prepare($query);
$res->execute(array($checked,$s_id,$book_no));
    }
}//end class

class before{
//the one not checked before
	public function bef(){
	 $date=date("Y-m-d");
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
	
$fine=0;
    
$query="select  activity.s_id ,activity.book_no ,activity.return_date,activity.due_date ,activity.id,students.s_name,students.class,students.section,books.book_title from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.checked is null and activity.fine=? and activity.due_date < ? ORDER BY activity.due_date DESC";
$result=array();
	$result=$db->getRows($query,array($fine,$date));
	if(!empty($result)){
	echo json_encode($result);
	}else{
	//got some codes if there is no pending unchecked
	}
	}//end function before 
}//end before class
if(isset($_GET['content'])){
$content=trim(mysql_real_escape_string(htmlentities($_GET['content'])));
	if($content==1){
	$befor=new before();
	$befor->bef();
	}
}
if(isset($_GET['count'])){
$possen=new netw_notify();
$possen->coun();
}
if(isset($_GET['id'])){
		$id = trim(mysql_real_escape_string(htmlentities($_GET['id'])));
$possen=new netw_notify();
$possen->notify($id);
}
if(isset($_GET['s_id'])&&isset($_GET['book_no'])&&!empty($_GET['s_id'])&&!empty($_GET['book_no'])){
    $s_id = trim(mysql_real_escape_string(htmlentities($_GET['s_id'])));
    $book_no = trim(mysql_real_escape_string(htmlentities($_GET['book_no'])));
$possen=new netw_notify();
$possen->notified($s_id,$book_no);
}
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
		$date=date("Y-m-d");
$fine=0;
            
?>