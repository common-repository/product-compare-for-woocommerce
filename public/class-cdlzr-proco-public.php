<?php
/**
  * WooCommerce Product Compare - Public Page.
  *
  * @package product-compare-for-woocommerce
*/
defined( 'ABSPATH' ) or die();

if( !class_exists('CDLZR_PROCO_PUBLIC')){
    class CDLZR_PROCO_PUBLIC{
        function __construct(){       
            require_once( 'class-cdlzr-proco-addbutton.php' );
            require_once( 'class-cdlzr-proco-frontend.php' );
            require_once( 'class-cdlzr-proco-frontend-actions.php' );
            new CDLZR_PROCO_ADDBUTTON;
            new Proco_Frontend;
            new Proco_Frontend_Actions;

            /*
            * Load the CSS and JS
            */
            add_action( 'wp_enqueue_scripts', array( 'Proco_Frontend', 'load_assets_front' ) );

            /**
            * Action for ajax
            */
            add_action( 'wp_ajax_check_upg_prdct_category', array( 'Proco_Frontend_Actions', 'check_product_category' ) );
            add_action( 'wp_ajax_nopriv_check_upg_prdct_category', array( 'Proco_Frontend_Actions', 'check_product_category' ) );

            /**
            * Action to show compare table in pop-up
            */

            add_action( 'wp_ajax_show_compare_table_popup', array( 'Proco_Frontend_Actions', 'show_product_compare_table' ) );
            add_action( 'wp_ajax_nopriv_show_compare_table_popup', array( 'Proco_Frontend_Actions', 'show_product_compare_table' ) );

            /**
            * Action to remove product from compare table
            */
            add_action( 'wp_ajax_remove_product_compare_table', array( 'Proco_Frontend_Actions', 'remove_product_compare_table' ) );
            add_action( 'wp_ajax_nopriv_remove_product_compare_table', array( 'Proco_Frontend_Actions', 'remove_product_compare_table' ) );

            /* 
                # To control the add to list button visibility on archeive and single
            */
            $get_saved_option          = get_option( 'proco_product_compare' );
            $show_button_singleproduct = isset($get_saved_option['show_button_singleproduct']);
            $show_button_productlist   = isset($get_saved_option['show_button_productlist']);
            /* 
                Add add to compare button on shop archive and single product
            */
            if( $show_button_productlist == 1 ) {
               add_action( 'woocommerce_after_shop_loop_item', array('CDLZR_PROCO_ADDBUTTON','proco_archive_page_compare_btn_archivePage'), 10 ); 
               add_action( 'woocommerce_after_shop_loop_item', array('CDLZR_PROCO_PUBLIC','show_view'), 10 ); 
            }

            /* The action, "woocommerce_after_add_to_cart_button", will add the compare button after cart button on single product page */
            if( $show_button_singleproduct == 1 ) {
                add_action( 'woocommerce_after_add_to_cart_button', array('CDLZR_PROCO_ADDBUTTON','proco_archive_page_compare_btn_archivePage') );
            }
        } 

        /* same code is written in the class-cdlzr-proco-addbutton.php */
        public static function proco_archive_page_compare_btn() {
            global $product;

            if( $product ) { 
            $get_saved_option = get_option( 'proco_product_compare' );           
            $button_text      = $get_saved_option['button_text'];
            $front_boxTitle   = $get_saved_option['front_boxTitle'];
            ?>          
            <div class="container">          
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary btn-sm adcomp-button" data-id="<?php echo esc_attr( $product->get_id() ); ?>">
                            <?php echo esc_html($button_text); ?>
                        </button>
                        <button type="button" class="btn btn-info btn-sm showcomp-button">
                            <?php echo esc_html($front_boxTitle); ?>
                        </button>          
                    </div>
                </div>
            </div>
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">    
                <div class="modal-content">
                  <div class="modal-header">
                   <!--  <h5 class="modal-title" id="exampleModalLabel"><?php //_e( 'Modal Title', CDLZR_PRODUCT_COMPARE ); ?></h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php _e('COMPARE TABLE', CDLZR_PRODUCT_COMPARE); ?>
                    <div class="result">
                        
                    </div>            
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

        /* Show compare button only on the shop page */
        public static function show_view() {    
            if( is_shop() ) {        
                ?>        
                    <div class="view_table">
                        <button type="button" class="btn btn-sm btn-info showcomp-button">
                            <?php _e( 'View Compare Table', CDLZR_PRODUCT_COMPARE ); ?>
                        </button>
                    </div>
                <?php         
            }
        }
    }
}     