<?php
    ini_set('display_errors', '1');     # don't show any errors...
    error_reporting(1);
    error_reporting(E_ALL | ~E_STRICT);  # ...but do log them
	include("./include/LocalDB.php");
	include('./liabrary/email.php');
	include('./include/SessionManage.php');
	include('./include/ServiceManager.php');
    include "./include/constants.php";
    include "./include/Utility.php";

	$input = $_REQUEST;
	$method = !empty($_REQUEST['method']) ? $_REQUEST['method'] : '404';
	if($method == 404){
		echo "File not present";
		die();
	} 


	if($method == 'save_application'){
		$mailObj = array(
				'status'=>false,
				'msg' => 'Application could not be saved, Please try again.'
			);
		$next_url = "careers.php";
		$s_link = $next_url."?success=true";
		$e_link = $next_url."?success=false";
		$post_id = trim($_REQUEST['post_id']);
		$name = trim($_REQUEST['name']);
		$phone = trim($_REQUEST['phone']);
		$email = trim($_REQUEST['email']);
		$area_of_interest = trim($_REQUEST['message']);
		$resume_link = trim($_REQUEST['resume_link']);
		$sex = 1;
		$add = "NA";
		$city = "NA";
		$state = "NA";
		$zip = "NA";
		$qualification = "NA";
		$work_exp = "NA";
		$salary = "NA";
		
		$objSession = new SessionManage();


		if($name == '' || $email == '' || $phone == '' || $post_id == ''){
			$e_link = $e_link."&error_no=1";
			header( 'Location: ./'.$e_link);
			$mailObj = array(
					'status'=>false,
					'msg' => 'Something is missing.'
				);
			$objSession->setObject(json_encode($mailObj), 'new_page_message');
			die();
		} else {
			$email_result = LocalDB::saveApplication('',$post_id,$name,$sex,$phone,$email,$add,$city,$state,$zip,$qualification,$work_exp,$area_of_interest,$salary,$resume_link);
			if($email_result['status'] == true){
				

				$to = HR_EMAIL;
				//$webDetails = LocalDB::getWebDetails(WEBID);
				$admin_name = HR_NAME;
				$arr_inputs = array(
						'name' => $name,
						'phone' => $phone,
						'email' => $email,
						'area_of_interest' => $area_of_interest,
						'resume_link' => SERVER_PATH.''.$resume_link,
						'post_id' => $post_id
					);

				// To Admin
				$email_result = ServiceManager::send_application_email($arr_inputs, $admin_name, $email, $to);
				
				// To Customer
				$email_result = ServiceManager::send_application_email($arr_inputs, $name, $to, $email);


				header( 'Location: ./'.$s_link);
				$mailObj = array(
						'status'=>true,
						'msg' => 'Application submitted successfully.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');

				die();
			} else {
				$e_link = $e_link."&error_no=2";
				header( 'Location: ./'.$e_link);	
				$mailObj = array(
						'status'=>false,
						'msg' => 'Error while sending application.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');
				die();
			}
		}
		header( 'Location: ./'.$e_link);
		die();
	}



	if($method == 'save_contact'){
		$mailObj = array(
				'status'=>false,
				'msg' => 'Request could not be saved, Please try again.'
			);
		$next_url = "contact.php";
		$s_link = $next_url."?success=true";
		$e_link = $next_url."?success=false";
		$message_id = "";
		$name = trim($_REQUEST['name']);
		$phone = trim($_REQUEST['mobile']);
		$email = trim($_REQUEST['email']);
		$message = trim($_REQUEST['message']);
		$subject = trim($_REQUEST['subject']);
		
		$objSession = new SessionManage();

		if($name == '' || $email == '' || $subject == '' || $phone == '' ){
			$e_link = $e_link."&error_no=1";
			header( 'Location: ./'.$e_link);
			$mailObj = array(
					'status'=>false,
					'msg' => 'Something is missing.'
				);
			$objSession->setObject(json_encode($mailObj), 'new_page_message');
			die();
		} else {
			$email_result = LocalDB::saveContact($message_id,$name,$email,$phone,$subject,$message);
			if($email_result['status'] == true){
				
				$to = ADMIN_EMAIL;
				//$webDetails = LocalDB::getWebDetails(WEBID);
				$admin_name = ADMIN_NAME;
				$arr_inputs = array(
						'name' => $name,
						'phone' => $phone,
						'email' => $email,
						'message' => $message,
						'subject' => $subject,
					);

				// To Admin
				$email_result = ServiceManager::send_contact_email($arr_inputs, $admin_name, $email, $to);
				
				// To Customer
				$email_result = ServiceManager::send_contact_email($arr_inputs, $name, $to, $email);
				
				header( 'Location: ./'.$s_link);
				$mailObj = array(
						'status'=>true,
						'msg' => 'Contact request submitted successfully.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');

				die();
			} else {
				$e_link = $e_link."&error_no=2";
				header( 'Location: ./'.$e_link);	
				$mailObj = array(
						'status'=>false,
						'msg' => 'Error while adding contact request.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');
				die();
			}
		}
		header( 'Location: ./'.$e_link);
		die();
	}



	if($method == 'save_enquiry'){
		$mailObj = array(
				'status'=>false,
				'msg' => 'Enquiry could not be saved, Please try again.'
			);
		$next_url = $_REQUEST['next_url'];
		$s_link = $next_url."?success=true";
		$e_link = $next_url."?success=false";
		$enquiry_id = "";
		$name = trim($_REQUEST['name']);
		$email = trim($_REQUEST['email']);
		$address = trim($_REQUEST['address']);
		$city = trim($_REQUEST['city']);
		$country = trim($_REQUEST['country']);
		$post_code = trim($_REQUEST['post_code']);
		$phone = trim($_REQUEST['phone']);
		$fax = trim($_REQUEST['fax']);
		$message = trim($_REQUEST['message']);
		
		$objSession = new SessionManage();

		if($name == '' || $email == '' || $address == '' || $post_code == '' ){
			$e_link = $e_link."&error_no=1";
			header( 'Location: '.$e_link);
			$mailObj = array(
					'status'=>false,
					'msg' => 'Something is missing.'
				);
			$objSession->setObject(json_encode($mailObj), 'new_page_message');
			die();
		} else {
			$email_result = LocalDB::saveEnquiry($enquiry_id,$name,$email,$address,$city,$country,$post_code,$phone,$fax,$message);
			if($email_result['status'] == true){
				

				$to = ENQUIRY_EMAIL;
				//$webDetails = LocalDB::getWebDetails(WEBID);
				$admin_name = ENQUIRY_NAME;
				$arr_inputs = array(
						'name' => $name,
						'phone' => $phone,
						'email' => $email,
						'address' => $address,
						'city' => $city,
						'country' => $country,
						'post_code' => $post_code,
						'fax' => $fax,
						'message' => $message,
					);

				// To Admin
				$email_result = ServiceManager::send_enquiry_email($arr_inputs, $admin_name, $email, $to);
				
				// To Customer
				$email_result = ServiceManager::send_enquiry_email($arr_inputs, $name, $to, $email);

				header( 'Location: '.$s_link);
				$mailObj = array(
						'status'=>true,
						'msg' => 'Enquiry submitted successfully.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');

				die();
			} else {
				$e_link = $e_link."&error_no=2";
				header( 'Location: '.$e_link);	
				$mailObj = array(
						'status'=>false,
						'msg' => 'Error while adding enquiry resquest.'
					);
				$objSession->setObject(json_encode($mailObj), 'new_page_message');
				die();
			}
		}
		header( 'Location: '.$e_link);
		die();
	}


	

	if($method == 'save_profile'){
		$user_id=isset($input["user_id"]) ? $input["user_id"] : "";
		$fname=isset($input["fname"]) ? $input["fname"] : "";
		$lname=isset($input["lname"]) ? $input["lname"] : "";
		$email_id=isset($input["email_id"]) ? $input["email_id"] : "";
		$mobile=isset($input["mobile"]) ? $input["mobile"] : "";
		$phone=isset($input["phone"]) ? $input["phone"] : "";
		$comp_apt=isset($input["comp_apt"]) ? $input["comp_apt"] : "";
		$add1=isset($input["add1"]) ? $input["add1"] : "";
		$add2=isset($input["add2"]) ? $input["add2"] : "";
		$city=isset($input["city"]) ? $input["city"] : "";
		$state=isset($input["state"]) ? $input["state"] : "";
		$country=isset($input["country"]) ? $input["country"] : "";
		$postcode=isset($input["postcode"]) ? $input["postcode"] : "";
		
		$next_url = 'edit-account.php';
		$s_link = $next_url."?success=true";
		$e_link = $next_url."?success=false";
		
		if($user_id == ''){
			$e_link = $e_link."&error_no=1";
			header( 'Location: ./'.$e_link);
			die();
		} else {
			$is_delete = 0;
			$email_result = LocalDB::editProfile($user_id,$fname,$lname,$email_id,$mobile,$phone,$comp_apt,$add1,$add2,$city,$state,$country,$postcode);
			$user_details = LocalDB::getUserDetails($user_id);

			//include './dw_include/SessionManage.php'; 
			$objSession = new SessionManage();
			$user_data = $objSession->setObject($user_details, "customer_data");

			if($email_result['status'] == true){
				header( 'Location: ./'.$s_link);
				die();
			} else {
				$e_link = $e_link."&error_no=2";
				header( 'Location: ./'.$e_link);
				die();
			}
		}
		header( 'Location: ./'.$e_link);
		die();
	}
	

?>