<?php
/**
 * Functions to allow styling of the templating system
 *
 * @author 		ThemeJR
 * @package 	matjar/inc
 * @since 		1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Sets up the matjar_loop global from the passed args.
 */
function matjar_setup_loop( $args = array() ) {
	
	$default_args = array(
		'name'          						=> 'posts-loop',
		//Blog
		'post-single-line-title'          		=> 0,
		'post-date'          					=> matjar_get_option( 'post-date', 0 ),
		'sticky-post-icon'          			=> matjar_get_option( 'sticky-post-icon', 1 ),
		'post-format-icon'          			=> matjar_get_option( 'post-format-icon', 0 ),
		'post-category'          				=> matjar_get_option( 'post-category', 1 ),
		'post-meta'          					=> matjar_get_option( 'post-meta', 1 ),
		'specific-post-meta'          			=> matjar_get_option( 'specific-post-meta', array( 'post-author', 'post-date', 'post-comments' ) ),
		'post-meta-icon'          				=> matjar_get_option( 'post-meta-icon', 1 ),
		'post-meta-separator'          			=> matjar_get_option( 'post-meta-separator', 'meta-separator-colon' ),
		
		//Blog Archive
		'blog-post-style'          				=> matjar_get_option( 'blog-post-style', 'blog-classic' ),
		'blog-grid-layout'          			=> matjar_get_option( 'blog-grid-layout', 'simple-grid' ),
		'blog-grid-columns'        				=> matjar_get_option( 'blog-grid-columns', 2 ),
		'blog-grid-columns-tablet'        		=> matjar_get_option( 'blog-grid-columns-tablet', 2 ),
		'blog-grid-columns-mobile'        		=> matjar_get_option( 'blog-grid-columns-mobile', 1 ),
		'blog-post-thumbnail'          			=> matjar_get_option( 'blog-post-thumbnail', 1 ),
		'blog-post-title'          				=> matjar_get_option( 'blog-post-title', 1 ),
		'show-blog-post-content'          		=> matjar_get_option( 'show-blog-post-content', 1 ),
		'blog-post-content'          			=> matjar_get_option( 'blog-post-content', 'full-content' ),
		'blog-excerpt-length'          			=> matjar_get_option( 'blog-excerpt-length', 30 ),
		'read-more-button'          			=> matjar_get_option( 'read-more-button', 1 ),
		'read-more-button-style'          		=> matjar_get_option( 'read-more-button-style', 'read-more-link' ),
		'post-readmore-text'          	    	=> matjar_get_option( 'post-readmore-text', 'Read More' ),
		'blogs-pagination-type'          		=> matjar_get_option( 'blogs-pagination-type', 'default' ),
		'blog-pagination-load-more-button-text'	=> matjar_get_option( 'blog-pagination-load-more-button-text', 'Load More Posts' ),
		'blog-pagination-finished-message'		=> matjar_get_option( 'blog-pagination-finished-message', 'No More Posts Available...' ),
		
		/* Portfolio options */
		'portfolio-post-thumbnail'          	=> matjar_get_option( 'portfolio-post-thumbnail', 1 ),
		'portfolio-style'          				=> matjar_get_option( 'portfolio-style', 'portfolio-style-1' ),
		'portfolio-grid-layout'          		=> matjar_get_option( 'portfolio-grid-layout', 'masonry-grid' ),
		'portfolio-grid-columns'          		=> matjar_get_option( 'portfolio-grid-columns', 3 ),
		'portfolio-grid-columns-tablet'    		=> matjar_get_option( 'portfolio-grid-columns-tablet', 2 ),
		'portfolio-grid-columns-mobile'    		=> matjar_get_option( 'portfolio-grid-columns-mobile', 1 ),
		'portfolio-grid-gap'          			=> matjar_get_option( 'portfolio-grid-gap', 15 ),
		'portfolio-filter'          			=> matjar_get_option( 'portfolio-filter', 1 ),
		'portfolio-per-page'          			=> matjar_get_option( 'portfolio-per-page', 9 ),
		'portfolio-button-icon'          		=> matjar_get_option( 'portfolio-button-icon', 1 ),
		'portfolio-link-icon'          			=> matjar_get_option( 'portfolio-link-icon', 1 ),
		'portfolio-zoom-icon'          			=> matjar_get_option( 'portfolio-zoom-icon', 1 ),
		'portfolio-content-part'          		=> matjar_get_option( 'portfolio-content-part', 1 ),
		'portfolio-category'          			=> matjar_get_option( 'portfolio-category',1 ),
		'portfolio-title'          				=> matjar_get_option( 'portfolio-title', 1 ),
		'portfolio-pagination-type'          	=> matjar_get_option( 'portfolio-pagination-type', 'default' ),
		'portfolio-pagination-load-more-button-text'		=> matjar_get_option( 'portfolio-pagination-load-more-button-text','Load More Portfolios' ),
		'portfolio-pagination-finished-message'	=> matjar_get_option( 'portfolio-pagination-finished-message', 'No More Portfolios Available...' ),
		
		/* woocommerce */
		'login-to-see-price'        			=> matjar_get_option( 'login-to-see-price', 0 ),
		'product-labels'       				 	=> matjar_get_option( 'product-labels', 1 ),
		'sale-product-label'     				=> matjar_get_option( 'sale-product-label', 1 ),
		'sale-product-label-after-price'        => matjar_get_option( 'sale-product-label-after-price', 'on-product-image' ),
		'sale-single-product-label-after-price' => matjar_get_option( 'sale-single-product-label-after-price', 'on-product-image'),
		'sale-product-label-text-options'       => matjar_get_option( 'sale-product-label-text-options', 'percentages' ),
		'sale-product-label-percentage-text' 	=> matjar_get_option( 'sale-product-label-percentage-text', 'Off' ),
		'sale-product-label-text'        		=> matjar_get_option( 'sale-product-label-text', 'Sale' ),
		'sale-product-label-color'        		=> matjar_get_option( 'sale-product-label-color', '#60BF79' ),
		'product-new-label'      				=> matjar_get_option( 'product-new-label', 1 ),
		'new-product-label-text'        		=> matjar_get_option( 'new-product-label-text', 'New' ),
		'product-newness-days'        			=> matjar_get_option( 'product-newness-days', 90 ),
		'new-product-label-color'        		=> matjar_get_option( 'new-product-label-color', '#48c2f5' ),
		'featured-product-label' 				=> matjar_get_option( 'featured-product-label', 1 ),
		'featured-product-label-text'        	=> matjar_get_option( 'featured-product-label-text', 'Featured' ),
		'featured-product-label-color'        	=> matjar_get_option( 'featured-product-label-color', '#ff781e' ),
		'outofstock-product-label' 				=> matjar_get_option( 'outofstock-product-label', 1 ),
		'outofstock-product-label-text'         => matjar_get_option( 'outofstock-product-label-text', 'Out Of Stock' ),
		'outofstock-product-label-color'      	=> matjar_get_option( 'outofstock-product-label-color', '#FF4557' ),
		'product-style'        					=> matjar_get_option( 'product-style', 'product-style-4' ),
		'product-action-buttons-style'    		=> '',
		'product-action-buttons-style'    		=> '',
		'products-columns'        				=> (int) matjar_get_option( 'products-columns', 4 ),
		'products-columns-tablet'        		=> (int) matjar_get_option( 'products-columns-tablet', 3 ),
		'products-columns-mobile'        		=> (int) matjar_get_option( 'products-columns-mobile', 2 ),
		'products-per-page'        				=> matjar_get_option( 'products-per-page', 12 ),
		'products-view-icon'        			=> matjar_get_option( 'products-view-icon', 1 ),
		'products-pagination-style'        		=> matjar_get_option( 'products-pagination-style', 'default' ),
		'products-pagination-load-more-button-text' => matjar_get_option( 'products-pagination-load-more-button-text', 'Load More' ),
		'products-pagination-finished-message'  => matjar_get_option( 'products-pagination-finished-message', 'No More Products Available' ),
		'products-per-page-dropdown'        	=> matjar_get_option( 'products-per-page-dropdown', 1 ),
		'product-countdown'          			=> matjar_get_option( 'product-countdown', 0 ), 		
		'product-category'          			=> matjar_get_option( 'product-category', 1 ),
		'product-title'          				=> matjar_get_option( 'product-title', 1 ),
		'product-rating'        				=> matjar_get_option( 'product-rating', 1 ),
		'product-price'        					=> matjar_get_option( 'product-price', 1 ),
		'catalog-mode'        					=> matjar_get_option( 'catalog-mode', 0 ),
		'product-buttons'        				=> matjar_get_option( 'product-buttons', 1 ),
		'product-cart-button'        			=> matjar_get_option( 'product-cart-button', 1 ),
		'product-wishlist-button'        		=> matjar_get_option( 'product-wishlist-button', 1 ),
		'product-compare-button'        		=> matjar_get_option( 'product-compare-button', 1 ),
		'product-quickview-button'        		=> matjar_get_option( 'product-quickview-button', 1 ),
		'product-variations'        			=> matjar_get_option( 'product-variations', 1 ),
		'products_view'							=> function_exists ( 'matjar_get_products_view' ) ? matjar_get_products_view() : 'grid-view',
		'category-style'						=> matjar_get_option('category-style', 'category-style-1' ),
		'is_quick_view'		                    => false,
	);
	
	// Merge any existing values.
	if ( isset( $GLOBALS['matjar_loop'] ) ) {
		$default_args = array_merge( $default_args, $GLOBALS['matjar_loop'] );
	}

	$GLOBALS['matjar_loop'] = wp_parse_args( $args, $default_args );
}
add_action( 'woocommerce_before_shop_loop', 'matjar_setup_loop' );
add_action( 'wp', 'matjar_setup_loop', 10 );

/**
 * Sets a property in the matjar_loop global.
 */
function matjar_set_loop_prop( $prop, $value = '' ) {
	if ( ! isset( $GLOBALS['matjar_loop'] ) ) {
		matjar_setup_loop();
	}
	$GLOBALS['matjar_loop'][ $prop ] = $value;
}

/**
 * Resets the matjar_loop global.
 */
function matjar_reset_loop() {
	unset( $GLOBALS['matjar_loop'] );
}
add_action( 'woocommerce_after_shop_loop', 'woocommerce_reset_loop', 999 );

/**
 * Gets a property from the matjar_loop global.
 */
if ( ! function_exists( 'matjar_get_loop_prop' ) ) {
	function matjar_get_loop_prop( $prop, $default = '' ) {

		matjar_setup_loop(); // Ensure post loop is setup.

		$value = isset( $GLOBALS['matjar_loop'], $GLOBALS['matjar_loop'][ $prop ] ) ? $GLOBALS['matjar_loop'][ $prop ] : $default;
		$value = apply_filters( 'matjar_get_loop_prop' , $value, $prop, $GLOBALS['matjar_loop']);
		return apply_filters( 'matjar_get_loop_prop_' . $prop, $value, $prop,$GLOBALS['matjar_loop']) ;
	}
}

/**
 * Adds custom classes to the array of body classes.
 */
function matjar_body_classes( $classes ) {
	
	$layout 			= matjar_get_layout();
	$classes[] 			= 'wrapper-' . matjar_get_option( 'theme-layout', 'full' );
	$classes[] 			= 'matjar-skin-' . matjar_get_option( 'site-skin', 'light' );
		
	
	if( matjar_is_open_categories_menu() ){
		$classes[] = 'open-categories-menu';
	}
	
	if( $layout != 'full-width' ){
		$classes[] = 'has-sidebar';
		$classes[] = $layout;
	}else{
		$classes[] = 'no-sidebar';
	}
	
	if( matjar_get_option( 'ajax-filter', 0 ) && matjar_is_catalog() ){
		$classes[] = 'matjar-catalog-ajax-filter';
	}
	
	if( matjar_get_option( 'widget-toggle', 0 ) ){
		$classes[] = 'has-widget-toggle';
	}
	
	if( matjar_get_option( 'widget-menu-toggle', 0 ) ){
		$classes[] = 'has-widget-menu-toggle';
	}
	
	if( matjar_get_option( 'product-hover-mobile', 0 ) ){
		$classes[] = 'has-product-hover-mobile';
	}
	
	if( matjar_get_option( 'mobile-bottom-navbar', 0 ) ) { 
		if( function_exists('is_product') && is_product() ) {
			if( matjar_get_option( 'mobile-product-page-button', 1 ) ){
				$classes[] = 'has-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'has-mobile-bottom-navbar';
			}
		}elseif( function_exists('is_cart') && is_cart() ){
			if( matjar_get_option( 'mobile-cart-page-button', 1 ) ) {
				$classes[] = 'has-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'has-mobile-bottom-navbar';
			}
		}elseif( function_exists('is_checkout') && is_checkout() ){
			if( matjar_get_option( 'mobile-checkout-page-button', 1 ) ){
				$classes[] = 'has-mobile-bottom-navbar-single-page';
			}else{
				$classes[] = 'has-mobile-bottom-navbar';
			}
		}else{
			$classes[] = 'has-mobile-bottom-navbar';
		}		
	}
	
	if( matjar_get_option('sidebar-canvas-mobile', 1 ) || matjar_get_option( 'shop-page-off-canvas-sidebar', 0 ) ){
		if( ! matjar_is_vendor_page() ){
			$classes[] = 'has-mobile-canvas-sidebar';
		}
	}elseif( matjar_get_option( 'mobile-bottom-navbar', 0 )  && !matjar_is_vendor_page() ){
		$mobile_elemets = (array) matjar_get_option( 'mobile-navbar-elements',  array(
				'enabled'  => array(
				   'shop'  		=> esc_html__( 'Shop', 'matjar' ),
					'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'matjar' ),
					'wishlist' 		=> esc_html__( 'Wishlist', 'matjar' ),
					'cart'     		=> esc_html__( 'Cart', 'matjar' ),
					'account'  		=> esc_html__( 'Account', 'matjar' ),							
				) ) );
		if( !isset( $mobile_elemets['enabled'] ) ){
			$mobile_elemets['enabled'] =  array(
			   'shop'  		=> esc_html__( 'Shop', 'matjar' ),
				'sidebar'  	=> esc_html__( 'Sidebar/Filters', 'matjar' ),
				'wishlist' 	=> esc_html__( 'Wishlist', 'matjar' ),
				'cart'     	=> esc_html__( 'Cart', 'matjar' ),
				'account'  	=> esc_html__( 'Account', 'matjar' ),							
			);
		}		
		if( array_key_exists( 'sidebar', $mobile_elemets['enabled'] ) ){
			if( function_exists('is_product') && is_product() && matjar_get_option('mobile-product-page-button')  ){
				$classes[] = '';
			}else{
				$classes[] = 'has-mobile-canvas-sidebar';
			}			
		}
	}
	
	if( matjar_get_option( 'promo-bar', 0 ) && 'bottom' == matjar_get_option( 'promo-bar-position', 'top' ) ) {
		$classes[] = 'has-promo-bar-bottom';
	}
	
	$classes = apply_filters( 'matjar_body_classes', $classes );
	
	return $classes;
}

/**
 * Adds custom class to the array of posts classes.
 */
function matjar_post_classes( $classes, $class, $post_id ) {
	//$classes[] = 'entry';

	return $classes;
}

/**
 * Display classes for primary div
 */
if ( ! function_exists( 'matjar_primary_class' ) ) :
	function matjar_primary_class( $class = '' ) {
		echo 'class="' . esc_attr( join( ' ', matjar_get_primary_class( $class ) ) ) . '"';
	}
endif;

/**
 * Retrieve the classes for the primary element as an array.
 */
if ( ! function_exists( 'matjar_get_primary_class' ) ) :
	function matjar_get_primary_class( $class = '' ) {
		$classes 		= array();
		$page_id 		= get_the_ID();
		$page_layout 	= get_post_meta( $page_id, MATJAR_PREFIX.'page_sidebar_position', true );
		
		$classes[] = 'content-area';
		
		$content_columns = matjar_get_content_columns();
		if( !empty( $content_columns ) ){
			$classes = array_merge( $classes, $content_columns );
		}
		
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}
		
		$classes = apply_filters( 'matjar_primary_class', $classes, $class );
		$classes = array_map( 'sanitize_html_class', $classes );

		return array_unique( $classes );
	}
endif;


/**
 * Display classes for sidebar div
 */
if ( ! function_exists( 'matjar_sidebar_class' ) ) :
	function matjar_sidebar_class( $class = '' ) {
		echo 'class="' . esc_attr( join( ' ', matjar_get_sidebar_class( $class ) ) ) . '"';
	}
endif;

/**
 * Retrieve the classes for the sidebar as an array.
 */
if ( ! function_exists( 'matjar_get_sidebar_class' ) ) :
	function matjar_get_sidebar_class( $class = '' ) {
		$classes 	= array();
		$classes[] 	= 'widget-area';
		
		$sidebar_columns = matjar_get_sidebar_columns();		
		if( !empty( $sidebar_columns ) ){
			$classes = array_merge( $classes, $sidebar_columns );
		}
		
		if ( ! empty( $class ) ) {
			if ( ! is_array( $class ) ) {
				$class = preg_split( '#\s+#', $class );
			}
			$classes = array_merge( $classes, $class );
		} else {
			$class = array();
		}
		
		$classes = apply_filters( 'matjar_sidebar_class', $classes, $class );

		return array_unique( $classes );
	}
endif;

/**
 * Blog wrapper classes
 */
if( ! function_exists( 'matjar_blog_wrapper_classes' ) ):
	function matjar_blog_wrapper_classes() {			
		$classes = array();
		if( matjar_get_loop_prop('name') == 'related-posts' ){
			
			if( 'slider' == matjar_get_option('related-posts-display', 'slider') ) {
				$classes[]	= 'matjar-carousel';
				$classes[]	= 'owl-carousel';
				$classes[]	= 'grid-col-lg-'.matjar_get_loop_prop( 'rs_large' );
				$classes[] 	= 'grid-col-md-'.matjar_get_loop_prop( 'rs_medium' );
				$classes[] 	= 'grid-col-'.matjar_get_loop_prop( 'rs_extra_small' );
			}else{
				$classes[] = 'items-grid';
			}
			$classes[] = ( matjar_get_loop_prop( 'read-more-button-style' ) ) ? matjar_get_loop_prop('read-more-button-style' ) : '';
		}else{
			$blog_post_style	= matjar_get_loop_prop( 'blog-post-style' );
			$blog_grid_layout	= matjar_get_loop_prop( 'blog-grid-layout' );		
			
			$classes[] = 'articles-list';
			if( 'blog-grid' == $blog_post_style && 'posts-slider-shortcode' != matjar_get_loop_prop('name') ){
				$classes[] = 'row';
			}			
			
			if( 'masonry-grid' == $blog_grid_layout ){
				wp_enqueue_script( 'isotope' );
				wp_enqueue_script('masonry');
			}
			
			$classes[] = $blog_post_style;
			if( 'blog-grid' == $blog_post_style ){
				$classes[] = $blog_grid_layout;
			}
			
			if( 'posts-slider-shortcode' == matjar_get_loop_prop('name') ){
				$classes[]	= 'matjar-carousel';
				$classes[]	= 'owl-carousel';
				$classes[]	= 'grid-col-lg-'.matjar_get_loop_prop( 'rs_large' );
				$classes[] 	= 'grid-col-md-'.matjar_get_loop_prop( 'rs_medium' );
				$classes[] 	= 'grid-col-'.matjar_get_loop_prop( 'rs_extra_small' );
			}
			
			$classes[] = ( matjar_get_loop_prop( 'read-more-button-style' ) ) ? matjar_get_loop_prop( 'read-more-button-style' ) : '';
		}
		
		if( matjar_get_loop_prop( 'post-single-line-title' ) ){
			$classes[] 	= 'post-single-line-title';
		}
		
		$classes = apply_filters( 'matjar_blog_wrapper_classes', $classes );
		
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}
		
		echo esc_attr( $classes );
	}
endif;

/**
 * Portfolio wrapper classes
 */
if( !function_exists( 'matjar_portfolio_wrapper_classes' ) ):
	function matjar_portfolio_wrapper_classes() {
		
		$classes 				= array();
		$portfolio_style		= matjar_get_loop_prop( 'portfolio-style' );
		$portfolio_grid_layout	= matjar_get_loop_prop( 'portfolio-grid-layout' );
		
		wp_enqueue_script( 'isotope' );
		if( 'related-portfolios' == matjar_get_loop_prop( 'name' ) ){
			$classes[] = 'portfolio-style-1';			
			if( 'slider' == matjar_get_option( 'related-portfolios-display', 'slider' ) ) {
				$classes[]	= 'matjar-carousel';
				$classes[]	= 'owl-carousel';
				$classes[] 	= 'grid-col-xl-'.matjar_get_loop_prop( 'rs_extra_large' );
				$classes[] 	= 'grid-col-lg-'.matjar_get_loop_prop( 'rs_large' );
				$classes[] 	= 'grid-col-md-'.matjar_get_loop_prop( 'rs_medium' );
				$classes[] 	= 'grid-col-sm-'.matjar_get_loop_prop( 'rs_small' );
				$classes[] 	= 'grid-col-'.matjar_get_loop_prop( 'rs_extra_small' );
			}else{
				$classes[] = 'items-grid';
			}
		}else{
			if( 'portfolio-slider-widget' == matjar_get_loop_prop( 'name' ) ){
				$classes[] = 'matjar-carousel';
				$classes[] = 'owl-carousel';
				$classes[] = 'items-grid';
				$classes[] 	= 'grid-col-xl-'.matjar_get_loop_prop( 'rs_extra_large' );
				$classes[] 	= 'grid-col-lg-'.matjar_get_loop_prop( 'rs_large' );
				$classes[] 	= 'grid-col-md-'.matjar_get_loop_prop( 'rs_medium' );
				$classes[] 	= 'grid-col-sm-'.matjar_get_loop_prop( 'rs_small' );
				$classes[] 	= 'grid-col-'.matjar_get_loop_prop( 'rs_extra_small' );
			}else{
				$classes[] = 'portfolios-list';
				$classes[] = 'row';
			}
			
			if( 'portfolio-post-widget' != matjar_get_loop_prop( 'name' )  && 'portfolio-style-1'  != $portfolio_style ){
			//if(   ){
				$classes[] ='gutters-space-'.matjar_get_loop_prop( 'portfolio-grid-gap' );		
			//}
			}	
			
			if( ! matjar_get_loop_prop( 'portfolio-content-part' ) ){
				$classes[] ='no-content-part';
			}
			
			if( 'masonry-grid' == $portfolio_grid_layout ){
				wp_enqueue_script( 'masonry' );
			}
			
			$classes[] = $portfolio_grid_layout;
			$classes[] = matjar_get_loop_prop( 'portfolio-style' );
			
			if( matjar_get_loop_prop( 'portfolio-filter' ) ){
				$classes[] = 'portfolio-filter-enabled';
			}
			
		}
		
		$classes = apply_filters( 'matjar_portfolio_wrapper_classes', $classes );
		
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}
		
		echo esc_attr( $classes );
	}
endif;

/**
 * Checks to see if we're on the homepage or not.
 */
function matjar_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if we're on the homepage or not.
 */
function matjar_site_loader() {
	
	if( ! matjar_get_option( 'site-preloader', 0 ) ) return;
	$preloader_style = matjar_get_option('predefine-loader-style', '1' );
	if( 'predefine-loader' == matjar_get_option('preloader-image', 'predefine-loader' ) ){	
		$html = '';
		switch ( $preloader_style ) {
			case '1':
				$html ='<div class="spinner style-'.$preloader_style.'">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
				</div>';
				break;
			case '2':
				$html ='<div class="sk-folding-cube style-'.$preloader_style.'">
						<div class="sk-cube1 sk-cube"></div>
						<div class="sk-cube2 sk-cube"></div>
						<div class="sk-cube4 sk-cube"></div>
						<div class="sk-cube3 sk-cube"></div>
					</div>';
				break;
			case '3':
				$html ='<div class="spinner style-'.$preloader_style.'"></div>';
				break;
			case '4':
				$html ='<div class="spinner style-'.$preloader_style.'">						
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>';
				break;
			case '5':
				$html ='<div class="spinner style-'.$preloader_style.'">						
						<div class="rect1"></div>
						<div class="rect2"></div>
						<div class="rect3"></div>
						<div class="rect4"></div>
						<div class="rect5"></div>
					</div>';
				break;
		}
		$html = '<div class="matjar-site-preloader">'.$html.'</div>';
	}else{		
		$html = '<div class="matjar-site-preloader"></div>';
	}
	
	echo apply_filters( 'matjar_site_preloader', $html, $preloader_style );
}

/**
 * Global
 */
if ( ! function_exists( 'matjar_output_content_wrapper' ) ) {

	/**
	 * Output the start of the page wrapper.
	 */
	function matjar_output_content_wrapper() {
		matjar_get_template( 'template-parts/global/wrapper-start.php' );		
	}
}
if ( ! function_exists( 'matjar_output_content_wrapper_end' ) ) {

	/**
	 * Output the end of the page wrapper.
	 */
	function matjar_output_content_wrapper_end() {
		matjar_get_template( 'template-parts/global/wrapper-end.php' );
	}
}

if( ! function_exists( 'matjar_mobile_menu' ) ) {
	/**
	 * Header Mobile menu
	 */
	function matjar_mobile_menu() {
		
		$mobile_primary_menu 		= 'mobile-menu';
		$mobile_categories_menu 	= 'mobile-categories-menu';
		
		if ( ! has_nav_menu( $mobile_primary_menu ) ) {
			$mobile_primary_menu = 'primary';
		}
		
		if ( ! has_nav_menu( $mobile_categories_menu ) ) {
			$mobile_categories_menu = 'categories-menu';
		}
		
		$primary_menu_location 		= apply_filters( 'matjar_mobile_primary_menu_location', $mobile_primary_menu );
		$categories_menu_location 	= apply_filters( 'matjar_mobile_categories_menu_location', $mobile_categories_menu );
		$mobile_signup_text			= apply_filters( 'matjar_mobile_signup_text', esc_html__('Login & Signup','matjar') );
		$mobile_menu_text			= apply_filters( 'matjar_mobile_menu_text', esc_html__('Menu','matjar') );
		$mobile_categories_text		= apply_filters( 'matjar_mobile_categories_text', esc_html__('Categories','matjar') );
		$menu_link 					= get_admin_url( null, 'nav-menus.php' );		
		$user_data 					= wp_get_current_user();
		$current_user 				= apply_filters('matjar_myaccount_username',$user_data->user_login );	?>		
		<div class="matjar-mobile-menu">
			<div class="mobile-menu-header">
				<?php
				if( MATJAR_WOOCOMMERCE_ACTIVE && matjar_get_option( 'mobile-menu-header-login-register', 1 ) ){
					$dashboard_url	= apply_filters( 'matjar_myaccount_dashboard_url', wc_get_page_permalink( 'myaccount' ) ); 
					if( ! is_user_logged_in() ):?>
						<a class="login-register customer-signinup" href="<?php echo esc_url($dashboard_url);?>"><?php echo esc_html($mobile_signup_text);?></a>
					<?php else:?>
						<a class="login-register user-myaccount" href="<?php echo esc_url($dashboard_url);?>"><?php echo esc_html($current_user);?></a>
					<?php endif;?>						
				<?php } ?>
				<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'matjar' ); ?></a>
			</div>
			
			<?php if( has_nav_menu( $primary_menu_location ) || has_nav_menu( $categories_menu_location ) ){ ?>
				<div class="mobile-nav-tabs">
					<ul>
						<li class="primary active" data-menu="primary"><span><?php echo esc_html( $mobile_menu_text );?></span></li>
						<?php if ( matjar_get_option('mobile-categories-menu', 1 ) && has_nav_menu( 'categories-menu' ) ) { ?>
							<li class="categories" data-menu="categories"><span><?php echo esc_html($mobile_categories_text);?></span></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
			
			<?php
			// Mobile Primary Menu
			$admin_menu_link = get_admin_url( null, 'nav-menus.php' );
			if ( has_nav_menu( $primary_menu_location ) ) {
				wp_nav_menu( array( 
					'theme_location' 	=> $primary_menu_location,
					'menu_class'      	=> 'mobile-main-menu',
					'container_class'	=> 'mobile-primary-menu mobile-nav-content active',
					'fallback_cb' 		=> '',
					'walker' 			=> new Matjar_Menu_Walker()
				) ); 			
			}else{ ?>
				<div class="mobile-primary-menu mobile-nav-content active">
					<span class="add-navigation-message">
						<?php printf( wp_kses( __('Add your <a href="%s">navigation menu here</a>', 'matjar' ),array( 'a' => array( 'href' => array() )	) )	, $admin_menu_link );	?>
					</span>
				</div>
			<?php }
			
			// Mobile Categories Menu
			if ( matjar_get_option('mobile-categories-menu', 1 ) && has_nav_menu( $categories_menu_location ) ) {
				wp_nav_menu( array( 
					'theme_location' 	=> $categories_menu_location,
					'menu_class'      	=> 'mobile-main-menu',
					'container_class'   => 'mobile-categories-menu mobile-nav-content',
					'fallback_cb' 		=> '',
					'walker' 			=> new Matjar_Menu_Walker()
				) );
			}?>
			
			<?php if( matjar_get_option( 'mobile-menu-social-profile', 1 ) ) { ?>
				<div class="mobile-topbar">
					<?php matjar_get_template( 'template-parts/header/elements/social-profile' ); ?>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}

/**
 * Header
 */
if ( ! function_exists( 'matjar_template_header' ) ) {

	/**
	 * Matjar template header.
	 */
	function matjar_template_header() {
		
		$args = $class = array();
		$header_style 			= matjar_get_post_meta( 'header_style' );
		if( !$header_style || $header_style == 'default' ){
			if( matjar_get_option( 'header-select', 'style' ) == 'style' ){
				$header_style 	= matjar_get_option( 'header-style', '1' );
			}else{
				$header_style 	= matjar_get_option( 'header-select', 'builder' );
			}
		}	
		$header_style 			= apply_filters( 'matjar_header_style', $header_style );
		$class[]				= ( matjar_get_option( 'header-sticky', 0 ) ) ? 'header-sticky' : '';
		$class[]				= 'header-'.$header_style;
		
		$header_top 			= matjar_get_post_meta( 'header_top' );
		$header 				= matjar_get_post_meta( 'header' );
		$header_transparent 	= matjar_get_post_meta( 'header_transparent' );
		$header_transparent_color	= matjar_get_post_meta( 'header_transparent_color' );
		
		if( !$header_top || $header_top == 'default' ){
			$header_top = matjar_get_option( 'header-topbar', 1 );				
		}elseif( $header_top == 'enable' ){
			$header_top = 1;
		}elseif( $header_top == 'disable' ){
				$header_top = 0;
		}

		if( ! $header || $header == 'default' ){
			$header = 1;				
		}elseif( $header == 'enable' ){
			$header = 1;
		}elseif( $header == 'disable' ){
				$header = 0;
		}

		if( ! $header_transparent || 'default' == $header_transparent ){
			$header_transparent = 0;
			if( matjar_get_option( 'header-transparent', 0 ) ){
				if ( is_front_page() && 'front-page' == matjar_get_option( 'header-transparent-on', 'front-page' ) ) {
					$header_transparent = 1;
				}elseif( 'all-pages' == matjar_get_option( 'header-transparent-on', 'front-page' ) ){
					$header_transparent = 1;
				}
			}
		}elseif( 'enable' == $header_transparent ){
			$header_transparent = 1;
		}elseif( 'disable' == $header_transparent ){
			$header_transparent = 0;
		}
		
		if( MATJAR_WOOCOMMERCE_ACTIVE && is_product() ){
			$header_transparent = 0;
		}
		
		if( $header_transparent ){
			$class[]	= 'header-overlay';
			if( !$header_transparent_color || $header_transparent_color == 'default' ){
				$header_transparent_color = matjar_get_option( 'header-transparent-color', 'dark' );				
			}
			$class[]	= 'header-color-'.$header_transparent_color;
		}
		
		$args['header_style']	= apply_filters( 'matjar_header_style', 'header-'.$header_style );
		$args['class']	 		= implode( ' ', array_filter( $class ) );
		$args['header_top'] 	= $header_top;
		$args['header'] 		= $header;
		
		if( ! $header ) return;
		
		matjar_get_template( 'template-parts/header/header', $args );
	}
}

if ( ! function_exists( 'matjar_search_popup' ) ) {

	/**
	 * Header search popup.
	 */
	function matjar_search_popup() {
		if( ! matjar_get_option( 'product-ajax-search', 1 ) ) {
			return;
		}?>
		<div class="matjar-search-popup">
			<div class="matjar-search-popup-wrap">
				<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'matjar' ); ?></a>
				<?php matjar_get_template( 'template-parts/header/elements/ajax-search' );?>
			</div>
		</div>
	<?php }
}

if ( ! function_exists( 'matjar_header_topbar_left' ) ) {

	/**
	 * Output header topbar left.
	 */
	function matjar_header_topbar_left() {
		$elements = matjar_get_option( 'header-topbar-manager', array ( 'left' => array ( 'email' => 'Email', 'phone-number' => 'Phone Number' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_topbar_right' ) ) {

	/**
	 * Output header topbar right.
	 */
	function matjar_header_topbar_right() {
		$elements = matjar_get_option( 'header-topbar-manager', array ( 'right' => array ( 'welcome-message' => 'Welcome Message Switcher', 'language-switcher' => 'Language Switcher', 'currency-switcher' => 'Currency Switcher' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_main_left' ) ) {

	/**
	 * Output header main left.
	 */
	function matjar_header_main_left() {
		$elements = matjar_get_option( 'header-main-manager', array ( 'left' => array ( 'logo' => 'Logo' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_main_center' ) ) {

	/**
	 * Output header main center.
	 */
	function matjar_header_main_center() {
		$elements = matjar_get_option( 'header-main-manager', array ( 'center' => array ( 'ajax-search' => 'Ajax Search' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ($elements['center']): 
			foreach ($elements['center'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_main_right' ) ) {

	/**
	 * Output header main right.
	 */
	function matjar_header_main_right() {
		$elements = matjar_get_option( 'header-main-manager', array ( 'right' => array ( 'myaccount' => 'My Account', 'wishlist' => 'Wishlist', 'cart' => 'Cart' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'header', 'custom_html' => 'header-main-custom-html' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_navigation_left' ) ) {

	/**
	 * Output header navigation left.
	 */
	function matjar_header_navigation_left() {
		$elements = matjar_get_option( 'header-navigation-manager', array ( 'left' => array ( 'category-menu' => 'Category Menu' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ($elements['left']): 
			foreach ($elements['left'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_navigation_center' ) ) {

	/**
	 * Output header navigation center.
	 */
	function matjar_header_navigation_center() {
		$elements = matjar_get_option( 'header-navigation-manager', array ( 'center' => array ( 'primary-menu' => 'Primary Menu' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ($elements['center']): 
			foreach ($elements['center'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_navigation_right' ) ) {

	/**
	 * Output header navigation right.
	 */
	function matjar_header_navigation_right() {
		$elements = matjar_get_option( 'header-navigation-manager', array ( 'right' => array ( ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ($elements['right']): 
			foreach ($elements['right'] as $element=>$value) {
				matjar_get_template( 'template-parts/header/elements/'.$element, ['custom_html' => 'header-navigation-custom-html'] );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_mobile_topbar_center' ) ) {

	/**
	 * Output header mobile topbar.
	 */
	function matjar_header_mobile_topbar_center() {
		$elements = matjar_get_option( 'header-mobile-topbar-manager', array ( 'center' => array ( 'welcome-message'=> 'Welcome Message', 'language-switcher'=> 'Language Switcher', 'currency-switcher'=> 'Currency Switcher' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ( $elements['center'] ): 
			foreach ($elements['center'] as $element => $value) {
				matjar_get_template( 'template-parts/header/elements/'.$element );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_mobile_left' ) ) {

	/**
	 * Output header mobile left.
	 */
	function matjar_header_mobile_left() {
		$elements = matjar_get_option( 'header-mobile-manager', array ( 'left' => array ( 'mobile-navbar'=> 'Mobile Nav' ) ) );
		
		if ( isset( $elements['left']['placebo'] ) ) {
			unset( $elements['left']['placebo'] );
		}
				
		if ( $elements['left'] ): 
			foreach ( $elements['left'] as $element => $value ) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_mobile_center' ) ) {

	/**
	 * Output header mobile center.
	 */
	function matjar_header_mobile_center() {
		$elements = matjar_get_option( 'header-mobile-manager', array ( 'left' => array ( 'logo' => 'Logo' ) ) );
		
		if ( isset( $elements['center']['placebo'] ) ) {
			unset( $elements['center']['placebo'] );
		}
				
		if ( $elements['center'] ): 
			foreach ( $elements['center'] as $element => $value ) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_header_mobile_right' ) ) {

	/**
	 * Output header mobile right.
	 */
	function matjar_header_mobile_right() {
		$elements = matjar_get_option( 'header-mobile-manager', array ( 'right' => array ( 'mini-search' => 'Mini Search', 'cart' => 'Cart' ) ) );
		
		if ( isset( $elements['right']['placebo'] ) ) {
			unset( $elements['right']['placebo'] );
		}
				
		if ( $elements['right'] ): 
			foreach ( $elements['right'] as $element => $value ) {
				matjar_get_template( 'template-parts/header/elements/'.$element, array( 'header_logo' => 'mobile' ) );
			}
		endif;
	}
}

if ( ! function_exists( 'matjar_is_open_categories_menu' ) ) :

	/**
	 * Check categories menu is open in home page or not.
	 */
	function matjar_is_open_categories_menu() {
		
		$return_value = false;
		
		if( is_front_page() && matjar_get_option( 'open-categories-menu', 0 ) ){
			$return_value = true;
		}
		
		return apply_filters('matjar_open_categories_menu', $return_value );
	}
endif;

/**
 * Page Title
 */
if ( ! function_exists( 'matjar_page_title' ) ) :

	/**
	 * Matjar page title.
	 */
	function matjar_page_title() {
		
		// Return if page title disable
		if( ( is_front_page() && !is_home() )
			|| ( function_exists( 'is_product' ) && is_product() ) 
			|| ( matjar_is_catalog() && !matjar_get_option( 'shop-page-title', 1 ) ) ) {
			return;
		} 
		
		if( matjar_is_vendor_page() ){
			return;			
		}
		
		$prefix 					= MATJAR_PREFIX; // Taking metabox prefix
		$page_title_section 		= matjar_get_post_meta('page_title_section');
		$page_title_style 			= matjar_get_post_meta('page_title_style');
		$title_font_size 			= matjar_get_post_meta('title_font_size');
		$page_heading 				= matjar_get_post_meta('page_heading');
		$breadcrumb 				= matjar_get_post_meta('breadsrumb');
		
		/* Style Param*/
		$title_padding_top 			= matjar_get_post_meta('title_padding_top');
		$title_padding_bottom 		= matjar_get_post_meta('title_padding_bottom');
		$title_bg_color 			= matjar_get_post_meta('title_bg_color');
		$title_color 				= matjar_get_post_meta('title_color'); /* Dark/Light */
		$title_bg_img 				= matjar_get_post_meta('title_bg_img');
		$title_bg_position 			= matjar_get_post_meta('title_bg_position');
		$title_bg_attachment 		= matjar_get_post_meta('title_bg_attachment'); /* Scroll/Fixed */
		$title_bg_repeat 			= matjar_get_post_meta('title_bg_repeat');
		$title_bg_size 				= matjar_get_post_meta('title_bg_size');
		$title_bg_opacity 			= matjar_get_post_meta('title_bg_opacity');
		
		if ( function_exists( 'is_product_category' ) && is_product_category() ) {				
			$queried_object = get_queried_object();
			$term_id        = $queried_object->term_id;				
			$cat_title_bg_img    	= get_term_meta( $term_id, $prefix.'header_banner', true );
			$sidebar_title_color    = get_term_meta( $term_id, $prefix.'sidebar_title_color', true );
			
			$cat_ancestors  = get_ancestors( $term_id, 'product_cat' );
			if ( empty( $cat_title_bg_img ) && count( $cat_ancestors ) > 0 ) {
				$parent_id   = $cat_ancestors[0];
				$cat_title_bg_img = get_term_meta( $parent_id, $prefix.'header_banner', true );
			}
			
			if( !empty( $cat_title_bg_img ) ){
				$title_bg_img 	= $cat_title_bg_img;
			}
			if( !empty( $sidebar_title_color ) ){
				$title_color 	= $sidebar_title_color;
			}
		}
		
		if ( matjar_is_product_brand() ) {				
			$queried_object = get_queried_object();
			$term_id        = $queried_object->term_id;				
			$cat_title_bg_img    	= get_term_meta( $term_id, $prefix.'header_banner', true );
			$sidebar_title_color    = get_term_meta( $term_id, $prefix.'sidebar_title_color', true );
			
			$cat_ancestors  = get_ancestors( $term_id, 'product_brand' );
			if ( empty( $cat_title_bg_img ) && count( $cat_ancestors ) > 0 ) {
				$parent_id   = $cat_ancestors[0];
				$cat_title_bg_img = get_term_meta( $parent_id, $prefix.'header_banner', true );
			}
			
			if( !empty( $cat_title_bg_img ) ){
				$title_bg_img 	= $cat_title_bg_img;
			}
			if( !empty( $sidebar_title_color ) ){
				$title_color 	= $sidebar_title_color;
			}
		}
		
		if( ! $page_title_section || $page_title_section == 'default' ){
			$page_title_section = matjar_get_option( 'page-title-layout', 'center' );				
		}elseif( $page_title_section == 'enable' ){
			$page_title_section = true;
		}elseif( $page_title_section == 'disable' ){
				$page_title_section = false;
		}
		
		if( is_tax() || is_tag() || is_category() || is_date() || is_author() ){
			if( ! matjar_get_option( 'blog-page-title', 1 ) && ! matjar_get_option( 'blog-page-breadcrumb', 1 ) ){
				$page_title_section = false;
			}
			
		}
		
		// Return if disabled page title
		if( ! $page_title_section 
			|| 'disable' == $page_title_section ) {
			return;
		}
		
		if( !$page_title_style || $page_title_style == 'default' ){
			$page_title_style = matjar_get_option( 'page-title-layout', 'center' );				
		}
		if( !$title_font_size || $title_font_size == 'default' ){
			$title_font_size = matjar_get_option( 'page-title-size', 'default' );				
		}
		
		if( !$page_heading || $page_heading == 'default' ){
			$page_heading = matjar_get_option( 'page-title', 1 );				
		}elseif( $page_heading == 'enable' ){
			$page_heading = true;
		}elseif( $page_heading == 'disable' ){
			$page_heading = false;
		}
		
		if( ! $breadcrumb || 'default' == $breadcrumb ){
			$breadcrumb = matjar_get_option( 'page-breadcrumb', 1 );				
		}elseif( 'yes' == $breadcrumb ){
			$breadcrumb = true;
		}elseif( 'no' == $breadcrumb ){
			$breadcrumb = false;
		}
		
		if ( is_home() ) {
			$page_heading = (int)matjar_get_option( 'blog-page-title', 1 );			
			$breadcrumb = matjar_get_option( 'blog-page-breadcrumb', 1 );
		}
		if( matjar_is_portfolio() ) {
			$page_heading = (int)matjar_get_option( 'portfolio-page-title', 1 );
			$breadcrumb = (int)matjar_get_option( 'portfolio-page-breadcrumb', 1 );
		}
		$custom_css = array();
		$custom_style = '';
		if( ! empty( $title_padding_top ) ){
			$custom_css[] = 'padding-top:'.$title_padding_top.'px;';
		}
		if( ! empty( $title_padding_bottom ) ){
			$custom_css[] = 'padding-bottom:'.$title_padding_bottom.'px;';
		}
		
		if( !$title_color || $title_color == 'default' ){
			$title_color = matjar_get_option( 'page-title-color', 'dark' );				
		}
		$title_bg_img = apply_filters( 'matjar_title_bg_attachment' , $title_bg_img );
		if( ! empty( $title_bg_img ) ){
			$image_src = matjar_get_image_src( $title_bg_img, 'full' );
			$custom_css[] = 'background-image:url('.$image_src.');';
			if( ! empty($title_bg_position) && $title_bg_position != 'default' ){
				$title_bg_position =  str_replace('-',' ',$title_bg_position);
				$custom_css[] = 'background-position:'.$title_bg_position.';';
			}
			if( ! empty($title_bg_attachment) && $title_bg_attachment != 'default' ){
				$custom_css[] = 'background-attachment:'.$title_bg_attachment.';';
			}
			if( ! empty($title_bg_repeat) && $title_bg_repeat != 'default' ){
				$custom_css[] = 'background-repeat:'.$title_bg_repeat.';';
			}
			if( ! empty($title_bg_size) && $title_bg_size != 'default' ){
				$custom_css[] = 'background-size:'.$title_bg_size.';';
			}
		}
		if( ! empty( $custom_css ) ){
			$custom_style .= '.page-title-wrapper {';
			$custom_style .= implode(' ',$custom_css);
			$custom_style .= '}';
		}
		if( ! empty( $title_bg_color ) ){
			$custom_css[] = 'background-color:'.$title_bg_color.';';
		}
		$title_bg_img 	= apply_filters( 'matjar_title_bg_attachment' , $title_bg_img );
		$page_heading 	= apply_filters( 'matjar_page_heading' , $page_heading );
		$breadcrumb 	= apply_filters( 'matjar_page_breadcrumb' , $breadcrumb );
		$title_color	= apply_filters( 'matjar_page_title_color' , $title_color );
		if( $page_heading || $breadcrumb  ) {
			$args 				= array();
			$class[]			= 'text-'.$page_title_style;
			$class[]			= 'title-size-'.$title_font_size;
			$class[]			= 'color-scheme-'.$title_color;
			$args['class']	 	= implode( ' ', array_filter( $class ) );
			$args['custom_css'] = '';
			$args['custom_css']	= implode( ' ', array_filter( $custom_css ) );
			matjar_get_template( 'template-parts/page-title/page-title', $args );
		}
	}
endif;

if ( ! function_exists( 'matjar_template_page_title' ) ) :

	/**
	 * Matjar template title.
	 */
	function matjar_template_page_title() {
		$page_heading 		= matjar_get_post_meta( 'page_heading' );
		
		if(!$page_heading || $page_heading == 'default'){
			$page_heading = matjar_get_option( 'page-title', 1 );				
		}elseif($page_heading == 'enable'){
			$page_heading = 1;
		}elseif($page_heading == 'disable'){
				$page_heading = 0;
		}
		if( matjar_is_portfolio() ) {
			$page_heading = (int)matjar_get_option( 'portfolio-page-title', 1 );
		}
		if( ! $page_heading ) return;

		matjar_get_template( 'template-parts/page-title/title');
	}
endif;

if ( ! function_exists( 'matjar_template_breadcrumbs' ) ) :
	/**
	 * Matjar template page breadcrumbs.
	 */
	function matjar_template_breadcrumbs( $args = array() ) {
		$breadcrumb			= matjar_get_post_meta('breadsrumb');
		
		if(!$breadcrumb || $breadcrumb == 'default'){
			$breadcrumb = matjar_get_option( 'page-breadcrumb', 1 );				
		}elseif($breadcrumb == 'yes'){
			$breadcrumb = 1;
		}elseif($breadcrumb == 'no'){
				$breadcrumb = 0;
		}
		if(matjar_is_portfolio()){
			$breadcrumb = matjar_get_option( 'portfolio-page-breadcrumb', 1 );
		}
		if( is_tax() || is_tag() || is_category() || is_date() || is_author() ){
			$breadcrumb = matjar_get_option( 'blog-page-breadcrumb', 1 );
		}
		if ( is_home()) {
			$breadcrumb = matjar_get_option( 'blog-page-breadcrumb', 1 );
		}
		$breadcrumb 	= apply_filters( 'matjar_page_breadcrumb' , $breadcrumb );
		if( ! $breadcrumb ) return;

		$delimiter = matjar_get_option( 'breadcrumbs-delimiter', 'forward-slash' );
		// use yoast breadcrumbs if enabled
		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$yoast_breadcrumbs = yoast_breadcrumb( '', '', false );
			yoast_breadcrumb( '<div class="entry-breadcrumbs">','</div>' );
			if ( $yoast_breadcrumbs ) {
				return $yoast_breadcrumbs;
			}
		}
		
		$args = wp_parse_args( $args, apply_filters( 'matjar_breadcrumb_defaults', array(
			'wrap_before' 		=> '<nav class="matjar-breadcrumb">',
			'wrap_after'  		=> '</nav>',
			'delimiter_before'	=> '<span class="delimiter-sep '.$delimiter.'">',
			'delimiter_after'	=> '</span>',
			'delimiter'   		=> '',
			'before'      		=> '',
			'after'       		=> '',
		) ) );
		$breadcrumbs = new Matjar_Breadcrumb();
		 

		$args['breadcrumb'] = $breadcrumbs->generate();

		do_action( 'matjar_breadcrumb', $breadcrumbs, $args );

		matjar_get_template( 'template-parts/page-title/breadcrumbs',$args );
	}
endif;

/**
 * Footer Subscribe
 */
if ( ! function_exists( 'matjar_template_footer_subscribe' ) ) :

	/**
	 * Matjar template footer.
	 */
	function matjar_template_footer_subscribe() {
		$footer_subscribe 		= matjar_get_post_meta( 'footer_subscribe' );
		
		if( ! $footer_subscribe || $footer_subscribe == 'default' ){
			$footer_subscribe 	= matjar_get_option( 'footer-subscribe', 0 );				
		}elseif( $footer_subscribe == 'enable' ){
			$footer_subscribe 	= 1;
		}elseif( $footer_subscribe == 'disable' ){
			$footer_subscribe 	= 0;
		}
		$footer_subscribe = apply_filters('matjar_footer_subscribe', $footer_subscribe );
		if( ! $footer_subscribe ){ return; }
		$args = array();
		$args['layout'] 		= matjar_get_option( 'footer-subscribe-layout', 'columns' );
		$args['form_style'] 	= matjar_get_option( 'subscribe-form-style', 'overlay-form' );
		$args['field_shape'] 	= matjar_get_option( 'subscribe-field-shape', 'shape-round' );
		$args['title'] 			= matjar_get_option( 'footer-subscribe-title', esc_html__( 'Subscribe to Our Newsletter', 'matjar') );
		$args['subtitle'] 		= matjar_get_option( 'footer-subscribe-subtitle', esc_html__( 'Subscribe today and get special offers, coupons and news.', 'matjar') );
		$args['class'] 			= $args['form_style'] . ' ' .$args['field_shape'];
		
		matjar_get_template( 'template-parts/footer/footer-subscribe', $args );
	}
endif;

/**
 * Footer
 */
if ( ! function_exists( 'matjar_template_footer' ) ) :

	/**
	 * Matjar template footer.
	 */
	function matjar_template_footer() {
		$footer_layout 			= matjar_get_option( 'footer-layout', '2' );
		$footer_layout_data 	= matjar_get_footer_layout( $footer_layout );
		$site_footer 			= matjar_get_post_meta( 'site_footer' );
		$footer_copyright 		= matjar_get_post_meta( 'footer_copyright' );
		
		if( ! $site_footer || $site_footer == 'default' ){
			$site_footer = matjar_get_option( 'site-footer', 1 );				
		}elseif( $site_footer == 'enable' ){
			$site_footer = 1;
		}elseif( $site_footer == 'disable' ){
				$site_footer = 0;
		}
		
		if( ! $footer_copyright || $footer_copyright == 'default' ){
			$footer_copyright = matjar_get_option( 'footer-copyright', 1 );				
		}elseif( $footer_copyright == 'enable' ){
			$footer_copyright = 1;
		}elseif( $footer_copyright == 'disable' ){
				$footer_copyright = 0;
		}
		
		if( ! matjar_footer_widget_active() ){
			$site_footer = 0;
		}
		
		$args['site_footer'] = $site_footer;
		$args['footer_copyright'] = $footer_copyright;
		$args['footer_layout_data'] = $footer_layout_data;
		
		matjar_get_template( 'template-parts/footer/footer', $args );
	}
endif;

if ( ! function_exists( 'matjar_template_footer_categories' ) ) {
	/**
	 * Footer popular categories
	 */
	function matjar_template_footer_categories() {
		$footer_categories 		= matjar_get_post_meta( 'footer_categories' );
		
		if( ! $footer_categories || $footer_categories == 'default' ){
			$footer_categories 	= matjar_get_option( 'footer-categories', 0 );				
		}elseif( $footer_categories == 'enable' ){
			$footer_categories 	= 1;
		}elseif( $footer_categories == 'disable' ){
			$footer_categories 	= 0;
		}
		$footer_categories = apply_filters('matjar_footer_subscribe', $footer_categories );
		if( ! $footer_categories ){ return; }
		get_template_part( 'template-parts/footer/footer-categories' );
	}
}

if ( ! function_exists( 'matjar_template_footer_copyright' ) ) :

	/**
	 * Matjar template footer copyright.
	 */
	function matjar_template_footer_copyright() {
		$footer_copyright 		= matjar_get_post_meta( 'footer_copyright' );
		
		if( ! $footer_copyright || $footer_copyright == 'default' ){
			$footer_copyright 	= matjar_get_option( 'footer-copyright', 1 );				
		}elseif( $footer_copyright == 'enable' ){
			$footer_copyright 	= 1;
		}elseif( $footer_copyright == 'disable' ){
			$footer_copyright 	= 0;
		}
		
		if( ! $footer_copyright ){ return; }
		
		get_template_part( 'template-parts/footer/footer-copyright' );	
	}
endif;

if ( ! function_exists( 'matjar_footer_widget_active' ) ) :
	/**
	 * Check is footer widget active
	 */
	function matjar_footer_widget_active() {
		if ( is_active_sidebar( 'footer-widget-area-1' ) 
			|| is_active_sidebar( 'footer-widget-area-2' ) 
			|| is_active_sidebar( 'footer-widget-area-3' ) 
			|| is_active_sidebar( 'footer-widget-area-4' ) ){
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'matjar_back_to_top' ) ) :

	/**
	 * Back to top button.
	 */
	function matjar_back_to_top() {
		if( ! matjar_get_option( 'back-to-top', 1 ) 
			|| ( wp_is_mobile() 
			&& ! matjar_get_option( 'back-to-top-mobile', 1 ) ) ) {
				return; 
		}?>
		
		<div class="matjar-back-to-top">
			<?php esc_html_e('Scroll To Top', 'matjar');?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_mask_overaly' ) ) :

	/**
	 * Close sidebar popup.
	 */
	function matjar_mask_overaly() {?>
	
		<div class="matjar-mask-overaly"></div>
		
	<?php }
endif;

/**
 * Sidebar
 */
if ( ! function_exists( 'matjar_get_sidebar' ) ) :

	/**
	 * Get the matjar sidebar.
	 */
	function matjar_get_sidebar() {
		get_sidebar();
	}
endif;

/**
 * Page
 */
if ( ! function_exists( 'matjar_template_page_content' ) ) :

	/**
	 * Matjar template page content.
	 */
	function matjar_template_page_content() {
		get_template_part( 'template-parts/page/content');
	}
endif;

if ( ! function_exists( 'matjar_template_page_comments' ) ) :

	/**
	 * Matjar template page comments.
	 */
	function matjar_template_page_comments() {
		get_template_part( 'template-parts/page/comments');
	}
endif;

/**
 * Post Loop
 */
if ( ! function_exists( 'matjar_post_loop_start' ) ) :

	/**
	 * Post loop start.
	 */
	function matjar_post_loop_start( $echo = true ) {
				
		ob_start();
		
		matjar_get_template( 'template-parts/post-loop/loop-start.php' );

		if ( $echo ) {
			echo apply_filters( 'matjar_post_loop_start', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'matjar_post_loop_start', ob_get_clean() );
		}		
	}
endif;

if ( ! function_exists( 'matjar_post_loop_end' ) ) :

	/**
	 * Post loop end.
	 */
	function matjar_post_loop_end( $echo = true ) {
		
		ob_start();

		matjar_get_template( 'template-parts/post-loop/loop-end.php' );

		if ( $echo ) {
			echo apply_filters( 'matjar_post_loop_end', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'matjar_post_loop_end', ob_get_clean() );
		}
	}
endif;

if ( ! function_exists( 'matjar_post_wrapper' ) ) {

	/**
	 * Post wrapper.
	 */
	function matjar_post_wrapper() {
		$output='<div class="entry-post">';
		echo apply_filters('matjar_post_wrapper',$output);
	}
}

if ( ! function_exists( 'matjar_post_wrapper_end' ) ) {

	/**
	 * Post wrapper end.
	 */
	function matjar_post_wrapper_end() {
		$output='</div>';
		echo apply_filters('matjar_post_wrapper_end',$output);
	}
}

if ( ! function_exists( 'matjar_template_loop_post_date' ) ) {

	/**
	 * Loop post date.
	 */
	function matjar_template_loop_post_date() {
		get_template_part( 'template-parts/post-loop/date' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_highlight' ) ) {

	/**
	 * Loop post highlight format, sticky.
	 */
	function matjar_template_loop_post_highlight() {
		get_template_part( 'template-parts/post-loop/highlight' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_thumbnail' ) ) {

	/**
	 * Loop post thumbnail.
	 */
	function matjar_template_loop_post_thumbnail() {
		get_template_part( 'template-parts/post-loop/thumbnail' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_header' ) ) {

	/**
	 * Loop post header.
	 */
	function matjar_template_loop_post_header() {
		get_template_part( 'template-parts/post-loop/header' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_category' ) ) {

	/**
	 * Loop post header category.
	 */
	function matjar_template_loop_post_category() {
		get_template_part( 'template-parts/post-loop/category' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_title' ) ) {

	/**
	 * Loop post header title.
	 */
	function matjar_template_loop_post_title() {
		get_template_part( 'template-parts/post-loop/title' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_meta' ) ) {

	/**
	 * Loop post header meta.
	 */
	function matjar_template_loop_post_meta() {
		get_template_part( 'template-parts/post-loop/meta' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_content' ) ) {

	/**
	 * Loop post content.
	 */
	function matjar_template_loop_post_content() {
		get_template_part( 'template-parts/post-loop/content' );		
	}
}

if ( ! function_exists( 'matjar_template_loop_post_footer' ) ) {

	/**
	 * Loop post footer.
	 */
	function matjar_template_loop_post_footer() {
		get_template_part( 'template-parts/post-loop/footer' );		
	}
}

if ( ! function_exists( 'matjar_template_read_more_link' ) ) {

	/**
	 * Loop post readmore link.
	 */
	function matjar_template_read_more_link() {
		get_template_part( 'template-parts/post-loop/readmore' );		
	}
}

if ( ! function_exists( 'matjar_pagination' ) ) {

	/**
	 * Output the pagination.
	 */
	function matjar_pagination() {
		get_template_part( 'template-parts/global/pagination' );
	}
}

/**
 * Single Post
 */
if ( ! function_exists( 'matjar_template_single_post_date' ) ) {

	/**
	 * Single post date.
	 */
	function matjar_template_single_post_date() {
		get_template_part( 'template-parts/single-post/date' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_highlight' ) ) {

	/**
	 * Single post highlight format, sticky.
	 */
	function matjar_template_single_post_highlight() {
		get_template_part( 'template-parts/single-post/highlight' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_thumbnail' ) ) {

	/**
	 * Single post thumbnail.
	 */
	function matjar_template_single_post_thumbnail() {
		get_template_part( 'template-parts/single-post/thumbnail/thumbnail', get_post_format() );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_header' ) ) {

	/**
	 * Single post header.
	 */
	function matjar_template_single_post_header() {
		get_template_part( 'template-parts/single-post/header' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_category' ) ) {

	/**
	 * Single post header category.
	 */
	function matjar_template_single_post_category() {
		get_template_part( 'template-parts/single-post/category' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_title' ) ) {

	/**
	 * Single post header title.
	 */
	function matjar_template_single_post_title() {
		get_template_part( 'template-parts/single-post/title' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_meta' ) ) {

	/**
	 * Single post header meta.
	 */
	function matjar_template_single_post_meta() {
		get_template_part( 'template-parts/single-post/meta' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_content' ) ) {

	/**
	 * Single post content.
	 */
	function matjar_template_single_post_content() {
		get_template_part( 'template-parts/single-post/content' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_footer' ) ) {

	/**
	 * Single post footer.
	 */
	function matjar_template_single_post_footer() {
		get_template_part( 'template-parts/single-post/footer' );		
	}
}

if ( ! function_exists( 'matjar_template_single_tag_social_share' ) ) {

	/**
	 * Single post Tags & Social share.
	 */
	function matjar_template_single_tag_social_share() {
		
		$args = array();
		$args['is_tag_enable'] 		= matjar_get_option( 'single-post-tag', 1 );
		$args['is_share_enable'] 	= matjar_get_option( 'single-post-social-share-link', 1 );		
		$args['social_icons_style'] = matjar_get_option( 'social-sharing-icons-style','icons-bordered' );
		$args['social_icons_shape'] = matjar_get_option( 'sharing-icons-shape','icons-shape-circle' );
		$args['social_icons_size']  = matjar_get_option( 'sharing-icons-size','icons-size-default' );
		
		matjar_get_template( 'template-parts/single-post/tags-social-share', $args );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_author_bios' ) ) {

	/**
	 * Single post author bios.
	 */
	function matjar_template_single_post_author_bios() {
		get_template_part( 'template-parts/single-post/author-bios' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_navigation' ) ) {

	/**
	 * Single post navigation.
	 */
	function matjar_template_single_post_navigation() {
		get_template_part( 'template-parts/single-post/navigation' );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_related' ) ) {

	/**
	 * Single related posts.
	 */
	function matjar_template_single_post_related( $args = array() ) {
		
		if ( ! matjar_get_option( 'single-post-related', 0 ) ) { return; }
		
		$post_id = get_the_id();
		$taxonomy = matjar_get_option( 'related-posts-taxonomy', 'post_tag' );
		
		$defaults = array (
			'post_type'     	 	=> 'post',
			'post_status' 			=> array( 'publish' ),
			'ignore_sticky_posts'	=> true,
			'post__not_in' 			=> array($post_id),
			'showposts' 			=> matjar_get_option('single-posts-related', 6),
			'orderby' 				=> matjar_get_option('related-posts-orderby', 'rand'),
			'order' 				=> matjar_get_option('related-posts-order', 'DESC'),
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		$taxs = get_the_terms($post_id, $taxonomy);
		
		if ( $taxs ) {
			$tax_ids = array();
			foreach( $taxs as $tag ) $tax_ids[] = $tag->term_id;			
		}

		if( !empty($tax_ids) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'id',
					'terms' => $tax_ids
				)
			);
		}
		
		$query 	= new WP_Query( apply_filters( 'matjar_related_posts_args', $args ) );
		
		$args['related_posts'] = $query;
		
		$unique_id = matjar_uniqid('section-');
		$slider_data = shortcode_atts( matjar_slider_options() ,array(
				'slider_margin'		=> 30,			
				'rs_extra_large'	=> 2,			
				'rs_large'     		=> 2,			
				'rs_medium'     	=> 2,
				'rs_small'     		=> 2,			
				'rs_extra_small'	=> 1,			
			));
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ));
		$args['unique_id'] = $unique_id;

		// Set global loop values.
		matjar_set_loop_prop( 'name', 'related-posts' );
		matjar_set_loop_prop( 'products-columns', 2 );
		matjar_set_loop_prop( 'rs_extra_large', 2 );
		matjar_set_loop_prop( 'rs_large', 2 );
		matjar_set_loop_prop( 'rs_medium', 2 );
		matjar_set_loop_prop( 'rs_small', 2 );
		matjar_set_loop_prop( 'rs_extra_small', 1 );
		matjar_set_loop_prop( 'blog-custom-thumbnail-size', 'medium' );
		matjar_set_loop_prop( 'specific-post-meta', array( 'post-author', 'post-comments' ) );
		matjar_get_template( 'template-parts/single-post/related.php', $args );		
	}
}

if ( ! function_exists( 'matjar_template_single_post_comments' ) ) {

	/**
	 * Single post comments.
	 */
	function matjar_template_single_post_comments() {
		get_template_part( 'template-parts/single-post/comments' );		
	}
}

/**
 * Portfolio Loop
 */
if ( ! function_exists( 'matjar_portfolio_loop_start' ) ) :

	/**
	 * Portfolio loop start.
	 */
	function matjar_portfolio_loop_start( $echo = true ) {
		ob_start();

		matjar_get_template( 'template-parts/portfolio-loop/loop-start.php' );

		if ( $echo ) {
			echo apply_filters( 'matjar_portfolio_post_loop_start', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'matjar_portfolio_post_loop_start', ob_get_clean() );
		}		
	}
endif;

if ( ! function_exists( 'matjar_portfolio_loop_end' ) ) :
	/**
	 * Portfolio loop end.
	 */
	function matjar_portfolio_loop_end( $echo = true ) {
		
		ob_start();

		matjar_get_template( 'template-parts/portfolio-loop/loop-end.php' );

		if ( $echo ) {
			echo apply_filters( 'matjar_portfolio_post_loop_end', ob_get_clean() ); // WPCS: XSS ok.
		} else {
			return apply_filters( 'matjar_portfolio_post_loop_end', ob_get_clean() );
		}
	}
endif;

if ( ! function_exists( 'matjar_template_portfolio_filter' ) ) {
	/**
	 * Portfolio filter.
	 */
	function matjar_template_portfolio_filter() {
		get_template_part( 'template-parts/portfolio-loop/filter' );		
	}
}

if ( ! function_exists( 'matjar_template_portfolio_loop_thumbnail' ) ) {
	/**
	 * Portfolio loop thumbnail.
	 */
	function matjar_template_portfolio_loop_thumbnail() {
		get_template_part( 'template-parts/portfolio-loop/thumbnail' );		
	}
}

if ( ! function_exists( 'matjar_template_portfolio_loop_action_icon' ) ) {
	/**
	 * Portfolio loop action icon.
	 */
	function matjar_template_portfolio_loop_action_icon() {
		get_template_part( 'template-parts/portfolio-loop/action-icon' );		
	}
}

if ( ! function_exists( 'matjar_template_portfolio_loop_header' ) ) {
	/**
	 * Portfolio loop header.
	 */
	function matjar_template_portfolio_loop_header() {
		get_template_part( 'template-parts/portfolio-loop/header' );		
	}
}

if ( ! function_exists( 'matjar_template_portfolio_loop_categories' ) ) {
	/**
	 * Portfolio loop header category.
	 */
	function matjar_template_portfolio_loop_categories() {
		get_template_part( 'template-parts/portfolio-loop/category' );		
	}
}

if ( ! function_exists( 'matjar_template_portfolio_loop_title' ) ) {
	/**
	 * Portfolio loop header title.
	 */
	function matjar_template_portfolio_loop_title() {
		get_template_part( 'template-parts/portfolio-loop/title' );		
	}
}

if ( ! function_exists( 'matjar_portfolio_pagination' ) ) {
	/**
	 * Output the pagination.
	 */
	function matjar_portfolio_pagination() {
		get_template_part( 'template-parts/global/pagination' );
	}
}

/**
 * Single Portfolio
 */
if ( ! function_exists( 'matjar_template_single_portfolio_image' ) ) {
	/**
	 * Output the portfolio image/gallery.
	 */
	function matjar_template_single_portfolio_image() {
		$prefix 					= MATJAR_PREFIX;
		$show_portfolio_gallery 	= matjar_get_post_meta('show_portfolio_gallery');
		$portfolio_gallery_style 	= matjar_get_post_meta('portfolio_gallery_style');
		$attachment_ids 			= get_post_meta( get_the_ID(), $prefix .'gallery_images' );
		$is_gallery_style 			= 1;
		
		if(!$show_portfolio_gallery || $show_portfolio_gallery == 'default'){
			$is_gallery_style = matjar_get_option('single-portfolio-gallery', 1);				
		}elseif($show_portfolio_gallery == 'gallery'){
			$is_gallery_style = 1;
		}elseif($show_portfolio_gallery == 'thumbnail'){
			$is_gallery_style = 0;
		}
		if($is_gallery_style){
			if(!$portfolio_gallery_style || $portfolio_gallery_style == 'default'){
				$portfolio_gallery_style = matjar_get_option('single-portfolio-gallery-style', 'slider');				
			}
		}
		$thumbnail_size		= apply_filters( 'matjar_single_portfolio_image_size', ( matjar_get_option('single-portfolio-layout', '8' ) == '12' ? 'full' : 'large' ) );
		$post_thumbnail_id 	= get_post_thumbnail_id( get_the_ID() );
		
		$carousel_classes 	= array();
		if( ! empty ( $attachment_ids ) && $is_gallery_style){
			$carousel_classes	= ( ! empty ($attachment_ids ) && $portfolio_gallery_style == 'slider' ? array('matjar-gallery-carousel', 'owl-carousel') : array( 'row', 'gallery-grid' ) );
		}
		$wrapper_classes	= apply_filters( 'matjar_single_portfolio_image_classes', array_merge( array(
			'matjar-portfolio-image',
			( has_post_thumbnail() ? 'with-images' : 'without-images' ),
		), $carousel_classes) );
		$args['thumbnail_size'] 	=  $thumbnail_size;
		$args['is_gallery_style'] 	=  $is_gallery_style;
		$args['gallery_style'] 		=  $portfolio_gallery_style;
		$args['post_thumbnail_id'] 	=  $post_thumbnail_id;
		$args['attachment_ids'] 	=  $attachment_ids;
		$args['wrapper_classes'] 	=  $wrapper_classes;
		
		matjar_get_template( 'template-parts/single-portfolio/portfolio-image',$args );
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_title' ) ) {
	/**
	 * Output the portfolio title.
	 */
	function matjar_template_single_portfolio_title() {
		
		matjar_get_template( 'template-parts/single-portfolio/title' );
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_content' ) ) {
	/**
	 * Output the portfolio content.
	 */
	function matjar_template_single_portfolio_content() {
		
		matjar_get_template( 'template-parts/single-portfolio/content' );
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_preview' ) ) {
	/**
	 * Output the portfolio preview.
	 */
	function matjar_template_single_portfolio_preview() {
		
		$args['website_link']	= get_post_meta( get_the_ID(), MATJAR_PREFIX.'website_link', true );

		if ( ! matjar_get_option( 'single-portfolio-preview-button', 1 ) || empty( $args['website_link'] ) ) { return; }
		
		matjar_get_template( 'template-parts/single-portfolio/preview', $args );
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_client' ) ) {
	/**
	 * Output the portfolio client.
	 */
	function matjar_template_single_portfolio_client() {	
		$args['client']	= get_post_meta( get_the_ID(), MATJAR_PREFIX .'client_name', true );
		
		matjar_get_template( 'template-parts/single-portfolio/client', $args);
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_date' ) ) {
	/**
	 * Output the portfolio date.
	 */
	function matjar_template_single_portfolio_date() {
				
		matjar_get_template( 'template-parts/single-portfolio/date');
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_category' ) ) {
	/**
	 * Output the portfolio categories.
	 */
	function matjar_template_single_portfolio_category() {
		
		if ( ! matjar_get_option( 'single-portfolio-category', 1 ) || empty ( matjar_get_taxonomy_list( get_the_ID(),'portfolio_cat', ', ' ) ) ) { return; }
		
		matjar_get_template( 'template-parts/single-portfolio/category');
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_skill' ) ) {
	/**
	 * Output the portfolio skill.
	 */
	function matjar_template_single_portfolio_skill() {

		if ( ! matjar_get_option( 'single-portfolio-skill', 1 ) || empty ( matjar_get_taxonomy_list( get_the_ID(),'portfolio_skills', ', ' ) ) ) { return; }
		
		matjar_get_template( 'template-parts/single-portfolio/skill');
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_share' ) ) {
	/**
	 * Output the portfolio share.
	 */
	function matjar_template_single_portfolio_share() {
		
		if ( ! matjar_get_option( 'single-portfolio-share', 1 ) ) return;
		
		$args['social_icons_style'] = matjar_get_option( 'social-sharing-style','style-1' );		
		$args['social_icons_shape'] = matjar_get_option( 'sharing-icons-shape','icons-shape-circle' );
		$args['social_icons_size']  = matjar_get_option( 'sharing-icons-size','icons-size-default' );
		matjar_get_template( 'template-parts/single-portfolio/share', $args );
	}
}

/**
 * Get HTML for a gallery image.
 *
 * @return string
 */
function matjar_get_gallery_image_html( $attachment_id, $thumbnail_size, $gallery_style='' ) {	
	$grid_classes	='';
	if( $gallery_style == 'grid' ){
		$grid_classes = 'col-12 col-sm-6';
	}elseif( $gallery_style == 'one-column' ){
		$grid_classes = 'col-12 col-sm-12';
	}
	
	$grid_classes	= apply_filters( 'matjar_post_gallery_grid_classes', $grid_classes );
	$full_size		= apply_filters( 'matjar_post_gallery_full_size', 'full' );
	$full_src       = wp_get_attachment_image_src( $attachment_id, $full_size );
	$image     		= wp_get_attachment_image( $attachment_id, $thumbnail_size );
	
	return '<div class="matjar-post-gallery__image '.$grid_classes.'"><a href="' . esc_url( $full_src[0] ) . '" data-elementor-open-lightbox="no">' . $image . '</a></div>';
}
 
if ( ! function_exists( 'matjar_template_single_portfolio_navigation' ) ) {
	/**
	 * Output the navigation.
	 */
	function matjar_template_single_portfolio_navigation() {
		get_template_part( 'template-parts/single-portfolio/navigation' );
	}
}

if ( ! function_exists( 'matjar_template_single_related_portfolio' ) ) {
	/**
	 * Output related the portfolio.
	 */
	function matjar_template_single_related_portfolio( $args =array() ) {
		
		if ( ! matjar_get_option( 'single-portfolio-related', 1 ) ) return;
		
		$post_id = get_the_id();
		$taxonomy = matjar_get_option('related-portfolios-taxonomy', 'portfolio_cat');
		
		$defaults = array (
			'post_type'     	 	=> 'portfolio',
			'post_status' 			=> array( 'publish' ),
			'ignore_sticky_posts'	=> true,
			'post__not_in' 			=> array($post_id),
			'showposts' 			=> matjar_get_option('show-related-portfolios', 6),
			'orderby' 				=> matjar_get_option('related-portfolios-orderby', 'rand'),
			'order' 				=> matjar_get_option('related-portfolios-order', 'DESC'),
		);
		
		$args = wp_parse_args( $args, $defaults );
		
		$taxs = get_the_terms($post_id, $taxonomy);
		
		if ( $taxs ) {
			$tax_ids = array();
			foreach( $taxs as $tag ) $tax_ids[] = $tag->term_id;			
		}

		if( !empty($tax_ids) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => $taxonomy,
					'field' => 'id',
					'terms' => $tax_ids
				)
			);
		}
		
		$query 	= new WP_Query( apply_filters( 'matjar_related_portfolios_args', $args ) );
		
		$args['related_portfolios'] = $query;
		
		$unique_id = matjar_uniqid('section-');
		$slider_data = shortcode_atts(matjar_slider_options(),array(
				'slider_margin'		=> 30,		
				'rs_extra_large'	=> 3,			
				'rs_large'     		=> 3,			
				'rs_medium'     	=> 2,
				'rs_small'     		=> 2,			
				'rs_extra_small'	=> 1,		
			));
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ));
		$args['unique_id'] = $unique_id;
		
		// Set global loop values.
		matjar_set_loop_prop( 'name', 'related-portfolios' );
		matjar_set_loop_prop('rs_extra_large',3);
		matjar_set_loop_prop('rs_large',3);
		matjar_set_loop_prop('rs_medium',2);
		matjar_set_loop_prop('rs_small',2);
		matjar_set_loop_prop('rs_extra_small',1);
			
		if(matjar_get_option('related-portfolios-display', 'slider') =='grid'){
			matjar_set_loop_prop( 'portfolio-grid-layout','simple-grid');
			matjar_set_loop_prop( 'portfolio-grid-columns',3);
		}
		matjar_get_template( 'template-parts/single-portfolio/related.php', $args );
	}
}

if ( ! function_exists( 'matjar_template_single_portfolio_comments' ) ) {
	/**
	 * Output portfolio the comments.
	 */
	function matjar_template_single_portfolio_comments() {
		get_template_part( 'template-parts/single-portfolio/comments' );
	}
}

if ( ! function_exists( 'matjar_newsletter_popup' ) ) {
	
	/**
	 * Newsletter Popup.
	 */
	function matjar_newsletter_popup(){
		
		if( ( ! matjar_get_option( 'newsletter-popup', 0 ) ) || 
			( 'front-page' == matjar_get_option( 'newsletter-popup-on', 'all-pages' ) && !is_front_page() ) ) {
			return; 
		}
		
		$tag_line 				= matjar_get_option( 'newsletter-tag-line', 'Subscribe today and get special offers, coupons and top news.' );
		$newsletter_layout 		= matjar_get_option( 'newsletter-layout', 'banner-left' );
		$banner 				= matjar_get_option( 'newsletter-banner', array( 'url' => MATJAR_ADMIN_IMAGES.'newsletter-banner.jpg' ) );
		$form_style 			= matjar_get_option( 'newsletter-form-style', 'overlay-form' );
		$field_shape 			= matjar_get_option( 'newsletter-field-shape', 'shape-round' );
		$class 			= $newsletter_layout. ' '.$form_style . ' ' .$field_shape ;
		?>
		<div class="matjar-newsletter-popup mfp-hide">		
			<div class="matjar-newsletter-wrap <?php echo esc_attr( $class ); ?> style-2 field-shape-square">
				<?php if( 'banner-left' == $newsletter_layout || 'banner-right' == $newsletter_layout ){ ?>
					<div class="matjar-newsletter-banner">
						<img src="<?php echo esc_url( $banner['url'] );?>" alt="<?php esc_attr_e( 'Newsletter Banner', 'matjar' );?>" />
					</div>
				<?php } ?>
				<div class="matjar-newsletter-content">
					<?php $newsletter_logo = matjar_get_option( 'newsletter-logo' );
					if( ! empty( $newsletter_logo ) ):?>
						<div class="newsletter-logo">
							<img src="<?php echo esc_url( $newsletter_logo['url'] );?>" alt="<?php esc_attr_e( 'logo', 'matjar' );?>">
						</div>
					<?php endif;?>					
					<h2 class="matjar-newsletter-title"><?php echo esc_html( matjar_get_option( 'newsletter-title', 'Upto 45% Off!' ) );?></h2>
					<p class="tag-line"><?php echo do_shortcode( $tag_line );?></p>
					<div class="newsletter-form">
						<div class="checkbox-group form-group-top clearfix">
						  <input type="checkbox" id="newsletter-donotshow" value="do-not-show">
						  <label for="newsletter-donotshow"> 
							<span class="check"></span>
							<span class="box"></span>
							<?php echo esc_html( matjar_get_option('newsletter-dont-show', 'Don\'t show this popup again') );?>
						  </label>
						</div>
					</div>
				</div>				
			</div>  	  
		</div>
		<?php
	}
}

if ( ! function_exists( 'matjar_coming_soon_redirect' ) ) {
	
	/**
	 *  Comming Soon
	 */
	function matjar_coming_soon_redirect(){
		
		$is_maintenance 	= matjar_get_option( 'maintenance-mode', 0 );
		$maintenance_page 	= matjar_get_option( 'maintenance-page', 0 );
		
        // Dont't show coming soon page if not coming soon mode on or  is user logged in.
        if ( is_user_logged_in() || !$is_maintenance ) {
            return;
        }
		
		if (!is_page( $maintenance_page ) && $is_maintenance && $maintenance_page && !current_user_can('edit_posts') && !in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ){
            wp_redirect( esc_url( home_url( 'index.php?page_id='.$maintenance_page) ) );
            exit();
        }
	}
}

if ( ! function_exists( 'matjar_mobile_bottom_navbar' ) ) {	
	/**
	 * Mobile Bottom Navbar.
	 */
	function matjar_mobile_bottom_navbar(){
		
		if( ! apply_filters( 'matjar_mobile_bottom_navbar', true ) || ! matjar_get_option( 'mobile-bottom-navbar', 0 ) ) {
			return; 
		}
		
		$mobile_elemets = matjar_get_option( 'mobile-navbar-elements',  array(
                    'enabled'  => array(
                        'shop'  		=> esc_html__( 'Shop', 'matjar' ),
						'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'matjar' ),
						'wishlist' 		=> esc_html__( 'Wishlist', 'matjar' ),
						'cart'     		=> esc_html__( 'Cart', 'matjar' ),
						'account'  		=> esc_html__( 'Account', 'matjar' ),				
                    ) ) );
		
		if ( isset( $mobile_elemets['enabled']['placebo'] ) ) {
			unset( $mobile_elemets['enabled']['placebo'] );
		}
		
		if( empty( $mobile_elemets['enabled'] ) ){
			return;
		}
		
		$args['navbar_class']	= ' navbar-color-'.matjar_get_option( 'mobile-navbar-color', 'light' );
		$args['navbar_class']	.= ( !matjar_get_option( 'mobile-navbar-label', 1 ) ) ? ' navbar-label-hide' : '';
		
		foreach ( $mobile_elemets['enabled'] as $element => $value ) {
			$element_args = array();
			switch ( $element ) {
				case 'shop':
					if ( ! function_exists( 'is_shop' ) ) {
						continue 2;
					}
					$element_args['link'] 	= get_permalink( get_option( 'woocommerce_shop_page_id' ) );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-shop', 'jricon-home' );
					$element_args['label'] 	= matjar_get_option( 'mobile-navbar-label-shop', esc_html__( 'shop', 'matjar' ) );
					$element_args['class'] 	= 'item-shop';					
					break;
				case 'wishlist':
					if ( ! function_exists( 'YITH_WCWL' ) ) {
						continue 2;
					}		
					$wishlist_page_id 		= get_option( 'yith_wcwl_wishlist_page_id' );
					$wishlist_url 			= YITH_WCWL()->get_wishlist_url();
					$element_args['link'] 	= apply_filters('matjar_myaccount_wishlist_url', $wishlist_url );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-wishlist', 'jricon-heart' );
					$element_args['count'] 	= YITH_WCWL()->count_products();
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-wishlist',esc_html__( 'Wishlist', 'matjar' ) );
					$element_args['class'] 	= 'item-wishlist';					
					if ( is_page( $wishlist_page_id ) ) {
						$element_args['class'] .= ' active';
					}
					break;			
				case 'cart':
					if( ! MATJAR_WOOCOMMERCE_ACTIVE || matjar_get_option( 'catalog-mode', 0 ) || ( ! is_user_logged_in() && matjar_get_option( 'login-to-see-price',0 ) ) ){
						continue 2;
					}					
					$element_args['link'] 	= wc_get_cart_url();
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-cart', 'jricon-handbag' );
					$element_args['count'] 	= WC()->cart->get_cart_contents_count();
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-cart', esc_html__( 'Cart', 'matjar' ) );
					$element_args['class'] 	= 'item-cart header-cart';
					if ( function_exists( 'is_cart' ) && is_cart() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'account':
					if( ! MATJAR_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$element_args['link'] 	= get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-account', 'jricon-user' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-account', esc_html__( 'Account', 'matjar' ) );
					$element_args['class'] 	= 'item-account';	
					if( ! is_user_logged_in() ){
						$element_args['class'] 	.= ' customer-signinup';	
					}
					if ( is_account_page() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'home':
					$element_args['link'] 	= home_url( '/' );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-home', 'jricon-home' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-home', esc_html__( 'Home', 'matjar' ));
					$element_args['class'] 	= 'item-home';					
					if ( is_front_page() ) {
						$element_args['class'] .= ' active';
					}
					break;
				case 'menu':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-menu', 'jricon-menu' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-menu', esc_html__( 'Menu', 'matjar' ) );
					$element_args['class'] 	= 'item-menu navbar-toggle';					
					break;
				case 'category':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-category', 'jricon-categories' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-category', esc_html__( 'Category', 'matjar' ) );
					$element_args['class'] 	= 'item-category';					
					break;
				case 'compare':
					if ( ! class_exists( 'YITH_Woocompare' ) ) {
						continue 2;
					}
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-compare', 'jricon-shuffle' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-compare', esc_html__( 'Compare', 'matjar' ) );
					$element_args['class'] 	= 'yith-woocompare-open';					
					break;
				case 'sidebar':
					if( 'full-width' == matjar_get_layout() || ! matjar_get_option( 'canvas-sidebar-mobile', 1 ) ) {
						continue 2;
					}
					if( matjar_is_catalog() ){												
						$element_args['link'] 	= '#';
						$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-filter', 'jricon-equalizer' );
						$element_args['label'] 	= matjar_get_option('mobile-navbar-label-filter', esc_html__( 'Filters', 'matjar' ) );
						$element_args['class'] 	= 'item-sidebar canvas-sidebar-icon';
					}else{						
						$element_args['link'] 	= '#';
						$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-sidebar', 'jricon-sidebar' );
						$element_args['label'] 	= matjar_get_option('mobile-navbar-label-sidebar', esc_html__( 'Sidebar', 'matjar' ) );
						$element_args['class'] 	= 'item-sidebar canvas-sidebar-icon';
					}						
					break;
				case 'search':
					$element_args['link'] 	= '#';
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-search', 'jricon-magnifier' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-search', esc_html__( 'Search', 'matjar' ) );
					$element_args['class'] 	= 'item-search search-icon-text';					
					break;
				case 'order':
					if( ! MATJAR_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$orders  = get_option( 'woocommerce_myaccount_orders_endpoint', 'orders' );
					$account_page_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					if ( substr( $account_page_url, - 1, 1 ) != '/' ) {
						$account_page_url .= '/';
					}
					$orders_url   			= $account_page_url . $orders;					
					$element_args['link'] 	= apply_filters('matjar_myaccount_orders_url', $orders_url  );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-order', 'jricon-letter' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-order', esc_html__( 'Order', 'matjar' ) );
					$element_args['class'] 	= 'item-order';	
					break;
				case 'order-tracking':
					if( ! MATJAR_WOOCOMMERCE_ACTIVE ){
						continue 2;
					}
					$tracking_pageid		= matjar_get_option('order-tracking-page', '');
					if( empty( $tracking_pageid ) ){
						continue 2;
					}
					$order_tracking_url		= apply_filters('matjar_myaccount_order_tracking_url', ( ! empty ( $tracking_pageid ) ) ? get_permalink( $tracking_pageid ) : '' );
					$element_args['link'] 	= $order_tracking_url;
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-order-tracking', 'jricon-plane' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-order-tracking', esc_html__( 'Order Tracking', 'matjar' ) );
					$element_args['class'] 	= 'item-order';					
					break;
				case 'blog':
					$element_args['link'] 	= get_permalink( get_option( 'page_for_posts' ) );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-label-icon-blog', 'jricon-note' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-label-blog', esc_html__( 'Blog', 'matjar' ) );
					$element_args['class'] 	= 'item-blog';					
					break;
				case 'custom_link1':
					$element_args['link'] 	= matjar_get_option( 'mobile-navbar-custom-link1-url', '' );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-custom-link1-icon', '' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-custom-link1-label' );
					$element_args['class'] 	= 'item-custom-link1';					
					break;
				case 'custom_link2':
					$element_args['link'] 	= matjar_get_option( 'mobile-navbar-custom-link2-url', '' );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-custom-link2-icon', '' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-custom-link2-label' );
					$element_args['class'] 	= 'item-custom-link2';					
					break;
				case 'custom_link3':
					$element_args['link'] 	= matjar_get_option( 'mobile-navbar-custom-link3-url', '' );
					$element_args['icon'] 	= matjar_get_option( 'mobile-navbar-custom-link3-icon', '' );
					$element_args['label'] 	= matjar_get_option('mobile-navbar-custom-link3-label' );
					$element_args['class'] 	= 'item-custom-link3';					
					break;
			}
			$args['elements'][$element] = apply_filters( 'matjar_mobile_bottom_navbar_element'.$element, $element_args );
		}
		
		if( empty( $args['elements'] ) ) { 
			return;
		}
		
		matjar_get_template( 'template-parts/mobile/mobile-bottom-navbar.php',$args);			
	}
}

if ( ! function_exists( 'matjar_promo_bar' ) ) {
	/**
	 * Promo bar
	 */
	function matjar_promo_bar() {
		
		if( ( matjar_get_option( 'promo-bar-close-btn', 1 ) && matjar_get_option( 'promo-bar-dismiss', 0 ) && isset( $_COOKIE['matjar_promo_bar_close'] ) ) ){
			return; 
		}
			
		$args = array();
		
		$args['promo_position'] 			= matjar_get_option( 'promo-bar-position', 'top' );
		$args['promo_position_type'] 		= matjar_get_option( 'promo-bar-position-type', 'absolute' );
		$args['promo_message'] 				= matjar_get_option( 'promo-bar-message-text', esc_html__( 'SUMMER SALE, Get 40% Off for all products.', 'matjar' ) );
		$args['promo_link_btn'] 			= matjar_get_option( 'promo-bar-link-btn', 0 );
		$args['promo_link_text'] 			= matjar_get_option( 'promo-bar-link-btn-text', esc_html__( 'Click Here', 'matjar' ) );
		$args['promo_link_url'] 			= matjar_get_option( 'promo-bar-link-btn-url', '#' );
		$args['promo_link_open_new_tab'] 	= matjar_get_option( 'promo-bar-link-open-new-tab', 0 ) ;
		$args['promo_close_btn']			= matjar_get_option( 'promo-bar-close-btn', 1 ) ;
		$args['promo_dismiss_class'] 		= '' ;
		$args['target'] 					= '_self' ;
		
		if( matjar_get_option( 'promo-bar-dismiss', 0 ) ){
			$args['promo_dismiss_class'] = 'promo-bar-dismiss' ;
		}
		
		if( matjar_get_option( 'promo-bar-link-open-new-tab', 0 ) ){
			$args['target'] = '_blank' ;
		}
		
		matjar_get_template( 'template-parts/promo-bar/promo-bar', $args );
	}
}