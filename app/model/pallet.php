<?php
class Pallet{
	function __construct(){
		$this->bsn = new Business();
	}

	//Pallet table method
	public function palletTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayPallet = array();
			$query  = "SELECT A.id, A.name, A.description, A.status, A.position_number, A.tag_number, B.background FROM re_pallet A INNER JOIN pa_status B ON B.id_status = A.status;";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrayPallet, $row);
				}
				$bool = true;
				$response = json_encode($arrayPallet);

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
	public function insertPallet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			if ($data->name!="" && $data->status!="" && $data->description!=""){
				isset($data->position_number) ? $data->position_number = $data->position_number : $data->position_number = '';
				isset($data->tag_number) ? $data->tag_number = $data->tag_number : $data->tag_number = '';
				$query  = "INSERT INTO re_pallet (name, description, status, position_number, tag_number) VALUES ('".$data->name."','".$data->description."','".$data->status."','".$data->position_number."','".$data->tag_number."')";
				$result = $conn->query($query);
				if($result){
					$id = $conn->lastInsertId();
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'the pallet was successfully inserted';	
				} else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'Erroneous query';
				}
			}else{
				$this->bsn->return->bool = false;
			    $this->bsn->return->msg = 'Empty data';
			}
			
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	
	public function updateStatus($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrStatus = array();
			$query  = "UPDATE re_pallet";
			$query .= " SET status = ".$data->new_status." WHERE id= ".$data->id.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					/*/while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrStatus, $row);
					}*/
					$bool = true;
					$response = "Correct change of status";
				} else {
					$bool = false;
					$response = 'Wrong get pallet';
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
	
	
	public function positionNumber(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrpositionNumber = array();
			$query  = "SELECT id, name";
			$query .= "FROM re_pallet WHERE position_number = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrpositionNumber, $row);
					}
					$bool = true;
					$response = json_encode($arrpositionNumber);
				} else {
					$bool = false;
					$response = 'Wrong get receiving';
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
	

	public function tagNumber(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrtagNumber = array();
			$query  = "SELECT id, name";
			$query .= "FROM re_pallet WHERE tag_number = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrtagNumber, $row);
					}
					$bool = true;
					$response = json_encode($arrtagNumber);
				} else {
					$bool = false;
					$response = 'Wrong get receiving';
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

	public function pallets_tag_number(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrtagNumber = array();
			$query  = "SELECT (MAX(tag)+1) AS pallet_tag FROM re_pallet ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						if($row->pallet_tag == '1000000') {
							$row->pallet_tag == '1';
						} else {
							$row->pallet_tag = $row->pallet_tag;
						}
						array_push($arrtagNumber, $row);
					}
					$bool = true;
					$response = json_encode($arrtagNumber);
				} else {
					$bool = false;
					$response = 'Wrong get receiving';
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