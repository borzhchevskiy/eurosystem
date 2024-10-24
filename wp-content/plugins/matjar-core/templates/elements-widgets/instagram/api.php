<?php 
/**
 * Instagram Template
 */

if ( is_wp_error($instagram_data) ) {
	   echo esc_html( $instagram_data->get_error_message() );
}else{ ?>
	<section id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
		<?php if( ! empty( $title  ) ) { ?>
			<div class="section-heading">
				<h2><?php echo esc_html($title); ?></h2>
			</div>
		<?php } ?>
		<div class="section-content <?php echo esc_attr( $section_class ); ?>">
			<div class="instagram-wrap <?php echo esc_attr( $slider_class ); ?>" <?php if(!empty( $owl_options ) ){ echo 'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >		
				<?php $count = 0; $username = '';
				foreach( $instagram_data as $item ) {
					if( $rows > 1 && $count % $rows == 0 ) {
						echo '<div class="carousel-group">';
					}
					$username 	= $item['username'];
					$image_url 	= $item['image_url']; ?>					
					<div class="instagram-image <?php echo esc_attr($column_class); ?>">					
						<div class="image-wrap">
							<a href="<?php echo esc_url( $item['image_link'] ); ?>" target="<?php echo esc_attr( $target ); ?>"></a>
							<?php echo matjar_get_src_image_loaded($image_url);?>
						</div>
					</div>					
					<?php if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $number_of_photos - 1) ){
						echo '</div>';
					} $count++;
				} ?>			
			</div>
		</div>
	</section>
<?php }