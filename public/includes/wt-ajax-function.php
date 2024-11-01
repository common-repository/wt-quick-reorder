<?php
/**
 * WT Quick Reorder table ajax functions.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Functions
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
* load more order with ajax.
*/

add_action( 'wp_ajax_wt_reorder_load_more', 'wt_reorder_load_more' );
add_action( 'wp_ajax_nopriv_wt_reorder_load_more', 'wt_reorder_load_more' );

function wt_reorder_load_more() {
    $html = '';
    ob_start();
    if( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'wqr_form_save' ) ){
        $page = isset( $_POST['page'] ) ? sanitize_text_field( $_POST['page'] ) : 1;
        $order_date = isset( $_POST['order_date'] ) ? sanitize_text_field( $_POST['order_date'] ) : '';
        $args = wt_reorder_wp_query_callback_func( $page, $order_date );
        $result = new WP_Query( $args );
        if ( $result-> have_posts() ) {
            while ( $result->have_posts() )  { 
                $result->the_post();            
                $order = wc_get_order( get_the_ID() );
                $date_created = $order->get_date_created()->date('m/d/Y');
                $wt_quick_reorder_get_field_activated = wt_quick_reorder_get_field_activated();
                $colspan_count = 8;
                if( is_array($wt_quick_reorder_get_field_activated) ) {
                    $colspan_count = count( $wt_quick_reorder_get_field_activated );
                }

                if( !empty( $order ) ){ 
                    ?>
                    <tr>
                        <td class="order-date"><?php echo esc_html( $date_created ); ?></td>
                        <td class="order-id"><?php echo esc_html( '#'.$order->get_order_number() ); ?></td>
                        <td class="wc-product" colspan="<?php echo esc_attr( $colspan_count ); ?>" style="padding:0; border:0">
                            <table class="reorder-subtable">
                                <?php
                                wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/wt-tb-subtable-body.php' );
                                ?>
                            </table>
                        </td>
                    </tr>
                    <?php
                }
            }

        }
        wp_reset_postdata();
        $html .= ob_get_clean();
        $html = apply_filters( 'wt_reorder_load_more_html', $html );
    }

    wp_send_json( array( 'html' => $html ) );
}

/**
* add to cart previous order's product.
*/

add_action('wp_ajax_wt_reorder_add_cart_obj', 'wt_reorder_add_cart_obj' );
add_action('wp_ajax_nopriv_wt_reorder_add_cart_obj', 'wt_reorder_add_cart_obj' );

function wt_reorder_add_cart_obj(){

    global $woocommerce;

    $html = '';
    $product_error = array();
    if( isset( $_POST['reorderType'] ) && wp_verify_nonce( $_POST['reorderType'], 'quick_reorder_cart' ) && isset( $_POST['order_product_list'] ) && !empty( $_POST['order_product_list'] ) ){

        $order_product_list = array_map( 'wt_reorder_sanitize_callback',  $_POST['order_product_list'] );

        if( !empty( $order_product_list ) ){
            foreach ($order_product_list as  $order_product ) {
                if( $order_product['produt_id'] && $order_product['quantity'] ){
                    $add_to_cart = $woocommerce->cart->add_to_cart(  $order_product['produt_id'], $order_product['quantity']);
                    if( !$add_to_cart){
                        $product_error[] = array( 'produt_id' => $order_product['produt_id'] , 'quantity' => $order_product['quantity'] );
                    }
                }
            }
        }

        if( $product_error ){

            $html .= '<ul class="wt-quick-reorder-error" role="alert">'; 

            foreach( $product_error  as  $productdata ) {
                $product = wc_get_product( $productdata['produt_id'] );

                $stock_quantity = $product->get_stock_quantity();

                $cart_item_quantities = WC()->cart->get_cart_item_quantities();

                $product_qty_in_cart = $cart_item_quantities[ $product->get_stock_managed_by_id() ];

                $html .= '<li>'.__( 'You cannot add that amount to the cart — we have ','wt-quick-reorder' ). esc_html( $stock_quantity ) .__( ' in stock and you already have ','wt-quick-reorder' ). esc_html( $product_qty_in_cart ) .__( ' in your cart.','wt-quick-rorder' ).'</li>';
            }

            $html .= '</ul>';   
        }

        if( $add_to_cart  ){
            $data = array( 'sucess' => 'sucess');
        }else{
            $data = array( 'error' => 'error' , 'html' => $html);
        }

        $html = apply_filters( 'wt_reorder_ajax_add_cart_obj', $product_error, $html );

        wp_send_json($data);
    }
}

/**
 * Saving the sanitize callback
 *
 */
function wt_reorder_sanitize_callback($value) {
    if ( is_array( $value ) ) {
            // If the value is an array, recursively sanitize it
        $value = array_map( 'wt_reorder_sanitize_callback', $value );
    } else {
            // Sanitize the value using sanitize_text_field()
        $value = sanitize_text_field( $value );
    }
    return $value;
}