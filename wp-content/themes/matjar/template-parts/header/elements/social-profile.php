<?php
/**
 * Template part for displaying social profile icon on topbar
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

$style 	= matjar_get_option( 'social-profile-icons-style', 'icons-default' );
$shape 	= matjar_get_option( 'profile-icons-shape', 'icons-shape-circle' );
$size 	= matjar_get_option( 'profile-icons-size', 'icons-size-default' );
if ( function_exists( 'matjar_social_share' ) ) {		
	matjar_social_share( 
		array(
			'type' => 'profile', 
			'style' => $style, 
			'shape' => $shape,
			'size' => $size
		) 
	);
}