<?php
/*
Element: Blog Carousel
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_BlogCarousel extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_blog_carousel';
    }

	/**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blog Carousel', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-post-slider';
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
		return [ 'blog', 'post'];
	}
	
	/**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= matjar_get_all_image_sizes(true);
		$matjar_blog_cats = matjar_elementor_get_terms('category',true);
		
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 		=> esc_html__('Blog Title', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'description' 	=> esc_html__( 'Enter title.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'blog_view_mode',
            [
                'label' 	=> esc_html__( 'Blog View Mode', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'vertical'		=> esc_html__( 'Vertical', 'matjar-core' ),
					'horizontal'	=> esc_html__( 'Horizontal', 'matjar-core' ),
				],
				'default' 	=> 'vertical',				
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
            'categories',
            [
                'label'			=> esc_html__( 'Specific Category', 'matjar-core' ),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_taxonomies',
				'render'		=> 'matjar_elementor_render_taxonomies',
				'taxonomy'		=> array('category'),
				'multiple'		=> true,
				'label_block'	=> true,
                'description'	=> esc_html__( 'Select specific categories.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'exclude',
            [
                'label'			=> esc_html__('Exclude Post', 'matjar-core'),
                'type'			=> 'matjar_autocomplete',
				'search'		=> 'matjar_elementor_search_post',
				'render'		=> 'matjar_elementor_render_post',
				'post_type'		=> 'post',
				'multiple'		=> true,
				'label_block'	=> true,
				'description' 	=> esc_html__( 'Exclude some blog which you do not want to display.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'limit',
            [
                'label' 	=> esc_html__('Per Page', 'matjar-core'),
                'type' 		=> Controls_Manager::NUMBER,
				'default' 	=> 4,
            ]
        );
		$this->add_control(
            'orderby',
            [
                'label' 	=> esc_html__( 'Order By', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'date'   	=> esc_html__( 'Recent Posts', 'matjar-core' ),
					'rand'     	=> esc_html__( 'Random Posts', 'matjar-core' ),
					'modified' 	=> esc_html__( 'Last Modified Posts', 'matjar-core' ),
					'popular'  	=> esc_html__( 'Most Commented posts', 'matjar-core' ),
					'views'  	=> esc_html__( 'Most Viewed posts', 'matjar-core' ),
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
			'section_content_blog_settings',
			array(
				'label'     => esc_html__( 'Blog Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
            'blog_title',
            [
                'label' 		=> esc_html__( 'Post Title', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 		=> '1',
				'description'	=> esc_html__( 'Show/hide blog post title.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'post_single_line_title',
			[
				'label'     => esc_html__( 'Single Line Title', 'matjar-core' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'1'	=> esc_html__( 'Yes', 'matjar-core' ),
					'0'	=> esc_html__( 'No', 'matjar-core' ),
				],
				'default' 	=> '0',
				'condition' => [
					'blog_title' => '1',
				],
			]
		);
		$this->add_control(
			'post_date',
			[
				'label'     => esc_html__( 'Post Date', 'matjar-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '0',
			]
		);
		$this->add_control(
			'post_category',
			[
				'label'     => esc_html__( 'Post Categories', 'matjar-core' ),
				'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
			]
		);
		$this->add_control(
            'image_size',
            [
                'label' 	=> esc_html__( 'Banner Image Size', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $image_sizes,
				'default' 	=> 'full',
            ]
        );
		$this->add_control(
            'blog_thumbnail',
            [
                'label' 	=> esc_html__( 'Post Thumbnail', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					1	=> esc_html__( 'Show', 'matjar-core' ),
					0	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> 1,
				'description' 	=> esc_html__( 'Show/hide blog post thumbnail.', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'post_meta',
            [
                'label' 	=> esc_html__( 'Post Meta', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'description' 	=> esc_html__( 'Show/hide post meta.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'specific_post_meta',
            [
                'label' 	=> esc_html__( 'Post Meta', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT2,
                'options' 	=> [
					'post-author' 		=> esc_html__( 'Author', 'matjar-core' ),
                    'post-date' 		=> esc_html__( 'Date', 'matjar-core' ),
                    'post-category' 	=> esc_html__( 'Category', 'matjar-core' ),					
                    'post-tags' 		=> esc_html__( 'Tags', 'matjar-core' ),
					'post-comments' 	=> esc_html__( 'Comments', 'matjar-core' ),
					'post-views' 		=> esc_html__( 'Views', 'matjar-core' ),
					'post-rtime' 		=> esc_html__( 'Read Time', 'matjar-core' ),
					'post-share' 		=> esc_html__( 'Share', 'matjar-core' ),
					'post-edit' 		=> esc_html__( 'Edit', 'matjar-core' ),
				],
				'default' 	=> [ 'post-author', 'post-comments', 'post-share' ],
				'multiple' 	=> true,
				'condition' => [
					'post_meta' => '1',
				],
            ]
        );		
		$this->add_control(
            'show_blog_content',
            [
                'label' 		=> esc_html__( 'Show Post content', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 		=> '1',
				'description' 	=> esc_html__( 'Show/hide blog post content.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'blog_content',
            [
                'label' 		=> esc_html__( 'Post Content', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'excerpt-content'	=> esc_html__( 'Expert', 'matjar-core' ),
					'full-content'		=> esc_html__( 'Full', 'matjar-core' ),
				],
				'default' 	=> 'excerpt-content',
				'condition' => [
					'show_blog_content' => '1'
				],
            ]
        );
		$this->add_control(
            'blog_excerpt_length',
            [
                'label' 	=> esc_html__( 'Expert Length', 'matjar-core' ),
                'type' 		=> Controls_Manager::NUMBER,                
				'default' 	=> '30',
				'condition' => [
					'show_blog_content' => '1',
					'blog_content' => 'excerpt-content',
				],
            ]
        );
		$this->add_control(
            'read_more_btn',
            [
                'label' 		=> esc_html__( 'Read More Button', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 		=> '1',
				'description' 	=> esc_html__( 'Show/hide blog read more button.', 'matjar-core' ),
				'condition' 	=> [
					'show_blog_content' => '1',
				],
            ]
        );
		$this->add_control(
            'read_more_btn_style',
            [
                'label' 	=> esc_html__( 'Read More Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'read-more-link'	=> esc_html__( 'Link', 'matjar-core' ),
					'read-more-button'	=> esc_html__( 'Button', 'matjar-core' ),
					'read-more-button-fill'	=> esc_html__( 'Button Fill', 'matjar-core' ),
				],
				'default' 	=> 'read-more-link',
				'condition' => [
					'read_more_btn' => '1'
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
				'default' 			=> '2',
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
                'label' 		=> esc_html__( 'Navigation Position', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
					'side'		=> esc_html__( 'Side', 'matjar-core' ),
					'top'		=> esc_html__( 'Top', 'matjar-core' ),
				],
				'default' 		=> 'side',
				'condition' 	=> [
					'slider_nav'	=> 'yes'
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
			'slider_columns_mobile' => 1
		]);
		extract( $settings );
		
		$settings['id'] 	= matjar_uniqid('matjar-blog-carousel-');
		$class				= array( 'matjar-element', 'matjar-blog-carousel' );
		$class[]			= ( 'horizontal' == $blog_view_mode ) ? 'matjar-blog-'.$blog_view_mode : '';
		$class[]	 		= ( $slider_nav ) ? 'navigation-'.$navigation_position : '';
		$settings['class'] 	= implode( ' ', array_filter( $class ) );
		
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
		
		$slider_data 		= shortcode_atts( matjar_slider_options(), $owl_data );
			
		$query_args = array(
			'post_type'          	=> 'post',
			'post_status'        	=> array('publish'),
			'posts_per_page'     	=> $limit,
			'ignore_sticky_posts'	=> true,
		);
		
		
		if( !empty($categories) ){
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);			
		}
		
		$query_args['orderby'] = 'date';
		
		// Posts Order
		if( ! empty( $orderby ) ){

			// Random Posts
			if( $orderby == 'rand' ){
				$query_args['orderby'] = 'rand';
			}

			// Most Viewd posts
			elseif( $orderby == 'views'){
				$prefix = MATJAR_PREFIX;
				$query_args['orderby']  = 'meta_value_num';
				$query_args['meta_key'] = apply_filters( 'matjar_views_meta_field', $prefix.'views_count' );
			}

			// Popular Posts by comments
			elseif( $orderby == 'popular' ){
				$query_args['orderby'] = 'comment_count';
			}

			// Recent modified Posts
			elseif( $orderby == 'modified' ){
				$query_args['orderby'] = 'modified';
			}
		}
		
		$query_args['order'] = $order;
		
		// Exclude Posts
		if( ! empty( $exclude )){
			$exclude_blogs_array = explode( ',', $exclude );
			if( is_array( $exclude_blogs_array ) && !empty( $exclude_blogs_array ) ){
				$query_args['post__not_in'] = $exclude_blogs_array;		
			}
		}
		
		$the_query = new WP_Query( $query_args );
		$settings['query'] 			= $the_query; 
		
		matjar_set_loop_prop( 'name', 'posts-slider-shortcode' );
		matjar_set_loop_prop( 'post-single-line-title', $post_single_line_title);
		matjar_set_loop_prop( 'blog-post-style', 'blog-grid');
		matjar_set_loop_prop( 'post-date', $post_date);
		matjar_set_loop_prop( 'post-category', $post_category);
		matjar_set_loop_prop( 'post-meta', $post_meta);
		matjar_set_loop_prop( 'specific-post-meta', array( 'post-author', 'post-comments', 'post-share' ) );
		matjar_set_loop_prop( 'blog-grid-layout', 'simple-grid' );
		matjar_set_loop_prop( 'blog-grid-columns', $slider_columns );
		if( !empty( $specific_post_meta) ){
			matjar_set_loop_prop( 'specific-post-meta', $specific_post_meta );
		}
		matjar_set_loop_prop( 'show-blog-post-content', $show_blog_content );
		matjar_set_loop_prop( 'blog-post-content', $blog_content );
		matjar_set_loop_prop( 'blog-excerpt-length', $blog_excerpt_length );
		if( !$show_blog_content){
			$read_more_btn = 0;
		}
		matjar_set_loop_prop( 'read-more-button', $read_more_btn );
		matjar_set_loop_prop( 'read-more-button-style', $read_more_btn_style );
		matjar_set_loop_prop( 'blog-post-thumbnail', $blog_thumbnail);
		matjar_set_loop_prop( 'blog-custom-thumbnail-size', $image_size );
		matjar_set_loop_prop( 'blog-post-title', $blog_title );
		matjar_set_loop_prop( 'rs_extra_large', $slider_columns );
		matjar_set_loop_prop( 'rs_large', $slider_columns );
		matjar_set_loop_prop( 'rs_medium', $slider_columns_tablet );
		matjar_set_loop_prop( 'rs_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'rs_extra_small', $slider_columns_mobile );
		matjar_set_loop_prop( 'owl_options', wp_json_encode( $slider_data ) );
		
		matjar_get_pl_templates( 'elements-widgets/blog-carousel', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_BlogCarousel());