<?php
/**
 * Matjar Dashboard
 *
 * Handles the about us page HTML
 *
 * @package Matjar
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$matjar_tabs = apply_filters('matjar_dashboard_tabs', array(
					'matjar-theme' 			=> esc_html__("Dashboard", 'matjar'),
					'matjar-system-status' 	=> esc_html__("System Status", 'matjar'),
					'matjar-theme-option' 	=> esc_html__("Theme Options", 'matjar'),
				));
$active_tab 	= isset($_GET['page']) ? $_GET['page'] : 'matjar-theme'; 
?>
<div class="wrap about-wrap matjar-admin-wrap matjar-dashboard-wrap">
	
	<h1>
		<?php
		echo apply_filters( 'matjar_dashboard_title', esc_html__('Welcome to', 'matjar').' Matjar' );
		?>
	</h1>
	<div class="about-text">
		<?php 
		echo apply_filters( 'matjar_dashboard_description', esc_html__('Thank you for purchasing our premium matjar theme. Here you are able to start creating your awesome web store by importing our dummy content and theme options.', 'matjar'));
		?>
	</div>
	<div class="matjar-theme-badge">
		<?php $dashlogo_url = apply_filters( 'matjar_dashboard_logo', MATJAR_URI.'/inc/admin/assets/images/dashboard-logo.png' ) ?>
		<img src="<?php echo esc_url( $dashlogo_url ); ?>">
		<span><?php echo esc_html__('Version', 'matjar') .' '.MATJAR_VERSION; ?></span>
	</div>
	
	<?php 
	$action_button = apply_filters( 'matjar_dashboard_docs_rating_button', true);
	if( $action_button ){ ?>
	<p class="matjar-actions">
		<a class="btn-docs button" href="https://templatemonster.com/store/themejr" target="_blank"><?php esc_html_e('Our Store','matjar');?></a>
		<a class="btn-rate button" href="https://account.templatemonster.com/downloads" target="_blank"><?php esc_html_e('Rate our theme','matjar');?></a>
    </p>
	<?php }
	if( !empty( $matjar_tabs ) ) { ?>
		<h2 class="nav-tab-wrapper">
			<?php foreach ($matjar_tabs as $tab_key => $tab_val) { 

				if( empty($tab_key) ) {
					continue;
				}
				if( !defined( 'MATJAR_CORE_DIR' ) && $tab_key == 'matjar-theme-option') {
					continue;
				}
				$active_tab_cls	= ( $active_tab == $tab_key ) ? ' nav-tab-active' : '';
				$tab_link 		= add_query_arg( array( 'page' => $tab_key ), admin_url('admin.php') );
				?>
				<a class="nav-tab<?php echo esc_attr( $active_tab_cls ); ?>" href="<?php echo esc_url( $tab_link ); ?>"><?php echo esc_html( $tab_val ); ?></a>
			<?php } ?>
		</h2>
	<?php } ?>
	<div id="matjar-dashboard" class="matjar-dashboard wp-clearfix">
	