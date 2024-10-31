<?php
/**
  * WooCommerce Product Compare - Add Button Setting Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();
if( !class_exists('CDLZR_PROCO_ADDBUTTON')) {
    class CDLZR_PROCO_ADDBUTTON {
        public static function proco_archive_page_compare_btn_archivePage(){
            global $product;
            $get_saved_option = get_option( 'proco_product_compare' );
            
            $button_text      = $get_saved_option['button_text'];
            $front_boxTitle   = $get_saved_option['front_boxTitle'];

            $get_current_products_ids = get_option('current_products_id');
            $get_saved_option         = get_option( 'proco_product_compare' );
            
            if( $product ) {        
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
                .view_table {
                    position: fixed;
                    bottom: 0;
                }
            </style>
            <div class="container">
                <div class="loader"></div>      
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-12">
                        <p>             
                            <?php 
                                if( isset( $get_saved_option['button_type'] ) && $get_saved_option['button_type'] == 1 ) {
                                    ?>
                                    <a href="#" class="product_type_simple add_to_cart_button adcomp-button <?php //echo self::hide_button($product->get_id()); ?>" id="<?php echo esc_attr($product->get_id()); ?>" data-id="<?php echo esc_attr($product->get_id()); ?>">
                                        <?php echo esc_html($button_text); ?>
                                    </a>
                                    <?php
                                }
                                elseif ( isset( $get_saved_option['button_type'] ) && $get_saved_option['button_type'] == 2 ) { 
                                    ?>
                                    <button type="button" class="button product_type_simple add_to_cart_button adcomp-button <?php //echo self::hide_button($product->get_id()); ?>" id="<?php echo esc_attr($product->get_id()); ?>" data-id="<?php echo esc_attr($product->get_id()); ?>">
                                        <?php echo esc_html($button_text); ?>
                                    </button>
                                    <?php
                                }
                            ?>
                        </p>                                      
                    </div>
                </div>
            </div>
            
                
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                <?php echo esc_html($get_saved_option['front_boxTitle']); ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">                    
                            <div class="result"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e( 'Close', CDLZR_PRODUCT_COMPARE ); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
        }

        /* 
            @function to hide the add to compare button
        */
        public static function hide_button( $productId ) {
            $productIds_array = get_option('current_products_id');
            if( in_array($productId, $productIds_array) ) {
                return 'd-none';
            }
            else {
                return '';
            }
        }
    }
}