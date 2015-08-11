/**
 * jquery.carousel.js v1.0.0
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
	
	//check for touch detection
	var msGesture = window.navigator && window.navigator.msPointerEnabled && window.MSGesture;
	var touchMode = (( "ontouchstart" in window ) || msGesture || window.DocumentTouch && document instanceof DocumentTouch);
	
	//Touch positions
	var initPageX = 0;
	var trackTouch = 0;
	
	var wrapper = null;
	
	var itemCounter = 0;
	
	var isAnimating = false;
				
	//cache DOM objects
	var carouselContainerWidth = 0;	

	$.PMCarousel = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMCarousel.defaults = {
		// default panel type
		slideAmount : 1,
		touch : true
	};

	$.PMCarousel.prototype = {
		
		_init : function( options ) {
					
			// options
			this.options = $.extend( true, {}, $.PMCarousel.defaults, options );
			// cache some elements and initialize some variables
			this._config();
						
		},
		
		_config : function() {
						
			// support for CSS Transitions & transforms
			this.support = Modernizr.csstransitions && Modernizr.csstransforms;
			this.support3d = Modernizr.csstransforms3d;
			// transition end event name and transform name
			// transition end event name
			var transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				},
				transformNames = {
					'WebkitTransform' : '-webkit-transform',
					'MozTransform' : '-moz-transform',
					'OTransform' : '-o-transform',
					'msTransform' : '-ms-transform',
					'transform' : 'transform'
				};

			if( this.support ) {
				this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMSlider';
				this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
				//console.log('this.transformName = ' + this.transformName);
			}
			
			wrapper = this.$el.find('#pm_carousel_inner');
			carouselContainerWidth = wrapper.width();
			//alert(carouselContainerWidth);
			
			// the list of items
			this.$list = $('#pm_carousel_ul');
			// the items (li elements)
			this.$items = this.$list.children( 'li' );
			// total number of items
			this.itemsCount = this.$items.length;
			//console.log('this.itemsCount = ' + this.itemsCount);
			
			//move the last list item before the first item. The purpose of this is if the user clicks previous he will be able to see the last item.
			$('#pm_carousel_ul li:first').before($('#pm_carousel_ul li:last'));
			
			//Add hover items
			this.$items.each(function(index,element) {
				
				var $this = $(element);
				
				var imgWidth = $this.find('img').width(),
				imgHeight = imgWidth;
				$this.prepend('<div class="pm_carousel_item_hover"></div>');
				$('.pm_carousel_item_hover').css({
					width : imgWidth,
				});
				
				var $hoverInfo = $this.find('.pm-carousel-hover-info');
				
				$hoverInfo.css({
					top : imgHeight
				});
				
			});
			
			this._bindEvents();
			
			//Check for touch support
			/*if (msGesture && this.options.touch) {
				this._activateMSTouch();
			} else if(touchMode && this.options.touch){
				this._activateTouch();	
			};*/
																						
			//define window
			var $window = $(window);
			//Execute on load
			this._onResize();
			//Bind event listener
			$window.resize(this._onResize);
			
			
		},
		
		_onResize : function() {
			
			var parent = this;
			
			var windowWidth = $(window).width();
			
			if(windowWidth < 320){//iphone portrait
				
				wrapper.css({
					width : $(window).width() - 120, //120
				});
				
			} else if(windowWidth < 480) {//mobile landscape
				
				wrapper.css({
					width : $(window).width() - 160,
				});
				
			} else if(windowWidth < 767) {
				
				wrapper.css({
					width : $(window).width() - 155,
				});
				
			} else {//desktop
				wrapper.css({
					width : '',
				});
			}
			
							
			var imgWidth = $('#pm_carousel_ul li').width();
			$('.pm_carousel_item_hover').css({
				width : imgWidth,
			});
							
			//update carousel position
			var item_margin = parseInt($('#pm_carousel_ul li').css("marginLeft")) * 2 ;
			var item_width = $('#pm_carousel_ul li').outerWidth() + item_margin; //tack on right margin
			$('#pm_carousel_ul').css({'left' : -item_width} );
			
			
		},
		
		_activateMSTouch : function() {
						
		},
		
		_activateTouch : function() {
			
			var parent = this;
			
			this.$items.each(function(i,e) {
				
				var el = $(e);
				el.bind('touchstart touchmove touchend', onTouch);
				
			});
			
			
			
			function onTouch(e) {
				
				if(!isAnimating){
					
					if(e.type === 'touchstart'){
						//store touch values
						var xPos = e.originalEvent.touches[0].pageX;
														  
						initPageX = xPos;
														 
						//required for iOS?
						var simulatedEvent = document.createEvent('MouseEvent');
						simulatedEvent.initMouseEvent(type, true, true, window, 1, first.screenX, first.screenY, first.clientX, first.clientY, false, false, false, false, 0/*left*/, null);
						first.target.dispatchEvent(simulatedEvent);
						
						e.preventDefault();
						e.stopPropogation();
						
					}
					
					if(e.type === 'touchmove'){
											
						//store touch values
						var xPos = e.originalEvent.touches[0].pageX;
						
						trackTouch = xPos;
										
						e.preventDefault();
						e.stopPropogation();
						
					}
					
					if(e.type === 'touchend'){
						
						if(trackTouch > initPageX + 70){
							$('#pm_left_scroll a').trigger('click');	
						}
						if(trackTouch < initPageX - 70){
							$('#pm_right_scroll a').trigger('click');
						}
						
					}
					
				}				
					
			}
			
		},
		
		_bindEvents : function() {
			
			var parent = this;
			
			$('#pm_right_scroll a').click(function(e){
								
				e.preventDefault();
				
				if(parent.isAnimating){
					return;
				}
								
				parent.isAnimating = true;
					
				//get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
				var item_margin = parseInt($('#pm_carousel_ul li').css("marginLeft")) * 2 ;
				var item_width = $('#pm_carousel_ul li').innerWidth() + item_margin; //tack on margin
	
				//calculate the new left indent of the unordered list
				var left_indent = parseInt($('#pm_carousel_ul').css('left')) - item_width;
				
				//make the sliding effect using jquery's anumate function
				$('#pm_carousel_ul').animate({
					'left' : left_indent
				},500, function(e) {
					
					//original code: 
					$('#pm_carousel_ul li:last').after($('#pm_carousel_ul li:first')); 
					
					//and get the left indent to the default -180px
					$('#pm_carousel_ul').css({'left' : -item_width} );
					
					parent.isAnimating = false;
					
				});
				
			});
			
			//when user clicks the image for sliding left
			$('#pm_left_scroll a').click(function(e){
				
				e.preventDefault();
				
				if(parent.isAnimating){
					return;
				}
								
				parent.isAnimating = true;
				
				//get the width of the items ( i like making the jquery part dynamic, so if you change the width in the css you won't have o change it here too ) '
				var item_margin = parseInt($('#pm_carousel_ul li').css("marginLeft")) * 2 ;
				var item_width = $('#pm_carousel_ul li').innerWidth() + item_margin; //tack on margin
	
				//calculate the new left indent of the unordered list
				var left_indent = parseInt($('#pm_carousel_ul').css('left')) + item_width;
				
					
				$('#pm_carousel_ul').animate({
					'left' : left_indent
				},500, function(e) {
					/* when sliding to left we are moving the last item before the first item */
					$('#pm_carousel_ul li:first').before($('#pm_carousel_ul li:last'));
		
					/* and again, when we make that change we are setting the left indent of our unordered list to the default -210px */
					$('#pm_carousel_ul').css({'left' : -item_width} );
					
					parent.isAnimating = false;
					
				});
	
			});
			
			//bind interaction events
			this.$items.each(function(index,element) {
				
				var $this = $(element);
				$this.bind('onclick mouseenter mouseleave', function(e) {
					
					if(e.type === 'onclick' || e.type === 'mouseenter'){
						
						var imgHeight = $(this).find('img').height();
						
						$(this).find('.pm_carousel_item_hover').stop().animate({
							opacity : 1,
							height : imgHeight
						},300);
												
						var $hoverInfo = $this.find('.pm-carousel-hover-info');
				
						$hoverInfo.stop().animate({
							top : (imgHeight / 2) - 28,
							opacity : 1
						});
						
					}
					
					if(e.type === 'mouseleave'){
						
						var imgHeight = $(this).find('img').height();
						
						$(this).find('.pm_carousel_item_hover').stop().animate({
							opacity : 0,
							height : 0
						},300);
						
						var $hoverInfo = $this.find('.pm-carousel-hover-info');
				
						$hoverInfo.stop().animate({
							top : imgHeight,
							opacity : 0
						});
						
						
					}
					
				});
			});
			
		},
		
		destroy : function() {

			//add destroy code here
			
		}
		
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.PMCarousel = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMCarousel' );
				if ( !instance ) {
					logError( "cannot call methods on PMCarousel prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMCarousel instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMCarousel' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'PMCarousel', new $.PMCarousel( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );