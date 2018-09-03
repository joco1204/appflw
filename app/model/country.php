<?php
class Country{
	function __construct(){
		$this->bsn = new Business();
	}
	//list select country method
	public function selectCountrys(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrCountry = array();
			$query  = "SELECT a.id_country, a.country FROM pa_country AS a;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrCountry, $row);
					}
					$bool = true;
					$response = json_encode($arrCountry);
				} else {
					$bool = false;
					$response = 'Wrong get Country';
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