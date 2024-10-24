<?php
/**
 * Displays the post entry header
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/post-loop
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<header class="entry-header">

	<?php
	/**
	 * Hook: matjar_loop_post_header.
	 *
	 * @hooked matjar_template_loop_post_fancy_date - 10
	 * @hooked matjar_template_loop_post_title - 20
	 * @hooked matjar_template_loop_post_meta - 30
	 */
	do_action( 'matjar_loop_post_header' );
	?>
	
</header><!-- .entry-header -->