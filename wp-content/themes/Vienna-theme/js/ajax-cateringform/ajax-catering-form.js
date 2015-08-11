(function($) {

	'use strict';
	
	var cateringFormXML;
	var cateringFormRequestHandler;
		
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  cateringFormXML = new XMLHttpRequest();
	} else {// code for IE6, IE5
	  cateringFormXML = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	function sendCateringInfo() {
	
		cateringFormXML.open("POST", templateDirObject.templateDir + "/js/ajax-cateringform/send_email.php",true);
		cateringFormXML.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var form = $('#pm-catering-form');
		cateringFormXML.send(form.serialize());
		cateringFormXML.onreadystatechange = cateringFormRequestHandler;
	}
	
	cateringFormRequestHandler = function(data){
	
		if (cateringFormXML.readyState == 4 && cateringFormXML.status == 200)	{
			
			var responseCateringObject = jQuery.parseJSON(cateringFormXML.responseText);
				
			if(responseCateringObject.status == "first_name_error") {
				
				$('#pm-catering-form-response').html('Please fill in your first name.');
				$('#catering-form-first-name').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "last_name_error") {
				
				$('#pm-catering-form-response').html('Please fill in your last name.');
				$('#catering-form-last-name').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "email_error") {
				
				$('#pm-catering-form-response').html('Please provide a valid email address.');
				$('#catering-form-email-address').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "event_type_error") {
				
				$('#pm-catering-form-response').html('Please select your event type.');
				$('#catering-form-event-type').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "date_of_event_error") {
				
				$('#pm-catering-form-response').html('Please provide a date for your event');
				$('.catering-form-datepicker').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "num_of_guests_error") {
				
				$('#pm-catering-form-response').html('Please enter the number of guests for your event.');
				$('#catering-form-guests-field').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "event_location_error") {
				
				$('#pm-catering-form-response').html('Please enter the event location.');
				$('#catering-form-location-field').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "time_of_event_error") {
				
				$('#pm-catering-form-response').html('Please enter the time for your event.');
				$('#catering-form-time-field').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "security_error") {
				
				$('#pm-catering-form-response').html('Invalid security code entered.');
				$('#security_code').addClass('invalid_field');
				bindCateringClickEvent();
				
			} else if(responseCateringObject.status == "success"){
				
				$('#pm-catering-form-response').html('Your catering inquiry has been received, thank you.');
				$('#pm-catering-form-btn').fadeOut('slow');
				
			} else if(responseCateringObject.status == "failed"){
				
				$('#pm-catering-form-response').html('A system error occurred. Please try again later.');
				$('#pm-catering-form-btn').fadeOut('slow');
				
			}

	
		}
	
	}
	
	$(document).ready(function(e) {
		
		bindCateringClickEvent();
		
		$('#catering-form-first-name').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#catering-form-last-name').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#catering-form-email-address').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#catering-form-event-type').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('.catering-form-datepicker').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#catering-form-guests-field').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('#catering-form-location-field').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
				
		$('#catering-form-time-field').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
		
		$('.pm_s_security_code').focus(function(e) {
			$(this).removeClass('invalid_field');
		});
	
	});//end of jQuery
	
	function bindCateringClickEvent() {
			
		$('#pm-catering-form-btn').click(function(e) {
		
			sendCateringInfo();
		
			$(this).unbind("click");
			
			$('#pm-catering-form-response').html("Validating message, please wait...");
						
			//$('#form_response').show();
			
			//alert('submit form');
			e.preventDefault();
		});
			
	}
	
})(jQuery);


