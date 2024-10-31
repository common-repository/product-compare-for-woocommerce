<?php
/**
  * WooCommerce Product Compare - Admin Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_PROCO_ADMIN')){
	class CDLZR_PROCO_ADMIN{
		function __construct(){
			require_once( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'admin/inc/class-cdlzr-proco-menu.php' );
			require_once( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'admin/class-cdlzr-proco-actions.php' );
			/**
			 * Check if WooCommerce is activated and add menu to dashboard
			 */
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				
				add_action( 'admin_menu', array( 'Proco_Menu', 'proco_create_menu' ) );
			}

			/*
				* Save admin side form
			*/
			add_action( 'wp_ajax_save_options_adminside', array( 'CDLZR_Admin_Actions', 'save_options' ) );

			add_action( 'admin_enqueue_scripts', array( 'CDLZR_Admin_Actions', 'cdlzr_proco_admin_print_scripts' ) );
		}
	}
}
