<?php
/*
Element: Button
*/

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

class Matjar_Elementor_Button extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar-button';
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
        return esc_html__( 'Button', 'matjar-core' );
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
        return 'matjar-icon eicon-button';
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
            'matjar_button_section',
            [
                'label'		=> esc_html__( 'General', 'matjar-core' ),
            ]
        );
		
		$this->add_control(
            'text',
            [
                'label' 		=> esc_html__('Button Text', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'default'		=> esc_html__('Click here', 'matjar-core'),
				'placeholder' 	=> esc_html__('Button text here', 'matjar-core'),
            ]
        );
		
		$this->add_control(
			'button_link',
			[
				'label'	 	 	=> esc_html__( 'Link', 'matjar-core' ),
				'type' 		 	=> Controls_Manager::URL,
				'dynamic' 	 	=> [
					'active' => true,
				],
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'matjar-core' ),
				'default' 	 	=> [
					'url'	=> '#',
				],
			]
		);
		
		$this->add_responsive_control(
			'align',
			[
				'label' 	=> esc_html__( 'Alignment', 'matjar-core' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options'	=> $this->matjar_alignment_options(),
				'selectors'	=> [
                    '{{WRAPPER}} .matjar-button' => 'text-align: {{VALUE}};',
                ],
				'default' 	=> 'left',
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
                'default' 	=> 'left',
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
					'value'   => 'lnr lnr-chevron-right',
					'library' => 'linearicons-icons',
				],
				'condition' => [
					'button_icon' => 'yes'
				],
            ]
		);
		
		$this->end_controls_section();
		
		/**
		 * Title settings.
		 */
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Button', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'style',
            [
                'label' 	=> esc_html__('Style', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'flat'		=> esc_html__( 'Flat', 'matjar-core' ),
					'outline'	=> esc_html__( 'Outline', 'matjar-core' ),
					'link'	  	=> esc_html__( 'Link', 'matjar-core' ),
					'text'		=> esc_html__( 'Text', 'matjar-core' ),
				],
                'default' 	=> 'flat',
            ]
		);
		
		$this->add_control(
            'shape',
            [
                'label' 	=> esc_html__('Shape', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'square'	=> esc_html__( 'Square', 'matjar-core' ),
					'rounded'	=> esc_html__( 'Rounded', 'matjar-core' ),
					'round'		=> esc_html__( 'Round', 'matjar-core' ),
				],
                'default' 	=> 'square',
				'condition' => [
					'style' => [ 'flat','outline' ],
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
				'size_units'	=> [ 'px', '%', 'em' ],
				'selectors'		=> [
					'{{WRAPPER}} .matjar-button a.btn-style-flat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .matjar-button a.btn-style-outline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ 'flat','outline' ],
				],
			]
		);
		$this->add_control(
            'button_color',
            [
                'label' 	=> esc_html__('Button Color', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'default'	=> esc_html__( 'Default', 'matjar-core' ),
					'custom'	=> esc_html__( 'Custom', 'matjar-core' ),
				],
                'default' 	=> 'default',
            ]
		);
		$this->add_control(
            'select_custom_button_color',
            [
                'label' 	=> esc_html__('Select Button Color', 'matjar-core'),
                'type' 		=> Controls_Manager::HEADING,
                'condition' => [
					'button_color' => [ 'custom' ],
				],
            ]
		);
		$this->start_controls_tabs( 'custom_buttons_colors',
			[
				'condition' => [
					'button_color' => [ 'custom' ],
				]
			]
		);

        $this->start_controls_tab(
            'custom_buttons_colors_normal',
            [
                'label' => esc_html__( 'Normal', 'matjar-core' ),                
            ]
        );
		$this->add_control(
            'custom_btn_color',
            [
                'label'		=> esc_html__( 'Background Color', 'matjar-core' ),
                'type'		=> Controls_Manager::COLOR,
				'default'	=> matjar_get_primary_color(),
                'selectors' => [
					'{{WRAPPER}} .matjar-button .btn-style-flat, {{WRAPPER}} .matjar-button .btn-style-link:after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .matjar-button .btn-style-flat, {{WRAPPER}} .matjar-button .btn-style-outline' => 'border-color: {{VALUE}};',
                ],
				'condition' => [
					'style!' => [ 'text' ],
				]
            ]
        );
		$this->add_control(
            'button_custom_text_color',
            [
                'label'		=> esc_html__('Color', 'matjar-core'),
                'type' 		=> Controls_Manager::COLOR,
                'default'	=> '#333333',
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .button, {{WRAPPER}} .matjar-button .btn-style-text'	=> 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->start_controls_tab(
            'custom_buttons_colors_hover',
            [
                'label' 	=> esc_html__( 'Hover', 'matjar-core' ),
                'condition' => [
					'button_color' => [ 'custom' ],
				],
            ]
        );
		
		$this->add_control(
            'custom_btn_hover_color',
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
					'style!' => [ 'text' ],
				]
            ]
        );
		$this->add_control(
            'button_custom_text_color_hover',
            [
                'label' 	=> esc_html__('Color', 'matjar-core'),
				'type'		=> Controls_Manager::COLOR,
                'default'	=> '#333333',
                'selectors' => [
                    '{{WRAPPER}} .matjar-button .button:hover, {{WRAPPER}} .matjar-button .btn-style-text:hover'	=> 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();

        $this->end_controls_tabs();
		
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$icon_html 			= '';
		if( $settings['button_icon'] ) {			
			ob_start();
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
			$icon_html = ob_get_clean();
		}
		$settings['id'] 	= matjar_uniqid('matjar-button-');
		$settings['class'] 	= 'matjar-element matjar-button';
		
		$button_class			= array( );
		if( $style != 'text' ){
			$button_class[] = 'button';
		}
		$button_class[]			= 'btn-style-'.$style;
		if( 'flat' == $style || 'outline' == $style ){
			$button_class[]			= 'btn-shape-'.$shape;
		}
		$button_class[]				= 'btn-color-'.$settings['button_color'];
		$button_class[]				= !empty ( $settings['button_icon'] ) ? 'btn-icon-'.$settings['icon_alignment'] : '';
		$settings['button_class']	= implode(' ', array_filter( $button_class ) );
		$settings['icon_html'] 		= $icon_html;
		$settings['link_url'] 		= $settings['button_link']['url'];
		$settings['target'] 		= $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$settings['nofollow']		= $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';		
		matjar_get_pl_templates( 'elements-widgets/button', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Button());