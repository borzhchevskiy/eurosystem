<?php
/*
Plugin Name: Matjar Core
Plugin URI: https://matjar.themejr.net/
Description: Elementor elements for Matjar Theme.
Version: 1.2.1
Author: ThemeJR
Author URI: https://templatemonster.com/store/themejr
Text Domain: matjar-core
*/

// don't load directly
if ( !defined( 'ABSPATH' ) ){
    die('-1');
}

if ( 'matjar' !== get_template() ) {
	return;
}

if( !defined( 'MATJAR_CORE_VERSION' ) ) {
    define( 'MATJAR_CORE_VERSION', '1.2.1' ); // Version of plugin
}

if( !defined( 'MATJAR_CORE_DIR' ) ) {
    define( 'MATJAR_CORE_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( !defined( 'MATJAR_CORE_URL' ) ) {
    define( 'MATJAR_CORE_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}

if( !defined( 'MATJAR_PREFIX' ) ) {
	define('MATJAR_PREFIX', '_themejr_');
}
		
// Load Custom Post types
require_once MATJAR_CORE_DIR .'/posts/posts-content.php';

// Load Custom widget
require MATJAR_CORE_DIR . '/widgets/init.php';

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// Load plugin text domain
load_plugin_textdomain( 'matjar-core', false, plugin_basename( dirname( __FILE__ ) ) . "/languages" );

if ( !class_exists ( 'ReduxFramework' ) && file_exists ( MATJAR_CORE_DIR.'/inc/admin/redux-core/framework.php' ) ) {
    require_once ( MATJAR_CORE_DIR .'/inc/admin/redux-core/framework.php' );
} 

if ( !class_exists ( 'RWMB_Loader' ) && file_exists ( MATJAR_CORE_DIR.'/inc/admin/meta-box/meta-box.php' ) ) {
    require_once ( MATJAR_CORE_DIR.'/inc/admin/meta-box/meta-box.php' );
	require_once MATJAR_CORE_DIR .'/inc/admin/custom-field-image-set.php';
} 

// Load Wordpress Importer plugin
require_once MATJAR_CORE_DIR .'/inc/admin/class-admin.php';
require_once MATJAR_CORE_DIR .'/inc/admin/class-white-label.php';

//Load functions
require_once MATJAR_CORE_DIR .'/inc/functions.php';

/**
 * Init matjar elementor elements
 */
function matjar_init_elementor() {
	// Check if Elementor installed and activated
	if ( ! did_action( 'elementor/loaded' ) ) {
		return;
	}

	// Check for required Elementor version
	if ( ! version_compare( ELEMENTOR_VERSION, '2.0.0', '>=' ) ) {
		return;
	}

	// Check for required PHP version
	if ( version_compare( PHP_VERSION, '5.4', '<' ) ) {
		return;
	}

	// Once we get here, We have passed all validation checks so we can safely include our plugin
	include_once( MATJAR_CORE_DIR . '/inc/elementor/elementor-functions.php' );
	include_once( MATJAR_CORE_DIR . '/inc/elementor/class-elementor.php' );
}
add_action( 'plugins_loaded', 'matjar_init_elementor' );