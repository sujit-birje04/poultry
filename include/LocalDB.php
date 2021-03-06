<?php

class LocalDB{

	public static function mysqli_configation(){	
		
		/*
		$host_name = "localhost";
		$local_db_user = "root";
		$local_db_password = "root";
		$local_db_name = "multi_website";
		
		$host_name = "localhost";
		$local_db_user = "ovcywrzo_econutrivet";
		$local_db_password = "sujit@123";
		$local_db_name = "ovcywrzo_econutrivet";
		*/
			
		$host_name = "localhost";
		$local_db_user = "ecotechz_multisi";
		$local_db_password = "Toshiba4757";
		$local_db_name = "poultry_farm";
		
		/*
		$host_name = "localhost";
		$local_db_user = "teccrooz_bedmuth";
		$local_db_password = "nN#fevNsh?vQ";
		$local_db_name = "teccrooz_econutrivet";
		*/

		$mysqli = new mysqli($host_name, $local_db_user, $local_db_password, $local_db_name);
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
			return null;
		}
		return $mysqli;
	}

	/*************************************
	**	Product Category details
	*************************************/
	public static function getCategoryDetails($prc_id){
		$mysqli = self::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`prc_id`,
				`parent_cat_id`,
				`name`,
				`image`,
				`sort_order`,
				`note`,
				`is_active`,
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
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}

	/**********************************************************************
	** BLOG RELATED
	**********************************************************************/

	/* This function will be return row in details from the table */
	public static function getBlogDetails($blog_id){
		$mysqli = self::mysqli_configation();
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
	public static function listAllBlogs($type, $page_lower='-1',$page_upper='-1'){ 
		$mysqli = self::mysqli_configation();
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
			 from `blogs` where type = '$type'";

		$sql .= " order by created_on desc;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(

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

	/**********************************************************************
	** BLOG RELATED
	**********************************************************************/

	/*********************************************************************
	*** Enqiory
	**********************************************************************/
	/* This function will be used to insert new entry in the table */
	public static function saveEnquiry($id,$name,$email,$address,$city,$country,$zipcode,$phone,$fax,$comment,$product_name){
		$mysqli = self::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `enquiries` (`id`,`name`,`email`,`address`,`city`,`country`,`zipcode`,`phone`,`fax`,`comment`,`product_name`,`created_on`) 
					VALUES('$id','$name','$email','$address','$city','$country','$zipcode','$phone','$fax','$comment','$product_name',now());
				";
		$result = $mysqli->query($insert_query); 			
		$id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'id' => $id,
						'name' => $name,
						'email' => $email,
						'address' => $address,
						'city' => $city,
						'country' => $country,
						'zipcode' => $zipcode,
						'phone' => $phone,
						'fax' => $fax,
						'product_name' => $product_name,
						'comment' => $comment,
						'created_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/********************************************************************
	** Contact 
	********************************************************************/
	public static function saveContact($id,$name,$email,$phone,$subject,$message){
		$mysqli = self::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `contact_us` (`id`,`name`,`email`,`phone`,`subject`,`message`,`created_on`) 
					VALUES('$id','$name','$email','$phone','$subject','$message',now());
				";
		$result = $mysqli->query($insert_query); 			
		$id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'id' => $id,
						'name' => $name,
						'email' => $email,
						'phone' => $phone,
						'subject' => $subject,
						'message' => $message,
						'created_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/***********************************************************************************
	**** Product related
	***********************************************************************************/
	/* This function will be return row in details from the table */
	public static function getProductDetails($product_alise){
		$mysqli = self::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`product_id`,
				`name`,
				`code`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`alise`,
				`alttag`,
				`created_on`,
				`updated_on`
			 FROM `tbl_product` WHERE alise = '$product_alise'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'product_id' => $row['product_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'type' => $row['type'],
						'price' => $row['price'],
						'discount' => $row['discount'],
						'is_active' => $row['is_active'],
						'image' => $row['image'],
						'short_description' => $row['short_description'],
						'long_description' => $row['long_description'],
						'video_link' => $row['video_link'],
						'alise' => $row['alise'],
						'alttag' => $row['alttag'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public static function listAllProducts(){ 
		$mysqli = self::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`product_id`,
				`name`,
				`code`,
				`type`,
				`price`,
				`discount`,
				`is_active`,
				`image`,
				`short_description`,
				`long_description`,
				`video_link`,
				`alise`,
				`alttag`,
				`created_on`,
				`updated_on`
			 from `tbl_product`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(

						'product_id' => $row['product_id'],
						'name' => $row['name'],
						'code' => $row['code'],
						'type' => $row['type'],
						'price' => $row['price'],
						'discount' => $row['discount'],
						'is_active' => $row['is_active'],
						'image' => $row['image'],
						'short_description' => $row['short_description'],
						'long_description' => $row['long_description'],
						'video_link' => $row['video_link'],
						'alise' => $row['alise'],
						'alttag' => $row['alttag'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}



	/*************************************************************************
	** Save Customer
	*************************************************************************/
	/* This function will be used to insert new entry in the table */
	public static function saveCustomer($user_id,$fname,$lname,$email_id,$mobile,$is_active,$sex,$profile_pic,$username,$password,$phone,$comp_apt,$add1,$add2,$city,$state,$country){
		$mysqli = self::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_customer` (`user_id`,`fname`,`lname`,`email_id`,`mobile`,`is_active`,`sex`,`profile_pic`,`username`,`password`,`phone`,`comp_apt`,`add1`,`add2`,`city`,`state`,`country`,`created_on`,`updated_on`) 
					VALUES('$user_id','$fname','$lname','$email_id','$mobile','$is_active','$sex','$profile_pic','$username','$password','$phone','$comp_apt','$add1','$add2','$city','$state','$country',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$user_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'user_id' => $user_id,
						'fname' => $fname,
						'lname' => $lname,
						'email_id' => $email_id,
						'mobile' => $mobile,
						'is_active' => $is_active,
						'sex' => $sex,
						'profile_pic' => $profile_pic,
						'username' => $username,
						'password' => $password,
						'phone' => $phone,
						'comp_apt' => $comp_apt,
						'add1' => $add1,
						'add2' => $add2,
						'city' => $city,
						'state' => $state,
						'country' => $country,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}



}

?>