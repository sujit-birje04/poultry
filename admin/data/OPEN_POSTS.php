<?php


if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class OPEN_POSTS {

	/* This function will be used to insert new entry in the table */
	public function insert($post_id,$title,$description,$min_exp,$max_exp,$is_active,$job_location, $division){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `open_posts` (`post_id`,`title`,`description`,`min_exp`,`max_exp`,`is_active`,`job_location`,`division`,`created_on`,`updated_on`) 
					VALUES('$post_id','$title','$description','$min_exp','$max_exp','$is_active','$job_location','$division',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$post_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'post_id' => $post_id,
						'title' => $title,
						'description' => $description,
						'min_exp' => $min_exp,
						'max_exp' => $max_exp,
						'is_active' => $is_active,
						'job_location' => $job_location,
						'division' => $division,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($post_id,$title,$description,$min_exp,$max_exp,$is_active,$job_location,$division){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `open_posts` SET 
						`title`='$title',
						`description`='$description',
						`min_exp`='$min_exp',
						`max_exp`='$max_exp',
						`is_active`='$is_active',
						`job_location`='$job_location',
						`division`='$division',
						`updated_on`=now()
					 WHERE post_id = '$post_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($post_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `open_posts` WHERE post_id = '$post_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($post_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`post_id`,
				`title`,
				`description`,
				`min_exp`,
				`max_exp`,
				`is_active`,
				`job_location`,
				`division`,
				`created_on`,
				`updated_on`
			 FROM `open_posts` WHERE post_id = '$post_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'post_id' => $row['post_id'],
						'title' => $row['title'],
						'description' => $row['description'],
						'min_exp' => $row['min_exp'],
						'max_exp' => $row['max_exp'],
						'is_active' => $row['is_active'],
						'job_location' => $row['job_location'],
						'division' => $row['division'],
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
				`post_id`,
				`title`,
				`description`,
				`min_exp`,
				`max_exp`,
				`is_active`,
				`job_location`,
				`division`,
				`created_on`,
				`updated_on`
			 from `open_posts`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'post_id' => $row['post_id'],
						'title' => $row['title'],
						'description' => $row['description'],
						'min_exp' => $row['min_exp'],
						'max_exp' => $row['max_exp'],
						'is_active' => $row['is_active'],
						'job_location' => $row['job_location'],
						'division' => $row['division'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $post_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `open_posts` (`post_id`,`title`,`description`,`min_exp`,`max_exp`,`is_active`,`created_on`,`updated_on`)
					SELECT 
				`post_id`,
				`title`,
				`description`,
				`min_exp`,
				`max_exp`,
				`is_active`,
				`created_on`,
				`updated_on`
			 FROM `open_posts` WHERE post_id = '$post_id'
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