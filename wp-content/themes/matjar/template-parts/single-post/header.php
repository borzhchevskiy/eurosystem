<?php
/**
 * Displays the post entry header
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
?>

<header class="entry-header">

	<?php
	/**
	 * Hook: matjar_single_post_header.
	 *
	 * @hooked matjar_template_single_post_fancy_date - 10
	 * @hooked matjar_template_single_post_title - 20
	 * @hooked matjar_template_single_post_meta - 30
	 */
	do_action( 'matjar_single_post_header' );
	?>
	
</header><!-- .entry-header -->