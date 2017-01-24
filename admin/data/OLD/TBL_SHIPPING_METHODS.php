<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_SHIPPING_METHODS {

	/* This function will be used to insert new entry in the table */
	public function insert($method_id,$method_name,$method_charge){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_shipping_methods` (`method_id`,`method_name`,`method_charge`,`created_on`,`updated_on`) 
					VALUES('$method_id','$method_name','$method_charge',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$method_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'method_id' => $method_id,
						'method_name' => $method_name,
						'method_charge' => $method_charge,
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($method_id,$method_name,$method_charge){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_shipping_methods` SET 
						`method_name`='$method_name',
						`method_charge`='$method_charge',
						`updated_on`=now()
					 WHERE method_id = '$method_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($method_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_shipping_methods` WHERE method_id = '$method_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($method_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`method_id`,
				`method_name`,
				`method_charge`,
				`created_on`,
				`updated_on`
			 FROM `tbl_shipping_methods` WHERE method_id = '$method_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'method_id' => $row['method_id'],
						'method_name' => $row['method_name'],
						'method_charge' => $row['method_charge'],
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
				`method_id`,
				`method_name`,
				`method_charge`,
				`created_on`,
				`updated_on`
			 from `tbl_shipping_methods`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'method_id' => $row['method_id'],
						'method_name' => $row['method_name'],
						'method_charge' => $row['method_charge'],
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