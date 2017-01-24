<?php

/*
** Class will be used to handle All session
** Author : Sujit
** Created on : 30-oct-2014
*/

session_start();
class SESSIONDATA{
	public function user_session($mainObj){
		$_SESSION['user_data'] = $mainObj;
	}

	public function get_user_session(){
		return $_SESSION['user_data'];
	}

	public function distroy_user_session(){
		unset($_SESSION['user_data']);
	}

	public function set_uploaded_image($file_name){
		$_SESSION['uploaded_file'] = $file_name;
	}
	
	public function get_uploaded_image(){
		$uploaded_file = isset($_SESSION['uploaded_file']) ? $_SESSION['uploaded_file'] : '';
		return $uploaded_file;
	}
}
?>