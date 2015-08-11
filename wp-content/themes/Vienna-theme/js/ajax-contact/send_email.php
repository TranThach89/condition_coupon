<?php
	
	session_start();
	
	include_once('class.phpmail.php');
	
	$full_name = $_POST['pm_s_full_name'];
	$email_address = $_POST['pm_s_email_address'];
	$pm_s_subject = $_POST['pm_s_subject'];
	$message = $_POST['pm_s_message'];
	$pm_s_email_address_contact = $_POST['pm_s_email_address_contact'];
		
	if ( empty($full_name) || $full_name == 'Name *' ){
		
		//print 'Please fill in your name.'; 
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'name_error'));
		exit;
		
	} elseif( validate_email($email_address) == false ){
		
		//print 'Please provide a valid email address.';
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'email_error'));
		exit;
		
	} elseif( empty($pm_s_subject) || $pm_s_subject == 'Subject *' ){
		
		//print 'Please provide a subject line.';
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'subject_error'));
		exit;
		
	} elseif( empty($message) || $message == 'Inquiry *' ){
		
		//print 'Please provide a short message for your inquiry.'; 
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'message_error'));
		exit;
		
	} elseif($_SESSION['security_code'] != $_POST['security_code'] && !empty($_SESSION['security_code'] )) {//VALIDATE THE CAPTCHA CODE
					
		//print 'Invalid security code.'; 
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'security_error'));
		exit;
	
	} else {
	
		//Send the report
		$mailer = PhpMail::getInstance();
		
		$message_santizied = $mailer->sanitize_message($message);
		
		$subject = 'Contact Form Inquiry';
				
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: donotreply@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		//$headers .= 'From: donotreply@ontruck.org <donotreply@ontruck.org>' . "\r\n" . 'CC: '.$cc.'';

		$body = ' 
				<html>
				<head>
				  <title>Contact form inquiry</title>
				</head>
				<body>
				  
				  <p>Full Name: '.$full_name.'</p>
				  <p>Email Address: '.$email_address.'</p>
				  <p>Subject: '.$pm_s_subject.'</p>
				  <p>Message: '.$message_santizied.'</p>
				  
				</body>
				</html>
				';
		
		$result = $mailer->sendMail($pm_s_email_address_contact, $subject, $body, $headers);
		//$result = $mailer->sendMail('leo@pulsarmedia.ca', $subject, $body, $headers);
		
		if( $result !== false ){
			
			//echo 'Your inquiry has been received, thank you.';
			
			header('Content-type: application/json');
			echo json_encode(array('status' => 'success')); // where $status is 'OK' or 'ERROR'
			exit;
			
		} else {
			
			//echo 'A system error occurred. Please try again later.';	
			
			header('Content-type: application/json');
			echo json_encode(array('status' => 'failed')); // where $status is 'OK' or 'ERROR'
			exit;
			
		}
		
	}//end of if		
	
	function validate_email($value){
			
		if( !empty($value) ) {
			
			if( !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $value)) {
				
				return false;
				
			} else {
				
				return true;
				
			}
			
		} else {
			
			return false;
			
		}
		
	}//end of validate_email()
		
?>