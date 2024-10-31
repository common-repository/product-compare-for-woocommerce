<?php
/**
  * WooCommerce Product Compare - Check Product Cateogry Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();
/*
	First compare the product category, if same added to compare list other wise  gives error message
*/
global $product;
if( isset( $_POST['product_id'] ) ) {
	$products_id = sanitize_text_field( $_POST['product_id'] );
	$largets_key = NULL;
	$cat_id 	 = NULL;
	/*Get the category Id from product id
	 This will give the category id, if cat has child or sub child, then it gives child id otherwise parent id */
	$term_list   = wp_get_post_terms($products_id,'product_cat',array('fields'=>'ids'));
	
	$product_cats_ids = wc_get_product_term_ids( $products_id, 'product_cat' );
	$count_elements   = count($product_cats_ids);
	if( $count_elements > 0 ) {
		$largets_key      = $count_elements-1;	
		$cat_id 		  = (int)$product_cats_ids[$largets_key];
	}
	elseif( $count_elements == 0 ) {
		$cat_id 		  = (int)$product_cats_ids[$count_elements];
	}
	

	//To store the result
	$store_result = NULL;
	/*This will give the category page */
	// get_term_link ($cat_id, 'product_cat');

	/*
		Check the category option in option table if not available then
	  	make or update it and add the item to compare table 
	*/
	if( !empty( get_option( 'current_compare_cat_id' ) ) ) { 
		$current_cat_id = get_option('current_compare_cat_id');
		if( $current_cat_id != $cat_id ) {
			
			$store_result = "Please select the similar product to compare";
		}
		else {
			if( get_option( 'current_products_id' ) ) {
				/* When option value is already present */
				
				$a = get_option( 'current_products_id' );
				if( count($a) !=0 ) {
					if( in_array( $products_id, $a ) ) {						
						$store_result = "Already added to list";
					}
					else{
						array_push( $a, $products_id );
						update_option( 'current_products_id', $a );					
						$store_result = "Product added to compare table";
					}
				}												
			}
			/*If the no product found */
			else {
				/*First Product will be added to the array*/
				$array_product_ids = array();
				array_push( $array_product_ids, $products_id );
				update_option( 'current_products_id', $array_product_ids );
				$store_result = "Product added to compare table";
			}
		}
	} /* If the categoy id found in the db */
	else {
		/* First add the product category Id */
		update_option( 'current_compare_cat_id', $cat_id );
		/* Now add the product id to db */
		$array_product_ids = array();
		array_push( $array_product_ids, $products_id );
		update_option( 'current_products_id', $array_product_ids );
		$store_result = "Product added to compare table";
	}
	echo esc_html($store_result);
}
die();