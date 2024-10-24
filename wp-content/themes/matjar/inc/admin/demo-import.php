<?php

function matjar_import_files() {
	return array(
		array(
			'import_file_name'             => 'Home1',
			'categories'                   => array( 'Electronics'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/home1/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/home1/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-data/home1/matjar_options.json',
					'option_name' => 'matjar_options',
				),
			),
			'import_preview_image_url'     => 'http://matjar.themejr.net/wp-content/uploads/2023/06/matjar-home1.webp',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'matjar' ),
			'preview_url'                  => 'http://matjar.themejr.net/home1/',
		),
		array(
			'import_file_name'             => 'Home2',
			'categories'                   => array( 'Electronics'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/home2/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/home2/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-data/home2/matjar_options.json',
					'option_name' => 'matjar_options',
				),
			),
			'import_preview_image_url'     => 'http://matjar.themejr.net/wp-content/uploads/2023/06/matjar-home2.webp',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'matjar' ),
			'preview_url'                  => 'http://matjar.themejr.net/home2/',
		),
		array(
			'import_file_name'             => 'Home3',
			'categories'                   => array( 'Fashion'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/home3/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/home3/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-data/home3/matjar_options.json',
					'option_name' => 'matjar_options',
				),
			),
			'import_preview_image_url'     => 'http://matjar.themejr.net/wp-content/uploads/2023/06/matjar-home3.webp',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'matjar' ),
			'preview_url'                  => 'http://matjar.themejr.net/home3/',
		),
		array(
			'import_file_name'             => 'Home4',
			'categories'                   => array( 'furniture'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/home4/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/home4/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-data/home4/matjar_options.json',
					'option_name' => 'matjar_options',
				),
			),
			'import_preview_image_url'     => 'http://matjar.themejr.net/wp-content/uploads/2023/06/matjar-home4.webp',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'matjar' ),
			'preview_url'                  => 'http://matjar.themejr.net/home4/',
		),
		array(
			'import_file_name'             => 'Home5',
			'categories'                   => array( 'Pharmacy'),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/home5/content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/home5/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo-data/home5/matjar_options.json',
					'option_name' => 'matjar_options',
				),
			),
			'import_preview_image_url'     => 'http://matjar.themejr.net/wp-content/uploads/2023/06/matjar-home5.webp',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'matjar' ),
			'preview_url'                  => 'http://matjar.themejr.net/home5/',
		),		
	);
}
add_filter('pt-ocdi/import_files', 'matjar_import_files');

function matjar_after_importer_setup($selected_import)
{
  // Assign menus to their locations.
  $main_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
  $topbar_menu = get_term_by('name', 'Topbar Menu', 'nav_menu');
  $categories_menu = get_term_by('name', 'Categories Menu', 'nav_menu');

  set_theme_mod(
    'nav_menu_locations',
    array(
      'primary' => $main_menu->term_id,
      'topbar-menu' => $topbar_menu->term_id,
      'categories-menu' => $categories_menu->term_id,
    )
  );

// Delete duplicates
		$pages2 = array('cart','checkout','my-account','wishlist');
		foreach ($pages2 as $p2) {
			$p = get_page_by_path($p2 . '-2');
			if ($p) {
				wp_delete_post( $p->ID, true);
			}
		}
		// Get Shop page
		$shop2 = get_page_by_path('shop-2');
		if ($shop2) {
			$shop1 = get_page_by_path('shop');
			wp_delete_post( $shop1->ID, true);
			wp_update_post([
				'post_name' => 'shop',
				'ID' => $shop2->ID,
			]);
		}
 		$shop = get_page_by_path('shop');
		$cart = get_page_by_path('cart');
		$checkout = get_page_by_path('checkout');
		$wishlist = get_page_by_path('wishlist');
		$myaccount = get_page_by_path('my-account');

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title('Home');
  $blog_page_id  = get_page_by_title('Blog');

  update_option('show_on_front', 'page');
  update_option('page_on_front', $front_page_id->ID);
  update_option('page_for_posts', $blog_page_id->ID);
  update_option( 'woocommerce_myaccount_page_id', $myaccount->ID );
  update_option( 'woocommerce_shop_page_id', $shop->ID );
  update_option( 'woocommerce_cart_page_id', $cart->ID );
  update_option( 'woocommerce_checkout_page_id', $checkout->ID );
  update_option( 'general-show_notice', '');
  
// Yith Wishlist
		if ( class_exists( 'YITH_WCWL_Frontend' ) )  {
			update_option( 'yith_wcwl_wishlist_page_id', $wishlist->ID );
		}
           /** Delete Hello Post */
			wp_delete_post( 1, true );

			/** Delete "Sample Page" Page */
			wp_delete_post( 2, true );	

       if (class_exists('RevSlider')) {

    if ('Home1' === $selected_import['import_file_name']) {
      $slider_array = array(
        get_template_directory() . "/inc/demo-data/home1/home-1.zip"
      );
    }elseif ('Home2' === $selected_import['import_file_name']) {
      $slider_array = array(
        get_template_directory() . "/inc/demo-data/home2/home-2.zip"
      );
    }elseif ('Home3' === $selected_import['import_file_name']) {
      $slider_array = array(
        get_template_directory() . "/inc/demo-data/home3/home-3.zip"
      );
    }elseif ('Home4' === $selected_import['import_file_name']) {
      $slider_array = array(
        get_template_directory() . "/inc/demo-data/home5/home-4.zip"
      );
    }

    $slider = new RevSlider();

    foreach ($slider_array as $filepath) {
      $slider->importSliderFromPost(true, true, $filepath);
    }

    echo esc_html(' Slider processed', 'matjar');
  }

}
add_action('pt-ocdi/after_import', 'matjar_after_importer_setup');