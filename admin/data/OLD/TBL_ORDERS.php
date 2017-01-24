<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_ORDERS {

	/* This function will be used to insert new entry in the table */
	public function insert($order_id,$web_id,$user_id,$price,$discount,$shipping_method,$shipping_charge,$shipping_comment,$payment_method,$payment_comment,$payment_id,$payment_response,$payment_status,$order_status,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_orders` (`order_id`,`web_id`,`user_id`,`price`,`discount`,`shipping_method`,`shipping_charge`,`shipping_comment`,`payment_method`,`payment_comment`,`payment_id`,`payment_response`,`payment_status`,`order_status`,`created_on`,`updated_on`) 
					VALUES('$order_id','$web_id','$user_id','$price','$discount','$shipping_method','$shipping_charge','$shipping_comment','$payment_method','$payment_comment','$payment_id','$payment_response','$payment_status','$order_status','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$order_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'order_id' => $order_id,
						'web_id' => $web_id,
						'user_id' => $user_id,
						'price' => $price,
						'discount' => $discount,
						'shipping_method' => $shipping_method,
						'shipping_charge' => $shipping_charge,
						'shipping_comment' => $shipping_comment,
						'payment_method' => $payment_method,
						'payment_comment' => $payment_comment,
						'payment_id' => $payment_id,
						'payment_response' => $payment_response,
						'payment_status' => $payment_status,
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
	public function edit($order_id,$web_id,$user_id,$price,$discount,$shipping_method,$shipping_charge,$shipping_comment,$payment_method,$payment_comment,$payment_id,$payment_response,$payment_status,$order_status,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_orders` SET 
						`order_id`='$order_id',
						`web_id`='$web_id',
						`user_id`='$user_id',
						`price`='$price',
						`discount`='$discount',
						`shipping_method`='$shipping_method',
						`shipping_charge`='$shipping_charge',
						`shipping_comment`='$shipping_comment',
						`payment_method`='$payment_method',
						`payment_comment`='$payment_comment',
						`payment_id`='$payment_id',
						`payment_response`='$payment_response',
						`payment_status`='$payment_status',
						`order_status`='$order_status',
						`created_on`='$created_on',
						`updated_on`='$updated_on'
					 WHERE order_id = '$order_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function is used to update the status */

	public function changestatus($order_id, $order_status){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_orders` SET 
						`order_status`='$order_status',
						`updated_on` = now()
					 WHERE order_id = '$order_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	} 

	


	/* This function will be used to delete a row from the table */
	public function delete($order_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_orders` WHERE order_id = '$order_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($order_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`order_id`,
				`web_id`,
				`user_id`,
				`price`,
				`discount`,
				`shipping_method`,
				`shipping_charge`,
				`shipping_comment`,
				`payment_method`,
				`payment_comment`,
				`payment_id`,
				`payment_response`,
				`payment_status`,
				`order_status`,
				`coupon_id`,
				`coupon_discount`,
				`created_on`,
				`updated_on`
			 FROM `tbl_orders` WHERE order_id = '$order_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
	          	$objUsers = new TBL_CUSTOMER();
	          	$user = $objUsers->getdetails($row['user_id']);

	          	$objProducts = new TBL_ORDERED_PRODUCT();
	          	$product = $objProducts->listorderproduct($row['order_id'], $row['web_id']);
	          	//$product = array();

	          	$objAddress = new TBL_SHIPPING_BILLING();
	          	$payment_address = $objAddress->getdetails($row['order_id'], 1);
	          	$shipping_address = $objAddress->getdetails($row['order_id'], 2);

	          	$objPayment = new TBL_PAYMENT_METHODS();
	          	$payment_method = $objPayment->getdetails($row['payment_method']);

	          	$objShipping = new TBL_SHIPPING_METHODS();
	          	$shipping_method = $objShipping->getdetails($row['shipping_method']);

				$mainObj = array(
						'order_id' => $row['order_id'],
						'web_id' => $row['web_id'],
						'user_id' => $row['user_id'],
						'user' => $user,
						'price' => $row['price'],
						'discount' => $row['discount'],
						'shipping_method' => $row['shipping_method'],
						'shipping_method_details' => $shipping_method,
						'shipping_charge' => $row['shipping_charge'],
						'shipping_comment' => $row['shipping_comment'],
						'payment_method' => $row['payment_method'],
						'payment_method_details' => $payment_method,
						'payment_comment' => $row['payment_comment'],
						'payment_id' => $row['payment_id'],
						'payment_response' => $row['payment_response'],
						'payment_status' => $row['payment_status'],
						'order_status' => $row['order_status'],
						'coupon_id' => $row['coupon_id'],
						'coupon_discount' => $row['coupon_discount'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on'],
						'product_list'	=> $product,
						'shipping_address'	=> $shipping_address,
						'billing_address'	=> $payment_address,
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`order_id`,
				`web_id`,
				`user_id`,
				`price`,
				`discount`,
				`shipping_method`,
				`shipping_charge`,
				`shipping_comment`,
				`payment_method`,
				`payment_comment`,
				`payment_id`,
				`payment_response`,
				`payment_status`,
				`order_status`,
				`coupon_id`,
				`coupon_discount`,
				`created_on`,
				`updated_on`
			 from `tbl_orders`";

		$sql .= " order by created_on DESC";
			 
		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				if (!class_exists('TBL_CUSTOMER')) {
	    			include("../data/TBL_CUSTOMER.php");
				}
	          	$objUsers = new TBL_CUSTOMER();
	          	$user = $objUsers->getdetails($row['user_id']);

				$mainObj[$i] = Array(
						'order_id' => $row['order_id'],
						'web_id' => $row['web_id'],
						'user_id' => $row['user_id'],
						'user' => $user,
						'price' => $row['price'],
						'discount' => $row['discount'],
						'shipping_method' => $row['shipping_method'],
						'shipping_charge' => $row['shipping_charge'],
						'shipping_comment' => $row['shipping_comment'],
						'payment_method' => $row['payment_method'],
						'payment_comment' => $row['payment_comment'],
						'payment_id' => $row['payment_id'],
						'payment_response' => $row['payment_response'],
						'payment_status' => $row['payment_status'],
						'order_status' => $row['order_status'],
						'coupon_id' => $row['coupon_id'],
						'coupon_discount' => $row['coupon_discount'],
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