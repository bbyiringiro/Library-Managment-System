<?php
include_once 'db.class.php';
class studentpage extends dbHandler{
	//iyo umunyeshuri atiye igitabo
	public function search_book($query,$params){
		return $this->getRows($query,$params);
	}
	public function pick_book($s_id,$book_no,$return_date,$out,$cur){
        if(isset($_SESSION['id']))
            $done_by=$_SESSION['id'];
        else
            $done_by=0;
           
		$this->insertRow("insert into activity(s_id,book_no,return_date,l_id,outsider,current_class)values(?,?,?,?,?,?)", array($s_id,$book_no,$return_date,$done_by,$out,$cur));
	}
	//iyo umunyeshuri agaruye igitabo
	public function book_return($student_id,$book_no){
		$this->insertRow("update activity set fine=1 where s_id=? and book_no=?",array($student_id,$book_no));
	}
	//kongeza igihe igitabo kizamara
	public function upgrade_time($student_id,$book_no){
		$this->insertRow("update activity set return_date=?,where s_id=? and book_no=?",array(date(),$student_id,$book_no));
	}
 //selecting like only one class 
	public function selectgroup($class,$section){}
	//inserting new students 
	public function add_stud($name,$class,$section){}
	
}