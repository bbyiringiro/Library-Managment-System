<?php
include_once 'include/func.php';
include_once 'include/config.php';
include_once 'include/db.class.php';
require_once("dompdf/dompdf_config.inc.php");
require_once("dompdf/dompdf_config.inc.php");
islogged();

$htm="<img src='college.jpg' style='left:2px;top:2px;height:100px;width:80px;'/><p><center><u><b>Library Periodic History</b></u></center><p>";
$htm.="<style>table, th, td{
    border:#E3EAEC solid;    border-spacing: 0px;
}</style><div class='all_history'><form id='all_history'><table class='bordered'><thead><tr><th data-field='price'>Id</th><th data-field='price'style='width:160px;'>Name</th><th data-field='price'  style='width:260px;';>Book name</th><th data-field='id'style='width:140px;'>ISBN</th><th data-field='ay'>Class</th> <th data-field='day'style='width:10px;'>Fine</th></tr> </thead><tbody>";
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id ,activity.book_no ,activity.due_date,activity.fine,activity.id,activity.current_class,students.s_name,books.book_title,activity.outsider from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id!=? ORDER BY activity.due_date ASC";
$result=array();
	$result=$db->getRows($query,array('0'));
if (empty($result))
$htm.='<div class="no-history center-align blue-grey lighten-5"><h5 class="flow-text">No history yet</h5></div>';
else {
foreach ($result as $res):
if($res['outsider']==1){
    $res_nam=$db->getRow('select name from prof_out where id=?',array($res['s_id']));
    $res_name=$res_nam['name'];
}else{
    $res_name=$res['s_name'];
}if($res['fine']==0){
    $fine="no";
}else{
 $fine="yes";   
}
$htm.="<tr><td class='book-title'>".$res['s_id']."</td><td class='book-title'>".$res_name."</td><td class='book-title'>".$res['book_title']."</td><td class='book-nbr'>".$res['book_no']."</td><td>". $res['current_class']."</td><td>". $fine."</td>";
 endforeach;
        $htm.="</tbody></table></form></div>";

}//end else 
 if(isset($_GET['id'])&&is_numeric($_GET['id'])){
$GLOBALS['per_html']="";
  $db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id 's_id' ,activity.book_no 'book_no',activity.due_date 'due_date',activity.fine 'fine',activity.current_class 'current_class',students.s_name 's_name',books.book_title 'book_title',students.class 'class',students.section 'section' from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id=? and activity.outsider=0 ORDER BY activity.fine DESC";
$result=array();
	$result=$db->getRows($query,array($_GET['id']));
     if(!empty($result)){
    $pic='.jpg'; $pic=$result[0]['s_id'].$pic;
$GLOBALS['per_html'].="<style>table,td,th{
    border: #E3EAEC solid;border-spacing:0px;
}</style><div  class='personal_history card'><div class='row valign-wrapper card-panel' style='width:100%;' id='identities'> <div class='card-image' style='width:30%;'><img src='pictures/".$pic." 'alt='' style='width:99%;height:130px;'></div><div class='card-ids' style='width:40%;left:300px;'><p><b>Name:</b>".strtoupper($result[0]['s_name'])."</p><p><b>Class:</b>".ucwords($result[0]['class'])." ".ucwords($result[0]['section'])."</p><p><b>S_id:</b>".$result[0]['s_id']."</p></div><div class='card-image' style='width:40%;'><img src='college.jpg' alt='' style='width:60%;height:150px;margin-left:550px;margin-top:-260px;'></div></div><form style=''><table style='' id='personal_history'><thead><tr style='border:#F1D2BD solid;'><th data-field='price'style='width:170px;'>Book name</th><th data-field='id'style='width:100px'>ISBN</th><th data-field='Due_date'style='width:130px'> due date</th> <th data-field='day'style='width:70px;'>Class</th> <th data-field='day'style='width:30px;'>Fine</th></tr></thead><tbody>";
      foreach ($result as $res):
    if($res['fine']==0){
$jol='no';
}
else {$jol='yes';}
      $GLOBALS['per_html'].="<tr style='height:50px;'><td class='book-title' style='';>".$res['book_title']."</td><td class='book-nbr'>".$res['book_no']."</td><td>".$res['due_date']."</td><td>".$res['current_class']."</td><td><b><i>".$jol."</i></b></td></tr>";
    
    endforeach; 
$GLOBALS['per_html'].='</tbody></table></form></div>';
     }else{
  $GLOBALS['per_html'].='<div class="no-history center-align blue-grey lighten-5"><h5 class="flow-text">No history yet</h5></div>';    
     }
$html=$GLOBALS['per_html'];
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("personal_history.pdf");
    
}else if(isset($_GET['whole'])){
  $html=$htm;
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("library_history.pdf");  
}

//check if it is whole or personal




?>

<!DOCTYPE html>
  <html>
      <head></head>
      <body></body>
  </html>