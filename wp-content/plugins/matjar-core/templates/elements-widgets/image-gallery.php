<?php 
/**
 * Image Gallery
 */
?>
<div id="<?php echo esc_attr( $id );?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-content">
		<div class="<?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $owl_options ) ){ echo 'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >
			<?php if ( ! empty( $gallery_images ) ) {
				$count = 0;
				$lastElement = end( $gallery_images );	
				$total_images = count( $gallery_images );
				$row=1;
				
				foreach( $gallery_images as $index => $attchData ){
					$image_url = wp_get_attachment_image_src( $attchData['id'], 'full' );
					
					if( $row == 1 && $rows > 1) { 
						echo '<div class="carousel-group">'; 
					}?>
					
					<div class="matjar-gallery <?php echo esc_attr ( $column_class );?>">
						<a href="<?php echo esc_url( $profile_link );?>" data-elementor-open-lightbox="no">
							<?php if( wp_get_attachment_url($attchData['id'] ) ) :
								$image_output = wp_get_attachment_image( $attchData['id'], 'full', false );
								echo $image_output;
							else:?>
								<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html_e('Gallery Image','matjar-core');?>"/>
							<?php endif;?>
						</a>
					</div>
					<?php 
					if( ( $row == $rows || $gallery_images == $lastElement ) && $rows > 1 ){
						$row=0;
						echo '</div>';
					} $row++;
				}
			} ?>
		</div>
	</div>
</div>