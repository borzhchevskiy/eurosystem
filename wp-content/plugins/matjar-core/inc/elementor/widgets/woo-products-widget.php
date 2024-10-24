<?php
/*
Element: Product Widgets
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_ProductsWidget extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_products_widget';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Widgets widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products Widget', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Widgets widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-post-list';
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
		return [ 'woocommerce', 'product widget', 'products' ];
	}
	
	/**
     * Register Product Widgets widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {		
		$matjar_product_cats = matjar_elementor_get_terms('product_cat',true);
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
				'default' 	=> esc_html__( 'Recent Products', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Layout', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'list'		=> esc_html__( 'List', 'matjar-core' ),
					'slider'	=> esc_html__( 'Slider', 'matjar-core' ),
				],
                'default' 	=> 'list',
            ]
        );
		$this->add_control(
            'data_source',
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
				'description' 	=> esc_html__( 'Select data source', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'product_ids',
            [
                'label'			=> esc_html__('Include Product Ids', 'matjar-core'),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_post',
				'render'		=> 'matjar_elementor_render_post',
				'post_type'		=> 'product',
				'multiple'		=> true,
				'label_block'	=> true,
				'condition'		=> [
					'data_source'	=> [ 'products' ],
				],
				'description' 	=> esc_html__( 'Select specific products.', 'matjar-core' ),
            ]
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
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'date'	=> esc_html__( 'Date', 'matjar-core' ),
					'title'	=> esc_html__( 'Title', 'matjar-core' ),
					'name'	=> esc_html__( 'Name(Slug)', 'matjar-core' ),
					'rand'	=> esc_html__( 'Random', 'matjar-core' ),
					'ID'	=> esc_html__( 'ID', 'matjar-core' ),
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
		$this->add_control(
			'show_rating',
			[
				'label' 	=> esc_html__( 'Show Rating?', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Carousel Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' 	=> [
					'layout' => 'slider'
				],
			)
		);
		$this->add_control(
            'rows',
            [
                'label' 	=> esc_html__( 'Product Per Slide', 'matjar-core' ),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '5',
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
		extract( $settings );
		$settings['id'] 	= matjar_uniqid('matjar-product-widget-');
		$class				= array( 'matjar-element', 'widget', 'matjar-products-widget', 'woocommerce' );
		$widget_css			= '';
		
		
		$query = matjar_get_products( $data_source, $settings );
		
		$the_query = new WP_Query( $query );		
		$settings['query'] 			= $the_query;
		$show_button  = false;
		$max_num_page = $the_query->max_num_pages;
		$query_paged  = $the_query->query_vars['paged'];
		if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
			$show_button = true;
		} else {
			$show_button = false;
		}
		if ( $max_num_page <= 1 ) {
			$show_button = false;
		}
		if( 'list' == $layout){
			matjar_set_loop_prop( 'products-columns', 4 );
		}else{			
			$owl_data	= array(
				'slider_loop'				=> $slider_loop ? true : false,
				'slider_autoplay' 			=> $slider_autoplay ? true : false,
				'slider_center' 			=> false,
				'slider_nav'				=> $slider_nav ? true : false,
				'slider_dots'				=> $slider_dots ? true : false,
				'slider_autoHeight'			=>  false,
				'rs_extra_large' 			=> 1,
				'rs_large' 					=> 1,
				'rs_medium' 				=> 1,
				'rs_small' 					=> 1,
				'rs_extra_small' 			=> 1,
			);
			$unique_id 		= $settings['id'];
			$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data );
			$widget_css		= ' matjar-carousel owl-carousel grid-col-1';
			$settings['owl_options'] = wp_json_encode( $slider_data );
		}
		$settings['class'] = implode(' ', array_filter( $class ) ) ;
		$settings['args'] = wp_json_encode( $settings );
		$settings['widget_css'] = $widget_css;
		$settings['template_args'] = array(
			'show_rating' => $show_rating,
		);
		
		matjar_get_pl_templates( 'elements-widgets/woo-products-widget', $settings );
	}
}

$widgets_manager->register( new Matjar_Elementor_ProductsWidget() );