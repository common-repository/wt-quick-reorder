<?php
/**
 * WT Quick Reorder table hook functions.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Functions
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
* Output the reorder table top header content. 
*/

if ( ! function_exists( 'wt_reorder_table_top_header' ) ) {

	function wt_reorder_table_top_header() {
		wt_reorder_get_template( 'quick-reorder-table/wt-tb-top-header.php' );
	}

}

/** 
* Output the reorder table top filters content. 
*/

if ( ! function_exists( 'wt_reorder_table_top_filters' ) ) {

	function wt_reorder_table_top_filters() {
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-search-filter.php' );
	}
	
}

/**
* Output the reorder table add to cart content.
*/

if ( ! function_exists( 'wt_reorder_table_add_cart_wrap' ) ) {

	function wt_reorder_table_add_cart_wrap() {	
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-add-to-cart.php' );
	}
	
}

/** 
 * Output the reorder table notices.
 */

if ( ! function_exists( 'wt_reorder_table_notices' ) ) {

	function wt_reorder_table_notices() {
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-notices.php' );
	}

}

/**
*
* Output the reorder table column header content.
* 
*/

if ( ! function_exists( 'wt_reorder_table_column_header' ) ) {

	function wt_reorder_table_column_header() {
		wt_reorder_get_template( 'quick-reorder-table/wt-tb-column.php' );
	}

}

/**
* Output the reorder table start wrap content.
*/

if ( ! function_exists( 'wt_reorder_table_start_wrap' ) ) {

	function wt_reorder_table_start_wrap() {
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-table-start.php' );
	}

}

/**
* Output the reorder table body content.
*/

if ( ! function_exists( 'wt_reorder_table_body_content' ) ) {

	function wt_reorder_table_body_content() {
		wt_reorder_get_template( 'quick-reorder-table/wt-tb-body.php' );
	}

}

/**
* Output the reorder table body subrow start wrap content.
*/

if ( !function_exists('wt_reorder_subrow_start_wrap') ) {

	function wt_reorder_subrow_start_wrap() {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/wt-tb-subtable-start.php' );
	}

}

/**
* Output the reorder table body subrow body content. 
*/

if ( !function_exists('wt_reorder_subrow_body') ) {

	function wt_reorder_subrow_body() {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/wt-tb-subtable-body.php' );
	}

}

/**
* Output the reorder table body subrow product image. 
*/

if ( !function_exists('wt_reorder_subrow_product_image') ) {

	function wt_reorder_subrow_product_image( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-image.php' );
	}

}

/**
* Output the reorder table body subrow product image. 
*/

if ( !function_exists('wt_reorder_subrow_product_name') ) {

	function wt_reorder_subrow_product_name( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-name.php' );
	}

}

/**
* Output the reorder table body subrow product sku. 
*/

if ( !function_exists('wt_reorder_subrow_product_sku') ) {

	function wt_reorder_subrow_product_sku( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-sku.php' );
	}

}

/**
* Output the reorder table body subrow product sku. 
*/

if ( !function_exists('wt_reorder_subrow_product_variant') ) {

	function wt_reorder_subrow_product_variant( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-variant.php' );
	}

}

/**
* Output the reorder table body subrow product price. 
*/

if ( !function_exists('wt_reorder_subrow_product_price') ) {

	function wt_reorder_subrow_product_price( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-price.php' );
	}

}

/**
* Output the reorder table body subrow product previous qty. 
*/

if ( !function_exists('wt_reorder_subrow_product_previous_order') ) {

	function wt_reorder_subrow_product_previous_order( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-previous-qty.php', false, array( 'item' => $item, 'product' => $product ) );
	}

}

/**
* Output the reorder table body subrow product qty. 
*/

if ( !function_exists('wt_reorder_subrow_product_qty_box') ) {

	function wt_reorder_subrow_product_qty_box( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-qty.php' );
	}

}

/**
* Output the reorder table body subrow product checkbox. 
*/

if ( !function_exists('wt_reorder_subrow_product_order') ) {

	function wt_reorder_subrow_product_order( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-checkbox.php' );
	}

}

/**
* Output the reorder table body subrow product categories. 
*/

if ( !function_exists('wt_reorder_subrow_product_categories') ) {

	function wt_reorder_subrow_product_categories( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-categories.php' );
	}

}

/**
* Output the reorder table body subrow product categories. 
*/

if ( !function_exists('wt_reorder_subrow_product_tags') ) {

	function wt_reorder_subrow_product_tags( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-tags.php' );
	}

}

/**
* Output the reorder table body subrow product specifications. 
*/

if ( !function_exists('wt_reorder_subrow_product_specifications') ) {

	function wt_reorder_subrow_product_specifications( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-specifications.php' );
	}

}

/**
* Output the reorder table body subrow product description. 
*/

if ( !function_exists('wt_reorder_subrow_product_description') ) {

	function wt_reorder_subrow_product_description( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-description.php' );
	}

}

/**
* Output the reorder table body subrow product stock status. 
*/

if ( !function_exists('wt_reorder_subrow_product_stock_status') ) {

	function wt_reorder_subrow_product_stock_status( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-stock-status.php' );
	}

}

/**
* Output the reorder table body subrow product stock status. 
*/

if ( !function_exists('wt_reorder_subrow_product_stock_quantity') ) {

	function wt_reorder_subrow_product_stock_quantity( $product, $item ) {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-stock-quantity.php' );
	}

}

/**
* Output the reorder table body subrow product not exist content.
*/

if ( ! function_exists( 'wt_reorder_subrow_product_not_exist_content' ) ) {

	function wt_reorder_subrow_product_not_exist_content() {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/product/wt-tb-subtable-product-not-exist.php' );
	}
}

/**
* Output the reorder table body subrow end wrap content.
*/

if ( !function_exists('wt_reorder_subrow_end_wrap') ) {

	function wt_reorder_subrow_end_wrap() {
		wt_reorder_get_template( 'quick-reorder-table/quick-reorder-subtable/wt-tb-subtable-end.php' );
	}

}

/**
* Output the reorder table end wrap content.
*/

if ( ! function_exists( 'wt_reorder_table_end_wrap' ) ) {

	function wt_reorder_table_end_wrap() {
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-table-end.php' );
	}

}

/**
* Output the reorder table pagination content.
*/

if ( ! function_exists( 'wt_reorder_table_pagination' ) ) {

	function wt_reorder_table_pagination() {
		wt_reorder_get_template( 'quick-reorder-table/global/wt-tb-pagination.php' );
	}

}

/**
* Output the reorder table data not found wrap content.
*/

if ( ! function_exists( 'wt_reorder_table_data_not_found_content' ) ) {

	function wt_reorder_table_data_not_found_content() {
		wt_reorder_get_template( 'quick-reorder-table/wt-tb-data-not-found.php' );
	}

}

/**
* Output the reorder table user logout content.
*/

if ( ! function_exists( 'wt_reorder_table_user_logout_content' ) ) {
	
	function wt_reorder_table_user_logout_content() {
		wt_reorder_get_template( 'quick-reorder-table/wt-tb-user-logout.php' );
	}

}

/**
* Output the reorder table qty input box add plus icon
*/
add_action( 'woocommerce_after_quantity_input_field', 'wt_quick_order_display_quantity_plus' );

function wt_quick_order_display_quantity_plus() {
	echo '<button type="button" class="wt-plus">+</button>';
}

/**
* Output the reorder table qty input box add minus icon
*/
add_action( 'woocommerce_before_quantity_input_field', 'wt_quick_order_display_quantity_minus' );

function wt_quick_order_display_quantity_minus() {
	echo '<button type="button" class="wt-minus">-</button>';
}