<?php
/**
 * Template part for displaying mini search in header.php
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

if( ! matjar_get_option( 'product-ajax-search', 1 ) ) return;
?>			

<div class="header-mini-search">
	<a class="search-icon-text" href="#">
		<span class="header-search-icon"></span>
		<span class="header-icon-text"><?php esc_html_e( 'Search', 'matjar') ?></span>
	</a>
</div>	