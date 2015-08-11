(function($) {

	'use strict';
	
	var eventFormXML;
	var eventFormRequestHandler;
		
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  eventFormXML = new XMLHttpRequest();
	} else {// code for IE6, IE5
	  eventFormXML = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	function sendEventInfo() {
	
		eventFormXML.open("POST", templateDirObject.templateDir + "/js/ajax-eventform/send_email.php",true);
		eventFormXML.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var form = $('#pm-event-form');
		eventFormXML.send(form.serialize());
		eventFormXML.onreadystatechange = eventFormRequestHandler;
	}
	
	eventFormRequestHandler=function(data){
	
		if (eventFormXML.readyState == 4 && eventFormXML.status == 200)	{
			
			var responseEventObject = jQuery.parseJSON(eventFormXML.responseText);
				
			if(responseEventObject.status == "first_name_error") {
				
				$('#pm-event-form-response').html('Please fill in your first name.');
				$('#event-form-first-name').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "last_name_error") {
				
				$('#pm-event-form-response').html('Please fill in your last name.');
				$('#event-form-last-name').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "email_error") {
				
				$('#pm-event-form-response').html('Please provide a valid email address.');
				$('#event-form-email-address').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "event_type_error") {
				
				$('#pm-event-form-response').html('Please select your event type.');
				$('#event-form-event-type').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "date_of_event_error") {
				
				$('#pm-event-form-response').html('Please provide a date for your event');
				$('.event-form-datepicker').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "num_of_guests_error") {
				
				$('#pm-event-form-response').html('Please enter the number of guests for your event.');
				$('#event-form-guests-field').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "time_of_event_error") {
				
				$('#pm-event-form-response').html('Please enter the time for your event.');
				$('#event-form-time-field').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "security_error") {
				
				$('#pm-event-form-response').html('Invalid security code entered.');
				$('#security_code').addClass('invalid_field');
				bindEventClickEvent();
				
			} else if(responseEventObject.status == "success"){
				
				$('#pm-event-form-response').html('Your event inquiry has been received, thank you.');
				$('#pm-event-form-btn').fadeOut('slow');
				
			} else if(responseEventObject.status == "failed"){
				
				$('#pm-event-form-response').html('A system error occurred. Please try again later.');
				$('#pm-event-form-btn').fadeOut('slow');
				
			}

	
		}
	
	}
	
	$(document).ready(function(e) {
		
		bindEventClickEvent();
				
		$('#event-form-first-name').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#event-form-last-name').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#event-form-email-address').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#event-form-event-type').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('.event-form-datepicker').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#event-form-guests-field').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		$('#event-form-time-field').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('.pm_s_security_code').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
	
	});//end of jQuery
	
	function bindEventClickEvent() {
			
		$('#pm-event-form-btn').click(function(e) {
		
			sendEventInfo();
		
			$(this).unbind("click");
			
			$('#pm-event-form-response').html("Validating message, please wait...");
						
			//$('#form_response').show();
			
			//alert('submit form');
			e.preventDefault();
		});
			
	}
	
})(jQuery);


