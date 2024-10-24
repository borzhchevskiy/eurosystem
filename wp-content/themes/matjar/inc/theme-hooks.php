<?php
/**
 * Action/filter hooks used for theme functions/templates.
 *
 * @author 		ThemeJR
 * @package 	matjar/inc
 * @since     	1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'body_class', 'matjar_body_classes' );
add_filter( 'post_class', 'matjar_post_classes', 10, 3 );

add_action( 'matjar_body_top', 'matjar_site_loader', 1 );

/**
 * Content Wrappers.
 *
 * @see matjar_output_content_wrapper()
 * @see matjar_output_content_wrapper_end()
 */
add_action( 'matjar_before_main_content', 'matjar_output_content_wrapper', 10 );
add_action( 'matjar_after_main_content', 'matjar_output_content_wrapper_end', 10 );

/**
 * Header.
 *
 * @see matjar_template_header()
 * @see matjar_header_topbar_left()
 * @see matjar_header_topbar_right()
 * @see matjar_header_main_left()
 * @see matjar_header_main_center()
 * @see matjar_header_main_right()
 * @see matjar_header_navigation_left()
 * @see matjar_header_navigation_center()
 * @see matjar_header_navigation_right()
 */
add_action( 'matjar_header', 'matjar_template_header', 10 );
add_action( 'matjar_header_topbar_left', 'matjar_header_topbar_left', 10 );
add_action( 'matjar_header_topbar_right', 'matjar_header_topbar_right', 10 );
add_action( 'matjar_header_main_left', 'matjar_header_main_left', 10 );
add_action( 'matjar_header_main_center', 'matjar_header_main_center', 10 );
add_action( 'matjar_header_main_right', 'matjar_header_main_right', 10 );
add_action( 'matjar_header_navigation_left', 'matjar_header_navigation_left', 10 );
add_action( 'matjar_header_navigation_center', 'matjar_header_navigation_center', 10 );
add_action( 'matjar_header_navigation_right', 'matjar_header_navigation_right', 10 );
add_action( 'matjar_header_sticky_left', 'matjar_header_sticky_left', 10 );
add_action( 'matjar_header_sticky_center', 'matjar_header_sticky_center', 10 );
add_action( 'matjar_header_sticky_right', 'matjar_header_sticky_right', 10 );
add_action( 'matjar_header_mobile_topbar_center', 'matjar_header_mobile_topbar_center', 10 );
add_action( 'matjar_header_mobile_left', 'matjar_header_mobile_left', 10 );
add_action( 'matjar_header_mobile_center', 'matjar_header_mobile_center', 10 );
add_action( 'matjar_header_mobile_right', 'matjar_header_mobile_right', 10 );

/**
 * Page Title.
 *
 * @see matjar_template_page_title()
 * @see matjar_template_breadcrumbs()
 */
add_action( 'matjar_page_title', 'matjar_page_title', 10 );
add_action( 'matjar_inner_page_title', 'matjar_template_page_title', 10 );
add_action( 'matjar_inner_page_title', 'matjar_template_breadcrumbs', 20 );

/**
 * Page
 *
 * @see matjar_template_page_content()
 * @see matjar_template_page_comments()
 */
add_action( 'matjar_page_content', 'matjar_template_page_content', 10 );
add_action( 'matjar_after_page_entry', 'matjar_template_page_comments', 10 );

/**
 * Sidebar.
 *
 * @see matjar_get_sidebar()
 */
add_action( 'matjar_sidebar', 'matjar_get_sidebar', 10 );

/**
 * Post Loop.
 *
 * @see matjar_post_wrapper()
 * @see matjar_template_loop_post_date()
 * @see matjar_template_loop_post_highlight()
 * @see matjar_template_loop_post_thumbnail()
 * @see matjar_template_loop_post_header()
 * @see matjar_template_loop_post_title()
 * @see matjar_template_loop_post_meta()
 * @see matjar_template_loop_post_content()
 * @see matjar_template_loop_post_footer()
 * @see matjar_template_read_more_link()
 * @see matjar_post_wrapper_end()
 * @see matjar_pagination()
 */
 
add_action( 'matjar_loop_post_entry_top', 'matjar_post_wrapper', 10 );
add_action( 'matjar_loop_post_thumbnail', 'matjar_template_loop_post_date', 10 );
add_action( 'matjar_loop_post_thumbnail', 'matjar_template_loop_post_highlight', 10 );
add_action( 'matjar_loop_post_thumbnail', 'matjar_template_loop_post_thumbnail', 20 );
add_action( 'matjar_loop_post_content', 'matjar_template_loop_post_header', 10 );
add_action( 'matjar_loop_post_content', 'matjar_template_loop_post_content', 20 );
add_action( 'matjar_loop_post_content', 'matjar_template_loop_post_footer', 30 );
add_action( 'matjar_loop_post_entry_bottom', 'matjar_post_wrapper_end', 10 );
add_action( 'matjar_after_loop_post', 'matjar_pagination', 10 );

//Inner hook
add_action( 'matjar_loop_post_header', 'matjar_template_loop_post_category', 5 );
add_action( 'matjar_loop_post_header', 'matjar_template_loop_post_title', 10 );
add_action( 'matjar_loop_post_header', 'matjar_template_loop_post_meta', 20 );
add_action( 'matjar_loop_post_footer', 'matjar_template_read_more_link', 10 );

/**
 * Single Post.
 *
 * @see matjar_post_wrapper()
 * @see matjar_template_single_post_date()
 * @see matjar_template_single_post_thumbnail()
 * @see matjar_template_single_post_highlight()
 * @see matjar_template_single_post_header()
 * @see matjar_template_single_post_content()
 * @see matjar_post_wrapper_end()
 * @see matjar_template_single_post_author_bios()
 * @see matjar_template_single_tag_social_share()
 * @see matjar_template_single_post_navigation()
 * @see matjar_template_single_post_related()
 * @see matjar_template_single_post_comments()
 * @see matjar_template_single_post_category()
 * @see matjar_template_single_post_title()
 * @see matjar_template_single_post_meta()
 */
 
add_action( 'matjar_single_post_entry_top', 'matjar_post_wrapper', 10 );
add_action( 'matjar_single_post_entry_top', 'matjar_template_single_post_header', 15 );
add_action( 'matjar_single_post_thumbnail', 'matjar_template_single_post_date', 10 );
add_action( 'matjar_single_post_thumbnail', 'matjar_template_single_post_thumbnail', 10 );
add_action( 'matjar_single_post_thumbnail', 'matjar_template_single_post_highlight', 20 );
add_action( 'matjar_single_post_content', 'matjar_template_single_post_content', 10 );
add_action( 'matjar_single_post_entry_bottom', 'matjar_post_wrapper_end', 10 );
add_action( 'matjar_after_single_post_entry', 'matjar_template_single_post_author_bios', 10 );
add_action( 'matjar_after_single_post_entry', 'matjar_template_single_tag_social_share', 20 );
add_action( 'matjar_after_single_post_entry', 'matjar_template_single_post_navigation', 30 );
add_action( 'matjar_after_single_post_entry', 'matjar_template_single_post_related', 40 );
add_action( 'matjar_after_single_post_entry', 'matjar_template_single_post_comments', 50 );

//Inner hook
add_action( 'matjar_single_post_header', 'matjar_template_single_post_category', 5 );
add_action( 'matjar_single_post_header', 'matjar_template_single_post_title', 10 );
add_action( 'matjar_single_post_header', 'matjar_template_single_post_meta', 20 );

/**
 * Portfolio Loop.
 *
 * @see matjar_template_portfolio_filter()
 * @see matjar_post_wrapper()
 * @see matjar_template_portfolio_loop_thumbnail()
 * @see matjar_template_portfolio_loop_action_icon()
 * @see matjar_template_portfolio_loop_header()
 * @see matjar_post_wrapper_end()
 * @see matjar_template_portfolio_loop_categories()
 * @see matjar_template_portfolio_loop_title()
 * @see matjar_portfolio_pagination()
 */
add_action( 'matjar_before_portfolio_loop', 'matjar_template_portfolio_filter', 10 );
add_action( 'matjar_portfolio_loop_entry_top', 'matjar_post_wrapper', 10 );
add_action( 'matjar_portfolio_loop_thumbnail', 'matjar_template_portfolio_loop_thumbnail', 10 );
add_action( 'matjar_portfolio_loop_thumbnail', 'matjar_template_portfolio_loop_action_icon', 20 );
add_action( 'matjar_portfolio_loop_content', 'matjar_template_portfolio_loop_header', 10 );
add_action( 'matjar_portfolio_loop_entry_bottom', 'matjar_post_wrapper_end', 10 );
add_action( 'matjar_after_portfolio_loop', 'matjar_portfolio_pagination', 10 );

//Inner hook 
add_action( 'matjar_portfolio_loop_header', 'matjar_template_portfolio_loop_categories',10 );
add_action( 'matjar_portfolio_loop_header', 'matjar_template_portfolio_loop_title',20 );;

/**
 * Single Post.
 *
 * @see matjar_post_wrapper()
 * @see matjar_template_single_portfolio_image()
 * @see matjar_template_single_portfolio_title()
 * @see matjar_template_single_portfolio_content()
 * @see matjar_template_single_portfolio_client()
 * @see matjar_template_single_portfolio_date()
 * @see matjar_template_single_portfolio_category()
 * @see matjar_template_single_portfolio_skill()
 * @see matjar_template_single_portfolio_share()
 * @see matjar_template_single_portfolio_navigation()
 * @see matjar_template_single_related_portfolio()
 * @see matjar_template_single_portfolio_comments()
 * @see matjar_post_wrapper_end()
 */
add_action( 'matjar_single_portfolio_entry_top', 'matjar_post_wrapper', 10 );
add_action( 'matjar_single_portfolio_image', 'matjar_template_single_portfolio_image', 10 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_title', 5 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_content', 10 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_preview', 15 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_client', 20 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_date', 25 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_category', 30 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_skill', 35 );
add_action( 'matjar_single_portfolio_summary', 'matjar_template_single_portfolio_share', 40 );
add_action( 'matjar_after_single_portfolio_entry', 'matjar_template_single_portfolio_navigation', 10 );
add_action( 'matjar_after_single_portfolio_entry', 'matjar_template_single_related_portfolio', 20 );
add_action( 'matjar_after_single_portfolio_entry', 'matjar_template_single_portfolio_comments', 30 );
add_action( 'matjar_single_portfolio_entry_bottom', 'matjar_post_wrapper_end', 10 );

/* Comming Soon */
add_action( 'template_redirect', 'matjar_coming_soon_redirect' );

/**
 * Footer.
 *
 * @see matjar_template_footer()
 * @see matjar_template_footer_copyright()
 * @see matjar_back_to_top()
 * @see matjar_mobile_menu()
 * @see matjar_search_popup()
 * @see matjar_newsletter_popup()
 * @see matjar_mobile_bottom_navbar()
 * @see matjar_mask_overaly()
 */
add_action( 'matjar_footer_top', 'matjar_template_footer_subscribe', 10 );
add_action( 'matjar_footer', 'matjar_template_footer', 10 );
add_action( 'matjar_footer_bottom', 'matjar_template_footer_categories', 5 );
add_action( 'matjar_footer_bottom', 'matjar_template_footer_copyright', 10 );
add_action( 'matjar_body_bottom', 'matjar_back_to_top', 10 );
add_action( 'matjar_body_bottom', 'matjar_mobile_menu', 20 );
add_action( 'matjar_body_bottom', 'matjar_search_popup', 25 );
add_action( 'matjar_body_bottom', 'matjar_newsletter_popup', 30 );
add_action( 'matjar_body_bottom', 'matjar_mobile_bottom_navbar', 40 );
add_action( 'matjar_body_bottom', 'matjar_mask_overaly', 100 );