<?php
/**
 * Displays the post entry gallery post format.
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

$thumbnail_size		= apply_filters( 'matjar_single_post_image_size', ( matjar_get_option('single-post-layout', 'right-sidebar' ) == 'full-width' ? 'full' : 'large' ) );
$gallery_style 	 	= apply_filters( 'matjar_single_post_gallery_style', matjar_get_option('single-post-gallery-style', 'slider' ) );
$post_thumbnail_id 	= get_post_thumbnail_id( get_the_ID() );
$attachment_ids		= get_post_meta( get_the_ID(), MATJAR_PREFIX.'post_format_gallery' );
$carousel_classes	= ( ! empty ($attachment_ids ) && matjar_get_option( 'single-post-gallery-style', 'slider' ) == 'slider' ? array('matjar-gallery-carousel', 'owl-carousel') : array( 'row', 'gallery-grid' ) );
$wrapper_classes	= apply_filters( 'matjar_single_post_image_classes', array_merge( array(
	'matjar-post-image',
	( has_post_thumbnail() ? 'with-images' : 'without-images' ),
), $carousel_classes) );
$html				= '';
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	<?php 
	if( ! empty ( $attachment_ids ) ){
		foreach ( $attachment_ids as $attachment_id ) {
			$html	.= matjar_get_gallery_image_html( $attachment_id, $thumbnail_size, $gallery_style );
		}
	}elseif( has_post_thumbnail() ){
		$html  = matjar_get_gallery_image_html( $post_thumbnail_id, $thumbnail_size );
	}
	
	echo apply_filters( 'matjar_single_post_image_html', $html );
	?>
</div>