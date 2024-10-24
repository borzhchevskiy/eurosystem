<?php 
/**
 * Product Categories Thumbnail Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<?php if( ! empty( $title ) ){ ?>
		<div class="section-heading">			
			<h2><?php echo esc_html( $title );?></h2>
			<?php if( $show_view_more_button ){ ?>
				<div class="view-all-btn">
					<a <?php echo implode(' ', $view_all_btn );?> ><?php echo esc_html( $view_more_button_text );?></a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="section-content<?php echo esc_attr( $row_class ); ?>">
		<div class="products <?php echo esc_attr( $slider_class ); ?>" 
		<?php if( $layout == 'slider' ) : ?>
			data-owl_options="<?php echo esc_attr( $owl_options );?>" 
		<?php endif;?>>	
			<?php if ( $product_categories ) {
				$count = 0;
				$lastElement = end( $product_categories );	
				$total_categories = count($product_categories);
				foreach ( $product_categories as $cat ) {
					$cate_link = get_term_link( $cat ); 
					if( $rows > 1 && $count % $rows == 0 ){
						echo '<div class="carousel-group">';
					}?>
					<div class="product-category <?php echo esc_attr($column_class);?>">	
						<a href="<?php echo esc_url($cate_link);?>">
							<div class="category-image">
								<?php 
								if( $image_type == 'icon' ){
									$prefix = MATJAR_PREFIX;
									$thumbnail_id = get_term_meta( $cat->term_id, $prefix.'category_icon', true );
								}else{
									$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
								}
								
								$category_img = wp_get_attachment_image_src( $thumbnail_id, $image_size );
								if ( ! empty( $category_img ) ) { 
									$attribute 			= array();
									$attribute['alt'] 	= esc_html($cat->name);
									 echo matjar_get_image_html($thumbnail_id, $image_size, '', $attribute);					
								}else{ ?>
									<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-thumbnail.jpg');?>" alt="<?php esc_html($cat->name);?>"/>
								<?php } ?>
							</div>
							
							<?php if( $show_title ){ ?>
								<div class="category-title"><?php echo esc_html($cat->name);?></div>
							<?php } ?>
						</a>
					</div>
					<?php
					if( $rows > 1 && ($count % $rows == $rows - 1 || $cat == $lastElement) ){
						echo '</div>';
					}
					$count++; 
				}
			} ?>
		</div>
	</div>
</div>