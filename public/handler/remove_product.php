<?php
/**
  * WooCommerce Product Compare - Remove Product Handler Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();
if( isset( $_POST['productId_remove'] ) ) {
	$product_id 	  = sanitize_text_field($_POST['productId_remove']);
	$productIds_array = get_option('current_products_id');
	$result_collector = NULL;
	
	$array_index = array_search($product_id, $productIds_array);
	unset($productIds_array[$array_index]);
	$rearranged_array = array_values($productIds_array);
	if( count( $rearranged_array ) > 0 ) {
		if( update_option( 'current_products_id', $rearranged_array ) ) {
			$result_collector = 1;
		}
		else {
			$result_collector = 0;
		}
	}
	else {
		if( delete_option( 'current_products_id' ) && delete_option('current_compare_cat_id' ) ) {
			$result_collector = 1;
		}
		else {
			$result_collector = 0;
		}
	}
	echo esc_html($result_collector);
}
die();