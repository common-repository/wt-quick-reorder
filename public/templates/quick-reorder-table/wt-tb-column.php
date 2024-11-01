<?php
/**
 * The Template for displaying reorder table column content.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

$wt_quick_reorder_get_field_activated = wt_quick_reorder_get_field_activated();

?>
<thead>
    <tr class="reorder-table-row">
        <th class="reorder-table-col order_date" value="order_date">
            <?php echo esc_html( __( 'Order Date', 'wt-quick-reorder' ) ); ?>
        </th>
        <th class="reorder-table-col order_id" value="order_id">
            <?php echo esc_html( __( 'Order ID', 'wt-quick-reorder' ) ); ?>
        </th>
        <th class="reorder-table-col order_col_table">
            <?php
            if( $wt_quick_reorder_get_field_activated ) { 
                ?>
                <table width="100%">
                    <tr>
                        <?php
                        foreach ( $wt_quick_reorder_get_field_activated as $key => $field_value ) { ?>
                            <th class="reorder-table-col <?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>">
                                <?php echo esc_html( $field_value ); ?>
                            </th>
                        <?php }
                        ?>
                    </tr>
                </table>
                <?php
            }else{
                echo esc_html( __( 'Info', 'wt-quick-reorder' ) );
            }
            ?>
        </th>
    </tr>
</thead>