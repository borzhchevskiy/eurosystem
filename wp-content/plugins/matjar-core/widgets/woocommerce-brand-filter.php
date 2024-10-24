<?php
/**
 *	Matjar Widget: Products
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'WC_Widget' ) ) {
	return;
}

class Matjar_Brand_Filter_Widget extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->widget_cssclass 		= 'matjar-widget-brands';
        $this->widget_description 	= esc_html__("Products Filter by brands.", 'matjar-core');
        $this->widget_id 			= 'matjar-brands';
        $this->widget_name 			= esc_html__('Matjar: Filter by brands', 'matjar-core');
		
		$this->settings = array(
            'title' => array(
                'type' => 'text',
                'label' => esc_html__('Title:', 'matjar-core'),
				'std' => esc_html__('Filter by brands','matjar-core'),
            )
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

       	if ( ! matjar_is_catalog() ) {
			return;
		}
		
		$current_taxonomy = 'product_brand';
		$term_id          = 0;
		
		if ( empty( $instance['title'] ) ) {
			$taxonomy          = get_taxonomy( $current_taxonomy );
			$instance['title'] = $taxonomy->labels->name;
		}
		
        $this->widget_start($args, $instance);
		$terms_args = array( 'hide_empty' => true);
		$terms  = get_terms( $current_taxonomy , $terms_args);
		$found  = false;
		$output = array();
		if ( $terms ) {

			foreach ( $terms as $term ) {

				$css_class = '';
				if ( $term_id == $term->term_id ) {
					$css_class = 'selected';
					$found     = true;
				}

				$output[] = sprintf( '<li><a href="%s" class="%s">%s</a></li>', esc_url( get_term_link( $term ) ), esc_attr( $css_class ), $term->name );
			}

		}
		$css_class = $found ? '' : 'selected';

		printf(
			'<ul class="matjar_product_brands">' .
			'<li><a href="%s" class="%s">%s</a></li>' .
			'%s' .
			'</ul>',
			esc_url( esc_url( get_permalink( get_option( 'woocommerce_shop_page_id' ) ) ) ),
			esc_attr( $css_class ),
			esc_html__( 'All', 'matjar-core' ),
			implode( ' ', $output )
		);
		
		$this->widget_end($args);
    }

}
