<?php
/**
 * The Template for displaying reorder table user logout content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

?>
<div class="logged-out-content">
	<p>
		<?php echo esc_html( __( 'You are not logged in. Please log in', 'wt-quick-reorder' ) ); ?>
		<a class="user_click_logged" href="<?php echo esc_url( get_permalink ( get_option ('woocommerce_myaccount_page_id' ) ) ); ?>">
			<b><?php echo esc_html( __( 'click here', 'wt-quick-reorder' ) ); ?></b>
		</a>
	</p>
</div>