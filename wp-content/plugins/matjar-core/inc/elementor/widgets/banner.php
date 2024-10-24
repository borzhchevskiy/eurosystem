<?php
/*
Element: Banner
*/
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Icons_Manager;

class Matjar_Elementor_Banner extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar-banner';
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
        return esc_html__( 'Banner', 'matjar-core' );
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
        return 'matjar-icon eicon-banner';
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
		return [ 'ads', 'banner', 'offer'];
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
		
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
			'banner_image',
			[
				'label'     => esc_html__( 'Banner Image', 'matjar-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default' 	=> [
					'url'	=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'banner_image_size',
				'default'   => 'full',
				'separator' => 'none',
				'exclude'	=> ['custom'],
			]
		);
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
				'default'	=> esc_html__('Summer Sale', 'matjar-core'),
            ]
        );
		$this->add_control(
            'subtitle',
            [
                'label' 	=> esc_html__('Subtitle', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
				'default'	=> esc_html__('Min 20% Off', 'matjar-core'),
            ]
        );
		$this->add_control(
            'banner_content',
            [
                'label' 	=> esc_html__('Banner Content', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$this->add_control(
            'button_text',
            [
                'label' 	=> esc_html__('Button Text', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default'	=> esc_html__('Shop Now', 'matjar-core'),
            ]
        );
		$this->add_control(
			'button_icon',
			[
				'label'     => esc_html__( 'Add Icon', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 0,				
			]
		);
		
		$this->add_control(
            'icon_alignment',
            [
                'label' 	=> esc_html__('Icon Alignment', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'left'	=> esc_html__( 'Left', 'matjar-core' ),
					'right'	=> esc_html__( 'Right', 'matjar-core' ),
				],
                'default' 	=> 'right',
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);
		
		$this->add_control(
            'selected_icon',
            [
                'label' 	=> esc_html__('Icon', 'matjar-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);		
		$this->add_control(
			'banner_link',
			[
				'label' 		=> esc_html__( 'Banner Link', 'matjar-core' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'matjar-core' ),
				'default' 		=> [
					'url'		=> '#',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Banner Settings', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'banner_hover_effect',
            [
                'label'		=> esc_html__( 'Hover Style', 'matjar-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					''			=> esc_html__( 'None', 'matjar-core' ),
					'zoom-in'	=> esc_html__( 'Zoom In', 'matjar-core' ),
					'zoom-out'	=> esc_html__( 'Zoom Out', 'matjar-core' ),
				],
                'default'	=> 'zoom-out',
            ]
        );
		$this->add_control(
            'banner_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} .banner-wrapper' => 'background-color: {{VALUE}};'
                ],
            ]
        );
		$this->add_responsive_control(
            'banner_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'matjar-core'),
               'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		$this->add_responsive_control(
			'banner_padding',
			[
				'label'			=> esc_html__( 'Padding', 'matjar-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .matjar-banner .banner-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'banner_min_height',
			[
				'label'			=> esc_html__( 'Min Height', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'description' => esc_html__( 'Min height value of banner.', 'matjar-core' ),
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default'     => [
					'unit' => 'px',
					'size' => 200,
				],
				'range'       	=> [
					'px'  => [
						'step' => 1,
						'min'  => 0,
						'max'  => 600,
					],
					'rem' => array(
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					),
					'%'   => [
						'step' => 1,
						'min'  => 0,
						'max'  => 100,
					],
				],
				'selectors'		=> [
					'{{WRAPPER}} .banner-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'banner_max_height',
			[
				'label'       => esc_html__( 'Max Height', 'matjar-core' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Max height value of banner.', 'matjar-core' ),
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default'     => [
					'unit' => 'px',
				],
				'range'       => [
					'px' => [
						'step' => 1,
						'min'  => 0,
						'max'  => 600,
					],
				],
				'selectors'		=> [
					'{{WRAPPER}} .banner-wrapper, {{WRAPPER}} .banner-wrapper img' => 'max-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Title', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_color',
            [
                'label'		=> esc_html__( 'Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} .banner-title' => 'color: {{VALUE}};'
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .banner-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-title-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => esc_html__( 'Subtitle', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_style',
			[
				'label'   => esc_html__( 'Style', 'matjar-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default'    => esc_html__( 'Default', 'matjar-core' ),
					'background' => esc_html__( 'Background', 'matjar-core' ),
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			'subtitle_bg_color',
			[
				'label'     => esc_html__( 'Background color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> matjar_get_primary_color(), 
				'selectors' => [
					'{{WRAPPER}} .banner-subtitle-background .banner-subtitle' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'subtitle_style' => 'background',
				],
			]
		);
		$this->add_responsive_control(
			'banner_subtitle_bg_padding',
			[
				'label'			=> esc_html__( 'Padding', 'matjar-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'default' => [
                    'top'		=> '5',
					'right'		=> '5',
					'bottom'	=> '5',
					'left'		=> '5',
					'unit'		=> 'px',
                ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-subtitle-background .banner-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'subtitle_style' => 'background',
				],
			]
		);
		$this->add_control(
            'subtitle_color',
            [
                'label'		=> esc_html__( 'Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors'	=> [
                    '{{WRAPPER}} .banner-subtitle' => 'color: {{VALUE}};'
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .banner-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-subtitle-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'content_style_section',
			[
				'label' => esc_html__( 'Content', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'content_color',
            [
                'label'		=> esc_html__( 'Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .banner-content-text' => 'color: {{VALUE}};'
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'banner_content_typography',
				'label'    => esc_html__( 'Custom typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .banner-content-text',
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label'			=> esc_html__( 'Margin Bottom', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-content-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		
		/**
		 * Button settings.
		 */
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'button_style',
            [
                'label'		=> esc_html__('Style', 'matjar-core'),
                'type'		=> Controls_Manager::SELECT,
                'options'	=> [
					'flat'		=> esc_html__( 'Flat', 'matjar-core' ),
					'outline'	=> esc_html__( 'Outline', 'matjar-core' ),
					'link'		=> esc_html__( 'Link', 'matjar-core' ),
					'text'		=> esc_html__( 'Text', 'matjar-core' ),
				],
                'default'	=> 'flat',
            ]
        );
		$this->add_control(
            'button_shape',
            [
                'label'		=> esc_html__('Shape', 'matjar-core'),
                'type'		=> Controls_Manager::SELECT,
                'options'	=> [
					'square'	=> esc_html__( 'Square', 'matjar-core' ),
					'rounded'	=> esc_html__( 'Rounded', 'matjar-core' ),
					'round'		=> esc_html__( 'Round', 'matjar-core' ),
				],
                'default'	=> 'square',
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_text_typography',
				'label'    => esc_html__( 'Typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .matjar-button a',
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label'			=> esc_html__( 'Padding', 'matjar-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .matjar-button a.btn-style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .matjar-button a.btn-style-outline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => [ 'flat','outline' ],
				],
			]
		);		
		$this->add_responsive_control(
			'button_margin',
			[
				'label'			=> esc_html__( 'Margin Top', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-button' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'banner_buttons_colors' );

        $this->start_controls_tab(
            'banner_buttons_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'matjar-core' ),                
            ]
        );
		$this->add_control(
            'button_bg_color',
            [
                'label'		=> esc_html__( 'Background Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> matjar_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .btn-style-flat, {{WRAPPER}} .matjar-button .btn-style-link:after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .matjar-button .btn-style-flat, {{WRAPPER}} .matjar-button .btn-style-outline' => 'border-color: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'text' ],
				]
            ]
        );
		$this->add_control(
            'button_text_color',
            [
                'label'		=> esc_html__('Color', 'matjar-core'),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> matjar_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .button, {{WRAPPER}} .matjar-button .btn-style-text'	=> 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->start_controls_tab(
            'banner_buttons_colors_hover',
            [
                'label' => esc_html__( 'Hover', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'button_bg_hover_color',
            [
                'label'		=> esc_html__( 'Background Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> matjar_get_primary_color(),
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .btn-style-flat:hover, {{WRAPPER}} .matjar-button .btn-style-outline:hover, {{WRAPPER}} .matjar-button .btn-style-link:hover:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .matjar-button .btn-style-outline:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .matjar-button .btn-style-link:hover' => 'color: {{VALUE}};',
                ],
				'condition' => [
					'button_style!' => [ 'text' ],
				]
            ]
        );
		$this->add_control(
            'button_text_hover_color',
            [
                'label' 	=> esc_html__('Color', 'matjar-core'),
				'type'		=> Controls_Manager::COLOR,
                'default'	=> matjar_get_primary_inverse_color(),
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .button:hover, {{WRAPPER}} .matjar-button .btn-style-text:hover'	=> 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->end_controls_tabs();
		
		$this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'content_position_style_section',
			[
				'label' => esc_html__( 'Content Box', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'banner_content_bg_color',
            [
                'label'		=> esc_html__( 'Background', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,                
                'selectors' => [
                    '{{WRAPPER}} .banner-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'banner_content_width',
			[
				'label'			=> esc_html__( 'Width', 'matjar-core' ),
				'type'			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%', 'px' ],
				'range'			=> [
					'%' 	=> [ 'min' => 0, 'max' => 100 ],
					'px' 	=> [ 'min' => 0, 'max' => 1600, 'step' => 1 ], 
				],
				'default' 		=> [ 'unit' => '%', 'size' => 70 ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-content' => 'max-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'banner_content_padding',
			[
				'label'			=> esc_html__( 'Padding', 'matjar-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'box_border_style',
            [
                'label' 	=> esc_html__('Border Style', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'none'		=> esc_html__( 'None', 'matjar-core' ),
					'solid'		=> esc_html__( 'Solid', 'matjar-core' ),
					'dashed'	=> esc_html__( 'Dashed', 'matjar-core' ),
					'dotted'	=> esc_html__( 'Dotted', 'matjar-core' ),
					'double'	=> esc_html__( 'Double', 'matjar-core' ),
					'inset'		=> esc_html__( 'Inset', 'matjar-core' ),
					'outset'	=> esc_html__( 'Outset', 'matjar-core' ),			
				],
				'default'	=> 'none',
				'selectors' => [
                    '{{WRAPPER}} .banner-content' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_responsive_control(
			'box_border_width',
			[
				'label'			=> esc_html__( 'Border Width', 'matjar-core' ),
				'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border_style!' => [ 'none' ],
				],
			]
		);
		
		$this->add_responsive_control(
            'box_border_radius',
            [
                'label' 	=> esc_html__('Border Radius', 'matjar-core'),
               'type'			=> Controls_Manager::DIMENSIONS,
				'size_units'	=> [ 'px', 'rem', '%' ],
				'selectors'		=> [
					'{{WRAPPER}} .banner-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
            'box_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'matjar-core'),
                'type'      => Controls_Manager::COLOR,
				'condition' => [
					'box_border_style' => [ 'solid','dashed','dotted','double','inset','outset' ],
				],
				'selectors' => [
                    '{{WRAPPER}} .banner-content' => 'border-color: {{VALUE}};',
                ],
				
            ]
		);
		$this->add_responsive_control(
            'content_text_align',
            [
                'label'		=> esc_html__('Text Alignment', 'matjar-core'),
				'type' 		=> Controls_Manager::CHOOSE,
                'options' 	=> [
					'left' => [ 
						'title' => esc_html__('Left', 'matjar-core'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'matjar-core'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'matjar-core'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'matjar-core'),
						'icon' => 'eicon-text-align-justify',
					],
				],
                'default'	=> 'left',
				'selectors'		=> [
					'{{WRAPPER}} .matjar-banner .banner-content-wrap' => 'text-align: {{VALUE}};',
				],
            ]
        );
		
		$this->add_responsive_control(
            'content_horizontal_align',
            [
                'label'		=> esc_html__('Horizontal Alignment', 'matjar-core'),
                'type'		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'flex-start' => [
						'title' => esc_html__('Left', 'matjar-core'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'matjar-core'),
						'icon' 	=> 'eicon-h-align-center',
					],
					'flex-end' => [
						'title' => esc_html__('Right', 'matjar-core'),
						'icon' 	=> 'eicon-h-align-right',
					],
				],
                'default'	=> 'start',
				'selectors'		=> [
					'{{WRAPPER}} .matjar-banner .banner-content-wrap' => 'align-items: {{VALUE}};',
				],
            ]
        );
		
		$this->add_responsive_control(
            'content_vertical_align',
            [
                'label'		=> esc_html__('Vertical Alignment', 'matjar-core'),
				'type'		=> Controls_Manager::CHOOSE,
				'options' 	=> [
					'flex-start' => [ 
						'title' => esc_html__('Top', 'matjar-core'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__('Middle', 'matjar-core'),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__('Bottom', 'matjar-core'),
						'icon' => 'eicon-v-align-bottom',
					],
					'space-between' => [
						'title' => esc_html__('Justify', 'matjar-core'),
						'icon' => 'eicon-v-align-middle',
					],
				],
                'default' => 'start',
				'selectors'		=> [
					'{{WRAPPER}} .matjar-banner .banner-content-wrap' => 'justify-content: {{VALUE}};',
				],
            ]
        );
		
		$this->end_controls_section();		
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 	= matjar_uniqid('matjar-banner-');
		$class				= array( 'matjar-element', 'matjar-banner' );		 
		$class[]			= !empty( $banner_hover_effect ) ? 'banner-'.$banner_hover_effect : '';
			
		$settings['content'] 	= $banner_content;
		
		$button_class			= array( );
		if( $button_style != 'text' ){
			$button_class[] = 'button';
		}
		$button_class[]			= 'btn-style-'.$button_style;
		if( 'flat' == $button_style || 'outline' == $button_style ){
			$button_class[]			= 'btn-shape-'.$button_shape;
		}
		$button_class[]			= ( $button_icon ) ? 'btn-icon-'.$icon_alignment : '';
		$settings['button_class'] 	= implode(' ', array_filter( $button_class ) );
		
		$icon_html 			= '';
		if( $settings['button_icon'] ) {			
			ob_start();
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
			$icon_html = ob_get_clean();
		}
		
		$link_url 					= $settings['banner_link']['url'];
		$window_link_target 		= $settings['banner_link']['is_external'] ? '_blank' : '_self';
		
		$settings['link_target'] 	= $settings['banner_link']['is_external'] ? "_blank" : "_self";
		$settings['link_url'] 		= empty($link_url) ?  'javascript:voide();' : $link_url;
		
		$settings['icon_html'] 		= $icon_html;
		if( $button_icon && $icon_alignment == 'left' ){
			$settings['button_text'] = $icon_html .' '.$button_text;
		}
		
		if( $button_icon && $icon_alignment == 'right' ){
			$settings['button_text'] = $button_text.' '.$icon_html;
		}
		
		$link_on_box_title = '';		
		if( empty ( $settings['button_text'] ) && ! empty( $link_url) ){
			$link_on_box_title = ' onclick="window.open(\''.$link_url.'\',\''.$window_link_target.'\')"';
			$class[]	= 'wrap-link';
		}
		
		$settings['link_on_box_title'] 		= $link_on_box_title;
		$settings['class'] 			= implode(' ', array_filter( $class ) );
		
		$settings['image_src'] = '';
		if ( !empty( $settings['banner_image']['id'] ) ) {
			$settings['image_src'] = Group_Control_Image_Size::get_attachment_image_src($settings['banner_image']['id'], 'banner_image_size', $settings);
		} elseif( !empty( $settings['banner_image']['url'] ) ) {
			$settings['image_src'] = $settings['banner_image']['url'];
		}
		matjar_get_pl_templates( 'elements-widgets/banner', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Banner());