<?php
/**
 * Matjar Admin Dashboard Tab
 *
 * @package Matjar
 * @since 3.0
 */
require_once MATJAR_FRAMEWORK.'admin/dashboard/header.php';
global $wp_filesystem, $wpdb;;
$obj_dash = new Matjar_Dashboard();
if ( isset( $_GET['tgmpa-deactivate'] ) && 'deactivate-plugin' == $_GET['tgmpa-deactivate'] ) {
	$plugins = TGM_Plugin_Activation::$instance->plugins;
	check_admin_referer( 'tgmpa-deactivate', 'tgmpa-deactivate-nonce' );
	foreach ( $plugins as $plugin ) {
		if ( $plugin['slug'] == $_GET['plugin'] ) {
			deactivate_plugins( $plugin['file_path'] );
		}
	}
}
if ( isset( $_GET['tgmpa-activate'] ) && 'activate-plugin' == $_GET['tgmpa-activate'] ) {
	check_admin_referer( 'tgmpa-activate', 'tgmpa-activate-nonce' );
	$plugins = TGM_Plugin_Activation::$instance->plugins;
	foreach ( $plugins as $plugin ) {
		if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
			activate_plugin( $plugin['file_path'] );
		}
	}
}

$plugins 				= TGM_Plugin_Activation::$instance->plugins;
$tgm_plugins_required 	= 0;
$tgm_plugins_action 	= array();
foreach ( $plugins as $plugin ) {
	$tgm_plugins_action[ $plugin['slug'] ] = $obj_dash->plugin_action( $plugin );
}
?>
<div class="matjar-content-body">		
	<div class="row">
		<div class="col-md-6">
			<div class="matjar-box docs">
				<div class="matjar-box-header">
					<div class="title"><?php esc_html_e('Our Store','matjar');?></div>
				</div>
				<div class="matjar-box-body">	
					<p><?php esc_html_e('Visit our store on TemplateMonster and enjoy the best e-commerce templates.','matjar');?> </p>
					<div class="s-button">
						<a class="button" href="https://www.templatemonster.com/store/themejr/" target="_blank"><?php esc_html_e('Visit our store. ','matjar');?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="matjar-box support">
				<div class="matjar-box-header">
					<div class="title"><?php esc_html_e('Support','matjar');?></div>
				</div>
				<div class="matjar-box-body">	
					<p><?php esc_html_e('Matjar theme comes with 6 months of free support for every license you purchase. Support can be extended through subscriptions via TemplateMonster.','matjar');?> </p>
					<div class="s-button">
						<a class="button" href="https://www.templatemonster.com/authors/themejr/" target="_blank"><?php esc_html_e('Send Request','matjar');?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="matjar-box system-requirements">
				<div class="matjar-box-header">
					<div class="title"><?php esc_html_e('System Requirements','matjar');?></div>
				</div>
				<div class="matjar-box-body">
					<table class="widefat" cellspacing="0">
						<tbody>
							<?php if( function_exists( 'matjar_get_server_info' ) ) { ?>
							<tr>
								<td data-export-label="Server Info"><?php esc_html_e( 'Server Info:', 'matjar' ); ?></td>
								<td><?php echo esc_html( matjar_get_server_info() ); ?></td>
							</tr>
							<?php } ?>
							<tr>
								<td data-export-label="PHP Version"><?php esc_html_e( 'PHP Version:', 'matjar' ); ?></td>
								<td>
									<?php 
									if ( function_exists( 'phpversion' ) ) { 
										$php_version = phpversion();
										if( version_compare(phpversion(), '5.6', '<') ){ 
										echo esc_html__('Currently:','matjar').' '. phpversion().' ';  
										esc_html_e('(min: 5.6)','matjar') ?> 
										<label class="hero button" for="php-version"> <?php esc_html_e('Please contact Host provider to fix it.','matjar') ?> </label>
									<?php } else { 
										echo esc_html__('Currently:','matjar').' '. phpversion() ?> </span>
									<?php }
									}else{
										echo  esc_html__('Couldn\'t determine PHP version because phpversion() doesn\'t exist.','matjar');
									}
									?>
								</td>
							</tr>
							<tr>
								<td data-export-label="PHP Post Max Size"><?php esc_html_e( 'PHP Post Max Size:', 'matjar' ); ?></td>
								<td><?php echo size_format( wp_convert_hr_to_bytes( ini_get( 'post_max_size' ) ) ); ?></td>
							</tr>
							<tr>
								<td data-export-label="PHP Time Limit"><?php esc_html_e( 'PHP Time Limit:', 'matjar' ); ?></td>
								<td>
									<?php
									$time_limit = ini_get('max_execution_time');

									if ( $time_limit < 180 && $time_limit != 0 ) {
										echo '<mark class="error">' . wp_kses(sprintf( __( '%1$s - We recommend setting max execution time to at least 600. <br /> To import demo content, <strong>600</strong> seconds of max execution time is required.<br />See: <a href="%2$s" target="_blank">Increasing max execution to PHP</a>', 'matjar' ), $time_limit, 'https://wordpress.org/support/article/common-wordpress-errors/#php-errors' ), array( 'strong' => array(), 'br' => array(), 'a' => array( 'href' => array(), 'target' => array() ) ) ) . '</mark>';
									} else {
										echo  esc_html( $time_limit );
										if ( $time_limit < 600 && $time_limit != 0 ) {
											echo '<br /><mark class="error">' . wp_kses(__( 'Current time limit is sufficient, but if you need import demo content, the required time is <strong>600</strong>.', 'matjar' ), array( 'strong' => array(),  ) ) . '</mark>';
										}
									}
									?>
								</td>
							</tr>
							<tr>
								<td data-export-label="PHP Max Input Vars"><?php esc_html_e( 'PHP Max Input Vars:', 'matjar' ); ?></td>
								<td>
									<?php 
									$registered_navs = get_nav_menu_locations();
									$menu_items_count = array( '0' => '0' );
									foreach ( $registered_navs as $handle => $registered_nav ) {
										$menu = wp_get_nav_menu_object( $registered_nav );
										if ( $menu ) {
											$menu_items_count[] = $menu->count;
										}
									}

									$max_items = max( $menu_items_count );
									$required_input_vars = $max_items * 20;
									$max_input_vars = ini_get( 'max_input_vars' );
									$required_input_vars = $required_input_vars + ( 500 + 1000 );
									echo esc_html( $max_input_vars );
									?>
								</td>
							</tr>
							 <tr>
								<td data-export-label="ZipArchive"><?php esc_html_e( 'ZipArchive:', 'matjar' ); ?></td>
								<td><?php echo class_exists( 'ZipArchive' ) ? '<span class="yes">&#10004;</span>' : '<span class="error">No.</span>'; ?></td>
							</tr>
							<tr>
								<td data-export-label="Max Upload Size"><?php esc_html_e( 'Max Upload Size:', 'matjar' ); ?></td>
								<td><?php echo size_format( wp_max_upload_size() ); ?></td>
							</tr>
							<tr>
								<td data-export-label="MySQL Version"><?php esc_html_e( 'MySQL Version:', 'matjar' ); ?></td>
								<td><?php echo esc_html( $wpdb->db_version() ); ?></td>
							</tr>
							<tr>
								<td data-export-label="GD Library"><?php esc_html_e( 'GD Library:', 'matjar' ); ?></td>
								<td>
									<?php
									$info = esc_attr__( 'Not Installed', 'matjar' );
									if ( extension_loaded( 'gd' ) && function_exists( 'gd_info' ) ) {
										$info = esc_attr__( 'Installed', 'matjar' );
										$gd_info = gd_info();
										if ( isset( $gd_info['GD Version'] ) ) {
											$info = $gd_info['GD Version'];
										}
									}
									echo esc_html( $info );
									?>
								</td>
							</tr>
							<tr>
								<td data-export-label="cURL"><?php esc_html_e( 'cURL:', 'matjar' ); ?></td>
								<td>
									<?php
									$info = esc_attr__( 'Not Enabled', 'matjar' );
									if ( function_exists( 'curl_version' ) ) {
										$curl_info = curl_version();
										$info = $curl_info['version'];
									}
									echo esc_html( $info );
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>		
	</div>
	<div class="row">
		<div class="col-12">
			<div class="matjar-box install-plugin ">
				<div class="matjar-box-header">
					<div class="title"><?php esc_html_e('Installation Required Plugins','matjar');?></div>
				</div>
				<div class="matjar-box-body">
					<table class="widefat">
						<thead>
							<tr>
								<th> <?php esc_html_e('Plugin', 'matjar');?> </th>
								<th> <?php esc_html_e('Version','matjar');?> </th>
								<th> <?php esc_html_e('Type', 'matjar');?> </th>
								<th> <?php esc_html_e('Action', 'matjar');?> </th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ( $plugins as $tgm_plugin ) { ?>
								<tr>
									<td>
										<?php
										if ( isset( $tgm_plugin['required'] ) && ( $tgm_plugin['required'] == true ) ) {
											if ( ! matjar_tgmpa_is_plugin_check_active( $tgm_plugin['slug'] ) ){
												echo '<span>' . $tgm_plugin['name'] . '</span>';
												$tgm_plugins_required ++;
											} else {
												echo '<span class="actived">' . $tgm_plugin['name'] . '</span>';
											}
										} else {
											echo esc_html( $tgm_plugin['name'] );
										}?>
									</td>
									<td><?php echo( isset( $tgm_plugin['version'] ) ? $tgm_plugin['version'] : '' ); ?></td>
									<td><?php echo( isset( $tgm_plugin['required'] ) && ( $tgm_plugin['required'] == true ) ? 'Required' : 'Recommended' ); ?></td>
									<td>
										<?php echo wp_kses_post( $tgm_plugins_action[ $tgm_plugin['slug'] ] ); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
require_once MATJAR_FRAMEWORK.'admin/dashboard/footer.php';