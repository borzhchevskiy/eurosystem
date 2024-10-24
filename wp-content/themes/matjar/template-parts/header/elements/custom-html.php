<?php
/**
 * Template part for displaying header logo
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package /template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
		
if( !isset( $custom_html ) ){
	return;
}
$custom_html = matjar_get_option( $custom_html, '' ); ?>
<div class="matjar-header-custom-html">
	<?php
	echo do_shortcode($custom_html);
	?>
</div>
<?php