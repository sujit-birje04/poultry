<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class CONTACT_US {

	/* This function will be used to insert new entry in the table */
	public function insert($id,$name,$email,$phone,$subject,$message){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `contact_us` (`id`,`name`,`email`,`phone`,`subject`,`message`,`created_on`) 
					VALUES('$id','$name','$email','$phone','$subject','$message',now());
				";
		$result = $mysqli->query($insert_query); 			
		$id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'id' => $id,
						'name' => $name,
						'email' => $email,
						'phone' => $phone,
						'subject' => $subject,
						'message' => $message,
						'created_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($id,$name,$email,$phone,$subject,$message){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `contact_us` SET
						`name`='$name',
						`email`='$email',
						`phone`='$phone',
						`subject`='$subject',
						`message`='$message',
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
		$update_query = "DELETE FROM `contact_us` WHERE id = '$id'";
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
				`phone`,
				`subject`,
				`message`,
				`created_on`
			 FROM `contact_us` WHERE id = '$id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'id' => $row['id'],
						'name' => $row['name'],
						'email' => $row['email'],
						'phone' => $row['phone'],
						'subject' => $row['subject'],
						'message' => $row['message'],
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
				`phone`,
				`subject`,
				`message`,
				`created_on`
			 from `contact_us`;";
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
						'phone' => $row['phone'],
						'subject' => $row['subject'],
						'message' => $row['message'],
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
		$insert_query = "INSERT INTO `contact_us` (`id`,`name`,`email`,`phone`,`subject`,`message`,`created_on`)
					SELECT 
				`id`,
				`name`,
				`email`,
				`phone`,
				`subject`,
				`message`,
				`created_on`
			 FROM `contact_us` WHERE id = '$id'
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