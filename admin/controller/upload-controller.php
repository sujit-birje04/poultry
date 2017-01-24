<?php
	//ini_set('display_errors', '1');     # don't show any errors...
	//error_reporting(1);
	//error_reporting(E_ALL | ~E_STRICT);

	include '../include/constants.php';
	include("../data/SESSIONDATA.php");

	$objSession = new SESSIONDATA();
	$uploaded_img = $objSession->get_uploaded_image();

	$is_thumb = 1;//isset($_REQUEST['is_thumb']) ? $_REQUEST['is_thumb'] : 0;
	//Delete Uploaded image
	if(!empty($uploaded_img)){
		$arr_name = explode('uploads/', $uploaded_img);
		$file_name = isset($arr_name[1]) ? $arr_name[1] : '';
		$file_to_delete = BASE_DIR."uploads/".$file_name;
		if (file_exists($file_to_delete)) {
			//unlink($file_to_delete);
		}
	}
	

	$objMain = array('status' => false, 'msg' => 'Image uploaded sucessfully', 'link' => './uploads/test.jpg');
	//echo json_encode($objMain);

	$input_name = isset($_REQUEST['input_name']) ? $_REQUEST['input_name'] : 'file_image';

	$target_dir = BASE_DIR."uploads/";
	$return_target_dir = "./admin/uploads/";
	$target_file = basename($_FILES[$input_name]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	$target_file = $target_dir.date("Ymdhis").".".$imageFileType;
	$return_target_file = $return_target_dir.date("Ymdhis").".".$imageFileType;
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES[$input_name]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
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
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$objMain["msg"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	} else {
		if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
			//echo "The file ". basename( $_FILES[$input_name]["name"]). " has been uploaded.";
			if($is_thumb == 1){
				// Make thumbnail here
				make_thumb($imageFileType, $target_file, $target_file, 400);
			}


			$objMain["msg"] = "File uploaded sucessfully.";
			$objMain["status"] = true;
			$objMain["link"] = "../".$return_target_file;
			$objMain["link_in"] = $return_target_file;

			$objSession->set_uploaded_image($return_target_file);
		} else {
			$objMain["msg"] = "Sorry, there was an error uploading your file.";
		}
	}

	echo json_encode($objMain);
?>

<?php
	function make_thumb($file_ext, $src, $dest, $desired_width) {

		/* read the source image */
		switch($file_ext){
            case 'jpg':
                $source_image = imagecreatefromjpeg($src);
                break;
            case 'jpeg':
                $source_image = imagecreatefromjpeg($src);
                break;

            case 'png':
                $source_image = imagecreatefrompng($src);
                break;
            case 'gif':
                $source_image = imagecreatefromgif($src);
                break;
            default:
                $source_image = imagecreatefromjpeg($src);
        }

		$width = imagesx($source_image);
		$height = imagesy($source_image);
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
		
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
		
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
		
		/* create the physical thumbnail image to its destination */
		switch($file_ext){
	            case 'jpg' || 'jpeg':
	                imagejpeg($virtual_image,$dest,100);
	                break;
	            case 'png':
	                imagepng($virtual_image,$dest,100);
	                break;

	            case 'gif':
	                imagegif($virtual_image,$dest,100);
	                break;
	            default:
	                imagejpeg($virtual_image,$dest,100);
	    }
	}
?>