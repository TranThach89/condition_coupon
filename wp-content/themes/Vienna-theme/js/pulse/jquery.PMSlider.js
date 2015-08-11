/**
 * jquery.PMSlider.js v1.0.0
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
	//var operaBrowser = window.opera && window.opera.version;
	
	//container for thumbnail data
	var thumbsData = [];
	
	//cache DOM objects for faster fullScreen calculations
	var pmContainer = null;
	var pmSlider = null;
	var pmSlidesContainer = null;
	var pmImages = [];
	
	//Progress bar
	var sliderStart = 0;
	var sliderMaxTime = 0;
	var sliderTimeoutVal = 0;
	var sliderPerc = 0;
	var slideshowTimer = null;
	
	//Animation vars
	var currAnimSlide = 0;
	
	//Touch positions
	var initPageX = 0;
	var trackTouch = 0;
	
	$.PMSlider = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMSlider.defaults = {
		// default transition speed (ms)
		speed : 500,
		// default transition easing
		easing : 'ease', //ease-in - ease-out - ease
		// loop slides
		loop : false, //true or false
		//default dots nav
		controlNav : 'thumbnails', //true - false - 'thumbnails'
		//add thumbs to bullets
		controlNavThumbs : false,
		//animation type
		animation : 'fade', //fade - slide
		//set fullscreen mode
		fullScreen : false, //false or true
		//slideshow
		slideshow : false, //false or true
		//slideshow speed
		slideshowSpeed : 2000,
		//pause slideshow on hover
		pauseOnHover: false,
		//toggle arrows on or off
		arrows : true,
		//fixed height
		fixedHeight: false,
		//default fixed height value
		fixedHeightValue : 800,
		//activate touch
		touch: false,
		//slideshow progress bar
		progressBar: true
	};

	$.PMSlider.prototype = {
		
		_init : function( options ) {
			// options
			this.options = $.extend( true, {}, $.PMSlider.defaults, options );
			// cache some elements and initialize some variables
			this._config();
			// initialize/bind the events
			this._initEvents();
			//initialize fullscreen mode if true
			this._initFullScreen();
			//initialize slideshow
			this._slideShow();
									
		},
		
		_config : function() {
									
			var parent = this;
			
			// the list of items
			this.$list = this.$el.children( 'ul' );
						
			//Clone li's for Infinite loop
			if(this.options.loop && this.options.animation == 'slide'){
				//clone first and last elements
				var $firstChild = this.$list.children( 'li:first-child' );
				var $lastChild = this.$list.children( 'li:last-child' );
				this.$list.append( $firstChild.clone(true).addClass('clone') ).prepend( $lastChild.clone(true).addClass('clone'));
			}
						
			// the items (li elements)
			this.$items = this.$list.children( 'li' );
			
			// total number of items
			this.itemsCount = this.$items.length;
			//console.log('this.itemsCount = ' + this.itemsCount);
			
			//cache slider img's
			$('#pm-slider ul li img').each(function(index, element) {
				var $el = $(element);
				pmImages.push($el);
				//console.log(pmImages[0]);
			});
			
			//Append arrow code
			if(this.options.arrows && this.itemsCount > 1){
				$('#pm-slider').append('<nav id="pm-nav-arrows"><span class="pm-prev reset-pulse-sizing"><div class="pm-slide-count"></div><i class="fa fa-angle-left"></i></span><span class="pm-next reset-pulse-sizing"><div class="pm-slide-count"></div><i class="fa fa-angle-right"></i></span></nav>');
			}
			
			
			//Store data and collapse captions for animating
			this.$items.each(function(i, el) {
				var $el = $(el);
				var titleWidth = $el.find('h1').width();
				var captionWidth = $el.find('.pm-caption-decription').width();
				$el.data("properties", { "titleWidth" : titleWidth, "captionWidth" : captionWidth });//This works but does not show up in firebug!
			});
			
			//if fade, hide all li's and fadeIn the first li
			if(this.options.animation == 'fade'){
				this.$items.each(function(i, el) {
					var $this = $(el);
					if(i != 0){
						$this.fadeOut('fast'); //fadeOut() works better than hide()
					}
				});
			}
			
			//retrieve thumbnail data
			if(this.options.controlNav == 'thumbnails'){
				this.$items.each(function(i, el) {
					var $this = $(el);
					thumbsData.push($this.data('thumb'));
				});
				//splice out clones
				if(this.options.loop && this.options.animation == 'slide'){
					thumbsData.splice(0,1);
					thumbsData.splice(this.itemsCount - 2,1);
				}
			}
			
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
			
			// current and old item´s index
			this.current = 0;
			this.old = 0;
			
			//set the starting slide if loop is true
			if(this.options.loop && this.options.animation == 'slide'){
				var translateVal = -1 * ( this.current++ ) * 100 / this.itemsCount;
				//console.log('translateVal = ' + translateVal);
				this.$list.css( 'margin-left', -1 * this.current * 100 + '%' );	
				this.current--;
			}
			
			//check if the list is currently moving
			this.isAnimating = false;
			
			//the list (ul) will have a width of 100% x itemsCount
			this.$list.css( 'width', 100 * this.itemsCount + '%' );
			
			//set fixed height mode
			if(this.options.fixedHeight) {
								
				this.$list.css({
					'position' : 'relative'	
				});
				
				//var imgHeight = this.$items.find('img').height();
								
				this.$items.find('img').css({
					'maxWidth'	: 'inherit'
				});	
				this.$items.css({
					'height' : this.options.fixedHeightValue+'px'
				});
				
								
			}
			
			// apply the slide transition
			if( this.support && this.options.animation == 'slide' ) {
				this.$list.css( 'transition', this.transformName + ' ' + this.options.speed + 'ms ' + this.options.easing );
			}
			
			// each item will have a width of 100 / itemsCount
			this.$items.css( 'width', 100 / this.itemsCount + '%' );

			
			// add navigation arrows and navigation dots/thumbnails if there is more than 1 item
			if( this.itemsCount > 1 ) {

				if(this.options.controlNav === true){
					
					// add navigation dots
					var dots = '';
					var len = this.options.loop && this.options.animation == 'slide' ? this.itemsCount - 2 : this.itemsCount;
					
					for( var i = 0; i < len; ++i ) {
						// current dot will have the class pm-currentDot
						var dot = i === this.current ? '<span class="pm-currentDot"></span>' : '<span></span>';
						dots += dot;
					}
					var navDots = $( '<div class="pm-dots"/>' ).append( dots ).appendTo( this.$el );
					this.$navDots = navDots.children( 'span' );
					
					//Add tooltip functionality
					if(this.options.controlNavThumbs === true){
						
						this.$navDots.each(function(i,el) {
						
							$(this).hover(function(e) {
								
								var thumbData = $('.pmslide_'+i).data('thumb');
								
								if(thumbData != ''){
									parent._toolTip(thumbData, this);
								}
								
							}, function(e) {
								
								var thumbData = $('.pmslide_'+i).data('thumb');
								
								if(thumbData != ''){
									$("#pm_slider_tooltip").remove();
								}
								
							});
							
						});
					}
					
				} else if(this.options.controlNav == 'thumbnails') {
					
					var thumbs = '';
					var len = this.options.loop && this.options.animation == 'slide' ? this.itemsCount - 2 : this.itemsCount;
					//console.log('len = ' + len);
					
					for( var i = 0; i < len; ++i ) {
						// current dot will have the class pm-currentDot
						var thumb = i === this.current ? '<span class="pm-currentThumb"><img src="'+ thumbsData[i] +'" /></span>' : '<span><img src="'+ thumbsData[i] +'" /></span>';
						thumbs += thumb;
					}
					
					var navThumbs = $( '<div class="pm-thumbs"/>' ).append( thumbs ).appendTo( this.$el );
					this.$navThumbs = navThumbs.children( 'span' );
					
				} else {
					//default	
				}//end of if
				
									
				if(!this.options.loop && this.options.animation == 'slide'){
					
					this.$navPrev = $( '.pm-prev' ).hide();
					
				} else if(!this.options.loop && this.options.animation == 'fade') {
					
					this.$navPrev = $( '.pm-prev' ).hide();
					
				} else {
					
					this.$navPrev = $( '.pm-prev' ).show();
					
				}
				
				this.$navNext = $( '.pm-next');
				

			}//end of if
			
			
			//remove images from html and apply as css backgrounds for fixedHeight mode
			if(this.options.fixedHeight){
				this.$items.find('img').remove();	
				
				this.$items.each(function(index, element) {
					var $this = $(element);
					$this.css({
						'backgroundImage' : 'url('+pmImages[index].attr('src')+')',
						'backgroundPosition' : 'center center'
					});
				});
				
			};
			
			//Check for touch support
			if (msGesture && this.options.touch) {
				this._activateMSTouch();
			} else if(touchMode && this.options.touch){
				this._activateTouch();	
			};
			
			//Btn slide activation - should only apply if Arrows are active
			if(this.options.arrows){
								
				if(this.options.animation == 'fade'){//no clones
					$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount);
				} else if(!this.options.loop) {//no loop
					$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount);
				} else {//clones and loop
					$('.pm-slide-count').html((this.current + 1) + ' / ' + (this.itemsCount - 2));
				}
				
				var btnHeight = $('.pm-next').height();
				var btnWidth = $('.pm-next').width();
				
				$('.pm-next, .pm-prev').hover(function(e) {
					
					var $el = $(this);
					$el.stop().animate({
						'width' : '30px'
					}, 100);
					$el.find('i').stop().animate({
						'marginTop' : '7px'	
					});
					$el.find('.pm-slide-count').fadeIn('fast');
					
					
				}, function(e) {
					
					var $el = $(this);
					$el.stop().animate({
						'width' : btnWidth	
					}, 100);
					$el.find('i').stop().animate({
						'marginTop' : '0px'	
					});
					$el.find('.pm-slide-count').fadeOut('fast');
					
				});
				
			};
			
			//execute first animation on initial load
			parent._resetAnimation();
						
			
			//Check if first slide is loaded and fade in slider
			if(parent.options.animation == 'slide' && !parent.options.loop){
							
				//alert('no loop');
							
				$('#pm-pulse-loader').hide();
				$('#pm-slider').css({
					height : 'auto'	
				});
				$('#pm-slider').animate({
					opacity : 1
				});
				parent._animateSlide(this.current);
				
				
			} else if(parent.options.animation == 'slide') {
																
				$('#pm-slider').css({
					height : 'auto'	
				});
								
				$('#pm-slider').animate({
					opacity : 1
				}, 500, function(e) {
					parent._animateSlide(parent.current);					
				});
				
				$('#pm-pulse-loader').hide();
				
			} else {
				
				
				$('#pm-pulse-loader').hide();
				$('#pm-slider').css({
					height : 'auto'	
				});
				$('#pm-slider').animate({
					opacity : 1
				});
				parent._animateSlide(this.current);	
				
				
			}
			
			
			//console.log('starting this.current = ' + this.current);

		},
		
		_animateSlide : function(currSlide) {
			
			
																		
			//Animate the first slide
			var $slide = $('.pmslide_'+currSlide);
			//console.log('$slide = ' + $slide.attr('class'));	
			
			var title = $slide.find('h1');
			var subTitle = $slide.find('h2');
			var caption = $slide.find('.pm-caption-decription');
			var btn = $slide.find('.pm-slide-btn');
			
			
			
			if(title.length > 0){

				title.css('transition' , 'all .6s ease 0s');
				title.css({
					'opacity' : 1, 
					marginTop : 0	
				});
								
			}
			
			if(subTitle.length > 0){
				subTitle.css('transition' , 'all .6s ease 0s');
				subTitle.css({
					'opacity' : 1, 
					marginLeft : 0	
				});
			}
			
			if(caption.length > 0){
				caption.css('transition' , 'all .6s ease 0s');
				caption.css({
					'opacity' : 1, 
					marginLeft : 0	
				});
			}
			
			if(btn.length > 0){
				btn.css('transition' , 'all .6s ease 0s');
				btn.css({
					'opacity' : 1, 
					'marginTop' : 80	
				});
			}
			
		},
		
		_resetAnimation : function() {
			
			var parent = this;
			
			this.$items.each(function(i, el) {
				
				var $el = $(el);
				
				var title = $el.find('h1');
				var subTitle = $el.find('h2');
				var caption = $el.find('.pm-caption-decription');
				var btn = $el.find('.pm-slide-btn');
				
				if(title.length > 0){
					
					title.finish().css({
						'opacity' : 0, 
						marginTop : -50	
					});
					
				}
				
				if(subTitle.length > 0){
					
					subTitle.finish().css({
						'opacity' : 0, 
						'marginLeft' : 0
					});
					
				}
				
				if(caption.length > 0){
					//caption.stop();
					caption.finish().css({
						'opacity' : 0,	
						'marginLeft' : 0
					});
				}
				
				if(btn.length > 0){
					//btn.stop();
					btn.finish().css({
						'opacity' : 0,
						'marginTop' : 200	
					},0);
				}
				
			});
			
		},

		
		//Add touch support for mobile devices
		_activateTouch : function() {
									
			var parent = this;
									
			this.$items.each(function(i,el){
				
				/*var deviceAgent = navigator.userAgent.toLowerCase();
				var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
				if (agentID) {	}; */
								
				el.addEventListener('touchstart', onTouchStart, false);
				el.addEventListener('touchmove', onTouchMove, false);
				el.addEventListener('touchend', onTouchEnd, false);
				
				function onTouchStart(event){
					
					//store touch values
					var touches = event.changedTouches,
								  first = touches[0];
								  
					initPageX = first.pageX;
					$('#pm-touchstart').html('Touch start = ' + initPageX);//Debugger
								 
					//required for iOS?
					var simulatedEvent = document.createEvent('MouseEvent');
					simulatedEvent.initMouseEvent(type, true, true, window, 1, first.screenX, first.screenY, first.clientX, first.clientY, false, false, false, false, 0/*left*/, null);
					first.target.dispatchEvent(simulatedEvent);
					
					event.preventDefault();
					
				};
				
				function onTouchMove(event){
					
					//store touch values
					var touches = event.changedTouches,
								  first = touches[0];
								  
					trackTouch = first.pageX;
					
					//$('#pm-touchmove').html('Touch move = ' + first.pageX + ' and Touch start = ' + initPageX);//Debugger
					
					//event.preventDefault();
					
				};
				
				function onTouchEnd(event){
					
					if(trackTouch > initPageX + 60){
						$('#pm-swipe').html('Swiping right');//Debugger
						parent._executeTouch('right');	
					}
					if(trackTouch < initPageX - 60){
						$('#pm-swipe').html('Swiping left');//Debugger
						parent._executeTouch('left');
					}
					
				}
				
				
			});
						
			
		},
		
		_activateMSTouch : function() {
						
			var parent = this;
			
			this.$items.each(function(i,el){
				
				el.style.msTouchAction = "none"; //this is required!!
				var g = new MSGesture();
				g.target = el;
				el.addEventListener("MSPointerDown", assignPointer, false);
				el.addEventListener("MSGestureChange", onMSGestureChange, false);
				el.addEventListener("MSGestureEnd", onMSGestureEnd, false);
				
				function assignPointer(e){
					
					try {                                              
						g.target = e.target;   // Emulate old implicit targeting
					} catch (err) {}           // If gesture has already started, catch and ignore

					
					if (e.target == g.target) {
						g.addPointer(e.pointerId);   // Emulate implicit pointer association
						initPageX = e.screenX;
						
						$('#pm-touchstart').html('MS Touch start = ' + initPageX);//Debugger
					}
					
					e.stopPropagation();
					
				};
				
				function onMSGestureChange(e) {
					
					trackTouch = e.screenX;
										 
					$('#pm-touchmove').html('MS Touch move = ' + e.screenX + ' and Touch start = ' + initPageX);//Debugger
					  
					e.preventDefault();
					 
				};
				
				function onMSGestureEnd(e) {
					
					if(trackTouch > initPageX + 30){
						$('#pm-swipe').html('Swiping right');//Debugger
						parent._executeTouch('right');	
					}
					if(trackTouch < initPageX - 30){
						$('#pm-swipe').html('Swiping left');//Debugger
						parent._executeTouch('left');
					}
					
				}
				
			});
			
		},
			
		
		_executeTouch : function(direction) {
												
			switch(direction){ 
				case 'right' :
				
					if(this.options.animation == 'slide') {
						this._navigate('previous');		
					} else if(this.options.animation == 'fade'){
						this._navigate('next');		
					}
								
				break;
				
				case 'left' :
				
					if(this.options.animation == 'slide') {
						this._navigate('next');	
					} else if(this.options.animation == 'fade'){
						this._navigate('previous');		
					}
					
				break;
			}
			
		},
		
		_initFullScreen : function() {
			
			var parent = this;
			
			if(this.options.fullScreen){
								
				//cache #pm-container object
				pmContainer = $('#pm-container');
				//apply css properties
				pmContainer.css({
					"overflow" : "hidden",
					"width" : "100%",
					"position" : "relative"
				});
				
				//cache #pm-slider object
				pmSlider = $('#pm-slider');
				//apply css properties
				pmSlider.css({
					"height" : "100%",
					"position" : "relative"
				});
				
				//cache .pm-slides-container
				pmSlidesContainer = $('.pm-slides-container');
				//apply css properties
				pmSlidesContainer.children().css({
					"overflow" : "hidden",
					"height" : "100%",
					"position" : "absolute",
					"top" : "0"
				});
				
				//apply css classes to children
				pmSlidesContainer.children().css({
					"height" : "100%",
					"position" : "relative"
				});
				
				//parse through cached img's
				$.each(pmImages, function(index, value) {
					value.css({
						"max-width" : "none",
						"left" : "0",
						"top" : "0",
						"position" : "absolute",
						"z-index" : "-1"
					});
				});
				
				//define window
				var $window = $(window);
				//Execute on load
				this._checkWidth();
				//Bind event listener
				$window.resize(this._checkWidth);
				
								
			}//end of if
			
		},
		
		_checkWidth : function() {
						
			var parent = this;
							
			setTimeout(function() {
						
				var $window = $(window);
				var $windowWidth = 0;
				var $windowHeight = 0;
				$windowWidth = $window.width();
				$windowHeight = $window.height();
				//console.log('windowWidth = ' + $windowWidth + ' windowHeight = ' + $windowHeight);
				
				//apply width to pm-thumbs container and li elements
				pmContainer.height($windowHeight);
				pmSlidesContainer.height($windowHeight);
				//pmSlider.width($windowWidth);
				//pmSlider.height($windowHeight);
						
				//apply width, height and aspect ratio to imgs
				$.each(pmImages, function(index, value) {
															
					var img = value;					
					var imgWidth = img.width();
					var imgHeight = img.height();
					
					var container_aspect_ratio = $windowHeight / $windowWidth; 
					//console.log('container_aspect_ratio = ' + container_aspect_ratio);
					
					var image_aspect_ratio = imgHeight / imgWidth;
					//console.log('image_aspect_ratio = ' + image_aspect_ratio);
					
					if (container_aspect_ratio > image_aspect_ratio) {
						
					  img.css({
						height: $windowHeight,
						width: $windowHeight / image_aspect_ratio,
					  });
					  
					  //img.attr('style', 'height:'+$windowHeight+'; width:'+$windowHeight / image_aspect_ratio+';'); //for testing purposes
				
					} else {
						
					  img.css({
						height: $windowWidth * image_aspect_ratio,
						width: $windowWidth,
					  });
										  
					}
					
					//get the dynamic width and height of the slide img to supply the correct left and top positioning
					img.css({
						left : ($windowWidth - pmSlidesContainer.children().find('img').width() ) / 4, 
						top : ($windowHeight - pmSlidesContainer.children().find('img').height() ) / 4,
					});
					 
					//console.log('top = ' + ($windowHeight - pmSlidesContainer.children().find('img').height() ) / 4);
					//console.log('left = ' + ($windowWidth - pmSlidesContainer.children().find('img').width() ) / 4);
					
				});

			
		  }, 10);
			  
			
		},		
						
		_initEvents : function() {
			
			var parent = this;
			if( this.itemsCount > 1 ) {
				
				this.$navPrev.on( 'click.PMSlider', $.proxy( this._navigate, this, 'previous' ) );
				this.$navNext.on( 'click.PMSlider', $.proxy( this._navigate, this, 'next' ) );
				
				//activate nav
				if(this.options.controlNav === true){
					this.$navDots.on( 'click.PMSlider', function() { 
						parent._jump( $( this ).index() ); 
					});
				} else if(this.options.controlNav === 'thumbnails'){
					this.$navThumbs.on( 'click.PMSlider', function() { 
						parent._jump( $( this ).index() ); 
					});
				} else {
					//default	
				}
				
			}

		},
		
		_navigate : function( direction ) {
					
			var parent = this;
							
			// do nothing if the list is currently moving
			if( this.isAnimating || this.itemsCount == 1 ) {
				return false;
			}
			
			// do nothing if there is only one slide
			if(this.options.loop && this.options.animation == 'slide' && this.itemsCount == 3){
				return false;
			}
			
			this.isAnimating = true;
			
			//Animate slide
			parent._resetAnimation();
						
			// update old value to current value
			if(this.options.slideshow){
				
				//check for 'next' direction only
				if( this.current == this.itemsCount-1 && direction == 'next'){
					this.old = this.itemsCount-1
				    this.current = -1;
			    } else {
					this.old = this.current;	
				}
				
			} else {
				this.old = this.current;
			}
						
			//update current value
			if( direction === 'next' && this.current <= this.itemsCount ) {
				//console.log('next');
				++this.current;
				if(this.options.loop && this.options.animation == 'fade'){
					if(this.current >= this.itemsCount){
						this.current = 0;
					}
				}
			}
			else if( direction === 'previous' && this.current >= 0 ) {
				//console.log('previous');
				--this.current;
				if(this.options.loop && this.options.animation == 'fade'){
					if(this.current == -1){
						this.current = this.itemsCount - 1;
					}
				}
			}
						
			// slide
			if(this.options.animation == 'slide'){ this._slide(); }
			// fade
			if(this.options.animation == 'fade'){ this._fade(); }
			
			//console.log('this.current = ' + this.current + ' and this.old = ' + this.old);
			
			//Update the btn paging for the correct values
			if(this.options.loop && this.options.animation == 'slide') {
				
				if((this.current + 1) > (this.itemsCount - 2)) {
					$('.pm-slide-count').html('1 / ' + (this.itemsCount - 2));
				} else if((this.current) < 0){
					$('.pm-slide-count').html((this.itemsCount - 2) + ' / ' + (this.itemsCount - 2));
				} else {
					$('.pm-slide-count').html((this.current + 1) + ' / ' + (this.itemsCount - 2));	
				}
				
			} else if(!this.options.loop){
				
				$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount );
				
			} else if(this.options.animation == 'fade') {
				$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount);
			}
			
			
			//Animate slide
			//parent._resetAnimation();
			
			

		},
		
		_runSlideShow : function(status) {
									
			var parent = this;
			
			//Run a single instance of setInterval
						
			if(status == 'start'){
				
				//clear any previous timer instances first
				if(slideshowTimer !== null) {
					clearInterval(slideshowTimer);
					slideshowTimer = null;
				}
				
				$('#pm-slider-progress-bar').remove();
				$('#pm-slider').append('<div id="pm-slider-progress-bar"></div>');
				
				if(!parent.options.progressBar){
					$('#pm-slider-progress-bar').css({display:'none'});
				}
				
				//initialize slideshow
				sliderStart = new Date();
				sliderMaxTime = parent.options.slideshowSpeed;
				sliderTimeoutVal = Math.floor(sliderMaxTime/100);
				sliderPerc = 0;
				
				slideshowTimer = window.setInterval(function(){
					
					var now = new Date();
					var timeDiff = now.getTime() - sliderStart.getTime();
					var perc = Math.round((timeDiff/sliderMaxTime)*100);
					sliderPerc = perc;
					
					if (perc <= 105) {
					   $('#pm-slider-progress-bar').css("width", perc + "%");
					} else {
						clearInterval(slideshowTimer);
						slideshowTimer = null;
						$('#pm-slider-progress-bar').css("width", '0');
						if(!parent.isAnimating){
							return parent._autoplay();
						}
					}
					
				}, sliderTimeoutVal);
				
			} else if(status == 'pause'){
				
				//clear slideshow
				if(slideshowTimer !== null) {
					clearInterval(slideshowTimer);
					slideshowTimer = null;
				}
				
			} else if(status == 'resume'){
				
				//resume slideshow
				slideshowTimer = window.setInterval(function(){
					
					sliderPerc++;
					
					if (sliderPerc <= 105) {
					   $('#pm-slider-progress-bar').css("width", sliderPerc + "%");
					} else {
						clearInterval(slideshowTimer);
						slideshowTimer = null;
						sliderPerc = 0;
						$('#pm-slider-progress-bar').css("width", '0');
						if(!parent.isAnimating){
							return parent._autoplay();
						}
					}
					/*if(!parent.isAnimating){
						return parent._autoplay();
					}*/
				}, sliderTimeoutVal);
				
			}
			
			
		},
				
		_slideShow : function() {
						
			var parent = this;
						
			if(this.options.slideshow){
				
				if( this.options.animation === 'slide' && this.itemsCount > 3 ){
					
					parent._runSlideShow('start');	
					
				} else if(this.options.animation === 'fade' && this.itemsCount > 1){
					
					parent._runSlideShow('start');				
				
					
					
				}
				
				parent._bindMouseEvents();
								
			};
			
		},
		
		_bindMouseEvents : function() {
			
			var parent = this;
						
			if(this.options.pauseOnHover){
				//add mouseenter event to pause slideshow
				$('#pm-slider').bind('mouseenter mouseleave mousemove', function(event) {
					
					if(event.type == 'mouseenter'){
						//console.log('pause');					
						//remove timer on mouseenter
						parent._runSlideShow('pause');
						
					} else if(event.type == 'mouseleave'){
						//console.log('resume');
						parent._runSlideShow('resume');
												
					} else if(event.type == 'mousemove'){
						//default	
						parent._runSlideShow('pause'); //Might be a good idea to remove this
					}
					
				});
			};
			
		},
		
		_autoplay : function(){
		   
			this._navigate('next');
		
		},
						
		_toggleNavControls : function() {
			
			// re-apply the slide transition
			if( this.options.loop && this.options.animation == 'slide' ){
				this.$list.css({ 
				   'transition' : this.transformName + ' '+ this.options.speed +'ms '+ this.options.easing +' 0s'
				});
			}

			// if the current item is the first one in the list, the left arrow is not shown
			// if the current item is the last one in the list, the right arrow is not shown
			switch( this.current ) {
				
				case 0 : 
				
					if(!this.options.loop){
						this.$navNext.show(); this.$navPrev.hide(); 
					} else {
						this.$navNext.show(); this.$navPrev.show(); 	
					}
				
				
				break;
				
				case this.itemsCount - 1 : 
				
					if(!this.options.loop){
						this.$navNext.hide(); this.$navPrev.show(); 
					} else {
						this.$navNext.show(); this.$navPrev.show();
					}
								
				break;
				
				default : 
				
					this.$navNext.show(); 
					this.$navPrev.show(); 
				
				break;
			}
			
			// highlight navigation dot
			if(this.options.loop && this.options.animation == 'slide') {
				
				if(this.options.controlNav === true){
					
					if( (this.current + 2) >= this.itemsCount  ){
						this.$navDots.eq( this.old ).removeClass( 'pm-currentDot' ).end().eq( 0 ).addClass( 'pm-currentDot' );
					} else {
						this.$navDots.eq( this.old ).removeClass( 'pm-currentDot' ).end().eq( this.current ).addClass( 'pm-currentDot' );
					}
					
				} else if(this.options.controlNav === 'thumbnails'){
					
					if( (this.current + 2) >= this.itemsCount  ){
						this.$navThumbs.eq( this.old ).removeClass( 'pm-currentThumb' ).end().eq( 0 ).addClass( 'pm-currentThumb' );
					} else {
						this.$navThumbs.eq( this.old ).removeClass( 'pm-currentThumb' ).end().eq( this.current ).addClass( 'pm-currentThumb' );
					}
					
				} else {
					//default	
				}
				
				
			} else if( this.options.loop && this.options.animation == 'fade' ) {
								
				if(this.options.controlNav === true){
					
					if( this.current >= this.itemsCount  ){
						this.$navDots.eq( this.old ).removeClass( 'pm-currentDot' ).end().eq( 0 ).addClass( 'pm-currentDot' );
					} else {
						this.$navDots.eq( this.old ).removeClass( 'pm-currentDot' ).end().eq( this.current ).addClass( 'pm-currentDot' );
					}
					
				} else if(this.options.controlNav === 'thumbnails'){
					
					//console.log('this.current = ' + this.current);	
					
					if( this.current >= this.itemsCount  ){
						this.$navThumbs.eq( this.old ).removeClass( 'pm-currentThumb' ).end().eq( 0 ).addClass( 'pm-currentThumb' );
					} else {
						this.$navThumbs.eq( this.old ).removeClass( 'pm-currentThumb' ).end().eq( this.current ).addClass( 'pm-currentThumb' );
					}
					
				} else {
					//default	
				}
				
			} else {
				if(this.options.controlNav === true){
					this.$navDots.eq( this.old ).removeClass( 'pm-currentDot' ).end().eq( this.current ).addClass( 'pm-currentDot' );	
				} else if(this.options.controlNav === 'thumbnails'){
					this.$navThumbs.eq( this.old ).removeClass( 'pm-currentThumb' ).end().eq( this.current ).addClass( 'pm-currentThumb' );
				} else {
					//default	
				}
			}
			

		},
		
		_fade : function() {
						
			var parent = this;
			
			// check which navigation arrows should be shown
			this._toggleNavControls();
			
			//fade code
			var $list = this.$el.children( 'ul' );
			var $items = this.$list.children( 'li' );
			var current = this.current;
			var old = this.old;
			var speed = this.options.speed;
			
			//fade out current slide
			$items.each(function(i, el) {
				var $this = $(el);
				if(i == old){
					$this.fadeOut(speed, fadeComplete);
				}
			});
			//fade in next slide
			function fadeComplete() {
				$items.each(function(i, el) {
					var $this = $(el);
					if(i == current){
						$this.fadeIn(speed, transitionendfn);
					}
				});
			}
			
			var transitionendfn = $.proxy( function() {
				this.isAnimating = false;	
				parent._animateSlide(this.current);
				if(parent.options.slideshow){
					parent._runSlideShow('start');
				}						
			}, this );
			
		},
		
		_slide : function() {
			
			var parent = this;

			// check which navigation arrows should be shown
			this._toggleNavControls();
			
			var $list = this.$el.children( 'ul' );
			var $items = this.$list.children( 'li' );
			
			// translate value
			var translateVal = -1 * this.current * 100 / this.itemsCount;
			if( this.support ) {
				this.$list.css( this.transformName, this.support3d ? 'translate3d(' + translateVal + '%,0,0)' : 'translate(' + translateVal + '%)' );
				
			} else {
				//this.$list.css( 'margin-left', -1 * this.current * 100 + '%' );
				//for browsers that dont support translations
				$list.animate({
					//'marginLeft' : -1 * this.current * 100 + '%' (animating marginLeft does not work correctly in IE 9)
					'left' : -1 * this.current * 100 + '%'
				}, this.options.speed, function() {
					if(!$(this).is('animated')){
						transitionendfn.call();
						if(parent.options.slideshow){
							parent._runSlideShow('start');
						}
					}	
				});
			}
			
			
			var transitionendfn = $.proxy( function() {
								
				this.isAnimating = false;
				
				//execute infinite loop if true
				if(this.options.loop && this.options.animation == 'slide'){
					
					//add else if to check for reverse loop
					if( (this.current + 2) >= this.itemsCount  ){
						
						this.current = 0;
						this.old = 0;
						
						var translateVal = -1 * ( this.current ) * 100 / this.itemsCount;
						
						//px value
						if(this.support){
							this.$list.css('transition' , this.transformName + ' 0ms ease 0s');
							this.$list.css(this.transformName , this.support3d ? 'translate3d(' + translateVal + ',0,0)' : 'translate(' + translateVal + 'px)');
						} else {
							//ADD IE SUPPORT
							$list.css({
								//'marginLeft' : -1 * this.current * 100 + '%' (animating marginLeft does not work correctly in IE 9)
								'left' : translateVal + '%'
							}, this.options.speed );
						}
												
					} else if(this.current < 0) {
						
						this.current = this.itemsCount - 3;
						this.old = this.current;
						
						var translateVal = -1 * ( this.current ) * 100 / this.itemsCount;
						
						//percent value
						if(this.support){
							this.$list.css('transition' , this.transformName + ' 0ms ease 0s');
							this.$list.css(this.transformName , this.support3d ? 'translate3d(' + translateVal + '%,0,0)' : 'translate(' + translateVal + '%)');
						} else {
							//ADD IE SUPPORT	
							$list.css({
								//'marginLeft' : -1 * this.current * 100 + '%' (animating marginLeft does not work correctly in IE 9)
								'left' : -1 * ( this.current ) * 100 + '%'
							}, this.options.speed );
						}
						
							
					}//end of if
					
				}//end of if
				
				
				if(this.options.loop){
					if(this.current < 0) {// -1
						parent._animateSlide(this.itemsCount - 3);//offset for clones and -1 value
					} else if(this.current >= this.itemsCount - 2) {
						parent._animateSlide(0);
					} else {
						parent._animateSlide(this.current);
					}
				} else {
					parent._animateSlide(this.current);	
				}
				
				
				if(parent.options.slideshow){
					parent._runSlideShow('start');
				}
								
			}, this );
			
				
			if( this.support ) {
				this.$list.on( this.transEndEventName, $.proxy( transitionendfn, this ) );
			} 		

		},
		
		_jump : function( position ) {
			
			var parent = this;
												
			// do nothing if clicking on the current dot, or if the list is currently moving
			if( position === this.current || this.isAnimating ) {
				return false;
			}
			
			this.isAnimating = true;
			
			// update old and current values
			this.old = this.current;
			this.current = position;
			
			console.log('position = ' + position + ' and this.current = '+ this.current);
			
			//Update the btn paging for the correct values
			if(this.options.loop && this.options.animation == 'slide'){
				$('.pm-slide-count').html((this.current + 1) + ' / ' + (this.itemsCount - 2));
			} else if(!this.options.loop){
				$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount);
			} else if(this.options.animation == 'fade'){
				$('.pm-slide-count').html((this.current + 1) + ' / ' + this.itemsCount);
			}
			
			
			// slide
			if(this.options.animation == 'slide'){
				this._slide();
			}
			
			if(this.options.animation == 'fade'){
				this._fade();
			}
			
			//reset and call next animation
			parent._resetAnimation();
			//parent._animateSlide(this.current);

		},
		
		_toolTip : function(toolTipData, el){
			
			var parent = this;
				
			var $el = $(el);
			
			var yOffset = $("#pm_slider_tooltip").height() + 55;
			var xOffset = $("#pm_slider_tooltip").width() + 12;
			
			$("body").append("<div id='pm_slider_tooltip'>"+ toolTipData +"</div>");								 
			$("#pm_slider_tooltip").css({

				"top" : ($el.pageY - xOffset) + "px",
				"left" : ($el.pageX + yOffset) + "px",
			});
							
			$('#pm_slider_tooltip').css("top", ($el.offset().top - yOffset) + "px").css("left",+ ($el.offset().left - xOffset) + "px").css({marginTop:0,opacity:1}); //start position
			
			$('#pm_slider_tooltip').html('<img src="'+ toolTipData +'" />');
				
		},//end of toolTip
		
		destroy : function() {

			if( this.itemsCount > 1 ) {
				this.$navPrev.parent().remove();
				
				if(this.options.controlNav == true){
					this.$navDots.parent().remove();
				} else if(this.options.controlNav == 'thumbnails'){
					this.$navThumbs.parent().remove();
				} else {
					//default
				}
				
				
			}
			this.$list.css( 'width', 'auto' );
			if( this.support ) {
				this.$list.css( 'transition', 'none' );
			}
			this.$items.css( 'width', 'auto' );

		}
		
		
	};

	var logError = function( message ) {
		if ( window.console ) {
			window.console.error( message );
		}
	};

	$.fn.PMSlider = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMSlider' );
				if ( !instance ) {
					logError( "cannot call methods on PMSlider prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMSlider instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMSlider' );
				if ( instance ) {
					instance._init();
				}
				else {
					instance = $.data( this, 'PMSlider', new $.PMSlider( options, this ) );
				}
			});
		}
		
		return this;
		
	};
	

} )( jQuery, window );