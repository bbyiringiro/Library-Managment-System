<?php
session_start();
include_once '../include/manage.inc.php';
include_once '../include/config.php';
$manage=new studentpage(DB_HOST, DB_USER, DB_PWD,NULL);

if(isset($_POST["register"])&&!empty($_POST['name'])&&isset($_POST[''])){
    echo "<html><p>i have got it by  post<p></html>";
}

//for  getting books to borrow
if (isset($_GET['book'])){
	$q=$_GET['book'];
	
$sql1='select * from books b where book_no like ? and book_no not in(select book_no from activity where fine=0)  order by b.book_no desc limit 40 ';
$res=$manage->search_book($sql1, array($q.'%'));
echo json_encode($res);
}


// for geting the number of books owed
if (isset($_GET['u'])){
	$q=$_GET['u'];
	if(!isset($_GET['out'])){
$sql1='select count(*) as count from activity where s_id=? and fine=0 and outsider=0';
$res=$manage->search_book($sql1, array($q));
echo json_encode($res);
}else{  $q=$_GET['u'];
        $qr='select id from prof_out where pro_id=?';
        $rq=$manage->getRows($qr, array($q));
      $re=$rq[0]['id'];
        $sql1='select count(*) as count from activity where s_id=? and fine=0 and outsider=1';
$res=$manage->search_book($sql1, array($rq));
echo json_encode($res);
    }
}



//for lending 
if (isset($_GET['lend'])&& isset($_GET['book_nbr'])&& isset($_GET['user'])&& $_GET['date']){
$sql="select count(*) as 'count' from activity where s_id=? and fine=0 and outsider=0";
	$row=$manage->getRow($sql,array($_GET['user']));
	$count=$row['count'];
	//checking if student have accomplished maximim 3 book to lend others
	if ($count>=3&&isset($_GET['current'])){
		//when max is 1 means he has acheived maxmum books
		$max=1;
		echo json_encode($max);	}

else{
if(isset($_GET['current'])){
$current=$_GET['current'];
    $handle=$manage->pick_book($_GET['user'], $_GET['book_nbr'],$_GET['date'],'0',$current);
	/* if three books exist for each students this student can't lend
	 * 
	 */
    $max=0;
		echo json_encode($max);
}
	
}
}

	
/*book  back for all */
	
if(isset($_GET['back'])&&isset($_GET['book_nbr'])&&isset($_GET['user'])){
    if(!is_numeric($_GET['user'])||$_GET['out']==1){
	$sql="select * from prof_out where pro_id=?";
    $res_id=$manage->getRow($sql,array($_GET['user']));
    $s_id=$res_id['id'];
        echo json_encode($s_id);
    }
    else{
        $s_id=htmlentities($_GET['user']);
        echo "0";
    }
	$res=$manage->book_return($s_id,$_GET['book_nbr']);
    
}



//for lending outsider and teacher 
if (isset($_GET['lend'])&& isset($_GET['book_nbr'])&& isset($_GET['user2'])&& $_GET['date']){
    $q=$_GET['user2'];
	$qr='select id from prof_out where pro_id=?';
        $rq=$manage->getRow($qr, array($q));
    $re=$rq['id'];
$sql="select count(*) as 'count' from activity where s_id=? and fine=0 and outsider=1";
	$row=$manage->getRow($sql,array($re));
	$count=$row['count'];
			$handle=$manage->pick_book($re, $_GET['book_nbr'],$_GET['date'],'1',$_GET['current']);
	$max=0;
		echo json_encode($max);

}
// for geting the number of books owed
if (isset($_GET['u2'])){
	$q=$_GET['u2'];
	$qr='select id from prof_out where pro_id=?';
        $rq=$manage->getRow($qr, array($q));
    $re=$rq['id'];
$sql1='select count(*) as count from activity where s_id=? and fine=0 and outsider=1';
$res=$manage->search_book($sql1, array($re));
echo json_encode($res);
}
if(isset($_GET['student'])&&!empty($_GET['student'])){
    $s_id=htmlentities($_GET['student']);
    if(is_numeric($s_id)){
        $sql="select * from students where s_id=? limit 1";
        $results=$manage->getRow($sql,array($s_id));
        echo json_encode($results);
    }else
        echo "0";
}if(isset($_GET['pass'])&&isset($_GET['s_i'])&&!empty($_GET['pass'])&&!empty($_GET['s_i'])){
$s_id=intval(strip_tags(htmlentities($_GET['s_i'])));
    if(is_numeric($s_id)){ 
        $pass=strip_tags(htmlentities($_GET['pass']));
    $sql="update students set pass=? where s_id=?";
    $res=$manage->updateRow($sql,array($pass,$s_id));
    echo "1";
}else{ 
        echo json_encode($pass);
       
   }
}
if(isset($_GET['lost'])&&!empty($_GET['lost'])){
    $l_name=$_GET['lost_name'];
    $l_nbr=$_GET['lost_nbr'];
    $sql="select activity.s_id 's_id',activity.book_no 'book_no',activity.checked 'checked',students.s_name 's_name',students.class 'class',students.section 'section',books.book_title from activity join students on activity.s_id=students.s_id join books on books.book_no=activity.book_no where activity.book_no like ? and activity.outsider!=1";
$res=$manage->getRow($sql,array($l_nbr.'%')); 
    if(empty($res)){
        echo json_encode($l_nbr);
    }else{
        echo json_encode($res);
    }
}
if (isset($_GET['l_book'])){
	$q=$_GET['l_book'];
$sql1='select * from books b where book_no like ? and book_no in(select book_no from activity where fine=0 and outsider=0)  order by b.book_no desc limit 40 ';	

$res=$manage->search_book($sql1, array($q.'%'));
    if(empty($res)){
        echo "1";
    }else{
echo json_encode($res);}
}
?>