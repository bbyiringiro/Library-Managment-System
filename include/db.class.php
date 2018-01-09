<?php
class dbHandler{
	public  $isConnceted;
	public  $db;
	public function __construct($host,$username,$pwd,$options=array()){
		$this->isConnceted=true;
		try {
			$this->db=new PDO($host, $username, $pwd, $options);
			$this->db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			$this->isConnceted=false;
			throw new Exception($e->getMessage());
		}
	
	}
  public function Disconnect(){
  	$this->db=null;
  	$this->isConnceted=false;
  }
  public function getRow($query,$params=array()){
  	try {
  		$stmt=$this->db->prepare($query);
  		$stmt->execute($params);
  		return $stmt->fetch();
  	}
  	catch (PDOException $e){
  		throw new Exception($e->getMessage());
  	}
  
  }
 public function getRows($query,$params=array()){
  	try {
  		$stmt=$this->db->prepare($query);
  		$stmt->execute($params);
  		return $stmt->fetchAll();
  	}
  	catch (PDOException $e){
  		throw new Exception($e->getMessage());
  	}
  
  }
  public function insertRow($query,$params){
  	try {
  		$stmt=$this->db->prepare($query);
  		$stmt->execute($params);
  	}catch (PDOException $e){throw new Exception($e->getMessage());}
  	
  }
  public function updateRow($query,$params){
  try {
  		$stmt=$this->db->prepare($query);
  		$stmt->execute($params);
  	}catch (PDOException $e){throw new Exception($e->getMessage());}
  }
  public function deleteRow($query,$params){
  	return $this->insertRow($query, $params);
  }
  public function lastid(){
  	return $this->db->lastInsertId();
  }
  
  
  //help to roll back in case of error
public function beginTransaction(){
    return $this->db->beginTransaction();
}
public function endTransaction(){
    return $this->db->commit();
}
public function cancelTransaction(){
    return $this->db->rollBack();
}
	
	
}