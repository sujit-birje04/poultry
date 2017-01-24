<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_PRODUCT_CATEGORY {

	/* This function will be used to insert new entry in the table */
	public function insert($prc_id,$parent_cat_id,$name,$image,$sort_order,$note,$is_active, $publish_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_product_category` (`prc_id`,`parent_cat_id`,`name`,`image`,`sort_order`,`note`,`is_active`, `publish_on`,`created_on`,`updated_on`) 
					VALUES('$prc_id','$parent_cat_id','$name','$image','$sort_order','$note','$is_active','$publish_on',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$prc_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'prc_id' => $prc_id,
						'parent_cat_id' => $parent_cat_id,
						'name' => $name,
						'image' => $image,
						'sort_order' => $sort_order,
						'note' => $note,
						'is_active' => $is_active,
						'publish_on' => $publish_on,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($prc_id,$parent_cat_id,$name,$image,$sort_order,$note,$is_active,$publish_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_category` SET 
						`parent_cat_id`='$parent_cat_id',
						`name`='$name',
						`image`='$image',
						`sort_order`='$sort_order',
						`note`='$note',
						`is_active`='$is_active',
						`publish_on`='$publish_on',
						`updated_on`=now()
					 WHERE prc_id = '$prc_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Category updated successfully';
		}
		return $mainObj;
	}

/* This function will be used to update a row in the table */
	public function editImage($prc_id,$image){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_product_category` SET 
						`image`='$image'
					 WHERE prc_id = '$prc_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Category updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to delete a row from the table */
	public function delete($prc_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_product_category` WHERE prc_id = '$prc_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Category deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($prc_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`prc_id`,
				`parent_cat_id`,
				`name`,
				`image`,
				`sort_order`,
				`note`,
				`is_active`,
				`publish_on`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product_category` WHERE prc_id = '$prc_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'prc_id' => $row['prc_id'],
						'parent_cat_id' => $row['parent_cat_id'],
						'name' => $row['name'],
						'image' => $row['image'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'publish_on' => $row['publish_on'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall($page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`prc_id`,
				`parent_cat_id`,
				`name`,
				`image`,
				`sort_order`,
				`note`,
				`is_active`,
				`publish_on`,
				`created_on`,
				`updated_on`
			 from `tbl_product_category` order by sort_order ASC";
		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		$result = $mysqli->query($sql);
		$objParent = new TBL_PRODUCT_CATEGORY();
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;

			while($row = $result->fetch_assoc()) {
				$parentCatObj = $objParent->getdetails($row['parent_cat_id']);
				$parentCat = $parentCatObj;
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'prc_id' => $row['prc_id'],
						'parent_cat_id' => $row['parent_cat_id'],
						'parent_cat' => $parentCat,
						'name' => $row['name'],
						'image' => $row['image'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'publish_on' => $row['publish_on'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function listallparent(){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`prc_id`,
				`name`,
				`image`,
				`sort_order`,
				`note`,
				`is_active`,
				`publish_on`,
				`created_on`,
				`updated_on`
			 from `tbl_product_category` 
			 where parent_cat_id = 0 order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;

			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'prc_id' => $row['prc_id'],
						'name' => $row['name'],
						'image' => $row['image'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'publish_on' => $row['publish_on'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function listchild($parent_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`prc_id`,
				`name`,
				`parent_cat_id`,
				`image`,
				`sort_order`,
				`note`,
				`is_active`,
				`publish_on`,
				`created_on`,
				`updated_on`
			 from `tbl_product_category` 
			 where parent_cat_id = '$parent_id' order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;

			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'prc_id' => $row['prc_id'],
						'name' => $row['name'],
						'parent_cat_id' => $row['parent_cat_id'],
						'image' => $row['image'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'publish_on' => $row['publish_on'],
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