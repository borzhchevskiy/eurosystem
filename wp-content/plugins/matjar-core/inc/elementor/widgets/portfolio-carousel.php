<?php
/*
Element: Portfolio Carousel
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_PortfolioCarousel extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_portfolio_carousel';
    }

	/**
     * Get widget title.
     *
     * Retrieve portfolio carousel widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Portfolio Carousel', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve portfolio carousel widget icon.
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
		return [ 'portfolio', 'work'];
	}
	
	/**
     * Register portfolio carousel widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {		
		
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 		=> esc_html__('Portfolio Title', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Our Portfolio', 'matjar-core'),
				'description'   => esc_html__( 'Enter title', 'matjar-core' ),	
            ]
        );
		$this->add_control(
            'portfolio_style',
            [
                'label' 	=> esc_html__( 'Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'portfolio-style-1'	=> esc_html__( 'Style 1', 'matjar-core' ),
					'portfolio-style-2'	=> esc_html__( 'Style 2', 'matjar-core' ),
					'portfolio-style-3'	=> esc_html__( 'Style 3', 'matjar-core' ),
				],
                'default' 	=> 'portfolio-style-1',
				'description' 	=> esc_html__( 'Select style.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'portfolio_grid_gap',
            [
                'label' 	=> esc_html__( 'Grid Gapping', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'0'		=> esc_html__( 'None', 'matjar-core' ),
					'5'		=> esc_html__( '5', 'matjar-core' ),
					'10'	=> esc_html__( '10', 'matjar-core' ),
					'15'	=> esc_html__( '15', 'matjar-core' ),
				],
				'default' 	=> '10',
				'selectors' => [
					'{{WRAPPER}} .matjar-portfolio-carousel article' => 'padding: {{VALUE}}px',
					'{{WRAPPER}} .matjar-portfolio-carousel .section-content.row' => 'margin: -{{VALUE}}px;',
				],
				'condition' => [
					'portfolio_style!' => [ 'portfolio-style-1' ],
				],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_query',
			array(
				'label'     => esc_html__( 'Query', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);	      
		
		$this->add_control(
            'portfolio_per_page',
            [
                'label' 	=> esc_html__('Number Of Portfolios', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 6,
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'title'   	=> esc_html__( 'Title', 'matjar-core' ),
					'date'     	=> esc_html__( 'Date', 'matjar-core' ),
					'random' 	=> esc_html__( 'Random', 'matjar-core' ),
				],
				'default' 	=> 'date',
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
				'default' 	=> 'DESC',
            ]
        );		
		$this->end_controls_section();	
		
		
		$this->start_controls_section(
			'section_content_portfolio_settings',
			array(
				'label'     => esc_html__( 'Portfolio Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);		
		$this->add_control(
            'portfolio_button_icon',
            [
                'label' 	=> esc_html__( 'Hover Button Icon', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
            ]
        );
		$this->add_control(
            'portfolio_link_icon',
            [
                'label' 	=> esc_html__( 'Link Button Icon', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'condition' => [
					'portfolio_button_icon' => '1',
				],
            ]
        );
		$this->add_control(
            'portfolio_zoom_icon',
            [
                'label' 	=> esc_html__( 'Zoom Image Icon', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'condition' => [
					'portfolio_button_icon' => '1',
				],
            ]
        );
		$this->add_control(
            'portfolio_content_part',
            [
                'label' 	=> esc_html__( 'Portfolio Content Part', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
            ]
        );
		$this->add_control(
            'portfolio_category',
            [
                'label' 	=> esc_html__( 'Portfolio Category', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'condition' => [
					'portfolio_content_part' => '1',
				],
            ]
        );
		$this->add_control(
            'portfolio_title',
            [
                'label' 	=> esc_html__( 'Portfolio Title', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'condition' => [
					'portfolio_content_part' => '1',
				],
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
					'side'		=> esc_html__( 'Side', 'matjar-core' ),
					'top'		=> esc_html__( 'Top', 'matjar-core' ),
				],
				'default' 	=> 'side',
				'condition'	=> [
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
		
		$settings = $this-> get_settings();
		$settings = wp_parse_args( $settings, [
			'slider_columns_tablet' => 2,
			'slider_columns_mobile' => 1
		]);
		extract( $settings );
		$default_atts		= $settings;
		$settings['id'] 	= matjar_uniqid('matjar-portfolio-');
		$class				= array( 'matjar-element', 'matjar-portfolio-carousel', $portfolio_style );
		$class[]			= $slider_center ? 'matjar-carousel-center-mode' : '';
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] 		= implode(' ', array_filter($class) );
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
		
		$slider_data 			= shortcode_atts( matjar_slider_options(), $owl_data );		
		$query_args = array(
			'post_type'          => 'portfolio',
			'post_status'        => array('publish'),
			'posts_per_page'     => $portfolio_per_page,
			'ignore_sticky_posts'=> true,
		);
		
		$query_args['orderby'] = $settings['orderby'];
		
		// Posts Order
		if( ! empty( $orderby ) ){

			// Random Posts
			if( $orderby == 'rand' ){
				$query_args['orderby'] = 'rand';
			}

			// Recent modified Posts
			elseif( $orderby == 'modified' ){
				$query_args['orderby'] = 'modified';
			}
		}
		
		$query_args['order'] = $settings['order'];
		
		$the_query = new WP_Query( $query_args );
		$settings['query'] 			= $the_query; 
		
		matjar_set_loop_prop( 'name', 'portfolio-slider-widget' );
		matjar_set_loop_prop( 'portfolio-style', $portfolio_style );
		matjar_set_loop_prop( 'portfolio-grid-layout', 'simple-grid' );
		matjar_set_loop_prop( 'portfolio-filter', 0 );
		matjar_set_loop_prop( 'portfolio-content-part', $portfolio_content_part );
		matjar_set_loop_prop( 'portfolio-button-icon', $portfolio_button_icon );
		matjar_set_loop_prop( 'portfolio-link-icon', $portfolio_link_icon );
		matjar_set_loop_prop( 'portfolio-zoom-icon', $portfolio_zoom_icon );
		matjar_set_loop_prop( 'portfolio-content-part', $portfolio_content_part );
		matjar_set_loop_prop( 'portfolio-category', $portfolio_category );
		matjar_set_loop_prop( 'portfolio-title', $portfolio_title );
		matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
		matjar_set_loop_prop( 'rs_large', $slider_columns );
		matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
		matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
		
		matjar_get_pl_templates( 'elements-widgets/portfolio-carousel', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_PortfolioCarousel());