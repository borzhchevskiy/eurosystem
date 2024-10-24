<?php
/**
 * Template part for displaying header logo
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
		
$logo_url 				= matjar_get_option( 'header-logo', array( 'url' => MATJAR_IMAGES.'logo.png' ) );
$logo_light_url 		= matjar_get_option( 'header-logo-light', array( 'url' => MATJAR_IMAGES.'logo-light.png' ) );
$mobile_logo_url		= matjar_get_option( 'mobile-header-logo', array( 'url' => MATJAR_IMAGES.'logo.png' ) );
$site_title 			= get_bloginfo( 'name', 'display' );

if( is_ssl() ) {
	$logo 					= str_replace('http://', 'https://', $logo_url['url']);
	$logo_light				= str_replace('http://', 'https://', $logo_light_url['url']);
	$mobile_logo 			= str_replace('http://', 'https://', $mobile_logo_url['url']);
}else{
	$logo					= $logo_url['url'];
	$logo_light				= $logo_light_url['url'];
	$mobile_logo			= $mobile_logo_url['url'];
}?>	

<div class="header-logo">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="<?php echo esc_attr('home');?>">
		<img class="logo" src="<?php echo esc_url($logo);?>" alt="<?php echo esc_attr($site_title);?>" />
		<img class="logo-light" src="<?php echo esc_url($logo_light);?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) );?>" />
		<img class="mobile-logo" src="<?php echo esc_url($mobile_logo);?>" alt="<?php echo esc_attr($site_title);?>" />
	</a>
</div>
