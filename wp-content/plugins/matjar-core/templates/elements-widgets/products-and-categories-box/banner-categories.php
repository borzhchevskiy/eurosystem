<?php 
/** 
 * Banner With Categories Template
 */

if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif; ?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-inner row">
		<div class="section-categories col-12 col-md-3 col-lg-2">
			<?php if( !empty( $title ) ) { ?>
			<div class="section-title">
				<h3><?php echo esc_attr($title);?></h3>
			</div>
			<?php } ?>
			<ul class="sub-categories">
				<?php foreach($product_categories as $cate):
						$cate_link = get_term_link( $cate ); ?>
					<li><a href="<?php echo esc_url($cate_link);?>"><?php echo esc_html($cate->name);?></a></li>
				<?php endforeach;?>
			</ul>
		</div>
		<div class="section-banner-content col-12 col-md-9 col-lg-10">
			<div class="row">
				<div class="section-banner col-xl-5 d-none d-xl-block">
					<div id="<?php echo esc_attr($banner_id);?>" class="banner-img">
						<?php if($banner_style=="banner_slider"):?>
							<ul class="matjar-carousel owl-carousel" <?php if(!empty( $banner_owl_options ) ){ echo 'data-owl_options="'.esc_attr( $banner_owl_options ).'"';  } ?> >
								<?php 
									if( !empty( $banner_images )) {
									foreach( $banner_images as $index => $attchData):?>
									<?php //$cate_link = get_term_link( $cate ); ?>
									<li>
										<a href="<?php echo  !empty($cat_title_link) ? esc_url( $cat_title_link ) : 'javascript:void();'; ?>">
										<?php if(wp_get_attachment_url( $attchData['id'] )) :
											echo matjar_get_image_html($attchData['id'],'full');
										else:?>
											<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html_e('Banner','matjar-core');?>"/>
										<?php endif;?>
										</a>
									</li>
								<?php endforeach;
									}else{ ?>
									<li>
										<a href="<?php echo  !empty($cat_title_link) ? esc_url( $cat_title_link ) : 'javascript:void();'; ?>">										
											<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html_e('Banner','matjar-core');?>"/>
										</a>
									</li>	
									<?php }
								?>
							</ul>
						<?php else:?>
							<a href="<?php echo  !empty($cat_title_link) ? esc_url( $cat_title_link ) : 'javascript:void();'; ?>">
								<?php if(wp_get_attachment_url( $banner_image['id'] )) :
									echo matjar_get_image_html($banner_image['id'],'full');
								elseif( !empty( $banner_image['url'] )): 
									echo matjar_get_src_image_loaded( $banner_image['url'] );
								else:?>
									<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-placeholder.jpg');?>"/>
								<?php endif;?>
							</a>
						<?php endif;?>
					</div>
				</div>
				<div class="section-content col-12 col-xl-7">
					<?php if ( ! empty($product_categories) ) :	$lastElement = end( $product_categories );	?>
						<?php $row=1; ?>
						<div id="<?php echo esc_attr( $cat_section_id );?>" class="row">
							<div class="products matjar-carousel owl-carousel" <?php if(!empty( $owl_options ) ){ echo 'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >
								<?php foreach( $product_categories as $cat ): 	
									if( $row == 1 ) { 
										echo '<div class="carousel-group">'; 
									}								
									$cate_link = get_term_link( $cat ); ?>
									<div class="product-category product product <?php echo esc_attr($category_box_style);?>">
										<div class="product-wrapper">
											<div class="category-image">
												<a href="<?php echo esc_url($cate_link);?>">
												<?php $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
												$catalog_img = wp_get_attachment_image_src( $thumbnail_id, 'shop_catalog' );
												if ( ! empty( $catalog_img ) ) {
													$attribute 			= array();
													$attribute['alt'] 	= esc_html( $cat->name );
													 
													echo matjar_get_image_html($thumbnail_id,'shop_catalog','',$attribute); 
												}else{ ?>
													<img src="<?php echo esc_url(MATJAR_CORE_URL.'assets/images/product-placeholder.jpg');?>" alt="<?php esc_html($cat->name);?>"/>
												<?php } ?>
												</a>
											</div>
											<h3 class="woocommerce-loop-category__title">
												<a href="<?php echo esc_url($cate_link);?>">
													<?php echo esc_html($cat->name);
													if( $show_count ) {
														echo sprintf(
															'<span class="product-count">%1$s</span>',
															sprintf( _n( '%s Product', '%s Products', $cat->count, 'matjar-core' ), $cat->count )
														);
													}?>
												</a>
											</h3>									
										</div>
									</div>
									<?php if( $row==2 || $cat==$lastElement ){
										$row=0;
										echo '</div>';
									} $row++;
								endforeach; // end of the loop. ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>