<?php
/**
 * Template part for displaying footer copyright
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/footer
 * @since 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$footer_categories = matjar_get_option( 'footer-popular-categories', [] );
if( empty( $footer_categories ) ){
	return;
}
?>

<div class="footer-categories">
	<div class="container">	
		<div class="row">
			<div class="col-12">
				<div class="popular-categories">
					<?php if( ! empty( $footer_categories ) ):
						foreach( $footer_categories as $cat_ID ):
							$args = array( 'child_of' =>$cat_ID , 'taxonomy'=> 'product_cat','number' => 10, 'title_li'=>'' ); ?>								
							<ul class="categories-list">
								<li class="cate_title"><?php echo esc_html( get_the_category_by_ID( $cat_ID ) );?> : </li>
								<?php wp_list_categories( $args ); ?>
							</ul>
						<?php endforeach; ?>
					<?php endif;?>
				</div>
			</div>			
		</div>
	</div>
</div><!-- .footer-link -->