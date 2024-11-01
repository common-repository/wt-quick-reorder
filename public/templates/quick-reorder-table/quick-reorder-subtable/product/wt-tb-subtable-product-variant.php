<?php
/**
 * The Template for displaying order table product variant.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-variant" data-title="Variant">
    <?php wt_quick_order_product_variant( $wt_quick_product ); ?>
</td>