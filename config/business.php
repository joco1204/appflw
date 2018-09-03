<?php
//Include models
include 'connect.php';
include 'session.php';
include '../../app/model/login.php';
include '../../app/model/logout.php';
include '../../app/model/accounts.php';
include '../../app/model/awb.php';
include '../../app/model/receiving.php';
include '../../app/model/shipment.php';
include '../../app/model/workorder.php';
include '../../app/model/country.php';
include '../../app/model/state.php';
include '../../app/model/city.php';
include '../../app/model/boxes.php';
include '../../app/model/purchasingorder.php';
include '../../app/model/inventory.php';
include '../../app/model/prod_carga_informacion.php';
include '../../app/model/pallet.php';
//Business class
class Business{
	public $return;
	public $conn;
	public $db;
	public $session;
	public $post;
	public $get;
 	//Business class builder
	function __construct(){
		//Definition response scheme
		$this->return = new stdClass();
		$this->return->bool = false;
		$this->return->msg = 'Answer has not been assigned';
		$this->conn = new Connect();
		$this->session = new Session();
		$this->post = ((object) $_POST);
		$this->get = ((object) $_GET);
		$this->files = ((object) $_FILES);
		$this->db = 'appdb';
		$this->date = date('Y-m-d');
 	}
} 
?>