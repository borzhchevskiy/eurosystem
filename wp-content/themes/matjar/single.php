<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */
get_header(); ?>

<?php if( ! matjar_has_elementor_template( 'single' ) ) :
	/**
	 * Hook: matjar_before_main_content.
	 *
	 * @hooked matjar_output_content_wrapper - 10 (outputs opening divs for the content area)
	 */
	do_action( 'matjar_before_main_content' );


	do_action( 'matjar_before_single_post_loop' ); 
			
	/* Start the Loop */
	while ( have_posts() ) : the_post();
			
		// Include the post content template.
		get_template_part( 'template-parts/single-post/layout', get_post_format() );	

	endwhile; // End of the loop.		
			
	do_action( 'matjar_after_single_post_loop' ); 

	/**
	 * Hook: matjar_after_main_content.
	 *
	 * @hooked matjar_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'matjar_after_main_content' );

	/**
	 * Hook: matjar_sidebar.
	 *
	 * @hooked matjar_get_sidebar - 10
	 */
	do_action( 'matjar_sidebar' );
endif; ?>

<?php get_footer();