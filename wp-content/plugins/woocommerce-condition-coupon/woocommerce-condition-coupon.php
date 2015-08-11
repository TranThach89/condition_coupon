<?php
/**
 * Plugin Name: WooCommerce Condition Coupon
 * Plugin URI: https://github.com/TranThach89/condition_coupon
 * Description: An e-commerce toolkit that helps you sell anything. Beautifully.
 * Version: 1.0.0
 * Author: S
 * Author URI: https://github.com/TranThach89/condition_coupon
 * Text Domain: woocommerce
 * Domain Path: /i18n/languages/
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Required functions
if ( ! function_exists( 'woothemes_queue_update' ) )
{
    require_once( 'woo-includes/woo-functions.php' );
}
// Plugin updates
woothemes_queue_update( plugin_basename( __FILE__ ), '0343e0115bbcb97ccd98442b8326a0af', '216836' );

// Check if WooCommerce is active
//if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return; // Check if WooCommerce is active
if ( ! is_woocommerce_active() )
    return;

define( '__WOOCOPATH__', plugin_dir_path( __FILE__ ) );
define( '__WOOCOURL__', plugin_dir_url( __FILE__ ) );

/**
 * Class WOOCOCO
 */
if( !class_exists( 'WOOCOCO' ) ):
    class WOOCOCO{
        /**
         * construct
         */
        public function __construct()
        {
            add_filter( 'woocommerce_coupon_data_tabs', array( $this, 'woocommerce_coupon_data_tabs' ) );
            add_action( 'woocommerce_coupon_data_panels', array( $this, 'woocommerce_coupon_data_panels' ) );
            add_action( 'init', array( $this,'init_function') );
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts') );
        }

        /*
         * add tab Condition in meta box coupon
         */
        function woocommerce_coupon_data_tabs( $coupon_data_tabs )
        {
            $coupon_data_tabs['condition'] = array(
                'label'  => __( 'Condition', 'woocommerce' ),
                'target' => 'condition_coupon_data',
                'class'  => 'condition_coupon_data',
            );
            return $coupon_data_tabs;
        }

        /*
         * layout Condition
         */
        function woocommerce_coupon_data_panels()
        {
            include_once 'inc/condition-coupon.php';
        }

        /*
         *
         */
        function init_function()
        {
            include_once 'functions.php';
        }

        /*
         *
         */
        function admin_enqueue_scripts()
        {

        }

        /**
         * destruct
         */
        public function __destruct()
        {

        }

    }

    $WOOCOCO = new WOOCOCO;
endif;