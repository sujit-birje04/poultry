<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}
class TBL_COUPON {

	/* This function will be used to insert new entry in the table */
	public function insert($coupon_id,$name,$code,$discount,$product_id,$start_date,$end_date,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_coupon` (`coupon_id`,`name`,`code`,`discount`,`product_id`,`start_date`,`end_date`,`is_active`,`created_on`,`updated_on`) 
					VALUES('$coupon_id','$name','$code','$discount','$product_id','$start_date','$end_date','$is_active',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$coupon_id = $mysqli->insert_id;
		echo $mysqli->error;
		if($result){			
			$mainObj["data"] = array(
						'coupon_id' => $coupon_id,
						'name' => $name,
						'code' => $code,
						'discount' => $discount,
						'product_id' => $product_id,
						'start_date' => $start_date,
						'end_date' => $end_date,
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
	public function edit($coupon_id,$name,$code,$discount,$product_id,$start_date,$end_date,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_coupon` SET 
						`name`='$name',
						`code`='$code',
						`discount`='$discount',
						`product_id`='$product_id',
						`start_date`='$start_date',
						`end_date`='$end_date',
						`is_active` = '$is_active',
						`updated_on`=now()
					 WHERE coupon_id = '$coupon_id'";
					 
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($coupon_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_coupon` WHERE coupon_id = '$coupon_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($coupon_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`coupon_id`,
				`name`,
				`code`,
				`discount`,
				`product_id`,
				`start_date`,
				`end_date`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `tbl_coupon` WHERE coupon_id = '$coupon_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'coupon_id' => $row['coupon_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'discount' => $row['discount'],
						'product_id' => $row['product_id'],
						'products' => self::getProductList($row['code']),
						'start_date' => $row['start_date'],
						'end_date' => $row['end_date'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	public static function getProductList($code){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`coupon_id`,
				`name`,
				`code`,
				`discount`,
				`product_id`,
				`start_date`,
				`end_date`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_coupon` where code = '$code';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = $row['product_id'];
				$i++;
			}
		} 	
		return $mainObj;
	}

	public static function getProductListById($coupon_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`coupon_id`,
				`name`,
				`code`,
				`discount`,
				`product_id`,
				`start_date`,
				`end_date`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_coupon` where coupon_id = '$coupon_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
					'coupon_id' => $row['coupon_id'],
					'name' => $row['name'],
					'code' => $row['code'],
					'discount' => $row['discount'],
					'product_id' => $row['product_id'],
					'products' => self::getProductList($row['code']),
					'start_date' => $row['start_date'],
					'end_date' => $row['end_date'],
					'is_active' => $row['is_active'],
					'created_on' => $row['created_on'],
					'updated_on' => $row['updated_on']
				);	
				$i++;
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`coupon_id`,
				`name`,
				`code`,
				`discount`,
				`product_id`,
				`start_date`,
				`end_date`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_coupon` group by code;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
					
						'coupon_id' => $row['coupon_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'discount' => $row['discount'],
						'product_id' => $row['product_id'],
						'products' => self::getProductList($row['code']),
						'start_date' => $row['start_date'],
						'end_date' => $row['end_date'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $coupon_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_coupon` (`coupon_id`,`name`,`code`,``,`product_id`,`start_date`,`end_date`,`created_on`,`updated_on`)
					SELECT 
				`coupon_id`,
				`name`,
				`code`,
				`discount`,
				`product_id`,
				`start_date`,
				`end_date`,
				`created_on`,
				`updated_on`
			 FROM `tbl_coupon` WHERE coupon_id = '$coupon_id'
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