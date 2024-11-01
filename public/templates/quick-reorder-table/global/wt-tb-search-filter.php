<?php
/**
 * The Template for displaying reorder table filter.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates\Global
 * @author     Webby Template <support@webbytemplate.com>
 */ 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

$page = isset( $_GET['pa'] ) ? sanitize_text_field( $_GET['pa'] ) : 1;
$order_date = isset( $_GET['order_date'] ) ? sanitize_text_field( $_GET['order_date'] ) : '';

$enable_filter = wt_quick_reorder_get_field( 'show_filter', 'order_table' );
if ( $enable_filter && $enable_filter == "yes" ) { ?>
	<div class="reorder-list-filter">
		<form method="get">
			<ul>
				<li>
					<select class="order-by-date" name="order_date">
						<option value=""><?php echo __( 'Filter By Date', 'wt-quick-reorder' ); ?></option>	
						<option value="last-30" <?php selected( $order_date, 'last-30' ); ?>><?php echo __( 'Last 30 Days', 'wt-quick-reorder' ); ?></option>						
						<option value="months-3" <?php selected( $order_date, 'months-3' ); ?>><?php echo __( 'Last 3 Months', 'wt-quick-reorder' ); ?></option>	
						<?php 	
						$year_list = wt_reorder_year_list();
						if( $year_list ){
							foreach( $year_list as $year_data ) { ?>
								<option value="<?php echo esc_attr( $year_data['p_year'] ); ?>" <?php selected( $order_date, $year_data['p_year'] ); ?> >
									<?php echo esc_html( $year_data['p_year'] ); ?>
								</option>
								<?php 
							}
						}
						?>
					</select>
				</li>
				<li>
					<button type="submit" name="submit_filter">
						<?php echo esc_html( __( 'Filter', 'wt-quick-reorder' ) ); ?>
					</button>
				</li>
				<input type="hidden" name="pa" value="<?php echo esc_attr( $page ); ?>">
			</ul>
		</form>
	</div>
	<?php 
}