<?php 
/**
 * Banner With Products Template
 */
 
if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif; ?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr($class);?>">
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
					<?php 
					$count = 0;
					woocommerce_product_loop_start();		
						while ( $query->have_posts() ) :			
							$query->the_post();							
							if( $rows > 1 && $count % $rows == 0 ){
								echo '<div class="carousel-group">';
							}
							wc_get_template_part( 'content', 'product' );
							if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $query->post_count - 1) ){
								echo '</div>';
							}
							$count++;
						endwhile;
						wp_reset_postdata();
						
					woocommerce_product_loop_end();
					matjar_reset_loop();
					?>
				</div>
			</div>
		</div>
	</div>
</div>