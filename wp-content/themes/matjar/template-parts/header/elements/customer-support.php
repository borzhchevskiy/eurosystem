<?php
/**
 * Template part for displaying customer support
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
}?>			

<?php if( ! empty( matjar_get_option( 'header-phone-number', '(+123) 4567 890' ) )  || ! empty( matjar_get_option( 'header-email','support@matjar.com' ) ) ){ ?>
	<div class="customer-support">
		<div class="customer-support-wrap">
			<?php if( ! empty( matjar_get_option( 'header-phone-number', '(+123) 4567 890' ) ) ){ ?>
				<span class="contact-phone"><strong><?php esc_html_e('Support: ', 'matjar');?></strong><?php echo esc_html( matjar_get_option( 'header-phone-number', '(+123) 4567 890' ) );?></span>
			<?php } ?>
			<?php if( ! empty( matjar_get_option( 'header-email','support@matjar.com' ) ) ){ ?>
				<span class="contact-email"><strong><?php esc_html_e('Email: ', 'matjar');?></strong><?php echo esc_html( matjar_get_option( 'header-email','support@matjar.com' ) );?></span>
			<?php } ?>
		</div>
	</div>
<?php } ?>
