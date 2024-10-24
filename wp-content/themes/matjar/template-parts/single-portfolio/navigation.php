<?php
/**
 * Template part for displaying related portfolio
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/single-portfolio
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! matjar_get_option( 'single-portfolio-navigation', 1 ) ) return;

$next_post = get_next_post();
$prev_post = get_previous_post();
if(!empty($prev_post) || !empty($next_post)){
?>
	<div class="navigation post-navigation">			
		<div class="nav-previous">
			<?php if(!empty($prev_post)) {?>
				<a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" rel="prev">
					<span class="nav-subtitle"><?php esc_html_e('Previous', 'matjar'); ?></span>
					<span class="nav-title h4"><?php echo get_the_title($prev_post->ID); ?></span>
				</a>
			<?php }?>
		</div>			
		<div class="nav-archive">
			<a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>"><i class="icon-grid"></i></a>
		</div>
		<div class="nav-next">
			<?php if(!empty($next_post)) {?>
				<a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" rel="next">
					<span class="nav-subtitle"><?php esc_html_e('Next', 'matjar'); ?></span>
					<span class="nav-title h4"><?php echo get_the_title($next_post->ID); ?></span>
				</a>
			<?php }?>
		</div>
	</div><!-- .post-navigation -->
<?php }