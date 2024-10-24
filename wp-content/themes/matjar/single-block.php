<?php
/**
 * The template for displaying all html block
 *
 * @author 	ThemeJR
 * @package matjar
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="profile" href="//gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php wp_body_open(); ?>	
		<div id="page" class="site-wrapper">
			<div id="main-content" class="site-content">
				<div class="container">
					<div class="row">
						<div id="primary" class="content-area col-12">
							<?php while ( have_posts() ) : ?>
								<?php the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
			</div>
		<?php wp_footer(); ?>
	</body>
</html>