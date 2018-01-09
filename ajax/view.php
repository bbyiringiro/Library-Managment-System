<?php
session_start();
// Include database credentials and connect to the database
include_once '../include/db.class.php';
include_once '../include/config.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD,NULL);

$sql = "select s.s_name,s.s_id,s.class,s.section,count(a.s_id) 'count' from students s join activity a on s.s_id=a.s_id and a.fine=0 and a.outsider=0 group by a.s_id order by s.class asc,s.section asc";
$sql2="select b.book_title  b_name ,b.book_no 'nbr'  from activity a inner join books b on a.book_no=b.book_no where a.s_id=? and a.fine=0 and a.outsider=0 ";

$stmt = $db->db->prepare($sql);
$stmt->execute();
$res_count=$stmt->rowCount();
$res=$stmt->fetchAll();
echo'<div class="card-panel col  s10" id="result" style="margin-left:245px;margin-right:2px;">';
$class='';
foreach ($res as $row):
 


if (empty($class)){
    $count=1;
    $class=$row['class'].' '.$row['section'];
    echo '<h2 class="header">'.$class.'</h2>';
 echo <<<LT
 <hr>
 <table class="bordered striped hoverable">
        <thead>
          <tr>
              <th ><i class="mdi-editor-format-list-numbered"><i></th>
              <th >Name</th>
              <th >His/her id</th>
              <th >N.o of books</th>
              <th >Those books</th>
             
              
          </tr>
        </thead>

        <tbody>
 
LT;

}
    elseif ($class != $row['class'].' '.$row['section']){
        $count=1;
        $class=$row['class'].' '.$row['section'];
        
        echo <<<lt
        </tbody>
      </table>
lt;
       
        
        
       
     echo '<h2 class="header">'.$class.'</h2>';
     echo <<<LT
     <hr>
     
     <table class="bordered striped hoverable">
        <thead>
          <tr>
              <th ><i class="mdi-editor-format-list-numbered"><i></th>
              <th >Name</th>
              <th >His/her id</th>
              <th >No of books</th>
              <th >Those books</th>
             
              
          </tr>
        </thead>

        <tbody>
 
LT;

 }
 
 $stmt2 = $db->db->prepare($sql2);
$stmt2->execute(array($row['s_id']));
$res2=$stmt2->fetchAll();
 
 echo '<tr><td>'.$count.'</td><td>'.$row['s_name'].'</td><td>'.$row['s_id'].'</td><td>'.$row['count'].'</td><td>';
 
 
 echo'<table class="bordered" id="sub-table"><thead>
          <tr>
              <th></th>
              <th></th>
          </tr>
        </thead><tbody>';

 foreach ($res2 as $row2) {
 	echo '<tr><td>'.$row2['b_name'].':</td><td>'.$row2['nbr'].'</td></tr>';
 }
 echo '</tbody></table>';

 
 echo '</td<tr>';
 
 
    
    


 
$count++;

endforeach;
echo'</div>';