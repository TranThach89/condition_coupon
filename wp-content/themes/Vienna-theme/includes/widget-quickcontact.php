<?php

/*

Plugin Name: Quick Contact Widget 
Plugin URI: http://www.pulsarmedia.ca
Description: A widget that displays a quick contact form
Version: 1.0
Author: Pulsar Media
Author URI: http://www.pulsarmedia.ca
License: GPLv2

*/

// use widgets_init action hook to execute custom function
add_action('widgets_init', 'pm_contact_widget');

//register our widget
function pm_contact_widget() {
	register_widget('pm_quickcontact_widget');
}

//pm_quickcontact_widget class
class pm_quickcontact_widget extends WP_Widget {
	
	//process the new widget
	function pm_quickcontact_widget() {
	
		$widget_ops = array(
			'classname' => 'pm_quickcontact_widget',
			'description' => __('Insert a quick contact form','viennatheme')
		);
		
		$this->WP_Widget('pm_quickcontact_widget', __('[Pulsar Media] - Quick Contact Form','viennatheme'), $widget_ops);
		
	}//end of pm_widget_my_info function
	
	//build the widget settings form
	function form($instance){
		
		$defaults = array( 
			'title' => 'Quick Contact', 
			'fa_icon' => 'fa-envelope',
			'desc' => '',
			'color' => 'Light',
			'response_color' => 'Light',
			'email' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = $instance['title'];
		$desc = $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = $instance['email'];
		
		?>
        
        	<p>Title: <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
            <!--<p>
                <label for="<?php //echo $this->get_field_id( 'fa_icon' ); ?>"><?php //_e('FontAwesome Icon:', 'viennatheme') ?></label>
                <input id="<?php //echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php //echo $this->get_field_name( 'fa_icon' ); ?>" value="<?php //echo $instance['fa_icon']; ?>"  class="widefat" />
            </p>-->
            <p>Description: <input class="widefat" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo esc_attr($desc); ?>" /></p>
            <p>
            <label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e('Form Color:', 'viennatheme') ?></label>
            <select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['color'] ) echo 'selected="selected"'; ?>><?php _e('Light', 'viennatheme') ?></option>
                <option <?php if ( 'Dark' == $instance['color'] ) echo 'selected="selected"'; ?>><?php _e('Dark', 'viennatheme') ?></option>
            </select>
            </p>
            <p>
            <label for="<?php echo $this->get_field_id( 'response_color' ); ?>"><?php _e('Response Color:', 'viennatheme') ?></label>
            <select id="<?php echo $this->get_field_id( 'response_color' ); ?>" name="<?php echo $this->get_field_name( 'response_color' ); ?>" class="widefat">
                <option <?php if ( 'Light' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php _e('Light', 'viennatheme') ?></option>
                <option <?php if ( 'Dark' == $instance['response_color'] ) echo 'selected="selected"'; ?>><?php _e('Dark', 'viennatheme') ?></option>
            </select>
            </p>
            <p>Email address: <input class="widefat" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>
                    
        <?php
		
	}//end of form function
	
	//save the widget settings
	function update($new_instance, $old_instance) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['response_color'] = strip_tags( $new_instance['response_color'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		
		return $instance;
		
	}//end of update function
	
	//display the widget
	function widget($args, $instance){
		
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title'] );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? '' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$desc = empty( $instance['desc'] ) ? '&nbsp;' : $instance['desc'];
		$color = $instance['color'];
		$response_color = $instance['response_color'];
		$email = empty( $instance['email'] ) ? '&nbsp;' : $instance['email'];
		
		if( !empty($title) ){
			
			echo $before_title . $fa_icon. $title . $after_title;
			
		}//end of if
		
		//form code here
		
		if($desc != '&nbsp;'){
			echo '<p>'.$desc.'</p><br />';
			
		}
		
		echo '
		<form action="#" method="post" id="quick-contact-form" class="validate" target="_blank" novalidate>  
			<input name="pm_full_name" type="text" class="pm_quick_contact_field '.$color.' reset-pulse-sizing" placeholder="'.__('full name','viennatheme').'">
			<input name="pm_email_address" type="email" class="pm_quick_contact_field '.$color.' reset-pulse-sizing" placeholder="'.__('email address', 'viennatheme').'">
			<textarea name="pm_message" cols="" rows="" class="pm_quick_contact_textarea '.$color.' reset-pulse-sizing" placeholder="'.__('message','viennatheme').'"></textarea>
			<input name="subscribe" type="submit" value="Send" class="pm-rounded-btn small"> ';
			
			?>
            
            <div id="pm_form_response" class="pm_form_response <?php echo $response_color; ?>"></div>
			
		<?php echo '<input name="pm_email_address_contact" id="" type="hidden" value="'.$email.'">
			<input name="quick_contact_submitted" id="" type="hidden" value="true">
		</form>';
				
		echo $after_widget;
		
		// output template path to locate php file on server ?>
        <script> var templateDir = "<?php echo get_template_directory_uri(); ?>"; </script>
        
        <?php
		
	}//end of widget function
	
}//end of class

?>