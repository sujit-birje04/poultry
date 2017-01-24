<?php

class TBL_PRODUCT_ON_WEBSITE {

	/* This function will be used to insert new entry in the table */
	public function insert($pw_id,$product_id,$web_id,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_on_website` (`pw_id`,`product_id`,`web_id`,`created_on`,`updated_on`) 
					VALUES('$pw_id','$product_id','$web_id','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$pw_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'pw_id' => $pw_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($pw_id,$product_id,$web_id,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_on_website` SET 
						`pw_id`='pw_id',
						`product_id`='product_id',
						`web_id`='web_id',
						`created_on`='created_on',
						`updated_on`='updated_on'
					 WHERE pw_id = '$pw_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($pw_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_on_website` WHERE pw_id = '$pw_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($pw_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`pw_id`,
				`product_id`,
				`web_id`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_on_website` WHERE pw_id = '$pw_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'pw_id' => $pw_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function list(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`pw_id`,
				`product_id`,
				`web_id`,
				`created_on`,
				`updated_on`
			 from `tbl_product_on_website`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'pw_id' => $pw_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


}

?>