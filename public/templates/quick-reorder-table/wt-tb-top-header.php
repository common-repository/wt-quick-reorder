<?php
/**
 * The Template for displaying reorder list top header content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

$GLOBALS['wt_quick_product'] = '';
$GLOBALS['wt_quick_item'] = '';
?>
<div class="order-list-header">
	
	<?php
	/**
	* @hooked wt_reorder_table_top_filters - 10
	* @hooked wt_reorder_table_add_cart_wrap - 20
	*/
	do_action( 'wt_reorder_table_top_header_content' );
	?>

</div>