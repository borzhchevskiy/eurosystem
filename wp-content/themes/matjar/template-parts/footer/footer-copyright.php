<?php
/**
 * Template part for displaying footer copyright
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

<div class="footer-copyright copyright-<?php echo esc_attr( matjar_get_option( 'copyright-layout', 'columns' ) );?>">
	<div class="container">	
		<div class="row copyright-wrap">
			<div class="text-left reset-mb-10 col-12 col-md-6">
				<?php
				$copyright_text = matjar_get_option('copyright-text',
					wp_kses( sprintf( __( 'Matjar &copy; {current_year} by <a href="%s" >ThemeJR</a> All Rights Reserved.', 'matjar' ), esc_url( 'https://templatemonster.com/store/themejr' ) ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						) 
					)
				);
				$current_year = date("Y"); 
				$copyright_text = str_replace( '{current_year}', $current_year, $copyright_text );
				echo wp_kses_post( $copyright_text ); ?>
			</div>
			<?php if( matjar_get_option( 'show-payments-logo', 0 ) ){ ?>
				<div class="text-right col-12 col-md-6">						
					<?php $payments_url = matjar_get_option( 'payments-logo', array( 'url' => MATJAR_IMAGES.'/payments-method.png') );?>
					<img src="<?php echo esc_url( $payments_url['url'] );?>" alt="<?php echo esc_attr__('Payment logo','matjar');?>">
				</div>
			<?php }?>
		</div>
	</div>
</div><!-- .footer-copyright -->