<?php
/*
Element: Newsletter
*/
use Elementor\Controls_Manager;
class Matjar_Elementor_Newsletter extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_newsletter';
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
        return esc_html__( 'Newsletter', 'matjar-core' );
    }

    /**
     * Get widget icon.
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-mailchimp';
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
            'title',
            [
                'label' 	=> esc_html__('Title', 'matjar-core'),
                'type' 		=> Controls_Manager::TEXT,
            ]
        );
		$this->add_control(
            'subscribe_form_style',
            [
                'label'		=> esc_html__( 'Form Style', 'matjar-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'overlay-form'	=> esc_html__( 'Overlay Form', 'matjar-core' ),
					'simple-form'	=> esc_html__( 'Simple Form', 'matjar-core' ),
				],
                'default'	=> 'overlay-form',
            ]
        );
		$this->add_control(
            'subscribe_form_shape',
            [
                'label'		=> esc_html__( 'Form Field Shape', 'matjar-core' ),
                'type'		=> Controls_Manager::SELECT,
                'options' 	=> [
					'shape-round'	=> esc_html__( 'Round', 'matjar-core' ),
					'shape-square'	=> esc_html__( 'Square', 'matjar-core' ),
				],
                'default'	=> 'shape-round',
            ]
        );

		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings	= $this->get_settings();
		$class		= array( 'matjar-element', 'matjar-newsletter' );
		$class[]	= $settings['subscribe_form_style'];
		$class[]	= $settings['subscribe_form_shape'];
		
		
		$settings['class']	= implode( ' ', $class );
		
		matjar_get_pl_templates( 'elements-widgets/newsletter', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_Newsletter());