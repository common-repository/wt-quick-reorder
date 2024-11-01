<?php
/**
 * The Template for displaying reorder table pagination.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates\Global
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

$page = isset( $_GET['pa'] ) ? sanitize_text_field( $_GET['pa'] ) : 1;
$order_date = isset( $_GET['order_date'] ) ? sanitize_text_field( $_GET['order_date'] ) : '';
$args = wt_reorder_wp_query_callback_func( $page, $order_date );
$the_query = new WP_Query( $args );

$pagination = wt_quick_reorder_get_field( 'pagination', 'order_table' ); 
$posts_per_page = wt_quick_reorder_get_field( 'order_per_page','order_table' );

if ( $pagination == 'number' ) { ?>

	<div class="reorder-pagination-wrap">
		<?php 
		$current_page = max( 1, $page );		
		$base_link = html_entity_decode( str_replace( "pa=".$current_page, "pa=%_%", get_pagenum_link(1) ) );
		if( $current_page == 1 ){
			if( !isset($_GET['pa']) ){
				$base_link = html_entity_decode( get_pagenum_link(1) . '?pa=%_%' );					
			}else{
				if( empty($_GET['pa']) ){
					$base_link = html_entity_decode( str_replace( "pa", "pa=%_%", get_pagenum_link(1) ) );												
				}
			}
		}		
		echo paginate_links( array (
			'base' 		=> $base_link,
			'format'	=> '%#%',
			'current'   => $current_page,
			'total'     => $the_query->max_num_pages,
			'prev_text' => __('« Prev'),
			'next_text' => __('Next »'),
			'add_args'  => array(),
			'type'      => 'list'
		) );
		?>
	</div>
<?php } 

if ( $pagination == 'load_more' ) { 
	if ( $the_query->found_posts > $posts_per_page ) { ?>
		<div class="load-more-button">
			<button class="load-more" page="2" max_pages="<?php echo esc_attr( $the_query->max_num_pages ); ?>">
				<?php echo esc_html( __( 'Show More', 'wt-quck-reorder' ) ); ?>
				<i class="fa fa-spinner fa-spin" aria-hidden="true" style="display: none;"></i>
			</button>
		</div>
	<?php } 

}