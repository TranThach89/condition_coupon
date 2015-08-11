(function($){

	$(document).ready(function(e) {
		
		//alert('pm-image-uploader loaded');
		
		if(wp.media !== undefined){
			
			var formfield = null;
		
			var clicked = '';
			
			var image_custom_uploader;
			
			//Page header image
			$('#upload_image_button').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (image_custom_uploader) {
					 image_custom_uploader.open();
					 return;
				 }
				
			});
					
			 //Extend the wp.media object
			 image_custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 image_custom_uploader.on('select', function() {
				attachment = image_custom_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#img-uploader-field').val(url);
				$('.pm-admin-upload-field-preview').html('<img src="'+ url +'" />');
	
			 });
			 
			 
			//Featured Post image
			$('#featured_upload_image_button').click(function(e) {
												
				 e.preventDefault();
	
				 //If the uploader object has already been created, reopen the dialog
				 if (featured_image_custom_uploader) {
					 featured_image_custom_uploader.open();
					 return;
				 }
				
			});
			
			//Extend the wp.media object
			 featured_image_custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
				text: 'Choose Image'
				},
				 multiple: false
			 });
			 
			 //When a file is selected, grab the URL and set it as the text field's value
			 featured_image_custom_uploader.on('select', function() {
				attachment = featured_image_custom_uploader.state().get('selection').first().toJSON();
				var url = '';
				url = attachment['url'];
				
				$('#featured-img-uploader-field').val(url);
				$('.pm-featured-image-preview').html('<img src="'+ url +'" />');
	
			 });
			
		}
		
		
		
		
	});

})(jQuery);