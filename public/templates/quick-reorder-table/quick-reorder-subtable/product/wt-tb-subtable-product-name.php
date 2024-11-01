<?php
/**
 * The Template for displaying reorder table product name.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-name" data-title="Name">
    <?php echo esc_html( $wt_quick_product->get_title() );  ?>
</td>