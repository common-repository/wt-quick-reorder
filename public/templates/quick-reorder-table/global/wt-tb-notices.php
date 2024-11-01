<?php
/**
 * The Template for displaying reorder table message.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates\Global
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

?>
<div class="top-cart-error">
	<p class="sucess" style="display: none;">
		<?php echo esc_html( __( 'Product added to cart successfully!', 'wt-quick-reorder' ) ); ?>
	</p>
	<p class="error" style="display: none;">
		<?php echo esc_html( __( 'Change Product quantity!', 'wt-quick-reorder' ) ); ?>
	</p>
	<p class="btn-error" style="display: none;">
		<?php echo esc_html( __( 'Click on the check box to add the product!', 'wt-quick-reorder' ) ); ?>
	</p>
</div>
