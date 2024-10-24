<?php
/**
 * Template part for displaying cart
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! matjar_get_option( 'header-cart', 1 ) || matjar_get_loop_prop( 'catalog-mode' ) || ! MATJAR_WOOCOMMERCE_ACTIVE || ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) ) return;

global $woocommerce;
$count 				= WC()->cart->get_cart_contents_count();
$cart_url			= wc_get_cart_url();
$cart_style			= matjar_get_option( 'header-cart-style', 1 );
?>			

<div class="header-cart cart-style-<?php echo esc_attr($cart_style); ?>">
	<a href="<?php echo esc_url($cart_url);?>">		
		<?php 
		switch ($cart_style) {
			case 1:?>
				<div class="header-cart-icon <?php echo esc_attr( matjar_get_option( 'header-cart-icon','cart-icon') );?>">
					<span class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
				</div>				
				<?php 
				break;
			default:
		}?>	
		<span class="header-icon-text"><?php esc_html_e( 'Cart', 'matjar' );?></span>				
	</a>
	<?php if ( 'dropdow'== matjar_get_option( 'header-minicart-popup', 'slider' ) && ! is_cart() && ! is_checkout() ){?>
		<div class="woocommerce widget_shopping_cart matjar-arrow">
			<div class="dropdow-minicart-header">
				<h3 class="minicart-title"><?php echo sprintf(_n('Recent add item', 'Recent add item(s)', WC()->cart->cart_contents_count, 'matjar'), WC()->cart->cart_contents_count);?></h3>
			</div>
			<div class="widget_shopping_cart_content">
				<?php woocommerce_mini_cart();?>
			</div>
		</div>
	<?php }?>	
</div>