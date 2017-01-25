<?php
if (!class_exists('CI_Email')) {
    include('./liabrary/email.php');
} 

class ServiceManager{
	
	/******************************************
	**	Function is used to send contact email
	******************************************/
	public static function send_contact_email($input_arr, $name, $from_email, $to_email){
		$objEmail = new CI_Email();
        $mail_body = '<p>Name : '.$input_arr["name"].'</p>';
        $mail_body .= '<p>Email : '.$input_arr["email"].'</p>';
        $mail_body .= '<p>Phone : '.$input_arr["phone"].'</p>';
        $mail_body .= '<p>Message :</p>';
        $mail_body .= '<p>'.$input_arr["message"].'</p>';
        $subject = 'Contact us : '.$input_arr["subject"];

        // send mail
        $status = self::send_email($from_email, $name, $to_email, $subject, $mail_body, $objEmail);
        return $status;
	}


    /******************************************
    **  Function is used to send Enquiry email
    ******************************************/
    public static function send_enquiry_email($input_arr, $name, $from_email, $to_email){
        $objEmail = new CI_Email();

        $mail_body = '<p>Name : '.$input_arr["name"].'</p>';
        $mail_body .= '<p>Email : '.$input_arr["email"].'</p>';
        $mail_body .= '<p>Phone : '.$input_arr["phone"].'</p>';
        $mail_body .= '<p>Address : '.$input_arr["address"].'</p>';
        $mail_body .= '<p>City : '.$input_arr["city"].'</p>';
        $mail_body .= '<p>Country : '.$input_arr["country"].'</p>';
        $mail_body .= '<p>PostCode : '.$input_arr["post_code"].'</p>';
        $mail_body .= '<p>Fax : '.$input_arr["fax"].'</p>';
        $mail_body .= '<p>Message :</p>';
        $mail_body .= '<p>'.$input_arr["message"].'</p>';
        $subject = 'Enquiry message';

        // send mail
        $status = self::send_email($from_email, $name, $to_email, $subject, $mail_body, $objEmail);
        return $status;
    }


    /******************************************
    **  Function is used to send Enquiry email
    ******************************************/
    public static function send_application_email($input_arr, $name, $from_email, $to_email){
        $objEmail = new CI_Email();
        $mail_body = '<p>Name : '.$input_arr["name"].'</p>';
        $mail_body .= '<p>Email : '.$input_arr["email"].'</p>';
        $mail_body .= '<p>Phone : '.$input_arr["phone"].'</p>';
        $mail_body .= '<p>Area of Interest : '.$input_arr["area_of_interest"].'</p>';
        $mail_body .= '<p>Resume : <a href="'.$input_arr["resume_link"].'" >Click Here</p>';
        $subject = 'Application Recieved for post : '.$input_arr['post_id'];

        // send mail
        $status = self::send_email($from_email, $name, $to_email, $subject, $mail_body, $objEmail);
        return $status;
    }


    public static function send_email($from, $from_natural, $to, $subject, $mail_body, $objEmail,$admin_email = '') {
        $objEmail->from($from, $from_natural);
        $objEmail->to($to);
        if($admin_email!= ''){
            $objEmail->cc($admin_email);
        }
        $objEmail->message($mail_body);
        $objEmail->subject($subject);
        $result = $objEmail->send();
        //var_dump($result); 
        if ($result) {
            $reutn_array['status'] = true;
            $reutn_array['msg'] = 'Mail sent';
        } else {
            $reutn_array['status'] = false;
            $reutn_array['msg'] = 'Mail not sent';
        }
        return $reutn_array;
    }


}

?>