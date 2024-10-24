<?php 
/**
 * Products Widget Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr( $class );?>">	
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php } ?>
	<ul class="product_list_widget<?php echo esc_attr($widget_css); ?>" <?php if(!empty( $owl_options )){ echo  'data-owl_options="'.esc_attr( $owl_options ).'"';  } ?> >
		
		<?php $row = 1;
		while ( $query->have_posts() ) {
			
			$query->the_post();
			if( ( 'slider' == $layout ) && 1 == $row ) { 
				echo '<ul>'; 
			}
			
			wc_get_template( 'content-widget-product.php', $template_args );
			
			if( ( 'slider' == $layout ) && ( $row == $rows || $query->current_post+1 == $query->post_count ) ){ 
				$row=0; 
				echo '</ul>'; 
			} 
			$row++;
		}
		wp_reset_postdata();
		matjar_reset_loop();		?>
		
	</ul>
</div>