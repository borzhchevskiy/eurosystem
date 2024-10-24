<?php
/**
 * Template part for displaying welcome message of topbar
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

if( matjar_get_option( 'header-welcome-message','Welcome to Our Store!' ) !='' ) { ?>	
	<span class="welcome-message"><?php echo esc_html( matjar_get_option( 'header-welcome-message', 'Welcome to Our Store!' ) );?></span>
<?php } ?>
