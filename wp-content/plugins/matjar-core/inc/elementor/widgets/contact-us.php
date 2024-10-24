<?php
/*
Element: Contact Us
*/
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
class Matjar_Elementor_Contactus extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_contactus';
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
        return esc_html__( 'Contact Us', 'matjar-core' );
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
        return 'matjar-icon eicon-form-horizontal';
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
		$form_list = matjar_get_posts_dropdown('wpcf7_contact_form',esc_html__('Select Contact Form','matjar-core'));
		$this->start_controls_section(
            'section_content_general',
            [
                'label' => esc_html__( 'General', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
				'default' 	=> esc_html__( 'Contact Us' , 'matjar-core'),
            ]
        );
		$this->add_control(
            'description',
            [
                'label' 	=> esc_html__('Description', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXTAREA,
            ]
        );
		$this->add_control(
            'form_id',
            [
                'label' 	=> esc_html__( 'Select Form', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> $form_list,
				'default'	=> ' ',
            ]
        );
		$this->add_control(
            'form_shape',
            [
                'label'		=> esc_html__( 'Form Field Shape', 'matjar-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'shape-round'	=> esc_html__( 'Round', 'matjar-core' ),
					'shape-square'	=> esc_html__( 'Square', 'matjar-core' ),
				],
                'default'	=> 'shape-square',
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
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .matjar-contact-us h3' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .matjar-contact-us h3',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'Description', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'matjar-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .matjar-contact-us .form-description' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'matjar-core' ),
				'selector' => '{{WRAPPER}} .matjar-contact-us .form-description',
			]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		$settings 			= $this->get_settings();
		$class				= array('matjar-element', 'matjar-contact-us');
		$class[]			= $settings['form_shape'];
		$settings['class']	= implode( ' ', $class );	
		matjar_get_pl_templates( 'elements-widgets/contact-us', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Contactus());