<?php
/**
* This function return a value of admin setting by name.
*
* @return string
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

function wt_quick_reorder_get_field( $name, $tab ){

	$option_name = str_replace('-', '_',  'wt-quick-reorder' ) .'_'.$tab;
	$option = get_option($option_name);

	if( $option ){
		if( isset( $option[$name] ) && !empty( $option[$name] ) ){
			return str_replace("\'", "'", $option[$name]);
		}
	}
	return '';
}

/**
* This function return template name.
*
* @return string
*/

function wt_reorder_get_template( $template_name, $load_once = false, $args = array() ){
	$public_url_path = '';
	if( dirname( __FILE__ ) ){
		$public_url = explode('public', dirname( __FILE__ ));
	}
	$public_url_path = isset($public_url[0]) ? $public_url[0] : '';
	load_template( $public_url_path . 'public/templates/'.$template_name, $load_once, $args );
}

/**
* This function return activated Field.
*
* @return string
*/

function wt_quick_reorder_get_field_activated(){
	$wt_quick_field = array();
	$quick_activated_field = wt_quick_reorder_get_field_active();
	$quick_all_field = wt_quick_reorder_get_field_all();
	if( $quick_all_field ){
		if( is_array( $quick_all_field ) ){
			foreach( $quick_all_field as $key => $field_value ) {
				if( in_array( $key, $quick_activated_field ) ){
					$wt_quick_field[$key] = $field_value;
				}
			}
			return $wt_quick_field;
		}
	}
	return '';
}

/**
* This function return activated Field.
*
* @return string
*/

function wt_quick_reorder_get_field_active(){

	$wt_columns = wt_quick_reorder_get_field( 'show_column','order_table' );
	if( $wt_columns ){
		$wt_column = json_decode(  $wt_columns );		
		if(  $wt_column ){
			return $wt_column->slug;
		}
	}
	return '';
}

/**
* This function return all Field.
*
* @return string
*/

function wt_quick_reorder_get_field_all(){

	$wt_all_categries = array();
	$wt_columns = wt_quick_reorder_get_field('show_column','order_table');
	if( $wt_columns ){
		$wt_column = json_decode( $wt_columns );
		if(  $wt_column ){
			foreach ($wt_column->values as $key => $value) {
				$wt_all_columns[$key] = $value;
			}
			return $wt_all_columns;
		}
	}
	return '';
}