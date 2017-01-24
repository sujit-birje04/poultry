<?php
ob_start();
//ini_set('display_errors', '0');     # don't show any errors...
//error_reporting(0);
//error_reporting(E_ALL | ~E_STRICT);  # ...but do log them
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST'); 
if(isset($_REQUEST['method'])){
	$arr_method = explode('-',$_REQUEST['method']); 
	$methodName = $arr_method['0']; 
	$className = strtoupper($arr_method['1']);
	if(!file_exists("../model/".$className.".php")){
		$arr_response = array(
					'status'=>false,
					'msg'=>'File not exists, Please report this error'
				);
		echo json_encode($arr_response);
		exit;
	}
	
	include("../model/".$className.".php");
	
	$instance = new $className(); 
	$arr_response = $instance->$methodName($_REQUEST);
	echo $arr_response;
} else {
	$arr_response = array(
		'status'=>false,
		'msg'=>'method name not specified'
	);
	echo json_encode($arr_response);
}
?>
