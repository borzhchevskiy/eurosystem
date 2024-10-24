<?php
/**
 * Template part for displaying single portfolio image/gallery
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>">
	<?php
	$html ='';
	if( ! empty ( $attachment_ids ) && $is_gallery_style){
		foreach ( $attachment_ids as $attachment_id ) {
			$html	.= matjar_get_gallery_image_html( $attachment_id, $thumbnail_size, $gallery_style );
		}
	}elseif( has_post_thumbnail() ){
		$html  = matjar_get_image_html( $post_thumbnail_id, $thumbnail_size );
	}
	
	echo apply_filters( 'matjar_single_portfolio_image_html', $html );
	?>
</div>