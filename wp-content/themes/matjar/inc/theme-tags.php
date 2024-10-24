<?php
/**
 * Custom template tags for Matjar
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Matjar
 * @since Matjar 1.0
 */

/**
 * Display page title on header.
 */
if ( ! function_exists( 'matjar_get_page_title' ) ) :
	function matjar_get_page_title() {		
		global $wp_query;
		$output = '';

		if ( is_singular() ) {
			
			$post = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;
			$page_title = '';
			if ( is_page() && matjar_get_option( 'parent-page-title', 0 ) ) {
				$page_title = empty($post->post_parent) ? '' : get_the_title($post->post_parent);
			} else if (!is_page() && matjar_get_option( 'archives-page-title', 0 ) ) {
				if ( isset( $post->post_type ) && $post->post_type == 'post' && matjar_get_option( 'archives-page-title', 0 ) ) {
					if (get_option( 'show_on_front' ) == 'page') {
						$page_title = get_the_title( get_option('page_for_posts', true) );
					} else {
						$page_title = matjar_page_title_archive($post->post_type);
					}
				} else if ( isset( $post->post_type ) && $post->post_type == 'product' && matjar_get_option( 'archives-page-title', 0 ) ) {
					$post_type = 'product';
					$post_type_object = get_post_type_object( $post_type );
					if ( is_object( $post_type_object ) && function_exists( 'wc_get_page_id' ) ) {
						$shop_page_id = wc_get_page_id( 'shop' );
						$page_title  = $shop_page_id ? get_the_title( $shop_page_id ) : '';
						if ( !$page_title  ) {
							$page_title  = $post_type_object->labels->name;
						}else{
							$page_title .= ' - ' . get_the_title();
						}
					}
				} else {
					$page_title = matjar_page_title_archive($post->post_type);
					$page_title .= ' - ' . get_the_title();
				}
			}

			if ( $page_title ) {
				$output.= $page_title;
			} else {
				$single_post_title = matjar_get_option( 'single-post-title-text', 'Our Blog' );
				$custom_page_title 				= matjar_get_post_meta('custom_page_title');
				if(!empty($custom_page_title )){
					$output .= $custom_page_title ;
				}elseif(!empty($single_post_title) && is_singular('post')){
					$output .= matjar_get_option( 'single-post-title-text', 'Our Blog' );
				}else{
					$output .= get_the_title( $post->ID );
				}
				
			}
		} else {
			
			if ( is_post_type_archive() ) {
				
				if ( is_search() ) {
					$output .= sprintf( esc_html__( 'Search Results: %s', 'matjar' ), esc_html( get_search_query() ) );
				} else {
					$output .= matjar_page_title_archive();
				}
			} elseif ( (is_tax() || is_tag() || is_category()) &&  matjar_get_option( 'blog-page-title', 1 ) ) { 
				$term = $wp_query->get_queried_object();
				$html = $title = $term->name;

				if ( is_tag() ) {
					$output .= sprintf( __( 'Tag Archives: %s', 'matjar' ), $html );
				} elseif ( is_tax('product_tag') ) {
					$output .= sprintf( __( 'Product Tag: %s', 'matjar' ), $html );
				} else {
					$output .= $html;
				}
			} elseif ( is_date() &&  matjar_get_option( 'blog-page-title', 1 ) ) {
				if ( is_year() ) {
					$output .= sprintf( esc_html__( 'Yearly Archives: %s', 'matjar' ), get_the_date( _x( 'Y', 'yearly archives date format', 'matjar' ) ) );
				} elseif ( is_month() ) {
					$output .= sprintf( esc_html__( 'Monthly Archives: %s', 'matjar' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'matjar' ) ) );
				} elseif ( is_day() ) {
					$output .= sprintf( esc_html__( 'Daily Archives: %s', 'matjar' ), get_the_date() );
				}else{
					$output .= esc_html__( 'Archives', 'matjar' );
				}
			} elseif ( is_author() &&  matjar_get_option( 'blog-page-title', 1 ) ) {
				$user 	= $wp_query->get_queried_object();
				$output .= sprintf( esc_html__( 'Author Archives: %s', 'matjar' ), $user->display_name );
			} elseif ( is_search() ) {
				$output .= sprintf( esc_html__( 'Search Results: %s', 'matjar' ), esc_html( get_search_query() ) );
			} elseif ( is_404() ) {
				$output .= esc_html__( 'Error 404', 'matjar' );
			}else {
				
				if ( is_home() && !is_front_page() ) {
					
					if( matjar_get_option( 'blog-page-title', 1 ) && !empty( trim( matjar_get_option( 'blog-page-title-text', 'Blog' ) ) ) ){
						$output .= matjar_get_option( 'blog-page-title-text', 'Blog' );
					}elseif( get_option( 'show_on_front' ) == 'page'  && matjar_get_option( 'blog-page-title', 1 ) ){
						$output .= get_the_title( get_option('page_for_posts', true) );
					}
				}else{
					if( matjar_get_option( 'blog-page-title', 1 ) ){
						$output .= matjar_get_option( 'blog-page-title-text', 'Blog' );
					}
				}
			}
		}

		return apply_filters( 'matjar_get_page_title', $output );
	}
endif;

function matjar_page_title_shop() {
    $post_type = 'product';
    $post_type_object = get_post_type_object( $post_type );

    $output = '';
    if ( is_object( $post_type_object ) && class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
        $shop_page_id = wc_get_page_id( 'shop' );
        $shop_page_name = $shop_page_id ? get_the_title( $shop_page_id ) : '';

        if ( ! $shop_page_name ) {
            $shop_page_name = $post_type_object->labels->name;
        }
        $output .= $shop_page_name;
    }

    return $output;
}

function matjar_page_title_archive( $post_type = null ) {
    global $wp_query;

    if (!$post_type)
        $post_type = $wp_query->query_vars['post_type'];
    $post_type_object = get_post_type_object( $post_type );
    $archive_title = '';

    if ( is_object( $post_type_object ) ) {

        // woocommerce
        if ( $post_type == 'product' && $shop_title = matjar_page_title_shop() ) {
            return $shop_title;
        }
		
        // default
        $archive_title = matjar_title_archive_name( $post_type );
    }

    return $archive_title;
}

function matjar_title_archive_name( $post_type = null ) {
    global $wp_query;

    if (!$post_type)
        $post_type = $wp_query->query_vars['post_type'];

    $page_id = 0;
    switch ($post_type) {
        case 'post':
            if (get_option( 'show_on_front' ) == 'page') {
                $page_id = (int) (get_option('page_for_posts', true));
            }
            break;
        case 'portfolio':
            $page_id = (int) esc_attr( matjar_get_option('portfolio-archive-page', null ) );
            break;
    }

    $archive_title = '';

    if ($page_id && ($post = get_post( $page_id ) )) {
        $archive_title = $post->post_title;
    } elseif($post_type == 'portfolio'){
		$archive_title = matjar_get_option('portfolio-page-title-text', 'Portfolio' );
	}else {
        $post_type_object = get_post_type_object( $post_type );

        if ( is_object( $post_type_object ) ) {

            if ( isset( $post_type_object->label ) && $post_type_object->label !== '' ) {
                $archive_title = $post_type_object->label;
            } elseif ( isset( $post_type_object->labels->menu_name ) && $post_type_object->labels->menu_name !== '' ) {
                $archive_title = $post_type_object->labels->menu_name;
            } else {
                $archive_title = $post_type_object->name;
            }
        }
    }
	
    return $archive_title;
}

/**
 * Post content
 */
if ( ! function_exists( 'matjar_the_content' ) ) {
	function matjar_the_content() {
		global $post;
		$content_type 	= matjar_get_loop_prop( 'blog-post-content' );
		$excerpt_length = matjar_get_loop_prop( 'blog-excerpt-length' );

		if ( $content_type == 'full-content' && matjar_get_loop_prop( 'name' ) != 'related-posts' ) {
			echo str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', get_the_content( '' ) ) );
		} else {
			if ( $post->post_excerpt ) {
				if( !empty( $excerpt_length ) ){
					echo matjar_get_excerpt_from_content( intval( $excerpt_length ) ); // phpcs:ignore
				}else{
					the_excerpt();
				}
				
			} else {
				echo matjar_get_excerpt_from_content( intval( $excerpt_length ) ); // phpcs:ignore
			}
		}
	}
}

/**
 * Get excerpt from post content
 */
if ( ! function_exists( 'matjar_get_excerpt_from_content' ) ) {
	function matjar_get_excerpt_from_content( $limit ) {
		return wp_trim_words( get_the_excerpt(), $limit );
	}
}

/**
 * Return image files
 */
if ( ! function_exists( 'matjar_get_post_image' ) ) :
	
	function matjar_get_post_image($size ='large', $post_id = '') {
		$prefix = MATJAR_PREFIX;
		$image = '';
		$post_id = $post_id ? $post_id : get_the_ID();
		
		if ( $meta = get_post_meta( $post_id, $prefix.'post_format_image', true ) ) { 
			$image = $meta;
		}
		
		if(wp_get_attachment_url( $image )){
			$image = wp_get_attachment_image( $image, 'large' );
		}
		return $image;
	}
endif;

/**
 * Return video files
 */
if ( ! function_exists( 'matjar_get_post_video' ) ) {
	
	function matjar_get_post_video($post_id = '') {
		
		$prefix = MATJAR_PREFIX;
		$video = '';
		$post_id = $post_id ? $post_id : get_the_ID();
		
		if ( $meta = get_post_meta( $post_id, $prefix.'post_format_video', true ) ) { 
			$video = $meta;
		}
		
		if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
			return '<div class="responsive-video-wrap">'. $oembed .'</div>';
		}else {
			$video = apply_filters( 'the_content', $video );
			if ( strpos( $video, 'youtube' ) || strpos( $video, 'vimeo' ) ) {
				return '<div class="responsive-video-wrap">'. $video .'</div>';
			}else {
				return $video;
			}
		}		
	}
}
/**
 * Return audio files
 */
if ( ! function_exists( 'matjar_get_post_audio' ) ) {
	
	function matjar_get_post_audio($post_id = '') {
		$prefix = MATJAR_PREFIX;
		$audio = '';
		$post_id = $post_id ? $post_id : get_the_ID();
		
		if ( $meta = get_post_meta( $post_id, $prefix.'post_format_audio', true ) ) { 
			$audio = $meta;
		}
		$audio = apply_filters( 'the_content', $audio );
		return $audio;
		
	}
}

/**
 * Function to get post view count
 */
if ( ! function_exists( 'matjar_post_views' ) ) :
	function matjar_post_views( $post_id = 0 ){
		
		$prefix = MATJAR_PREFIX;		
		global $post;
		$post_id = $post->ID;		
		$views = get_post_meta( $post_id, $prefix.'views_count', true );
		
		if(empty($views)){
			$views = 0;
		}
		$views_rounded = matjar_get_round_number( $views );
		
		$post_view_tag = '%s<span class="post-meta-label"> %s</span>';
		$output = sprintf('<span class="post-view">%s</span>',
			sprintf( 
				_n(
					sprintf( $post_view_tag, '%s', esc_html__( 'View', 'matjar' ) ),
					sprintf( $post_view_tag, '%s', esc_html__( 'Views', 'matjar' ) ),
				$views ), 
				$views_rounded
			)
		);		
		echo apply_filters( 'matjar_post_views', $output);
	}
endif;

/**
 * Calculate Post Reading Time in Minutes
 */
if ( ! function_exists( 'matjar_calculate_post_reading_time' ) ) {
	function matjar_calculate_post_reading_time( $post_id = null ) {
		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$post_content = get_post_field( 'post_content', $post_id );
		$strip_shortcodes = strip_shortcodes( $post_content );
		$strip_tags = strip_tags( $strip_shortcodes );
		$locale = matjar_get_locale();
		if ( 'ru_RU' === $locale ) {
			$word_count = count( preg_split( '/\s+/', $strip_tags ) );
		} else {
			$word_count = str_word_count( $strip_tags );
		}
		$reading_time = intval( ceil( $word_count / 250 ) );
		return $reading_time;
	}
}

/**
 * Update Post Reading Time on Post Save
 */
function matjar_update_post_reading_time( $post_id, $post, $update ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$prefix = MATJAR_PREFIX;
	$reading_time = matjar_calculate_post_reading_time( $post_id );
	update_post_meta( $post_id, $prefix.'reading_time', $reading_time );
}

add_action( 'save_post', 'matjar_update_post_reading_time', 10, 3 );

/**
 * Get Post Reading Time from Post Meta
 */
function matjar_get_post_reading_time( $post_id = null ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$prefix = MATJAR_PREFIX;
	// Get existing post meta.
	$reading_time = get_post_meta( $post_id, $prefix.'reading_time', true );
	// Calculate and save reading time, if there's no existing post meta.
	if ( ! $reading_time ) {
		$reading_time = matjar_calculate_post_reading_time( $post_id );
		update_post_meta( $post_id, $prefix.'reading_time', $reading_time );
	}
	return $reading_time;
}

if ( ! function_exists( 'matjar_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Matjar 1.0
 */
function matjar_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h3><span><?php esc_html_e( 'Comment Navigation', 'matjar' ); ?><span></h3>
		<div class="nav-links">
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'matjar' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'matjar' ) ); ?></div>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'matjar_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Matjar 1.0
 */
function matjar_entry_meta() {
	
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'matjar' ) );
	}
	
	$postmeta	= matjar_get_loop_prop( 'specific-post-meta' );
	$format 	= get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) && ( !empty($postmeta) && in_array('post-format', $postmeta ))) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'matjar' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( in_array( get_post_type(), array('attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
			_x( 'Posted on', 'Used before publish date.', 'matjar' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( 'post' == get_post_type() ) {
		if ( (is_singular() || is_multi_author()) && ( !empty($postmeta) && in_array('post-author', $postmeta ) ) ) {
			printf( '<span class="byline"><span class="author vcard"><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
				_x( 'Author', 'Used before post author name.', 'matjar' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_the_author()
			);
		}

		$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'matjar' ) );
		if ( $categories_list && matjar_categorized_blog() && ( !empty($postmeta) && in_array('cat-links', $postmeta ))) {
			printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Categories', 'Used before category names.', 'matjar' ),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'matjar' ) );
		if ( $tags_list && ( !empty($postmeta) && in_array('tags-links', $postmeta ) ) ) {
			printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
				_x( 'Tags', 'Used before tag names.', 'matjar' ),
				$tags_list
			);
		}
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'matjar' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) && in_array('comments-link', matjar_get_option('specific-post-meta', array('post-author', 'post-date', 'post-comments' ) ) ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'matjar' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Matjar 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function matjar_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'matjar_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'matjar_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so matjar_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so matjar_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see matjar_categorized_blog()}.
 *
 * @since Matjar 1.0
 */
function matjar_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'matjar_categories' );
}
add_action( 'edit_category', 'matjar_category_transient_flusher' );
add_action( 'save_post',     'matjar_category_transient_flusher' );

if ( ! function_exists( 'matjar_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Matjar 1.0
 */
function matjar_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) : ?>

	<div class="post-thumbnail">
		<?php if(wp_get_attachment_url( get_post_thumbnail_id() )) :
			 the_post_thumbnail('large');
		else:?>
			<img src="<?php echo esc_url(MATJAR_IMAGES.'/blog-placeholder.jpg');?>"/>
		<?php endif;?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>
	
	<div class="entry-thumbnail">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php if(wp_get_attachment_url( get_post_thumbnail_id() )) :
				the_post_thumbnail( 'large', array( 'alt' => get_the_title() ) );
			else:?>
				<img src="<?php echo esc_url(MATJAR_IMAGES.'/blog-placeholder.jpg');?>"/>
			<?php endif;?>
		</a>
		<?php matjar_image_overlay();?>
	</div>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'matjar_small_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Matjar 1.0
 */
function matjar_small_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}?>
	<div class="entry-thumbnail">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php if(wp_get_attachment_url( get_post_thumbnail_id() )) :
				the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) );
			else:?>
				<img src="<?php echo esc_url(MATJAR_IMAGES.'/blog-placeholder.jpg');?>"/>
			<?php endif;?>
		</a>
		<?php matjar_image_overlay();?>
	</div>
	<?php
}
endif;

function matjar_image_overlay(){
	
	$image_link = wp_get_attachment_url( get_post_thumbnail_id() ); ?>
	<div class="hover-overlay">
		<div class="hover-overlay-btn">
			<a href="<?php echo esc_url($image_link);?>" class="zoom-gallery"><i class="jricon-magnifier icon-animation"></i></a>
			<a href="<?php echo esc_url( get_permalink());?>" class="portfolio-detail"><i class="jricon-link icon-animation"></i></a>
		</div>
	</div>
<?php 
}

if ( ! function_exists( 'matjar_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Matjar 1.0
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function matjar_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'matjar_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Matjar 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function matjar_excerpt_more( $more ) {
	if( ! matjar_get_loop_prop( 'read-more-button' ) ) return;
	
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( matjar_get_loop_prop( 'post-readmore-text' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'matjar_excerpt_more' );
endif;
