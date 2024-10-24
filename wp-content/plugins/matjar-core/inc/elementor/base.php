<?php
if (!defined('ABSPATH') || function_exists('Matjar_Elementor_Widget_Base') ) {
    exit; // Exit if accessed directly.
}

abstract class Matjar_Elementor_Widget_Base extends Elementor\Widget_Base {
	public function get_categories() {
        return [ 'matjar-elements' ];
    }
    
    public function get_name() {
        return 'matjar-base';
    }
	
	public function matjar_alignment_options(){
		return [
			'left' => [ 
				'title' => esc_html__('Left', 'matjar-core'),
				'icon' => 'eicon-text-align-left',
			],
			'center' => [
				'title' => esc_html__('Center', 'matjar-core'),
				'icon' => 'eicon-text-align-center',
			],
			'right' => [
				'title' => esc_html__('Right', 'matjar-core'),
				'icon' => 'eicon-text-align-right',
			],
		];
	}
	
	public function matjar_horizontal_align_options(){
		return [
			'start' => [ 
				'title' => esc_html__('Left', 'matjar-core'),
				'icon' => 'eicon-h-align-left',
			],
			'center' => [
				'title' => esc_html__('Center', 'matjar-core'),
				'icon' => 'eicon-h-align-center',
			],
			'end' => [
				'title' => esc_html__('Right', 'matjar-core'),
				'icon' => 'eicon-h-align-right',
			],
		];
	}
	
	public function matjar_vertical_align_options(){
		return [
			'start' => [ 
				'title' => esc_html__('Top', 'matjar-core'),
				'icon' => 'eicon-v-align-top',
			],
			'center' => [
				'title' => esc_html__('Middle', 'matjar-core'),
				'icon' => 'eicon-v-align-middle',
			],
			'end' => [
				'title' => esc_html__('Bottom', 'matjar-core'),
				'icon' => 'eicon-v-align-bottom',
			],
		];
	}
	
	public function get_url_attribute($link) {
        $attrs = '';
		if ( isset( $link['url'] ) && $link['url'] ) {
			$attrs = ' href="' . esc_url( $link['url'] ) . '"';
			$attrs .= $link['is_external'] ? ' target="_blank"' : '';
			$attrs .= $link['nofollow'] ? ' rel="nofollow"' : '';			
		}
		if ( isset( $link['custom_attributes'] ) ) {
			$custom_attributes = Utils::parse_custom_attributes( $link['custom_attributes'] );
			foreach ( $custom_attributes as $attr_key => $value ) {
				$attrs .= ' ' . $attr_key . '="' . $value . '"';
			}
		}
		return $attrs;
    }
}