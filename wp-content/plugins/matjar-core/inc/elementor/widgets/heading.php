<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

class Matjar_Elementor_Heading extends  Matjar_Elementor_Widget_Base{
    /**
     * Get widget name.
     * @return string Widget name.
     */
    public function get_name() {
        return 'matjar-heading';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Heading', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-heading';
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
		return [ 'heading', 'title' ];
	}
	
    /**
     * Register tabs widget controls.
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
		
		$this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__( 'Heading', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> esc_html__('Add Your Heading Text Here', 'matjar-core'),
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' 	=> esc_html__( 'Title HTML Tag', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
                    'h1' 	=> 'H1',
                    'h2' 	=> 'H2',
                    'h3' 	=> 'H3',
                    'h4' 	=> 'H4',
                    'h5' 	=> 'H5',
                    'h6' 	=> 'H6',
                    'div' 	=> 'div',
                    'span'	=> 'span',
                    'p' 	=> 'p',
                ],
                'default' 	=> 'h3',
            ]
        );
		
		$this->add_control(
            'sub_title',
            [
                'label' 	=> esc_html__('Sub Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__('Sub Title Text', 'matjar-core'),
            ]

		);  


        $this->add_control(
            'tagline',
            [
                'label' 	=> esc_html__('Tagline', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
				'default' 	=> esc_html__('Enter Tagline text here', 'matjar-core'),
            ]
        );
		
        $this->add_responsive_control(
            'title_align',
            [
                'label' 	=> esc_html__('Alignment', 'matjar-core'),
                'type' 		=> Controls_Manager::CHOOSE,
                'options' 	=> $this->matjar_alignment_options(),
                'default' 	=> 'center',
            ]
        );
		
		$this->add_responsive_control(
            'title_width',
            [
                'label' 	=> esc_html__('Title Width', 'matjar-core'),
				'type'			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range'			=> [ 
					'px' 	=> [ 'min' => 0, 'max' => 1600,'step' => 1 ], 
					'%' 	=> [ 'min' => 1,'max' => 100 ] 
				],
				'default' 		=> [ 'unit' => '%', 'size' => 100 ],
				'selectors'		=> [
					'{{WRAPPER}} .matjar-heading' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
            ]

		);
     
        $this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'title_style_section',
			[
				'label'	=> esc_html__( 'Title', 'matjar-core' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
            'title_separator',
            [
                'label' 	=> esc_html__('Separator', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'none'		=> esc_html__( 'None', 'matjar-core' ),
					'underline'	=> esc_html__( 'Underline', 'matjar-core' ),
					'line'		=> esc_html__( 'Line', 'matjar-core' ),
					'image'		=> esc_html__( 'Image', 'matjar-core' ),
				],
                'default'	=> 'none',
            ]

		);
		
		$this->add_control(
            'underline_color',
            [
                'label' 	=> esc_html__('Underline Color', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'default'	=> esc_html__( 'Default', 'matjar-core' ),
					'light'		=> esc_html__( 'Light', 'matjar-core' ),						
					'dark'		=> esc_html__( 'Dark', 'matjar-core' ),
				],
                'default' 	=> 'default',
				'condition' => [
					'title_separator' => [ 'underline' ],
				],
            ]

		);
		
		$this->add_control(
            'title_separator_position',
            [
                'label' 	=> esc_html__('Separator Position', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'between-heading'	=> esc_html__( 'Between Heading', 'matjar-core' ),
					'bottom-heading'	=> esc_html__( 'Bottom Heading', 'matjar-core' ),
				],
                'default' 	=> 'between-heading',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);
		
		$this->add_control(
            'separator_line_style',
            [
                'label' 	=> esc_html__('Line Style', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'solid'		=> esc_html__( 'Solid', 'matjar-core' ),
					'dashed'	=> esc_html__( 'Dashed', 'matjar-core' ),
					'dotted'	=> esc_html__( 'Dotted', 'matjar-core' ),
					'double'	=> esc_html__( 'Double', 'matjar-core' ),
					'inset'		=> esc_html__( 'Inset', 'matjar-core' ),
					'outset'	=> esc_html__( 'Outset', 'matjar-core' ),
				],
                'default' 	=> 'solid',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);
		
		$this->add_control(
            'separator_line_width',
            [
                'label' 	=> esc_html__('Line Width', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> '1',
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);
		
		$this->add_control(
            'separator_line_color',
            [
                'label' 	=> esc_html__('Line Color', 'matjar-core'),
                'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .separator-left,{{WRAPPER}} .separator-right' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'title_separator' => [ 'line' ],
				],
            ]

		);
		
		$this->add_control(
            'separator_image',
            [
                'label' 	=> esc_html__('Select Image', 'matjar-core'),
                'type' 		=> Controls_Manager::MEDIA,
				'condition' => [
					'title_separator' => [ 'image' ],
				],
            ]

		);
		
		$this->add_control(
            'separator_image_width',
            [
                'label' 	=> esc_html__('Image Width', 'matjar-core'),
				'type' 			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 1600 ] ],
				'label_block' 	=> true,
				'default' 		=> [
					'unit' 	=> 'px',
					'size' 	=> 150,
				],
				'selectors' => [
                    '{{WRAPPER}} .heading-wrap .image-separator img' => 'max-width: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'title_separator' => [ 'image' ],
				],
            ]

		);
		
		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-title' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .heading-title',
			]
		);
		
		$this->end_controls_section();
		
		/**
		 * Subtitle settings.
		 */
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => esc_html__( 'Subtitle', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .heading-subtitle',
			]
		);
		
		$this->end_controls_section();
		
		/**
		 * Tagline settings.
		 */
		$this->start_controls_section(
			'tagline_style_section',
			[
				'label' => esc_html__( 'Tagline', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'tagline_color',
			[
				'label'     => esc_html__( 'Color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .heading-tagline' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tagline_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .heading-tagline',
			]
		);
		
		$this->end_controls_section();
    }
	
	protected function render() {
		
		$settings = $this->get_settings();
		
		if( $settings['separator_image'] ){
			if ( isset( $settings['separator_image']['id'] ) && $settings['separator_image']['id'] ) {
				$separator_image_src 				= matjar_get_image_src($settings['separator_image']['id'],'full');
				$settings['separator_image_src']	= $separator_image_src;
			}
		}
		
		$settings['separator_class']	= ( 'underline' == $settings['title_separator'] && 'default' != $settings['underline_color'] ) ? ' color-scheme-'.$settings['underline_color'] : '';
		$settings['id'] 				= matjar_uniqid('matjar-header-');
		$settings['class']				= 'matjar-element matjar-heading text-'.$settings['title_align'].' separator-'.$settings['title_separator'].' separator-'.$settings['title_separator_position'];
		
		/* Dynamic Css */
		$title_css 							= array();
		$style_css 							= '';
		$title_css['separator'][] 			= ( !empty($settings['separator_line_style']) && 'underline' != $settings['title_separator'] )  ? 'border-bottom-style:'.$settings['separator_line_style'] : '';
		$title_css['separator'][] 			= ( !empty($settings['separator_line_style']) && 'underline' != $settings['title_separator'] ) ? 'border-bottom-width:'.$settings['separator_line_width'].'px' : '' ;
				
		if( ! empty( array_filter( $title_css['separator'] ) ) ){
			$style_css .= '#'.$settings['id'].' .separator-left,#'.$settings['id'].' .separator-right {';
			$style_css .=  implode('; ', array_filter($title_css['separator']) );
			$style_css .= '}';
		}
		
		if( \Elementor\Plugin::$instance->editor->is_edit_mode() ){
			echo '<style>'.esc_attr($style_css).'</style>';
		} else {
			matjar_add_custom_css( $style_css );
		}		
		matjar_get_pl_templates( 'elements-widgets/heading', $settings );		
	}

}
$widgets_manager->register(new Matjar_Elementor_Heading());