<?php
/*
Element: Product Categories
*/
use Elementor\Controls_Manager;
use Elementor\Utils;
class Matjar_Elementor_Productcategories extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_product_categories';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Categories widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Categories', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Categories widget icon.
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
		return [ 'woocommerce', 'categories', 'product categories'];
	}
	
	/**
     * Register Product Categories widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= matjar_get_all_image_sizes(true);
		$matjar_product_cats = matjar_elementor_get_terms('product_cat',true);
		
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
				'default' 	=> esc_html__( 'Top Categories', 'matjar-core' ),
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
					'categories-default'					=> esc_html__( 'Default', 'matjar-core' ),
					'categories-sub-categories-box'			=> esc_html__( 'Categories and Sub Categories Box', 'matjar-core' ),
					'categories-sub-categories-vertical'	=> esc_html__( 'Categories and Sub Categories Vertical', 'matjar-core' ),
				],
                'default' 		=> 'categories-default',
				'description' 	=> esc_html__( 'Select style.', 'matjar-core' ),
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
					'style' => [ 'categories-default'],
				],
            ]
        );
		$this->add_control(
            'image_size',
            [
                'label' 	=> esc_html__( 'Image Size', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
                'default' 	=> 'shop_catalog',
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
            ]
        );
		$this->add_control(
            'parent_category',
            [
                'label' 	=> esc_html__( 'Parent Category', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '',
                'options' 	=> $matjar_product_cats,				
                'description' => esc_html__( 'Each category item will be a sub category of this category. This option is available when the specific Categories option is empty.', 'matjar-core' ),
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
                'description'	=> esc_html__( 'Exclude specific categories.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'number',
            [
                'label' 	=> esc_html__('Number of Categories', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> '6',
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'name'			=> esc_html__( 'Name', 'matjar-core' ),
					'slug'			=> esc_html__( 'Slug', 'matjar-core' ),
					'ID'			=> esc_html__( 'ID', 'matjar-core' ),
					'menu_order'	=> esc_html__( 'Sort Order', 'matjar-core' ),
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
					'DESC'	=> esc_html__( 'Descending', 'matjar-core' ),
					'ASC'	=> esc_html__( 'Ascending', 'matjar-core' ),
				],
				'default' 	=> 'DESC',
            ]
        );		
		$this->add_control(
			'show_child_of',
			[
				'label' 	=> esc_html__( 'Child Of', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
				'condition' => [
					'style!'	=> [ 'categories-sub-categories-box','categories-sub-categories-vertical' ],
				],
			]
		);
		$this->add_control(
			'hide_empty_categories',
			[
				'label' 	=> esc_html__( 'Hide Empty Categories', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->add_control(
			'show_count',
			[
				'label' 	=> esc_html__( 'Show Count', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
				'condition' => [
					'style'	=> [ 'categories-default'],
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
			'slider_columns_mobile' => 2,
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		
		$settings['id'] 			= matjar_uniqid('matjar-product-cat-');
		$column_class				= array();
		$class						= array( 'matjar-element', 'matjar-product-categories' );		 
		$class[]					= $style;
		$class[]					= 'layout-'.$layout;
		$class[]	 				= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] 			= implode(' ',array_filter( $class ) );
		$settings['show_count'] 			= $show_count ? true : false;
		$settings['show_view_more_button'] 	= $show_view_more_button ? true : false;
		$settings['view_all_btn']['url']	= 'href="'.wc_get_page_permalink( 'shop' ).'"';
		$settings['slider_class'] 			= 'row';
		$settings['section_class'] 			= '';		
		$settings['banner_layout'] 	= '';
		
		$query_args = array(
			'taxonomy'  	=> 'product_cat',
			'number'    	=> $settings['number'],
			'orderby'    	=> $settings['orderby'],
			'order'      	=> $settings['order'],
			'hide_empty' 	=> $hide_empty_categories,
		);
		$settings['args']		= $query_args; // Query for inner sub categories
		
		if( empty( $categories ) && empty( $parent_category ) ){
			$query_args['parent'] = 0;
		}
		
		$ids = array();
		if ( ! empty( $parent_category ) && empty( $categories ) ) {
			if( $style == 'categories-sub-categories-box' || $style == 'categories-sub-categories-vertical' ){				
				$query_args['parent'] = (int)$parent_category;
			} else {				
				if($show_child_of){
					$query_args['child_of'] = (int)$parent_category;
				}else{
					$query_args['parent'] = (int)$parent_category;
				}				
			}
						
			$term = get_term_by( 'id',(int)$parent_category, 'product_cat' );
			if( ! empty( $term ) ):
				$settings['view_all_btn']['url'] = 'href="'.get_term_link($term).'"';
			endif;
		}		
		
		if ( ! empty( $settings['exclude_categories'] ) ) {
			$query_args['exclude'] = $settings['exclude_categories'];			
		} 		
		
		$link_url = '';		
		if( !empty( $settings['view_more_button_link']['url']) ) {
			$link_url = matjar_elementor_get_url_data($settings['view_more_button_link']);			
		}
		
		if ( !empty( $settings['categories'] ) ) {			
			$query_args['include'] 		= $categories;			
			$term_link = get_term_link( (int)trim($categories[0]),'product_cat' );
			if ( !is_wp_error( $term_link ) ) {
				$settings['view_all_btn']['url'] 	= 'href="'.$term_link.'"';		
			}	
		}
		
		if( !empty($link_url['url']) ){
			$settings['view_all_btn'] 	= $link_url;
		}
		
		$product_categories 			= get_terms( $query_args );		
		$settings['product_categories'] = $product_categories;	
		if( 'grid' == $layout ){
			$column_class[] 	= 'col-lg-'. matjar_get_rs_grid_columns( $grid_columns );
			$column_class[] 	= 'col-md-'. matjar_get_rs_grid_columns( $grid_columns_tablet );
			$column_class[] 	= 'col-'. matjar_get_rs_grid_columns( $grid_columns_mobile );
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
			$settings['owl_options'] 	= wp_json_encode( $slider_data );
			$settings['slider_class'] 	= 'matjar-carousel owl-carousel';
			$settings['slider_class'] 	.= ' grid-col-xl-'.$slider_columns;
			$settings['slider_class'] 	.= ' grid-col-lg-'.$slider_columns;
			$settings['slider_class'] 	.= ' grid-col-md-'.$slider_columns_tablet;
			$settings['slider_class'] 	.= ' grid-col-sm-'.$slider_columns_mobile;
			$settings['slider_class'] 	.= ' grid-col-'.$slider_columns_mobile;
			$settings['section_class'] 	= 'row' ;
		}
		
		$settings['column_class']	= implode( ' ', array_filter( $column_class ) );
		matjar_get_pl_templates( 'elements-widgets/product-categories/'.$style, $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Productcategories());