/**
 * jquery.hoverPanel.js v1.0.0
 * http://www.pulsarmedia.ca
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Pulsar Media
 * http://www.pulsarmedia.ca
 */
;( function( $, window, undefined ) {

	'use strict';

	// global
	var Modernizr = window.Modernizr;
			
	//cache DOM objects
	var object = null;
	
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	
	var windowWidth = $(window).width();

	$.PMToolTip = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMToolTip.defaults = {
		// default panel type
		floatType : 'float',
	};

	$.PMToolTip.prototype = {
		
		_init : function( options ) {
			
			var parent = this;
			
			$(window).resize(parent._checkResize);
												
			// options
			this.options = $.extend( true, {}, $.PMToolTip.defaults, options );
			
			this.$el.each(function( key, value ) {
								
				var $obj = $(this);
				
				$obj.hover(function(e) {
																
					var $this = $(this);
					var title = $this.attr('title');
					
					if(title != undefined && !isiPad && windowWidth > 980){
						//console.log(title);
						parent._addToolTip(title, $this);
					};
					
					
				}, function(e){
					
					var $this = $(this);
					var title = $this.attr('title');
					
					if(title != undefined && !isiPad && windowWidth > 980){
						//console.log(title);
						//remove tooltip
						$("#pm_marker_tooltip").remove();
					};
					
				});
				
			});
						
		},
		
		_addToolTip : function(toolTipData, el) {
			
			var parent = this;
			
			var $el = $(el);
			//alert($el.offset().left);
			
			if(parent.options.floatType == 'staticTop'){
				$("body").append("<div id='pm_marker_tooltip' class='pm_tip_arrow_top'>"+ toolTipData +"</div>");
			} else if(parent.options.floatType == 'staticBottom') {
				$("body").append("<div id='pm_marker_tooltip' class='pm_tip_arrow_bottom'>"+ toolTipData +"</div>");
			} else if(parent.options.floatType == 'float') {
				$("body").append("<div id='pm_marker_tooltip'>"+ toolTipData +"</div>");
			}
			
			var yOffset = $("#pm_marker_tooltip").height() + 20;
			var xOffset = -$("#pm_marker_tooltip").width() + 40;
											 
			$("#pm_marker_tooltip").css({

				"top" : ($el.pageY - xOffset) + "px",
				"left" : ($el.pageX + yOffset) + "px",
			});
				
			//$('#pm_marker_tooltip').css("top", ($el.offset().top - yOffset) + "px").css("left",+ ($el.offset().left - xOffset) + "px").css({marginTop:0,opacity:1}); //start position
			
			
			if(parent.options.floatType == 'float'){
				
				$($el).mousemove(function(e){
								
					var mouseX = e.pageX;
					var mouseY = e.pageY;
					//console.log(yOffset);
					$('#pm_marker_tooltip').css("top",(mouseY - yOffset) + "px").css("left",(mouseX + xOffset) + "px");	
									
				});	
				
			}
			
			if(parent.options.floatType == 'staticBottom'){ //below the element
				
				var tipWidth = $("#pm_marker_tooltip").width();
				$('#pm_marker_tooltip').css("top", ($el.offset().top + $el.innerHeight()) + 5 ).css("left", $el.offset().left - (tipWidth / 2));	
				
				
			}
			
			if(parent.options.floatType == 'staticTop'){ //above the element
				
				var tipWidth = $("#pm_marker_tooltip").width();
				var tipHeight = $("#pm_marker_tooltip").height();
				$('#pm_marker_tooltip').css("top", ( ($el.offset().top - $el.height()) + 6 )).css( "left", $el.offset().left - (tipWidth / 2) + 10 ).css("opacity" , 1).css("marginTop" , 0);	

				
			}

		},
		
		_checkResize : function() {
			windowWidth = $(window).width();
		},
		
		destroy : function() {

			//add destroy code here
			$("#pm_marker_tooltip").remove();
		}
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.PMToolTip = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMToolTip' );
				if ( !instance ) {
					logError( "cannot call methods on PMToolTip prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMToolTip instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMToolTip' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'PMToolTip', new $.PMToolTip( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );