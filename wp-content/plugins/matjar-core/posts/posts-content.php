<?php 
/**
 * @author  ThemeJR
 * @package Matjar Core
 * @version 1.0.0
 */
 
class Matjar_Post_Content{
	private $cat_sidebars = array();
	function __construct() {		
			
		add_action('init', array( $this, 'matjar_sidebar_list' ) );
		add_action('init', array( $this, 'matjar_addPortfolioContentType' ) );
		add_action('init', array( $this, 'matjar_addProductBrand' ) );
		add_action('init', array( $this, 'matjar_blocks_post_type' ) );
		add_action('init', array( $this, 'matjar_size_chart_post_type' ) );
		add_filter( 'manage_block_posts_columns', array($this, 'matjar_block_posts_columns') );
		add_action('manage_block_posts_custom_column', array($this, 'matjar_block_post_columns_data'), 10, 2);
    }
	
	function matjar_sidebar_list(){
		if( !defined('MATJAR_DIR')){
			return;
		}
		$this->cat_sidebars[''] = esc_html__( 'Default', 'matjar-core' );
		global $wp_registered_sidebars;			
		if ( $wp_registered_sidebars ) {
			foreach ( $wp_registered_sidebars as $sidebar ) {
				$this->cat_sidebars[ $sidebar['id'] ] = $sidebar['name'];
			}
		}
	}
	
    // Register portfolio content type
    function matjar_addPortfolioContentType() {
		if( !defined('MATJAR_DIR')){
			return;
		}
		if( !matjar_get_option('enable-portfolio') ) return;
		$singular_name = !empty(matjar_get_option('portfolio-singular-name'))? matjar_get_option('portfolio-singular-name') : __('Portfolio', 'matjar-core') ;
		$name = !empty( matjar_get_option('portfolio-name') ) ? matjar_get_option('portfolio-name') :  __('Portfolios', 'matjar-core');
		$slug = !empty(matjar_get_option('portfolio-slug')) ? matjar_get_option('portfolio-slug') : 'portfolio';
		$cat_name = $singular_name.__(' Category','matjar-core');
		$cats_name = $singular_name.__(' Categories','matjar-core');
		$cat_slug_name = !empty(matjar_get_option('portfolio-cat-slug')) ? matjar_get_option('portfolio-cat-slug') : 'portfolio_cat';
		$skill_name = $singular_name.__(' Skill','matjar-core');
		$skills_name = $singular_name.__(' Skills','matjar-core');
		$skill_slug_name = !empty(matjar_get_option('portfolio-skill-slug')) ? matjar_get_option('portfolio-skill-slug') : 'portfolio_skills' ;
	   register_post_type(
            'portfolio',
            array(
                'labels' => $this->getLabels($singular_name,$name ),
                'exclude_from_search' => false,
                'has_archive' => true,
                'public' => true,
				'rewrite' => array('slug' => $slug),
                'supports' => array('title', 'editor', 'thumbnail'),
                'can_export' => true
            )
        );
		//flush_rewrite_rules( false );

        register_taxonomy(
            'portfolio_cat',
            'portfolio',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels($cat_name, $cats_name),
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters('matjar_core_portfolio_cat_slug',$cat_slug_name))
            )
        );

        register_taxonomy(
            'portfolio_skills',
            'portfolio',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels($skill_name, $skills_name),
                'query_var' => true,
                'rewrite' => array('slug' => apply_filters('matjar_core_portfolio_skill_slug',$skill_slug_name))
            )
        );
    }

	// Register brand content type
    function matjar_addProductBrand() {
		if( !defined('MATJAR_DIR')){
			return;
		}
        register_taxonomy(
            'product_brand',
            'product',
            array(
                'hierarchical' => true,
                'show_in_nav_menus' => true,
                'labels' => $this->getTaxonomyLabels(esc_html__('Brands', 'matjar-core'), esc_html__('Brands', 'matjar-core')),
				'show_admin_column'     => true,
				'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => true
            )
        );
    }
	
	/**
	*	Register Custom Block content type
	*/
	function matjar_blocks_post_type() {
		if( !defined('MATJAR_DIR')){
			return;
		}
		$singular_name = esc_html__('Block', 'matjar-core') ;
		$name = esc_html__('Blocks', 'matjar-core');
		
		register_post_type(
            'block',apply_filters('matjar_core_register_post_type_blocks',
            array(
                'labels' 				=> $this->getLabels($singular_name,$name),
                'exclude_from_search' 	=> true,
                'public' 				=> true,
				'show_ui' 				=> true,
                'menu_icon' 			=> 'dashicons-format-aside',
				'supports' 				=> array('title', 'editor'),
				'show_in_nav_menus' 	=> false,
            ))
        );
		
	}
	
	/**
	*	Register Size Chart content type
	*/
	function matjar_size_chart_post_type() {
		if( !defined('MATJAR_DIR')){
			return;
		}
		$singular_name = esc_html__('Size Chart', 'matjar-core') ;
		$name = esc_html__('Size Charts', 'matjar-core');
		 register_post_type(
            'themejr_size_chart',apply_filters('matjar_core_register_post_type_size_chart',
            array(
                'labels' 				=> $this->getLabels($singular_name,$name),
                'public' 				=> false,
				'show_ui' 				=> true,
				'show_in_menu' 			=> true,
				'query_var' 			=> true,
				'rewrite' 				=> false,
				'capability_type' 		=> 'post',
				'has_archive' 			=> false,
				'hierarchical' 			=> false,
				'menu_position' 		=> null,
				'show_in_nav_menus' 	=> false,
				'exclude_from_search' 	=> true,
                'menu_icon' 			=> 'dashicons-format-aside',
				'supports' 				=> array('title', 'editor'),
				
            ))
        );
	}

    // Get content type labels
    function getLabels($singular_name, $name, $title = FALSE) {
        if( !$title )
            $title = $name;

        return array(
            "name" => $title,
            "singular_name" => $singular_name,
            "add_new" => esc_html__("Add New", 'matjar-core'),
            "add_new_item" => sprintf( esc_html__("Add New %s", 'matjar-core'), $singular_name),
            "edit_item" => sprintf( esc_html__("Edit %s", 'matjar-core'), $singular_name),
            "new_item" => sprintf( esc_html__("New %s", 'matjar-core'), $singular_name),
            "view_item" => sprintf( esc_html__("View %s", 'matjar-core'), $singular_name),
            "search_items" => sprintf( esc_html__("Search %s", 'matjar-core'), $name),
            "not_found" => sprintf( esc_html__("No %s found", 'matjar-core'), $name),
            "not_found_in_trash" => sprintf( esc_html__("No %s found in Trash", 'matjar-core'), $name),
            "parent_item_colon" => ""
        );
    }

    // Get content type taxonomy labels
    function getTaxonomyLabels($singular_name, $name) {
        return array(
            "name" => $name,
            "singular_name" => $singular_name,
            "search_items" => sprintf( esc_html__("Search %s", 'matjar-core'), $name),
            "all_items" => sprintf( esc_html__("All %s", 'matjar-core'), $name),
            "parent_item" => sprintf( esc_html__("Parent %s", 'matjar-core'), $singular_name),
            "parent_item_colon" => sprintf( esc_html__("Parent %s:", 'matjar-core'), $singular_name),
            "edit_item" => sprintf( esc_html__("Edit %s", 'matjar-core'), $singular_name),
            "update_item" => sprintf( esc_html__("Update %s", 'matjar-core'), $singular_name),
            "add_new_item" => sprintf( esc_html__("Add New %s", 'matjar-core'), $singular_name),
            "new_item_name" => sprintf( esc_html__("New %s Name", 'matjar-core'), $singular_name),
            "menu_name" => $name,
        );
    }
	
	/**
	*	Add shortcode column in block post type
	*/
	function matjar_block_posts_columns( $columns ) {
	    $new_column['block_shortcode'] 	= esc_html__('Shortcode', 'matjar-core');
	    $columns = matjar_add_array( $columns, $new_column, 1, true );
	    return $columns;
	}
	
	/**
	*	Add column data to shortcode column
	*/
	function matjar_block_post_columns_data( $column, $post_id ) {		
	    switch ($column) {
			case 'block_shortcode':
				echo '<div class="block-shortcode-preview">[matjar_block_html id="'.$post_id.'"]</div>';
	    		break;
		}
	}
}
new Matjar_Post_Content();
?>