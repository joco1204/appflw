<?php
class Balance{	
	function __construct(){
		$this->bsn = new Business();
	}
	// Insert File ID ORDER
	public function ListBalance(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT id,nombre,fecha_inicial,fecha_final,estado,fecha_final-fecha_inicial as dias_tot, ship_min, ship_max ";
			$query .= "FROM re_poscosecha ;";
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
	public function balance_order_posc($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			if ($data->id_ord != 0){
				$query  = "SELECT ORDER_ID,CUSTOMER,TOTAL_BOX,TOTAL_BOX_REST,pid_order ";
				$query .= "FROM re_pid_order where pid_order=".$data->id_ord." ";
			}else{
				$query  = "SELECT C.ORDER_ID,C.CUSTOMER,C.TOTAL_BOX,C.TOTAL_BOX_REST,C.pid_order ";
				$query .= "FROM re_poscosecha A ";
				$query .= "inner join re_poscosecha_order B on A.id = B.poscosecha ";
				$query .= "inner join re_pid_order C on B.`order` = pid_order ";
				$query .= "and A.id = ".$data->id_pos." ";
			}
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
	public function list_order_posc($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT A.order,A.poscosecha,B.ORDER_ID,B.CUSTOMER ";
			$query  .= "FROM re_poscosecha_order A ";
			$query  .= "inner join re_pid_order B on A.order = B.pid_order ";
			$query  .= "where poscosecha=".$data->id_posc;

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
	public function Create_Posc($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){
			if ($data->pos_nombre != '' && $data->pos_estado != '' && $data->pos_finicial != '' && $data->pos_ffinal != '' && $data->pos_shipmin != '' && $data->pos_shipmax != ''){  
				$query  = "INSERT INTO  re_poscosecha(nombre,estado,fecha_inicial,fecha_final,ship_min,ship_max) VALUES (";
				$query.= "'".$data->pos_nombre."',";
				$query.= "'".$data->pos_estado."',";
				$query.= "'".$data->pos_finicial."',";
				$query.= "'".$data->pos_ffinal."',";
				$query.= "'".$data->pos_shipmin."',";
				$query.= "'".$data->pos_shipmax."')";
				
				$result = $conn->query($query);
				if($result){
					
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'was created correctly';
			
				} else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'Erroneous query';
				}
			}else{
				$this->bsn->return->bool = false;
				$this->bsn->return->msg = 'Campos Vacios';
			}		
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	public function ListAdd_order_ToBalance(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrPo = array();
			$query  = "SELECT t1.pid_order,t1.ORDER_ID,CUSTOMER,MIAMI_SHIP,TOTAL_BOX,PACK,N_RECETA,PRODUCTO,COLOR ";
			$query  .= "FROM re_pid_order t1 ";
			$query  .= "LEFT JOIN re_poscosecha_order t2 ";
			$query  .= "ON t2.order = t1.pid_order ";
			$query  .= "WHERE t2.order IS NULL ;";
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
	public function Asoc_Order_Posc($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		$session = $this->bsn->session;
		//Validate the connection of db
		if($conn){
				$query  = "INSERT INTO  re_poscosecha_order(poscosecha,`order`,estado) VALUES (";
				$query.= "'".$data->poscosecha."',";
				$query.= "'".$data->idorder."',";
				$query.= "1)";
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
	
}
?>