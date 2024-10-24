<?php
/**
 *	Matjar Widget: Newsletter
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Matjar_Widget_Base' ) ) {
	return;
}

class Matjar_Newsletter_Widget extends Matjar_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'matjar-newsletter';
        $this->widget_description 	= esc_html__("Display newsletter.", 'matjar-core');
        $this->widget_id 			= 'matjar-newsletter';
        $this->widget_name 			= esc_html__('Matjar: Newsletter', 'matjar-core');
		$this->settings = array(
            
			'title' => array(
                'type' 	=> 'text',
                'label' => esc_html__('Title', 'matjar-core'),
                'std' 	=> esc_html__('Newsletter','matjar-core'),
            ),
			'newsletter_tagline' => array(
                'type' 				=> 'textarea',
                'label' 			=> esc_html__('Newsletter Tagline', 'matjar-core'),
				'allow_esc_html'	=> false,
                'std' 				=> 'Subscribe to our mailing list to get the new updates!',
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
    public function widget($args, $instance){
		
        ob_start();

        $this->widget_start($args, $instance);
		do_action( 'matjar_before_newsletter');
		
		$newsletter_tagline = apply_filters('newsletter_tagline', empty($instance['newsletter_tagline']) ? false : $instance['newsletter_tagline']);
		
		?>
		<div class="matjar-newsletter-widget">
			<?php 
			# Text
			if( ! empty( $newsletter_tagline ) ){ ?>
				<div class="subscribe-tagline">
					<?php echo do_shortcode( $newsletter_tagline ) ?>
				</div>
				<?php
			}
			 if( function_exists( 'mc4wp_show_form' ) ) {
				mc4wp_show_form();
			} ?>
		</div>
		
		<?php		
		do_action( 'matjar_after_newsletter');
		
		$this->widget_end($args);
		
        echo ob_get_clean();
    }

}