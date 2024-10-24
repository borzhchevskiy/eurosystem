<?php

/* Theme Widget sidebars. */
require MATJAR_CORE_DIR . '/widgets/widget-base/abstract-widget-base.php';
require MATJAR_CORE_DIR . '/widgets/class-about-us.php';
require MATJAR_CORE_DIR . '/widgets/class-social-links.php';
require MATJAR_CORE_DIR . '/widgets/class-newsletter.php';
require MATJAR_CORE_DIR . '/widgets/class-recent-posts.php';
require MATJAR_CORE_DIR . '/widgets/class-portfolios.php';

add_action('widgets_init','matjar_register_widget');
function matjar_register_widget(){
	register_widget( 'Matjar_About_Us_Widget' );
	register_widget( 'Matjar_Social_Links' );	
	register_widget( 'Matjar_Newsletter_Widget' );
	register_widget( 'Matjar_Recent_Posts_Widget' );	
	register_widget( 'Matjar_Portfolio_Widget' );
	if ( class_exists( 'WC_Widget' ) ) {	
		require MATJAR_CORE_DIR . '/widgets/woocommerce-product.php';		
		require MATJAR_CORE_DIR . '/widgets/woocommerce-product-attributes-filter.php';		
		require MATJAR_CORE_DIR . '/widgets/woocommerce-brand-filter.php';			
		require MATJAR_CORE_DIR . '/widgets/woocommerce-product-sorting.php';			
		require MATJAR_CORE_DIR . '/widgets/woocommerce-price-filter.php';			
		register_widget( 'Matjar_Products_Widget' );		
		register_widget( 'Matjar_Widget_Attributes_Filter' );		
		register_widget( 'Matjar_Brand_Filter_Widget' );
		register_widget( 'Matjar_WC_Widget_Product_Sorting' );
		register_widget( 'Matjar_Price_Filter_List_Widget' );
	}
}