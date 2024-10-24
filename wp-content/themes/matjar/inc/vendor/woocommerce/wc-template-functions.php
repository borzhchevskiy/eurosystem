<?php 
/**
 * Functions to allow styling of the templating system
 *
 * General core functions available on both the front-end and admin.
 *
 * @package matjar\inc
 * @version 1.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Adds custom classes to the array of body classes.
 */
function matjar_body_woocommerce_classes( $classes ) {
	
	if( apply_filters( 'matjar_mobile_products_cart_icon', true ) ){
		$classes[] = 'has-moible-product-cart-icon';
	}	
	
	if( matjar_get_option( 'shop-page-off-canvas-sidebar', 0 ) && matjar_is_catalog() ) {
		$classes[] = 'matjar-off-canvas-sidebar';
	}
	
	if( matjar_get_option( 'ajax-filter', 0 ) && matjar_is_catalog() ) {
		$classes[] = 'matjar-catalog-ajax-filter';
	}
	
	if( is_product() && matjar_get_option( 'single-product-quick-buy', 0 ) ) {
		$classes[] = 'has-single-product-quick-buy';
	}

	/* if( is_product() && matjar_get_option( 'sticky-add-to-cart-button', 1 ) ) {
		$classes[] = 'has-sticky-add-to-cart';
	} */
	
	if( is_cart() && matjar_get_option( 'cart-auto-update', 1 ) ) {
		$classes[] = 'has-auto-update-cart';
	}
	
	if( is_checkout() && matjar_get_option( 'multi-step-checkout', 0 ) ) {
		$classes[] = 'has-multi-step-checkout';
	}
	
	$classes = apply_filters( 'matjar_body_woocommerce_classes', $classes );
	
	return $classes;
}

/**
 * Product loop row classes
 */
if ( ! function_exists( 'matjar_product_row_classes' ) ):
	function matjar_product_row_classes(){
		
		$product_style 			= matjar_get_loop_prop( 'product-style' );
		$products_columns 		= matjar_get_loop_prop( 'products-columns' ); 
		$classes[] 				= $product_style;				
		
		if( matjar_get_loop_prop( 'name' ) == 'matjar-carousel' ){
			$classes[] 			= 'grid-view';
			$product_layout	 	= 'matjar-carousel';
			$classes[] 			= 'owl-carousel';
			$classes[] 			= 'grid-col-lg-'.matjar_get_loop_prop( 'rs_large' );
			$classes[] 			= 'grid-col-md-'.matjar_get_loop_prop( 'rs_medium' );
			$classes[] 			= 'grid-col-'.matjar_get_loop_prop( 'rs_extra_small' );
		}else{			
			$classes[] 			= 'row';
			$product_layout	 	= 'products-wrap';
			$classes[] 			= matjar_get_loop_prop( 'products_view' );
		}
		$classes[] 			= $product_layout;
		$classes[]			= matjar_get_loop_prop( 'product-action-buttons-style' );
		
		if( apply_filters( 'matjar_products_cart_icon', false ) ){
			$classes[] 		= matjar_product_button_class( $product_style, $products_columns );	
		}	
		$classes[]			=  ( matjar_get_option( 'product-quantity-field', 1 ) ) ? 'has-quantity-field' : '';
		
		$classes = apply_filters( 'matjar_product_row_classes', $classes );
		
		return implode( ' ', $classes );
	}
endif;

if ( ! function_exists( 'matjar_product_button_class' ) ):
	function matjar_product_button_class( $product_style ='', $products_columns = '' ){
		
		if( empty ( $product_style ) || empty ( $products_columns ) || 'product-style-3' == $product_style ){
			return 'return';
		}
		
		$element 	= matjar_get_loop_prop( 'products-element' );		
		if( '6' == $products_columns ){
			return 'product-cart-icon';
		}elseif( ( ! empty ($element) && 'products-with-banner' == $element ) && '5' == $products_columns  ) {
			return 'product-cart-icon';
		}elseif( function_exists( 'dokan_is_store_page' ) && dokan_is_store_page() && $products_columns > 3 ){
			return 'product-cart-icon';
		}
	}
endif;

/**
 * Product loop classes
 */
if( ! function_exists( 'matjar_product_loop_classes' ) ):
	function matjar_product_loop_classes() {
		$classes = array();		
		if( matjar_get_loop_prop( 'name' ) != 'matjar-carousel' ){
			$classes[] = 'col-lg-'.matjar_get_rs_grid_columns( matjar_get_loop_prop( 'products-columns' ) );
			$classes[] = 'col-md-'.matjar_get_rs_grid_columns( matjar_get_loop_prop( 'products-columns-tablet' ) );
			$classes[] = 'col-'.matjar_get_rs_grid_columns( matjar_get_loop_prop( 'products-columns-mobile' ) );
		}
		return apply_filters( 'matjar_product_loop_classes', $classes );
	}
endif;

/**
 * Product classes
 */
function matjar_woocommerce_product_class (){
 
	$classes		= [];	
	$classes[]		= 'single-product-page';
	$classes[]		= matjar_get_product_gallery_layout();
	
	return $classes;
}

/**
 * Adds extra post classes for products.
 *
 * @return array
 */
function matjar_get_product_gallery_layout() {
	
	$product_layout = matjar_get_post_meta( 'single_product_layout' );
	if( ! $product_layout ){
		$product_layout = matjar_get_option( 'product-gallery-style', 'product-gallery-left' );			
	}	
	return $product_layout;
}

/**
 * Mini Cart Slide
 */
if( ! function_exists( 'matjar_minicart_slide' ) ) :
	function matjar_minicart_slide(){ 
	
		if ( 'slider' != matjar_get_option( 'header-minicart-popup', 'slider' ) ){ return; }?>
	
		<div class="matjar-minicart-slide">
			<div class="minicart-header">
				<h3 class="minicart-title"><?php echo apply_filters( 'matjar_mini_cart_header_text', esc_html__('Shopping Cart','matjar' ) );?></h3>
				<a href="#" class="close-sidebar"><?php esc_html_e( 'Close', 'matjar' ); ?></a>
			</div>
			<div class="woocommerce widget_shopping_cart">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart();?>
				</div>
			</div>
		</div>
		<?php
	}
endif;

/**
 * Canvas Sidebar
 */
if( ! function_exists( 'matjar_canvas_sidebar' ) ) :
	function matjar_canvas_sidebar() {
		
		if( 'full-width' == matjar_get_layout() || matjar_get_option( 'shop-page-off-canvas-sidebar', 0 ) || ! matjar_get_option( 'canvas-sidebar-mobile', 1 ) ) {
			return;
		}
		if( matjar_get_option( 'mobile-bottom-navbar', 0 ) ){
			$mobile_elemets = (array)matjar_get_option( 'mobile-navbar-elements',  array(
                    'enabled'  => array(
                       'shop'  			=> esc_html__( 'Shop', 'matjar' ),
						'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'matjar' ),
						'wishlist' 		=> esc_html__( 'Wishlist', 'matjar' ),
						'cart'     		=> esc_html__( 'Cart', 'matjar' ),
						'account'  		=> esc_html__( 'Account', 'matjar' ),							
                    ) ) );
			
			if(!isset($mobile_elemets['enabled'])){
				$mobile_elemets['enabled'] =  array(
				   'shop'  		=> esc_html__( 'Shop', 'matjar' ),
					'sidebar'  	=> esc_html__( 'Sidebar/Filters', 'matjar' ),
					'wishlist' 	=> esc_html__( 'Wishlist', 'matjar' ),
					'cart'     	=> esc_html__( 'Cart', 'matjar' ),
					'account'  	=> esc_html__( 'Account', 'matjar' ),							
				);
			}		
			if( array_key_exists( 'sidebar', $mobile_elemets['enabled'] ) ){
				return;
			}
		}?>
		
		<div class="matjar-canvas-sidebar">
			<div class="canvas-sidebar-icon"><?php esc_html_e( 'Sidebar', 'matjar' )?></div>
		</div>
		<?php
	}
endif;

/**
 * User Login Signup Popup
 */
if( ! function_exists( 'matjar_login_signup_popup' ) ) :
	function matjar_login_signup_popup() {
		
		if( !matjar_get_option( 'show-login-register-popup', 1 ) ){
			return;
		}
		if ( ! shortcode_exists( 'woocommerce_my_account' ) || is_user_logged_in() ) {
			return;
		}
		if( is_account_page() ){
			return;
		} ?>	
		<div id="matjar-signin-up-popup" class="matjar-signin-up-popup mfp-hide">
			<?php echo do_shortcode( '[woocommerce_my_account]' ); ?>
		</div>
		<?php
	}
endif;

/** 	
 * Ajax Count Wishlist Product
 */
if( ! function_exists( 'matjar_ajax_wishlist_count' ) ) :
	function matjar_ajax_wishlist_count() {
		if( function_exists( 'YITH_WCWL' ) ){
			wp_send_json( YITH_WCWL()->count_products() );
			die();
		}
	}
endif;

/* 	Ajax Count Compare Product
/* --------------------------------------------------------------------- */
if( ! function_exists( 'matjar_ajax_compare_count' ) ) :
	function matjar_ajax_compare_count(){
		
		if( defined( 'YITH_WOOCOMPARE' ) ){	
			$products_list=array();
			$products_list = isset( $_COOKIE[ 'yith_woocompare_list' ] ) && !empty($_COOKIE[ 'yith_woocompare_list' ]) ? maybe_unserialize( $_COOKIE[ 'yith_woocompare_list' ] ) : array();
			$products_list= json_decode($products_list);
			if (!empty($products_list) && $products_list > 0) {
				
				if( isset( $_REQUEST['id'] ) ) {
					if ( $_REQUEST['id'] == 'all' ) {
						unset($products_list);
					} else {
						$products_list=array_diff($products_list, array($_REQUEST['id']));
					}
				}			
				
				echo count($products_list);
			} else {
				echo '0';
			}
		}
		die();
	}
endif;

/** 	
 * Ensure cart contents update when products are added to the cart via AJAX
 */
if( ! function_exists( 'matjar_cart_data' ) ) :
	add_filter('woocommerce_add_to_cart_fragments', 'matjar_cart_data', 30);
	function matjar_cart_data( $array ) {
		$count  		= WC()->cart->get_cart_contents_count();
		$cart_count 	= '<span class="header-cart-count">'.WC()->cart->get_cart_contents_count().'</span>';
		$cart_total 	= '<span class="header-cart-total">'.WC()->cart->get_cart_subtotal().'</span>';
		$cart_item_text = '<span class="header-cart-item-text">'.WC()->cart->get_cart_contents_count().' '._n( 'item', 'items', $count, 'matjar' ).'</span>';
		
		$array['span.header-cart-count'] 		= $cart_count;
		$array['span.header-cart-total'] 		= $cart_total;
		$array['span.header-cart-item-text'] 	= $cart_item_text;
		
		return $array;
	}
endif;

/** 	
 * Empty Mini Cart Shop Button
 */
if( ! function_exists( 'matjar_empty_mini_cart_button' ) ) :
	function matjar_empty_mini_cart_button(){?>
	<p class="woocommerce-empty-mini-cart__buttons">
		<a class="button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php echo apply_filters( 'matjar_woocommerce_empty_mini_cart_button_text', esc_html__( 'Continue Shopping', 'matjar' ) );?></a>
	</p>
	<?php }
endif;

/** 	
 * Checkout Progress Steps
 */
if( ! function_exists( 'matjar_checkout_steps' ) ) :
	function matjar_checkout_steps(){	
				
		$step = 1;
		if( is_checkout() ){
			$step = 2;
		}
		if( is_order_received_page() ){
			$step = 3;
		}?>
		
		<ul class="matjar-chekout-steps">
			<li class="step <?php echo esc_attr( $step == 1 ) ? 'current' : ''; ?>">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<span><?php esc_html_e( 'Shopping Cart', 'matjar' ); ?></span>
				</a>
			</li>
			<li class="step <?php echo esc_attr( $step == 2 ) ? 'current' : ''; ?>">
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
					<span><?php esc_html_e( 'Checkout', 'matjar' ); ?></span>
				</a>
			</li>
			<li class="step <?php echo esc_attr( $step == 3 ) ? 'current' : ''; ?>">
				<span><?php esc_html_e( 'Order Complete', 'matjar' ); ?></span>
			</li>
		</ul>
		<?php
	}
endif;

/**
 * Shop Loop Header
 */
if( ! function_exists( 'matjar_before_shop_loop' ) ) :
	function matjar_before_shop_loop(){ ?>
		<div class="products-header">
			<div class="products-header-left">
				<?php 
				/**
				 * Hook: matjar_shop_loop_header_left.
				 *
				 * @hooked matjar_shop_page_title - 10
				 * @hooked matjar_proudcts_result_count - 20
				 */
				do_action( 'matjar_shop_loop_header_left' );
				?>
			</div>
			<div class="products-header-right">
				<?php 
				/**
				 * Hook: matjar_shop_loop_header_right.
				 *
				 * @hooked matjar_product_loop_view - 20
				 * @hooked matjar_product_loop_show - 25
				 * @hooked woocommerce_catalog_ordering - 30
				 * @hooked matjar_product_filter_top - 35
				 */
				do_action( 'matjar_shop_loop_header_right' );
				?>
			</div>
		</div>
	<?php }
endif;

if ( ! function_exists( 'matjar_shop_page_title' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function matjar_shop_page_title() { ?>
		<h5 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h5>
	<?php }
endif;

if ( ! function_exists( 'matjar_product_loop_view' ) ) :
	/**
	 * Products view grid/list style on shop page
	 */
	function matjar_product_loop_view() {
		
		if( ! matjar_get_loop_prop( 'products-view-icon' ) || ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) return;
		$product_view = matjar_get_loop_prop('products_view')
		?>
		<div class="products-view">
			<a class="grid-view <?php echo esc_attr( $product_view =='grid-view' ) ? 'active' : ''; ?>" data-shopview="grid-view" href="<?php echo esc_url( add_query_arg( array( 'view' => 'grid-view' ) ) );?>"><?php esc_html_e('Grid View','matjar');?></a>
			<a class="list-view <?php echo esc_attr( $product_view =='list-view' ) ? 'active' : ''; ?>" data-shopview="list-view" href="<?php echo esc_url( add_query_arg( array( 'view' => 'list-view' ) ) );?>"><?php esc_html_e('List View','matjar');?></a>
		</div>
		<?php 
	}
endif;

if ( ! function_exists( 'matjar_product_loop_show' ) ) :
	/**
	 * Show number of products per page on product loop
	 */
	function matjar_product_loop_show() {
			
		if( ! matjar_get_loop_prop( 'products-per-page-dropdown', 1 ) || ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) return;
		
		$show_numbers = matjar_get_shop_viewnumbers();
		$loop_shop_per_page = matjar_loop_shop_per_page();
		
		if( !empty( $show_numbers ) ) { ?>
			<div class="product-show">
				<form class="show-products-number" method="get">
					<span><?php esc_html_e('Show:','matjar');?></span>
					<select class="show-number per_page" name="per_page">
						<?php foreach( $show_numbers as $show_per_page ) { 	?> 
							<option value="<?php echo esc_attr($show_per_page); ?>" <?php selected( $show_per_page, $loop_shop_per_page );?>><?php echo absint($show_per_page);?></option>
						<?php } ?>
					</select>
					<?php
					foreach( $_GET as $name => $value ) {
						if ( 'per_page' != $name ) {
							printf( '<input type="hidden" name="%s" value="%s">', esc_attr( $name ), esc_attr( $value ) );
						}
					}
					?>
				</form>
			</div>
		<?php }
	}
endif;

if ( ! function_exists( 'matjar_active_filter_widgets' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function matjar_active_filter_widgets() { ?>
		<div class="matjar-active-filters">
			<?php 

				do_action( 'matjar_before_active_filters_widgets' );

				the_widget( 'WC_Widget_Layered_Nav_Filters', array('title' => ''), array() ); 

				do_action( 'matjar_after_active_filters_widgets' );

			?>
		</div>
	<?php
		}
endif;

if ( ! function_exists( 'matjar_clear_filters_btn' ) ) :
	/**
	 * Show the shop page title on the product loop. By default this is an H1.
	 */
	function matjar_clear_filters_btn() { 
			global $wp;  
			$url = home_url( add_query_arg( array( $_GET ), $wp->request ) );
			$filters = array( 'filter_', 'rating_filter', 'min_price', 'max_price', 'product_visibility', 'stock', 'onsales' );
			$need_clear = false;
				
			foreach ( $filters as $filter )
				if ( strpos( $url, $filter ) ) $need_clear = true;	
				
			if ( $need_clear ) {
				$reset_url = strtok( $url, '?' );
				if ( isset( $_GET['post_type'] ) ) $reset_url = add_query_arg( 'post_type', wc_clean( wp_unslash( $_GET['post_type'] ) ), $reset_url );
				?>
					<div class="matjar-clear-filters-wrapp">
						<a class="matjar-clear-filters" href="<?php echo esc_url( $reset_url ); ?>"><?php echo esc_html__( 'Clear filters', 'matjar' ); ?></a>
					</div>
				<?php
			}
		}
endif;

if ( ! function_exists( 'matjar_product_off_canvas_sidebar' ) ) :
	/**
	 * Product Off Canvas Sidebar Button
	 */
	function matjar_product_off_canvas_sidebar() {
			
		if( ! matjar_get_option( 'shop-page-off-canvas-sidebar', 0 ) ) {
			return;
		}
		
		$filter_text =  matjar_get_option( 'off-canvas-button-text', esc_html__('Filters', 'matjar') ); ?>
		
		<span class="matjar-product-off-canvas-btn"><?php echo esc_html( $filter_text );?></span>
	
	<?php }
endif;

if( ! function_exists( 'matjar_loop_shop_per_page' ) ) :
	/**
	 * Set per page product loop product page
	 */
	function matjar_loop_shop_per_page(){
		
		$shop_loop_per_page = matjar_get_loop_prop( 'products-per-page' );
		if ( isset( $_GET[ 'per_page' ] ) ) {
			return $_GET[ 'per_page' ];
		}
		
		return $shop_loop_per_page;
	}
	add_filter( 'loop_shop_per_page', 'matjar_loop_shop_per_page', 20 );
endif;

if ( ! function_exists( 'matjar_loop_product_wrapper' ) ) :
	/**
	 * Product loop wrapper start
	 */
	function matjar_loop_product_wrapper() { ?>
		<div class="product-wrapper">
	<?php }
endif;

if ( ! function_exists( 'matjar_product_wrapper_end' ) ) :
	/**
	 * Product loop wrapper end
	 */
	function matjar_product_wrapper_end() { ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'matjar_before_shop_loop_item_title' ) ) :
	/**
	 * Product loop image
	 */
	function matjar_before_shop_loop_item_title() { ?>
		<div class="product-image">
			<?php
			/**
			 * Hook: matjar_before_shop_loop_item_title.
			 *
			 * @hooked matjar_template_loop_product_thumbnail - 10
			 */
			 do_action( 'matjar_before_shop_loop_item_title' );?>
		 </div>
		 <?php 
	}
endif;

if ( ! function_exists( 'matjar_subcategory_count_html' ) ) :
	/**
	 * Categories loop products count
	 */
	function matjar_subcategory_count_html( $html, $category ) { 	
		 return sprintf(
			'<span class="product-count">%1$s</span>',
			sprintf( _n( '%s Product', '%s Products', $category->count, 'matjar' ), $category->count )
		);
	}
	add_filter('woocommerce_subcategory_count_html', 'matjar_subcategory_count_html', 10, 2);
endif;

if ( ! function_exists( 'matjar_template_loop_product_thumbnail' ) ) :
	/**
	 * Get the product thumbnail, slider for the loop.
	 */
	function matjar_template_loop_product_thumbnail() {
				
		global $product;

		$image_size 	= apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );		
		$attachment_ids = $product->get_gallery_image_ids();
		$hover_image 	= '';
		$mobile_hover_image	= true;
		
		if( wp_is_mobile() && ! matjar_get_option( 'mobile-product-hover-image', 0 ) ) {
			$mobile_hover_image	= false;
		}

		if ( $mobile_hover_image && ! empty( $attachment_ids[0] ) ) {
			$hover_image = matjar_get_image_html( $attachment_ids[0] , $image_size, 'hover-image' );
		}
		
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		$target = '_self';
		if( matjar_get_option( 'open-product-page-new-tab', 0 ) ){
			$target = '_blank';
		}
		
		$html = '<a href="'. esc_url( $link ) .'" class="woocommerce-LoopProduct-link" target="'.$target.'">';		
			$html .=  $product ? matjar_get_post_thumbnail( $image_size, 'front-image' ) : '';			
			if( '' != $hover_image && matjar_get_option( 'product-hover-image', 1 ) ) {				
				$html .= $hover_image;
			}
		$html .= '</a>';
		
		echo apply_filters( 'matjar_template_loop_product_thumbnail', $html );
	}
endif;

if ( ! function_exists( 'matjar_shop_loop_item_title' ) ) :
	/**
	 * Product loop title hooke
	 */
	function matjar_shop_loop_item_title() { 
		/**
		 * Hook: matjar_shop_loop_item_title.
		 *
		 * @hooked matjar_loop_product_info_wrapper - 5
		 * @hooked matjar_product_title_rating_wrapper - 10
		 * @hooked matjar_product_loop_category - 15
		 * @hooked woocommerce_template_loop_product_title - 20
		 * @hooked woocommerce_template_single_excerpt - 30
		 * @hooked matjar_product_wrapper_end - 50
		 */
		 do_action( 'matjar_shop_loop_item_title' );
	}
endif;

if ( ! function_exists( 'matjar_loop_product_info_wrapper' ) ) :
	/**
	 * Product loop info wrapper start
	 */
	function matjar_loop_product_info_wrapper() { ?>
		<div class="product-info">
	<?php }
endif;

if ( ! function_exists( 'matjar_product_title_rating_wrapper' ) ) :
	/**
	 * Product loop title & rating
	 */
	function matjar_product_title_rating_wrapper() { ?>
		<div class="product-title-rating">
	<?php }
endif;

if( ! function_exists( 'matjar_product_loop_categories' ) ) :
	
	function matjar_product_loop_categories() {

		global $product;
		
		if( ! matjar_get_loop_prop( 'product-category' ) ) { return; } ?>
		
		<div class="product-cats">
			<?php echo wc_get_product_category_list( $product->get_id(), ', ' );?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) :
	/**
	 * Show the product title in the product loop. By default this is an H3.
	 */
	function woocommerce_template_loop_product_title() {
		
		if( ! matjar_get_loop_prop( 'product-title' ) ) { return; }
		global $product;

		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
		
		$target = '_self';
		if( matjar_get_option( 'open-product-page-new-tab', 0 ) ){
			$target = '_blank';
		}
		echo '<h3 class="product-title"><a href="' . esc_url( $link ) . '" target="'.$target.'">' . get_the_title() . '</a></h3>';
	}
endif;

if ( ! function_exists( 'matjar_after_shop_loop_item_title' ) ) :
	/**
	 * Product loop action buttons
	 */
	function matjar_after_shop_loop_item_title() { ?>
		<div class="product-price">
			<?php
			/**
			 * Hook: matjar_after_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 * @hooked matjar_product_loop_compare_button - 15
			 * @hooked matjar_product_loop_quick_view_button - 20
			 */
			 do_action( 'matjar_after_shop_loop_item_title' );?>
		 </div>
		 <?php 
	}
endif;

if ( ! function_exists( 'matjar_product_price_buttons_wrapper' ) ) :
	/**
	 * Product loop price & buttons
	 */
	function matjar_product_price_buttons_wrapper() { ?>
		<div class="product-price-buttons">
	<?php }
endif;

if ( ! function_exists( 'matjar_product_labels' ) ) :
	/**
	 * Product labels
	 */
	function matjar_product_labels( $sale_label ='' ) {
		global $product;
		$output 				= array();
		$sale_percentage_label 	= ( $sale_label == 'percentages' ) ? $sale_label : matjar_get_loop_prop( 'sale-product-label-text-options' );
		
		if ( matjar_get_loop_prop( 'product-new-label' ) ) {
			
			$postdate 		= get_the_time( 'Y-m-d' );								// Post date
			$postdatestamp 	= strtotime( $postdate );								// Timestamped post date
			$newness 		= matjar_get_loop_prop( 'product-newness-days' ); 	// Newness in days
			$new_label_text	= matjar_get_loop_prop( 'new-product-label-text' );

			if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
				$output['new'] = '<span class="new">' . $new_label_text . '</span>';
			}					
		}
		
		if( $product->is_on_sale() && matjar_get_loop_prop( 'sale-product-label' ) ) {		
			$percentage = '';
			if( $product->get_type() == 'variable' && $sale_percentage_label =='percentages' ){				
				$available_variations = $product->get_variation_prices();
				$max_value = 0;
				foreach( $available_variations['regular_price'] as $key => $regular_price ) {					
					$sale_price = $available_variations['sale_price'][$key];					
					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
						if ( $percentage > $max_value ) {
							$max_value = $percentage;
						}
					}
				}
				$percentage = $max_value;
				
			} elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' ) && $sale_percentage_label =='percentages' ) {				
				$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
			}
			if ( $percentage ) {	
				$sale_percentage_label_text = matjar_get_loop_prop( 'sale-product-label-percentage-text' ); 
				$output['sale'] = '<span class="on-sale"><span>'. $percentage . '</span>% ' .$sale_percentage_label_text. '</span>';
			}else{				
				if($product->is_on_sale() && $sale_percentage_label == 'percentages' ){
					/* Fixed issue for you may also like variable products*/
					$percentage = 0;
					if($product->get_regular_price() && $product->get_sale_price()){
						$percentage = round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 );
					}
					if( $percentage > 0 ){
						$sale_percentage_label_text = matjar_get_loop_prop( 'sale-product-label-percentage-text' );
						$output['sale'] = '<span class="on-sale"><span>'. $percentage . '</span>% ' .$sale_percentage_label_text. '</span>';
					}
				} else {
					$sale_label_text = matjar_get_loop_prop( 'sale-product-label-text' );
					$output['sale'] = '<span class="on-sale"><span>' . $sale_label_text . '</span></span>';
				}
				
			}
		}		

		if ( $product->is_featured() && matjar_get_loop_prop( 'featured-product-label' ) ) {
			$featured_label_text = matjar_get_loop_prop( 'featured-product-label-text' );
			$output['featured'] = '<span class="featured">' . $featured_label_text . '</span>';
		}	
		
		if( !$product->is_in_stock() && matjar_get_loop_prop( 'outofstock-product-label' ) ){
			$out_stock_label_text = matjar_get_loop_prop( 'outofstock-product-label-text' );
			$output['out_of_stock'] = '<span class="out-of-stock">' . $out_stock_label_text . '</span>';
		}
		if ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) {
			if(isset($output['sale'])){
				unset($output['sale']);
			}
		}		
		return apply_filters( 'matjar_product_labels', $output );
	}
endif;

if ( ! function_exists( 'matjar_output_product_labels' ) ) :
	/**
	 * Product labels
	 */
	function matjar_output_product_labels() {
		
		if( ! matjar_get_loop_prop( 'product-labels' ) ){ return; }
		
		$output_labels = matjar_product_labels();
		$html='';
		$current_filter = current_filter();
		if( isset( $output_labels['sale'] ) && 
		( ! is_product() && matjar_get_loop_prop( 'sale-product-label-after-price' ) == 'after-price' ) || 
		( is_product() && $current_filter == 'woocommerce_before_single_product_summary' && matjar_get_loop_prop( 'sale-single-product-label-after-price' ) == 'after-price' ) ){
			unset($output_labels['sale']);
		}
		if(isset( $output_labels['sale'] ) && is_product() && matjar_get_loop_prop( 'sale-product-label-after-price' ) == 'after-price' && $current_filter != 'woocommerce_before_single_product_summary' ){
			unset($output_labels['sale']);
		}
		if( isset( $output_labels['out_of_stock'] ) && ( is_product() && $current_filter == 'matjar_product_gallery_top') ){			
			unset($output_labels['out_of_stock']);			
		}		
		if ( ! empty( $output_labels ) ) {
			$html = '<div class="product-labels">' . implode( '', $output_labels ) . '</div>';
		}
		echo apply_filters( 'matjar_output_product_labels', $html, $output_labels );
	}
endif;

if ( ! function_exists( 'matjar_product_sale_percentage' ) ) :
	/**
	 * Product sale percentage
	 */
	function matjar_product_sale_percentage() {

		if( ! matjar_get_loop_prop( 'product-labels' ) || 
		matjar_get_loop_prop( 'sale-product-label-after-price' ) != 'after-price' || 
		! matjar_get_loop_prop( 'sale-product-label' ) ) return;
		
		$output_label = matjar_product_labels();
		
		echo ( isset( $output_label['sale'] ) && ( matjar_get_loop_prop( 'sale-product-label-after-price' ) == 'after-price' ) ) ? $output_label['sale'] : '';
	}
endif;

if ( ! function_exists( 'matjar_product_loop_buttons_variations' ) ) :
	/**
	 * Product loop buttons & variations
	 */
	function matjar_product_loop_buttons_variations() { ?>
		<div class="product-buttons-variations">
			<?php
			/**
			 * Hook: matjar_product_loop_buttons_variations.
			 *
			 * @hooked matjar_template_loop_action_buttons - 10
			 * @hooked matjar_template_loop_variations - 20
			 */
			 do_action( 'matjar_product_loop_buttons_variations' );?>
		 </div>
		 <?php 
	}
endif;

if ( ! function_exists( 'matjar_template_loop_action_buttons' ) ) :
	/**
	 * Product loop buttons
	 */
	function matjar_template_loop_action_buttons() { ?>
		
		<div class="product-buttons">
			<?php
			/**
			 * Hook: matjar_template_loop_action_buttons.
			 *
			 * @hooked matjar_product_loop_cart_button - 10
			 * @hooked matjar_product_loop_wishlist_button - 15
			 * @hooked matjar_product_loop_compare_button - 20
			 */
			 do_action( 'matjar_template_loop_action_buttons' );?>
		 </div>
		 <?php 
	}
endif;

if ( ! function_exists( 'matjar_product_loop_cart_button' ) ) :
	/**
	 * Product loop cart button
	 */
	function matjar_product_loop_cart_button() {
		
		if( ! matjar_get_loop_prop('product-buttons') || ! matjar_get_loop_prop( 'product-cart-button' ) ) return; ?>
		
		<div class="cart-button">
			<?php
			/**
			 * Hook: matjar_product_loop_cart_button.
			 *
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			 do_action( 'matjar_product_loop_cart_button' );?>
		 </div>
		<?php 
	}
endif;

if ( ! function_exists( 'matjar_product_loop_wishlist_button' ) ) :
	/**
	 * Product loop wishlist button
	 */
	function matjar_product_loop_wishlist_button() {
		
		if( ! matjar_get_loop_prop('product-buttons') || ! matjar_get_loop_prop( 'product-wishlist-button' ) ) return; ?>
		
		<div class="whishlist-button">
			<?php if( class_exists('YITH_WCWL_Shortcode')) echo YITH_WCWL_Shortcode::add_to_wishlist(array()); ?>
		</div>
		<?php 
	}
endif;

if ( ! function_exists( 'matjar_product_loop_compare_button' ) ) :
	/**
	 * Product loop compare button
	 */
	function matjar_product_loop_compare_button() {
		
		if( ! defined( 'YITH_WOOCOMPARE' )) return; 
		if( ! matjar_get_loop_prop('product-buttons') || ! matjar_get_loop_prop( 'product-compare-button' ) ) return; 
		global $product;
		$id = $product->get_id();
		$button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'matjar' ) );
		$compare_button_style = get_option( 'yith_woocompare_is_button' );		
		?>
		
		<div class="compare-button">
			<?php printf( '<a href="%s" class="%s" data-product_id="%d" rel="nofollow">%s</a>',
						matjar_compare_add_product_url( $id ),
						'compare'.' '.$compare_button_style,
						$id,
						$button_text ); 
			?>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_compare_add_product_url' ) ) :
	function matjar_compare_add_product_url( $product_id ) {

		$action_add = 'yith-woocompare-add-product';

		$url_args = array(
			'action' => $action_add,
			'id'     => $product_id,
		);

		return apply_filters( 'yith_woocompare_add_product_url',
			esc_url_raw( add_query_arg( $url_args ) ),
			$action_add );
	}
endif;

if ( ! function_exists( 'matjar_product_loop_quick_view_button' ) ) :
	/**
	 * Product loop quick view button
	 */
	function matjar_product_loop_quick_view_button() {
		
		if( ! matjar_get_loop_prop('product-buttons') || ! matjar_get_loop_prop( 'product-quickview-button' ) ) return; ?>
		
		<div class="quickview-button">
			<a class="quickview-btn" href="<?php echo esc_url( get_the_permalink() );?>" data-id="<?php echo esc_attr(get_the_ID());?>"><?php esc_html_e('Quick View','matjar')?></a>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_product_loop_quantity_field' ) ) :
	/**
	 * Product loop quick view button
	 */
	function matjar_product_loop_quantity_field() {		
		if( ! matjar_get_option( 'product-quantity-field', 1 )  ) {
			return;
		}
		global $product;		
		//add quantity field only to simple products
		if ( $product->is_type( 'simple' ) && ! $product->is_sold_individually() && $product->is_purchasable() && $product->is_in_stock() ) {
			woocommerce_quantity_input(
				array(
					'min_value' => 1,
					'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity(),
				),
				$product
			);
		}
	}
endif;

if ( ! function_exists( 'matjar_quantity_button_plus' ) ) :
	/**
	 * Quantity Button Plus
	 */
	function matjar_quantity_button_plus() { ?>
		<input type="button" value="+" class="plus" />
	<?php }
endif;

if ( ! function_exists( 'matjar_quantity_button_minus' ) ) :
	/**
	 * Quantity Button Minus
	 */
	function matjar_quantity_button_minus() { ?>
		<input type="button" value="-" class="minus" />
	<?php }
endif;	

if ( ! function_exists( 'matjar_stock_progress_bar' ) ) :
	/**
	 * Product loop buttons & variations
	 */
	function matjar_stock_progress_bar() { 
		if( ! matjar_get_loop_prop( 'products-stock-progressbar' ) ){
			return;
		}
		global $product;
		$product_error 		= false;
		$productId 			= get_the_ID();	
		$stock_available 	= false;	
		$stock_sold 		= ( $total_sales = get_post_meta( $productId, 'total_sales', true ) ) ? round( $total_sales ) : 0;
		$stock_available 	= ($stock = get_post_meta($productId, '_stock', true)) ? round($stock) : 0;
		$percentage 		= $stock_available > 0 ? round($stock_sold/($stock_available + $stock_sold) * 100) : 0;
		if($stock_available) : ?>
			<div class="product-special-deal-progress">
				<div class="deal-stock-label">
					<span class="stock-sold text-right"><?php echo esc_html__('Already Sold:', 'matjar');?> <strong><?php echo esc_html($stock_sold); ?></strong></span>
					<span class="stock-available text-left"><?php echo esc_html__('Available:', 'matjar');?> <strong><?php echo esc_html($stock_available); ?></strong></span>
				</div>
				<div class="progress">
					<span class="progress-bar active" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"><?php echo esc_html( $percentage ).'%'; ?></span>
				</div>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'matjar_after_shop_loop_item' ) ):
	/**
	 * Product after shop loop wrapper end
	 */
	function matjar_after_shop_loop_item() {
		/**
		 * Hook: matjar_after_shop_loop_item.
		 *
		 * @hooked matjar_product_wrapper_end - 10
		 * @hooked matjar_product_wrapper_end - 20
		 * @hooked matjar_product_wrapper_end - 30
		 */
		 do_action( 'matjar_after_shop_loop_item' );
	}
endif;

/**
 * Single Product
 */
if( ! function_exists( 'matjar_wc_get_gallery_image_html' ) ) :
	/**
	 * Get Product Gallery Thumbnails
	 */
	function matjar_wc_get_gallery_image_html( $attachment_id ){	
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $thumbnail[0],
			'data-large_image'        => $thumbnail[0],
			'data-large_image_width'  => $thumbnail[1],
			'data-large_image_height' => $thumbnail[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
		$html .= '</div>';
		
		return $html;
	}
endif;

/**
 * Single Product
 */
if( ! function_exists( 'matjar_wc_get_gallery_image_html' ) ) :
	/**
	 * Get Product Gallery Thumbnails
	 */
	function matjar_wc_get_gallery_image_html( $attachment_id ){	
		$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
		$attributes      = array(
			'title'                   => get_post_field( 'post_title', $attachment_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
			'data-src'                => $thumbnail[0],
			'data-large_image'        => $thumbnail[0],
			'data-large_image_width'  => $thumbnail[1],
			'data-large_image_height' => $thumbnail[2],
		);

		$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '">';
		$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
		$html .= '</div>';
		
		return $html;
	}
endif;

if ( ! function_exists( 'matjar_single_product_photoswipe_btn' ) ) :
	/**
	 * Single product photoswipe button
	 */
	function matjar_single_product_photoswipe_btn(){
		
		if( ! matjar_get_option( 'product-gallery-lightbox', 1 ) ) return; ?>
		
		<div class="product-photoswipe-btn">
			<a href="#" class="matjar-product-image-full"><?php esc_html_e('Lightbox', 'matjar'); ?></a>
		</div>		
	<?php
	}
endif;

if ( ! function_exists( 'matjar_single_product_video_btn' ) ) :
	/**
	 * Single product video button
	 */
	function matjar_single_product_video_btn(){
		
		if( ! matjar_get_option( 'product-video', 1 ) ) return;
		
		$prefix 	= MATJAR_PREFIX;
		$video_url 	= get_post_meta(get_the_ID(),  $prefix .'product_video', true );
		if( ! empty( $video_url ) ){ ?>
			<div class="product-video-btn">
				<a href="<?php echo esc_url( $video_url ); ?>" class="matjar-video-popup"><?php esc_html_e( 'Show Video', 'matjar' ); ?></a>
			</div>
			
		<?php }
	}
endif;

if ( ! function_exists( 'matjar_single_product_degree360_btn' ) ) :
	/**
	 * Single product 360 degree View button
	 */
	function matjar_single_product_degree360_btn(){
		
		if( ! matjar_get_option( 'product-360-degree', 1 ) ) return;
		global $post;
		if ( ! $post ) {
			return;
		}
		$prefix 			= MATJAR_PREFIX;
		$gallery_images 	= get_post_meta($post->ID,  $prefix .'product_360_degree_images' );
		
		if( ! empty( $gallery_images ) ){ ?>
			<div class="product-360-degree-btn">
				<a href="#matjar-360-degree-wrapper" ><?php esc_html_e('360 Degree', 'matjar'); ?></a>
			</div>			
		<?php }
	}
endif;

if ( ! function_exists( 'matjar_single_product_360_degree_content' ) ) :
	/**
	 * Single Product 360 Degree Content
	 */
	function matjar_single_product_360_degree_content(){
		
		if( ! matjar_get_option( 'product-360-degree', 1 ) ) return;
		global $post;
		if ( ! $post ) {
			return;
		}
		$prefix 	= MATJAR_PREFIX;
		$gallery_images 	= get_post_meta( $post->ID,  $prefix .'product_360_degree_images' );
		if( empty( $gallery_images ) ){
			return;
		}
		$image_array = array();
		foreach ( $gallery_images as $attachment_id ) {
			$image_src = wp_get_attachment_image_url( $attachment_id, 'woocommerce_single' );
			if( $image_src ){
				$image_array[] = "'" . $image_src . "'";
			}		
		}
		$frames_count  = count( $image_array );
		$images_js_string = implode( ',', $image_array );	?>
		<div id="matjar-360-degree-wrapper" class="matjar-360-degree-wrapper mfp-hide">
			<ol class="matjar-360-degree-images"></ol>	
			<div class="spinner">
				<span>0%</span>
			</div>
		</div>
		<?php
		wp_enqueue_script( 'threesixty' );
		wp_add_inline_script('threesixty',
			'jQuery(document).ready(function( $ ) {
				$(".matjar-360-degree-wrapper").ThreeSixty({
					totalFrames: ' . esc_js( $frames_count ) . ',
					endFrame: ' . esc_js( $frames_count ) . ',
					currentFrame: 1,
					imgList: ".matjar-360-degree-images",
					progress: ".spinner",
					imgArray: ' . '[' . $images_js_string . ']' . ', 
					width: 300,
					height: 300,
					responsive: true,
					navigation: true,
					position: "bottom-center",
				});
			});',
			'after'
		);
	}
endif;

if ( ! function_exists( 'matjar_single_product_before_price' ) ) :
	/**
	 * Single Products Summary Befor Price
	 */
	function matjar_single_product_before_price() { 
		/**
		 * Hook: matjar_single_product_before_price.
		 *
		 * @hooked matjar_product_navigation_share - 10
		 */
		 do_action( 'matjar_single_product_before_price' );
	}
endif;

if ( ! function_exists( 'matjar_product_navigation_share' ) ) :
	/**
	 * Single Product Navigation & Share
	 */
	function matjar_product_navigation_share() { ?>
		
		<div class="product-navigation-share">
			<?php 
			/**
			 * Hook: matjar_product_navigation_share.
			 *
			 * @hooked matjar_single_product_share - 5
			 * @hooked matjar_single_product_navigation - 10
			 */
			 do_action( 'matjar_product_navigation_share' );
			?>
		</div>
		<?php 
	}
endif;

if( ! function_exists( 'matjar_single_product_navigation' ) ) :
	/**
	 * Single Product Navigation
	 */
	function matjar_single_product_navigation(){
		
		if( ! matjar_get_option( 'single-product-navigation', 1 ) ) return; 
	
		$next = get_next_post();
	    $prev = get_previous_post();

	    $next = ( ! empty( $next ) ) ? wc_get_product( $next->ID ) : false;
	    $prev = ( ! empty( $prev ) ) ? wc_get_product( $prev->ID ) : false; ?>
		
		<div class="product-navigation">
			<?php if ( ! empty( $prev ) ): ?>
				<div class="product-nav-btn product-prev">
					<a href="<?php echo esc_url( $prev->get_permalink() ); ?>">
						<?php esc_html_e('Previous product', 'matjar'); ?>
					</a>				
					<div class="product-info-wrap matjar-arrow">
						<div class="product-info">
							<div class="product-thumb">
								<a href="<?php echo esc_url( $prev->get_permalink() ); ?>">
									<?php echo wp_kses( $prev->get_image(), matjar_allowed_html(array('img')) );?>
								</a>
							</div>
							<div class="product-title-price">							
								<a class="product-title" href="<?php echo esc_url( $prev->get_permalink() ); ?>">
									<?php echo esc_html( $prev->get_title() ); ?>
								</a>
								<span class="price"><?php echo wp_kses( $prev->get_price_html(), matjar_allowed_html(array( 'span','del','ins' ) ) );?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
			
			<?php if ( ! empty( $next ) ): ?>
				<div class="product-nav-btn product-next">				
					<a href="<?php echo esc_url( $next->get_permalink() ); ?>">
						<?php esc_html_e('Next product', 'matjar'); ?>
					</a>
					<div class="product-info-wrap matjar-arrow">
						<div class="product-info">
							<div class="product-thumb">
								<a href="<?php echo esc_url( $next->get_permalink() ); ?>">
									<?php echo wp_kses( $next->get_image(), matjar_allowed_html(array('img')) );?>
								</a>
							</div>
							<div class="product-title-price">							
								<a class="product-title" href="<?php echo esc_url( $next->get_permalink() ); ?>">
									<?php echo esc_html( $next->get_title() ); ?>
								</a>
								<span class="price"><?php echo wp_kses( $next->get_price_html(), matjar_allowed_html(array( 'span','del','ins' ) ) );?></span>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'matjar_sale_product_countdown' ) ) :
	/**
	 * Sale Product Countdown
	 */
	function matjar_sale_product_countdown() {
		
		$current_filter = current_filter();
		if( ( !matjar_get_loop_prop('product-countdown')  && $current_filter != 'woocommerce_single_product_summary' ) || (is_product() && $current_filter == 'woocommerce_single_product_summary' && ! matjar_get_option('single-product-countdown', 1 ) ) ) return; 
		
		global $product;
		$html = $sale_time = $offer_text = $offer_html = '';
		$countdown_style 	='countdown-box';
		$timezone 			= wc_timezone_string();
		
		if( is_single() && $current_filter == 'woocommerce_single_product_summary' ){
			$countdown_style = matjar_get_option('single-product-countdown-style', 'countdown-box');
			$offer_text = matjar_get_option('single-product-countdown-tag', 'Special price ends in less than');
			$offer_html = ( $countdown_style =='countdown-text' ) ? '<span class="offer-tag">'.$offer_text.'</span>' : '';
		}

		if ( $product->is_on_sale() ) : 
			$sale_time = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );
		endif;
		
		/* variable product */
		if( $product->has_child() && $product->is_on_sale() ){
			$vsale_end = array();
			
			$pvariables = $product->get_children();
			foreach($pvariables as $pvariable){
				$vsale_end[] = (int)get_post_meta( $pvariable, '_sale_price_dates_to', true );
			}			
			/* get the latest time */
			$sale_time = max( $vsale_end );				
		}
		
		if( $product->is_on_sale() && $sale_time ) :
			wp_enqueue_script( 'countdown' );
			$sale_time = $sale_time;
			$sale_time = date('Y-m-d H:i:s', $sale_time); ?>
			<div class="product-countdown-timer <?php echo esc_attr( $countdown_style );?>">
				<?php echo wp_kses( $offer_html, matjar_allowed_html(array('span')) );?>
				<div class="product-countdown" data-end-date="<?php echo esc_attr( $sale_time );?>" data-timezone="<?php echo esc_attr( $timezone );?>" data-countdown-style="<?php echo esc_attr( $countdown_style );?>"></div>	
			</div>
			<?php
		endif;
		
		echo apply_filters( 'matjar_sale_product_countdown', $html, $sale_time, $timezone, $countdown_style );
	}
endif;

if ( ! function_exists( 'matjar_single_product_after_price' ) ) :
	/**
	 * Single Product Summary After Price
	 */
	function matjar_single_product_after_price() {
		/**
		 * Hook: matjar_single_product_after_price.
		 *
		 * @hooked matjar_single_product_price_discount - 5
		 * @hooked matjar_single_product_offer - 10
		 * @hooked matjar_single_product_brands - 15
		 * @hooked matjar_single_product_service - 20
		 */
		 do_action( 'matjar_single_product_after_price' );
	}
endif;

if( ! function_exists( 'matjar_single_product_price_discount' ) ) :
	/**
	 * Single Product Discount
	 */
	function matjar_single_product_price_discount(){
		
		if( matjar_get_loop_prop( 'sale-single-product-label-after-price' ) != 'after-price' ) { return; }
		if ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) {
			return;
		}
		$output_labels = matjar_product_labels( 'percentage' );
		
		$output ='<div class="product-price-discount">';
		$output .= ( isset( $output_labels['sale'] ) ) ? $output_labels['sale'] : '';
		$output .='</div>';
		
		echo apply_filters( 'matjar_single_product_price_discount',  $output );
	}
endif;

if( ! function_exists( 'matjar_get_products_availability' ) ) :
	/* Change In Stock Text */
	function matjar_get_products_availability( $availability, $_product ) {
		if ( ! $_product->is_in_stock() ) {
			$availability['availability']	= matjar_get_option( 'single-product-availability-outstock-msg', 'Out of Stock' );
			$availability['class']			= 'out-of-stock';
		} elseif ( $_product->managing_stock() && $_product->is_on_backorder( 1 ) ) {
			$availability['availability']	= $_product->backorders_require_notification() ? esc_html__( 'Available on backorder', 'matjar' ) : '';
			$availability['class']			= 'out-of-stock';
		} elseif ( ! $_product->managing_stock() && $_product->is_on_backorder( 1 ) ) {
			$availability['availability'] 	= esc_html__( 'Available on backorder', 'matjar' );
			$availability['class'] 			= 'out-of-stock';
		} elseif ( $_product->managing_stock() ) {
			$stock_amount 	= $_product->get_stock_quantity();
			$stockQty		= matjar_get_option( 'single-product-availability-lowstock-qty', 5 );
			if( $stock_amount <= $stockQty){
				$stock_string 					= matjar_get_option( 'single-product-availability-hurry-left-msg', 'Hurry, Only {qty} left.' );
				$stock_outputstring  			= str_replace('{qty}',$stock_amount,$stock_string); 
				$availability['availability'] 	= $stock_outputstring;
				$availability['class'] 			= 'min-stock';
				
			}else{
				$stock_string 					= matjar_get_option( 'single-product-availability-instock-msg', 'In Stock' );
				$stock_outputstring  			= str_replace('{qty}',$stock_amount,$stock_string); 
				$availability['availability'] 	= $stock_outputstring;
				$availability['class'] 			= 'in-stock';
			}			
		} else {
			$stock_string 						= matjar_get_option( 'single-product-availability-instock-msg', 'In Stock' );
			$stock_outputstring  				= str_replace('{qty}','',$stock_string); 
			$availability['availability'] 		= $stock_outputstring;
			$availability['class']				= 'in-stock';
		}
		return $availability;
	}
endif;
add_filter( 'woocommerce_get_availability', 'matjar_get_products_availability', 1, 2);

if ( ! function_exists( 'matjar_single_product_stock_availability' ) ) :
	/**
	 * Single Product Stock Availability Message
	 */
	function matjar_single_product_stock_availability() {

		if( ! matjar_get_option( 'single-product-availability', 1 ) ) return;
		
		global $product;    
		$availability = $product->get_availability();
		
		echo '<div class="stock-availability '.esc_attr($availability['class']).'">'.$availability['availability'].'</div>';
	}
endif;

if( ! function_exists( 'matjar_single_product_brands' ) ) :
	/**
	 * Single Product Brands
	 */
	function matjar_single_product_brands(){		
		
		if( ! matjar_get_option( 'single-product-brands', 1 ) ) return;
		
		$brands = get_the_terms( get_the_ID(), 'product_brand' );	
		if( ! is_wp_error( $brands ) && !empty ( $brands ) ):?>		
			<div class="product-brands">
				<?php foreach( $brands as $brand ): 
					$thumbnail_id 	= absint( get_term_meta( $brand->term_id, 'thumbnail_id', true ) );
					$brand_link 	= get_term_link( $brand, 'product_brand' ); 
					$brand_class 	= $thumbnail_id ? 'brand-image' : 'brand-title'; ?>
					<a class="<?php echo esc_attr($brand_class);?>" href="<?php echo esc_url( get_term_link($brand) ); ?>" title="<?php echo esc_attr($brand->name);?>">                        
						<?php 
						if ($thumbnail_id  ) {
							echo wp_get_attachment_image( $thumbnail_id, 'full' );
						} else {
							echo esc_html($brand->name);
						}
						 ?>
					</a> 
				<?php endforeach; // end of the loop. ?>
			</div>
		<?php
		endif;
	}
endif;

if( ! function_exists( 'matjar_woocommerce_grouped_product_list_image' ) ) :
	/**
	 * Group Product added image in grouped product list
	 */
	function matjar_woocommerce_grouped_product_list_image( $product ){
		 $image = $product->get_image( array( '50', '50' ), array( 'class' => 'product-img' ) );
		$thumbnail = '<div class="product-thumbnail">'.$image.'</div>';
		echo '<td class="woocommerce-grouped-product-list-item__thumbnail">'.$thumbnail.'</td>';
	}
	add_action( 'woocommerce_grouped_product_list_before_quantity', 'matjar_woocommerce_grouped_product_list_image' );
endif;

if( ! function_exists('matjar_add_quick_buy_pid') ) :
	/* Quick buy button*/
	function matjar_add_quick_buy_pid() {
		
		if( ! matjar_get_option( 'single-product-quick-buy', 0 ) ) return;
		
		global $product;
		if ( $product != null ) {
			echo '<input type="hidden" id="matjar_quick_buy_product_' . esc_attr( $product->get_id() ). '" value="' . esc_attr( $product->get_id() ) . '"  />';
		}
	}
endif;

if( ! function_exists('matjar_add_quick_buy_button') ) :
	function matjar_add_quick_buy_button(){
		
		if( ! matjar_get_option( 'single-product-quick-buy', 0 ) ) return;
		
		global $product;
		$html = '';

		if ( $product == null ) {
			return;
		}
		if ( $product->get_type() == 'external' ) {
			return;
		}
		$pid 			= $product->get_id();
		$type 			= $product->get_type();
		$label 			= matjar_get_option( 'product-quickbuy-button-text', 'Buy Now' );
		$quick_buy_btn_style 	= 'button';
		$class 			= '';
		$defined_class 	= 'matjar_quick_buy_' . $type . ' matjar_quick_buy_' . $pid;
		$defined_id    	= 'matjar_quick_buy_button_'. $pid ;
		$defined_attrs 	= 'name="matjar_quick_buy_button"  data-product-type="' . esc_attr( $type ) . '" data-matjar-product-id="' . esc_attr($pid ) . '"';
		echo '<div class="matjar-quick-buy" id="matjar_quick_buy_container_' . esc_attr( $pid ).'" >';

		if ( $quick_buy_btn_style == 'button' ) {
			echo '<button  id="' . esc_attr( $defined_id ) . '"   class="matjar_quick_buy_button '.esc_attr( $defined_class ).'" value="' . esc_attr($label) . '" type="button" ' . $defined_attrs . '>' . esc_attr($label) . '</button>';
		}
		echo  '</div>';
	}
endif;

if( ! function_exists('matjar_quick_buy_redirect') ) :
	/**
	 * Function to redirect user after qucik buy button is submitted
	 */
	function matjar_quick_buy_redirect( $url ) {
		if ( isset( $_REQUEST['matjar_quick_buy'] ) && $_REQUEST['matjar_quick_buy'] == true ) {
			$redirect = 'checkout';
			if ( $redirect == 'cart' ) {
				return wc_get_cart_url();
			} elseif ( $redirect == 'checkout' ) {
				return wc_get_checkout_url();
			}
		}
		return $url;
	}
endif;

if( ! function_exists( 'matjar_single_product_size_chart' ) ) :
	/**
	 * Single Product Size Chart
	 */
	function matjar_single_product_size_chart(){
		
		if( ! matjar_get_option( 'single-product-size-chart', 0 ) ) return;
		
		$prefix 	= MATJAR_PREFIX;
		$chart_id 	= get_post_meta(get_the_ID(),  $prefix.'size_guide', true );
		if( empty( trim($chart_id) ) ) return;?>		
		<div class="product-sizechart">
			<a href="#" data-id="<?php echo esc_attr($chart_id);?>" class="matjar-ajax-size-chart"><?php echo apply_filters( 'matjar_single_product_sizechart_label', esc_html__('Size Guide', 'matjar') );?></a>
		</div>
		<?php 
	}
endif;

if( ! function_exists('matjar_single_product_delivery_return_ask_question') ) :
	/**
	 * Single Product Delivery Return & Ask a Quesion
	 */
	function matjar_single_product_delivery_return_ask_question() {
		
		if( matjar_get_option( 'product-delivery-return', 0 ) || matjar_get_option( 'product-ask-quetion', 0 ) ){ ?>
			
			<div class="matjar-deliver-return-ask-questions">
				<?php if( matjar_get_option( 'product-delivery-return', 0 ) ){
					$class = '';
					$block_id = matjar_get_option( 'delivery-return-terms', 0 ); 
					if( $block_id ){
						$class = ' matjar-ajax-block';
					}
					?>
					<div class="matjar-deliver-return<?php echo esc_attr($class);?>" data-id="<?php echo esc_attr($block_id);?>">
						<?php echo esc_html( matjar_get_option( 'delivery-return-label', 'Delivery & Return' ) ); ?>
					</div>
				<?php } ?>
				
				<?php if( matjar_get_option( 'product-ask-quetion', 0 ) ){
					$class = '';
					$form_id = matjar_get_option( 'ask-question-form', 0 );
					if( $form_id ){
						$class = ' matjar-ask-questions-ajax';
					}					
					global $product;
					$product_title = $product->get_name(); ?>
					<div class="matjar-ask-questions<?php echo esc_attr( $class );?>" data-id="<?php echo esc_attr( $form_id );?>">
						<?php echo esc_html( matjar_get_option( 'ask-quetion-label', 'Ask a Question' ) ); ?>
					</div>
					<div id="matjar-ask-questions-popup" class="matjar-ask-questions-popup mfp-hide">
						<h3 class="ask-questions-form-tile"> 
							<?php echo esc_html( matjar_get_option( 'ask-quetion-form-title', 'Ask a Question' ) ); ?>
						</h3>
						<?php echo do_shortcode('[contact-form-7 id="'.$form_id.'" product-title="'.$product_title.'"]'); ?>
					</div>
				<?php } ?>
			</div>
		<?php }
	}
endif;

if( ! function_exists('matjar_shortcode_atts_wpcf7_filter') ) :
	/**
	 * Custom attribute add to form
	 */
	function matjar_shortcode_atts_wpcf7_filter( $out, $pairs, $atts ) {
		$my_attr = 'product-title';
		if ( isset( $atts[$my_attr] ) ) {
			$out[$my_attr] = $atts[$my_attr];
		}
		return $out;
	}
	add_filter( 'shortcode_atts_wpcf7', 'matjar_shortcode_atts_wpcf7_filter', 10, 3 );
endif;

if( ! function_exists('matjar_single_product_estimated_delivery') ) :
	/**
	 * Single Product Estimated Delivery Time
	 */
	function matjar_single_product_estimated_delivery() {
		
		if( ! matjar_get_option( 'product-estimated-delivery', 0 ) ) { 
			return;			
		}
		$number			= matjar_get_option( 'estimated-delivery-days', array( 1 => 3, 2 => 7, ) );
		$to_days		= $number['1'];
		$from_days		= $number['2'];
		$minDate		= wp_date( 'Y-m-d', strtotime( " + " . $to_days . " days" ) );
		$maxDate 		= wp_date( 'Y-m-d', strtotime( " + " . $from_days . " days" ) );
		$date_string	= date_i18n( "d F ", strtotime( $minDate ) ) . ' - ' . date_i18n( "d F", strtotime( $maxDate ) );
		?>
		<div class="matjar-estimated-delivery">
			<div class="matjar-delivery-label">
				<?php echo esc_html( matjar_get_option( 'estimated-delivery-label', 'Estimated Delivery:' ) ); ?>
			</div>
			<div class="matjar-delivery-date"><?php echo esc_html( $date_string );?> </div>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_single_product_visitor_count' ) ) :
	/**
	 * Single Product Visitor Count
	 */
	function matjar_single_product_visitor_count() {
		
		if( ! matjar_get_option( 'single-product-visitor-count', 0 ) ) { 
			return;
		}
		
		$number			= matjar_get_option( 'random-visitor-number', array( 1 => 20, 2 => 50, ) );
		$min 			= $number['1'];
		$max 			= $number['2'];
		$delay 			=  matjar_get_option( 'visitor-count-delay-time', '5' );
		$visitor_count 	= rand( $min, $max );
		$enable_enterval = '';
		if( $delay  > 0 ){
			$enable_enterval 	= ' matjar-visitor-change';
		}		
		$visitor_count_btml = '<span class="product-visitor-count">'.$visitor_count.'</span>';
		$count_message		= matjar_get_option( 'visitor-count-text', '{visitor_count} People viewing this product right now!' );
		$count_message		= str_replace( '{visitor_count}', $visitor_count_btml, $count_message );
		
		
		$visitor_count_html = '<div class="matjar-visitor-count'.$enable_enterval.'" data-min="'.$min.'" data-max="'.$max.'" data-delay="'.$delay.'">'. $count_message .'</div>';
		
		echo apply_filters('matjar_product_visitor_count', $visitor_count_html );
	}
endif;

if ( ! function_exists( 'matjar_single_product_policy' ) ) :
	/**
	 * Single Product Policy
	 */
	function matjar_single_product_policy() {
		
		if( ! matjar_get_option( 'single-product-policies', 0 ) ) { 
			return;
		}
		
		$defualt_policy = [ 
			'policy_title'	=> [
				'Free Shipping',
				'1 Year Warranty',
				'Secure payment',
				'30 Days Return',
			],
			'policy_icon_class'	=> [
				'jricon-truck',
				'jricon-shield-check',
				'jricon-handshake',
				'jricon-reload',
			],
			'policy_block'	=> [
				'',
				'',
				'',
				'',
			]
		];
		
		$product_policies = matjar_get_option( 'product-policies', $defualt_policy );
		
		if( empty( $product_policies ) ){
			return;
		}
		
		$policy_title 		= $product_policies['policy_title'];
		$policy_icon_class 	= $product_policies['policy_icon_class'];
		$policy_block 		= $product_policies['policy_block'];
		
		ob_start();?>
		<div class="matjar-product-policy">
			<ul class="product-policy-list">
				<?php foreach( $policy_title as $key => $value ){ 
					if( empty( trim( $value ) ) ){
						continue;
					}
					$icon_html 	= $link_class = '';
					$block_id 	= 0;
					if( !empty( $policy_icon_class[$key] ) ){
						$icon_html = '<span class="policy-item-icon '.$policy_icon_class[$key].'"></span>';
					}
					
					if( !empty( $policy_block[$key] ) ){
						$link_class = ' matjar-ajax-block';
						$block_id 	= $policy_block[$key];
					}?>
					<li class="policy-item<?php echo esc_attr($link_class);?>" data-id="<?php echo esc_attr($block_id);?>">
						<?php echo wp_kses( $icon_html, matjar_allowed_html( array('span') ) ); ?>
						<span class="policy-item-name"> <?php echo esc_html( $value ); ?> </span>
					</li>
				<?php } ?>
			</ul>
		</div>
		
		<?php		
		$output = ob_get_clean();
		
		echo apply_filters( 'matjar_product_policy',  $output );		
	}
endif;

if ( ! function_exists( 'matjar_single_product_trust_badge' ) ) :
	/**
	 * Single Product Trust Badge
	 */
	function matjar_single_product_trust_badge() {
		
		if( ! matjar_get_option( 'single-product-trust-badge', 0 ) ) { 
			return;
		}
		
		$trust_badge_url = matjar_get_option( 'trust-badge-image', array( 'url' => MATJAR_IMAGES.'/trust_badge.png') );
		
		if( empty( $trust_badge_url ) ) { 
			return;
		}
		
		ob_start(); ?>						
		<div class="matjar-product-trust-badge">
			<fieldset>
				<legend><?php echo esc_html( matjar_get_option( 'trust-badge-label', 'Guaranteed Safe Checkout' ) ); ?></legend>
				<img src="<?php echo esc_url($trust_badge_url['url']); ?>" alt="<?php esc_attr_e( 'Trues Badge', 'matjar'); ?>"/>
			</fieldset>
		</div>		
		<?php 
		$badge_html = ob_get_clean();
			
		echo apply_filters('matjar_product_trust_badge', $badge_html );
	}
endif;

if ( ! function_exists( 'matjar_single_product_share' ) ) :
	/**
	 * Single Product Share
	 */
	function matjar_single_product_share() {
		
		if( ! matjar_get_option( 'single-product-share', 1 ) ) { return; } ?>
		
		<?php if ( function_exists( 'matjar_social_share' ) ) { ?>
			<div class="product-share">
				<span class="share-label">
					<?php esc_html_e( 'Share:', 'matjar' );?>
				</span>
				<?php matjar_social_share(
					array(
						'type' 		=> 'share', 
						'style' 	=> 'style-2',
						'el_class' 	=> 'matjar-arrow'
					)
				); ?>
			</div>
		<?php 
		}
	}
endif;

if ( ! function_exists( 'matjar_output_recently_viewed_products' ) ) :
	/**
	 * Single Product Recently Viewed Products
	 */
	function matjar_output_recently_viewed_products() {
		
		$recently_viewed_products = matjar_get_recently_viewed_products();	
		
		if( ! empty( $recently_viewed_products ) ){
			
			$args['recently_viewed_products'] = $recently_viewed_products;
			// Set global loop values.
			wc_set_loop_prop( 'name', 'recently-viewed' );
			wc_get_template( 'single-product/recently-viewed.php', $args );
		}
	}
endif;

if( ! function_exists('matjar_reduce_woocommerce_min_strength_requirement') ) :
	/** 
	 *Reduce the strength requirement on the woocommerce password.
	 * 
	 * Strength Settings
	 * 3 = Strong (default)
	 * 2 = Medium
	 * 1 = Weak
	 * 0 = Very Weak / Anything
	 */
	function matjar_reduce_woocommerce_min_strength_requirement( $strength ) {
		if( matjar_get_option( 'manage-password-strength', 0 ) )
			return matjar_get_option( 'user-password-strength', 3 );
		else
			return 3;		 
	}
	add_filter( 'woocommerce_min_password_strength', 'matjar_reduce_woocommerce_min_strength_requirement' );
endif;

/**
 * My Account Page
 */
if ( ! function_exists( 'matjar_before_account_navigation' ) ) :
	/**
	 * Add wrap and user info to the account navigation
	 */
	function matjar_before_account_navigation() {

		// Name to display
		$current_user = wp_get_current_user();

		if ( $current_user->display_name ) {
			$name = $current_user->display_name;
		} else {
			$name = esc_html__( 'Welcome!', 'matjar' );
		}
		$name = apply_filters( 'matjar_user_profile_name_text', $name );

		echo '<div class="MyAccount-navigation-wrapper">';
			echo '<div class="matjar-user-profile">';
				echo '<div class="user-avatar">'. get_avatar( $current_user->user_email, 128 ) .'</div>';
				echo '<div class="user-info">';
					echo '<h5 class="display-name">'. esc_attr( $name ) .'</h5>';
				echo '</div>';
			echo '</div>';
	}
endif;

if ( ! function_exists( 'matjar_after_account_navigation' ) ) :
	/**
	 * Add wrap to the account navigation.
	 */
	function matjar_after_account_navigation() {
		echo '</div>';
	}
endif;

if ( ! function_exists( 'matjar_woocommerce_before_account_orders' ) ) :
	/**
	 *  My Orders Page Title
	 */
	function matjar_woocommerce_before_account_orders( $has_orders) {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My Orders', 'matjar' ); ?></h2>
			<p><?php esc_html_e( 'Your recent orders are displayed in the table below.', 'matjar' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_woocommerce_before_account_downloads' ) ) :
	/**
	 *  My Downloads Page Title
	 */
	function matjar_woocommerce_before_account_downloads( $has_orders) {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My Downloads', 'matjar' ); ?></h2>
			<p><?php esc_html_e( 'Your digital downloads are displayed in the table below.', 'matjar' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_woocommerce_my_account_my_address_description' ) ):
	/**
	 *  My Address Page Title
	 */
	function matjar_woocommerce_my_account_my_address_description( $address_desc ) {
		
		$address_title = '<div class="section-title">';
		$address_title .= '<h2>'.esc_html__('Address','matjar').'</h2>';
		$address_title .= '<p>' . $address_desc . '</p>';
		$address_title .= '</div>';
		return $address_title;
	}
endif;


if ( ! function_exists( 'matjar_woocommerce_myaccount_edit_account_heading' ) ) :
	/**
	 * Edit Account Heading
	 */
	function matjar_woocommerce_myaccount_edit_account_heading() {
		?>
		<div class="section-title">
			<h2><?php esc_html_e( 'My account', 'matjar' ) ?></h2>
			<p><?php esc_html_e( 'Edit your account details or change your password', 'matjar' ); ?></p>
		</div>
		<?php
	}
endif;

if ( ! function_exists( 'matjar_free_shipping_bar' ) ) :
	/**
	 * Free Shipping Progress Bar
	 */
	function matjar_free_shipping_bar() {
		
		if( ! matjar_get_option( 'free-shipping-bar', 0 ) ) {
			return;
		}
		if( empty( matjar_get_option( 'free-shipping-amount', '' ) ) ) {
			return;
		}
		$subtotal = WC()->cart->subtotal;
		$minimum_amount = matjar_get_option( 'free-shipping-amount', 0 );
		if( $subtotal < $minimum_amount ){
			$remaining = $minimum_amount - $subtotal;
			$percentage = round( ( $subtotal / $minimum_amount ) * 100 ) ;
			$missing_amount = wc_price($remaining);
			$free_shipping_text = matjar_get_option('free-shipping-msg','Spend {missing_amount} to get <strong>free shipping</strong>');
			$free_shipping_text = str_replace( '{missing_amount}', $missing_amount, $free_shipping_text );
			$class = 'active';
			
		}else{
			$free_shipping_text = matjar_get_option('free-shipping-complete-msg','Congratulation! You have got free shipping');
			$percentage = 100;
			$class = 'completed';
		}?>
		<div class="matjar-freeshipping-bar <?php echo esc_attr($class);?>">
			<div class="freeshipping-bar">				
				<span class="progress-bar active" style="width:<?php echo esc_attr( $percentage );?>%"><?php echo wp_kses_post( $percentage );?>%</span>
			</div>
			<div class="freeshipping-bar-msg"><?php echo wp_kses_post( $free_shipping_text );?></div>
		</div>
	<?php }
endif;

if ( ! function_exists( 'matjar_woocommerce_cart_page_wrapper' ) ) :
	/**
	 * Cart Page Wrapper Start
	 */
	function matjar_woocommerce_cart_page_wrapper() { ?>
		<div class="woocommerce-cart-wrapper">
	<?php }
endif;

if ( ! function_exists( 'matjar_woocommerce_cart_page_wrapper_end' ) ) :
	/**
	 * Cart Page Wrapper End
	 */
	function matjar_woocommerce_cart_page_wrapper_end() { ?>
		</div>
	<?php }
endif;

if ( ! function_exists( 'matjar_sticky_add_to_cart_button' ) ) :
	/**
	 * Single Product Sticky Add To Cart Button
	 */
	function matjar_sticky_add_to_cart_button(){
		
		global $product;		
		$stick_add_to_cart = matjar_get_option( 'sticky-add-to-cart-button', 1 );
		
		if ( !$product || ! is_singular( 'product' ) || ! $stick_add_to_cart || !$product->is_in_stock() ) {
			return;
		}
				
		?>
		<div class="matjar-sticky-add-to-cart">
			<div class="container">
				<div class="row">
					<div class="col sticky-add-to-cart-left">
						<div class="sticky-product-image">
							<?php echo woocommerce_get_product_thumbnail( 'woocommerce_gallery_thumbnail'); ?>
						</div>
						<div class="sticky-product-info">
							<div class="sticky-product-title"><?php the_title(); ?></div>
							<?php if( wc_review_ratings_enabled() ) {
								echo wc_get_rating_html( $product->get_average_rating() );
							} ?>
						</div>
					</div>
					<div class="col-auto sticky-add-to-cart-right">
						<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>						
						<a href="<?php echo esc_url( '#' ); ?>" class="button <?php echo esc_attr( $product->get_type() );?>" rel="nofollow">
							<?php echo esc_attr( $product->add_to_cart_text() ); ?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
endif;