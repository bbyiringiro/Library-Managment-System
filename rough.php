$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$query="select  activity.s_id 's_id' ,activity.book_no 'book_no',activity.due_date 'due_date',activity.fine 'fine',activity.current_class 'current_class',students.s_name 's_name',books.book_title 'book_title',students.class 'class',students.section 'section' from activity join students on activity.s_id=students.s_id join books on activity.book_no=books.book_no where activity.s_id=? and activity.outsider=0 ORDER BY activity.fine DESC";
$result=array();
	$result=$db->getRows($query,array($id));
        if (empty($result))
echo '<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>
<div style="position:absolute;width:60%;top:200px;left:20%;"class="no-personal center-align blue-grey lighten-5"><h5 class="flow-text">This student never borrowed a book yet</h5></div>';
else {?>
<h2><a href="personal_history.php" id="link" style="color:#37a69b;"><i  class="mdi-hardware-keyboard-backspace"></i></a></h2>

$pic='.jpg'; $pic=$result[0]['s_id'].$pic;
$per_html.="<div  class='personal_history card'><div class='row valign-wrapper card-panel' style='width:100%;' id='identities'> <div class='card-image' style='width:40%;'><img src='pictures/college_logo.jpg' alt='' style='width:60%;height:130px;'></div><div class='card-ids' style='width:40%;'><p><b>Name:</b>".strtoupper($result[0]['s_name'])."</p><p><b>Class:</b>".ucwords($result[0]['class'])." ".ucwords( $result[0]['section'])."</p><p><b>S_id:</b>".$result[0]['s_id']."</p></div><div class='card-image' style='width:20%;'><img src='pictures/".$pic." 'alt='' style='width:99%;height:130px;'></div></div><form style=''><table class='hoverable striped bordered' id='personal_history'><thead><tr><th data-field='price'>Book name</th><th data-field='id'>ISBN</th><th data-field='Due_date'> due date</th> <th data-field='day'>Class</th> <th data-field='day'>Returned</th></tr></thead><tbody>";
<?php
foreach ($result as $res):

         ?>
if($res['fine']==0){
$jol='no';
}
else $jol='yes';
          $per_html.="<tr><td class='book-title'>".$res['book_title']."</td><td class='book-nbr'>".$res['book_no']."</td><td>".$res['due_date']."</td><td>".$res['current_class']."</td><td><b><i>".$jol."</i></b></td></tr>";
        
        <?php endforeach; }?>
          
        </tbody></table></form></div>

