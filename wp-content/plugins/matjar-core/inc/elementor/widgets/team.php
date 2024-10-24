<?php
/*
Element: Team
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
class Matjar_Elementor_Team extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_team';
    }

	/**
     * Get widget title.
     *
     * Retrieve Team widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Team', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Team widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-person';
    }
	
	/**
     * Register Team widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$image_sizes 		= matjar_get_all_image_sizes(true);
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );		
		$this->add_control(
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'image-top-with-box'	=> esc_html__( 'Image Top With Box', 'matjar-core' ),
					'image-top-with-box-2'	=> esc_html__( 'Image Top With Box 2', 'matjar-core' ),
					'image-middle-swap-box'	=> esc_html__( 'Image Middle With Swap Box', 'matjar-core' ),
					'image-top-botton-info'	=> esc_html__( 'Image Top With Bottom Info', 'matjar-core' ),
					'image-bottom-overlay'	=> esc_html__( 'Image With Bottom Overlay', 'matjar-core' ),
				],
                'default' 		=> 'image-top-with-box',
				'description'	=> esc_html__( 'Select style.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'img_size',
            [
                'label' 		=> esc_html__( 'Member Avatar Image size', 'matjar-core' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> $image_sizes,
                'default'		=> 'medium',
				'description'	=> esc_html__( 'Select image size.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'bg_color',
            [
                'label'			=> esc_html__( 'Background Color', 'matjar-core' ),
                'type'			=> Controls_Manager::COLOR,
                'default'		=> '#f8f8f8',
				'condition' 	=> [
					'style!' => [ 'image-top-botton-info' ],
				],
				'selectors' => [
					'{{WRAPPER}} .member-info, {{WRAPPER}} .flip-front,{{WRAPPER}} .image-bottom-overlay .matjar-team-member .member-info::before,{{WRAPPER}} .image-bottom-overlay .matjar-team-member .member-info::after' => 'background-color: {{VALUE}}',
				],
            ]
        );
		$this->add_control(
            'color',
            [
                'label' 	=> esc_html__( 'Color', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'inherit'	=> esc_html__( 'Inherit', 'matjar-core' ),
					'light'		=> esc_html__( 'Light', 'matjar-core' ),
					'dark'		=> esc_html__( 'Dark', 'matjar-core' ),
				],
                'default' 		=> 'dark',				
            ]
        );
		$this->add_control(
            'hover_bg_color',
            [
                'label' 	=> esc_html__( 'Hover Background Color', 'matjar-core' ),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> matjar_get_primary_color(),
				'condition'	=> [
					'style' => [ 'image-top-with-box-2' ],
				],
            ]
        );
		$this->add_control(
            'hover_color',
            [
                'label' 	=> esc_html__( 'Hover Color', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'inherit'	=> esc_html__( 'Inherit', 'matjar-core' ),
					'light'		=> esc_html__( 'Light', 'matjar-core' ),
					'dark'	=> esc_html__( 'Dark', 'matjar-core' ),
				],
                'default' 		=> 'light',
				'condition' 	=> [
					'style' => [ 'image-top-with-box-2', 'image-bottom-overlay' ],
				],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_tab',
			array(
				'label'     => esc_html__( 'Member', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		
		$repeater = new Repeater();		
		$repeater->add_control(
			'name',
			[
				'label' 		=> esc_html__( 'Name', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter member name', 'matjar-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label' 		=> esc_html__( 'Designation', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter member designation', 'matjar-core' ),
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' 		=> esc_html__( 'Member Avatar', 'matjar-core' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
				'description'	=> esc_html__( 'Select image from media library.', 'matjar-core' ),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' 		=> esc_html__( 'Description', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> '',
				'placeholder'	=> esc_html__( 'Enter member bio', 'matjar-core' ),
				'description' 	=> esc_html__( 'You can add some member bio here.', 'matjar-core' )
			]
		);
		$repeater->add_control(
			'facebook',
			[
				'label' 		=> esc_html__( 'Facebook link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'twitter',
			[
				'label' 		=> esc_html__( 'Twitter link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label' 		=> esc_html__( 'Linkedin link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'skype',
			[
				'label' 		=> esc_html__( 'Skype link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'instagram',
			[
				'label' 		=> esc_html__( 'Instagram link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'youtube',
			[
				'label' 		=> esc_html__( 'Youtube Link', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
			]
		);
		
		$this->add_control(
            'team_members',
            [
                'label' 	=> esc_html__( 'Team Members', 'matjar-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'name' 			=> 'John',
						'designation' 	=> 'CEO',
						'description' 	=> 'Lorem ipsum dolor sit amet, adipiscing . Nulla cursus eu odio lacinia, sed magna fermentum. Interdum malesuada.',
						'facebook' 		=> '#',
						'twitter' 		=> '#',
						'linkedin' 		=> '#',
						'skype' 		=> '#',
					],
					[
						'name' 			=> 'Smith',
						'designation' 	=> 'CEO',
						'description' 	=> 'Lorem ipsum dolor sit amet, adipiscing . Nulla cursus eu odio lacinia, sed magna fermentum. Interdum malesuada.',
						'facebook' 		=> '#',
						'twitter' 		=> '#',
						'linkedin' 		=> '#',
						'skype' 		=> '#',
					],
					[
						'name' 			=> 'John',
						'designation' 	=> 'Manager',
						'description' 	=> 'Lorem ipsum dolor sit amet, adipiscing . Nulla cursus eu odio lacinia, sed magna fermentum. Interdum malesuada.',
						'facebook' 		=> '#',
						'twitter' 		=> '#',
						'linkedin' 		=> '#',
						'skype' 		=> '#',
					],
				],
				'title_field' => '{{{ name }}}',
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
				'default' 			=> '4',
				'tablet_default' 	=> '3',
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
			'slider_columns_mobile' => 1,
		]);
		extract( $settings );
		$settings['id'] 	= matjar_uniqid('matjar-team-');
		$class				= array( 'row', 'matjar-element', 'matjar-team', $style );
		$settings['class']	= implode( ' ', $class );
		$member_class 		= array();
		
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
		$settings['slider_data']	= json_encode( shortcode_atts( matjar_slider_options(), $owl_data ) );
		$settings['slider_class'] 	= 'matjar-carousel';
		$settings['slider_class'] 	.= ' owl-carousel';
		$settings['slider_class'] 	.= ' grid-col-lg-' .$slider_columns;
		$settings['slider_class'] 	.= ' grid-col-md-' .$slider_columns_tablet;
		$settings['slider_class'] 	.= ' grid-col-' .$slider_columns_mobile;
		$settings['owl_options'] 	= wp_json_encode( $slider_data );
		$member_class[]				= 'color-scheme-' .$color;
		$member_class[]				= ( $style == 'image-top-with-box-2' || $style == 'image-bottom-overlay' ) ? 'hover-color-scheme-'.$hover_color : '';
		$settings['member_class'] 		= implode(' ', array_filter( $member_class ) );
		matjar_get_pl_templates( 'elements-widgets/team', $settings );
	}
}

$widgets_manager->register( new Matjar_Elementor_Team() );