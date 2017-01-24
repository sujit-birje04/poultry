<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_PRODUCT_UNIQUE {

	/* This function will be used to insert new entry in the table */
	public function insert($unique_product_id,$product_id,$web_id,$prc_id,$name,$code,$sku,$country_id,$type,$price,$is_active,$image,$short_description,$long_description,$video_link,$video2,$video3,$discount,$model,$color, $sell_on,$alise,$alttag,$sort_order){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_unique` (`unique_product_id`,`product_id`,`web_id`,`prc_id`,`name`,`code`,`sku`,`model`,`color`,`country_id`,`type`,`price`,`is_active`,`image`,`short_description`,`long_description`,`video_link`,`video2`,`video3`,`discount`, `sell_on`, `alise`, `alttag`, `sort_order`,`created_on`,`updated_on`) 
					VALUES('$unique_product_id','$product_id','$web_id','$prc_id','$name','$code','$sku','$model','$color','$country_id','$type','$price','$is_active','$image','$short_description','$long_description','$video_link','$video2','$video3','$discount','$sell_on','$alise','$alttag','$sort_order',now(),now());
				";
				
		$result = $mysqli->query($insert_query); 			
		$unique_product_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'unique_product_id' => $unique_product_id,
						'product_id' => $product_id,
						'web_id' => $web_id,
						'prc_id' => $prc_id,
						'name' => $name,
						'code' => $code,
						'alise' => $alise,
						'alttag' => $alttag,
						'sell_on' => $sell_on,
						'sku' => $sku,
						'country_id' => $country_id,
						'type' => $type,
						'price' => $price,
						'discount' => $discount,
						'is_active' => $is_active,
						'image' => $image,
						'short_description' => $short_description,
						'long_description' => $long_description,
						'video_link' => $video_link,
						'video2' => $video2,
						'video3' => $video3,
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
	public function edit($unique_product_id,$product_id,$web_id,$prc_id,$name,$code,$sku,$country_id,$type,$price,$is_active,$image,$short_description,$long_description,$video_link,$video2,$video3,$discount,$model,$color, $sell_on,$alise,$alttag,$sort_order){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_unique` SET 
						`product_id`='$product_id',
						`web_id`='$web_id',
						`prc_id`='$prc_id',
						`name`='$name',
						`code`='$code',
						`alise`='$alise',
						`alttag`='$alttag',
						`sell_on` = '$sell_on',
						`sku`='$sku',
						`model` = '$model',
						`color` = '$color',
						`country_id`='$country_id',
						`type`='$type',
						`price`='$price',
						`is_active`='$is_active',
						`image`='$image',
						`short_description`='$short_description',
						`long_description`='$long_description',
						`video_link`='$video_link',
						`video2`='$video2',
						`video3`='$video3',
						`discount`='$discount',
						`sort_order`='$sort_order',
						`updated_on`=now()
					 WHERE unique_product_id = '$unique_product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}



	/* This function will be used to update a row in the table */
	public function editAlise($unique_product_id,$alise){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_unique` SET
						`alise`='$alise'
					 WHERE unique_product_id = '$unique_product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to update a row in the table */
	public function editImage($unique_product_id,$image){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_unique` SET
						`image`='$image'
					 WHERE unique_product_id = '$unique_product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	public function changeStatus($product_id,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_unique` SET
						`is_active`='$is_active',
						`updated_on`=now()
					 WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($unique_product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 


      	$objInstance = new TBL_PRODUCT_UNIQUE();
     	$mainObj = $objInstance->getuniquedetails($unique_product_id);
      	$details = $mainObj;

		$update_query = "DELETE FROM `tbl_product_unique` WHERE unique_product_id = '$unique_product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
			
			$product_id = $details['product_id'];
			$web_id = $details['web_id'];
			//Delete speacial Prop	
			$update_query = "DELETE FROM `tbl_product_special_prop_unique` WHERE product_id = '$product_id' and web_id = '$web_id'";
			$result = $mysqli->query($update_query); 			
			//Delete Features	
			$update_query = "DELETE FROM `tbl_product_features_unique` WHERE product_id = '$product_id' and web_id = '$web_id'";
			$result = $mysqli->query($update_query); 			
			//Delete Image
			$update_query = "DELETE FROM `tbl_product_images_unique` WHERE product_id = '$product_id' and web_id = '$web_id'";
			$result = $mysqli->query($update_query); 			
			//Delete Files
			$update_query = "DELETE FROM `tbl_product_files_unique` WHERE product_id = '$product_id' and web_id = '$web_id'";
			$result = $mysqli->query($update_query); 			
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function deleteproduct($p_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_unique` WHERE product_id = '$p_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}

	/* This function will be return row in details from the table */
	public function getdetails($product_id, $web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`sort_order`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_unique` 
			 WHERE product_id = '$product_id' AND web_id = '$web_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					'unique_product_id' => $row['unique_product_id'],
					'product_id' => $row['product_id'],
					'web_id' => $row['web_id'],
					'prc_id' => $row['prc_id'],
					'name' => $row['name'],
					'code' => $row['code'],
					'alise' => $row['alise'],
					'alttag' => $row['alttag'],
					'sell_on' => $row['sell_on'],
					'sku' => $row['sku'],
					'model' => $row['model'],
					'color' => $row['color'],
					'country_id' => $row['country_id'],
					'type' => $row['type'],
					'price' => $row['price'],
					'discount' => $row['discount'],
					'is_active' => $row['is_active'],
					'image' => $row['image'],
					'short_description' => $row['short_description'],
					'long_description' => $row['long_description'],
					'video_link' => $row['video_link'],
					'video2' => $row['video2'],
					'video3' => $row['video3'],
					'sort_order' => $row['sort_order'],
					'created_on' => $row['created_on'],
					'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}

	public function getAliseDetails($alise){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_unique` 
			 WHERE alise = '$alise'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					'unique_product_id' => $row['unique_product_id'],
					'product_id' => $row['product_id'],
					'web_id' => $row['web_id'],
					'prc_id' => $row['prc_id'],
					'name' => $row['name'],
					'code' => $row['code'],
					'alise' => $row['alise'],
					'alttag' => $row['alttag'],
					'sell_on' => $row['sell_on'],
					'sku' => $row['sku'],
					'model' => $row['model'],
					'color' => $row['color'],
					'country_id' => $row['country_id'],
					'type' => $row['type'],
					'price' => $row['price'],
					'discount' => $row['discount'],
					'sort_order' => $row['sort_order'],
					'is_active' => $row['is_active'],
					'image' => $row['image'],
					'short_description' => $row['short_description'],
					'long_description' => $row['long_description'],
					'video_link' => $row['video_link'],
					'video2' => $row['video2'],
					'video3' => $row['video3'],
					'created_on' => $row['created_on'],
					'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}

	/* This function will be return row in details from the table */
	public function getuniquedetails($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`sort_order`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_unique` 
			 WHERE unique_product_id = '$product_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					'unique_product_id' => $row['unique_product_id'],
					'product_id' => $row['product_id'],
					'web_id' => $row['web_id'],
					'prc_id' => $row['prc_id'],
					'name' => $row['name'],
					'code' => $row['code'],
					'alise' => $row['alise'],
					'alttag' => $row['alttag'],
					'sell_on' => $row['sell_on'],
					'sku' => $row['sku'],
					'model' => $row['model'],
					'color' => $row['color'],
					'country_id' => $row['country_id'],
					'type' => $row['type'],
					'price' => $row['price'],
					'discount' => $row['discount'],
					'is_active' => $row['is_active'],
					'sort_order' => $row['sort_order'],
					'image' => $row['image'],
					'short_description' => $row['short_description'],
					'long_description' => $row['long_description'],
					'video_link' => $row['video_link'],
					'video2' => $row['video2'],
					'video3' => $row['video3'],
					'created_on' => $row['created_on'],
					'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($web_id = -1){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`sort_order`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`created_on`,
				`updated_on`
			 from `tbl_product_unique`";
		if($web_id != -1){
			$sql .= " where web_id = '$web_id';";
		}
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'unique_product_id' => $row['unique_product_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'prc_id' => $row['prc_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'alise' => $row['alise'],
						'alttag' => $row['alttag'],
						'sell_on' => $row['sell_on'],
						'sku' => $row['sku'],
						'model' => $row['model'],
						'color' => $row['color'],
						'country_id' => $row['country_id'],
						'type' => $row['type'],
						'price' => $row['price'],
						'discount' => $row['discount'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'image' => $row['image'],
						'short_description' => $row['short_description'],
						'long_description' => $row['long_description'],
						'video_link' => $row['video_link'],
						'video2' => $row['video2'],
						'video3' => $row['video3'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	/* This function will be used to return a list of rows from table */
	public function listdubble(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`sort_order`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`created_on`,
				`updated_on`
			 from `tbl_product_unique`
			 GROUP BY product_id HAVING count(unique_product_id) > 1;";
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'unique_product_id' => $row['unique_product_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'prc_id' => $row['prc_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'alise' => $row['alise'],
						'alttag' => $row['alttag'],
						'sell_on' => $row['sell_on'],
						'sku' => $row['sku'],
						'model' => $row['model'],
						'color' => $row['color'],
						'country_id' => $row['country_id'],
						'type' => $row['type'],
						'price' => $row['price'],
						'discount' => $row['discount'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'image' => $row['image'],
						'short_description' => $row['short_description'],
						'long_description' => $row['long_description'],
						'video_link' => $row['video_link'],
						'video2' => $row['video2'],
						'video3' => $row['video3'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function listallproduct($product_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`unique_product_id`,
				`product_id`,
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`alise`,
				`alttag`,
				`sell_on`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`sort_order`,
				`video3`,
				`created_on`,
				`updated_on`
			 from `tbl_product_unique`
			 where product_id = '$product_id';";
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'unique_product_id' => $row['unique_product_id'],
						'product_id' => $row['product_id'],
						'web_id' => $row['web_id'],
						'prc_id' => $row['prc_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'alise' => $row['alise'],
						'alttag' => $row['alttag'],
						'sell_on' => $row['sell_on'],
						'sku' => $row['sku'],
						'model' => $row['model'],
						'color' => $row['color'],
						'country_id' => $row['country_id'],
						'type' => $row['type'],
						'price' => $row['price'],
						'discount' => $row['discount'],
					    'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'image' => $row['image'],
						'short_description' => $row['short_description'],
						'long_description' => $row['long_description'],
						'video_link' => $row['video_link'],
						'video2' => $row['video2'],
						'video3' => $row['video3'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $unique_product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_unique` (`product_id`,`web_id`,`prc_id`,`name`,`code`,`sku`,`model`,`color`,`country_id`,`type`,`price`,`discount`,`is_active`,`image`,`short_description`,`long_description`,`video_link`,`video2`,`video3`,`sell_on`,`alise`,`alttag`,`created_on`,`updated_on`)
					SELECT 
				'$new_product_id',
				`web_id`,
				`prc_id`,
				`name`,
				`code`,
				`sku`,
				`model`,
				`color`,
				`country_id`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`video2`,
				`video3`,
				`sort_order`
				`sell_on`,
				`alise`,
				`alttag`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_unique` WHERE unique_product_id = '$unique_product_id'
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