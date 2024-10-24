<?php
/*
Element: Progress Bar
*/
use Elementor\Controls_Manager;
use Elementor\Repeater;
class Matjar_Elementor_ProgressBar extends Matjar_Elementor_Widget_Base {
	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
        return 'matjar_progress_bar';
    }

	/**
     * Get widget title.
     *
     * Retrieve progress_bar widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Progress Bar', 'matjar-core' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve progress_bar widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'matjar-icon eicon-skill-bar';
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
		return [ 'skill', 'bar', 'graph' ];
	}
	
	/**
     * Register progress_bar widget controls.
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
				 'default' 	=> 'Skill',
            ]
        );
		$this->add_control(
            'style',
            [
                'label' 	=> esc_html__( 'Style', 'matjar-core' ),
                'type' 		=> Controls_Manager::SELECT,
                'options' 	=> [
					'style-1'		=> esc_html__( 'Style 1', 'matjar-core' ),
					'style-2'		=> esc_html__( 'Style 2', 'matjar-core' ),
					'style-3'		=> esc_html__( 'Style 3', 'matjar-core' ),
				],
                'default' 	=> 'style-1',
            ]
        );
		$this->add_control(
            'units',
            [
                'label' 		=> esc_html__('Units', 'matjar-core'),
                'type' 			=> Controls_Manager::TEXT,
				 'default' 		=> '%',
				 'description' 	=> esc_html__( 'Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'matjar-core' ),
            ]
        );
		$this->add_control(
            'stripes',
            [
                'label' 		=> esc_html__('Add stripes', 'matjar-core'),
                'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 0,
				'return_value' 	=> 'yes',
            ]
        );
		$this->add_control(
            'stripe_animation',
            [
                'label' 	=> esc_html__('Add animation', 'matjar-core'),
                'type' 		=> Controls_Manager::SWITCHER,
				'default' 	=> 0,
				'condition'	=> [
					'stripes' => [ 'yes' ],
				],
            ]
        );		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_tab',
			array(
				'label'     => esc_html__( 'Progress Bar', 'matjar-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			)
		);
		
		$repeater = new Repeater();		
		$repeater->add_control(
			'bar_label',
			[
				'label' 		=> esc_html__( 'Label', 'matjar-core' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_html__( 'Bar label', 'matjar-core' ),
				'dynamic' 		=> [
					'active' 	=> true,
				],
			]
		);
		$repeater->add_control(
			'bar_value',
            [
                'label' 		=> esc_html__('Value', 'matjar-core'),
                'type' 			=> Controls_Manager::NUMBER,
            ]
		);
		$repeater->add_control(
			'bar_color',
            [
                'label' 		=> esc_html__('Color', 'matjar-core'),
                'type' 			=> Controls_Manager::COLOR,
            ]
		);
		$this->add_control(
            'bar_items',
            [
                'label' 	=> esc_html__( 'Bar Items', 'matjar-core' ),
                'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'bar_label' 		=> 'HTML',
						'bar_value' 		=> 90,
						'bar_color' 		=> matjar_get_primary_color(),
					],
					[
						'bar_label' 		=> 'WordPress',
						'bar_value' 		=> 80,
						'bar_color' 		=> matjar_get_primary_color(),
					],
					[
						'bar_label' 		=> 'Design',
						'bar_value' 		=> 95,
						'bar_color' 		=> matjar_get_primary_color(),
					],
				],
				'title_field' => '{{{ bar_label }}}',
            ]
        );
		
		$this->end_controls_section();
	}
	
	protected function render() {
		
		$settings = $this->get_settings();
		extract( $settings );
		$settings['id'] 	= matjar_uniqid('matjar-progress-');
		$class				= array('matjar-element', 'matjar-progress-bar', 'bar-'.$style );
		$settings['class']	= implode( ' ', $class );
		$stripe_class = '';
		if($stripes){
			$stripe_class .= ' progress-bar-striped';
		}
		if($stripes && $stripe_animation){
			$stripe_class .= ' progress-bar-animated';
		}
		$settings['stripe_class'] = $stripe_class;	
		matjar_get_pl_templates( 'elements-widgets/progress-bar', $settings );
	}
}

$widgets_manager->register( new Matjar_Elementor_ProgressBar() );