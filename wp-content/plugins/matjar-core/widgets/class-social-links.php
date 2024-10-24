<?php
/**
 *	Matjar Widget: Social Links
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Matjar_Widget_Base' ) ) {
	return;
}

class Matjar_Social_Links extends Matjar_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'matjar-social-link';
        $this->widget_description 	= esc_html__( 'Display social links.', 'matjar-core' );
        $this->widget_id 			= 'matjar-social-links';
        $this->widget_name 			= esc_html__( 'Matjar: Social Links', 'matjar-core' );
		$this->settings = array(
            'title' => array(
                'type' 	=> 'text',
                'label' => esc_html__( 'Title:', 'matjar-core' ),
				'std' => esc_html__( 'Social', 'matjar-core' ),
            ),
			'hide_title' => array(
                'type' 	=> 'checkbox',
                'label' => esc_html__( 'Hide Widget Title?', 'matjar-core' ),
                'std' 	=> true,
            ),
			'social_Style' => array(
                'type' => 'select',
                'label' => esc_html__( 'Icons Style:', 'matjar-core' ),
                'options' => array(
					'icons-default' 		=> esc_html__( 'Default', 'matjar-core' ),					
                    'icons-colour' 			=> esc_html__( 'Colour', 'matjar-core' ),
                    'icons-bordered' 		=> esc_html__( 'Bordered', 'matjar-core' ),
					'icons-fill-colour'		=> esc_html__( 'Fill Colour', 'matjar-core' ),
					'icons-theme-colour'	=> esc_html__( 'Theme Colour', 'matjar-core' ),
										
                ),
                'std' => 'icons-fill-colour',
            ),
			'social_shape' => array(
                'type' => 'select',
                'label' => esc_html__( 'Icons Shape:', 'matjar-core' ),
                'options' => array(
                    'icons-shape-circle' => esc_html__( 'Circle', 'matjar-core' ),
					'icons-shape-square' => esc_html__( 'Square', 'matjar-core' ),										
                ),
                'std' => 'icons-shape-square',
            ),
			'social_icon_size' => array(
                'type' => 'select',
                'label' => esc_html__( 'Icons Size:', 'matjar-core' ),
                'options' => array(
                    'icons-size-default'=> esc_html__( 'Default', 'matjar-core' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'matjar-core' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'matjar-core' ),
                ),
                'std' => 'icons-size-small',
            ),
		);
		parent::__construct();
	}
	
	/**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ){

        ob_start();
		
		$hide_title = ( !empty( $instance['hide_title'] ) ) ? (bool) $instance['hide_title'] : false;
		if( $hide_title ) unset( $instance['title'] );
		
		$this->widget_start( $args, $instance );
		
		do_action( 'matjar_before_social_links' );
		
		$social_Style 		= ( !empty($instance['social_Style'] ) ) ?  $instance['social_Style'] : 'icons-fill-colour';
		$social_shape 		= ( !empty($instance['social_shape'] ) ) ?  $instance['social_shape'] : 'icons-shape-square';
		$social_icon_size 	= ( !empty($instance['social_icon_size'] ) ) ?  $instance['social_icon_size'] : 'icons-size-small';	?>
		
		<div class="matjar-social-links-widget">
			<?php //Get Social link
			if ( function_exists( 'matjar_social_share' ) ){
				matjar_social_share( array(
					'type'	=> 'profile',
					'style' => $social_Style,
					'shape'	=> $social_shape,
					'size' 	=> $social_icon_size
				) );
			}?>
		</div>
		
		<?php
		do_action( 'matjar_after_social_links' );

		$this->widget_end($args);

        echo ob_get_clean();
    }
}