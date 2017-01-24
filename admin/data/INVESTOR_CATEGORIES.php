<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class INVESTOR_CATEGORIES {

	/* This function will be used to insert new entry in the table */
	public function insert($cat_id,$category_name){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `investor_categories` (`cat_id`,`category_name`,`created_on`,`updated_on`) 
					VALUES('$cat_id','$category_name',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$cat_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'cat_id' => $cat_id,
						'category_name' => $category_name,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($cat_id,$category_name){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `investor_categories` SET 
						`category_name`='$category_name',
						`updated_on`=now()
					 WHERE cat_id = '$cat_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($cat_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `investor_categories` WHERE cat_id = '$cat_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($cat_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`cat_id`,
				`category_name`,
				`created_on`,
				`updated_on`
			 FROM `investor_categories` WHERE cat_id = '$cat_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'cat_id' => $row['cat_id'],
						'category_name' => $row['category_name'],
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
				`cat_id`,
				`category_name`,
				`created_on`,
				`updated_on`
			 from `investor_categories`";

		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'cat_id' => $row['cat_id'],
						'category_name' => $row['category_name'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $cat_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `investor_categories` (`cat_id`,`category_name`,`created_on`,`updated_on`)
					SELECT 
				`cat_id`,
				`category_name`,
				`created_on`,
				`updated_on`
			 FROM `investor_categories` WHERE cat_id = '$cat_id'
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