<?php
/**
 * The Template for displaying reorder table product image.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-image" data-title="Image">
    <?php echo wp_kses_post( $wt_quick_product->get_image() ); ?>
</td>