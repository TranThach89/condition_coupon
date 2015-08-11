// JavaScript Document

(function($) {
	
	$(document).ready(function(e) {
		        
		//Header image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-field-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Featured Post image preview
		if( $('.pm-featured-image-upload-field').length > 0 ){
	
			var value = $('.pm-featured-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-featured-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Staff Header image preview
		if( $('.pm-admin-staff-header-upload-field').length > 0 ){
	
			var value = $('.pm-admin-staff-header-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-staff-header-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Staff image preview
		if( $('.pm-staff-admin-upload-field').length > 0 ){
	
			var value = $('.pm-staff-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-staff-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//iPhone switches
		if( $('#pm_post_featured_switch').length > 0 ){
			
			var currValue = $('input[name=pm_post_featured_meta]').val();
			//alert(currValue);
			
			$('#pm_post_featured_switch').iphoneSwitch(currValue, 
			  function() {
				   //alert('on');
				   $('input[name=pm_post_featured_meta]').val("on");
			  },
			  function() {
				   $('input[name=pm_post_featured_meta]').val("off");
			  },
			  {
				switch_on_container_path: adminRootObject.adminRoot + '/wp-content/themes/quantum-theme/js/wp-admin/switch/iphone_switch_container_off.png'
			});
				
		}
		
		//Datepicker
		if( $('#datepicker').length > 0 ){
			$( "#datepicker" ).datepicker();
		}
			
		
    });
	
})(jQuery);