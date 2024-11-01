<?php
/**
 * The Template for displaying reorder table data not found content.
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
$colspan_count = $colspan_count + 2;
?>
<tr>
	<td colspan="<?php echo esc_attr( $colspan_count ); ?>" class="not-found-data">
		<?php echo esc_html( __( 'Order Data Not Found!', 'wt-quick-reorder' ) ); ?>
	</td>
</tr>
<?php