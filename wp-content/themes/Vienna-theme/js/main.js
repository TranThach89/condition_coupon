(function($) {
	
	'use strict';
	
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	
	$(document).ready(function(e) {
		
		// global
		var Modernizr = window.Modernizr;
		
		// support for CSS Transitions & transforms
		var support = Modernizr.csstransitions && Modernizr.csstransforms;
		var support3d = Modernizr.csstransforms3d;
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
					
		if( support ) {
			this.transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ] + '.PMMain';
			this.transformName = transformNames[ Modernizr.prefixed( 'transform' ) ];
			//console.log('this.transformName = ' + this.transformName);
		}

		runParallax();
		
	/* ==========================================================================
	   Product switcher
	   ========================================================================== */
		if( $('#pm-product-switcher').length > 0 ){
			
			var switcherActive = false,
			$switcher = $('#pm-product-switcher');
			
			$('#pm-product-switcher-btn').click(function(e) {
				
				var $this = $(this);
				
				if(!switcherActive){
					
					switcherActive = true;
					$switcher.css({
						'bottom' : '0px'	
					});
					
					$this.addClass('pm-switcher-active');
					
				} else {
					switcherActive = false;
					$switcher.css({
						'bottom' : '-275px'	
					});	
					$this.removeClass('pm-switcher-active');
				}
				
			});
			
		}
				
	/* ==========================================================================
	   Initialize PrettyPhoto
	   ========================================================================== */
		methods.loadPrettyPhoto();
		
	/* ==========================================================================
	   Add rollover features to Flicker widget
	   ========================================================================== */
	   if( $('.flickr_badge_image').length > 0 ){
	   	
			var flickrATag = $('.flickr_badge_image').find('a');
			flickrATag.prepend('<span></span><i class="fa fa-search-plus"></i>');
		
	   }
		
	/* ==========================================================================
	   Add micro nav icons
	   ========================================================================== */
		if( $('#menu-micro-navigation').length > 0 ){
			
			$('#menu-micro-navigation').children().each(function(index, element) {
            
				var aTag = $(element).find('a');
				
				if(aTag.attr('title') == 'search-button'){
					aTag.html('').attr('id', 'pm-search-btn').addClass('pm-search-btn').append('<i class="fa fa-search"></i>');
				}
				
				if(aTag.attr('title') == 'cart-button'){
					aTag.html('').addClass('pm-cart-btn').append('<i class="fa fa-shopping-cart"></i>');
				}
				
			});
			
		}
		
	/* ==========================================================================
	   Desktop search submit feature
	   ========================================================================== */
		$('#pm-desktop-search-btn').click(function(e) {
			$('#pm-desktop-searchform').submit();
			e.preventDefault();
        });
		
	/* ==========================================================================
	   Print page
	   ========================================================================== */
		if( $('#pm-print-btn').length > 0 ){
			var printBtn = $('#pm-print-btn');
			printBtn.click(function() {
				window.print();
				return false;	
			});
		}
	   
		
	/* ==========================================================================
	   Testimonials widget
	   ========================================================================== */
	   if( $('.pm-testimonials-widget-quotes').length > 0 ){
		   
		    $('.pm-testimonials-widget-quotes').PMTestimonials({
				speed : 450,
				slideShow : true,
				slideShowSpeed : 6000,
				controlNav : false,
				arrows : true
			});
		   
	   }
		
	/* ==========================================================================
	   Homepage slider
	   ========================================================================== */
		if($('#pm-slider').length > 0){
						
			$('#pm-slider').PMSlider({
				speed : pulseSliderOptionsObject.slideSpeed, //get parameter fron wp
				easing : 'ease',
				loop : pulseSliderOptionsObject.slideLoop == 'true' ? true : false, //get parameter fron wp
				controlNav : pulseSliderOptionsObject.enableControlNav == 'true' ? true : false, //false = no bullets / true = bullets / 'thumbnails' activates thumbs //get parameter fron wp
				controlNavThumbs : true,
				animation : pulseSliderOptionsObject.animtionType, //get parameter fron wp
				fullScreen : false,
				slideshow : pulseSliderOptionsObject.enableSlideShow == 'true' ? true : false, //get parameter fron wp
				slideshowSpeed : pulseSliderOptionsObject.slideShowSpeed, //get parameter fron wp
				pauseOnHover : pulseSliderOptionsObject.pauseOnHover == 'true' ? true : false, //get parameter fron wp
				arrows : pulseSliderOptionsObject.showArrows == 'true' ? true : false, //get parameter fron wp
				fixedHeight : true,
				fixedHeightValue : pulseSliderOptionsObject.sliderHeight,
				touch : true,
				progressBar : false
			});
			
		}
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}
		
	/* ==========================================================================
	   Mobile Menu trigger
	   ========================================================================== */
	   
	   var menuOpen = false,
	   $icon = null;
		
		$('#pm-mobile-menu-trigger').click(function(e) {
			
			$icon = $(this).find('i').removeClass('fa fa-bars').addClass('fa fa-close'); 
			
			if( !menuOpen ){
				menuOpen = true;
				$('body').removeClass('menu-collapsed').addClass('menu-opened');
			} 
			
			e.preventDefault();
			
		});
		
		$('#pm-mobile-menu-overlay').click(function(e) {
			
			
			
			if( menuOpen ){
				menuOpen = false;
				$('body').removeClass('menu-opened').addClass('menu-collapsed');
				$icon.removeClass('fa fa-close').addClass('fa fa-bars'); 
			}
			
			e.preventDefault();
			
		});
		
		$('.pm-mobile-global-menu').css({
			'height' : 	$('#pm_layout_wrapper').height()
		});
		
	/* ==========================================================================
	   Datepicker
	   ========================================================================== */
	   if($("#datepicker").length > 0){
		   $("#datepicker").datepicker();
	   }
	   
		
	/* ==========================================================================
	   Isotope menu expander (mobile only)
	   ========================================================================== */
	   if($('.pm-isotope-filter-system-expand').length > 0){
		   
		   var totalHeight = 0;
		   
		   $('.pm-isotope-filter-system-expand').click(function(e) {
			   
			   var $this = $(this),
			   $parentUL = $this.parent('ul');
			   
			   
			   
			   //get the height of the total li elements
			   $parentUL.children('li').each(function(index, element) {
					totalHeight += $(this).height();
			   });
			   			   
			   if( !$parentUL.hasClass('expanded') ){
				   
				    //expand the menu
					$parentUL.addClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : totalHeight	  
				    });
					
					$this.find('i').removeClass('fa-angle-down').addClass('fa-close');
				   
			   } else {
				
					//close the menu
					$parentUL.removeClass('expanded');
				   				  
				    $parentUL.css({
					  "height" : 80 
				    });
					
					$this.find('i').removeClass('fa-close').addClass('fa-angle-down');
									   
			   }
			   
			   //reset totalheight
			   totalHeight = 0;
			   
		   });
		   
	   }
		
		
	/* ==========================================================================
	   Language Selector drop down
	   ========================================================================== */
		if($('.pm-dropdown.pm-language-selector-menu').length > 0){
			$('.pm-dropdown.pm-language-selector-menu').on('mouseover', methods.dropDownMenu).on('mouseleave', methods.dropDownMenu);
		}
		
	/* ==========================================================================
	   Search activator
	   ========================================================================== */
	   
	   var searchActive = false;
	   
		$('#pm-search-btn').click(function(e) {
			
			if(!searchActive) {
			
				searchActive = true;
				
				$('#pm-search-container').css({
					'top' : '0px'	
				});
				
			}
			
			e.preventDefault();
						
		});
		
		$('#pm-search-collapse').click(function(e) {
			
			if(searchActive) {
			
				searchActive = false;
				
				$('#pm-search-container').css({
					'top' : '-160px'	
				});
				
			} 
			
			e.preventDefault();
			
		});

		
	/* ==========================================================================
	   Main menu interaction
	   ========================================================================== */
		if( $('.pm-nav').length > 0 ){
						
			//superfish activation
			$('.pm-nav').superfish({
				delay: 0,
				animation: {opacity:'show',height:'show'},
				speed: 300,
				dropShadows: false,
			});
						
		};
		
	/* ==========================================================================
	   Remove Woocommerce classes on body
	   ========================================================================== */
		$('body').removeClass('woocommerce');
		$('body').removeClass('woocommerce-page');
		
	/* ==========================================================================
	   Checkout expandable forms
	   ========================================================================== */
		if ($('#pm-returning-customer-form-trigger').length > 0){
			
			var $returningFormExpanded = false;
			
			$('#pm-returning-customer-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$returningFormExpanded ) {
					$returningFormExpanded = true;
					$('#pm-returning-customer-form').fadeIn(700);
					
				} else {
					$returningFormExpanded = false;
					$('#pm-returning-customer-form').fadeOut(300);
				}
				
			});
			
		}
		
		if ($('#pm-promotional-code-form-trigger').length > 0){
			
			var $promotionFormExpanded = false;
			
			$('#pm-promotional-code-form-trigger').on('click', function(e) {
				
				e.preventDefault();
				
				if( !$promotionFormExpanded ) {
					$promotionFormExpanded = true;
					$('#pm-promotional-code-form').fadeIn(700);
					
				} else {
					$promotionFormExpanded = false;
					$('#pm-promotional-code-form').fadeOut(300);
				}
				
			});
			
		}

				
	/* ==========================================================================
	   isTouchDevice - return true if it is a touch device
	   ========================================================================== */
	
		function isTouchDevice() {
			return !!('ontouchstart' in window) || ( !! ('onmsgesturechange' in window) && !! window.navigator.maxTouchPoints);
		}
				
		
		//dont load parallax on mobile devices
		function runParallax() {
			
			//enforce check to make sure we are not on a mobile device
			if( !isMobile.any()){
							
				//stellar parallax
				//stellar parallax
				$.stellar({
				  // Set scrolling to be in either one or both directions
				  horizontalScrolling: false,
				  verticalScrolling: true,
				
				  // Set the global alignment offsets
				  horizontalOffset: 0,
				  verticalOffset:-40,
				
				  // Refreshes parallax content on window load and resize
				  responsive: false,
				
				  // Select which property is used to calculate scroll.
				  // Choose 'scroll', 'position', 'margin' or 'transform',
				  // or write your own 'scrollProperty' plugin.
				  scrollProperty: 'scroll',
				
				  // Select which property is used to position elements.
				  // Choose between 'position' or 'transform',
				  // or write your own 'positionProperty' plugin.
				  positionProperty: 'position',
				
				  // Enable or disable the two types of parallax
				  parallaxBackgrounds: true,
				  parallaxElements: true,
				
				  // Hide parallax elements that move outside the viewport
				  hideDistantElements: true,
				
				  // Customise how elements are shown and hidden
				  hideElement: function($elem) { $elem.hide(); },
				  showElement: function($elem) { $elem.show(); }
				  
				});
				
				$('.pm-parallax-panel').stellar();
								
			}
			
		}//end of function
		
	/* ==========================================================================
	   Checkout form - Account password activation
	   ========================================================================== */
	   
	   if( $('#pm-create-account-checkbox').length > 0){
			  			
			$('#pm-create-account-checkbox').change(function(e) {
				
				if( $('#pm-create-account-checkbox').is(':checked') ){
					
					$('#pm-checkout-password-field').fadeIn(500);
					
				} else {
					$('#pm-checkout-password-field').fadeOut(500);	
				}
				
			});
			   
	   }
	   
	   
	 /* ==========================================================================
	   Accordion and Tabs
	   ========================================================================== */
	   
	    $('#accordion').collapse({
		  toggle: false
		})
	    $('#accordion2').collapse({
		  toggle: false
		})
	   
		if($('.panel-title').length > 0){
			
			var $prevItem = null;
			var $currItem = null;
			
			$('.pm-accordion-link').click(function(e) {
				
				var $this = $(this);
				
				if($prevItem == null){
					$prevItem = $this;
					$currItem = $this;
				} else {
					$prevItem = $currItem;
					$currItem = $this;
				}				
				
				
				if( $currItem.attr('href') != $prevItem.attr('href') ) {
										
					//toggle previous item
					if( $prevItem.parent().find('i').hasClass('fa fa-minus') ){
						$prevItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					}
					
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				} else if($currItem.attr('href') == $prevItem.attr('href')) {
										
					//else toggle same item
					if( $currItem.parent().find('i').hasClass('fa fa-minus') ){
						$currItem.parent().find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
					} else {
						$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					}
						
				} else {
					
					//console.log('toggle current item');
					$currItem.parent().find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
					
				}
				
				
			});

			
		}
		
		//tab menu
		if($('.nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.nav-tabs a:first').tab('show');
			$('.nav.nav-tabs li:first-child').addClass('active');
		}
	   
	   
	/* ==========================================================================
	   Staff isotope activation
	   ========================================================================== */
		if($('#pm-isotope-item-container').length > 0){
			//initialize isotope
			$('#pm-isotope-item-container').isotope({
			  // options
			  itemSelector : '.pm-isotope-item',
			  layoutMode : 'fitRows',
			});	
		}
		
	/* ==========================================================================
	   Isotope filter activation
	   ========================================================================== */
		$('.pm-isotope-filter-system').children().each(function(i,e) {
						
			if(i > 0){
				
				delay(e, 1);
				$(e).css({
					'visibility' : 'visible'	
				});
				//add click functionality
				$(e).find('a').click(function(e) {
					
					e.preventDefault();
					
					$('.pm-isotope-filter-system').children().find('a').removeClass('current');
					$(this).addClass('current');
					
					var id = $(this).attr('id');
					$('#pm-isotope-item-container').isotope({ filter: '.'+$(this).attr('id') });
					
				});
				
			}
						
			
		});
		
		var offset = 50;
		
		//must be declared at top level or immediately after a function call in "strict mode"
		function delay(element, opacity) {
			setTimeout(function(){
				$(element).animate({
					opacity: opacity, 
				}, 150);
			}, $(element).index() * offset)
		}	
	   
	/* ==========================================================================
	   Ajax load more
	   ========================================================================== */
	   if($('#pm-load-more').length > 0){
						
			var morebutton = $('#pm-load-more'),
			section = morebutton.attr('name'),
			//container = 'pm-isotope-'+section+'-container',
			container = 'pm-isotope-item-container',
			btntext = morebutton.find('span').text(),
			page = 1;
									
			//alert($('#'+container).height());
		
			morebutton.click(function(e){
				
				e.preventDefault();
				page++;
				
				//morebutton.removeClass('fa fa-cloud-download').addClass('fa fa-spinner fa-spin');
				morebutton.find('span').text(pulsarajax.loading);//retrieved from localize script in functions.php
				//morebutton.find('i').removeClass('fa fa-cloud-download').addClass('fa fa-cog fa-spin').css({borderLeft:'0px'});
				
				$.post(pulsarajax.ajaxurl, {action:'pm_ln_load_more', nonce:pulsarajax.nonce, page:page, section:section}, function(data){
					
					var content = $(data.content);
					
					$(content).imagesLoaded(function(){
						
						$('#'+container).append(content).isotope('insert',content); //appended or insert (insert appends and filters the new items)
												
						//$('.pm-load-more-status').text('Loading...');
						//morebutton.find('span').append('<i class="fa fa-cloud-download"></i>');
						//morebutton.find('i').removeClass('fa fa-cog fa-spin').addClass('fa fa-cloud-download').css({borderLeft:'1px solid black'});
						
						//methods.resetHoverPanels();
						
						var numItems = $('div.pm-isotope-item').length; 
						$('.pm-load-more-container-current-count').text(numItems);
						
						if(section == 'galleries'){
							//reset prettyPhoto for new isotope items
							methods.loadPrettyPhoto();
						}
						
						/*if(section == 'staff'){
							var numItems = $('div.pm-isotope-item').length;
							$('.pm-load-more-container-current-count').text(numItems);
						}*/
						
					});
					
					if(page >= data.pages){
						
						//all data has loaded, hide the Load More button
						morebutton.fadeOut('fase');
						morebutton.unbind( "click" );
						morebutton.click(function(e) {
							e.preventDefault();
						});
						
					} else {
						//More items can be loaded, restore text on button
						morebutton.find('span').text(btntext);//retrieved from localize script in functions.php
					}
					
				},'json');
				
			});
			
		}
		
	
		
	/* ==========================================================================
	   When the window is scrolled, do
	   ========================================================================== */
		$(window).scroll(function () {
			
			//toggle back to top btn
			if ($(this).scrollTop() > 50) {
				if( support ) {
					$('#back-top').css({ right : 0 });
				} else {
					$('#back-top').animate({ right : 0 });
				}
			} else {
				if( support ) {
					$('#back-top').css({ right : -70 });
				} else {
					$('#back-top').animate({ right : -70 });
				}
			}
			
			//toggle fixed nav
			if(stickyNavObject.stickyNav == 'on'){
				
				//apply sticky nav on desktop resolutions
				if( $(window).width() > 991 ){
				
					if ($(this).scrollTop() > 47) {
						
						$('header').addClass('fixed');
										
					} else {
						
						$('header').removeClass('fixed');
											
					}
				
				}
				
			}
									
		});
		
	/* ==========================================================================
	   Detect page scrolls on buttons
	   ========================================================================== */
		if( $('.pm-page-scroll').length > 0 ){
			
			$('.pm-page-scroll').click(function(e){
								
				e.preventDefault();
				var $this = $(e.target);
				var sectionID = $this.attr('href');
				
				
				$('html, body').animate({
					scrollTop: $(sectionID).offset().top - 80
				}, 1000);
				
			});
			
		}
		
		
	/* ==========================================================================
	   Mobile menu button toggle
	   ========================================================================== */
		if( $('#pm-mobile-menu-btn').length > 0 ){
			
			var menuCollapsed = false;
			
			$('#pm-mobile-menu-btn').on('click', function(e) {
				
				var $icon = $(this).find('i');
				
				if( !menuCollapsed ){
					
					menuCollapsed = true;
					
					$icon.removeClass('fa-bars').addClass('fa-minus');
					
				} else {
					
					menuCollapsed = false;
					
					$icon.removeClass('fa-minus').addClass('fa-bars');
						
				}
				
			});
			
		}
	
	/* ==========================================================================
	   Back to top button
	   ========================================================================== */
		$('#back-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
	/* ==========================================================================
	   Accordion menu
	   ========================================================================== */
		if($('#accordionMenu').length > 0){
			$('#accordionMenu').collapse({
				toggle: false,
				parent: false,
			});
		}
		
		
	/* ==========================================================================
	   Tab menu
	   ========================================================================== */
		if($('.pm-nav-tabs').length > 0){
			//actiavte first tab of tab menu
			$('.pm-nav-tabs a:first').tab('show');
			$('.pm-nav-tabs li:first-child').addClass('active');
		}

	/* ==========================================================================
	   Parallax check
	   ========================================================================== */
		var $window = $(window);
		var $windowsize = 0;
		
		function checkWidth() {
			$windowsize = $window.width();
			if ($windowsize < 980) {
				//if the window is less than 980px, destroy parallax...
				$.stellar('destroy');
			} else {
				runParallax();	
			}
		}
		
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);

		
	/* ==========================================================================
	   Window resize call
	   ========================================================================== */
		$(window).resize(function(e) {
			methods.windowResize();
		});

		
	
		if( $('#pm-search-btn').length > 0 ){
						
			var $searchBtn = $('#pm-search-btn');
			
			$searchBtn.click(function(e) {
				
				//CALL METHODS FUNCTION
				methods.displaySearch();
								
				$('#pm-search-exit').click(function(e) {
					methods.hideSearch();
				});
											
				e.preventDefault();
			
			});
			
		}
		
	/* ==========================================================================
	   Tooltips
	   ========================================================================== */
		if( $('.pm_tip').length > 0 ){
			$('.pm_tip').PMToolTip();
		}
		if( $('.pm_tip_static_bottom').length > 0 ){
			$('.pm_tip_static_bottom').PMToolTip({
				floatType : 'staticBottom'
			});
		}
		if( $('.pm_tip_static_top').length > 0 ){
			$('.pm_tip_static_top').PMToolTip({
				floatType : 'staticTop'
			});
		}
		
	/* ==========================================================================
	   TinyNav
	   ========================================================================== */
		$("#pm-footer-nav").tinyNav();
		$("#pm-members-nav").tinyNav();
		
			
	}); //end of document ready
	
	
	/* ==========================================================================
	   Woocommerce add to cart icon
	   ========================================================================== */
		$('.pm-add-to-cart-btn').on('click', function(e) {
			
			var $this = $(this);
			
			var productID = $this.data('product_id');
			
			var post = '.post-' + productID;
			$(post).find('.pm-added-to-cart-icon').addClass('in_cart');
			
		});
		
		
	/* ==========================================================================
	   Woocommerce Star rating
	   ========================================================================== */
		if( $('.comment-form-rating').length > 0 ){
			
			$('.comment-form-rating .stars span a').append('<i class="icon-star"></i>');
			
			$('.comment-form-rating .stars span a').on('click mousedown', function(e) {
				
				e.preventDefault();
				
				var $this = $(this);
				
				//remove previous active attribute to all a tags so we dont catch it
				$('.comment-form-rating .stars span a').removeClass('active');
				$('.comment-form-rating .stars span a i').removeClass('activated');
				
				var className = $this.attr('class');
				var currentStarIndex = className.substring(className.lastIndexOf("-") + 1);
				//console.log("currentStarIndex = " + currentStarIndex);
				
				for( var i = 0; i <= currentStarIndex; i++){
					
					var $currStar = '.star-' + i;
					$($currStar).find('i').addClass('activated');
					
				}
				
			});
			
		}
		
	/* ==========================================================================
	   Woocommerce Star rating widget
	   ========================================================================== */
		if( $('.widget_recent_reviews').length > 0 ){
			
			$('.widget_recent_reviews .product_list_widget li').each(function(index, element) {
                
				var $ratingDiv = $(element).find('.star-rating');
				var rating = $(element).find('.star-rating span strong').html();
				
				$ratingDiv.html('<ul class="pm-widget-star-rating" id="pm-widget-star-rating-'+index+'"></ul>');
				
				for (var i = 1; i <= 5; i++) {
										
					if( i > parseInt(rating) ){
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="icon-star inactive"></i></li>');
					} else {
						$('#pm-widget-star-rating-'+index+'').append('<li><i class="icon-star"></i></li>');
					}
										
				}
				
            });
						
		}

	
	/* ==========================================================================
	   Options
	   ========================================================================== */
		var options = {
			dropDownSpeed : 100,
			slideUpSpeed : 200,
			slideDownTabSpeed: 50,
			changeTabSpeed: 200,
		}
	
	/* ==========================================================================
	   Methods
	   ========================================================================== */
		var methods = {
	
			displaySearch : function(e) {
							
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'height' : $(window).height(),
					'opacity' : 1
				});
				
			},
			
			hideSearch : function(e) {
				
				var searchContainer = $("#pm-search-container");
				
				searchContainer.css({
					'opacity' : 0,
					'height' : 0
				});
				
			},

			
			dropDownMenu : function(e){  
					
				var body = $(this).find('> :last-child');
				var head = $(this).find('> :first-child');
				
				if (e.type == 'mouseover'){
					body.fadeIn(options.dropDownSpeed);
				} else {
					body.fadeOut(options.dropDownSpeed);
				}
				
			},
			
			loadPrettyPhoto : function() {
								
				if( $("a[data-rel^='prettyPhoto']").length > 0 ){
							
					$("a[data-rel^='prettyPhoto']").prettyPhoto({
						animation_speed: ppObject.ppAnimationSpeed.toString(), /* fast/slow/normal */
						slideshow: ppObject.ppSlideShowSpeed, /* false OR interval time in ms */
						autoplay_slideshow: ppObject.ppAutoPlay == 'false' ? false : true, /* true/false */
						opacity: 0.80, /* Value between 0 and 1 */
						show_title: ppObject.ppShowTitle == 'false' ? false : true, /* true/false */
						//allow_resize: true, /* Resize the photos bigger than viewport. true/false */
						//default_width: 640,
						//default_height: 480,
						counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
						theme: ppObject.ppColorTheme.toString(), /* light_rounded / dark_rounded / light_square / dark_square / facebook */
						horizontal_padding: 20, /* The padding on each side of the picture */
						hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
						wmode: 'opaque', /* Set the flash wmode attribute */
						autoplay: true, /* Automatically start videos: True/False */
						modal: false, /* If set to true, only the close button will close the window */
						deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
						overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
						keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
						changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
						
					});
					
				}	
				
			},
			
					
			windowResize : function() {
				//resize calls
			},
			
		};
		
	
	
})(jQuery);

