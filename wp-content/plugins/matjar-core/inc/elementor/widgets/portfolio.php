<?php
/*
Element: Portfolio
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_Portfolio extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_portfolio';
    }

	/**
     * Get widget title.
     *
     * Retrieve Portfolio widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Portfolio', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Portfolio widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-gallery-grid';
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
	 * Retrieve Widget Dependent JS.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array JS script handles.
	 */
	public function get_script_depends() {
		return [ 'imagesloaded', 'masonry', 'isotope' ];
	}
	
	/**
     * Register Portfolio widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= matjar_get_all_image_sizes(true);
		
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
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
					'{{WRAPPER}} .matjar-portfolio article' => 'padding: {{VALUE}}px;',
					'{{WRAPPER}} .matjar-portfolio .portfolios-list.row' => 'margin: -{{VALUE}}px;',
				],
				'condition' => [
					'portfolio_style!' => [ 'portfolio-style-1' ],
				],
            ]
        );
		$this->add_control(
            'pagination',
            [
                'label' 	=> esc_html__( 'Pagination', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'none'				=> esc_html__( 'None', 'matjar-core' ),
					'default'			=> esc_html__( 'Default', 'matjar-core' ),
					'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'matjar-core' ),
					'load-more-button'	=> esc_html__( 'Load More', 'matjar-core' ),
				],
				'default' 	=> 'none',
            ]
        );
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_blog_query',
			array(
				'label'     => esc_html__( 'Query', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);	      
		
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Per Page', 'matjar-core'),
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
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
            'portfolio_grid_layout',
            [
                'label' 	=> esc_html__( 'Grid Layout', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'simple-grid'	 => esc_html__( 'Simple', 'matjar-core' ),
					'masonry-grid'	 => esc_html__( 'Masonry', 'matjar-core' ),
				],
				'default' 	=> 'simple-grid',
            ]
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
				],
				'default' 			=> '3',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
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
            'portfolio_filter',
            [
                'label' 	=> esc_html__( 'Portfolio Filter', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
            ]
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
		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings = wp_parse_args( $settings, [
			'grid_columns_tablet' => 2,
			'grid_columns_mobile' => 1
		]);
		extract( $settings );
		
		
		$settings['id'] 	= matjar_uniqid('matjar-portfolio-');
		$class				= array( 'matjar-element', 'matjar-portfolio', $portfolio_style );
		$settings['class'] 		= implode(' ',array_filter($class));
		$settings['post_type'] 	= 'portfolio';
		$default_atts		= $settings;	
		// Pagination parameter
		if(is_home() || is_front_page()) {
			$paged = get_query_var('page');
		} else {
			$paged = get_query_var('paged');
		}
		$settings['paged'] = $paged;
		
		$query_args  	= matjar_get_posts($settings);
		$the_query 		= new WP_Query( $query_args );
		$settings['query'] 	= $the_query; 
		
		$total   = $the_query->max_num_pages;
		$current = $paged;
		$base    = esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) );
		$format  = '?page=%#%';
		$show_pagination  = true;
		if ( $total <= 1 || $pagination == 'none') {
			$show_pagination  = false;
		}
		
		$settings['show_pagination'] 	= $show_pagination;
		$settings['total'] 				= $total;
		$settings['base'] 				= $base;
		$settings['current'] 			= $current;
		$settings['format'] 			= $format;
		$settings['atts'] 				= wp_json_encode( array_intersect_key( $settings,matjar_default_portfolio_args() ) );	
		
		
		matjar_set_loop_prop( 'name', 'portfolio-post-widget' );
		matjar_set_loop_prop( 'portfolio-style', $portfolio_style );
		matjar_set_loop_prop( 'portfolio-grid-layout', $portfolio_grid_layout );
		matjar_set_loop_prop( 'portfolio-grid-columns', $grid_columns );
		matjar_set_loop_prop( 'portfolio-grid-columns-tablet', $grid_columns_tablet );
		matjar_set_loop_prop( 'portfolio-grid-columns-mobile', $grid_columns_mobile );
		matjar_set_loop_prop( 'portfolio-filter', $portfolio_filter );
		matjar_set_loop_prop( 'portfolio-button-icon', $portfolio_button_icon );
		matjar_set_loop_prop( 'portfolio-link-icon', $portfolio_link_icon );
		matjar_set_loop_prop( 'portfolio-zoom-icon', $portfolio_zoom_icon );
		matjar_set_loop_prop( 'portfolio-content-part', $portfolio_content_part );
		matjar_set_loop_prop( 'portfolio-category', $portfolio_category );
		matjar_set_loop_prop( 'portfolio-title', $portfolio_title );
		
		
		matjar_get_pl_templates( 'elements-widgets/portfolio', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Portfolio());