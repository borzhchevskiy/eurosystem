<?php
/*
Element: Product Recently Viewed
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_ProductsRecentlyViewed extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_products_recently_viewed';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Recently Viewed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Recently Viewed', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Recently Viewed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-products';
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
		return [ 'woocommerce', 'product', 'recently viewed','viewed' ];
	}
	
	/**
     * Register Product Recently Viewed widget controls.
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
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Recently Viewed', 'matjar-core'),
            ]
        );
		
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 10,
            ]
        );
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Carousel Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
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
			'slider_columns_tablet' => 3,
			'slider_columns_mobile' => 2
		]);
		extract( $settings );
		$default_atts		= $settings;
		$settings['id'] 	= matjar_uniqid( 'matjar-recently-viewed-' );
		$class				= array( 'matjar-element', 'matjar-products-recently-viewed', 'woocommerce' );
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] = implode(' ',array_filter($class));
		
		matjar_set_loop_prop( 'name', 'matjar-carousel' );
		matjar_set_loop_prop( 'products_view', 'grid-view' );
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
		$unique_id 		= matjar_uniqid( 'section-' );
		$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data);
		
		matjar_set_loop_prop( 'products-columns', $slider_columns );
		matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
		matjar_set_loop_prop( 'rs_large', $slider_columns );
		matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
		matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'unique_id', $unique_id );		
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
	
		$viewed_products = matjar_get_recently_viewed_products();
		if( empty( $viewed_products ) ) { return; }
		
		$query = array(
			'posts_per_page' => $settings['limit'],
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'post__in'       => $viewed_products,
			'orderby'        => 'post__in',
		);

		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			);
		}
		
		$the_query 		= new WP_Query( $query );		
		$settings['query'] 	= $the_query;		
		
		matjar_get_pl_templates( 'elements-widgets/woo-products-recently-viewed', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_ProductsRecentlyViewed());