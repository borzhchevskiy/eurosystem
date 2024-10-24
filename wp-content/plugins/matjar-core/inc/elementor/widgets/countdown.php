<?php
/*
Element: Countdown
*/
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
class Matjar_Elementor_Countdown extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_countdown';
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
        return esc_html__( 'Countdown Timer', 'matjar-core' );
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
        return 'matjar-icon eicon-countdown';
    }
	
	public function get_script_depends() {
       return [ 'countdown' ];
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
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'align',
            [
                'label' 	=> esc_html__('Alignment', 'matjar-core'),
                'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> $this->matjar_alignment_options(),
				'default'	=> 'center',
            ]
		);
		$this->add_control(
            'input_datetime',
            [
                'label'			=> esc_html__('Date', 'matjar-core'),
                'type'			=> Controls_Manager::DATE_TIME,
				'default'		=> date( 'Y-m-d', strtotime('+10 day') ),
				'picker_options'=> [ 'dateFormat' => 'Y-m-d', 'enableTime' => false ],
            ]
        );
		$this->end_controls_section();
		
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'Title', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'box_border_style',
            [
                'label' 	=> esc_html__('Box Border Style', 'matjar-core'),
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
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'border-style: {{VALUE}};',
                ],
            ]
		);
		$this->add_responsive_control(
            'box_border_width',
            [
                'label' 	=> esc_html__('Border Width', 'matjar-core'),
                'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'border-width: {{SIZE}}px;',
                ],
            ]
        );
		$this->add_control(
            'box_border_color',
            [
                'label' 	=> esc_html__('Border Color', 'matjar-core'),
                'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'border-color: {{VALUE}};',
                ],
				
            ]
		);
		
		$this->add_control(
            'box_background_color',
            [
                'label' 	=> esc_html__('Background Color', 'matjar-core'),
                'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'background-color: {{VALUE}};',
                ],
				
            ]
		);
		$this->add_responsive_control(
            'box_size',
            [
                'label' 	=> esc_html__('Box Size', 'matjar-core'),
               'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'min-width: {{SIZE}}px; min-height: {{SIZE}}px;',
                ],
            ]
        );
		$this->add_responsive_control(
            'box_radius',
            [
                'label' 	=> esc_html__('Box Radius', 'matjar-core'),
                'label_block'	=> true,
				'type'			=> Controls_Manager::SLIDER,
				'range'			=> [ 'px' => [ 'min' => 0, 'max' => 500 ] ],
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );
		
		$this->add_control(
            'number_color',
            [
                'label' 	=> esc_html__('Number Color', 'matjar-core'),
                'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span' => 'color: {{VALUE}};',
                ],
				
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_number_typography',
				'label'    => esc_html__( 'Counter Number', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span',
			]
		);
		
		$this->add_control(
            'text_color',
            [
                'label' 	=> esc_html__('Text Color', 'matjar-core'),
                'type'      => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span span' => 'color: {{VALUE}};',
                ],
				
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'counter_text_typography',
				'label'    => esc_html__( 'Counter Text', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .matjar-countdown .matjar-countdown-timer > span span',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 				= matjar_uniqid('matjar-info-box-');
		$class							= array('matjar-element', 'matjar-countdown', 'countdown-simple' , 'text-'.$align);
		$settings['class']				= implode( ' ', $class );	
		$settings['countdown_style'] 	= 'countdown-box';
		$settings['timezone'] 			= matjar_timezone_string();
		$settings['date'] 				= strtotime($input_datetime)+ ( 24 * 60 * 60);
		matjar_get_pl_templates( 'elements-widgets/countdown', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Countdown());