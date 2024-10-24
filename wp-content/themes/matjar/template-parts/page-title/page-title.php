<?php
/**
 * Template part for displaying page title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/page-title
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div id="page-title" class="page-title <?php echo esc_attr($class);?>" <?php echo !empty($custom_css) ? 'style="'.esc_attr($custom_css).'"':''?>>			
	<div class="container">
		<div class="row">
			<div class="col">
				<?php
				/**
				 * Hook: matjar_inner_page_title.
				 *
				 * @hooked matjar_template_page_title- 10
				 * @hooked matjar_template_breadcrumbs- 20
				 */
				do_action( 'matjar_inner_page_title' );
				?>				
			</div>
		</div>
	</div>
</div><!-- .page-title -->