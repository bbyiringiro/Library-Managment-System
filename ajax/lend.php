<?php
session_start();
include_once '../include/manage.inc.php';
include_once '../include/config.php';
$manage=new studentpage(DB_HOST, DB_USER, DB_PWD,NULL);



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
	
$sql1='select count(*) as count from activity where s_id=? and fine=0 and outsider=0';
$res=$manage->search_book($sql1, array($q));
echo json_encode($res);
}



//for lending 
if (isset($_GET['lend'])&& isset($_GET['book_nbr'])&& isset($_GET['user'])&& $_GET['date']){
$sql="select count(*) as 'count' from activity where s_id=? and fine=0 and outsider=0";
	$row=$manage->getRow($sql,array($_GET['user']));
	$count=$row['count'];
	//checking if student have accomplished maximim 3 book to lend others
	if ($count>=3){
		//when max is 1 means he has acheived maxmum books
		$max=1;
		echo json_encode($max);	}

else{

	$sql1="insert into activity values(?,?,?,?,?,?)";
	$handle=$manage->pick_book($_GET['user'], $_GET['book_nbr'],$_GET['date'],'0');
	/* if three books exist for each students this student can't lend
	 * 
	 */
	$max=0;
		echo json_encode($max);
}
}

	
if(isset($_GET['back'])&&isset($_GET['book_nbr'])&&isset($_GET['user'])){
	
	$sql="update activity set fine=1 where s_id=? and book_no=?";
	$res=$manage->book_return($_GET['user'],$_GET['book_nbr']);
}







/* for all */

	
if(isset($_GET['back'])&&isset($_GET['book_nbr'])&&isset($_GET['user'])){
	
	$sql="update activity set fine=1 where s_id=? and book_no=?";
	$res=$manage->book_return($_GET['user'],$_GET['book_nbr']);
}


















//for lending outsider and teacher 
if (isset($_GET['lend'])&& isset($_GET['book_nbr'])&& isset($_GET['user2'])&& $_GET['date']){
$sql="select count(*) as 'count' from activity where s_id=? and fine=0 and outsider=1";
	$row=$manage->getRow($sql,array($_GET['user2']));
	$count=$row['count'];
	//checking if student have accomplished maximim 3 book to lend others


	$sql1="insert into activity values(?,?,?,?,?,?,?)";
	$handle=$manage->pick_book($_GET['user2'], $_GET['book_nbr'],$_GET['date'],'1');
	/* if three books exist for each students this student can't lend
	 * 
	 */
	$max=0;
		echo json_encode($max);

}



// for geting the number of books owed
if (isset($_GET['u2'])){
	$q=$_GET['u2'];
	
$sql1='select count(*) as count from activity where s_id=? and fine=0 and outsider=1';
$res=$manage->search_book($sql1, array($q));
echo json_encode($res);
}



?>