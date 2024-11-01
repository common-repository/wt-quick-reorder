<?php
/**
 * The Template for displaying reorder table product sku.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-sku" data-title="SKU">
    <?php echo esc_html( $wt_quick_product->get_sku() ); ?>
</td>