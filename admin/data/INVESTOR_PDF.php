<?php

if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class INVESTOR_PDF {

	/* This function will be used to insert new entry in the table */
	public function insert($pdf_id,$cat_id,$pdf_name,$pdf_path,$from_year,$to_year){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `investor_pdf` (`pdf_id`,`cat_id`,`pdf_name`,`pdf_path`,`from_year`,`to_year`,`created_on`,`updated_on`) 
					VALUES('$pdf_id','$cat_id','$pdf_name','$pdf_path','$from_year','$to_year',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$pdf_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'pdf_id' => $pdf_id,
						'cat_id' => $cat_id,
						'pdf_name' => $pdf_name,
						'pdf_path' => $pdf_path,
						'from_year' => $from_year,
						'to_year' => $to_year,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($pdf_id,$cat_id,$pdf_name,$pdf_path,$from_year,$to_year){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `investor_pdf` SET 
						`cat_id`='$cat_id',
						`pdf_name`='$pdf_name',
						`pdf_path`='$pdf_path',
						`from_year`='$from_year',
						`to_year`='$to_year',
						`updated_on`=now()
					 WHERE pdf_id = '$pdf_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($pdf_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `investor_pdf` WHERE pdf_id = '$pdf_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($pdf_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`pdf_id`,
				`cat_id`,
				`pdf_name`,
				`pdf_path`,
				`from_year`,
				`to_year`,
				`created_on`,
				`updated_on`
			 FROM `investor_pdf` WHERE pdf_id = '$pdf_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'pdf_id' => $row['pdf_id'],
						'cat_id' => $row['cat_id'],
						'pdf_name' => $row['pdf_name'],
						'pdf_path' => $row['pdf_path'],
						'from_year' => $row['from_year'],
						'to_year' => $row['to_year'],
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
				`pdf_id`,
				`cat_id`,
				`pdf_name`,
				`pdf_path`,
				`from_year`,
				`to_year`,
				`created_on`,
				`updated_on`
			 from `investor_pdf`";

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
						'pdf_id' => $row['pdf_id'],
						'cat_id' => $row['cat_id'],
						'pdf_name' => $row['pdf_name'],
						'pdf_path' => $row['pdf_path'],
						'from_year' => $row['from_year'],
						'to_year' => $row['to_year'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function copyitem($new_product_id, $pdf_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Duplication failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `investor_pdf` (`pdf_id`,`cat_id`,`pdf_name`,`pdf_path`,`created_on`,`updated_on`)
					SELECT 
				`pdf_id`,
				`cat_id`,
				`pdf_name`,
				`pdf_path`,
				`created_on`,
				`updated_on`
			 FROM `investor_pdf` WHERE pdf_id = '$pdf_id'
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