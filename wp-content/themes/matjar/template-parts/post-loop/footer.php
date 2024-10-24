<?php
/**
 * Displays the post entry footer
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

<div class="entry-footer">
	<?php 
	/**
	 * matjar_loop_post_footer hook.
	 *
	 * @hooked matjar_read_more_link - 10
	 */
	do_action( 'matjar_loop_post_footer' );
	?>
</div>