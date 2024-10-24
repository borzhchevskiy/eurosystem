<?php 
/**
 * Newsletter Template
 */
?>
<div class="<?php echo esc_attr($class);?>">
	<?php if( ! empty( $title ) ) { ?>
		<div class="section-heading">
			<h2><?php echo esc_html($title); ?></h2>
		</div>
	<?php }
	if( function_exists( 'mc4wp_show_form' ) ) {
		mc4wp_show_form();
	} ?>
</div>