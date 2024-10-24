<?php 
/**
 * Portfolio Carousel Template
 */
?>
<div id="<?php echo esc_attr($id);?>" class="<?php echo esc_attr($class);?>">
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php } ?>

	<div class="section-content row">
		<?php
		matjar_portfolio_loop_start();	
			while ( $query->have_posts() ) :
				$query->the_post();		
				// Include the portfolio loop content template.
				get_template_part( 'template-parts/portfolio-loop/layout', get_post_format() );

			endwhile;
		matjar_portfolio_loop_end();
		matjar_reset_loop();
		?>
	</div>
</div>