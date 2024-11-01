<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder/public
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

class WT_Quick_Reorder_Tab {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0 
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    		The version of this plugin.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'wt_add_quick_reorder_endpoint' ) );
		add_filter( 'query_vars', array( $this, 'wt_quick_reorder_query_vars' ), 0 );

		add_filter( 'woocommerce_account_menu_items', array( $this, 'wt_quick_add_new_item_tab' ), 10, 1 );
		add_action( 'woocommerce_account_quick-reorder_endpoint', array( $this, 'wt_quick_reorder_content' ) );
	}

	
	/**
	* Rewrite endpoint of custom my account tab.
	*
	* @since    1.0.0
	*/

	public function wt_add_quick_reorder_endpoint() {
		add_rewrite_endpoint( 'quick-reorder', EP_ROOT | EP_PAGES );
	}


	/**
	* Add query vars of custom my account tab.
	*
	* @since    1.0.0
	*/

	public function wt_quick_reorder_query_vars( $vars ) {
		$vars[] = 'quick-reorder';
		return $vars;
	}


	/**
	* Add new custom tab in my account tab.
	*
	* @since    1.0.0
	*/

	public function wt_quick_add_new_item_tab( $items ) {
		$items = array_slice( $items, 0, 5, true ) 
		+ array( 'quick-reorder' => __( 'Quick Reorder','wt-quick-reorder' ) )
		+ array_slice( $items, 5, NULL, true );
		return $items;
	}


	/**
	* Add content in new custom tab in my account tab.
	*
	* @since    1.0.0
	*/

	public function wt_quick_reorder_content() {
		echo do_shortcode('[wt_quick_reorder_table]');
	}

}
$check_tab_enable = wt_quick_reorder_get_field( 'tab_on_my_account', 'general' );
if( $check_tab_enable == 'yes' ){
	$WT_Quick_Reorder_Tab = new WT_Quick_Reorder_Tab();
}