<?php 

//WPML custom language selector
function pm_ln_icl_post_languages(){
	
  if( function_exists('icl_get_languages') ){
	  
	  $languages = icl_get_languages('skip_missing=1');
  
	  if(1 < count($languages)){
		  
		  echo '<div class="pm-micro-nav-lang-selector desktop">';
						
			 echo '<div class="pm-dropdown pm-language-selector-menu">';
				 echo '<div class="pm-dropmenu">';
					 echo '<p class="pm-menu-title">'.__('Language','viennatheme').'</p>';
					 echo '<i class="fa fa-angle-down"></i>';
				 echo '</div>';
				 echo '<div class="pm-dropmenu-active">';
					 echo '<ul>';
					 foreach($languages as $l){
						if(!$l['active']) echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
					 }
					 echo '</ul>';
				 echo '</div>';
			 echo '</div>';
		
		 echo '</div>';
			
		
		//echo join(', ', $langs);
		
	  }
	  
  }//end of check function
  
}

function pm_ln_icl_post_languages_mobile(){
	
  if( function_exists('icl_get_languages') ){
	  
	  $languages = icl_get_languages('skip_missing=1');
  
	  if(1 < count($languages)){
		  
		  echo '<div class="pm-micro-nav-lang-selector mobile">';
						
			 echo '<div class="pm-dropdown pm-language-selector-menu">';
				 echo '<div class="pm-dropmenu">';
					 echo '<p class="pm-menu-title">'.__('Language','viennatheme').'</p>';
					 echo '<i class="fa fa-angle-down"></i>';
				 echo '</div>';
				 echo '<div class="pm-dropmenu-active">';
					 echo '<ul>';
					 foreach($languages as $l){
						if(!$l['active']) echo '<li><a href="'.$l['url'].'">'.$l['translated_name'].'</a></li>';
					 }
					 echo '</ul>';
				 echo '</div>';
			 echo '</div>';
		
		 echo '</div>';
			
		
		//echo join(', ', $langs);
		
	  }
	  
  }//end of check function
  
}

//Custom WordPress functions
function pm_ln_set_query($custom_query=null) { 
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query_old = $wp_query;
	$wp_query = $custom_query;
	$orig_post = $post;
}

function pm_ln_restore_query() {  
	global $wp_query, $wp_query_old, $post, $orig_post;
	$wp_query = $wp_query_old;
	$post = $orig_post;
	setup_postdata($post);
}

//Limit words in paragraphs
function pm_ln_string_limit_words($string, $word_limit){
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

//Count all posts related to current tag
function pm_ln_get_posts_count_by_tag($tag_name){
    $tags = get_tags(array ('search' => $tag_name) );
    foreach ($tags as $tag) {
      //if ($tag->name == $tag_name) {}
	  return $tag->count;
    }
    return 0;
}

//Count all posts related to current category
function pm_ln_get_posts_count_by_category($category_name){
    $categories = get_categories(array ('search' => $category_name) );
    foreach ($categories as $category) {
		//if ($category->name == $category_name) {}
		return $category->count;
    }
    return 0;
}

//Convert HEX to RGB
function pm_ln_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
	  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
	  $r = hexdec(substr($hex,0,2));
	  $g = hexdec(substr($hex,2,2));
	  $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

//YOUTUBE Thumbnail Extract
function pm_ln_parse_yturl($url) {
	$pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
	preg_match($pattern, $url, $matches);
	return (isset($matches[1])) ? $matches[1] : false;
}



//New breadcrumb nav as of Feb. 23 2014
function pm_ln_breadcrumbs() {
	
	global $post;
	
	echo '<div class="pm-sub-header-breadcrumbs-ul">';	
    
    if (!is_home()) {
        echo '<p><a href="'.home_url().'"> Home</a></p>';
        echo '<p><i class="fa fa-angle-right"></i></p>';
		
		if (is_single() && get_post_type() == 'post_staff' ) { //Wordpress doesnt support custom post types for breadcrumbs
		
			echo '<p>';
			the_title();
			echo '</p>';
		
		} else if (is_single()) {
			
            echo '<p>';
			the_title();
            echo '</p>';
			
		} else if (is_404()) {
			
            echo '<p> '.__('404 Error', 'viennatheme').'</p>';
		
		} else if (is_category()) {	
		
			echo '<p>';
			
            //the_category('</li><li class="separator"> / </li><li>', 'single');
			
			$cat = get_category( get_query_var( 'cat' ) ); 
			echo $cat->name;
			echo '</p>';
				
        } elseif (is_page()) {
			
            if($post->post_parent){
                $anc = get_post_ancestors( $post->ID );
                $title = get_the_title();
                foreach ( $anc as $ancestor ) {
                    $output = '<p><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></p> <p><i class="fa fa-angle-right"></i></p>';
                }
                echo $output;
                echo '<p title="'.$title.'"> '.$title.'</p>';
            } else {
                echo '<p> ';
                echo the_title();
                echo '</p>';
            }
        } 
		elseif (is_tag()) {
			echo '<p>'; 
			single_tag_title();
			echo '</p>';
		}
		elseif (is_day()) {
			echo"<p>Archive for "; the_time('F jS, Y'); echo'</p>';
		}
		elseif (is_month()) {
			echo"<p>Archive for "; the_time('F, Y'); echo'</p>';
		}
		elseif (is_year()) {
			echo"<p>Archive for "; the_time('Y'); echo'</p>';
		}
		elseif (is_author()) {
			echo"<p>Author Archive"; echo'</p>';
		}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {exit;
			echo "<p>Blog Archives"; echo'</p>';
		}
		elseif (is_search()) {
			echo"<p>Search Results"; echo'</p>';
		}
    }
    
	
	
    echo '</div>';
	
}

//COMMENTS CONTROL
function pm_ln_mytheme_comment($comment, $args, $depth) {
	
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class('pm-comment-box-container'); ?> id="li-comment-<?php comment_ID() ?>">
    
    
    <div id="comment-<?php comment_ID(); ?>">
    
        <!-- Comment -->        
        <div class="pm-comment-box-avatar-container">
            <div class="pm-comment-avatar">
                <?php echo get_avatar($comment,$size='70'); ?>
            </div>
            <ul class="pm-comment-author-list">
                <li><p class="pm-comment-name"><?php printf(__('%s', 'viennatheme'), get_comment_author_link()) ?> <a href="<?php echo htmlspecialchars(get_comment_link( $comment->comment_ID )) ?>"></a></p></li>
                <li><p class="pm-comment-date"><?php printf(__('%1$s at %2$s', 'viennatheme'), get_comment_date(),get_comment_time()) ?><?php edit_comment_link(__('(Edit)', 'viennatheme'),' ','') ?></p></li>
            </ul>
                        
        </div>
                
        <div class="pm-comment">
        
        	<?php if ($comment->comment_approved == '0') : ?>
				<p class="pm-primary" style="font-style:italic;"><?php _e('Your comment is awaiting moderation.', 'viennatheme') ?></p>
            <?php endif; ?>
        
            <?php comment_text() ?>
        </div>
        
        <div class="pm-comment-reply-btn">
        	<div class="pm-rounded-btn small pm-comment-reply">
             	<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <!--<a href="#" class="pm-rounded-btn pm-primary small">post a reply</a>-->
        </div>
        <!-- Comment end -->
        
    </div>
    
    <!-- originial code goes here -->
	
	<?php
	
	echo '<div class="pm-comment-reply-form">';
	
		//Required for Themeforest regulations.
		$comments_args = array(
		  'title_reply'       => __( 'Leave a Reply', 'viennatheme' ),
		  'title_reply_to'    => __( 'Leave a Reply to %s', 'viennatheme' ),
		  'cancel_reply_link' => __( 'Cancel Reply', 'viennatheme' ),
		  'label_submit'      => __( 'Post Comment', 'viennatheme' ),
		);
	
		comment_form($comments_args);
	
	echo '</div>';
		
}//end of comments control

//Menu functions
function pm_ln_main_menu() {
	echo '<ul class="sf-menu pm-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

function pm_ln_micro_menu() {
	echo '<ul class="pm-sub-navigation">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

function pm_ln_mobile_menu() {
	echo '<ul class="sf-menu pm-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}

function pm_ln_footer_menu() {
	echo '<ul class="pm-footer-navigation" id="pm-footer-nav">';
		  wp_list_pages('title_li=&depth=1'); //http://codex.wordpress.org/Function_Reference/wp_list_pages
	echo '</ul>';
}


/* Load More AJAX Call */
function pm_ln_load_more(){
	
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['page']) || $_POST['page'] < 0 ) die('Invalid page');
	
	$section = '';
	
	global $vienna_options;
	
	$gallery_posts_per_load = $vienna_options['gallery-posts-per-load'];
	$event_posts_per_load = $vienna_options['event-posts-per-load']; 
	
	$args = '';
	if(isset($_POST['section']) && $_POST['section']){
		$section = $_POST['section'];
		$args = 'post_type=post_'.$_POST['section'].'&'; //match the post type name
	}
	
	if($section == 'galleries'){
		$args .= 'post_status=publish&posts_per_page='.$gallery_posts_per_load.'&paged='. $_POST['page'];
	} elseif($section == 'event') {
		$args .= 'post_status=publish&posts_per_page='.$event_posts_per_load.'&paged='. $_POST['page'];
	} else {
		$args .= 'post_status=publish&posts_per_page=4&paged='. $_POST['page'];
	}
		
	ob_start();
	$query = new WP_Query($args);
	while( $query->have_posts() ){ $query->the_post();
		echo '<div id="pm-isotope-item-container">';
			if($section == 'galleries'){//match the post type name
				get_template_part( 'content', 'gallerypost' );
			} else {
				get_template_part( 'content', $section.'post' );	
			}
			
		echo '</div>';
	}
	
	wp_reset_postdata();
	$content = ob_get_contents();
	ob_end_clean();
	
	echo json_encode(
		array(
			'pages' => $query->max_num_pages,
			'content' => $content
		)
	);
	
	exit;
	
	/*if(isset($_POST['archive']) && $_POST['archive'] && strlen(strstr($_POST['archive'],'post-format'))>0){
		$args = array(
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => $_POST['archive']
				)
			),
			'posts_per_page' => get_option('posts_per_page'),
			'paged' => $_POST['page']
		);
	}*/
}

function pm_ln_retrieve_likes() {
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	
	$currentLikes = get_post_meta($postID, 'pm_total_likes', true);
	
	echo json_encode(
		array(
			'currentLikes' => $currentLikes,
		)
	);
	
	exit;
	
}

function pm_ln_like_feature() {
	
	//verify nonce (set in functions.php - line 636)
	if(!wp_verify_nonce($_POST['nonce'], 'pulsar_ajax')) die('Invalid nonce');
	if( !is_numeric($_POST['postID']) || $_POST['postID'] < 0 ) die('Invalid request');
	
	$postID = $_POST['postID'];
	$likes = (int) $_POST['likes'];
	
	//$newLikes = $likes + 1;
	
	update_post_meta($postID, 'pm_total_likes', $likes);
	
	exit;
	
}

?>