<?php
/**
 * Template part for displaying page layout
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @package matjar
 * @since 1.0
 */

do_action( 'matjar_before_page_entry' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php	
	/**
	 * matjar_page_content hook.
	 *		 
	 * @hooked matjar_template_page_content - 10
	 */
	do_action( 'matjar_page_content' );
	?>	
</article><!-- #post-## -->

<?php
/**
 * matjar_after_page_entry hook.
 * 
 * @hooked matjar_template_page_comments - 10
 */
do_action( 'matjar_after_page_entry' ); 
