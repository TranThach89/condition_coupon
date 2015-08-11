(function($) {
	
	$(document).ready(function(e) {
		
		'use strict'

		var $colorSelector = $('#pm_theme_color_selector');
		var colorSelectorWidth = $colorSelector.outerWidth();
		
		var $colorSelBtn = $('.pm_theme_color_selector_btn');
		//console.log('$colorSelector.width() = ' + $colorSelector.width());
		var isActive = false;
		
		var primary = '';
		var secondary = '';
		
		var primaryRbg = {};
		var secondaryRbg = {};
		
		var layoutMode = 'pm-full-mode';
		
		var templateDir = templateDirObject.templateDir;
		
		$colorSelBtn.click(function(e) {
			
			var $this = $(this);
            
			if(!isActive){
				isActive = true;
				$colorSelector.animate({
					left : 0
				}, 750);
				
			
			} else {
				isActive = false;	
				$colorSelector.animate({
					left : -colorSelectorWidth
				}, 750);
				
			}
			
        });
		
		//Primary color selector
		/*$('#color-picker').iris({
			width: 150,
        	hide: false,
			palettes: true,
			mode: 'rgb',
			change: function(event, ui) {
				primaryRbg = hexToRgb(ui.color.toString());
				primary = ui.color.toString();
				$('.sf-menu li.current-menu-item').attr('style', 'border-bottom:1px solid '+primary.toString()+'; background-color:rgba('+primaryRbg.r+','+primaryRbg.g+','+primaryRbg.b+',.2) !important');
				$('.pm_span_header h4').css('backgroundColor', primary.toString());
				$('.widget_footer h6').css('borderBottom', '1px solid '+primary.toString()+'');
			}
		});*/
		
		//Theme mode
		$('#pm_theme_color_selector_mode').change(function(e) {
			var val = $(this).val();
			layoutMode = val;
            var $wrapper = $('#pm_layout_wrapper').removeAttr('class').addClass(val);
			
			if(layoutMode === 'pm-full-mode'){
				$('body').attr('style', 'background-color: none !important; background-image:none;');	
			}
			
        });
		
		//Secondary color selector
		/*$('#color-picker2').iris({
			width: 150,
        	hide: false,
			palettes: true,
			mode: 'rgb',
			change: function(event, ui) {
				secondaryRbg = hexToRgb(ui.color.toString());
				secondary = ui.color.toString();
				$('.header_donate_btn a, .pm_slider_btn_large, .pm_slider_btn a, .button-small, .button-large, .searchBtn').css('backgroundColor', ui.color.toString());
				$('.newsletter_submit').attr('style', 'background-color: '+ ui.color.toString() +'');
				$('#back-top a').attr('style', 'color: '+ ui.color.toString() +'');
				$('.pm-hover-item-details a, .pm-hover-item-title-panel b').css('color', ui.color.toString());
				$('.header_social_icons a:hover');
				$('#back-top a, .recentcomments, .tweet_list li a, .pm-hover-item-details a ').css('color', ui.color.toString());
			}
		});*/
		
		//Header color selector
		/*$('#color-picker3').iris({
			width: 150,
        	hide: false,
			palettes: true,
			mode: 'rgb',
			change: function(event, ui) {
				$('header, .pm_footer_info').attr('style', 'background-color: '+ ui.color.toString() +' !important; background-image:none; !important;');
			}
		});*/
		
		$('#back-top a').hover(function(e) {
			$(this).css("color",primary);
		}, function(e) {
			$(this).css("color",secondary);
		});
		
		/*$('.header_social_icons a').hover(function(e) {
			$(this).css("backgroundColor",secondary);
		}, function(e) {
			$(this).css("backgroundColor",'rgba(0, 0, 0, 0.5)');
		});*/
		
		$('.sf-menu li').hover(function(e) {	
			if(!jQuery.isEmptyObject( primaryRbg )){
				$(this).attr('style', 'border-bottom:1px solid '+primary.toString()+'; background-color:rgba('+primaryRbg.r+','+primaryRbg.g+','+primaryRbg.b+',.2) !important');
			}
			
		}, function(e) {
			if(!jQuery.isEmptyObject( primaryRbg )){
				$(this).attr('style', 'border-bottom:1px solid transparent');
				$('.sf-menu li.current-menu-item').attr('style', 'border-bottom:1px solid '+primary.toString()+'; background-color:rgba('+primaryRbg.r+','+primaryRbg.g+','+primaryRbg.b+',.2) !important');
			}
			
		});
		
		//Header/footer bg selector
		if( $('.pm_theme_header_selector').length > 0 ){
			var $selector = $('.pm_theme_header_selector');
			$selector.children().find('a').click(function(e) {
				var $id = $(this).attr('id');
				//console.log('$id = ' + $id);
				
				//apply bg to footer and header
				//var templateImgDir = themeSelectorObject.templatePath;
				var templateImgDir = '';
				$('header, .pm_footer_info').attr('style', 'background-color: none !important; background-image:url("' + templateImgDir + 'img/bgs/'+$id+'-header.png"); !important;');
				
				return false;
			});
		}
		
		//Boxed mode pattern selector
		if( $('#pm_theme_pattern_selector').length > 0 ){
						
			var $selector = $('#pm_theme_pattern_selector');
			$selector.children().find('a').click(function(e) {
				
				if(layoutMode === 'pm-boxed-mode'){
					var $id = $(this).attr('id');	
					$('body').attr('style', 'background-color: none !important; background-image:url("' + templateDir + '/img/boxed-patterns/'+$id+'.png"); !important;');
				} else {
					alert('Please select boxed mode first');
				}				
				return false;
			});
			
		};
		
		//Boxed mode bg selector
		if( $('#pm_theme_background_selector').length > 0 ){
						
			var $selector = $('#pm_theme_background_selector');
			$selector.children().find('a').click(function(e) {
				
				if(layoutMode === 'pm-boxed-mode'){
					var $id = $(this).attr('id');	
					$('body').attr('style', 'background-color: none !important; background-image:url("' + templateDir + '/img/boxed-bgs/'+$id+'.jpg"); !important;');
				} else {
					alert('Please select boxed mode first');
				}				
				return false;
			});
			
		};
		
				
		
    });
	
})(jQuery);

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
	} : null;
}

var isStyleFuncSupported = !!CSSStyleDeclaration.prototype.getPropertyValue;
if (!isStyleFuncSupported) {
    CSSStyleDeclaration.prototype.getPropertyValue = function(a) {
        return this.getAttribute(a);
    };
    CSSStyleDeclaration.prototype.setProperty = function(styleName, value, priority) {
        this.setAttribute(styleName,value);
        var priority = typeof priority != 'undefined' ? priority : '';
        if (priority != '') {
            // Add priority manually
            var rule = new RegExp(RegExp.escape(styleName) + '\\s*:\\s*' + RegExp.escape(value) + '(\\s*;)?', 'gmi');
            this.cssText = this.cssText.replace(rule, styleName + ': ' + value + ' !' + priority + ';');
        } 
    }
    CSSStyleDeclaration.prototype.removeProperty = function(a) {
        return this.removeAttribute(a);
    }
    CSSStyleDeclaration.prototype.getPropertyPriority = function(styleName) {
        var rule = new RegExp(RegExp.escape(styleName) + '\\s*:\\s*[^\\s]*\\s*!important(\\s*;)?', 'gmi');
        return rule.test(this.cssText) ? 'important' : '';
    }
}

// Escape regex chars with \
RegExp.escape = function(text) {
    return text.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
}

// The style function
jQuery.fn.style = function(styleName, value, priority) {
    // DOM node
    var node = this.get(0);
    // Ensure we have a DOM node 
    if (typeof node == 'undefined') {
        return;
    }
    // CSSStyleDeclaration
    var style = this.get(0).style;
    // Getter/Setter
    if (typeof styleName != 'undefined') {
        if (typeof value != 'undefined') {
            // Set style property
            var priority = typeof priority != 'undefined' ? priority : '';
            style.setProperty(styleName, value, priority);
        } else {
            // Get style property
            return style.getPropertyValue(styleName);
        }
    } else {
        // Get CSSStyleDeclaration
        return style;
    }
}