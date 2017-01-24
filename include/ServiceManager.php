<?php
if (!class_exists('CI_Email')) {
    include('liabrary/email.php');
} 

class ServiceManager{
	
	/******************************************
	**	Function is used to send contact email
	******************************************/
	public static function send_contact_email($name, $phone, $email, $subject, $message, $to){
		$objEmail = new CI_Email();
        $mail_body = '';
        $mail_body .= "Subject: " . $subject . "\r\n";
        $mail_body .= "From: " .  $name . "\r\n";
        $mail_body .= "Phone: " .  $phone . "\r\n";
        $mail_body .= "Email: " . $email . "\r\n" . "\r\n";
        $mail_body .= $message . "\r\n";

        // send mail
        $status = self::send_email($email, $name, $to, $subject, $mail_body, $objEmail);
        return $status;
	}

    /******************************************
    **  Function is used to send contact email
    ******************************************/
    public static function send_comment_email($name, $email, $dealer, $message, $to){
        $objEmail = new CI_Email();
        //$contact_page = file_get_contents('../mailTemplates/cust_otp.tpl');
        //$mail_body = str_ireplace(array('{customer_name}', '{customer_mobile}', '{generated_date}'), array($name, $mob_no, date('d-m-Y h:i:s')), $otp_page);
        $mail_body = '<p>Name : '.$name.'</p>';
        $mail_body .= '<p>Email : '.$email.'</p>';
        $mail_body .= '<p>Message :</p>';
        $mail_body .= '<p>'.$message.'</p>';

        $subject = $name.' Added a review for dealer '.$dealer;

        // send mail
        $status = self::send_email($email, $name, $to, $subject, $mail_body, $objEmail);
        return $status;
    }

	/******************************************
	**	Function is used to send feedback email
	******************************************/
	public static function send_feedback_email($name, $email, $mobile, $comment, $to){
		$objEmail = new CI_Email();
        //$contact_page = file_get_contents('../mailTemplates/cust_otp.tpl');
        //$mail_body = str_ireplace(array('{customer_name}', '{customer_mobile}', '{generated_date}'), array($name, $mob_no, date('d-m-Y h:i:s')), $otp_page);
        $mail_body = '<p>Name : '.$name.'</p>';
        $mail_body .= '<p>Email : '.$email.'</p>';
        $mail_body .= '<p>Mobile : '.$mobile.'</p>';
        $mail_body .= '<p>Comment :</p>';
        $mail_body .= '<p>'.$comment.'</p>';

        $subject = 'User Comment';

        // send mail
        $status = self::send_email($email, $name, $to, $subject, $mail_body, $objEmail);
        return $status;

	}

	/*******************************************
	**	Function is used to send Quotation email
	*******************************************/
	public static function send_quote_email($name, $email, $product_id, $product_name, $comment, $to){
		$objEmail = new CI_Email();
        //$contact_page = file_get_contents('../mailTemplates/cust_otp.tpl');
        //$mail_body = str_ireplace(array('{customer_name}', '{customer_mobile}', '{generated_date}'), array($name, $mob_no, date('d-m-Y h:i:s')), $otp_page);
        $mail_body = '<p>Name : '.$name.'</p>';
        $mail_body .= '<p>Email : '.$email.'</p>';
        $mail_body .= '<p>Product ID : '.$product_id.'</p>';
        $mail_body .= '<p>Product Name : '.$product_name.'</p>';
        $mail_body .= '<p>Comment :</p>';
        $mail_body .= '<p>'.$comment.'</p>';

        $subject = 'User asked quotation';

        // send mail
        $status = self::send_email($email, $name, $to, $subject, $mail_body, $objEmail);
        return $status;

	}

    /*******************************************
    **  Function is used to send Quotation email
    *******************************************/
    public static function send_password_email($web_name, $web_email, $message, $to){
        $objEmail = new CI_Email();
        $mail_body = $message;
        $subject = 'Forget Password';
        // send mail
        $status = self::send_email($web_email, $web_name, $to, $subject, $mail_body, $objEmail);
        return $status;

    }


    /*******************************************
    **  Function is used to send order email
    *******************************************/
    public static function send_order_email($from_natural,$mail_table, $from, $name, $link, $to){
        $objEmail = new CI_Email();
        $mail_body = '<p>Hello '.$name.'</p>';
        $mail_body .= '<p>New order created, Please check below details.</p>';
        $mail_body .= $mail_table;
        $subject = 'New order created';
        // send mail
        $status = self::send_email($from, $from_natural, $to, $subject, $mail_body, $objEmail);
        return $status;

    }

    /*******************************************
    **  Function is used to send order email
    *******************************************/
    public static function send_register_email_admin($name, $from_natural, $from, $mail_table, $to){
        $objEmail = new CI_Email();
        $mail_body = '<p>Hello,</p>';
        $mail_body .= '<p>New user created, Please check below details.</p>';
        $mail_body .= $mail_table;
        $subject = 'New user registed.';
        // send mail
        $status = self::send_email($from, $from_natural, $to, $subject, $mail_body, $objEmail);
        return $status;

    }


    /*******************************************
    **  Function is used to send order email
    *******************************************/
    public static function send_register_email_user($name, $web_name, $web_domain, $from, $mail_table, $to){
        $objEmail = new CI_Email();
        $mail_body = '<p>Hello '.$name.'</p>';
        $mail_body .= '<p>Welcome to '.$web_name.'! You can login to your account at '.$web_domain.'</p>';
        $mail_body .= '<p>Please check your below details.</p>'; 
        $mail_body .= $mail_table;
        $mail_body .= '<p>You can update your profile after login to your account.</p>';
        $subject = 'Welcome to '.$web_name.'!';
        // send mail
        $status = self::send_email($from, $web_name, $to, $subject, $mail_body, $objEmail);
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