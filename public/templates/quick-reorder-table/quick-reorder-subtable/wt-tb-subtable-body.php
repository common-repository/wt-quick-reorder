<?php
/**
 * The Template for displaying reorder table subtable body content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
* wt_reorder_subrow_body_before_content hook.		 
*/
do_action( 'wt_reorder_subrow_body_before_content' );
?>
<tbody>
	<?php 
	$order = wc_get_order( get_the_ID() );
	$items = $order->get_items();

	if( !empty( $order ) ){

		if ( $items ) {

			foreach ( $items as $item_id => $item ) {  

				$product = $item->get_product();
				$variation_id = (int) $item->get_variation_id(); 
				$product_parent= $product->get_parent_id();
				$product_id = $product->get_id();
				if ( $product_parent ) {
					$product_id = $product_parent;
				}

				if($product){
					
					$GLOBALS['wt_quick_product'] = $product;
					$GLOBALS['wt_quick_item'] = $item;

					$disabled = 0;

					if( !$product->is_in_stock() || $product->get_stock_status() === "onbackorder" && ( !$product->get_manage_stock() || $product->get_stock_quantity() <= 0 ) ){
						$disabled = 1;
					}

					if ( wt_reorder_product_exist( $product_id ) ) { ?>

						<tr class="reorder-list <?php echo ($disabled == 1) ? "wc-disabled" : ""; ?>" product_id="<?php echo esc_attr( $product->get_id() ); ?>" variation_id="<?php echo esc_attr( $variation_id ); ?>">

							<?php
							$wt_quick_reorder_get_field_activated = wt_quick_reorder_get_field_activated();

							if( $wt_quick_reorder_get_field_activated ){
								$action_index = 10;
								foreach ( $wt_quick_reorder_get_field_activated as $key => $field_value) {
									/**
									* wt_reorder_subrow_product_'.esc_attr($key) - $action_index;
									*/
									$action_index += 10;
								}

							}
							do_action( 'wt_reorder_subrow_body_content', $product, $item );
							?>

						</tr>

					<?php } else { 
						/**
						* wt_reorder_subrow_empty_content hook.
						*/
						do_action( 'wt_reorder_subrow_empty_content' );
					} 
				}
			}
		} 
	}
	?>
</tbody>
<?php
/**
* wt_reorder_subrow_body_after_content hook.		 
*/
do_action( 'wt_reorder_subrow_body_after_content' );