<?php
if (!class_exists('Configuration')) {
	include("../config/database.php");
}


class TBL_MENUS {

	/* This function will be used to insert new entry in the table */
	public function insert($menu_id,$name,$web_id,$parent_menu_id,$target,$sort_order,$is_active,$menu_type,$unique_prop,$unique_prop2){
		$mysqli = Configuration::mysqli_configation();
		$name = mysqli_real_escape_string($mysqli, $name);
		$mainObj = Array("status"=>false, "msg"=>"Insertion failed, Please try one more time");		 		 
		$insert_query = "INSERT INTO `tbl_menus` (`menu_id`,`name`,`web_id`,`parent_menu_id`,`target`,`sort_order`,`is_active`,`menu_type`,`unique_prop`,`unique_prop2`,`created_on`,`updated_on`) 
					VALUES('$menu_id','$name','$web_id','$parent_menu_id','$target','$sort_order','$is_active','$menu_type','$unique_prop','$unique_prop2',now(),now());
				";
		$result = $mysqli->query($insert_query); 			
		$menu_id = $mysqli->insert_id;
		if($result){			
			$mainObj["data"] = array(
						'menu_id' => $menu_id,
						'name' => $name,
						'web_id' => $web_id,
						'parent_menu_id' => $parent_menu_id,
						'target' => $target,
						'sort_order' => $sort_order,
						'is_active' => $is_active,
						'menu_type' => $menu_type,
						'unique_prop' => $unique_prop,
						'unique_prop2' => $unique_prop2,
						'created_on' => date("Y-m-d h:i:s"),
						'updated_on' => date("Y-m-d h:i:s")
					);
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Inserted successfully';
		}
		return $mainObj;
	}


	/* This function will be used to update a row in the table */
	public function edit($menu_id,$name,$web_id,$parent_menu_id,$target,$sort_order,$is_active,$menu_type,$unique_prop,$unique_prop2){
		$mysqli = Configuration::mysqli_configation();
		$name = mysqli_real_escape_string($mysqli, $name);
		$mainObj = Array("status"=>false, "msg"=>"Updation failed, Please try one more time");		 		 
		$update_query = "UPDATE `tbl_menus` SET 
						`name`='$name',
						`web_id`='$web_id',
						`parent_menu_id`='$parent_menu_id',
						`target`='$target',
						`sort_order`='$sort_order',
						`is_active`='$is_active',
						`menu_type`='$menu_type',
						`unique_prop`='$unique_prop',
						`unique_prop2`='$unique_prop2',
						`updated_on`=now()
					 WHERE menu_id = '$menu_id'";
					 
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Updated successfully';
		}
		return $mainObj;
	}


	/* This function will be used to delete a row from the table */
	public function delete($menu_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Deleting failed, Please try one more time");		 		 
		$update_query = "DELETE FROM `tbl_menus` WHERE menu_id = '$menu_id'";
		$result = $mysqli->query($update_query); 			
		if($result){			
			$mainObj['status'] = true;
			$mainObj['msg'] = 'Deleted successfully';
		}
		return $mainObj;
	}


	/* This function will be return row in details from the table */
	public function getdetails($menu_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`menu_id`,
				`name`,
				`web_id`,
				`parent_menu_id`,
				`target`,
				`sort_order`,
				`is_active`,
				`menu_type`,
				`unique_prop`,
				`unique_prop2`,
				`created_on`,
				`updated_on`
			 FROM `tbl_menus` WHERE menu_id = '$menu_id'";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$mainObj = array(
						'menu_id' => $row['menu_id'],
						'name' => $row['name'],
						'web_id' => $row['web_id'],
						'parent_menu_id' => $row['parent_menu_id'],
						'target' => $row['target'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'menu_type' => $row['menu_type'],
						'unique_prop' => $row['unique_prop'],
						'unique_prop2' => $row['unique_prop2'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
			}
		} 	
		return $mainObj;
	}


	/* This function will be used to return a list of rows from table */
	public function listall(){ 
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array("status"=>false, "msg"=>"Cities not found", "data"=>"");
		$sql = "SELECT 
				`menu_id`,
				`name`,
				`web_id`,
				`parent_menu_id`,
				`target`,
				`sort_order`,
				`is_active`,
				`menu_type`,
				`unique_prop`,
				`unique_prop2`,
				`created_on`,
				`updated_on`
			 from `tbl_menus` order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj["status"] = true;
				$mainObj["data"][$i] = Array(
						'menu_id' => $row['menu_id'],
						'name' => $row['name'],
						'web_id' => $row['web_id'],
						'parent_menu_id' => $row['parent_menu_id'],
						'target' => $row['target'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'menu_type' => $row['menu_type'],
						'unique_prop' => $row['unique_prop'],
						'unique_prop2' => $row['unique_prop2'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}

	public function listchild($parent_menu_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`menu_id`,
				`name`,
				`web_id`,
				`parent_menu_id`,
				`target`,
				`sort_order`,
				`is_active`,
				`menu_type`,
				`unique_prop`,
				`unique_prop2`,
				`created_on`,
				`updated_on`
			 from `tbl_menus`
			 where parent_menu_id = '$parent_menu_id'  order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {
				$mainObj[$i] = Array(
						'menu_id' => $row['menu_id'],
						'name' => $row['name'],
						'web_id' => $row['web_id'],
						'parent_menu_id' => $row['parent_menu_id'],
						'target' => $row['target'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'menu_type' => $row['menu_type'],
						'unique_prop' => $row['unique_prop'],
						'unique_prop2' => $row['unique_prop2'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$i++;
			}
		} 	
		return $mainObj;
	}


	public function listallparent($web_id, $menu_type='-1', $is_active = '-1', $menu_search = '-1', $page_lower='-1', $page_upper='-1'){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`menu_id`,
				`name`,
				`web_id`,
				`parent_menu_id`,
				`target`,
				`sort_order`,
				`is_active`,
				`menu_type`,
				`unique_prop`,
				`unique_prop2`,
				`created_on`,
				`updated_on`
			 from `tbl_menus` where 1 = 1 ";
		
		$menu_search = mysqli_real_escape_string($mysqli, $menu_search);
		if($web_id != -1){
			$sql .= " AND web_id = '$web_id'";  
		}
		
		if($menu_type != -1){
			$sql .= " AND menu_type = '$menu_type'";  
		}

		if($is_active != -1){
			$sql .= " AND is_active = '$is_active'";  
		}
		if($menu_search != -1){
			$sql .= " AND ( menu_id = '$menu_search' OR name LIKE '%$menu_search%' ) ";  
		}

		$sql .= " ORDER BY sort_order ASC;";
		//echo $sql;
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {

				if (!class_exists('TBL_WEBSITE')) {
	    			include("../data/TBL_WEBSITE.php");
				}
	          	$objUsers = new TBL_WEBSITE();
	          	$website = $objUsers->getdetails($row['web_id']);

				$mainObj[$i] = Array(
						'menu_id' => $row['menu_id'],
						'name' => $row['name'],
						'web_id' => $row['web_id'],
						'website' => $website,
						'parent_menu_id' => $row['parent_menu_id'],
						'target' => $row['target'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'menu_type' => $row['menu_type'],
						'unique_prop' => $row['unique_prop'],
						'unique_prop2' => $row['unique_prop2'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	
				/*
				$child_menu = self::listchildmenus($row['menu_id']);
				foreach ($child_menu as $key => $value) {
					$i++;
					$mainObj[$i] = $value;
				}
				*/

				$i++;
			}
		} 	
		return $mainObj;
	}


	public static function listchildmenus($parent_menu_id){
		$mysqli = Configuration::mysqli_configation();
		$mainObj = Array();
		$sql = "SELECT 
				`menu_id`,
				`name`,
				`web_id`,
				`parent_menu_id`,
				`target`,
				`sort_order`,
				`is_active`,
				`menu_type`,
				`unique_prop`,
				`unique_prop2`,
				`created_on`,
				`updated_on`
			 from `tbl_menus`
			 where parent_menu_id = '$parent_menu_id'  order by sort_order ASC;";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) {
			// output data of each row
			$i=0;
			while($row = $result->fetch_assoc()) {

				if (!class_exists('TBL_WEBSITE')) {
	    			include("../data/TBL_WEBSITE.php");
				}
	          	$objUsers = new TBL_WEBSITE();
	          	$website = $objUsers->getdetails($row['web_id']);

				$mainObj[$i] = Array(
						'menu_id' => $row['menu_id'],
						'name' => $row['name'],
						'web_id' => $row['web_id'],
						'website' => $website,
						'parent_menu_id' => $row['parent_menu_id'],
						'target' => $row['target'],
						'sort_order' => $row['sort_order'],
						'is_active' => $row['is_active'],
						'menu_type' => $row['menu_type'],
						'unique_prop' => $row['unique_prop'],
						'unique_prop2' => $row['unique_prop2'],
						'created_on' => $row['created_on'],
						'updated_on' => $row['updated_on']
					);	

				$child_menu = self::listchildmenus($row['menu_id']);
				foreach ($child_menu as $key => $value) {
					$i++;
					$mainObj[$i] = $value;
				}

				$i++;
			}
		} 	
		return $mainObj;
	}


}

?>