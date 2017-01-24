<?php
/*
** Class will be used to handdel user related data
** Author : Vikas Sakhare
** Created on : 25th Aug 2015
*/

include("../data/USERDATA.php");
include("../data/OTPDATA.php");
include("../data/SCHOOLS.php");
include("../data/AMENITYCLASSDATA.php");
include("../data/AMENITYTYPEDATA.php");
include("../data/CITYDATA.php");
include("../data/STATEDATA.php");
include("../data/COURSEDETAILSDATA.php");
include("../data/ORDERDATA.php");
include("../data/AMENITYDETAILSDATA.php");
include("../data/AMENITYMASTER.php");
include("../data/COURSEMASTER.php");
include("../data/OFFERMASTER.php");
include("../data/COURSESESSIONDATA.php");
include("../data/TEACHERSDATA.php");
include("../data/SERVICESDATA.php");
include("../data/OFFERMAPDATA.php");
include("../data/SCHOOLSERVICESDATA.php");
include("../data/SERVICEORDERDATA.php");
include("../data/REVIEWDATA.php");
include("../data/SMSDATA.php");
include("../data/EMAILDATA.php");
include('../liabrary/email.php');


class USER {
	
	/*
	* This method will authenticate login and return login profile.
	* if error returns error
	*/
	function login($input){
		$userInstance = new USERDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid data, Please send all required data.");
		if(!isset($input['username']) || !isset($input['password'])){
			return json_encode($mainObj);
		} else if(empty($input['username']) || empty($input['password'])){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}

		
		$mainObj = $userInstance->login($input['username'], $input['password']);
		return json_encode($mainObj);
	}
	
	function checkotp($input){
		$otpInstance = new OTPDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid data, Please send all required data.");
		if(!isset($input['user_id']) || !isset($input['otp'])){
			return json_encode($mainObj);
		} else if(empty($input['user_id']) || empty($input['otp'])){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}

		
		$mainObj = $otpInstance->checkotp($input['user_id'], $input['otp']);
		return json_encode($mainObj);
	}
	
	
	function generateotp($input){
		$otpInstance = new OTPDATA();
		$mainObj = Array("status"=>false, "msg"=>"Please provide valid user_id");
		if(!isset($input['user_id']) ){
			return json_encode($mainObj);
		} else if(empty($input['user_id']) ){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		
		$mainObj = $otpInstance->generate($input['user_id']);
		return json_encode($mainObj);
	}
	
	
	function adduser($input){
		
		$userInstance 	= new USERDATA();
		$otpInstance 	= new OTPDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid data, Please send all required data.");
		 
						
		if(	!isset($input['email']) 	|| 			!isset($input['password'])  || 
			!isset($input['mobile'])	|| 			!isset($input['address_1']) || 
			!isset($input['address_2']) || 			!isset($input['city_id']) 	|| 
			!isset($input['state_id']) 
		){	
			return json_encode($mainObj);
		} 
		else if(empty($input['email']) 		|| 	empty($input['password']) 	|| 
				empty($input['mobile']) 	|| 	empty($input['address_1']) 	|| 
				empty($input['address_2']) 	|| 	empty($input['city_id']) 	|| 
				empty($input['state_id']))
		{
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		
		$fname = '';
		$lname = '';
		if(isset($input['fname'])||isset($input['lname'])){
			$fname	 		= $input['fname'];
			$lname	 		= $input['lname'];
		} else {
			$name = $input['name'];
			$arr_name = explode(' ', $input['name']);
			$fname = isset($arr_name[0]) ? $arr_name[0] : '' ;
			for($i=1;$i<count($arr_name); $i++){
				$lname = $lname ." ".$arr_name[$i];
			}
		}

		$username 		= $input['email'];
		$email	 		= $input['email'];
		$password 		= $input['password'];
		$mobile	 		= $input['mobile'];
		$add1	 		= $input['address_1'];
		$add2	 		= $input['address_2'];
		$profile_pic	= isset($input['profile_pic']) ? $input['profile_pic'] : 'default_pic.png';
		$city_id		= $input['city_id'];
		$state_id		= $input['state_id'];
		$lat			= isset($input['latitude']) ? $input['latitude'] : 0;
		$long			= isset($input['longitude']) ? $input['longitude'] : 0;
		$ref_code		= isset($input['referral']) ? $input['referral'] : '';
		$gender			= isset($input['gender']) ? $input['gender'] : 0;
		$type 			= 2; // 1=>Admin,2=>School driving admin , 3=> lerner
		
		
		$mainObj = $userInstance->register(	$username, 
											$password, 
											$fname, 
											$lname, 
											$email, 
											$mobile, 
											$add1, 
											$add2, 
											$city_id, 
											$state_id,
											$lat, 
											$long,
											$profile_pic,
											$type,
											$gender);
									
		return json_encode($mainObj);
	}
	
	
	
	function edit($input){
		$mainObj = Array("status"=>false, "msg"=>"Invalid data, Please send all required data++ .");
		if(	!isset($input['email']) 		|| 			!isset($input['password'])  || 
			!isset($input['mobile'])		|| 			!isset($input['address_1']) || 
			!isset($input['address_2']) 	|| 			!isset($input['city_id']) 	|| 
			!isset($input['latitude']) 		||			!isset($input['longitude']) || 			
			!isset($input['user_id'])   	||			!isset($input['state_id'])
		){	
			return json_encode($mainObj);
		} 
		else if(empty($input['email']) 		|| 	empty($input['password']) 	|| 
				empty($input['mobile']) 	|| 	empty($input['address_1']) 	|| 
				empty($input['address_2']) 	|| 	empty($input['city_id']) 	|| 
				empty($input['state_id'])	|| 	empty($input['user_id'])    ||
				empty($input['latitude'])	|| 	empty($input['longitude'])    
				)
		{
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		$fname = '';
		$lname = '';
		if(isset($input['fname'])||isset($input['lname'])){
			$fname	= $input['fname'];
			$lname	= $input['lname'];
		} else {
			$name = $input['name'];
			$arr_name = explode(' ', $input['name']);
			$fname = isset($arr_name[0]) ? $arr_name[0] : '' ;
			for($i=1;$i<count($arr_name); $i++){
				$lname = $lname ."".$arr_name[$i];
			}
		}
		$username 		= $input['email'];
		$email	 		= $input['email'];
		$password 		= $input['password'];
		//$fname	 		= $input['fname'];
		//$lname	 		= $input['lname'];
		$mobile	 		= $input['mobile'];
		$add1	 		= $input['address_1'];
		$add2	 		= $input['address_2'];
		$profile_pic	= isset($input['profile_pic']) ? $input['profile_pic'] : 'default_pic.png';
		$city_id		= $input['city_id'];
		$state_id		= $input['state_id'];
		$lat			= isset($input['latitude']);
		$long			= isset($input['longitude']);
		$user_id 		= $input['user_id']; 
		$gender 		= ($input['gender'] == '') ? 0 : $input['gender']; 
		
		$userInstance = new USERDATA();
		$mainObj = $userInstance->update($username, 
						$password, 
						$fname, 
						$lname, 
						$email, 
						$mobile, 
						$add1, 
						$add2, 
						$city_id, 
						$state_id,
						$lat, 
						$long,
						$profile_pic,
						$user_id,
						$gender);
		return json_encode($mainObj);
	}

	function schools($input){
		$arr_result = array('status' => false, 'msg'=>'Inputs are not proper');
		if(!isset($input['lat']) || !isset($input['lng'])){
			return json_encode($arr_result);
		} 
		
		if(empty($input['lat']) || empty($input['lng'])){
			return json_encode($arr_result);
		}
		
		$input['user_id'] = isset($input['user_id']) ? $input['user_id'] : 0;
		$input['start_time'] = isset($input['start_time']) ? $input['start_time'] : 0;
		$input['type'] = isset($input['type']) ? $input['type'] : 0;
		$input['class'] = isset($input['class']) ? $input['class'] : 0;
		$input['price_min'] = isset($input['price_min']) ? $input['price_min'] : 0;
		$input['price_max'] = isset($input['price_max']) ? $input['price_max'] : 0;
		$join_date = isset($input['join_date']) ? $input['join_date'] : date('Y-m-d');
		$instance = new SCHOOLS();
		$arr_result = $instance->schoollist($input['user_id'], $input['lat'], $input['lng']
						, $input['start_time'], $input['type']
						, $input['class'], $input['price_min'], $input['price_max'], $join_date);

		echo json_encode($arr_result);
	}
	
	function schooldetails($input){
		
		$arr_result = array('status' => false, 'msg'=>'Inputs are not proper');
		if(!isset($input['school_id'])){
			return json_encode($arr_result);
		} 
		
		if(empty($input['school_id'])){
			return json_encode($arr_result);
		}
		$join_date = isset($input['join_date']) ? $input['join_date'] : date('Y-m-d');
		$arr_courses = array();
		if(isset($input['courses']) && !empty($input['courses'])){
			$arr_courses = explode(";",$input['courses']);
		}
		
		$instance = new SCHOOLS();
		$arr_result = $instance->schooldetails($input['school_id'], $arr_courses, $join_date);
		echo json_encode($arr_result);
	}
	
	
	public function listcity($input){
		$instance 	= new CITYDATA();
		$mainObj = $instance->listcity();
		return json_encode($mainObj);
	}
	
	public function liststate($input){
		$instance 	= new STATEDATA();
		$mainObj = $instance->liststate();
		return json_encode($mainObj);
	}
	
	public function listamenitytype($input){
		$instance 	= new AMENITYTYPEDATA();
		$mainObj = $instance->listamenitytype();
		return json_encode($mainObj);
	}
	
	public function listamenityclass($input){
			$instance 	= new AMENITYCLASSDATA();
		$mainObj = array('status' => false, 'msg'=>'Inputs are not proper');
		if(!isset($input['type'])){
			return json_encode($mainObj);
		} 
		
		if(empty($input['type'])){
			return json_encode($mainObj);
		}
		$mainObj = $instance->listamenityclass($input['type']);
		return json_encode($mainObj);	
	}
	
	public function listorders($input){
		$instance     = new ORDERDATA();
		
		$mainObj = Array("status"=>false, "msg"=>"Invalid user id, Please enter valid user id");
		
		if(!isset($input['user_id']) || !isset($input['user_id'])){
		    return json_encode($mainObj);
		} else if(empty($input['user_id']) || empty($input['user_id'])){
		    $mainObj['msg'] = 'Something is left blank';
		    return json_encode($mainObj);
		}
		$mainObj = $instance->listorders($input['user_id']);
		return json_encode($mainObj);
	}
	
	
	public function listreviews($input){
		$instance     = new REVIEWDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid user id, Please enter valid user id");
		if(!isset($input['user_id']) || !isset($input['school_id'])){
		    return json_encode($mainObj);
		} else if(empty($input['user_id']) || empty($input['school_id'])){
		    $mainObj['msg'] = 'Something is left blank';
		    return json_encode($mainObj);
		}
		$mainObj = $instance->listreviews($input['user_id'],$input['school_id']);
		return json_encode($mainObj);
	}


	public function createreviews($input){
		$instance   = new REVIEWDATA();
		$mainObj 	= array("status"=>false, "msg"=>"Invalid user id, Please enter valid user id");
		
		if(!isset($input['user_id']) || !isset($input['school_id']) || !isset($input['comment']) || !isset($input['rating'])){
		    return json_encode($mainObj);
		} else if(empty($input['user_id']) || empty($input['school_id'])){
		    $mainObj['msg'] = 'Something is left blank';
		    return json_encode($mainObj);
		}
		
		$input['comment'] = empty($input['comment']) ? '' : $input['comment'];
		$input['rating'] = empty($input['rating']) ? '' : $input['rating'];
		
		$mainObj = $instance->createreview($input['user_id'],$input['school_id'],$input['comment'],$input['rating']);
		return json_encode($mainObj);
	}	
	
	public function verifyoffer($input){
		 $instance = new OFFERMASTER();
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		if( !isset($input['user_id']) || !isset($input['session_id']) || !isset($input['amenity_detail_id']) || !isset($input['offer_code'])){
		    return json_encode($mainObj);
		}  else if(empty($input['user_id']) || empty($input['session_id']) || empty($input['amenity_detail_id']) || empty($input['offer_code'])){	
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		$mainObj = $instance->verifyoffer($input['user_id'],$input['session_id'],$input['amenity_detail_id'],$input['offer_code']);
		return json_encode($mainObj);
	}

	public function createorder($input){
		$instance     = new ORDERDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid input");
			if(isset($input['order_type']) && $input['order_type'] == 1){
				if(!isset($input['join_date']) || !isset($input['session_id']) 
					|| !isset($input['school_id']) || !isset($input['amenity_id'])){
					return json_encode($mainObj);
				} else if(empty($input['join_date']) || empty($input['session_id'])
					|| empty($input['school_id']) || empty($input['amenity_id'])){
					$mainObj['msg'] = 'Something is left blank';
					return json_encode($mainObj);
				}
			}
			$input['offer_id'] = isset($input['offer_id']) ? $input['offer_id'] : 0;
			
			$input['pick_up'] = isset($input['pick_up']) ? $input['pick_up'] : 0;
			$input['lady_instructor'] = isset($input['lady_instructor']) ? $input['lady_instructor'] : 0;
			$input['simulator'] = isset($input['simulator']) ? $input['simulator'] : 0;
			$input['driving_license'] = isset($input['driving_license']) ? $input['driving_license'] : 0;
			$input['order_for'] = isset($input['order_for']) ? $input['order_for'] : '';
			$input['order_mob'] = isset($input['order_mob']) ? $input['order_mob'] : '';
			$input['order_email'] = isset($input['order_email']) ? $input['order_email'] : '';
			$input['order_lat'] = isset($input['order_lat']) ? $input['order_lat'] : '';
			$input['order_lang'] = isset($input['order_lang']) ? $input['order_lang'] : '';
			$input['order_location'] = isset($input['order_location']) ? $input['order_location'] : '';
			//if user_id is not set create user and send $user_id
			
		$mainObj = $instance->createorder($input['user_id'],$input['order_type'],$input['join_date']
							,$input['session_id'],$input['amenity_id'],$input['school_id'],$input['offer_id']
							,$input['pick_up'],$input['lady_instructor'],$input['simulator'],$input['driving_license']
							,$input['order_for'],	$input['order_mob'],$input['order_email'],$input['order_lat'],$input['order_lang'], $input['order_location']);
		if($mainObj['status'] == true){
			$user_details = USERDATA::user_details($input['user_id']);
			
			$user_name = $user_details['fname'] . " " .$user_details['lname'];
			$order_id = $mainObj['data']['order_id'];
			$order_status = $mainObj['data']['order_status'];
			$order_status_text = 'Reserved';
			$school_details = $mainObj['data']['session']['course_details']['school'];
			$school_name = $school_details['school_name'];
			$school_email = $school_details['email'];
			
			$school_owner_details = USERDATA::user_details($school_details['owner_id']);
			$owner_name = $school_owner_details['fname']." ".$school_owner_details['lname'];
			$school_address = $school_details['add1'].", ".$school_details['add2'].", ".$school_details['area'].", ".$school_details['city']['text'].", ".$school_details['state']['text'];
			$school_with_add = $school_name.', '.$school_address;
			
			$course_days = $mainObj['data']['session']['course_details']['master_course']['course_duration'].' Days';
			$vehcle_name = $mainObj['data']['amenity']['name'];
			$course_name = $mainObj['data']['session']['course_details']['master_course']['course_name'];
			$join_date = date('d-m-Y', strtotime($input['join_date']));
			$time_formate = 'pm';
			$school_mobile = $mainObj['data']['session']['course_details']['school']['mobile'];
			if($mainObj['data']['session']['start_time'] < 12){
				$time_formate = 'am';
			}
			$start_time_hr = $mainObj['data']['session']['start_time'];
			if($start_time_hr == 12 || $start_time_hr == 24){
				$start_time_hr = $start_time_hr;
			} else {
				$start_time_hr = $start_time_hr % 12;
			}
			
			$end_time_hr = $mainObj['data']['session']['end_time'];
			if($end_time_hr == 12 || $end_time_hr == 24){
				$end_time_hr = $end_time_hr;
			} else {
				$end_time_hr = $end_time_hr % 12;
			}
			
			$join_time = $start_time_hr.'-'.$end_time_hr.$time_formate;
			
			
			/*Send SMS to Customer*/
			SMSDATA::sendadminssinbooking($user_name, $user_details['mobile']);
			
			/* Send SMS to Schools*/
			SMSDATA::sendadminssiontoschool($user_name, $user_details['mobile'],$vehcle_name,$course_name,$join_date,$join_time,$school_mobile);
			
			/*send Email to customer*/
			$send_mail = EMAILDATA::sendCustomerOrderEmail($user_details['email'],$user_name,$order_id,$order_status_text,$vehcle_name,
															$school_with_add, $course_name, $join_date, $join_time, $course_days);
			
			/*send email to school*/
			//$school_email = 'sujit.birje@gmail.com';
            $send_mail = EMAILDATA::sendSchoolOrderEmail($school_email,$owner_name,$order_id,$user_details['mobile'],$user_name,
														  $school_details['area'],$vehcle_name,$course_name,$join_date,
														  $join_time,$user_details['email']);
		
		
		}
		return json_encode($mainObj);
	}
	
	
	public function orderservice($input){
		$instance     = new ORDERDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid input");
		if(isset($input['order_type']) && $input['order_type'] == 2){
			if(!isset($input['services']) || !isset($input['school_id']) || !isset($input['user_id'])){
				return json_encode($mainObj);
			} else if(empty($input['services']) || empty($input['school_id']) || empty($input['user_id'])){
				$mainObj['msg'] = 'Something is left blank';
				return json_encode($mainObj);
			}
		}
		$input['school_id'] = 2;
		$input['order_for'] = isset($input['order_for']) ? $input['order_for'] : '';
		$input['order_mob'] = isset($input['order_mob']) ? $input['order_mob'] : '';
		$input['order_email'] = isset($input['order_email']) ? $input['order_email'] : '';
		
		$input['offer_id'] = isset($input['offer_id']) ? $input['offer_id'] : 0;
		$input['corp'] = isset($input['corp']) ? $input['corp'] : 'pmc';
		$mainObj = $instance->orderservice($input['user_id'],$input['order_type'],$input['school_id'],$input['offer_id'],$input['services'], $input['corp'],$input['order_for'], $input['order_mob'],$input['order_email']);
		
		if($mainObj['status'] == true){
			$user_details = USERDATA::user_details($input['user_id']);
			
			$user_name = $user_details['fname'] . " " .$user_details['lname'];
			$user_email = $user_details['email'];
			$user_mobile = $user_details['mobile'];
			$user_add = $user_details['address_1'].", ".$user_details['address_2'].", ".$user_details['city']['text'].", ".$user_details['state']['text'];
			
			SMSDATA::sendcustomerservicebooking($user_name, $user_details['mobile']);
			$arr_services = array();//$mainObj['data']['services'];
			$rto_area = 'PMC';
			$lead_time = 0;
			$arr_services_with_name = array();
			foreach($mainObj['data']['services'] as $service){
				if(is_array($service)){
					$service_num = ($service['service']['service_master']['service_id'] >= 10) ? 'D'.$service['service']['service_master']['service_id'] : 'D0'.$service['service']['service_master']['service_id'];
					$arr_services[] = $service_num;
					$arr_services_with_name[] = $service['service']['service_master']['service_name'];
					
					$rto_area = $service['corp'];
					if($lead_time <= $service['service']['lead_time']){
						$lead_time = $service['service']['lead_time'];
					}
				}
			}
			$services = implode(', ',$arr_services);
			$services_with_name = implode(', ',$arr_services_with_name);
			
			$school_details = SCHOOLS::schoolindetails(2);
			$school_mobile = $school_details['mobile'];
			$school_email = $school_details['email'];
			$school_owner= $school_details['owner_id'];
			SMSDATA::sendadminssiontoservices($user_name, $user_details['mobile'],$services, $school_mobile);
			
			
			$order_id = $mainObj['data']['order_id'];
			$order_status = $mainObj['data']['order_status'];
			$order_status_text = 'Reserved';
			
			// send email to customer with Service Details
			/*send Email to customer*/
			$send_mail = EMAILDATA::sendCustomerServiceOrderEmail($user_email,$user_name,$order_id,$order_status_text, $rto_area, $user_mobile
																, $user_add, $services_with_name, $lead_time);
			
			// Send email to school with Services and Customer Details
			$owner_details = USERDATA::user_details($school_owner);
			$school_owner_name = $owner_details['fname']." ".$owner_details['lname'];
			
			$send_mail = EMAILDATA::sendSchoolServiceOrderEmail($school_email,$school_owner_name,$order_id, $user_mobile,$user_name
																, $user_add, $services_with_name, $user_email, $lead_time);
		}
		
		return json_encode($mainObj);
	}
	
	
	
	public function checkorder($input){
		$instance     = new ORDERDATA();
		$mainObj = Array("status"=>false, "msg"=>"Invalid input");
			if(isset($input['order_type']) && $input['order_type'] == 1){
				if(!isset($input['join_date']) || !isset($input['session_id']) 
					|| !isset($input['school_id']) || !isset($input['amenity_id'])){
					return json_encode($mainObj);
				} else if(empty($input['join_date']) || empty($input['session_id'])
					|| empty($input['school_id']) || empty($input['amenity_id'])){
					$mainObj['msg'] = 'Something is left blank';
					return json_encode($mainObj);
				}
			}
		$input['offer_id'] = isset($input['offer_id']) ? $input['offer_id'] : 0;
		//if user_id is not set create user and send $user_id
			
		$mainObj = $instance->checkorder($input['user_id'],$input['order_type'],$input['join_date']
							,$input['session_id'],$input['amenity_id'],$input['school_id'],$input['offer_id']);
		return json_encode($mainObj);
	}
	
	public function listservices(){
		    $instance	= new SERVICESDATA();
		    $mainObj = $instance->listservices();
		    return json_encode($mainObj);
	} 
    
	
	public function listsession($input){
		$instance	= new COURSESESSIONDATA();
		$mainObj = array("status"=>false, "msg"=>"sessions not found", "data"=>null);
		if(!isset($input['session_id'])){
			return json_encode($mainObj);
		} else if(empty($input['session_id'])){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		$session_id = $input['session_id'];
		$join_date = isset($input['join_date']) ? $input['join_date'] : date('Y-m-d');
		$mainObj = $instance->listsession($session_id, $join_date);
		return json_encode($mainObj);
	} 
	
	
	public function listcoursesession($input){
		$instance	= new COURSESESSIONDATA();
		$mainObj = array("status"=>false, "msg"=>"sessions not found", "data"=>null);
		if(!isset($input['course_id'])){
			return json_encode($mainObj);
		} else if(empty($input['course_id'])){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		$course_id = $input['course_id'];
		$join_date = isset($input['join_date']) ? $input['join_date'] : date('Y-m-d');
		$mainObj = $instance->listcoursesession($course_id, $join_date);
		return json_encode($mainObj);
	} 
	
	
	public function listschoolservices($input){
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		
		if( !isset($input['ids'])){		    
		    return json_encode($mainObj);
		}elseif(empty($input['ids'])){
		    return json_encode($mainObj);
		} 
		$instance	= new SCHOOLSERVICESDATA();
		$mainObj = $instance->listservices($input['ids']);
		return json_encode($mainObj);
       }
       
	public function servicesdetails($input){
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		if( !isset($input['ids'])){		    
		    return json_encode($mainObj);
		}elseif(empty($input['ids'])){
		    return json_encode($mainObj);
		}
		$corp = isset($_REQUEST['corp']) ? $_REQUEST['corp'] : 'pmc';
		$instance = new SCHOOLSERVICESDATA();
		$mainObj = $instance->serviceindetails($input['ids'], $corp);
		return json_encode($mainObj);
	}
       
	   
	public function orderdetails($input){
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		if( !isset($input['order_id'])){		    
		    return json_encode($mainObj);
		}elseif(empty($input['order_id'])){
		    return json_encode($mainObj);
		} 
		$instance	= new ORDERDATA();
		$mainObj = $instance->orderdetails($input['order_id']);
		return json_encode($mainObj);
	}
	
	
	
	public function forgotpassword($input){
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		if(!isset($input['email'])){
			return json_encode($mainObj);
		}else if(empty($input['email'])){
			return json_encode($mainObj);	
		}
		
		$userInstance = new USERDATA();
		$mainObj = $userInstance->forgotPassword($input['email']);
		
		//send Email to user
		if($mainObj['status'] == true){
			$send_mail = EMAILDATA::sendResetPasswordEmail($mainObj['email'], $mainObj['name'], $mainObj['password']);
		}
		return json_encode($mainObj);
	}
	
	public function listoffers($input){
		$instance = new OFFERMASTER();
		$mainObj = Array("status"=>false, "msg"=>"Inputs are not proper", "data"=>"");
		if( !isset($input['session_id'])||!isset($input['amenity_id'])){
		    return json_encode($mainObj);
		} else if(empty($input['session_id'])||empty($input['amenity_id'])){
			$mainObj['msg'] = 'Something is left blank';
			return json_encode($mainObj);
		}
		$mainObj = $instance->getofferdetails($input['session_id'],$input['amenity_id']);
		return json_encode($mainObj);
	}
        
        public function sendsms(){
            $instance = new SMSDATA();
            
            
            /// OTP SMS - To Customer//
            /* 
                request : 1: User phone no
                          2: OTP Code  
             */
            $send_sms = SMSDATA::sendotpsms('8956536970','9999');
            
            
            /// Admission Booking - To Customer //
            /* 
                request :   1: User Name
                            2: User Phone no
                          
             */
            
            //$send_sms = SMSDATA::sendadminssinbooking('Vikas','8956536970');
            

            // Admission Booking - To School //
            /* 
                request :   1: User Name
                            2: User Phone no
                            3: Vehicle name
                            4: Course name
                            5: join date    
                            6: join time
                          
             */
            
            //$send_sms = SMSDATA::sendadminssiontoschool('Vikas','8956536970','WagonR','Regular 4 WheelerXX','01/01/2016',' 9-10am');
            
            /// Sevice Admission Booking - To Customer //
            /* 
                request :   1: User Name
                            2: User Phone no
                            3: Services in Array    
                          
             */
            
            
            //$send_sms = SMSDATA::sendadminssiontoservices('Vikas','8956536970',array('Permanent License','Transfer certificate','No objection certificate'));
              
            //print_r($send_sms);die;
            
            
            
        }




        public function clearoldcourseorder(){

				$course_orders = ORDERDATA::getCompletedCourseOrders();
				foreach($course_orders as $course_o_id){			
					$result = ORDERDATA::completeTheOrders($course_o_id);
					
					if($result['status']){
						//Send mail to this order
						$order_data = ORDERDATA::order_details($course_o_id);				
						if(empty($order_data['session'])){
							continue;
						}
						$user_details = USERDATA::user_details($order_data['user_id']);
						

						$user_name = $user_details['fname'] . " " .$user_details['lname'];
						$order_id = $order_data['order_id'];
						$order_status = $order_data['order_status'];
						$order_status_text = 'Completed';
						$school_details = $order_data['session']['course_details']['school'];
						$school_name = $school_details['school_name'];
						$school_email = $school_details['email'];
						
						//$school_owner_details = USERDATA::user_details($school_details['owner_id']);
						//$owner_name = $school_owner_details['fname']." ".$school_owner_details['lname'];
						$school_address = $school_details['add1'].", ".$school_details['add2'].", ".$school_details['area'].", ".$school_details['city']['text'].", ".$school_details['state']['text'];
						$school_with_add = $school_name.', '.$school_address;
						
						$course_days = $order_data['session']['course_details']['master_course']['course_duration'].' Days';
						$vehcle_name = $order_data['amenity']['name'];
						$course_name = $order_data['session']['course_details']['master_course']['course_name'];
						$join_date = $order_data['start_datetime'];
						$time_formate = 'pm';
						$school_mobile = $order_data['session']['course_details']['school']['mobile'];
						if($order_data['session']['start_time'] < 12){
							$time_formate = 'am';
						}
						$start_time_hr = $order_data['session']['start_time'];
						if($start_time_hr == 12 || $start_time_hr == 24){
							$start_time_hr = $start_time_hr;
						} else {
							$start_time_hr = $start_time_hr % 12;
						}
						
						$end_time_hr = $order_data['session']['end_time'];
						if($end_time_hr == 12 || $end_time_hr == 24){
							$end_time_hr = $end_time_hr;
						} else {
							$end_time_hr = $end_time_hr % 12;
						}
						
						$join_time = $start_time_hr.'-'.$end_time_hr.$time_formate;
						
						$join_date = date('d-m-Y', strtotime($join_date));
						
						//echo json_encode($join_date)."<br/><br/>";
						
						/*send Email to customer*/
						$send_mail = EMAILDATA::sendCustomerOrderCompletionEmail($user_details['email'],$user_name,$order_id,$order_status_text,$vehcle_name,
																		$school_with_add, $course_name, $join_date, $join_time, $course_days);
						
					} else {
						echo "no order present.";
					}
				}
        }


        public function clearoldserviceorder(){      	
			$service_orders = ORDERDATA::getCompletedServiceOrders();
			foreach($service_orders as $service_o_id){			
				$result = ORDERDATA::completeTheOrders($service_o_id);	
				
				if($result['status']){
					//Send mail to this order
					
					$order_data = ORDERDATA::order_details($service_o_id);
					$oder_id = $service_o_id;
					$user_details = USERDATA::user_details($order_data['user_id']);
					
					$user_name = $user_details['fname'] . " " .$user_details['lname'];
					$user_email = $user_details['email'];
					$user_mobile = $user_details['mobile'];
					$user_add = $user_details['address_1'].", ".$user_details['address_2'].", ".$user_details['city']['text'].", ".$user_details['state']['text'];
					
					
					$arr_services = array();//$order_data['services'];
					$rto_area = 'PMC';
					$lead_time = 0;
					$arr_services_with_name = array();
					foreach($order_data['services'] as $service){
						if(is_array($service)){
							$service_num = ($service['service']['service_master']['service_id'] >= 10) ? 'D'.$service['service']['service_master']['service_id'] : 'D0'.$service['service']['service_master']['service_id'];
							$arr_services[] = $service_num;
							$arr_services_with_name[] = $service['service']['service_master']['service_name'];
							
							$rto_area = $service['corp'];
							if($lead_time <= $service['service']['lead_time']){
								$lead_time = $service['service']['lead_time'];
							}
						}
					}
					$services = implode(', ',$arr_services);
					$services_with_name = implode(', ',$arr_services_with_name);
					
					$school_details = SCHOOLS::schoolindetails(2);
					$school_mobile = $school_details['mobile'];
					$school_email = $school_details['email'];
					$school_owner= $school_details['owner_id'];
					
					
					$order_id = $order_data['order_id'];
					$order_status = $order_data['order_status'];
					$order_status_text = 'Completed';
					
					//echo $oder_id.'<br/><br/><br/>';
					
					/*send Email to customer*/
					
					$send_mail = EMAILDATA::sendCustomerServiceCompleteEmail($user_email,$user_name,$oder_id,$order_status_text, $rto_area, $user_mobile
																		, $user_add, $services_with_name, $lead_time);
					
				}
			}
			
        }
		
		
		public function sendemail(){
			
		$send_mail = EMAILDATA::sendSchoolServiceOrderEmail('vikas0253@gmail.com','Vikas Sakhare','111','Reserved','Pune','8956536970','Sujit Birje',
														  'A-6,Planet Millenium ,Pune -27','Liscense, Lady Instructor','sujit.birje@gmail.com','26 Days');
			
														
			print_r($send_mail);die;
			
			
			/* 
                request : 1: To as emaiil id
                          2: name as first name of customer
						  3: Mobile no
             */
            $send_mail = EMAILDATA::sendotpemail('vikas0253@gmail.com','Vikas','8956536970',$objEmail);
			print_r($send_mail);
			/* 
                request : 1: To as emaiil id
                          2: name as full name of customer
						  3: order_id
						  4: order_status
						  5: vehicle name
						  6: school_name
						  7: course_name
						  8: joining_date
						  9: timing_slot
						  10: course_duration
             */
			 
			 
            $send_mail = EMAILDATA::sendCustomerOrderEmail('vikas0253@gmail.com','Vikas Sakhare','111','Reserved','Alto',
															'Aditya Driving School, Baner, Pune.','4 Wheeler Regular',
															'26th Jan 2016','9 am to 10 am','26 Days',$objEmail);
			print_r($send_mail);												
															
			/* 
                request : 1: To as emaiil id
                          2: full name as full name of school owner
						  3: order_id
						  4: customer_mobile
						  4: customer_name
						  5: customer_location
						  6: vehicle
						  7: course
						  8: joining_date
						  9: timing slot
						  10: customer_email
             */
			 //$to,$full_name,$order_id,$customer_mobile,$customer_name,$customer_location
			//									$vehicle,$course,$joining_date,$timing_slot,$customer_email
			
			
			
            $send_mail = EMAILDATA::sendSchoolOrderEmail('vikas0253@gmail.com','Vikas Sakhare','111','8956536970','Sujit Birje',
														  'Baner','WagonR','4 Wheeler Regular','26th Jan 2016',
														  '9 am to 10 am','sujit.birje@gmail.com',$objEmail);
			
			print_r($send_mail);
			
			
			
			
			/* Send mail to customer for service order
				
                request : $to,$full_name,$oder_id,$order_status,$rto_area,$customer_mobile,$customer_add,$services,$lead_time
						  
             */
			 
			 
            $send_mail = EMAILDATA::sendCustomerServiceOrderEmail('vikas0253@gmail.com','Vikas Sakhare','111','Reserved','Pune','8956536970',
														  'A-6,Planet Millenium ,Pune -27','Liscense, Lady Instructor','26 Days'
														);
														
			print_r($send_mail);
			
			/* 
                request : 1: To as emaiil id
                          2: full name as full name of school owner
						  3: order_id
						  4: order_status
						  5: rto_area
						  6: customer_mobile
						  7: customer_name
						  8: customer_address
						  9: services
						  10: Customer Email
						  11: lead_days
									
			 
			*/
			
			
           $send_mail = EMAILDATA::sendSchoolServiceOrderEmail('vikas0253@gmail.com','Vikas Sakhare','111','Reserved','Pune','8956536970','Sujit Birje',
														  'A-6,Planet Millenium ,Pune -27','Liscense, Lady Instructor','sujit.birje@gmail.com','26 Days',$objEmail);
			
			print_r($send_mail);//die;
			
			
			/* 
                request : 1: To as emaiil id
                          2: name as first name of customer
						  3: Password
             */
            $send_mail = EMAILDATA::sendResetPasswordEmail('vikas0253@gmail.com','Vikas','8956536970');
			print_r($send_mail);
			
		}
	
}
?>
