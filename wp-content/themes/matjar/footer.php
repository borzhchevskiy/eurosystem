<?php
/**
 * The template for displaying the footer
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */
?>
				</div><!-- .row -->		
			</div><!-- .container -->
			
			<?php do_action( 'matjar_site_content_botton' ); ?>
			
		</div><!-- .site-content -->
		
		<?php if( ! matjar_has_elementor_template( 'footer' ) ) :
			/**
			 * Hook: matjar_footer.
			 *
			 * @hooked matjar_template_footer- 10
			 */
			do_action( 'matjar_footer' );
		endif; ?>
		
	</div><!-- .site-wrapper -->
	
	<?php do_action( 'matjar_body_bottom' ); ?>
	<?php wp_footer(); ?>
	</body>
</html>