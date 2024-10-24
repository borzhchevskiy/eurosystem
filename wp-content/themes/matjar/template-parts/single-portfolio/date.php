<?php
/**
 * Template part for displaying date of project
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! matjar_get_option('single-portfolio-date', 1) ) return;
?>

<div class="project-info-item">
	<h5><?php esc_html_e( 'Date', 'matjar' );?><span>:</span></h5>
	<p><?php echo get_the_date( apply_filters( 'matjar_project_date_format', '' ) );?></p>
</div>