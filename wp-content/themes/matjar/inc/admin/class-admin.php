<?php
 /**
 * Matjar Include Admin Customizer Function
 *
 * @package WordPress
 * @subpackage Matjar
 * @since Matjar 1.0
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class Matjar_Admin {
	public $prefix;
	
	function __construct() {
		$this->prefix 			= MATJAR_PREFIX;
		$theme_data 			= wp_get_theme();
        $this->current_version 	= $theme_data->get('Version');	
		
		/*Admin menu*/
		add_action( 'admin_menu', array( $this, 'theme_page_menu' ) );		
		
		// Register walker replacement
		add_action('wp_update_nav_menu_item', array( $this, 'save_custom_fields' ), 10, 3 );		
		add_action( 'wp_nav_menu_item_custom_fields',   array( $this, 'custom_menu_field'), 10 , 4 );
	}
	
	public function theme_page_menu() {
		$menu_title = apply_filters( 'matjar_menu_title', 'Matjar' );
		$menu_icon = apply_filters( 'matjar_menu_icon', MATJAR_URI.'/inc/admin/assets/images/menu-icon.png' );
		
        add_menu_page( $menu_title,
			$menu_title,
            'manage_options',
            'matjar-theme',
            array( $this, 'matjar_dashboard_page' ),$menu_icon,
			25
        );
		add_submenu_page( 'matjar-theme',
            esc_html__( 'Welcome', 'matjar' ),
            esc_html__( 'Welcome', 'matjar' ),
            'manage_options',
            'matjar-theme',
            array( $this, 'matjar_dashboard_page' )
        );
		add_submenu_page( 'matjar-theme',
            esc_html__( 'System Status', 'matjar' ),
            esc_html__( 'System Status', 'matjar' ),
            'manage_options',
            'matjar-system-status',
            array( $this, 'matjar_system_status' )
        );		
    }
	
	public function matjar_dashboard_page() {
		require( MATJAR_FRAMEWORK. '/admin/dashboard/welcome.php' );
	}
	
	public function matjar_system_status() {		 
		require(MATJAR_FRAMEWORK. '/admin/dashboard/system_status.php' );
	}
	
	public function save_custom_fields($menu_id, $menu_item_db_id, $args){
		
		$custom_fields = array('enable','design','width','height','custom_block','label_text','label_color','icon','thumbnail_url','attachment_id');

		foreach ( $custom_fields as $key ) {
			$value = isset($_REQUEST['menu-item-'.$key][$menu_item_db_id]) ? $_REQUEST['menu-item-'.$key][$menu_item_db_id] : '';
			update_post_meta( $menu_item_db_id, '_menu_item_matjar_'.$key, $value );
		}
	}
		
	public function custom_menu_field($item_id, $item, $depth, $args ){
		
		$enable  		= get_post_meta( $item_id, '_menu_item_matjar_enable',  true );
		$design  		= get_post_meta( $item_id, '_menu_item_matjar_design',  true );
		$custom_block  	= get_post_meta( $item_id, '_menu_item_matjar_custom_block',  true );
		$height  		= get_post_meta( $item_id, '_menu_item_matjar_height',  true );
		$width   		= get_post_meta( $item_id, '_menu_item_matjar_width',   true );
		$label_text   	= get_post_meta( $item_id, '_menu_item_matjar_label_text',  true );
		$label_color   	= get_post_meta( $item_id, '_menu_item_matjar_label_color',  true );
		$icon    		= get_post_meta( $item_id, '_menu_item_matjar_icon',    true );		
		$attachment_id  = get_post_meta( $item_id, '_menu_item_matjar_attachment_id',  true );
		$thumbnail_url  = get_post_meta( $item_id, '_menu_item_matjar_thumbnail_url',  true );
		$icon_btn_text = (!empty($thumbnail_url)) ? esc_html__('Change Custom Icon','matjar') : esc_html__('Upload Custom Icon','matjar');
		$megamenu_class = ($enable != 'enabled') ? 'hidden-field' : '';
		$img_remove_cls = (empty($thumbnail_url)) ? 'hidden-field' : '';
		$custom_size_class = (($design == 'custom-size') && ($enable == 'enabled')) ? '' : 'hidden-field';
		$custom_blocks = matjar_get_posts_by_post_type('block');
		$custom_block_edit_link = !empty($custom_block) ? admin_url( 'post.php?post='.$custom_block.'&action=edit' ) : 'javascript:void();'; ?>
		
		<!--  Matjar custom fields-->
		<div id="matjar-custom-fields" class="matjar-custom-fields">
			<p class="description description-wide matjar-megamenu-enable">
				<label for="edit-menu-item-megamenu-enable-<?php echo esc_attr( $item_id ); ?>">
					<input type="checkbox" id="edit-menu-item-megamenu-enable-<?php echo esc_attr( $item_id ); ?>" data-itemid=<?php echo esc_attr( $item_id ); ?> class="widefat code edit-menu-item-megamenu-enable" name="menu-item-enable[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked($enable,'enabled')?> />
					<strong><?php esc_html_e( 'Enable Mega Menu (only for main menu)', 'matjar' ); ?></strong>
				</label>
			</p>
			<p class="description description-wide matjar-menu-design megamenu-field <?php echo esc_attr($megamenu_class);?>">
				<label for="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Design', 'matjar'); ?><br>
					<select id="edit-menu-item-design-<?php echo esc_attr( $item_id ); ?>" data-field="matjar-menu-design" data-itemid="<?php echo esc_attr( $item_id ); ?>" class="widefat matjar-menu-design" name="menu-item-design[<?php echo esc_attr( $item_id ); ?>]">
						<option value="full-width" <?php selected( esc_attr( $design ), 'full-width', true); ?>><?php esc_html_e('Full width', 'matjar'); ?></option>
						<option value="custom-size" <?php selected( esc_attr( $design ), 'custom-size', true); ?>><?php esc_html_e('Custom sizes', 'matjar'); ?></option>
					</select>
				</label>
			</p>
			<div id="matjar-custom-design-block-<?php echo esc_attr( $item_id ); ?>" class="matjar-custom-design-block <?php echo esc_attr($custom_size_class);?>">
			<p class="description description-thin matjar-menu-width">
				<label for="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Width', 'matjar'); ?><br>
					<input type="number" id="edit-menu-item-width-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-width[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($width);?>">
				</label>
			</p>			
			<p class="description description-thin matjar-menu-height ">
				<label for="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Height', 'matjar'); ?><br>
					<input type="number" id="edit-menu-item-height-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-height[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($height);?>">
				</label>
			</p>
			</div>
			<p class="description description-wide matjar-menu-custom-block megamenu-field <?php echo esc_attr($megamenu_class);?>">
				<label for="edit-menu-item-custom-block-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e('Select block', 'matjar'); ?><br>
					<select id="edit-menu-item-custom-block-<?php echo esc_attr( $item_id ); ?>" data-field="matjar-menu-custom-block" class="widefat matjar-custom-block select" name="menu-item-custom_block[<?php echo esc_attr( $item_id ); ?>]">
						<option value=""><?php esc_html_e('Select block','matjar');?></option>
						<?php
						if(!empty($custom_blocks)){
							foreach ($custom_blocks as $id => $title) {
							$edit_link = admin_url( 'post.php?post='.$id.'&action=edit' );
							?>
							<option value="<?php echo esc_attr($id);?>" <?php selected($custom_block,$id); ?> data-block-link="<?php echo esc_url($edit_link);?>"><?php echo esc_html($title);?></option>
							<?php
							}
						}
						?>
					</select>
					<?php if(!empty( $custom_block ) ){?>
					<a href="<?php echo esc_url($custom_block_edit_link);?>" class="edit-block-link" target="_blank"><?php esc_html_e( 'Edit megamenu block', 'matjar' ); ?></a> | 
					<?php } ?>
					<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=block' ) ); ?>" class="add-block-link" target="_blank"><?php esc_html_e( 'Add megamenu block', 'matjar' ); ?></a>
				</label>
			</p>
			
			<p class="description description-thin matjar-label-text">
				<label for="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>">					
					<?php esc_html_e('Label text','matjar');?><br>
					<input id="edit-menu-item-label-text-<?php echo esc_attr( $item_id ); ?>" class="widefat" name="menu-item-label_text[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($label_text);?>" type="text">
				
			</p>
			<p class="description description-thin matjar-label-color">
				<label for="edit-menu-item-label-color-<?php echo esc_attr( $item_id ); ?>">					
					<?php esc_html_e('Label color','matjar');?></label><br>
					<input id="edit-menu-item-label-color-<?php echo esc_attr( $item_id ); ?>" class="widefat matjar-color-box" name="menu-item-label_color[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($label_color);?>" type="text">
				
			</p>
			<p class="description description-thin matjar-menu-icon">
				<label for="edit-menu-item-icon-<?php echo esc_attr( $item_id ); ?>">
					<a href="#" class="button-secondary pick-icon"><i class=" fa <?php echo esc_attr($icon);?>"></i> <?php esc_html_e( 'Menu Icon', 'matjar' ) ?></a>
					<span class="icons-block">
						<input type="text" class="search-icon" placeholder="<?php esc_attr_e( 'Quick search', 'matjar' ) ?>">
						<span class="matjar-icon-close"> X </span>
						<span class="icon-selector">
							<i data-icon="">&nbsp;</i>
							<?php echo implode( "\n", matjar_get_themejr_icons($icon) ); ?>
						</span>
					</span>
					<input type="hidden" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($icon);?>">
				</label>
			</p>			
			<p class="description description-thin matjar-menu-icon-img">				
				<label for="edit-menu-item-megamenu-thumbnail-<?php echo esc_attr( $item_id ); ?>">
					<span class="img-wrp">
						<?php if(!empty($thumbnail_url)){?>
						<img src="<?php echo esc_url($thumbnail_url);?>" id="matjar-media-img-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="matjar-megamenu-thumbnail-image matjar-attr-img" height="32" width="32" align="left" alt="<?php echo esc_attr__('Menu icon','matjar');?>"/>
						<span data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="matjar-menu-image-clear"></span>
						<?php }?>
					</span>					
					<a href="#" id="matjar-media-upload-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" class="matjar-menu-image-upload button button-primary"><?php echo esc_html($icon_btn_text ); ?></a>
				</label>
				<input type="hidden" id="edit-menu-item-thumbnail-url-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" name="menu-item-thumbnail_url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($thumbnail_url);?>" />
				<input type="hidden" id="matjar-attachment-<?php echo esc_attr( $item_id ); ?>" data-itemid = "<?php echo esc_attr( $item_id ); ?>" name="menu-item-attachment_id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr($attachment_id);?>" />
			</p>
			
		</div><!-- End #matjar-custom-fields. -->
		
	<?php
	}
}
$obj_matjar_admin = new Matjar_Admin();