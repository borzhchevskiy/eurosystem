<?php
/*
Element: Product Custom Categories
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Utils;
class Matjar_Elementor_ProductCustomCategories extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar-custom-categories';
    }

	/**
     * Get widget title.
     *
     * Retrieve Product Custom Categories widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Product Custom Categories', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Product Custom Categories widget icon.
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
     * Register Product Custom Categories widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$matjar_product_cats = matjar_elementor_get_terms('product_cat',true);
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
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
            'category_style',
            [
                'label' 	=> esc_html__( 'Category Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'category-style-1'	=> esc_html__( 'Style 1', 'matjar-core' ),
					'category-style-2'	=> esc_html__( 'Style 2', 'matjar-core' ),
					'category-style-3'	=> esc_html__( 'Style 3', 'matjar-core' ),
					'category-style-4'	=> esc_html__( 'Style 4', 'matjar-core' ),
					'category-style-5'	=> esc_html__( 'Style 5', 'matjar-core' ),
				],
                'default' 	=> 'category-style-1',
            ]
        );
		$this->add_control(
			'show_cat_title',
			[
				'label' 	=> esc_html__( 'Show Category Title', 'matjar-core' ),
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
				'condition' 	=> [
					'show_cat_title' => 'yes',
					'category_style!' => 'category-style-5',
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
            'image_position',
            [
                'label' 	=> esc_html__( 'Image Position', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [ 'image-position-left' => esc_html__('Left','matjar-core'), 'image-position-right' => esc_html__('Right','matjar-core')],
                'default' 	=> 'image-position-left',
				'condition' 	=> [
					'category_style' => 'category-style-4'
				],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_category_style',
			array(
				'label'     => esc_html__( 'Box Background', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' 	=> [
					'category_style' => 'category-style-4'
				],
			)
		);
		$this->add_control(
			'box_bg_color',
			[
				'label'     => esc_html__( 'Background color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '', 
				'selectors' => [
					'{{WRAPPER}} .matjar-product-custom-categories .category-style-4 .product-wrapper' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'label'     => esc_html__( 'Border color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#e9e9e9', 
				'selectors' => [
					'{{WRAPPER}} .matjar-product-custom-categories .category-style-4 .product-wrapper' => 'border-color: {{VALUE}}',
				]				
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_custom_categories',
			array(
				'label'     => esc_html__( 'Custom Categories', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$repeater = new Repeater();
		$repeater->add_control(
			'custom_title',
			[
				'label' 	=> esc_html__( 'Custom Title', 'matjar-core' ),
				'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> '',
			]
		);
		$repeater->add_control(
			'cat_title',
			[
				'label' 		=> esc_html__( 'Title', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_html__( 'Cat Title', 'matjar-core' ),
			]
		);
		$repeater->add_control(
			'category',
			[
				'label' 		=> esc_html__( 'Select Category', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options'		=> $matjar_product_cats,
                'default' 		=> '',
				'description' 	=> esc_html__( 'Select category', 'matjar-core' ),
			]
		);
		$repeater->add_control(
			'cat_image',
			[
				'label'     => esc_html__( 'Image', 'matjar-core' ),
				'type'      => Controls_Manager::MEDIA,
				'description'	=> esc_html__( 'Upload category image.', 'matjar-core' ),
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);		
		$this->add_control(
            'category_list',
            [
                'label' 	=> esc_html__('Category','matjar-core'),
                'type' 		=> Controls_Manager::REPEATER,
                'fields' 	=> $repeater->get_controls(),
                'title_field' => '{{{ cat_title }}}',
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
					'7'	 	=> esc_html__( '7', 'matjar-core' ),
					'8'	 	=> esc_html__( '8', 'matjar-core' ),
					'9'	 	=> esc_html__( '9', 'matjar-core' ),
					'10' 	=> esc_html__( '10', 'matjar-core' ),
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
					'7'	 	=> esc_html__( '7', 'matjar-core' ),
					'8'	 	=> esc_html__( '8', 'matjar-core' ),
					'9'	 	=> esc_html__( '9', 'matjar-core' ),
					'10' 	=> esc_html__( '10', 'matjar-core' ),
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
		if ( empty( $settings['category_list'] ) ) {
			return;
		}
		$settings = wp_parse_args( $settings, [ 
			'slider_columns_tablet' => 3,
			'slider_columns_mobile' => 2,
			'grid_columns_tablet' => 3,
			'grid_columns_mobile' => 2
		]);
		extract( $settings );
		$settings['id'] 			= matjar_uniqid('matjar-cat-');
		$class						= array( 'matjar-element', 'matjar-product-custom-categories' );
		$settings['class'] 			= implode(' ', array_filter( $class ) );
		$column_class				= array();
		$image_size 	= 'woocommerce_thumbnail';
		$settings['image_position'] = isset( $image_position ) ? $image_position : '';
		$settings['slider_class'] 	= 'row';
		$settings['section_class'] 	= '';		
		$settings['banner_layout'] 	= '';
		
		if( $category_style == 'category-style-4' || $category_style == 'category-style-5' ){
			$image_size 	= 'woocommerce_gallery_thumbnail';
		}
		if( $category_style == 'category-style-5' ){
			$settings['show_count'] 	= false;
		}
		if( 'grid' == $layout ){
			$column_class[] 	= 'col-lg-'. matjar_get_rs_grid_columns( $grid_columns );
			$column_class[] 	= 'col-md-'. matjar_get_rs_grid_columns( $grid_columns_tablet );
			$column_class[] 	= 'col-'. matjar_get_rs_grid_columns( $grid_columns_mobile );
			wc_set_loop_prop( 'columns', $grid_columns );
			$settings['rows'] 		= 1;
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
		$results = array();
		foreach( $settings['category_list'] as $cat_data ){
			$data= array();
			$query_args = array(
							'taxonomy'  	=> 'product_cat',
							'number'    	=> 1,
							'include' => array( $cat_data['category'] )
						);
			$cat = get_terms( $query_args );			
			if( empty( $cat ) ) {
				continue;
			}
			if($hide_empty_categories && $cat[0]->count == 0 ){
				continue;
			}
			$thumbnail_id 				= get_term_meta( $cat[0]->term_id, 'thumbnail_id', true );
			$data['category_title'] 	= $cat[0]->name;
			$data['category_count'] 	= $cat[0]->count;
			$data['category_thumbnail'] = wp_get_attachment_image_src( $thumbnail_id, $image_size );
			$data['category_link'] 		= get_term_link( (int)$cat_data['category'], 'product_cat' );
			if( $cat_data['custom_title'] ){
				$data['category_title'] = $cat_data['cat_title'];				
			}
			$data['category_image'] = '';
			if( $cat_data['cat_image']['id'] ){
				$data['category_image'] = wp_get_attachment_image_src( $cat_data['cat_image']['id'] , $image_size );
				if( !empty( $data['category_image'] )){
					$data['category_image'] = $data['category_image'][0];
				}
			}elseif(!empty( $data['category_thumbnail'] ) ){
				$data['category_image'] = $data['category_thumbnail'][0];
			}
			elseif( $cat_data['cat_image']['url'] ){
				$data['category_image'] = $cat_data['cat_image']['url'];
			}
			
			$results[] = $data;
		}
		$settings['cutom_category'] = $results;		
		matjar_get_pl_templates( 'elements-widgets/woo-product-cutstom-category', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_ProductCustomCategories());