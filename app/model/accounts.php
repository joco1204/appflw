<?php
class Accounts{
	function __construct(){
		$this->bsn = new Business();
	}
	//Accounts table method
	public function accountsTable(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrayAccounts = array();
			$query  = "SELECT id, name_company, phone_number FROM re_accounts;";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrayAccounts, $row);
					}
					$bool = true;
					$response = json_encode($arrayAccounts);
				} else {
					$bool = false;
					$response = 'Wrong Get Accounts';
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
	//Create method
	public function insertAccounts($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			if ($data->name_company!="" && $data->web_site!="" && $data->phone_number!="" && $data->fax_number!="" && $data->toll_free!="" && $data->cut_off!="" && $data->address_billing_address!="" && $data->country_billing_address!="" && $data->state_billing_address!="" && $data->city_billing_address!="" && $data->zip_code_billing_address!="" && $data->address_shipping_address!="" && $data->country_shipping_address!="" && $data->state_shipping_address!="" && $data->city_shipping_address!="" && $data->zip_code_shipping_address!="" && $data->notes!="" ){
				isset($data->client) ? $data->client = $data->client : $data->client = '';
				isset($data->customer) ? $data->customer = $data->customer : $data->customer = '';
				isset($data->grower) ? $data->grower = $data->grower : $data->grower = '';
				isset($data->truck) ? $data->truck = $data->truck : $data->truck = '';
				isset($data->consignee) ? $data->consignee = $data->consignee : $data->consignee = '';
				
				$query  = "INSERT INTO re_accounts (name_company,web_site,phone_number,fax_number,client,customer,grower,truck,consignee,toll_free,cut_off,address_billing_address, id_country, state_billing_address, city_billing_address, zip_code_billing_address, address_shipping_address, id_country_shipment, state_shipping_address, city_shipping_address, zip_code_shipping_address, notes) VALUES ('".$data->name_company."','".$data->web_site."','".$data->phone_number."','".$data->fax_number."','".$data->client."','".$data->customer."','".$data->grower."','".$data->truck."','".$data->consignee."','".$data->toll_free."','".$data->cut_off."','".$data->address_billing_address."','".$data->country_billing_address."','".$data->state_billing_address."','".$data->city_billing_address."','".$data->zip_code_billing_address."','".$data->address_shipping_address."','".$data->country_shipping_address."','".$data->state_shipping_address."','".$data->city_shipping_address."','".$data->zip_code_shipping_address."','".$data->notes."')";
				
				$result = $conn->query($query);
				if($result){
					$id = $conn->lastInsertId();
					$this->bsn->return->bool = true;
					$this->bsn->return->msg = 'the account was successfully inserted';
					for ($n=1; $n<=$data->n_contact; $n++){
						$firstname = 'fname'.$n;
						$firstname1 = $data->$firstname;
						$lastname = 'lname'.$n;
						$lastname1 = $data->$lastname;
						$contact = 'ctype'.$n;
						$contact1 = $data->$contact;
						$dept = 'department'.$n;
						$dept1 = $data->$dept;
						$jobti = 'job'.$n;
						$jobti1 = $data->$jobti;
						$phone = 'hphone'.$n;
						$phone1 = $data->$phone;
						$mobil = 'mobile'.$n;
						$mobil1 = $data->$mobil;
						$em = 'email'.$n;
						$em1 = $data->$em;
						$cont = 'pcontact'.$n;
                        $cont1 = $data->$cont;						
						$query2 = "INSERT INTO re_contact (id_accounts,first_name,last_name,contact_type,departament,job_title,home_phone,mobile,email,primary_contact) VALUES ('".$id."','".$firstname1."','".$lastname1."','".$contact1."','".$dept1."','".$jobti1."','".$phone1."','".$mobil1."','".$em1."','".$cont1."')";
					$result2 = $conn->query($query2);
				if($result2){
					
					}else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'Erroneous query';
				}
					}				
				} else {
					$this->bsn->return->bool = false;
					$this->bsn->return->msg = 'Erroneous query';
				}
			}else{
				$this->bsn->return->bool = false;
			    $this->bsn->return->msg = 'Empty data';
			}
			
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = 'Database connection error';
		}
		return $this->bsn->return;
	}
	//Data customer
	public function customer(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrCustomer = array();
			$query  = "SELECT id, name_company ";
			$query .= "FROM re_accounts WHERE customer = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrCustomer, $row);
					}
					$bool = true;
					$response = json_encode($arrCustomer);
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
	//Data truck
	public function truck(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrGrower = array();
			$query  = "SELECT id, name_company ";
			$query .= "FROM re_accounts WHERE truck = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrGrower, json_encode($row));
					}
					$bool = true;
					$response = json_encode($arrGrower);
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
	//Data grower
	public function grower(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrGrower = array();
			$query  = "SELECT id, name_company ";
			$query .= "FROM re_accounts WHERE grower = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrGrower, $row);
					}
					$bool = true;
					$response = json_encode($arrGrower);
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
	//Data consignee
	public function consignee(){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
			$arrConsignee = array();
			$query  = "SELECT id, name_company ";
			$query .= "FROM re_accounts WHERE consignee = '1';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrConsignee, $row);
					}
					$bool = true;
					$response = json_encode($arrConsignee);
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
	public function selectState($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
		$arrState = array();
			$query  = "SELECT id, state ";
			$query .= "FROM pa_state WHERE id_country = '".$data->countryactual."';";
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrState, $row);
					}
					$bool = true;
					$response = json_encode($arrState);
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
	public function selectCity($data){
		$conn = $this->bsn->conn;
		$db = $this->bsn->db;
		//Validate the connection of db
		if($conn){
		$arrCity = array();
			$query  = "SELECT id, city ";
			if ($data->search=="country"){
				$query .= "FROM pa_city WHERE id_country = '".$data->actual."';";
			}else{
				$query .= "FROM pa_city WHERE id_state = '".$data->actual."';";
			}
			$result = $conn->query($query);
			if($result){
				if($result->rowCount() > 0){
					while($row = $result->fetch(PDO::FETCH_OBJ)){
						array_push($arrCity, $row);
					}
					$bool = true;
					$response = json_encode($arrCity);
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