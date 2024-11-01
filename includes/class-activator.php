<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder/includes
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

class WT_Quick_Reorder_Activator {	

	/**
	 * Activation code here
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            $admin_quick_reorder = new WT_Quick_Reorder_Admin( WT_QUICK_REORDER_NAME, WT_QUICK_REORDER_VERSION );
            $admin_quick_reorder->reset_plugin_data( false );
        }
        
    }

}