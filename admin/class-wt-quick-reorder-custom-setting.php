<?php
/**
 * The navs & panels array for setting page.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder/admin
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

class WT_Quick_Reorder_Custom_Settings {

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version           The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

     $this->plugin_name = $plugin_name;
     $this->version = $version;

     add_filter( "wt_quick_reorder_settings_nav", array( $this, "add_wt_quick_reorder_plugin_nav" ), 10, 1 );
     add_filter( "wt_quick_reorder_settings_panel", array( $this, "add_wt_quick_reorder_plugin_panel" ), 10, 1 );

     add_action( "wt_enqueue_add_extra_styles_before", array( $this, "add_custom_extra_styles_before_default_styles") ); 
     add_action( "wt_enqueue_add_extra_styles_after", array( $this, "add_custom_extra_styles_after_default_styles") ); 

     add_action( "wt_enqueue_add_extra_scripts_before", array( $this, "add_custom_extra_scripts_before_default_scripts") ); 
     add_action( "wt_enqueue_add_extra_scripts_after", array( $this, "add_custom_extra_scripts_after_default_scripts") );

 }

    /**
    * This function is return navs array.
    *
    * @since    1.0.0
    * @access   public
    */
    public function add_wt_quick_reorder_plugin_nav( $navs ) {

      $navs = array(
        'general' => array(
          'title' => __( 'Settings', 'wt-quick-reorder' ),
          'icon' => 'fa-cogs',
          'action' => true
      ),
        'order_table' => array(
          'title' => __( 'Quick Reorder Table', 'wt-quick-reorder' ),
          'icon' => 'fa-solid fa-cart-shopping',
          'action' => true
      ),
        'shortcode' => array(
          'title' => __( 'Shortcode', 'wt-quick-reorder' ),
          'icon' => 'fa-solid fa-code',
          'action' => false
      ),
    );

      return $navs;
  }

    /**
     * This function is return panels array.
     *
     * @since    1.0.0
     * @access   public
     */
    public function add_wt_quick_reorder_plugin_panel( $panels ) {

        $panels['general'] = array(
            'section' => array(
                array(
                    'title' => __( 'General', 'wt-quick-reorder' ),
                    'icon' => 'fa-solid fa-gear',
                    'desc' => '',
                    'fields' => array(
                        array(
                            'type' => 'switch',
                            'name' => 'wt_quick_reorder_facility',
                            'title' => __( 'Enable WT Quick Reorder Facility?', 'wt-quick-reorder' ),
                            'desc' => '',
                            'field_desc' => '',
                            'default' => 'yes'
                        ),
                        array(
                            'type' => 'switch',
                            'name' => 'tab_on_my_account',
                            'title' => __( 'Enable Tab On My Account?', 'wt-quick-reorder' ),
                            'desc' => '',
                            'field_desc' => '',
                            'default' => 'yes'
                        ),
                    )
                )
            )
        );

        $panels['order_table'] = array(
            'section' => array(
                array(
                    'title' => __( 'Setting', 'wt-quick-reorder' ),
                    'icon' => 'fa-solid fa-gear',
                    'desc' => '',
                    'fields' => array(
                        array(
                            'type' => 'switch',
                            'name' => 'show_filter',
                            'title' => __( 'Show Filter', 'wt-quick-reorder' ),
                            'desc' => '',
                            'field_desc' => '',
                            'default' => 'yes'
                        ),
                        array(
                            'type' => 'sortable',
                            'title' => __( 'Show Column', 'wt-quick-reorder' ),
                            'desc' => '',
                            'id' => 'show_column',
                            'field_desc' => '',
                            'connected_class' => 'connectedClass',
                            'sortable_type' => 'connected_list',
                            'fields_title' => __( 'Inactive', 'wt-quick-reorder' ),
                            'default_title' => __( 'Active', 'wt-quick-reorder' ),
                            'sortable_list' => array(
                                'fields' => array(
                                    'image' => __('Image', 'wt-quick-reorder' ),
                                    'name' => __('Name','wt-quick-reorder' ),
                                    'sku' => __('SKU', 'wt-quick-reorder' ),
                                    'variant' => __('Variant', 'wt-quick-reorder' ),
                                    'price' => __('Price', 'wt-quick-reorder' ),
                                    'previous_order' => __('Previous Order', 'wt-quick-reorder' ),
                                    'qty_box' => __('Qty Box', 'wt-quick-reorder' ),
                                    'order' => __('Order', 'wt-quick-reorder' ),
                                    'categories' => __('Categories', 'wt-quick-reorder' ),
                                    'tags' => __('Tags', 'wt-quick-reorder' ),
                                    'specifications' => __('Specifications', 'wt-quick-reorder' ),
                                    'description' => __('Description','wt-quick-reorder' ),
                                    'stock_status' => __('Stock Status','wt-quick-reorder' ),
                                    'stock_quantity' => __('Stock Quantity', 'wt-quick-reorder' )
                                ),
                                'default' => array(
                                    'image' => __('Image', 'wt-quick-reorder' ),
                                    'name' => __('Name', 'wt-quick-reorder' ),
                                    'sku' => __( 'SKU', 'wt-quick-reorder' ),
                                    'variant' => __( 'Variant', 'wt-quick-reorder' ),
                                    'price' => __( 'Price', 'wt-quick-reorder' ),
                                    'previous_order' => __( 'Previous Order', 'wt-quick-reorder' ),
                                    'qty_box' => __( 'Qty Box', 'wt-quick-reorder' ),
                                    'order' => __( 'Order', 'wt-quick-reorder' )
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'title' => __( 'Pagination', 'wt-quick-reorder' ),
                            'name' => 'pagination',
                            'options' => array(
                                'number' => __( 'Number', 'wt-quick-reorder' ),
                                'load_more' => __( 'Load More', 'wt-quick-reorder' )
                            ),
                            'default' => 'number'
                        ),
                        array(
                            'type' => 'number',
                            'name' => 'order_per_page',
                            'title' => __( 'Order Per Page', 'wt-quick-reorder' ),
                            'desc' => '',
                            'default' => 10,
                            'placeholder' => __( 'Enter Order Per Page Value', 'wt-quick-reorder' ),
                            'min' => 1
                        ),
                        array(
                            'type' => 'select',
                            'title' => __( 'Order', 'wt-quick-reorder' ),
                            'name' => 'order',
                            'options' => array(
                                'asc' => __( 'ASC', 'wt-quick-reorder' ),
                                'desc' => __( 'DESC', 'wt-quick-reorder' )
                            ),
                            'default' => 'asc'
                        ),
                        array(
                            'type' => 'select',
                            'title' => __( 'Order By', 'wt-quick-reorder' ),
                            'name' => 'order_by',
                            'options' => array(
                                'date' => __( 'Date', 'wt-quick-reorder' ),
                                'name' => __( 'Name', 'wt-quick-reorder' ),
                                'id' => __( 'ID', 'wt-quick-reorder' )
                            ),
                            'default' => 'date'
                        ),
                    )
)
)
);

$panels['shortcode'] = array(
    'section' => array(
        array(
            'title' => __( 'Shortcode', 'wt-quick-reorder' ),
            'icon' => 'fa-solid fa-code',
            'desc' => '',
            'fields' => array(
              array(
                'name' => 'quick_reorder_shortcode',
                'type' => 'text',
                'title' => __( 'Shortcode', 'wt-quick-reorder' ),
                'desc' => '',
                'field_desc' => '',
                'default' => '[wt_quick_reorder_table]',
                'readonly' => true,
                'icon' => 'fa-solid fa-clone',
            ),
          )
        )
    )
);

return $panels;

}

    /**
     * This function is for add custom extra styles before default styles.
     *
     * @since    1.0.0
     * @access   public
     */
    public function add_custom_extra_styles_before_default_styles() {

    }


    /**
     * This function is for add custom extra styles after default styles.
     *
     * @since    1.0.0
     * @access   public
     */
    public function add_custom_extra_styles_after_default_styles() {

    }


    /**
     * This function is for add custom extra scripts before default scripts.
     *
     * @since    1.0.0
     * @access   public
     */
    public function add_custom_extra_scripts_before_default_scripts() {

    }


    /**
     * This function is for add custom extra scripts after default scripts.
     *
     * @since    1.0.0
     * @access   public
     */
    public function add_custom_extra_scripts_after_default_scripts() {

    }

}