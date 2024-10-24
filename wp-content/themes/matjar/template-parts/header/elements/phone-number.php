<?php
/**
 * Template part for displaying phone number on topbar
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

if( matjar_get_option( 'header-phone-number', '+123 4567 890' ) != '' ) { ?>
	<span class="contact-phone"><i class="jricon-phone"></i> <?php echo esc_html( matjar_get_option( 'header-phone-number', '+123 4567 890' ) );?></span>
<?php } ?>
