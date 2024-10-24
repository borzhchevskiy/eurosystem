<?php
/**
 * Template part for displaying header
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/header
 * @since 1.0
 * @version 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$header = array();
$header['header_topbar']['left']		= matjar_get_responsive_class( matjar_get_option( 'header-topbar-left', '6' ) );
$header['header_topbar']['right']		= matjar_get_responsive_class( matjar_get_option( 'header-topbar-right', '6' ) );
$header['header_main']['left']			= matjar_get_responsive_class( matjar_get_option( 'header-main-left', '3' ) );
$header['header_main']['center']		= matjar_get_responsive_class( matjar_get_option( 'header-main-center', '6' ) );
$header['header_main']['right']			= matjar_get_responsive_class( matjar_get_option( 'header-main-right', '3' ) );
$header['header_navigation']['left']	= matjar_get_responsive_class( matjar_get_option( 'header-navigation-left', '3' ) );
$header['header_navigation']['center']	= matjar_get_responsive_class( matjar_get_option( 'header-navigation-center', '9' ) );
$header['header_navigation']['right']	= matjar_get_responsive_class( matjar_get_option( 'header-navigation-right', '3' ) );
$header['header_mobile_topbar']['center'] = matjar_get_option( 'header-mobile-topbar', '12' );
$header['header_mobile']['left']		= matjar_get_option( 'header-mobile-left', '3' );
$header['header_mobile']['center']		= matjar_get_option( 'header-mobile-center', '9' );
$header['header_mobile']['right']		= matjar_get_option( 'header-mobile-right', '3' );
$header_navigation						= matjar_get_option( 'header-navigation', 1 );
?>

<?php if ( $header_top ) : ?>
	<div class="header-topbar">
		<div class="container">
			<div class="row">
				<?php if( ! empty( $header['header_topbar'] ) ){?>
					<div class="header-desktop d-none d-lg-flex">
						<?php foreach( $header['header_topbar'] as $position => $header_class ){
							if( empty( $header_class ) ) { continue; } ?>						
							<div class="header-col header-col-<?php echo esc_attr( $position );?> <?php echo esc_attr( $header_class );?>">
								<?php do_action( 'matjar_header_topbar_'.$position );?>
							</div>						
						<?php } ?>
					</div><!--.header-desktop-->
				<?php }
				
				if( ! empty( $header['header_mobile_topbar'] ) ){ ?>
					<div class="header-mobile d-flex d-lg-none">				
						<?php foreach( $header['header_mobile_topbar'] as $position => $header_class ){
							if( empty( $header_class ) ) { continue; }
							$alignment_class = '';
							if( matjar_get_option( 'header-mobile-topbar-align', 1 ) ) {
								$alignment_class = ' justify-content-center';
							}?>
							<div class="header-col header-col-<?php echo esc_attr( $position );?> col-<?php echo esc_attr( $header_class );?> <?php echo esc_attr( $alignment_class );?>">
								<?php do_action( 'matjar_header_mobile_topbar_'.$position );?>
							</div>
						<?php } ?>
					</div><!--.header-mobile-->
				<?php }?>
			</div>
		</div>
	</div><!--.header-topbar-->
<?php endif; ?>

<div class="header-main">
	<div class="container">
		<div class="row">
			<?php if( ! empty( $header['header_main'] ) ){?>
				<div class="header-desktop d-none d-lg-flex">
					<?php foreach( $header['header_main'] as $position => $header_class ){					
						if( empty( $header_class ) ) { continue; }				
						$alignment_class = '';
						if($position == 'center' && matjar_get_option( 'header-main-align', 0 ) ) {
							$alignment_class = ' justify-content-center';
						}?>
						<div class="header-col header-col-<?php echo esc_attr( $position );?> <?php echo esc_attr( $header_class );?> <?php echo esc_attr( $alignment_class );?>">
							<?php do_action( 'matjar_header_main_'.$position );?>
						</div>
					<?php } ?>
				</div><!--.header-desktop-->
			<?php }
			if( ! empty( $header['header_mobile'] ) ){ ?>
				<div class="header-mobile d-flex d-lg-none">
					<?php foreach( $header['header_mobile'] as $position => $header_class ){					
						if( empty( $header_class ) ) { continue; }
						$alignment_class = '';
						if( $position == 'center' && matjar_get_option( 'header-mobile-align', 1 ) ) {
							$alignment_class = ' justify-content-center';
						}?>
						<div class="header-col header-col-<?php echo esc_attr( $position );?> col-<?php echo esc_attr($header_class );?> <?php echo esc_attr( $alignment_class );?>">
							<?php do_action( 'matjar_header_mobile_'.$position );?>
						</div>
					<?php } ?>
				</div><!--.header-mobile-->
			<?php }	?>
		</div>
	</div>
</div><!--.header-main-->

<?php if ( $header_navigation ) : ?>
	<div class="header-navigation d-none d-lg-flex">
		<div class="container">
			<div class="row">
				<?php if( ! empty( $header['header_navigation'] ) ){ ?>
					<div class="header-desktop d-none d-lg-flex">
						<?php foreach( $header['header_navigation'] as $position => $header_class ){						
							if( empty( $header_class ) ) { continue; }
							$alignment_class = '';
							if( $position == 'center' && matjar_get_option( 'header-navigation-align', 0 ) ) {
								$alignment_class = ' justify-content-center';
							}?>
							<div class="header-col header-col-<?php echo esc_attr( $position );?> <?php echo esc_attr( $alignment_class );?> <?php echo esc_attr($header_class);?>">
								<?php do_action( 'matjar_header_navigation_'.$position );?>
							</div>
						<?php } ?>
					</div><!--.header-desktop-->
				<?php } ?>
			</div>
		</div>
	</div><!--.header-navigation-->
<?php endif;