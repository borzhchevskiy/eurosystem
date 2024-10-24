<?php
/*
Element: Hot Deal Products
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_HotDealProducts extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_hot_deal_products';
    }

	/**
     * Get widget title.
     *
     * Retrieve Hot Deal Products widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Hot Deal Products', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Hot Deal Products widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-countdown';
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
		return [ 'woocommerce', 'hot deal', 'products','deal of the day' ];
	}
	
	/**
     * Register Hot Deal Products widget controls.
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
				'default' 	=> esc_html__( 'Hot Deals', 'matjar-core' ),
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
            'product_deal_style',
            [
                'label' 	=> esc_html__( 'Products Deal Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'simple'			=> esc_html__( 'Simple Deal', 'matjar-core' ),
					'deal-with-timer'	=> esc_html__( 'Deal With Timer', 'matjar-core' ),
				],
                'default' 		=> 'simple',
				'description' 	=> esc_html__( 'Select product deal style.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'deal_title',
            [
                'label' 	=> esc_html__('Deal title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__('Deal Off The Day', 'matjar-core'),
				'condition' => [
					'product_deal_style' => [ 'deal-with-timer' ],
				],
				'description' 	=> esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'deal_end_date',
            [
                'label' 	=> esc_html__('Deal End Date', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'condition' => [
					'product_deal_style' => [ 'deal-with-timer' ],
				],
				'description'	=> esc_html__( 'Enter deal end date like YYYY-MM-DD', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'hide_element',
            [
                'label' 	=> esc_html__('Hide Elements After Deal Ends.', 'matjar-core'),
                'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
				'condition' => [
					'product_deal_style' => [ 'deal-with-timer' ],
				],
				'description' 	=> esc_html__( 'Enter deal end date like YYYY-MM-DD', 'matjar-core' ),
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
		$this->add_control(
			'show_stock_progressbar',
			[
				'label' 	=> esc_html__( 'Show Progressbar', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
			'show_countdown',
			[
				'label' 	=> esc_html__( 'Show Countdown', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 'yes',
			]
		);
		$this->add_control(
			'highlighted_border',
			[
				'label' 	=> esc_html__( 'Highlighted with Border', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
			]
		);
		$this->add_control(
            'countdown_position',
            [
                'label' 	=> esc_html__( 'Countdown Position', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'on-product-image'		=> esc_html__( 'On Product Image', 'matjar-core' ),
					'after-product-price'	=> esc_html__( 'After Product Price', 'matjar-core' ),
				],
                'default' 		=> 'on-product-image',
				'description' 	=> esc_html__( 'Select product countdown display position.', 'matjar-core' ),
				'condition' 	=> [
					'show_countdown' => [ 'yes' ],
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
				'condition'		=> [
					'data_source!'	=> 'products',
				],
            ]
        );
		$this->add_control(
            'product_ids',
            [
                'label'			=> esc_html__('Specific Product Ids', 'matjar-core'),
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
		
		if( $hide_element && !empty( $deal_end_date ) && strtotime( $deal_end_date ) < time() ){
			return;
		}
		
		//Get Products
        global $woocommerce_loop, $wpdb;
		
		// Get products on sale
		$product_ids_raw = $wpdb->get_results(
		"SELECT posts.ID, posts.post_parent
		FROM `$wpdb->posts` posts
		INNER JOIN `$wpdb->postmeta` ON (posts.ID = `$wpdb->postmeta`.post_id)
		INNER JOIN `$wpdb->postmeta` AS mt1 ON (posts.ID = mt1.post_id)
		WHERE
			posts.post_status = 'publish'
			AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().") 
			GROUP BY posts.ID 
			ORDER BY posts.post_title");

		$product_ids_on_sale = array();

		foreach ( $product_ids_raw as $product_raw ) 
		{
			if(!empty($product_raw->post_parent))
			{
				$product_ids_on_sale[] = $product_raw->post_parent;
			}
			else
			{
				$product_ids_on_sale[] = $product_raw->ID;  
			}
		}
		$product_ids_on_sale = array_unique( $product_ids_on_sale );
		
		//Hot Deal products
		$query_args = array(
				'post_type'				=> 'product',
				'post_status'			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' 		=> $limit,
				'orderby' 			    => $orderby,
				'order' 				=> $order,
				'post__in'			    => array_merge( array( 0 ), $product_ids_on_sale ),
			);
		$meta_query			= WC()->query->get_meta_query();
		$tax_query   		= WC()->query->get_tax_query();	
		
		//Get Categories
		if( ! empty( $product_ids ) ):
			$product_ids_array 		= explode(',', $product_ids);
			$product_ids_array 		= array_map( 'trim', $product_ids_array );
			$query_args['post__in'] = $product_ids_array;
		endif;
		
		if( apply_filters( 'matjar_hotdeal_hide_outofstock_products', true ) ){
			$tax_query[] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				),
			);
		}
		
		if( ! empty( $categories ) ):
			$tax_query[] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);		
		endif;
		
		$query_args['meta_query']	= $meta_query;
		$query_args['tax_query']	= $tax_query;
		$the_query 					= new WP_Query( $query_args );		
		$settings['query'] 			= $the_query;		
		
		$settings['id'] 	= matjar_uniqid('matjar-hot-deal-');
		$class				= array( 'matjar-element', 'matjar-hot-deal-products', 'woocommerce' );
		$class[]			= ( 'horizontal' == $product_view_mode ) ? 'matjar-product-'.$product_view_mode : '';
		$class[]	 		= ( $highlighted_border ) ? 'highlighted-border' : '';
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		if( $product_style != 'default' ){
			matjar_set_loop_prop( 'product-style', $product_style );
		}
		if( 'product-style-3' != $product_style && 'icon' == $cart_button_style ){
			matjar_set_loop_prop( 'product-action-buttons-style', 'product-cart-icon' );
		}
		matjar_set_loop_prop( 'products_view', 'grid-view' );
		
		if( 'grid' == $layout ){
			matjar_set_loop_prop( 'products-columns', $grid_columns );
			matjar_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
			matjar_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
			wc_set_loop_prop( 'columns', $grid_columns );
			$settings['rows'] = 1;
		}else{
			$owl_data	= array(
				'slider_loop'				=> $slider_loop ? true : false,
				'slider_autoplay' 			=> $slider_autoplay ? true : false,
				'slider_center' 			=> $slider_center ? true : false,
				'slider_nav'				=> $slider_nav ? true : false,
				'slider_dots'				=> $slider_dots ? true : false,
				'slider_autoHeight'			=>  false,
				'rs_extra_large' 			=> $slider_columns,
				'rs_large' 					=> $slider_columns,
				'rs_medium' 				=> $slider_columns_tablet,
				'rs_small' 					=> $slider_columns_mobile,
				'rs_extra_small' 			=> $slider_columns_mobile,
			);
			$unique_id 		= matjar_uniqid( 'section-' );
			$slider_data 	= shortcode_atts( matjar_slider_options(), $owl_data );
			matjar_set_loop_prop( 'name','matjar-carousel');
			matjar_set_loop_prop( 'products-columns', $slider_columns );
			matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
			matjar_set_loop_prop( 'rs_large', $slider_columns );
			matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
			matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
			matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
			matjar_set_loop_prop( 'unique_id',$unique_id);
			matjar_set_loop_prop( 'slider_data',$slider_data);
			matjar_set_loop_prop( 'owl_options',wp_json_encode( $slider_data ) );
		}
		
		matjar_set_loop_prop( 'product-countdown', 0 );
		
		if( $show_countdown == 'yes' ){
			matjar_set_loop_prop( 'product-countdown', 1 );
			$class[]			= ( 'after-product-price' == $countdown_position || 'horizontal' == $product_view_mode ) ? 'after-product-price' : '';
		}
		
		if( $show_stock_progressbar ){
			matjar_set_loop_prop( 'products-stock-progressbar', 1 );
		}
		
		$settings['class'] 				= implode( ' ', array_filter( $class ) );	
		$settings['countdown_style'] 	= 'countdown-text';
		$settings['timezone'] 			= matjar_timezone_string();
		$settings['date'] 				= '';
		
		if( ! empty($deal_end_date ) && strtotime( $deal_end_date ) > time() ){
			$settings['date'] 				= strtotime($deal_end_date) + ( 24 * 60 * 60);
		}		
		
		matjar_get_pl_templates( 'elements-widgets/products-hot-deal/'.$product_deal_style, $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_HotDealProducts());