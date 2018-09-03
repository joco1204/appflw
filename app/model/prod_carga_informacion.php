<?php
class CargaInformacionOrder{	
	function __construct(){
		$this->bsn = new Business();
	}
	// Insert File ID ORDER
	public function insertFileIDOrder($file){
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
					$query  = "INSERT INTO re_pid_order (ORDER_ID,CUSTOMER,MIAMI_SHIP,TOTAL_BOX,TOTAL_BOX_REST,PACK,WEEKSHIP,UPC_CODE,NOMBRE_RAMO,PACK_RECETA,N_RECETA,REGLA,PRODUCTO,COLOR,GRADE,CANTIDAD_DE_TALLOS_POR_RAMO,CONSUMO,NOMBRE_CAPUCHON,COLOR_CAPUCHON,MEDIDA_CAPUCHON,NOMBRE_RUANA,COLOR_RUANA,MEDIDA_RUANA,CONSERVANTE,CANTIDAD_GR_CONSERVANTE,NOMBRE_PICK)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."', ";
					$query .="'".$data[4]."', ";
					$query .="'".$data[5]."', ";
					$query .="'".$data[6]."', ";
					$query .="'".$data[7]."', ";
					$query .="'".$data[8]."', ";
					$query .="'".$data[9]."', ";
					$query .="'".$data[10]."', ";
					$query .="'".$data[11]."', ";
					$query .="'".$data[12]."', ";
					$query .="'".$data[13]."', ";
					$query .="'".$data[14]."', ";
					$query .="'".$data[15]."', ";
					$query .="'".$data[16]."', ";
					$query .="'".$data[17]."', ";
					$query .="'".$data[18]."', ";
					$query .="'".$data[19]."', ";
					$query .="'".$data[20]."', ";
					$query .="'".$data[21]."', ";
					$query .="'".$data[22]."', ";
					$query .="'".$data[23]."', ";
					$query .="'".$data[24]."'); ";
					
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
	// Insert File INventario flor
	public function insertFileInventarioFlor($file){
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
					$query  = "INSERT INTO re_pinventario_flor (PRODUCTO,COLOR,GRADE,CANTIDAD)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."'); ";
					
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
	
	
	
	// Insert File INventario HG
	public function insertFileInventarioHg($file){
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
					$query  = "INSERT INTO re_pinventario_hg (PRODUCTO,COLOR,TAMANO,CANTIDAD,POSTCOSECHA)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."'); ";
					
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
	
	// Insert File orden compra flor
	public function insertFileOrdenCompraFlor($file){
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
					$query  = "INSERT INTO re_porden_compra_flor (N_ORDEN,PRODUCTO,COLOR,GRADE,CANTIDAD,DATE_ARRIVE)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."', ";
					$query .="'".$data[5]."'); ";
					
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
	
	
	// Insert File orden compra hg
	public function insertFileOrdenCompraHg($file){
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
					$query  = "INSERT INTO re_porden_compra_hg (PRODUCTO,COLOR,TAMANO,CANTIDAD,DATE_ARRIVE)  VALUES ( ";
					$query .="'".$data[0]."', ";
					$query .="'".$data[1]."', ";
					$query .="'".$data[2]."', ";
					$query .="'".$data[3]."', ";
					$query .="'".$data[4]."'); ";
					
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
	
	
	public function TableIdOrder(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT *";
			$query .= "FROM re_pid_order ;";
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
	
	public function TableInventarioFlor(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT *";
			$query .= "FROM re_pinventario_flor ;";
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
	public function TableInventarioHg(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT *";
			$query .= "FROM re_pinventario_hg ;";
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
	
	public function TableOrdenCompraFlor(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT *";
			$query .= "FROM re_porden_compra_flor ;";
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
	
	public function TableOrdenCompraHg(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT *";
			$query .= "FROM re_porden_compra_hg ;";
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
}
?>