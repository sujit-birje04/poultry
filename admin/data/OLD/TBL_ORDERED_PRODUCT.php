<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}
class TBL_ORDERED_PRODUCT {

	/* This function will be used to insert new entry in the table */
	public function insert($o_p_id,$product_id,$order_id,$quantity,$price,$order_status,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_ordered_product` (`o_p_id`,`product_id`,`order_id`,`quantity`,`price`,`order_status`,`created_on`,`updated_on`) 
					VALUES('$o_p_id','$product_id','$order_id','$quantity','$price','$order_status','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$o_p_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'o_p_id' => $o_p_id,
						'product_id' => $product_id,
						'order_id' => $order_id,
						'quantity' => $quantity,
						'price' => $price,
						'order_status' => $order_status,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($o_p_id,$product_id,$order_id,$quantity,$price,$order_status,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_ordered_product` SET 
						`o_p_id`='$o_p_id',
						`product_id`='$product_id',
						`order_id`='$order_id',
						`quantity`='$quantity',
						`price`='$price',
						`order_status`='$order_status',
						`created_on`='$created_on',
						`updated_on`='$updated_on'
					 WHERE o_p_id = '$o_p_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($o_p_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_ordered_product` WHERE o_p_id = '$o_p_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($o_p_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`o_p_id`,
				`product_id`,
				`order_id`,
				`quantity`,
				`price`,
				`order_status`,
				`created_on`,
				`updated_on`
			 FROM `tbl_ordered_product` WHERE o_p_id = '$o_p_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'o_p_id' => $o_p_id,
						'product_id' => $product_id,
						'order_id' => $order_id,
						'quantity' => $quantity,
						'price' => $price,
						'order_status' => $order_status,
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
				`o_p_id`,
				`product_id`,
				`order_id`,
				`quantity`,
				`price`,
				`order_status`,
				`created_on`,
				`updated_on`
			 from `tbl_ordered_product`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'o_p_id' => $o_p_id,
						'product_id' => $product_id,
						'order_id' => $order_id,
						'quantity' => $quantity,
						'price' => $price,
						'order_status' => $order_status,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	/* This function will be used to return a list of rows from table */
	public function listorderproduct($order_id, $web_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`o_p_id`,
				`product_id`,
				`order_id`,
				`quantity`,
				`price`,
				`order_status`,
				`created_on`,
				`updated_on`
			 from `tbl_ordered_product` where order_id = '$order_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$objUProduct = new TBL_PRODUCT_UNIQUE();
				$objCProduct = new TBL_PRODUCT();
			    $product = $objUProduct->getuniquedetails($row['product_id']);
				if(empty($product)){
					$product = $objCProduct->getdetails($row['product_id']);
				}

				$mainObj[$i] = Array(
						'o_p_id' => $row['o_p_id'],
						'product_id' => $row['product_id'],
						'product' => $product,
						'order_id' => $row['order_id'],
						'quantity' => $row['quantity'],
						'price' => $row['price'],
						'order_status' => $row['order_status'],
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