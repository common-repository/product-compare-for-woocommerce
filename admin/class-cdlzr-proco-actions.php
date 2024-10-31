<?php
/**
  * WooCommerce Product Compare - Admin Actions Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die( 'Avada Kedavra' );

if ( ! class_exists( 'CDLZR_Admin_Actions' ) ) { 
	class CDLZR_Admin_Actions
	{		
		public static function save_options() {
			include( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'admin/inc/handler/setting-handler.php' );
		}


		public static function cdlzr_proco_admin_print_scripts($hook_suffix){
			 $screen = get_current_screen();	
			//echo $hook_suffix;
			//if ( in_array( $hook_suffix, array('admin.php') ) ) {
				//var_dump($screen);
		        $screen = get_current_screen();	
		        wp_enqueue_script( 'jquery' ); //mother js library		        
		        // here 'cdlzr_proco' is cptname
		        if ( 'toplevel_page_cdlzr_proco' === $screen->base ) {	        	
		        	
		        	 wp_enqueue_style( 'cdlzr-proco-bootstrap', CDLZR_PRODUCT_COMPARE_URL . '/assets/css/bootstrap.css'  );				   
					wp_enqueue_script('cdlzr-proco-bootstrap-js', CDLZR_PRODUCT_COMPARE_URL . '/assets/js/bootstrap.min.js', array('jquery'), true, true);
					
		        }
		    //}
		}
	}
}