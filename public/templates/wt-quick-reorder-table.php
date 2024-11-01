<?php
/**
 * The Template for displaying reorder table data.
 *
 * @package    WT_Quick_Reorder
 * @subpackage WT_Quick_Reorder\Templates
 * @author     Webby Template <support@webbytemplate.com>
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly  

/**
 * wt_reorder_table_before_content hook.		 
 */
do_action( 'wt_reorder_table_before_content' );

if( is_user_logged_in()  ){ ?>

	<div class="reorder-list-main">		
    	<?php
    	/**
    	* @hooked wt_reorder_table_top_header - 10    	
    	* @hooked wt_reorder_table_notices - 20
    	* @hooked wt_reorder_table_start_wrap - 30
    	* @hooked wt_reorder_table_column_header - 40
    	* @hooked wt_reorder_table_body_content - 50
		* @hooked wt_reorder_table_end_wrap - 60
		* @hooked wt_reorder_table_pagination - 70
		*/
		do_action( 'wt_reorder_table_content' );
		?>
	</div>
	<?php 	

}else{
	/**
	* wt_reorder_table_logout_content hook.
	*/
	do_action( 'wt_reorder_table_logout_content' );
}
/**
 * wt_reorder_table_after_content hook.		 
 */
do_action( 'wt_reorder_table_after_content' );