<?php
/**
 * Template part for displaying footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/footer
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<footer id="footer" class="site-footer">	
	
	<?php do_action( 'matjar_footer_top' ); ?>
	
	<?php if( $site_footer ) { ?>
		<div class="footer-main footer-layout-<?php echo esc_attr( matjar_get_option( 'footer-layout', '2' ) );?>">
			<div class="container">
				<?php if( ! empty( $footer_layout_data ) ){ ?>
					<div class="row">
						<?php
						$collapse_class = matjar_get_option( 'footer-widget-collapse', 0 ) ? ' footer-widget-collapse' : '';
						foreach($footer_layout_data['class'] as $key => $classes){
							$count = $key + 1;
							?>
							<div class="footer-widget<?php echo esc_attr( $collapse_class ); ?> <?php echo esc_attr( $classes ); ?>">
								<?php dynamic_sidebar( 'footer-widget-area-' . $count ); ?>
							</div>
							<?php
						} ?>
					</div>
				<?php } ?>
			</div><!-- .container -->	
		</div><!-- .footer-main -->
	<?php }?>
	
	<?php
	/**
	 * Hook: matjar_footer_bottom.
	 *
	 * @hooked matjar_template_footer_copyright- 10
	 */
	do_action( 'matjar_footer_bottom' );
	?>		
	
</footer><!-- .site-footer -->