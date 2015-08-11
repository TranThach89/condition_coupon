<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>


<div class="product_meta">


	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>


<div class="pm-product-share-container">
	<?php $enableTooltip = get_theme_mod('enableTooltip') ?>
	<p><?php _e('Share with Friends','viennatheme'); ?></p>
    <ul class="pm-product-social-icons">
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. __('Share on Google Plus', 'viennatheme') .'"' : '' ?>>
        	<a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" title="<?php _e('Share on Google Plus', 'localization'); ?>" class="fa fa-google-plus" target="_blank"></a>
        </li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. __('Share on Twitter', 'viennatheme') .'"' : '' ?>>
        	<a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" title="<?php _e('Share on Twitter', 'localization'); ?>" class="fa fa-twitter" target="_blank"></a>
        </li>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. __('Share on Facebook', 'viennatheme') .'"' : '' ?>>
        	<a href="http://www.facebook.com/share.php?u=<?php urlencode(the_permalink()); ?>" title="<?php _e('Share on Facebook', 'localization'); ?>" class="fa fa-facebook" target="_blank"></a>
        </li>
        <?php $postExcerpt = get_the_excerpt(); ?>
        <li class="<?php echo $enableTooltip == 'on' ? 'pm_tip_static_top' : '' ?>" <?php echo $enableTooltip == 'on' ? 'title="'. __('Share on Linkedin', 'viennatheme') .'"' : '' ?>>
        	<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(site_url()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>&amp;summary=<?php echo urlencode(pm_ln_string_limit_words($postExcerpt, 30)) ?>&amp;source=<?php echo urlencode(site_url()); ?>" title="<?php _e('Share on LinkedIn', 'localization'); ?>" class="fa fa-linkedin" target="_blank"></a>
        </li>
    </ul>
</div>