<?php
/*
Element: Product and Categories Box
*/
use Elementor\Controls_Manager;
use Elementor\Utils;
class Matjar_Elementor_ProductsAndCategoriesBox extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_products_and_categories_box';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product and Categories Box widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Products And Categories Box', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product and Categories Box widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-product-categories';
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
		return [ 'woocommerce', 'products', 'categories', 'categories box' ];
	}
	/**
     * Register Product and Categories Box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$matjar_product_cats = matjar_elementor_get_terms('product_cat',true);
		
		$this->start_controls_section(
            'content_section_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Box Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Accessories' , 'matjar-core'),
            ]
        );
		$this->add_control(
            'layout',
            [
                'label' 	=> esc_html__( 'Box Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'banner-products'	=> esc_html__( 'Banner With Products', 'matjar-core' ),
					'banner-categories'	=> esc_html__( 'Banner With Categories', 'matjar-core' ),
					'only-products'		=> esc_html__( 'Only Products', 'matjar-core' ),
					'only-categories'	=> esc_html__( 'Only Categories', 'matjar-core' ),
				],
                'default'		=> 'banner-products',
                'description'	=> esc_html__( 'Select box style.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
			'hide_action_button',
			[
				'label' 	=> esc_html__( 'Hide Action Button', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' => [
					'layout'	=> [ 'banner-products', 'only-products' ],
				],
			]
		);
		$this->add_control(
            'category_box_style',
            [
                'label' 	=> esc_html__( 'Category Box Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'category-style-1'	=> esc_html__( 'Style 1', 'matjar-core' ),
					'category-style-2'	=> esc_html__( 'Style 2', 'matjar-core' ),
					'category-style-3'	=> esc_html__( 'Style 3', 'matjar-core' ),
				],
                'default' 	=> 'category-style-1',
				'condition' => [
					'layout'	=> [ 'banner-categories', 'only-categories' ],
				],
            ]
        );
		$this->add_control(
			'show_count',
			[
				'label' 	=> esc_html__( 'Show Count', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' => [
					'layout'	=> [ 'banner-categories', 'only-categories' ],
				],
			]
		);
		$this->add_control(
            'banner_style',
            [
                'label' 	=> esc_html__( 'Banner Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'banner_single_image'	=> esc_html__( 'Banner Single Image', 'matjar-core' ),
					'banner_slider'			=> esc_html__( 'Banner Slider', 'matjar-core' ),
				],
                'default' 	=> 'banner_single_image',
				'condition' => [
					'layout'	=> [ 'banner-products','banner-categories' ],
				],
                'description' 	=> esc_html__( 'Select banner style. Only single image banner or multiple images banner with slider.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'banner_image',
			[
				'label'     => esc_html__( 'Banner Single Image', 'matjar-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'layout'		=> [ 'banner-products','banner-categories' ],
					'banner_style'	=> [ 'banner_single_image' ],
				],
				'description'	=> esc_html__( 'Single image banner', 'matjar-core' )
			]
		);
		$this->add_control(
			'banner_images',
			[
				'label'     => esc_html__( 'Banner Slider Images', 'matjar-core' ),
				'type'      => Controls_Manager::GALLERY,				
				'condition' => [
					'layout'		=> [ 'banner-products','banner-categories' ],
					'banner_style'	=> [ 'banner_slider' ],
				],
				'description' 	=> esc_html__( 'Banner slider images', 'matjar-core' )
			]
		);
		$this->add_control(
			'box_color',
			[
				'label'     	=> esc_html__( 'Box Color', 'matjar-core' ),
				'type'      	=> Controls_Manager::COLOR,
				'default' 		=> matjar_get_primary_color(),
				'description'	=> esc_html__( 'Set unique color of this box', 'matjar-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title h3,{{WRAPPER}} .sub-categories a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-inner' => 'border-top: 2px solid {{VALUE}}',
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
				
            ]
        );
		$this->add_control(
            'parent_category',
            [
                'label' 		=> esc_html__( 'Parent Category', 'matjar-core' ),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_taxonomies',
				'render'		=> 'matjar_elementor_render_taxonomies',
				'taxonomy'		=> array('product_cat'),
				'multiple'		=> false,
				'label_block'	=> true,
                'description' 	=> esc_html__( 'Each category will be a sub category of this category. This option is available when the specific Categories option is empty.', 'matjar-core' ),
            ]
        );		
		$this->add_control(
            'exclude_categories',
            [
                'label'			=> esc_html__( 'Exclude Category', 'matjar-core' ),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_taxonomies',
				'render'		=> 'matjar_elementor_render_taxonomies',
				'taxonomy'		=> array('product_cat'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Select specific categories.', 'matjar-core' ),
				
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
				'condition' => [
					'layout'	=> [ 'banner-products', 'only-products' ],
				],
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Number Of Products', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 8,
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
		$settings['id'] 	= matjar_uniqid('product-with-categories-box-');
		$class				= array( 'matjar-element', 'products-and-categories-box', 'woocommerce' );
		$class[]			= $hide_action_button ? 'hide-action-btn' : '' ;
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$class[]			= $layout;
		
		$settings['cat_title_link']	= '';
		
		$cat_query_args = array(
			'taxonomy'		=> 'product_cat',
			'number'		=> $settings['limit'],
			'orderby'		=> $orderby,
			'order'			=> $order,
			'hide_empty'	=> 1,
		);
		
		if( empty( $categories ) && empty( $parent_category ) ){
			$cat_query_args['parent'] = 0;
		}
		$ids = array();
		
		if ( ! empty( $settings['categories'] ) ) {
			$cat_query_args['include'] 	= $settings['categories'];
			$cat_query_args['orderby'] = 'include';
			unset($cat_query_args['order']);
			$term 						= get_term_by( 'id',(int)$settings['categories'][0], 'product_cat' );
			
			if( ! empty( $term ) ):
				$settings['cat_title_link'] = get_term_link($term);;
			endif;
		}
		
		if ( ! empty( $settings['exclude_categories'] ) ) {
			$cat_query_args['exclude'] = $settings['exclude_categories'];			
		}
		
		if ( ! empty( $parent_category ) && empty( $categories ) ) {
			$cat_query_args['parent'] 	= (int)$parent_category;	
			$settings['categories']		= (int)$parent_category;
			$term 						= get_term_by( 'id',(int)$parent_category, 'product_cat' );
			
			if( ! empty( $term ) ):
				$settings['cat_title_link'] = get_term_link($term);;
			endif;
		}
		
		$product_categories 	= get_terms( $cat_query_args );					
		$banner_unique_id 		= matjar_uniqid( 'section-banner-' );
		
		if( 'banner_slider' == $banner_style ){			
			$owl_data	= array(
				'slider_loop'				=> true,
				'slider_autoplay' 			=> true,
				'slider_center' 			=> false,
				'slider_nav'				=> false,
				'slider_dots'				=> true,
				'slider_autoHeight'			=> false,
				'rs_extra_large' 			=> 1,
				'rs_large' 					=> 1,
				'rs_medium' 				=> 1,
				'rs_small' 					=> 1,
				'rs_extra_small' 			=> 1,
			);			
			$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data );			
			$settings['banner_owl_options']	= wp_json_encode( $slider_data );
		}
		
		$query_args			= matjar_get_products( $data_source, $settings );		
		$the_query			= new WP_Query( $query_args );		
		$settings['query']	= $the_query;		
		
		matjar_set_loop_prop( 'product-style', 'product-style-2' );				
		matjar_set_loop_prop( 'name','matjar-carousel' );
		matjar_set_loop_prop( 'product-countdown', 0 );
		matjar_set_loop_prop( 'products_view','grid-view' );
		matjar_set_loop_prop( 'sale-product-label-after-price', 'on-product-image' );
		$owl_data				= array(
			'slider_loop'			=> $slider_loop ? true : false,
			'slider_autoplay' 		=> $slider_autoplay ? true : false,
			'slider_center' 		=> $slider_center ? true : false,
			'slider_nav'			=> $slider_nav ? true : false,
			'slider_dots'			=> false,
			'slider_autoHeight'		=> false,
			'rs_extra_large' 		=> $slider_columns,
			'rs_large' 				=> $slider_columns,
			'rs_medium' 			=> $slider_columns_tablet,
			'rs_small' 				=> $slider_columns_mobile,
			'rs_extra_small' 		=> $slider_columns_mobile,
		);
		$unique_id 			= matjar_uniqid( 'section' );
		$slider_data 		= shortcode_atts( matjar_slider_options(), $owl_data );
			
		matjar_set_loop_prop( 'unique_id', $unique_id );
		matjar_set_loop_prop( 'products-columns', $slider_columns );
		matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
		matjar_set_loop_prop( 'rs_large', $slider_columns );
		matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
		matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
		$cat_section_unique_id 	= matjar_uniqid( 'section-cat-' );
		
		$settings['owl_options']	= wp_json_encode( $slider_data );
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
		$settings['class'] 				= implode(' ',array_filter($class));
		$settings['product_categories'] = $product_categories;
		$settings['banner_id'] 			= $banner_unique_id;
		$settings['cat_section_id'] 	= $cat_section_unique_id;
		$settings['rows'] 				= 2;
		$settings['slider_class'] 	= 'matjar-carousel owl-carousel'; 
		$settings['slider_class'] 	.= ' grid-col-xl-'.$slider_columns;
		$settings['slider_class'] 	.= ' grid-col-lg-'.$slider_columns;
		$settings['slider_class'] 	.= ' grid-col-md-'.$slider_columns_tablet;
		$settings['slider_class'] 	.= ' grid-col-sm-'.$slider_columns_mobile;
		$settings['slider_class'] 	.= ' grid-col-'.$slider_columns_mobile;
		if( empty( $product_categories ) ){
			esc_html_e('No categories were found matching your selection', 'matjar-core' );
		} else{
			matjar_get_pl_templates( 'elements-widgets/products-and-categories-box/'.$layout, $settings );
		}
	}
}
$widgets_manager->register(new Matjar_Elementor_ProductsAndCategoriesBox() );