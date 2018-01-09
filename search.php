<?php
	include_once 'include/config.php';
include_once 'include/db.class.php';
//importing databasw task handler class
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);

if(isset($_GET['s']) && !empty($_GET['s'])){


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
				$q .= "`s_name` LIKE '%$term%' "; 
			}else{
				$q .= "AND `s_name` LIKE '%$term%' ";
			}
		}
		

		//prepare the mysql query in PDO
		$query=$db->getRows('select * from students where '.$q,null);
if (empty($query))
echo "nothing";
else echo json_encode($query);
 
}
elseif(isset($_GET['s2']) && !empty($_GET['s2'])){
    
		//secure the search input
		$search = trim(mysql_real_escape_string(htmlentities($_GET['s2'])));

		//convert the space in the search to sepreate terms
		$search_terms = explode(" ", $search);
		$term_count = 0;
		$q = "";
		$result = array();
		$i = 0;

		foreach ($search_terms as $term) {
			$term_count++;
			if($term_count === 1){
				$q .= "`name` LIKE '%$term%' "; 
			}else{
				$q .= "AND `name` LIKE '%$term%' ";
			}
		}
		

		//prepare the mysql query in PDO
		$query=$db->getRows('select * from prof_out where '.$q,null);
if (empty($query))
echo "nothing";
else echo json_encode($query);
 
}elseif(isset($_GET['ts']) && !empty($_GET['ts'])){


		//secure the search input
		$search = trim(mysql_real_escape_string(htmlentities($_GET['ts'])));

		//convert the space in the search to sepreate terms
		$search_terms = explode(" ", $search);
		$term_count = 0;
		$q = "";
		$result = array();
		$i = 0;

		foreach ($search_terms as $term) {
			$term_count++;
			if($term_count === 1){
				$q .= "`s_name` LIKE '%$term%' AND class!='fin' AND class!='final' "; 
			}else{
				$q .= "AND `s_name` LIKE '%$term%' AND class!='fin' AND class!='final' ";
			}
		}
		

		//prepare the mysql query in PDO
		$query=$db->getRows('select * from students where '.$q,null);
if (empty($query))
echo "nothing";
else echo json_encode($query);
 
}

?>