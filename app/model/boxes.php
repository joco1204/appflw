<?php
class Boxes{
	function __construct(){
		$this->bsn = new Business();
	}
	//receiving table method
	public function BoxesTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayBoxes = array();
			$query  = "SELECT *";
			$query .= "FROM re_box";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayBoxes, $row);
					}
					$bool = true;
					$response = json_encode($arrayBoxes);
				} else {
					$bool = false;
					$response = 'Wrong get boxes';
				}
				$this->bsn->return->bool = $bool;
				$this->bsn->return->msg = $response;
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//Create method
	public function boxesCreate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){
			$query  = "INSERT INTO re_box (code,box_name,brand,length,width,height,fbe) VALUES (";
			$query.= "'".$data->code."',";
			$query.= "'".$data->box_name."',";
			$query.= "'".$data->brand."',";
			$query.= "'".$data->length."',";
			$query.= "'".$data->width."',";
			$query.= "'".$data->height."',";
			$query.= "'".$data->fbe."')";
			
			$result = $conn->query($query);
			if($result){
				
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = 'was created correctly';
		
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
			
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//Update method
	public function boxesUpdate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){

			$query  = "UPDATE re_box set ";
			$query.="code='".$data->code."',";
			$query.="box_name='".$data->box_name."',";
			$query.="brand='".$data->brand."',";
			$query.="width='".$data->width."',";
			$query.="length='".$data->length."',";
			$query.="height='".$data->height."',";
			$query.="fbe='".$data->fbe."'";
			$query.=" WHERE id_box_type = ".$data->idBoxes.";";
			$result = $conn->query($query);
			
			if($result){
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = 'was updated correctly';
		
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
			
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	public function boxesGet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayBoxes = array();
			$query  = "SELECT * ";
			$query .= "FROM re_box ";
			$query .= "WHERE id_box_type=".$data->idBoxes.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayBoxes, $row);
					}
					$bool = true;
					$response = json_encode($arrayBoxes);
				} else {
					$bool = false;
					$response = 'Wrong get Boxes';
				}
				$this->bsn->return->bool = $bool;
				$this->bsn->return->msg = $response;
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//Box Size Method
	public function boxSize(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrBoxSize = array();
			$query  = "SELECT id_box_type, code, length, width, height ";
			$query .= "FROM re_box; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$row->dimention = $row->length."x".$row->width."x".$row->height;
						array_push($arrBoxSize, $row);
					}
					$bool = true;
					$response = json_encode($arrBoxSize);
				} else {
					$bool = false;
					$response = 'Wrong get Boxes';
				}
				$this->bsn->return->bool = $bool;
				$this->bsn->return->msg = $response;
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//Box FBE Method
	public function boxFbe($id){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrFbe = array();
			$query  = "SELECT id_box_type, fbe ";
			$query .= "FROM re_box ";
			$query .= "WHERE id_box_type = '".$id."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrFbe, $row);
					}
					$bool = true;
					$response = json_encode($arrFbe);
				} else {
					$bool = false;
					$response = 'Wrong get fbe';
				}
				$this->bsn->return->bool = $bool;
				$this->bsn->return->msg = $response;
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;

	}
	
}
?>
