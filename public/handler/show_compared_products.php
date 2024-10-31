<?php
/**
  * WooCommerce Product Compare - Show Comapred Products Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die( 'Avada Kedavra' );
/**
 * This will show the comparison table 
*/
global $post, $thepostid, $product;
if( get_option( 'current_products_id' ) ) { 
	$array_stored_productids = get_option( 'current_products_id' );
	$count_products = count($array_stored_productids);
	$product_id    = [];
	$sku 		   = [];
	$product_title = [];
	$regular_price = [];
	$short_descrip = [];
	$weight 	   = [];
	$dimensions    = [];
	$height 	   = [];
	$image 		   = [];
	$stock_status  = [];
	$rating		   = [];
	$colspanvalue  = $count_products+1;
	for( $i=0; $i<$count_products; $i++ ) {
		$product = wc_get_product( $array_stored_productids[$i] );
		array_push($product_id, $product->get_id());
		array_push($sku, $product->get_sku());
		array_push($image, $product->get_image());
		array_push($product_title, $product->get_title());
		array_push($regular_price, $product->get_regular_price());
		array_push($short_descrip, $product->get_short_description());		
		array_push($dimensions, wc_format_dimensions( $product->get_dimensions( false ) ));
		array_push($weight, $product->get_weight());
		array_push($height, $product->get_height());
		array_push($stock_status, $product->get_stock_status());
		array_push($rating, $product->get_average_rating());
	}
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
	    img.attachment-woocommerce_thumbnail.size-woocommerce_thumbnail {
		    width: 150px;
		    height: 150px;
		    display: block;
		    text-align: center;
		    margin: 0 auto;
		}
    </style>
    <?php 
    	$get_saved_option = get_option( 'proco_product_compare' );

    	$front_boxTitle_show   	  = $get_saved_option['front_boxTitle'];
    	$product_image_show 	  = $get_saved_option['product_image'];
    	$product_title_show 	  = $get_saved_option['product_title'];
    	$product_price_show 	  = $get_saved_option['product_price'];
    	$product_description_show = $get_saved_option['product_description'];
    	$product_sku_show 		  = $get_saved_option['product_sku'];
    	$product_dimension_show   = $get_saved_option['product_dimension'];

    	$weight_unit    = get_option('woocommerce_weight_unit');
    	$dimension_unit = get_option('woocommerce_dimension_unit');
    	$currency_unit  = get_option('woocommerce_currency');
    ?>
	<div class="container-fluid">
		<div class="loader"></div>
		<div class="row">
			<div class="col-md-12 table-responsive">
				<table class="table table-striped compare_table table-bordered table-responsive">
					<thead>
						<tr class="row">
							<th class="text-center col-12" colspan="<?php //echo $colspanvalue; ?>">
								<?php _e( 'Product Comparison Table', CDLZR_PRODUCT_COMPARE ); ?>
							</th>
						</tr>
					</thead>
					<tbody class="container-fluid">
						<?php 
							if( $product_image_show == 1 ) {
								?>
								<tr class="row">
									<th class="col-2"></th>
									<?php 
										if( count($image) > 0 ) {
											for( $i_mage = 0; $i_mage < count($image); $i_mage++ ) {
												echo "<td class='col'><a href='' class='remove_product' data-id='".esc_attr($product_id[$i_mage])."'><span class='crossign'>X</span></a>". $image[$i_mage] ."</td>";
											}
										}
									?>
								</tr>
								<?php
							}
						?>
						<?php 
						if( $product_title_show == 1 ) {
							?>
							<tr class="row">
								<th class="col-2"><?php _e( 'Title', CDLZR_PRODUCT_COMPARE ); ?>			
								</th>
								<?php 
									if( count($product_title) > 0 ) {
										for( $pro_title = 0; $pro_title < count($product_title); $pro_title++ ) {
											echo "<td class='col'>". esc_html($product_title[$pro_title]) ."</td>";
										}
									}
								?>
							</tr>
							<?php
						}

						if( $product_sku_show == 1 ) {
							?>
							<tr class="row">
								<th class="col-2"><?php _e( 'SKU', CDLZR_PRODUCT_COMPARE ); ?></th>
								<?php 
									if( count($sku) > 0 ) {
										for( $pro_sku = 0; $pro_sku < count($sku); $pro_sku++ ) {
											echo "<td class='col'>". esc_html($sku[$pro_sku]) ."</td>";
										}
									}
								?>
							</tr>
							<?php
						}
						if( $product_description_show == 1 ) {
							?>
							<tr class="row">
								<th class="col-2"><?php _e( 'Short Description', CDLZR_PRODUCT_COMPARE ); ?></th>
								<?php 
									if( count($short_descrip) > 0 ) {
										for( $description = 0; $description < count($short_descrip); $description++ ) {
											echo "<td class='col'>". esc_html($short_descrip[$description]) ."</td>";
										}
									}
								?>
							</tr>
							<?php
						}

						if( $product_dimension_show == 1 ) {
							?>
							<tr class="row">
								<th class="col-2"><?php _e( 'Product Dimensions', CDLZR_PRODUCT_COMPARE );  ?>
									<small> 
										( <?php echo esc_html($dimension_unit); ?> )
									</small>
								</th>
								<?php 
									if( count($dimensions) > 0 ) {
										for( $pro_dimens_counter = 0; $pro_dimens_counter < count($dimensions); $pro_dimens_counter++ ) {
											echo "<td class='col'>". esc_html($dimensions[$pro_dimens_counter]) ."</td>";
										}
									}
								?>
							</tr>
							<?php
						}
						?>						
						<tr class="row">
							<th class="col-2"><?php _e( 'Product Weight', CDLZR_PRODUCT_COMPARE ); ?> <small>( <?php echo esc_html($weight_unit); ?></small> )</th>
							<?php 
								if( count($weight) > 0 ) {
									for( $pro_weight_counter = 0; $pro_weight_counter < count($weight); $pro_weight_counter++ ) {
										echo "<td class='col'>". esc_html($weight[$pro_weight_counter]) ."</td>";
									}
								}
							?>
						</tr>						
						<tr class="row">
							<th class="col-2"><?php _e( 'Stock Status', CDLZR_PRODUCT_COMPARE ); ?></th>
							<?php 
								if( count($stock_status) > 0 ) {
									for( $stock_status_counter = 0; $stock_status_counter < count($stock_status); $stock_status_counter++ ) {
										echo "<td class='col'>". esc_html($stock_status[$stock_status_counter]) ."</td>";
									}
								}
							?>
						</tr>
						<tr class="row">
							<th class="col-2"><?php _e( 'Rating', CDLZR_PRODUCT_COMPARE ); ?></th>
							<?php 
								if( count($rating) > 0 ) {
									for( $rating_counter = 0; $rating_counter < count($rating); $rating_counter++ ) {
										echo "<td class='col'>". esc_html($rating[$rating_counter]) ."</td>";
									}
								}
							?>
						</tr>
						<?php 
						if( $product_price_show == 1 ) {
							?>
							<tr class="row">
								<th class="col-2"><?php _e( 'Price', CDLZR_PRODUCT_COMPARE ); ?></th>
								<?php 
									if( count($regular_price) > 0 ) {
										for( $regular_price_counter = 0; $regular_price_counter < count($regular_price); $regular_price_counter++ ) {
											echo "<td class='col'>". wc_price($regular_price[$regular_price_counter]) ."</td>";
										}
									}
								?>
							</tr>
							<?php
						}
						?>						
						<tr class="row">
							<th class="col-2"><?php _e( 'Add to cart', CDLZR_PRODUCT_COMPARE ); ?></th>
							<?php 
								if( count($product_id) > 0 ) {
									for( $product_id_counter = 0; $product_id_counter < count($product_id); $product_id_counter++ ) {
										?>
										<td class="col">
											<a href="?add-to-cart=<?php echo esc_attr($product_id[$product_id_counter]); ?>" data-quantity="1" class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_id="<?php echo esc_attr($product_id[$product_id_counter]); ?>" data-product_sku="" aria-label="<?php _e( 'Added to your cart', CDLZR_PRODUCT_COMPARE ); ?>" rel="nofollow"><?php _e( 'Order Now', CDLZR_PRODUCT_COMPARE ); ?></a>	
										</td>
										<?php										
									}
								}
							?>
						</tr>
					</tbody>
				</table>
			</div>
		</div> <!-- row -->
	</div>	<!-- container fluid-->
	<?php	
}
else {
	print("No products found");
}
die();