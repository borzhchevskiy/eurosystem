<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$unique_id 		= matjar_uniqid('section-');
$slider_data 	= shortcode_atts( matjar_slider_options() ,array(
	'slider_autoplay'   => ( matjar_get_option( 'related-upsell-auto-play', 1) ) ? true : false,
	'slider_loop'   	=> ( matjar_get_option( 'related-upsell-loop', 1) ) ? true : false,
	'slider_autoHeight'	=>  false,
	'slider_nav'     	=> ( matjar_get_option( 'related-upsell-navigation', 1) ) ? true : false,
	'slider_dots'     	=> ( matjar_get_option( 'related-upsell-product-dots', 1) ) ? true : false,
	'rs_extra_large'	=> matjar_get_option( 'related-upsell-products-columns', 5 ),			
	'rs_large'			=> matjar_get_option( 'related-upsell-products-columns', 5 ),			
	'rs_medium'			=> matjar_get_option( 'related-upsell-products-columns-tablet', 3 ),		
	'rs_small'			=> matjar_get_option( 'related-upsell-products-columns-mobile', 2 ),	
	'rs_extra_small'    => matjar_get_option( 'related-upsell-products-columns-mobile', 2 ),
));
matjar_set_loop_prop( 'name', 'matjar-carousel' );
matjar_set_loop_prop( 'products-columns', matjar_get_option( 'related-upsell-products-columns', 5 ) );
matjar_set_loop_prop('rs_large', matjar_get_option( 'related-upsell-products-columns', 5 ) );
matjar_set_loop_prop('rs_medium', matjar_get_option( 'related-upsell-products-columns-tablet', 3 ) );
matjar_set_loop_prop('rs_extra_small', matjar_get_option( 'related-upsell-products-columns-mobile', 2 ) );
matjar_set_loop_prop( 'unique_id', $unique_id );
matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );

if ( $recently_viewed_products ) : ?>

	<section class="recently-viewed">

		<h2><?php esc_html_e( 'Recently Viewed', 'matjar' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $recently_viewed_products as $product_id ) : ?>
				<?php
				 	$post_object = get_post( $product_id );
					if($post_object){
						setup_postdata( $GLOBALS['post'] =& $post_object );
						wc_get_template_part( 'content', 'product' );
					}
				?>
			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
