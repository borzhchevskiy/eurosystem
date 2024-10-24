<?php 
/**
 * WooCommerce Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @package matjar/inc/integrations/woocommerce
 * @version 1.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! function_exists( 'matjar_woocommerce_setup' ) ) :
	function matjar_woocommerce_setup() {
		
		// Enable product gallery lightbox
		if( matjar_get_option( 'product-gallery-lightbox', 1 ) ){
			add_theme_support( 'wc-product-gallery-lightbox' );
		}
	}
	add_action( 'after_setup_theme', 'matjar_woocommerce_setup' );
endif;

/**
 * Get Account Menu
 */
function matjar_get_account_menu() {
	$user_roles = array();
	if(is_user_logged_in()){
		$user_info = get_userdata( get_current_user_id() );
		$user_roles = $user_info->roles;
	}
	$orders  = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
	$account_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
	if ( substr( $account_page_url, - 1, 1 ) != '/' ) {
		$account_page_url .= '/';
	}
	$orders_url   		= $account_page_url . $orders;
	$dashboard_url		= apply_filters('matjar_myaccount_dashboard_url',$account_page_url );
	$orders_url			= apply_filters('matjar_myaccount_orders_url', $orders_url  );

	$compare_url		= apply_filters('matjar_myaccount_compare_url', '');
	$tracking_pageid	= matjar_get_option('order-tracking-page', '');
	$order_tracking_url	= apply_filters('matjar_myaccount_order_tracking_url', ( ! empty ( $tracking_pageid ) ) ? get_permalink( $tracking_pageid ) : '' );
	$logout_url			= apply_filters('matjar_myaccount_logout_url', wc_logout_url() );
	$user_data 			= wp_get_current_user();
	$current_user 		= apply_filters('matjar_myaccount_username',$user_data->user_login );	

	$woocommerce_account_menu = array();
	$woocommerce_account_menu['profile'] = array( 
										'icon'		=> 'jricon-user',
										 'link'		=> $dashboard_url,
										 'label'	=> esc_html__('My Profile','matjar'),
								);
	$woocommerce_account_menu['orders'] = array( 
										'icon'		=> 'jricon-notebook',
										 'link'		=> $orders_url,
										 'label'	=> esc_html__('My Orders','matjar'),
								);
	if( ! empty ( $tracking_pageid ) ):
	$woocommerce_account_menu['order-tracking'] = array( 
										'icon'		=> 'jricon-plane',
										 'link'		=> $order_tracking_url,
										 'label'	=> esc_html__('Order Tracking','matjar'),
								);
	 endif;
	if( function_exists( 'YITH_WCWL' ) ){
		//Wishlist
		$wishlist_url 	= YITH_WCWL()->get_wishlist_url();
		$wishlist_url	= apply_filters('matjar_myaccount_wishlist_url', $wishlist_url );
		$woocommerce_account_menu['wishlist'] = array( 
										'icon'		=> 'jricon-heart',
										 'link'		=> $wishlist_url,
										 'label'	=> esc_html__('My Wishlist','matjar'),
								);
	}
			
	if(defined( 'YITH_WOOCOMPARE' )): 
	$woocommerce_account_menu['compare'] = array( 
										'class'		=> 'yith-woocompare-open',
										'icon'		=> 'jricon-refresh',
										'link'		=> $compare_url,
										'label'		=> esc_html__('Compare','matjar'),
								);
	endif;
	
		
	 $woocommerce_account_menu['logout'] = array( 
										'icon'		=> 'jricon-logout',
										'link'		=> $logout_url,
										'label'		=> esc_html__('Logout','matjar'),
								);
	return apply_filters( 'matjar_myaccount_menu', $woocommerce_account_menu );
}

if( ! function_exists( 'matjar_manage_woocommerce_hooks' ) ) {
	function matjar_manage_woocommerce_hooks() {
		
		// Enable product gallery zoom
		if( matjar_get_option( 'product-gallery-zoom', 1 ) ){
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		
		$breadcrumbs_position 		= matjar_get_option( 'single-product-breadcrumbs-position', 'above-summary' );
		
		$tabs_location = matjar_get_post_meta( 'single_product_tabs_location' );
		if( ! $tabs_location || 'default' == $tabs_location ){
			$tabs_location = matjar_get_option( 'single-product-tabs-location', 'after-summary' );
		}
		
		$bought_together_location = matjar_get_post_meta( 'product_bought_together_location' );
		if( ! $bought_together_location || 'default' == $bought_together_location ){
			$bought_together_location = matjar_get_option( 'product-bought-together-location', 'summary-bottom' );
		}
		
		// Checkout steps
		if( matjar_get_option( 'checkout-steps', 1 ) && ( is_cart() || is_checkout() || is_order_received_page() )) {
			remove_action( 'matjar_inner_page_title', 'matjar_template_page_title', 10 );
			remove_action( 'matjar_inner_page_title', 'matjar_template_breadcrumbs', 20 );
			add_action( 'matjar_inner_page_title', 'matjar_checkout_steps', 10 );
		}
		
		// Shop page breadcrumbs
		if( ! matjar_get_option( 'shop-page-title', 1 ) ) {
			add_action( 'woocommerce_archive_description', 'matjar_template_breadcrumbs', 5 );
		}
		
		// Remove Product Header
		if( ! matjar_get_option( 'products-header', 1 ) ) {
			remove_action( 'woocommerce_before_shop_loop', 'matjar_before_shop_loop', 20 );
		}
		
		// Remove Product Sorting
		if( ! matjar_get_option( 'products-sorting', 1 ) ) {
			remove_action( 'matjar_shop_loop_header_right', 'woocommerce_catalog_ordering', 30 );
		}
		
		// Remove Shop page products rating
		if( ! matjar_get_loop_prop( 'product-rating' ) ) {
			remove_action( 'matjar_shop_loop_item_title', 'woocommerce_template_loop_rating', 25	 );
		}

		// Remove Shop page products price
		if( ! matjar_get_loop_prop( 'product-price' ) ) {
			remove_action( 'matjar_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		}
		
		// Enable catalog mode
		if( matjar_get_loop_prop( 'catalog-mode' ) ) {			
			remove_action( 'matjar_product_loop_cart_button', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		}
				
		// Remove Short Description in List View
		if( ! matjar_get_option( 'product-short-description', 1 ) ) {
			remove_action( 'matjar_shop_loop_item_title', 'woocommerce_template_single_excerpt', 30 );
		}		
		
		add_filter( 'woocommerce_output_related_products_args', 'matjar_related_products_args' );
		
		add_filter( 'woocommerce_upsell_display_args', 'matjar_related_products_args' );
		
		if ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) {
			add_filter( 'woocommerce_get_price_html', 'matjar_login_to_see_prices' );  
			add_filter( 'woocommerce_loop_add_to_cart_link', '__return_false' );  

			//Remove Add to cart btns
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		}
		
		// Breadcrumbs Position in product page 
		if( matjar_get_option( 'single-product-breadcrumbs', 1 ) ) {	
			if( 'above-summary' == $breadcrumbs_position ){
				add_action( 'woocommerce_single_product_summary', 'matjar_template_breadcrumbs', 4 );
			}elseif( 'above-image' == $breadcrumbs_position ) {
				add_action( 'woocommerce_before_single_product', 'matjar_template_breadcrumbs', 50 );
			}
		}
		
		// Remove product rating
		if( ! matjar_get_option( 'single-product-rating', 1 ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8 );
		}
		
		// Remove product short description
		if( ! matjar_get_option( 'single-product-short-description', 1 ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
		}
		
		// Remove product meta
		if( ! matjar_get_option( 'single-product-meta', 1 ) ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		}
				
		// Product bought together location
		if( $bought_together_location == 'summary-bottom' ) {
			add_action( 'woocommerce_single_product_summary', 'matjar_bought_together_products', 55 );
		}elseif( $bought_together_location == 'after-summary' ) {			
			add_action( 'woocommerce_after_single_product_summary', 'matjar_bought_together_products', 5 );
		}
		
		// Disable product tabs title option
		if( ! matjar_get_option('single-product-tabs-titles', 1) ) {
			add_filter( 'woocommerce_product_description_heading', '__return_false', 20 );
			add_filter( 'woocommerce_product_additional_information_heading', '__return_false', 20 );
		}
				
		// Product tabs location
		if( $tabs_location == 'summary-bottom' ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 57 );
		}
		
		//Remove yith compare button in loop yith_woocompare_compare_button
		if( class_exists( 'YITH_Woocompare' ) ){
			global $yith_woocompare;
			$yith_woocompare_obj = $yith_woocompare->obj;
			if ( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ) {
				remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare_obj, 'add_compare_link' ), 20 );
			}
		}
		
		// Remove UpSell Products
		if( ! matjar_get_option('upsells-products', 1 ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}
		
		// Remove Related Products
		if( ! matjar_get_option('related-products', 1 ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
		
		// Remove Recently Viewed Products
		if( ! matjar_get_option('recently-viewed-products', 1 ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'matjar_output_recently_viewed_products', 25 );
		}
		
		add_filter( 'woocommerce_product_tabs', 'matjar_product_tabs', 90 );
		
		add_filter( 'woocommerce_output_related_products_args', 'matjar_related_products_args' );
		
		add_filter( 'woocommerce_upsell_display_args', 'matjar_related_products_args' );		
	}
	add_action( 'wp', 'matjar_manage_woocommerce_hooks', 1000 );	
}

/**
 * Product Style 3 Buttons
 */
function matjar_product_style_button(){
	 // Add Wishlist in Style 3
	if( 'product-style-3' == matjar_get_loop_prop( 'product-style' ) || 'product-style-5' == matjar_get_loop_prop( 'product-style' ) ) {
		add_action( 'matjar_before_shop_loop_item_title', 'matjar_product_loop_wishlist_button',7);
		remove_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_wishlist_button', 15 );
		remove_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_compare_button', 20 );
	}else{
		remove_action( 'matjar_before_shop_loop_item_title', 'matjar_product_loop_wishlist_button',7);
		add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_wishlist_button', 15 );
		add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_compare_button', 20 );
	}
	if( 'product-style-5' == matjar_get_loop_prop( 'product-style' ) ) {
		add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_quantity_field', 20 );
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'matjar_product_style_button' );

/**
 * Remove WCWL default options
 */
function matjar_wcwl_settings(){
	if( function_exists( 'YITH_WCWL_Frontend' ) ){
		$wcwl_obj = YITH_WCWL_Frontend();
		remove_action( 'woocommerce_before_shop_loop_item', array( $wcwl_obj, 'print_button' ), 5 );
		remove_action( 'woocommerce_after_shop_loop_item', array( $wcwl_obj, 'print_button' ), 7 );
		remove_action( 'woocommerce_after_shop_loop_item', array( $wcwl_obj, 'print_button' ),15 );		
		remove_action( 'woocommerce_single_product_summary', array( $wcwl_obj, 'print_button' ),31 );		
		remove_action( 'woocommerce_product_thumbnails', array( $wcwl_obj, 'print_button' ),21 );		
		remove_action( 'woocommerce_after_single_product_summary', array( $wcwl_obj, 'print_button' ),11 );
		add_action( 'woocommerce_single_product_summary', array( $wcwl_obj, 'print_button' ),31 );
	}
}
add_action( 'wp_head', 'matjar_wcwl_settings', 10 ); 


/* Improve YITH compare popup */
if( isset($_GET['action']) && $_GET['action'] == 'yith-woocompare-view-table' ){
	add_action('wp_print_styles', 'pressmar_compare_popup_style', 1000);
}
function pressmar_compare_popup_style(){	
	wp_enqueue_style( 'redux-google-fonts-matjar_options' );
	wp_enqueue_style( 'matjar-base' );
	wp_enqueue_style( 'matjar-custom-css' );
}

/*The social nextend social login/register*/
if ( ! function_exists( 'matjar_social_nextend_social_login' ) ) {
    function matjar_social_nextend_social_login() {
		if (!defined('NSL_PRO_PATH')) {
			if ( class_exists('NextendSocialLogin') ) {
				echo '<div class="social-login-separator"><span>'. esc_html__('Or login with', 'matjar') .'</span></div>';
				echo do_shortcode('[nextend_social_login]');
			}
		}
        
    }
    add_action( 'woocommerce_login_form_end', 'matjar_social_nextend_social_login', 10 );
} 
if ( ! function_exists( 'matjar_social_nextend_social_register' ) ) {
    function matjar_social_nextend_social_register() {
		if (!defined('NSL_PRO_PATH')) {
			if ( class_exists('NextendSocialLogin') ) {
				echo '<div class="social-login-separator"><span>'. esc_html__('Or connect with', 'matjar') .'</span></div>';
				echo do_shortcode('[nextend_social_login]');
			}
		}
        
    }
    add_action( 'woocommerce_register_form_end', 'matjar_social_nextend_social_register', 10 );
}

if ( ! function_exists( 'woodmart_single_product_thumbnails_gallery_image_width' ) ) {
	/**
	 * Change default `gallery_thumbnail` size values
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function woodmart_single_product_thumbnails_gallery_image_width() {
		//if ( woodmart_get_opt( 'single_product_thumbnails_gallery_image_width' ) ) {
			$size = array(
				//'width'  => (int) woodmart_get_opt( 'single_product_thumbnails_gallery_image_width' ),
				'width'  => 100,
				'height' => 0,
				'crop'   => 0,
			);
		/* } else {
			$size = wc_get_image_size( 'woocommerce_thumbnail' );
		} */

		if ( isset( $size['height'] ) && ! $size['height'] ) {
			$size['height'] = 0;
		}

		return $size;
	}

	add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'woodmart_single_product_thumbnails_gallery_image_width', 10 );
}

/*
 * Remove Product gallery Lightbox link
 */
function matjar_wc_remove_link_on_thumbnails( $html ) {
	
	if( matjar_get_option( 'product-gallery-lightbox', 1 ) ) {	
		return $html;
	}else{
		 return strip_tags( $html,'<div><img>' );
	 }
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'matjar_wc_remove_link_on_thumbnails' );

/*
 * Swap "Regular price" and "Sale price"
 */
function matjar_sale_regular_price( $price, $regular_price, $sale_price ) {	
	$price = '<ins>' . ( is_numeric( $sale_price ) ? wc_price( $sale_price ) : $sale_price ) . '</ins> <del aria-hidden="true">' . ( is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price ) . '</del>';
	
    return $price;
}
add_filter( 'woocommerce_format_sale_price', 'matjar_sale_regular_price', 10, 3 );

if ( ! function_exists( 'matjar_login_to_see_prices' ) ) {
	function matjar_login_to_see_prices() {
		if(is_user_logged_in()) return;
		$login_to_prices_text = apply_filters( 'matjar_login_to_prices_text', esc_html__('Login to see price','matjar'));
		$account_page_id 			= get_option( 'woocommerce_myaccount_page_id' );
		$account_page_url 			= !empty( $account_page_id ) ? get_permalink( $account_page_id ) : '#';
		return '<a href="'.esc_url( $account_page_url ).'" class="matjar-login-to-see-prices customer-signinup">' . $login_to_prices_text . '</a>';
	}
}

if ( ! function_exists( 'matjar_show_login_to_price' ) ) {
	function matjar_show_login_to_price(){
		if( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) {
			return false;
		}
		return true;
	}
}

if ( ! function_exists( 'matjar_hide_in_stock_message' ) ) {
	/**
	 * Hide stock in message for variation product
	 */
	function matjar_hide_in_stock_message( $html, $product) {
		$availability = $product->get_availability();
		
		if($product->get_type() != 'variation'){
			return '';
		} 
		if ( $product->is_in_stock() ) {
			return '';
		}
		return $html;
	}
	add_filter( 'woocommerce_get_stock_html', 'matjar_hide_in_stock_message', 10, 2 );
}
if ( ! function_exists( 'matjar_get_recently_viewed_products' ) ){
	function matjar_get_recently_viewed_products(){
		$viewed_products = ! empty( $_COOKIE['woocommerce_recently_viewed'] ) ? (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) : array(); // @codingStandardsIgnoreLine
		$viewed_products = array_reverse( array_filter( array_map( 'absint', $viewed_products ) ) );
		if ( empty( $viewed_products ) ) {
			return array();
		}
		return $viewed_products;
	}
}

/**
	Matjar product tabs
*/
if ( !function_exists( 'matjar_product_tabs' ) ){
	/**
	 * Matjar product tabs
	 */
	function matjar_product_tabs( $tabs ){
		global $post;
		$product_id = $post->ID;
		$prefix = MATJAR_PREFIX;		
		$additional_information = matjar_get_option( 'product-additional-information-tab', 1 );
		$review_tab = matjar_get_option( 'product-review-tab', 1 );
		$bought_together = matjar_get_option( 'single-product-bought-together', 1 );
		$bought_together_location = matjar_get_post_meta( 'product_bought_together_location' );
		if( ! $bought_together_location || 'default' == $bought_together_location ){
			$bought_together_location = matjar_get_option( 'product-bought-together-location', 'summary-bottom' );
		}
		$bought_together_txt = matjar_get_option( 'product-bought-together-title', 'Frequently Bought Together' );
		if( ! $review_tab ){
			unset( $tabs['reviews'] ); 
		}
		if( ! $additional_information ){
			unset( $tabs['additional_information'] ); 
		}
		if( $bought_together && $bought_together_location == 'in-tab' ){
			$pids = get_post_meta( $product_id, $prefix.'product_ids', true );
            if ( !empty($pids) ) {
                $tabs['bought_together'] = array(
                    'title' => $bought_together_txt,
                    'priority' => 1,
                    'callback' => 'matjar_bought_together_products'
                );
            }
		}
		$enable_custom_tab = get_post_meta( $product_id, $prefix.'enable_custom_tab', true );
		$product_custom_tab_heading = get_post_meta( $product_id, $prefix.'product_custom_tab_heading', true );
		if ($enable_custom_tab && !empty($product_custom_tab_heading) ) {
			$tabs['matjar_custom_tab'] = array(
				'title' => $product_custom_tab_heading,
				'priority' => 40,
				'callback' => 'matjar_custom_tab'
			);
		}
		return $tabs;
	}
}

if ( ! function_exists( 'matjar_custom_tab' ) ) {
	/**
	 * Matjar Product Custom Tab
	 */
	function matjar_custom_tab() {
		global $product;
		$prefix = MATJAR_PREFIX;
		$product_id = $product->get_id();
		$product_custom_tab_content = get_post_meta( $product_id,$prefix.'product_custom_tab_content', true );
		echo do_shortcode($product_custom_tab_content);
		
	}
}

if ( ! function_exists( 'matjar_bought_together_products' ) ) {
	/**
	 * Bought Together Products
	 */
	function matjar_bought_together_products() {
		$bought_together = matjar_get_option( 'single-product-bought-together', 1 );
		if(!$bought_together){
			return;
		}
		if ( is_singular( 'product' ) ) {
			global $product;
			
			$prefix = MATJAR_PREFIX;
			$product_id = $product->get_id();
			$together_products = get_post_meta( $product_id, $prefix.'product_ids', true );
			if( empty( $together_products ) ){ return; }
			$together_products = array_merge( array( $product_id ), $together_products );
			
			$args = apply_filters( 'woocommerce_bought_together_products_args', array(
				'post_type'            	=> array( 'product', 'product_variation' ),
				'ignore_sticky_posts'  	=> 1,
				'no_found_rows'        	=> 1,
				'posts_per_page'       	=> -1,
				'orderby' 				=> 'post__in',
				'post__in' 				=> $together_products
			) );
			
			$products = new WP_Query( $args );
			$total_price = 0;
			$count = 0;
			$i = 1;
			$max_disply_products = apply_filters('matjar_display_bought_together_products',3);
			$bought_together_txt = matjar_get_option( 'product-bought-together-title', 'Frequently Bought Together' );
			if ( $products->have_posts() ) : ?>
			<div class="matjar-wc-message"></div>
			<div class="matjar-bought-together-products">
				<h3 class="bought-together-title">
					<?php echo apply_filters('woocommerce_bought_together_title', $bought_together_txt ); ?>
				</h3>
				<div class="row">
					<div class="products col-12 col-md-8 col-lg-9">
						<div class="row">
							<?php 
							while ( $products->have_posts() ) : $products->the_post(); 
								global $product;
														
								$args['count'] = $count;
								wc_get_template( 'content-bought-together.php', $args );					
								$price_html = $product->get_price_html();
								if ( $price_html ) {
									$display_price = wc_get_price_to_display($product);
								}
								if ( $product->is_in_stock() ) {
									$total_price += wc_get_price_to_display( $product );					
									$count++;
								}
								if($i == $max_disply_products){
									break;								
								}
								$i++;
							endwhile; 
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php global $product;?>
					<?php if( matjar_show_login_to_price() ) { ?>
					<div class="items-total-price-button col-12 col-md-4 col-lg-3">				
						<div class="items-total-price">
							<div class="current-item">
								<span class="item"><?php if ( $product->is_in_stock() ) { echo sprintf( esc_html__('%d Item','matjar'),1);} else {echo sprintf(esc_html__('%d Item','matjar'),0);}?></span>
								<span class="item-price" data-id="<?php echo esc_attr($product->get_id());?>" data-itemprice="<?php echo esc_attr( wc_get_price_to_display( $product ) );?>"
								data-type="<?php echo esc_attr( $product->get_type() );?>"><?php echo wc_price(wc_get_price_to_display( $product ));?></span>
							</div>
							<div class="addons-item">
								<span class="items"><?php echo wp_kses( sprintf(__('<span class="addon-count">%d</span> Add-Ons','matjar'),$count-1), matjar_allowed_html('span') );?></span>
								<span class="items-price"><?php echo wp_kses( wc_price($total_price - wc_get_price_to_display( $product )), matjar_allowed_html('span') );?></span>
							</div>
							<div class="items-total">
								<span><?php echo esc_html__('Total','matjar');?></span>
								<span class="total-price"><?php echo wp_kses( wc_price($total_price) , matjar_allowed_html('span') );?></span>
							</div>
						</div>
						<?php if( ! matjar_get_loop_prop( 'catalog-mode' ) ) { ?>
						<div class="add-items-to-cart-wrap">
							<button type="button" class="add-items-to-cart"><?php echo esc_html__( 'Add items to cart', 'matjar' ); ?></button>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php endif;
			wp_reset_postdata();
		}
	}
}

if ( ! function_exists( 'matjar_all_add_to_cart' ) ) {
	/**
	 * All Add To Cart Products
	 */
	function matjar_all_add_to_cart() {
		
		// phpcs:disable WordPress.Security.NonceVerification.Missing
		$product_id        = apply_filters( 'matjar_add_to_cart_product_id', absint( $_POST['product_id'] ) );
		$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );
		$variation_id      = empty( $_POST['variation_id'] ) ? 0 : $_POST['variation_id'];
		$variation         = empty( $_POST['variation'] ) ? array() : $_POST['variation'];
		$passed_validation = apply_filters( 'matjar_add_to_cart_validation', true, $product_id, $quantity );
		$product_status    = get_post_status( $product_id );


		if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) && 'publish' === $product_status ) {

			do_action( 'woocommerce_ajax_added_to_cart', $product_id );
			
			if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
				wc_add_to_cart_message( array( $product_id => $quantity ), true );
			}

			// Return fragments
			WC_AJAX::get_refreshed_fragments();

		} else {

			// If there was an error adding to the cart, redirect to the product page to show any errors.
			$data = array(
				'error'       => true,
				'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
			);

			wp_send_json( $data );

		}
		die();
	}
	add_action( 'wp_ajax_nopriv_matjar_all_add_to_cart',  'matjar_all_add_to_cart' );
	add_action( 'wp_ajax_matjar_all_add_to_cart',  'matjar_all_add_to_cart' );
}

if ( ! function_exists( 'matjar_ajax_add_to_cart' ) ) {
	/**
	 * Ajax Add to Cart
	 */
	function matjar_ajax_add_to_cart(){
		
		// Get messages
		ob_start();
		wc_print_notices();
		$notices = ob_get_clean();
		
		// Get fragments
		// Get mini cart
		ob_start();

		woocommerce_mini_cart();

		$mini_cart = ob_get_clean();
		
		// Fragments and mini cart are returned
		$data = array(
			'notices' => $notices,
			'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
						'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
					)
				),
			'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
		);
		wp_send_json( $data );		
		die();
	}
	add_action('wp_ajax_matjar_ajax_add_to_cart', 'matjar_ajax_add_to_cart');
	add_action('wp_ajax_nopriv_matjar_ajax_add_to_cart', 'matjar_ajax_add_to_cart');
}

if ( ! function_exists( 'matjar_get_products_view' ) ){
	/**
	 * Get Product View
	 */
	function matjar_get_products_view(){
		
		$product_view = matjar_get_option( 'products-view', 'grid-view' );
		if( isset( $_GET['view'] ) ){
			return $_GET['view'];
		}
		return $product_view;
	}
}

if ( ! function_exists( 'matjar_related_products_args' ) ){
	/**
	 * Related Product args
	 */
	function matjar_related_products_args($args){		
		$args['posts_per_page'] = matjar_get_option('related-upsells-products', 6 );
		return $args;
	}
}

if ( !function_exists( 'matjar_get_shop_viewnumbers' ) ){
	/*
	 * Number of Product View
	 */
	function matjar_get_shop_viewnumbers(){
		$show_numbers = matjar_get_option( 'products-per-page-number', '6,9,12,24,36,48' );
		$show_numbers = explode(',',$show_numbers);
		$show_numbers = array_map('trim',$show_numbers);
		return $show_numbers;
	}
}

if ( ! function_exists( 'matjar_set_recently_viewed_products' ) ){
	/**
	 * Track Recently Viewed Products 
	 */
	function matjar_set_recently_viewed_products() {
		if ( ! is_singular( 'product' )) {
			return;
		}

		global $post;

		if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
			$viewed_products = array();
		} else {
			$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
		}

		// Unset if already in viewed products list.
		$keys = array_flip( $viewed_products );

		if ( isset( $keys[ $post->ID ] ) ) {
			unset( $viewed_products[ $keys[ $post->ID ] ] );
		}

		$viewed_products[] = $post->ID;

		if ( count( $viewed_products ) > 15 ) {
			array_shift( $viewed_products );
		}

		// Store for session only.
		wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
	}
	add_action( 'template_redirect', 'matjar_set_recently_viewed_products', 20 );
}

if ( ! function_exists( 'matjar_update_cart_widget_quantity' ) ){
	/** 
	 * MINI Cart Quantity Update
	 */
	function matjar_update_cart_widget_quantity(){	
		$cart_item_key 	= sanitize_text_field( $_POST['cart_item_key'] );
		$quantity 		= (int) sanitize_text_field( $_POST['quantity'] );
		if( !empty( $cart_item_key ) ){
			$cart =  WC()->cart->get_cart();
			if( isset($cart[$cart_item_key]) ){
				$quantity = apply_filters( 'woocommerce_stock_amount_cart_item', wc_stock_amount( preg_replace( '/[^0-9\.]/', '', $quantity ) ), $cart_item_key );
				if( !($quantity === '' || $quantity === $cart[$cart_item_key]['quantity']) ){
					if( !($cart[$cart_item_key]['data']->is_sold_individually() && $quantity > 1) ){
						WC()->cart->set_quantity( $cart_item_key, $quantity, false );
						$cart_updated = apply_filters( 'woocommerce_update_cart_action_cart_updated', true );
						if( $cart_updated ){
							WC()->cart->calculate_totals();
						}
					}
				}
			}
			WC_AJAX::get_refreshed_fragments();
		}	
	}
	add_action( 'wp_ajax_matjar_update_cart_widget_quantity','matjar_update_cart_widget_quantity' );
	add_action( 'wp_ajax_nopriv_matjar_update_cart_widget_quantity','matjar_update_cart_widget_quantity' );
}

if ( ! function_exists( 'matjar_update_checkout_quantity' ) ){
	/** 
	 * Checkout Quantity Update
	 */
	function matjar_update_checkout_quantity(){
		$data = array();
        parse_str($_POST['form_data'], $data);
        $cart 			= $data['cart'];
        $cart_updated 	= false;
		$cart_totals  	= isset( $data['cart'] ) ? wp_unslash( $data['cart'] ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		
		if ( ! WC()->cart->is_empty() && is_array( $cart_totals ) ) {
			foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {

				$_product = $values['data'];

				// Skip product if no updated quantity was posted.
				if ( ! isset( $cart_totals[ $cart_item_key ] ) || ! isset( $cart_totals[ $cart_item_key ]['qty'] ) ) {
					continue;
				}

				// Sanitize.
				$quantity = apply_filters( 'woocommerce_stock_amount_cart_item', wc_stock_amount( preg_replace( '/[^0-9\.]/', '', $cart_totals[ $cart_item_key ]['qty'] ) ), $cart_item_key );

				if ( '' === $quantity || $quantity === $values['quantity'] ) {
					continue;
				}

				// Update cart validation.
				$passed_validation = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $values, $quantity );

				// is_sold_individually.
				if ( $_product->is_sold_individually() && $quantity > 1 ) {
					/* Translators: %s Product title. */
					wc_add_notice( sprintf( __( 'You can only have 1 %s in your cart.', 'matjar' ), $_product->get_name() ), 'error' );
					$passed_validation = false;
				}

				if ( $passed_validation ) {
					WC()->cart->set_quantity( $cart_item_key, $quantity, false );
					$cart_updated = true;
				}
			}
		}
		
		if ( $cart_updated ) {
            WC()->cart->calculate_totals();            
			WC_AJAX::get_refreshed_fragments();
        }
		die();
	}	
	add_action( 'wp_ajax_matjar_update_checkout_quantity','matjar_update_checkout_quantity' );
	add_action( 'wp_ajax_nopriv_matjar_update_checkout_quantity','matjar_update_checkout_quantity' );
}

if( ! function_exists( 'matjar_product_quick_view' ) ){
	/**
	 * Product Quick View
	 */
	function matjar_product_quick_view(){
		
		if( isset( $_REQUEST['pid'] ) ) {
			$pid = sanitize_text_field( (int) $_REQUEST['pid'] );
		}
		
		global $post, $product;
		$post = get_post( $pid );
		setup_postdata( $post );
		$product = wc_get_product( $post->ID );
		ob_start();
			if ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) {
				add_filter( 'woocommerce_get_price_html', 'matjar_login_to_see_prices' );  
				add_filter( 'woocommerce_loop_add_to_cart_link', '__return_false' );  

				//Add to cart btns
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			}
			if( matjar_get_loop_prop( 'catalog-mode' ) ) {			
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			}
		
			get_template_part( 'woocommerce/content-quick-view' );
		echo ob_get_clean();
		die();
	}
	add_action( 'wp_ajax_matjar_product_quick_view','matjar_product_quick_view' );
	add_action( 'wp_ajax_nopriv_matjar_product_quick_view','matjar_product_quick_view' );
}

if ( !function_exists('matjar_ajax_get_size_chart') ) {
	function matjar_ajax_get_size_chart(){
				
		$post_id = isset($_POST['id']) ? $_POST['id'] : 0;
		if( $post_id ){
			$content_post = get_post($post_id);
			if( $content_post ){
				$prefix = MATJAR_PREFIX; // Metabox prefix
				$title = $content_post->post_title;
				$content = $content_post->post_content;
				$chart_data = get_post_meta($post_id,$prefix.'size_chart_data',true);
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				$table_html = '';
				if( ! empty( $chart_data ) ){
					$chart_table = json_decode($chart_data);
					if ( ! empty( $chart_table ) ) {
						$table_html .= "<table id='size-chart' class='table'>";
						$i = 0;
						foreach ( $chart_table as $chart ) {

							$table_html .= "<tr>";
							for ($j = 0; $j < count($chart); $j++) {
								//If data avaible
								if (!empty($chart[$j])) {
									$table_html .= ($i == 0) ? "<th>" . $chart[$j]. "</th>" : "<td>" .$chart[$j] . "</td>";
								}  else {
									$table_html .= ($i == 0) ? "<th>" . $chart[$j] . "</th>" : "<td></td>";
								}
							}
							$table_html .= "</tr>";
							$i++;
						}
						$table_html .= "</table>";
					}
				}
				$args = array('chart_id'=>$post_id,'title'=>$title,'content' => $content,'table_html'=> $table_html);
				wc_get_template( 'content-size-chart.php',$args );
				
			}else{
				echo esc_html__('Something wrong..','matjar');
			}	
			
		}else{
			echo esc_html__('Something wrong..','matjar');
		}
		die();
	}
	//Size Chart
	add_action('wp_ajax_matjar_ajax_get_size_chart', 'matjar_ajax_get_size_chart');
	add_action('wp_ajax_nopriv_matjar_ajax_get_size_chart', 'matjar_ajax_get_size_chart');
}

if ( !function_exists('matjar_ajax_get_block') ) {
	function matjar_ajax_get_block(){
				
		$post_id = isset($_POST['id']) ? $_POST['id'] : 0;
		$title = isset($_POST['title']) ? $_POST['title'] : '';
		if( $post_id ){
			echo '<div class="matjar-ajax-blok-content">';
			if( !empty( $title ) ){
				echo '<div class="matjar-blok-title">';
				echo esc_html($title);
				echo '</div>';
			}			
			echo do_shortcode('[matjar_block_html id="'.$post_id.'"]');
			echo '</div>';
		}else{
			echo esc_html__('Something wrong..','matjar');
		}
		die();
	}
	//Ajax Block
	add_action('wp_ajax_matjar_ajax_get_block', 'matjar_ajax_get_block');
	add_action('wp_ajax_nopriv_matjar_ajax_get_block', 'matjar_ajax_get_block');
}

if ( ! function_exists( 'matjar_wc_get_gallery_html' ) ) {
	/**
	 * Get HTML for a gallery
	 * @since 1.0
	 */
	function matjar_wc_get_gallery_html( $gallery_image_ids, $main_image = false ) {
		$gallery_output = '';

		foreach ( $gallery_image_ids as $gallery_image_id ) {
			$gallery_output .= matjar_wc_get_gallery_image_html( $gallery_image_id, $main_image );
		}
		return $gallery_output;
	}
}

if ( ! function_exists( 'matjar_wc_get_gallery_image_html' ) ) {
	/**
	 * Get Product Gallery Image HTML
	 * @since 1.0
	 */
	function matjar_wc_get_gallery_image_html( $attachment_id, $main_image = false ){
		$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
		$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
		$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
		$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
		$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
		$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
		if( empty( $thumbnail_src ) ){
			return;			
		}
		$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
		$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
		if( $main_image ){
			$image             = wp_get_attachment_image(
				$attachment_id,
				$image_size,
				false,
				apply_filters(
					'woocommerce_gallery_image_html_attachment_image_params',
					array(
						'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
						'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
						'data-src'                => esc_url( $full_src[0] ),
						'data-large_image'        => esc_url( $full_src[0] ),
						'data-large_image_width'  => esc_attr( $full_src[1] ),
						'data-large_image_height' => esc_attr( $full_src[2] ),
						'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
					),
					$attachment_id,
					$image_size,
					$main_image
				)
			);
			return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
		}else{
			return '<div class="matjar-gallery-thumbnail-image">'.wp_get_attachment_image( $attachment_id, $image_size ).'</div>';
		}
	}
}

if ( ! function_exists( 'matjar_wc_gallery_thumbnail_image_size' ) ) {
	function matjar_wc_gallery_thumbnail_image_size( $size ) {

		$product_gallery_layout = matjar_get_product_gallery_layout();

		if ( 'product-gallery-left' == $product_gallery_layout || 'product-gallery-bottom' == $product_gallery_layout ) {
			$size['width']  = 150;
			$size['height'] = 150;
		}
		return $size;
	}
	add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'matjar_wc_gallery_thumbnail_image_size' );
}

/**
 * Check enable swatch
 * @since 1.0
*/
function matjar_has_enable_switch($attribute_name){
	$prefix = MATJAR_PREFIX;
	$enable_swatch = get_option($prefix.$attribute_name.'_enable_swatch',false);
	if( !empty( $enable_swatch ) && $enable_swatch ){
		return true;
	}
	return false;
}

/**
 * Swatch HTML
 * @since 1.0
*/
function matjar_swatch_html( $html, $terms, $options, $attribute_name, $selected_attributes, $product ){
	
	if ( isset( $_REQUEST[ 'attribute_' . $attribute_name ] ) ) {
		$selected_value = $_REQUEST[ 'attribute_' . $attribute_name ];
	} elseif ( isset( $selected_attributes[ $attribute_name ] ) ) {
		$selected_value = $selected_attributes[ $attribute_name ];
	} else {
		$selected_value = '';
	}	
	foreach ( $terms as $term ) {
		$html .= matjar_get_swatch_html( $term, $selected_value, $attribute_name, $product );
	}
	return $html;
}

/**
 * Get Swatch HTML
 * @since 1.0
*/
function matjar_get_swatch_html( $term, $selected_value ='', $attribute_name = '', $product = null ){
	$html 					= '';
	$prefix 				= MATJAR_PREFIX;
	$swatch_display_style 	= get_option($prefix.$attribute_name.'_swatch_display_style',true);
	$swatch_display_type 	= get_option($prefix.$attribute_name.'_swatch_display_type',true);
	$swatch_size 			= get_option($prefix.$attribute_name.'_swatch_display_size',true);
	$name     				= esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );
		$selected = sanitize_title( $selected_value ) == $term->slug ? 'swatch-selected' : '';
		if($swatch_display_type == 'color'){			
			$color = get_term_meta( $term->term_id,  $prefix.'color', true );
			list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
			$html .= sprintf(
			'<span class="swatch-term swatch swatch-color term-%s swatch-%s swatch-%s %s"  title="%s" data-term="%s"><span class="matjar-tooltip" style="background-color:%s;color:%s;">%s</span></span>',
			esc_attr( $term->slug ),
			$swatch_display_style,
			$swatch_size,
			$selected,					
			esc_attr( $name ),
			esc_attr( $term->slug ),
			esc_attr( $color ),
			"rgba($r,$g,$b,0.5)",
			$name
			);
		}else if($swatch_display_type == 'image'){
			$image = get_term_meta( $term->term_id, $prefix.'attachment_id', true );
			
			$show_variation_image = apply_filters( 'matjar_show_variation_image', true );
			if( $show_variation_image ) {
				$pid 	= $product->get_id();
				$cache_enabled = apply_filters( 'matjar_has_swatches_cache', true );
				$transient_name     = 'matjar_swatches_cache_' . $pid;
				
				if ( $cache_enabled ) {
					$available_variations = get_transient( $transient_name );
				} else {
					$available_variations = array();
				}
				
				if ( ! $available_variations ) {					
					$available_variations = $product->get_available_variations();
					if ( $cache_enabled ) {
						set_transient( $transient_name, $available_variations, apply_filters( 'matjar_swatches_cache_time', WEEK_IN_SECONDS ) );
					}
				}
				if ( empty( $available_variations ) ) {
					return;
				}
				foreach ( $available_variations as $variation ) {
					if ( $variation['attributes'][ 'attribute_' . $attribute_name ] == $term->slug ) {
						$data_var_id = $variation['variation_id'];
					}
				}
				$variation = new WC_Product_Variation( $data_var_id );
				$image_id = $variation->get_image_id(); 
				
				if($image_id){
					$image = $image_id;
				}
			}
			
			$image = $image ? wp_get_attachment_image_src( $image ) : '';
			$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
			$html  .= sprintf(
				'<span class="swatch-term swatch swatch-image term-%s swatch-%s swatch-%s %s" title="%s" data-term="%s"><img src="%s" alt="%s"></span>',
				esc_attr( $term->slug ),
				$swatch_display_style,
				$swatch_size,
				$selected,
				esc_attr( $name ),
				esc_attr( $term->slug ),
				esc_url( $image ),
				esc_attr( $name )
			);
		}else{
			$label = get_term_meta( $term->term_id, 'label', true );
			$label = $label ? $label : $name;
			if( $swatch_display_style == 'square' ){
				$swatch_size = 'default';
			}
			$html  .= sprintf(
				'<span class="swatch-term swatch swatch-label term-%s swatch-%s swatch-%s %s" title="%s" data-term="%s"><span>%s</span></span>',
				esc_attr( $term->slug ),
				$swatch_display_style,
				$swatch_size,
				$selected,
				esc_attr( $name ),
				esc_attr( $term->slug ),
				esc_html( $label )
			);
		}
	return apply_filters('matjar_single_swatch_html',$html,$term,$selected_value);
}

/**
 * Vendor options
*/
function matjar_vendor_theme_options(){
	
	$options = array();
	
	if ( class_exists( 'WC_Vendors' ) || class_exists( 'WCMp' ) ) {
		$options[] = array(
					'id'       => 'vendor-page-layout',
					'type'     => 'image_select',
					'title'    => esc_html__( 'Page Layout', 'matjar' ),
					'subtitle' => esc_html__( 'Select vendor page layout with sidebar postion.', 'matjar' ),
					'options'  => array(
						'full-width' => array(
							'alt' => esc_html__( 'Full Width', 'matjar' ),
							'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
						),                   
						'left-sidebar' => array(
							'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
							'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
						), 
						'right-sidebar' => array(
							'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
							'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
						), 
					),
					'default'  => 'left-sidebar'
				);
		$options[] = array(
					'id'       => 'vendor-page-sidebar-widget',
					'type'     => 'select',
					'title'    => esc_html__('Sidebar Widget Area','matjar'),
					'data'     => 'sidebars',
					'default'  => 'shop-page-sidebar',
					'required' => array( 'vendor-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
				);
	}
	$options[] = array(
                'id'       		=> 'enable-sold-by-in-loop',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Loop Sold By', 'matjar' ),
				'subtitle'		=> esc_html__('Display sold by vendor name in loop.', 'matjar' ),
                'default'  		=> 1,
                'on'       		=> esc_html__('Yes','matjar'),
                'off'      		=> esc_html__('No','matjar'),
            );
	$options[] = array(
                'id'       		=> 'enable-sold-by-in-single',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Single Sold By', 'matjar' ),
				'subtitle'		=> esc_html__('Display sold by vendor name in single page.', 'matjar' ),
                'default'  		=> 1,
                'on'       		=> esc_html__('Yes','matjar'),
                'off'      		=> esc_html__('No','matjar'),
            );

	if ( class_exists( 'WC_Vendors' ) || class_exists( 'WCFMmp' ) ) {

		$options[] = array(
                'id'       => 'vendor-sold-by-template',
                'type'     => 'select',
                'title'    => esc_html__( 'Sold By Template', 'matjar' ),
                'options'  => array(
					'theme'=>esc_html__('By Theme','matjar'),
					'plugin'=>esc_html__('By Plugin','matjar'),
				),
                'default'  => 'theme',
            );	
	}
	
	return apply_filters('matjar_vendor_options', $options);
}