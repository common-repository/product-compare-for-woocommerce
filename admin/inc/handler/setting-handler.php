<?php
/**
  * WooCommerce Product Compare - Save Setting Handler Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();
if( ! wp_verify_nonce( $_POST['proco_user_choice_form_nonce'], 'proco_user_choice_form' ) ) {
	die('Lord Voldemort');
}
else {
	$proco_t1					= isset( $_POST['proco_t1'] ) ? sanitize_text_field( $_POST['proco_t1'] ) : "0";
	$proco_t2					= isset( $_POST['proco_t2'] ) ? sanitize_text_field( $_POST['proco_t2'] ) : "Not set";
	$proco_c1					= isset( $_POST['proco_c1'] ) ? sanitize_text_field( $_POST['proco_c1'] ) : "0";
	$proco_c2					= isset( $_POST['proco_c2'] ) ? sanitize_text_field( $_POST['proco_c2'] ) : "0";
	$proco_frontend_title		= isset( $_POST['proco_frontend_title'] ) ? sanitize_title( $_POST['proco_frontend_title'] ) : "Compare";
	$proco_image_checkbox		= isset( $_POST['proco_image_checkbox'] ) ? sanitize_text_field( $_POST['proco_image_checkbox'] ) : "0";
	$proco_title_checkbox		= isset( $_POST['proco_title_checkbox'] ) ? sanitize_text_field( $_POST['proco_title_checkbox'] ) : "0";
	$proco_price_checkbox		= isset( $_POST['proco_price_checkbox'] ) ? sanitize_text_field( $_POST['proco_price_checkbox'] ) : "0";
	$proco_description_checkbox	= isset( $_POST['proco_description_checkbox'] ) ? sanitize_text_field( $_POST['proco_description_checkbox'] ) : "0";
	$proco_sku_checkbox			= isset( $_POST['proco_sku_checkbox'] ) ? sanitize_text_field( $_POST['proco_sku_checkbox'] ) : "0";
	$proco_dimensions_checkbox	= isset( $_POST['proco_dimensions_checkbox'] ) ? sanitize_text_field( $_POST['proco_dimensions_checkbox'] ) : "0";

	$proco_all_setting_variables = array(
		"button_type" 				=> $proco_t1,
		"button_text" 				=> $proco_t2,
		"show_button_singleproduct" => $proco_c1,
		"show_button_productlist" 	=> $proco_c2,
		"front_boxTitle" 			=> $proco_frontend_title,
		"product_image" 			=> $proco_image_checkbox,
		"product_title" 			=> $proco_title_checkbox,
		"product_price" 			=> $proco_price_checkbox,
		"product_description" 		=> $proco_description_checkbox,
		"product_sku" 				=> $proco_sku_checkbox,
		"product_dimension" 		=> $proco_dimensions_checkbox,
	);
	if(update_option('proco_product_compare', $proco_all_setting_variables)) {
		$send_json_array = array( "success_msg" => "1" );
		echo json_encode($send_json_array);	
	}
	else {
		$send_json_array = array( "success_msg" => "0" );
		echo json_encode($send_json_array);
	}	
	die();
}