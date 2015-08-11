<?php

/**

 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');

	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'viennatheme'); ?></p>

    <?php
    return;
}

global $id;
$id = $post->ID;

?>



<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>

	<div class="pm-comment-header">
        <p class="pm-comment-section-title"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</p>
    </div>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
     
    <ol class="commentlist" style="margin:0; padding:0;">
        <?php wp_list_comments('callback=pm_ln_mytheme_comment'); ?>
    </ol>
     
    <div class="navigation">
        <div class="alignleft"><?php previous_comments_link() ?></div>
        <div class="alignright"><?php next_comments_link() ?></div>
    </div>
    
<?php else : // this is displayed if there are no comments so far ?>
 
	<?php if ('open' == $post->comment_status) : ?>
    <!-- If comments are open, but there are no comments. -->
     
        <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments">Comments are closed.</p>
         
    <?php endif; ?>

<?php endif; ?>

 
<?php if ('open' == $post->comment_status) : ?>

    <!-- Submit a comment form --> 
    <div class="pm-submit-comment-form-container">
        
        <p class="pm-comment-section-title"><?php comment_form_title( 'Submit a comment', 'Leave a Reply to %s' ); ?></p>
        <p class="pm-comment-required"><?php _e('Your email address will not be published. Required fields are marked *', 'viennatheme'); ?></p>
        
        <div class="cancel-comment-reply" style="margin-bottom:15px;">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>
        
        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
            <p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'viennatheme'); ?></a> <?php _e('to post a comment.', 'viennatheme'); ?></p>
        <?php else : ?>
        
            <div class="row">
        
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form">
                
                    <?php if ( $user_ID ) : ?>
             
                    <p style="padding-left:16px;">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account','viennatheme'); ?>">Log out &raquo;</a></p>
                     
                    <?php else : ?>
                    
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="author" placeholder="<?php _e('Name *', 'viennatheme'); ?>" id="author" class="respond_author pm-comment-form-textfield" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="email" placeholder="<?php _e('Email *', 'viennatheme'); ?>" id="email" class="respond_email pm-comment-form-textfield" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type="text" name="url" placeholder="<?php _e('Website', 'viennatheme'); ?>" id="url" class="respond_url pm-comment-form-textfield" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
                        </div>
                    
                    <?php endif; ?>
                
                    
                    
                    <div class="col-lg-12 pm-clear-element">
                        <textarea name="comment" placeholder="<?php _e('Comment...', 'viennatheme'); ?>" id="comment" class="respond_comment pm-comment-form-textarea" cols="20" rows="10" tabindex="4"></textarea>
                    </div>
                    
                    <div class="col-lg-12 pm-clear-element">
                        <div class="pm-comment-html-tags">
                            <span><?php _e('You may use these HTML tags and attributes:','viennatheme') ?> </span>
                            <p style="margin-top:10px;"><?php echo allowed_tags(); ?></p>
                        </div>
                        <input name="submit" type="submit" id="submit" class="pm-rounded-submit-btn" tabindex="5" value="<?php _e('Submit Comment','viennatheme') ?>" />
                        <?php comment_id_fields(); ?>
                        
                        <?php do_action('comment_form', $post->ID); ?>
                        
                    </div>                           
                </form>              
            </div>
        
        
        <?php endif; // If registration required and not logged in ?>
        
        
    </div>
    <!-- Submit a comment form end --> 
 
<?php endif; // if you delete this the sky will fall on your head ?>