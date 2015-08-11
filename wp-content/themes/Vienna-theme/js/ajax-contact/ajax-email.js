(function($) {

	'use strict';
	
	var contactFormXML;
	var contactFormRequestHandler;
	
	//var templateDir = '/idigital'; //local testing only
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  contactFormXML=new XMLHttpRequest();
	} else {// code for IE6, IE5
	  contactFormXML=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	function sendContactInfo() {
	
		contactFormXML.open("POST", templateDirObject.templateDir + "/js/ajax-contact/send_email.php",true);
		contactFormXML.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var form = $('#pm-contact-form');
		contactFormXML.send(form.serialize());
		contactFormXML.onreadystatechange=contactFormRequestHandler;
	}
	
	contactFormRequestHandler=function(data){
	
		if (contactFormXML.readyState==4 && contactFormXML.status==200)	{
			
			var responseTextObject = jQuery.parseJSON(contactFormXML.responseText);

				
			if(responseTextObject.status == "name_error") {
				
				$('#pm-contact-form-response').html('Please fill in your name.');
				$('#pm_s_full_name').addClass('invalid_field');
				bindClickEvent();
				
			} else if(responseTextObject.status == "email_error") {
				
				$('#pm-contact-form-response').html('Please provide a valid email address.');
				$('#pm_s_email_address').addClass('invalid_field');
				bindClickEvent();
				
			} else if(responseTextObject.status == "subject_error") {
				
				$('#pm-contact-form-response').html('Please provide a subject line.');
				$('#pm_s_subject').addClass('invalid_field');
				bindClickEvent();
				
			} else if(responseTextObject.status == "message_error") {
				
				$('#pm-contact-form-response').html('Please provide a message for your inquiry.');
				$('#pm_s_message').addClass('invalid_field');
				bindClickEvent();
				
			} else if(responseTextObject.status == "security_error") {
				
				$('#pm-contact-form-response').html('Invalid security code entered.');
				$('#security_code').addClass('invalid_field');
				bindClickEvent();
				
			} else if(responseTextObject.status == "success"){
				
				$('#pm-contact-form-response').html('Your inquiry has been received, thank you.');
				$('#pm-contact-form-btn').fadeOut();
				
			} else if(responseTextObject.status == "failed"){
				
				$('#pm-contact-form-response').html('A system error occurred. Please try again later.');
				$('#pm-contact-form-btn').fadeOut();
				
			}

	
		}
	
	}
	
	$(document).ready(function(e) {
		
		bindClickEvent();
		
		$('#pm_s_full_name').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#pm_s_email_address').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#pm_s_subject').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#pm_s_message').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('.pm_s_security_code').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
	
	});//end of jQuery
	
	function bindClickEvent() {
			
		$('#pm-contact-form-btn').click(function(e) {
		
			sendContactInfo();
		
			$(this).unbind("click");
			
			$('#pm-contact-form-response').html("Validating message, please wait...");
						
			//$('#form_response').show();
			
			//alert('submit form');
			e.preventDefault();
		});
			
	}
	
})(jQuery);


