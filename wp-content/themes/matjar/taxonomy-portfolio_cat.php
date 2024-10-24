<?php
/**
 * Template part for displaying category archive portfolio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */

get_header(); ?>

<?php if( ! matjar_has_elementor_template( 'archive' ) ) :
	/**
	 * Hook: matjar_before_main_content.
	 *
	 * @hooked matjar_output_content_wrapper - 10 (outputs opening divs for the content area)
	 */
	do_action( 'matjar_before_main_content' );

	if ( have_posts() ) :

		/**
		 * Hook: matjar_before_portfolio_loop.
		 *
		 * @hooked matjar_portfolio_filter - 10
		 */
		do_action( 'matjar_before_portfolio_loop' );
		
		matjar_portfolio_loop_start();
		
		while ( have_posts() ) :
			the_post();	
			
			// Include the portfolio loop content template.
			get_template_part( 'template-parts/portfolio-loop/layout', get_post_format() );

		endwhile;
		
		matjar_portfolio_loop_end();
		
		/**
		 * Hook: matjar_after_portfolio_loop.
		 *
		 * @hooked matjar_portfolio_pagination - 10
		 */
		do_action( 'matjar_after_portfolio_loop' );

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;

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