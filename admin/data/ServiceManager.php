<?php


if (!class_exists('CI_Email')) {
    include('../liabrary/email.php');
} 

class ServiceManager{
	
	/******************************************
	**	Function is used to send contact email
	******************************************/
	public static function send_status_email($name, $email, $subject, $message, $to){
		$objEmail = new CI_Email();
        //$contact_page = file_get_contents('../mailTemplates/cust_otp.tpl');
        //$mail_body = str_ireplace(array('{customer_name}', '{customer_mobile}', '{generated_date}'), array($name, $mob_no, date('d-m-Y h:i:s')), $otp_page);
        $mail_body = '<p>Dear '.$name.'</p>';
        $mail_body .= '<p>Your order status has been updated, Below are the details</p>';
        $mail_body .= '<p>'.$message.'</p>';
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