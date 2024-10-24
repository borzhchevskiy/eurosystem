<?php
/*
Element: Product With Banner
*/
use Elementor\Controls_Manager;
use Elementor\Utils;
class Matjar_Elementor_Product_Width_Banner extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_products_with_banner';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product With Banner widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products With Banner', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product With Banner widget icon.
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
		return [ 'woocommerce', 'product', 'products', 'banner' ];
	}
	
	/**
     * Register Product With Banner widget controls.
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
				'default' 	=> esc_html__( 'Latest Products', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Layout', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'banner-left'	=> esc_html__( 'Products With Banner Left', 'matjar-core' ),
					'banner-right'	=> esc_html__( 'Products With Banner Right', 'matjar-core' ),
				],
                'default' 		=> 'banner-left',
                'description' 	=> esc_html__( 'Select element layout.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'banner_image',
			[
				'label'     => esc_html__( 'Choose image', 'matjar-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
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
		$this->add_control(
			'show_view_more_button',
			[
				'label' 	=> esc_html__( 'Show View All Button', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->add_control(
			'view_more_button_text',
			[
				'label' 	=> esc_html__( 'View All Button Text', 'matjar-core' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> 'View All',
				'condition' => [
					'show_view_more_button' => 'yes'
				],
			]
		);
		$this->add_control(
			'view_more_button_link',
			[
				'label' 	=> esc_html__( 'View More Button Link', 'matjar-core' ),
				'type' 		=> Controls_Manager::URL,				
				'condition' => [
					'show_view_more_button' => 'yes'
				],
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
				'description' 	=> esc_html__( 'Select data source for your product grid', 'matjar-core' ),
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
				'default' 	=> 6,
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
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_slider',
			array(
				'label'     => esc_html__( 'Carousel Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
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
		$settings['id'] 	= matjar_uniqid('matjar-banner-');
		$class				= array( 'matjar-element', 'products-with-banner', 'woocommerce' );
		$class[]			= $layout;
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['show_view_more_button'] 	= $show_view_more_button ? true : false;		
		$settings['banner_layout']			= '';
		if($layout == 'banner-right'){
			$settings['banner_layout']	= 'flex-row-reverse';
		}
		$shop_page_id 	= wc_get_page_id( 'shop' );
		$shop_page_url 	= $shop_page_id ? get_permalink( $shop_page_id ) : '#';
		$settings['view_all_btn']['url']	= 'href="'.$shop_page_url.'"';		
		$settings['banner_link'] = $shop_page_url;		
		
		if(!empty($categories)){
			$banner_link 	= get_term_link( (int) trim( $categories[0] ), 'product_cat' );
			if(  !is_wp_error( $banner_link )){
				$settings['banner_link'] 	= $banner_link;
				$settings['view_all_btn']['url'] 	= 'href="'.$banner_link.'"';
			}
			
		}
		
		$query = matjar_get_products( $data_source, $settings );
		
		$the_query = new WP_Query( $query );		
		$settings['query'] 			= $the_query;
		
		
		$link_url = '';		
		if( !empty( $settings['view_more_button_link']['url'] ) ) {
			$link_url = matjar_elementor_get_url_data($settings['view_more_button_link']);
			$settings['banner_link']	= $settings['view_more_button_link']['url'];
		}
		
		if(!empty($link_url['url'])){
			$settings['view_all_btn'] 	= $link_url;			
		}
		
		if( $product_style != 'default' ){
			matjar_set_loop_prop( 'product-style', $product_style );
		}		
		if( 'product-style-3' != $product_style && 'icon' == $cart_button_style ){
			matjar_set_loop_prop('product-action-buttons-style', 'product-cart-icon' );
		}
		
		matjar_set_loop_prop( 'name', 'matjar-carousel');
		matjar_set_loop_prop( 'products-element', 'products-with-banner' );
		matjar_set_loop_prop( 'products_view', 'grid-view' );
		$owl_data	= array(
			'slider_loop'				=> $slider_loop ? true : false,
			'slider_autoplay' 			=> $slider_autoplay ? true : false,
			'slider_center' 			=> $slider_center ? true : false,
			'slider_nav'				=> $slider_nav ? true : false,
			'slider_dots'				=> $slider_dots ? true : false,
			'slider_autoHeight'			=>  false,
			'rs_extra_large' 		=> $slider_columns,
			'rs_large' 				=> $slider_columns,
			'rs_medium' 			=> $slider_columns_tablet,
			'rs_small' 				=> $slider_columns_mobile,
			'rs_extra_small' 		=> $slider_columns_mobile,
		);
		$unique_id 		= matjar_uniqid('section-');
		$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data );				
		matjar_set_loop_prop( 'unique_id', $unique_id );
		matjar_set_loop_prop( 'products-columns', $slider_columns );
		matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
		matjar_set_loop_prop( 'rs_large', $slider_columns );
		matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
		matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
		$settings['class'] = implode( ' ', array_filter( $class ) );
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
		
		matjar_get_pl_templates( 'elements-widgets/woo-products-with-banner', $settings );
	}
}

$widgets_manager->register( new Matjar_Elementor_Product_Width_Banner() );