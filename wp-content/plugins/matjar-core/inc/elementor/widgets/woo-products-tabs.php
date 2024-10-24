<?php
/*
Element: Product Tab
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
class Matjar_Elementor_ProductsTabs extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_products_tabs';
    }

	/**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Tabs', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-product-tabs';
    }
	
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'woocommerce', 'product', 'tabs','tab' ];
	}
	
	/**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Layout', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'slider'	=> esc_html__( 'Slider', 'matjar-core' ),
					'grid'		=> esc_html__( 'Grid', 'matjar-core' ),
				],
                'default' 	=> 'slider',
            ]
        );
		$this->add_control(
            'product_view_mode',
            [
                'label' 	=> esc_html__( 'Product View Mode', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'vertical'		=> esc_html__( 'Vertical', 'matjar-core' ),
					'horizontal'	=> esc_html__( 'Horizontal', 'matjar-core' ),
				],
                'default' 	=> 'vertical',
            ]
        );
		$this->add_control(
            'product_style',
            [
                'label' 	=> esc_html__( 'Products Hover Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'default'			=> esc_html__( 'Default', 'matjar-core' ),
					'product-style-1'	=> esc_html__( 'Products Hover Style 1', 'matjar-core' ),
					'product-style-2'	=> esc_html__( 'Products Hover Style 2', 'matjar-core' ),
					'product-style-3'	=> esc_html__( 'Products Hover Style 3', 'matjar-core' ),
					'product-style-4'	=> esc_html__( 'Products Hover Style 4', 'matjar-core' ),
				],
                'default' 		=> 'default',
				'description' 	=> esc_html__( 'Select product hover style.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'cart_button_style',
            [
                'label' 		=> esc_html__( 'Cart Button Style', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'text'			=> esc_html__( 'Text', 'matjar-core' ),
					'icon'			=> esc_html__( 'Only Icon', 'matjar-core' ),
				],
                'default' 		=> 'text',
				'description' 	=> esc_html__( 'Select product cart button style', 'matjar-core' ),
				'condition' 	=> [
					'product_style!' 	=> [ 'product-style-3' ],
				],
            ]
        );		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_tab',
			array(
				'label'     => esc_html__( 'Tabs', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
            'tabs_style',
            [
                'label' 	=> esc_html__( 'Tabs Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'tabs-only'			=> esc_html__( 'Only Tabs', 'matjar-core' ),
					'tabs-with-title'	=> esc_html__( 'Tabs With Title', 'matjar-core' ),
				],
                'default' 		=> 'tabs-only',
				'description' 	=> esc_html__( 'Select product tabs style.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Latest Products', 'matjar-core'),
				'condition' 	=> [
					'tabs_style' => [ 'tabs-with-title'],
				],
            ]
        );
		
		$this->add_control(
            'tabs_align',
            [
                'label' 		=> esc_html__( 'Tabs Align', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'tabs-left'		=> esc_html__( 'Left', 'matjar-core' ),
					'tabs-center'	=> esc_html__( 'Center', 'matjar-core' ),
					'tabs-right'	=> esc_html__( 'Right', 'matjar-core' ),
				],
                'default' 		=> 'tabs-center',
				'condition' 	=> [
					'tabs_style' => [ 'tabs-only'],
				],
				'description' 	=> esc_html__( 'Select product tabs align.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'enable_ajax',
			[
				'label'     => esc_html__( 'Enable Ajax', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			'tab_enable',
			[
				'label' 	=> esc_html__( 'Enable', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$repeater->add_control(
			'tab_title',
			[
				'label' 		=> esc_html__( 'Tab Title', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Tab Title', 'matjar-core' ),
				'placeholder'	=> esc_html__( 'Tab Title', 'matjar-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);

		$repeater->add_control(
			'tab_data_source',
			[
				'label' 	=> esc_html__( 'Data source', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'recent_products'		=> esc_html__( 'Recent Products', 'matjar-core' ),
					'featured_products'		=> esc_html__( 'Featured Products', 'matjar-core' ),
					'sale_products'			=> esc_html__( 'On Sale Products', 'matjar-core' ),
					'best_selling_products'	=> esc_html__( 'Best-Selling Products', 'matjar-core' ),
					'top_rated_products'	=> esc_html__( 'Top Rated Products', 'matjar-core' ),
					'products'				=> esc_html__( 'List of Products', 'matjar-core' ),
				],
                'default' 		=> 'recent_products',
				'description' 	=> esc_html__( 'Select data source for your product tab', 'matjar-core' ),
			]
		);
		$repeater->add_control(
			'product_ids',
            [
                'label' 		=> esc_html__('Include Product Ids', 'matjar-core'),
                'type'        => 'matjar_autocomplete',
				'search'      => 'matjar_elementor_search_post',
				'render'      => 'matjar_elementor_render_post',
				'post_type'   => 'product',
				'multiple'    => true,
				'label_block' => true,
				'condition' 	=> [
					'tab_data_source' => [ 'products' ],
				],
				'description' 	=> esc_html__( 'Select specific products.', 'matjar-core' ),
            ]
		);
		
		$this->add_control(
            'product_tabs',
            [
                'label' 	=> esc_html__( 'Tabs Items', 'matjar-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'Best Selling', 'matjar-core' ),
						'tab_data_source' 	=> 'best_selling_products',
					],
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'Featured', 'matjar-core' ),
						'tab_data_source' 	=> 'featured_products',
					],
					[
						'tab_enable' 		=> 'yes',
						'tab_title' 		=> esc_html__( 'On Sale', 'matjar-core' ),
						'tab_data_source' 	=> 'sale_products',
					],
				],
				'title_field' => '{{{ tab_title }}}',
            ]
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_product_query',
			array(
				'label'     => esc_html__( 'Products Query', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$this->add_control(
            'categories',
            [
                'label'			=> esc_html__( 'Specific Category', 'matjar-core' ),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_taxonomies',
				'render'		=> 'matjar_elementor_render_taxonomies',
				'taxonomy'		=> array('product_cat'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Select specific categories.', 'matjar-core' ),
				'condition'		=> [
					'data_source!'	=> 'products',
				],
            ]
        );
		$this->add_control(
            'exclude',
            [
                'label'			=> esc_html__('Exclude Products', 'matjar-core'),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_post',
				'render'		=> 'matjar_elementor_render_post',
				'post_type'		=> 'product',
				'multiple'		=> true,
				'label_block'	=> true,
				'description' 	=> esc_html__( 'Exclude some products which you do not want to display.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 5,
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout' => 'grid',
				),
			)
		);
		$this->add_responsive_control(
			'grid_columns',
			[
				'label'			=> esc_html__( 'Columns', 'matjar-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'matjar-core' ),
					'2'		=> esc_html__( '2', 'matjar-core' ),
					'3'		=> esc_html__( '3', 'matjar-core' ),
					'4'		=> esc_html__( '4', 'matjar-core' ),
					'5'		=> esc_html__( '5', 'matjar-core' ),
					'6'		=> esc_html__( '6', 'matjar-core' ),
				],
				'default' 			=> '4',
				'tablet_default' 	=> '3',
				'mobile_default' 	=> '2',
			]
		);		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Carousel Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout' => 'slider',
				),
			)
		);
		$this->add_control(
            'rows',
            [
                'label' 	=> esc_html__( 'Rows', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( '1', 'matjar-core' ),
					'2'	=> esc_html__( '2', 'matjar-core' ),
					'3'	=> esc_html__( '3', 'matjar-core' ),
				],
				'default' 	=> '1',
            ]
        );
		$this->add_responsive_control(
			'slider_columns',
			[
				'label'			=> esc_html__( 'Columns', 'matjar-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'		=> esc_html__( '1', 'matjar-core' ),
					'2'		=> esc_html__( '2', 'matjar-core' ),
					'3'		=> esc_html__( '3', 'matjar-core' ),
					'4'		=> esc_html__( '4', 'matjar-core' ),
					'5'		=> esc_html__( '5', 'matjar-core' ),
					'6'		=> esc_html__( '6', 'matjar-core' ),
				],
				'default' 			=> '4',
				'tablet_default' 	=> '3',
				'mobile_default' 	=> '2',
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'     => esc_html__( 'Autoplay', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'label'     => esc_html__( 'Loop', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_center',
			[
				'label'     => esc_html__( 'Center Mode', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->add_control(
			'slider_nav',
			[
				'label'     => esc_html__( 'Nav', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'slider_dots',
			[
				'label'     => esc_html__( 'Dots', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,
			]
		);
		$this->end_controls_section();		
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slider_columns_tablet' => 3,
			'slider_columns_mobile' => 2,
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		
		$default_atts		= $settings;
		$settings['id'] 	= matjar_uniqid('matjar-products-tabs-');
		$class				= array('matjar-element', 'products-tabs', $tabs_style, 'tabs-layout', 'tabs-line' );
		$class[]			= ( 'tabs-only' == $tabs_style ) ? $tabs_align : '';
		$class[]			= ( 'horizontal' == $product_view_mode ) ? 'matjar-product-'.$product_view_mode : '';
		$class[]	 		= 'navigation-middle';
		$class[]			= ( $enable_ajax ) ? 'enable-ajax' : '';
		$settings['class']	= implode( ' ', $class );
		if( $product_style != 'default' ){
			matjar_set_loop_prop( 'product-style', $product_style );
		}
		if( 'product-style-3' != $product_style && 'icon' == $cart_button_style ){
			matjar_set_loop_prop( 'product-action-buttons-style', 'product-cart-icon' );
		}
		
		$owl_data	= array(
			'slider_loop'			=> $slider_loop ? true : false,
			'slider_autoplay' 		=> $slider_autoplay ? true : false,
			'slider_center' 		=> $slider_center ? true : false,
			'slider_nav'			=> $slider_nav ? true : false,
			'slider_dots'			=> $slider_dots ? true : false,
			'slider_autoHeight'		=>  false,
			'rs_extra_large' 		=> $slider_columns,
			'rs_large' 				=> $slider_columns,
			'rs_medium' 			=> $slider_columns_tablet,
			'rs_small' 				=> $slider_columns_mobile,
			'rs_extra_small' 		=> $slider_columns_mobile,
		);		
		$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data );	
		$settings['slider_data'] = $slider_data;
		
		$tabs_data = array();
		if( ! empty( $product_tabs ) ){
			foreach( $product_tabs as $intex => $items ){
				if( $items['tab_enable'] == 'yes' && !empty( $items['tab_title'] ) ) {
					$settings['data_source'] 	= $settings['product_ids'] = '';
					$settings['data_source']	= $items['tab_data_source'];
					if( $items['tab_data_source'] == 'products' ) {
						$settings['product_ids'] = $items['product_ids'];
					}
					$data		= wp_json_encode( array_intersect_key( $settings, matjar_default_product_args() ) );					
					$the_query = [];
					if( $enable_ajax && ( $intex == 0 ) ){
						$query 			= matjar_get_products($items['tab_data_source'], $settings );
						$the_query 		= new WP_Query( $query );	
					}else{
						$query 			= matjar_get_products($items['tab_data_source'], $settings );
						$the_query 		= new WP_Query( $query );
					}					
					$tabs_data[]	= array(
						'id' 			=> matjar_uniqid( 'matjar-tab-' ),
						'title' 		=> $items['tab_title'],
						'data_source' 	=> $items['tab_data_source'],
						'query' 		=> $the_query,
						'data'			=> $data,
					);
				}
			}
		}		
		$settings['tabs'] = $tabs_data;
		matjar_get_pl_templates( 'elements-widgets/woo-products-tabs', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_ProductsTabs());