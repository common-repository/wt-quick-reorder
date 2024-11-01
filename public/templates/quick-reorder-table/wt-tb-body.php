<?php
/**
 * The Template for displaying reorder table body content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
* wt_reorder_table_body_before_content hook.		 
*/
do_action( 'wt_reorder_table_body_before_content' );
?>
<tbody>
	<?php 
	$page = isset( $_GET['pa'] ) ? sanitize_text_field( $_GET['pa'] ) : 1;
	$order_date = isset( $_GET['order_date'] ) ? sanitize_text_field( $_GET['order_date'] ) : '';
	$args = wt_reorder_wp_query_callback_func( $page, $order_date );
	$the_query = new WP_Query( $args );

	if( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {	
			$the_query->the_post();
			$order = wc_get_order( get_the_ID() );
			$date_created = $order->get_date_created()->date('m/d/Y');
			$wt_get_reorder_field_activated = wt_quick_reorder_get_field_activated();
			$colspan_count = 8;
			if( is_array($wt_get_reorder_field_activated) ) {
				$colspan_count = count( $wt_get_reorder_field_activated );
			}

			if( !empty( $order ) ){ ?>
				<tr>
					<td class="order-date" data-title="Order Date">
						<?php echo esc_html( $date_created ); ?>
					</td>
					<td class="order-id" data-title="Order ID">
						<?php echo esc_html( '#'.$order->get_order_number() ); ?>
					</td>
					<td class="wc-product" colspan="<?php echo esc_attr( $colspan_count ); ?>" style="padding:0; border:0" data-title="4">
						<?php
						/**
						* @hooked wt_reorder_subrow_start_wrap - 10
						* @hooked wt_reorder_subrow_body - 20
						* @hooked wt_reorder_subrow_end_wrap - 30
						*/
						do_action( 'wt_reorder_subrow_content' );
						?>
					</td>
				</tr>
				<?php
			}
		}

	}else{
		/**
		* wt_reorder_table_data_empty_content hook.
		*/
		do_action( 'wt_reorder_table_data_empty_content' );
	}
	wp_reset_postdata();
	?>
</tbody>
<?php
/**
* wt_reorder_table_body_after_content hook.		 
*/
do_action( 'wt_reorder_table_body_after_content' );