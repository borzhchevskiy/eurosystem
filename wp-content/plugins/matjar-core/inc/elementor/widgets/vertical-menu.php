<?php
/*
Element: Vertical Menu
*/
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
class Matjar_Elementor_VerticalMenu extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_vertical_menu';
    }

	/**
     * Get widget title.
     *
     * Retrieve Vertical Menu widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Vertical/Categories Menu', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve Vertical Menu widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-menu-bar';
    }
	
	/**
     * Register Vertical Menu widget controls.
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
				 'default' 		=> esc_html__( 'Shop By Categories', 'matjar-core'),
				 'description' 	=> esc_html__( 'Enter title.', 'matjar-core' ),
            ]
        );
		$this->add_control(
			'menu_icon',
			[
				'label'     => __( 'Add Icon', 'matjar-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',				
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
					'menu_icon' => 'yes'
				],
            ]
		);
		
		$this->add_control(
            'selected_icon',
            [
                'label' 	=> esc_html__('Icon', 'matjar-core'),
                'type' 		=> Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'jricon jricon-menu',
					'library' => 'matjar-icons',
				],
				'condition' => [
					'menu_icon' => 'yes'
				],
            ]
		);
		$this->end_controls_section();	
		
		/**
		 * Style settings.
		 */
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'Menu Title', 'matjar-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'menu_title_color',
            [
                'label' 	=> esc_html__( 'Color', 'matjar-core' ),
                'type' 		=> Controls_Manager::COLOR,                
                'default' 	=> '#ffffff',                
                'selectors' => [
                    '{{WRAPPER}} .categories-menu-title' => 'color: {{VALUE}};'
                ],
            ]
        );
		$this->add_control(
            'menu_bg_color',
            [
                'label' 	=> esc_html__( 'BG Color', 'matjar-core' ),
                'type' 		=> Controls_Manager::COLOR,                
                'default' 	=> '#1558E5',                
                'selectors' => [
                    '{{WRAPPER}} .categories-menu-title' => 'background-color: {{VALUE}};'
                ],
            ]
        );
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );		
		$settings['id'] 		= matjar_uniqid('matjar-element-');
		$class					= array( 'matjar-element', 'matjar-vertical-categories' );
		$icon_html 				= '';
		
		if( $settings['menu_icon'] ) {			
			ob_start();
			Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ]  );
			$icon_html 	= ob_get_clean();
			$class[]	= 'icon-alignment-'.$icon_alignment;
		}
		
		$settings['icon_html'] 	= $icon_html;
		$settings['class'] 		= implode(' ', array_filter( $class ));
		matjar_get_pl_templates( 'elements-widgets/vertical-menu', $settings );
	}
}

$widgets_manager->register(new Matjar_Elementor_VerticalMenu());