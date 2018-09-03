<?php
//Construction class for cookies
class Cookie
{
	private $params;
	protected $cookie;
	//Method that receives the cookie
	public function setCookie($name, $value) {
		$this->params = session_get_cookie_params();
		return setcookie($name, $value, time() + 3600, $this->params["path"], $this->params["domain"], $this->params["secure"], $this->params["httponly"]);
	}
	//Method that the cookie sends
	public function getCookie($name){
		if(isset($_COOKIE[$name])){
			$this->cookie = $_COOKIE[$name];
		} else {
			$this->cookie = false;
		}
		return $this->cookie;
	}
	//Destroying method of the cookie
	public function destroy(){
		$this->params = session_get_cookie_params();
		return setcookie(session_name(), '', time() - 3600, $this->params["path"], $this->params["domain"], $this->params["secure"], $this->params["httponly"]);
	}

}
?>