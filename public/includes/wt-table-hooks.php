<?php
/**
 * WT Quick Reorder Table Hooks
 *
 * Action/filter hooks used for WT Quick Reorder functions/templates.
 *
 * @package WT_Quick_Reorder
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
* table content.
*
* @see wt_reorder_table_top_header() 
*/

add_action( 'wt_reorder_table_content', 'wt_reorder_table_top_header', 10 );

/**
* table top header content.
*
* @see wt_reorder_table_top_filters() 
* @see wt_reorder_table_add_cart_wrap()
*/

add_action( 'wt_reorder_table_top_header_content', 'wt_reorder_table_top_filters', 10 );
add_action( 'wt_reorder_table_top_header_content', 'wt_reorder_table_add_cart_wrap', 20 );


/**
* table content.
*
* @see wt_reorder_table_notices() 
*/

add_action( 'wt_reorder_table_content', 'wt_reorder_table_notices', 20 );

/**
* table content.
*
* @see wt_reorder_table_start_wrap() 
*/

add_action( 'wt_reorder_table_content','wt_reorder_table_start_wrap', 30 );

/**
* table content.
*
* @see wt_reorder_table_column_header() 
*/

add_action( 'wt_reorder_table_content','wt_reorder_table_column_header', 40 );


/**
* table body content.
*
* @see wt_reorder_table_body_content() 
*/

add_action( 'wt_reorder_table_content','wt_reorder_table_body_content', 50 );

/**
* table body subrow content.
*
* @see wt_reorder_subrow_start_wrap() 
* @see wt_reorder_subrow_body()
* @see wt_reorder_subrow_end_wrap() 
*/

add_action( 'wt_reorder_subrow_content','wt_reorder_subrow_start_wrap', 10 );
add_action( 'wt_reorder_subrow_content','wt_reorder_subrow_body', 20 );
add_action( 'wt_reorder_subrow_content','wt_reorder_subrow_end_wrap', 30 );

/**
* table data subrow empty content.
*
* @see wt_reorder_subrow_product_not_exist_content() 
*/

add_action('wt_reorder_subrow_empty_content', 'wt_reorder_subrow_product_not_exist_content' );

/**
* table content.
*
* @see wt_reorder_table_end_wrap() 
*/

add_action( 'wt_reorder_table_content','wt_reorder_table_end_wrap', 60 );

/**
* table content.
*
* @see wt_reorder_table_pagination()
*/

add_action( 'wt_reorder_table_content','wt_reorder_table_pagination', 70 );

/**
* table logout content.
*
* @see wt_reorder_table_user_logout_content() 
*/

add_action( 'wt_reorder_table_logout_content' , 'wt_reorder_table_user_logout_content' );

/**
* table data empty content.
*
* @see wt_reorder_table_data_not_found_content() 
*/

add_action('wt_reorder_table_data_empty_content', 'wt_reorder_table_data_not_found_content' );


$wt_quick_reorder_get_field_activated = wt_quick_reorder_get_field_activated();

if( $wt_quick_reorder_get_field_activated ){
    $action_index = 10;
    foreach ( $wt_quick_reorder_get_field_activated as $key => $field_value) {
        add_action( 'wt_reorder_subrow_body_content', 'wt_reorder_subrow_product_'.esc_attr($key), $action_index, 2 );        
        $action_index += 10;
    }

}