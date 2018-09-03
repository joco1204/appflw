<?php
class PurchasingOrder{	
	function __construct(){
		$this->bsn = new Business();
	}
	//
	public function poTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$cmpt_date="-2018";
			$query  = "SELECT a.id, h.name_company AS customer_name, truck_date, i.name_company AS truck_line, po_number, j.name_company AS consignee_name,'' as truck_date_day ,g.status,g.background,a.delivered_date, b.state AS consignee_state, consignee_dc_number,consignee_zip_code,consignee_addrees, c.city AS consignee_city ";
			$query .= "FROM re_purchasing_order AS a ";
			$query .= "JOIN pa_state AS b ON a.consignee_state = b.id ";
			$query .= "JOIN pa_city AS c ON a.consignee_city = c.id ";
			$query .= "JOIN pa_status AS g ON a.status = g.id_status ";
			$query .= "LEFT JOIN re_accounts AS h ON a.customer_name = h.id ";
			$query .= "LEFT JOIN re_accounts AS i ON a.truck_line = i.id ";
			$query .= "LEFT JOIN re_accounts AS j ON a.consignee_name = j.id ";
			$query .= "ORDER BY a.id;";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					
					
					$date = $row->truck_date.'-2018';
					$nameOfDay = date('D', strtotime($date));
					$row->truck_date_day = $nameOfDay;
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
	public function dc_name(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrDCname = array();
			$query  = "SELECT a.id AS id_city, CONCAT(a.city,', ',b.abbreviation) AS dc_name ";
			$query .= "FROM pa_city AS a ";
			$query .= "JOIN pa_state AS b ON a.id_state = b.id ";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrDCname, $row);
					}
					$bool = true;
					$response = json_encode($arrDCname);
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
	public function client(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrClient = array();
			$query  = "SELECT id, client_name FROM re_client;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrClient, $row);
					}
					$bool = true;
					$response = json_encode($arrClient);
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
	public function supplier(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrSupplier = array();
			$query  = "SELECT id, supplier_name FROM re_supplier;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrSupplier, $row);
					}
					$bool = true;
					$response = json_encode($arrSupplier);
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
	public function status(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrStatus = array();
			$query  = "SELECT id_status, status FROM pa_status WHERE activo = 'SI' AND modulo = '4';"; 
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
	public function pack(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrStatus = array();
			$query  = "SELECT id_status, status FROM pa_status WHERE activo = 'SI' AND modulo = '5';"; 
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
	public function poCreate($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			if ($data->po_number != '' && $data->department_miami_date != '' && $data->dc_delivery_date != '' && $data->dc_came != 0 && $data->client != 0 && $data->supplier != 0 && $data->pallet_total != '' && $data->case_total != '' && $data->cube_total != '' && $data->mini_boxes != '' && $data->start_boxes != '' && $data->sell_by_date != ''){
				$query  = "INSERT INTO re_purchasing_order (po_number, depart_miami_date, delivery_date, id_dc_name, id_client, id_supplier, pallet_total, case_total, cube_total, min_boxes, start_boxes, sell_by_date, comments, status, process_po)  VALUES ( ";
				$query.="'".$data->po_number."', ";
				$query.="'".$data->department_miami_date."', ";
				$query.="'".$data->dc_delivery_date."', ";
				$query.="'".$data->dc_came."', ";
				$query.="'".$data->client."', ";
				$query.="'".$data->supplier."', ";
				$query.="'".$data->pallet_total."', ";
				$query.="'".$data->case_total."', ";
				$query.="'".$data->cube_total."', ";
				$query.="'".$data->mini_boxes."', ";
				$query.="'".$data->start_boxes."', ";
				$query.="'".$data->sell_by_date."', ";
				$query.="'".$data->comments."', ";
				$query.="'19', ";
				$query.="'24');";
				//Validate result insert
				$result = $conn->query($query);
				if($result){
					$arrLine = array();
					//Loop create 
					for($i=1; $i <= $data->lines; $i++){
						$item_code 		= 'item_code_'.$i;
						$product_name 	= 'product_name_'.$i;
						$id_box_type	= 'box_type_'.$i;
						$pack 			= 'pack_'.$i;
						$quantity 		= 'quantity_'.$i;
						$fulls			= 'fulls_'.$i;
						//Validate line information
						isset($data->$item_code) ? $data->$item_code = $data->$item_code : $data->$item_code = '';
						isset($data->$product_name) ? $data->$product_name = $data->$product_name : $data->$product_name = '';
						isset($data->$id_box_type) ? $data->$id_box_type = $data->$id_box_type : $data->$id_box_type = '';
						isset($data->$pack) ? $data->$pack = $data->$pack : $data->$pack = '';
						isset($data->$quantity) ? $data->$quantity = $data->$quantity : $data->$quantity = '';
						isset($data->$fulls) ? $data->$fulls = $data->$fulls : $data->$fulls = '';
						//Insert Line PO
						$queryLines  = "INSERT INTO re_product (po_number, item_code, product_name, id_box, pack, quantity, fulls, status) ";
						$queryLines .= "VALUES ('".$data->po_number."', '".$data->$item_code."', '".$data->$product_name."', '".$data->$id_box_type."', '".$data->$pack."', '".$data->$quantity."', '".$data->$fulls."', '19'); ";
						$resultLines = $conn->query($queryLines);
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
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;

	}
	//
	public function poGet($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPoId = array();
			$query  = "SELECT a.po_number, a.depart_miami_date, a.delivery_date, a.id_dc_name, CONCAT(c.city,', ',b.abbreviation) AS dc_name, a.id_client, d.client_name, a.id_supplier, f.supplier_name, a.pallet_total, a.case_total, a.cube_total, a.min_boxes, a.start_boxes, a.sell_by_date, a.comments, a.status AS id_status, g.status AS status_name ";
			$query .= "FROM re_purchasing_order AS a ";
			$query .= "JOIN pa_city AS c ON a.id_dc_name = c.id ";
			$query .= "JOIN pa_state AS b ON c.id_state = b.id ";
			$query .= "JOIN re_client AS d ON a.id_client = d.id ";
			$query .= "JOIN re_supplier AS f ON a.id_supplier = f.id ";
			$query .= "JOIN pa_status AS g ON a.status = g.id_status ";
			$query .= "WHERE a.id = '".$data->id."';";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrPoId, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrPoId);
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
	public function productsTable($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrProducts = array();
			
			$query  = "SELECT item_code,item_description,box_type_dry, c.status AS pack_system,box_qty, d.background, d.status ";
			$query .= "FROM re_product AS a ";
			//$query .= "JOIN re_box AS b ON a.id_box = b.id_box_type ";
			$query .= "JOIN pa_status AS c ON a.pack_system = c.id_status ";
			$query .= "JOIN pa_status AS d ON a.status = d.id_status ";
			$query .= "WHERE a.po_number = '".$data->po_number."';";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrProducts, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrProducts);
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
	public function productsLines($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrProducts = array();
			$query  = "SELECT b.id, b.po_number, b.item_code, b.product_name, b.id_box, c.box_name AS box, b.pack, d.status AS pack_name, b.quantity, b.fulls, e.background, e.status ";
			$query .= "FROM re_purchasing_order AS a ";
			$query .= "JOIN re_product AS b ON a.po_number = b.po_number ";
			$query .= "JOIN re_box AS c ON b.id_box = c.id_box_type ";
			$query .= "JOIN pa_status AS d ON b.pack = d.id_status ";
			$query .= "JOIN pa_status AS e ON b.status = e.id_status ";
			$query .= "WHERE a.id = '".$data->idPo."';";
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					array_push($arrProducts, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrProducts);
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
	public function insertFilePo($file){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			/**********************************************/
			//Aquí es donde seleccionamos nuestro csv
			$fname = $file->name;
			$ext = explode(".",$fname);
			if(strtolower(end($ext)) == "csv" || strtolower(end($ext)) == "txt"){
				//si es correcto, entonces damos permisos de lectura para subir
				$file_tmp_name = $file->tmp_name;
				$handle = fopen($file_tmp_name, "r");
				while($data = fgetcsv($handle, 1000, ";")){
					//Insertamos los datos con los valores...
					$query  = "INSERT INTO re_purchasing_order (po_number, depart_miami_date, delivery_date, id_dc_name, id_client, id_supplier, pallet_total, case_total, cube_total, min_boxes, start_boxes, sell_by_date, comments, status)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."', ";
					$query .="'".$data[5]."', ";
					$query .="'".$data[6]."', ";
					$query .="'".$data[7]."', ";
					$query .="'".$data[8]."', ";
					$query .="'".$data[9]."', ";
					$query .="'".$data[10]."', ";
					$query .="'".$data[11]."', ";
					$query .="'".$data[12]."', ";
					$query .="'19'); ";
					$result = $conn->query($query);
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
	//
	public function insertFilePo_Full($file){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			/**********************************************/
			//Aquí es donde seleccionamos nuestro csv
			$fname = $file->name;
			$ext = explode(".",$fname);
			if(strtolower(end($ext)) == "csv" || strtolower(end($ext)) == "txt"){
				//si es correcto, entonces damos permisos de lectura para subir
				$file_tmp_name = $file->tmp_name;
				$handle = fopen($file_tmp_name, "r");
				$flag_line=0;
				$list_po_in = array();
				while($data = fgetcsv($handle, 1000, ";")){
					if (!in_array($data[5], $list_po_in)) {
						array_push($list_po_in,$data[5]);
						$query  = "INSERT INTO re_purchasing_order (customer_name,	customer_zip_code,	customer_state,	customer_city,customer_addrees,	po_number,	consignee_name,	consignee_dc_number,	consignee_zip_code,	consignee_state,	consignee_city,	consignee_addrees,	truck_line,	truck_date,	delivered_date,status)  VALUES ( ";
						$query .="GetID_Customer('".$data[0]."'), ";
						$query .="'".$data[1]."', ";
						$query .="GetID_State('".$data[2]."'), ";
						$query .="GetID_City('".$data[3]."'), ";
						$query .="'".$data[4]."', ";
						$query .="'".$data[5]."', ";
						$query .="GetID_Consignee('".$data[6]."'), ";
						$query .="'".$data[7]."', ";
						$query .="'".$data[8]."', ";
						$query .="GetID_State('".$data[9]."'), ";
						$query .="GetID_City('".$data[10]."'), ";
						$query .="'".$data[11]."', ";
						$query .="GetID_Truck('".$data[12]."'), ";
						$query .="'".$data[13]."', ";
						$query .="'".$data[14]."',1); ";
						$result = $conn->query($query);
					}
					
					$query  = "INSERT INTO re_product (po_number,item_code,	item_description,	grade,	box_type_dry,	length,	width,	height,	tie, high,	pallet_qty,	box_qty,	bar_code_case_number,	upc_code,	pack_dry,	cube_per_case, pack_system,	wet_per_dry,	pack_per_wet,	box_type_wet,	box_code_number_1, box_code_number_2,	box_code_number_3,status,in_receiving)  VALUES ( ";
					$query .="'".$data[5]."', ";
					$query .="'".$data[15]."', ";
					$query .="'".$data[16]."', ";
					$query .="'".$data[17]."', ";
					$query .="'".$data[18]."', ";
					$query .="'".$data[19]."', ";
					$query .="'".$data[20]."', ";
					$query .="'".$data[21]."', ";
					$query .="'".$data[22]."', ";
					$query .="'".$data[23]."', ";
					$query .="'".$data[24]."', ";
					$query .="'".$data[25]."', ";
					$query .="'".$data[26]."', ";
					$query .="'".$data[27]."', ";
					$query .="'".$data[28]."', ";
					$query .="'".$data[29]."', ";
					$query .="GetID_Status('".$data[30]."'), ";
					$query .="'".$data[31]."', ";
					$query .="'".$data[32]."', ";
					$query .="'".$data[33]."', ";
					$query .="'".$data[34]."', ";
					$query .="'".$data[35]."', ";
					$query .="'".$data[36]."',1,0); ";
					$result = $conn->query($query);
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
	//
	public function insertFileProduct($file){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$fname = $file->name;
			$ext = explode(".",$fname);
			if(strtolower(end($ext)) == "csv" || strtolower(end($ext)) == "txt"){
				$file_tmp_name = $file->tmp_name;
				$handle = fopen($file_tmp_name, "r");
				while($data = fgetcsv($handle, 1000, ";")){
					$query  = "INSERT INTO re_product (po_number, item_code, product_name, id_box, pack, quantity, fulls, status)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."', ";
					$query .="'".$data[5]."', ";
					$query .="'".$data[6]."', ";
					$query .="'19');";
					$result = $conn->query($query);
				}
				fclose($handle);
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = "the file has been successfully loaded";
			} else {
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'The file extension must be csv or tx';
			}
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//
	public function datePo(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$date = $this->bsn->date;
		$date1 = strtotime ('+1 day',strtotime($date));
		$oneDate = date('Y-m-d',$date1);
		$date2 = strtotime('+2 day',strtotime($date));
		$twoDate = date ('Y-m-d',$date2);
		$date3 = strtotime('+3 day',strtotime($date));
		$treeDate = date ('Y-m-d',$date3);
		//Validate the connection of db
		if($conn){
			$arrDatePo = array();
			$query  = "SELECT COUNT(*) AS total, depart_miami_date, status FROM re_purchasing_order ";
			$query .= "WHERE depart_miami_date BETWEEN '".$oneDate."' AND '".$treeDate."' ";
			$query .= "GROUP BY status, depart_miami_date; ";
			var_dump($query);
			$result = $conn->query($query);
			if($result){
				while($row = $result->fetch(PDO::FETCH_OBJ)){
					$row->one_date = $oneDate;
					$row->two_date = $twoDate;
					$row->tree_date = $treeDate;
					array_push($arrDatePo, $row);
				}
				$this->bsn->return->bool = true;
				$this->bsn->return->msg = json_encode($arrDatePo);
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
	public function grafico1(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrDCname = array();
			$query  = "select count(A.po_number) cnt,A.po_number from re_product A ";
			$query .= "inner join re_purchasing_order B on A.po_number = B.po_number ";
			$query .= "group by A.po_number ";
			$query .= "order by count(A.po_number) desc ";
			$query .= "limit 5 ";
			  
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrDCname, $row);
					}
					$bool = true;
					$response = json_encode($arrDCname);
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