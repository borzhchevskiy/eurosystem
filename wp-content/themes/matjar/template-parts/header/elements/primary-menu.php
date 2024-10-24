<?php
/**
 * Template part for displaying main menu
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

wp_nav_menu(
	array(
		'theme_location' 	=> 'primary',
		'container_class'   => 'main-navigation matjar-navigation',
		'fallback_cb' 		=> 'matjar_fallback_menu',
		'walker' 			=> new Matjar_Mega_Menu_Walker()
	)
);