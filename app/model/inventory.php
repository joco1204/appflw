<?php
class Inventory{
	
	function __construct(){
		$this->bsn = new Business();
	}
	//receiving table method
	public function inventoryTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceiving = array();
			$query  = "SELECT a.id_inventory, a.id_product, a.po_number, b.item_description, e.status AS pack_system, SUM(a.box_qty) AS box_qty, a.pallet_position, a.pallet_tag, g.name_company AS truck_line, f.truck_date AS truck_day ";
			$query .= "FROM re_inventory AS a ";
			$query .= "JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "JOIN pa_status AS e ON a.pack_system = e.id_status ";
			$query .= "JOIN re_purchasing_order AS f ON a.po_number = f.po_number ";
			$query .= "LEFT JOIN re_accounts AS g ON f.truck_line = g.id ";
			$query .= "WHERE a.status = '17' ";
			$query .= "GROUP BY a.id_product, a.po_number, b.item_description, e.status, a.pallet_position, a.pallet_tag, g.name_company, f.truck_date; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrayReceiving, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrayReceiving);
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

	//Update inventory, shipment and work order 
	public function inventoryUpdateStatus($data){
		//var_dump($data);
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query1 = "UPDATE re_inventory SET pallet_position = '0', pallet_tag = '0', status = '".$data->status."' WHERE po_number = '".$data->po."' AND id_product = '".$data->product."'; ";
			$result1 = $conn->query($query1);
			if($result1){
				$queryPallet = "UPDATE re_pallet SET in_use = '0' WHERE number = '".$data->position."' AND position = '1';";
				$resultPallet = $conn->query($queryPallet);

				$total_product = 0;
				$products_complete = 0;
				//Total Products
				$query2 = "SELECT COUNT(*) total_product FROM re_product WHERE po_number = '".$data->po."';";
				$result2 = $conn->query($query2);
				while($row2 = $result2->fetch(PDO::FETCH_OBJ)){
					$total_product = $row2->total_product;
				}
				//Products completes
				$query3 = "SELECT COUNT(*) total_product FROM re_product WHERE po_number = '".$data->po."' AND status = '20';";
				$result3 = $conn->query($query2);
				while($row3 = $result3->fetch(PDO::FETCH_OBJ)){
					$products_complete = $row3->total_product;
				}
				if($total_product == $products_complete){
					$query4 = "UPDATE re_purchasing_order SET status = '20' WHERE po_number = '".$data->po."'";
					$result4 = $conn->query($query4);
				}
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
	
}
?>
