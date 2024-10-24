<?php 
/**
 * Action/filter hooks used for woocommerce functions/templates.
 *
 * @author 		ThemeJR
 * @package 	matjar/inc
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_theme_support( 'woocommerce');
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
add_filter('woocommerce_show_page_title', '__return_false');
add_filter( 'body_class', 'matjar_body_woocommerce_classes' );

/**
 * Matjar Header
 *
 * @see matjar_ajax_wishlist_count()
 * @see matjar_ajax_compare_count()
 * @see matjar_empty_mini_cart_button()
 */
add_action( 'wp_ajax_matjar_ajax_wishlist_count', 'matjar_ajax_wishlist_count' );
add_action( 'wp_ajax_nopriv_matjar_ajax_wishlist_count', 'matjar_ajax_wishlist_count' );
add_action( 'wp_ajax_matjar_ajax_compare_count', 'matjar_ajax_compare_count' );
add_action( 'wp_ajax_nopriv_matjar_ajax_compare_count', 'matjar_ajax_compare_count' );
add_action( 'matjar_after_empty_mini_cart', 'matjar_empty_mini_cart_button', 20 );

/**
 * Content Wrappers
 *
 * @see matjar_output_content_wrapper()
 * @see matjar_output_content_wrapper_end()
 * @see matjar_reset_loop()
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'matjar_output_content_wrapper', 10 );
add_action( 'woocommerce_after_main_content', 'matjar_output_content_wrapper_end', 10 );

add_action( 'woocommerce_after_shop_loop', 'matjar_reset_loop', 999 );

/**
 * Products Loop
 *
 * @see matjar_before_shop_loop()
 * @see matjar_shop_page_title()
 * @see matjar_product_loop_view()
 * @see matjar_product_loop_show()
 * @see matjar_active_filter_widgets()
 * @see matjar_clear_filters_btn()
 * @see matjar_loop_product_wrapper()
 * @see matjar_before_shop_loop_item_title()
 * @see matjar_output_product_labels()
 * @see matjar_product_loop_quick_view_button()
 * @see matjar_template_loop_product_thumbnail()
 * @see matjar_shop_loop_item_title()
 * @see matjar_loop_product_info_wrapper()
 * @see matjar_product_title_rating_wrapper()
 * @see matjar_product_loop_categories()
 * @see matjar_product_price_buttons_wrapper()
 * @see matjar_after_shop_loop_item_title()
 * @see matjar_product_sale_percentage()
 * @see matjar_product_loop_buttons_variations()
 * @see matjar_template_loop_action_buttons()
 * @see matjar_product_loop_cart_button()
 * @see matjar_product_loop_wishlist_button()
 * @see matjar_product_loop_compare_button()
 * @see matjar_stock_progress_bar()
 * @see matjar_sale_product_countdown()
 * @see matjar_after_shop_loop_item()
 * @see matjar_product_wrapper_end()
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_before_shop_loop', 'matjar_before_shop_loop', 20 );
add_action( 'matjar_shop_loop_header_left', 'matjar_product_off_canvas_sidebar', 5 );
add_action( 'matjar_shop_loop_header_left', 'matjar_shop_page_title', 10 );
add_action( 'matjar_shop_loop_header_left', 'woocommerce_result_count', 20 );
add_action( 'matjar_shop_loop_header_right', 'matjar_product_loop_view', 20 );
add_action( 'matjar_shop_loop_header_right', 'matjar_product_loop_show', 25 );
add_action( 'matjar_shop_loop_header_right', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'matjar_active_filter_widgets', 30 );
add_action( 'matjar_before_active_filters_widgets', 'matjar_clear_filters_btn', 30 );
add_action( 'woocommerce_before_shop_loop_item', 'matjar_loop_product_wrapper', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'matjar_before_shop_loop_item_title', 10 );
add_action( 'matjar_before_shop_loop_item_title', 'matjar_output_product_labels', 5 );
//add_action( 'matjar_before_shop_loop_item_title', 'matjar_sale_product_countdown', 8 );
add_action( 'matjar_before_shop_loop_item_title', 'matjar_product_loop_quick_view_button', 10 );
add_action( 'matjar_before_shop_loop_item_title', 'matjar_template_loop_product_thumbnail', 15 );
add_action( 'woocommerce_shop_loop_item_title', 'matjar_shop_loop_item_title', 10 );
add_action( 'matjar_shop_loop_item_title', 'matjar_loop_product_info_wrapper', 5 );
add_action( 'matjar_shop_loop_item_title', 'matjar_product_title_rating_wrapper', 10 );
add_action( 'matjar_shop_loop_item_title', 'matjar_product_loop_categories', 15 );
add_action( 'matjar_shop_loop_item_title', 'woocommerce_template_loop_product_title', 20 );
add_action( 'matjar_shop_loop_item_title', 'woocommerce_template_loop_rating', 25 );
add_action( 'matjar_shop_loop_item_title', 'woocommerce_template_single_excerpt', 30 );
add_action( 'matjar_shop_loop_item_title', 'matjar_product_wrapper_end', 50 );
add_action( 'woocommerce_after_shop_loop_item_title', 'matjar_product_price_buttons_wrapper', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'matjar_after_shop_loop_item_title', 10 );
add_action( 'matjar_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'matjar_after_shop_loop_item_title', 'matjar_product_sale_percentage', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'matjar_product_loop_buttons_variations', 10 );
add_action( 'matjar_product_loop_buttons_variations', 'matjar_template_loop_action_buttons', 10 );
//add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_quantity_field', 5 );
add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_cart_button', 10 );
add_action( 'matjar_product_loop_cart_button', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_wishlist_button', 15 );
add_action( 'matjar_template_loop_action_buttons', 'matjar_product_loop_compare_button', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'matjar_stock_progress_bar', 14 );
add_action( 'woocommerce_after_shop_loop_item', 'matjar_sale_product_countdown', 15 );
add_action( 'woocommerce_after_shop_loop_item', 'matjar_after_shop_loop_item', 50 );
add_action( 'matjar_after_shop_loop_item', 'matjar_product_wrapper_end', 10 );
add_action( 'matjar_after_shop_loop_item', 'matjar_product_wrapper_end', 20 );
add_action( 'matjar_after_shop_loop_item', 'matjar_product_wrapper_end', 30 );

/**
 * Categories Loop.
 */
add_action( 'woocommerce_before_subcategory', 'matjar_loop_product_wrapper', 5 );
add_action( 'woocommerce_after_subcategory', 'matjar_product_wrapper_end', 10 );

/**
 * Single Product
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
 
/**
 * Single Products Summary Div.
 *
 * @see matjar_output_product_labels()
 * @see matjar_single_product_video_btn()
 * @see matjar_single_product_degree360_btn()
 * @see matjar_single_product_photoswipe_btn()
 * @see matjar_single_product_before_price()
 * @see matjar_product_navigation_share()
 * @see matjar_single_product_navigation()
 * @see woocommerce_template_single_rating()
 * @see matjar_sale_product_countdown()
 * @see matjar_single_product_after_price()
 * @see matjar_single_product_price_discount()
 * @see matjar_single_product_stock_availability()
 * @see matjar_single_product_brands()
 * @see matjar_single_product_size_chart()
 * @see matjar_single_product_delivery_return_ask_question()
 * @see matjar_single_product_estimated_delivery()
 * @see matjar_single_product_visitor_count()
 * @see matjar_single_product_policy()
 * @see matjar_single_product_trust_badge()
 * @see matjar_single_product_share()
 * @see matjar_output_recently_viewed_products()
 */

add_action( 'matjar_product_gallery_top', 'matjar_output_product_labels', 10 ); 
add_action( 'matjar_product_gallery_bottom', 'matjar_single_product_video_btn', 10 );
add_action( 'matjar_product_gallery_bottom', 'matjar_single_product_degree360_btn', 15 );
add_action( 'matjar_product_gallery_bottom', 'matjar_single_product_photoswipe_btn', 20 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_before_price', 6 );
add_action( 'matjar_single_product_before_price', 'matjar_product_navigation_share', 10 );
add_action( 'matjar_product_navigation_share', 'matjar_single_product_navigation', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8);
add_action( 'woocommerce_single_product_summary', 'matjar_sale_product_countdown', 9);
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_after_price', 12);
add_action( 'matjar_single_product_after_price', 'matjar_single_product_price_discount', 5 );
add_action( 'matjar_single_product_after_price', 'matjar_single_product_stock_availability', 6 );
add_action( 'matjar_single_product_after_price', 'matjar_single_product_brands', 15 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_size_chart', 35 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_delivery_return_ask_question', 36 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_estimated_delivery', 37 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_visitor_count', 38 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_policy', 39 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_trust_badge', 39 );
add_action( 'woocommerce_single_product_summary', 'matjar_single_product_share', 50 );
add_action( 'woocommerce_after_single_product_summary', 'matjar_output_recently_viewed_products', 25 );

/* Quick Buy*/
add_action( 'woocommerce_after_add_to_cart_button', 'matjar_add_quick_buy_pid');
add_action( 'woocommerce_after_add_to_cart_button', 'matjar_add_quick_buy_button', 99 );
add_filter( 'woocommerce_add_to_cart_redirect', 'matjar_quick_buy_redirect', 99 );

/**
 * Quantity Buttons
 *
 * @see matjar_quantity_button_minus()
 * @see matjar_quantity_button_plus()
 */
add_action( 'woocommerce_before_quantity_input_field', 'matjar_quantity_button_minus', 10 );
add_action( 'woocommerce_after_quantity_input_field', 'matjar_quantity_button_plus', 10 );

/**
 * My Account Page
 */
remove_action( 'woocommerce_register_form', 'wc_registration_privacy_policy_text', 20 );

add_action( 'matjar_before_signup_form', 'wc_registration_privacy_policy_text', 10 );
add_action( 'woocommerce_before_account_navigation', 'matjar_before_account_navigation' );
add_action( 'woocommerce_after_account_navigation', 'matjar_after_account_navigation' );
add_action( 'woocommerce_before_account_orders', 'matjar_woocommerce_before_account_orders', 10 );
add_action( 'woocommerce_before_account_downloads', 'matjar_woocommerce_before_account_downloads', 10 );
add_filter( 'woocommerce_my_account_my_address_description', 'matjar_woocommerce_my_account_my_address_description', 10 );
add_action( 'woocommerce_before_edit_account_form', 'matjar_woocommerce_myaccount_edit_account_heading', 10 );

/**
 * Cart Page
 *
 * @see matjar_free_shipping_bar()
 * @see matjar_woocommerce_cart_page_wrapper()
 * @see matjar_woocommerce_cart_page_wrapper_end()
 * @see woocommerce_cross_sell_display()
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

add_action( 'woocommerce_proceed_to_checkout', 'matjar_free_shipping_bar', 10 );
add_action( 'woocommerce_before_cart', 'matjar_woocommerce_cart_page_wrapper', 10 );
add_action( 'woocommerce_after_cart', 'matjar_woocommerce_cart_page_wrapper_end', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 20 );

 /**
 * Mini Cart
 *
 * @see matjar_free_shipping_bar()
 */
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'matjar_free_shipping_bar', 10 );

/**
 * Footer
 *
 * @see matjar_login_signup_popup()
 * @see matjar_minicart_slide()()
 * @see matjar_canvas_sidebar()
 * @see matjar_single_product_360_degree_content()
 * @see matjar_sticky_add_to_cart_button()
 */
add_action( 'matjar_body_bottom', 'matjar_login_signup_popup', 50 );
add_action( 'matjar_body_bottom', 'matjar_minicart_slide', 55 );
add_action( 'matjar_body_bottom', 'matjar_canvas_sidebar', 60 );
add_action( 'matjar_body_bottom', 'matjar_single_product_360_degree_content', 65 );
add_action( 'matjar_body_bottom', 'matjar_sticky_add_to_cart_button', 70 );