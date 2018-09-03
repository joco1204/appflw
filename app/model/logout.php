<?php
class Logout{
	function __construct(){
		$this->bsn = new Business();
	}
	//logout method
	public function logout(){
		$session = $this->bsn->session;
		$session->start();
		if($session->destroy()){
			$this->bsn->return->bool = true;
			$this->bsn->return->msg = json_encode('Logout');
		} else {
			$this->bsn->return->bool = false;
			$this->bsn->return->msg = json_encode('No Logout');
		}
		return $this->bsn->return;
	}
}
?>