<?php
/**
 * Displays the post entry date
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-post
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! matjar_get_loop_prop( 'post-date' ) ) return;
?>

<div class="entry-date">	
	
	<?php echo sprintf('<span class="date-day">%1$s</span>%2$s',
		esc_html( get_the_time('d') ),
		esc_html( get_the_time('M') )
	);?>
		
</div>