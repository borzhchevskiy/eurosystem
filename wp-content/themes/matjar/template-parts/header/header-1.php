<?php
/**
 * Template part for displaying header style 1
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
				<div class="header-desktop d-none d-lg-flex">
					<div class="header-col header-col-left col-6">
						<?php matjar_get_template( 'template-parts/header/elements/welcome-message' );?>
					</div>
					<div class="header-col header-col-right col-6">		
						<?php matjar_get_template( 'template-parts/header/elements/topbar-menu' );?>
						<?php matjar_get_template( 'template-parts/header/elements/phone-number' );?>
						<?php matjar_get_template( 'template-parts/header/elements/language-switcher' );?>
						<?php matjar_get_template( 'template-parts/header/elements/currency-switcher' );?>
					</div>
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
	</div><!--.header-topbar-->
<?php endif; ?>

<div class="header-main">
	<div class="container">
		<div class="row">
			<div class="header-desktop d-none d-lg-flex">
				<div class="header-col header-col-left col-3">
					<?php matjar_get_template( 'template-parts/header/elements/logo' );?>
				</div>
				<div class="header-col header-col-center col-6">
					<?php matjar_get_template( 'template-parts/header/elements/ajax-search' );?>
				</div>
				<div class="header-col header-col-right col-3">
					<?php matjar_get_template( 'template-parts/header/elements/myaccount' );?>
					<?php matjar_get_template( 'template-parts/header/elements/wishlist' );?>
					<?php matjar_get_template( 'template-parts/header/elements/cart' );?>
				</div>
			</div><!--.header-desktop-->
			
			<div class="header-mobile d-flex d-lg-none">
				<div class="header-col header-col-left col-3">
					<?php matjar_get_template( 'template-parts/header/elements/mobile-navbar' );?>
				</div>
				<div class="header-col header-col-center col-6">
					<?php matjar_get_template( 'template-parts/header/elements/logo' );?>
				</div>
				<div class="header-col header-col-right col-3">
					<?php matjar_get_template( 'template-parts/header/elements/mini-search' );?>
					<?php matjar_get_template( 'template-parts/header/elements/cart' );?>
				</div>
			</div><!--.header-mobile-->
		</div>
	</div>
</div><!--.header-main-->

<div class="header-navigation d-none d-lg-flex">
	<div class="container">
		<div class="row">
			<div class="header-desktop d-none d-lg-flex">
				<?php if ( matjar_get_option( 'categories-menu', 1 ) && has_nav_menu( 'categories-menu' ) ) { ?>
					<div class="header-col header-col-left col-3">
						<?php matjar_get_template( 'template-parts/header/elements/category-menu' );?>
					</div>
					<div class="header-col header-col-center col-9">
						<?php matjar_get_template( 'template-parts/header/elements/primary-menu' );?>
					</div>
				<?php }else{?>
					<div class="header-col header-col-center col-12">
						<?php matjar_get_template( 'template-parts/header/elements/primary-menu' );?>
					</div>
				<?php }?>
			</div><!--.header-desktop-->
		</div>
	</div>
</div><!--.header-navigation-->