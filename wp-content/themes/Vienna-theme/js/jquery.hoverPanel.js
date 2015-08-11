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
	
	//Global vars
	var containerOffSetX = 0,
		containerOffSetY = 0;

	$.PMHoverPanel = function( options, element ) {
		this.$el = $( element );
		this._init( options );
	};

	// the options
	$.PMHoverPanel.defaults = {
		// default panel type
		slideType : 'singlePostPanel',
		// default animation speed
		animationSpeed : 750,
		//easing method
		easing : 'easeOutCubic',
		//scale
		scale : true,
		//scale value
		scaleValue : 2,
		//mouse follow
		mouseFollow : false
	};

	$.PMHoverPanel.prototype = {
		
		_init : function( options ) {
			
			var parent = this;
			
			//check for transform support
			// support for CSS Transitions & transforms
			this.support = Modernizr.csstransitions && Modernizr.csstransforms;
			this.support3d = Modernizr.csstransforms3d;
			// transition end event name and transform name
			// transition end event name
			var transEndEventNames = {
				'WebkitTransition' : 'webkitTransitionEnd',
				'MozTransition' : 'transitionend',
				'OTransition' : 'oTransitionEnd',
				'msTransition' : 'msTransitionEnd',
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
				this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMHoverPanel';
				this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
				//console.log('this.transformName = ' + this.transformName);
			}
			
			// options
			this.options = $.extend( true, {}, $.PMHoverPanel.defaults, options );
			
			this.$el.each(function(index, obj) { //Adding return allows for chainability - this isnt always neccesary if chaining is not required
		
				var $obj = $(obj);
				
				if(parent.options.slideType == 'infoPanel' || parent.options.slideType == 'postPanel'){
					
					//add touch support for mobile browsers
					$obj.find('.pm-hover-item-title-panel').bind('touchstart click', function(e){
						e.stopPropagation();
						e.preventDefault();
						parent._clickEvent($obj);
						
					});
					
				}
				
				if(parent.options.slideType == 'galleryPanel' || parent.options.slideType == 'singlePostPanel'){
					//add touch support for mobile browsers
					$obj.find('.pm-hover-item-img').bind('touchstart click', function(e){
						e.stopPropagation();
						e.preventDefault();
						parent._clickEvent($obj);
					});
				}
							
				
				$obj.bind('onclick mouseenter mouseleave', function(event) {
					
					event.preventDefault();
					
					if(event.type == 'onclick' || event.type == 'mouseenter'){
						
						switch(parent.options.slideType){
							
							case 'presentationPostPanel' :
								parent._showPresentationPost($(this));
							break;
	
							case 'blogPostPanel' :
								parent._showBlogPost($(this));
							break;
							
							case 'infoPanelExcerpt' :
								parent._showPanelInfoExcerpt($(this));
							break;
							
							case 'eventPanel' :
								parent._showEventInfo($(this));
							break;						
		
							case 'postPanel' :
								parent._showPostInfo($(this));
							break; 
							
							case 'galleryPanel' :
								parent._showGalleryInterface($(this));
							break; 
							
							case 'imagePanel' :
								parent._showImagePanelOverlay($(this));
							break;
							
							case 'latestWorkPanel' :
								parent._showLatestWorkOverlay($(this));
							break;
							
							case 'staffPanel' :
								parent._showStaffOverlay($(this));
							break;
									
						}
						
					}
					
					if(event.type == 'mouseleave'){
						
						switch(parent.options.slideType){
							
							case 'presentationPostPanel' :
								parent._hidePresentationPost($(this));
							break;
	
							case 'blogPostPanel' :
								parent._hideBlogPost($(this));
							break;
							
							case 'infoPanelExcerpt' :
								parent._hidePanelInfoExcerpt($(this));
							break;
							
							case 'eventPanel' :
								parent._hideEventInfo($(this));
							break;
		
							case 'postPanel' :
								parent._hidePostInfo($(this));
							break; 
							
							case 'galleryPanel' :
								parent._hideGalleryInterface($(this));
							break; 
							
							case 'imagePanel' :
								parent._hideImagePanelOverlay($(this));
							break;
							
							case 'latestWorkPanel' :
								parent._hideLatestWorkOverlay($(this));
							break;
							
							case 'staffPanel' :
								parent._hideStaffOverlay($(this));
							break;
		
						}
						
					}
					
				});
				
	
			});
			
			this._onResize();
			$(window).resize(this._onResize);
						
		},
		
		_onResize : function() {
			//console.log('on resize');
			
			//update size on portfolio isotope items
			if($('#pm-isotope-gallery-container').length > 0){
				
				var width = $('.pm-isotope-gallery-item').width();
				var height = $('.pm-isotope-gallery-item').height();
				//console.log('gallery item width = ' + width + ' gallery item height = ' + height);
				
				$('.pm-isotope-gallery-item-overlay').css({
					'width' : width,
					'height' : height,
				});
				
				$('.pm-isotope-gallery-item-title').css({
					'width' : width,
				});
				
				$('.pm-isotope-gallery-item-details').css({
					'width' : width,
					'top' : height
				});
				
				
					
			}
			
		},
		
		_clickEvent : function(el) {
			
			var parent = this;
			var $obj = $(el);
						
			//Show panel only
			switch(parent.options.slideType){
				
				case 'presentationPostPanel' :
					parent._showPresentationPost($obj);
				break;
	
				case 'singlePostPanel' :
					parent._showBlogPost($obj);
				break;

				case 'postPanel' :
					parent._showPostInfo($obj);
				break; 
				
				case 'galleryPanel' :
					parent._showGalleryInterface($obj);
				break; 
				
				case 'imagePanel' :
					parent._showImagePanelOverlay($obj);
				break;
				
				case 'latestWorkPanel' :
					parent._showLatestWorkOverlay($obj);
				break;

			}
			
			
		},
		
		//Presentation posts
		_showPresentationPost : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var $dateBox = $this.find('.pm-presentation-post-date'),
			$postTitle = $this.find('.pm-presentation-post-title'),
			$postExcerpt = $this.find('.pm-presentation-post-excerpt'),
			$hoverContainer = $this.find('.pm-presentation-post-hover-container'),
			$img = $this.find('.pm-presentation-post-img');
			
			$dateBox.css({
				"left" : 0	
			});
			
			$postTitle.css({
				"bottom" : 160,
			});
			
			$postExcerpt.css({
				"bottom" : "-100px",
			});
			
			$hoverContainer.css({
				"left" : 0	
			});
			
			$img.css({
				'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
			});
			
			
		},
		
		_hidePresentationPost : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var $dateBox = $this.find('.pm-presentation-post-date'),
			$postTitle = $this.find('.pm-presentation-post-title'),
			$postExcerpt = $this.find('.pm-presentation-post-excerpt'),
			$hoverContainer = $this.find('.pm-presentation-post-hover-container'),
			$img = $this.find('.pm-presentation-post-img');
			
			$dateBox.css({
				"left" : 210	
			});
			
			$postTitle.css({
				"bottom" : 70,
			});
			
			$postExcerpt.css({
				"bottom" : 36,
			});
			
			$hoverContainer.css({
				"left" : '290px'	
			});
			
			$img.css({
				'transform' : 'scale(1, 1)',
			});
			
		},
		
		//Regular Panels
		_showBlogPost : function(el) {
			
			var parent = this,
			$this = el,
			$postDate = $this.find('.pm-blog-post-date'),
			$postTitle = $this.find('.pm-blog-post-title'),
			$postExcerpt = $this.find('.pm-post-hover-excerpt');
						
			$postDate.stop().animate({
				"top" : 0	
			}, 450);
			
			$postTitle.stop().animate({
				"top" : 0,
			}, 550);
			
			$postExcerpt.stop().animate({
				"opacity" : 1	
			}, 300);
		},

		_hideBlogPost : function(el) {

			var parent = this,
			$this = el,
			$postDate = $this.find('.pm-blog-post-date'),
			$postTitle = $this.find('.pm-blog-post-title'),
			$postExcerpt = $this.find('.pm-post-hover-excerpt');
			
			$postDate.stop().animate({
				"top" : 205	
			}, 550);
			
			$postTitle.stop().animate({
				"top" : 230,
			}, 450);
			
			$postExcerpt.stop().animate({
				"opacity" : 0	
			}, 500);		

		},
		
		//Latest Works Panel
		_showLatestWorkOverlay : function(el) {
			
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			var $panelTitle = $this.find('.pm-latest-work-item-title');
			
			var $panelBg = $this.find('.pm-latest-work-item-bg');
			
			var $panelText =  $this.find('.pm-latest-work-item-text');
						
			$panelTitle.stop().animate({
				'bottom' : panelHeight - 32,
				 //this needs reference primary color var from WordPress - use Localize js for this
			}, 450, parent.options.easing, function(e) {
				
				var $this = $(this);
				$this.find('i').fadeOut(100, function(e) {
					var $this = $(this);
					$this.removeClass('fa fa-angle-up').addClass('fa fa-angle-down').fadeIn(100);
				});
					
			});
			
			$panelBg.stop().animate({
				'opacity' : .8,
			}, 500, parent.options.easing, function(e) {
				//animate in text
				$panelText.animate({
					'bottom' : panelHeight - 150,
					'opacity' : 1,	
				}, 450, parent.options.easing);	
			});
			
			
			
		},
		
		_hideLatestWorkOverlay : function(el) {
			
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			var $panelTitle = $this.find('.pm-latest-work-item-title');
			
			var $panelBg = $this.find('.pm-latest-work-item-bg');
			
			var $panelText =  $this.find('.pm-latest-work-item-text');
									
			$panelText.stop().animate({
				'bottom' : -panelHeight,
				'opacity' : 0,	
			}, 200, parent.options.easing);	
			
			$panelTitle.stop().animate({
				'bottom' : 0,
			}, 450, parent.options.easing, function(e) {
				
				var $this = $(this);
				$this.find('i').fadeOut(100, function(e) {
					var $this = $(this);
					$this.removeClass('fa fa-angle-down').addClass('fa fa-angle-up').fadeIn(100);
				});
					
			});
			
			$panelBg.stop().animate({
				'opacity' : 0,
			}, 500, parent.options.easing);
			
		},
				
		//Post Panels
		_showPostInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $postDetails = $this.find('.pm-news-post-item-details');
			var $postImg = $this.find('img');
			
			$postDetails.stop().animate({
				'bottom' : 0,
				'opacity' : '.85'
			}, parent.options.animationSpeed, parent.options.easing);
			
			$postImg.stop().animate({
				'opacity':'0.85',
			});
			
			if(parent.options.scale === true){
				$postImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			
			
			

		},

		_hidePostInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;
			
			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $postDetails = $this.find('.pm-news-post-item-details');
			var $postImg = $this.find('img');
			
			$postDetails.stop().animate({
				'bottom' : '-300px',
				'opacity' : '1'
			}, parent.options.animationSpeed, parent.options.easing);
			
			$postImg.stop().animate({
				'opacity':'1',
			});
			
			if(parent.options.scale === true){
				$postImg.css({
					'transform' : 'scale(1, 1)',
				});
			}
			

		},
		
		//Gallery Panels
		_showGalleryInterface : function(el) {
						
			var parent = this;
			
			var $this = el;
			
			var panelWidth = $this.parent().width();
			var panelHeight = $this.parent().height();
			//alert(panelHeight);
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-isotope-gallery-item-title');
			var $panelDetails = $this.find('.pm-isotope-gallery-item-details');
			
			$this.css({
				width : panelWidth,
				height : panelHeight,
			});
			
			$panelTitle.css({
				width : panelWidth,
				bottom : 0
			});
			
			$panelTitle.stop().animate({
				'bottom' : -67,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
						
			
		},
		
		_hideGalleryInterface : function(el) {
			
			var parent = this;
			
			var $this = el;
			
			//var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelHeight);
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-isotope-gallery-item-title');
			var $panelDetails = $this.find('.pm-isotope-gallery-item-details');
			
			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight,
			}, parent.options.animationSpeed, parent.options.easing);
						
		},
		
		
		//Staff Panels
		_showStaffOverlay : function(el) {
			
			var parent = this;
			
			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-isotope-staff-item-details');
			var $overlay = $this.find('.pm-isotope-staff-item-overlay');
			$panelDetails.css({
				width : panelWidth,
				height : panelHeight	
			});
			$overlay.css({
				width : panelWidth,
				height : panelHeight
			});
						
			$panelDetails.stop().animate({
				'left' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
						
			
		},
		
		_hideStaffOverlay : function(el) {
						
			var parent = this;
			
			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelHeight);
			
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-isotope-staff-item-details');
			var $overlay = $this.find('.pm-isotope-staff-item-overlay');
			$panelDetails.css({
				width : panelWidth,
				height : panelHeight	
			});
			$overlay.css({
				width : panelWidth,
				height : panelHeight
			});
						
			$panelDetails.stop().animate({
				'left' : -panelWidth,
			}, parent.options.animationSpeed, parent.options.easing);
						
		},
		
		
		_showImagePanelOverlay : function(el){
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			var $icon = $this.find('.pm-hover-item-icon');
			var iconStyles = {
				left : (panelWidth / 2) - ($icon.width() / 2),
				top: 0 + (panelHeight / 2) - ($icon.width() / 2)
			};
				
			$icon.css(iconStyles);
			
			$icon.fadeIn('slow');
						
			//grab the neccessary elements
			var $panelDetails = $this.find('.pm-hover-item-details');
			$panelDetails.stop().animate({
				'top' : 0
			}, parent.options.animationSpeed, parent.options.easing);
			
			var $panelImg = $this.find('img');
			$panelImg.stop().animate({
				'opacity' : .7
			}, parent.options.animationSpeed, parent.options.easing);
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			
		},
		
		_hideImagePanelOverlay : function(el){
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $icon = $this.find('.pm-hover-item-icon');
			$icon.fadeOut('slow');
			
			var $panelDetails = $this.find('.pm-hover-item-details');
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);

			var $panelImg = $this.find('img');

			$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}
			
		},
		
		
		_showEventInfo : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var panelTitleHeight = $panelTitle.height();
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			//var $eventInfo = $this.find('.pm-hover-item-event-info');
			
			$panelTitle.stop().animate({
				'bottom' : -panelTitleHeight - 25
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0 //slides down
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelImg.stop().animate({
				'opacity' : 0.6
			}, parent.options.animationSpeed, parent.options.easing);
			
			/*$eventInfo.stop().animate({
				'top' : 0 //slides down
			}, parent.options.animationSpeed, parent.options.easing * 4);*/

			/*$panelImg.stop().animate({
				'opacity' : 0
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			

		},

		_hideEventInfo : function(el) {

			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			//var $eventInfo = $this.find('.pm-hover-item-event-info');

			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);
			
			/*$eventInfo.stop().animate({
				'top' : -panelHeight
			}, parent.options.animationSpeed, parent.options.easing * 4);*/

			/*$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}

		},
		
		//Post with excerpts
		_showPanelInfoExcerpt : function(el) {
			
			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			//console.log(panelWidth);
			
			
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var panelTitleHeight = $panelTitle.height();
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('img');
			
			$panelTitle.stop().animate({
				'bottom' : -panelTitleHeight - 25
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : 0
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 0
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale('+parent.options.scaleValue+', '+parent.options.scaleValue+')',
				});
			}
			

		},

		_hidePanelInfoExcerpt : function(el) {

			//target parent element to get plugin settings
			var parent = this;

			var $this = el;
			var panelWidth = $this.width();
			var panelHeight = $this.height();
			
			//grab the neccessary elements
			var $panelTitle = $this.find('.pm-hover-item-title-panel');
			var $panelDetails = $this.find('.pm-hover-item-details');
			var $panelImg = $this.find('.pm-hover-item-img');
			
			var $panelImg = $this.find('img');

			$panelTitle.stop().animate({
				'bottom' : 0,
			}, parent.options.animationSpeed, parent.options.easing);
			
			$panelDetails.stop().animate({
				'top' : panelHeight
			}, parent.options.animationSpeed, parent.options.easing);

			/*$panelImg.stop().animate({
				'opacity' : 1
			}, parent.options.animationSpeed, parent.options.easing);*/
			
			if(parent.options.scale === true){
				$panelImg.css({
					'transform' : 'scale(1, 1)',
				});
			}

		},
		
		
		_checkWidth : function() {
			
			var parent = this;
						
			setTimeout(function() {
				
			}, 10);
			
		}, 
		
		
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

	$.fn.PMHoverPanel = function( options ) {
		
		if ( typeof options === 'string' ) {
			
			var args = Array.prototype.slice.call( arguments, 1 );
			this.each(function() {
				var instance = $.data( this, 'PMHoverPanel' );
				if ( !instance ) {
					logError( "cannot call methods on PMHoverPanel prior to initialization; " +
					"attempted to call method '" + options + "'" );
					return;
				}
				if ( !$.isFunction( instance[options] ) || options.charAt(0) === "_" ) {
					logError( "no such method '" + options + "' for PMHoverPanel instance" );
					return;
				}
				instance[ options ].apply( instance, args );
			});
			
		} else {
			
			this.each(function() {	
				var instance = $.data( this, 'PMHoverPanel' );
				if ( instance ) {
					console.log('init');
					//instance._init();
					instance = $.data( this, 'PMHoverPanel', new $.PMHoverPanel( options, this ) );
				}
				else {
					instance = $.data( this, 'PMHoverPanel', new $.PMHoverPanel( options, this ) );
				}
			});
		}
		
		return this;
		
	};

} )( jQuery, window );