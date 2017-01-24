<?php

class TBL_PRODUCT_FEATURES_UNIQUE {

	/* This function will be used to insert new entry in the table */
	public function insert($feature_id,$product_id,$web_id,$title,$sort_order){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_features_unique` (`feature_id`,`product_id`,`web_id`,`title`,`sort_order`,`created_on`,`updated_on`) 
					VALUES('$feature_id','$product_id','$web_id','$title','$sort_order',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$feature_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'feature_id' => $feature_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'title' => $title,
						'sort_order' => $sort_order,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($feature_id,$product_id,$web_id,$title,$sort_order){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_features_unique` SET 
						`product_id`='$product_id',
						`web_id`='$web_id',
						`title`='$title',
						`sort_order`='$sort_order',
						`updated_on`= now()
					 WHERE feature_id = '$feature_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($feature_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_features_unique` WHERE feature_id = '$feature_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}

	/* This function will be used to delete a row from the table */
	public function deleteproduct($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_features_unique` WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($feature_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`feature_id`,
				`product_id`,
				`web_id`,
				`title`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_features_unique` WHERE feature_id = '$feature_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'feature_id' => $row['feature_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'title' => $row['title'],
						'sort_order' => $row['sort_order'],
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
		$mainObj = Array();
		$sql = "SELECT 
				`feature_id`,
				`product_id`,
				`web_id`,
				`title`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 from `tbl_product_features_unique`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'feature_id' => $row['feature_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'title' => $row['title'],
						'sort_order' => $row['sort_order'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}

	/* This function will be used to return a list of rows from table */
	public function productfeatures($product_id, $web_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`feature_id`,
				`product_id`,
				`web_id`,
				`title`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 from `tbl_product_features_unique`
			 WHERE product_id = '$product_id' and web_id = '$web_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'feature_id' => $row['feature_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'title' => $row['title'],
						'sort_order' => $row['sort_order'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listproductfeaturebyid($product_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`feature_id`,
				`product_id`,
				`web_id`,
				`title`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 from `tbl_product_features_unique`
			 WHERE product_id = '$product_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'feature_id' => $row['feature_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'title' => $row['title'],
						'sort_order' => $row['sort_order'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $feature_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_features_unique` (`product_id`,`web_id`,`title`,`sort_order`,`created_on`,`updated_on`)
					SELECT 
				`product_id`,
				`web_id`,
				`title`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_features_unique` WHERE feature_id = '$feature_id'
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