<?php
/*
Element: WCFM Vendors
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_WCFMVendors extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_wcfm_vendors';
    }

	/**
     * Get widget title.
     *
     * Retrieve WCFM Vendors widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'WCFM Vendors', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve WCFM Vendors widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-user-circle-o';
    }
	
	/**
     * Register WCFM Vendors widget controls.
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
                'label'		=> esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 		=> esc_html__('Title', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Top Vendor', 'matjar-core' ),
				'description'   => esc_html__( 'Enter title', 'matjar-core' ),
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
					'default'					=> esc_html__( 'Default', 'matjar-core' ),
					'boxed'						=> esc_html__( 'Boxed', 'matjar-core' ),
					'boxed-center-products'		=> esc_html__( 'Boxed Center with Products', 'matjar-core' ),
					'boxed-horizontal-products'	=> esc_html__( 'Boxed Horizontal with Products', 'matjar-core' ),
					'boxed-simple'				=> esc_html__( 'Boxed Simple', 'matjar-core' ),
				],
                'default' 		=> 'default',
				'description' 	=> esc_html__( 'Select style.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'recent_products',
			[
				'label' 	=> esc_html__( 'Show Recent Products', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' 	=> [
					'style' => [ 'boxed-center-products', 'boxed-horizontal-products' ],
				],
			]
		);
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number Of Vendor', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 3,
            ]
        );
		$this->add_control(
            'specific_vendor',
            [
                'label' 		=> esc_html__('Specific Vendor', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'description' 	=> esc_html__( 'Enter vendor id, multiple vendor id with comma-separated.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'display_name'	=> esc_html__( 'Store Name', 'matjar-core' ),
					'ID'			=> esc_html__( 'ID', 'matjar-core' ),
				],
				'default' 	=> 'display_name',
            ]
        );
		$this->add_control(
            'order',
            [
                'label' 	=> esc_html__( 'Sort By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'DESC'	=> esc_html__( 'Descending', 'matjar-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'matjar-core' ),
				],
				'default' 	=> 'ASC',
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
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
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
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
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
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [ 
			'slider_columns_tablet' => 2,
			'slider_columns_mobile' => 1,
			'grid_columns_tablet' 	=> 2,
			'grid_columns_mobile' 	=> 1
		]);
		extract( $settings );
		$default_atts			= $settings;
		$settings['id'] 		= matjar_uniqid('matjar-wcfm-vendors-');
		$class					= array( 'matjar-element', 'matjar-wcfm-vendors', 'matjar-vendors-'.$style );
		$class[]	 			= ( $layout == 'slider' ) ? 'row' : '';
		$class[]	 			= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] 			= implode( ' ', array_filter( $class ) );
		$settings['slider_class'] 	= 'row';
		$settings['column_class'] 	= ''; 
		
		if( $layout == 'grid' ){
			$columns_class 		= array();
			$columns_class[] = 'col-' .matjar_get_rs_grid_columns ( $grid_columns_mobile );
			$columns_class[] = 'col-md-' .matjar_get_rs_grid_columns ( $grid_columns_tablet );
			$columns_class[] = 'col-lg-' .matjar_get_rs_grid_columns ( $grid_columns );
			$settings['column_class'] 	= join( ' ', $grid_columns );
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
				
		$user_args = array();
		$user_args['number'] 	= $number;
		$user_args['role'] 		= 'wcfm_vendor';
		$user_args['orderby'] 	= $orderby;
		$user_args['order'] 	= $order;
		$user_args['meta_query'] = array( 
			array( 
				'key' 		=> '_disable_vendor', 
				'compare' 	=> 'NOT EXISTS'										
			)
		 );
		$user_args['fields'] 	= 'ID';
		if( ! empty( $specific_vendor ) ){
			$specific_ids = explode( ',', $atts[ 'specific_vendor' ] );
			$specific_ids = array_map( 'trim', $specific_ids );
			$user_args['include'] 	= $specific_ids;
			$user_args['number'] 	= count($specific_ids);
			unset($user_args['orderby']);
			unset($user_args['order']);
		}
		
		$vendors = get_users( $user_args );
		
		if(!$vendors){
			return;
		}
		
		$settings['vendors'] = $vendors;
		$settings['vendors_count'] = count($vendors);	
		
		matjar_get_pl_templates( 'elements-widgets/wcfm-vendors/'.$style, $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_WCFMVendors());