<?php 
/**
 * Load Elementor Elements
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Elementor\Controls_Manager;
class Matjar_Elementor {
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );
		add_action('elementor/widgets/register', [ $this, 'extend_element' ] );
		add_action( 'elementor/widgets/register', [ $this, 'include_widgets' ] );		
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'elementor_enqueue_style' ]  );
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'elementor_custom_font' ] );
		add_filter( 'elementor/fonts/groups', [ $this, 'elementor_custom_font_groups' ] );
		add_filter( 'elementor/fonts/additional_fonts', [ $this, 'elementor_custom_additional_fonts' ] );
		
		add_action( 'init', [ $this, 'add_elementor_support' ] );
		add_shortcode( 'matjar_block_html', [ $this, 'matjar_block_html' ] );
		add_action('redux/options/matjar_options/saved', [ $this, 'elementor_global_settings' ] );
	}
	
	public function add_category( $elements_manager ) {		
		
		$theme_name = apply_filters( 'matjar_theme_name','Matjar' );
		$new_categories['matjar-elements'] = [
			'title' => $theme_name.' '.esc_html__( 'Elements', 'matjar-core' ),
			'icon' => 'fab fa-plug',
		];
		
		$exists_categories	= $elements_manager->get_categories();		
		$split_arr			= array_splice( $exists_categories, 2 );
        $all_categories		= array_merge( $exists_categories, $new_categories, $split_arr);
		
		$rearrange_categories = function ( $categories ) {
			$this->categories = $categories;
		};
		$rearrange_categories->call( $elements_manager, $all_categories );
    }
	
	function register_controls( $controls_manager ){
		require_once MATJAR_CORE_DIR .'/inc/elementor/controls/autocomplete.php';
		$controls_manager->register( new Matjar_Autocomplete_Control() );
	}
	
	/**
     * Extend defualt elementor element
     */
    public function extend_element() {
		require_once MATJAR_CORE_DIR .'/inc/elementor/extend-element/accordion.php';
	}
	
	/**
     * @param $widgets_manager Elementor\Widgets_Manager
     */
    public function include_widgets($widgets_manager) {		
        $this->include_base_class($widgets_manager);
        $this->include_general_widgets($widgets_manager);
	}
	
	/*Editor style*/
	function elementor_enqueue_style(){
		wp_enqueue_style( 'themejr-font', MATJAR_STYLES.'themejr-font.css', array(), '1.0' );
		wp_enqueue_style( 'linearicons-free', MATJAR_STYLES.'linearicons.css', array(), '1.0.0' );
		wp_enqueue_style( 'matjar-elementor-style',  MATJAR_CORE_URL . 'inc/elementor/assets/css/matjar-elementor.css', array( 'elementor-editor' ),'1.0.0' );
	}
		
	function elementor_custom_font( $settings ){
		
		// matjar font
		$settings['matjar-icons'] = [
			'name'          => 'matjar-icons',
			'label'         => esc_html__( 'Matjar Icons', 'matjar-core' ),
			'url' 			=> '',
			'enqueue' 		=> '',
			'prefix' 		=> 'jricon-',
			'displayPrefix' => 'jricon',
			'labelIcon' 	=> 'jricon-user',
			'ver' 			=> '1.0',
			'fetchJson' 	=> MATJAR_CORE_URL.'inc/elementor/assets/js/icons/themejr-font.js',
			'native' 		=> true,
		];
		
		/*  linearicons font */
		$settings['linearicons-icons'] = [
			'name'          => 'linearicons-icons',
			'label'         => esc_html__( 'Linearicons', 'matjar-core' ),
			'url' 			=> '',
			'enqueue' 		=> '',
			'prefix' 		=> 'lnr-',
			'displayPrefix' => 'lnr',
			'labelIcon' 	=> 'lnr lnr-home',
			'ver' 			=> '1.0',
			'fetchJson' 	=> MATJAR_CORE_URL.'inc/elementor/assets/js/icons/linearicon-font.js',
			'native' 		=> true,
		];
		
		return $settings;		
	}
	
	function elementor_custom_font_groups( $font_groups){		
		if(function_exists( 'matjar_add_custom_fonts' ) ){
			$custom_font = matjar_add_custom_fonts();
			if( !empty( $custom_font ) ){
				$new_font_groups = array( 'matjar_custom_font' => esc_html__( 'Theme fonts', 'matjar-core' ) );
				$font_groups = array_merge($new_font_groups,$font_groups);
			}
		}
		return $font_groups;		
	}
	
	function elementor_custom_additional_fonts( $additional_fonts){
		if(function_exists( 'matjar_add_custom_fonts' ) ){
			$custom_font = matjar_add_custom_fonts();
			if( !empty( $custom_font ) ){
				foreach( $custom_font['Custom-Fonts'] as $font ){
					$additional_font[$font] = 'matjar_custom_font';
				}
				$additional_fonts = array_merge($additional_font,$additional_fonts);
			}
		}
		return $additional_fonts;		
	}
	
	/**
     * Widgets Abstract Theme
     */
    public function include_base_class($widgets_manager) {
        require_once MATJAR_CORE_DIR .'/inc/elementor/base.php';
    }
	
	/**
     * Widgets Abstract Theme
     */
    public function include_general_widgets($widgets_manager) {    
		$woocommerce_widgets = [];
		if ( class_exists( 'WooCommerce' ) ) {
			$woocommerce_widgets = array(
				'woo-products-grid-carousel',
				'woo-products-with-banner',
				'woo-products-tabs',
				'woo-products-category-tabs',
				'woo-products-and-categories-box',
				'woo-products-with-banner',
				'woo-products-widget',
				'woo-hot-deal-products',
				'woo-products-recently-viewed',
				'woo-product-categories',
				'woo-product-categories-thumbnails',
				'woo-product-custom-categories',
				'woo-product-brands',
			);
			if( class_exists('WeDevs_Dokan') ){
				array_push( $woocommerce_widgets,'woo-dokan-vendors' );				
			}
			if( class_exists('WCMp') ){
				array_push( $woocommerce_widgets,'woo-wcmp-vendors' );				
			}
			if( class_exists('WCVendors_Pro') ){
				array_push( $woocommerce_widgets,'woo-wcmp-vendors' );				
			}
			if( class_exists('WCFMmp') ){
				array_push( $woocommerce_widgets,'woo-wcfm-vendors' );				
			}
		}
		
		$theme_widgets = array(
			'blog',
			'blog-carousel',
			'portfolio',
			'portfolio-carousel',
			'banner',
			'banner-carousel',
			'heading',
			'button',			
			'info-box',
			'counter',
			'countdown',
			'testimonials',
			'team',
			'progress-bar',
			'menu-block',
			'vertical-menu',
			'social-buttons',
			'instagram',
			'newsletter',
		);
		if( class_exists('WPCF7') ){
			array_push( $theme_widgets,'contact-us' );				
		}
		
		$widgets = array_merge( $woocommerce_widgets, $theme_widgets );
		foreach( $widgets as $widget){
			 require_once MATJAR_CORE_DIR .'/inc/elementor/widgets/'.$widget.'.php';
		}
    }
	
	public function add_elementor_support() {
		//if exists, assign to $cpt_support var
		$cpt_support = get_option( 'elementor_cpt_support' );
		
		if ( ! $cpt_support ) {
			$cpt_support = [ 'page', 'post', 'product', 'portfolio', 'block'];
			update_option( 'elementor_cpt_support', $cpt_support );
		} else  {
			$new_support = [ 'page', 'post', 'product', 'portfolio', 'block' ];
			$cpt_support = array_unique (array_merge ($cpt_support, $new_support));
			update_option( 'elementor_cpt_support', $cpt_support );
		}
	}
	
	/*
		Matjar html block shortcode matjar_block_html
	*/
	public function matjar_block_html( $atts ){
		$args = ( shortcode_atts( array(
			'id' 	=> '',
		), $atts ) );
		extract( $args );
		
		if( empty( $id ) ){ return;}
		
		$post 		= get_post( $id );
		$content 	= '';		
		if ( ! $post || $post->post_type != 'block' ) { return; }
		if( function_exists( 'matjar_block_get_content' )){
			$content = matjar_block_get_content($id);
		}		
		return $content;
	}
	
	public function get_font_family_weight( $font_type, $default = array() ){
		$font = matjar_get_option( $font_type, $default );
		$return_data = [ 
			'font_family' => $font['font-family'],
			'font_weight' => $font['font-weight']
		];
		return $return_data;
	}
	
	/*
		Update Global elementor settings
	*/
	public function elementor_global_settings(){
		
		$active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();	
		if ( $active_kit_id ) {
			$elementor_site_settings = get_post_meta( $active_kit_id, '_elementor_page_settings', true );
			if ( empty( $elementor_site_settings ) ) {
				$elementor_site_settings = array();
			}
			$update_settings = [];
			if(isset( $elementor_site_settings['system_colors'] )){
				$link_color = matjar_get_option( 'body-link-color', [ 'regular' => '#212121',
			'hover' => '#1558E5' ] );
				$system_colors = $elementor_site_settings['system_colors'];
				$system_colors[0]['color'] = matjar_get_option( 'primary-color', '#1558E5' );
				$system_colors[1]['color'] = matjar_get_option( 'secondary-color', '#9e7856' );
				$system_colors[2]['color'] = matjar_get_option( 'body-text-color', '#656565' );
				$system_colors[3]['color'] = $link_color['regular'];
				$system_colors[3]['title'] = esc_html__('Link', 'matjar-core');
				$update_settings['system_colors'] = $system_colors;
			}
			if(isset( $elementor_site_settings['system_typography'] )){
				$body_font = $this->get_font_family_weight('body-font',[
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px',
					'letter-spacing'	=> '',
				]);
				$secondary_font = $this->get_font_family_weight('secondary-font',[
					'color'       		=> '#333333',
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Satisfy', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
				]);
				$heading_font = $this->get_font_family_weight('h1-headings-font',[
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '28px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				]);
				$system_typography = $elementor_site_settings['system_typography'];	
				$system_typography[0]['typography_font_family'] = $body_font['font_family'];
				$system_typography[0]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[1]['typography_font_family'] = $secondary_font['font_family'];
				$system_typography[1]['typography_font_weight'] = $secondary_font['font_weight'];
				$system_typography[2]['typography_font_family'] = $body_font['font_family'];
				$system_typography[2]['typography_font_weight'] = $body_font['font_weight'];
				$system_typography[3]['typography_font_family'] = $body_font['font_family'];
				$system_typography[3]['typography_font_weight'] = $body_font['font_weight'];
				$update_settings['system_typography'] = $system_typography;
			}
			
			$update_settings['container_width'] = ['unit' => 'px', 'size' => matjar_get_option( 'theme-container-width', '1200' ) ];
			
			$elementor_site_settings = array_merge($elementor_site_settings, $update_settings);			
			update_post_meta( $active_kit_id, '_elementor_page_settings', $elementor_site_settings );
			Elementor\Plugin::$instance->files_manager->clear_cache();			
		}		
	}
	
}
new Matjar_Elementor();