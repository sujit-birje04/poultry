<?php
//session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class SessionManage{
	public function user_session($mainObj){
		$_SESSION["customer_data"] = $mainObj;
		$_SESSION['billing_add'] = $mainObj;
	}

	public function distroy_user_session(){
		unset($_SESSION["customer_data"]);	
		unset($_SESSION['shipping_add']);	
		unset($_SESSION['billing_add']);		
	}

	public function set_current_article($article_id){
		$_SESSION['article_id'] = $article_id;
	}

	public function distroy_current_article(){
		unset($_SESSION['article_id']);
	}

	public function getSessionId(){
		return session_id();
	}

	public function setShipping($mainObj){
		$_SESSION['shipping_add'] = $mainObj;
	}

	public function setBilling($mainObj){
		$_SESSION['billing_add'] = $mainObj;
	}

	public function setObject($mainObj, $session_name){
		$_SESSION[$session_name] = $mainObj;

	}

	public function getObject($lable){
		$obj = isset($_SESSION[$lable]) ? $_SESSION[$lable] : array();
		return $obj;
	}

	public function destroyObject($lable){
		unset($_SESSION[$lable]);	
	}

}
?>