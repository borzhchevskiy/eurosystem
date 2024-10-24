<?php
/**
 * Template part for displaying category of project
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="project-info-item">
	<h5><?php esc_html_e( 'Category', 'matjar' );?><span>:</span></h5>
	<p><?php echo matjar_get_taxonomy_list( get_the_ID(), 'portfolio_cat', ', ' ) ; // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
</div>