<?php
/**
 * Template part for displaying mobile navbar
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
}?>

<div class="mobile-navbar">	
	<a href="#" class="navbar-toggle">
		<span class="navbar-icon"><i class="jricon-menu"></i></span>
		<span class="navbar-label"><?php esc_html_e('Menu','matjar');?></span>
	</a>
</div>
