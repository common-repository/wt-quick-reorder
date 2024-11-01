<?php
/**
 * The Template for displaying reorder table product checkbox.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product, $wt_quick_item;

$disabled = 0;

if( $wt_quick_product ){

    if( !empty( $wt_quick_product->get_stock_status() ) ){
        $get_stock_status = $wt_quick_product->get_stock_status();
    }
    if( !$wt_quick_product->is_in_stock() || $wt_quick_product->get_stock_status() === "onbackorder" && ( !$wt_quick_product->get_manage_stock() || $wt_quick_product->get_stock_quantity() <= 0 ) ){
        $disabled = 1;
    }
} 
?>
<td class="product-check" data-title="Order">    
    <?php
    if( $disabled == 1 ){
        ?>
        <span class="sold-out-icon"><span title="Sold Out" class="dashicons dashicons-info"></span></span>
        <?php    
    }else{
       ?>
       <input type="checkbox" name="check_add_cart" <?php echo ($disabled == 1) ? "disabled" : ''; ?> value="0" form="multi-cart">
       <?php 
   }
   ?>
</td>