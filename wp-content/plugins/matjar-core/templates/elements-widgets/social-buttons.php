<?php 
/**
 * Social Button Template
 */
?>
<div class="<?php echo esc_attr($class);?>">
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php }
	
	matjar_social_share( array( 'type'=>$social_type,'style' =>$social_style,'shape'=> $social_shape,'size' => $social_icon_size ) );
	?>
</div>