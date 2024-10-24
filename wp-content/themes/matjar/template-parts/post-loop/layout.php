<?php
/**
 * Template part for displaying posts layout
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/post-loop
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$blog_post_style	= matjar_get_loop_prop( 'blog-post-style' );	
if( matjar_get_loop_prop( 'name' ) == 'related-posts' ) {
	$classes[] 	= 'related-post';
}else{
	$classes[]  = 'blog-post-loop';
}
$classes[] = ( ! matjar_get_loop_prop( 'blog-post-thumbnail' ) ) ? 'no-post-thumbnail' : '';
if( matjar_get_loop_prop( 'name' ) == 'posts-loop-shortcode' ){
	if( $blog_post_style == 'blog-grid' ){
		$classes[] = 'col-lg-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns' ) );
		$classes[] = 'col-md-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns-tablet' ) );
		$classes[] = 'col-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns-mobile' ) );
	}				
}elseif( $blog_post_style == 'blog-grid' && ! is_single() ){
	if( matjar_get_loop_prop( 'name' ) != 'posts-slider-shortcode' ){
		$classes[] = 'col-lg-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns' ) );
		$classes[] = 'col-md-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns-tablet' ) );
		$classes[] = 'col-' .matjar_get_rs_grid_columns( matjar_get_loop_prop( 'blog-grid-columns-mobile' ) );
	}					
}
$classes[] = ( matjar_get_loop_prop( 'post-meta' ) ) ? matjar_get_loop_prop( 'post-meta-separator' ) : '';
$classes[] = ( matjar_get_loop_prop( 'post-meta' ) && matjar_get_loop_prop( 'post-meta-icon' ) ) ? 'post-meta-icon' : 'post-meta-label';
?>

<?php do_action( 'matjar_before_loop_post_entry' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	
	<?php
	/**
	 * matjar_loop_post_entry_top hook.
	 *
	 * @hooked matjar_post_wrapper - 10
	 */
	do_action( 'matjar_loop_post_entry_top' );
	?>
	
	<div class="entry-thumbnail-wrapper">
		<?php 
		/**
		 * matjar_loop_post_thumbnail hook.
		 *
		 * @hooked matjar_template_loop_post_highlight - 10
		 * @hooked matjar_template_loop_post_thumbnail - 20
		 */
		do_action( 'matjar_loop_post_thumbnail' );
		?>
	</div>
	
	<div class="entry-content-wrapper">
		<?php	
		/**
		 * matjar_loop_post_content hook.
		 *
		 * @hooked matjar_loop_post_header 	- 10
		 * @hooked matjar_loop_post_content 	- 20
		 * @hooked matjar_loop_post_footer 	- 30
		 */
		do_action( 'matjar_loop_post_content' );
		?>
	</div>
	
	<?php	
	/**
	 * matjar_loop_post_entry_bottom hook.
	 *
	 * @hooked matjar_post_wrapper_end - 10
	 */
	do_action( 'matjar_loop_post_entry_bottom' );
	?>
		
</article>

<?php
do_action( 'matjar_after_loop_post_entry' ); 