<?php
/**
 * Matjar functions and definitions
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 * @version 1.0
 */

/*-----------------------------------------------------------------------*/
/* Define Constants.
/*-----------------------------------------------------------------------*/
define('MATJAR_DIR',		get_template_directory() );			// template directory
define('MATJAR_URI',     get_template_directory_uri() );		// template directory uri

class Matjar_Theme_Class{
	
	
	public function __construct() {
		$this->constants();
		$this->include_functions();
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ), 10 );
		add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
		
		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_style' ) );
			add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
		} else{		
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );		
			add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_scripts' ) );		
			add_action( 'wp_head', array( $this, 'google_theme_color' ), 2 );
			add_action( 'wp_head', array( $this, 'custom_head_js') );
			add_action( 'wp_footer', array( $this, 'enqueue_inline_style'), 10 );
			add_action( 'wp_footer', array( $this, 'print_css'), 15 );
			add_action( 'wp_footer', array( $this, 'custom_footer_js') );
			add_action( 'pre_get_posts', array( $this, 'search_posts_per_page' ) );		
			add_action( 'wp', array( $this, 'post_view_count'), 999 );		
			add_filter( 'excerpt_more', array( $this, 'excerpt_more') );	
			add_filter( 'the_content_more_link',  array( $this, 'read_more_tag' ) );
			add_filter( 'excerpt_length', array( $this, 'excerpt_length'), 999 );
			add_action( 'wp_footer', array( $this, 'owl_param' ) );			
			if( MATJAR_WOOCOMMERCE_ACTIVE ){
				add_filter( 'posts_search', array( $this, 'product_search_sku' ), 9 );
			}
		}
				
	}
	
	/**
	 * Define Constants
	 *
	 * @since   1.0
	 */
	public  function constants() {

		$theme = wp_get_theme('Matjar');

		// Theme version
		define( 'MATJAR_THEME_NAME', 'Matjar' );
		define( 'MATJAR_VERSION', $theme->get('Version') );
		define( 'MATJAR_FRAMEWORK', MATJAR_DIR .'/inc/' );
		define( 'MATJAR_FRAMEWORK_URI', MATJAR_URI .'/inc/' );
		define( 'MATJAR_ADMIN_DIR_URI', MATJAR_FRAMEWORK_URI .'admin/' );
		define( 'MATJAR_SCRIPTS', MATJAR_URI .'/assets/js/' );
		define( 'MATJAR_STYLES', MATJAR_URI .'/assets/css/' );
		define('MATJAR_IMAGES', MATJAR_URI . '/assets/images/');
		define('MATJAR_ADMIN_IMAGES', MATJAR_ADMIN_DIR_URI . 'assets/images/');
		
		// Check if plugins are active		
		if( !defined( 'MATJAR_WOOCOMMERCE_ACTIVE' ) ) {
			define( 'MATJAR_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		}
		if( !defined( 'MATJAR_DOKAN_ACTIVE' ) ) {
			define( 'MATJAR_DOKAN_ACTIVE', class_exists( 'WeDevs_Dokan' ) );
		}
		if( !defined( 'MATJAR_WC_VENDORS_ACTIVE' ) ) {
			define( 'MATJAR_WC_VENDORS_ACTIVE', class_exists( 'WC_Vendors' ) );
		}
		
		// Othere		
		if( !defined( 'MATJAR_PREFIX' ) ) {
			define('MATJAR_PREFIX', '_themejr_');
		}		
	}
	
	/**
	 * Load all core theme function files
	 *
	 * @since 1.0
	 */
	public function include_functions(){
		
		require_once MATJAR_FRAMEWORK.'theme-layout.php';		
		require_once MATJAR_FRAMEWORK.'font-config.php';
		require_once MATJAR_FRAMEWORK.'core-functions.php';
		require_once MATJAR_FRAMEWORK.'theme-tags.php';
		require_once MATJAR_FRAMEWORK.'theme-functions.php';		
		require_once MATJAR_FRAMEWORK.'theme-hooks.php';
		require_once MATJAR_FRAMEWORK.'dynamic-css.php';
		require_once MATJAR_FRAMEWORK.'admin/admin-function.php';	
		require_once MATJAR_FRAMEWORK.'vendor/elementor/elementor-functions.php';	

		if( MATJAR_WOOCOMMERCE_ACTIVE ) {
			require_once MATJAR_FRAMEWORK.'vendor/woocommerce/wc-core-functions.php';
			require_once MATJAR_FRAMEWORK.'vendor/woocommerce/wc-template-hooks.php';
			require_once MATJAR_FRAMEWORK.'vendor/woocommerce/wc-template-functions.php';
			require_once MATJAR_FRAMEWORK.'classes/class-swatches.php';
			require_once MATJAR_FRAMEWORK.'classes/class-woocommerce.php';
			require_once MATJAR_FRAMEWORK.'classes/class-bought-together.php';
			
			if( class_exists('WeDevs_Dokan') ){
				require_once MATJAR_FRAMEWORK.'vendor/dokan/dokan-core-functions.php';
			}
			
			if( class_exists('WCMp') ){
				require_once MATJAR_FRAMEWORK.'vendor/wcmp/wcmp-core-functions.php';
			}
			
			if( class_exists('WC_Vendors') ){
				require_once MATJAR_FRAMEWORK.'vendor/wc-vendor/wc-vendors-core-functions.php';
			}
			
			if( class_exists('WCFMmp') ){
				require_once MATJAR_FRAMEWORK.'vendor/wcfm/wcfm-core-functions.php';
			}
			
			if( function_exists( 'YITH_YWRAQ_Frontend' ) ){
				require_once MATJAR_FRAMEWORK.'vendor/yith-add-to-quote/yith-add-to-quote-core-functions.php';
			}
		}		
		
		require_once MATJAR_FRAMEWORK.'classes/class-metabox.php';
		require_once MATJAR_FRAMEWORK.'classes/class-walker-nav-menu.php';
		require_once MATJAR_FRAMEWORK.'classes/class-breadcrumb.php';
		require_once MATJAR_FRAMEWORK.'classes/class-ajax-search.php';
		require_once MATJAR_FRAMEWORK.'classes/sidebar-generator-class.php';
		require_once MATJAR_FRAMEWORK.'classes/class-cookie-notice.php';
		if ( is_admin() ) {
			require_once MATJAR_FRAMEWORK.'classes/class-tgm-plugin-activation.php';
		}
		require_once MATJAR_FRAMEWORK.'admin/theme_options.php';
		require_once MATJAR_FRAMEWORK.'admin/class-admin.php';
		require_once MATJAR_FRAMEWORK.'admin/class-dashboard.php';
		require_once MATJAR_FRAMEWORK.'admin/demo-import.php';
	}
	
	/**
	 * Theme Setup
	 *
	 * @since   1.0
	 */
	public function theme_setup() {
	
		load_theme_textdomain( 'matjar', get_template_directory() . '/languages' );	
		load_theme_textdomain( 'matjar', get_stylesheet_directory() . '/languages' );
		
		/* Theme support */
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );	
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote', 'link' ) );
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );
		add_theme_support( 'wp-block-styles' );
				
		// Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );		
		
		// Disable Widget block editor.
		if( apply_filters('matjar_disable_widgets_block_editor', true) ) {
			remove_theme_support( 'block-templates' );
			remove_theme_support( 'widgets-block-editor' );
		}
		
		// Set the default content width.
		$GLOBALS['content_width'] = 1200;
		
		register_nav_menus( array(
			'primary' 					=> esc_html__( 'Primary Menu', 'matjar' ),
			'secondary'					=> esc_html__( 'Secondary Menu', 'matjar' ),
			'categories-menu' 			=> esc_html__( 'Categories(Vertical) Menu', 'matjar' ),
			'topbar-menu' 				=> esc_html__( 'Topbar Menu', 'matjar' ),
			'mobile-menu' 				=> esc_html__( 'Mobile Menu', 'matjar' ),
			'mobile-categories-menu' 	=> esc_html__( 'Mobile Categories Menu', 'matjar' ),
			'myaccount-menu' 			=> esc_html__( 'MyAccount/Profile Menu', 'matjar' ),
		) );
	}
	
	/*-----------------------------------------------------------------------*/
	/* Register custom fonts.
	/*-----------------------------------------------------------------------*/
	public function fonts_url() {
		$fonts_url = '';	
		
		if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'matjar' ) ) {
			$font_families[] = 'Poppins:300,400,500,600,700,900';
		}

		if ( ! empty( $font_families ) ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );		
	}
	
	/**
	 * Register required plugins
	 *
	 * @since   1.0
	*/
	public function register_required_plugins(){
		$plugins = array(
			array(
				'name' 					=> 'Matjar Core',
				'slug' 					=> 'matjar-core',
				'source' 				=> MATJAR_FRAMEWORK. 'plugins/matjar-core.zip',
				'version'  				=> '1.2.1',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'Revolution Slider',
				'slug' 					=> 'revslider',
				'source'             	=> MATJAR_FRAMEWORK. 'plugins/revslider.zip',
				'version'  				=> '6.7.5',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'Elementor Website Builder',
				'slug' 					=> 'elementor',
				'required' 				=> true,
			),		
			array(
				'name' 					=> 'Woocommerce',
				'slug' 					=> 'woocommerce',
				'required' 				=> true,
			),
			array(
				'name' 					=> 'YITH WooCommerce Compare',
				'slug' 					=> 'yith-woocommerce-compare',
				'required' 				=> false,
			),
			array(
				'name' 					=> 'YITH WooCommerce Wishlist',
				'slug' 					=> 'yith-woocommerce-wishlist',
				'required' 				=> false,
			),	
			array(
				'name' 					=> 'MailChimp for WordPress',
				'slug' 					=> 'mailchimp-for-wp',
				'required' 				=> false,
			),
			array(
				'name'      			=> 'Contact Form 7',
				'slug'     			 	=> 'contact-form-7',
				'required' 			 	=> false,
			),
			array(
				'name'      			=> 'One Click  Demo Import',
				'slug'     			 	=> 'one-click-demo-import',
				'required' 			 	=> false,
			),				
		);		
		$config = array(
			'id'           => 'tgmpa',
			'menu'         => 'themejr-install-plugins',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'has_notices'  => true,
			'dismissable'  => true,
			'is_automatic' => false,			
		);
		tgmpa( $plugins, $config );
	}
	
	
	/**
	 * Registers sidebars
	 *
	 * @since   1.0
	 */
	public function register_sidebars(){

		register_sidebar( array(
			'name'          => esc_html__( 'Blog Sidebar', 'matjar' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Page Sidebar', 'matjar' ),
			'id'            => 'shop-page',
			'description'   => esc_html__( 'Add widgets here to appear in shop page sidebar.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Filter Sidebar', 'matjar' ),
			'id'            => 'shop-filters-sidebar',
			'description'   => esc_html__( 'Add widgets here to appear in your shop page.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Product Page Sidebar', 'matjar' ),
			'id'            => 'single-product',
			'description'   => esc_html__( 'Add widgets here to appear in single product page sidebar.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 1', 'matjar' ),
			'id'            => 'footer-widget-area-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 2', 'matjar' ),
			'id'            => 'footer-widget-area-2',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 3', 'matjar' ),
			'id'            => 'footer-widget-area-3',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 4', 'matjar' ),
			'id'            => 'footer-widget-area-4',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 5', 'matjar' ),
			'id'            => 'footer-widget-area-5',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'matjar' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
	
	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0
	 */
	public function admin_style( $hook ) {
		//Admin css
		global $pagenow,$typenow;
		wp_enqueue_style( 'wp-color-picker' );		
		wp_enqueue_style( 'themejr-font', MATJAR_STYLES.'themejr-font.css', array(), '1.0' );
		
		if ( strpos( $hook, 'matjar-demo-import' ) !== false ){
			wp_enqueue_style( 'magnific-popup', MATJAR_STYLES.'magnific-popup.css', array(), MATJAR_VERSION );
		}
		
		if ( 'customize.php' != $pagenow ) {
			wp_enqueue_style( 'matjar-style', MATJAR_FRAMEWORK_URI.'admin/assets/css/admin.css', array(), MATJAR_VERSION );
		}
		
		if( $typenow == 'themejr_size_chart' ){
			wp_register_style( 'matjar-edittable', MATJAR_FRAMEWORK_URI.'admin/assets/css/jquery.edittable.css', null, time() );
			wp_enqueue_style('matjar-edittable');
		}
		
	}
	
	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.0
	 */
	public function admin_scripts( $hook ) {
		global $pagenow, $typenow;
		wp_enqueue_media(); 
		wp_enqueue_script( 'wp-color-picker' );
						
		if ( strpos( $hook, 'themejr-system-status' ) !== false ){
			wp_enqueue_script( 'themejr-system-status', MATJAR_FRAMEWORK_URI.'admin/assets/js/system-status.js' );
		}
		
		if ( 'nav-menus.php' == $pagenow ) {
			wp_enqueue_style( 'themejr-font', MATJAR_STYLES.'themejr-font.css', array(), '1.0' );
			wp_enqueue_script( 'matjar-mega-menu', MATJAR_FRAMEWORK_URI.'admin/assets/js/mega-menu.js');
		}
		
		if( $typenow == 'themejr_size_chart' ){
			wp_register_script( 'matjar-edittablejs', MATJAR_FRAMEWORK_URI.'admin/assets/js/jquery.edittable.js', array('jquery'), time(), true );
			wp_enqueue_script('matjar-edittablejs');
		}
				
		wp_enqueue_script( 'matjar-admin-js', MATJAR_FRAMEWORK_URI.'admin/assets/js/admin.js' );
		wp_localize_script( 'matjar-admin-js', 'matjar_admin_params', apply_filters('matjar_admin_js_params', array(
			'ajaxurl'          		=> admin_url( 'admin-ajax.php' ),
			'nonce'            		=> wp_create_nonce( 'matjar_nonce' ),
			'loading_text'      	=> esc_html__( 'Loading...', 'matjar' ),
			'bindmessage'      		=> esc_html__( 'Are you sure you want to leave?','matjar' ),
			'menu_icon_change_text'	=> esc_html__( 'Change Custom Icon', 'matjar' ),
			'menu_icon_upload_text'	=> esc_html__( 'Upload Custom Icon', 'matjar' ),
			'menu_delete_icon_msg'	=> esc_html__( 'Are you sure,You want to remove this icon?', 'matjar' ),
		)));
	}

	/**
	 * Disable Unused Scripts
	 */
	function dequeue_scripts() {
		
		// Disable font awesome style from plugins
		if ( matjar_get_option( 'disable-fontawesome', 1 ) ) {
			wp_deregister_style( 'fontawesome' );
			wp_deregister_style( 'font-awesome' );
			wp_deregister_style( 'wplc-font-awesome' );
		}
		
		// YITH WCWL styles & scripts
		if ( defined( 'YITH_WCWL' ) && ! defined( 'YITH_WCWL_PREMIUM' ) ) {
			
			wp_dequeue_style( 'jquery-selectBox' );
			wp_dequeue_script( 'jquery-selectBox' );
			
			// checkout
			if ( function_exists( 'is_checkout' ) && is_checkout() ) {
				wp_dequeue_style( 'selectWoo' );
				wp_deregister_style( 'selectWoo' );
			}
		}
		
		if ( function_exists( 'yith_wcwl_is_wishlist_page' ) && !yith_wcwl_is_wishlist_page() ) {
			// YITH : main style was dequeued because of font-awesome
			wp_dequeue_style( 'yith-wcwl-main' );
			wp_dequeue_style( 'yith-wcwl-font-awesome' );
			wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		}
		
		// WooCommerce PrettyPhoto(deprecated), but YITH Wishlist use
		if ( class_exists( 'WooCommerce' ) && ! defined( 'YITH_WCWL_PREMIUM' ) ) {
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );			
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'prettyPhoto' );
		}

		// Disable wp block library 
		if ( matjar_get_option( 'disable-gutenberg', 0 ) ) {
			wp_deregister_style( 'wp-block-library' );
			wp_dequeue_style( 'wp-block-library' );
		}
		
		// Disable Default wc blocks styles
		if ( matjar_get_option( 'disable-wc-blocks', 0 ) ) {
			wp_dequeue_style( 'wc-blocks-style' );
			wp_deregister_style( 'wc-blocks-style' );
			wp_dequeue_style( 'wc-blocks-vendors-style' );
			wp_deregister_style( 'wc-blocks-vendors-style' );
		}
		
		// REMOVE WP EMOJI
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles');
	}

	/**
	 * Load front-end css
	 *
	 * @since 1.0
	 */
	public function enqueue_styles() {
				
		// Load our main stylesheet.
		wp_enqueue_style( 'matjar-style', MATJAR_URI.'/style.css' , array(), MATJAR_VERSION );
		
		// Load elementor css
		wp_enqueue_style( 'elementor-frontend' );

		$theme = ( is_rtl() ) ? MATJAR_STYLES .'theme-rtl' : MATJAR_STYLES .'theme';
		$woocommerce_style = ( is_rtl() ) ? MATJAR_STYLES .'woocommerce-rtl' : MATJAR_STYLES .'woocommerce' ;		
		
		if ( ! class_exists('ReduxFrameworkPlugin') ) {
			wp_enqueue_style( 'matjar-fonts', $this->fonts_url(), array(), null );
		}
		wp_enqueue_style( 'bootstrap-grid', MATJAR_STYLES.'bootstrap-grid.css', array(), '4.1.3' );
		wp_enqueue_style( 'themejr-font', MATJAR_STYLES.'themejr-font.css', array(), '1.0' );
		wp_enqueue_style( 'linearicons-free', MATJAR_STYLES.'linearicons.css', array(), '1.0.0' );
		wp_enqueue_style( 'matjar-woocommerce', $woocommerce_style.'.css' , array(), '' );
		wp_enqueue_style( 'owl-carousel', MATJAR_STYLES.'owl.carousel.min.css', array(), '2.3.4' );
		wp_enqueue_style( 'slick', MATJAR_STYLES . 'slick.css', array(), '1.9.0' );
		wp_enqueue_style( 'magnific-popup', MATJAR_STYLES.'magnific-popup.css', array(), '1.1.0' );
		wp_enqueue_style( 'animate', MATJAR_STYLES.'animate.min.css', array(), '3.7.2' );	
				
		// Theme basic stylesheet.
		wp_enqueue_style( 'matjar-base', $theme.'.css', array( 'bootstrap-grid', 'matjar-woocommerce' ), MATJAR_VERSION );
		
		//Dynamic CSS
		wp_add_inline_style( 'matjar-base', matjar_theme_style() );
		
		// load typekit fonts
		$enable_typekit_font 	= matjar_get_option( 'typekit-font', 0 );
		$typekit_id 			= matjar_get_option( 'typekit-kit-id', '' );

		if ( $enable_typekit_font && !empty($typekit_id)) {
			wp_enqueue_style( 'matjar-typekit',  matjar_get_protocol().'//use.typekit.net/' . esc_attr ( $typekit_id ) . '.css', array(), MATJAR_VERSION );
		}
		
		wp_register_style( 'matjar-custom-css', false );
	}
	
	/**
	 * Load front-end script
	 *
	 * @since 1.0
	 */
	public function enqueue_scripts() {
		
		// Load waypoints Js
		wp_enqueue_script( 'waypoints', MATJAR_SCRIPTS .'waypoints.min.js', array( 'jquery' ), '2.0.2', true );
		wp_enqueue_script( 'popper', MATJAR_SCRIPTS.'popper.min.js', array( 'jquery' ), '4.0.0', true );
		wp_enqueue_script( 'bootstrap', MATJAR_SCRIPTS.'bootstrap.min.js', array( 'jquery' ), '4.3.1', true );
		wp_enqueue_script( 'owl-carousel', MATJAR_SCRIPTS.'owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		wp_register_script( 'isinviewport', MATJAR_SCRIPTS.'isInViewport.min.js', array( 'jquery' ), '1.8.0', true );
		wp_enqueue_script( 'slick', MATJAR_SCRIPTS.'slick.min.js', array( 'jquery' ), '1.9.0', true );
		wp_register_script( 'isotope', MATJAR_SCRIPTS.'isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
		wp_register_script( 'cookie', MATJAR_SCRIPTS.'cookie.min.js', array( 'jquery' ), '', true );
		wp_register_script( 'parallax', MATJAR_SCRIPTS.'jquery.parallax.js', array( 'jquery' ), '', true );
		wp_register_script( 'threesixty', MATJAR_SCRIPTS .'threesixty.min.js', array( 'jquery' ), '2.0.5', true );
		wp_enqueue_script ( 'magnific-popup', MATJAR_SCRIPTS.'jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'nanoscroller', MATJAR_SCRIPTS.'jquery.nanoscroller.min.js', array( 'jquery' ), '0.8.7', true );
		wp_register_script( 'countdown', MATJAR_SCRIPTS.'jquery.countdown.min.js', array( 'jquery' ), '2.2.0', true );
		wp_register_script( 'counterup', MATJAR_SCRIPTS.'jquery.counterup.min.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'sticky-kit', MATJAR_SCRIPTS.'sticky-kit.min.js', array( 'jquery' ), '1.10.0', true );
		if( matjar_get_option( 'product-ajax-search', 1 ) ){
			wp_enqueue_script( 'matjar-autocomplete', MATJAR_SCRIPTS.'jquery.autocomplete.min.js', array( 'jquery' ), '', true );
		}
		if( matjar_get_option( 'lazy-load', 0 ) ){
			wp_enqueue_script( 'lazyload', MATJAR_SCRIPTS .'jquery.lazy.min.js', array( 'jquery' ), MATJAR_VERSION, true );
		}
		if( matjar_get_option( 'widget-items-hide-max-limit', 0 ) ){
			wp_enqueue_script( 'hideMaxListItem', MATJAR_SCRIPTS.'hideMaxListItem-min.js', array( 'jquery' ), '1.36', true );
		}	
		if( class_exists( 'WooCommerce' ) && matjar_get_option( 'product-quickview-button', 1 ) ){
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}
		
		if ( ! wp_script_is( 'wc-cart-fragments', 'enqueued' ) && wp_script_is( 'wc-cart-fragments', 'registered' ) ) {
			wp_enqueue_script( 'wc-cart-fragments' );
		}
	
		if( matjar_get_option( 'sticky-sidebar', 1 ) && ( 'full-width' != matjar_get_layout() ) ){
			wp_enqueue_script( 'sticky-kit' );
		}
		if ( function_exists('is_product') && is_product() && ( matjar_get_option( 'sticky-product-image', 1 ) || matjar_get_option( 'sticky-product-summary', 1 ) ) ){
			wp_enqueue_script( 'sticky-kit' );			
		}		
		
		$google_api_key = matjar_get_option( 'google-map-api', '' );
		if( ! empty( $google_api_key ) ){
			wp_enqueue_script( 'matjar-google-map-api', matjar_get_protocol().'//maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.22&key=' . $google_api_key . '', array(), '', false );
		}		
		wp_enqueue_script( 'matjar-script', MATJAR_SCRIPTS.'functions.js', array( 'jquery' ), MATJAR_VERSION, true );
		
		$is_rtl = is_rtl() ? true : false ;		
		$matjar_settings = apply_filters( 'matjar_localize_script_data', array(
			'rtl' 							=> $is_rtl,
			'ajax_url' 						=> admin_url( 'admin-ajax.php' ),
			'ajax_nonce' 					=> esc_js( wp_create_nonce( 'matjar-ajax-nonce' ) ),
			'product_ajax_search'			=> matjar_get_option( 'product-ajax-search', 1 ) ? true : false,	
			'sticky_header'					=> matjar_get_option( 'header-sticky', 0 ) ? true : false,
			'sticky_header_class'			=> matjar_get_option( 'header-sticky-part', 'main' ),
			'sticky_header_scroll_up'		=> matjar_get_option( 'header-sticky-scroll-up', 0 ) ? true : false,	
			'sticky_header_tablet'			=> matjar_get_option( 'header-sticky-tablet', 0 ) ? true : false,	
			'sticky_header_mobile'			=> matjar_get_option( 'header-sticky-mobile', 0 ) ? true : false,
			'login_register_popup'			=> matjar_get_option( 'login-register-popup', 1 ) ? true : false,
			'button_loader'					=> true,
			'header_minicart_popup'			=> matjar_get_option( 'header-minicart-popup', 'slider' ),
			'promo_bar'						=> matjar_get_option( 'promo-bar', 0 ) ? true : false,	
			'lazy_load'						=> matjar_get_option( 'lazy-load', 0 ) ? true : false,	
			'cookie_path'					=> COOKIEPATH,
			'cookie_expire'					=> 3600 * 24 * 30,			
			'show_promobar_in_next_days'	=> 1,			
			'permalink'						=> ( get_option( 'permalink_structure' ) == '' ) ? 'plain' : '',			
			'newsletter_args'				=> apply_filters( 'matjar_js_newsletter_args', array(
				'newsletter_popup'			=> matjar_get_option( 'newsletter-popup', 0 ) ? true : false,
				'popup_display_on'		=> matjar_get_option( 'newsletter-when-appear', 'page_load' ),
				'popup_delay'			=> matjar_get_option( 'newsletter-delay', 5 ),
				'popup_x_scroll'		=> matjar_get_option( 'newsletter-x-scroll', 30 ),
				'show_for_mobile'		=> matjar_get_option( 'newsletter-show-mobile', 1 ),
				'show_in_next_days'		=> 1,
				'version'				=> matjar_get_option( 'newsletter-version', 1 ),
			) ),
			'js_translate_text'				=> apply_filters( 'matjar_js_text', array(
				'days_text'					=> esc_html__( 'Days', 'matjar' ),
				'hours_text'				=> esc_html__( 'Hours', 'matjar' ),
				'mins_text'					=> esc_html__( 'Mins', 'matjar' ),
				'secs_text'					=> esc_html__( 'Secs', 'matjar' ),
				'sdays_text'				=> esc_html__( 'd', 'matjar' ),
				'shours_text'				=> esc_html__( 'h', 'matjar' ),
				'smins_text'				=> esc_html__( 'm', 'matjar' ),
				'ssecs_text'				=> esc_html__( 's', 'matjar' ),
				'show_more'					=> esc_html__( '+ Show more', 'matjar' ),
				'show_less'					=> esc_html__( '- Show less', 'matjar' ),
				'loading_txt'				=> esc_html__( 'Loading...', 'matjar' ),
				'variation_unavailable'		=> esc_html__( 'Sorry, this product is unavailable. Please choose a different combination.', 'matjar' ),
			) ),
			'cart_auto_update'				=> matjar_get_option( 'cart-auto-update', 1 ) ? true : false,
			'checkout_product_quantity'		=> matjar_get_option( 'checkout-product-quantity', 0 ) ? true : false,
			'product_image_zoom'			=> matjar_get_option( 'product-gallery-zoom', 1 ) ? true : false,
			'product_PhotoSwipe'			=> matjar_get_option( 'product-gallery-lightbox', 1 ) ? true : false,
			'product_gallery_layout'		=> function_exists('matjar_get_product_gallery_layout') ? matjar_get_product_gallery_layout() : matjar_get_option( 'product-gallery-style', 'product-gallery-left' ),
			'typeahead_options'     		=> array( 'hint' => false, 'highlight' => true ),
			'nonce'                 		=> wp_create_nonce( 'matjar_nonce' ),						
			'enable_add_to_cart_ajax' 		=> matjar_get_option('product-add-to-cart-ajax', 1 ) ? true : false,
			'mini_cart_popup' 				=> ( 'slider' == matjar_get_option( 'header-minicart-popup', 'slider' ) )  ? true : false,
			'sticky_product_image'			=> matjar_get_option( 'sticky-product-image', 1 ) ? true : false,
			'sticky_product_summary'		=> matjar_get_option( 'sticky-product-summary', 1 ) ? true : false,
			'sticky_sidebar'				=> matjar_get_option( 'sticky-sidebar', 1 ) ? ( ( matjar_is_catalog() && matjar_get_option( 'shop-page-off-canvas-sidebar', 0 ) ) ? false : true) : false,
			'widget_toggle'					=> matjar_get_option('widget-toggle', 0 ) ? true : false,
			'widget_menu_toggle'			=> matjar_get_option('widget-menu-toggle', 0 ) ? true : false,
			'widget_hide_max_limit_item' 	=> matjar_get_option('widget-items-hide-max-limit', 0 ) ? true : false,
			'number_of_show_widget_items'	=> matjar_get_option('number-of-show-widget-items', 8 ),			
			'touch_slider_mobile'			=> matjar_get_option('touch-slider-mobile', 0 ) ? true : false,
			'disable_variation_price_change'=> false,
			'maintenance_mode'				=> matjar_get_option( 'maintenance-mode' , 0 ) ? true : false,
			
		));
		
		if ( class_exists( 'WooCommerce' ) ) {
			$matjar_settings['price_format']             = get_woocommerce_price_format();
			$matjar_settings['price_decimals']           = wc_get_price_decimals();
			$matjar_settings['price_thousand_separator'] = wc_get_price_thousand_separator();
			$matjar_settings['price_decimal_separator']  = wc_get_price_decimal_separator();
			$matjar_settings['currency_symbol']          = get_woocommerce_currency_symbol();
			$matjar_settings['wc_tax_enabled']           = wc_tax_enabled();
			$matjar_settings['cart_url']                 = wc_get_cart_url();
			if ( wc_tax_enabled() ) {
				$matjar_settings['ex_tax_or_vat'] = WC()->countries->ex_tax_or_vat();
			} else {
				$matjar_settings['ex_tax_or_vat'] = '';
			}
		}
		
		//general ajax
		wp_localize_script( 'matjar-script', 'matjar_options', $matjar_settings );			
		
		wp_enqueue_script( 'html5', MATJAR_SCRIPTS .'html5.js' , array(), '3.7.3' );
		wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}	

	/**
	 * Load custom js in footer
	 * @since 1.0
	 */
	function owl_param() {
		global $matjar_owlparam;
		wp_localize_script( 'matjar-script', 'matjarOwlArg', (array) $matjar_owlparam );
	}
	
	/**
	 * Search product with sku
	 * @since 1.0
	 */
	public function product_search_sku( $where ) {
        global $pagenow, $wpdb, $wp;
 
        if ( ( is_admin() && 'edit.php' != $pagenow )
             || ! is_search()
             || ! isset( $wp->query_vars['s'] )
             || ( isset( $wp->query_vars['post_type'] ) && 'product' != $wp->query_vars['post_type'] )
             || ( isset( $wp->query_vars['post_type'] ) && is_array( $wp->query_vars['post_type'] ) && ! in_array( 'product', $wp->query_vars['post_type'] ) )
        ) {
            return $where;
        }
        $search_ids = array();
        $terms      = explode( ',', $wp->query_vars['s'] );
 
        foreach ( $terms as $term ) {
            //Include the search by id if admin area.
            if ( is_admin() && is_numeric( $term ) ) {
                $search_ids[] = $term;
            }
            // search for variations with a matching sku.
 
            $sku_to_parent_id = $wpdb->get_col( $wpdb->prepare( "SELECT p.post_parent as post_id FROM {$wpdb->posts} as p join {$wpdb->postmeta} pm on p.ID = pm.post_id and pm.meta_key='_sku' and pm.meta_value LIKE '%%%s%%' where p.post_parent <> 0 group by p.post_parent", wc_clean( $term ) ) );
 
            //Search for a simple product that matches the sku.
            $sku_to_id = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_sku' AND meta_value LIKE '%%%s%%';", wc_clean( $term ) ) );
 
            $search_ids = array_merge( $search_ids, $sku_to_id, $sku_to_parent_id );
        }
 
        $search_ids = array_filter( array_map( 'absint', $search_ids ) );
 
        if ( sizeof( $search_ids ) > 0 ) {
            $where = str_replace( ')))', ") OR ({$wpdb->posts}.ID IN (" . implode( ',', $search_ids ) . "))))", $where );
        }
 
        return $where;
    }
		
	function google_theme_color(){
		
		$google_theme_color = matjar_get_option( 'google-theme-color', 'transparent' );
		
		if( 'transparent' != $google_theme_color){ ?>	
			<meta name="theme-color" content="<?php echo esc_attr( $google_theme_color ); ?>">
		<?php
		}
	}
	
	/**
	 * Output of custom js options.
	 */
	public function custom_head_js() {
		
		$custom_js = matjar_get_option('custom-js-head','');
		
		if ( !empty( trim( $custom_js ) ) ) {
			
			echo apply_filters( 'matjar_head_custom_js', $custom_js ); // WPCS: XSS OK.
			
		}
	}

	/**
	* Javascript detection
	*/
	public function custom_footer_js(){
		
		$custom_js 	= trim( matjar_get_option('custom_js', '') );
		$output = '';
		
		if( !empty( $custom_js ) ){ 
			$output .= '<script>' ;
			$output .= $custom_js ;
			$output .= '</script>' ;
		}
		echo apply_filters( 'matjar_custom_js', $output ); // WPCS: XSS OK.
	}
	
	/**
	 * Output of dyanamic css.
	 */
	public  function print_css() {
		global $matjar_custom_css;

		if ( ! empty( trim( (string)$matjar_custom_css ) ) ) {
			// Sanitize.
			$matjar_custom_css = wp_check_invalid_utf8( $matjar_custom_css );			
			wp_add_inline_style( 'matjar-custom-css', $matjar_custom_css );
		}
	}
	
	/**
	 * Enqueue custom inline style
	 */
	public function enqueue_inline_style(){
		wp_enqueue_style( 'matjar-custom-css' );
	}
	
	/**
	 * Alter the search posts per page
	 *
	 * @since 1.0
	 */
	public  function search_posts_per_page( $query ) {
		
		if ( is_admin() || ! $query->is_main_query() ) return;
		$portfolio_per_page = matjar_get_option( 'portfolio-per-page' );
		
		if ( in_array ( $query->get('post_type'), array('portfolio') ) ) {
			$query->set( 'posts_per_page', $portfolio_per_page);
			return;
		}elseif( $query->is_main_query() && is_search() && isset( $_GET['post_type'] ) && $_GET['post_type'] == 'product' ){
			$posts_per_page = matjar_get_option( 'products-per-page', 12);
			if ( isset( $_GET[ 'per_page' ] ) ) {
				$posts_per_page = $_GET[ 'per_page' ];
			}
			$query->set( 'posts_per_page', $posts_per_page);
		}
	}
	
	/**
	 *Post View Count 
	 */
	public function post_view_count(){
		$prefix = MATJAR_PREFIX;
		if( ! is_single() || ! is_singular( 'post' ) ) return;
		$post_id = get_the_ID();
		$views = get_post_meta( $post_id, $prefix.'views_count', true );
		$views = !empty($views) ? $views : 0;
		
		update_post_meta( $post_id, $prefix.'views_count', ($views+1) );
		$views = get_post_meta( $post_id, $prefix.'views_count', true );
	}
	
	
	/**
	 * 'Continue reading' link.
	 */
	public function excerpt_more( $link ) {
		return '';
	}
	
	public function read_more_tag() {
		
		return sprintf( '<p class="read-more-btn link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink( get_the_ID() ) ),
			matjar_get_loop_prop( 'post-readmore-text' )
		);
	}

	/**
	 * Filter the except length to 30 words.
	 */
	function excerpt_length( $length ) {
		return matjar_get_option( 'blog-excerpt-length', 30 );
	}
} 
// Initialize theme
$matjar_theme_class = new Matjar_Theme_Class;