<?php 
/**
 * The template for products with banner
 */
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
			<?php if( $show_view_more_button ){ ?>
				<div class="view-all-btn">
					<a <?php echo implode(' ',$view_all_btn );?> ><?php echo esc_html( $view_more_button_text );?></a>
				</div>
			<?php } ?>
		</div>
	<?php }?>
	<div class="products-banner-content row <?php echo esc_attr( $banner_layout );?>">		
		<div class="banner-image col-xl-3 d-none d-xl-flex">
			<?php if ( isset( $banner_image['id'] ) && $banner_image['id'] ) { ?>		
				<a href="<?php echo esc_attr($banner_link);?>">
				<?php echo matjar_get_image_html($banner_image['id'],'full'); ?>
				</a>	
			<?php }elseif( isset( $banner_image['url'] ) ){ ?>
				<a href="<?php echo esc_attr($banner_link);?>">
				<?php echo matjar_get_src_image_loaded( $banner_image['url'] ); ?>
				</a>
			<?php } ?>
		</div>			
		<div  class="col-12 col-xl-9">	
			<?php
			$count = 0;
			woocommerce_product_loop_start();
				while ( $query->have_posts() ) {			
					$query->the_post();
					if( $rows > 1 && $count % $rows == 0 ){
						echo '<div class="carousel-group">';
					}
					wc_get_template_part( 'content', 'product' );
					if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $query->post_count - 1) ){
						echo '</div>';
					}
					$count++;
				}
				wp_reset_postdata();				
			woocommerce_product_loop_end();
			matjar_reset_loop();
			?>
		</div>
	</div>
</div>