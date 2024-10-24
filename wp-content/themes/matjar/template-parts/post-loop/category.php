<?php
/**
 * Displays the post loop entry categories
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/post-loop
 * @since 1.0
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! matjar_get_loop_prop( 'post-category' ) ) return;
?>		
		
<div class="entry-category">	
	<span class="cat-links"><?php echo get_the_category_list( esc_html__( ', ', 'matjar' ) );?> </span>
</div>