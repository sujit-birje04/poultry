<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class APPLICATIONS {

	/* This function will be used to insert new entry in the table */
	public function insert($app_id,$post_id,$name,$sex,$phone,$email,$add,$city,$state,$zip,$qualification,$work_exp,$area_of_interest,$salary,$resume_link){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `applications` (`app_id`,`post_id`,`name`,`sex`,`phone`,`email`,`add`,`city`,`state`,`zip`,`qualification`,`work_exp`,`area_of_interest`,`salary`,`resume_link`,`created_on`,`updated_on`) 
					VALUES('$app_id','$post_id','$name','$sex','$phone','$email','$add','$city','$state','$zip','$qualification','$work_exp','$area_of_interest','$salary','$resume_link',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$app_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'app_id' => $app_id,
						'post_id' => $post_id,
						'name' => $name,
						'sex' => $sex,
						'phone' => $phone,
						'email' => $email,
						'add' => $add,
						'city' => $city,
						'state' => $state,
						'zip' => $zip,
						'qualification' => $qualification,
						'work_exp' => $work_exp,
						'area_of_interest' => $area_of_interest,
						'salary' => $salary,
						'resume_link' => $resume_link,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")

					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($app_id,$post_id,$name,$sex,$phone,$email,$add,$city,$state,$zip,$qualification,$work_exp,$area_of_interest,$salary,$resume_link){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `applications` SET 
						`post_id`='$post_id',
						`name`='$name',
						`sex`='$sex',
						`phone`='$phone',
						`email`='$email',
						`add`='$add',
						`city`='$city',
						`state`='$state',
						`zip`='$zip',
						`qualification`='$qualification',
						`work_exp`='$work_exp',
						`area_of_interest`='$area_of_interest',
						`salary`='$salary',
						`resume_link`='$resume_link',
						`updated_on`=now()
					 WHERE app_id = '$app_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($app_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `applications` WHERE app_id = '$app_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($app_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`app_id`,
				`post_id`,
				`name`,
				`sex`,
				`phone`,
				`email`,
				`add`,
				`city`,
				`state`,
				`zip`,
				`qualification`,
				`work_exp`,
				`area_of_interest`,
				`salary`,
				`resume_link`,
				`created_on`,
				`updated_on`
			 FROM `applications` WHERE app_id = '$app_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'app_id' => $row['app_id'],
						'post_id' => $row['post_id'],
						'name' => $row['name'],
						'sex' => $row['sex'],
						'phone' => $row['phone'],
						'email' => $row['email'],
						'add' => $row['add'],
						'city' => $row['city'],
						'state' => $row['state'],
						'zip' => $row['zip'],
						'qualification' => $row['qualification'],
						'work_exp' => $row['work_exp'],
						'area_of_interest' => $row['area_of_interest'],
						'salary' => $row['salary'],
						'resume_link' => $row['resume_link'],
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
				`app_id`,
				`post_id`,
				`name`,
				`sex`,
				`phone`,
				`email`,
				`add`,
				`city`,
				`state`,
				`zip`,
				`qualification`,
				`work_exp`,
				`area_of_interest`,
				`salary`,
				`resume_link`,
				`created_on`,
				`updated_on`
			 from `applications`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
					
						'app_id' => $row['app_id'],
						'post_id' => $row['post_id'],
						'name' => $row['name'],
						'sex' => $row['sex'],
						'phone' => $row['phone'],
						'email' => $row['email'],
						'add' => $row['add'],
						'city' => $row['city'],
						'state' => $row['state'],
						'zip' => $row['zip'],
						'qualification' => $row['qualification'],
						'work_exp' => $row['work_exp'],
						'area_of_interest' => $row['area_of_interest'],
						'salary' => $row['salary'],
						'resume_link' => $row['resume_link'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $app_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `applications` (`app_id`,`post_id`,`name`,`sex`,`phone`,`email`,`add`,`city`,`state`,`zip`,`qualification`,`work_exp`,`area_of_interest`,`salary`,`resume_link`,`created_on`,`updated_on`)
					SELECT 
				`app_id`,
				`post_id`,
				`name`,
				`sex`,
				`phone`,
				`email`,
				`add`,
				`city`,
				`state`,
				`zip`,
				`qualification`,
				`work_exp`,
				`area_of_interest`,
				`salary`,
				`resume_link`,
				`created_on`,
				`updated_on`
			 FROM `applications` WHERE app_id = '$app_id'
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