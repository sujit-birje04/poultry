<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_DEALER {

	/* This function will be used to insert new entry in the table */
	
	public function insert($dealer_id,$dealer_name,$dealer_address,$dealer_zipcode,$publish_on,$dealer_city,$dealer_state,$dealer_phone,$dealer_fax,$dealer_email,$dealer_hour,$del_is_active,$dealer_sort,$dealer_website){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");
		$date=date('Y-m-d');
		$adderess=$dealer_address;
		$geocodeFromAddr='http://maps.googleapis.com/maps/api/geocode/json?address='.$dealer_zipcode.'&sensor=false';
                   $output = json_decode($geocodeFromAddr);
                   $ch = curl_init();
                   curl_setopt($ch, CURLOPT_URL, $geocodeFromAddr);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                   curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                   $response = curl_exec($ch);
                   curl_close($ch);
                   $output = json_decode($response);

              $latitude=  $data['latitude']  = $output->results[0]->geometry->location->lat; 
              $longitude=$data['longitude'] = $output->results[0]->geometry->location->lng;		 
		$insert_query = "INSERT INTO `tbl_dealer` (`dealer_id`,`name`,`address`,`zipcode`,`website_id`,`latitude`,`longitude`,`City`,`State`,`phone_number`,`fax`,`email`,`working_hours`,`status`,`create_date`,`sort_order`,`dealer_website`) 
					VALUES('$dealer_id','$dealer_name','$dealer_address','$dealer_zipcode','$publish_on','$latitude','$longitude','$dealer_city','$dealer_state','$dealer_phone','$dealer_fax','$dealer_email','$dealer_hour','$del_is_active','$date','$dealer_sort','$dealer_website');
				";
				
		$result = $mysqli->query($insert_query); 			
		$prc_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'dealer_id' => $dealer_id,
						'dealer_name' => $dealer_name,
						'dealer_address' => $dealer_address,
						'dealer_zipcode' => $dealer_zipcode,
						'website_id' => $publish_on,
						'dealer_city'=>$dealer_city,
						'dealer_state'=>$dealer_state,
						'dealer_phone'=>$dealer_phone,
						'dealer_fax'=>$dealer_fax,
						'dealer_email'=>$dealer_email,
						'dealer_hour'=>$dealer_hour,
						'del_is_active'=>$del_is_active,
						'dealer_sort'=>$dealer_sort,
						'dealer_website'=>$dealer_website
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}
     
     public function edit($dealer_id,$dealer_name,$dealer_address,$dealer_zipcode,$publish_on,$dealer_city,$dealer_state,$dealer_phone,$dealer_fax,$dealer_email,$dealer_hour,$del_is_active,$dealer_sort,$dealer_website){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");
		$date=date('Y-m-d');
		$geocodeFromAddr='http://maps.googleapis.com/maps/api/geocode/json?address='.$dealer_zipcode.'&sensor=false';
                   $output = json_decode($geocodeFromAddr);
                   $ch = curl_init();
                   curl_setopt($ch, CURLOPT_URL, $geocodeFromAddr);
                   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                   curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                   $response = curl_exec($ch);
                   curl_close($ch);
                   $output = json_decode($response);

              $latitude=  $data['latitude']  = $output->results[0]->geometry->location->lat; 
              $longitude=$data['longitude'] = $output->results[0]->geometry->location->lng;		 
				 
		$update_query = "UPDATE `tbl_dealer` set `name`='$dealer_name',`address`='$dealer_address',`zipcode`='$dealer_zipcode',`website_id`='$publish_on',`latitude`='$latitude',`longitude`='$longitude',`City`='$dealer_city',`State`='$dealer_state',`phone_number`='$dealer_phone',`fax`='$dealer_fax',`email`='$dealer_email',`working_hours`='$dealer_hour',`status`='$del_is_active',`sort_order`='$dealer_sort',`dealer_website`='$dealer_website' where `dealer_id`='$dealer_id'";
					
				
		$result = $mysqli->query($update_query); 			
		
		if($result){			
			$mainObj["data"] = array(
						'dealer_id' => $dealer_id,
						'dealer_name' => $dealer_name,
						'dealer_address' => $dealer_address,
						'dealer_zipcode' => $dealer_zipcode,
						'website_id' => $publish_on,
						'dealer_city'=>$dealer_city,
						'dealer_state'=>$dealer_state,
						'dealer_phone'=>$dealer_phone,
						'dealer_fax'=>$dealer_fax,
						'dealer_email'=>$dealer_email,
						'dealer_hour'=>$dealer_hour,
						'del_is_active'=>$del_is_active,
						'dealer_sort'=>$dealer_sort,
						'dealer_website'=>$dealer_website
						
					);
			$mainObj['status'] = true;

			$mainObj['msg'] = 'Dealer updated successfully';
		}
		return $mainObj;
	}   
	 
	 public function delete($dealer_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_dealer` WHERE dealer_id = '$dealer_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Dealer deleted successfully';
		}
		return $mainObj;
	}

	public function listallretail($web_id='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Websites not found", "data"=>"");
		$sql = "SELECT 
				*
			 from `tbl_dealer`
			 ";
			 if($web_id != '-1'){
		 	$sql .= " where website_id = '$web_id' ";
		 }
		 $sql.= "ORDER BY sort_order ASC"; 
		 //echo $website_id;
		 //echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'dealer_id' => $row['dealer_id'],
						'name' => $row['name'],
						'address' => $row['address'],
						'zipcode' => $row['zipcode'],
						'City' =>$row['City'],
						'State' => $row['State'],
						'phone_number'=>$row['phone_number'],
						'fax' =>$row['fax'],
						'email'=>$row['email'],
						'working_hours'=>$row['working_hours'],
						'sort_order'=>$row['sort_order'],
						'is_active'=>$row['status'],
						'dealer_website'=>$row['dealer_website']
						
					);	
				$i++;
			}
		} 	
		return $mainObj;
	}
     
     public function getdetails($dealer_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Websites not found", "data"=>"");
		$sql = "SELECT 
				*
			 from `tbl_dealer` where dealer_id='$dealer_id'
			 ";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj = Array(
						'dealer_id' => $row['dealer_id'],
						'name' => $row['name'],
						'address' => $row['address'],
						'zipcode' => $row['zipcode'],
						'website_id'=>$row['website_id'],
						'City' =>$row['City'],
						'State' => $row['State'],
						'phone_number'=>$row['phone_number'],
						'fax' =>$row['fax'],
						'email'=>$row['email'],
						'working_hours'=>$row['working_hours'],
						'sort_order'=>$row['sort_order'],
						'is_active'=>$row['status'],
						'dealer_website'=>$row['dealer_website']
					);	
				
			}
		} 	
		return $mainObj;
	}


}
	?>