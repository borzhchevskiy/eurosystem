<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */

get_header();

if( ! matjar_has_elementor_template( 'single' ) ) :
	/**
	 * Hook: matjar_before_main_content.
	 *
	 * @hooked matjar_output_content_wrapper - 10 (outputs opening divs for the content area)
	 */
	do_action( 'matjar_before_main_content' );?>

			<div class="error-404 not-found">
				<?php if( matjar_get_option( '404-use-image-text', '404-text' ) == '404-text' ) { ?>
					<h1>404 <span><?php echo esc_html( matjar_get_option('404-page-title', 'Oops! That page can&rsquo;t be found.') ); ?><span></h1>
					<?php if( matjar_get_option( 'show-previous-link', 1 ) ) { ?>
						<p><?php echo esc_html( matjar_get_option( '404-page-tagline', 'Try using the button below to go to back previous page.' ) ); ?></p>
							<a class="button" href="<?php echo esc_url( wp_get_referer() );?>"><?php echo esc_html( matjar_get_option( 'previous-link-title', 'Go to Back' ) );?></a>
					<?php }							
				}else{
					$image_404 = matjar_get_option( '404-page-image' ); ?>
					<?php if(! empty( $image_404['url'] ) ){ ?>
						<img src="<?php echo esc_url( $image_404['url'] );?>" alt="<?php esc_attr_e('404 Image', 'matjar'); ?>">	
					<?php }else{
						esc_html_e( 'Image Not Set', 'matjar' );
					}
				} ?>
			</div><!-- .error-404 -->
		</div>

	<?php 
	/**
	 * Hook: matjar_after_main_content.
	 *
	 * @hooked matjar_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'matjar_after_main_content' );
endif;

get_footer();