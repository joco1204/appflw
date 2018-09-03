<?php
include ('../../../../config/connect.php');


class functions_PDF{
	public $return;
	public $conn;
	public $db;
	public $session;
	public $post;
	public $get;
	
	public function GetPo($data){
		$conn =	$this->conn = new Connect();
		$this->db = 'appdb';
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT GetName_Account(customer_name) as customer, GetName_Account(consignee_name) as consignee, GetName_State(consignee_state) as state, consignee_dc_number as dc_number, consignee_zip_code as zip_code, consignee_addrees as address, GetName_City(consignee_city) as city ";
			$query .= "FROM re_purchasing_order ";
			$query .= "WHERE po_number = ".$data.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					
					$response =$arrTable;
				} else {
					
					$response = 'Wrong get work order';
				}
				
				return $arrTable;
			} else {
				
				$this->bsn->return->msg = 'Erroneous query'.$query;
			}
		} else {
			
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	
	/* public function GetLinePO($data){
		$conn =	$this->conn = new Connect();
		$this->db = 'appdb';
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT A.item_code, B.delivered_date, B.truck_date, A.item_description, A.box_type_dry, GetName_Status(A.pack_system) as pack_system, A.box_qty, GetName_Status(A.status) as status ";
			$query .= "FROM re_product A ";
			$query .= "INNER JOIN re_purchasing_order B ON A.po_number = B.po_number ";
			$query .= "WHERE A.po_number = ".$data.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					
					$response =$arrTable;
				} else {
					
					$response = 'Wrong get work order';
				}
				
				return $arrTable;
			} else {
				
				$this->bsn->return->msg = 'Erroneous query'.$query;
			}
		} else {
			
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	
	} */
	
	public function GetWorkOrderPo($data){
		$conn =	$this->conn = new Connect();
		$this->db = 'appdb';
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT B.id, GetName_Account(B.id_customer) as customer, GetName_Account(consignee_name) as consignee, C.truck_date, GetName_Account(C.truck_line) as truck_line, B.item_description, B.pack_dry, B.pack_per_wet, A.grade, B.total_price_line, A.bar_code_case_number, A.box_code_number_1, A.box_code_number_2, B.notes, B.total_price_line, B.box_type_dry, B.box_qty, B.box_type_wet ";
			$query .= "FROM re_product A ";
			$query .= "INNER JOIN re_work_order B ON A.po_number = B.po_number ";
			$query .= "INNER JOIN re_purchasing_order C ON A.po_number = C.po_number ";
			$query .= "WHERE A.po_number = ".$data.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					
					$response =$arrTable;
				} else {
					
					$response = 'Wrong get work order';
				}
				
				return $arrTable;
			} else {
				
				$this->bsn->return->msg = 'Erroneous query'.$query;
			}
		} else {
			
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	
	public function GetLinePO($data){
		$conn =	$this->conn = new Connect();
		$this->db = 'appdb';
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT A.item_code, B.delivered_date, B.truck_date, A.item_description, A.box_type_dry, GetName_Status(A.pack_system) as pack_system, A.box_qty, GetName_Status(A.status) as status ";
			$query .= "FROM re_product A ";
			$query .= "INNER JOIN re_purchasing_order B ON A.po_number = B.po_number ";
			$query .= "WHERE A.po_number = ".$data.";";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					
					$response =$arrTable;
				} else {
					
					$response = 'Wrong get work order';
				}
				
				return $arrTable;
			} else {
				
				$this->bsn->return->msg = 'Erroneous query'.$query;
			}
		} else {
			
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	
	}
		public function GetAWB($data){
		$conn =	$this->conn = new Connect();
		$this->db = 'appdb';
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT A.awb, A.awb_hija, A.awb_nieta, B.box_type_dry, GetName_Account(A.id_customer) as customer, A.truck_date, B.po, B.item_description, B.length, B.width, B.height, B.pack_system ";
			$query .= "FROM re_receiving A ";
			$query .= "INNER JOIN re_receiving_line B ON A.awb = B.receiving ";
			$query .= "WHERE A.id_receiving = ".$data.";";
			
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					
					$response =$arrTable;
				} else {
					
					$response = 'Wrong get AWB';
				}
				
				return $arrTable;
			} else {
				
				$this->bsn->return->msg = 'Erroneous query'.$query;
			}
		} else {
			
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	
	}
	
}	
	
?>
