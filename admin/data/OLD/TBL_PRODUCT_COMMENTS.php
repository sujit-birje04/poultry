<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_PRODUCT_COMMENTS {

	/* This function will be used to insert new entry in the table */
	public function insert($p_comment_id,$product_id,$user_id,$full_name,$email,$dealer,$comment,$is_active,$starts,$web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_comments` (`p_comment_id`,`product_id`,`user_id`,`full_name`,`email`,`dealer`,`comment`,`is_active`,`starts`,`web_id`,`created_on`,`updated_on`) 
					VALUES('$p_comment_id','$product_id','$user_id','$full_name','$email','$dealer','$comment','$is_active','$starts','$web_id',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$p_comment_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'p_comment_id' => $p_comment_id,
						'product_id' => $product_id,
						'user_id' => $user_id,
						'full_name' => $full_name,
						'email' => $email,
						'dealer' => $dealer,
						'comment' => $comment,
						'is_active' => $is_active,
						'starts' => $starts,
						'web_id' => $web_id,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($p_comment_id,$product_id,$user_id,$full_name,$email,$dealer,$comment,$is_active,$starts,$web_id,$created_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_comments` SET 
						`product_id`='$product_id',
						`user_id`='$user_id',
						`full_name`='$full_name',
						`email`='$email',
						`dealer`='$dealer',
						`comment`='$comment',
						`is_active`='$is_active',
						`starts`='$starts',
						`web_id`='$web_id',
						`created_on`='$created_on',
						`updated_on`=now()
					 WHERE p_comment_id = '$p_comment_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($p_comment_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_comments` WHERE p_comment_id = '$p_comment_id'";
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
		$update_query = "DELETE FROM `tbl_product_comments` WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}
	


	/* This function will be return row in details from the table */
	public function getdetails($p_comment_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_comment_id`,
				`product_id`,
				`user_id`,
				`full_name`,
				`email`,
				`dealer`,
				`comment`,
				`is_active`,
				`starts`,
				`web_id`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_comments` WHERE p_comment_id = '$p_comment_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
    			include("../data/TBL_PRODUCT_UNIQUE.php");
	          	$objInstance = new TBL_PRODUCT_UNIQUE();
	          	$product = $objInstance->getuniquedetails($row['product_id']);
				$mainObj = array(
						'p_comment_id' => $row['p_comment_id'],
						'product_id' => $row['product_id'],
						'product' => $product,
						'user_id' => $row['user_id'],
						'comment' => $row['comment'],
						'full_name' => $row['full_name'],
						'email' => $row['email'],
						'dealer' => $row['dealer'],
						'starts' => $row['starts'],
						'web_id' => $row['web_id'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}

	/* This function will be return row in details from the table */
	public function listproduct($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_comment_id`,
				`product_id`,
				`user_id`,
				`full_name`,
				`email`,
				`dealer`,
				`comment`,
				`is_active`,
				`starts`,
				`web_id`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_comments` WHERE product_id = '$product_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			//output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj[] = array(
						'p_comment_id' => $row['p_comment_id'],
						'product_id' => $row['product_id'],
						'user_id' => $row['user_id'],
						'comment' => $row['comment'],
						'full_name' => $row['full_name'],
						'email' => $row['email'],
						'dealer' => $row['dealer'],
						'starts' => $row['starts'],
						'web_id' => $row['web_id'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($ratting, $web_id, $product_id,$is_active, $comment,$page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`p_comment_id`,
				`product_id`,
				`user_id`,
				`full_name`,
				`email`,
				`dealer`,
				`comment`,
				`is_active`,
				`starts`,
				`web_id`,
				`created_on`,
				`updated_on`
			 from `tbl_product_comments` WHERE 1 = 1 ";
		if($ratting != 'all'){
			$sql .= " AND starts = '$ratting' ";
		}
		if($web_id != 'all'){
			$sql .= " AND web_id = '$web_id' ";
		}
		if($product_id != 'all'){
			$sql .= " AND product_id = '$product_id' ";
		}
		if($is_active != 'all'){
			$sql .= " AND is_active = '$is_active' ";
		}
		if($comment != ''){
			$sql .= " AND comment like '%$comment%' ";
		}
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

				if (!class_exists('TBL_PRODUCT_UNIQUE')) {
    			include("../data/TBL_PRODUCT_UNIQUE.php");
				}
	          	$objInstance = new TBL_PRODUCT_UNIQUE();
	          	$product = $objInstance->getuniquedetails($row['product_id']);

				if (!class_exists('TBL_WEBSITE')) {
    			  include("../data/TBL_WEBSITE.php");
				}
	          	$objWeb = new TBL_WEBSITE();
	          	$website = $objWeb->getdetails($row['web_id']);

				$mainObj[$i] = Array(
						'p_comment_id' => $row['p_comment_id'],
						'product_id' => $row['product_id'],
						'product' => $product,
						'user_id' => $row['user_id'],
						'comment' => $row['comment'],
						'full_name' => $row['full_name'],
						'email' => $row['email'],
						'dealer' => $row['dealer'],
						'starts' => $row['starts'],
						'web_id' => $row['web_id'],
						'website' => $website,
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $p_comment_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_comments` (`product_id`,`user_id`,`full_name`,`email`,`dealer`,`comment`,`is_active`,`starts`,`web_id`,`created_on`,`updated_on`)
					SELECT 
				'$new_product_id',
				`user_id`,
				`full_name`,
				`email`,
				`dealer`,
				`comment`,
				`is_active`,
				`starts`,
				`web_id`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_comments` WHERE p_comment_id = '$p_comment_id'
					";
		//echo $insert_query;
		$result = $mysqli->query($insert_query); 			
		if($result){	
			$id = $mysqli->insert_id;	
			$mainObj["id"] = $id;
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
			//$sql = "update tbl_product_comments set product_id = "
		}
		return $mainObj;
	}


}

?>