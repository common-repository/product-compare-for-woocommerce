<?php
defined( 'ABSPATH' ) or die();
/**
  * WooCommerce Product Compare - Frontend CSS JS Enqueue Page.
  *
  * @package product-compare-for-woocommerce
*/
if( !class_exists('Proco_Frontend')){
	class Proco_Frontend
	{
		public static function load_assets_front() {
			if( is_woocommerce() ) {
				wp_enqueue_style( 'bootstrap_css', CDLZR_PRODUCT_COMPARE_URL . 'assets/css/bootstrap.min.css' );
				wp_enqueue_style( 'datatable_css', CDLZR_PRODUCT_COMPARE_URL . 'assets/datatable/jquery.dataTables.min.css' );
				wp_enqueue_style( 'custom_css_frontend', CDLZR_PRODUCT_COMPARE_URL . 'public/libs/proco_public_css.css' );
				wp_enqueue_script( 'jquery' );
				wp_register_script( 'popperjs', CDLZR_PRODUCT_COMPARE_URL . 'public/libs/popper.min.js', null, null, true );
				wp_enqueue_script( 'popperjs' );
				wp_enqueue_script( 'bootstrap_js', CDLZR_PRODUCT_COMPARE_URL . 'assets/js/bootstrap.min.js' );
				wp_enqueue_script( 'datatable_js', CDLZR_PRODUCT_COMPARE_URL . 'assets/datatable/jquery.dataTables.min.js' );
				/* Front ajax load */
				//wp_enqueue_script( 'public_js', CDLZR_PRODUCT_COMPARE_URL . 'public/libs/public_js.js', null, null, true );
				//wp_localize_script( 'public_js', 'procopublicajax', admin_url( 'admin-post.php' ) );
				
				
				wp_enqueue_script( 'public_js', CDLZR_PRODUCT_COMPARE_URL . 'public/libs/public_js.js' , ['jquery'], '1.2', true );
				wp_localize_script( 'public_js', 'procopublicajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
			}
		}
	}
}	