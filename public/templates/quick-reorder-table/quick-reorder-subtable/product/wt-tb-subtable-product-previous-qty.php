<?php
/**
 * The Template for displaying reorder table product previous qty.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product, $wt_quick_item;
$quantity = 0;

if( is_object( $wt_quick_item ) ){
    $quantity = $wt_quick_item->get_quantity();     
}else{
    $wt_quick_item = $args['item']; 
    $quantity = $wt_quick_item->get_quantity();     
}
?>
<td class="previous-qty" data-title="Previous Order">
    <?php echo ( !empty( $quantity  ) ? esc_html( $quantity ) : 0 ); ?>
</td>