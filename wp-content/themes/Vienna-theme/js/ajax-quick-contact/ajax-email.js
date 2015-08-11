(function($) {

	'use strict';

	var quickContactFormXML;
	var formRequestHandler;
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
	  quickContactFormXML=new XMLHttpRequest();
	} else {// code for IE6, IE5
	  quickContactFormXML=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	function sendInfo() {
	
		quickContactFormXML.open("POST", templateDir + "/js/ajax-quick-contact/send_email.php",true);
		quickContactFormXML.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var form = $('#quick-contact-form');
		quickContactFormXML.send(form.serialize());
		quickContactFormXML.onreadystatechange=formRequestHandler;
	}
	
	formRequestHandler=function(data){
	
		if (quickContactFormXML.readyState==4 && quickContactFormXML.status==200)	{
	
			$('#pm_form_response').html(quickContactFormXML.responseText);
			$('#pm_form_response').fadeIn(1000, function(){
	
				$(this).fadeOut(6000, function(){
					$(this).html('');
				});
	
			});
	
		}
	
	}
	
	$(document).ready(function(e) {
				
		//form submission
		$('#quick-contact-form').submit(function() {
	
			//$('#pm_form_response').show();
			sendInfo();
			//alert('submit form');
			return false;
		});
	
	});//end of jQuery
	
})(jQuery);


