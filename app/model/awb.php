<?php
class AWB{
	function __construct(){
		$this->bsn = new Business();
	}

	//receiving table method
	public function awbTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwb = array();
			$query  = "SELECT a.awb, e.name_company as carrie_grower, d.background, a.id_receiving, a.truck_date, b.name_company AS customer, c.city, a.pieces_master, a.id_status, a.sub_id_status, d.status ";
			$query .= "FROM re_receiving AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN pa_city AS c ON a.id_city = c.id ";
			$query .= "LEFT JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "LEFT JOIN re_accounts AS e ON a.carrie_grower = e.id ";
			$query .= "WHERE a.id_status NOT IN ('11') ";
			$query .= "AND d.modulo = '2' ";
			$query .= "ORDER BY a.id_receiving DESC; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$queryBox = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->awb."';";
					$resultBox = $conn->query($queryBox);
					while ($rowBox = $resultBox->fetch(PDO::FETCH_OBJ)){
						$row->box_qty = $rowBox->box_qty;
					}
					array_push($arrayAwb, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrayAwb);
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
	public function awbCreate($data){
		//Validate connection of db
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		if($conn){
			if ($data->lines != '0'){
				if ($data->awb_number != '' && $data->origin_country != '' && $data->origin_city != '' && $data->carrie_grower != '' && $data->customer != '' && $data->pieces_master != '' && $data->status != '' && $data->weight != '' && $data->tip_weight != '' && $data->temp != ''){
					$query  = "INSERT INTO re_receiving (awb, awb_hija, awb_nieta, id_country, id_city, carrie_grower, id_customer, pieces_master, ship_date_origin, time_ship_origin, id_status, weight, type_weight, date_arrival, time_arrival, temp, comments) VALUES (";
					$query.="'".$data->awb_number."', ";
					$query.="'".$data->awb_hija."', ";
					$query.="'".$data->awb_nieta."', ";
					$query.="'".$data->origin_country."', ";
					$query.="'".$data->origin_city."', ";
					$query.="'".$data->carrie_grower."', ";
					$query.="'".$data->customer."', ";
					$query.="'".$data->pieces_master."', ";
					$query.="'".$data->ship_date_origin."', ";
					$query.="'".$data->time_ship_origin."', ";
					$query.="'".$data->status."', ";
					$query.="'".$data->weight."', ";
					$query.="'".$data->tip_weight."', ";
					$query.="'".$data->date_arrival."', ";
					$query.="'".$data->time_arrival."', ";
					$query.="'".$data->temp."', ";
					$query.="'".$data->notes."');";
					$result = $conn->query($query);
					//Validate result insert
					if($result){
						$id_receiving = $conn->lastInsertId();
						$arrLine = array();
						//Loop create 
						for($i=1; $i <= $data->lines; $i++) { 
							$boxes 		= 'boxes_'.$i;
							$pieces 	= 'pieces_'.$i;
							$po_number 	= 'po_number_'.$i;
							$prod_id 	= 'po_prod_id_'.$i;
							$label_init = 'label_init_'.$i;
							$label_end 	= 'label_end_'.$i;
							//Validate line information
							isset($data->$boxes) ? $data->$boxes = $data->$boxes : $data->$boxes = '';
							isset($data->$pieces) ? $data->$pieces = $data->$pieces : $data->$pieces = '';
							isset($data->$po_number) ? $data->$po_number = $data->$po_number : $data->$po_number = '';
							isset($data->$prod_id) ? $data->$prod_id = $data->$prod_id : $data->$prod_id = '';
							
							//Insert Line receiving
							$queryUpdatePO  = "update re_product set in_receiving=".$data->$pieces." where po_number=".$data->$po_number." and id=".$data->$prod_id;
							$resultLine = $conn->query($queryUpdatePO);
							
							
							$queryLine  = "INSERT INTO re_receiving_line (receiving, po, product, box, pieces, label_init, label_end) ";
							$queryLine .= "VALUES ('".$id_receiving."', '".$data->$po_number."', '".$data->$prod_id."', '".$data->$boxes."', '".$data->$pieces."', '".$data->$label_init."', '".$data->$label_end."');";
							$resultLine = $conn->query($queryLine);
						}
						$this->bsn->return->bool = true;
						$this->bsn->return->msg = 'was created correctly';
					} else {
						$this->bsn->return->bool = false;
						$this->bsn->return->msg = 'Erroneous query';
					}
				} else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'No Field Null';
				}
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'No lines added';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}

	//Insert load file awb
	public function insert_file_awb($file){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){

			/**********************************************/
			//Load file scv insert awb
			$fname = $file->name;
			$ext = explode(".",$fname);
			if(strtolower(end($ext)) == "csv" || strtolower(end($ext)) == "txt"){
				//si es correcto, entonces damos permisos de lectura para subir
				$file_tmp_name = $file->tmp_name;
				$handle = fopen($file_tmp_name, "r");
				$flag_line = 0;
				$list_awb_in = array();
				$list_line_in = array();
				while($data = fgetcsv($handle, 1000, ";")){
					if (!in_array($data[2], $list_awb_in)) {
						array_push($list_awb_in,$data[2]);
					
						$query  = "INSERT INTO re_receiving (id_country, id_city, awb, awb_hija, awb_nieta, carrie_grower, id_customer, po_number, id_consignee, consignee_dc, truck_line, truck_date, id_status) VALUES ( ";
						$query .= " GetID_Country('".$data[0]."'), ";
						$query .= " GetID_City('".$data[1]."'), ";
						$query .= " '".$data[2]."', ";
						$query .= " '".$data[3]."', ";
						$query .= " '".$data[4]."', ";
						$query .= " GetID_Carrier('".$data[5]."'), ";
						$query .= " GetID_Customer('".$data[6]."'), ";
						$query .= " '".$data[7]."', ";
						$query .= " GetID_Consignee('".$data[8]."'), ";
						$query .= " '".$data[9]."', ";
						$query .= " GetID_Truck('".$data[10]."'), ";
						$query .= " '".$data[11]."', ";
						$query .= " '32' ";
						$query .= "); ";
						$result = $conn->query($query);


						$query2 = "INSERT INTO re_receiving_line (receiving, po, item_code, item_description, grade, pack_system, box_type_dry, length, width, height, tie, high, pallet_qty) VALUES ( ";
						$query2 .= " '".$data[2]."', ";
						$query2 .= " '".$data[7]."', ";
						$query2 .= " '".$data[12]."', ";
						$query2 .= " '".$data[13]."', ";
						$query2 .= " '".$data[14]."', ";
						$query2 .= " GetID_Status('".$data[15]."'), ";
						$query2 .= " '".$data[16]."', ";
						$query2 .= " '".$data[17]."', ";
						$query2 .= " '".$data[18]."', ";
						$query2 .= " '".$data[19]."', ";
						$query2 .= " '".$data[20]."', ";
						$query2 .= " '".$data[21]."', ";
						$query2 .= " '".$data[22]."'";
						$query2 .= "); ";
						$result2 = $conn->query($query2);
					}

					$query3  = "INSERT INTO re_labels (receiving, po, item_code, box_qty, barcode) VALUES ( ";
					$query3 .= " '".$data[2]."', ";
					$query3 .= " '".$data[7]."', ";
					$query3 .= " '".$data[12]."', ";
					$query3 .= " '".$data[23]."', ";
					$query3 .= " '".$data[24]."'";
					$query3 .= ");";
					$result3 = $conn->query($query3);
					$flag_line++;
				}
				//cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
				fclose($handle);
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = "the file has been successfully loaded";
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'The file extension must be csv or tx';
			}
			/**********************************************/
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;

	}


	//Update method
	public function awbUpdate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_receiving SET id_country = '".$data->origin_country."', ";
			$query .= "id_city = '".$data->origin_city."', ";
			$query .= "carrie_grower = '".$data->carrie_grower."', ";
			$query .= "ship_date_origin = '".$data->ship_date_origin."', ";
			$query .= "time_ship_origin = '".$data->time_ship_origin."', ";
			$query .= "date_arrival = '".$data->date_arrival."', ";
			$query .= "time_arrival = '".$data->time_arrival."', ";
			if($data->status_h == '32'){
				$query .= "id_status = '3', ";
			}
			$query .= "temp = '".$data->temp."', ";
			$query .= "comments = '".$data->notes."' ";
			$query .= "WHERE id_receiving = ".$data->idReceiving."; ";
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
	public function awbGet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwb = array();
			$query  = "SELECT  a.id_receiving, a.awb, a.awb_hija, a.awb_nieta, a.id_country, e.country, a.id_city, c.city, a.carrie_grower AS id_carrie, g.name_company AS carrie, a.id_customer, b.name_company AS customer, a.ship_date_origin, a.time_ship_origin, a.id_status, d.status, a.weight, a.type_weight, a.date_arrival, a.time_arrival, a.temp, a.comments ";
			$query .= "FROM re_receiving AS a ";
			$query .= "JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "JOIN pa_city AS c ON a.id_city = c.id ";
			$query .= "JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "JOIN pa_country AS e ON a.id_country = e.id_country ";
			$query .= "JOIN re_accounts AS f ON a.carrie_grower = f.id ";
			$query .= "JOIN re_accounts AS g ON a.carrie_grower = g.id ";
			$query .= "AND a.id_receiving=".$data->idReceiving."; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$queryBox = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->awb."';";
						$resultBox = $conn->query($queryBox);
						while ($rowBox = $resultBox->fetch(PDO::FETCH_OBJ)){
							$row->pieces_master = $rowBox->box_qty;
						}
						array_push($arrayAwb, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwb);
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
	public function awbLineUp($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbLineUp = array();
			$query  = "SELECT a.id_line, b.item_code, a.location, a.pallete ";
			$query .= "FROM re_receiving_line  AS a ";
			$query .= "JOIN re_product AS b ON a.product = b.id ";
			$query .= "WHERE  a.receiving = '".$data->AWBid."'; ";
			$result = $conn->query($query);
			$cntLines=0;
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$cntLines++;
						array_push($arrayAwbLineUp, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbLineUp);
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
	public function awbToWork($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbLineUp = array();
			$query  = "SELECT C.name_company as customer, B.id_customer, A.po, A.product";
			$query .= " FROM re_receiving_line A";
			$query .= " inner join re_receiving B on A.receiving = B.id_receiving";
			$query .= " inner join re_accounts C on B.id_customer = C.id";
			$query .= " WHERE  A.receiving = '".$data->AWBid."';";
			$result = $conn->query($query);
			$cntLines=0;
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$cntLines++;
						array_push($arrayAwbLineUp, $row);
					}
					
					$bool = true;
					$response = json_encode($arrayAwbLineUp);
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
	public function awbUpdateUpLine($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_receiving_line SET location = '".$data->LocLine."', ";
			$query .= "pallete='".$data->PalLine."' ";
			$query .= "WHERE id_line = ".$data->IdLine.";";
			$result = $conn->query($query);
			if($result){
				$queryInventory = "SELECT id_line, receiving, po, product FROM re_receiving_line WHERE id_line = '".$data->IdLine."';";
				$resultInventory = $conn->query($queryInventory);
				while ($rowi= $resultInventory->fetch(PDO::FETCH_OBJ)){
					//Insert Inventory product
					$queryi  = "INSERT INTO re_inventory (po_number, id_product, id_receiving, id_receiving_line, status) ";
					$queryi .= "VALUES ('".$rowi->po."', '".$rowi->product."', '".$rowi->receiving."', '".$rowi->id_line."', '28'); ";
					$resulti = $conn->query($queryi);
					//Update status product
					$queryp = "UPDATE re_product SET status = '20' WHERE id = '".$rowi->product."';";
					$resultp = $conn->query($queryp);
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

	//Update method Status
	public function awbUpdateStatus($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_receiving SET ";
			if($data->id_status == '11'){
				$query .= "id_status = '14' ";
			} else {
				$query .= "id_status = '".$data->id_status."' ";
			}
			$query .= "WHERE id_receiving = ".$data->awb."; ";
			$result = $conn->query($query);
			if($result){
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = 'was Updated Status correctly';
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
	public function awbCity($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbCity = array();
			$query  = "SELECT * ";
			$query .= "FROM pa_city ";
			$query .= "WHERE  id_country = '".$data->country."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwbCity, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbCity);
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
	public function awbCountry(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbCountry = array();
			$query  = "SELECT *";
			$query .= "FROM pa_country; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwbCountry, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbCountry);
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
	public function awbStatus(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwb = array();
			$query  = "SELECT *";
			$query .= "FROM pa_status where modulo = '2' ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwb, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwb);
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
	public function awbLines($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLines = array();
			$query  = "SELECT a.receiving, a.po, a.item_code AS item, CONCAT(a.item_code,' - ',a.item_description) AS item_code, b.status AS pack_system, CONCAT(a.box_type_dry,' - ',a.length,' x ',a.width,' x ', a.height) AS box ";
			$query .= "FROM re_receiving_line AS a ";
			$query .= "JOIN pa_status AS b ON a.pack_system = b.id_status ";
			$query .= "WHERE a.receiving = '".$data->awb."'; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$query_qty = "SELECT SUM(box_qty) AS pallet_qty FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."' AND item_code = '".$row->item."';";
					$result_qty = $conn->query($query_qty);
					while ($row_qty = $result_qty->fetch(PDO::FETCH_OBJ)){
						$row->pallet_qty = $row_qty->pallet_qty;
					}

					$queryLabelInit = "SELECT MIN(barcode) AS label_init FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."'; ";
					$resultLabelInit = $conn->query($queryLabelInit);
					while($rowLabelInit = $resultLabelInit->fetch(PDO::FETCH_OBJ)){
						$row->label_init = $rowLabelInit->label_init;
					}

					$queryLabelEnd = "SELECT MAX(barcode) AS label_end FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."'; ";
					$resultLabelEnd = $conn->query($queryLabelEnd);
					while($rowLabelEnd = $resultLabelEnd->fetch(PDO::FETCH_OBJ)){
						$row->label_end = $rowLabelEnd->label_end;
					}

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
	
	//PO Lines
	public function awbLinesPO(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLinesPO = array();
			$query  = "SELECT a.po_number, a.case_total, b.product_name ";
			$query .= "FROM re_purchasing_order AS a ";
			$query .= "INNER JOIN re_product AS b ON a.id_product = b.id ";
			$query .= "WHERE status <> 2; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$row->po_product = $row->po_number." - ".$row->product_name;
					array_push($arrLinesPO, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrLinesPO);
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
	public function po_number(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbPONumber = array();
			$query  = "select distinct(po_number) po_number ";
			$query .= "from re_purchasing_order;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwbPONumber, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbPONumber);
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
	public function po_number_prod($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbPONumber = array();
			$query  = "SELECT id, item_code, item_description  ";
			$query .= "FROM re_product ";
			$query .= "WHERE po_number = '".$data->n_po."'; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwbPONumber, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbPONumber);
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
	public function po_quallity_prod($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAwbQuality = array();
			$query  = "SELECT box_qty, in_receiving ";
			$query .= "FROM re_product ";
			$query .= "WHERE id = '".$data->n_prod."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAwbQuality, $row);
					}
					$bool = true;
					$response = json_encode($arrayAwbQuality);
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
