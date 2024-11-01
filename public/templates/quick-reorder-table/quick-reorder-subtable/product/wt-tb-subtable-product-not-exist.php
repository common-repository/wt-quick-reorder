<?php
/**
 * The Template for displaying reorder table product not found exist.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

$wt_quick_reorder_get_field_activated = wt_quick_reorder_get_field_activated();
$colspan_count = 8;
if( is_array($wt_quick_reorder_get_field_activated) ) {
    $colspan_count = count( $wt_quick_reorder_get_field_activated );
}
?>
<tr class="no-more-exist-product">
    <td colspan="<?php echo esc_attr( $colspan_count ); ?>">
        <?php echo esc_html( __( 'This product is no more exist.', 'wt-quick-reorder' ) ); ?>
    </td>
</tr>
