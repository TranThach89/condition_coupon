<?php

/*

Plugin Name: Events Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your events
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_events_widget');

//register our widget
function pm_events_widget() {
	register_widget('pm_eventposts_widget');
}

//pm_eventposts_widget class
class pm_eventposts_widget extends WP_Widget {
	
	//process the new widget
	function pm_eventposts_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_eventposts_widget',
			'description' => __('Display your events.','viennatheme')
		);
		
		$this->WP_Widget('pm_eventposts_widget', __('[Pulsar Media] - Events','viennatheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Events', 
			'fa_icon' => '',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php _e('Title:', 'viennatheme') ?> <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <p>
                <!--<label for="<?php //echo $this->get_field_id( 'fa_icon' ); ?>"><?php //_e('FontAwesome Icon:', 'viennatheme') ?></label>
                <input id="<?php //echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php //echo $this->get_field_name( 'fa_icon' ); ?>" value="<?php //echo $instance['fa_icon']; ?>"  class="widefat" />-->
            </p>
            <p><?php _e('Number of Events to show:', 'viennatheme') ?> <input class="widefat" name="<?php echo $this->get_field_name('numOfPosts'); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['numOfPosts'] = strip_tags( $new_instance['numOfPosts'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? '' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$numOfPosts = empty( $instance['numOfPosts'] ) ? '3' : $instance['numOfPosts'];
		
		if( !empty($title) ){
			
			echo $before_title . $title . $after_title;
			
		}//end of if
		
		/*
		post_author 
		post_date
		post_date_gmt
		post_content
		post_title
		post_category
		post_excerpt
		post_status
		comment_status 
		ping_status
		post_name
		comment_count 
		*/
		
		//retrieve recent posts
		$args = array(
					'numberposts' => $numOfPosts,
					'offset' => 0,
					'category' => 0,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'meta_key' => '',
					'meta_value' => '',
					'post_type' => 'post_event',
					'post_status' => 'publish',
					'suppress_filters' => true );
						
		$recent_posts = wp_get_recent_posts($args, ARRAY_A);
		
		echo '<ul class="pm-event-widget-ul">';
		
		//front-end widget code here
		foreach( $recent_posts as $recent ){
						
			$pm_event_featured_image_meta = get_post_meta($recent["ID"], 'pm_event_featured_image_meta', true);
			$pm_event_date_meta = get_post_meta($recent["ID"], 'pm_event_date_meta', true);
			$month = date("M", strtotime($pm_event_date_meta));
			$day = date("d", strtotime($pm_event_date_meta));
			$year = date("Y", strtotime($pm_event_date_meta));
			$pm_event_fan_page_meta = get_post_meta($recent["ID"], 'pm_event_fan_page_meta', true);
			$excerpt = $recent['post_excerpt'];
			
			echo '<li>';
					
				echo '<div class="pm-event-widget-container">';
					echo '<div class="pm-event-widget-img" style="background-image:url('.$pm_event_featured_image_meta.');">';
						echo '<div class="pm-event-widget-date-container">';
							echo '<p class="pm-event-widget-month">'.$month.'</p>';
							echo '<p class="pm-event-widget-day">'.$day.'</p>';
						echo '</div>';
					echo '</div>';
					echo '<div class="pm-event-widget-desc">';
						echo '<p class="pm-event-widget-desc-title">'.$recent['post_title'].'</p>';
						echo '<p class="pm-event-widget-desc-excerpt">'.pm_ln_string_limit_words($excerpt,20).'<a href="'.$recent['guid'].'"> {...}</a> </p>';
					echo '</div>';
					echo '<ul class="pm-event-widget-btns">';
						echo '<li><a href="'.$recent['guid'].'" class="pm-rounded-btn small">'.__('More Info','viennatheme').'</a></li>';
						echo '<li><a href="'.$pm_event_fan_page_meta.'" class="pm-rounded-btn small event-fan-page"><i class="fa fa-facebook"></i> &nbsp;'.__('Fan Page','viennatheme').'</a></li>';
					echo '</ul>';
				echo '</div>';
			
			echo '</li>';
			
		}//end of foreach
		
		echo '</ul>';
						
		echo $after_widget;

		
	}//end of widget function
	
}//end of class

?>