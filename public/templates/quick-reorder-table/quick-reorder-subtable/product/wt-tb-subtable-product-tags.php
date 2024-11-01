<?php
/**
 * The Template for displaying reorder table product tags.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

global $wt_quick_product;
?>
<td class="product-tags">
    <?php 
    if ( !empty($wt_quick_product) ) {
        $terms = wp_get_post_terms( $wt_quick_product->get_id(), 'product_tag' );
        if( count($terms) > 0 ) { ?>
            <ul>
               <?php 
               foreach($terms as $term){ 
                $term_name = $term->name; 
                $term_link = get_term_link( $term, 'product_tag' ); ?>
                <li>
                    <a href="<?php echo esc_url($term_link); ?>">
                        <?php echo esc_html($term_name); ?>
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