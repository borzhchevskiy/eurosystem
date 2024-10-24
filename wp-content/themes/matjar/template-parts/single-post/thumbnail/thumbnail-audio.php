<?php
/**
 * Displays the post entry audio post format.
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-post/thumbnail
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! matjar_get_option( 'single-post-thumbnail', 1 ) ) return;

// Get post audio
$audio = matjar_get_post_audio();

if(! empty( $audio ) ){?>
	<div class="post-thumbnail">
		<?php echo apply_filters( 'matjar_post_audio', $audio ); // WPCS: XSS OK. ?>
	</div>
<?php }else{
	if( has_post_thumbnail() ){?>
		<div class="post-thumbnail">
		<?php echo matjar_get_post_thumbnail('large'); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	<?php }
}