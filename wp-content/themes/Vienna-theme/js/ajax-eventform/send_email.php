<?php
	
	session_start();
	
	include_once('class.phpmail.php');
	
	$first_name = $_POST['pm-first-name-field'];
	$last_name = $_POST['pm-last-name-field'];
	$email_address = $_POST['pm-email-field'];
	$phone = $_POST['pm-phone-field'];	
	$event_inquiry = $_POST['pm-event-inquiry-field'];	
	$date_of_event = $_POST['pm-date-of-event-field'];	
	$num_of_guests = $_POST['pm-num-of-guests-field'];	
	$time_of_event = $_POST['pm-time-of-event-field'];
	$additional_info = $_POST['pm-additional-info-field'];
	
	//grab the email for the intended recipient and confirmation email status
	$pm_event_email_address_contact = $_POST['pm_event_email_address_contact'];
	$pm_send_event_confirmation = $_POST['pm_send_event_confirmation'];
		
	if ( empty($first_name) || $first_name == 'First name *' ){
		
		//print 'Please fill in your name.'; 
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'first_name_error'));
		exit;
		
	} elseif( empty($last_name) || $first_name == 'Last name *' ){
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'last_name_error'));
		exit;
		
	} elseif( validate_email($email_address) == false ){
		
		//print 'Please provide a valid email address.';
		//exit;
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'email_error'));
		exit;
		
	} elseif(  $event_inquiry == 'default' ){
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'event_type_error'));
		exit;
		
	} elseif( empty($date_of_event) ){
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'date_of_event_error'));
		exit;
		
	} elseif( empty($num_of_guests) ){
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'num_of_guests_error'));
		exit;
		
	} elseif( empty($time_of_event) ){
		
		header('Content-type: application/json');
		echo json_encode(array('status' => 'time_of_event_error'));
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
		
		$subject = 'Event Form Inquiry';
				
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		if($pm_send_event_confirmation == 1){
			//cc customer
			$headers .= 'From: donotreply@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n" . 'Bcc: '.$email_address.'';
		} else {
			$headers .= 'From: donotreply@'. $_SERVER['SERVER_NAME'] .' <donotreply@'. $_SERVER['SERVER_NAME'] .'>' . "\r\n";
		}
		

		$body = ' 
				<html>
				<head>
				  <title>The following Event inquiry has been submitted:</title>
				</head>
				<body>
				  
				  <p>First Name: '.$first_name.'</p>
				  <p>Last Name: '.$last_name.'</p>
				  <p>Email Address: '.$email_address.'</p>
				  <p>Phone: '.$phone.'</p>
				  <p>Eveny Type: '.$event_inquiry.'</p>
				  <p>Date of event: '.$date_of_event.'</p>
				  <p>Number of guests: '.$num_of_guests.'</p>
				  <p>Time of event: '.$time_of_event.'</p>
				  <p>Additional information: '.$additional_info.'</p>
				  
				
				';
				
		if($pm_send_event_confirmation == 1){
			$body .= '<p><strong>This is a confirmation notice, please do not reply directly to this email.</strong></p>';	
		}
		
		$body .= '
				</body>
				</html>
				';
		
		$result = $mailer->sendMail($pm_event_email_address_contact, $subject, $body, $headers);
		
		if( $result !== false ){
			
			//echo 'Your inquiry has been received, thank you.';
			
			header('Content-type: application/json');
			echo json_encode(array('status' => 'success'));
			exit;
			
		} else {
			
			//echo 'A system error occurred. Please try again later.';	
			
			header('Content-type: application/json');
			echo json_encode(array('status' => 'failed'));
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