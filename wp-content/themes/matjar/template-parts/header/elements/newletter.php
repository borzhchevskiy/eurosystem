<?php
/**
 * Template part for displaying newsletter
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

if( matjar_get_option( 'header-newsletter' ) !='' ) { ?>
	<span class="header-newsletter"><i class="jricon-envelope"></i> <?php echo esc_html( matjar_get_option('header-newsletter','Newsletter') );?></span>
<?php } ?>
