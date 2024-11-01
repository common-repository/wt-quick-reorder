<?php
/**
 * Plugin Name:       WT Quick Reorder
 * Plugin URI:        https://woo-reorder.webbytemplate.com/
 * Description:       A fully featured wt quick reorder plugin that allows to reorder your product that you have ordered previously.It's easy to find your product for reorder.
 * Version:           1.0.0
 * Author:            webbytemplate
 * Author URI:        https://webbytemplate.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wt-quick-reorder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin name ,version.
 */
define( 'WT_QUICK_REORDER_VERSION', '1.0.0' );
define( 'WT_QUICK_REORDER_NAME', 'wt-quick-reorder' );
define( 'WT_QUICK_REORDER_PLUGIN_FILE', __FILE__ );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-activator.php
 */
function wt_quick_reorder_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
	WT_Quick_Reorder_Activator::activate();
}

register_activation_hook( __FILE__, 'wt_quick_reorder_activate' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 */
function wt_quick_reorder_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-deactivator.php';
	WT_Quick_Reorder_Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'wt_quick_reorder_deactivate' );

/**
 * The code load core packages, admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/packages.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function wt_quick_reorder_install() {

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $plugin = new WT_Quick_Reorder();
    } else {
        if( is_admin() ) {
            wt_quick_reorder_woocommerce_activation_notice();
        }
    }
}

/**
 * Show notice message on admin plugin page.
 *
 * Callback function for admin_notices(action).
 *
 * @since  1.0.0
 * @access public
 */
function wt_quick_reorder_woocommerce_activation_notice() {
    ?>
    <div class="error">
        <p>
            <?php echo '<strong> WT Quick Reorder </strong> requires <a target="_blank" href="https://wordpress.org/plugins/woocommerce/">Woocommerce</a> to be installed & activated!' ; ?>
        </p>
    </div>
    <?php
}

wt_quick_reorder_install();