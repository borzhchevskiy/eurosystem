<?php
if (!class_exists('Matjar_Woocommerce')) {

	class Matjar_Woocommerce{
		public $prefix			= MATJAR_PREFIX;
		private $cat_sidebars	= array();
		private $blocks			= array();
		function __construct() {
			$this->blocks			= matjar_get_posts_by_post_type('block');
			$this->cat_sidebars['']	= esc_html__( 'Default', 'matjar' );
			global $wp_registered_sidebars;			
			if ( $wp_registered_sidebars ) {
				foreach ( $wp_registered_sidebars as $sidebar ) {
					$this->cat_sidebars[ $sidebar['id'] ] = $sidebar['name'];
				}
			}
			
			// Product Category field
			add_action( 'product_cat_add_form_fields', array( $this, 'add_category_fields' ), 30 );
			add_action( 'product_cat_edit_form_fields', array( $this, 'edit_category_fields' ), 20 );
			add_action( 'created_product_cat', array( $this, 'save_category_fields' ), 20 );
			add_action( 'edit_product_cat', array( $this, 'save_category_fields' ), 20 );
			// Add Brand Image Field 
			add_action( 'product_brand_add_form_fields', array( $this, 'add_brand_fields' ) );
			add_action( 'product_brand_edit_form_fields', array( $this, 'edit_brand_fields' ), 10, 2 );
			add_action( 'created_product_brand', array( $this, 'save_brand_fields' ), 10, 3 );
			add_action( 'edit_product_brand', array( $this, 'save_brand_fields' ), 10, 3 );
			// Add Brand Image Columns
			add_filter( 'manage_edit-product_brand_columns', array( $this, 'product_brand_columns' ) );
			add_filter( 'manage_product_brand_custom_column', array( $this, 'product_brand_column' ), 10, 3 );
			
			add_action( 'woocommerce_archive_description', array( $this, 'shop_page_top_block' ), 10 );
			add_action( 'woocommerce_after_shop_loop', array( $this, 'archive_bottom_block' ), 10 );
		}
		
		/**
		 * Category thumbnail fields.
		 */
		function add_category_fields() {
			$prefix = $this->prefix; // Taking metabox prefix
			?>
			<div class="form-field">
				<label for="matjar-image-icon"><?php echo esc_html__('Category Icon', 'matjar'); ?></label>
				<input type="hidden" class="matjar-attachment-id" name="<?php echo esc_attr( $prefix );?>category_icon">
				<img class="matjar-attr-img" src="<?php echo esc_url( wc_placeholder_img_src() );?>" alt="<?php echo esc_attr__('Select Image','matjar')?>" height="50px" width="50px">
				<button class="matjar-image-upload button" type="button"><?php echo esc_html__('Upload/Add Images','matjar');?></button>
				<button class="matjar-image-clear button" type="button" data-src="<?php echo esc_url( wc_placeholder_img_src() );?>"><?php esc_html_e('Remove image','matjar');?></button>
				 <p class="description"><?php esc_html_e('Upload icon for this category.', 'matjar'); ?></p>
			</div>
			<div class="form-field">
				<label for="matjar-image"><?php echo esc_html__('Header Banner', 'matjar'); ?></label>
				<input type="hidden" class="matjar-attachment-id" name="<?php echo esc_attr( $prefix );?>header_banner">
				<img class="matjar-attr-img" src="<?php echo esc_url( wc_placeholder_img_src() );?>" alt="<?php echo esc_attr__('Select Image','matjar')?>" height="50px" width="50px">
				<button class="matjar-image-upload button" type="button"><?php echo esc_html__('Upload/Add Images','matjar');?></button>
				<button class="matjar-image-clear button" type="button" data-src="<?php echo esc_url( wc_placeholder_img_src() );?>"><?php esc_html_e('Remove image','matjar');?></button>
				 <p class="description"><?php esc_html_e('Upload banner for this category..', 'matjar'); ?></p>
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Title Color', 'matjar' ); ?></label>           
				<select id="sidebar-color" name="<?php echo esc_attr( $prefix );?>sidebar_title_color">
					<option value="default"><?php echo esc_html__( 'Default', 'matjar'  ); ?></option>						
					<option value="light"><?php echo esc_html__( 'Light', 'matjar'  ); ?></option>						
					<option value="dark"><?php echo esc_html__( 'Dark', 'matjar'  ); ?></option>						
				</select>           
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Sidebar', 'matjar' ); ?></label>           
				<select id="sidebar-name" name="<?php echo esc_attr( $prefix );?>sidebar">
					<?php
					foreach ( $this->cat_sidebars as $key => $value ) {
						?>
						<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
				</select>           
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Category Top Content', 'matjar' ); ?></label>           
				<select id="matjar-blok" name="<?php echo esc_attr( $prefix );?>block">
					<option value=""><?php esc_html_e('Select block','matjar');?></option>
					<?php
					if( !empty( $this->blocks ) ){
						foreach ( $this->blocks as $key => $value ) {
							?>
							<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
							<?php
						}
					}
					?>
				</select>          
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Category Bottom Content', 'matjar' ); ?></label>           
				<select id="matjar-blok-bottom" name="<?php echo esc_attr( $prefix );?>bottom_block">
					<option value=""><?php esc_html_e('Select block','matjar');?></option>
					<?php
					if( !empty( $this->blocks ) ){
						foreach ( $this->blocks as $key => $value ) {
							?>
							<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
							<?php
						}
					}
					?>
				</select>          
			</div>
			<script>
				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '.matjar-attr-img').attr( 'src', '<?php echo esc_url(wc_placeholder_img_src()); ?>' );
						jQuery( '.matjar-attachment-id' ).val( '' );
						jQuery( '#sidebar-color' ).val( 'default' );
						jQuery( '#sidebar-name' ).val( '' );
						jQuery( '#matjar-blok' ).val( '' );
						jQuery( '#matjar-blok-bottom' ).val( '' );
						return;
					}
				} );
			</script>
			<?php
		}
		/**
		 * Edit category thumbnail field.
		 *
		 * @param mixed $term Term (category) being edited
		 */
		function edit_category_fields( $term ) {
			$prefix					= $this->prefix; // Taking metabox prefix
			$header_banner			= get_term_meta( $term->term_id, $prefix.'header_banner', true );
			$category_icon			= get_term_meta( $term->term_id, $prefix.'category_icon', true );
			$sidebar				= get_term_meta( $term->term_id, $prefix.'sidebar', true );
			$sidebar_title_color	= get_term_meta( $term->term_id, $prefix.'sidebar_title_color', true );
			$block					= get_term_meta( $term->term_id, $prefix.'block', true );
			$bottom_block			= get_term_meta( $term->term_id, $prefix.'bottom_block', true );
			$image					= wc_placeholder_img_src();
			$icon_image 			= wc_placeholder_img_src();
			if(!empty($header_banner)){
				$image = matjar_get_image_src( $header_banner,'thumnail');
			}
			if(!empty($category_icon)){
				$icon_image = matjar_get_image_src( $category_icon,'thumnail');
			}	
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="matjar-attr-icon-image"><?php esc_html_e('Category Icon', 'matjar'); ?></label></label></th>
				<td>
					<input type="hidden" class="matjar-attachment-id" value="<?php echo esc_attr($category_icon);?>" name="<?php echo esc_attr( $prefix );?>category_icon">
					<img class="matjar-attr-img" src="<?php echo esc_url($icon_image);?>" alt="<?php esc_attr_e('Select Image','matjar')?>" height="50px" width="50px">
					<button class="matjar-image-upload button" type="button"><?php esc_html_e('Upload/Add image','matjar');?></button>
					<button class="matjar-image-clear button" type="button" data-src="<?php echo wc_placeholder_img_src();?>"><?php esc_html_e('Remove image','matjar');?></button>
					<p class="description"><?php esc_html_e('Upload icon for this category.', 'matjar'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="matjar-attr-image"><?php esc_html_e('Header Banner', 'matjar'); ?></label></label></th>
				<td>
					<input type="hidden" class="matjar-attachment-id" value="<?php echo esc_attr($header_banner);?>" name="<?php echo esc_attr( $prefix );?>header_banner">
					<img class="matjar-attr-img" src="<?php echo esc_url($image);?>" alt="<?php esc_attr_e('Select Image','matjar')?>" height="50px" width="50px">
					<button class="matjar-image-upload button" type="button"><?php esc_html_e('Upload/Add image','matjar');?></button>
					<button class="matjar-image-clear button" type="button" data-src="<?php echo wc_placeholder_img_src();?>"><?php esc_html_e('Remove image','matjar');?></button>
					<p class="description"><?php esc_html_e('Upload banner for this category.', 'matjar'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Title Color', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-title-color" name="<?php echo esc_attr( $prefix );?>sidebar_title_color">
						<option value="default" <?php selected('default',$sidebar_title_color);?>><?php echo esc_html__( 'Default', 'matjar'  ); ?></option>						
						<option value="light" <?php selected('light',$sidebar_title_color);?>><?php echo esc_html__( 'Light', 'matjar'  ); ?></option>						
						<option value="dark" <?php selected('dark',$sidebar_title_color);?>><?php echo esc_html__( 'Dark', 'matjar'  ); ?></option>		
					</select>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Sidebar', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-sidebar" name="<?php echo esc_attr( $prefix );?>sidebar">
						<?php
						foreach ( $this->cat_sidebars as $key => $value ) {
							$selected = ( $key == $sidebar ) ? 'selected=selected' : '';
							?>
							<option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $value ); ?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Category Top Content', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-blok" name="<?php echo esc_attr( $prefix );?>block">
						<option value=""><?php esc_html_e('Select block','matjar');?></option>
						<?php
						if( !empty( $this->blocks ) ){
							foreach ( $this->blocks as $key => $value ) {
								$selected = ( $key == $block ) ? 'selected=selected' : '';
								?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $value ); ?></option>
								<?php
							}
						}
						?>
					</select>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Category Bottom Content', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-blok-bottom" name="<?php echo esc_attr( $prefix );?>bottom_block">
						<option value=""><?php esc_html_e('Select block','matjar');?></option>
						<?php
						if( !empty( $this->blocks ) ){
							foreach ( $this->blocks as $key => $value ) {
								$selected = ( $key == $bottom_block ) ? 'selected=selected' : '';
								?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $value ); ?></option>
								<?php
							}
						}
						?>
					</select>
				</td>
			</tr>
			<?php
		}
		
		/**
		 * save_category_fields function.
		 *
		 * @param mixed $term_id Term ID being saved
		 */
		function save_category_fields( $term_id ) {

			$prefix					= $this->prefix;
			$header_banner			= !empty($_POST[$prefix.'header_banner']) ? $_POST[$prefix.'header_banner'] : '';
			$category_icon			= !empty($_POST[$prefix.'category_icon']) ? $_POST[$prefix.'category_icon'] : '';
			$sidebar				= !empty($_POST[$prefix.'sidebar']) ? $_POST[$prefix.'sidebar'] : '';
			$sidebar_title_color	= !empty($_POST[$prefix.'sidebar_title_color']) ? $_POST[$prefix.'sidebar_title_color'] : '';
			$block 					= !empty($_POST[$prefix.'block']) ? $_POST[$prefix.'block'] : '';
			$bottom_block 					= !empty($_POST[$prefix.'bottom_block']) ? $_POST[$prefix.'bottom_block'] : '';
			update_term_meta($term_id, $prefix.'header_banner', $header_banner);
			update_term_meta($term_id, $prefix.'category_icon', $category_icon);
			update_term_meta($term_id, $prefix.'sidebar', $sidebar);
			update_term_meta($term_id, $prefix.'sidebar_title_color', $sidebar_title_color);
			update_term_meta($term_id, $prefix.'block', $block);
			update_term_meta($term_id, $prefix.'bottom_block', $bottom_block);
		}
		/**
		 * Category thumbnail fields.
		 */
		function add_brand_fields() {
			$prefix = $this->prefix; // Taking metabox prefix
			?>
			<div class="form-field">
				<label for="matjar-image-icon"><?php echo esc_html__('Thumbnail', 'matjar'); ?></label>
				<input type="hidden" class="matjar-attachment-id" name="thumbnail_id">
				<img class="matjar-attr-img" src="<?php echo esc_url( wc_placeholder_img_src() );?>" alt="<?php echo esc_attr__('Select Image','matjar')?>" height="50px" width="50px">
				<button class="matjar-image-upload button" type="button"><?php echo esc_html__('Upload/Add Images','matjar');?></button>
				<button class="matjar-image-clear button" type="button" data-src="<?php echo esc_url( wc_placeholder_img_src() );?>"><?php esc_html_e('Remove image','matjar');?></button>
				 <p class="description"><?php esc_html_e('Upload thumbnail for this brand.', 'matjar'); ?></p>
			</div>
			<div class="form-field">
				<label for="matjar-image"><?php echo esc_html__('Header Banner', 'matjar'); ?></label>
				<input type="hidden" class="matjar-attachment-id" name="<?php echo esc_attr( $prefix );?>header_banner">
				<img class="matjar-attr-img" src="<?php echo esc_url( wc_placeholder_img_src() );?>" alt="<?php echo esc_attr__('Select Image','matjar')?>" height="50px" width="50px">
				<button class="matjar-image-upload button" type="button"><?php echo esc_html__('Upload/Add Images','matjar');?></button>
				<button class="matjar-image-clear button" type="button" data-src="<?php echo esc_url( wc_placeholder_img_src() );?>"><?php esc_html_e('Remove image','matjar');?></button>
				 <p class="description"><?php esc_html_e('Upload header banner for this brand.', 'matjar'); ?></p>
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Title Color', 'matjar' ); ?></label>           
				<select id="sidebar-color" name="<?php echo esc_attr( $prefix );?>sidebar_title_color">
					<option value="default"><?php echo esc_html__( 'Default', 'matjar'  ); ?></option>						
					<option value="light"><?php echo esc_html__( 'Light', 'matjar'  ); ?></option>						
					<option value="dark"><?php echo esc_html__( 'Dark', 'matjar'  ); ?></option>						
				</select>           
			</div>
			<div class="form-field">
				<label><?php esc_html_e( 'Sidebar', 'matjar' ); ?></label>           
				<select id="sidebar-name" name="<?php echo esc_attr( $prefix );?>sidebar">
					<?php
					foreach ( $this->cat_sidebars as $key => $value ) { ?>
						<option value="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $value ); ?></option>
						<?php
					}
					?>
				</select>           
			</div>
			<script>
				jQuery( document ).ajaxComplete( function( event, request, options ) {
					if ( request && 4 === request.readyState && 200 === request.status
						&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

						var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
						if ( ! res || res.errors ) {
							return;
						}
						// Clear Thumbnail fields on submit
						jQuery( '.matjar-attr-img').attr( 'src', '<?php echo esc_url(wc_placeholder_img_src()); ?>' );
						jQuery( '.matjar-attachment-id' ).val( '' );
						jQuery( '#sidebar-color' ).val( 'default' );
						jQuery( '#sidebar-name' ).val( '' );
						return;
					}
				} );
			</script>
			<?php
		}
		/**
		 * Edit category thumbnail field.
		 *
		 * @param mixed $term Term (category) being edited
		 */
		function edit_brand_fields( $term ) {
			$prefix					= $this->prefix;
			$header_banner			= get_term_meta( $term->term_id, $prefix.'header_banner', true );
			$thumbnail_id			= get_term_meta( $term->term_id, 'thumbnail_id', true );
			$sidebar				= get_term_meta( $term->term_id, $prefix.'sidebar', true );
			$sidebar_title_color	= get_term_meta( $term->term_id, $prefix.'sidebar_title_color', true );
			$image					= wc_placeholder_img_src();
			$icon_image				= wc_placeholder_img_src();
			if(!empty($header_banner)){
				$image = matjar_get_image_src( $header_banner,'thumnail');
			}
			if(!empty($thumbnail_id)){
				$icon_image = matjar_get_image_src( $thumbnail_id,'thumnail');
			}	
			?>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="matjar-attr-icon-image"><?php esc_html_e('Thumbnail', 'matjar'); ?></label></label></th>
				<td>
					<input type="hidden" class="matjar-attachment-id" value="<?php echo esc_attr($thumbnail_id);?>" name="thumbnail_id">
					<img class="matjar-attr-img" src="<?php echo esc_url($icon_image);?>" alt="<?php esc_attr_e('Select Image','matjar')?>" height="50px" width="50px">
					<button class="matjar-image-upload button" type="button"><?php esc_html_e('Upload/Add image','matjar');?></button>
					<button class="matjar-image-clear button" type="button" data-src="<?php echo wc_placeholder_img_src();?>"><?php esc_html_e('Remove image','matjar');?></button>
					<p class="description"><?php esc_html_e('Upload thumbnail for this brand.', 'matjar'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label for="matjar-attr-image"><?php esc_html_e('Header Banner', 'matjar'); ?></label></label></th>
				<td>
					<input type="hidden" class="matjar-attachment-id" value="<?php echo esc_attr($header_banner);?>" name="<?php echo esc_attr( $prefix );?>header_banner">
					<img class="matjar-attr-img" src="<?php echo esc_url($image);?>" alt="<?php esc_attr_e('Select Image','matjar')?>" height="50px" width="50px">
					<button class="matjar-image-upload button" type="button"><?php esc_html_e('Upload/Add image','matjar');?></button>
					<button class="matjar-image-clear button" type="button" data-src="<?php echo wc_placeholder_img_src();?>"><?php esc_html_e('Remove image','matjar');?></button>
					<p class="description"><?php esc_html_e('Upload header banner for this brand', 'matjar'); ?></p>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Title Color', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-title-color" name="<?php echo esc_attr( $prefix );?>sidebar_title_color">
						<option value="default" <?php selected('default',$sidebar_title_color);?>><?php echo esc_html__( 'Default', 'matjar'  ); ?></option>						
						<option value="light" <?php selected('light',$sidebar_title_color);?>><?php echo esc_html__( 'Light', 'matjar'  ); ?></option>						
						<option value="dark" <?php selected('dark',$sidebar_title_color);?>><?php echo esc_html__( 'Dark', 'matjar'  ); ?></option>		
					</select>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row" valign="top"><label><?php esc_html_e( 'Sidebar', 'matjar' ); ?></label></th>
				<td>
					<select id="matjar-sidebar" name="<?php echo esc_attr( $prefix );?>sidebar">
						<?php
						foreach ( $this->cat_sidebars as $key => $value ) {
							$selected = ( $key == $sidebar ) ? 'selected=selected' : '';
							?>
							<option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $value ); ?></option>
							<?php
						}
						?>
					</select>
				</td>
			</tr>
			<?php
		}
		
		/**
		 * save_brand_fields function.
		 *
		 * @param mixed $term_id Term ID being saved
		 */
		function save_brand_fields( $term_id ) {

			$prefix					= $this->prefix;
			$header_banner			= !empty($_POST[$prefix.'header_banner']) ? $_POST[$prefix.'header_banner'] : '';
			$thumbnail_id			= !empty($_POST['thumbnail_id']) ? $_POST['thumbnail_id'] : '';
			$sidebar				= !empty($_POST[$prefix.'sidebar']) ? $_POST[$prefix.'sidebar'] : '';
			$sidebar_title_color	= !empty($_POST[$prefix.'sidebar_title_color']) ? $_POST[$prefix.'sidebar_title_color'] : '';
			update_term_meta($term_id, 'thumbnail_id', $thumbnail_id);
			update_term_meta($term_id, $prefix.'header_banner', $header_banner);			
			update_term_meta($term_id, $prefix.'sidebar', $sidebar);
			update_term_meta($term_id, $prefix.'sidebar_title_color', $sidebar_title_color);
		}
		
		/**
		 * Thumbnail column added to brand admin.
		 *
		 * @access public
		 * @param mixed $columns
		 * @return array
		 */
		function product_brand_columns( $columns ) {
			$new_columns          = array();
			$new_columns['cb']    = $columns['cb'];
			$new_columns['thumb'] = esc_html__( 'Image', 'matjar' );

			unset( $columns['cb'] );
			unset( $columns['description'] );

			return array_merge( $new_columns, $columns );
		}

		/**
		 * Thumbnail column value added to brand admin.
		 *
		 * @access public
		 * @param mixed $columns
		 * @param mixed $column
		 * @param mixed $id
		 * @return array
		 */
		function product_brand_column( $columns, $column, $id ) {

			if ( $column == 'thumb' ) {

				$image 			= '';
				$thumbnail_id 	= get_term_meta( $id, 'thumbnail_id', true );

				if ($thumbnail_id){
					$image = wp_get_attachment_thumb_url( $thumbnail_id );
				}else{
					$image = wc_placeholder_img_src();
				}
				$columns .= '<img src="' . esc_url( $image ) . '" alt="'.esc_attr__( 'Thumbnail','matjar' ).'" class="wp-post-image" style="max-width: 50px; max-height: 50px;" />';
			}

			return $columns;
		}
		
		public function shop_page_top_block(){			
			if ( matjar_is_catalog() ) {
				$block_id = matjar_get_option( 'shop-page-top-content', '' );
				if ( is_product_taxonomy() ) {
					$term = get_queried_object();
					if ( $term && ! empty( get_term_meta( $term->term_id, $this->prefix.'block',true) ) ) {
						$block_id = get_term_meta( $term->term_id, $this->prefix.'block',true);
					}
				}
				
				if( empty( trim( $block_id ) ) ){
					return;
				}
				echo '<div class="products-top-custom-content">';
				echo matjar_block_get_content($block_id);
				echo '</div>';
			}
		}
		
		public function archive_bottom_block(){
			if ( matjar_is_catalog() ) {
				$block_id = matjar_get_option( 'shop-page-bottom-content', '' );
				if ( is_product_taxonomy() ) {
					$term = get_queried_object();
					if ( $term && ! empty( get_term_meta( $term->term_id, $this->prefix.'bottom_block',true) ) ) {
						$block_id = get_term_meta( $term->term_id, $this->prefix.'bottom_block',true);
					}
				}
				if( empty( trim( $block_id ) ) ){
					return;
				}
				echo '<div class="products-bottom-custom-content">';
				echo matjar_block_get_content( $block_id);
				echo '</div>';
			}
		}
	}
	
	function matjar_woocommerce_class_init(){
		$obj_swatches = new Matjar_Woocommerce();
	}
	add_action( 'init', 'matjar_woocommerce_class_init');	
}