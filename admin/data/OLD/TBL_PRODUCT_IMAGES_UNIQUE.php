<?php

class TBL_PRODUCT_IMAGES_UNIQUE {

	/* This function will be used to insert new entry in the table */
	public function insert($p_image_id,$product_id,$web_id,$image_link,$description){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_images_unique` (`p_image_id`,`product_id`,`web_id`,`image_link`,`description`,`created_on`,`updated_on`) 
					VALUES('$p_image_id','$product_id','$web_id','$image_link','$description',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$p_image_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'p_image_id' => $p_image_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'image_link' => $image_link,
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
	public function edit($p_image_id,$product_id,$web_id,$image_link,$description,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_images_unique` SET 
						`p_image_id`='$p_image_id',
						`product_id`='$product_id',
						`web_id`='$web_id',
						`image_link`='$image_link',
						`description`='$description',
						`created_on`='$created_on',
						`updated_on`='$updated_on'
					 WHERE p_image_id = '$p_image_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	
	public function editImage($p_image_id, $image_link){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_images_unique` SET 
						`image_link`='$image_link'
					 WHERE p_image_id = '$p_image_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($p_image_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_images_unique` WHERE p_image_id = '$p_image_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function deleteproduct($p_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_images_unique` WHERE product_id = '$p_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($p_image_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_image_id`,
				`product_id`,
				`web_id`,
				`image_link`,
				`description`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_images_unique` WHERE p_image_id = '$p_image_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'p_image_id' => $row['p_image_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'image_link' => $row['image_link'],
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
				`p_image_id`,
				`product_id`,
				`web_id`,
				`image_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_images_unique`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'p_image_id' => $row['p_image_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'image_link' => $row['image_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function productimages($product_id, $web_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_image_id`,
				`product_id`,
				`web_id`,
				`image_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_images_unique`
			 WHERE web_id = '$web_id' AND product_id = '$product_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'p_image_id' => $row['p_image_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'image_link' => $row['image_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function productimagesbyid($product_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_image_id`,
				`product_id`,
				`web_id`,
				`image_link`,
				`description`,
				`created_on`,
				`updated_on`
			 from `tbl_product_images_unique`
			 WHERE product_id = '$product_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'p_image_id' => $row['p_image_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'image_link' => $row['image_link'],
						'description' => $row['description'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $new_image_link, $p_image_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_images_unique` (`product_id`,`web_id`,`image_link`,`description`,`created_on`,`updated_on`)
					SELECT 
				'$new_product_id',
				`web_id`,
				'$new_image_link',
				`description`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_images_unique` WHERE p_image_id = '$p_image_id'
					";
		//echo $insert_query;
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