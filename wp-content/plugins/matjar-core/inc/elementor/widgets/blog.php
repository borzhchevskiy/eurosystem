<?php
/*
Element: Blog
*/
use Elementor\Controls_Manager;

class Matjar_Elementor_Blog extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_blog';
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
        return esc_html__( 'Blog', 'matjar-core' );
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
		return [ 'blog', 'post'];
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
		return [ 'masonry', 'isotope' ];
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
            'blog_style',
            [
                'label' 	=> esc_html__( 'Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'blog-classic'		=> esc_html__( 'Blog Classic', 'matjar-core' ),
					'blog-listing'		=> esc_html__( 'Blog Listing', 'matjar-core' ),
					'blog-chess'		=> esc_html__( 'Blog Chess', 'matjar-core' ),
					'blog-grid'			=> esc_html__( 'Blog Grid', 'matjar-core' ),
				],
                'default' 		=> 'blog-classic',
				'description' 	=> esc_html__( 'Select style.', 'matjar-core' ),
            ]
        );		
		$this->add_control(
            'pagination',
            [
                'label' 	=> esc_html__( 'Products Pagination', 'matjar-core' ),
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
			'section_content_grid',
			array(
				'label'     => esc_html__( 'Grid Settings', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'blog_style' => 'blog-grid',
				),
			)
		);
		$this->add_control(
            'grid_layout',
            [
                'label' 	=> esc_html__( 'Grid Layout', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'simple-grid'	 => esc_html__( 'Simple', 'matjar-core' ),
					'masonry-grid'	 => esc_html__( 'Masonry', 'matjar-core' ),
				],
				'default' 	=> 'simple-grid',
				'condition' => [
					'blog_style' => 'blog-grid'
				],
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
				'default' 			=> '2',
				'tablet_default' 	=> '2',
				'mobile_default' 	=> '1',
				'condition' => [
					'blog_style' => 'blog-grid'
				],
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
                'label' 	=> esc_html__( 'Post Title', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'description' 	=> esc_html__( 'Show/hide blog post title.', 'matjar-core' ),
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
				'default' 	=>'0',
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
				'default' 	=> '1',
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
                'label' 	=> esc_html__( 'Show Post content', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 	=> '1',
				'description' 	=> esc_html__( 'Show/hide blog post content.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'blog_content',
            [
                'label' 	=> esc_html__( 'Post Content', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
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
					'blog_content' 		=> 'excerpt-content',
				],
            ]
        );
		$this->add_control(
            'read_more_btn',
            [
                'label' 	=> esc_html__( 'Read More Button', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'1'	=> esc_html__( 'Show', 'matjar-core' ),
					'0'	=> esc_html__( 'Hide', 'matjar-core' ),
				],
				'default' 		=> '1',
				'description'	=> esc_html__( 'Show/hide blog read more button.', 'matjar-core' ),
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
					'read-more-link'		=> esc_html__( 'Link', 'matjar-core' ),
					'read-more-button'		=> esc_html__( 'Button', 'matjar-core' ),
					'read-more-button-fill'	=> esc_html__( 'Button Fill', 'matjar-core' ),
				],
				'default' 	=> 'read-more-link',
				'condition' => [
					'read_more_btn' => '1'
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
		$default_atts		= $settings;
		$settings['id'] 	= matjar_uniqid('matjar-blog-');
		$class				= array( 'matjar-element', 'matjar-blog' );
		$settings['class']	= implode(' ',array_filter($class));
		// Pagination parameter
		if(is_home() || is_front_page()) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = get_query_var( 'paged' );
		}
		$settings['paged'] = $paged;
		
		$query_args  		= matjar_get_posts($settings);
		
		$the_query 			= new WP_Query( $query_args );
		$settings['query'] 	= $the_query;		
			
		$total   = $the_query->max_num_pages;
		$current = $paged;
		$base    = esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) );
		$format  = '?page=%#%';
		$show_pagination  = true;
		if ( $total <= 1 || $pagination == 'none' ) {
			$show_pagination  = false;
		}
		
		$settings['show_pagination'] 	= $show_pagination;
		$settings['total'] 				= $total;
		$settings['base'] 				= $base;
		$settings['current'] 			= $current;
		$settings['format'] 			= $format;
		$settings['attribute']			= wp_json_encode( array_intersect_key( $settings,matjar_default_blog_args() ) );
		matjar_set_loop_prop( 'name', 'posts-loop-shortcode' );
		
		matjar_set_loop_prop( 'blog-post-style', $blog_style );
		matjar_set_loop_prop( 'post-single-line-title', $post_single_line_title );
		matjar_set_loop_prop( 'post-meta', $post_meta );
		matjar_set_loop_prop( 'post-date', $post_date );
		matjar_set_loop_prop( 'post-category', $post_category );
		wp_enqueue_script( 'masonry' );
		if( 'blog-grid' == $blog_style ){			
			matjar_set_loop_prop( 'blog-grid-layout', $grid_layout );
			matjar_set_loop_prop( 'blog-grid-columns', $grid_columns );
			matjar_set_loop_prop( 'blog-grid-columns-tablet', $grid_columns_tablet );
			matjar_set_loop_prop( 'blog-grid-columns-mobile', $grid_columns_mobile );
		}		
		if( !empty( $specific_post_meta) ){
			matjar_set_loop_prop( 'specific-post-meta', $specific_post_meta );
		}
		matjar_set_loop_prop( 'show-blog-post-content', $show_blog_content );
		matjar_set_loop_prop( 'blog-post-content', $blog_content );
		matjar_set_loop_prop( 'blog-excerpt-length', $blog_excerpt_length );
		matjar_set_loop_prop( 'read-more-button', $read_more_btn);
		if(!$show_blog_content){
			matjar_set_loop_prop( 'read-more-button', 0);
		}else{
			matjar_set_loop_prop( 'read-more-button', $read_more_btn);
		}
		matjar_set_loop_prop( 'read-more-button-style', $read_more_btn_style );
		matjar_set_loop_prop( 'blog-custom-thumbnail-size', $image_size );
		matjar_set_loop_prop( 'blog-post-thumbnail', $blog_thumbnail );
		matjar_set_loop_prop( 'blog-post-title', $blog_title );		
		matjar_get_pl_templates( 'elements-widgets/blog', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Blog());