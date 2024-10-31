<?php
/**
 * Plugin Name: Product Compare for WooCommerce
 * Plugin URI: https://wordpress.org/plugins/
 * Description: The plugin give you the ability to compare the products by their category
 * Version: 0.3
 * Author: Codelizar
 * Author URI: https://codelizar.com/
 * Text Domain: product-compare-for-woocommerce
 * Domain Path: /languages/
 */

defined( 'ABSPATH' ) or die();

/*
*TEXT DOMAIN
*/
if( ! defined( 'CDLZR_PRODUCT_COMPARE' ) ) {
	define( 'CDLZR_PRODUCT_COMPARE', 'product-compare-for-woocommerce');
}
/*
*Plugin Directory URL
*/
if( !defined( 'CDLZR_PRODUCT_COMPARE_URL' ) ) {
	define( 'CDLZR_PRODUCT_COMPARE_URL', plugin_dir_url( __FILE__ ));
}
/*
*Plugin Directory Path
*/
if( !defined( 'CDLZR_PRODUCT_COMPARE_DIR_PATH' ) ) {
	define( 'CDLZR_PRODUCT_COMPARE_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

/*
*LOAD TEXT DOMAIN AND CHECK WOOCOMMERCE IS ACTIVATED OR NOT
*/

add_action( 'plugin_loaded', 'proco_loadplugin' );

function proco_loadplugin() {
	load_plugin_textdomain( 'product-compare-for-woocommerce', false, dirname( plugin_basename( __FILE__ ) ).'/languages/' );
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {	   
	}
	else {		
		add_action( 'admin_notices', 'proco_woocom_deactivate_admin_notice' );
	}
}

function proco_woocom_deactivate_admin_notice() {
	?>
	<div class="error">
		<p>
			<?php 
			_e( 'Plugin activated but no use with out WOOCOMMERCE', CDLZR_PRODUCT_COMPARE ); 
			?>
		</p>
	</div>
	<?php
}

function proco_woocom_activate_admin_notice() {
	?>
	<div class="success">
		<p>
			<?php 
			_e( 'Woocommerce is activated', CDLZR_PRODUCT_COMPARE );
			 ?>
		</p>
	</div>
	<?php
}

/*
* Calling the plugin
*/
if ( ! class_exists( 'CDLZR_PROCO_Sys' ) ) {
	final class CDLZR_PROCO_Sys
	{
		private static $instance = null;

		private function __construct()
		{
			$this->initialize_hooks();			
		}

		private function initialize_hooks() {
			if ( is_admin() ) {				
				require_once( 'admin/class-cdlzr-proco-admin.php' );
				new CDLZR_PROCO_ADMIN;
			}
			require_once( 'public/class-cdlzr-proco-public.php' );
			new CDLZR_PROCO_PUBLIC;
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		
	}
}
CDLZR_PROCO_Sys::get_instance();