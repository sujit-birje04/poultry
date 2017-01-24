<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class TBL_PARENT_CATEGORY {

	/* This function will be used to insert new entry in the table */
	public function insert($parent_cat_id,$name,$sort_order,$note,$is_active,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_parent_category` (`parent_cat_id`,`name`,`sort_order`,`note`,`is_active`,`created_on`,`updated_on`) 
					VALUES('$parent_cat_id','$name','$sort_order','$note','$is_active','$created_on','$updated_on');
				";
		$result = $mysqli->query($insert_query); 			
		$parent_cat_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'parent_cat_id' => $parent_cat_id,
						'name' => $name,
						'sort_order' => $sort_order,
						'note' => $note,
						'is_active' => $is_active,
						'created_on' => $created_on,
						'updated_on' => $updated_on
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($parent_cat_id,$name,$sort_order,$note,$is_active,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_parent_category` SET 
						`name`='name',
						`sort_order`='sort_order',
						`note`='note',
						`is_active`='is_active',
						`updated_on`='now()'
					 WHERE parent_cat_id = '$parent_cat_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($parent_cat_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_parent_category` WHERE parent_cat_id = '$parent_cat_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($parent_cat_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`parent_cat_id`,
				`name`,
				`sort_order`,
				`note`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `tbl_parent_category` WHERE parent_cat_id = '$parent_cat_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'parent_cat_id' => $row['parent_cat_id'],
						'name' => $row['name'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
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
				`parent_cat_id`,
				`name`,
				`sort_order`,
				`note`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_parent_category` order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'parent_cat_id' => $row['parent_cat_id'],
						'name' => $row['name'],
						'sort_order' => $row['sort_order'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
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