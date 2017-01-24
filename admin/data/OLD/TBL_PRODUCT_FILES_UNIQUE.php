<?php

class TBL_PRODUCT_FILES_UNIQUE {

	/* This function will be used to insert new entry in the table */
	public function insert($p_file_id,$product_id,$web_id,$file_link,$description){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_files_unique` (`p_file_id`,`product_id`,`web_id`,`file_link`,`description`,`created_on`,`updated_on`) 
					VALUES('$p_file_id','$product_id','$web_id','$file_link','$description',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$p_file_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'p_file_id' => $p_file_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'file_link' => $file_link,
						'description' => $description,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($p_file_id,$product_id,$web_id,$file_link,$description,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_files_unique` SET 
						`p_file_id`='$p_file_id',
						`product_id`='$product_id',
						`web_id`='$web_id',
						`file_link`='$file_link',
						`description`='$description',
						`updated_on`=now()
					 WHERE p_file_id = '$p_file_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	public function editImage($p_file_id,$file_link){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_files_unique` SET 
						`file_link`='$file_link'
					 WHERE p_file_id = '$p_file_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($p_file_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_files_unique` WHERE p_file_id = '$p_file_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}

	public function deleteproduct($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_files_unique` WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($p_file_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_file_id`,
				`product_id`,
				`web_id`,
				`file_link`,
				`description`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_files_unique` WHERE p_file_id = '$p_file_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'p_file_id' => $row['p_file_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'file_link' => $row['file_link'],
						'description' => $row['description'],
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
				`p_file_id`,
				`product_id`,
				`web_id`,
				`file_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_files_unique`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'p_file_id' => $row['p_file_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'file_link' => $row['file_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function productfiles($product_id, $web_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_file_id`,
				`product_id`,
				`web_id`,
				`file_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_files_unique`
			 WHERE web_id = '$web_id' AND product_id = '$product_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'p_file_id' => $row['p_file_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'file_link' => $row['file_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function productfilesbyid($product_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_file_id`,
				`product_id`,
				`web_id`,
				`file_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_files_unique`
			 WHERE product_id = '$product_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'p_file_id' => $row['p_file_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'file_link' => $row['file_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $new_image_link, $p_file_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_files_unique` (`product_id`,`web_id`,`file_link`,`description`,`created_on`,`updated_on`)
					SELECT 
				'$new_product_id',
				`web_id`,
				'$new_image_link',
				`description`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_files_unique` WHERE p_file_id = '$p_file_id'
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