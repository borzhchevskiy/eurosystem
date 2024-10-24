<?php 
/**
 * Ajax search
 */
if( !class_exists( 'Matjar_Ajax_Search' ) ){
	class Matjar_Ajax_Search {

		public function __construct() {
			add_action( 'wp_ajax_matjar_ajax_search', array( $this, 'ajax_suggestions' ) );
			add_action( 'wp_ajax_nopriv_matjar_ajax_search', array( $this, 'ajax_suggestions' ) );
		}
		
		/**
		 * Search for post by category.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_post_by_category () {
			$search_text	= isset($_REQUEST['query']) ? $_REQUEST['query'] : '';
			$args			= array(
				'taxonomy'      => array( 'category' ), // taxonomy name
				'orderby'       => 'id', 
				'order'         => 'ASC',
				'hide_empty'    => true,
				'fields'        => 'all',
				'name__like'    => $search_text
			); 
			$terms = get_terms( $args);		
			return $terms;
		}
		
		/**
		 * Search for post by tag.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_post_by_tag () {
			$search_text	= isset($_REQUEST['query']) ? $_REQUEST['query'] : '';
			$args			= array(
				'taxonomy'      => array( 'post_tag' ), // taxonomy name
				'orderby'       => 'id', 
				'order'         => 'ASC',
				'hide_empty'    => true,
				'fields'        => 'all',
				'name__like'    => $search_text
			); 
			$terms = get_terms( $args);		
			return $terms;
		}
		
		/**
		 * Search for products by category.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_products_by_category () {
			$search_text	= isset($_REQUEST['query']) ? $_REQUEST['query'] : '';
			$args 			= array(
				'taxonomy'      => array( 'product_cat' ), // taxonomy name
				'orderby'       => 'id', 
				'order'         => 'ASC',
				'hide_empty'    => true,
				'fields'        => 'all',
				'name__like'    => $search_text
			); 
			$terms = get_terms( $args);		
			return $terms;
		}
		
		/**
		 * Search for products by brand.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_products_by_brand () {
			$search_text	= isset($_REQUEST['query']) ? $_REQUEST['query'] : '';
			$results = array();
			$args			= array(
				'taxonomy'      => array( 'product_brand' ),
				'orderby'       => 'id', 
				'order'         => 'ASC',
				'hide_empty'    => true,
				'fields'        => 'all',
				'name__like'    => $search_text
			); 
			$terms = get_terms( $args);
			if (!empty($terms) && !is_wp_error($terms)) {
				return $terms;
			}
			return $results;
		}
		
		/**
		 * Search for products.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_products ( $args ) {
			global $woocommerce;
			$ordering_args 		= $woocommerce->query->get_catalog_ordering_args( 'title', 'asc' );
			$hide_outofstock 	= get_option( 'woocommerce_hide_out_of_stock_items' ) != 'no';
			$defaults = $args;

			// Add products to the results.
			$args['s'] 			= apply_filters( 'matjar_ajax_search_products_search_query', esc_attr( $_REQUEST['query'] ) );
			$args['post_type'] 	= 'product';
			$args['orderby'] 	= $ordering_args['orderby'];
			$args['order'] 		= $ordering_args['order'];
			$args['tax_query'] 	= WC()->query->get_tax_query();
			$args['meta_query'] = WC()->query->get_meta_query();

			if ( !empty( $_REQUEST['product_cat'] ) ) {
				$args['tax_query'][] = array(
						'relation' => 'AND',
					array(
						'taxonomy' 	=> 'product_cat',
						'field' 	=> 'slug',
						'terms' 	=> esc_attr( $_REQUEST['product_cat'] )
					)
				);
			}
			$search_query 	= http_build_query( $args );
			$query_function = apply_filters( 'matjar_ajax_search_function', 'get_posts', $search_query, $args, $defaults );

			return ( ( $query_function == 'get_posts' ) || ! function_exists( $query_function ) )
			? get_posts( $args )
			: $query_function( $search_query, $args, $defaults );
		}
		
		/**
		 * Search for products by sku.
		 *
		 * @param  array $args
		 * @return array
		 */
		function ajax_search_products_by_sku ( $args ) {
			$query = apply_filters( 'matjar_ajax_search_products_by_sku_search_query', esc_attr( $_REQUEST['query'] ) );
			$stock_status = get_option('woocommerce_hide_out_of_stock_items');
			$query_args = array(
				'post_status'		=> 'publish',
				'post_type'			=> 'product',
				'posts_per_page'	=> $args['posts_per_page'],
				'meta_query'		=> array(
						array(
							'key' 	=> '_sku',
							'value' => $query,
						)
				),
				'tax_query'		=> array(
						'relation'	=> 'AND',
				),
			);
			if( $stock_status == 'yes'){
				$query_args['meta_query'][] = array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => '!='
				);
			}
			$query_args = $this->ajax_search_catalog_visibility( $query_args );
			$results 	= new WP_Query($query_args);
			$simple_product_results = $results->get_posts();
			
			$args_variation_sku = array(
				'post_type'        => 'product_variation',
				'posts_per_page'   => $args['posts_per_page'],
				'meta_query'       => array(
					array(
						'key'     => '_sku',
						'value'   => trim( $query ),
						'compare' => 'like',
					),
				),
				'suppress_filters' => 0,
			);
			if( $stock_status == 'yes'){
				$args_variation_sku['meta_query'][] = array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => '!='
				);
			}
		
			$products_variation_sku		= get_posts( $args_variation_sku );
			$products    				= array_merge( $simple_product_results, $products_variation_sku );
			return $products;
		}

		/**
		 * Check product catalog visibility with custom tax_query. (only queries the exclude-from-search term)
		 *
		 * @param  array $query_args
		 * @return array
		 */
		function ajax_search_catalog_visibility( $query_args ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$query_args['tax_query'][] = array(
				'taxonomy' 	=> 'product_visibility',
				'field' 	=> 'term_taxonomy_id',
				'terms' 	=> $product_visibility_term_ids['exclude-from-search'],
				'operator' 	=> 'NOT IN',
			);
			$query_args['post_parent'] = 0;

			return $query_args;
		}
		
		/**
		 * Search for posts.
		 *
		 * @param  array $args
		 * @return array
		 */
		public function ajax_search_posts ( $args ) {
			$defaults = $args;

			$args['s'] 			= apply_filters( 'matjar_ajax_search_query', esc_attr( $_REQUEST['query'] ) );
			$args['post_type'] 	= array( 'post', 'page' );

			$search_query 		= http_build_query( $args );
			$query_function 	= apply_filters( 'matjar_ajax_search_function', 'get_posts', $search_query, $args, $defaults );

			return ( ( $query_function == 'get_posts' ) || ! function_exists( $query_function ) )
			? get_posts( $args )
			: $query_function( $search_query, $args, $defaults );
		}
		
		/**
		 * Search for portfolio.
		 *
		 * @param  array $args
		 * @return array
		 */
		public function ajax_search_portfolio ( $args ) {
			$defaults = $args;

			$args['s'] 			= apply_filters( 'matjar_ajax_search_query', esc_attr( $_REQUEST['query'] ) );
			$args['post_type'] 	= array( 'portfolio');

			$search_query 		= http_build_query( $args );
			$query_function 	= apply_filters( 'matjar_ajax_search_function', 'get_posts', $search_query, $args, $defaults );

			return ( ( $query_function == 'get_posts' ) || ! function_exists( $query_function ) )
			? get_posts( $args )
			: $query_function( $search_query, $args, $defaults );
		}
		
		function productIdExist($products, $key, $val) {
			foreach ($products as $item){
				if (isset($item[$key]) && $item[$key] == $val)
				{
					return true;
				}
			}
			return false;
		} 
		
		/**
		 * Search AJAX handler.
		 *
		 * @return array
		 */
		function ajax_suggestions () {
			
			if ( ! wp_verify_nonce( $_POST['nonce'], 'matjar_nonce' ) ) {
				$no_results = __( 'No data found.', 'matjar' ) ;
				$suggestions[] = array(
					'id' 	=> - 1,
					'value' => $no_results,
					'url' 	=> '',
				);
				echo json_encode( array( 'suggestions' => $suggestions ) );
				die();
			}
			
			$query 					= apply_filters( 'matjar_ajax_search_query', esc_attr( $_REQUEST['query'] ) );
			$products 				= array();
			$posts 					= array();
			$portfolio 				= array();
			$sku_products 			= array();
			$product_brands 		= array();
			$product_categories 	= array();
			$post_category 			= array();
			$post_cat 				= array();
			$support_post_type 		= matjar_get_option( 'search-content-type','all' );
			$product_search_by_sku	= matjar_get_option( 'product-search-by-sku', 0 );
			$args 					= apply_filters( 'matjar_ajax_search_default_args', array(
				's' 					=> $query,
				'orderby' 				=> '',
				'post_type' 			=> array(),
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> 10,
				'ignore_sticky_posts' 	=> 1,
				'post_password' 		=> '',
				'suppress_filters' 		=> false,
			) );
			if( $support_post_type == 'all' || $support_post_type == 'product' ){
				if ( MATJAR_WOOCOMMERCE_ACTIVE ) {
					$products 		= $this->ajax_search_products( $args );
					if( $product_search_by_sku ){
						$sku_products 	= $this->ajax_search_products_by_sku( $args );
					}
					if( empty( $_REQUEST['product_cat'] ) ){					
						if(apply_filters('matjar_ajax_product_cat_search',true)){
							$product_categories = $this->ajax_search_products_by_category();
						}
						if(apply_filters('matjar_ajax_product_brand_search',true)){
							$product_brands = $this->ajax_search_products_by_brand();
						}					
					}		
				}
			}
		  
			if ( empty( $_REQUEST['product_cat'] ) ) {
				if($support_post_type == 'all' || $support_post_type == 'post'){
					$posts = $this->ajax_search_posts( $args );
					if(apply_filters('matjar_ajax_post_category_search',true)){
						$post_category = $this->ajax_search_post_by_category(  );
					}
					if(apply_filters('matjar_ajax_post_tag_search',true)){
						$post_tag = $this->ajax_search_post_by_tag(  );
					}
				}
			}
			if ( empty( $_REQUEST['product_cat'] ) ) {
				if($support_post_type == 'all' || $support_post_type == 'portfolio'){
					$portfolio = $this->ajax_search_portfolio( $args );
				}
			}
			$results = array_merge( $products, $sku_products, $posts, $portfolio );
		 
			$suggestions = array();

			foreach ( $results as $key => $post ) {
				if ( $post->post_type == 'product' && MATJAR_WOOCOMMERCE_ACTIVE ) {
					global $product;
					$product 		= wc_get_product( $post );
					$product_image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ) );
					$rating_count 	= $product->get_rating_count();
					$average 		= $product->get_average_rating();
					$product_exist 	= $this->productIdExist($suggestions,'id',$product->get_id()); //Fix duplicate product
					if( ! $product_exist ){
						$product_data = [ 
								'type' 		=> 'Product',
								'id' 		=> $product->get_id(),
								'value' 	=> $product->get_title(),
								'url' 		=> $product->get_permalink()
							];
						if( matjar_get_option( 'header-search-image', 1 ) ){
							$product_data['img'] = $product_image[0];
						}
						if( matjar_get_option( 'header-search-price', 1 ) ){
							$product_data['price'] = ( ! is_user_logged_in() && matjar_get_loop_prop( 'login-to-see-price' ) ) ? '' : $product->get_price_html();
						}
						if( matjar_get_option( 'header-search-rating', 0 ) && wc_review_ratings_enabled() ){
							$product_data['rating'] = wc_get_rating_html( $average, $rating_count );
						}
						$suggestions[] = apply_filters( 'matjar_ajax_suggestion_args', $product_data );
					}
				} else {
					$suggestions[] = apply_filters( 'matjar_ajax_suggestion_args', array(
						'type' 		=> 'Page',
						'id' 		=> $post->ID,
						'value' 	=> get_the_title( $post->ID ),
						'url' 		=> get_the_permalink( $post->ID ),
						'img' 		=> get_the_post_thumbnail_url( $post->ID, 'thumbnail' ),
						'price'		=> '',
					) );
				}
			}
			if( ! empty( $post_category ) ){
				foreach( $post_category as $terms => $term_data ){
					$suggestions[] = array(
						'type' 	=> 'post_cat',
						'id' 	=> 'term-'.$term_data->term_id,
						'value' => $term_data->name,
						'url' 	=> get_term_link( $term_data),
					);
				}		  
			}
			if( ! empty( $post_tag ) ){
				foreach( $post_tag as $terms => $term_data ){
					$suggestions[] = array(
						'type' 	=> 'post_cat',
						'id' 	=> 'term-'.$term_data->term_id,
						'value' => $term_data->name,
						'url' 	=> get_term_link( $term_data),
					);
				}		  
			}
			if( ! empty( $product_categories ) ){
				foreach( $product_categories as $terms => $term_data ){
					$suggestions[] = array(
						'type' 	=> 'product_cat',
						'id' 	=> 'term-'.$term_data->term_id,
						'value' => $term_data->name,
						'url' 	=> get_term_link( $term_data),
					);
				}		  
			}
			if( ! empty( $product_brands ) ){
				foreach( $product_brands as $terms => $term_data ){
					$suggestions[] = array(
						'type' 	=> 'product_brand',
						'id' 	=> 'term-'.$term_data->term_id,
						'value' => $term_data->name,
						'url' 	=> get_term_link( $term_data),
					);
				}		  
			}
			if ( empty( $suggestions ) ) {
				$no_results = MATJAR_WOOCOMMERCE_ACTIVE ? esc_html__( 'No products found.', 'matjar' ) : esc_html__( 'No matches found', 'matjar' );
				$suggestions[] = array(
					'id' 	=> - 1,
					'value' => $no_results,
					'url' 	=> '',
				);
			}
			echo json_encode( array( 'suggestions' => $suggestions ) );
			die();
		}
		
	}
	$obj_matjar_ajax_earch = new Matjar_Ajax_Search();
}