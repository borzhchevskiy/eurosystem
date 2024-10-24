<?php
/**
 * The Header of theme
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */ 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="profile" href="//gmpg.org/xfn/11">
	<?php do_action( 'matjar_head_bottom' ); ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action( 'matjar_body_top' ); ?>
	
	<div id="page" class="site-wrapper">
		
		<?php if( ! matjar_has_elementor_template( 'header' ) ) :
			/**
			 * Hook: matjar_header.
			 *
			 * @hooked matjar_template_header- 10
			 */
			do_action( 'matjar_header' );
		endif; ?>
		
		<?php if( ! matjar_has_elementor_template( 'archive' ) ) : ?>
		
		<?php
		/**
		 * Hook: matjar_page_title.
		 *
		 * @hooked matjar_template_page_title - 10
		 */
		do_action( 'matjar_page_title' );
		
		endif; ?>			
		
		<div id="main-content" class="site-content">
		
			<?php do_action( 'matjar_site_content_top' ); ?>
			
			<div class="container">
				<?php do_action( 'matjar_after_container' ); ?>
				<div class="<?php matjar_row_classes(); ?>">