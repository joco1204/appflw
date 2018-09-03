<?php 
//Construction class for sessions
class Session
{
	protected $session;
	//Method of construction of the session
	public function start(){
		$start = session_start();
		return $start; 
	}
	//Method that the session receives
	public function setSession($name, $val) {
		$_SESSION[$name] = $val;
	}
	//Method that the session sends
	public function getSession($name){
		if(isset($_SESSION[$name])){
			$this->session = $_SESSION[$name];
		} else {
			$this->session = false;
		}
		return $this->session;
	}
	//Method that eliminates session variables
	public function ussetSession($name){
		unset($_SESSION[$name]);
	}
	//Method that eliminates the session
	public function destroy(){
		$_SESSION = array();
		$destroy = session_destroy();
		clearstatcache();
		return $destroy;
	}
	//Token that generates value of the cookie
	public function token(){
		$tocken = strtoupper(md5(uniqid(rand(), true)));
		return $tocken;
	}
}

?>