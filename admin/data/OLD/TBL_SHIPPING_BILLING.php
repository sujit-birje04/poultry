<?php


class TBL_SHIPPING_BILLING {

	/* This function will be used to insert new entry in the table */
	public function insert($s_b_id,$user_id,$order_id,$address_type,$fname,$lname,$email_id,$mobile,$phone,$comp_apt,$add1,$add2,$city,$state,$country,$postcode,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_shipping_billing` (`s_b_id`,`user_id`,`order_id`,`address_type`,`fname`,`lname`,`email_id`,`mobile`,`phone`,`comp_apt`,`add1`,`add2`,`city`,`state`,`country`,`postcode`,`created_on`,`updated_on`) 
					VALUES('$s_b_id','$user_id','$order_id','$address_type','$fname','$lname','$email_id','$mobile','$phone','$comp_apt','$add1','$add2','$city','$state','$country','$postcode','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$s_b_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						's_b_id' => $s_b_id,
						'user_id' => $user_id,
						'order_id' => $order_id,
						'address_type' => $address_type,
						'fname' => $fname,
						'lname' => $lname,
						'email_id' => $email_id,
						'mobile' => $mobile,
						'phone' => $phone,
						'comp_apt' => $comp_apt,
						'add1' => $add1,
						'add2' => $add2,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'postcode' => $postcode,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($s_b_id,$user_id,$order_id,$address_type,$fname,$lname,$email_id,$mobile,$phone,$comp_apt,$add1,$add2,$city,$state,$country,$postcode,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_shipping_billing` SET 
						`s_b_id`='$s_b_id',
						`user_id`='$user_id',
						`order_id`='$order_id',
						`address_type`='$address_type',
						`fname`='$fname',
						`lname`='$lname',
						`email_id`='$email_id',
						`mobile`='$mobile',
						`phone`='$phone',
						`comp_apt`='$comp_apt',
						`add1`='$add1',
						`add2`='$add2',
						`city`='$city',
						`state`='$state',
						`country`='$country',
						`postcode`='$postcode',
						`created_on`='$created_on',
						`updated_on`='$updated_on'
					 WHERE s_b_id = '$s_b_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($s_b_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_shipping_billing` WHERE s_b_id = '$s_b_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($order_id, $address_type){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`s_b_id`,
				`user_id`,
				`order_id`,
				`address_type`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`phone`,
				`comp_apt`,
				`add1`,
				`add2`,
				`city`,
				`state`,
				`country`,
				`postcode`,
				`created_on`,
				`updated_on`
			 FROM `tbl_shipping_billing` 
			 WHERE address_type = '$address_type' and order_id = '$order_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						's_b_id' => $row['s_b_id'],
						'user_id' => $row['user_id'],
						'order_id' => $row['order_id'],
						'address_type' => $row['address_type'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'phone' => $row['phone'],
						'comp_apt' => $row['comp_apt'],
						'add1' => $row['add1'],
						'add2' => $row['add2'],
						'city' => $row['city'],
						'state' => $row['state'],
						'country' => $row['country'],
						'postcode' => $row['postcode'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`s_b_id`,
				`user_id`,
				`order_id`,
				`address_type`,
				`fname`,
				`lname`,
				`email_id`,
				`mobile`,
				`phone`,
				`comp_apt`,
				`add1`,
				`add2`,
				`city`,
				`state`,
				`country`,
				`postcode`,
				`created_on`,
				`updated_on`
			 from `tbl_shipping_billing`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						's_b_id' => $row['s_b_id'],
						'user_id' => $row['user_id'],
						'order_id' => $row['order_id'],
						'address_type' => $row['address_type'],
						'fname' => $row['fname'],
						'lname' => $row['lname'],
						'email_id' => $row['email_id'],
						'mobile' => $row['mobile'],
						'phone' => $row['phone'],
						'comp_apt' => $row['comp_apt'],
						'add1' => $row['add1'],
						'add2' => $row['add2'],
						'city' => $row['city'],
						'state' => $row['state'],
						'country' => $row['country'],
						'postcode' => $row['postcode'],
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