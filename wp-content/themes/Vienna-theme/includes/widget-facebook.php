<?php 

add_action('widgets_init','fb_likebox_widget');

function fb_likebox_widget() {
	register_widget('fb_likebox_widget');
	
	}

class fb_likebox_widget extends WP_Widget {
	function fb_likebox_widget() {
			
		$widget_ops = array('classname' => 'Like-box','description' => __('Facebook Like Box','viennatheme'));

		$this->WP_Widget('Like-box',__('[Pulsar Media] - Facebook Likebox','viennatheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? '' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$show_header = $instance['show_header'];
		$show_faces = $instance['show_faces'];
		$show_border = $instance['show_border'];
		$show_stream = $instance['show_stream'];
		$height = $instance['height'];
		$page = $instance['page'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title ) {
			echo $before_title . $fa_icon. $title . $after_title;
		}
			
?>
        <div class="like_box_footer">
        
        
        <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $page; ?>&amp;width=100&amp;height=<?php echo $height; ?>&amp;colorscheme=light&amp;show_faces=<?php echo $show_faces == 1 ? 'true' : 'false' ?>&amp;header=<?php echo $show_header == 1 ? 'true' : 'false' ?>&amp;stream=<?php echo $show_stream == 1 ? 'true' : 'false' ?>&amp;show_border=<?php echo $show_border == 1 ? 'true' : 'false' ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
        
		</div><!--like_box_footer-->
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['show_header'] = strip_tags($new_instance['show_header']);
		$instance['show_faces'] = strip_tags($new_instance['show_faces']);
		$instance['show_border'] = strip_tags($new_instance['show_border']);
		$instance['show_stream'] = strip_tags($new_instance['show_stream']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['page'] = $new_instance['page'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Facebook','viennatheme'),
			'fa_icon' => '',
			'page' => 'http://www.facebook.com/pulsarmediaCA',
			'show_header' => 0,
			'show_faces' => 0,
			'show_border' => 0,
			'show_stream' => 0,
			'height' => 258,
			
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = $instance['title'];
		$height = $instance['height'];
		$page = $instance['page'];
		?>
	
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'viennatheme') ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
        
        <!--<p>
            <label for="<?php //echo $this->get_field_id( 'fa_icon' ); ?>"><?php //_e('FontAwesome Icon:', 'viennatheme') ?></label>
            <input id="<?php //echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php //echo $this->get_field_name( 'fa_icon' ); ?>" value="<?php //echo $instance['fa_icon']; ?>"  class="widefat" />
        </p>-->

		<p>  
            <input id="<?php echo $this->get_field_id('show_header'); ?>" name="<?php echo $this->get_field_name('show_header'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_header'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_header' ); ?>"><?php _e('Show Header?', 'viennatheme'); ?></label>  
        </p>  
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_faces'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php _e('Show Faces?', 'viennatheme'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_border'); ?>" name="<?php echo $this->get_field_name('show_border'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_border'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_border' ); ?>"><?php _e('Show Border?', 'viennatheme'); ?></label>  
        </p> 
        
        <p>  
            <input id="<?php echo $this->get_field_id('show_stream'); ?>" name="<?php echo $this->get_field_name('show_stream'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_stream'] ); ?>/>   
            <label for="<?php echo $this->get_field_id( 'show_stream' ); ?>"><?php _e('Show Stream?', 'viennatheme'); ?></label>  
        </p>  

    	<p>
		<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'viennatheme') ?></label>
		<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo esc_attr($height); ?>"  class="widefat" />
		</p>

    	<p>
		<label for="<?php echo $this->get_field_id( 'page' ); ?>"><?php _e('Facebook Page URL:', 'viennatheme') ?></label>
		<input id="<?php echo $this->get_field_id( 'page' ); ?>" name="<?php echo $this->get_field_name( 'page' ); ?>" value="<?php echo $page; ?>"  class="widefat" />
		</p>
        
   <?php 
}
	} //end class