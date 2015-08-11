(function() {  

	//////////////////// FANCY TITLE
    tinymce.create('tinymce.plugins.fancyTitle', {  

        init : function(ed, url) {  

            ed.addButton('fancyTitle', {  

                title : 'Fancy Title',  

                image : url+'/buttons/fancy-title.gif',  

                onclick : function() {  

                     ed.selection.setContent('[fancyTitle title="This is a Fancy Title" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('fancyTitle', tinymce.plugins.fancyTitle);

	//////////////////// POST ITEMS
    tinymce.create('tinymce.plugins.postItems', {  

        init : function(ed, url) {  

            ed.addButton('postItems', {  

                title : 'Post Items',  

                image : url+'/buttons/post-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[postItems num_of_posts="2" title="Latest News" message="Bringing you the latest in cuisine and culture" header_image="" post_order="DESC" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('postItems', tinymce.plugins.postItems);


	//////////////////// EVENT ITEMS
    tinymce.create('tinymce.plugins.eventItems', {  

        init : function(ed, url) {  

            ed.addButton('eventItems', {  

                title : 'Event Items',  

                image : url+'/buttons/event-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[eventItems num_of_posts="3" title="Upcoming Events" message="Come and join us at our upcoming events across the city" header_image="" post_order="DESC" tag="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('eventItems', tinymce.plugins.eventItems);


	//////////////////// MENU ITEMS
    tinymce.create('tinymce.plugins.menuItems', {  

        init : function(ed, url) {  

            ed.addButton('menuItems', {  

                title : 'Menu Items',  

                image : url+'/buttons/menu-items.gif',  

                onclick : function() {  

                     ed.selection.setContent('[menuItems num_of_posts="3" title="Daily Specials" message="Featuring the best dishes from our menu" header_image="" post_order="DESC" tag="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('menuItems', tinymce.plugins.menuItems);

	////////////////////// BOX BUTTON
	/*tinymce.create('tinymce.plugins.boxButton', {  

        init : function(ed, url) {  

            ed.addButton('boxButton', {  

                title : 'Box Button',  

                image : url+'/buttons/button2.gif',  

                onclick : function() {  

                     ed.selection.setContent('[boxButton link="#" margin_top="0" margin_bottom="0" icon="typcn typcn-vendor-microsoft" target="_self"]' + ed.selection.getContent() + '[/boxButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('boxButton', tinymce.plugins.boxButton); */


	//////////////////// STAFF PROFILE
    /*tinymce.create('tinymce.plugins.staffProfile', {  

        init : function(ed, url) {  

            ed.addButton('staffProfile', {  

                title : 'Staff Profile',  

                image : url+'/buttons/staffProfile.gif',  

                onclick : function() {  

                     ed.selection.setContent('[staffProfile id="" name_color="#2C5E83" title_color="#4B4B4B" text_color="#4b4b4b" icon_color="#dad9d9" target="_blank" class="wow fadeInUp" animation_delay="1" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('staffProfile', tinymce.plugins.staffProfile);*/
	
		 

	//////////////////// QUOTE BOX
    tinymce.create('tinymce.plugins.quoteBox', {  

        init : function(ed, url) {  

            ed.addButton('quoteBox', {  

                title : 'Quote Box',  

                image : url+'/buttons/quoteBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[quoteBox author_name="Jane Tolman" author_title="Visual Designer, Academix Systems" avatar="" text_color="#333354" name_color="#295D84"]' + ed.selection.getContent() + '[/quoteBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('quoteBox', tinymce.plugins.quoteBox);  
		

	//////////////////// COLUMN CONTAINER
    tinymce.create('tinymce.plugins.bootstrapContainer', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapContainer', {  

                title : 'Bootstrap Container',  

                image : url+'/buttons/cc.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapContainer fullscreen="off" bgcolor="transparent" bgimage="" bgposition="static" bgrepeat="repeat-x" alignment="left" paddingTop="60" paddingBottom="60" border_color="#DBC164" border_height="0" parallax="off" icon="" class="" id=""]' + ed.selection.getContent() + '[/bootstrapContainer]');  


                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapContainer', tinymce.plugins.bootstrapContainer);  	
	
	
	//////////////////// CONTAINER
	tinymce.create('tinymce.plugins.bootstrapRow', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapRow', {  

                title : 'Bootstrap Row',  

                image : url+'/buttons/container.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapRow class=""]' + ed.selection.getContent() + '[/bootstrapRow]');

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;

        },  

    });  

    tinymce.PluginManager.add('bootstrapRow', tinymce.plugins.bootstrapRow); 
	 
	
	//////////////////// COLUMN
    tinymce.create('tinymce.plugins.bootstrapColumn', {  

        init : function(ed, url) {  

            ed.addButton('bootstrapColumn', {  

                title : 'Bootstrap Column',  

                image : url+'/buttons/column.gif',  

                onclick : function() {  

                     ed.selection.setContent('[bootstrapColumn col_large="12" col_medium="12" col_small="12" col_extrasmall="12" class=""]' + ed.selection.getContent() + '[/bootstrapColumn]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('bootstrapColumn', tinymce.plugins.bootstrapColumn); 

		

    ////////////////////// SLIDER CAROUSEL
	
	tinymce.create('tinymce.plugins.sliderCarousel', {  

        init : function(ed, url) {  

            ed.addButton('sliderCarousel', {  

                title : 'Slider Carousel',  

                image : url+'/buttons/slider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[sliderCarousel animation="slide"]<br />[sliderItem img="" title="" /]<br />[/sliderCarousel]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('sliderCarousel', tinymce.plugins.sliderCarousel);
    

	////////////////////// CTA BOX
	
	tinymce.create('tinymce.plugins.ctaBox', {  

        init : function(ed, url) {  

            ed.addButton('ctaBox', {  

                title : 'Call To Action Box',  

                image : url+'/buttons/ctaBox.gif',  

                onclick : function() {  

                     ed.selection.setContent('[ctaBox title="" icon="fa fa-exclamation" icon_color="#DBC164"]' + ed.selection.getContent() + '[/ctaBox]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('ctaBox', tinymce.plugins.ctaBox); 


	////////////////////// DIVIDER
	
	tinymce.create('tinymce.plugins.divider', {  

        init : function(ed, url) {  

            ed.addButton('divider', {  

                title : 'Content divider',  

                image : url+'/buttons/divider.gif',  

                onclick : function() {  

                     ed.selection.setContent('[divider height="1" bg_color="#E3E3E3" margin="20" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('divider', tinymce.plugins.divider); 

	////////////////////// ALERT
	
	tinymce.create('tinymce.plugins.alert', {  

        init : function(ed, url) {  

            ed.addButton('alert', {  

                title : 'Alert Box',  

                image : url+'/buttons/alert.png',  

                onclick : function() {  

                     ed.selection.setContent('[alert close="true" type="success" icon=""]' + ed.selection.getContent() + '[/alert]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

	tinymce.PluginManager.add('alert', tinymce.plugins.alert); 

	////////////////////// GOOGLE MAP
	
	tinymce.create('tinymce.plugins.googleMap', {  

        init : function(ed, url) {  

            ed.addButton('googleMap', {  

                title : 'Google Map',  

                image : url+'/buttons/google-map.png',  

                onclick : function() {  

                     ed.selection.setContent('[googleMap id="anotherMap" zoom="13" latitude="43.656885" longitude="-79.383904" message="We are here" height="300" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('googleMap', tinymce.plugins.googleMap); 
	

	////////////////////// PANEL HEADER
	
	tinymce.create('tinymce.plugins.panelHeader', {  

        init : function(ed, url) {  

            ed.addButton('panelHeader', {  

                title : 'Panel Header',  

                image : url+'/buttons/panel-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[panelHeader panel_style="1" link="" target="_self" color="" show_button="true" button_text="" margin_bottom="10" icon="fa-angle-right" tip="" bg_color="transparent" ]' + ed.selection.getContent() + '[/panelHeader]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('panelHeader', tinymce.plugins.panelHeader); 
	
	////////////////////// COLUMN HEADER
	
	tinymce.create('tinymce.plugins.columnHeader', {  

        init : function(ed, url) {  

            ed.addButton('columnHeader', {  

                title : 'Column Header',  

                image : url+'/buttons/column-header.gif',  

                onclick : function() {  

                     ed.selection.setContent('[columnHeader title="Title goes here" message="Message goes here" header_image="" /]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('columnHeader', tinymce.plugins.columnHeader); 
	

	////////////////////// BUTTON
	
	tinymce.create('tinymce.plugins.standardButton', {  

        init : function(ed, url) {  

            ed.addButton('standardButton', {  

                title : 'Standard Button',  

                image : url+'/buttons/button.gif',  

                onclick : function() {  

                     ed.selection.setContent('[standardButton link="#" margin_top="20" margin_bottom="20" target="_self" icon="fa fa-angle-right" animated="off" class=""]' + ed.selection.getContent() + '[/standardButton]');  

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('standardButton', tinymce.plugins.standardButton); 
	
	
	//////////////////// ICON
    tinymce.create('tinymce.plugins.iconElement', {  

        init : function(ed, url) {  

            ed.addButton('iconElement', {  

                title : 'Icon Element',  

                image : url+'/buttons/icon.gif',  

                onclick : function() {  

                     ed.selection.setContent('[iconElement symbol="typcn typcn-device-tablet" color="#EF5438" size="4" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('iconElement', tinymce.plugins.iconElement);
	
	
	//////////////////// YOUTUBE
    tinymce.create('tinymce.plugins.youtubeVideo', {  

        init : function(ed, url) {  

            ed.addButton('youtubeVideo', {  

                title : 'Youtube Video',  

                image : url+'/buttons/youtube.png',  

                onclick : function() {  

                     ed.selection.setContent('[youtubeVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('youtubeVideo', tinymce.plugins.youtubeVideo);
	
	
	
	//////////////////// VIMEO
    tinymce.create('tinymce.plugins.vimeoVideo', {  

        init : function(ed, url) {  

            ed.addButton('vimeoVideo', {  

                title : 'Vimeo Video',  

                image : url+'/buttons/vimeo.png',  

                onclick : function() {  

                     ed.selection.setContent('[vimeoVideo id="0" height="250" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('vimeoVideo', tinymce.plugins.vimeoVideo);
	
	
	//////////////////// HTML5 VIDEO


    tinymce.create('tinymce.plugins.html5Video', {  

        init : function(ed, url) {  

            ed.addButton('html5Video', {  

                title : 'HTML5 Video',  

                image : url+'/buttons/html5-video.png',  

                onclick : function() {  

                     ed.selection.setContent('[html5Video webm="" mp4="" ogg=""][/html5Video]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('html5Video', tinymce.plugins.html5Video);
	
	
	//////////////////// TAB GROUP


    tinymce.create('tinymce.plugins.tabGroup', {  

        init : function(ed, url) {  

            ed.addButton('tabGroup', {  

                title : 'Tab Group',  

                image : url+'/buttons/tab-group.gif',  

                onclick : function() {  

                     ed.selection.setContent('[tabGroup]<br />[tabItem title="Tab"]' + ed.selection.getContent() + '[/tabItem]<br />[/tabGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('tabGroup', tinymce.plugins.tabGroup);
	
	
	//////////////////// ACCORDION GROUP


    tinymce.create('tinymce.plugins.accordionGroup', {  

        init : function(ed, url) {  

            ed.addButton('accordionGroup', {  

                title : 'Accordion Group',  

                image : url+'/buttons/accordion.gif',  

                onclick : function() {  

                     ed.selection.setContent('[accordionGroup]<br />[accordionItem title="Accordion Item 1"]' + ed.selection.getContent() + '[/accordionItem]<br />[/accordionGroup]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('accordionGroup', tinymce.plugins.accordionGroup);
	
	
	//////////////////// FEATURED GALLERY


    /*tinymce.create('tinymce.plugins.featuredGallery', {  

        init : function(ed, url) {  

            ed.addButton('featuredGallery', {  

                title : 'Featured Gallery',  

                image : url+'/buttons/posts.gif',  

                onclick : function() {  

                     ed.selection.setContent('[featuredGallery items="4" order_by="DESC" padding_top="20" padding_bottom="20" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('featuredGallery', tinymce.plugins.featuredGallery);*/
	
	
	//////////////////// CONTACT FORM

    tinymce.create('tinymce.plugins.contactForm', {  

        init : function(ed, url) {  

            ed.addButton('contactForm', {  

                title : 'Contact Form',  

                image : url+'/buttons/contact-form.gif',  

                onclick : function() {  

                     ed.selection.setContent('[contactForm email_address="name@yourdomain.com" alert_message="All fields are required." button_text="Send Message" text_color="red" /]');    

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('contactForm', tinymce.plugins.contactForm);
	
	
	//////////////////// IMAGE PANEL


    tinymce.create('tinymce.plugins.imagePanel', {  

        init : function(ed, url) {  

            ed.addButton('imagePanel', {  

                title : 'Image Panel',  

                image : url+'/buttons/image-panel.gif',  

                onclick : function() {  

                     ed.selection.setContent('[imagePanel icon="fa fa-link" link="#" image="" /]');   

                }  

            });  

        },  

        createControl : function(n, cm) {  

            return null;  

        },  

    });  

    tinymce.PluginManager.add('imagePanel', tinymce.plugins.imagePanel);

    
})();  