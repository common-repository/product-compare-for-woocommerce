<?php
/**
  * WooCommerce Product Compare - Dashboard Setting Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();

if( ! class_exists( 'Proco_Dashboard' ) ) {
	class Proco_Dashboard {
		public static function dashboard_page_func(){
			?>
			<style type="text/css">
			    .loader {
			    	position:fixed;
			        top: 40%;
			        left: 50%;
			        width: 200px;
			        height: 200px;
			        margin-top: -3em; 
			        margin-left: -3em;
			        border: 0px solid #ccc;
			        background-color: #ffffff;        
			        background: url('<?php echo esc_url(CDLZR_PRODUCT_COMPARE_URL."assets/loader/Spinner-1s-200px.gif"); ?>') no-repeat;
			        display: none;
			        z-index: 9999999;
			    }
			</style>
			<div class="mwa_news_flasher">
				<div class="loader"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2 class="text-center">
								 <?php _e( 'Dashboard', CDLZR_PRODUCT_COMPARE ); ?>
							</h2>
						</div>		
					</div>
					<?php
						$saved_proco_product_compare = get_option('proco_product_compare');
						
						$button_type 			   = isset( $saved_proco_product_compare['button_type'] ) ? esc_html( $saved_proco_product_compare['button_type'] ) : '';
						$button_text 			   = isset( $saved_proco_product_compare['button_text'] ) ? esc_html( $saved_proco_product_compare['button_text'] ) : '';
						$show_button_singleproduct = isset( $saved_proco_product_compare['show_button_singleproduct'] ) ? esc_html( $saved_proco_product_compare['show_button_singleproduct'] ) : '';
						$show_button_productlist   = isset( $saved_proco_product_compare['show_button_productlist'] ) ? esc_html( $saved_proco_product_compare['show_button_productlist'] ) : '';
						$front_boxTitle 		   = isset( $saved_proco_product_compare['front_boxTitle'] ) ? esc_attr( $saved_proco_product_compare['front_boxTitle'] ) : '';
						$product_image 			   = isset( $saved_proco_product_compare['product_image'] ) ? esc_html( $saved_proco_product_compare['product_image'] ) : '';
						$product_title 			   = isset( $saved_proco_product_compare['product_title'] ) ? esc_attr( $saved_proco_product_compare['product_title'] ) : '';
						$product_price 			   = isset( $saved_proco_product_compare['product_price'] ) ? esc_html( $saved_proco_product_compare['product_price'] ) : '';
						$product_description 	   = isset( $saved_proco_product_compare['product_description'] ) ? esc_html( $saved_proco_product_compare['product_description'] ) : '';
						$product_sku 			   = isset( $saved_proco_product_compare['product_sku'] ) ? esc_html( $saved_proco_product_compare['product_sku'] ) : '';
						$product_dimension 		   = isset( $saved_proco_product_compare['product_dimension'] ) ? esc_html( $saved_proco_product_compare['product_dimension'] ) : '';
					?>
					<form method="post" id="proco_form_1">			
						<?php wp_nonce_field('proco_user_choice_form', 'proco_user_choice_form_nonce'); ?>
						<div class="block_css block_general_setting">
							<div class="row">
								<div class="col-md-12">
									<h5 class="proco_admin_heading">
									<?php 
										_e( 'General Settings', CDLZR_PRODUCT_COMPARE );
									?>	
									</h5>
								</div>		
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="proco_t1"><?php _e( 'Compare Button Type', CDLZR_PRODUCT_COMPARE ); ?></label>
									<select class="custom-select" id="proco_t1" name="proco_t1">
										<option selected><?php _e( 'Select Button Type', CDLZR_PRODUCT_COMPARE ); ?></option>
										<option value="1" <?php echo ( $button_type == 1 ) ? 'selected = selected' : '' ?>><?php _e( 'Link', CDLZR_PRODUCT_COMPARE ); ?></option>
										<option value="2" <?php echo( $button_type == 2 ) ? 'selected = selected' : '' ?>><?php _e( 'Button', CDLZR_PRODUCT_COMPARE ); ?></option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label for="proco_t2"><?php _e( 'Link or Button text', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="text" name="proco_t2" id="proco_t2" class="form-control" placeholder="<?php _e( 'Ex: Compare or tally the products', CDLZR_PRODUCT_COMPARE ); ?>" value="<?php echo esc_attr($button_text); ?>">
								</div>
							</div>
							<div class="form-row mt-4">
								<div class="form-group col">
									<label for="proco_c1"><?php _e( 'Show compare button to single page', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_c1" class="form-control" id="proco_c1" value="1" <?php echo ( $show_button_singleproduct == 1 ) ? 'checked=checked' : '' ?>>
								</div>
								<div class="form-group col">
									<label for="proco_c2"><?php _e( 'Show compare button in products shop page', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_c2" class="form-control" id="proco_c2" value="1" <?php echo ( $show_button_productlist == 1 ) ? 'checked=checked' : '' ?>>
								</div>
							</div>
						</div>
						<!-- Block 2 -->
						<div class="block_css block_frontend_settings">
							<div class="row">
								<div class="col-md-12">
									<h5 class="proco_admin_heading"><?php _e( 'Frontend Settings', CDLZR_PRODUCT_COMPARE ); ?></h5>
								</div>		
							</div>
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="proco_frontend_title">
										<?php _e( 'Compare window/box title', CDLZR_PRODUCT_COMPARE ); ?>
									</label>
								</div>
								<div class="form-group col-md-6">
									<input type="text" name="proco_frontend_title" id="proco_frontend_title" class="form-control" placeholder="eg: Product compare" value="<?php echo $front_boxTitle; ?>">
								</div>
							</div>
							<div class="form-row mt-2">
								<div class="form-group col-md-4">
									<label>
										<?php _e( 'Fields to Show', CDLZR_PRODUCT_COMPARE ); ?>
									</label>
									<p>
									<?php _e( 'Please select the field from list, which you want to show in comaprison', CDLZR_PRODUCT_COMPARE ); ?>
									</p>						
								</div>
								<div class="form-group col-md-6">						
									<label for="proco_image_checkbox"><?php _e( 'Product Image', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_image_checkbox" class="form-control" id="proco_image_checkbox" value="1" <?php echo ( $product_image == 1 ) ? 'checked=checked' : '' ?>>

									<label for="proco_title_checkbox"><?php _e( 'Product Title', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_title_checkbox" class="form-control" id="proco_title_checkbox" value="1" <?php echo ( $product_title == 1 ) ? 'checked=checked' : '' ?>>

									<label for="proco_price_checkbox"><?php _e( 'Product Price', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_price_checkbox" class="form-control" id="proco_price_checkbox" value="1" <?php echo ( $product_price == 1 ) ? 'checked=checked' : '' ?>>

									<label for="proco_description_checkbox"><?php _e( 'Product Description', CDLZR_PRODUCT_COMPARE ); ?></label>
									<input type="checkbox" name="proco_description_checkbox" class="form-control" id="proco_description_checkbox" value="1" <?php echo ( $product_description == 1 ) ? 'checked=checked' : '' ?>>

									<label for="proco_sku_checkbox">
										<?php _e( 'Product SKU', CDLZR_PRODUCT_COMPARE ); ?>
									</label>
									<input type="checkbox" name="proco_sku_checkbox" class="form-control" id="proco_sku_checkbox" value="1" <?php echo ( $product_sku == 1 ) ? 'checked=checked' : '' ?>>

									<label for="proco_dimensions_checkbox">
										<?php _e( 'Product Dimensions', CDLZR_PRODUCT_COMPARE ); ?>
									</label>
									<input type="checkbox" name="proco_dimensions_checkbox" class="form-control" id="proco_dimensions_checkbox" value="1" <?php echo ( $product_dimension == 1 ) ? 'checked=checked' : '' ?>>
								</div>
							</div>				
						</div>
						<button type="submit" name="proco_save_options" id="proco_save_options" class="btn btn-info">
							<?php _e( 'Save Settings', CDLZR_PRODUCT_COMPARE ); ?>
						</button>
					</form>
				</div>
			</div>
			<?php			
		}
		
	}
}
?>