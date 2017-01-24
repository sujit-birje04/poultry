<?php
	include '../include/constants.php';
	$objMain = array('status' => false, 'msg' => 'Image uploaded sucessfully', 'html' => '');
	//echo json_encode($objMain);

	$input_name = 'pdf_file';//isset($_REQUEST['input_name']) ? $_REQUEST['input_name'] : 'pdf_file';
	//var_dump($input_name);
	$target_dir = BASE_DIR."uploads/";
	$return_target_dir = "../uploads/";
	$target_file = basename($_FILES[$input_name]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$rand_name = pathinfo($target_file,PATHINFO_BASENAME);
	
	$target_file = $target_dir.date("Ymdhis").".".$imageFileType;
	$return_target_file = $return_target_dir.date("Ymdhis").".".$imageFileType;
	
	// Check if file already exists
	if (file_exists($target_file)) {
		$objMain["msg"] = "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES[$input_name]["size"] > 500000) {
		$objMain["msg"] = "Sorry, your file is too large.";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf"
	&& $imageFileType != "gif" ) {
		$objMain["msg"] = "Sorry, only PDF, GIF, DOC & DOCX files are allowed, ".$imageFileType." Not allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	} else {
		if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES[$input_name]["name"]). " has been uploaded.";
			$objMain["msg"] = "File uploaded sucessfully.";
			$objMain["status"] = true;
			$returnHTML = '
				<a>
					<div class="unlink_unsaved remove_uploaded_img" call_link="'.SERVER_PATH.'controller/controller.php?method=deleteunsavedfile-API&file='.$return_target_file.'" >X</div>
                  	<input type="hidden" name="pdf_path" id="" value="'.$return_target_file.'" >
                 	<!--<i class="gallary_images fa fa-file" ></i>-->
                 	<iframe src="'.$return_target_file.'" ></iframe>
              	</a>
			';

			$objMain["html"] = $returnHTML;
		} else {
			$objMain["msg"] = "Sorry, there was an error uploading your file.";
		}
	}

	echo json_encode($objMain);
?>