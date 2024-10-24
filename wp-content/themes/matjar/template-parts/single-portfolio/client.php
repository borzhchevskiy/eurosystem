<?php
/**
 * Template part for displaying client of project
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! matjar_get_option('single-portfolio-client', 1) || ! $client ) {
	return;
}
?>

<div class="project-info-item">
	<h5><?php esc_html_e( 'Client', 'matjar' );?><span>:</span></h5>
	<p><?php echo esc_html( $client );?></p>
</div>