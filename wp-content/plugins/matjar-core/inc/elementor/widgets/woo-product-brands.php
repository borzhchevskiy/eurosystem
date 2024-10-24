<?php
/*
Element: Product Brand
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_ProductBrands extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_product_brands';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Brand widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Brands', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Brand widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-posts-carousel';
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
		return [ 'woocommerce', 'brand' ];
	}
	
	/**
     * Register Product Brand widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		$image_sizes 		= matjar_get_all_image_sizes(true);
		$matjar_product_brands = matjar_elementor_get_terms('product_brand');
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Top Brands', 'matjar-core' ),
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
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'brand-square'	=> esc_html__( 'Square', 'matjar-core' ),
					'brand-circle'	=> esc_html__( 'Circle', 'matjar-core' ),
				],
                'default' 	=> 'brand-square',
            ]
        );
		$this->add_control(
            'image_size',
            [
                'label' 	=> esc_html__( 'Image Size', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
                'default' 	=> 'full',
            ]
        );
		$this->add_responsive_control(
			'image_width',
			[
				'label'     	=> esc_html__( 'Image Width', 'matjar-core' ),
				'label_block'	=> true,
				'type'      	=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'selectors' 	=> [
					'{{WRAPPER}} .matjar-product-brands.brand-circle .brand-image' => 'width: {{SIZE}}px;height: {{SIZE}}px;border-radius: {{SIZE}}px'
				],
				'condition' 	=> [
					'style' => 'brand-circle'
				],
			]
		);
		$this->add_control(
            'brands',
            [
                'label' 		=> esc_html__( 'Specific Brands', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT2,
				'multiple' 		=> true,
                'options' 		=> $matjar_product_brands,
                'description' 	=> esc_html__( 'Select specific brands.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number of Brands', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '10',
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'name'	=> esc_html__( 'Name', 'matjar-core' ),
					'slug'	=> esc_html__( 'Slug', 'matjar-core' ),
					'ID'	=> esc_html__( 'ID', 'matjar-core' ),
				],
				'default' 	=> 'name',
            ]
        );
		$this->add_control(
            'order',
            [
                'label' 	=> esc_html__( 'Sort By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'desc'	=> esc_html__( 'Descending', 'matjar-core' ),
					'asc'	=> esc_html__( 'Ascending', 'matjar-core' ),
				],
				'default' 	=> 'desc',
            ]
        );
		
		$this->add_control(
			'show_title',
			[
				'label' 	=> esc_html__( 'Show Title', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'hover_effect',
			[
				'label' 	=> esc_html__( 'Enable Hover Effect', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'hide_empty_brand',
			[
				'label' 	=> esc_html__( 'Hide Empty Brands', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
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
					'7'		=> esc_html__( '7', 'matjar-core' ),
					'8'		=> esc_html__( '8', 'matjar-core' ),
					'9'		=> esc_html__( '9', 'matjar-core' ),
					'10'	=> esc_html__( '10', 'matjar-core' ),
				],
				'default' 			=> '7',
				'tablet_default' 	=> '5',
				'mobile_default' 	=> '3',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Slider Settings', 'matjar-core' ),
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
					'7'		=> esc_html__( '7', 'matjar-core' ),
					'8'		=> esc_html__( '8', 'matjar-core' ),
					'9'		=> esc_html__( '9', 'matjar-core' ),
					'10'	=> esc_html__( '10', 'matjar-core' ),
				],
				'default' 			=> '7',
				'tablet_default' 	=> '5',
				'mobile_default' 	=> '3',
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
            'navigation_position',
            [
                'label' 	=> esc_html__( 'Navigation Position', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'side'	=> esc_html__( 'Side', 'matjar-core' ),
					'top'	=> esc_html__( 'Top', 'matjar-core' ),
				],
				'default' 	=> 'side',
				'condition' 	=> [
					'slider_nav' => 'yes'
				],
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
		
		$settings 					= $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slider_columns_tablet' => 5,
			'slider_columns_mobile' => 3,
			'grid_columns_tablet' => 5,
			'grid_columns_mobile' => 3
		]);
		extract( $settings );
		$settings['id'] 			= matjar_uniqid( 'matjar-product-brand-' );
		$class						= array( 'matjar-element', 'matjar-product-brands', $style );	
		$class[]					= $hover_effect ? 'brand-hover-effect' : '';
		$class[]	 				= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] 			= implode(' ', array_filter( $class ) );
		$settings['column_class'] 	= '';
		$settings['slider_class'] 	= 'row';
		$query_args = array(
			'taxonomy'  	=> 'product_brand',
			'number'    	=> $settings['number'],
			'orderby'    	=> $settings['orderby'],
			'order'      	=> $settings['order'],
			'hide_empty' 	=> $hide_empty_brand,
		);
		
		if ( !empty( $settings['brands'] ) ) {
			$query_args['include'] = $settings['brands'];			
		} 
		
		$product_brands = get_terms( $query_args );	
		
		$settings['product_brands'] = $product_brands;
		
		if( $layout == 'grid' ){
			$columns_class = array();
			$columns_class[] = 'col-' .matjar_get_rs_grid_columns ( $grid_columns_mobile );
			$columns_class[] = 'col-md-' .matjar_get_rs_grid_columns ( $grid_columns_tablet );
			$columns_class[] = 'col-lg-' .matjar_get_rs_grid_columns ( $grid_columns );
						
			$settings['column_class'] = join( ' ', $columns_class );
			wc_set_loop_prop( 'columns', $grid_columns );
			$settings['rows'] = 1;
		}else{
			$owl_data	= array(
				'slider_loop'				=> $slider_loop ? true : false,
				'slider_autoplay' 			=> $slider_autoplay ? true : false,
				'slider_center' 			=> $slider_center ? true : false,
				'slider_nav'				=> $slider_nav ? true : false,
				'slider_dots'				=> $slider_dots ? true : false,
				'rs_extra_large' 			=> $slider_columns,
				'rs_large' 					=> $slider_columns,
				'rs_medium' 				=> $slider_columns_tablet,
				'rs_small' 					=> $slider_columns_mobile,
				'rs_extra_small' 			=> $slider_columns_mobile,
			);
			$slider_data 				= shortcode_atts( matjar_slider_options(), $owl_data );
			$settings['slider_class'] 	= 'matjar-carousel owl-carousel';
			$settings['slider_class'] 	.= ' grid-col-lg-'.$slider_columns;
			$settings['slider_class'] 	.= ' grid-col-md-'.$slider_columns_tablet;
			$settings['slider_class'] 	.= ' grid-col-'.$slider_columns_mobile;
			$settings['owl_options'] 	= wp_json_encode( $slider_data );
		}
		
		matjar_get_pl_templates( 'elements-widgets/woo-product-brands', $settings );
	}
}

$widgets_manager->register( new Matjar_Elementor_ProductBrands() );