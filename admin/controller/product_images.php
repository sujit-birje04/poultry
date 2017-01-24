<?php
	include '../include/constants.php';
	$objMain = array('status' => false, 'msg' => 'Image uploaded sucessfully', 'html' => '');
	//echo json_encode($objMain);

	$target_dir = BASE_DIR."uploads/";
	$return_target_dir = "../admin/uploads/";
	$target_file = basename($_FILES["additional_image"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	$target_file = $target_dir.date("Ymdhis").".".$imageFileType;
	$return_target_file = $return_target_dir.date("Ymdhis").".".$imageFileType;
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["additional_image"]["tmp_name"]);
		if($check !== false) {
			$objMain["msg"] = "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$objMain["msg"] = "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		$objMain["msg"] = "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["additional_image"]["size"] > 500000) {
		$objMain["msg"] = "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$objMain["msg"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	} else {
		if (move_uploaded_file($_FILES["additional_image"]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES["additional_image"]["name"]). " has been uploaded.";
			$objMain["msg"] = "File uploaded sucessfully.";
			$objMain["status"] = true;
			$returnHTML = '
				<a>
					<div class="unlink_unsaved remove_uploaded_img" call_link="'.SERVER_PATH.'controller/controller.php?method=deleteunsavedimage-API&img='.$return_target_file.'" >X</div>
                  	<input type="hidden" name="aditionalImage[]" id="" value="'.$return_target_file.'" >
                  	<img src="../'.$return_target_file.'" class="gallary_images" >
              	</a>
			';

			$objMain["html"] = $returnHTML;
		} else {
			$objMain["msg"] = "Sorry, there was an error uploading your file.";
		}
	}

	echo json_encode($objMain);
?>