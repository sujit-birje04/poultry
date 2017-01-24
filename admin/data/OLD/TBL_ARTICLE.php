<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}

class TBL_ARTICLE {

	/* This function will be used to insert new entry in the table */
	public function insert($a_id,$ac_id,$title,$note,$is_active,$is_featured,$html_content_short,$html_content,$image,$video){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Article insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_article` (`a_id`,`ac_id`,`title`,`note`,`is_active`,`is_featured`,`html_content_short`,`html_content`, `image`, `video`,`created_on`,`updated_on`) 
					VALUES('$a_id','$ac_id','$title','$note','$is_active','$is_featured','$html_content_short','$html_content', '$image', '$video',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$a_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'a_id' => $a_id,
						'ac_id' => $ac_id,
						'title' => $title,
						'note' => $note,
						'is_active' => $is_active,
						'is_featured' => $is_featured,
						'html_content_short' => $html_content_short,
						'html_content' => $html_content,
						'image' => $image,
						'video' => $video,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Article inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($a_id,$ac_id,$title,$note,$is_active,$is_featured,$html_content_short,$html_content,$image,$video,$updated_on){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_article` SET 
						`ac_id`='$ac_id',
						`title`='$title',
						`note`='$note',
						`is_active`='$is_active',
						`is_featured`='$is_featured',
						`html_content`='$html_content',
						`html_content_short`='$html_content_short',
						`image`='$image',
						`video`='$video',
						`updated_on`='$updated_on'
					 WHERE a_id = '$a_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}

	/* This function will be used to update a row in the table */
	public function editImage($a_id,$image){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_article` SET 
						`image`='$image'
					 WHERE a_id = '$a_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($a_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_article` WHERE a_id = '$a_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($a_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`a_id`,
				`ac_id`,
				`title`,
				`note`,
				`is_active`,
				`is_featured`,
				`html_content_short`,
				`html_content`,
				`image`,
				`video`,
				`created_on`,
				`updated_on`
			 FROM `tbl_article` WHERE a_id = '$a_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			if (!class_exists('TBL_ARTICLE_CATEGORY')) {
				include("../data/TBL_ARTICLE_CATEGORY.php");
			}

			$objArticleCat = new TBL_ARTICLE_CATEGORY();

			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'a_id' => $row['a_id'],
						'category' => $objArticleCat->getdetails($row['ac_id']),
						'title' => $row['title'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'is_featured' => $row['is_featured'],
						'html_content_short' => $row['html_content_short'],
						'html_content' => $row['html_content'],
						'image' => $row['image'],
						'video' => $row['video'],
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
				`a_id`,
				`ac_id`,
				`title`,
				`note`,
				`is_active`,
				`is_featured`,
				`html_content`,
				`image`,
				`video`,
				`html_content_short`,
				`created_on`,
				`updated_on`
			 from `tbl_article`;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			if (!class_exists('TBL_ARTICLE_CATEGORY')) {
				include("../data/TBL_ARTICLE_CATEGORY.php");
			}

			$objArticleCat = new TBL_ARTICLE_CATEGORY();
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'a_id' => $row['a_id'],
						'category' => $objArticleCat->getdetails($row['ac_id']),
						'title' => $row['title'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'is_featured' => $row['is_featured'],
						'html_content' => $row['html_content'],
						'image' => $row['image'],
						'video' => $row['video'],
						'html_content_short' => $row['html_content_short'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function listallarticles($cat_id="-1",$a_id="", $web_id = '-1', $is_active = '-1',$page_lower='-1',$page_upper='-1'){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = array();
		$sql = "SELECT 
				`a_id`,
				`ac_id`,
				`title`,
				`note`,
				`is_active`,
				`is_featured`,
				`html_content`,
				`image`,
				`video`,
				`html_content_short`,
				`created_on`,
				`updated_on`
			 from `tbl_article` Where 1 = 1 ";
		
		 if($web_id != '-1'){
		 	if($web_id == '-2'){
		  		$sql.=" and a_id not in (select a_id from tbl_article_published where 1 = 1 )";
		 	} else {
		 		$sql.=" and a_id in (select a_id from tbl_article_published where web_id = '$web_id' )";
		 	}
		 }
		 if($cat_id != '-1'){
		 	$sql .= " and ac_id = '$cat_id'";
		 }
		 if($is_active != '-1'){
		 	$sql .= " and is_active = '$is_active'";
		 }
		 if($a_id != ''){
		 	$sql .= " and (a_id = '$a_id' OR title LIKE '%$a_id%') ";
		 }
		  
		if($page_upper != '-1'){
			$sql .= " Limit $page_lower, $page_upper ";
		}
		 //echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			if (!class_exists('TBL_ARTICLE_CATEGORY')) {
				include("../data/TBL_ARTICLE_CATEGORY.php");
			}
			$objArticleCat = new TBL_ARTICLE_CATEGORY();

			//
			if (!class_exists('TBL_ARTICLE_PUBLISHED')) {
				include("../data/TBL_ARTICLE_PUBLISHED.php");
			}
			$objArticleWeb = new TBL_ARTICLE_PUBLISHED();

			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'a_id' => $row['a_id'],
						'category' => $objArticleCat->getdetails($row['ac_id']),
						'websites' => $objArticleWeb->articlewebsites($row['a_id']),
						'title' => $row['title'],
						'note' => $row['note'],
						'is_active' => $row['is_active'],
						'is_featured' => $row['is_featured'],
						'html_content' => $row['html_content'],
						'image' => $row['image'],
						'video' => $row['video'],
						'html_content_short' => $row['html_content_short'],
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