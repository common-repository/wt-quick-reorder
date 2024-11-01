<?php
/**
 * The Template for displaying reorder table product categories.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-categories">
    <?php    
    if( !empty( $wt_quick_product ) ) {
        $categories = get_the_terms($wt_quick_product->get_id(), 'product_cat');
        if(  $categories  ) {
            ?>
            <ul>
                <?php
                foreach( $categories as $category ) {
                 $cat_id = $category->term_id;
                 $term_link = get_term_link( $cat_id );
                 ?>
                 <li>
                    <a href="<?php echo esc_url( $term_link ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                </li>
                <?php 
            }
            ?>
        </ul>
    <?php }
}
?>
</td>