<?php
/**
 *	Matjar Widget: About Us
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Matjar_Widget_Base' ) ) {
	return;
}

class Matjar_About_Us_Widget extends Matjar_Widget_Base {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'matjar-about-us';
        $this->widget_description 	= esc_html__("Display about us ", 'matjar-core');
        $this->widget_id 			= 'matjar-about-us';
        $this->widget_name 			= esc_html__('Matjar: About Us', 'matjar-core');
		$this->image_sizes 			= matjar_get_all_image_sizes(true);
        array_shift($this->image_sizes);
		
		$this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Title:', 'matjar-core'),
				'std' => __('About Us','matjar-core'),
            ),
			'hide_title' => array(
                'type' => 'checkbox',
                'label' => esc_html__('Hide Title?', 'matjar-core'),
				'std' => true,
            ),
			'logo' => array(
                'type' => 'image',
                'label' => esc_html__('Upload Logo:', 'matjar-core'),                
            ),
			'logo_size' => array(
                'type' => 'select',
                'label' => esc_html__('Logo Size:', 'matjar-core'),
                'options' => $this->image_sizes,
                'std' => 'full',
            ),
			'our_site_url' => array(
                'type' => 'text',
                'label' => esc_html__('Site Url:', 'matjar-core'),
            ),
			'about_tagline' => array(
                'type' => 'textarea',
                'label' => esc_html__('About Tagline:', 'matjar-core')
            ),
			'address' => array(
                'type' => 'text',
                'label' => esc_html__('Address:', 'matjar-core'),
            ),
			'phone_number' => array(
                'type' => 'text',
                'label' => esc_html__('Phone Number:', 'matjar-core'),
            ),
			'fax_number' => array(
                'type' => 'text',
                'label' => esc_html__('Fax Number:', 'matjar-core'),
            ),
			'email_address' => array(
                'type' => 'text',
                'label' => esc_html__('Email:', 'matjar-core'),
            ),
			'website' => array(
                'type' => 'text',
                'label' => esc_html__('Website:', 'matjar-core'),
            ),
			'days_hours' => array(
                'type' => 'text',
                'label' => esc_html__('Working Days/Hours:', 'matjar-core'),
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
		
		$hide_title 	= (!empty($instance['hide_title'])) ? (bool) $instance['hide_title'] : false;
		if($hide_title) unset($instance['title']);
		
		$this->widget_start($args, $instance);
		
		do_action( 'matjar_before_about_us');
		
		$logo 			= (!empty($instance['logo'])) ?  $instance['logo'] : '';
		$logo_size 		= (!empty($instance['logo_size'])) ? esc_attr($instance['logo_size']) : 'full';	
		$logo_url 		= '';
		if($logo){
			$logo_url =  matjar_get_image_src( $logo,$logo_size);
		}
		$logo_url 		= apply_filters('matjar_widget_about_us_logo', $logo_url );
		$our_site_url 	= (!empty($instance['our_site_url'])) ?  $instance['our_site_url'] : '#';
		$about_tagline 	= apply_filters('about_tagline', empty($instance['about_tagline']) ? false : $instance['about_tagline']);
		$address 		= (!empty($instance['address'])) ?  $instance['address'] : '';
		$phone_number 	= (!empty($instance['phone_number'])) ?  $instance['phone_number'] : '';
		$fax_number 	= (!empty($instance['fax_number'])) ?  $instance['fax_number'] : '';
		$email_address 	= (!empty($instance['email_address'])) ?  $instance['email_address'] : '';
		$website 		= (!empty($instance['website'])) ?  $instance['website'] : '';
		$days_hours 	= (!empty($instance['days_hours'])) ?  $instance['days_hours'] : '';
		
		$html='<div class="about-us-widget">';
		
		if( !empty( $logo_url ) )
			$html.='<p class="about-logo"><a href="'.esc_url($our_site_url) .'"><img src="'. esc_url($logo_url) .'" alt="logo" /></a></p>';			
		
		if( !empty( $about_tagline ) )
			$html.='<p>'. esc_attr($about_tagline) .'</p>';			
		
		$html.='<ul class="about-us">';
			if($address != '')
				$html.='<li><i class="jricon-home"></i><span>'. esc_attr($address) .'</span></li>';				
			
			if($phone_number != '')
				$html.='<li><i class="jricon-phone"></i><span>'. esc_attr($phone_number) .'</span></li>';
			
			if($fax_number != '')
				$html.='<li><i class="jricon-printer"></i><span>'. esc_attr($fax_number) .'</span></li>';
			
			if($email_address != ''):
				$html.='<li><i class="jricon-envelope"></i><span>';
				if(is_email($email_address)){
					$html.='<a href="mailto:'. esc_attr($email_address).' ">'.esc_attr($email_address) .'</a>';
				}else{
					$html.= esc_html__("Invalid Email Address",'matjar-core');
				}
				$html.='</span>';
				$html.='</li>';
			endif;
			
			if($website != '')
				$html.='<li><i class="jricon-worldwide"></i><span><a href="'.esc_url($website) .'">'.  $website .'</a></span></li>';
			
			if($days_hours != '')
				$html.='<li><i class="jricon-clock"></i><span>'. esc_attr($days_hours) .'</span></li>';

		$html.='</ul>';
		$html.='</div>';
		
		echo $html;

		do_action( 'matjar_after_about_us');

		$this->widget_end($args);

        echo ob_get_clean();
    }

}
