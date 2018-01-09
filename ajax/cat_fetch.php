<?php
include_once '../include/manage.inc.php';
include_once '../include/config.php';

$db=new PDO(DB_HOST, DB_USER, DB_PWD);

if(isset($_GET['s']) && !empty($_GET['s']) && isset($_GET['type']) && !empty($_GET['type'])){
	
if ($_GET['type']==1)
$col="book_cat";
elseif ($_GET['type']==2){
$col="book_author";}
elseif ($_GET['type']==3)
$col="publisher";
else 
$col="book_title";
         
	  //secure the search input
		$search = trim(mysql_real_escape_string(htmlentities($_GET['s'])));

		//convert the space in the search to sepreate terms
		$search_terms = explode(" ", $search);
		$term_count = 0;
		$q = "";
		$result = array();
		$i = 0;

		foreach ($search_terms as $term) {
			$term_count++;
			if($term_count === 1){
				$q .= "$col LIKE '%$term%' "; 
			}else{
				$q .= "AND $col LIKE '%$term%' ";
			}
		}
		
		
		//prepare the mysql query in PDO
		$query = $db->query("SELECT *,count($col) as number FROM books WHERE $q group by $col");

		//get the number of the results found
		$num = $query->rowCount();

		if($num > 0){
		//fetch the result
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
				//convert result array into json format
		$json_result = json_encode($result);
		echo $json_result;
				
		}

	


}


?>