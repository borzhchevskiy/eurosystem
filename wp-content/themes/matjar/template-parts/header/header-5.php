<?php
/**
 * Template part for displaying header style 5
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
}?>

<?php if ( $header_top ) : ?>
	<div class="header-topbar">
		<div class="container">
			<div class="row">
				<div class="header-col header-col-left col-lg-6 col-xl-6 d-none d-lg-flex d-xl-flex">
					<?php matjar_get_template( 'template-parts/header/elements/welcome-message' );?>
				</div>
				<div class="header-col header-col-right col-lg-6 col-xl-6 d-none d-lg-flex d-xl-flex">		
						<?php matjar_get_template( 'template-parts/header/elements/topbar-menu' );?>
						<?php matjar_get_template( 'template-parts/header/elements/phone-number' );?>
						<?php matjar_get_template( 'template-parts/header/elements/language-switcher' );?>
						<?php matjar_get_template( 'template-parts/header/elements/currency-switcher' );?>
				</div><!--.header-desktop-->
				
				<div class="header-mobile d-flex d-lg-none">
					<div class="header-col header-col-center col-12 justify-content-center">		
						<?php matjar_get_template( 'template-parts/header/elements/welcome-message' );?>
						<?php matjar_get_template( 'template-parts/header/elements/language-switcher' );?>
						<?php matjar_get_template( 'template-parts/header/elements/currency-switcher' );?>
					</div>
				</div><!--.header-mobile-->
			</div>
		</div>
	</div>
<?php endif; ?>
<div class="header-main">
	<div class="container">
		<div class="row">
			<div class="header-col header-col-left col-lg-3 col-xl-3 d-none d-lg-flex d-xl-flex">
				<?php matjar_get_template( 'template-parts/header/elements/logo' );?>
			</div>
			<div class="header-col header-col-center col-lg-6 col-xl-6 d-none d-lg-flex d-xl-flex">
					<?php matjar_get_template( 'template-parts/header/elements/primary-menu' );?>
			</div>
			<div class="header-col header-col-right col-lg-3 col-xl-3 d-none d-lg-flex d-xl-flex">
				<?php matjar_get_template( 'template-parts/header/elements/myaccount' );?>
				<?php matjar_get_template( 'template-parts/header/elements/mini-search' );?>
				<?php matjar_get_template( 'template-parts/header/elements/wishlist' );?>
				<?php matjar_get_template( 'template-parts/header/elements/cart' );?>
			</div>
			
			<!-- Mobile-->
			<div class="header-col header-col-left col-3 d-flex d-lg-none d-xl-none">
				<?php matjar_get_template( 'template-parts/header/elements/mobile-navbar' );?>
			</div>
			<div class="header-col header-col-center col-6 d-flex d-lg-none d-xl-none">
				<?php matjar_get_template( 'template-parts/header/elements/logo' );?>
			</div>
			<div class="header-col header-col-right col-3 d-flex d-lg-none d-xl-none">
				<?php matjar_get_template( 'template-parts/header/elements/mini-search' );?>
				<?php matjar_get_template( 'template-parts/header/elements/cart' );?>
			</div>
			
		</div>
	</div>
</div>