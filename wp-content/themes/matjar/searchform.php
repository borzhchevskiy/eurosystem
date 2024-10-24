<?php
/**
 * Template for displaying search forms
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */

?>

<?php $unique_id = esc_attr( matjar_uniqid('search-form-') ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo esc_attr($unique_id); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'matjar' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	<button type="submit" class="search-submit"><?php esc_html_e('Search','matjar');?></button>
</form>
