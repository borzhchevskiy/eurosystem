<?php

if ( ! function_exists( 'matjar_get_terms' ) ) :
	function matjar_get_terms($args = array(), $args2 = ''){
		$return_data = array();
		
		if( !empty($args2) ){
			$result = get_terms( $args, $args2 );
		}else{
			if( !isset($args['hide_empty']) ){
				$args['hide_empty'] = true;
			}
			$result = get_terms( $args );
		}
		
		if ( is_wp_error( $result ) ) {
			return $return_data;
		}
		
		if ( !is_array( $result ) || empty( $result ) ) {
			return $return_data;
		}
		
		foreach ( $result as $term_data ) {
			if ( is_object( $term_data ) && isset( $term_data->name, $term_data->term_id ) ) {
				$return_data[ $term_data->name . ( ( isset($args['counts']) && $args['counts'] ) ? " (".$term_data->count.")" : '' )] = $term_data->term_id;
			}
		}
		return $return_data;
	}
endif;
if ( ! function_exists( 'matjar_get_all_image_sizes' ) ) :
    /**
     * Returns all image sizes available.
     *
     * @since 1.0.0
     *
     * @param bool $for_choice True/False to construct the output as key and value choice
     * @return array Image Size Array.
     */
    function matjar_get_all_image_sizes( $for_choice = false ) {

        global $_wp_additional_image_sizes;

        $sizes = array();

        if( true == $for_choice ){
            $sizes['no-image'] = __( 'No Image', 'matjar-core' );
        }

        foreach ( get_intermediate_image_sizes() as $_size ) {
            if ( in_array( $_size, array('thumbnail', 'medium', 'large') ) ) {

                $width = get_option( "{$_size}_size_w" );
                $height = get_option( "{$_size}_size_h" );

                if( true == $for_choice ){
                    $sizes[$_size] = ucfirst($_size) . ' (' . $width . 'x' . $height . ')';
                }else{
                    $sizes[ $_size ]['width']  = $width;
                    $sizes[ $_size ]['height'] = $height;
                    $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
                }
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                $width = $_wp_additional_image_sizes[ $_size ]['width'];
                $height = $_wp_additional_image_sizes[ $_size ]['height'];

                if( true == $for_choice ){
                    $sizes[$_size] = ucfirst($_size) . ' (' . $width . 'x' . $height . ')';
                }else{
                    $sizes[ $_size ] = array(
                        'width'  => $width,
                        'height' => $height,
                        'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                    );
                }
            }
        }

        if( true == $for_choice ){
            $sizes['full'] = __( 'Full Image', 'matjar-core' );
        }

        return $sizes;
    }
endif;

/**
* Get server info
*/
if( ! function_exists( 'matjar_get_server_info' ) ) {
	function matjar_get_server_info(){
		return $_SERVER['SERVER_SOFTWARE'];
	}
}

/**
 * Function to add array after specific key
 * 
 * @package Matjar Core
 * @since 1.0.0
 */
function matjar_add_array($array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {
        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }    
    return $array;
}

/* 	Social share
/* --------------------------------------------------------------------- */
if( ! function_exists( 'matjar_social_share' ) ) {
	function matjar_social_share( $atts = array(), $echo = true ) {
		
		
		extract(shortcode_atts( array(
			'type' 			=> 'share',			
			'style' 		=> 'icon-bordered',
			'shape' 		=> 'icons-shape-circle',
			'size' 			=> 'icons-size-default',
		), $atts ));
			
		$classes []		= 'matjar-social';
		$classes []		= $style;
		$classes []		= $shape;
		$classes []		= $size;
		$classes 		= implode( ' ', $classes );		
		$post_title 	= '';
		$post_link 		= '';
		$share_twitter_username = '';
		$thumb_id 		= '';
		$thumb_url 		= array( 0=> '' );
		$enabled_social_networks = array();
		
		if($type == 'share' && matjar_get_option( 'social-sharing', 1 ) ){
			$post_title   = htmlspecialchars( urlencode( html_entity_decode( esc_attr( get_the_title() ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
			$post_link = get_the_permalink();
			// Twitter username
			$share_twitter_username = matjar_get_option( 'share_twitter_username', '' ) ? ' via %40'.matjar_get_option( 'share_twitter_username','' ) : '';
			$thumb_id 	= get_post_thumbnail_id();
			$thumb_url 	= wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true );
			$social_networks = (array) matjar_get_option( 'social-share-manager', array(
                'enabled'  =>array(
					'facebook' 		=> 'Facebook',
					'twitter'     	=> 'Twitter',
					'linkedin'   	=> 'Linkedin',
					'telegram'		=> 'Telegram',
					'pinterest'		=> 'Pinterest',
				)
			));
			
			if(!isset($social_networks['enabled'])){
				$social_networks['enabled'] = array(
					'facebook' 		=> 'Facebook',
					'twitter'     	=> 'Twitter',
					'linkedin'   	=> 'Linkedin',
					'telegram'		=> 'Telegram',
					'pinterest'		=> 'Pinterest',
				);
			}
			
			$enabled_social_networks = $social_networks['enabled'];			
		}
		
		// Buttons array
		$share_buttons = array(

			'facebook' => array(
				'url'  => 'https://www.facebook.com/sharer/sharer.php?u='. $post_link,
				'text' => esc_html__( 'Facebook', 'matjar-core' ),
				'icon' => 'jricon-facebook',
			),

			'twitter' => array(
				'url'   => 'https://twitter.com/share?url='. $post_title . $share_twitter_username .'&amp;url='. $post_link,
				'text'  => esc_html__( 'Twitter', 'matjar-core' ),
				'icon' => 'jricon-x-twitter',
			),

			'linkedin' => array(
				'url'  => 'https://www.linkedin.com/shareArticle?mini=true&url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'LinkedIn', 'matjar-core' ),
				'icon' => 'jricon-linkedin',
			),

			'stumbleupon' => array(
				'url'  => 'http://www.stumbleupon.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'StumbleUpon', 'matjar-core' ),
				'icon' => 'jricon-stumbleupon',
			),

			'tumblr' => array(
				'url'  => 'https://tumblr.com/widgets/share/tool?canonicalUrl='. $post_link .'&amp;name='. $post_title,
				'text' => esc_html__( 'Tumblr', 'matjar-core' ),
				'icon' => 'jricon-tumblr',
			),

			'pinterest' => array(
				'url'  => 'https://pinterest.com/pin/create/button/?url='. $post_link .'&amp;description='. $post_title .'&amp;media='. $thumb_url[0],
				'text' => esc_html__( 'Pinterest', 'matjar-core' ),
				'icon' => 'jricon-pinterest-alt',
			),

			'reddit' => array(
				'url'  => 'https://reddit.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text' => esc_html__( 'Reddit', 'matjar-core' ),
				'icon' => 'jricon-reddit',
			),
			'vk' => array(
				'url'  => 'https://vk.com/share.php?url='. $post_link,
				'text' => esc_html__( 'VKontakte', 'matjar-core' ),
				'icon' => 'jricon-vk',
			),
			
			'odnoklassniki' => array(
				'url'  => 'https://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='. $post_link .'&amp;description='. $post_title .'&amp;media='. $thumb_url[0],
				'text' => esc_html__( 'Odnoklassniki', 'matjar-core' ),
				'icon' => 'jricon-odnoklassniki',
			),
			
			'pocket' => array(
				'url'  => 'https://getpocket.com/save?title='. $post_title .'&amp;url='.$post_link,
				'text' => esc_html__( 'Pocket', 'matjar-core' ),
				'icon' => 'jricon-pocket',
			),
			
			'whatsapp' => array(
				'url'   => 'https://wa.me/?text='. $post_link,
				'text'  => esc_html__( 'WhatsApp', 'matjar-core' ),
				'icon' => 'jricon-whatsapp',
				'avoid_esc' => true,
			),
			
			'telegram' => array(
				'url'   => 'https://telegram.me/share/url?url='.$post_link,
				'text'  => esc_html__( 'Telegram', 'matjar-core' ),
				'icon'  => 'jricon-telegram',
				'avoid_esc' => true,
			),	
			
			'email' => array(
				'url'  => 'mailto:?subject='. $post_title .'&amp;body='. $post_link,
				'text' => esc_html__( 'Email', 'matjar-core' ),
				'icon' => 'jricon-envelope',
			),
			
			'print' => array(
				'url'  => '#',
				'text' => esc_html__( 'Print', 'matjar-core' ),
				'icon' => 'jricon-printer',
				'check'=> matjar_get_option('share-print', 0 ),
			),
			
			'tiktok' => array(
				'url'  => '#',
				'text' => esc_html__( 'TikTok', 'matjar-core' ),
				'icon' => 'jricon-tik-tok',
			),
			
			'instagram' => array(
				'url'  => '#',
				'text' => esc_html__( 'Instagram', 'matjar-core' ),
				'icon' => 'jricon-instagram',
			),
			
			'flickr' => array(
				'url'  => '#',
				'text' => esc_html__( 'Flickr', 'matjar-core' ),
				'icon' => 'jricon-flickr',
			),
			
			'rss' => array(
				'url'  => '#',
				'text' => esc_html__( 'RSS', 'matjar-core' ),
				'icon' => 'jricon-feed',
			),
			
			'youtube' => array(
				'url'  => '#',
				'text' => esc_html__( 'Youtube', 'matjar-core' ),
				'icon' => 'jricon-youtube',
			),
			
			'github' => array(
				'url'  => '#',
				'text' => esc_html__( 'Github', 'matjar-core' ),
				'icon' => 'jricon-github',
			),			
		);
		
		$share_buttons = apply_filters( 'matjar_social_share_buttons', $share_buttons );
		
		$active_share_buttons = array();
		
		foreach ( $share_buttons as $network => $button ){
			$social_link = '';
			
			if($type == 'share' && array_key_exists( $network, $enabled_social_networks ) ){
				$social_link = $button['url'];
			}elseif($type == 'profile' && matjar_get_option( $network.'-link', '' ) ){
				$social_link = matjar_get_option($network.'-link','');
			}
			if( !empty($social_link)  && ! isset( $button['avoid_esc'] ) ){
				$button['url'] = esc_url( $social_link );
			}
			if( !empty( $social_link ) ){
				$active_share_buttons[$network] = '<a href="'. $social_link .'" rel="external" target="_blank" class="social-'. $network.'"><i class="'. $button['icon'] .'"></i> <span class="social-text">'. $button['text'] .'</span></a>';
			}
		}
		
		/**
		* social share icon order
		*/
		$active_share = array();
		if( ! empty( $enabled_social_networks ) ){
			foreach( $enabled_social_networks as $social_key => $value ){
				if(isset($active_share_buttons[$social_key]))
				$active_share[$social_key] =  $active_share_buttons[$social_key]; 
			}
			$active_share_buttons = array_merge( $active_share, $active_share_buttons );
		}
		if( is_array( $active_share_buttons ) && ! empty( $active_share_buttons ) ){
			if( $echo ){	?>
				<div class="<?php echo esc_attr($classes);?>">
					<?php echo implode( '', $active_share_buttons ); ?>
				</div>
			<?php			
			}else{
				return implode( '', $active_share_buttons );
			}		
		} 
	}
}

/**
* Get post order
*/
function matjar_post_order(){
	//Post Order
	$post_order = array(
		'latest'   => esc_html__( 'Recent Posts', 'matjar-core' ),
		'rand'     => esc_html__( 'Random Posts', 'matjar-core' ),
		'modified' => esc_html__( 'Last Modified Posts', 'matjar-core' ),
		'popular'  => esc_html__( 'Most Commented posts', 'matjar-core' ),
	);
	$post_order['views'] = esc_html__( 'Most Viewed posts', 'matjar-core' );
	

	return apply_filters( 'matjar_post_order', $post_order );
}

/* Function to get required plugin list*/
function matjar_get_required_plugins_list() {   
    $plugins = array(
		array(
			'name'                     => 'Matjar Core',
			'slug'                     => 'matjar-core',
			'required'                 => true,
			'url'                      => 'matjar-core/matjar-core.php',
			'version'                  => '1.0',
		),
		array(
            'name'                     => 'Revolution Slider',
            'slug'                     => 'revslider',
            'required'                 => true,
            'url'                      => 'revslider/revslider.php',
        ),
        array(
            'name'                     => 'Elementor',
            'slug'                     => 'elementor',
            'required'                 => true,
            'url'                      => 'elementor/elementor.php',
        ),
		array(
            'name'                     => 'Woocommerce',
            'slug'                     => 'woocommerce',
            'required'                 => true,
            'url'                      => 'woocommerce/woocommerce.php',
        ),			
    );
    return $plugins;
}

/**
* Get menu label HTML
*/
function matjar_menu_label( $label_txt = '',$label_color = '',$echo = true) {
	if(empty($label_txt) && empty($label_color)){
		return false;
	}
	$lable_style = '';
	if(!empty($label_color)){
		$lable_style = 'style="background-color:'.$label_color.'"';
	}
	if(!empty($label_txt)){
		$label_html = '<span class="menu-label" '.$lable_style.'>'.$label_txt.'</span>';
	}
	if($echo){
		echo apply_filters('matjar_menu_label',$label_html,$label_txt,$label_color);
	}else{
		return apply_filters('matjar_menu_label',$label_html,$label_txt,$label_color);
	}
}


/**
 * Get post type dropdown
 */
function matjar_get_posts_dropdown($post_type ='post',$select_options = ''){
	$results = array();
	$args = array('post_type'	=> $post_type,
				'post_status' 	=>  array('publish'),
				'posts_per_page'=>-1);
	$post_type_query = get_posts( $args );
	if(!empty($select_options)){
		$results[' '] = $select_options;
	}
    foreach ( $post_type_query as $p ):
		$results[$p->ID] = $p->post_title;
    endforeach; 
	return $results;
}

/**
 * Get shortcode template parts.
 */
function matjar_get_pl_templates( $slug,$args = array() ) {
	$template = '';
	
	$template_path = 'template-parts/';
	$plugin_path = trailingslashit( MATJAR_CORE_DIR );
	
	// If template file doesn't exist, look in yourtheme/template-parts/elements-widgets/slug.php
	if ( ! $template ) {
		$template = locate_template( array(
			$template_path . "{$slug}.php"
		) );
	}
	
	// Get default slug.php
	if ( ! $template && file_exists( $plugin_path . "templates/{$slug}.php" ) ) {
		$template = $plugin_path . "templates/{$slug}.php";
	}
	
	// Allow 3rd party plugins to filter template file from their plugin.
	$template = apply_filters( 'matjar_get_pl_templates', $template, $slug);	
	extract( $args );
	if ( $template ) {		
		include( $template );
	}
}

function matjar_get_posts( $args ) {
	$defaults = array(
		'post_type'           	=> isset($args['post_type']) ? $args['post_type'] : 'post',
		'status'              	=> 'published',
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> isset($args['orderby']) ? $args['orderby'] : 'date',
		'order'               	=> isset($args['order']) ? $args['order'] : 'desc',
		'posts_per_page'      	=> isset( $args['limit'] ) > 0 ? intval( $args['limit'] ) : 10,
		'paged'      			=> isset($args['paged']) > 0 ? intval( $args['paged'] ) : 1,
	);
	if( isset($args['title']) ){
		unset($args['title']);
	}
	$args = wp_parse_args( $args, $defaults );
	// Posts Order
	if( ! empty( $orderby ) ){
		
		// Random Posts
		if( $args['orderby'] == 'rand' ){
			$args['orderby'] = 'rand';
		}

		// Most Viewd posts
		elseif( $args['orderby'] == 'views'){
			$prefix = MATJAR_PREFIX;
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = apply_filters( 'matjar_views_meta_field', $prefix.'views_count' );
		}

		// Popular Posts by comments
		elseif( $args['orderby'] == 'popular' ){
			$args['orderby'] = 'comment_count';
		}

		// Recent modified Posts
		elseif( $args['orderby']== 'modified' ){
			$args['orderby'] = 'modified';
		}		
	}
	//Specific categories
	$categories = isset($args['categories']) ? $args['categories'] : '';
	
	if( !empty($categories) ){
		$taxonomy = isset($args['taxonomy']) ? $args['taxonomy'] : 'category';
		$args['tax_query'][] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);
		
	}	
	
	// Exclude Blog
	if ( !empty($args['exclude']) ) {					
		$args['post__not_in'] = $args['exclude'];
		if(!empty($args['post__in'])){
			$args['post__in'] = array_diff( $args['post__in'], $args['post__not_in'] );
		}
	}
	return $args;
}

/**
 Vendor products
*/
function matjar_vendor_products($args){
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => $args['posts_per_page'],
		'author' => $args['author'],
		'ignore_sticky_posts'=> true,
		'no_found_rows'=> true
	);
	$args['meta_query'] 	= WC()->query->get_meta_query();
	$args['tax_query']   	= WC()->query->get_tax_query();
	$products = new WP_Query($args);
	return $products;
}

function matjar_get_products( $data_source, $atts, $args = array() ) {
	$defaults = array(
		'post_type'           	=> 'product',
		'status'              	=> 'published',
		'ignore_sticky_posts' 	=> 1,
		'orderby'             	=> isset($atts['orderby']) ? $atts['orderby'] : 'DATE',
		'order'               	=> isset($atts['order']) ? $atts['order'] : 'DESC',
		'posts_per_page'      	=> isset( $atts['limit'] ) > 0 ? intval( $atts['limit'] ) : 10,
		'paged'      			=> isset($atts['paged']) > 0 ? intval( $atts['paged'] ) : 1,
	);
	if( isset($atts['title']) ){
		unset($atts['title']);
	}
	$args['meta_query'] 	= WC()->query->get_meta_query();
	$args['tax_query']   	= WC()->query->get_tax_query();
	$args = wp_parse_args( $args, $defaults );
	
	switch ( $data_source ) {
		case 'featured_products';
			$args['tax_query'][] = array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'featured' ),
					'operator' => 'IN',
				),
			);			
			break;
		case 'sale_products';
			$product_ids_on_sale   = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$args['post__in']      = $product_ids_on_sale;
			break;
		case 'best_selling_products';
			$args['meta_key'] = 'total_sales';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;
		case 'top_rated_products';
			$args['meta_key'] = '_wc_average_rating';
			$args['orderby']  = 'meta_value_num';
			$args['order']    = 'DESC';
			break;		
		case 'products';
			if ( is_array($atts['product_ids']) && !empty( $atts['product_ids'] ) ) {
				$args['post__in'] = $atts['product_ids'];
			}elseif($atts['product_ids'] != '' ) {
				$args['post__in'] = explode( ',', $atts['product_ids'] );
			}
			break;
		case 'deal_products';
			 global $wpdb;
			// Get products on sale
			$product_ids_raw = $wpdb->get_results(
			"SELECT posts.ID, posts.post_parent
			FROM `$wpdb->posts` posts
			INNER JOIN `$wpdb->postmeta` ON (posts.ID = `$wpdb->postmeta`.post_id)
			INNER JOIN `$wpdb->postmeta` AS mt1 ON (posts.ID = mt1.post_id)
			WHERE
				posts.post_status = 'publish'
				AND  (mt1.meta_key = '_sale_price_dates_to' AND mt1.meta_value >= ".time().") 
				GROUP BY posts.ID 
				ORDER BY posts.post_title");

			$product_ids_on_sale = array();

			foreach ( $product_ids_raw as $product_raw ) 
			{
				if(!empty($product_raw->post_parent))
				{
					$product_ids_on_sale[] = $product_raw->post_parent;
				}
				else
				{
					$product_ids_on_sale[] = $product_raw->ID;  
				}
			}
			$product_ids_on_sale = array_unique($product_ids_on_sale);
			$args['post__in'] = $product_ids_on_sale;			
			break;
	}
	
	//Specific categories
	$categories = isset($atts['categories']) ? $atts['categories'] : '';
	
	if( !empty($categories) ){
		$taxonomy = isset($atts['taxonomy']) ? $atts['taxonomy'] : 'product_cat';
		$args['tax_query'][] = array(
				array(
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $categories
				)
			);
		
	}	
	// Exclude Products
	if ( !empty($atts['exclude']) ) {					
		$args['post__not_in'] = $atts['exclude'];
		if(!empty($args['post__in'])){
			$args['post__in'] = array_diff( $args['post__in'], $args['post__not_in'] );
		}
	}
	
	return $args;
}

function matjar_loadmore_product(){
	$response        = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr      		= isset( $_POST['attr'] ) ? $_POST['attr'] : array();
	$paged      	= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args      		=  $attr;	
	$args['paged'] 	= $paged;
	$query 			= matjar_get_products( $args['data_source'], $args );	
	$loop 			= new WP_Query( $query );	
	$max_num_page 	= $loop->max_num_pages;
	$query_paged  	= $loop->query_vars['paged'];
	if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
		$show_button = '1';
	} else {
		$show_button = '0';
	}
	if ( $max_num_page <= 1 ) {
		$show_button = 0;
	}	
	ob_start();
	
	$args['show_button'] =  $show_button;
	extract( $args );
	if( $product_style != 'default' ){
		matjar_set_loop_prop( 'product-style', $product_style );
	}	
	if( 'product-style-3' != $product_style && 'icon' == $cart_button_style ){
		matjar_set_loop_prop('product-action-buttons-style', 'product-cart-icon' );
	}
	matjar_set_loop_prop( 'products_view', 'grid-view' );
	if( isset( $products_countdown ) ){
		matjar_set_loop_prop( 'product-countdown', $products_countdown );
	}	
	matjar_set_loop_prop( 'products-columns', $grid_columns );
	matjar_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
	matjar_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
	wc_set_loop_prop( 'columns', $grid_columns );
	while ( $loop->have_posts() ) : $loop->the_post();
		wc_get_template_part( 'content-product' );       
	endwhile;
	wp_reset_postdata();
	matjar_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	$response['show_bt'] = $show_button;
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_matjar_loadmore_product', 'matjar_loadmore_product' );
add_action( 'wp_ajax_nopriv_matjar_loadmore_product', 'matjar_loadmore_product' );


function matjar_category_tab_product(){
	$response        = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr      		= isset( $_POST['attr'] ) ? $_POST['attr'] : array();
	$paged      	= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args      		=  $attr;	
	$args['paged'] 	= 1;
	$data_source = $args['data_source'];
	if( isset($args['data_source'])){
		$data_source = $args['data_source'];
	}
	
	$query 			= matjar_get_products( $data_source, $args );	
	$loop 			= new WP_Query( $query );
	
	ob_start();	
	
	extract( $args );
	if( $product_style != 'default' ){
		matjar_set_loop_prop( 'product-style', $product_style );
	}	
	if( 'product-style-3' != $product_style && 'icon' == $cart_button_style ){
		matjar_set_loop_prop('product-action-buttons-style', 'product-cart-icon' );
	}
	if( $layout == 'slider'){
		matjar_set_loop_prop('name','matjar-carousel');
	}
	
	matjar_set_loop_prop( 'products_view', 'grid-view' );
	if( isset( $products_countdown ) ){
		matjar_set_loop_prop( 'product-countdown', $products_countdown );
	}		
	matjar_set_loop_prop( 'products-columns', $grid_columns );
	matjar_set_loop_prop( 'products-columns-tablet', $grid_columns_tablet );
	matjar_set_loop_prop( 'products-columns-mobile', $grid_columns_mobile );
	wc_set_loop_prop( 'columns', $grid_columns );
	$count = 0;
	while ( $loop->have_posts() ) : 
		$loop->the_post();
		if( $rows > 1 && $count % $rows == 0 ){
			echo '<div class="carousel-group">';
		}
		wc_get_template_part( 'content-product' );
		if( $rows > 1 && ($count % $rows == $rows - 1 || $count == $loop->post_count - 1) ){
			echo '</div>';
		}
		$count++;
	endwhile;
	wp_reset_postdata();
	matjar_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_matjar_category_tab_product', 'matjar_category_tab_product' );
add_action( 'wp_ajax_nopriv_matjar_category_tab_product', 'matjar_category_tab_product' );

function matjar_loadmore_posts(){
	$response = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr			= isset( $_POST['attr'] ) ? $_POST['attr'] : '';
	$paged			= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args			= $attr;
	$args['paged'] 	= $paged;	
	$query 			= matjar_get_posts($args );	
	$loop 			= new WP_Query( $query );	
	$max_num_page 	= $loop->max_num_pages;
	$query_paged  	= $loop->query_vars['paged'];
	if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
		$show_button = '1';
	} else {
		$show_button = '0';
	}
	if ( $max_num_page <= 1 ) {
		$show_button = 0;
	}
	ob_start();	
	extract( $args );	
	matjar_set_loop_prop( 'name','posts-loop-shortcode');
	matjar_set_loop_prop( 'post-single-line-title', $post_single_line_title);
	matjar_set_loop_prop( 'blog-post-style', $blog_style );
	matjar_set_loop_prop( 'post-date', $post_date);
	matjar_set_loop_prop( 'post-category', $post_category);
	matjar_set_loop_prop( 'post-meta', $post_meta);
	wp_enqueue_script( 'masonry' );
	if( 'blog-grid' == $blog_style ){		
		matjar_set_loop_prop( 'blog-grid-layout', $grid_layout );
		matjar_set_loop_prop( 'blog-grid-columns', $grid_columns );
		matjar_set_loop_prop( 'blog-grid-columns-tablet', $grid_columns_tablet );
		matjar_set_loop_prop( 'blog-grid-columns-mobile', $grid_columns_mobile );
	}		
	matjar_set_loop_prop( 'show-blog-post-content', $show_blog_content );
	matjar_set_loop_prop( 'blog-post-content', $blog_content );
	matjar_set_loop_prop( 'blog-excerpt-length', $blog_excerpt_length );
	matjar_set_loop_prop( 'read-more-button', $read_more_btn);
	if(!$show_blog_content){
		matjar_set_loop_prop( 'read-more-button', 0);
	}else{
		matjar_set_loop_prop( 'read-more-button', $read_more_btn);
	}
	matjar_set_loop_prop( 'read-more-button-style', $read_more_btn_style );
	matjar_set_loop_prop( 'blog-custom-thumbnail-size', $image_size );
	matjar_set_loop_prop( 'blog-post-thumbnail', $blog_thumbnail );
	matjar_set_loop_prop( 'blog-post-title', $blog_title );		
	while ( $loop->have_posts() ) :
		$loop->the_post();			
		// Include the loop post content template.
		get_template_part( 'template-parts/post-loop/layout', get_post_format() );      
	endwhile;
	wp_reset_postdata();
	matjar_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	$response['show_bt'] = $show_button;
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_matjar_loadmore_posts', 'matjar_loadmore_posts' );
add_action( 'wp_ajax_nopriv_matjar_loadmore_posts', 'matjar_loadmore_posts' );

function matjar_loadmore_portfolios(){
	$response        = array(
		'html'    => '',
		'message' => '',
		'success' => 'no',
		'show_bt' => 'no'
	);
	$attr			= isset( $_POST['attr'] ) ? $_POST['attr'] : '';
	$paged			= isset( $_POST['page'] ) ? $_POST['page'] : '';
	$args			=  $_POST['attr'];	
	$args['paged'] 	= $paged;
	$args['limit'] 	= $args['limit'];
	$query 			= matjar_get_posts($args );	
	$loop 			= new WP_Query( $query );
	$max_num_page 	= $loop->max_num_pages;
	$query_paged  	= $loop->query_vars['paged'];
	if ( $query_paged >= 0 && ( $query_paged < $max_num_page ) ) {
		$show_button = '1';
	} else {
		$show_button = '0';
	}
	if ( $max_num_page <= 1 ) {
		$show_button = 0;
	}	
	ob_start();
	extract( $args );	
	matjar_set_loop_prop( 'name', 'portfolio-post-widget' );
	matjar_set_loop_prop( 'portfolio-style', $portfolio_style );
	matjar_set_loop_prop( 'portfolio-grid-layout', $portfolio_grid_layout );
	matjar_set_loop_prop( 'portfolio-grid-columns', $grid_columns );
	matjar_set_loop_prop( 'portfolio-grid-columns-tablet', $grid_columns_tablet );
	matjar_set_loop_prop( 'portfolio-grid-columns-mobile', $grid_columns_mobile );
	matjar_set_loop_prop( 'portfolio-content-part', $portfolio_content_part );
	matjar_set_loop_prop( 'portfolio-filter', $portfolio_filter );
	matjar_set_loop_prop( 'portfolio-button-icon', $portfolio_button_icon );
	matjar_set_loop_prop( 'portfolio-link-icon', $portfolio_link_icon );
	matjar_set_loop_prop( 'portfolio-zoom-icon', $portfolio_zoom_icon );
	matjar_set_loop_prop( 'portfolio-content-part', $portfolio_content_part );
	matjar_set_loop_prop( 'portfolio-category', $portfolio_category );
	matjar_set_loop_prop( 'portfolio-title', $portfolio_title );		
	while ( $loop->have_posts() ) :
		$loop->the_post();			
		// Include the loop post content template.
		get_template_part( 'template-parts/portfolio-loop/layout', get_post_format() );   
	endwhile;
	wp_reset_postdata();
	matjar_reset_loop();
	$response['html']    = ob_get_clean();
	$response['success'] = 'ok';
	$response['show_bt'] = $show_button;
	wp_send_json( $response );
	die();
}
add_action( 'wp_ajax_matjar_loadmore_portfolios', 'matjar_loadmore_portfolios' );
add_action( 'wp_ajax_nopriv_matjar_loadmore_portfolios', 'matjar_loadmore_portfolios' );