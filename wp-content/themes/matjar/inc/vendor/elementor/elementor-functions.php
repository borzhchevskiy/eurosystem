<?php
/**
 * Elementor Register Location
*/
function matjar_register_elementor_locations( $elementor_theme_manager ) {
    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
	//$elementor_theme_manager->register_location( 'archive' );
}
add_action( 'elementor/theme/register_locations', 'matjar_register_elementor_locations' );