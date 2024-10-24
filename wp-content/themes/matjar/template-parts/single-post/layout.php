<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-post
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$classes[] = 'single-post-page';
$classes[] = ( matjar_get_option( 'post-meta', 1 ) ) ? matjar_get_option( 'post-meta-separator', 'meta-separator-colon' ) : '';
$classes[] = ( matjar_get_option( 'post-meta', 1 ) && matjar_get_option( 'post-meta-icon', 1) ) ? 'post-meta-icon' : 'post-meta-label';
$classes[] = ( matjar_get_option( 'single-post-thumbnail', 1 ) && matjar_has_post_thumbnail() ) ? 'has-post-thumbnail' : 'no-post-thumbnail';
$classes[] = ( is_sticky() ) ? 'sticky' : '';
?>

<?php do_action( 'matjar_before_single_post_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php
	/**
	 * matjar_single_post_entry_top hook.
	 *
	 * @hooked matjar_post_wrapper - 10	 
	 */
	do_action( 'matjar_single_post_entry_top' );
	?>
	
	<div class="entry-thumbnail-wrapper">
		<?php 
		/**
		 * matjar_single_post_thumbnail hook.
		 *
		 * @hooked matjar_template_single_post_thumbnail - 10
		 * @hooked matjar_template_single_post_highlight - 20
		 */
		do_action( 'matjar_single_post_thumbnail' );
		?>
	</div>
	
	<div class="entry-content-wrapper">
		<?php	
		/**
		 * matjar_single_post_content hook.
		 *
		 * @hooked matjar_single_post_header - 10
		 * @hooked matjar_single_post_content - 20
		 */
		do_action( 'matjar_single_post_content' );
		?>
	</div>
	
	<?php	
	/**
	 * matjar_single_post_entry_bottom hook.
	 *
	 * @hooked matjar_post_wrapper_end - 10
	 */
	do_action( 'matjar_single_post_entry_bottom' );
	?>
		
</article>

<?php
/**
 * matjar_after_single_post_entry hook.
 * 
 * @hooked matjar_template_single_post_author_bios - 10
 * @hooked matjar_template_single_social_share - 20
 * @hooked matjar_template_single_post_navigation - 30
 * @hooked matjar_template_single_related - 40
 * @hooked matjar_template_single_post_comments - 50
 */
do_action( 'matjar_after_single_post_entry' ); 