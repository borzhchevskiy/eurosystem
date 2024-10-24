<?php
/**
 * Displays the portfolio entry header
 *
 * @author 	ThemeJR
 * @package matjar/template-parts/portfolio
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<header class="entry-header">

	<?php
	/**
	 * Hook: matjar_portfolio_loop_header.
	 *
	 * @hooked matjar_template_portfolio_loop_categories - 10
	 * @hooked matjar_template_portfolio_loop_title - 20
	 */
	do_action( 'matjar_portfolio_loop_header' );
	?>
	
</header><!-- .entry-header -->