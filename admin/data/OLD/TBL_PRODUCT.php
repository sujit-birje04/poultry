<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_PRODUCT {

	/* This function will be used to insert new entry in the table */
	public function insert($product_id,$prc_id,$name,$code,$sku,$country_id,$type,$price,$is_active,$image,$short_description,$long_description,$video_link,$video2,$video3,$discount,$model,$color,$sell_on,$alise,$alttag){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product` (`product_id`,`prc_id`,`name`,`code`,`sku`,`model`,`color`,`country_id`,`type`,`price`,`is_active`,`image`,`short_description`,`long_description`,`video_link`,`video2`,`video3`,`discount`, `sell_on`, `alise`, `alttag`,`created_on`,`updated_on`) 
					VALUES('$product_id','$prc_id','$name','$code','$sku','$model','$color','$country_id','$type','$price','$is_active','$image','$short_description','$long_description','$video_link','$video2','$video3','$discount','$sell_on','$alise','$alttag',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$product_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'product_id' => $product_id,
						'prc_id' => $prc_id,
						'name' => $name,
						'code' => $code,
						'sell_on' => $sell_on,
						'alise' => $alise,
						'alttag' => $alttag,
						'sku' => $sku,
						'model' => $model,
						'color' => $color,
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
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($product_id,$prc_id,$name,$code,$sku,$country_id,$type,$price,$is_active,$image,$short_description,$long_description,$video_link,$video2,$video3,$discount,$model,$color,$sell_on,$alise,$alttag){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product` SET 
						`prc_id`='$prc_id',
						`name`='$name',
						`code`='$code',
						`sell_on`='$sell_on',
						`sku`='$sku',
						`alise`='$alise',
						`alttag`='$alttag',
						`model`='$model',
						`color`='$color',
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
						`updated_on`=now()
					 WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}



	/* This function will be used to update a row in the table */
	public function editAlise($product_id,$alise){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product` SET
						`alise`='$alise',
					 WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to update a row in the table */
	public function editImage($product_id,$image){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product` SET
						`image`='$image'
					 WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to delete a row from the table */
	public function delete($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product` WHERE product_id = '$product_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($product_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`product_id`,
				`prc_id`,
				`name`,
				`code`,
				`sell_on`,
				`alise`,
				`alttag`,
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
				`created_on`,
				`updated_on`
			 FROM `tbl_product` WHERE product_id = '$product_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'product_id' => $row['product_id'],
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
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($search = '', $type='-1', $prc_id='-1', $is_active = '-1', $web_id = '-1',$page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>array());
		$sql = "SELECT 
				`product_id`,
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
				`created_on`,
				`updated_on`
			 from `tbl_product` where 1=1";
		if(!empty($search)){
			$sql .= " and (name LIKE '%".$search."%' OR product_id = '$search') ";
		}
		 if($type != '-1'){
		 	$sql .= " and type = '$type' OR type LIKE '%$type%' ";
		 }
		 if($is_active != '-1'){
		 	$sql .= " and is_active = '$is_active' ";
		 }
		 if($prc_id != '-1'){
		 	$sql .= " and (prc_id = '$prc_id' OR prc_id LIKE '%$prc_id%')";
		 }
		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		//echo $sql;

		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;

	            if (!class_exists('Utility')) {
	              include("../include/utility.php");
	            }
				$websites = Utility::getProductSellOnID($row['product_id']);
				$category_arr = json_decode($row['prc_id']);
				$category_arr = is_array($category_arr) ? $category_arr : array($category_arr); 
				if(in_array($prc_id, $category_arr) || $prc_id == '-1'){
					if(in_array($web_id, $websites) || $web_id == '-1'){
					$mainObj["data"][$i] = Array(
							'product_id' => $row['product_id'],
							'prc_id' => $row['prc_id'],
							'category' => self::getCategoryDetails($row['prc_id']),
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
							'created_on' => $row['created_on'],
							'updated_on' => $row['updated_on']
						);	

					$i++;
					}
				}
			}
		} 	
		return $mainObj;
	}

	public function copyitem($id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product` (`prc_id`,`name`,`code`,`sku`,`model`,`color`,`country_id`,`type`,`price`,`discount`,`is_active`,`image`,`short_description`,`long_description`,`video_link`,`video2`,`video3`,`sell_on`,`alise`,`alttag`,`created_on`,`updated_on`) 
							SELECT 
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
							`sell_on`,
							`alise`,
							`alttag`,
							`created_on`,
							`updated_on`
						 FROM `tbl_product` WHERE product_id = '$id';					
				";
		//echo $insert_query;
		$result = $mysqli->query($insert_query); 			
		if($result){	
			$product_id = $mysqli->insert_id;	
			$mainObj["product_id"] = $product_id;
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}

	public static function getCategoryDetails($category){
		$arr_cat = json_decode($category);
		$arrReturn = array();
		if (!class_exists('TBL_PRODUCT_CATEGORY')) {
			include("../data/TBL_PRODUCT_CATEGORY.php");
		}
		if(!empty($arr_cat)){
		    $objInstance = new TBL_PRODUCT_CATEGORY();
			foreach ($arr_cat as $key => $value) {
				$arrReturn[] = $objInstance->getdetails($value);
			}
		}
		return $arrReturn;
	}


}

?>