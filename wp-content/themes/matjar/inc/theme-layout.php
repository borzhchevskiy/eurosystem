<?php
/**
 * Custom functions for layout.
 *
 * @author 	ThemeJR
 * @package matjar/inc
 * @since 1.0
 */
 
if ( ! function_exists( 'matjar_get_layout' ) ) :
	/**
	 * Get layout base on current page
	 *
	 * @return string
	 */
function matjar_get_layout() {
    $layout = matjar_get_option( 'blog-page-layout', 'left-sidebar' );
    
    if ( isset($_GET['shop-page-layout']) ) {
        if ($_GET['shop-page-layout'] === 'left-sidebar' || $_GET['shop-page-layout'] === 'right-sidebar' || $_GET['shop-page-layout'] === 'full-width') {
            $layout = $_GET['shop-page-layout'];
        } else {
            $layout = matjar_get_option( 'shop-page-layout', 'left-sidebar' );
        }
    } elseif ( matjar_is_catalog() ) {
        $layout = matjar_get_option( 'shop-page-layout', 'left-sidebar' ); 
    } elseif ( matjar_get_post_meta( 'page_layout' ) ) {        
        $layout = matjar_get_post_meta( 'page_layout' );
    } elseif ( is_singular( 'post' ) ) {
        $layout = matjar_get_option( 'single-post-layout', 'left-sidebar' );
    } elseif ( is_singular( 'portfolio' ) ) {
        $layout = matjar_get_option( 'single-portfolio-page-layout', 'full-width' );
    } elseif( function_exists( 'matjar_is_wcmp_vendor_page' ) && matjar_is_wcmp_vendor_page() ) {
        $layout = matjar_get_option( 'vendor-page-layout', 'left-sidebar' );
    } elseif( matjar_is_wc_vendor_page() ){
        $layout = matjar_get_option( 'vendor-page-layout', 'left-sidebar' );
    } elseif( MATJAR_DOKAN_ACTIVE && ( dokan_is_store_page() || dokan_is_product_edit_page() )){
        $layout = 'full-width';
    } elseif( function_exists('matjar_is_wcmp_vendor_page') && matjar_is_wcmp_vendor_page() ){
        $layout = 'full-width';
    } elseif ( function_exists('is_product') && is_product() )  {
        $layout = matjar_get_option( 'product-page-layout', 'full-width' );
    } elseif ( function_exists( 'matjar_full_pages' ) && matjar_full_pages() )  {
        $layout = 'full-width';
    } elseif ( is_404() ) {
        $layout = 'full-width';
    } elseif ( matjar_is_portfolio() ) {
        $layout = matjar_get_option( 'portfolio-page-layout', 'full-width' );        
    } elseif (  is_singular( 'page' ) ) { 
        $layout = matjar_get_option( 'page-layout', 'full-width' );
    }
    
    $layout = !empty($layout) ? $layout : 'full-width';   
    return apply_filters( 'matjar_site_layout', $layout );
}

endif;

if ( ! function_exists( 'matjar_get_sidebar_name' ) ) :



	/**
	 * Get sidebar name on current page
	 *
	 * @return string
	 */
	function matjar_get_sidebar_name() {
		$layout = matjar_get_layout();
		$sidebar_widget = matjar_get_option( 'blog-page-sidebar-widget', 'sidebar-1' );
		if($layout == 'full-width'){
			$sidebar_widget = '';
		}else{
			if ( matjar_get_post_meta( 'sidebar_widget' ) ) {
				$sidebar_widget = matjar_get_post_meta( 'sidebar_widget' );
			} elseif ( is_singular( 'post' ) ) {
				$sidebar_widget = matjar_get_option( 'single-post-sidebar-widget', 'sidebar-1' );
			} elseif ( is_singular( 'portfolio' ) ) {
				$sidebar_widget = matjar_get_option( 'single-portfolio-sidebar-widget', 'sidebar-1' );
			} elseif( function_exists( 'matjar_is_wcmp_vendor_page' ) && matjar_is_wcmp_vendor_page() ) {
				$sidebar_widget = matjar_get_option( 'vendor-page-sidebar-widget', 'shop-page' );
			} elseif( matjar_is_wc_vendor_page() ){
				$sidebar_widget = matjar_get_option( 'vendor-page-sidebar-widget', 'shop-page' );
			} elseif ( matjar_is_catalog() ) {
				$sidebar_widget = matjar_get_option( 'shop-page-sidebar-widget', 'shop-page' );
				$prefix = MATJAR_PREFIX;
				$cat_sidebar    = '';
				if ( function_exists( 'is_product_category' ) && is_product_category() ) {
					$queried_object = get_queried_object();
					$term_id        = $queried_object->term_id;
					$cat_sidebar    = get_term_meta( $term_id, $prefix.'sidebar', true );
					$cat_ancestors  = get_ancestors( $term_id, 'product_cat' );
					if ( empty( $cat_sidebar ) && count( $cat_ancestors ) > 0 ) {
						$parent_id   = $cat_ancestors[0];
						$cat_sidebar = get_term_meta( $parent_id, $prefix.'sidebar', true );
					}
				}
				if ( matjar_is_product_brand() ) {
					$queried_object = get_queried_object();
					$term_id        = $queried_object->term_id;
					$cat_sidebar    = get_term_meta( $term_id, $prefix.'sidebar', true );
					$cat_ancestors  = get_ancestors( $term_id, 'product_brand' );
					if ( empty( $cat_sidebar ) && count( $cat_ancestors ) > 0 ) {
						$parent_id   = $cat_ancestors[0];
						$cat_sidebar = get_term_meta( $parent_id, $prefix.'sidebar', true );
					}
				}
				if( !empty( $cat_sidebar ) ){
					$sidebar_widget  = $cat_sidebar;
				}
			} elseif ( function_exists('is_product') && is_product() ) {
				$sidebar_widget = matjar_get_option( 'product-page-sidebar-widget', 'single-product' );
			} elseif ( matjar_is_portfolio() ) {
				$sidebar_widget = matjar_get_option( 'portfolio-sidebar-widget', 'sidebar-1' );
			}
		}
		
		return apply_filters( 'matjar_sidebar_widget', $sidebar_widget );
	}
endif;

if ( ! function_exists( 'matjar_get_content_columns' ) ) :
	/**
	 * Get Bootstrap column classes for content area
	 *
	 * @since  1.0
	 *
	 * @return array Array of classes
	 */
	function matjar_get_content_columns( $layout = null ) {
		$layout  		= $layout ? $layout : matjar_get_layout();
		$classes 		= array( 'col-12', 'col-md-8', 'col-lg-9', 'col-xl-9' );	
		$sidebar_name 	= matjar_get_sidebar_name();
		if ( 'full-width' == $layout  || ! is_active_sidebar( $sidebar_name ) ) {
			$classes = array( 'col-md-12' );
		}

		return apply_filters( 'matjar_content_columns', $classes );
	}
endif;

if ( ! function_exists( 'matjar_get_sidebar_columns' ) ) :
	/**
	 * Get Bootstrap column classes for sidebar area
	 *
	 * @since  1.0
	 *
	 * @return array Array of classes
	 */
	function matjar_get_sidebar_columns( $layout = null ) {
		$layout  = $layout ? $layout : matjar_get_layout();
		
		$classes = array( 'col-12', 'col-md-4', 'col-lg-3', 'col-xl-3' );


		return apply_filters( 'matjar_sidebar_columns', $classes );
	}
endif;


if ( ! function_exists( 'matjar_get_grid_class' ) ) :
	/**
	 * Function to get grid class
	 */
	function matjar_get_grid_class( $column = '3' ){
		$grid_class = '';
		switch($column){
			case 1:
				$grid_class = ' col-12';
				break;
			case 2:
				$grid_class = ' col-12 col-md-6 col-lg-6';
				break;
			case 3:
				$grid_class = ' col-12 col-md-6 col-lg-4';
				break;
			case 4:
				$grid_class = ' col-12 col-md-6 col-lg-3';
				break;
		}
		
		return apply_filters( 'matjar_get_grid_class', $grid_class );
	}
endif;

if ( ! function_exists( 'matjar_has_elementor_template' ) ) :
	/**
	 * Call elementor location template
	 */
	function matjar_has_elementor_template( $location ) {
		if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( $location ) ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'matjar_row_classes' ) ) :
	/**
	 * Get reverse class
	 */
	function matjar_row_classes(  ) {
		$layout  = matjar_get_layout();
		$classes = array();
		$classes[] = 'row';
		if( $layout == 'left-sidebar' ){
			$classes[] = 'flex-row-reverse';
		}
		$classes = apply_filters( 'matjar_row_classes', $classes );
		
		if ( is_array( $classes ) ) {
			$classes = implode( ' ', $classes );
		}		
		echo esc_attr( $classes );		
	}
endif;

if ( ! function_exists( 'matjar_is_catalog' ) ) :
	/**
	 * Check is catalog
	 *
	 * @return bool
	 */
	function matjar_is_catalog() {

		if ( function_exists( 'is_shop' ) && ( is_shop() || is_product_category() || is_product_taxonomy() || is_product_tag() || matjar_is_product_brand() ) ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'matjar_is_product_brand' ) ) :
	/**
	 * Check is catalog
	 *
	 * @return bool
	 */
	function matjar_is_product_brand() {

		if ( is_tax( 'product_brand' )  ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'matjar_full_pages' ) ) :
	/**
	 * Check is fullpage
	 *
	 * @return bool
	 */
	function matjar_full_pages() {

		if ( ( function_exists( 'is_cart' )  && is_cart() ) ||
			 ( function_exists( 'is_checkout' )  && is_checkout() ) ||
			 ( function_exists( 'is_account_page' )  && is_account_page() ) ||
			 ( function_exists( 'is_wc_endpoint_url' )  && is_wc_endpoint_url() ) || matjar_is_wishlist_page() ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'matjar_is_wishlist_page' ) ) :
	/**
	 * Check is wishlist page
	 *
	 * @return bool
	 */
	function matjar_is_wishlist_page() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			$wishlist_pageid = get_option( 'yith_wcwl_wishlist_page_id', true );
			global $post;
			if( $post ){
				$page_id = $post->ID;
				if( $page_id == $wishlist_pageid ){
					return true;
				}
			}			
		}
		return false;
	}
endif;

if ( ! function_exists( 'matjar_is_portfolio' ) ) :
	/**
	 * Check is portfolio
	 *
	 * @return bool
	 */
	function matjar_is_portfolio() {

		if (  is_post_type_archive( 'portfolio' ) || is_tax( array('portfolio_cat', 'portfolio_tag') ) ) {
			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'matjar_get_post_thumbnail_size' ) ) :
	/**
	 * Get image size
	 *
	 * @since  1.0
	 *
	 * @return string size
	 */
	function matjar_get_post_thumbnail_size() {
		$layout  					= matjar_get_layout();
		$blog_post_style			= matjar_get_loop_prop( 'blog-post-style' );
		$blog_page_show_column		= matjar_get_loop_prop( 'blog-grid-columns' );
		$blog_custom_image_size		= matjar_get_loop_prop( 'blog-custom-thumbnail-size' );
		
		$size	= 'large';
		if( $layout == 'full-width' && $blog_post_style == 'blog-classic' ){
			$size	= 'full';
		} elseif(	$blog_post_style == 'blog-grid'  && ( $layout != 'full-width' || $blog_page_show_column !=  2 ) ){
			$size	='medium';
		}
		if( ! empty( $blog_custom_image_size ) ){
			$size = $blog_custom_image_size;	 
		}
		return apply_filters( 'matjar_post_thumbnail_size', $size );
	}
endif;

if ( ! function_exists( 'matjar_is_vendor_page' ) ) :
	function matjar_is_vendor_page(){
		
		/* Dokan */
		if ( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() ) {
			return true;
		}

		/* WC Vendor */
		if ( matjar_is_wc_vendor_page() ) {
			return true;
		}	
		
		/* WCMP plugin*/
		if ( function_exists( 'matjar_is_wcmp_vendor_page' ) && matjar_is_wcmp_vendor_page() ) {
			return true;
		}
		
		/* WCFM plugin*/
		if ( function_exists( 'wcfm_is_store_page' ) && wcfm_is_store_page() ) {
			return true;
		}
		return false;
			
	}
endif;

if ( ! function_exists( 'matjar_is_wc_vendor_page' ) ) :
	/**
	 * Check is vendor page
	 *
	 * @return bool
	 */
	function matjar_is_wc_vendor_page() {
	
		if ( class_exists( 'WCV_Vendors' ) && method_exists( 'WCV_Vendors', 'is_vendor_page' ) ) {
			return WCV_Vendors::is_vendor_page();
		}		
		return false;
	}
endif;