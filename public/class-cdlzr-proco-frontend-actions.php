<?php
defined( 'ABSPATH' ) or die();
/**
  * WooCommerce Product Compare - Frontend Actions & ajax operations Page.
  *
  * @package product-compare-for-woocommerce
*/
if( !class_exists( 'Proco_Frontend_Actions' ) ) {
	class Proco_Frontend_Actions
	{
		public static function check_product_category() {
			include( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'public/handler/check_product_category_file.php' );
		}

		/**
			* This will show the pop up window of comapre products
		*/
		public static function show_product_compare_table() {
			include( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'public/handler/show_compared_products.php' );
		}

		/*
			* This will handle the remove product request from compare table
		*/
		public static function remove_product_compare_table() {
			include( CDLZR_PRODUCT_COMPARE_DIR_PATH . 'public/handler/remove_product.php' );
		}
	}
}