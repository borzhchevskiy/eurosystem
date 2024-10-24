<?php
/*
Element: Social Buttons
*/
use Elementor\Controls_Manager;
class Matjar_Elementor_SocialButton extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_social_buttons';
    }

	/**
     * Get widget title.
     *
     * Retrieve Social Buttons widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Social Buttons', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Social Buttons widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-social-icons';
    }
	
	/**
     * Register Social Buttons widget controls.
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
                'label' 		=> esc_html__('Title', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				'description' 	=> esc_html__( 'Enter social button type title.', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'social_type',
            [
                'label' 	=> esc_html__('Social Type', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'share'		=> esc_html__( 'Share', 'matjar-core' ),
					'profile'	=> esc_html__( 'Profile', 'matjar-core' ),
				],
				'default'	=> 'share',
            ]
		);
		$this->add_control(
            'social_style',
            [
                'label' 	=> esc_html__('Icons Style', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icons-default'			=> esc_html__( 'Default', 'matjar-core' ),
					'icons-colour'	    	=> esc_html__( 'Colour', 'matjar-core' ),
					'icons-bordered'		=> esc_html__( 'Bordered', 'matjar-core' ),
					'icons-fill-colour'		=> esc_html__( 'Fill Colour', 'matjar-core' ),
					'icons-theme-colour'	=> esc_html__( 'Theme Colour', 'matjar-core' ),
				],
				'default'	=> 'icons-default',
            ]
		);
		$this->add_control(
            'social_shape',
            [
                'label' 	=> esc_html__('Icons Shape', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icons-shape-circle'	=> esc_html__( 'Circle', 'matjar-core' ),
					'icons-shape-square'	=> esc_html__( 'Square', 'matjar-core' ),
				],
				'default'	=> 'icons-shape-circle',
            ]
		);
		$this->add_control(
            'social_icon_size',
            [
                'label' 	=> esc_html__('Icons Size', 'matjar-core'),
                'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'icons-size-default'	=> esc_html__( 'Default', 'matjar-core' ),
					'icons-size-small'	    => esc_html__( 'Small', 'matjar-core' ),
					'icons-size-large'	    => esc_html__( 'Large', 'matjar-core' ),
				],
				'default'	=> 'icons-size-default',
            ]
		);
		$this->add_control(
            'social_alignment',
            [
                'label' 	=> esc_html__('Alignment', 'matjar-core'),
                'type' 		=> Controls_Manager::CHOOSE,
				'options' 	=> $this->matjar_alignment_options(),
				'default'	=> 'left',
            ]
		);
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		$settings['id']		= matjar_uniqid('matjar-social-button-');
		$class				= array('matjar-element', 'matjar-social-button-wrap', 'matjar-social-buttons');
		$class[]			= 'text-'.$settings['social_alignment'];
		$settings['class']	= implode( ' ', $class );	
		matjar_get_pl_templates( 'elements-widgets/social-buttons', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_SocialButton());