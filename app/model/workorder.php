<?php
class Workorder{

	function __construct(){
		$this->bsn = new Business();
	}

	//
	public function workorderTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT a.id AS wo, a.ship_date, a.po_number AS po, b.name_company AS customer, a.box_qty AS quantity, GetName_Account(a.id_consignee) AS consignee, a.id_status, c.status , d.background ";
			$query .= "FROM re_work_order AS a ";
			$query .= "INNER JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "INNER JOIN pa_status AS c ON a.id_status = c.id_status ";
			$query .= "JOIN pa_status AS d ON a.id_status = d.id_status ";
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

	//
	public function workorderCreate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){
			$query  = "INSERT INTO re_work_order (id_customer, id_contact, po_number, item_code, id_consignee, id_ship_via, ship_date, cut_off, sell_date, id_status, notes, item_description, box_type_dry, box_qty, pack_dry, wet_per_dry, pack_per_wet, box_type_wet, activity_line, description_line, quantity_line, unit_price_line, tax_percent_line, tax_price_line, total_price_line) VALUES ( ";
			$query .= "'".$data->customer."', ";
			$query .= "'".$data->contact_number."', ";
			$query .= "'".$data->po."', ";
			$query .= "'".$data->item."', ";
			$query .= "'".$data->consignee."', ";
			$query .= "'".$data->ship_via."', ";
			$query .= "'".$data->ship_date."', ";
			$query .= "'".$data->cut_off."', ";
			$query .= "'".$data->sell_by_date."', ";
			$query .= "'".$data->status."', ";
			$query .= "'".$data->notes."', ";
			$query .= "'".$data->item_description."', ";
			$query .= "'".$data->box_type_dry."', ";
			$query .= "'".$data->boxesqty."', ";
			$query .= "'".$data->pack_dry."', ";
			$query .= "'".$data->wet_per_dry."', ";
			$query .= "'".$data->pack_per_wet."', ";
			$query .= "'".$data->box_type_wet."', ";
			$query .= "'".$data->activity_line."', ";
			$query .= "'".$data->description_line."', ";
			$query .= "'".$data->quantity_line."', ";
			$query .= "'".$data->unit_price_line."', ";
			$query .= "'".$data->tax_percent_line."', ";
			$query .= "'".$data->tax_price_line."', ";
			$query .= "'".$data->total_price_line."' ";
			$query .= ");";
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

	//
	public function workorderGet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrTable = array();
			$query  = "SELECT a.id AS id_wo, a.id_customer, b.name_company AS customer, a.item_code AS id_product, g.item_code, a.po_number, a.id_contact, d.first_name, d.last_name, d.home_phone, d.email, a.id_consignee, e.name_company AS consignee, a.id_ship_via AS id_truck, f.name_company AS truck, d.mobile, a.ship_date, a.cut_off, a.sell_date, a.id_status, c.status, a.notes, a.item_description, a.box_type_dry, a.box_qty, a.pack_dry, a.wet_per_dry, a.pack_per_wet, a.box_type_wet, a.activity_line, a.description_line, a.quantity_line, a.unit_price_line, a.tax_percent_line, a.tax_price_line, a.total_price_line ";
			$query .= "FROM re_work_order AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN pa_status AS c ON a.id_status = c.id_status ";
			$query .= "LEFT JOIN re_contact AS d ON a.id_contact = d.id_contact  ";
			$query .= "LEFT JOIN re_accounts AS e ON a.id_consignee = e.id ";
			$query .= "LEFT JOIN re_accounts AS f ON a.id_ship_via = f.id ";
			$query .= "LEFT JOIN re_product AS g ON a.item_code = g.id ";
			$query .= "WHERE a.id = '".$data->id_wo."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrTable, $row);
					}
					$bool = true;
					$response = json_encode($arrTable);
				} else {
					$bool = false;
					$response = 'Wrong get work order';
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
	public function workorderUpdate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_work_order SET id_customer = '".$data->customer."', ";
			$query  .= "id_contact = '".$data->customer."', ";
			$query  .= "po_number = '".$data->po."', ";
			$query  .= "item_code = '".$data->item."', ";
			$query  .= "id_consignee = '".$data->consignee."', ";
			$query  .= "id_ship_via = '".$data->ship_via."', ";
			$query  .= "ship_date = '".$data->ship_date."', ";
			$query  .= "cut_off = '".$data->cut_off."', ";
			$query  .= "sell_date = '".$data->sell_by_date."', ";
			$query  .= "id_status = '".$data->status."', ";
			$query  .= "notes = '".$data->notes."', ";
			$query  .= "box_qty = '".$data->boxesqty."', ";
			$query  .= "activity_line = '".$data->activity_line."',";
			$query  .= "description_line = '".$data->description_line."',";
			$query  .= "quantity_line = '".$data->quantity_line."',";
			$query  .= "unit_price_line = '".$data->unit_price_line."', ";
			$query  .= "tax_percent_line = '".$data->tax_percent_line."', ";
			$query  .= "tax_price_line = '".$data->tax_price_line."', ";
			$query  .= "total_price_line = '".$data->total_price_line."' ";
			$query  .= "WHERE id = '".$data->idWo."'; ";
			$result = $conn->query($query);
			if($result){
				if($data->status == '29'){
					
					$queryUpdate1 = "UPDATE re_inventory SET status = '17', pallet_position = '".$data->pallet_position."', pallet_tag = '".$data->pallet_tag."' WHERE po_number = '".$data->po."' AND id_product = '".$data->item."'; ";
					$resultUpdate1 = $conn->query($queryUpdate1);

					$queryTag = "INSERT INTO re_pallet (number, position, tag, in_use) VALUES ('".$data->pallet_tag."', '0', '0', '0');";
					$resultTag = $conn->query($queryTag);
						
					$queryUpdate2 = "UPDATE re_product SET pack = '13' WHERE id = '".$data->item."' AND po_number = '".$data->po."'; ";
					$resultUpdate2 = $conn->query($queryUpdate2);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = 'Update OK';
		
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

	//Contact Customer
	public function contactCustomer($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayContactCustomer = array();
			$query  = "SELECT * ";
			$query .= "FROM re_contact WHERE id_accounts = '".$data->customer."'";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$row->first_name = $row->first_name.' '.$row->last_name;
						array_push($arrayContactCustomer, $row);
					}
					$bool = true;
					$response = json_encode($arrayContactCustomer);
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

	//
	public function contactCustomerInfo($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayWorkorderContact = array();
			$query  = "SELECT * ";
			$query .= "FROM re_contact where id_contact= ".$data->contact_number;
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayWorkorderContact, $row);
					}
					$bool = true;
					$response = json_encode($arrayWorkorderContact);
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

	//Status Work Order
	public function status(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayStatus = array();
			$query  = "SELECT *";
			$query .= "FROM pa_status where modulo = '7';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayStatus, $row);
					}
					$bool = true;
					$response = json_encode($arrayStatus);
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

	//
	public function poWo(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT DISTINCT po_number FROM re_inventory WHERE status = '19';";
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
			$query  = "SELECT DISTINCT a.id_product, b.item_code ";
			$query .= "FROM re_inventory AS a ";
			$query .= "JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "WHERE a.po_number = '".$data->po."' AND a.status = '19';";
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
			$query  = "SELECT  a.id_product, b.item_description, b.box_type_dry, b.box_qty, b.pack_dry, b.wet_per_dry, b.pack_per_wet, b.box_type_wet ";
			$query .= "FROM re_inventory AS a ";
			$query .= "JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "WHERE a.po_number = '".$data->po."' AND a.id_product = '".$data->product."' AND a.status = '19';";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
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

	//
	public function workorderBoxTyp(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayWorkorderBoxTyp = array();
			$query  = "SELECT * ";
			$query .= "FROM re_box;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$row->box = $row->code.' '.$row->length.' '.$row->width.' '.$row->height;
						array_push($arrayWorkorderBoxTyp, $row);
					}
					$bool = true;
					$response = json_encode($arrayWorkorderBoxTyp);
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