<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_USERS {

	/* This function will be used to insert new entry in the table */
	public function insert($user_id,$user_type,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_users` (`user_id`,`user_type`,`fname`,`lname`,`email_id`,`mobile`,`is_active`,`sex`,`profile_pic`,`username`,`password`,`created_on`,`updated_on`) 
					VALUES('$user_id','$user_type','$fname','$lname','$email_id','$mobile','$is_active','$sex','$profile_pic','$username','$password',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$user_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'user_id' => $user_id,
						'user_type' => $user_type,
						'fname' => $fname,
						'lname' => $lname,
						'email_id' => $email_id,
						'mobile' => $mobile,
						'is_active' => $is_active,
						'sex' => $sex,
						'profile_pic' => $profile_pic,
						'username' => $username,
						'password' => $password,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'User inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($user_id,$user_type,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_users` SET 
						`user_type`='$user_type',
						`fname`='$fname',
						`lname`='$lname',
						`email_id`='$email_id',
						`mobile`='$mobile',
						`is_active`='$is_active',
						`sex`='$sex',
						`profile_pic`='$profile_pic',
						`username`='$username',
						`password`='$password',
						`updated_on`=now()
					 WHERE user_id = '$user_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'User updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($user_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_users` WHERE user_id = '$user_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($user_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`user_id`,
				`user_type`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`is_active`,
				`sex`,
				`profile_pic`,
				`username`,
				`password`,
				`created_on`,
				`updated_on`
			 FROM `tbl_users` WHERE user_id = '$user_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'user_id' => $row['user_id'],
						'user_type' => $row['user_type'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'is_active' => $row['is_active'],
						'sex' => $row['sex'],
						'profile_pic' => $row['profile_pic'],
						'username' => $row['username'],
						'password' => $row['password'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`user_id`,
				`user_type`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`is_active`,
				`sex`,
				`profile_pic`,
				`username`,
				`password`,
				`created_on`,
				`updated_on`
			 from `tbl_users`";
			 
		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'user_id' => $row['user_id'],
						'user_type' => $row['user_type'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'is_active' => $row['is_active'],
						'sex' => $row['sex'],
						'profile_pic' => $row['profile_pic'],
						'username' => $row['username'],
						'password' => $row['password'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function isUserPresent($username){ 
		$mysqli = Configuration::mysqli_configation();
		$sql = "SELECT  *
				FROM tbl_users ud
				where lower(username) = lower('$username')";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			return true;
		} 
		return false;
	}



	/* This function will be return row in details from the table */
	public function login($username, $password){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array(
						"status"=>false, 
						"msg"=>"Username or Password is not matching."
					);
		$sql = "SELECT 
				`user_id`,
				`user_type`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`is_active`,
				`sex`,
				`profile_pic`,
				`username`,
				`password`,
				`created_on`,
				`updated_on`
			 FROM `tbl_users` WHERE lower(username) = lower('$username')
			 		AND password = '$password' AND is_active = 1";


		$result = $mysqli->query($sql);
		//echo $mysqli->error;
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["msg"] = "Logged in successfully";
				$mainObj["data"] = array(
						'user_id' => $row['user_id'],
						'user_type' => $row['user_type'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'is_active' => $row['is_active'],
						'sex' => $row['sex'],
						'profile_pic' => $row['profile_pic'],
						'username' => $row['username'],
						'password' => $row['password'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}




}

?>