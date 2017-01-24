<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_CUSTOMER {

	/* This function will be used to insert new entry in the table */
	public function insert($user_id,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password,$phone,$comp_apt,$add1,$add2,$city,$state,$country){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_customer` (`user_id`,`fname`,`lname`,`email_id`,`mobile`,`is_active`,`sex`,`profile_pic`,`username`,`password`,`phone`,`comp_apt`,`add1`,`add2`,`city`,`state`,`country`,`created_on`,`updated_on`) 
					VALUES('$user_id','$fname','$lname','$email_id','$mobile','$is_active','$sex','$profile_pic','$username','$password','$phone','$comp_apt','$add1','$add2','$city','$state','$country',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$user_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'user_id' => $user_id,
						'fname' => $fname,
						'lname' => $lname,
						'email_id' => $email_id,
						'mobile' => $mobile,
						'is_active' => $is_active,
						'sex' => $sex,
						'profile_pic' => $profile_pic,
						'username' => $username,
						'password' => $password,
						'phone' => $phone,
						'comp_apt' => $comp_apt,
						'add1' => $add1,
						'add2' => $add2,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($user_id,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password,$phone,$comp_apt,$add1,$add2,$city,$state,$country){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_customer` SET 
						`fname`='$fname',
						`lname`='$lname',
						`email_id`='$email_id',
						`mobile`='$mobile',
						`is_active`='$is_active',
						`sex`='$sex',
						`profile_pic`='$profile_pic',
						`username`='$username',
						`password`='$password',
						`phone`='$phone',
						`comp_apt`='$comp_apt',
						`add1`='$add1',
						`add2`='$add2',
						`city`='$city',
						`state`='$state',
						`country`='$country',
						`updated_on`=now()
					 WHERE user_id = '$user_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($user_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_customer` WHERE user_id = '$user_id'";
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
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`is_active`,
				`sex`,
				`profile_pic`,
				`username`,
				`password`,
				`phone`,
				`comp_apt`,
				`add1`,
				`add2`,
				`city`,
				`state`,
				`country`,
				`created_on`,
				`updated_on`
			 FROM `tbl_customer` WHERE user_id = '$user_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'user_id' => $row['user_id'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'is_active' => $row['is_active'],
						'sex' => $row['sex'],
						'profile_pic' => $row['profile_pic'],
						'username' => $row['username'],
						'password' => $row['password'],
						'phone' => $row['phone'],
						'comp_apt' => $row['comp_apt'],
						'add1' => $row['add1'],
						'add2' => $row['add2'],
						'city' => $row['city'],
						'state' => $row['state'],
						'country' => $row['country'],
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
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>array());
		$sql = "SELECT 
				`user_id`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`is_active`,
				`sex`,
				`profile_pic`,
				`username`,
				`password`,
				`phone`,
				`comp_apt`,
				`add1`,
				`add2`,
				`city`,
				`state`,
				`country`,
				`created_on`,
				`updated_on`
			 from `tbl_customer`";

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
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'is_active' => $row['is_active'],
						'sex' => $row['sex'],
						'profile_pic' => $row['profile_pic'],
						'username' => $row['username'],
						'password' => $row['password'],
						'phone' => $row['phone'],
						'comp_apt' => $row['comp_apt'],
						'add1' => $row['add1'],
						'add2' => $row['add2'],
						'city' => $row['city'],
						'state' => $row['state'],
						'country' => $row['country'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


}

?>