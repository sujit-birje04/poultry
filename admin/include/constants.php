<?php


$myfile = fopen("../config/settings.config", "r") or die("Unable to open file!");
$jsonSettings = json_decode(fgets($myfile));
fclose($myfile);
if(empty($jsonSettings)){
	echo "Settings are not proper";
	die();
} else {
	define("BASE_DIR", $jsonSettings->path);
	define("SERVER_PATH", $jsonSettings->host);

	define("PAGE_LIMIT", $jsonSettings->page);

	$menu_types = array(
					'PMU' => 'Seprator',
					'SCAR' => 'Single Article',
					'SAT' => 'Single Article on Template',
					'FRM' => 'Form',
					'BLI' => 'Blog List',
					'SAR' => 'Single Post',
					'CVW' => 'Category View',
					'SPL' => 'Product Listing',
					'SPR' => 'Single Product',
					'EXL' => 'External Link',
					); 

	define("MENU_TYPES", json_encode($menu_types));

	$product_types = array(
					'1' => 'Residential',
					'2' => 'Commercial',
					'3' => 'Industrial',
					); 

	define("PRODUCT_TYPES", json_encode($product_types));
}



?>