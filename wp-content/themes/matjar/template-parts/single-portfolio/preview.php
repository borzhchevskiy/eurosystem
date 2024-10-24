<?php
/**
 * Template part for displaying preview of project
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

<div class="project-preview">
	<a class="btn preview-link" href="<?php echo esc_url( $website_link );?>" target="_blank"><?php esc_html_e('Live Preview', 'matjar');?></a>
</div>