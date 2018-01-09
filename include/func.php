<?php


function islogged(){
	session_start();
    if(!isset($_SESSION['name'])&& !isset($_SESSION['id']))
    header("location:./");
    elseif (isset($_SESSION['name']) && !isset($_SESSION['id']))
          header("location:./semi-login.php");
  
}



function relativeTime($dt,$precision=2)
{
	$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
	$passed=time()-$dt;
	
	if($passed<5)
	{
		$output='less than 5 seconds ago';
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' and ',$output).' ago';
	}
	
	return $output;
}

function formatTweet($tweet,$dt)
{
	if(is_string($dt)) $dt=strtotime($dt);

	$tweet=htmlspecialchars(stripslashes($tweet));

	return'
	<li>
	<a href="#"><img class="avatar" src="img/avatar.jpg" width="48" height="48" alt="avatar" /></a>
	<div class="tweetTxt">
	<strong><a href="#">demo</a></strong> '. preg_replace('/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i','<a href="$1" rel="nofollow" target="blank">$1</a>',$tweet).'
	<div class="date">'.relativeTime($dt).'</div>
	</div>
	<div class="clear"></div>
	</li>';

}

// scripts used to extract student from excel to database
function import_stud($file){
    ini_set('max_execution_time', 180);

	include_once 'include/config.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'include/Classes/');
include 'PHPExcel/IOFactory.php';
$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);

$sql1='select * from students where s_name=? and class=? and section=?';
   
$sql2="insert into students(s_name,class,section)values(?,?,?)";
$does_exist="select * from  students where class=? and section=?";


try {
     $objPHPExcel = PHPExcel_IOFactory::load($file);
}catch (Exception $e){
	die('error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
//geting all worksheet information
    $html="<span class='white ' id='res_status' style='margin-top:2px;position:absolute;bottom:14px;max-height:100px;left:22%;overflow-y:auto;'><b><h3>Error log</h3></b>";
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

    $classtitle    = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); 
    $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    
    //check if workshett name is written in good manner that it's class and class are separated
    $sheet=strtolower($classtitle);
    $sheet=explode(' ', $sheet);
    if(sizeof($sheet)!=2){
    	$html.="<p>the class and section must be separeted for  ".$classtitle."s
    	rename it and try to upload again<p>";
    	break;
    }else{
    list($class,$section)=$sheet;
    $does_it=$pdo->prepare($does_exist);
    $does_it->execute(array($class,$section));
   $does=$does_it->rowCount();
    $html.="<br>The worksheet ".$classtitle." has ".$nrColumns . ' columns (A-' . $highestColumn . ') </br> and ' . $highestRow . " row.<br>Data:";
    for ($row = 1; $row <= $highestRow; ++ $row) {
    	
    	$html.="";
    	
        for ($col = 0; $col < $highestColumnIndex; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            $val = $cell->getValue();
            $val=strtolower($val);
            //check if student already exist into data base
            $stmt=$pdo->prepare($sql1);
            $stmt->execute(array($val,$class,$section));
            $data=$stmt->rowCount();
        	if ($data>0||$does>20){
                break;
            }
        	else {
        		
            //save data from excel row into database
    if($val!=""){      
        $stmt=$pdo->prepare($sql2);
            $stmt->execute(array($val,$class,$section));
            }
        	}
            
        }
        if($does>20){
                $html.="<u><b>$classtitle</b></u></br>please make sure you are not registering  again this class OR you must make promotions first</br> ";break;
            }
    }
} 
   
}$html.="</span>";
    echo $html;
    
}


//for handling all student export to excel
function export($name){
	ini_set('max_execution_time', 180);
	$homedir=getenv("HOMEDRIVE").getenv("HOMEPATH");
	$path ="$homedir\Desktop\Library reports";

include_once 'include/config.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'include/Classes/');
include 'PHPExcel/IOFactory.php';
$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);

$sql='select * from students';
$res=$pdo->query($sql);
$res=$res->fetchAll();




// Instantiate a new PHPExcel object
$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 

//special font for header of class
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '#1E1E1E'),
        'size'  => 15,
        'name'  => 'Verdana'
    ));
    




// Initialise the Excel row number
$rowCount =1; 

foreach ($res as $row){
   
        
    // Set cell An to the "name" column from the database (assuming you have a column called name)
    //    where n is the Excel row number (ie cell A1 in the first row)
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['s_id']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, ucwords($row['s_name'])); 
    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
    //    where n is the Excel row number (ie cell A1 in the first row)
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['class'].'  '.strtoupper($row['section'])); 
    // Increment the Excel row counter
    $rowCount++; 
} 

// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
// Write the Excel file to filename some_excel_file.xlsx in the current directory
$objWriter->save($path.'/'.$name.'.xlsx'); 
	
}//end of export function




//for handling report export to excel
function exportReport($name){
	ini_set('max_execution_time', 180);

include_once 'include/config.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'include/Classes/');
include 'PHPExcel/IOFactory.php';
$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);

$sql = "select s.s_name,s.s_id,s.class as class,s.section,count(a.s_id) 'count' from students s join activity a on s.s_id=a.s_id and a.fine=0 group by a.s_id order by s.class asc,s.section asc";
$sql2="select b.book_title  b_name ,b.book_no 'nbr'  from activity a inner join books b on a.book_no=b.book_no where a.s_id=? and a.fine=0 ";
$res=$pdo->query($sql);
$res=$res->fetchAll();




// Instantiate a new PHPExcel object
$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 

//special font for header of class
$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '#1E1E1E'),
        'size'  => 15,
        'name'  => 'Verdana'
    ));
    

$dirToSave=checkSaveDir();
 $objPHPExcel->getActiveSheet()->SetCellValue('A1','Name of student'); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'his/her id'); 
    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
    //    where n is the Excel row number (ie cell A1 in the first row)
    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'no of books he/she owe school');
    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'class');

// Initialise the Excel row number
$rowCount =2; 

foreach ($res as $row){
   
        
    // Set cell An to the "name" column from the database (assuming you have a column called name)
    //    where n is the Excel row number (ie cell A1 in the first row)
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['s_name']); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, ucwords($row['s_id'])); 
    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
    //    where n is the Excel row number (ie cell A1 in the first row)
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $row['count'].''); 
    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $row['class'].'  '.strtoupper($row['section'])); 
    // Increment the Excel row counter
    $rowCount++; 
} 

// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
// Write the Excel file to filename some_excel_file.xlsx in the current directory
$objWriter->save($dirToSave.'/'.$name.'.xlsx'); 


	
}//end of export function



function checkSaveDir()
{
	$homedir=getenv("HOMEDRIVE").getenv("HOMEPATH");
	$path ="$homedir\Desktop\Library reports";
// Determines the path to check

// Checks if the directory exists
if(!is_dir($path))
{
// Creates the directory
if(!mkdir($path, 0777, TRUE))
{
// On failure, throws an error
throw new Exception("Can't create the directory!");
}
}
return $path;
}







//for multiple book import

// scripts used to extract student from excel to database
function import_books($file){
    ini_set('max_execution_time', 36000);

	include_once 'include/config.php';
set_include_path(get_include_path() . PATH_SEPARATOR . 'include/Classes/');
include 'PHPExcel/IOFactory.php';
$pdo=new PDO(DB_HOST,DB_USER,DB_PWD);

$sql="insert into books(book_no,book_title,book_cat,book_author,publisher)values(?,?,?,?,?)";



try {
     $objPHPExcel = PHPExcel_IOFactory::load($file);
}catch (Exception $e){
	die('error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
//geting all worksheet information
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $highestRow         = $worksheet->getHighestRow(); 
    $highestColumn      = $worksheet->getHighestColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    
 
    
//first check if all column are named according to the way it is going to be istalled in db

 $tempo=array();
        for ($col = 0; $col < 6; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, 1);
            
	array_push($tempo, $cell->getValue());
	
        	}
        	
        	$nbr=$tempo[0];
	$title=$tempo[1];
	$cat=$tempo[2];
	$auth=$tempo[3];
	$pub=$tempo[4];
	$num=$tempo[5];
	if(($nbr !='nbr') && ($title!='book name') && ($cat!='category') && ($auth!='author') && ($pub !='publisher') && ($num!='number')){
	echo "Please make sure that the column name of first row in excel file are ordered liked this and named like this";
	echo "<br>nbr  -- book name -- category -- author -- publisher --number";
	break;
	}

    
    
    
    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    echo ' and ' . $highestRow . ' row.';
    
    for ($row = 2; $row <= $highestRow; ++ $row) {
    	
    	
    	
    	
        echo '<tr>';
        $temp=array();
        for ($col = 0; $col < 6; ++ $col) {
            $cell = $worksheet->getCellByColumnAndRow($col, $row);
            
	array_push($temp, $cell->getValue());
	
        	}
        	$nbr=$temp[0];
	$title=$temp[1];
	$cat=$temp[2];
	$auth=$temp[3];
	$pub=$temp[4];
	$num=$temp[5];

	
	
	 //check if student already exist into data base
            $stm=$pdo->prepare("select * from books where book_no=?");
            $stm->execute(array($nbr.'/1'));
            $data=$stm->rowCount();
        	if ($data>0){
        		echo $nbr."already exist in database";
        		break;
        	}
        	else {
	
	echo $num;
    for ($i=1;$i<=$num;$i++){
      $stmt=$pdo->prepare($sql);
            $stmt->execute(array($nbr.'/'.$i,$title,$cat,$auth,$pub));
}
        	}

}

}
}


/*
define('INCLUDE_CHECK',1);
require "functions.php";
require "connect.php";


if(ini_get('magic_quotes_gpc'))
$_POST['inputField']=stripslashes($_POST['inputField']);



$_POST['inputField'] = mysql_real_escape_string(strip_tags($_POST['inputField']),$link);

if(mb_strlen($_POST['inputField']) < 1 || mb_strlen($_POST['inputField'])>140)
die("0");

mysql_query("INSERT INTO demo_twitter_timeline SET tweet='".$_POST['inputField']."',dt=NOW()");

if(mysql_affected_rows($link)!=1)
die("0");

echo formatTweet($_POST['inputField'],time());
*/







