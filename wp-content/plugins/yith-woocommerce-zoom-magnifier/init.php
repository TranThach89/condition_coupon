<?php
/**
 * Plugin Name: YITH WooCommerce Zoom Magnifier
 * Plugin URI: http://yithemes.com/themes/plugins/yith-woocommerce-zoom-magnifier/
 * Description: YITH WooCommerce Zoom Magnifier enables you to add a zoom effect to product images and a thumbnail slider for the product image gallery.
 * Version: 1.2.5
 * Author: Yithemes
 * Author URI: http://yithemes.com/
 * Text Domain: ywzm
 * Domain Path: /languages/
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Magnifier
 * @version 1.2.5
 */
/*  Copyright 2013-2015  Your Inspiration Themes  (email : plugins@yithemes.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

function yith_ywzm_install_woocommerce_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'YITH WooCommerce Zoom Magnifier is enabled but not effective. It requires WooCommerce in order to work.', 'ywzm' ); ?></p>
	</div>
<?php
}


function yith_ywzm_install_free_admin_notice() {
	?>
	<div class="error">
		<p><?php _e( 'You can\'t activate the free version of YITH WooCommerce Zoom Magnifier while you are using the premium one.', 'ywzm' ); ?></p>
	</div>
<?php
}

if ( ! function_exists( 'yith_plugin_registration_hook' ) ) {
	require_once 'plugin-fw/yit-plugin-registration-hook.php';
}
register_activation_hook( __FILE__, 'yith_plugin_registration_hook' );

//region    ****    Define constants
if ( ! defined( 'YITH_YWZM_FREE_INIT' ) ) {
	define( 'YITH_YWZM_FREE_INIT', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YITH_YWZM_VERSION' ) ) {
	define( 'YITH_YWZM_VERSION', '1.2.5' );
}

if ( ! defined( 'YITH_YWZM_FILE' ) ) {
	define( 'YITH_YWZM_FILE', __FILE__ );
}

if ( ! defined( 'YITH_YWZM_DIR' ) ) {
	define( 'YITH_YWZM_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YITH_YWZM_URL' ) ) {
	define( 'YITH_YWZM_URL', plugins_url( '/', __FILE__ ) );
}

if ( ! defined( 'YITH_YWZM_ASSETS_URL' ) ) {
	define( 'YITH_YWZM_ASSETS_URL', YITH_YWZM_URL . 'assets' );
}

if ( ! defined( 'YITH_YWZM_TEMPLATE_DIR' ) ) {
	define( 'YITH_YWZM_TEMPLATE_DIR', YITH_YWZM_DIR . 'templates' );
}

if ( ! defined( 'YITH_YWZM_ASSETS_IMAGES_URL' ) ) {
	define( 'YITH_YWZM_ASSETS_IMAGES_URL', YITH_YWZM_ASSETS_URL . '/images/' );
}

if ( ! defined( 'YITH_YWZM_LIB_DIR' ) ) {
	define( 'YITH_YWZM_LIB_DIR', YITH_YWZM_DIR . 'lib/' );
}

//endregion

function yith_ywzm_init() {

	/**
	 * Required functions
	 */
	if ( ! defined( 'YITH_FUNCTIONS' ) ) {
		require_once( 'yit-common/yit-functions.php' );
	}

	/**
	 * Load text domain and start plugin
	 */
	load_plugin_textdomain( 'ywzm', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	add_option( 'yith_wcmg_slider_direction', apply_filters( 'yith_wcmg_slider_direction', 'left' ) );

	define( 'YITH_WCMG', true );
	define( 'YITH_WCMG_URL', plugin_dir_url( __FILE__ ) );

	// Load required classes and functions
	require_once( 'functions.yith-wcmg.php' );
	require_once( 'class.yith-wcmg-admin.php' );
	require_once( 'class.yith-wcmg-frontend.php' );

	require_once( YITH_YWZM_LIB_DIR . 'class.yith-woocommerce-zoom-magnifier.php' );
	require_once( YITH_YWZM_LIB_DIR . 'class.yith-ywzm-plugin-fw-loader.php' );
	require_once( YITH_YWZM_LIB_DIR . 'class.yith-ywzm-custom-types.php' );

	YITH_YWZM_Plugin_FW_Loader::get_instance();

	// Let's start the game!
	global $yith_wcmg;

	$yith_wcmg = new YITH_WooCommerce_Zoom_Magnifier();
}

add_action( 'yith_ywzm_init', 'yith_ywzm_init' );


function yith_ywzm_install() {

	if ( ! function_exists( 'WC' ) ) {
		add_action( 'admin_notices', 'yith_ywzm_install_woocommerce_admin_notice' );
	} elseif ( defined( 'YITH_YWZM_PREMIUM' ) ) {
		add_action( 'admin_notices', 'yith_ywzm_install_free_admin_notice' );
		deactivate_plugins( plugin_basename( __FILE__ ) );
	} else {
		do_action( 'yith_ywzm_init' );
	}
}

add_action( 'plugins_loaded', 'yith_ywzm_install', 11 );