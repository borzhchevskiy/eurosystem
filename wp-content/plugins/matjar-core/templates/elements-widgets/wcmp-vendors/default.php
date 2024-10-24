<?php 
/**
 * WCMP Vendors Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php } ?>
	<div class="matjar-vendors-list <?php echo esc_attr($slider_class);?>" <?php if(!empty( $owl_options ) ){ echo 'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >
		<?php 
		global $WCMp;
		$count = 0;
		foreach ( $vendors as $key => $vendor_id ) {			
			$vendor 			= get_wcmp_vendor($vendor_id);
			$store_name			= apply_filters('wcmp_vendor_lists_single_button_text', $vendor->page_title);
			$store_url			= $vendor->get_permalink();
			$vendor_hide_phone 	= apply_filters('wcmp_vendor_store_header_hide_store_phone', get_user_meta($vendor_id, '_vendor_hide_phone', true), $vendor_id);
			$mobile 			= $vendor->phone;
			$image 				= $vendor->get_image() ? $vendor->get_image('image', array(125, 125)) : $WCMp->plugin_url . 'assets/images/WP-stdavatar.png';
			$banner 			= $vendor->get_image('banner') ? $vendor->get_image('banner') : '';
			$has_bg_class 		= $vendor->get_image() ? "has-vendor-background" : '';
			
			if( $rows > 1 && $count % $rows == 0 ){
				echo '<div class="carousel-group">';
			}
			?>
			<div class="matjar-single-vendor woocommerce <?php echo esc_attr($column_class);?>">
				<div class="matjar-store-wrapper">
					<div class="matjar-store-content">
						<div class="matjar-store-content-wrapper <?php echo esc_attr($has_bg_class);?>" style="background-image: url( '<?php if($banner) echo $banner; ?>');">
							<div class="matjar-store-content-container">
								
								<div class="matjar-store-data">
									<h2><?php echo esc_html( $store_name ); ?></h2>
									<div class="matjar-store-rating">
										<?php
											$rating_info = wcmp_get_vendor_review_info($vendor->term_id);
											$WCMp->template->get_template('review/rating_vendor_lists.php', array('rating_val_array' => $rating_info));
										?>
									</div>
									<?php if ( $vendor->get_formatted_address() || !empty($mobile) ){ ?>
										<ul class="store-details">
											<?php if ( $vendor->get_formatted_address() ){ ?>
												<li class="store-address">
													<i class="fa fa-map-marker" aria-hidden="true"></i>
													<?php echo $vendor->get_formatted_address(); ?>
												</li>
											<?php } ?>
											
											<?php if ( !empty($mobile) )  { ?>
												<li class="store-phone">
													<i class="fa fa-mobile" aria-hidden="true"></i> <?php echo esc_html( $mobile ); ?>
												</li>
											<?php } ?>
										</ul>
									<?php } ?>									
								</div>
							</div>
						</div>
					</div>
					<div class="matjar-store-footer">
						<div class="vendor-avatar">
							<?php echo get_avatar( $vendor_id, 150 ); ?>						
						</div>
						<a class="button matjar-store-link" href="<?php echo esc_attr( $store_url ); ?>"><?php esc_html_e( 'Visit Store', 'matjar-core' )?></a>
					</div>
				</div>
			</div>	
		<?php 
				if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $vendors_count - 1) ){
					echo '</div>';
				}
				$count++;
			}	?>
	</div>
</div>