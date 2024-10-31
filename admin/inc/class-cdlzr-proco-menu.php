<?php
/**
  * WooCommerce Product Compare - Admin Menu Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();

if( ! class_exists( 'Proco_Menu' ) ) {
	class Proco_Menu {
		public static function proco_create_menu() {
			$dashboard = add_menu_page( __( 'CDLZR Product Compare', CDLZR_PRODUCT_COMPARE ), __( 'Product Compare', CDLZR_PRODUCT_COMPARE ), 'manage_options', 'cdlzr_proco', array( 'Proco_Menu', 'dashboard_page' ), 'dashicons-sos', '10' );
			add_action( 'admin_print_styles-'.$dashboard, array( 'Proco_Menu', 'dashboard_assets' ) );
		}

		/*
		* CSS and JS assets
		*/
		public static function dashboard_assets() {
			self::load_assets();
		}
		public static function load_assets() {
			wp_enqueue_style( 'bootstrap_css', CDLZR_PRODUCT_COMPARE_URL . 'assets/css/bootstrap.min.css' );			
			wp_enqueue_style( 'admin_css', CDLZR_PRODUCT_COMPARE_URL . 'admin/libs/css/admin.css'  );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'bootstrap_js', CDLZR_PRODUCT_COMPARE_URL . 'assets/js/bootstrap.min.js', array( 'jquery' ), true, true );
			wp_enqueue_script( 'admin_side', CDLZR_PRODUCT_COMPARE_URL . 'admin/libs/js/admin_side.js' );
		}

		/*
		* Dashboard page
		*/
		public static function dashboard_page() {
			include_once( 'class-cdlzr-dashboard-page.php' );
			new Proco_Dashboard;
			Proco_Dashboard::dashboard_page_func();
		}
	}
}