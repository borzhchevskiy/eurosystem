<?php
/**
 * Template part for displaying wishlist in header.php
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

if( ! matjar_get_option( 'header-wishlist', 1 ) || ! MATJAR_WOOCOMMERCE_ACTIVE || ! function_exists( 'YITH_WCWL' ) ){
	return;
}

$wishlist_url 	= YITH_WCWL()->get_wishlist_url();
$wishlist_count	= YITH_WCWL()->count_products();
?>			

<div class="header-wishlist">
	<a href="<?php echo esc_url( $wishlist_url );?>">
		<span class="header-wishlist-icon">
			<span class="header-wishlist-count"><?php echo esc_html( $wishlist_count );?></span>			
		</span>
		<span class="header-icon-text"><?php esc_html_e( 'Wishlist', 'matjar' );?></span>
	</a>	
</div>
