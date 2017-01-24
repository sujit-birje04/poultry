<?php


class TBL_PRODUCT_SPECIAL_PROP_UNIQUE {

	/* This function will be used to insert new entry in the table */
	public function insert($ps_id,$product_id,$web_id,$name,$value,$sort_order,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_special_prop_unique` (`ps_id`,`product_id`,`web_id`,`name`,`value`,`sort_order`,`is_active`,`created_on`,`updated_on`) 
					VALUES('$ps_id','$product_id','$web_id','$name','$value','$sort_order','$is_active',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$ps_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'ps_id' => $ps_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'name' => $name,
						'value' => $value,
						'sort_order' => $sort_order,
						'is_active' => $is_active,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($ps_id,$product_id,$web_id,$name,$value,$sort_order,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_special_prop_unique` SET 
						`product_id`='$product_id',
						`web_id`='$web_id',
						`name`='$name',
						`value`='$value',
						`sort_order`='$sort_order',
						`is_active`='$is_active',
						`updated_on`=now()
					 WHERE ps_id = '$ps_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($ps_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_special_prop_unique` WHERE ps_id = '$ps_id'";
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
		$update_query = "DELETE FROM `tbl_product_special_prop_unique` WHERE product_id = '$p_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($ps_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ps_id`,
				`product_id`,
				`web_id`,
				`name`,
				`value`,
				`sort_order`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_special_prop_unique` WHERE ps_id = '$ps_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'ps_id' => $ps_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'name' => $name,
						'value' => $value,
						'sort_order' => $sort_order,
						'is_active' => $is_active,
						'created_on' => $created_on,
						'updated_on' => $updated_on
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
				`ps_id`,
				`product_id`,
				`web_id`,
				`name`,
				`value`,
				`sort_order`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_product_special_prop_unique`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'ps_id' => $ps_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'name' => $name,
						'value' => $value,
						'sort_order' => $sort_order,
						'is_active' => $is_active,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function productspecials($product_id, $web_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ps_id`,
				`product_id`,
				`web_id`,
				`name`,
				`value`,
				`sort_order`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_product_special_prop_unique`
			 WHERE product_id = '$product_id' AND web_id = '$web_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'ps_id' => $row['ps_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'value' => $row['value'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function productspecialsbyid($product_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ps_id`,
				`product_id`,
				`web_id`,
				`name`,
				`value`,
				`sort_order`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_product_special_prop_unique`
			 WHERE product_id = '$product_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'ps_id' => $row['ps_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'name' => $row['name'],
						'value' => $row['value'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function copyitem($new_product_id, $ps_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_special_prop_unique` (`product_id`,`web_id`,`name`,`value`,`sort_order`,`is_active`,`created_on`,`updated_on`)
					SELECT
				'$new_product_id',
				`web_id`,
				`name`,
				`value`,
				`sort_order`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_special_prop_unique` WHERE ps_id = '$ps_id'
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