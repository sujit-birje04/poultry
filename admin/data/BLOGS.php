<?php


if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class BLOGS {

	/* This function will be used to insert new entry in the table */
	public function insert($blog_id,$title,$is_active,$html_short,$html_full,$image,$video,$sort_code,$start_date,$end_date,$type){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `blogs` (`blog_id`,`title`,`is_active`,`html_short`,`html_full`,`image`,`video`,`sort_code`,`start_date`,`end_date`,`created_on`,`updated_on`,`type`) 
					VALUES('$blog_id','$title','$is_active','$html_short','$html_full','$image','$video','$sort_code','$start_date','$end_date',now(),now(),'$type');
				";
		$result = $mysqli->query($insert_query); 			
		$blog_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'blog_id' => $blog_id,
						'title' => $title,
						'is_active' => $is_active,
						'html_short' => $html_short,
						'html_full' => $html_full,
						'image' => $image,
						'video' => $video,
						'sort_code' => $sort_code,
						'start_date' => $start_date,
						'end_date' => $end_date,
						'type' => $type,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($blog_id,$title,$is_active,$html_short,$html_full,$image,$video,$sort_code,$start_date,$end_date,$type){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `blogs` SET 
						`blog_id`='$blog_id',
						`title`='$title',
						`is_active`='$is_active',
						`html_short`='$html_short',
						`html_full`='$html_full',
						`image`='$image',
						`video`='$video',
						`sort_code`='$sort_code',
						`start_date`='$start_date',
						`end_date`='$end_date',
						`type`='$type',
						`updated_on`=now()
					 WHERE blog_id = '$blog_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to update a row in the table */
	public function editImage($blog_id,$image){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `blogs` SET 
						`image`='$image'
					 WHERE blog_id = '$blog_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($blog_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `blogs` WHERE blog_id = '$blog_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($blog_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`blog_id`,
				`title`,
				`is_active`,
				`html_short`,
				`html_full`,
				`image`,
				`video`,
				`sort_code`,
				`start_date`,
				`end_date`,
				`type`,
				`created_on`,
				`updated_on`
			 FROM `blogs` WHERE blog_id = '$blog_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'blog_id' => $row['blog_id'],
						'title' => $row['title'],
						'is_active' => $row['is_active'],
						'html_short' => $row['html_short'],
						'html_full' => $row['html_full'],
						'image' => $row['image'],
						'video' => $row['video'],
						'sort_code' => $row['sort_code'],
						'start_date' => $row['start_date'],
						'end_date' => $row['end_date'],
						'type' => $row['type'],
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
				`blog_id`,
				`title`,
				`is_active`,
				`html_short`,
				`html_full`,
				`image`,
				`video`,
				`sort_code`,
				`start_date`,
				`end_date`,
				`type`,
				`created_on`,
				`updated_on`
			 from `blogs`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(

						'blog_id' => $row['blog_id'],
						'title' => $row['title'],
						'is_active' => $row['is_active'],
						'html_short' => $row['html_short'],
						'html_full' => $row['html_full'],
						'image' => $row['image'],
						'video' => $row['video'],
						'sort_code' => $row['sort_code'],
						'start_date' => $row['start_date'],
						'type' => $row['type'],
						'end_date' => $row['end_date'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']

					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $blog_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `blogs` (`blog_id`,`title`,`is_active`,`html_short`,`html_full`,`image`,`video`,`sort_code`,`start_date`,`end_date`,`created_on`,`updated_on`)
					SELECT 
				`blog_id`,
				`title`,
				`is_active`,
				`html_short`,
				`html_full`,
				`image`,
				`video`,
				`sort_code`,
				`start_date`,
				`end_date`,
				`created_on`,
				`updated_on`
			 FROM `blogs` WHERE blog_id = '$blog_id'
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