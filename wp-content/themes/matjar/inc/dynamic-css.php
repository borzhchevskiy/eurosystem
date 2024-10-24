<?php
/**
 * Customize theme style functionality for Matjar
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */

/**
 * Load dynamic css
 */
if ( ! function_exists( 'matjar_theme_style' ) ) :
	function matjar_theme_style() {
		
		/** Site Fonts */
		$style_options['font']['primary'] = matjar_get_option( 'body-font', array(
			'font-weight'  		=> '400', 
			'font-family' 		=> 'Poppins',
			'google'      		=> true,
			'font-backup' 		=> 'Arial, Helvetica, sans-serif',
			'font-size'   		=> '14px',
			'letter-spacing'	=> '',
		) );
		$style_options['font']['secondary'] = matjar_get_option( 'secondary-font', array(
			'font-weight'  		=> '400',
			'font-family' 		=> 'Poppins',
			'google'      		=> true,
			'font-backup' 		=> 'Arial, Helvetica, sans-serif',
			'color'       		=> '#333333',
		) );
	
		/** Site Layouts Options */
		$style_options['site']['site_layouts'] = matjar_get_option( 'theme-layout', 'full' );
		$style_options['site']['container_width'] = matjar_get_option( 'theme-container-width', 1200 );
		if( 'wide' == matjar_get_option( 'theme-layout', 'full' ) ) {
			$style_options['site']['container_width'] = matjar_get_option( 'theme-container-wide-width', 1820 );
		}
		$style_options['site']['grip_gap'] = matjar_get_option( 'theme-grid-gap', 10 );
		
		/* Promo Bar */	
		$style_options['promo_bar']['max_height'] = matjar_get_option( 'promo-bar-height', 60 );
		$style_options['promo_bar']['button_text'] = matjar_get_option( 'promo-button-text-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
		$style_options['promo_bar']['button_background'] = matjar_get_option( 'promo-button-background', array(
			'regular' 	=> '#1558E5',
			'hover' 	=> '#1558E5',
		) );
	
		/** Site Logos Width */
		$style_options['site']['logo_width'] = matjar_get_option( 'header-logo-width', 170 );
		$style_options['site']['mobile_logo_width'] = matjar_get_option( 'mobile-header-logo-width', 120 );
		
		/** Site Colors Options */
		$style_options['site']['primary_color'] = matjar_get_option( 'primary-color', '#1558E5' );
		$style_options['site']['primary_inverse_color'] = matjar_get_option( 'primary-inverse-color', '#ffffff' );
		$style_options['site']['secondary_color'] = matjar_get_option( 'secondary-color', '#1558E5' );
		$style_options['site']['secondary_inverse_color'] = matjar_get_option( 'secondary-inverse-color', '#ffffff' );
		$style_options['site']['hover_background_color'] = matjar_get_option( 'theme-hover-background-color', '#f8f8f8' );
		$style_options['site']['hex2rgb_color'] = matjar_hex2rgb( $style_options['site']['primary_color'] );

		/* $style_options['site']['background'] = matjar_get_option('body-background', array(
				'background-color' 		=> '#ffffff',
				'background-image' 		=> '',
				'background-repeat' 	=> '',
				'background-size' 		=> '',
				'background-attachment' => '',
				'background-position' 	=> ''
		) ); */
		$style_options['site']['wrapper_background'] = matjar_get_option( 'body-content-background', array( 
				'background-color' 		=> '#ffffff', 
				'background-image' 		=> '',
				'background-repeat' 	=> '',
				'background-size' 		=> '',
				'background-attachment' => '',
				'background-position' 	=> ''
		) );
		$style_options['site']['text_color'] = matjar_get_option( 'body-text-color', '#545454' );
		$style_options['site']['link_color'] = matjar_get_option('body-link-color', array(
			'regular' => '#212121',
			'hover' => '#1558E5',
		) );
		$style_options['site']['border'] = matjar_get_option('theme-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		$style_options['site']['border_radius'] = matjar_get_option( 'theme-border-radius', 0 );
		$style_options['site']['input_color'] = matjar_get_option( 'body-input-color', '#656565' );
		$style_options['site']['input_background'] = matjar_get_option('body-input-background', '#ffffff' );
		$style_options['site']['preloader_background'] = matjar_get_option('preloader-background', '#1558E5' );
		$style_options['site']['preloader_image'] = '';
		if( 'predefine-loader' != matjar_get_option( 'preloader-image', 'predefine-loader' ) ){
			$url = matjar_get_option('preloader-custom-image', '' );
			if(isset( $url['url']) ){
				$style_options['site']['preloader_image'] = $url['url'];
			}
		}
		
		/** Site Buttons */
		$style_options['button']['background'] = matjar_get_option('button-background', array(
			'regular' 	=> '#1558E5',
			'hover' 	=> '#1558E5',
		) );
		$style_options['button']['color'] = matjar_get_option('button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
		
		/** Shop Page Buttons */
		$style_options['button']['shop_cart_background'] = matjar_get_option('shop-cart-button-background', array(
			'regular' 	=> '#f5f5f5',
			'hover' 	=> '#1558E5',
		) );
		$style_options['button']['shop_cart_color'] = matjar_get_option('shop-cart-button-color', array(
			'regular' 	=> '#545454',
			'hover' 	=> '#ffffff',
		) );
		
		/** Product Page Buttons */
		$style_options['button']['product_cart_background'] = matjar_get_option('product-cart-button-background', array(
			'regular' 	=> '#1558E5',
			'hover' 	=> '#1558E5',
		) );
		$style_options['button']['product_cart_color'] = matjar_get_option('product-cart-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
		$style_options['button']['buy_now_background'] = matjar_get_option('buy-now-button-background', array(
			'regular' 	=> '#9e7856',
			'hover' 	=> '#ae8866',
		) );
		$style_options['button']['buy_now_color'] = matjar_get_option('buy-now-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
		
		/** Checkout Buttons */
		$style_options['button']['checkout_background'] = matjar_get_option('checkout-button-background', array(
			'regular' 	=> '#9e7856',
			'hover' 	=> '#ae8866',
		) );
		$style_options['button']['checkout_color'] = matjar_get_option('checkout-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#fcfcfc',
		) );
	
		/** Topbar Colors Options */
		$style_options['topbar']['text_color'] = matjar_get_option('topbar-text-color','#545454');
		$style_options['topbar']['link_color'] = matjar_get_option('topbar-link-color', array(
			'regular' 	=> '#212121',
			'hover' 	=> '#1558E5',
		) );
		$style_options['topbar']['border'] = matjar_get_option( 'topbar-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['topbar']['input_color'] = matjar_get_option( 'topbar-input-color', '#545454' );
		$style_options['topbar']['input_background'] = matjar_get_option( 'topbar-input-background', '#ffffff');
		$style_options['topbar']['height'] = matjar_get_option( 'topbar-height', array( 'height' => 42 ) );
		$style_options['topbar']['height'] = str_replace( 'px', '', $style_options['topbar']['height'] );
	
		/** Header Colors Options */
		$style_options['header']['text_color'] = matjar_get_option( 'header-text-color', '#545454' );  
		$style_options['header']['link_color'] = matjar_get_option( 'header-link-color', array(
			'regular' => '#212121',
			'hover' => '#1558E5',
		) );
		$style_options['header']['border'] = matjar_get_option( 'header-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['header']['input_color'] = matjar_get_option( 'header-input-color', '#545454' );
		$style_options['header']['input_background'] = matjar_get_option('header-input-background', '#ffffff' );
		$style_options['header']['min_height'] = matjar_get_option( 'header-min-height', array( 'height' => 92 ) );
		$style_options['header']['min_height'] = str_replace( 'px', '', $style_options['header']['min_height'] );
		$style_options['header']['mobile_height'] = matjar_get_option( 'header-mobile-height', array( 'height' => 60 ) );
		$style_options['header']['mobile_height'] = str_replace( 'px', '', $style_options['header']['mobile_height'] );
		$style_options['header']['sticky_height'] = matjar_get_option( 'header-sticky-main-height', array( 'height' => 65 ) );
		$style_options['header']['sticky_height'] = str_replace( 'px', '', $style_options['header']['sticky_height'] );
		
		/** Navigation Options */
		$style_options['navigation']['text_color'] = matjar_get_option( 'navigation-text-color','#ffffff' );
		$style_options['navigation']['link_color'] = matjar_get_option( 'navigation-link-color', array(
			'regular' => '#ffffff',
			'hover' => '#ffffff',
		) );
		$style_options['navigation']['border'] = matjar_get_option( 'navigation-border', array(
			'border-color'  => '#1558E5',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['navigation']['input_color'] = matjar_get_option('navigation-input-color','#545454');
		$style_options['navigation']['input_background'] = matjar_get_option('navigation-input-background','#ffffff');
		$style_options['navigation']['min_height'] = matjar_get_option( 'navigation-min-height', array( 'height' => 44 ) );
		$style_options['navigation']['min_height'] = str_replace( 'px', '', $style_options['navigation']['min_height'] );
	
		$style_options['categories_menu']['title_background'] = matjar_get_option( 'categories-menu-title-background', '#1558E5' );
		$style_options['categories_menu']['title_color'] = matjar_get_option( 'categories-menu-title-color', '#ffffff');
		$style_options['categories_menu']['wrapper_background'] = matjar_get_option( 'categories-menu-wrapper-background', '#ffffff' );
		$style_options['categories_menu']['hover_background'] = matjar_get_option( 'categories-menu-hover-background', '#f8f8f8');
		$style_options['categories_menu']['link_color'] = matjar_get_option( 'categories-menu-link-color', array(
			'regular' => '#212121',
			'hover' => '#1558E5',
		) );
		$style_options['categories_menu']['border'] = matjar_get_option( 'categories-menu-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['popup_menu']['hover_background'] = matjar_get_option( 'popup-menu-hover-background', '#f8f8f8' );
		$style_options['popup_menu']['text_color'] = matjar_get_option( 'popup-menu-text-color', '#545454');
		$menu_link_color =  
		$style_options['popup_menu']['link_color'] = matjar_get_option( 'popup-menu-link-color', array(
			'regular' => '#212121',
			'hover' => '#1558E5',
		) );
		$style_options['popup_menu']['border'] = matjar_get_option( 'popup-menu-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
	
		/** Footer Options */
		$style_options['footer']['title_color'] = matjar_get_option('footer-heading-color', '#212121' );  
		$style_options['footer']['text_color'] = matjar_get_option('footer-text-color', '#545454' );  
		$style_options['footer']['link_color'] = matjar_get_option('footer-link-color', array(
			'regular' 	=> '#212121',
			'hover' 	=> '#1558E5',
		) );
		$style_options['footer']['border'] = matjar_get_option('footer-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['footer']['input_color'] = matjar_get_option( 'footer-input-color', '#545454' );
		$style_options['footer']['input_background'] = matjar_get_option( 'footer-input-background', '#ffffff' );
		
		/** Footer Subscribe **/
		$style_options['footer_subscribe']['text_color'] = matjar_get_option('footer-subscribe-text-color','#ffffff' );
		$style_options['footer_subscribe']['button_color'] = matjar_get_option( 'subscribe-button-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		$style_options['footer_subscribe']['button_background'] = matjar_get_option( 'subscribe-button-background', array(
			'regular' 	=> '#333333',
			'hover' 	=> '#212121',
		) );
		$style_options['footer_subscribe']['input_color'] = matjar_get_option( 'footer-subscribe-input-color', '#545454' );
		$style_options['footer_subscribe']['input_background'] = matjar_get_option( 'footer-subscribe-input-background', '#ffffff' );
		
		/** Copyright Options */
		$style_options['copyright']['text_color'] = matjar_get_option('copyright-text-color', '#545454' );
		$style_options['copyright']['link_color'] = matjar_get_option('copyright-link-color', array(
			'regular' 	=> '#212121',
			'hover' 	=> '#1558E5',
		) );
		$style_options['copyright']['border'] = matjar_get_option('copyright-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		
		/** Mobile Header Options */
		$style_options['mobile_header']['background'] = matjar_get_option( 'header-mobile-background', '#ffffff' );  
		$style_options['mobile_header']['text_color'] = matjar_get_option( 'header-mobile-text-color', '#545454' );  
		$style_options['mobile_header']['link_color'] = matjar_get_option( 'header-mobile-link-color', array(
			'regular' 	=> '#333333',
			'hover' 	=> '#1558E5',
		) );
		$style_options['mobile_header']['border'] = matjar_get_option('header-mobile-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['mobile_header']['input_color'] = matjar_get_option('header-mobile-input-color','#545454');
		$style_options['mobile_header']['input_background'] = matjar_get_option('header-mobile-input-background','#ffffff');
		
		/** Woocommece */
		$style_options['woocommece']['single_line_title'] = matjar_get_option( 'single-line-product-title', 1 );
		$style_options['woocommece']['sale_label_color'] = matjar_get_loop_prop( 'sale-product-label-color' );
		$style_options['woocommece']['new_label_color'] = matjar_get_loop_prop( 'new-product-label-color' );
		$style_options['woocommece']['featured_label_color'] = matjar_get_option( 'featured-product-label-color', '#ff781e' );
		$style_options['woocommece']['outofstock_label_color'] = matjar_get_loop_prop( 'outofstock-product-label-color' );
		
		/** Free Shiping Button Color */
		$style_options['free_shipping']['background'] = matjar_get_option( 'shipping-bar-bg-color', '#efefef' );
		$style_options['free_shipping']['color'] = matjar_get_option( 'shipping-bar-color', '#1558E5' );
	
		/** Newsletter Popup Options */
		$style_options['newsletter']['width'] = matjar_get_option( 'newsletter-popup-width', 750 );
		$style_options['newsletter']['text_color'] = matjar_get_option('newsletter-text-color', '#ffffff' );  
		$style_options['newsletter']['button_background'] = matjar_get_option( 'newsletter-button-bg-color', array(
			'regular' 	=> '#1558E5',
			'hover' 	=> '#1558E5',
		) );
		$style_options['newsletter']['button_color'] = matjar_get_option( 'newsletter-button-text-color', array(
			'regular' 	=> '#ffffff',
			'hover' 	=> '#f1f1f1',
		) );
		$style_options['newsletter']['border'] = matjar_get_option('newsletter-border', array(
			'border-color'  => '#e9e9e9',
			'border-style'  => 'solid',
			'border-top'    => '1px',
			'border-right'  => '1px',
			'border-bottom' => '1px',
			'border-left'   => '1px'
		) );
		$style_options['newsletter']['border_radius'] = matjar_get_option( 'newsletter-border-radius', 0 );
		
		/** General */
		$style_options['general']['header_icon_text'] = matjar_get_option( 'header-icon-text', 1 );

		$theme_css = '
		
		:root {
			/* Site Font */
			--site-primary-font: '.$style_options['font']['primary']['font-family'].', '.$style_options['font']['primary']['font-backup'].';
			--site-secondary-font: '.$style_options['font']['secondary']['font-family'].', '.$style_options['font']['secondary']['font-backup'].';			
			--site-font-size: '. $style_options['font']['primary']['font-size'] .';
			--site-line-height: 1.9;
			
			/* Site Color */
			--primary-color: '. matjar_get_option( 'primary-color', '#1558E5' ) .';
			--primary-inverse-color: '. matjar_get_option( 'primary-inverse-color', '#ffffff' ) .';
			--secondary-color: '. matjar_get_option( 'secondary-color', '#1558E5' ) .';
			--secondary-inverse-color: '. matjar_get_option( 'secondary-inverse-color', '#ffffff' ) .';
			--site-text-color: '. matjar_get_option( 'body-text-color', '#545454' ) .';
			--site-hover-background-color: '. matjar_get_option( 'theme-hover-background-color', '#f8f8f8' ) .';
			--site-body-background: '. $style_options['site']['wrapper_background']['background-color'] .';
			--site-link-color: '. $style_options['site']['link_color']['regular'] .';
			--site-link-hover-color: '. $style_options['site']['link_color']['hover'] .';
			--site-border-top: '. $style_options['site']['border']['border-top'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--site-border-right: '. $style_options['site']['border']['border-right'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--site-border-bottom: '. $style_options['site']['border']['border-bottom'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--site-border-left: '. $style_options['site']['border']['border-left'].' '.$style_options['site']['border']['border-style'].' '.$style_options['site']['border']['border-color'].';
			--site-border-color: '.$style_options['site']['border']['border-color'].';
			--site-border-radius: '. matjar_get_option( 'theme-border-radius', 0 ) .';
			--site-input-background: '. matjar_get_option( 'body-input-background', '#ffffff' ) .';
			--site-input-color: '. matjar_get_option( 'body-input-color', '#545454' ) .';
			
			/* Site Gap */
			--site-grid-gap: '. matjar_get_option( 'theme-grid-gap', 10 ) .'px;
		}

		/* Input Font */
		.matjar-font-primary{
			font-family: '.$style_options['font']['primary']['font-family'].', '.$style_options['font']['primary']['font-backup'].';
		}
		.matjar-font-secondary{
			font-family: '.$style_options['font']['secondary']['font-family'].', '.$style_options['font']['secondary']['font-backup'].';
		}
		
		/* 
		* Container width
		*/
		.wrapper-boxed .site-wrapper,
		.wrapper-boxed .site-header > div[class*="header-"] {
			max-width:'.$style_options['site']['container_width'].'px;
		}
		/*.site-wrapper .container,*/
		.container,
		.elementor-section.elementor-section-boxed > .elementor-container {
			max-width:'.$style_options['site']['container_width'].'px;
		}
		.row,
		.products.product-style-4.grid-view .product-buttons-variations,
		.woocommerce-cart-wrapper,
		.woocommerce .col2-set,
		.woocommerce-page .col2-set {
			margin-left: -'.$style_options['site']['grip_gap'].'px;
			margin-right: -'.$style_options['site']['grip_gap'].'px;
		}
		.container,
		.container-fluid,
		.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
			padding-right: '.$style_options['site']['grip_gap'].'px;
			padding-left: '.$style_options['site']['grip_gap'].'px;
		}
		.products:not(.product-style-4).grid-view .product-variations,
		.woocommerce .matjar-bought-together-products div.product,
		.matjar-filter-widgets .widget,
		select.dokan-form-control,
		.woocommerce-cart-form,
		.cart-collaterals,
		.woocommerce .col2-set .col-1,
		.woocommerce-page .col2-set .col-1,
		.woocommerce .col2-set .col-2,
		.woocommerce-page .col2-set .col-2,
		.matjar-blog-carousel article,
		.matjar-portfolio-carousel.portfolio-style-1 article,
		.matjar-product-categories-thumbnails .owl-carousel .product-category,
		.matjar-banners-carousel .matjar-banner,
		.matjar-team .matjar-team-member,
		.matjar-testimonials .testimonial,
		.matjar-product-brands .product-brand,
		.matjar-dokan-vendors .matjar-single-vendor,
		.matjar-wc-vendors .matjar-single-vendor,
		.matjar-wcfm-vendors .matjar-single-vendor {
			padding-right: '.$style_options['site']['grip_gap'].'px;
			padding-left: '.$style_options['site']['grip_gap'].'px;
		}
		.elementor-column-gap-default > .elementor-column > .elementor-element-populated,
		.products div.product .product-wrapper,
		.categories-sub-categories-box .products.matjar-carousel .owl-stage-outer.overlay, .categories-sub-categories-vertical .products.matjar-carousel .owl-stage-outer.overlay,
		.products-with-banner .banner-image,
		.matjar-product-categories .banner-image {
			padding: '.$style_options['site']['grip_gap'].'px;
		}
		.products.product-style-4.grid-view .product-buttons-variations {
			padding-left: '.$style_options['site']['grip_gap'].'px;
			padding-right: '.$style_options['site']['grip_gap'].'px;
			padding-bottom: '.$style_options['site']['grip_gap'].'px;
		}
		.categories-sub-categories-box .products.matjar-carousel .owl-stage-outer.overlay, .categories-sub-categories-vertical .products.matjar-carousel .owl-stage-outer.overlay{
			margin: -'.$style_options['site']['grip_gap'].'px;
		}
		.products:not(.product-style-4).grid-view .product-variations {
			left: -'.$style_options['site']['grip_gap'].'px;
			right: -'.$style_options['site']['grip_gap'].'px;
		}
		elementor-widget:not(:last-child){
			margin-bottom: '.( $style_options['site']['grip_gap'] * 2 ).'px;
		}
		.matjar-site-preloader {
			background-color:'.$style_options['site']['preloader_background'].';
			background-image: url('.$style_options['site']['preloader_image'].');
		}
		
		/**
		 * Site Logos Width
		 */
		.header-logo .logo,
		.header-logo .logo-light{
			max-width:'.$style_options['site']['logo_width'].'px;
		}
		.header-logo .mobile-logo{
			max-width:'.$style_options['site']['mobile_logo_width'].'px;
		}
		@media (max-width:1024px){
			.header-logo .logo,
			.header-logo .logo-light,
			.header-logo .mobile-logo {
				max-width:'.$style_options['site']['mobile_logo_width'].'px;
			}
		}
		
		/* 
		* Body color Scheme 
		*/
		body{
			color: '.$style_options['site']['text_color'].';
		}
		
		select option,
		.matjar-ajax-search .search-field, 
		.matjar-ajax-search .product_cat,
		.header-cart .widget_shopping_cart,
		.products .product-cats a,
		.products .woocommerce-loop-category__title .product-count,
		.woocommerce div.product .matjar-breadcrumb,
		.woocommerce div.product .matjar-breadcrumb a,
		.product_meta > span span,
		.product_meta > span a,
		.multi-step-checkout .panel-heading,
		.matjar-tabs.tabs-classic .nav-tabs .nav-link,
		.matjar-tour.tour-classic .nav-tabs .nav-link,
		.matjar-accordion[class*="accordion-icon-"] .card-title a:after,
		.woocommerce table.wishlist_table tr td.product-remove a:before,
		.owl-carousel .owl-nav button[class*="owl-"]:before,
		.slick-slider button.slick-arrow:before,
		.matjar-mobile-menu ul.mobile-main-menu li.menu-item-has-children > .menu-toggle {
			color: '.$style_options['site']['text_color'].';
		}
		
		/* Link Colors */
		a,
		label,
		thead th,
		.matjar-dropdown ul.sub-dropdown li a,
		div[class*="wpml-ls-legacy-dropdown"] .wpml-ls-sub-menu a,
		div[class*="wcml-dropdown"] .wcml-cs-submenu li a, 
		.woocommerce-currency-switcher-form .dd-options a.dd-option,
		.header-topbar ul li li a, 
		.header-topbar ul li li a:not([href]):not([tabindex]),
		.header-myaccount .myaccount-items li a,
		.search-results-wrapper .autocomplete-suggestions,
		.trending-search-wrap,
		.matjar-ajax-search .trending-search-wrap ul li a, 
		.trending-search-wrap .recent-search-title,
		.trending-search-wrap .trending-title,
		.header-cart .widget_shopping_cart a:not(.wc-forward),
		.format-link .entry-content a,
		.woocommerce .widget_price_filter .price_label span,
		.woocommerce-or-login-with,
		.products-header .product-show span,
		.rating-histogram .rating-star,
		div.product p.price, 
		div.product span.price,
		.whishlist-button a:before,
		.product-buttons a.compare:before,
		.woocommerce div.summary a.compare,
		.woocommerce div.summary .countdown-box .product-countdown > span span,
		.woocommerce div.summary .price-summary span,
		.woocommerce div.summary .product-offers-list .product-offer-item,
		.woocommerce div.summary .woocommerce-product-details__short-description > span,
		.matjar-deliver-return,
		.matjar-ask-questions,
		.matjar-delivery-label,
		.product-visitor-count,
		.matjar-product-trust-badge legend,
		.matjar-product-policy legend,
		.woocommerce div.summary .product_meta > span,
		.woocommerce div.summary > .product-share .share-label,
		.quantity input[type="button"],
		.woocommerce div.summary-inner > .product-share .share-label,
		.woocommerce div.summary .items-total-price-button .item-price,
		.woocommerce div.summary .items-total-price-button .items-price,
		.woocommerce div.summary .items-total-price-button .total-price,
		.woocommerce-tabs .woocommerce-Tabs-panel--seller ul li span:not(.details),
		.single-product-page > .matjar-bought-together-products .items-total-price-button .item-price,
		.single-product-page > .matjar-bought-together-products .items-total-price-button .items-price,
		.single-product-page > .matjar-bought-together-products .items-total-price-button .total-price ,
		.single-product-page > .woocommerce-tabs .items-total-price-button .item-price,
		.single-product-page > .woocommerce-tabs .items-total-price-button .items-price,
		.single-product-page > .woocommerce-tabs .items-total-price-button .total-price,
		.woocommerce-cart .cart-totals .cart_totals tr th,
		.wcppec-checkout-buttons__separator,
		.multi-step-checkout .user-info span:last-child,
		.tabs-layout.tabs-normal .nav-tabs .nav-item.show .nav-link, 
		.tabs-layout.tabs-normal .nav-tabs .nav-link.active,
		.matjar-tabs.tabs-classic .nav-tabs .nav-link.active,
		.matjar-tour.tour-classic .nav-tabs .nav-link.active,
		.matjar-accordion.accordion-outline .card-header a,
		.matjar-accordion.accordion-outline .card-header a:after,
		.matjar-accordion.accordion-pills .card-header a,
		.wishlist_table .product-price,
		.mfp-close-btn-in .mfp-close,
		.woocommerce ul.cart_list li span.amount, 
		.woocommerce ul.product_list_widget li span.amount,
		.gallery-caption,
		.post-share .post-meta-label,
		.matjar-mobile-menu ul.mobile-main-menu li > a {
			color: '.$style_options['site']['link_color']['regular'].';
		}
		
		/* Link Hove Colors */
		a:hover,
		.header-topbar .header-col ul li li:hover a,
		.header-myaccount .myaccount-items li:hover a,
		.header-myaccount .myaccount-items li i,
		.matjar-ajax-search .trending-search-wrap ul li:hover a,
		.header-cart .widget_shopping_cart a:not(.wc-forward):hover,
		.matjar-mobile-menu ul.mobile-main-menu li > a:hover, 
		.matjar-mobile-menu ul.mobile-main-menu li.active > a, 
		.mobile-topbar-wrapper span a:hover,
		.matjar-chekout-steps li.current > *,
		.entry-meta a:hover,
		.entry-meta span:hover,
		.entry-meta .post-share:hover,
		.woocommerce div.summary a.compare:hover,
		.format-link .entry-content a:hover,	
		.products .product-cats a:hover,
		.whishlist-button a:hover:before,
		.product-buttons a.compare:hover:before {
			color: '.$style_options['site']['link_color']['hover'].';
		}
		
		/* Primary Colors */
		.primary-color {
			color: '.$style_options['site']['primary_color'].';
		}
		.primary-bg-color {
			background-color: '.$style_options['site']['primary_color'].';
			color: '.$style_options['site']['primary_inverse_color'].';
		}

		/* Secondary Colors */
		.secondary-color {
			color: '.$style_options['site']['secondary_color'].';
		}
		.secondary-bg-color {
			background-color: '.$style_options['site']['secondary_color'].';
			color: '.$style_options['site']['secondary_inverse_color'].';
		}
		
		/* Primary Colors */
		.ajax-search-style-3 .search-submit, 
		.ajax-search-style-4 .search-submit,
		.customer-support::before,
		.matjar-pagination .next,
		.matjar-pagination .prev,
		.woocommerce-pagination .next,
		.woocommerce-pagination .prev,
		.entry-post .post-highlight,
		.read-more-btn,
		.read-more-button-fill .read-more-btn .more-link,
		.post-navigation a:hover .nav-title,
		.nav-archive:hover a,
		blockquote cite,
		blockquote cite a,
		.comment-reply-link,
		.matjar-social.style-2 a:hover,
		.tag-social-share .single-tags a,
		.widget .maxlist-more a,
		.widget_calendar tbody td a,
		.widget_calendar tfoot td a,
		.widget-area .matjar-widget-testimonial .quote-content:before,
		.portfolio-post-loop .categories, 
		.portfolio-post-loop .categories a,
		.woocommerce form .woocommerce-rememberme-lost_password label,
		.woocommerce form .woocommerce-rememberme-lost_password a,
		.woocommerce-new-signup .button,
		.widget_shopping_cart .total .amount,
		.products-header .matjar-product-off-canvas-btn,
		.products-header .products-view a.active,
		.products .product-wrapper:hover .product-title a,
		.woocommerce div.product .matjar-breadcrumb a:hover,
		.woocommerce div.summary .countdown-box .product-countdown > span,
		.woocommerce div.product div.summary .sold-by a,
		.matjar-product-policy .policy-item-icon:before,
		.woocommerce-tabs .woocommerce-Tabs-panel--seller ul li.seller-name span.details a,
		.products .product-category.category-style-1:hover .woocommerce-loop-category__title a,
		.woocommerce div.summary .product-term-text,
		.tab-content-wrap .accordion-title.open,
		.tab-content-wrap .accordion-title.open:after,
		table.shop_table td .amount,
		.woocommerce-cart .cart-totals .shipping-calculator-button,
		.woocommerce-MyAccount-navigation li a::before,
		.woocommerce-account .addresses .title .edit,
		.woocommerce-Pagination a.button,
		.woocommerce table.my_account_orders .woocommerce-orders-table__cell-order-number a,
		.woocommerce-checkout .woocommerce-info .showcoupon,
		.multi-step-checkout .panel.completed .panel-title:after,
		.multi-step-checkout .panel-title .step-numner,
		.multi-step-checkout .logged-in-user-info .user-logout,
		.multi-step-checkout .panel-heading .edit-action,
		.matjar-testimonials.image-middle-center .testimonial-description:before,
		.matjar-testimonials.image-middle-center .testimonial-description:after,
		.matjar-element .view-all-btn,
		.products-and-categories-box .section-title h3,
		.categories-sub-categories-box .sub-categories-content .show-all-cate a,
		.categories-sub-categories-vertical .show-all-cate a,
		.matjar-tabs.tabs-outline .nav-tabs .nav-link.active,
		.matjar-tour.tour-outline .nav-tabs .nav-link.active,
		.matjar-accordion.accordion-outline .card-header a:not(.collapsed),
		.matjar-accordion.accordion-outline .card-header a:not(.collapsed):after,
		.matjar-button .btn-style-outline.btn-color-primary,
		.matjar-button .btn-style-link.btn-color-primary,
		.mobile-nav-tabs li.active,		
		.newsletter-form input[type="checkbox"]:before{
			color: '.$style_options['site']['primary_color'].';
		}

		/* Primary Inverse Colors */
		.primary-inverse-color{
			color: '.$style_options['site']['primary_inverse_color'].';
		}
		.header-cart-count, 
		.header-wishlist-count,		
		.header-compare-count,
		input[type="checkbox"]::before,
		.news .news-title,
		.entry-date,
		.page-numbers.current,
		.page-links > span.current .page-number,
		.read-more-button .read-more-btn .more-link,
		.read-more-button-fill .read-more-btn .more-link:hover,
		.format-link .entry-link a,		
		.format-link .entry-link:before,
		.format-quote .entry-quote:before,
		.format-quote .entry-quote:after,
		.format-quote .entry-quote,
		.format-quote .entry-quote .quote-author a,		
		.tag-social-share .single-tags a:hover,
		.widget .tagcloud a:hover,
		.widget .tagcloud a:focus,
		.widget.widget_tag_cloud a:hover,
		.widget.widget_tag_cloud a:focus,
		.widget_calendar .wp-calendar-table caption,
		.wp_widget_tag_cloud a:hover,
		.wp_widget_tag_cloud a:focus,		
		.matjar-back-to-top,
		.matjar-posts-lists .post-categories a,
		.matjar-recent-posts .post-categories a,
		.widget.widget_layered_nav li.chosen a:after,
		.widget.widget_rating_filter li.chosen a:after,
		.filter-categories a.active,
		.portfolio-post-loop .action-icon a:before,
		.portfolio-style-2 .portfolio-post-loop .entry-content-wrapper .categories, 
		.portfolio-style-2 .portfolio-post-loop .entry-content-wrapper a, 
		.portfolio-style-3 .portfolio-post-loop .entry-content-wrapper .categories, 
		.portfolio-style-3 .portfolio-post-loop .entry-content-wrapper a,
		.customer-login-left,
		.customer-signup-left,
		.customer-login-left h2,
		.customer-signup-left h2,
		.products .product-image .quickview-button a,
		.products .product .product-countdown > span,
		.products .product .product-countdown > span > span,
		.matjar-hot-deal-products .matjar-deal-date,
		.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover,
		.woocommerce-product-gallery .single-product-images-btns a:hover,
		.woocommerce-account .user-info .display-name,
		.multi-step-checkout .panel.active .panel-heading,
		.multi-step-checkout .checkout-next-step a,
		.matjar-team.image-top-with-box .color-scheme-inherit .member-info,
		.matjar-team.image-top-with-box-2 .color-scheme-inherit .member-info,
		.matjar-team.image-top-with-box .color-scheme-inherit .member-info h3,
		.matjar-team.image-top-with-box-2 .color-scheme-inherit .member-info h3,
		.matjar-team .color-scheme-inherit .member-social a,
		.matjar-team.image-middle-swap-box .color-scheme-inherit .flip-front,
		.matjar-team.image-middle-swap-box .color-scheme-inherit .flip-front h3,
		.matjar-team.image-middle-swap-box .color-scheme-inherit .member-info,
		.matjar-team.image-middle-swap-box .color-scheme-inherit .member-info h3,
		.matjar-team.image-bottom-overlay .color-scheme-inherit .member-info
		.matjar-team.image-bottom-overlay .color-scheme-inherit .member-info h3,
		.matjar-tabs.tabs-pills .nav-tabs .nav-link.active,
		.matjar-tour.tour-pills .nav-tabs .nav-link.active,
		.matjar-accordion.accordion-pills .card-header a:not(.collapsed),
		.matjar-accordion.accordion-pills .card-header a:not(.collapsed):after,
		.progress-bar,
		.matjar-social.icons-theme-colour a:hover i,
		.slick-slider .slick-arrow:hover,		
		.matjar-button .btn-style-outline.btn-color-primary:hover,
		#yith-wcwl-popup-message{
			color: '.$style_options['site']['primary_inverse_color'].';
		}
		
		.woocommerce-new-signup .button,
		.matjar-video-player .video-play-btn,
		.mobile-nav-tabs li.active{
			background-color: '.$style_options['site']['primary_inverse_color'].';
		}
		
		/* Primary Background Colors */
		.primary-background-color{
			background-color: '.$style_options['site']['primary_color'].';
		}
		.header-cart-count, 
		.header-wishlist-count,
		.header-compare-count,
		.owl-carousel .owl-dots .owl-dot.active span,
		input[type="radio"]::before,
		input[type="checkbox"]::before,
		.news .news-title,
		.page-numbers.current,
		.entry-date,
		.page-links > span.current .page-number,
		.read-more-button .read-more-btn .more-link,
		.read-more-button-fill .read-more-btn .more-link:hover,
		.format-link .entry-link,
		.format-quote .entry-quote,		
		.tag-social-share .single-tags a:hover,
		.related.posts > h3:after,
		.related.portfolios > h3:after,
		.comment-respond > h3:after, 
		.comments-area > h3:after, 
		.portfolio-entry-summary h3:after,
		.widget-title-bordered-short .widget-title::before,
		.widget-title-bordered-full .widget-title::before,
		.widget .tagcloud a:hover,
		.widget .tagcloud a:focus,
		.widget_calendar .wp-calendar-table caption,
		.widget.widget_tag_cloud a:hover,
		.widget.widget_tag_cloud a:focus,
		.wp_widget_tag_cloud a:hover,
		.wp_widget_tag_cloud a:focus,		
		.matjar-back-to-top,
		.matjar-posts-lists .post-categories a,
		.matjar-recent-posts .post-categories a,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.widget.widget_layered_nav li.chosen a:before,
		.widget.widget_rating_filter li.chosen a:before,
		.filter-categories a.active,
		.portfolio-post-loop .action-icon a:before,
		.customer-login-left,
		.customer-signup-left,
		.products .product-image .quickview-button,
		.products .product .product-countdown > span,
		.woocommerce div.product div.images .woocommerce-product-gallery__trigger:hover,
		.woocommerce-product-gallery .single-product-images-btns a:hover,
		.tabs-layout .tabs li:after,
		section.related > h2::after,
		section.upsells > h2::after,
		div.cross-sells > h2::after,
		section.recently-viewed > h2::after,
		.woocommerce-account .matjar-user-profile,
		.multi-step-checkout .panel.active .panel-heading,
		.matjar-countdown.countdown-box .product-countdown > span,
		.matjar-hot-deal-products .matjar-deal-date,
		.matjar-hot-deal-products .progress-bar,
		.tabs-layout.tabs-line .nav-tabs .nav-link::after,
		.matjar-team.image-top-with-box-2 .member-info,
		.matjar-team.image-middle-swap-box .member-info,
		.matjar-team.image-top-with-box .member-info,
		.matjar-team.image-middle-swap-box .flip-front,
		.matjar-team.image-bottom-overlay .member-info,
		.matjar-team.image-bottom-overlay .member-info::before, 
		.matjar-team.image-bottom-overlay .member-info::after,
		.matjar-video-player .video-wrapper:hover .video-play-btn,
		.matjar-tabs.tabs-line .nav-tabs .nav-link::after,
		.matjar-tabs.tabs-pills .nav-tabs .nav-link.active,
		.matjar-tour.tour-line .nav-tabs .nav-link::after,
		.matjar-tour.tour-pills .nav-tabs .nav-link.active,
		.matjar-accordion.accordion-pills .card-header a:not(.collapsed),
		.progress-bar,
		.matjar-social.icons-theme-colour a:hover i,
		.slick-slider .slick-arrow:hover,
		.matjar-button .btn-style-flat.btn-color-primary,
		.matjar-button .btn-style-outline.btn-color-primary:hover,
		#yith-wcwl-popup-message,
		.slick-slider .slick-dots li.slick-active button{
			background-color: '.$style_options['site']['primary_color'].';
		}
						
		/* Site Wrapper Background Colors */
		.matjar-dropdown ul.sub-dropdown,
		div[class*="wpml-ls-legacy-dropdown"] .wpml-ls-sub-menu,
		div[class*="wcml-dropdown"] .wcml-cs-submenu,
		.woocommerce-currency-switcher-form .dd-options,
		.header-mini-search .matjar-mini-ajax-search,
		.myaccount-items,
		.search-results-wrapper .autocomplete-suggestions, 
		.trending-search-wrap,
		.matjar-search-popup .matjar-search-popup-wrap,
		.header-cart .widget_shopping_cart,
		.matjar-promo-bar,
		.entry-post .post-highlight span:before,
		.entry-meta .meta-share-links,
		.matjar-off-canvas-sidebar .widget-area,
		.products.grid-view .product-variations,
		.products.product-style-4.grid-view .product-buttons-variations,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle::after,
		.widget.widget_layered_nav li a:before,
		.widget.widget_rating_filter li a:before,
		.widget.matjar_widget_product_sorting li.chosen a:after,
		.widget.matjar_widget_price_filter_list li.chosen a:after,
		.matjar-login-signup, 
		.matjar-signin-up-popup,
		.matjar-minicart-slide,
		.matjar-quick-view,
		.matjar-newsletter-popup,
		.newsletter-form input[type="checkbox"],
		.newsletter-form input[type="checkbox"]:before,
		.mfp-content button.mfp-close,
		.woocommerce div.product div.images .woocommerce-product-gallery__trigger,
		.woocommerce-product-gallery .single-product-images-btns a,
		.matjar-360-degree-wrapper .nav_bar,
		.product-navigation-share .matjar-social,
		.product-navigation .product-info-wrap,
		.woocommerce div.summary .countdown-box .product-countdown > span,
		.woocommerce div.summary .price-summary,
		.woocommerce div.summary .product-term-detail,
		.matjar-sticky-add-to-cart,
		.matjar-product-sizechart,
		.matjar-ajax-blok-content,
		.matjar-ask-questions-popup,
		.matjar-bought-together-products .matjar-out-of-stock,
		.woocommerce-cart.has-mobile-bottom-navbar-single-page .matjar-freeshipping-bar,
		.multi-step-checkout .panel-title.active .step-numner,
		.tabs-layout.tabs-normal .nav-tabs .nav-item.show .nav-link, 
		.tabs-layout.tabs-normal .nav-tabs .nav-link.active,
		.matjar-tabs.tabs-classic .nav-tabs .nav-link.active,
		.matjar-tabs.tabs-classic .nav-tabs + .tab-content,
		.matjar-tour.tour-classic .nav-tabs .nav-link.active,
		.matjar-tour.tour-classic .nav-tabs + .tab-content .tab-pane,
		.matjar-canvas-sidebar,
		.matjar-mobile-menu,
		.matjar-mobile-navbar,
		.widget .owl-carousel .owl-nav button[class*="owl-"],
		.widget .owl-carousel .owl-nav button[class*="owl-"] {
			background-color:'.$style_options['site']['wrapper_background']['background-color'].';
		}		
		select option {
			background-color:'.$style_options['site']['wrapper_background']['background-color'].';
		}
		
		.header-topbar ul li li:hover a,
		.search-results-wrapper .autocomplete-selected,
		.trending-search-wrap ul li:hover a,
		.header-myaccount .myaccount-items li:hover a,
		.matjar-navigation ul.sub-menu > li:hover > a,
		.matjar-minicart-slide .mini_cart_item:hover,
		.header-cart .widget_shopping_cart .mini_cart_item:hover,
		.matjar-product-policy,
		.woocommerce-MyAccount-navigation li.is-active a,
		.woocommerce-MyAccount-navigation li:hover a,
		.author-info,
		.tag-social-share .single-tags a,
		.slick-slider .slick-dots button {
			background-color:'.$style_options['site']['hover_background_color'].';
		}
		
		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.owl-carousel .owl-dots .owl-dot span {
			background-color:'.$style_options['site']['border']['border-color'].';
		}
		
		/* Hex RBG Color*/
		.portfolio-post-loop .post-thumbnail:after {
			background-color: rgba('.$style_options['site']['hex2rgb_color'].',0.4);
		}
		.portfolio-style-3 .portfolio-post-loop .post-thumbnail:after {
			background-color: rgba('.$style_options['site']['hex2rgb_color'].',0.7);
		}
		.portfolio-post-loop .action-icon a:hover:before,		
		.portfolio-style-2 .portfolio-post-loop .entry-content-wrapper,
		.portfolio-style-2 .portfolio-post-loop .action-icon a:hover:before {
			background-color: rgba('.$style_options['site']['hex2rgb_color'].',1);
		}
		
		/* Site Border */
		fieldset,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select,
		input[type="checkbox"], 
		input[type="radio"],
		.search-form [type="submit"],
		.wp-block-search [type="submit"],
		.exclamation-mark:before,
		.question-mark:before,
		.select2-container--default .select2-selection--multiple, 
		.select2-container--default .select2-selection--single,
		tr,
		.matjar-search-popup .matjar-ajax-search .searchform,
		.widget .tagcloud a,
		.widget.widget_tag_cloud a,
		.wp_widget_tag_cloud a,
		.widget_calendar table, 
		.widget_calendar td,
		.widget_calendar .wp-calendar-nav,
		.widget div[class*="wpml-ls-legacy-dropdown"] a.wpml-ls-item-toggle,
		.widget div[class*="wcml-dropdown"] .wcml-cs-item-toggle, 
		.widget .woocommerce-currency-switcher-form .dd-select .dd-selected,
		.widget.widget_layered_nav li a:before,
		.widget.widget_rating_filter li a:before,
		.matjar-swatches .swatch-color span,
		.quantity input[type="button"],
		.woocommerce div.summary .matjar-bought-together-products,
		.single-product-page > .matjar-bought-together-products,
		.accordion-layout .tab-content-wrap,
		.toggle-layout .tab-content-wrap,
		.woocommerce-MyAccount-navigation ul,
		.products-and-categories-box .section-inner.row,
		.matjar-product-categories-thumbnails.categories-circle .category-image,
		.matjar-product-custom-categories .category-style-4 .product-wrapper,
		.matjar-product-brands.brand-circle .brand-image,
		.matjar-product-policy,
		.matjar-tabs.tabs-classic .nav-tabs + .tab-content,
		.matjar-tour.tour-classic .nav-tabs .nav-link,
		.matjar-tour.tour-classic .nav-tabs + .tab-content .tab-pane,
		.matjar-accordion.accordion-classic .card,
		#wcfm_products_manage_form_wc_product_matjar_offer_expander .matjar_offer_option,
		#wcfm_products_manage_form_wc_product_matjar_offer_expander .matjar_service_option {
			border-top-width:'.$style_options['site']['border']['border-top'].';
			border-bottom-width:'.$style_options['site']['border']['border-bottom'].';
			border-left-width:'.$style_options['site']['border']['border-left'].';
			border-right-width:'.$style_options['site']['border']['border-right'].';
			border-style:'.$style_options['site']['border']['border-style'].';
			border-color:'.$style_options['site']['border']['border-color'].';
		}
		.post-navigation,
		.comment-list .children,
		.comment-navigation .nav-links,
		.woocommerce div.summary .price-summary .total-discount,
		.woocommerce div.summary .price-summary .overall-discount,
		.woocommerce div.summary .matjar-bought-together-products .items-total-price-button,
		.single-product-page > .matjar-bought-together-products .items-total-price-button .items-total-price > div:last-child,
		.single-product-page > .woocommerce-tabs .items-total-price-button .items-total-price > div:last-child,
		.woocommerce table.shop_table td,
		.woocommerce-checkout .woocommerce-form-coupon-toggle .woocommerce-info,
		.matjar-accordion.accordion-line .card,
		.matjar-mobile-menu ul.mobile-main-menu > li:first-child{
			border-top-width:'.$style_options['site']['border']['border-top'].';
			border-top-style:'.$style_options['site']['border']['border-style'].';
			border-top-color:'.$style_options['site']['border']['border-color'].';
		}
		.single-featured-image-header,
		.matjar-dropdown ul.sub-dropdown li:not(:last-child) a,
		div[class*="wpml-ls-legacy-dropdown"] .wpml-ls-sub-menu a,
		div[class*="wcml-dropdown"] .wcml-cs-submenu li a, 
		.woocommerce-currency-switcher-form .dd-options a.dd-option,
		.header-myaccount .myaccount-items li:not(:last-child) a,
		.post-navigation,
		.comment-list > li:not(:last-child),
		.comment-navigation .nav-links,	
		.woocommerce-or-login-with:after, 
		.woocommerce-or-login-with:before, 
		.woocommerce-or-login-with:after, 
		.woocommerce-or-login-with:before,
		.widget_shopping_cart .mini_cart_item,
		.empty-cart-browse-categories .browse-categories-title,
		.products-header,
		.matjar-filter-widgets .matjar-filter-inner,
		.products.list-view div.product .product-wrapper,
		.matjar-product-sizechart .sizechart-header h2,
		.tabs-layout .tabs,
		.related.posts > h3,
		.related.portfolios > h3,
		.comment-respond > h3, 
		.comments-area > h3, 
		.portfolio-entry-summary h3,
		section.related > h2,
		section.upsells > h2,
		section.recently-viewed > h2,
		div.cross-sells > h2,
		.woocommerce .wishlist_table.mobile li,
		.woocommerce-cart table.cart,
		.woocommerce-MyAccount-navigation li:not(:last-child) a,
		.woocommerce-checkout .woocommerce-form-coupon-toggle .woocommerce-info,
		.section-heading,
		.tabs-layout.tabs-normal .nav-tabs,
		.products-and-categories-box .section-title,
		.matjar-accordion.accordion-classic .card-header,
		.matjar-accordion.accordion-line .card:last-child,
		.matjar-mobile-menu ul.mobile-main-menu li a,
		.mobile-topbar > *:not(:last-child){
			border-bottom-width:'.$style_options['site']['border']['border-bottom'].';
			border-bottom-style:'.$style_options['site']['border']['border-style'].';
			border-bottom-color:'.$style_options['site']['border']['border-color'].';
		}		
		.matjar-heading.separator-underline .separator-right{
			border-bottom-color:'.$style_options['site']['primary_color'].';
		}		
		.entry-meta .meta-share-links:after{
			border-top-color:'.$style_options['site']['wrapper_background']['background-color'].';
		}';
		
		
		if( is_rtl() ){
			$theme_css .= ' 
			.matjar-ajax-search .search-field,
			.matjar-ajax-search .product_cat,
			.products-and-categories-box .section-categories,
			.products-and-categories-box .section-banner,
			.matjar-tabs.tabs-classic .nav-tabs .nav-link{
				border-left-width:'.$style_options['site']['border']['border-left'].';
				border-left-style:'.$style_options['site']['border']['border-style'].';
				border-left-color:'.$style_options['site']['border']['border-color'].';
			}
			.matjar-mobile-menu ul.mobile-main-menu li.menu-item-has-children > .menu-toggle,
			.single-product-page > .matjar-bought-together-products .items-total-price-button,
			.single-product-page .woocommerce-tabs .matjar-bought-together-products .items-total-price-button,
			.matjar-tabs.tabs-classic .nav-tabs .nav-link{
				border-right-width:'.$style_options['site']['border']['border-right'].';
				border-right-style:'.$style_options['site']['border']['border-style'].';
				border-right-color:'.$style_options['site']['border']['border-color'].';
			}
			.matjar-tour.tour-classic.position-left .nav-tabs .nav-link.active,
			blockquote,
			.matjar-video-player .video-play-btn:before,
			.news .news-title:before{
				border-right-color:'.$style_options['site']['primary_color'].';
			}
			.matjar-video-player .video-wrapper:hover .video-play-btn:before{
				border-right-color:'.$style_options['site']['primary_inverse_color'].';
			}
			.matjar-tour.tour-classic.position-right .nav-tabs .nav-link.active{
				border-left-color:'.$style_options['site']['primary_color'].';
			}
			.footer-categories .categories-list li.cat-item:not(:last-child){
				border-left-width:'.$style_options['footer']['border']['border-left'].';
				border-left-style:'.$style_options['footer']['border']['border-style'].';
				border-left-color:'.$style_options['footer']['border']['border-color'].';
			}';
		}else{
			$theme_css .= ' 
			.matjar-ajax-search .search-field,
			.matjar-ajax-search .product_cat,
			.products-and-categories-box .section-categories,
			.products-and-categories-box .section-banner,
			.matjar-tabs.tabs-classic .nav-tabs .nav-link{
				border-right-width:'.$style_options['site']['border']['border-right'].';
				border-right-style:'.$style_options['site']['border']['border-style'].';
				border-right-color:'.$style_options['site']['border']['border-color'].';
			}
			.matjar-mobile-menu ul.mobile-main-menu li.menu-item-has-children > .menu-toggle,
			.single-product-page > .matjar-bought-together-products .items-total-price-button,
			.single-product-page .woocommerce-tabs .matjar-bought-together-products .items-total-price-button,
			.matjar-tabs.tabs-classic .nav-tabs .nav-link,
			.widget_calendar .wp-calendar-nav .pad{
				border-left-width:'.$style_options['site']['border']['border-left'].';
				border-left-style:'.$style_options['site']['border']['border-style'].';
				border-left-color:'.$style_options['site']['border']['border-color'].';
			}
			.matjar-tour.tour-classic.position-left .nav-tabs .nav-link.active,
			.wp-block-quote,
			.wp-block-quote[style*="text-align:right"],
			.matjar-video-player .video-play-btn:before,
			.news .news-title:before{
				border-left-color:'.$style_options['site']['primary_color'].';
			}
			.matjar-video-player .video-wrapper:hover .video-play-btn:before{
				border-left-color:'.$style_options['site']['primary_inverse_color'].';
			}
			.matjar-tour.tour-classic.position-right .nav-tabs .nav-link.active{
				border-right-color:'.$style_options['site']['primary_color'].';
			}			
			.footer-categories .categories-list li.cat-item:not(:last-child){
				border-right-width:'.$style_options['footer']['border']['border-right'].';
				border-right-style:'.$style_options['footer']['border']['border-style'].';
				border-right-color:'.$style_options['footer']['border']['border-color'].';
			}';			
		}
		
		$theme_css .= ' 
		.dropdow-minicart-header .minicart-title,
		.minicart-header,
		.widget_shopping_cart .widget_shopping_cart_footer,
		.mobile-menu-header,
		.matjar-social.icons-theme-colour a i,
		.matjar-spinner::before,
		.loading::before,
		.woocommerce .blockUI.blockOverlay::before,
		.zoo-cw-attr-item,
		.dokan-report-abuse-button.working::before,
		.matjar-vendors-list .store-product,
		.matjar-accordion.accordion-outline .card-header a{
			border-color:'.$style_options['site']['border']['border-color'].';
		}
		.matjar-tabs.tabs-classic .nav-tabs .nav-link{
			border-top-color:'.$style_options['site']['border']['border-color'].';
		}
		.tabs-layout.tabs-normal .nav-tabs .nav-item.show .nav-link, 
		.tabs-layout.tabs-normal .nav-tabs .nav-link.active,
		.woocommerce ul.cart_list li dl, 
		.woocommerce ul.product_list_widget li dl{
			border-left-color:'.$style_options['site']['border']['border-color'].';
		}
		.tabs-layout.tabs-normal .nav-tabs .nav-item.show .nav-link, 
		.tabs-layout.tabs-normal .nav-tabs .nav-link.active{
			border-right-color:'.$style_options['site']['border']['border-color'].';
		}
		.read-more-button-fill .read-more-btn .more-link,
		.widget .tagcloud a:hover,
		.widget .tagcloud a:focus,
		.widget.widget_tag_cloud a:hover,
		.widget.widget_tag_cloud a:focus,
		.wp_widget_tag_cloud a:hover,
		.wp_widget_tag_cloud a:focus,
		.widget-area .matjar-widget-testimonial,
		.widget-area .matjar-widget-testimonial img,
		.matjar-swatches .swatch.swatch-selected,
		.zoo-cw-active.zoo-cw-attribute-option .zoo-cw-attr-item,
		.zoo-cw-attribute-option:not(.disabled):hover .zoo-cw-attr-item, 
		.zoo-cw-is-desktop .zoo-cw-attribute-option.cw-active .zoo-cw-attr-item,
		.woocommerce-checkout form.checkout_coupon,
		.tabs-layout.tabs-normal .nav-tabs .nav-item.show .nav-link,
		.matjar-tabs.tabs-outline .nav-tabs .nav-link.active,
		.matjar-tour.tour-outline .nav-tabs .nav-link.active,
		.matjar-accordion.accordion-outline .card-header a:not(.collapsed),
		.matjar-social.icons-theme-colour a:hover i,
		.matjar-button .btn-style-outline.btn-color-primary,
		.matjar-button .btn-style-link.btn-color-primary,
		.matjar-hot-deal-products.highlighted-border,
		.products-header .matjar-product-off-canvas-btn{
			border-color:'.$style_options['site']['primary_color'].';
		}
		.widget.widget_layered_nav li.chosen a:before,
		.widget.widget_rating_filter li.chosen a:before,
		.widget_calendar caption,
		.woocommerce-account .matjar-user-profile{
			border-top-width:'.$style_options['site']['border']['border-top'].';
			border-bottom-width:'.$style_options['site']['border']['border-bottom'].';
			border-left-width:'.$style_options['site']['border']['border-left'].';
			border-right-width:'.$style_options['site']['border']['border-right'].';
			border-style:'.$style_options['site']['border']['border-style'].';
			border-color:'.$style_options['site']['primary_color'].';
		}		
		.matjar-element .section-heading h2:after{
			border-bottom-style:'.$style_options['site']['border']['border-style'].';
			border-bottom-color:'.$style_options['site']['primary_color'].';
		}
		.site-footer,
		.matjar-tabs.tabs-classic .nav-tabs .nav-link.active,
		.tabs-layout.tabs-normal .nav-tabs .nav-link.active,
		.matjar-spinner::before,
		.loading::before,
		.woocommerce .blockUI.blockOverlay::before,
		.dokan-report-abuse-button.working::before{
			border-top-color:'.$style_options['site']['primary_color'].';
		}		
		.matjar-arrow:after,
		#add_payment_method #payment div.payment_box::after,
		.woocommerce-cart #payment div.payment_box::after,
		.woocommerce-checkout #payment div.payment_box::after{
			border-bottom-color:'.$style_options['site']['wrapper_background']['background-color'].';
		}
		.entry-date .date-month:after{
			border-top-color:'.$style_options['site']['wrapper_background']['background-color'].';
		}
		
		/* Site Border Radius */
		
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="number"],
		input[type="tel"],
		input[type="range"],
		input[type="date"],
		input[type="month"],
		input[type="week"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="color"],
		textarea,
		select
		button, 
		input, 
		select, 
		textarea,
		fieldset,
		button,
		.button, 
		input[type="button"], 
		input[type="reset"], 
		input[type="submit"],
		.header-cart .widget_shopping_cart,
		.myaccount-items,
		.products div.product .product-wrapper,
		.products .product-buttons .cart-button a,
		.products .product-image .quickview-button,
		.entry-date,
		.matjar-social.style-1 a,
		.entry-meta .meta-share-links,
		.widget-area .widget,
		.matjar-back-to-top,
		.dokan-widget-area .widget,
		.matjar-pagination .page-numbers, 
		.woocommerce-pagination .page-numbers, 
		.matjar-pagination .page-links .page-number, 
		.woocommerce-pagination .page-links .page-number, 
		.page-links .page-number,
		.product-navigation .product-info-wrap,
		.product-countdown > span,
		.woocommerce div.summary .product-brands a,
		.matjar-bought-together-products,
		.toggle-layout .tab-content-wrap,
		.woocommerce-cart .woocommerce-cart-inner,
		.woocommerce-cart .cart_totals,
		.woocommerce-checkout form.checkout_coupon,
		.woocommerce-checkout .order-review-inner,
		.woocommerce-checkout #payment div.payment_box,
		.woocommerce .wishlist_table td.product-add-to-cart a,
		.select2-container--default .select2-selection--single,
		.tag-social-share .single-tags a,
		.filter-categories a,
		.menu-item .menu-label,
		.product-labels > span,
		.header-services .icon-service,
		.project-preview .preview-link{
			border-radius: '.$style_options['site']['border_radius'].'px;
		}		
		.header-col-right .matjar-dropdown ul.sub-dropdown, 
		.header-col-right div[class*="wpml-ls-legacy-dropdown"] .wpml-ls-sub-menu, 
		.header-col-right div[class*="wcml-dropdown"] .wcml-cs-submenu, 
		.header-col-right .woocommerce-currency-switcher-form .dd-options, 
		.header-col-right .header-mini-search .matjar-mini-ajax-search,
		.matjar-dropdown ul.sub-dropdown li:last-child a,
		.search-results-wrapper .autocomplete-suggestions, 
		.trending-search-wrap,
		.matjar-navigation ul.menu ul.sub-menu, 
		.matjar-navigation .matjar-megamenu-wrapper,
		.categories-menu,
		.products.grid-view .product-variations,
		.accordion-layout .tab-content-wrap:last-child,
		.woocommerce-MyAccount-navigation ul{
			border-bottom-left-radius: '.$style_options['site']['border_radius'].'px;
			border-bottom-right-radius: '.$style_options['site']['border_radius'].'px;
		}
		.accordion-layout *:nth-child(2),
		.woocommerce-account .matjar-user-profile{
			border-top-left-radius: '.$style_options['site']['border_radius'].'px;
			border-top-right-radius: '.$style_options['site']['border_radius'].'px;
		}
		
		/* 
		* Button color Scheme 
		*/
		.button,
		.btn,
		button,
		input[type="button"],
		input[type="submit"],
		.search-form [type="submit"],
		.wp-block-search [type="submit"],
		.button:not([href]):not([tabindex]),
		.btn:not([href]):not([tabindex]),
		.header-cart .widget_shopping_cart .button:not(.checkout),
		.woocommerce .wishlist_table td.product-add-to-cart a{
			color: '.$style_options['button']['color']['regular'].';
			background-color: '.$style_options['button']['background']['regular'].';
		}
		.matjar-button .btn-color-default.btn-style-outline,
		.matjar-button .btn-color-default.btn-style-link,
		.matjar-button .btn-color-default.btn-style-text{
			color: '.$style_options['button']['background']['regular'].';
		}
		.matjar-button .btn-color-default.btn-style-outline{
			border-color: '.$style_options['button']['background']['regular'].';
		}
		.matjar-button .btn-color-default.btn-style-link:after{
			background-color: '.$style_options['button']['background']['regular'].';
		}
		
		.button:hover,
		.btn:hover,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.button:not([href]):not([tabindex]):hover,
		.btn:not([href]):not([tabindex]):hover,
		.matjar-button .btn-color-default.btn-style-outline:hover,
		.header-cart .button:not(.checkout):hover,
		.woocommerce .wishlist_table td.product-add-to-cart a:hover{
			color: '.$style_options['button']['color']['hover'].';
			background-color: '.$style_options['button']['background']['hover'].';
		}
		.matjar-button .btn-color-default.btn-style-link:hover{
			color: '.$style_options['button']['background']['hover'].';
		}
		.matjar-button .btn-color-default.btn-style-outline:hover,
		.matjar-button .btn-color-default.btn-style-link:hover{
			border-color: '.$style_options['button']['background']['hover'].';
		}
		
		/* Shop Page Cart Button */		
		.products .cart-button a {
			color: '.$style_options['button']['shop_cart_color']['regular'].';
			background-color: '.$style_options['button']['shop_cart_background']['regular'].';
		}
		.products div.product:hover .cart-button a,		
		.products .product-buttons .cart-button a.added{
			color: '.$style_options['button']['shop_cart_color']['hover'].';
			background-color: '.$style_options['button']['shop_cart_background']['hover'].';
		}
		
		/* Product Page Cart Button */
		div.summary form.cart .button{
			color: '.$style_options['button']['product_cart_color']['regular'].';
			background-color: '.$style_options['button']['product_cart_background']['regular'].';
		}
		div.summary form.cart .button:hover,
		div.summary form.cart .button:focus{
			color: '.$style_options['button']['product_cart_color']['hover'].';
			background-color: '.$style_options['button']['product_cart_background']['hover'].';
		}
		
		/* Buy Now Button */		
		.matjar-quick-buy .matjar_quick_buy_button,
		.matjar-bought-together-products .add-items-to-cart{
			color: '.$style_options['button']['buy_now_color']['regular'].';
			background-color: '.$style_options['button']['buy_now_background']['regular'].';
		}
		.matjar-quick-buy .matjar_quick_buy_button:hover,
		.matjar-quick-buy .matjar_quick_buy_button:focus,
		.matjar-bought-together-products .add-items-to-cart:hover,
		.matjar-bought-together-products .add-items-to-cart:focus{
			color: '.$style_options['button']['buy_now_color']['hover'].';
			background-color: '.$style_options['button']['buy_now_background']['hover'].';
		}
		
		/* Checkout & Palce Order Button */
		.widget_shopping_cart .button.checkout,
		.woocommerce-cart a.checkout-button,
		.woocommerce_checkout_login .checkout-next-step .btn,
		.woocommerce_checkout_login .checkout-next-step.btn,
		.woocommerce-checkout-payment #place_order{
			color: '.$style_options['button']['checkout_color']['regular'].';
			background-color: '.$style_options['button']['checkout_background']['regular'].';
		}
		.widget_shopping_cart .button.checkout:hover,
		.widget_shopping_cart .button.checkout:focus,
		.woocommerce-cart a.checkout-button:hover,
		.woocommerce-cart a.checkout-button:focus,
		.woocommerce_checkout_login .checkout-next-step .btn:hover,
		.woocommerce_checkout_login .checkout-next-step .btn:focus,
		.woocommerce_checkout_login .checkout-next-step.btn:hover,
		.woocommerce_checkout_login .checkout-next-step.btn:focus,
		.woocommerce-checkout-payment #place_order:hover,
		.woocommerce-checkout-payment #place_order:focus{
			color: '.$style_options['button']['checkout_color']['hover'].';
			background-color: '.$style_options['button']['checkout_background']['hover'].';
		}		
		
		/* 
		* Input color Scheme 
		*/
		text,
		select, 
		textarea,
		number,
		.matjar-search-popup .searchform, 
		.matjar-search-popup .search-field, 
		.matjar-search-popup .search-categories > select{
			color:'.$style_options['site']['input_color'].';
			background-color:'.$style_options['site']['input_background'].';
		}
		.mc4wp-form-fields p:first-child::before{
			color:'.$style_options['site']['input_color'].';
		}
		
		/* selection Colors */
		::-moz-selection { 
		  color: '.$style_options['site']['primary_inverse_color'].';
		  background: '.$style_options['site']['primary_color'].';
		}

		::selection {
		  color: '.$style_options['site']['primary_inverse_color'].';
		  background: '.$style_options['site']['primary_color'].';
		}
		
		/* 
		* Promo Bar Color Scheme 
		*/
		.promo-bar-wrapper{
			height: '.$style_options['promo_bar']['max_height'].'px;
		}
		.promo-bar-button .button{
			color: '.$style_options['promo_bar']['button_text']['regular'].';
			background-color: '.$style_options['promo_bar']['button_background']['regular'].';
		}
		.promo-bar-button .button:hover{
			color: '.$style_options['promo_bar']['button_text']['hover'].';
			background-color: '.$style_options['promo_bar']['button_background']['hover'].';
		}
		
		/* 
		* Topbar color Scheme 
		*/
		.header-topbar,
		.header-topbar :after{
			color: '.$style_options['topbar']['text_color'].';
		}
		.header-topbar a,
		.woocommerce-currency-switcher-form .dd-select label,
		.woocommerce-currency-switcher-form .dd-select small{
			color: '.$style_options['topbar']['link_color']['regular'].';
		}
		.header-topbar a:hover{
			color: '.$style_options['topbar']['link_color']['hover'].';
		}
		.header-topbar{
			border-bottom-width:'.$style_options['topbar']['border']['border-bottom'].';
			border-bottom-style:'.$style_options['topbar']['border']['border-style'].';
			border-bottom-color:'.$style_options['topbar']['border']['border-color'].';
		}';
		
		if( is_rtl() ){
			$theme_css .= '
			.header-topbar .header-col > *,
			.topbar-navigation ul.menu > li:not(:first-child){
				border-right-width:'.$style_options['topbar']['border']['border-right'].';
				border-right-style:'.$style_options['topbar']['border']['border-style'].';
				border-right-color:'.$style_options['topbar']['border']['border-color'].';
			}
			.header-topbar .header-col > *:last-child{
				border-left-width:'.$style_options['topbar']['border']['border-left'].';
				border-left-style:'.$style_options['topbar']['border']['border-style'].';
				border-left-color:'.$style_options['topbar']['border']['border-color'].';
			}';
		}else{
			$theme_css .= '
			.header-topbar .header-col > *,
			.topbar-navigation ul.menu > li:not(:first-child){
				border-left-width:'.$style_options['topbar']['border']['border-left'].';
				border-left-style:'.$style_options['topbar']['border']['border-style'].';
				border-left-color:'.$style_options['topbar']['border']['border-color'].';
			}
			.header-topbar .header-col > *:last-child{
				border-right-width:'.$style_options['topbar']['border']['border-right'].';
				border-right-style:'.$style_options['topbar']['border']['border-style'].';
				border-right-color:'.$style_options['topbar']['border']['border-color'].';
			}';
		}
		$theme_css .= '
		.header-topbar{
			max-height:'.$style_options['topbar']['height']['height'].'px;
		}
		.header-topbar .header-col > *{
			line-height:'.($style_options['topbar']['height']['height']-2).'px;
		}
		
		/* 
		* Header color Scheme 
		*/
		.header-main{
			color: '.$style_options['header']['text_color'].';
		}
		.header-main a,
		.header-main .header-mini-search .search-icon-text:before{
			color: '.$style_options['header']['link_color']['regular'].';
		}
		.header-main a:hover,
		.header-main .header-mini-search .search-icon-text:hover::before{
			color: '.$style_options['header']['link_color']['hover'].';
		}		
		.header-main .matjar-ajax-search .searchform,
		.header-services .icon-service{
			border-top-width:'.$style_options['header']['border']['border-top'].';
			border-bottom-width:'.$style_options['header']['border']['border-bottom'].';
			border-left-width:'.$style_options['header']['border']['border-left'].';
			border-right-width:'.$style_options['header']['border']['border-right'].';
			border-style:'.$style_options['header']['border']['border-style'].';
			border-color:'.$style_options['header']['border']['border-color'].';
		}
		.header-main{
			height:'.$style_options['header']['min_height']['height'].'px;
		}
		.header-main.header-sticked{
			height:'.$style_options['header']['sticky_height']['height'].'px;
		}
		.header-main .search-field, 
		.header-main .search-categories > select{
			color:'.$style_options['header']['input_color'].';
		}
		.header-main .searchform, 
		.header-main .search-field, 
		.header-main .search-categories > select{
			background-color:'.$style_options['header']['input_background'].';
		}
		.header-main ::-webkit-input-placeholder {
		   color:'.$style_options['header']['input_color'].';
		}
		.header-main :-moz-placeholder { /* Firefox 18- */
		  color:'.$style_options['header']['input_color'].';
		}
		.header-main ::-moz-placeholder {  /* Firefox 19+ */
		   color:'.$style_options['header']['input_color'].';
		}
		.header-main :-ms-input-placeholder {  
		   color:'.$style_options['header']['input_color'].';
		}
		
		/* 
		* Navigation color Scheme 
		*/
		.header-navigation{
			color: '.$style_options['navigation']['text_color'].';
		}
		.header-navigation a{
			color: '.$style_options['navigation']['link_color']['regular'].';
		}
		.header-navigation a:hover{
			color: '.$style_options['navigation']['link_color']['hover'].';
		}		
		.header-navigation .matjar-ajax-search .searchform{
			border-top-width:'.$style_options['navigation']['border']['border-top'].';
			border-bottom-width:'.$style_options['navigation']['border']['border-bottom'].';
			border-left-width:'.$style_options['navigation']['border']['border-left'].';
			border-right-width:'.$style_options['navigation']['border']['border-right'].';
			border-style:'.$style_options['navigation']['border']['border-style'].';
			border-color:'.$style_options['navigation']['border']['border-color'].';
		}
		.header-navigation{
			border-top-width:'.$style_options['navigation']['border']['border-top'].';
			border-top-style:'.$style_options['navigation']['border']['border-style'].';
			border-top-color:'.$style_options['navigation']['border']['border-color'].';
		}
		.header-navigation{
			border-bottom-width:'.$style_options['navigation']['border']['border-bottom'].';
			border-bottom-style:'.$style_options['navigation']['border']['border-style'].';
			border-bottom-color:'.$style_options['navigation']['border']['border-color'].';
		}
		.header-navigation,		
		.header-navigation .main-navigation ul.menu > li > a{
			height:'.$style_options['navigation']['min_height']['height'].'px;
		}
		.header-navigation .categories-menu-title{
			height:'.($style_options['navigation']['min_height']['height']).'px;
		}
		.header-navigation ::-webkit-input-placeholder {
		   color:'.$style_options['navigation']['input_color'].';
		}
		.header-navigation :-moz-placeholder { /* Firefox 18- */
		  color:'.$style_options['navigation']['input_color'].';
		}
		.header-navigation ::-moz-placeholder {  /* Firefox 19+ */
		   color:'.$style_options['navigation']['input_color'].';
		}
		.header-navigation :-ms-input-placeholder {  
		   color:'.$style_options['navigation']['input_color'].';
		}
		
		/* 
		* Menu color Scheme 
		*/	
				
		/* Categories menu */
		.categories-menu-title{
			background-color:'.$style_options['categories_menu']['title_background'].';
			color: '.$style_options['categories_menu']['title_color'].';
		}
		.categories-menu{
			background-color:'.$style_options['categories_menu']['wrapper_background'].';
		}
		.categories-menu ul.menu > li > a{
			color: '.$style_options['categories_menu']['link_color']['regular'].';
		}		
		.categories-menu ul.menu > li:hover > a{
			color: '.$style_options['categories_menu']['link_color']['hover'].';
		}
		.categories-menu ul.menu > li:hover > a{
			background-color:'.$style_options['categories_menu']['hover_background'].';
		}
		.categories-menu{
			border-top-width:'.$style_options['categories_menu']['border']['border-top'].';
			border-bottom-width:'.$style_options['categories_menu']['border']['border-bottom'].';
			border-left-width:'.$style_options['categories_menu']['border']['border-left'].';
			border-right-width:'.$style_options['categories_menu']['border']['border-right'].';
			border-style:'.$style_options['categories_menu']['border']['border-style'].';
			border-color:'.$style_options['categories_menu']['border']['border-color'].';
		}
		.categories-menu ul.menu > li:not(:last-child){
			border-bottom-width:'.$style_options['categories_menu']['border']['border-bottom'].';
			border-bottom-style:'.$style_options['categories_menu']['border']['border-style'].';
			border-bottom-color:'.$style_options['categories_menu']['border']['border-color'].';
		}
		
		/* Menu Popup */
		.site-header ul.menu ul.sub-menu,
		.site-header .matjar-megamenu-wrapper{
			color: '.$style_options['popup_menu']['text_color'].';
		}
		.site-header ul.menu ul.sub-menu a,
		.matjar-megamenu-wrapper a.nav-link,
		.site-header .matjar-megamenu-wrapper a{
			color: '.$style_options['popup_menu']['link_color']['regular'].';
		}
		.site-header .matjar-megamenu-wrapper a:hover{
			color: '.$style_options['popup_menu']['link_color']['hover'].';
		}
		.site-header ul.menu ul.sub-menu > li:hover > a,
		.matjar-megamenu-wrapper li.menu-item a:hover{
			color: '.$style_options['popup_menu']['link_color']['hover'].';
			background-color:'.$style_options['popup_menu']['hover_background'].';
		}
				
		/*
		* Footer color Scheme
		*/
		.footer-main,
		.site-footer .caption{
			color: '.$style_options['footer']['text_color'].';			
		}		
		.site-footer .widget-title,
		.site-footer .footer-categories .cate_title{
			color: '.$style_options['footer']['title_color'].';
		}
		.footer-main a,
		.footer-main label,
		.footer-main thead th{
			color: '.$style_options['footer']['link_color']['regular'].';
		}
		.footer-main a:hover{
			color: '.$style_options['footer']['link_color']['hover'].';
		}
		.site-footer text,
		.site-footer select, 
		.site-footer textarea,
		.site-footer number,
		.site-footer input[type="email"]{
			color:'.$style_options['footer']['input_color'].';
			background-color:'.$style_options['footer']['input_background'].';
		}		
		.site-footer .mc4wp-form-fields p:first-child::before{
			color: '.$style_options['footer']['input_color'].';
		}
		.site-footer .footer-categories{
			border-top-width:'.$style_options['footer']['border']['border-top'].';
			border-top-style:'.$style_options['footer']['border']['border-style'].';
			border-top-color:'.$style_options['footer']['border']['border-color'].';
		}
		.site-footer ::-webkit-input-placeholder {
		   color:'.$style_options['footer']['input_color'].';
		}
		.site-footer :-moz-placeholder { /* Firefox 18- */
		  color:'.$style_options['footer']['input_color'].';
		}
		.site-footer ::-moz-placeholder {  /* Firefox 19+ */
		   color:'.$style_options['footer']['input_color'].';
		}
		.site-footer :-ms-input-placeholder {
		   color:'.$style_options['footer']['input_color'].';
		}
		
		/*
		* Footer Subscribe Color
		*/
		.footer-subscribe h4,
		.footer-subscribe p {
			color:'.$style_options['footer_subscribe']['text_color'].';
		}
		.footer-subscribe [type="submit"]{
			color:'.$style_options['footer_subscribe']['button_color']['regular'].';
			background-color:'.$style_options['footer_subscribe']['button_background']['regular'].';
		}
		.footer-subscribe [type="submit"]:hover{
			color:'.$style_options['footer_subscribe']['button_color']['hover'].';
			background-color:'.$style_options['footer_subscribe']['button_background']['hover'].';
		}
		.footer-subscribe text,
		.footer-subscribe select, 
		.footer-subscribe textarea,
		.footer-subscribe input[type="email"]{
			color:'.$style_options['footer_subscribe']['input_color'].';
			background-color:'.$style_options['footer_subscribe']['input_background'].';
		}
		.footer-subscribe .mc4wp-form-fields p:first-child::before{
			color:'.$style_options['footer_subscribe']['input_color'].';
		}
		
		/*
		* Copyright color Scheme
		*/
		.footer-copyright{
			color: '.$style_options['copyright']['text_color'].';
		}
		.footer-copyright a{
			color: '.$style_options['copyright']['link_color']['regular'].';
		}
		.footer-copyright a:hover{
			color: '.$style_options['copyright']['link_color']['hover'].';
		}
		.footer-copyright{
			border-top-width:'.$style_options['copyright']['border']['border-top'].';
			border-top-style:'.$style_options['copyright']['border']['border-style'].';
			border-top-color:'.$style_options['copyright']['border']['border-color'].';
		}
		
		/*
		* Woocommece Color
		*/';
		
		if( $style_options['woocommece']['single_line_title'] ){
			$theme_css .= '
			.woocommerce ul.cart_list li .product-title, 
			.woocommerce ul.product_list_widget li .product-title,
			.widget.widget_layered_nav li  .nav-title,
			.products.grid-view .product-cats,
			.products.grid-view .product-title,
			.matjar-bought-together-products .product-title,
			.products .woocommerce-loop-category__title a{
				text-overflow: ellipsis;
				white-space: nowrap;
				overflow: hidden;
			}';
		}
		
		$theme_css .= '
		.product-labels span.on-sale{
			background-color:'.$style_options['woocommece']['sale_label_color'].';
		}
		.product-labels span.new{
			background-color:'.$style_options['woocommece']['new_label_color'].';
		}
		.product-labels span.featured{
			background-color:'.$style_options['woocommece']['featured_label_color'].';
		}
		.product-labels span.out-of-stock{
			background-color:'.$style_options['woocommece']['outofstock_label_color'].';
		}		
		.freeshipping-bar {
			background-color:'.$style_options['free_shipping']['background'].';
		}
		.freeshipping-bar .progress-bar {
			background-color:'.$style_options['free_shipping']['color'].';
		}
		
		/*
		* Newsletter Color
		*/
		.matjar-newsletter-popup{
			max-width: '.$style_options['newsletter']['width'].'px;
		}
		.matjar-newsletter-content,
		.matjar-newsletter-content > .matjar-newsletter-title,
		.matjar-newsletter-content label{
			color:'.$style_options['newsletter']['text_color'].';
		}
		.matjar-newsletter-popup input[type="submit"]{
			color:'.$style_options['newsletter']['button_color']['regular'].';
			background-color:'.$style_options['newsletter']['button_background']['regular'].';
		}
		.matjar-newsletter-popup input[type="submit"]:hover{
			color:'.$style_options['newsletter']['button_color']['hover'].';
			background-color:'.$style_options['newsletter']['button_background']['hover'].';
		}
		.matjar-newsletter-content [type="email"] {
			border-top-width:'.$style_options['newsletter']['border']['border-top'].';
			border-bottom-width:'.$style_options['newsletter']['border']['border-bottom'].';
			border-left-width:'.$style_options['newsletter']['border']['border-left'].';
			border-right-width:'.$style_options['newsletter']['border']['border-right'].';
			border-style:'.$style_options['newsletter']['border']['border-style'].';
			border-color:'.$style_options['newsletter']['border']['border-color'].';
		}
		.matjar-newsletter-popup,
		.full-content .matjar-newsletter-content {
			border-radius: '.$style_options['newsletter']['border_radius'].'px;
		}
		.banner-left .matjar-newsletter-banner img,
		.banner-right .matjar-newsletter-content {
			border-top-left-radius: '.$style_options['newsletter']['border_radius'].'px;
			border-bottom-left-radius: '.$style_options['newsletter']['border_radius'].'px;
		}
		.banner-right .matjar-newsletter-banner img,
		.banner-left .matjar-newsletter-content {
			border-top-right-radius: '.$style_options['newsletter']['border_radius'].'px;
			border-bottom-right-radius: '.$style_options['newsletter']['border_radius'].'px;
		}

		/*
		* Responsive 
		*/
		@media (max-width:1024px){
			.header-main{
				height:'.$style_options['header']['mobile_height']['height'].'px;
			}

			.site-header .header-main,
			.site-header .header-navigation{
				color: '.$style_options['mobile_header']['text_color'].';
				background-color: '.$style_options['mobile_header']['background'].';
			}
			.header-main a,
			.header-navigation a{				
				color: '.$style_options['mobile_header']['link_color']['regular'].';
			}
			.header-main a:hover,
			.header-navigation a:hover{
				color: '.$style_options['mobile_header']['link_color']['hover'].';
			}	
			.site-header .header-main{
				border-bottom-width:'.$style_options['mobile_header']['border']['border-bottom'].';
				border-bottom-style:'.$style_options['mobile_header']['border']['border-style'].';
				border-bottom-color:'.$style_options['mobile_header']['border']['border-color'].';
			}
			.site-header text,
			.site-header select, 
			.site-header textarea,
			.site-header number,
			.site-header input[type="search"],
			.site-header .product_cat{
				color:'.$style_options['mobile_header']['input_color'].';
				background-color:'.$style_options['mobile_header']['input_background'].';
			}
			
			/* Placeholder Colors */
			.site-header ::-webkit-input-placeholder {
			   color:'.$style_options['mobile_header']['input_color'].';
			}
			.site-header :-moz-placeholder { /* Firefox 18- */
			  color:'.$style_options['mobile_header']['input_color'].';
			}
			.site-header ::-moz-placeholder {  /* Firefox 19+ */
			   color:'.$style_options['mobile_header']['input_color'].';
			}
			.site-header :-ms-input-placeholder { 
			   color:'.$style_options['mobile_header']['input_color'].';
			}
			.woocommerce div.summary .price-summary .price-summary-header,
			.woocommerce div.summary .product-term-detail .terms-header{
				border-bottom-width:'.$style_options['site']['border']['border-bottom'].';
				border-bottom-style:'.$style_options['site']['border']['border-style'].';
				border-bottom-color:'.$style_options['site']['border']['border-color'].';
			}
		}
		@media (max-width:767px){
			.widget-area{
				background-color:'.$style_options['site']['wrapper_background']['background-color'].';
			}
			.single-product-page > .matjar-bought-together-products .items-total-price-button, 
			.single-product-page .woocommerce-tabs .matjar-bought-together-products .items-total-price-button{
				border-top-width:'.$style_options['site']['border']['border-top'].';
				border-top-style:'.$style_options['site']['border']['border-style'].';
				border-top-color:'.$style_options['site']['border']['border-color'].';
			}
			.products-and-categories-box .section-categories,
			.woocommerce-cart table.cart tr{
				border-bottom-width:'.$style_options['site']['border']['border-bottom'].';
				border-bottom-style:'.$style_options['site']['border']['border-style'].';
				border-bottom-color:'.$style_options['site']['border']['border-color'].';
			}
			.nav-subtitle{
				color: '.$style_options['site']['link_color']['regular'].';
			}
		}';
		
		if( is_rtl() ){
			$theme_css .= '
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active {
				border-right-style: solid !important;
				border-left-style: none !important;
			}
			@media (min-width: 768px) {
				.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tabs-content-wrapper {
					border-style: solid none solid solid !important;
				}
			}
			.elementor-widget-tabs .elementor-tabs {
				text-align: right !important;
			}
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active:after,
			.elementor-widget-tabs.elementor-tabs-view-vertical .elementor-tab-desktop-title.elementor-active:before{
				left: 0 !important;
				right: inherit !important;
			}';
		}
		
		/*
		* General
		*/
		if( ! $style_options['general']['header_icon_text'] ) {
			$theme_css .= '
			.header-icon-text{
				display: none;
			}';
		}
		
		$theme_css .= matjar_get_option( 'custom-css', '' );	
		$theme_css .= matjar_custom_font();
		
		$theme_css = apply_filters( 'matjar_custom_css', $theme_css, $style_options );
		$theme_css = matjar_cleanup_css( $theme_css );
		
		return $theme_css;
	}
endif;

if ( ! function_exists( 'matjar_custom_font' ) ) :
	function matjar_custom_font() {
		/* Custom Font Option */
		$enable_custom_font1 = matjar_get_option( 'custom-font1', 0 );
		$enable_custom_font2 = matjar_get_option( 'custom-font2', 0 );
		$enable_custom_font3 = matjar_get_option( 'custom-font3', 0 );
		$font_face = array();
		if( $enable_custom_font1 ){
			$font1_name 			= matjar_get_option( 'custom-font1-name',''); 
			$custom_font1_woff 		= matjar_get_custom_fonturl('custom-font1-woff');
			$custom_font1_woff2 	= matjar_get_custom_fonturl('custom-font1-woff2');
			$custom_font1_ttf 		= matjar_get_custom_fonturl('custom-font1-ttf');
			$custom_font1_svg		= matjar_get_custom_fonturl('custom-font1-svg');
			$custom_font1_eot 		= matjar_get_custom_fonturl('custom-font1-eot');
			if( !empty( $font1_name ) && ( $custom_font1_woff != '' || $custom_font1_woff2 != '' || $custom_font1_ttf != '' || $custom_font1_svg != '' || $custom_font1_eot != '' ) ){				
				$font_face[] = '@font-face {font-family: "'.$font1_name.'";
				  src: url("'.$custom_font1_eot.'"); /* IE9*/
				  src: url("'.$custom_font1_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font1_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font1_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font1_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font1_svg.'#'.$font1_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		if( $enable_custom_font2 ){
			$font2_name 			= matjar_get_option( 'custom-font2-name',''); 
			$custom_font2_woff 		= matjar_get_custom_fonturl('custom-font2-woff');
			$custom_font2_woff2 	= matjar_get_custom_fonturl('custom-font2-woff2');
			$custom_font2_ttf 		= matjar_get_custom_fonturl('custom-font2-ttf');
			$custom_font2_svg		= matjar_get_custom_fonturl('custom-font2-svg');
			$custom_font2_eot 		= matjar_get_custom_fonturl('custom-font2-eot');
			if( !empty($font2_name ) && ( $custom_font2_woff != '' || $custom_font2_woff2 != '' || $custom_font2_ttf != '' || $custom_font2_svg != '' || $custom_font2_eot != '' ) ){				
				$font_face[] = '@font-face {font-family: "'.$font2_name.'";
				  src: url("'.$custom_font2_eot.'"); /* IE9*/
				  src: url("'.$custom_font2_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font2_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font2_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font2_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font2_svg.'#'.$font2_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		if( $enable_custom_font3 ){
			$font3_name 			= matjar_get_option( 'custom-font3-name',''); 
			$custom_font3_woff 		= matjar_get_custom_fonturl('custom-font3-woff');
			$custom_font3_woff2 	= matjar_get_custom_fonturl('custom-font3-woff2');
			$custom_font3_ttf 		= matjar_get_custom_fonturl('custom-font3-ttf');
			$custom_font3_svg		= matjar_get_custom_fonturl('custom-font3-svg');
			$custom_font3_eot 		= matjar_get_custom_fonturl('custom-font3-eot');
			if( !empty( $font3_name) && ( $custom_font3_woff != '' || $custom_font3_woff2 != '' || $custom_font3_ttf != '' || $custom_font3_svg != '' || $custom_font3_eot != '' ) ){				
				$font_face[] = '@font-face {font-family: "'.$font3_name.'";
				  src: url("'.$custom_font3_eot.'"); /* IE9*/
				  src: url("'.$custom_font3_eot.'?#iefix") format("embedded-opentype"), /* IE6-IE8 */
				  url("'.$custom_font3_woff2.'") format("woff2"), /* chrome,firefox */
				  url("'.$custom_font3_woff.'") format("woff"), /* chrome,firefox */
				  url("'.$custom_font3_ttf.'") format("truetype"), /* chrome,firefox,opera,Safari, Android, iOS 4.2+*/
				  url("'.$custom_font3_svg.'#'.$font3_name.'") format("svg"); /* iOS 4.1- */
				}';
			}
		}
		return !empty( $font_face ) ? implode(' ', $font_face ) : '';
	}
endif;

function matjar_get_custom_fonturl( $font_type ){
	$custom_font_file = matjar_get_option( $font_type );
	return (isset($custom_font_file['url']) && !empty($custom_font_file['url'])) ? $custom_font_file['url'] : '';
}