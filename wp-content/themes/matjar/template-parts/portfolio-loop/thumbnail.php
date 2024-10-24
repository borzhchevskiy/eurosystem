<?php
/**
 * Displays the portfolio post entry thumbnail
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/portfolio
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! has_post_thumbnail() || ! matjar_get_loop_prop( 'portfolio-post-thumbnail' ) ) {
	return;
}
?>

<div class="post-thumbnail">	
	<a href="<?php echo esc_url( get_permalink() );?>" ><?php echo matjar_get_post_thumbnail('medium','wp-post-image'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></a>	
</div>