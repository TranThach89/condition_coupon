<?php

/*
Plugin Name: Testimonials Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays your testimonials
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2
*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_testimonials_widget');

//register our widget
function pm_testimonials_widget() {
	register_widget('pm_testimonials_widget');
}

//pm_testimonials_widget class
class pm_testimonials_widget extends WP_Widget {
	
	//process the new widget
	function pm_testimonials_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_testimonials_widget',
			'description' => __('Display recent posts with style.','viennatheme')
		);
		
		$this->WP_Widget('pm_testimonials_widget', __('[Pulsar Media] - Testimonials Slider','viennatheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Testimonials', 
			'fa_icon' => '',
			'numOfPosts' => '3',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$numOfPosts = $instance['numOfPosts'];
		
		?>
        
        	<p><?php _e('Title:', 'viennatheme') ?> <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <!--<p>
                <label for="<?php //echo $this->get_field_id( 'fa_icon' ); ?>"><?php //_e('FontAwesome Icon:', 'viennatheme') ?></label>
                <input id="<?php //echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php //echo $this->get_field_name( 'fa_icon' ); ?>" value="<?php //echo $instance['fa_icon']; ?>"  class="widefat" />
            </p>-->
            <p><?php _e('Number of Testimonials to display:', 'viennatheme') ?> <input class="widefat" name="<?php echo $this->get_field_name('numOfPosts'); ?>" type="text" value="<?php echo esc_attr($numOfPosts); ?>" /></p>
                    
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
			
			echo $before_title . $fa_icon. $title . $after_title;
			
		}//end of if
		
		//retrieve testimonials
		global $vienna_options;
		
		$slides = $vienna_options['opt-testimonial-slides'];
		
		$counter = 1;
		
		if(count($slides) > 0){
		
			echo '<div class="pm-testimonials-widget-container">';
				echo '<div class="pm-testimonials-widget-box">';
					echo '<ul class="pm-testimonials-widget-quotes">';
						foreach($slides as $s) {
							
							if($counter <= $numOfPosts){
								echo '<li>';
									echo '<p>'.$s['description'].'</p>';
									echo '<div class="pm-testimonials-widget-name">'.$s['url'].'</div>';
								echo '</li>';
							}
							
							$counter++;
							
						}
					echo '</ul>';
				echo '</div>';
				
				echo '<ul class="pm-testimonials-widget-controls" id="pm-testimonials-arrows">';
					echo '<li><a href="#" id="pm-prev" class="fa fa-chevron-left"></a></li>';
					echo '<li><a href="#" id="pm-next" class="fa fa-chevron-right"></a></li>';
			 	echo '</ul>';
				
			echo '</div>';
			
		}
								
		echo $after_widget;
				
	}//end of widget function
	
}//end of class

?>