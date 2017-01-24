<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class TBL_WEBSITE {

	/* This function will be used to insert new entry in the table */
	public function insert($web_id,$name,$email,$domain,$logo_path,$type,$sort_order,$is_active, $web_shipping_charge, $web_path){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_website` (`web_id`,`name`, `email`,`domain`,`logo_path`,`type`,`sort_order`,`is_active`, `shipping_charge`,`web_path`,`created_on`,`updated_on`) 
					VALUES('$web_id','$name', '$email','$domain','$logo_path','$type','$sort_order','$is_active', '$web_shipping_charge','$web_path',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$web_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'web_id' => $web_id,
						'name' => $name,
						'email' => $email,
						'domain' => $domain,
						'logo_path' => $logo_path,
						'web_path' => $web_path,
						'type' => $type,
						'sort_order' => $sort_order,
						'is_active' => $is_active,
						'shipping_charge' => $web_shipping_charge,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($web_id,$name,$email,$domain,$logo_path,$type,$sort_order,$is_active,$web_shipping_charge,$web_path){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_website` SET 
						`name`='$name',
						`email`='$email',
						`domain`='$domain',
						`logo_path`='$logo_path',
						`web_path`='$web_path',
						`type`='$type',
						`sort_order`='$sort_order',
						`is_active`='$is_active',
						`shipping_charge` = '$web_shipping_charge',
						`updated_on`=now()
					 WHERE web_id = '$web_id'";
		
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Website updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_website` WHERE web_id = '$web_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Website deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`web_id`,
				`name`,
				`email`,
				`domain`,
				`logo_path`,
				`web_path`,
				`type`,
				`sort_order`,
				`is_active`,
				`shipping_charge`,
				`created_on`,
				`updated_on`
			 FROM `tbl_website` WHERE web_id = '$web_id'";
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'domain' => $row['domain'],
						'logo_path' => $row['logo_path'],
						'web_path' => $row['web_path'],
						'type' => $row['type'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'shipping_charge' => $row['shipping_charge'],
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
				`web_id`,
				`name`,
				`email`,
				`domain`,
				`logo_path`,
				`web_path`,
				`type`,
				`sort_order`,
				`is_active`,
				`shipping_charge`,
				`created_on`,
				`updated_on`
			 from `tbl_website` order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'domain' => $row['domain'],
						'logo_path' => $row['logo_path'],
						'web_path' => $row['web_path'],
						'type' => $row['type'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'shipping_charge' => $row['shipping_charge'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}

	public function listallretail(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Websites not found", "data"=>"");
		$sql = "SELECT 
				`web_id`,
				`name`,
				`email`,
				`domain`,
				`logo_path`,
				`web_path`,
				`type`,
				`sort_order`,
				`shipping_charge`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_website`
			 Where type = 1 order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'domain' => $row['domain'],
						'logo_path' => $row['logo_path'],
						'web_path' => $row['web_path'],
						'type' => $row['type'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'shipping_charge' => $row['shipping_charge'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}



	public function listallinformative(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Websites not found", "data"=>"");
		$sql = "SELECT 
				`web_id`,
				`name`,
				`email`,
				`domain`,
				`logo_path`,
				`web_path`,
				`type`,
				`sort_order`,
				`is_active`,
				`shipping_charge`,
				`created_on`,
				`updated_on`
			 from `tbl_website`
			 Where type = 2 order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'domain' => $row['domain'],
						'logo_path' => $row['logo_path'],
						'web_path' => $row['web_path'],
						'type' => $row['type'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'shipping_charge' => $row['shipping_charge'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}



	public function listallactive(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Websites not found", "data"=>"");
		$sql = "SELECT 
				`web_id`,
				`name`,
				`email`,
				`domain`,
				`logo_path`,
				`web_path`,
				`type`,
				`sort_order`,
				`is_active`,
				`shipping_charge`,
				`created_on`,
				`updated_on`
			 from `tbl_website`
			 Where is_active = 1 order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'domain' => $row['domain'],
						'logo_path' => $row['logo_path'],
						'web_path' => $row['web_path'],
						'type' => $row['type'],
						'sort_order' => $row['sort_order'],
						'shipping_charge' => $row['shipping_charge'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}



	/* This function will be used to update a row in the table */
	public function editImage($web_id,$image_path){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_website` SET 
						`logo_path`='$image_path'
					 WHERE web_id = '$web_id'";
		
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Website updated successfully';
		}
		return $mainObj;
	}


}

?>