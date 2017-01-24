<?php


if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class ENQUIRIES {

	/* This function will be used to insert new entry in the table */
	public function insert($id,$name,$email,$address,$city,$country,$zipcode,$phone,$fax,$comment){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `enquiries` (`id`,`name`,`email`,`address`,`city`,`country`,`zipcode`,`phone`,`fax`,`comment`,`created_on`) 
					VALUES('$id','$name','$email','$address','$city','$country','$zipcode','$phone','$fax','$comment',now());
				";
		$result = $mysqli->query($insert_query); 			
		$id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'id' => $id,
						'name' => $name,
						'email' => $email,
						'address' => $address,
						'city' => $city,
						'country' => $country,
						'zipcode' => $zipcode,
						'phone' => $phone,
						'fax' => $fax,
						'comment' => $comment,
						'created_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($id,$name,$email,$address,$city,$country,$zipcode,$phone,$fax,$comment){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `enquiries` SET 
						`name`='$name',
						`email`='$email',
						`address`='$address',
						`city`='$city',
						`country`='$country',
						`zipcode`='$zipcode',
						`phone`='$phone',
						`fax`='$fax',
						`comment`='$comment',
					 WHERE id = '$id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `enquiries` WHERE id = '$id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`id`,
				`name`,
				`email`,
				`address`,
				`city`,
				`country`,
				`zipcode`,
				`phone`,
				`fax`,
				`comment`,
				`created_on`
			 FROM `enquiries` WHERE id = '$id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'id' => $row['id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'address' => $row['address'],
						'city' => $row['city'],
						'country' => $row['country'],
						'zipcode' => $row['zipcode'],
						'phone' => $row['phone'],
						'fax' => $row['fax'],
						'comment' => $row['comment'],
						'created_on' => $row['created_on']
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
				`id`,
				`name`,
				`email`,
				`address`,
				`city`,
				`country`,
				`zipcode`,
				`phone`,
				`fax`,
				`comment`,
				`created_on`
			 from `enquiries`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'id' => $row['id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'address' => $row['address'],
						'city' => $row['city'],
						'country' => $row['country'],
						'zipcode' => $row['zipcode'],
						'phone' => $row['phone'],
						'fax' => $row['fax'],
						'comment' => $row['comment'],
						'created_on' => $row['created_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `enquiries` (`id`,`name`,`email`,`address`,`city`,`country`,`zipcode`,`phone`,`fax`,`comment`,`created_on`)
					SELECT 
				`id`,
				`name`,
				`email`,
				`address`,
				`city`,
				`country`,
				`zipcode`,
				`phone`,
				`fax`,
				`comment`,
				`created_on`
			 FROM `enquiries` WHERE id = '$id'
					";
		$result = $mysqli->query($insert_query); 			
		if($result){	
			$id = $mysqli->insert_id;	
			$mainObj["id"] = $id;
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}




}


?>