<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}
	
class TBL_ARTICLE_PUBLISHED {

	/* This function will be used to insert new entry in the table */
	public function insert($ap_id,$a_id,$web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_article_published` (`ap_id`,`a_id`,`web_id`,`created_on`,`updated_on`) 
					VALUES('$ap_id','$a_id','$web_id','now()','now()');
				";
		$result = $mysqli->query($insert_query); 			
		$ap_id = $mysqli->insert_id;

		if($result){			
			$mainObj["data"] = array(
						'ap_id' => $ap_id,
						'a_id' => $a_id,
						'web_id' => $web_id,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($ap_id,$a_id,$web_id,$created_on,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_article_published` SET 
						`ap_id`='ap_id',
						`a_id`='a_id',
						`web_id`='web_id',
						`created_on`='created_on',
						`updated_on`='updated_on'
					 WHERE ap_id = '$ap_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($ap_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_article_published` WHERE ap_id = '$ap_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function unpublish($a_id, $web_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_article_published` WHERE a_id = '$a_id' and web_id = '$web_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($ap_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ap_id`,
				`a_id`,
				`web_id`,
				`created_on`,
				`updated_on`
			 FROM `tbl_article_published` WHERE ap_id = '$ap_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row

			include("../data/TBL_ARTICLE.php");
			include("../data/TBL_WEBSITE.php");
			$objArticle = new TBL_ARTICLE();
			$objWebsite = new TBL_WEBSITE();
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
					
						'ap_id' => $row['ap_id'],
						'article' => $objArticle->getdetails($row['a_id']),
						'website' => $objWebsite->getdetails($row['web_id']),
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listallactive($web_id="-1",$cat_id="-1",$a_id=""){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>array());
		$sql = "SELECT 
				`ap_id`,
				`a_id`,
				`web_id`,
				`created_on`,
				`updated_on`
			 from `tbl_article_published` where 1=1 ";
			
		 if($web_id != '-1'){
		 	$sql .= " and web_id = '$web_id'";
		 }
		 if($cat_id != '-1'){
		 	$sql .= " and a_id in (SELECT `a_id` FROM `tbl_article` WHERE ac_id = '$cat_id')";
		 }
		 if($a_id != ''){
		 	$sql .= " and a_id = '$a_id'";
		 }
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			include("../data/TBL_ARTICLE.php");
			include("../data/TBL_WEBSITE.php");
			$objArticle = new TBL_ARTICLE();
			$objWebsite = new TBL_WEBSITE();
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						
						'ap_id' => $row['ap_id'],
						'article' => $objArticle->getdetails($row['a_id']),
						'website' => $objWebsite->getdetails($row['web_id']),
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listwebsites($a_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`ap_id`,
				`a_id`,
				`web_id`,
				`created_on`,
				`updated_on`
			 from `tbl_article_published`
			 Where a_id = '$a_id';";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = $row["web_id"];	
				$i++;
			}
		} 	
		return $mainObj;
	}

	public function articlewebsites($a_id){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "
			SELECT ap.ap_id, w.name, ap.a_id, 
				   ap.web_id, ap.created_on, ap.updated_on 
				   from tbl_article_published ap  JOIN  tbl_website w on w.web_id = ap.web_id 
				   Where ap.a_id = '$a_id'
		";
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = array(
							'web_id' => $row["web_id"],
							'name' => $row["name"]
							);	
				$i++;
			}
		} 	
		return $mainObj;
	}

}

?>