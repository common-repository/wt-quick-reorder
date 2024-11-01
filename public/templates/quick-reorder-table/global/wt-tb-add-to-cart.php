<?php
/**
 * The Template for displaying reorder table add to cart content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates\Global
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

?>
<div class="top-cart-btn">
	<button type="submit" name="add_cart_multi" value="" class="multi-add-to-cart-button button" disabled>
		<?php echo esc_html( __( 'Add to cart', 'wt-quick-reorder' ) ); ?>
		<?php wp_nonce_field( 'quick_reorder_cart', 'reorderType' ); ?>
		<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
	</button>
</div>