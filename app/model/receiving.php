<?php
class Receiving{
	
	function __construct(){
		$this->bsn = new Business();
	}

	//receiving table method
	public function receivingTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceiving = array();
			$query  = "SELECT a.id_receiving, a.awb, e.name_company as carrie_grower, d.background, a.id_receiving, a.date_arrival, b.name_company AS customer, c.city, a.pieces_master, a.id_status, a.sub_id_status, d.status ";
			$query .= "FROM re_receiving AS a ";
			$query .= "LEFT JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "LEFT JOIN pa_city AS c ON a.id_city = c.id ";
			$query .= "LEFT JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "LEFT JOIN re_accounts AS e ON a.carrie_grower = e.id ";
			$query .= "WHERE a.id_status NOT IN ('17') ";
			$query .= "AND d.modulo = '4' ";
			$query .= "ORDER BY a.id_receiving DESC; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$queryBox = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->awb."';";
					$resultBox = $conn->query($queryBox);
					while ($rowBox = $resultBox->fetch(PDO::FETCH_OBJ)){
						$row->box_qty = $rowBox->box_qty;
					}

					$queryBoxPending = "SELECT SUM(a.box_qty) AS box_pending FROM re_labels AS a WHERE a.receiving = '".$row->awb."' AND a.reader = '0';";
					$resultBoxPending = $conn->query($queryBoxPending);
					while($rowBoxPending = $resultBoxPending->fetch(PDO::FETCH_OBJ)){
						$row->box_pending = $rowBoxPending->box_pending;
					}

					$queryBox  = "SELECT CONCAT(a.box_type_dry,' - ',a.length,' x ',a.width,' x ', a.height) AS box ";
					$queryBox .= "FROM re_receiving_line AS a ";
					$queryBox .= "WHERE a.receiving = '".$row->awb."'; ";
					$resultBox = $conn->query($queryBox);
					while($rowBoxes = $resultBox->fetch(PDO::FETCH_OBJ)){
						$row->box = $rowBoxes->box;
					}

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

	//Create method
	public function receivingCreate($data){
		//Validate connection of db
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		if($conn){
			if ($data->lines != '0') {
					if ($data->awb_number != '' && $data->origin_country != '' && $data->origin_city != '' && $data->customer != '' && $data->receiving_date != '' && $data->time != '' && $data->weight != '' && $data->tip_weight != '' && $data->temp != '' && $data->status != ''){
						$query  = "INSERT INTO re_receiving (awb, id_country, id_city, id_customer, date, time_arrival, weight, type_weight, temp, pieces_master, id_status, comments, carrie_grower, user_registration) VALUES (";
						$query.="'".$data->awb_number."', ";
						$query.="'".$data->origin_country."', ";
						$query.="'".$data->origin_city."', ";
						$query.="'".$data->customer."', ";
						$query.="'".$data->receiving_date."', ";
						$query.="'".$data->time."', ";
						$query.="'".$data->weight."', ";
						$query.="'".$data->tip_weight."', ";
						$query.="'".$data->temp."', ";
						$query.="'".$data->pieces_master."', ";
						$query.="'".$data->status."', ";
						$query.="'".$data->notes."', ";
						$query.="'".$data->carrie_grower."', ";
						$query.="'".$session->getSession('iduser')."'); ";
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

	//Update method
	public function receivingUpdate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_receiving SET awb = '".$data->awb_number."', ";
			$query .= "id_country = '".$data->origin_country."', ";
			$query .= "id_city = '".$data->origin_city."', ";
			$query .= "id_customer = '".$data->customer."', ";
			$query .= "date = '".$data->receiving_date."', ";
			$query .= "time_arrival = '".$data->time."', ";
			$query .= "weight = '".$data->weight."', ";
			$query .= "type_weight = '".$data->tip_weight."', ";
			$query .= "temp = '".$data->temp."', ";
			$query .= "pieces_master = '".$data->pieces_master."', ";
			$query .= "id_status = '".$data->status."', ";
			$query .= "carrie_grower = '".$data->carrie_grower."' ";
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
	public function receivingGet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceiving = array();
			$query  = "SELECT  a.id_receiving, a.awb, a.id_country, e.country, a.id_city, c.city, a.id_customer, b.name_company AS customer, a.date, a.time_arrival, a.weight, a.type_weight, a.temp, a.pieces_master, a.id_status, d.status, a.carrie_grower AS id_carrie, b.name_company AS carrie, a.comments ";
			$query .= "FROM re_receiving AS a ";
			$query .= "JOIN re_accounts AS b ON a.id_customer = b.id ";
			$query .= "JOIN pa_city AS c ON a.id_city = c.id ";
			$query .= "JOIN pa_status AS d ON a.id_status = d.id_status ";
			$query .= "JOIN pa_country AS e ON a.id_country = e.id_country ";
			$query .= "JOIN re_accounts AS f ON a.carrie_grower = f.id ";
			$query .= "AND a.id_receiving=".$data->idReceiving."; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceiving, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceiving);
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
	public function receivingLineUp($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingLineUp = array();
			$query  = "SELECT a.id_line, a.receiving, a.item_code  ";
			$query  .= "FROM re_receiving_line AS a  ";
			$query  .= "inner join re_receiving AS b on a.receiving = b.awb ";
			$query  .= "WHERE b.id_receiving = '".$data->awb."'; ";
			$result = $conn->query($query);
			$cntLines=0;
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$cntLines++;
						array_push($arrayReceivingLineUp, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingLineUp);
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
	public function receivingToWork($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingLineUp = array();
			$query  = "SELECT DISTINCT C.name_company as customer, B.id_customer, A.po, A.product";
			$query .= " FROM re_receiving_line A";
			$query .= " inner join re_receiving B on A.receiving = B.id_receiving";
			$query .= " inner join re_accounts C on B.id_customer = C.id";
			$query .= " WHERE  A.receiving =".$data->AWBid.";";
			$result = $conn->query($query);
			$cntLines=0;
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						$cntLines++;
						array_push($arrayReceivingLineUp, $row);
					}
					
					$bool = true;
					$response = json_encode($arrayReceivingLineUp);
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
	public function receivingUpdateUpLine($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query_receiving  = "SELECT b.po AS po_numbre, b.receiving, b.item_code, c.id AS id_product, b.pack_system, a.id_receiving, b.id_line AS id_reciving_line ";
			$query_receiving .= "FROM re_receiving AS a ";
			$query_receiving .= "JOIN re_receiving_line AS b ON a.awb = b.receiving ";
			$query_receiving .= "JOIN re_product AS c ON b.item_code = c.item_code ";
			$query_receiving .= "WHERE b.id_line = '".$data->IdLine."'; ";
			$result_receiving = $conn->query($query_receiving);
			if($result_receiving){
				while ($row_receiving = $result_receiving->fetch(PDO::FETCH_OBJ)){
					$row_receiving->box_qty = '0';

					$query_box = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row_receiving->receiving."' AND po = '".$row_receiving->po_numbre."' AND item_code = '".$row_receiving->item_code."' AND reader = '1'; ";
					$result_box = $conn->query($query_box);

					while($row_box = $result_box->fetch(PDO::FETCH_OBJ)){
						$row_receiving->box_qty = $row_box->box_qty;
					}

					$query_insert  = "INSERT INTO re_inventory (po_number, id_product, pack_system, box_qty, pallet_position, pallet_tag, id_receiving, id_receiving_line, `status`) ";
					$query_insert .= "VALUES ('".$row_receiving->po_numbre."', '".$row_receiving->id_product."', '".$row_receiving->pack_system."', '".$row_receiving->box_qty."', '".$data->LocLine."', '".$data->PalLine."', '".$row_receiving->id_receiving."', '".$row_receiving->id_reciving_line."', '17'); ";
					$result_insert = $conn->query($query_insert);

					if($result_insert){
						$query_producto = "UPDATE re_product SET status = '2' WHERE id = '".$row_receiving->id_product."';";
						$result_producto = $conn->query($query_producto);
						if($result_producto){

							$queryTag = "INSERT INTO re_pallet (number, position, tag, in_use) VALUES ('".$data->PalLine."', '0', '1', '0');";
							$resultTag = $conn->query($queryTag);

							$queryPosition = "SELECT COUNT(*) AS postn FROM re_pallet WHERE position = '0' AND number = '".$data->LocLine."';";
							$resultPosition = $conn->query($queryPosition);
							
							while($rowPosition = $resultPosition->fetch(PDO::FETCH_OBJ)){
								if($rowPosition->postn == '0'){
									$insertPosition = "INSERT INTO re_pallet (number, position, tag, in_use) VALUES ('".$data->LocLine."', '1', '0', '1');";
									$resultInsPo = $conn->query($insertPosition);
								} else {
									$updatePosition = "UPDATE re_pallet SET in_use = '1' WHERE position = '1' AND number = '".$data->LocLine."';";
									$resultUpsPo = $conn->query($updatePosition);
								}
							}

							$this->bsn->return->bool = true;
							$this->bsn->return->msg = 'was updated correctly';
							
						} else {
							$this->bsn->return->bool = false;
							$this->bsn->return->msg = 'Erroneous Query';	
						}
					} else {
						$this->bsn->return->bool = false;
						$this->bsn->return->msg = 'Erroneous Query';
					}
				}
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous Query';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}

	//Update method Status
	public function receivingUpdateStatus($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			isset($data->locR) ? $data->locR = $data->locR : $data->locR = '';
			isset($data->coolR) ? $data->coolR = $data->coolR : $data->coolR = '';

			if ($data->coolR == 1){
				$pieces = explode("<br>", $data->locR);
				foreach($pieces as $element)
				{
					$element = str_replace('<div class="row"><div class="col-md-4 col-md-offset-2"><b>Barcode #:</b></div><div class="col-md-4">',"",$element);
					$element = str_replace('</div></div>',"",$element);
					$result = $conn->query($query);
				}
			}

			$query  = "UPDATE re_receiving SET ";
			$query .= "id_status = '".$data->newR."' ";
			$query .= "WHERE id_receiving = ".$data->awbR."; ";
			$result = $conn->query($query);
			if($result){
				$cntLine = 0;
				$cntLineRead = 0;

				$query1 = "SELECT count(id_line) AS d2 FROM re_receiving_line WHERE receiving = '".$data->awbR."'; ";
				$result1 = $conn->query($query1);
				if($result1){
					if($result1->rowCount() > 0){
						while($row1 = $result1->fetch(PDO::FETCH_OBJ)){
							$cntLine = $row1->d2;
						}	
					}
				}
				$query2 = "SELECT count(id_line) AS d2 FROM re_receiving_line WHERE receiving = '".$data->awbR."' AND isread ='YES'; ";
				$result2 = $conn->query($query2);
				if($result2){
					if($result2->rowCount() > 0){
						while($row2 = $result2->fetch(PDO::FETCH_OBJ)){
							$cntLineRead = $row2->d2;
						}	
					}
				}
				$total = ($cntLineRead - $cntLine);
				if($total <= 0){
					$query  = "UPDATE re_receiving set sub_id_status = 'Complete' where id_receiving = '".$data->awbR."'; ";
					$result = $conn->query($query);
				}else{
					$query  = "UPDATE re_receiving set sub_id_status = 'Incomplete' where id_receiving = '".$data->awbR."'";
					$result = $conn->query($query);
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

	//
	public function receivingCity($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingCity = array();
			$query  = "SELECT * ";
			$query .= "FROM pa_city ";
			$query .= "WHERE  id_country = '".$data->country."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingCity, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingCity);
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
	public function receivingCountry(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingCountry = array();
			$query  = "SELECT *";
			$query .= "FROM pa_country  ;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingCountry, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingCountry);
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
	public function receivingStatus(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingStatus = array();
			$query  = "SELECT *";
			$query .= "FROM pa_status where modulo = '4' ";
			$query .= "and id_status IN ('15', '16'); ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingStatus, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingStatus);
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
	public function receivingLines($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLines = array();
			$query  = "SELECT a.id_line, a.receiving, a.po, a.item_code, a.item_description, c.box_type_dry, c.length, c.width, c.height  ";
			$query .= "FROM re_receiving_line AS a ";
			$query .= "WHERE a.receiving = '".$data->id."'; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$row->box = $row->code." - ".$row->length."x".$row->width."x".$row->height;
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

	public function receivingCoolexpres($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLines = array();
			$query  = "SELECT a.id_line, a.receiving, a.po, a.item_code, a.item_description, CONCAT(a.box_type_dry,' - ',a.length,' x ',a.width,' x ', a.height) AS box, a.pallet_qty ";
			$query .= "FROM re_receiving_line AS a ";
			$query .= "WHERE a.receiving = '".$data->id."'; ";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					
					$queryLabelInit = "SELECT MIN(barcode) AS label_init FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."' AND reader = '0'; ";
					$resultLabelInit = $conn->query($queryLabelInit);
					while($rowLabelInit = $resultLabelInit->fetch(PDO::FETCH_OBJ)){
						$row->label_init = $rowLabelInit->label_init;
					}

					$queryLabelEnd = "SELECT MAX(barcode) AS label_end FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."' AND reader = '0'; ";
					$resultLabelEnd = $conn->query($queryLabelEnd);
					while($rowLabelEnd = $resultLabelEnd->fetch(PDO::FETCH_OBJ)){
						$row->label_end = $rowLabelEnd->label_end;
					}

					$queryq = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->receiving."' AND po = '".$row->po."' AND reader = '0';";
					$resultq = $conn->query($queryq);
					while($rowq = $resultq->fetch(PDO::FETCH_OBJ)){
						$row->pieces = $rowq->box_qty;
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
	
	
	
	//receivingCoolexpresLabel
	public function receivingCoolexpresLabel($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLines = array();
			$query  = "SELECT barcode  ";
			$query  .= "from re_labels  ";
			$query  .= "where receiving = '".$data->awb."' ";
			$query  .= "and item_code  = '".$data->id."'; ";
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
	
	
	//PO Lines
	public function receivingLinesPO(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrLinesPO = array();
			$query  = "select a.po_number,a.case_total,b.product_name ";
			$query .= "from re_purchasing_order a ";
			$query .= "inner join re_product b on a.id_product = b.id ";
			$query .= "where  status <> 2;";
			
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
			$arrayReceivingPONumber = array();
			$query  = "select distinct(po_number) po_number ";
			$query .= "from re_purchasing_order;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingPONumber, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingPONumber);
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
			$arrayReceivingPONumber = array();
			$query  = "select id, item_code, item_description  ";
			$query .= "from re_product ";
			$query .= "where po_number = '".$data->n_po."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingPONumber, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingPONumber);
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
			$arrayReceivingQuality = array();
			$query  = "select quantity ,in_receiving ";
			$query .= "from re_product ";
			$query .= "where id = '".$data->n_prod."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingQuality, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingQuality);
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
	
	//get label awb
	public function get_labelAWB($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingLabel = array();
			$query  = "select barcode ";
			$query .= "from re_labels a ";
			$query .= "inner join re_receiving b on a.receiving = b.awb ";
			$query .= "where a.item_code = '".$data->item_code."' ";
			$query .= "and a.pallet = 0 ";
			$query .= "and b.id_receiving = '".$data->awb."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingLabel, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingLabel);
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
	
	//Update Pallet of Label or barcode
	public function update_labelPallet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$nextPallet=0;
		//Validate the connection of db
		if($conn){
			$queryNext  = "select max(id)+1 next_pallet ";
			$queryNext .= "from re_pallet;";
			$resultNext = $conn->query($queryNext);
			if($resultNext){
				
				while($rowNext = $resultNext->fetch(PDO::FETCH_OBJ)){
					$nextPallet= $rowNext->next_pallet;
				}
			}	
					
			$query  = "UPDATE re_labels SET pallet = ".$nextPallet." WHERE barcode = '".$data->label."' and item_code= '".$data->item_code."';";
			$result = $conn->query($query);
			if($result){
				$query  = "INSERT re_pallet ()values() ;";
				$result = $conn->query($query);
				if($result){
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'OK';	
				}
				
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
	//get label awb
	public function get_palletAWB($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingLabel = array();
			$query  = "select count(pallet) cnt, pallet, c.position ";
			$query .= "from re_labels a ";
			$query .= "inner join re_receiving b on a.receiving = b.awb ";
			$query .= "inner join re_pallet c on a.pallet = c.id ";
			$query .= "where a.item_code = '".$data->item_code."' ";
			$query .= "and a.pallet <> 0 ";
			$query .= "and b.id_receiving = '".$data->awb."' ";
			$query .= "group by pallet ;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingLabel, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingLabel);
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
	//Update Pallet of Label or barcode
	public function update_labelPalletPosition($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_pallet SET position = '".$data->position."' , tag = '".$data->id_pallet."', in_use='1'  WHERE id = '".$data->id_pallet."';";
			$result = $conn->query($query);
			if($result){
				$po_insert="";
				$pack_insert="";
				$num_line_insert="";
				$product_insert="";
				
				$queryNext  = "select b.po,b.pack_system,b.id_line,GetID_Product(b.item_code) product ";
				$queryNext .= "from re_receiving a ";
				$queryNext .= "inner join re_receiving_line b on a.awb = b.receiving ";
				$queryNext .= "where a.id_receiving = '".$data->awb."' ";
				$queryNext .= "and b.item_code = '".$data->item_code."' ;";
				$resultNext = $conn->query($queryNext);
				if($resultNext){
					while($rowNext = $resultNext->fetch(PDO::FETCH_OBJ)){
						$po_insert= $rowNext->po;
						$pack_insert= $rowNext->pack_system;
						$num_line_insert= $rowNext->id_line;
						$product_insert= $rowNext->product;
					}
				}
				

				$queryInv  = "INSERT INTO re_inventory (po_number, id_product, pack_system, box_qty, pallet_position, pallet_tag, id_receiving, id_receiving_line, status) VALUES ";
				$queryInv  .= "('".$po_insert."', '".$product_insert."', '".$pack_insert."', '".$data->cnt_box."', '".$data->position."', '".$data->id_pallet."', '".$data->awb."', '".$num_line_insert."', 17)";
				var_dump($queryInv);
				$resultInv = $conn->query($queryInv);
				if($resultInv){
					
	
				}
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'OK';	
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
	
	//Add Labels
	public function receivingAddLabel($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$query  = "UPDATE re_labels SET reader = '1' WHERE barcode = '".$data->Label."';";			
			$result = $conn->query($query);
			if($result){
				$queryq = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->receiving."' AND item_code = '".$row->item_code."' AND reader = '0';";
				$resultq = $conn->query($queryq);
				while($rowq = $resultq->fetch(PDO::FETCH_OBJ)){
					$row->pieces = $rowq->box_qty;
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = $row->pieces;	
				}
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

	//Query pallet
	public function receivingPallet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayReceivingPallet = array();
			$query  = "SELECT name ";
			$query .= "FROM re_pallet ";
			if($data->type == 'position'){
				$query .= "WHERE position_number = '1' ";
			} else {
				$query .= "WHERE tag_number = '1' ";
			}
			$query .= "AND status = '30'; ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayReceivingPallet, $row);
					}
					$bool = true;
					$response = json_encode($arrayReceivingPallet);
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

	public function receivingReaderFull($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		var_dump($data);
		$labels="";
		$labels_cnt=0;
		foreach ($data->lines as $valor) {
			if($labels_cnt==0){
				$labels.=$valor;
			}else{
				$labels.=",".$valor;
			}
		}	
		$queryq = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->receiving."' AND item_code = '".$row->item_code."' AND reader = '0';";
		$resultq = $conn->query($queryq);
		while($rowq = $resultq->fetch(PDO::FETCH_OBJ)){
			$row->pieces = $rowq->box_qty;
			$this->bsn->return->bool = true;
			$this->bsn->return->msg = $row->pieces;	
		}
		if($conn){
			/*$query  = "UPDATE re_labels SET reader = '1' WHERE barcode = '".$data->Label."';";			
			$result = $conn->query($query);
			if($result){
				$queryq = "SELECT SUM(box_qty) AS box_qty FROM re_labels WHERE receiving = '".$row->receiving."' AND item_code = '".$row->item_code."' AND reader = '0';";
				$resultq = $conn->query($queryq);
				while($rowq = $resultq->fetch(PDO::FETCH_OBJ)){
					$row->pieces = $rowq->box_qty;
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = $row->pieces;	
				}
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			}*/
			$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Erroneous query';
			
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
}
?>
