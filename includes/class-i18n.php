<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder/includes
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

class WT_Quick_Reorder_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain( 'wt-quick-reorder', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );

	}

}