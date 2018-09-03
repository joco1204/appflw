<?php
class Shipment{
	function __construct(){
		$this->bsn = new Business();
	}
	// Shipment table
	public function shipmentTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT a.id AS bol, a.date_shipping AS date_shipping, b.name_company AS customer, c.name_company AS trucking_c, e.name_company AS consignee, d.status, d.background ";
			$query .= "FROM re_shipment AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN re_accounts AS c ON a.id_truck = c.id ";
			$query .= "LEFT JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "LEFT JOIN re_accounts AS e ON a.id_consignee = e.id ";
			$query .= "WHERE a.id_status <> '24' ";
			$query .= "ORDER BY a.id DESC;";
			$result = $conn->query($query);

			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrTable, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrTable);
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
	//Delivered Table
	public function deliveredTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT a.id AS bol, a.date_shipping AS date_shipping, b.name_company AS customer, c.name_company AS trucking_c, e.name_company AS consignee, d.status, d.background ";
			$query .= "FROM re_shipment AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN re_accounts AS c ON a.id_truck = c.id ";
			$query .= "LEFT JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "LEFT JOIN re_accounts AS e ON a.id_consignee = e.id ";
			$query .= "WHERE a.id_status = '24' ";
			$query .= "ORDER BY a.id DESC; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrTable, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrTable);
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
	public function shipmentCreate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			if ($data->customer != '' && $data->comments != ''){
				$query  = "INSERT INTO re_shipment (id_customer, id_truck, id_consignee, date_shipping, temp, received_damage, total_quantity, cases_received, id_status, comments) VALUES ( ";
				$query.="'".$data->customer."', ";
				$query.="'".$data->truck_company."', ";
				$query.="'".$data->consignee."', ";
				$query.="'".$data->shipping_date."', ";
				$query.="'".$data->temp."', ";
				$query.="'".$data->received_damage."', ";
				$query.="'".$data->tqoc."', ";
				$query.="'".$data->cro."', ";
				$query.="'21', ";
				$query.="'".$data->comments."'); ";
				$result = $conn->query($query);
				if($result){
					$id_shipment = $conn->lastInsertId();
					for ($i=1; $i <= $data->lines; $i++){
						$po_number = 'po_number_'.$i;				
						$id_product = 'id_product_'.$i;
						$id_box = 'id_box_'.$i;
						$pallet = 'pallet_'.$i;
						$quantity = 'quantity_'.$i;
						//Validate line information
						isset($data->$po_number) ? $data->$po_number = $data->$po_number : $data->$po_number = '';
						isset($data->$id_product) ? $data->$id_product = $data->$id_product : $data->$id_product = '';
						isset($data->$quantity) ? $data->$quantity = $data->$quantity : $data->$quantity = '';
						//Insert Line receiving
						$queryLine  = "INSERT INTO re_shipment_line (id_shipment, po_number, id_product, quantity) ";
						$queryLine .= "VALUES ('".$id_shipment."', '".$data->$po_number."', '".$data->$id_product."', '".$data->$quantity."'); ";
						$resultLine = $conn->query($queryLine);
					}
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'was created correctly';
				} else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'Erroneous query';
				}
			}else{
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'No Field Null';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//
	public function shipmentUpdate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query = "UPDATE re_shipment SET received_damage = '".$data->received_damage."', total_quantity = '".$data->tqoc."', cases_received = '".$data->cro."', id_status = '".$data->status."' WHERE id = '".$data->idShipment."';";
			if($result = $conn->query($query)){
				for($i = 1; $i <= $data->number_lines; $i++) {
					$awb = "awb_".$i;
					$queryLineShipment = "UPDATE re_shipment_line SET delivered_awb = '".$data->$awb."' WHERE id_shipment = '".$data->idShipment."';";
					$resultLineShipment = $conn->query($queryLineShipment);
				}
			}
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
	//
	public function pod($data, $file){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query = "UPDATE re_shipment SET pod = '".$file."' WHERE id = '".$data->id."';";
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
	//
	public function status(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrStatus = array();
			$query  = "SELECT id_status, status FROM pa_status WHERE modulo = '6' AND activo = 'SI' ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrStatus, $row);
					}
					$bool = true;
					$response = json_encode($arrStatus);
				} else {
					$bool = false;
					$response = 'Wrong get status';
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
	//
	public function shipmentGet($id){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrShipment = array();
			$query  = "SELECT a.id, a.id_customer, b.name_company AS customer, a.id_truck, c.name_company AS truck, a.id_consignee, d.name_company AS consignee, a.date_shipping, a.temp, a.received_damage, a.total_quantity, a.cases_received, a.id_status, e.status, a.comments ";
			$query .= "FROM re_shipment AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN re_accounts AS c ON a.id_truck = c.id ";
			$query .= "LEFT JOIN re_accounts AS d ON a.id_consignee = d.id ";
			$query .= "LEFT JOIN pa_status AS e ON a.id_status = e.id_status ";
			$query .= "WHERE a.id = '".$id."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrShipment, $row);
					}
					$bool = true;
					$response = json_encode($arrShipment);
				} else {
					$bool = false;
					$response = 'Wrong get shipment';
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
	//
	public function shipmentLines($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLines = array();
			$query  = "SELECT a.po_number, b.item_code, b.item_description, a.quantity, a.delivered_awb ";
			$query .= "FROM re_shipment_line AS a ";
			$query .= "LEFT JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "WHERE a.id_shipment = '".$data->id."'; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrLines, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrLines);
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
	//
	public function poShipment(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT po_number FROM re_inventory WHERE status = '18'; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrPo, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrPo);
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
	//
	public function productItemCode($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrItemCode = array();
			$query  = "SELECT a.id_product, b.item_code ";
			$query .= "FROM re_inventory AS a ";
			$query .= "JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "WHERE a.po_number = '".$data->po."' AND a.status = '18'";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrItemCode, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrItemCode);
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
	//
	public function productItemName($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrItemName = array();
			$query  = "SELECT c.receiving, b.po_number, b.item_code, b.item_description ";
			$query .= "FROM re_inventory AS a ";
			$query .= "JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "JOIN re_receiving_line AS c ON a.id_receiving_line = c.id_line ";
			$query .= "WHERE a.po_number = '".$data->po."' AND a.id_product = '".$data->product."' AND a.status = '18';";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$quer_qty = "SELECT SUM(box_qty) AS quantity FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po_number."' AND item_code = '".$row->item_code."' AND reader = '1';";
					$result_qty = $conn->query($quer_qty);
					while($row_qty = $result_qty->fetch(PDO::FETCH_OBJ)){
						$row->quantity = $row_qty->quantity;
					}
					array_push($arrItemName, $row);

				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrItemName);
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