<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class TBL_ARTICLE_CATEGORY {

	/* This function will be used to insert new entry in the table */
	public function insert($ac_id,$title,$description,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_article_category` (`ac_id`,`title`,`description`,`is_active`,`created_on`,`updated_on`) 
					VALUES('$ac_id','$title','$description','$is_active',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$ac_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'ac_id' => $ac_id,
						'title' => $title,
						'description' => $description,
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
	public function edit($ac_id,$title,$description,$is_active){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_article_category` SET 
						`title`='$title',
						`description`='$description',
						`is_active`='$is_active',
						`updated_on`=now()
					 WHERE ac_id = '$ac_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($ac_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_article_category` WHERE ac_id = '$ac_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($ac_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ac_id`,
				`title`,
				`description`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `tbl_article_category` WHERE ac_id = '$ac_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'ac_id' => $row['ac_id'],
						'title' => $row['title'],
						'description' => $row['description'],
						'is_active' => $row['is_active'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listallactive(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`ac_id`,
				`title`,
				`description`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_article_category`
			 WHERE is_active = 1;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'ac_id' => $row['ac_id'],
						'title' => $row['title'],
						'description' => $row['description'],
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
	public function listall(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`ac_id`,
				`title`,
				`description`,
				`is_active`,
				`created_on`,
				`updated_on`
			 from `tbl_article_category`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'ac_id' => $row['ac_id'],
						'title' => $row['title'],
						'description' => $row['description'],
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