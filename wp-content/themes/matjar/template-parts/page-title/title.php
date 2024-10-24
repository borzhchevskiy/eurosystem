<?php
/**
 * Template part for displaying page title
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/page-title
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="entry-header">
	<h1 class="title">
		<?php echo matjar_get_page_title(); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</h1>
</div>