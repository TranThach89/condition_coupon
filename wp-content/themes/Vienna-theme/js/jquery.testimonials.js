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
				
	var slideshowTimer = null;
	var slideShowPaused = false;

	$.PMTestimonials = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMTestimonials.defaults = {
		// default panel type
		speed : 500,
		slideShow : false,
		slideShowSpeed : 1000,
		controlNav : false,
		arrows : true
	};

	$.PMTestimonials.prototype = {
		
		_init : function( options ) {
						
			var parent = this;
												
			// options
			this.options = $.extend( true, {}, $.PMTestimonials.defaults, options );
			
			this._config();
			
			this._initEvents();
						
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
				this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMTestimonials';
				this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
				//console.log('this.transformName = ' + this.transformName);
			}
			
			this.$items = this.$el.children('li');
			
			this.$items.eq(0).addClass('active');
			this.$items.eq(0).find('.pm-testimonials-widget-name p').addClass('active');
			
			// total number of items
			this.itemsCount = this.$items.length;
			
			// current and old item´s index
			this.current = 0;
			this.old = 0;
			
			//check if the list is currently animating
			this.isAnimating = false;
			
			// add bullets if there is more than 1 item
			if( this.itemsCount > 1 ) {
				
				// add navigation dots
				var dots = '';
				var len = this.itemsCount;
				
				for( var i = 0; i < len; ++i ) {
					// current dot will have the class pm-currentDot
					var dot = i === this.current ? '<li><span class="pm-testimonial-active"></span></li>' : '<li><span></span></li>';
					dots += dot;
				}
				var navDots = $('#pm-testimonials-carousel-bullets').append(dots);
				
				this.$navDots = $('#pm-testimonials-carousel-bullets').children('li');
				
				//highlight the first bullet
				this.$navDots.eq(0).addClass( 'pm-testimonial-active' );
				
				if(this.options.slideShow){
					
					//run slideshow
					this._runSlideShow('start');
					
				}
											
			}//end of add bullets
			
			//initialize resize
			this._resize();
			
			//resize container on window resize
			$(window).resize(this._resize);
			
			
		},
		
		_initEvents : function() {
			
			var parent = this;
			if( this.itemsCount > 1 ) {
								
				//activate bullets
				if(this.options.controlNav === true){
					this.$navDots.on( 'click', function() { 
						parent._jump( $(this).index() );
						if(parent.options.slideShow){
							parent._runSlideShow('pause');
						}
					});
				} 
				
				//active arrows
				if(this.options.arrows === true){
					parent._activateArrows();	
				}
				
			}
			
		},
		
		_activateArrows : function() {
			
			var parent = this;
						
			$('#pm-testimonials-arrows').children('li').each(function(index, element) {
                
				var $this = $(this);
				
				$this.click(function(e) {
					
					parent.old = parent.current;
										
					var id = $(this).find('a').attr('id');
					
					parent.isAnimating = true;
					parent._runSlideShow('pause');
					
					if(id == 'pm-next'){
						
						parent.current++;
						
						if(parent.current > parent.itemsCount - 1) {
							//set to first slide
							parent.current = 0;
						}
						
						
					} else if(id == 'pm-prev'){
						
						parent.current--;
						
						
						if(parent.current < 0) {
							//jump to last slide
							parent.current = parent.itemsCount - 1;
						}
						
						
					} else {
						//do nothing	
					}
														
					parent._fade();
					
					e.preventDefault();
					
				});
				
            });
			
		},
		
		_resize : function() {
			
			var parent = this;
			
			//fade code
			var items = $('.pm-testimonials-widget-quotes').children('li');
			
			//fade out current testimonial
			items.each(function(i, el) {
				var $this = $(el);
				if($this.hasClass('active')){
					
					var ulHeight = $this.height();
					//console.log(ulHeight);
					$('.pm-testimonials-widget-quotes').css({
						'height' : ulHeight
					});
					
				}
			});
			
		},
		
		_runSlideShow : function(status) {
			
			var parent = this;
			
			switch(status) {
			
				case 'start' :
				
					//clear any previous instance of slideshowTimer first
					if(slideshowTimer !== null) {
						clearInterval(slideshowTimer);
						slideshowTimer = null;
					}
					
					slideShowPaused = false;
					
					slideshowTimer = setInterval(function(){
						
						if(!parent.isAnimating){
							return parent._jump(parent.current + 1);
						}
						
					}, this.options.slideShowSpeed);
				
				break;
				
				case 'pause' :
					//clear slideshow
					clearInterval(slideshowTimer);
					slideshowTimer = null;
					slideShowPaused = true;
				
				break;
				
			}
			
			
		},
		
		_toggleNavControls : function() {
				
			if( this.current >= this.itemsCount ){
				this.$navDots.eq( this.old ).removeClass( 'pm-testimonial-active' ).end().eq( 0 ).addClass( 'pm-testimonial-active' );
			} else {
				this.$navDots.eq( this.old ).removeClass( 'pm-testimonial-active' ).end().eq( this.current ).addClass( 'pm-testimonial-active' );
			}
				
		},
		
		_jump : function( position ) {
			
			//console.log('position = ' + position);
			
			var parent = this;
												
			// do nothing if clicking on the current dot, or if the list is currently moving
			if( position === this.current || this.isAnimating ) {
				return false;
			}
			
			this.isAnimating = true;
			
			if(this.options.slideShow){
				
				if(position > this.itemsCount - 1) {
					position = 0;
				}
				
			}
									
			this.old = this.current;
			this.current = position;
			
			this._fade();
			
			this._toggleNavControls();
			
		},
		
		_fade : function() {
			
			var parent = this;
			
			//fade code
			var items = this.$items;
			var current = this.current;
			var old = this.old;
			var speed = this.options.speed;
			
			//fade out current testimonial
			items.each(function(i, el) {
				var $this = $(el);
				
				if(i == old){
					$this.fadeOut(speed, fadeComplete);
				}
			});
			
			//fade in next slide
			function fadeComplete() {
				items.each(function(i, el) {
					var $this = $(el);
					$this.removeClass('active');
					
					if(i == current){
						var ulHeight = $this.height();
						
						parent.$el.animate({
							'height' : ulHeight
						}, 500);
						$this.fadeIn(speed, transitionendfn);
						$this.addClass('active');
						
					}
				});
			}
			
			var transitionendfn = $.proxy( function() {
				this.isAnimating = false;	
				
				if(parent.options.slideShow && slideShowPaused){
					parent._runSlideShow('start');
				}		
						
			}, this );
			
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

	$.fn.PMTestimonials = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMTestimonials' );
				if ( !instance ) {
					logError( "cannot call methods on PMTestimonials prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMTestimonials instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMTestimonials' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'PMTestimonials', new $.PMTestimonials( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );