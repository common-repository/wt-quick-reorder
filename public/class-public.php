<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder/public
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

class WT_Quick_Reorder_Public {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'after_setup_theme', array( $this, 'include_template_functions'), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_shortcode( 'wt_quick_reorder_table', array( $this ,'quick_reorder_table_data') );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'wt-font-awesome', plugin_dir_url( __DIR__ ) . '/admin/css/all.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$tab = 'general';			
		wp_enqueue_script( 'wt-font-awesome', plugin_dir_url( __DIR__ ) . '/admin/js/all.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wt-quick-reorder-public.js', array( 'jquery' ), time(), false );		
		wp_localize_script( $this->plugin_name, 'wqrAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce('wqr_form_save') ) );
	}


   /**
	* Function used to include template functions.
	*
	* @since    1.0.0
	*/

	public function include_template_functions() {
		include_once('includes/wt-quick-global-functions.php'); 
		include_once('includes/wt-table-hooks.php');
		include_once('includes/wt-table-hook-functions.php');
		include_once('includes/wt-table-column-functions.php');
		include_once('includes/wt-ajax-function.php');
		include_once('includes/wt-myaccount-tab-functions.php');

	}

	/**
	* Register the shortcode for the public area.
	*
	* @since    1.0.0
	*/

	public function quick_reorder_table_data() { 

		$check_enable = wt_quick_reorder_get_field('wt_quick_reorder_facility','general');
		if( $check_enable == 'no' ){
			return false;
		}else{
			wt_reorder_get_template('wt-quick-reorder-table.php' );
		}
	}

}