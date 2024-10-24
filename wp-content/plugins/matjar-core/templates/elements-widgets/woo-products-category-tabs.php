<?php 
/***
* Products Tabs Template
**/

if( empty( $tabs ) )  return; ?>

<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">
	<div class="section-heading">
		
		<?php if( ! empty( $title ) && $tabs_style == 'tabs-with-title' ) { ?>
					<h2><?php echo esc_attr( $title );?></h2>
			<?php } ?>
		<div class="nav-tabs-wrapper">
			
			<ul class="nav nav-tabs" role="tablist">
				<?php $i = 1;
				foreach($tabs as $tab_data){ 
					
					$class 		= ($i == 1) ? 'nav-link active' : 'nav-link';
					$expanded 	= ($i == 1) ? 'true' : 'false'; ?>
					<li class="nav-item" <?php if( $enable_ajax ){ ?> data-attribute="<?php echo esc_attr($tab_data['data']); ?>" <?php } ?>>
						<a id="nav-<?php echo esc_html($tab_data['id']);?>" class="<?php echo esc_attr($class);?>" href="#<?php echo esc_html($tab_data['id']);?>" data-href="<?php echo esc_html($tab_data['id']);?>" data-toggle="tab" role="tab"><?php echo esc_html($tab_data['title']);?></a>
					</li>
					<?php 
					$i++;
				}?>
			</ul>
		</div>
	</div>
	<div class="tab-content woocommerce">
	
		<?php $i = 1;
		//$number_of_row = 2;
		
		foreach( $tabs as $tab_data ){
			matjar_set_loop_prop( 'products_view', 'grid-view' );
			if( $layout == 'grid' ){
				matjar_set_loop_prop( 'products-columns', $grid_columns );
				matjar_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
				matjar_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
				wc_set_loop_prop( 'columns', $grid_columns );
				$rows = 1;
			}else{
				matjar_set_loop_prop( 'name','matjar-carousel' );
				matjar_set_loop_prop( 'products_view','grid-view' );			
				matjar_set_loop_prop( 'products-columns', $slider_columns );
				matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
				matjar_set_loop_prop( 'rs_large', $slider_columns );
				matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
				matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
				matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
				$unique_id 	= matjar_uniqid( 'section-' );
				matjar_set_loop_prop( 'unique_id', $unique_id );
				matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
			}
			
			$class = ($i == 1) ? 'tab-pane fade show active' : 'tab-pane fade'; ?>
			
			<div id="<?php echo esc_attr($tab_data['id']);?>" class="<?php echo esc_attr($class);?>">				
				<?php
				woocommerce_product_loop_start();
					$count = 0;
					while ( $tab_data['query']->have_posts() ) {
						$tab_data['query']->the_post();				
						if( $rows > 1 && $count % $rows == 0 ){
							echo '<div class="carousel-group">';
						}
						wc_get_template_part( 'content', 'product' );
						if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $tab_data['query']->post_count - 1) ){
							echo '</div>';
						}
						$count++;
					}
					wp_reset_postdata();					
				woocommerce_product_loop_end();	
				matjar_reset_loop();
				?>				
			</div>
			<?php 
			if( $enable_ajax ){ 
				break;
			}
			$i++; 
		} ?>
	</div>
</div>