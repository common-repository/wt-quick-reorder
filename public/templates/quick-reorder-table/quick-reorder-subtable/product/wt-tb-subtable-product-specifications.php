<?php
/**
 * The Template for displaying reorder table product specifications.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-specifications">
    <div class="quick-reorder-specification-main">
        <div class="specification-main">
            <span class="wt-specifications-icon"><i class="fa fa-exclamation"></i></span>
        </div>
        <div class="quick-reorder-specification-content">
         <ul class="dimensions">
           <?php
           $dimensions_flag = 0;
           if( !empty($wt_quick_product) ) {
            $dimensions = $wt_quick_product->get_dimensions( false );
            if ( ! empty( $dimensions ) ) { 
                if( $wt_quick_product->get_height() ) { 
                    $dimensions_flag = 1;
                    ?>
                    <li>
                        <b>Height:</b>
                        <?php echo esc_html( $wt_quick_product->get_height() . get_option( 'woocommerce_dimension_unit' ) ); ?>
                    </li>
                <?php }
                if( $wt_quick_product->get_width() ) { 
                    $dimensions_flag = 1;
                    ?>
                    <li>
                        <b>Width:</b>
                        <?php echo esc_html( $wt_quick_product->get_width() . get_option( 'woocommerce_dimension_unit' ) ); ?>
                    </li>
                <?php }
                if( $wt_quick_product->get_length() ) { 
                    $dimensions_flag = 1;
                    ?>
                    <li>
                        <b>Width:</b>
                        <?php echo esc_html( $wt_quick_product->get_length() . get_option( 'woocommerce_dimension_unit' ) ); ?>
                    </li>
                <?php } 
            } 
        }
        if( $dimensions_flag == 0 ){
            ?>
            <li><?php echo __( 'N/A', 'wt-quick-reorder' ); ?></li>
            <?php
        }
        ?>
    </ul>    
</div>
</div>
</td>