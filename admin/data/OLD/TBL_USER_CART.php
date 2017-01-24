<?php

class TBL_USER_CART {

	/* This function will be used to insert new entry in the table */
	public function insert($cart_id,$product_id,$user_id,$quantity,$is_delete,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_user_cart` (`cart_id`,`product_id`,`user_id`,`quantity`,`is_delete`,`created_on`,`updated_on`) 
					VALUES('$cart_id','$product_id','$user_id','$quantity','$is_delete','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$cart_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'cart_id' => $cart_id,
						'product_id' => $product_id,
						'user_id' => $user_id,
						'quantity' => $quantity,
						'is_delete' => $is_delete,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($cart_id,$product_id,$user_id,$quantity,$is_delete,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_user_cart` SET 
						`cart_id`='$cart_id',
						`product_id`='$product_id',
						`user_id`='$user_id',
						`quantity`='$quantity',
						`is_delete`='$is_delete',
						`created_on`='$created_on',
						`updated_on`='$updated_on'
					 WHERE cart_id = '$cart_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($cart_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_user_cart` WHERE cart_id = '$cart_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($cart_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`cart_id`,
				`product_id`,
				`user_id`,
				`quantity`,
				`is_delete`,
				`created_on`,
				`updated_on`
			 FROM `tbl_user_cart` WHERE cart_id = '$cart_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'cart_id' => $cart_id,
						'product_id' => $product_id,
						'user_id' => $user_id,
						'quantity' => $quantity,
						'is_delete' => $is_delete,
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
				`cart_id`,
				`product_id`,
				`user_id`,
				`quantity`,
				`is_delete`,
				`created_on`,
				`updated_on`
			 from `tbl_user_cart`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'cart_id' => $row['cart_id'],
						'product_id' => $row['product_id'],
						'user_id' => $row['user_id'],
						'quantity' => $row['quantity'],
						'is_delete' => $row['is_delete'],
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