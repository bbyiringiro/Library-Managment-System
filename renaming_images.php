<?php 
include_once 'include/config.php';
include_once 'include/db.class.php';
include_once 'include/func.php';
$db=new dbHandler(DB_HOST, DB_USER, DB_PWD);
$sql="select * from students where section='PCM' and class='S4'";
$condition=0;
$results=$db->getRows($sql);
if(!empty($results)&&is_array($results)){
     $count=0;
   foreach($results as $res){
    $name=$res['s_name'];
    $new_name=$res['s_id'];
    $folder=ucwords($res['class']);
    $dir="pic/S4 PCM/";
    $old="$dir"."$name".".jpg";
    $new="pic/"."$new_name".".jpg";
      
       if(file_exists($old)){
	 if(rename($old,$new)){
           echo "renaming".$res['s_name']." done </br>";
       }
           else{
               echo "rename failed for".$res['s_name']."</br>";
           }
}
else {
echo $old."</br>";
       $count++;
       continue;}
   }  
    echo $count;
}
else{
       
     echo "no entries found in the database";  
   } 
?>