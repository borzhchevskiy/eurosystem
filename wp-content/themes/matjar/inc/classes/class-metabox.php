<?php  
if ( ! defined('MATJAR_DIR')) exit('No direct script access allowed');
/**
 * Matjar Metabox
 * @author 		ThemeJR
 * @package 	matjar/inc
 * @version     1.0
 */
 
if ( ! class_exists( 'Matjar_Metabox' ) ) :

	/**
	 * Matjar_Metabox
	 *
	 * @since 1.0
	 */
	class Matjar_Metabox {
		
		/**
		 * Instance
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;
		
		private $prefix = MATJAR_PREFIX;
		
		public $post_types;
		
		/**
		 * Initiator
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->post_types = array('post','page','portfolio','product');
			add_action('admin_init',array($this,'register_metaboxes'));
			add_action('admin_enqueue_scripts',array($this,'admin_js_var'));
		}
		
		
		public function meta_boxes(){
			$prefix 	= MATJAR_PREFIX;
			$meta_box 	= array();
			$size_guide = array();
			
			/* Post Format Meta */
			$meta_boxes[] = array(
				'title' 		=> esc_html__('Post Format', 'matjar'),
				'id' 			=> $prefix .'meta_box_post_format',
				'post_types' 	=> array('post'),
				'tab'   		=> true,
				'fields' 		=> array(
					array(
						'name' 				=> esc_html__('Image', 'matjar'),
						'label_description' => esc_html__( 'Select images image for post', 'matjar' ),
						'id' 				=> $prefix . 'post_format_image',
						'type' 				=> 'image_advanced',
						'max_file_uploads' 	=> 1,
					),
					array(
						'name' 				=> esc_html__('Gallery', 'matjar'),
						'label_description' => esc_html__( 'Select images gallery for post', 'matjar' ),
						'id' 				=> $prefix . 'post_format_gallery',
						'type' 				=> 'image_advanced',
					),
					array(
						'name' 				=> esc_html__( 'Video URL or Embeded Code', 'matjar' ),
						'label_description' => esc_html__( 'Enter the URL or embed code of Vimeo.com or YouTube.com streaming services.<br>To get the code, go to the external video page, click "share" button and copy the Embed code.This setting is used for your video post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_video',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Audio URL or Embeded Code', 'matjar' ),
						'label_description' => esc_html__( 'Enter the URL or Embeded code of the audio.This setting is used for your audio post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_audio',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Quote', 'matjar' ),
						'label_description' => esc_html__( 'Enter your quote.This setting is used for your quote post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_quote',
						'type' 				=> 'textarea',
					),
					array(
						'name' 				=> esc_html__( 'Author', 'matjar' ),
						'label_description' => esc_html__( 'Enter quote author.This setting is used for your quote post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_quote_author',
						'type' 				=> 'text',
					),
					array(
						'name' 				=> esc_html__( 'Author URL', 'matjar' ),
						'label_description' => esc_html__( 'Enter quote author url.This setting is used for your quote post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_quote_author_url',
						'type' 				=> 'url',
					),
					array(
						'name' 				=> esc_html__( 'Link', 'matjar' ),
						'label_description' => esc_html__( 'Enter your external url.This setting is used for your link post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_link_url',
						'type' 				=> 'url',
					),					
					array(
						'name' 				=> esc_html__( 'Text', 'matjar' ),
						'label_description' => esc_html__( 'Enter link text for link.This setting is used for your link post formats.', 'matjar' ),
						'id'   				=> $prefix . 'post_format_link_text',
						'type' 				=> 'text',
					),
				),
			);

			/* Portfolio Metabox */
			$meta_boxes[]	= array(
				'title'			=> esc_html__('Portfolio Informations', 'matjar'),
				'id'			=> $prefix .'portfolio_informations',
				'post_types'	=> array('portfolio'),
				'tab'			=> true,
				'priority'		=> 'default',
				'priority'		=> 'high',
				'fields'		=> array(
					array(
						'name'  			=> esc_html__( 'Portfolio Layout', 'matjar' ),
						'label_description' => esc_html__( 'Select portfolio layout', 'matjar' ),
						'id'    			=> $prefix."portfolio_style",
						'type'  			=> 'image_set',
						'allowClear' 		=> false,
						'options' 			=> array(
							'default'	=> MATJAR_ADMIN_IMAGES . 'layout/default.png',
							'4'	  		=> MATJAR_ADMIN_IMAGES . 'layout/portfolio/4_8-layout.png',
							'6'	  		=> MATJAR_ADMIN_IMAGES . 'layout/portfolio/6_6-layout.png',
							'8'	  		=> MATJAR_ADMIN_IMAGES . 'layout/portfolio/8_4-layout.png',
							'12'		=> MATJAR_ADMIN_IMAGES . 'layout/portfolio/12_12-layout.png',
						),
						'std'				=> 'default',
						'multiple' 			=> false,							
					),
					array(
						'name'  			=> esc_html__( 'Client Name', 'matjar' ),
						'label_description' => esc_html__( 'Enter client name.', 'matjar' ),
						'id'    			=> $prefix.'client_name',
						'type'  			=> 'text',
					),
					array(
						'name'  			=> esc_html__( 'Website', 'matjar' ),
						'label_description' => esc_html__( 'Website link.', 'matjar' ),
						'id'    			=> $prefix.'website_link',
						'type'  			=> 'text',
					),
					array(
						'id'               	=> $prefix.'gallery_images',
						'name'             	=> esc_html__( 'Portfolio Images Upload', 'matjar' ),
						'label_description'	=> esc_html__( 'Upload portfolio images.', 'matjar' ),
						'type'             	=> 'image_advanced',
						'force_delete'     	=> false,
					),
					array(
						'name'  			=> esc_html__( 'Thumbnail/Gallery', 'matjar' ),
						'label_description' => esc_html__( 'Show gallery Or thumbnail.', 'matjar' ),
						'id'    			=> $prefix.'show_portfolio_gallery',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'gallery'	=> esc_html__( 'Gallery', 'matjar' ),
							'thumbnail'	=> esc_html__( 'Thumbnail', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',							
					),
					array(
						'name'  			=> esc_html__( 'Gallery Style', 'matjar' ),
						'label_description' => esc_html__( 'Select portfolio gallery style.', 'matjar' ),
						'id'    			=> $prefix.'portfolio_gallery_style',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'		=> esc_html__( 'Default', 'matjar' ),
							'slider'     	=> esc_html__( 'Slider', 'matjar' ),
							'grid'     		=> esc_html__( 'Grid', 'matjar' ),
							'one-column'    => esc_html__( 'One Column', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',							
					),
				),
			);
			
			/* Product meta */
			$size_guide = matjar_get_posts_by_post_type('themejr_size_chart',esc_html__('Select Size Chart','matjar'));
			
			$meta_boxes[] = array(
				'id' 			=> $prefix . 'product_setting_meta_box',
				'title' 		=> esc_html__('Product Setting', 'matjar'),
				'post_types' 	=> array('product'),
				'tab' 			=> true,
				'fields' 		=> array(
					array(
						'name'  			=> esc_html__( 'Product Page Layout', 'matjar' ),
						'label_description'	=> esc_html__( 'Select product page  layout.', 'matjar' ),
						'id'    			=> $prefix.'single_product_layout',
						'type'  			=> 'image_set',
						'allowClear' 		=> true,
						'options' 			=> array(
							'product-gallery-left'	  		=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
							'product-gallery-bottom'		=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
							'product-gallery-horizontal'	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-horizontal.png',
							'product-gallery-center'		=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-center.png',
							'product-gallery-grid'			=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-grid.png',
							'product-sticky-info'			=> MATJAR_ADMIN_IMAGES . 'product-page/product-sticky-info.png',
						),
						'std'				=> '',
						'multiple' 			=> false,
						'required' 			=> true,
					),
					array(
						'name' 				=> esc_html__( 'Product Video url', 'matjar' ),
						'id'   				=> $prefix . 'product_video',
						'label_description'	=> esc_html__( 'Youtube, Vimeo embaded link', 'matjar' ),
						'type' 				=> 'text',
					),
					array(
						'name' 				=> esc_html__( 'Product Size Guide', 'matjar' ),
						'label_description'	=> esc_html__( 'Select product size guide.', 'matjar' ),
						'id'   				=> $prefix . 'size_guide',
						'type' 				=> 'select',
						'options'			=> $size_guide,
						'max_file_uploads' 	=> 1,
					),
					array(
						'name'             	=> esc_html__( 'Product 360 Degree Images', 'matjar' ),
						'label_description'	=> esc_html__( 'Upload 360 degree images.', 'matjar' ),
						'id'               	=> $prefix . 'product_360_degree_images',
						'type'             	=> 'image_advanced',
						'force_delete'     	=> false,
					),
					array(
						'name'  			=> esc_html__( 'Bought Together Location', 'matjar' ),
						'label_description'	=> esc_html__( 'Select Bought Together Location.', 'matjar' ),
						'id'    			=> $prefix . 'product_bought_together_location',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'			=> esc_html__('Default','matjar'),
							'summary-bottom' 	=> esc_html__('Summary Bottom','matjar'),
							'after-summary'  	=> esc_html__('After Summary','matjar'),
							'in-tab'  			=> esc_html__('In Tab','matjar'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),						
					array(
						'name'  			=> esc_html__( 'Product Tabs Style', 'matjar' ),
						'label_description' => esc_html__( 'Select Product Tabs Style.', 'matjar' ),
						'id'    			=> $prefix . 'single_product_tabs_style',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'		=> esc_html__('Default','matjar'),
							'tabs' 			=> esc_html__('Tabs','matjar'),
							'accordion'  	=> esc_html__('Accordion','matjar'),
							'toggle'  		=> esc_html__('Toggle','matjar'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Product Tabs Location', 'matjar' ),
						'label_description' => esc_html__( 'Select Product Tabs Location.', 'matjar' ),
						'id'    			=> $prefix . 'single_product_tabs_location',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'			=> esc_html__('Default','matjar'),
							'after-summary' 	=> esc_html__('After Summary','matjar'),
							'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'matjar' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
				)
			);
			
			$meta_boxes[] = array(
				'id' 			=> $prefix . 'product_custom_tab_meta',
				'title' 		=> esc_html__('Product Custom Tab', 'matjar'),
				'post_types' 	=> array('product'),
				'fields' 		=> array(
					array(
						'name'  			=> esc_html__( 'Enable Custom Tab.', 'matjar' ),
						'label_description'	=> esc_html__( 'Check this for enable custom tab.', 'matjar' ),
						'id'    			=> $prefix . 'enable_custom_tab',
						'type'  			=> 'checkbox',
						'std'				=> 0,
					),
					array (
						'name' 				=> esc_html__('Custom Tab Title', 'matjar'),
						'label_description' => esc_html__( 'Enter tab title.', 'matjar' ),
						'id' 				=> $prefix . 'product_custom_tab_heading',
						'type' 				=> 'text',
						'std' 				=> '',
						'required-field' 	=> array( $prefix . 'enable_custom_tab', '=', array( '1' ) ),
					),
					array(
						'name'  			=> esc_html__( 'Custom Tab Content.', 'matjar' ),
						'label_description' => esc_html__( 'Enter tab content.', 'matjar' ),
						'id'    			=> $prefix . 'product_custom_tab_content',
						'type'  			=> 'wysiwyg',
						'raw'     			=> false,
						'options' 			=> array(
							'textarea_rows' 	=> 4,
							'teeny'         	=> true,
						),
						'required-field' 	=> array( $prefix . 'enable_custom_tab', '=', array( '1' ) ),
					), 
				)
			);

			/* Page  Options */
			$meta_boxes[] = array(
				'title' 		=> 	esc_html__('Page Layout', 'matjar'),
				'id' 			=> $prefix.'layout_options',
				'post_types' 	=> $this->post_types,
				'tab' 			=> 	true,
				'fields' 		=> 	array(
					array(
						'name'  		=> esc_html__( 'Page Sidebar', 'matjar' ),
						'id'    		=> $prefix.'page_layout',
						'type'  		=> 'image_set',
						'allowClear' 	=> true,
						'options' 		=> array(
							'full-width'	  => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
							'left-sidebar'	  => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
							'right-sidebar'	  => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
						),
						'std'			=> '',
						'multiple' 		=> false,
						'required' 		=> true,
					),
					array (
						'name' 				=> esc_html__('Sidebar Widget', 'matjar'),
						'id' 				=> $prefix.'sidebar_widget',
						'type' 				=> 'sidebar',
						'field_type'  		=> 'select_advanced',
						'placeholder' 		=> esc_attr__('Select Sidebar','matjar'),
						'std' 				=> '',	
						'required-field' 	=> array($prefix . 'page_layout', '=', array( 'left-sidebar', 'right-sidebar' ) ),
						'label_description'	=> esc_html__('Select sidebar. If empty then it take value from theme options.','matjar'),																
					),										
				),
			);
			/* End Page Options */

			/* Header Options */
			$meta_boxes[] = array(
				'title' 		=> esc_html__('Header', 'matjar'),
				'id' 			=> $prefix .'header_options',
				'post_types' 	=> array('post','page','portfolio','product'),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Header Top', 'matjar' ),
						'label_description'	=> esc_html__( 'Enable or disable the top bar.', 'matjar' ),
						'id'    			=> $prefix . 'header_top',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Header', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable the header.', 'matjar' ),
						'id'    			=> $prefix . 'header',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Select Header Style', 'matjar' ),
						'label_description' => esc_html__( 'Select header style.', 'matjar' ),
						'id'    			=> $prefix.'header_style',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'		=> esc_html__( 'Default', 'matjar' ),
							'1'      		=> esc_html__( 'Header 1', 'matjar' ),
							'2'   			=> esc_html__( 'Header 2', 'matjar' ),
							'3' 			=> esc_html__( 'Header 3', 'matjar' ),
							'4'				=> esc_html__( 'Header 4', 'matjar' ),
							'5'				=> esc_html__( 'Header 5', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Header Transparent', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable the header transparent/overlay.', 'matjar' ),
						'id'    			=> $prefix . 'header_transparent',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
					array(
						'name'  			=> esc_html__( 'Header Transparent Color', 'matjar' ),
						'label_description' => esc_html__( 'Select header color schema.', 'matjar' ),
						'id'    			=> $prefix . 'header_transparent_color',
						'type'  			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'light'    	=> esc_html__( 'Light', 'matjar' ),
							'dark' 		=> esc_html__( 'Dark', 'matjar' ),
						),
						'std'			=> 'default',
						'multiple' 		=> false,
					),
				),
			);
			/* End Header Options */

			/* Title Options */
			$meta_boxes[] = array(
				'title' 		=> esc_html__('Page Title', 'matjar'),
				'id' 			=> $prefix.'page_title_options',
				'post_types' 	=> array('post','page','portfolio'),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Page Title', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable the page title.', 'matjar' ),
						'id'    			=> $prefix.'page_title_section',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable'	=> esc_html__('Enable','matjar'),
							'disable'	=> esc_html__('Disable','matjar'),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Heading', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable the heading.', 'matjar' ),
						'id'    			=> $prefix.'page_heading',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name' 				=> esc_html__( 'Custom Header Title', 'matjar' ),
						'label_description'	=> esc_html__( 'Alter the main title display.', 'matjar' ),
						'desc' 				=> '',
						'id' 				=> $prefix . 'custom_page_title',
						'type' 				=> 'text',
					),
					array(
						'name'  			=> esc_html__( 'Title Style', 'matjar' ),
						'label_description' => esc_html__( 'Select a page title style.', 'matjar' ),
						'id'    			=> $prefix.'page_title_style',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'left' 		=> esc_html__('Left','matjar'),
							'center'	=> esc_html__('Centered','matjar'),							
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Header Font Size', 'matjar' ),
						'label_description' => esc_html__( 'Select page title font size.', 'matjar' ),
						'id'    			=> $prefix.'title_font_size',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'small'    	=> esc_html__( 'Small', 'matjar' ),
							'large'		=> esc_html__( 'Large', 'matjar' ),						
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std'			=> 'default',
					),
					array(
						'name' 				=> esc_html__( 'Padding Top', 'matjar' ),
						'desc' 				=> '',
						'id' 				=> $prefix.'title_padding_top',
						'type' 				=> 'number',
					),
					array(
						'name' 				=> esc_html__( 'Padding Bottom', 'matjar' ),
						'desc' 				=> '',
						'id' 				=> $prefix.'title_padding_bottom',
						'type' 				=> 'number',
					),
					array(
						'name'  			=> esc_html__( 'Background Color', 'matjar' ),
						'label_description' => esc_html__( 'Select a background color for title.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_color',
						'type'  			=> 'color',
					),
					array(
						'name' 				=> esc_html__( 'Color', 'matjar' ),
						'label_description'	=> esc_html__( 'Select a title color.', 'matjar' ),
						'desc' 				=> '',
						'id' 				=> $prefix.'title_color',
						'type'     			=> 'button_group',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'light'    	=> esc_html__( 'Light', 'matjar' ),
							'dark' 		=> esc_html__( 'Dark', 'matjar' ),
						),
						'inline'   		=> 	true,
						'multiple' 		=> 	false,
						'std' 			=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Background Image', 'matjar' ),
						'label_description' => esc_html__( 'Select a custom image for your main title.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_img',
						'type'  			=> 'single_image',
					),
					array(
						'name'  			=> esc_html__( 'Position', 'matjar' ),
						'label_description' => esc_html__( 'Select your background image position.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_position',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'		=> esc_html__( 'Default', 'matjar' ),
							'left-top'      => esc_html__( 'Left Top', 'matjar' ),
							'left-center'   => esc_html__( 'Left Center', 'matjar' ),
							'left-bottom' 	=> esc_html__( 'Left Bottom', 'matjar' ),
							'right-top'		=> esc_html__( 'Right Top', 'matjar' ),
							'right-center'	=> esc_html__( 'Right Center', 'matjar' ),
							'right-bottom'	=> esc_html__( 'Right Bottom', 'matjar' ),
							'center-top'	=> esc_html__( 'Center Top', 'matjar' ),
							'center-center'	=> esc_html__( 'Center Center', 'matjar' ),
							'center-bottom'	=> esc_html__( 'Center Bottom', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Attachment', 'matjar' ),
						'label_description' => esc_html__( 'Select your background image attachment.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_attachment',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'scroll'    => esc_html__( 'Scroll', 'matjar' ),
							'fixed' 	=> esc_html__( 'Fixed', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Repeat', 'matjar' ),
						'label_description' => esc_html__( 'Select your background image repeat.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_repeat',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'no-repeat'	=> esc_html__( 'No-Repeat', 'matjar' ),
							'repeat'    => esc_html__( 'Repeat', 'matjar' ),
							'repeat-x'  => esc_html__( 'Repeat-X', 'matjar' ),
							'repeat-y' 	=> esc_html__( 'Repeat-Y', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name'  			=> esc_html__( 'Size', 'matjar' ),
						'label_description' => esc_html__( 'Select your background image size.', 'matjar' ),
						'id'    			=> $prefix.'title_bg_size',
						'type'     			=> 'select',
						'options'  			=> array(
							'default'	=> esc_html__( 'Default', 'matjar' ),
							'auto'		=> esc_html__( 'Auto', 'matjar' ),
							'cover'     => esc_html__( 'Cover', 'matjar' ),
							'contain'   => esc_html__( 'contain', 'matjar' ),
						),
						'inline'   			=> 	true,
						'multiple' 			=> 	false,
						'std'				=>	'default',
					),
					array(
						'name' 				=> esc_html__( 'Background Opacity', 'matjar' ),
						'label_description' => esc_html__( 'Enter a number between 0.1 to 1. Default is 0.5.', 'matjar' ),
						'desc' 				=> '',
						'id' 				=> $prefix . 'title_bg_opacity',
						'type' 				=> 'number',
						'min'  				=> 0,
						'max'  				=> 1,
						'step' 				=> 0.1,
					),
					array(
						'type'     			=> 'button_group',
						'id'    			=> $prefix.'breadcrumb',
						'name'  			=> esc_html__( 'Show Breadcrubm', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable the page title breadcrumbs.', 'matjar' ),
						'options'  			=> array(
							'default'   => esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std' 				=> 'default',
					),	
				),
			);
			/* End Title Options */

			/* Footer Options */
			$meta_boxes[] = array(
				'title' 		=> esc_html__('Footer', 'matjar'),
				'id' 			=> $prefix .'footer_options',
				'post_types' 	=> array('post','page','portfolio','product'),
				'tab' 			=> true,
				'fields' 		=> 	array(
					array(
						'name'  			=> esc_html__( 'Footer', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable footer.', 'matjar' ),
						'id'    			=> $prefix . 'site_footer',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'				=> 'default',
						'multiple' 			=> false,
					),
					array(
						'name'  			=> esc_html__( 'Subscribe', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable subscribe.', 'matjar' ),
						'id'    			=> $prefix.'footer_subscribe',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'				=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Popular Categories', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable categories.', 'matjar' ),
						'id'    			=> $prefix.'footer_categories',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'				=> 'default',
					),
					array(
						'name'  			=> esc_html__( 'Copyright', 'matjar' ),
						'label_description' => esc_html__( 'Enable or disable copyright.', 'matjar' ),
						'id'    			=> $prefix.'footer_copyright',
						'type'  			=> 'button_group',
						'options' 			=> array(
							'default'	=> esc_html__('Default','matjar'),
							'enable' 	=> esc_html__('Enable','matjar'),
							'disable'  	=> esc_html__('Disable','matjar'),
						),
						'std'				=> 'default',
					),
				),
			);
			/* End Footer Options */

			return $meta_boxes;
			
		}
		public function register_metaboxes(){
			$meta_boxes = $this->meta_boxes();
			// Make sure there's no errors when the plugin is deactivated or during upgrade
			if (class_exists('RW_Meta_Box')) {
					foreach ($meta_boxes as $meta_box) {
							new RW_Meta_Box($meta_box);
					}
			}
		}
		public function admin_js_var(){
			$meta_boxes = $this->meta_boxes();
			$meta_box_id = '';
			foreach ($meta_boxes as $box) {
				if (!isset($box['tab'])) {
					continue;
				}
				if ( !empty( $meta_box_id ) ) {
					$meta_box_id .= ',';
				}
				$meta_box_id .= '#' . $box['id'];
			}
			$matjar_option_string = apply_filters( 'matjar_theme_name','Matjar' ).' '.esc_html__('Options','matjar');
			wp_enqueue_script( 'matjar-meta-box', MATJAR_FRAMEWORK_URI . '/admin/assets/js/meta-box.js');
			$themejr_meta_data	= apply_filters( 'matjar_meta_data_arg', array( 
								'meta_box_ids'	=> $meta_box_id,
								'meta_box_title'	=> $matjar_option_string,
							) );
			
			wp_localize_script( 'matjar-meta-box' , 'matjar_meta_data' ,$themejr_meta_data );
		}		
	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	Matjar_Metabox::get_instance();

endif;