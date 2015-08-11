<?php 
	
	define('HEADERS', 'From: webmaster@domain.com');

	class PhpMail {

		// Singleton Design Pattern
		public static $instance;
				
		
		public static function getInstance() {
			if (!isset(self::$instance))
				self::$instance = new PhpMail();
			
			return self::$instance;
		}
		
		public function __construct() {
			//do nothing	
		}
		
		public function sendMail($to, $subject, $txt, $headers = HEADERS){
			
			//$headers .= 'Bcc: leo@arcadehype.com' . "\r\n";
			
			if( mail($to, $subject, $txt, $headers) !== false ){
				
				return true;
				
			} else {
			
				return false;
				
			}//end of if
			
		}//end of sendMail
		
		public function sanitize_message($message){
			
			//Remove all special characters
			$clean_message = preg_replace("/[^a-zA-Z0-9\-.?! ]+/", "", trim($message) );
			
			return $clean_message;
			
		}//end of sanitize_message

		
	}//end of class
	
?>