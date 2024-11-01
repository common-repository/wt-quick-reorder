<?php
/**
 * WT Quick Reorder table column functions.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Functions
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
 * Get order year List.
 */

if ( ! function_exists( 'wt_reorder_year_list' ) ) {

	function wt_reorder_year_list() {

		global $wpdb;

		$year_list = $wpdb->get_results( $wpdb->prepare( "SELECT YEAR(post_date) as p_year FROM ".$wpdb->prefix."posts as p LEFT JOIN ".$wpdb->prefix."postmeta as pm ON  p.ID = pm.post_id  WHERE  p.post_type = 'shop_order'   AND  p.post_status NOT IN ( 'wc-cancelled', 'wc-failed', 'wc-checkout-draft' ) AND pm.meta_key = '_customer_user' AND 
		pm.meta_value = '%s' GROUP BY p_year  ORDER BY p_year DESC", get_current_user_id() ), ARRAY_A );

		$year_list = apply_filters( 'wt_get_quick_order_year_list', $year_list );

		return $year_list;
	}

}

/** 
* Check order product exist or not.
*/

if ( ! function_exists( 'wt_reorder_product_exist' ) ) {

	function wt_reorder_product_exist( $product_id ){
		$flag = false;
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'post__in'=> array($product_id)
		);
		$productdata = get_posts( $args );
		if ( $productdata ) {
			$flag = true;
		}
		return $flag;
	}
}

/**
* Get order table query args.
*/

if ( ! function_exists( 'wt_reorder_wp_query_callback_func' ) ) {

	function wt_reorder_wp_query_callback_func( $page='', $order_date='' ){

		$post_per_page = wt_quick_reorder_get_field('order_per_page','order_table');
		$order = wt_quick_reorder_get_field('order','order_table');
		$order_by = wt_quick_reorder_get_field('order_by','order_table');
		$date_query = array();
		if( $order_date ){
			if( $order_date == "last-30" ){
				$date_query = array(
					'after'   => '-30 days',
					'column' => 'post_date',
				);
			}else if( $order_date == "months-3" ){
				$date_query = array(
					'after'   => '-3 month',
					'column' => 'post_date',
				);
			}else{
				$date_query = array(
					'year'   => $order_date,
					'column' => 'post_date',
				);
			}
		}

		$array1 = array_keys(wc_get_order_statuses());
		$array2 = array( 'wc-cancelled', 'wc-failed', 'wc-checkout-draft' );
		$post_status_arr = array_diff($array1, $array2);

		$args = array(
			'meta_key' => '_customer_user',
			'meta_value' => get_current_user_id(),
			'post_type' => wc_get_order_types('view-orders'),
			'orderby' => isset( $order_by ) ? $order_by : 'date',
			'order'   => isset( $order ) ? $order : 'ASC',
			'posts_per_page' => isset( $post_per_page ) ?  $post_per_page : '10',
			'paged' => $page,
			'post_status' => $post_status_arr,
		);

		if( $date_query ){
			$args['date_query'] = array(
				$date_query,
			);
		}

		$args = apply_filters( 'wt_quick_reorder_wp_query_args', $args );

		return $args;
	}
}

/**
* Get order product variant.
*/

if ( ! function_exists( 'wt_quick_order_product_variant' ) ) {

	function wt_quick_order_product_variant( $product ){

		$variant = '';
		if( $product->is_type( 'variation' ) ){
			$attributes = $product->get_attributes();
			$variation_names = array();

			if( $attributes ){ 				
				foreach ( $attributes as $key => $value) {
					$variation_key =  explode('-', $key);
					$variation_key =  end($variation_key);
					if( $value ) {
						$variant .= '<li>'. wc_attribute_label( $variation_key ) .' : '. esc_html( $value ) . '</li>';
					}
				}
			}
			if( $variant ){
				echo '<ul>'.wp_kses_post( $variant ).'</ul>';
			}			
		}
	}
}

/**
* Get order product  woocommerce quantity input
*/

if ( ! function_exists( 'wt_quick_order_product_quantity_input' ) ) {

	function wt_quick_order_product_quantity_input( $args = array(), $product = null, $echo = true , $quantity = '') {
		if ( is_null( $product ) ) {
			$product = $GLOBALS['product'];
		}

		$defaults = array(
			'input_id'     => uniqid( 'quantity_' ),
			'input_name'   => 'quantity',
			'input_value'  => '1',
			'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
			'max_value'    => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
			'min_value'    => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
			'step'         => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
			'pattern'      => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
			'inputmode'    => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
			'product_name' => $product ? $product->get_title() : '',
			'placeholder'  => apply_filters( 'woocommerce_quantity_input_placeholder', '', $product ),
			'autocomplete' => apply_filters( 'woocommerce_quantity_input_autocomplete', 'off', $product ),
			'readonly'     => false,
		);
		
		$args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );
		
		$args['min_value'] = max( $args['min_value'], 0 );
		$args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : '';

		if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
			$args['max_value'] = $args['min_value'];
		}

		if( $echo == 'order_list' && !empty( $quantity )){
			$args['order-list'] = 'order_list';
			$args['product_stock'] = isset( $quantity ) ? $quantity : '';
		}

		$type = $args['min_value'] > 0 && $args['min_value'] === $args['max_value'] ? 'hidden' : 'number';
		$type = $args['readonly'] && 'hidden' !== $type ? 'text' : $type;


		$args['type'] = apply_filters( 'woocommerce_quantity_input_type', $type );

		ob_start();
		
		wc_get_template( 'global/quantity-input.php', $args );

		if ( $echo ) {
			echo ob_get_clean();
		} else {
			return ob_get_clean();
		}
	}	

}

