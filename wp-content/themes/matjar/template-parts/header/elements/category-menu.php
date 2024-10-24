<?php
/**
 * Template part for displaying categories menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/header
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! matjar_get_option( 'categories-menu', 1 ) ) return;

$class = ( matjar_is_open_categories_menu() ) ? ' opened-categories' : '';

if ( has_nav_menu( 'categories-menu' ) ) { ?>		
	<div class="categories-menu-wrapper<?php echo esc_attr( $class );?>">
		<div class="categories-menu-title">
			<span class="title"><?php echo esc_html( matjar_get_option( 'categories-menu-title', 'Shop By Categories' ) );?></span>
			<span class="arrow-down-up"></span>
		</div>
		<?php wp_nav_menu( 
			array(
				'theme_location' 	=> 'categories-menu',
				'container_class'   => 'categories-menu matjar-navigation',
				'walker' 			=> new Matjar_Mega_Menu_Walker()
			)
		);?>
	</div>	
<?php } ?>