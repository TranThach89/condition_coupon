(function (e) {
	
	var uploader = function (data) {
		
		this.formfield = null;
		
		this.init = function() {
			
			//alert('uploader loaded');
						
		};//end of init
		
		this.refreshAll = function(){
			//alert('refresh all');
			this.removeClicks();
		};
		
		this.removeClicks = function() {
			
			//alert('remove clicks');
			
			e('.upload_image_btn').each(function(i, el) {
				
				var $this = e(el);
				$this.unbind('click');
				
			});
			
			this.bindClicks();
			
		};//removeClicks
		
		this.bindClicks = function() {
			
			e('.upload_image_btn').each(function(i, el) {
            
				var $this = e(el);
				var imageBtnId = $this.attr('id');
				var imageBtnIndex = imageBtnId.substr(imageBtnId.lastIndexOf("_") + 1);
				
				var parent = e(this).closest('.panel_container');
				var panelFile = parent.find('#panel_image_'+imageBtnIndex);
				
				
				$this.bind('click', function(i, el) {
				
					//alert(panelFile.attr('id'));
					//panelFile.val('test');
					//return;
					
					//e('html').addClass('Image');
					formfield = panelFile.attr('name');
					tb_show('', 'media-upload.php?type=image&TB_iframe=true');
					
					window.original_send_to_editor = window.send_to_editor;
					window.send_to_editor = function(html) {
					
						var fileurl;
						
						if(this.formfield != null) {
							
							fileurl = e('img',html).attr('src');
							
							panelFile.val(fileurl);
							
							tb_remove();
							
							//e('html').removeClass('Image');
							this.formfield = null;
							
						} else {
							window.original_send_to_editor(html);	
						};
						
					};
					
					return false;
					
				});
				
			});
			
		};//bindClicks
		
	};
	
	window.PMImageUploader = uploader
	
})(jQuery);