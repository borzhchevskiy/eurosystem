<?php
/**
 * Template part for displaying email adress on topbar
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

if( matjar_get_option( 'header-email','support@matjar.com' ) != '' ) { ?>			
	<span class="contact-email"><i class="jricon-envelope"></i> <?php echo esc_html( matjar_get_option('header-email','support@matjar.com' ) );?></span>
<?php } ?>
