<?php
/**
 * Template part for displaying portfolio comments
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! matjar_get_option('single-portfolio-comments', 1) ) {
	return;
}

// If comments are open or we have at least one comment, load up the comment template.
if ( (comments_open() || get_comments_number()) && matjar_get_option('single-post-comment', 1) )  :
	comments_template();
endif;