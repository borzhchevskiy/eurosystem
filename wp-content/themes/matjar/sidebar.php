<?php
/**
 * The sidebar containing the main widget area
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */


$layout = matjar_get_layout();
if( 'full-width' == $layout ){
	return;
}

$sidebar_name = matjar_get_sidebar_name();
if ( ! is_active_sidebar( $sidebar_name ) ) {
	return;
}
?>

<div id="secondary" <?php matjar_sidebar_class();?>>
	<div class="sidebar-inner">
		<?php dynamic_sidebar( $sidebar_name ); ?>
	</div>
</div><!-- #secondary -->