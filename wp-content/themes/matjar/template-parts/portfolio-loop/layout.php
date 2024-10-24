<?php
/**
 * Template part for displaying portfolio layout
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/portfolio
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( matjar_get_loop_prop( 'name' ) == 'related-portfolios' ) {
	$classes[] = 'portfolio-post-loop';
	$classes[] = 'related-portfolio';
}elseif( matjar_get_loop_prop( 'name' ) == 'portfolio-slider-widget' ) {
	$classes[] = 'portfolio-post-loop';
	$classes[] = 'portfolio-slider-widget';
}else{
	$classes[] = 'portfolio-post-loop';
	$classes[] = 'col-lg-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'portfolio-grid-columns' ) );
	$classes[] = 'col-md-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'portfolio-grid-columns-tablet' ) );
	$classes[] = 'col-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns-mobile' ) );
}
?>

<?php do_action( 'matjar_before_portfolio_loop_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ) ?> > 
	
	<?php
	/**
	 * matjar_portfolio_loop_entry_top hook.
	 *
	 * @hooked matjar_post_wrapper - 10
	 */
	do_action( 'matjar_portfolio_loop_entry_top' );
	?>
	
	<div class="entry-thumbnail-wrapper">
		<?php 
		/**
		 * matjar_portfolio_loop_thumbnail hook.
		 *
		 * @hooked matjar_template_portfolio_loop_thumbnail - 10
		 * @hooked matjar_template_portfolio_loop_action_icon - 20
		 */
		do_action( 'matjar_portfolio_loop_thumbnail' );
		?>
	</div>
	
	<div class="entry-content-wrapper">
		<?php	
		/**
		 * matjar_portfolio_loop_content hook.
		 *
		 * @hooked matjar_portfolio_loop_header 	- 10
		 * @hooked matjar_portfolio_loop_content - 20
		 * @hooked matjar_portfolio_loop_footer 	- 30
		 */
		do_action( 'matjar_portfolio_loop_content' );
		?>
	</div>
	
	<?php	
	/**
	 * matjar_portfolio_loop_entry_bottom hook.
	 *
	 * @hooked matjar_post_wrapper_end - 10
	 */
	do_action( 'matjar_portfolio_loop_entry_bottom' );
	?>
		
</article>

<?php
do_action( 'matjar_after_portfolio_loop_entry' );