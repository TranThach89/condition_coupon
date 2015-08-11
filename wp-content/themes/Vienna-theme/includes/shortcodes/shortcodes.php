<?php
/*-----------------------------------------------------------------------------------*/
/*	Theme Shortcodes
/*-----------------------------------------------------------------------------------*/

// This function will run to make sure that column shortcodes run after wp_texturize so that stray paragraph and line break tags aren't added.
function pm_ln_run_shortcode( $content ) {
    global $shortcode_tags;
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
	
	add_shortcode("fancyTitle", "fancyTitle");//COMPLETE
	add_shortcode("columnHeader", "columnHeader");//COMPLETE
	add_shortcode("menuItems", "menuItems");//COMPLETE
	add_shortcode("eventItems", "eventItems");//COMPLETE
	add_shortcode("postItems", "postItems");//COMPLETE
	add_shortcode("vimeoVideo", "vimeoVideo");//COMPLETE
	add_shortcode("html5Video", "html5Video");//COMPLETE
	add_shortcode("staffProfile", "staffProfile");//COMPLETE
	add_shortcode("sliderCarousel", "sliderCarousel");//COMPLETE
	add_shortcode("sliderItem", "sliderItem");//COMPLETE
	add_shortcode("iconElement", "iconElement");//COMPLETE
	add_shortcode("youtubeVideo", "youtubeVideo");//COMPLETE
	add_shortcode("googleMap", "googleMap");//COMPLETE
	add_shortcode("divider", "divider");//COMPLETE
	add_shortcode("standardButton", "standardButton");//COMPLETE
	add_shortcode("boxButton", "boxButton");//COMPLETE
	add_shortcode("ctaBox", "ctaBox");//COMPLETE
	add_shortcode("tabGroup", "tabGroup");//COMPLETE
	add_shortcode("tabItem", "tabItem");//COMPLETE
	add_shortcode("accordionGroup", "accordionGroup");//COMPLETE
	add_shortcode("accordionItem", "accordionItem");//COMPLETE
	add_shortcode("contactForm", "contactForm");//COMPLETE
	add_shortcode("alert", "alert");//COMPLETE
	add_shortcode("quoteBox", "quoteBox"); //COMPLETE	
	
	//Bootstrap 3
	add_shortcode("bootstrapContainer", "bootstrapContainer");//COMPLETE
	add_shortcode("bootstrapRow", "bootstrapRow");//COMPLETE
	add_shortcode("bootstrapColumn", "bootstrapColumn");//COMPLETE
	add_shortcode("nestedRow", "nestedRow");//COMPLETE
	add_shortcode("nestedColumn", "nestedColumn");//COMPLETE
	
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode( $content );
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
    return $content;
}
add_filter( 'the_content', 'pm_ln_run_shortcode', 7 );
add_filter( 'widget_text', 'pm_ln_run_shortcode', 7 );

//FANCY TITLE
function fancyTitle($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => 'Latest News'
		), 
	$atts));
	
	return '<p class="pm-fancy-title pm-fancy"><span>'.$title.'</span></p>';
	
}

//POST ITEMS
function columnHeader($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => 'Latest News',
		"message" => 'Bringing you the latest in cuisine and culture',
		"header_image" => ''
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-featured-header-container">';
		$html .= '<div style="background-image:url('.$header_image.');" class="pm-featured-header-title-container">';
			$html .= '<p class="pm-featured-header-title">'.$title.'</p>';
			$html .= '<p class="pm-featured-header-message">'.$message.'</p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//POST ITEMS
function postItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '2',
		"title" => 'Latest News',
		"message" => 'Bringing you the latest in cuisine and culture',
		"header_image" => '',
		"post_order" => 'DESC'
		), 
	$atts));
	
	//Fetch data
	$arguments = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		//'posts_per_page' => -1,
		'order' => (string) $post_order,
		'posts_per_page' => $num_of_posts,
		//'tag' => get_query_var('tag')
	);

	$post_query = new WP_Query($arguments);

	pm_ln_set_query($post_query);

	
	$html = '';
	
	//Display Items
	$html .= '<div class="row">';
	
		$html .= '<div class="col-lg-12 pm-containerPadding-bottom-30 pm-containerPadding-top-30">';
			$html .= '<div class="pm-featured-header-container">';
				$html .= '<div class="pm-featured-header-title-container" style="background-image:url('.$header_image.');">';
					$html .= '<p class="pm-featured-header-title">'.$title.'</p>';
					$html .= '<p class="pm-featured-header-message">'.$message.'</p>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		
		if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
		
			$count = get_comments_number();
	 
			if ( has_post_thumbnail()) {
			  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
			}
			$pm_featured_post_image_meta = get_post_meta(get_the_ID(), 'pm_featured_post_image_meta', true);
			
			$html .= '<div class="col-lg-6 col-md-6 col-sm-12 pm-column-spacing">';
				$html .= '<div class="pm-news-post-container">';
					if($pm_featured_post_image_meta !== '') {
						$html .= '<div class="pm-news-post-image" style="background-image:url('.$pm_featured_post_image_meta.');">';
							$html .= '<div class="pm-news-post-title">';
								$html .= '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
							$html .= '</div>';
						$html .= '</div>';
					} else if(has_post_thumbnail()) {
						$html .= '<div class="pm-news-post-image" style="background-image:url('.$image_url[0].');">';
							$html .= '<div class="pm-news-post-title">';
								$html .= '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
							$html .= '</div>';
						$html .= '</div>';
					} else {
						$html .= '<div class="pm-news-post-image" style="min-height:40px !important;">';
							$html .= '<div class="pm-news-post-title">';
								$html .= '<p><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
							$html .= '</div>';
						$html .= '</div>';
					}				
					$html .= '<div class="pm-news-post-meta-container">';
						$html .= '<div class="pm-news-post-date">';
							$html .= '<p class="day">'.get_the_time( 'd' ).'</p>';
							$html .= '<p class="month-year">'.get_the_time( 'M' ).'<br />'.get_the_time( 'Y' ).'</p>';
						$html .= '</div>';
						$html .= '<ul class="pm-meta-options-list">';
							$html .= '<li><i class="fa fa-comment"></i> &nbsp;'.get_comments_number().' '.__('Comments','viennatheme').'</li>';
							$html .= '<li><i class="fa fa-twitter"></i> &nbsp;<a href="https://twitter.com/share?url='. urlencode(get_the_permalink()) .'&amp;text='. urlencode(get_the_title()) .'" target="_blank">'.__('Tweet this','viennatheme').'</a></li>';
							$html .= '<li><i class="fa fa-pencil"></i> &nbsp;<a href="'.get_comments_link().'">'.__('Post a comment','viennatheme').'</a></li>';
						$html .= '</ul>';
					$html .= '</div>';
					$html .= '<div class="pm-news-post-desc-container">';
						$post_excerpt = get_the_excerpt();
						$html .= '<p class="pm-news-post-excerpt">'. pm_ln_string_limit_words($post_excerpt,35) .' <a href="'.get_the_permalink().'">{...}</a></p>';
						$html .= '<p class="pm-news-post-continue"><a href="'.get_the_permalink().'">'.__('Continue Reading','viennatheme').' &rarr;</a></p>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		
		endwhile; else:
			$html .= '<div class="col-lg-12 pm-column-spacing">';
			 $html .= '<p>'.__('No posts were found.', 'viennatheme').'</p>';
			$html .= '</div>';
		endif;
	
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}


//MENU ITEMS
function eventItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"title" => 'Upcoming Events',
		"message" => 'Come and join us at our upcoming events across the city',
		"header_image" => '',
		"post_order" => 'DESC',
		"tag" => ''
		), 
	$atts));
	
	//Fetch data
	if($tag !== ''){
		
		$arguments = array(
			'post_type' => 'post_event',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'eventtags',
						'field' => 'slug',
						'terms' => array( $tag )
					)
			),
			'posts_per_page' => $num_of_posts,
		);
		
	} else {
		
		$arguments = array(
			'post_type' => 'post_event',
			'post_status' => 'publish',
			'paged' => $paged,
			'order' => (string) $post_order,
			'posts_per_page' => $num_of_posts,
		);
		
	}	

	$event_query = new WP_Query($arguments);

	pm_ln_set_query($event_query);

	
	$html = '';
	
	//Display Items
	$html .= '<div class="row">';
	
		$html .= '<div class="col-lg-12 pm-containerPadding-bottom-30 pm-containerPadding-top-30">';
			$html .= '<div class="pm-featured-header-container">';
				$html .= '<div class="pm-featured-header-title-container" style="background-image:url('.$header_image.');">';
					$html .= '<p class="pm-featured-header-title">'.$title.'</p>';
					$html .= '<p class="pm-featured-header-message">'.$message.'</p>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		
		if ($event_query->have_posts()) : while ($event_query->have_posts()) : $event_query->the_post();
		
			$pm_event_featured_image_meta = get_post_meta(get_the_ID(), 'pm_event_featured_image_meta', true);
			$pm_event_date_meta = get_post_meta(get_the_ID(), 'pm_event_date_meta', true);
			$month = date("M", strtotime($pm_event_date_meta));
			$day = date("d", strtotime($pm_event_date_meta));
			$year = date("Y", strtotime($pm_event_date_meta));
			$pm_event_fan_page_meta = get_post_meta(get_the_ID(), 'pm_event_fan_page_meta', true);
			
			$html .= '<div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">';
				$html .= '<div class="pm-event-item-container">';
					$html .= '<div class="pm-event-item-img-container" style="background-image:url('. $pm_event_featured_image_meta .');">';
						$html .= '<div class="pm-event-item-date">';
							$html .= '<p class="pm-event-item-month">'.$month.'</p>';
							$html .= '<p class="pm-event-item-day">'.$day.'</p>';
						$html .= '</div>';
					$html .= '</div>';
					$html .= '<div class="pm-event-item-desc">';
						$html .= '<p class="pm-event-item-title">'. get_the_title() .'</p>';
						$html .= '<div class="pm-event-item-divider"></div>';
						$html .= '<p class="pm-event-item-excerpt">';
							$excerpt = get_the_excerpt();
							$html .= pm_ln_string_limit_words($excerpt,20) . '<a href="'.get_the_permalink().'"> {...}</a>'; 
						$html .= '</p>';
						$html .= '<div class="pm-event-item-divider"></div>';
						$html .= '<ul class="pm-event-item-btns">';
							$html .= '<li><a href="'. get_the_permalink() .'" class="pm-rounded-btn small">'. __('More Info','viennatheme') .'</a></li>';
							if($pm_event_fan_page_meta !== '') {
								$html .= '<li><a href="'. $pm_event_fan_page_meta .'" class="pm-rounded-btn small event-fan-page" target="_blank"><i class="fa fa-facebook"></i> &nbsp;'. __('Fan Page','viennatheme') .'</a></li>';
							} 
						$html .= '</ul>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		
		endwhile; else:
			 $html .= '<p>'.__('No menu items were found.', 'viennatheme').'</p>';
		endif;
	
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}


//MENU ITEMS
function menuItems($atts, $content = null) {
		
	extract(shortcode_atts(array(
		"num_of_posts" => '3',
		"title" => 'Daily Specials',
		"message" => 'Featuring the best dishes from our menu',
		"header_image" => '',
		"post_order" => 'DESC',
		"tag" => ''
		), 
	$atts));
	
	//Fetch data
	if($tag !== ''){
		
		$arguments = array(
			'post_type' => 'post_menus',
			'post_status' => 'publish',
			'order' => (string) $post_order,
			'tax_query' => array(
					array(
						'taxonomy' => 'menutags',
						'field' => 'slug',
						'terms' => array( $tag )
					)
			),
			//'posts_per_page' => -1,
			'posts_per_page' => $num_of_posts,
			//'tag' => get_query_var('tag')
		);
		
	} else {
		
		$arguments = array(
			'post_type' => 'post_menus',
			'post_status' => 'publish',
			'paged' => $paged,
			'order' => (string) $post_order,
			'posts_per_page' => $num_of_posts,
		);
		
	}	

	$menu_query = new WP_Query($arguments);

	pm_ln_set_query($menu_query);

	
	$html = '';
	
	//Display Items
	$html .= '<div class="row">';
	
		$html .= '<div class="col-lg-12 pm-containerPadding-bottom-30 pm-containerPadding-top-30">';
			$html .= '<div class="pm-featured-header-container">';
				$html .= '<div class="pm-featured-header-title-container" style="background-image:url('.$header_image.');">';
					$html .= '<p class="pm-featured-header-title">'.$title.'</p>';
					$html .= '<p class="pm-featured-header-message">'.$message.'</p>';
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';
		
		if ($menu_query->have_posts()) : while ($menu_query->have_posts()) : $menu_query->the_post();
		
			$pm_menu_image_meta = get_post_meta(get_the_ID(), 'pm_menu_image_meta', true);
			$pm_menu_item_price_meta = get_post_meta(get_the_ID(), 'pm_menu_item_price_meta', true);
					
			$html .= '<div class="col-lg-4 col-md-4 col-sm-12 pm-column-spacing">';
				$html .= '<div class="pm-menu-item-container">';
					$html .= '<div class="pm-menu-item-img-container" style="background-image:url('. $pm_menu_image_meta .');">';
						if($pm_menu_item_price_meta !== ''){
							$html .= '<div class="pm-menu-item-price"><p>'. $pm_menu_item_price_meta .'</p></div>';	
						}
					$html .= '</div>';
					$html .= '<div class="pm-menu-item-desc">';
						$html .= '<p class="pm-menu-item-title">'.get_the_title().'</p>';
						$html .= '<p class="pm-menu-item-excerpt">';
							 $html .= get_the_content();
						$html .= '</p>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
		
		endwhile; else:
			 $html .= '<div class="col-lg-12 pm-column-spacing">';
			 	$html .= '<p>'.__('No menu items were found.', 'viennatheme').'</p>';
			 $html .= '</div>';
		endif;
	
	$html .= '</div>';
				
	pm_ln_restore_query();
	
	return $html;
	
		
}

//STAFF PROFILE
function staffProfile( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"id" => '',
		"name_color" => '#2C5E83',
		"title_color" => '#4B4B4B',
		"text_color" => '#4b4b4b',
		"icon_color" => '#dad9d9',
		"target" => '_blank',
		"class" => 'wow fadeInUp',
		"animation_delay" => 2
		), 
	$atts));
	
	//Method to retrieve a single post
	$queried_post = get_post($id);
	$postID = $queried_post->ID;
	$postLink = $queried_post->guid;
	$postTitle = $queried_post->post_title;
	//$postTags = get_the_tags($postID);
	$postExcerpt = $queried_post->post_excerpt;
	$shortExcerpt = pm_ln_string_limit_words($postExcerpt, 20);
	$pm_staff_image_meta = get_post_meta($postID, 'pm_staff_image_meta', true);
	$pm_staff_title_meta = get_post_meta($postID, 'pm_staff_title_meta', true);
	$pm_staff_twitter_meta = get_post_meta($postID, 'pm_staff_twitter_meta', true);
	$pm_staff_facebook_meta = get_post_meta($postID, 'pm_staff_facebook_meta', true);
	$pm_staff_gplus_meta = get_post_meta($postID, 'pm_staff_gplus_meta', true);
	$pm_staff_linkedin_meta = get_post_meta($postID, 'pm_staff_linkedin_meta', true);
	
	$html = '';
	
	$html .= '<div class="pm-staff-profile-container '.$class.'" data-wow-delay="0.'.$animation_delay.'s" data-wow-offset="50" data-wow-duration="1s">';
		$html .= '<div class="pm-staff-profile-image-wrapper">';
			$html .= '<div class="pm-staff-profile-image">';
				$html .= '<img src="'.$pm_staff_image_meta.'" class="img-responsive" alt="profile">';
			$html .= '</div>';
			$html .= '<ul class="pm-staff-profile-icons">';
				if($pm_staff_twitter_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_twitter_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-twitter"></i></a></li>';
				}
				if($pm_staff_facebook_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_facebook_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-facebook"></i></a></li>';
				}
				if($pm_staff_gplus_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_gplus_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-google-plus"></i></a></li>';
				}
				if($pm_staff_linkedin_meta !== ''){
					$html .= '<li><a href="'.$pm_staff_linkedin_meta.'" target="'.$target.'" style="background-color:'.$icon_color.';"><i class="fa fa-linkedin"></i></a></li>';
				}				
			$html .= '</ul>';
		$html .= '</div>';
		$html .= '<div class="pm-staff-profile-details">';
			$html .= '<p class="pm-staff-profile-name" style="color:'.$name_color.';">'.$postTitle.'</p>';
			$html .= '<p class="pm-staff-profile-title" style="color:'.$title_color.';">'.$pm_staff_title_meta.'</p>';
			$html .= '<p class="pm-staff-profile-bio" style="color:'.$text_color.';">'.$postExcerpt.'</p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
	
}

//NEWSLETTER SIGNUP
function newsletterSignup( $atts, $content = null ){
	
	extract(shortcode_atts(array(
		"mailchimp_url" => '',
		"name_placeholder" => 'Your Name',
		"email_placeholder" => 'Email Address',
		"class" => ''
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-workshop-newsletter-form-container">';
		$html .= '<form action="'.htmlspecialchars($mailchimp_url).'" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>  ';
			$html .= '<input name="MERGE1" type="text" id="MERGE1" placeholder="'.$name_placeholder.'">';
			$html .= '<input name="MERGE0" type="text" id="MERGE0" placeholder="'.$email_placeholder.'">';
			$html .= '<input name="subscribe" id="mc-embedded-subscribe" type="submit" value="subscribe" class="pm-workshop-newsletter-submit-btn">';
		$html .= '</form>';
	 $html .= '</div>';
					 
	return $html;
	
}


//QUOTE BOX (testimonial)
function quoteBox($atts, $content = null){
	
	extract(shortcode_atts(array(
		"author_name" => '',
		"author_title" => '',
		"avatar" => '',
		"text_color" => 'white',
		"name_color" => '#4D4D4D'
		), 
	$atts));
	
	$html = '';
	
	$html .= '<div class="pm-single-testimonial-container">';
		$html .= '<div class="pm-single-testimonial-box">';
			$html .= '<p style="color:'.$text_color.';">'.$content.'</p>';
		$html .= '</div>';
		$html .= '<div class="pm-single-testimonial-author-container">';
			$html .= '<div class="pm-single-testimonial-author-avatar">';
				$html .= '<img src="'.$avatar.'" width="74" height="74" alt="avatar">';
			$html .= '</div>';
			$html .= '<div class="pm-single-testimonial-author-info">';
				$html .= '<p class="name" style="color:'.$name_color.';">'.$author_name.'</p>';
				$html .= '<p class="title" style="color:'.$name_color.';">'.$author_title.'</p>';
			$html .= '</div>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		
}


//SLIDER CONTAINER
function customSlider($atts, $content = null){
	
	extract(shortcode_atts(array(
			"id" => ''
			), 
	$atts));
	
	return '<div class="pm-slider-container">'.$content.'</div>';
}

//GOOGLE MAP
function googleMap($atts, $content = null) {
	
    extract(shortcode_atts(array(
		"id" => 'myMap', 
		"type" => 'road', 
		"latitude" => '43.656885', 
		"longitude" => '-79.383904', 
		"zoom" => '13', 
		"message" => 'This is the message...',
		"responsive" => 1, 
		"width" => '300', 
		"height" => '450'), 
	$atts));
     
    $mapType = '';
    if($type == "satellite")
        $mapType = "SATELLITE";
    else if($type == "terrain")
        $mapType = "TERRAIN"; 
    else if($type == "hybrid")
        $mapType = "HYBRID";
    else
        $mapType = "ROADMAP"; 
         
    echo '<!-- Google Map -->
        <script type="text/javascript"> 
		
		(function($) {
			
			$(document).ready(function() {
			  function initializeGoogleMap() {
		 
				  var myLatlng = new google.maps.LatLng('.$latitude.','.$longitude.');
				  var myOptions = {
					center: myLatlng, 
					zoom: '.$zoom.',
					mapTypeId: google.maps.MapTypeId.'.$mapType.'
				  };
				  var map = new google.maps.Map(document.getElementById("'.$id.'"), myOptions);
		 
				  var contentString = "'.$message.'";
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
				   
				  var marker = new google.maps.Marker({
					  position: myLatlng
				  });
				   
				  google.maps.event.addListener(marker, "click", function() {
					  infowindow.open(map,marker);
				  });
				   
				  marker.setMap(map);
				 
			  }
			  initializeGoogleMap();
		 
			});
			
		})(jQuery);
		
        
        </script>';
     
	if($responsive == 1){
		return '<div id="'.$id.'" style="width:100%; height:'.$height.'px;" class="googleMap"></div>';
	} else {
		return '<div id="'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googleMap"></div>';
	}
        
} 


//BOOTSTRAP ALERT
function alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "close" => 'true',
		"type" => 'success',
		"icon" => 'typcn typcn-tick',
    ), $atts)); 
	
	$html = '';
	
	$html .= '<div class="alert alert-'.$type.' alert-dismissible" role="alert">';
	  if($close == 'true'){
		 $html .= '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
	  }
	  $html .= '<i class="'.$icon.'"></i>';
	  $html .= $content;
	$html .= '</div>';
	
	return $html;

}

//DIVIDER
function divider( $atts, $content = null ) {
	
	extract(shortcode_atts(array(  
        "height" => '1',
		"bg_color" => 'orange',
		"margin" => 20
    ), $atts)); 
	
	return '<div class="pm-divider" style="height:'.$height.'px; background-color:'.$bg_color.'; margin:'.$margin.'px 0px;"></div>';

}


//STANDARD BUTTON
function standardButton($atts, $content = null) {  
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"target" => '_self',
		"icon" => '',
		"transparency" => 'off',
		"animated" => 'on',
		"class" => ''
    ), $atts));  
	
	$html = '';
	
	$html .= '<a href="'.$link.'" target="'.$target.'" class="pm-rounded-btn '. ( $transparency == 'on' ? 'transparent' : '' ) .' '. ( $animated == 'on' ? 'animated' : '' ) .' '.$class.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">'.$content.' '. ( $icon !== '' ? '<i class="'.$icon.'"></i>' : '' ) .'</a>';
	
	return $html;
		 
}  

//BOX BTN
function boxButton($atts, $content = null) { 
 
    extract(shortcode_atts(array(  
		"link" => '#',
		"margin_top" => 0,
		"margin_bottom" => 0,
		"icon" => 'typcn typcn-vendor-microsoft',
		"target" => '_self',
    ), $atts));  
	
	$html = '';
		
	$html .= '<div class="pm-icon-bundle" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
		$html .= ( $icon !== '' ? '<i class="'.$icon.'"></i>' : '' );
		$html .= '<div class="pm-icon-bundle-content">';
			$html .= '<p><a href="'.$link.'" target="'.$target.'">'.$content.' <i class="fa fa-angle-right"></i></a></p>';
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
		 
}  



//IMAGE PANEL
function imagePanel($atts, $content = null) {
			
	extract( shortcode_atts( array(
		'icon' => 'fa fa-link',
		'link' => '',
		'image' => '',
	), $atts ) );
	
	$html = '';
    
    $html .= '<div class="pm_image_panel">';
        
		$html .= '<div class="pm-hover-item-image-panel">';
		
			$html .= '<div class="pm-hover-item-icon"><a class="'.$icon.'" href="'.$link.'"></a></div>';
		
			$html .= '<div class="pm-image-panel-hover"></div>';
		
			$html .= '<div class="pm-hover-item-image-panel-img"><img src="'.$image.'" /></div>';
			
		$html .= '</div>';   
    
    $html .= '</div>';
    
	return $html;
	
}

//CALL TO ACTION
function ctaBox($atts, $content = null) {
	
	extract(shortcode_atts(array(
		"title" => '',
		"icon" => 'fa fa-exclamation',
		"icon_color" => '#DBC164',
    ), $atts));
	
	$html = '';
	
	$html .= '<div class="pm-alert-message">';
		$html .= '<i class="'.$icon.'" style="background-color:'.$icon_color.';"></i>';
		$html .= '<p class="pm-alert-title">'.$title.'</p>';
		$html .= '<p class="pm-alert-details">'.$content.'</p>';
	$html .= '</div>';
	
	return $html;
	
}

//ICON  
function iconElement($atts, $content = null) {
	extract(shortcode_atts(array(  
        "symbol" => 'typcn typcn-device-tablet',
		"color" => '#2B5C84',
		"size" => 4
    ), $atts));
	
    return '<div class="pm-icon-box"><span class="'.$symbol.' typcn-size'.$size.'" style="color:'.$color.';"></span></div>';  
	
}  

// YOUTUBE SHORTCODE
function youtubeVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="http://www.youtube.com/embed/'.$id.'" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}  


// VIMEO SHORTCODE
function vimeoVideo($atts) {  
    extract(shortcode_atts(array(  
        "id" => '',
		"width" => 300,
		"height" => 250,
		"responsive" => 0,
    ), $atts));  
	
	if($responsive == 1){
		$finalWidth = 100 .'%';
	} else {
		$finalWidth = $width;	
	}
	
    return '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;color=ffffff" width="'.$finalWidth.'" height="'.$height.'"></iframe>';  
}

//HTML5 VIDEO
function html5Video($atts, $content = null) {
	extract(shortcode_atts(array(  
        "webm" => '',
		"mp4" => '',
		"ogg" => '',
		'width' => '400',
		'height' => '400',
		"responsive" => 0,
    ), $atts)); 
	
	return '<div class="pm-video-container"><video id="pm-video-background" autoplay loop controls="true" muted="muted" preload="auto" volume="0"><source src="'.$mp4.'" type="video/mp4"><source src="'.$webm.'" type="video/webm"><source src="'.$ogg.'" type="video/ogg">HTML5 Video Mime Type not found.</video>'.do_shortcode($content).'</div>';
	
}


//TABS
function tabGroup( $atts, $content ){
	
	$GLOBALS['pm_ln_tab_count'] = 0;
	
	do_shortcode( $content );
	
	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){
	
			$tabs[] = '<li><a data-toggle="tab" href="#'.str_replace( ' ', '', $tab['title'] ).'">'.$tab['title'].'</a></li>';
		
			$panes[] = '<div class="tab-pane" id="'.str_replace( ' ', '', $tab['title'] ).'">'.$tab['content'].'</div>';
	
		}

		$return = "\n".'<ul class="nav nav-tabs pm-nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content pm-tab-content shortcode">'.implode( "\n", $panes ).'</div>'."\n";

	}

	return $return;

}

function tabItem( $atts, $content ){

	extract(shortcode_atts(array(

		'title' => 'Tab %d'

	), $atts));

	$x = $GLOBALS['pm_ln_tab_count'];

	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['pm_ln_tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['pm_ln_tab_count']++;

}

//ACCORDION
function accordionGroup($atts, $content = null) { 

	$GLOBALS['pm_ln_accordion_count'] = 0;
	
    return '<div class="panel-group" id="accordion">'.do_shortcode($content).'</div>';
	
}  

function accordionItem($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"title" => 'Accordion Item 1',
		"icon" => 'fa fa-plus'
    ), $atts)); 
	
	$html = '';
	
	  $html .= '<div class="panel panel-default">';
		$html .= '<div class="panel-heading">';
		  $html .= '<h4 class="panel-title"><i class="fa fa-plus"></i>';
			$html .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="pm-accordion-link">';
			  $html .= ''.$title.'';
			$html .= '</a>';
		  $html .= '</h4>';
		$html .= '</div>';
		$html .= '<div id="collapse'.$GLOBALS['pm_ln_accordion_count'].'" class="panel-collapse collapse">';
		  $html .= '<div class="panel-body">';
			$html .= ''.do_shortcode($content).'';
		  $html .= '</div>';
		$html .= '</div>';
	  $html .= '</div>';
	
	$GLOBALS['pm_ln_accordion_count']++;
	
    return $html;
	
} 

//FLEXSLIDER CAROUSEL
function sliderCarousel($atts, $content = null) { 

	extract(shortcode_atts(array(  
		"animation" => 'slide',
    ), $atts)); 

	if(!isset($GLOBALS['pm_ln_flexslider_count'])){
		$GLOBALS['pm_ln_flexslider_count'] = 0;
	}
	
	$html = '';
	
	$html .= '<div class="flexslider pm-post-slider" id="pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'" style="width:100%;"><ul class="slides">'.do_shortcode($content).'</ul></div>';
	
	$html .= '<script>(function($) {$(document).ready(function(e) {$("#pm-flexslider-carousel-'.$GLOBALS['pm_ln_flexslider_count'].'").flexslider({animation:"'.$animation.'", controlNav: false, directionNav: true, animationLoop: true, slideshow: false, arrows: true, touch: false, prevText : "", nextText : "" }); }); })(jQuery); </script>';
	
	//increment for next possible carousel slider
	$GLOBALS['pm_ln_flexslider_count']++;
	
    return $html;
	
}  

function sliderItem($atts, $content = null) {

	extract(shortcode_atts(array(  
		"img" => '',
		"title" => ''
    ), $atts)); 
	
	$html = '<li><img src="' . $img . '" alt="' . $title . '" /></li>';
		
    return $html;
	
}  


//PANEL HEADER
function panelHeader($atts, $content = null) {
	extract(shortcode_atts(array(  
		"panel_style" => 1,
		"link" => '',
		"target" => '_self',
		"color" => '#00BC9D',
		"show_button" => 'true',
		"button_text" => '',
		"margin_bottom" => 10,
		"icon" => 'fa-link',
		"tip" => '',
		"bg_color" => '#F3F3F3',
    ), $atts));
		
	if($panel_style == 1){
		
		//panel header style 1
		if($show_button == 'true'){
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4><div class="pm_span_header_btn"><a class="pm-custom-button pm-btn-animated pm-btn-small pm-post-btn p_header" href="'.$link.'" target="'.$target.'"><span>'.$button_text.' <i class="fa '.$icon.'"></i></span></a></div></div>';
		} else {
			return '<div class="pm_span_header" style="margin-bottom:'.$margin_bottom.'px;"><h4 style="color:'.$color.';">'.$content.'</h4></div>';
		}
		
	} elseif($panel_style == 2){
		
		//panel header style2
		if($show_button == 'true'){
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style2"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} elseif($panel_style == 3){
		
		//panel header style3
		if($show_button == 'true'){
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span><a target="_self" '.($tip !== '' ? 'title="'.$tip.'"' : '').'  '. ($tip !== '' ? 'class="pm_tip"' : '') .' href="'.$link.'"><i class="fa '.$icon.'"></i></a></h4></div>';
		} else {
			return '<div class="pm_span_header_style3_divider"></div><div style="margin-bottom:'.$margin_bottom.'px !important; overflow:hidden;" class="pm_span_header_style3"><h4 style="background-color:'.$bg_color.';"><span>'.$content.'</span></h4></div>';
		}
		
	} else {
		return "";	
	}
	
     
}


//CONTACT FORM
function contactForm($atts) {

	extract(shortcode_atts(array(  
		"email_address" => '',
		"alert_message" => 'Your email address will be held strictly confidential. Required fields are marked *',
		"button_text" => 'Submit',
		"text_color" => 'red',
    ), $atts)); 
	
	$html = '';
	
		$html .= '<div class="pm-contact-form-container">';
			$html .= '<p class="pm-required" style="color:'.$text_color.';">'.$alert_message.'</p>';
			$html .= '<form action="#" method="post" id="pm-contact-form">';
				$html .= '<input name="pm_s_full_name" id="pm_s_full_name" type="text" placeholder="'.__('Name *', 'viennatheme').'" class="pm-form-textfield">';
				$html .= '<input name="pm_s_email_address" id="pm_s_email_address" type="text" placeholder="'.__('Email *', 'viennatheme').'" class="pm-form-textfield">';
				$html .= '<input name="pm_s_subject" id="pm_s_subject" type="text" placeholder="'.__('Subject *', 'viennatheme').'" class="pm-form-textfield">';
				$html .= '<textarea name="pm_s_message" id="pm_s_message" cols="20" rows="6" placeholder="'.__('Inquiry *', 'viennatheme').'" class="pm-form-textarea"></textarea>';
				$html .= '<div class="pm_captcha_box">';
					$html .= '<p>'.__('Security Code:').'</p>';
					$html .= '<img src="'.get_template_directory_uri().'/js/ajax-contact/CaptchaSecurityImages.php?width=100&height=40&characters=5" /><br />';
					$html .= '<div style="width:96px;"><div style="padding-top:2px; width:86px;"><input class="pm_s_security_code pm-form-textfield" name="security_code" type="text" class="form_field_security" id="security_code" maxlength="5" /></div></div>';
				$html .= '</div>';	
				$html .= '<div id="pm-contact-form-response"></div>';	
				$html .= '<input name="pm-form-submit-btn" class="pm-rounded-submit-btn" type="button" value="'.$button_text.'" id="pm-contact-form-btn">';
				$html .= '<input type="hidden" value="pm-contact-form-submitted" />';
				$html .= '<input type="hidden" name="pm_s_email_address_contact" value="'.$email_address.'" />';
			$html .= '</form>';
		$html .= '</div>';
		
	return $html;
	
}


/******** BOOTSTRAP 3 COLUMNS ***********/

//COLUMN CONTAINER
function bootstrapContainer($atts, $content = null) { 

	extract(shortcode_atts(array(  
        "fullscreen" => 'off',
		"bgcolor" => 'transparent',
		"bgimage" => '',
		"bgposition" => 'static',
		"bgrepeat" => 'repeat-x',
		"border" => 'no',
		"alignment" => 'left',
		"paddingtop" => 20,
		"paddingbottom" => 20,
		"border_color" => 'transparent',
		"border_height" => 5,
		"parallax" => 'on',
		"icon" => '',
		"class" => '',
		"id" => ''
    ), $atts)); 
	
	if($fullscreen == 'on'){
		//wrap a cta_container
		if($bgimage != ''){
			
			if($icon !== ''){
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container pm-parallax-panel '.$class.'" style="background-image:url('.$bgimage.'); background-repeat:'.$bgrepeat.'; background-attachment:'.$bgposition.' !important; background-color:'.$bgcolor.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div><div class="container">'.do_shortcode($content).'</div></div>';
				
			} else {
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container pm-parallax-panel '.$class.'" style="background-image:url('.$bgimage.'); background-repeat:'.$bgrepeat.'; background-attachment:'.$bgposition.' !important; background-color:'.$bgcolor.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';" '. ( $parallax == 'on' ? 'data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0"' : '' ) .'><div class="container">'.do_shortcode($content).'</div></div>';
				
			}
			
			
		} else {
			
			if($icon !== ''){
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container'.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';"><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div><div class="container">'.do_shortcode($content).'</div></div>';  	
				
			} else {
				
				return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px; border-top:'.$border_height.'px solid '.$border_color.';"><div class="container">'.do_shortcode($content).'</div></div>';  	
				
			}
			
			
		}
		
	} else {
		
		if($icon !== ''){
			
			return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px;"><div class="pm-column-container-icon" style="border:'.$border_height.'px solid '.$border_color.';"><i class="'.$icon.'"></i></div><div class="container">'.do_shortcode($content).'</div></div>'; 
			
		} else {
			
			return '<div '. ($id !== '' ? 'id="'.$id.'"' : '') .' class="pm-column-container '.$class.'" style="background-color:'.$bgcolor.'; background-repeat:'.$bgrepeat.'; text-align:'.$alignment.'; padding-top:'.$paddingtop.'px; padding-bottom:'.$paddingbottom.'px;"><div class="container">'.do_shortcode($content).'</div></div>'; 
				
		}
		  	
	}
    
}  

//COLUMN CONTAINER
function bootstrapRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//NESTED ROW
function nestedRow($atts, $content = null) {	

	extract(shortcode_atts(array(  
		"class" => ''
    ), $atts)); 

	if($class !== ''){
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	} else {
		return '<div class="row '.$class.'">'.do_shortcode($content).'</div>';
	}

	
}

//COLUMN
function bootstrapColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

//NESTED COLUMN
function nestedColumn($atts, $content = null) {
	
	extract(shortcode_atts(array(  
        "col_large" => 12,
		"col_medium" => 12,
		"col_small" => 12,
		"col_extrasmall" => 12,
		"class" => ''
    ), $atts)); 

	return '<div class="col-lg-'.$col_large.' col-md-'.$col_medium.' col-sm-'.$col_small.' col-xs-'.$col_extrasmall.' '.$class.'">'.do_shortcode($content).'</div>';	
}

/******** BOOTSTRAP 3 COLUMNS END ***********/

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/
add_action('init', 'pm_ln_add_tiny_shortcodes');  
function pm_ln_add_tiny_shortcodes() { 

	if ( current_user_can('edit_posts') && current_user_can('edit_pages') ) {
		 
		 //Bootstrap 3
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapContainer');  
     	 add_filter('mce_buttons_3', 'register_bootstrapContainer'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapRow');  
     	 add_filter('mce_buttons_3', 'register_bootstrapRow'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_bootstrapColumn');  
     	 add_filter('mce_buttons_3', 'register_bootstrapColumn'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_alert');  
     	 add_filter('mce_buttons_3', 'register_alert'); 
		 
		 //Add "standardButton" button
		 add_filter('mce_external_plugins', 'add_plugin_standardButton');  
		 add_filter('mce_buttons_3', 'register_standardButton');  
		 
		 //Add "boxButton" button
		 add_filter('mce_external_plugins', 'add_plugin_boxButton');  
		 add_filter('mce_buttons_3', 'register_boxButton');  
		 
		 //Add "divider" button
		 add_filter('mce_external_plugins', 'add_plugin_divider');  
		 add_filter('mce_buttons_3', 'register_divider'); 
		 
		 //Videos
		 add_filter('mce_external_plugins', 'add_plugin_youtubeVideo');  
     	 add_filter('mce_buttons_3', 'register_youtubeVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_vimeoVideo');  
     	 add_filter('mce_buttons_3', 'register_vimeoVideo'); 
		 
		 add_filter('mce_external_plugins', 'add_plugin_html5Video');  
     	 add_filter('mce_buttons_3', 'register_html5Video'); 
		 
		 //Tab Group
		 add_filter('mce_external_plugins', 'add_plugin_tabGroup');  
     	 add_filter('mce_buttons_3', 'register_tabGroup');
		 
		 //Accordion Group
		 add_filter('mce_external_plugins', 'add_plugin_accordionGroup');  
     	 add_filter('mce_buttons_3', 'register_accordionGroup');

		 
		 //Column Header
		 add_filter('mce_external_plugins', 'add_plugin_columnHeader');  
     	 add_filter('mce_buttons_3', 'register_columnHeader');
		 
		 //Contact Form
		 add_filter('mce_external_plugins', 'add_plugin_contactForm');  
     	 add_filter('mce_buttons_3', 'register_contactForm');	
		 
		 //Image panel
		 /*add_filter('mce_external_plugins', 'add_plugin_imagePanel');  
     	 add_filter('mce_buttons_3', 'register_imagePanel');*/
		 
		 //Google Map
		 add_filter('mce_external_plugins', 'add_plugin_googleMap');  
     	 add_filter('mce_buttons_3', 'register_googleMap');	
		 
		 //CTA Box
		 add_filter('mce_external_plugins', 'add_plugin_ctaBox');  
     	 add_filter('mce_buttons_3', 'register_ctaBox');
		 
		  //Icon Element
		 add_filter('mce_external_plugins', 'add_plugin_iconElement');  
     	 add_filter('mce_buttons_3', 'register_iconElement');	
		 
		 //Flexslider Carousel
		 add_filter('mce_external_plugins', 'add_plugin_sliderCarousel');  
     	 add_filter('mce_buttons_3', 'register_sliderCarousel');
		 
		 //Quote Box
		 add_filter('mce_external_plugins', 'add_plugin_quoteBox');  
     	 add_filter('mce_buttons_3', 'register_quoteBox');	
		 
		 //Staff Profile
		 add_filter('mce_external_plugins', 'add_plugin_staffProfile');  
     	 add_filter('mce_buttons_3', 'register_staffProfile');
		 
		 //Menu items
		 add_filter('mce_external_plugins', 'add_plugin_menuItems');  
     	 add_filter('mce_buttons_3', 'register_menuItems');
		 
		 //Event items
		 add_filter('mce_external_plugins', 'add_plugin_eventItems');  
     	 add_filter('mce_buttons_3', 'register_eventItems');
		 
		 //Post items
		 add_filter('mce_external_plugins', 'add_plugin_postItems');  
     	 add_filter('mce_buttons_3', 'register_postItems');
		 
		 //Fancy Title
		 add_filter('mce_external_plugins', 'add_plugin_fancyTitle');  
     	 add_filter('mce_buttons_3', 'register_fancyTitle');
		 
		
	}

}


//ACTIVATE TINYMCE BUTTONS
function register_fancyTitle($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "fancyTitle");  
   return $buttons;  
} 
function add_plugin_fancyTitle($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['fancyTitle'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_columnHeader($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "columnHeader");  
   return $buttons;  
} 
function add_plugin_columnHeader($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['columnHeader'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_postItems($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "postItems");  
   return $buttons;  
} 
function add_plugin_postItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['postItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_eventItems($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "eventItems");  
   return $buttons;  
} 
function add_plugin_eventItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['eventItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_menuItems($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "menuItems");  
   return $buttons;  
} 
function add_plugin_menuItems($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['menuItems'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_staffProfile($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "staffProfile");  
   return $buttons;  
} 
function add_plugin_staffProfile($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['staffProfile'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
} 

function register_standardButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "standardButton");  
   return $buttons;  
} 
function add_plugin_standardButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['standardButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}  

function register_boxButton($buttons) { //Registers the TinyMCE button 
   array_push($buttons, "boxButton");  
   return $buttons;  
} 
function add_plugin_boxButton($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['boxButton'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array; 
}  

function register_bootstrapContainer($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapContainer");  
   return $buttons;  
}
function add_plugin_bootstrapContainer($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapContainer'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapRow($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapRow");  
   return $buttons;  
}
function add_plugin_bootstrapRow($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapRow'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_bootstrapColumn($buttons) { //Registers the TinyMCE button
   array_push($buttons, "bootstrapColumn");  
   return $buttons;  
}
function add_plugin_bootstrapColumn($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['bootstrapColumn'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_youtubeVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "youtubeVideo");  
   return $buttons;  
}
function add_plugin_youtubeVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['youtubeVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_vimeoVideo($buttons) { //Registers the TinyMCE button
   array_push($buttons, "vimeoVideo");  
   return $buttons;  
}
function add_plugin_vimeoVideo($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['vimeoVideo'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_html5Video($buttons) { //Registers the TinyMCE button
   array_push($buttons, "html5Video");  
   return $buttons;  
}
function add_plugin_html5Video($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['html5Video'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_tabGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "tabGroup");  
   return $buttons;  
}
function add_plugin_tabGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['tabGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_accordionGroup($buttons) { //Registers the TinyMCE button
   array_push($buttons, "accordionGroup");  
   return $buttons;  
}
function add_plugin_accordionGroup($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['accordionGroup'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_contactForm($buttons) { //Registers the TinyMCE button
   array_push($buttons, "contactForm");  
   return $buttons;  
}
function add_plugin_contactForm($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['contactForm'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_googleMap($buttons) { //Registers the TinyMCE button
   array_push($buttons, "googleMap");  
   return $buttons;  
}
function add_plugin_googleMap($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['googleMap'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_alert($buttons) { //Registers the TinyMCE button
   array_push($buttons, "alert");  
   return $buttons;  
}
function add_plugin_alert($plugin_array) { //Adds the plugin functionality via javascript  
   $plugin_array['alert'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_divider($buttons) {  
   array_push($buttons, "divider");  
   return $buttons;  
}
function add_plugin_divider($plugin_array) {  
   $plugin_array['divider'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_ctaBox($buttons) {  
   array_push($buttons, "ctaBox");  
   return $buttons;  
}
function add_plugin_ctaBox($plugin_array) {  
   $plugin_array['ctaBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_iconElement($buttons) {  
   array_push($buttons, "iconElement");  
   return $buttons;  
}
function add_plugin_iconElement($plugin_array) {  
   $plugin_array['iconElement'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function register_sliderCarousel($buttons) {  
   array_push($buttons, "sliderCarousel");  
   return $buttons;  
}
function add_plugin_sliderCarousel($plugin_array) {  
   $plugin_array['sliderCarousel'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}


function register_quoteBox($buttons) {  
   array_push($buttons, "quoteBox");  
   return $buttons;  
}
function add_plugin_quoteBox($plugin_array) {  
   $plugin_array['quoteBox'] = get_template_directory_uri().'/js/tinymce-btns.js';    
   return $plugin_array;  
}

function parse_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim(  do_shortcode( $content ) );
    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );
    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );
    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    return $content;
}

?>