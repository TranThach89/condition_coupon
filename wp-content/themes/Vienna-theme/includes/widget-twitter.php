<?php 

add_action('widgets_init','lateset_tweets');

function lateset_tweets() {
	register_widget('lateset_tweets');
	
	}

class lateset_tweets extends WP_Widget {
	function lateset_tweets() {
			
		$widget_ops = array('classname' => 'tweets','description' => __('Twitter Widget - displays Latest Tweets','viennatheme'));
/*		$control_ops = array( 'twitter name' => 'pulsar', 'count' => 3, 'avatar_size' => '32' );
*/		
		$this->WP_Widget('latest-tweets',__('[Pulsar Media] - Twitter','viennatheme'),$widget_ops);

		}
		
	function widget( $args, $instance ) {
		extract( $args );
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$fa_icon = '<i class="'. (empty( $instance['fa_icon'] ) ? '' : $instance['fa_icon']) .' pm-sidebar-icon"></i> ';
		$username = $instance['username'];
		$count = $instance['count'];
		//$avatar_size = $instance['avatar'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Title of widget (before and after defined by themes). */
		if ( $title )
			echo $before_title . $fa_icon. $title . $after_title;
			$rndn = rand(1,500);
?>
			<script type="text/javascript">
				  jQuery.noConflict();
				jQuery(function(){
				  jQuery(".tweet_<?php echo $rndn; ?>").tweet({
					join_text: "auto",
					modpath: '<?php echo get_template_directory_uri(); ?>/js/twitter/',
					loading_text: '<?php _e('loading twitter feed...', 'viennatheme'); ?>',
					username: "<?php echo $username ?>",
					avatar_size: false,
					count: <?php echo $count ?>,
					
				<?php if( is_rtl() ) { ?>
					template: "{text}"

				<?php } else { ?>
					seconds_ago_text: "<?php _e('about %d seconds ago','viennatheme');?>",
					a_minutes_ago_text: "<?php _e('about a minute ago','viennatheme');?>",
					minutes_ago_text: "<?php _e('about %d minutes ago','viennatheme');?>",
					a_hours_ago_text: "<?php _e('about an hour ago','viennatheme');?>",
					hours_ago_text: "<?php _e('about %d hours ago','viennatheme');?>",
					a_day_ago_text: "<?php _e('about a day ago','viennatheme');?>",
					days_ago_text: "<?php _e('about %d days ago','viennatheme');?>",
					view_text: "<?php _e('view tweet on twitter','viennatheme');?>"
				<?php } ?>
				  });
				  
				});
			</script>
			    <div class="tweet_<?php echo $rndn; ?>"></div>
			
<?php 
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['fa_icon'] = strip_tags( $new_instance['fa_icon'] );
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = $new_instance['count'];

		return $instance;
	}
	
function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Twitter','viennatheme'), 
			'username' => 'PulsarMediaCA', 
			'fa_icon' => 'fa fa-twitter',
			'count' => 3
 			);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = $instance['title'];
		$username = $instance['username'];
		$count = $instance['count'];
		?>
	
    	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'viennatheme') ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>"  class="widefat" />
		</p>
        
        <!--<p>
            <label for="<?php //echo $this->get_field_id( 'fa_icon' ); ?>"><?php //_e('FontAwesome Icon:', 'viennatheme') ?></label>
            <input id="<?php //echo $this->get_field_id( 'fa_icon' ); ?>" name="<?php //echo $this->get_field_name( 'fa_icon' ); ?>" value="<?php //echo $instance['fa_icon']; ?>"  class="widefat" />
        </p>-->

		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e('Twitter username:', 'viennatheme') ?></label>
		<input id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo esc_attr($username); ?>" class="widefat" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of tweets:', 'viennatheme') ?></label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo esc_attr($count); ?>" class="widefat" />
		</p>
        
   <?php 
}
	} //end class