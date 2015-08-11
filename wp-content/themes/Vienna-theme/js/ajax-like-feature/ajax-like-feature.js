(function($) {
	
	'use strict';
	
	var cookieName = '';
	
	$(document).ready(function(e) {
		
		/* ==========================================================================
		Ajax load more
		========================================================================== */
		if($('.pm-like-this-btn').length > 0){
			
			var likebutton = $('.pm-like-this-btn'),
			postID = likebutton.attr('id'),
			likesSpan = $('.pm-likes-title').find('span');
			
			cookieName = 'post_' + postID
						
			//retrieve like value from database
			/*$.post(pulsarajax.ajaxurl, {action:'pm_ln_retrieve_likes', nonce:pulsarajax.nonce, postID:postID}, function(data){
																	
				likesSpan.html(data.currentLikes);
									
			},'json');*/
					
			//activate like btn								
			likebutton.click(function(e){
				
				e.preventDefault();
				
				//check for cookie else increase like value and set cookie for 1 year
				var checkCookie = methods.checkCookie();
				if(!checkCookie){
					
					//set the cookie
					methods.setCookie(cookieName, postID, 365);
					
					//save the post value
					var getLikes = $('.pm-likes-title').find('span').html();
					var intLikes = Number(getLikes);
					var totalLikes = intLikes + 1;
									
					//update span
					likesSpan.html(totalLikes);
					
					//send ajax request to WordPress to store new value
					$.post(pulsarajax.ajaxurl, {action:'pm_ln_like_feature', nonce:pulsarajax.nonce, postID:postID, likes:totalLikes}, function(data){},'json');
					
				}
				
				
				
			});
			
		}
		
	});
	
	
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
	
			setCookie : function(cname, cvalue, exdays) {
							
				var d = new Date();
				d.setTime(d.getTime() + (exdays*24*60*60*1000));
				var expires = "expires="+d.toUTCString();
				document.cookie = cname + "=" + cvalue + "; " + expires;
				
			},
			
			
			getCookie : function(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i=0; i<ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1);
					if (c.indexOf(name) != -1) return c.substring(name.length, c.length);
				}
				return "";
			},
			
			
			checkCookie : function() {
		
				var post = methods.getCookie(cookieName)
				
				if (post != "") {
					//cookies exists
					return true;
				} else {
					//else set the cookie
					return false;
				}
			}
			
			
		};
	
})(jQuery);

