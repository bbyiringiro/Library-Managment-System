<?php 
include_once 'include/config.php';
include_once 'include/db.class.php';

$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);



if(isset($_GET["submit"])){
	$nbr=$_GET["nbr"];
	$title=$_GET["title"];
	$cat=$_GET["cat"];
	$auth=$_GET["author"];
	$pub=$_GET["pub"];
	$num=$_GET["num"];
	
	
$sql="insert into books(book_no,book_title,book_cat,book_author,publisher)values(?,?,?,?,?)";
for ($i=1;$i<=$num;$i++){
      $stmt=$pdo->prepare($sql);
            $stmt->execute(array($nbr.'/'.$i,$title,$cat,$auth,$pub));
}

   
}

		
	
	



?>