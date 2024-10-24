<?php
/**
 * Post Loop Start
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/post-loop
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="<?php matjar_blog_wrapper_classes();?>" <?php if(!empty(matjar_get_loop_prop( 'owl_options' )) ){ echo 'data-owl_options="'.esc_attr( matjar_get_loop_prop( 'owl_options' ) ).'"';  } ?>>


