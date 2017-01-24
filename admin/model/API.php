<?php

include '../include/constants.php';
include("../data/TBL_USERS.php");
include("../data/TBL_CUSTOMER.php");
include("../data/CONTACT_US.php");
include("../data/ENQUIRIES.php");
include("../data/BLOGS.php");



include("../data/SESSIONDATA.php");
include("../data/ServiceManager.php");
include("../include/utility.php");

class API {
	
	public function login($input){
		$objInstance = new TBL_USERS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'login.php'
					);
		$username = Utility::get_input($input['txt_username']);
		$password = Utility::get_input($input['txt_password']);
		/** Validation **/		
		$valid_obj[] = array(
				'id'=>'txt_username',
				'value'=>$input['txt_username'],
				'name'=>'Username',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'txt_password',
				'value'=>$input['txt_password'],
				'name'=>'Password',
				'check' => array('NOT_BLANK')
			);
		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/

		$returnObj = $objInstance->login($username,$password);
		if($returnObj["status"]){
			$mainObj = $returnObj;
			$objSession = new SESSIONDATA();
			$arr = $objSession->user_session($mainObj["data"]);
			$mainObj["next_url"] = "manage_user.php";

		} 
		$mainObj['msg'] = $returnObj['msg'];

		return json_encode($mainObj);

	}

	public function logout($input){
			$objSession = new SESSIONDATA();
			$arr = $objSession->distroy_user_session();
		  	header( 'Location: ../view/login.php' );
		  	exit();
	}


	/*
	* Used to insert the user in the database
	*/
	public function insertuser($input){
		$objInstance = new TBL_USERS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'add_new_user.php'
					);

		$is_close = isset($input["is_close"]) ? $input["is_close"] : 0;
		
		
		$user_id="";
		$user_type = $input['user_type'];
		$email_id = $input['email_id'];
		$is_active = $input['is_active'];
		$username = $input['user_name'];
		$password = $input['password'];
		$full_name = $input['full_name'];
		$arr_name = explode(' ', $full_name);
		$fname = "";
		$lname = "";
		$fname = isset($arr_name[0]) ? $arr_name[0] : '' ;
		for($i=1;$i<count($arr_name); $i++){
			$lname = $lname ." ".$arr_name[$i];
		}
		$mobile = "";
		$sex = "";
		$profile_pic = "";

		/** Validation **/		
		$valid_obj[] = array(
				'id'=>'full_name',
				'value'=>$full_name,
				'name'=>'Name',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'email_id',
				'value'=>$email_id,
				'name'=>'Email ID',
				'check' => array('NOT_BLANK', 'EMAIL')
			);
		$valid_obj[] = array(
				'id'=>'user_name',
				'value'=>$username,
				'name'=>'Username',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'password',
				'value'=>$password,
				'name'=>'Password',
				'check' => array('NOT_BLANK')
			);
		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/
		 
		 $user_present = $objInstance->isUserPresent($username);
		 if($user_present){
			$mainObj['msg'] = 'User with same Username id already present';
			return json_encode($mainObj);
		 }	



		$mainObj = $objInstance->insert($user_id,$user_type,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password);
		
		if (!$is_close) {
			$mainObj["next_url"] = "add_new_user.php";
		} else {
			$mainObj["next_url"] = "manage_user.php";
		}

		return json_encode($mainObj);
	}

	public function edituser($input){
		$objInstance = new TBL_USERS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'edit_user.php'
					);

		$is_close = isset($input["is_close"]) ? $input["is_close"] : 0;
		
		
		$user_id=$input['user_id'];
		$user_type = $input['user_type'];
		$email_id = $input['email_id'];
		$is_active = $input['is_active'];
		$username = $input['user_name'];
		$password = $input['password'];
		$full_name = $input['full_name'];
		$arr_name = explode(' ', $full_name);
		$fname = "";
		$lname = "";
		$fname = isset($arr_name[0]) ? $arr_name[0] : '' ;
		for($i=1;$i<count($arr_name); $i++){
			$lname = $lname ."".$arr_name[$i];
		}
		$mobile = "";
		$sex = "";
		$profile_pic = "";

		/** Validation **/		
		$valid_obj[] = array(
				'id'=>'user_id',
				'value'=>$user_id,
				'name'=>'User Id',
				'check' => array('NOT_BLANK')
			);		
		$valid_obj[] = array(
				'id'=>'full_name',
				'value'=>$full_name,
				'name'=>'Name',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'email_id',
				'value'=>$email_id,
				'name'=>'Email ID',
				'check' => array('NOT_BLANK', 'EMAIL')
			);
		$valid_obj[] = array(
				'id'=>'user_name',
				'value'=>$username,
				'name'=>'Username',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'password',
				'value'=>$password,
				'name'=>'Password',
				'check' => array('NOT_BLANK')
			);
		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/
				 
		$mainObj = $objInstance->edit($user_id,$user_type,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password);
		if (!$is_close) {
			$mainObj["next_url"] = "edit_user.php";
		} else {
			$mainObj["next_url"] = "manage_user.php";
		}
		return json_encode($mainObj);
	}


	public function deleteuser($input){
		$objInstance = new TBL_USERS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_user.php'
					);

		$id = isset($input["id"]) ? $input["id"] : 0;
		if (!$id) {
			return json_encode($mainObj);
		} 
		$mainObj = $objInstance->delete($id);
		$mainObj["next_url"] = "manage_user.php";
		return json_encode($mainObj);
	}

	/******************************************************************************
	* 						Used to insert the blog
	*******************************************************************************/
	public function insertblog($input){
		$objInstance = new BLOGS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_blog.php'
					);

		$is_close = isset($input["is_close"]) ? $input["is_close"] : 0;
		

		$blog_id='';
		$title=$input['title'];
		$is_active = $input['is_active'];
		$html_short = $input['html_short'];
		$html_full = $input['html_full'];
		$image = $input['image'];
		$video = $input['video'];
		$sort_code = $input['sort_code'];
		$type = $input['type'];
		$start_date = date('Y-m-d h:i:s');//date('Y-m-d h:i:s', strtotime($input['start_date']));
		$end_date = date('Y-m-d h:i:s');//date('Y-m-d h:i:s', strtotime($input['end_date']));


		/** Validation **/	

		$valid_obj[] = array(
				'id'=>'title',
				'value'=>$title,
				'name'=>'Title',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'html_full',
				'value'=>$html_full,
				'name'=>'Long Description',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'html_short',
				'value'=>$html_short,
				'name'=>'Short Description',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'start_date',
				'value'=>$start_date,
				'name'=>'Start Date',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'end_date',
				'value'=>$end_date,
				'name'=>'End Date',
				'check' => array('NOT_BLANK')
			);

		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/

		$mainObj = $objInstance->insert($blog_id,$title,$is_active,$html_short,$html_full,$image,$video,$sort_code,$start_date,$end_date,$type);
		
		if (!$is_close) {
			$mainObj["next_url"] = "add_blog.php";
		} else {
			$mainObj["next_url"] = "manage_blog.php";
		}
		return json_encode($mainObj);
	}

	/*
	* Used to delete the category
	*/	
	public function deleteblog($input){
		$objInstance = new BLOGS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_blog.php'
					);

		$id = isset($input["id"]) ? $input["id"] : 0;
		if (!$id) {
			return json_encode($mainObj);
		} 

		$mainObj = $objInstance->delete($id);
		$mainObj["next_url"] = "manage_blog.php";
		return json_encode($mainObj);
	}


	/*
	* Used to insert the product category
	*/
	public function editblog($input){
		$objInstance = new BLOGS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_blog.php'
					);
		$is_close = isset($input["is_close"]) ? $input["is_close"] : 0;
		

		$blog_id=$input['blog_id'];
		$title=$input['title'];
		$is_active = $input['is_active'];
		$html_short = $input['html_short'];
		$html_full = $input['html_full'];
		$image = $input['image'];
		$video = $input['video'];
		$sort_code = $input['sort_code'];
		$type = $input['type'];
		
		$start_date = date('Y-m-d h:i:s', strtotime($input['start_date']));
		$end_date = date('Y-m-d h:i:s', strtotime($input['end_date']));


		/** Validation **/		
		$valid_obj[] = array(
				'id'=>'blog_id',
				'value'=>$blog_id,
				'name'=>'blog',
				'check' => array('NOT_BLANK')
			);		

		$valid_obj[] = array(
				'id'=>'title',
				'value'=>$title,
				'name'=>'Title',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'html_full',
				'value'=>$html_full,
				'name'=>'Long Description',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'html_short',
				'value'=>$html_short,
				'name'=>'Short Description',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'start_date',
				'value'=>$start_date,
				'name'=>'Start Date',
				'check' => array('NOT_BLANK')
			);

		$valid_obj[] = array(
				'id'=>'end_date',
				'value'=>$end_date,
				'name'=>'End Date',
				'check' => array('NOT_BLANK')
			);

		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/
		
		$mainObj = $objInstance->edit($blog_id,$title,$is_active,$html_short,$html_full,$image,$video,$sort_code,$start_date,$end_date,$type);
		if (!$is_close) {
			$mainObj["next_url"] = "edit_blog.php?id=".$blog_id;
		} else {
			$mainObj["next_url"] = "manage_blog.php";
		}
		return json_encode($mainObj);
	}

	public function deleteblogimage($input){
		$objInstance = new BLOGS();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'add_article.php'
					);

		$id=$input["id"];
		$mainObj = $objInstance->editImage($id,'');
		$mainObj["next_url"] = "edit_blog.php?id=".$id;
		return json_encode($mainObj);
	}

	/******************************************************************************
	* 						Used to insert the blog
	*******************************************************************************/

	public function deletecontactmessage($input){
		$objInstance = new CONTACT_US();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_blog.php'
					);

		$id = isset($input["id"]) ? $input["id"] : 0;
		if (!$id) {
			return json_encode($mainObj);
		} 

		$mainObj = $objInstance->delete($id);
		$mainObj["next_url"] = "manage_contactus.php";
		return json_encode($mainObj);
	}


	public function deleteenquiry($input){
		$objInstance = new ENQUIRIES();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_blog.php'
					);

		$id = isset($input["id"]) ? $input["id"] : 0;
		if (!$id) {
			return json_encode($mainObj);
		} 

		$mainObj = $objInstance->delete($id);
		$mainObj["next_url"] = "manage_enquiry.php";
		return json_encode($mainObj);
	}

	public function editcustomer($input){
		$objInstance = new TBL_CUSTOMER();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'edit_customer.php'
					);
		$is_close = isset($input["is_close"]) ? $input["is_close"] : 0;
		$user_id=$input['user_id'];
		$fname = $input['fname'];
		$lname = $input['lname'];
		$email_id = $input['email_id'];
		$mobile = $input['mobile'];
		$is_active = $input['is_active'];
		$sex = $input['sex'];
		$profile_pic = "";
		$username = $input['email_id'];
		$password = $input['password'];
		$phone = $input['phone'];
		$comp_apt = $input['comp_apt'];
		$add1 = $input['add1'];
		$add2 = $input['add2'];
		$city = $input['city'];
		$state = $input['state'];
		$country = $input['country'];

		/** Validation **/		
		$valid_obj[] = array(
				'id'=>'user_id',
				'value'=>$user_id,
				'name'=>'User Id',
				'check' => array('NOT_BLANK')
			);		
		$valid_obj[] = array(
				'id'=>'fname',
				'value'=>$fname,
				'name'=>'First Name',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'lname',
				'value'=>$lname,
				'name'=>'Last Name',
				'check' => array('NOT_BLANK')
			);
		$valid_obj[] = array(
				'id'=>'email_id',
				'value'=>$username,
				'name'=>'Username',
				'check' => array('NOT_BLANK', 'EMAIL')
			);
		$valid_obj[] = array(
				'id'=>'mobile',
				'value'=>$mobile,
				'name'=>'Mobile',
				'check' => array('NOT_BLANK', 'NUMIRIC', 'MOBILE')
			);
		$valid_obj[] = array(
				'id'=>'password',
				'value'=>$password,
				'name'=>'Password',
				'check' => array('NOT_BLANK')
			);
		$valid_result = Utility::validation($valid_obj);
		if($valid_result['status'] == false){
			$mainObj["msg"] = $valid_result['msg'];
			return json_encode($mainObj);
		}
		/** END OF VALIDATION **/

		$mainObj = $objInstance->edit($user_id,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password,$phone,$comp_apt,$add1,$add2,$city,$state,$country);
		if (!$is_close) {
			$mainObj["next_url"] = "edit_customer.php?id=".$user_id;
		} else {
			$mainObj["next_url"] = "manage_customer.php";
		}
		return json_encode($mainObj);
	}


	public function deletecustomer($input){
		$objInstance = new TBL_CUSTOMER();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Invalid data, Please send all required data.",
						"next_url"=>'manage_customer.php'
					);

		$id = isset($input["id"]) ? $input["id"] : 0;
		if (!$id) {
			return json_encode($mainObj);
		} 

		$mainObj = $objInstance->delete($id);
	
		$mainObj["next_url"] = "manage_customer.php";

		return json_encode($mainObj);
	}


	/***********************************
	** Delete unsaved images
	***********************************/
	public function deleteunsavedfile($input){
		//Delete unique specification
		$mainObj = Array(
						"status"=>true, 
						"msg"=>"images deleted.",
					);
		$img = isset($input["file"]) ? $input["file"] : '';
		if (!empty($img)) {
			$image_link = $img;
			if(!empty($image_link)){
				$arr_name = explode('uploads/', $image_link);
				$file_name = isset($arr_name[1]) ? $arr_name[1] : '';
				$file_to_delete = BASE_DIR."uploads/".$file_name;
				if (file_exists($file_to_delete)) {
					unlink($file_to_delete);
				}
			}
		}
		return json_encode($mainObj);
	}


}

?>