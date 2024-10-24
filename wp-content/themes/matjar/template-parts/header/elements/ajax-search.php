<?php
/**
 * Template part for displaying ajax search 
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

if( ! matjar_get_option( 'product-ajax-search', 1 ) ) {
	return;
}
		
$classes[] = matjar_get_option( 'header-ajax-search-style', 'ajax-search-style-1' );
$classes[] = matjar_get_option( 'ajax-search-shape', 'ajax-search-simple');?>	

<div class="matjar-ajax-search <?php matjar_implode_classes( $classes );?>">
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<input type="search" class="search-field"  name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( matjar_get_option('search-placeholder-text', 'Search for products, categories, sku...') ); ?>"/>
		<div class="search-categories">
		<?php
			$selected_cat 	= isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';     
			$product_cat 	= matjar_uniqid('product-cat-');
			$args = array(
			  'name'         		=> 'product_cat',
			  'value_field'  		=> 'slug',
			  'class'        		=> 'categories-filter product_cat',
			  'id'        	 		=> $product_cat,
			  'show_option_none' 	=> esc_html__( 'All Categories','matjar' ),
			  'option_none_value' 	=> '',
			  'hide_empty'   		=> 1,
			  'orderby'      		=> 'name',
			  'order'        		=> 'asc',
			  'echo'         		=> 0,
			  'taxonomy'     		=> 'product_cat',
			);
			
			if( $selected_cat !='' ):
				$args['selected'] = $selected_cat;
			else:
				$args['selected'] = 0;
			endif;
			
			if( matjar_get_option( 'search-categories', 'all' ) == 'parent' ):
				$args['depth'] = 1;
			endif;
			
			if( matjar_get_option( 'categories-hierarchical', 1 ) ):
				$args['hierarchical'] = true;
			endif;
			
			if( MATJAR_WOOCOMMERCE_ACTIVE && matjar_get_option( 'show-categories-dropdow', 1 ) ):
				echo wp_dropdown_categories( $args );
			endif;
			?>
		</div>
		<button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'matjar' );?></button>
		<?php 
		$search_post_type = matjar_get_option('search-content-type','product' );
		if( $search_post_type != 'all' ){ ?>
			<input type="hidden" name="post_type" value="<?php echo esc_attr($search_post_type);?>" />	
		<?php } ?>			
	</form>
	<div class="search-results-wrapper woocommerce"></div>
	
	<?php if( matjar_get_option( 'trending-search', 0 ) ) { ?>
		<div class="trending-search-wrap">
			<?php $trending_categories_ids = matjar_get_option( 'trending-search-categories', array() );
			if( ! empty( $trending_categories_ids ) ):
				$trending_categories = get_terms( 'product_cat', array(
					'include' => $trending_categories_ids,
					'orderby' => 'include',
				) );
				if( ! is_wp_error( $trending_categories ) ) : ?>
					<div class="trending-search">				
						<ul>
							<li class="trending-title"><?php esc_html_e( 'Trending Search', 'matjar' );?> </li>
							<?php foreach( $trending_categories  as $trending_cat ) : ?>
								<li class="item">
									<a href="<?php echo esc_url(get_term_link($trending_cat->term_id))?>"><span class="keyword"><?php echo esc_html($trending_cat->name);?></span></a>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				<?php endif;
			endif;?>
		</div>
	<?php } ?>
</div>
