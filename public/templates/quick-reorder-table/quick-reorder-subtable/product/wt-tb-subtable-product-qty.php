<?php
/**
 * The Template for displaying reorder table product qty.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product, $wt_quick_item;

$quantity = $wt_quick_item->get_quantity(); 
$input_quantity  = isset( $_POST['quantity'] ) ? sanitize_text_field( $_POST['quantity'] ) : 0;
?>
<td class="product-qty" data-title="Qty Box">
    <?php 
    $wt_quick_item = array(
        'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $wt_quick_product->get_min_purchase_quantity(), $wt_quick_product ),
        'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $wt_quick_product->get_max_purchase_quantity(), $wt_quick_product ),
        'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $input_quantity ) ) : $wt_quick_product->get_min_purchase_quantity(),
    );
    if( $wt_quick_product->is_purchasable() && $wt_quick_product->is_in_stock() ){
        echo wt_quick_order_product_quantity_input( $wt_quick_item , $wt_quick_product , $echo = "order_list" ,$quantity);    
    }else{
        echo "-";
    }
    ?>
</td>