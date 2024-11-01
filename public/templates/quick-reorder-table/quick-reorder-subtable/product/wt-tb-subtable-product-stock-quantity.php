<?php
/**
 * The Template for displaying reorder table product stock quantity.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;

?>
<td class="product-stock-quantity">
    <?php echo $wt_quick_product->get_stock_quantity(); ?>
</td>