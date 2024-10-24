<?php
/**
 * Matjar Theme Options
 */

if ( ! class_exists( 'Redux' ) ) {
	return;
}

    $opt_name = 'matjar_options';
    $theme = wp_get_theme( 'Matjar' );
	
    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => apply_filters( 'matjar_theme_name',$theme->get( 'Name' ) ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'submenu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__( 'Theme Options', 'matjar' ),
        'page_title'           => esc_html__( 'Theme Options', 'matjar' ),
		'google_api_key'       		=> '',
        'google_update_weekly' 		=> false,
        'async_typography'     		=> false,
        'global_variable'      		=> '',
        'dev_mode'             		=> false,
        'customizer'          		=> true,
        'page_priority'       		=> null,
        'page_parent'          		=> 'matjar-theme',
        'page_permissions'     		=> 'manage_options',
        'menu_icon'            		=> '',
        'page_icon'            		=> 'icon-themes',
        'page_slug'            		=> 'matjar-theme-option',
        'save_defaults'        		=> true,
        'default_show'         		=> false,
        'default_mark'         		=> '',
        'show_import_export'   		=> true,
        'transient_time'       		=> 60 * MINUTE_IN_SECONDS,
        'output'               		=> true,
        'output_tag'           		=> true,
		'font_display'              => 'swap',
		'footer_credit'             => ' ',
    );

    Redux::setArgs( $opt_name, $args );

    /* END ARGUMENTS */

	
    /* START SECTIONS  */

    // -> START Basic Fields
	
	/*
	* General
	*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'matjar' ),
        'id'               => 'general-options',
        'desc'             => '',
		'fields'           => array(
			array(
                'id'       			=> 'theme-layout',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Theme Layout', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Select layout of site.', 'matjar' ),
                'options'  			=> array(
					'wide' => array(
                        'title' 	=> esc_html__( 'Wide', 'matjar' ),
                        'alt' 		=> esc_html__( 'Wide', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/wide.png',
                    ),  
					'full' => array(
                        'title' 	=> esc_html__( 'Full', 'matjar' ),
                        'alt' 		=> esc_html__( 'Full', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/full.png',
                    ),                   
                    'boxed' => array(
                        'title' 	=> esc_html__( 'Boxed', 'matjar' ),
                        'alt' 		=> esc_html__( 'Boxed', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/box.png',
                    ),
                ),
                'default'  		=> 'full',
            ),
			array(
                'id'            	=> 'theme-container-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Container Width (px)', 'matjar' ),
				'subtitle'          => esc_html__( 'Theme container width in pixels', 'matjar' ),
                'default'       	=> 1200,
                'min'           	=> 1025,
                'step'          	=> 1,
                'max'           	=> 1920,
				'required' 			=> array( 'theme-layout', '=', array( 'full', 'boxed' ) ),
            ),
			array(
                'id'            	=> 'theme-container-wide-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Container Width (px)', 'matjar' ),
				'subtitle'          => esc_html__( 'Theme container wide layout width in pixels', 'matjar' ),
                'default'       	=> 1820,
                'min'           	=> 1200,
                'step'          	=> 1,
                'max'           	=> 1920,
				'required' 			=> array( 'theme-layout', '=', array( 'wide' ) ),
            ),
			array(
                'id'            	=> 'theme-grid-gap',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Grid Gap', 'matjar' ),
				'subtitle'          => esc_html__( 'Theme grid gapping/spacing between two columns. Like 5px, 10px, 15px, etc...', 'matjar' ),
                'default'       	=> 10,
                'min'           	=> 5,
                'step'          	=> 5,
                'max'           	=> 20,
            ),
			array(
                'id'       			=> 'header-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Logo', 'matjar' ),
                'compiler' 			=> 'true',
                'subtitle' 			=> esc_html__( 'Upload header logo.', 'matjar' ),
                'default'  			=> array(),
            ),
			array(
                'id'       			=> 'header-logo-light',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Logo Light Version', 'matjar' ),
				'subtitle'          => esc_html__( 'Upload an alternative light logo that will be used on dark and transparent header.', 'matjar' ),
                'compiler' 			=> 'true',
               'default'  			=> array(),
			),
			array(
                'id'            	=> 'header-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Width', 'matjar' ),
				'subtitle'          => esc_html__( 'Logo width in pixels', 'matjar' ),
                'default'       	=> 170,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 500,
                'display_value' 	=> 'text',
            ),
			array(
                'id'      			=> 'mobile-header-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Mobile Header Logo', 'matjar' ),
				'subtitle'          => esc_html__( 'Upload mobile header logo', 'matjar' ),
                'compiler' 			=> 'true',
				'default'  			=> array(),
			),
			array(
                'id'            	=> 'mobile-header-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Mobile Header Logo Width', 'matjar' ),				
				'subtitle'          => esc_html__( 'Logo max width in pixels', 'matjar' ),
                'default'       	=> 120,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 500,
                'display_value' 	=> 'text',
            ),
		)
    ) );
	
	/**
	* Site Preloader
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Site Preloader', 'matjar' ),
        'id'         		=> 'section-site-preloader',
		'subsection'		=> true,
        'fields'     => array(
			array(
                'id'       			=> 'site-preloader',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Site Preloader', 'matjar' ),
                'subtitle'    		=> esc_html__( 'Enable/disable preloader on your website', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
                'off'      			=> esc_html__( 'Disable', 'matjar' ),
                'default'  			=> 0,
            ),
			array(
                'id'       			=> 'preloader-background',
                'type'    			=> 'color',
				'title'   			=> esc_html__( 'Preloader Background', 'matjar' ),
				'subtitle'			=> esc_html__( 'Set preloader background color.', 'matjar' ),				
				'transparent'		=> false,
				'default'    		=> '#1558E5',
				'required' 			=> array( 'site-preloader', '=', 1 ),
            ),
			array(
				'id'      			=> 'preloader-image',
				'type'    			=> 'button_set',
				'title'   			=> esc_html__( 'Preloader Image', 'matjar' ),
				'subtitle'			=> esc_html__( 'Set preloader type as per your need.', 'matjar' ),
				'options' 			=> array(
					'predefine-loader'	=> esc_html__( 'Predefined Loader', 'matjar' ),
					'custom'         	=> esc_html__( 'Custom', 'matjar' ),
				),
				'default' 			=> 'predefine-loader',
				'required' 			=> array( 'site-preloader', '=', 1 ),
			),
			array(
                'id'       			=> 'predefine-loader-style',
                'type'     			=> 'select',
				'title'   			=> esc_html__( 'Choose Preloader Style', 'matjar' ),
				'subtitle'			=> esc_html__( 'Set preloader type as per your need.', 'matjar' ),
                'options'  			=> array(
                    '1' => 'Style 1',
                    '2' => 'Style 2',
                    '3' => 'Style 3',
                    '4' => 'Style 4',
                    '5' => 'Style 5',
                ),
                'default'  			=> '1',
				'required' 			=> array( 'site-preloader', '=', 1 ),
            ),
			array(
				'id'      			=> 'preloader-custom-image',
				'type'    			=> 'media',
				'url'     			=> false,
				'title'   			=> esc_html__( 'Upload Preloader Image', 'matjar' ),   
				'subtitle'			=> esc_html__( 'Upload preloader image.', 'matjar' ),
				'library_filter'	=> array( 'gif', 'jpg', 'jpeg', 'png' ),
				'required'      	=> array( 'preloader-image', '=', 'custom' ),
			),
		)
	) );
	
	/*
	* Back to top options
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Back To Top Button', 'matjar' ),
        'id'         		=> 'section-back-to-top',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'back-to-top',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button', 'matjar' ),
				'subtitle'			=> esc_html__( 'Enable/disable back to top button.', 'matjar' ),
                'default'  			=> 1,
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
                'off'      			=> esc_html__( 'Disable', 'matjar' ),
            ),
			array(
                'id'       			=> 'back-to-top-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button In Mobile', 'matjar' ),
				'subtitle'			=> esc_html__( 'Enable/disable back to top button in mobile device.', 'matjar' ),
                'default'  			=> 1,
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
                'off'      			=> esc_html__( 'Disable', 'matjar' ),
            ),
		)
	) );
	
	/*
	* Promo Bar
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Promo Bar', 'matjar' ),
        'id'         		=> 'section-promo-bar',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'promo-bar',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Promo Bar', 'matjar' ),
				'subtitle'			=> esc_html__( 'Enable/disable promo bar.', 'matjar' ),
                'default'  			=> 0,
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
                'off'      			=> esc_html__( 'Disable', 'matjar' ),
			),			
			array(
                'id'            	=> 'promo-bar-height',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Height', 'matjar' ),
				'subtitle'          	=> esc_html__( 'Promo bar height in pixels.', 'matjar' ),
                'default'       	=> 60,
                'min'           	=> 10,
                'step'          	=> 1,
                'max'           	=> 500,
                'display_value' 	=> 'text',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-position',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Position', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Select location for promo bar.', 'matjar' ),
                'options'  			=> array(
                    'top' 		=> esc_html__( 'Top', 'matjar' ),
                    'bottom' 	=> esc_html__( 'Bottom', 'matjar' ),
                ),
                'default'  			=> 'top',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-position-type',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Position Type', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Select position type for promo bar.', 'matjar' ),
                'options'  			=> array(
                    'absolute' 	=> esc_html__( 'Absolute', 'matjar' ),
                    'fixed' 	=> esc_html__( 'Fixed', 'matjar' ),
                ),
                'default'  			=> 'absolute',
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-message-text',
                'type'     			=> 'editor',
                'title'    			=> esc_html__( 'Message', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter promo message.', 'matjar' ),
				'default'  			=> esc_html__( 'SUMMER SALE, Get 40% Off for all products.', 'matjar' ),
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       			=> 'promo-bar-link-btn',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Button', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
				'off'      			=> esc_html__( 'Disable', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enable link button in promo bar.', 'matjar' ),
				'default'  			=> 1,
				'required' 			=> array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       => 'promo-bar-link-btn-text',
                'type'     => 'text',
                'title'    =>  esc_html__( 'Button Text', 'matjar' ),
                'subtitle' => esc_html__( 'The text of the more info button.', 'matjar' ),
				'default'  => esc_html__( 'Click Here', 'matjar' ),
				'required' => array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       => 'promo-bar-link-btn-url',
                'type'     => 'text',
                'title'    => esc_html__( 'Enter Url', 'matjar' ),
                'subtitle' => esc_html__( 'The text of the more info button.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       => 'promo-bar-link-open-new-tab',
                'type'     => 'switch',
                'title'    => esc_html__( 'Open link in New Tab', 'matjar' ),
                'subtitle' => esc_html__( 'Select the link target for more info page.', 'matjar' ),
				'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
                'default'  => 1,
				'required' => array( 'promo-bar-link-btn', '=', 1 ),
            ),
			array(
                'id'       => 'promo-bar-close-btn',
                'type'     => 'switch',
                'title'    => esc_html__( 'Close Button', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Enable close button.', 'matjar' ),
				'default'  => 1,
				'required' => array( 'promo-bar', '=', 1 ),
            ),
			array(
                'id'       => 'promo-bar-dismiss',
                'type'     => 'switch',
                'title'    => esc_html__( 'Promo Bar Dismissing', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Enable/Disable promo bar dismissing on button close.', 'matjar' ),
				'default'  => 0,
				'required' => array( 'promo-bar-close-btn', '=', 1 ),
            ),
			array(
                'id'    => 'promo-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Promo Bar Colors', 'matjar' ),
            ),
			array (
				'id'       		=> 'promo-bar-background',
				'type'     		=> 'background',
				'title'    		=> esc_html__( 'Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Promo bar background image or color', 'matjar' ),
				'output' 		=> array( '.matjar-promo-bar' ),
				'default'  		=> array(
					'background-color'	 	=> '#191919',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       		=> 'promo-button-text-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Text Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button text color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
			array(
                'id'       		=> 'promo-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button background color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#1558E5',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
				'id'          		=> 'promo-bar-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Promo Bar Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'These settings control the typography for promo bar.', 'matjar' ),
				'output' 			=> array( '.promo-bar-msg, .promo-bar-close' ),
				'default'     		=> array(
					'color'       		=> '#ffffff', 
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> '',
					'font-size'   		=> '14px', 
					'letter-spacing'	=> '',
				),
			),
		)
	) );
	
	/*
	* Lazyload Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Lazy Load Images', 'matjar' ),
        'id'         		=> 'section-lazy-load',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'lazy-load',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Lazy Load Images', 'matjar' ),
				'subtitle'		=> esc_html__( 'Enables lazy load to reduce page requests.', 'matjar' ),
                'on'       		=> esc_html__( 'Enable', 'matjar' ),
                'off'      		=> esc_html__( 'Disable', 'matjar' ),
                'default'  		=> 0,
            ),
		)
	) );
	
	/*
	* Google Map API
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'API Key', 'matjar' ),
        'id'         		=> 'section-api-key',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'   				=> 'google-map-api',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Google Map API Key', 'matjar' ),
				'subtitle'			=> wp_kses( 
					sprintf( 
						__( 'You should create an API for yourself and put code here. read below link to more info: <a href="%s" target="_blank">here</a>.', 'matjar' ),
						esc_url('https://developers.google.com/maps/documentation/javascript/get-api-key')
					),
					array( 
						'a'	=> array( 
							'href' 		=> array(), 
							'target'	=> array() 
						) 
					) 
				),
				'default'  			=> '',
            ),
			array(
                'id'   				=> 'instagram-access-token',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Instagram Access Token', 'matjar' ),
				'subtitle'			=> wp_kses( 
					sprintf( 
						__( 'You should create an API for yourself and put code here. read below link to more info: <a href="%s" target="_blank">here</a>.', 'matjar' ),
						esc_url('#/')
					),
					array( 
						'a'	=> array( 
							'href' 		=> array(), 
							'target'	=> array() 
						) 
					) 
				),
				'default'  			=> '',
            ),
		),
	) );
	
	/*
	* Mobile
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Mobile', 'matjar' ),
        'id'         => 'section-mobile',
		'icon'		 => 'el el-iphone-home',
        'fields'     => array(
			array(
                'id'       			=> 'mobile-categories-menu',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Categories Menu', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show categories menu in mobile.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-menu-header-login-register',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Login/Register', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show login/register on mobile menu header.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'mobile-menu-social-profile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Social Profile', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show social profile in mobile menu.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'product-hover-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Product Hover', 'matjar' ),
                'subtitle' 			=> esc_html__( 'By default display product hover in mobile.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'mobile-product-hover-image',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Hover Image In Mobile', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show product hover image in mobile layout.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
		),
	) );
	
	/*
	* Mobile Navbar
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Navbar', 'matjar' ),
        'id'         		=> 'section-mobile-navbar',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'mobile-bottom-navbar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Mobile Bottom Navbar', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show mobile bottom navbar in mobile device.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0
            ),
			array(
                'id'       		=> 'mobile-navbar-label',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Navbar Label', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show navbar label.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'mobile-navbar-color',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Navbar Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Select navbar color style.', 'matjar' ),
                'options'  		=> array(
					'light'	=> esc_html__( 'Light', 'matjar' ),
					'dark'	=> esc_html__( 'Dark', 'matjar' ),
				),
				'default'  		=> 'light',
            ),
			array(
                'id'       		=> 'mobile-product-page-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Page Button', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Enable/Disable Sticky Add to Cart/Buy Now button on single product page.', 'matjar' ),
                'on'       		=> esc_html__( 'Enable', 'matjar' ),
				'off'      		=> esc_html__( 'Disable', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'mobile-cart-page-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Cart Page Button', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Enable/Disable Sticky Proceed To Checkout button on cart page.', 'matjar' ),
                'on'       		=> esc_html__( 'Enable', 'matjar' ),
				'off'      		=> esc_html__( 'Disable', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'mobile-checkout-page-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Checkout Page Button', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Enable/Disable Sticky Place Order button on checkout page.', 'matjar' ),
                'on'       		=> esc_html__( 'Enable', 'matjar' ),
				'off'      		=> esc_html__( 'Disable', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       	=> 'mobile-navbar-elements',
                'type'     	=> 'sorter',
                'title'    	=> esc_html__( 'Navbar Elements', 'matjar' ),
                'compiler' 	=> 'true',
                'options'  	=> array(
                    'enabled'  => array(
						'shop'  		=> esc_html__( 'Shop', 'matjar' ),
						'sidebar'  		=> esc_html__( 'Sidebar/Filters', 'matjar' ),
						'wishlist' 		=> esc_html__( 'Wishlist', 'matjar' ),
						'cart'     		=> esc_html__( 'Cart', 'matjar' ),
						'account'  		=> esc_html__( 'Account', 'matjar' ),
                    ),
                    'disabled' => array(						
                        'home'     		=> esc_html__( 'Home', 'matjar' ),
						'menu'  		=> esc_html__( 'Menu', 'matjar' ),
						'compare'  		=> esc_html__( 'Compare', 'matjar' ),
						'search'  		=> esc_html__( 'Search', 'matjar' ),
						'order'			=> esc_html__( 'Order', 'matjar' ),
						'order-tracking'=> esc_html__( 'Order Tracking', 'matjar' ),
						'blog'  		=> esc_html__( 'Blog', 'matjar' ),
						'custom_link1'  => esc_html__( 'Custom Link 1', 'matjar' ),
						'custom_link2'  => esc_html__( 'Custom Link 2', 'matjar' ),
						'custom_link3'  => esc_html__( 'Custom Link 3', 'matjar' ),
					),
                ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-shop',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Shop Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter shop navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Shop', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-shop',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Shop Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-home', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-home', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-wishlist',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Wishlist Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter wishlist navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Wishlist', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-wishlist',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Wishlist Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-heart', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-heart', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-cart',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Cart Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter cart navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Cart', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-cart',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Cart Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-handbag', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-handbag', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-account',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Account Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter account navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Account', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-account',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Account Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-user', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-user', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-home',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Home Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter home navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Home', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-home',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Home Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-home', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-home', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-menu',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Menu Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter menu navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Menu', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-menu',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Menu Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-menu', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-menu', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-compare',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Compare Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter compare navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Compare', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-compare',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Compare Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-shuffle', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-shuffle', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-filter',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Filter Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter filter navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Filters', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-filter',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Filter Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-equalizer', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-equalizer', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-order',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter order navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Order', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-order',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-letter', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-letter', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-order-tracking',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Tracking Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter order tracking navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Order Tracking', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-order-tracking',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Order Tracking Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-plane', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-plane', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-sidebar',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Sidebar Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter sidebar navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Sidebar', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-sidebar',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Sidebar Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-sidebar', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-sidebar', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-blog',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Blog Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter blog navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Blog', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-blog',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Blog Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-note', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-note', 'matjar' ),
            ),
			
			array(
                'id'       			=> 'mobile-navbar-label-search',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Search Label', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter blog navbar label', 'matjar' ),
				'default'  			=> esc_html__( 'Search', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-label-icon-search',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Search Label Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Enter themejr font icon class. Ex. jricon-magnifier', 'matjar' ),
				'default'  			=> esc_html__( 'jricon-magnifier', 'matjar' ),
            ),
			array(
                'id'    => 'custom-link-options',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Custom Links', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 Label','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 1 label.','matjar'),
				'default'  			=> esc_html__( 'Custom 1', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 Icon','matjar'),
                'subtitle'     		=> esc_html__('Enter themejr font icon class.','matjar'),
				'default'  			=> 'jricon-home',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link1-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 1 URL','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 1 url.','matjar'),
				'default'  			=> '#',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 Label','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 2 label.','matjar'),
				'default'  			=> esc_html__( 'Custom 2', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 Icon','matjar'),
                'subtitle'     		=> esc_html__('Enter themejr font icon class.','matjar'),
				'default'  			=> 'jricon-home',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link2-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 2 URL','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 2 url.','matjar'),
				'default'  			=> '#',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 Label','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 3 label.','matjar'),
				'default'  			=> esc_html__( 'Custom 3', 'matjar' ),
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-icon',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 Icon','matjar'),
                'subtitle'     		=> esc_html__('Enter themejr font icon class.','matjar'),
				'default'  			=> 'jricon-home',
            ),
			array(
                'id'       			=> 'mobile-navbar-custom-link3-url',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Custom Link 3 URL','matjar'),
                'subtitle'     		=> esc_html__('Enter custom link 3 url.','matjar'),
				'default'  			=> '#',
            ),
		)
	) );
	
	/*
	* Mobile colors
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Colors', 'matjar' ),
        'id'         	=> 'section-mobile-colors',
		'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'    => 'header-mobile-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Mobile Header Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'header-mobile-background',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Mobile header background color.', 'matjar' ),
                'default'  		=> '#ffffff',
            ),	
			array(
                'id'       		=> 'header-mobile-text-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Mobile header text color.', 'matjar' ),
                'default'  		=> '#545454',
            ),			
			array(
                'id'       		=> 'header-mobile-link-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Mobile header link and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#333333',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       => 'header-mobile-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'matjar' ),                
                'subtitle' 		=> esc_html__( 'Mobile  header border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'       		=> 'header-mobile-input-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  		=> '#545454',
            ),
			array(
                'id'       		=> 'header-mobile-input-background',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  		=> '#ffffff',
            ),
			array(
				'id'       		=> 'google-theme-color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Google Theme Color', 'matjar' ), 				
				'subtitle'   		=> wp_kses( sprintf( __( 'Applied only on mobile devices Android on chrome browser toolbar, <a href="%s" target="_blank">click here</a> plugin.', 'matjar' ), esc_url( 'http://updates.html5rocks.com/2014/11/Support-for-theme-color-in-Chrome-39-for-Android/' ) ),
				array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'validate' 		=> 'color',
				'default'  		=> '#FFFFFF'
			),
		),
	) );
	
	/*
	* Theme Typography
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Typography', 'matjar' ),
        'id'         => 'section-typography',
		'icon'		 => 'el el-font',
        'fields'     => array(
			array(
				'id'          		=> 'body-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Primary Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'color'  			=> false,
				'letter-spacing' 	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use primary font for all title, body text, etc...', 'matjar' ),
				'output' 			=> array( 'body,body .compare-list' ),
				'default'     		=> array(
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px',
					'letter-spacing'	=> '',
				),
			),
			array(
				'id'          		=> 'secondary-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Secondary Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'font-size'   		=> false,
				'letter-spacing' 	=> false,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use secondary font for secondary(alt) titles.', 'matjar' ),
				'output' 			=> array( '.secondary-font' ),
				'default'     		=> array(
					'color'       		=> '#333333',
					'font-weight'  		=> '400', 
					'font-family' 		=> 'Satisfy', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
				),
			),			
			array(
				'id'          		=> 'h1-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H1 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H1 heading font for all H1 headings.', 'matjar' ),
				'output' 			=> array( 'h1, .h1' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '32px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h2-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H2 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H2 heading font for all H2 headings.', 'matjar' ),
				'output' 			=> array( 'h2, .h2' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '28px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h3-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H3 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H3 heading font for all H3 headings.', 'matjar' ),
				'output' 			=> array( 'h3, .h3' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '24px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h4-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H4 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H4 heading font for all H4 headings.', 'matjar' ),
				'output' 			=> array( 'h4, .h4' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '20px',
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h5-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H5 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H5 heading font for all H5 headings.', 'matjar' ),
				'output' 			=> array( 'h5, .h5' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '18px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'h6-headings-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'H6 Headings Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use H6 heading font for all H6 headings.', 'matjar' ),
				'output' 			=> array( 'h6, .h6' ),
				'default'     		=> array(
					'color'       		=> '#333333', 
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '16px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'main-menu-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Main Menu Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'color'				=> false,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use this typography for header main navigation.', 'matjar' ),
				'output' 			=> array( '.main-navigation ul.menu > li > a' ),
				'default'     		=> array(
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
			array(
				'id'          		=> 'categories-menu-font',
				'type'        		=> 'typography',
				'title'       		=> esc_html__( 'Categories Menu Font', 'matjar' ),
				'all_styles'  		=> true,
				'font-backup' 		=> true,
				'color'				=> false,
				'text-align'  		=> false,
				'line-height' 		=> false,
				'letter-spacing' 	=> true,
				'text-transform'	=> true,
				'units'       		=>'px',
				'subtitle'    		=> esc_html__( 'Use this typography for categories parent menu.', 'matjar' ),
				'output' 			=> array( '.categories-menu ul.menu > li > a' ),
				'default'     		=> array(
					'font-weight'  		=> '600', 
					'font-family' 		=> 'Poppins', 
					'google'      		=> true,
					'font-backup' 		=> 'Arial, Helvetica, sans-serif',
					'font-size'   		=> '14px', 
					'letter-spacing'	=> '',
					'text-transform'	=> 'inherit'
				),
			),
		),
	) );
	
	/*
	* Custom Fonts
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Custom Fonts', 'matjar' ),
        'id'         	=> 'section-custom-font',
		'desc'  		=> esc_html__( 'After uploading your fonts,you will have to save Theme Settings and RELOAD this page , Then you should select font family (custom font family)from dropdown list in (Body/Paragraph/Headings/Navigation) Typography section.', 'matjar' ),
        'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'       			=> 'custom-font1',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font1', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 1.', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
				'off'      			=> esc_html__( 'Disable', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font1-name',
                'title'     		=> esc_html__( 'Font1 Name', 'matjar' ),
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-woff',
                'title'     		=> esc_html__( 'Font1 (.woff)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-woff2',
                'title'     		=> esc_html__( 'Font1 (.woff2)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-ttf',
                'title'     		=> esc_html__( 'Font1 (.ttf)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-svg',
                'title'     		=> esc_html__( 'Font1 (.svg)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font1-eot',
                'title'     		=> esc_html__( 'Font1 (.eot)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font1', '=', '1' ),
            ),
			array(
                'id'       			=> 'custom-font2',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font2', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 2.', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
				'off'      			=> esc_html__( 'Disable', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font2-name',
                'title'     		=> esc_html__( 'Font2 Name', 'matjar' ),
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-woff',
                'title'     		=> esc_html__( 'Font2 (.woff)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-woff2',
                'title'     		=> esc_html__( 'Font2 (.woff2)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-ttf',
                'title'     		=> esc_html__( 'Font2 (.ttf)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-svg',
                'title'     		=> esc_html__( 'Font2 (.svg)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font2-eot',
                'title'     		=> esc_html__( 'Font2 (.eot)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font2', '=', '1' ),
            ),
			array(
                'id'       			=> 'custom-font3',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Custom Font3', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Custom Font 3.', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
				'off'      			=> esc_html__( 'Disable', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'type'      		=> 'text',
                'id'        		=> 'custom-font3-name',
                'title'     		=> esc_html__( 'Font3 Name', 'matjar' ),
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-woff',
                'title'     		=> esc_html__( 'Font3 (.woff)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-woff2',
                'title'     		=> esc_html__( 'Font3 (.woff2)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-ttf',
                'title'     		=> esc_html__( 'Font3 (.ttf)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-svg',
                'title'     		=> esc_html__( 'Font3 (.svg)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
			array(
                'type'      		=> 'media',
                'id'        		=> 'custom-font3-eot',
                'title'     		=> esc_html__( 'Font3 (.eot)', 'matjar' ),
                'mode'       		=> false,
                'preview'  			=> false,
                'url'       		=> true,
                'required'  		=> array( 'custom-font3', '=', '1' ),
            ),
		),
	) );
	
	/*
	* Typekit Font
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Adobe Typekit Font', 'matjar' ),
        'id'         	=> 'section-typekit-font',
        'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'       			=> 'typekit-font',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Adobe Typekit Font', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Please enable this option to use Adobe Typekit.', 'matjar' ),
                'on'       			=> esc_html__( 'Enable', 'matjar' ),
				'off'      			=> esc_html__( 'Disable', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'   				=> 'typekit-kit-id',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Typekit Kit ID', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter your ', 'matjar' ) . '<a target="_blank" href="https://typekit.com/account/kits">Typekit Kit ID</a>.',
				'required'  		=> array( 'typekit-font', '=', '1' ),
            ),
			array(
                'id'   				=> 'typekit-kit-family',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Typekit Font Family', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter all custom fonts you will use separated with coma.', 'matjar' ),
				'required'  		=> array( 'typekit-font', '=', '1' ),
            ),
		),
	) );
	
	// Theme Styling Options
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Theme Styling', 'matjar' ),
        'id'               => 'theme-styling',
        'desc'             => '',
        'icon'		 	   => 'el el-brush',
		'fields'           => array(
		)
	) );
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Body', 'matjar' ),
        'id'         => 'body-styling',
        'subsection' => true,		
        'fields'     => array(
            array(
                'id'       		=> 'primary-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Primary Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Primary color', 'matjar' ),
                'default'  		=> '#1558E5',
            ),
			array(
				'id'       		=> 'primary-inverse-color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Primary Inverse Color', 'matjar' ), 
				'subtitle' 		=> esc_html__( 'Primary inverse color', 'matjar' ),
				'validate' 		=> 'color',
				'default'  		=> '#ffffff'
			),
			array(
                'id'       		=> 'secondary-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Secondary Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Secondary color', 'matjar' ),
                'default'  		=> '#1558E5',
            ),
			array(
				'id'       		=> 'secondary-inverse-color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Secondary Inverse Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Secondary inverse color', 'matjar' ),
				'validate' 		=> 'color',
				'default'  		=> '#ffffff'
			),
			array(
				'id'       		=> 'theme-hover-background-color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Hover Background Color', 'matjar' ), 
				'subtitle' 		=> esc_html__( 'Apply theme hover background color for ul li menu, list, etc...', 'matjar' ),
				'validate' 		=> 'color',
				'default'  		=> '#f8f8f8'
			),
			array(
                'id'       		=> 'body-background',
                'type'     		=> 'background',
                'title'    		=> esc_html__( 'Body Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Body background image or color. Only for work in Boxed layout', 'matjar' ),
				'output'   		=> array( 'body' ),
                'default' 		=> array(
								'background-color' 		=> '#ffffff',
								'background-image' 		=> '',
								'background-repeat' 	=> '',
								'background-size' 		=> '',
								'background-attachment' => '',
								'background-position' 	=> '',
							)
            ),
			array (
				'id'       		=> 'site-wrapper-background',
				'type'     		=> 'background',
				'title'    		=> esc_html__('Wrapper Background', 'matjar'),
				'output' 		=> array('.site-wrapper'),
				'default'  		=> array(
					'background-color'	 	=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       		=> 'body-text-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Site text color.', 'matjar' ),
                'default'  		=> '#545454',
            ),
			array(
                'id'       		=> 'body-link-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Site link and hover color.', 'matjar' ),
				'active'   		=> false,
                'default'  		=> array(
                    'regular' => '#212121',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       		=> 'theme-border',
                'type'     		=> 'border',
                'title'    		=> esc_html__( 'Border', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Site border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'            => 'theme-border-radius',
                'type'          => 'slider',
                'title'         => esc_html__( 'Border Radius', 'matjar' ),
				'subtitle' 		=> esc_html__( 'site border radius.', 'matjar' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 10,
                'display_value' => 'label'
            ),			
			array(
                'id'       => 'body-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle' => esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'       => 'body-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),	
        )
    ) );
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Topbar', 'matjar' ),
        'id'         => 'topbar-styling',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       	=> 'topbar-background',
                'type'     	=> 'background',
                'title'    	=> esc_html__( ' Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Topbar background image or color.', 'matjar' ),
				'output' 	=> array( '.header-topbar' ),
				'default'  		=> array(
					'background-color'	 	=> '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
            ),
            array(
                'id'       => 'topbar-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Topbar text color', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'topbar-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Topbar link and hover color.', 'matjar' ),
				'active'    	=> false,
                'default'  => array(
                    'regular' => '#212121',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       => 'topbar-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'matjar' ),                
                'subtitle' 		=> esc_html__( 'Topbar border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'       => 'topbar-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color( TextBox, SelectBox, etc..)', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),
			 array(
                'id'       => 'topbar-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background( TextBox, SelectBox, etc..)', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'          		=> 'topbar-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Max Height', 'matjar' ),
				'subtitle'    		=> esc_html__( 'Set max height for topbar.', 'matjar' ),
                'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 42,
                )
            ),
		)
	) );
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'matjar' ),
        'id'         => 'header-styling',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'    => 'header-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Header Colors', 'matjar' ),
            ),
			array(
                'id'       => 'header-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Header background image or color', 'matjar' ),
				'output' 		=> array( '.header-main' ),
                'default' => array(
								'background-color' => '#ffffff',
								'background-image' 		=> '',
								'background-repeat' 	=> '',
								'background-size' 		=> '',
								'background-attachment' => '',
								'background-position' 	=> '',
							)
            ),
            array(
                'id'       => 'header-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Header text color', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'header-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
                'subtitle' => esc_html__( 'Header link and hover color.', 'matjar' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#212121',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       => 'header-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Header border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'       => 'header-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'header-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'          		=> 'header-min-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Min Height', 'matjar' ),
				'subtitle'    		=> esc_html__( 'Set min height for header.', 'matjar' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 92,
                )
            ),
			
			array(
                'id'    => 'header-notice2',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Header Transparent Colors', 'matjar' ),
            ),
			array(
                'id'       			=> 'header-transparent-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Header Transparent Color', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'This color will work when header transparent/overlay enable.', 'matjar' ),
                'options'  			=> array(
                    'light' 	=> esc_html__( 'Light', 'matjar' ),
                    'dark' 		=> esc_html__( 'Dark', 'matjar' ),
                ),
                'default'  			=> 'light',
            ),
		)
	) );
		
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Navigation', 'matjar' ),
        'id'         => 'navigation-styling',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'navigation-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background Color', 'matjar' ),
				'subtitle' 	=> esc_html__( 'Navigation bar background image or color', 'matjar' ),
				'output' 	=> array( '.header-navigation' ),
                'default'  => array(
					'background-color' 		=> '#1558E5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       => 'navigation-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Navigation bar text color', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'       => 'navigation-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 	=> esc_html__( 'Navigation bar link and hover color.', 'matjar' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#ffffff',
                    'hover'   => '#ffffff',
                )
            ),			 
			array(
                'id'       => 'navigation-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Navigation Border', 'matjar' ),
                'subtitle' => esc_html__( 'Navigation bar border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#1558E5',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),	
			array(
                'id'       => 'navigation-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),		
			array(
                'id'       => 'navigation-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle' => esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),	
			array(
                'id'          		=> 'navigation-min-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Min Height', 'matjar' ),
				'subtitle'    		=> esc_html__( 'Set min height for navigation bar.', 'matjar' ),
                'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 44,
                )
            ),	
		)
	) );
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Menu & Categories Menu', 'matjar' ),
        'id'         => 'menu-styling',
        'subsection' => true,
        'fields'     => array(
			/*array(
                'id'    => 'frist-level-menu-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'First Level Menu Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'first-level-menu-background-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Hover Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'First level menu hover background color', 'matjar' ),
                'default'  		=> 'transparent',
            ),		
			array(
                'id'       		=> 'first-level-menu-link-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'First level menu link and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#ffffff',
                )
            ),*/
			array(
                'id'    => 'categories-menu-title-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Categories Menu Title Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'categories-menu-title-background',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Categories menu title background color', 'matjar' ),
                'validate' 		=> 'color',
                'default' 		=> '#1558E5',
            ),		
			array(
                'id'       		=> 'categories-menu-title-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Title Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Categories menu title color.', 'matjar' ),
                'active'    	=> false,
                'default' 		=> '#ffffff',
            ),
			array(
                'id'    => 'categories-menu-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Categories Area & Menu Colors', 'matjar' ),
            ),
			array (
				'id'       		=> 'categories-menu-wrapper-background',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Categories menu wrapper/area background color', 'matjar' ),
				'default'  		=> '#ffffff',
			),
			array(
                'id'       		=> 'categories-menu-hover-background',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Hover Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Categories menu hover background color', 'matjar' ),
                'validate' 		=> 'color',
                'default' 		=> '#f8f8f8',
            ),
			array(
                'id'       		=> 'categories-menu-link-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Categories menu link and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#212121',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       		=> 'categories-menu-border',
                'type'     		=> 'border',
                'title'   	 	=> esc_html__( 'Border', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Categories menu border color, style and width.', 'matjar' ),
                'default'  		=> array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
					'border-top'    => '1px',
					'border-right'  => '1px',
					'border-bottom' => '1px',
					'border-left'   => '1px'
                )
            ),
			array(
                'id'    => 'menu-popup-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Main & Categories menu Popup Colors', 'matjar' ),
            ),
			array (
				'id'       		=> 'popup-menu-background',
				'type'     		=> 'background',
				'title'    		=> esc_html__( 'Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Popup menu background image or color', 'matjar' ),
				'output' 		=> array( '.matjar-navigation ul.menu ul.sub-menu, .matjar-navigation .matjar-megamenu-wrapper' ),
				'default'  		=> array(
					'background-color'	 => '#ffffff',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       		=> 'popup-menu-hover-background',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Hover Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Popup menu hover background color', 'matjar' ),
                'validate' 		=> 'color',
                'default' 		=> '#f8f8f8',
            ),
			array(
                'id'       		=> 'popup-menu-text-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Popup menu text color', 'matjar' ),
                'default'  		=> '#545454',
            ),			
			array(
                'id'       		=> 'popup-menu-link-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Link Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Popup menu link and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#212121',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       		=> 'popup-menu-border',
                'type'     		=> 'border',
                'title'   	 	=> esc_html__( 'Border', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Popup menu border color, style and width.', 'matjar' ),
                'default'  		=> array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
					'border-top'    => '1px',
					'border-right'  => '1px',
					'border-bottom' => '1px',
					'border-left'   => '1px'
                )
            ),			
		)
	) );
	
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Heading', 'matjar' ),
        'id'         => 'page-heading-style',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'page-heading-background',
                'type'     => 'background',
                'title'    =>  esc_html__( 'Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Page title background image or color', 'matjar' ),
				'output' 		=> array( '#page-title' ),
                'default' => array(
					'background-color' => '#f8f8f8',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> 'cover',
					'background-attachment' => '',
					'background-position' 	=> 'center center'
				),
            ),
			array(
                'id'       			=> 'page-title-color',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Color', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Page title color.', 'matjar' ),
                'options'  			=> array(
                    'default' 	=> esc_html__( 'Default', 'matjar' ),
                    'light' 	=> esc_html__( 'Light', 'matjar' ),
                    'dark' 		=> esc_html__( 'Dark', 'matjar' ),
                ),
                'default'  			=> 'dark',
            ),
			array(
                'id'       			=> 'page-title-size',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Title Size', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Page title size.', 'matjar' ),
                'options'  			=> array(
                    'default' 		=> esc_html__( 'Default', 'matjar' ),
                    'small' 		=> esc_html__( 'Small', 'matjar' ),
                    'large' 		=> esc_html__( 'Large', 'matjar' ),
                ),
                'default'  			=> 'default',
            ),
			array(
				'id'             	=> 'page-title-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for page title.', 'matjar' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '#page-title' ),
				'default'            => array(
					'padding-top'     	=> '50', 
					'padding-bottom'  	=> '50',
					'units'          	=> 'px', 
				)
			),
		)
	) );
		
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'matjar' ),
        'id'         => 'footer-styling',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'    => 'footer-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Footer Colors', 'matjar' ),
            ),			
			array(
                'id'       		=> 'footer-background',
                'type'     		=> 'background',
                'title'    		=> esc_html__( 'Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Footer background image or color', 'matjar' ),
				'output'  	 	=> array( '.site-footer .footer-main, .site-footer .footer-categories' ),
                'default' 		=> array(
					'background-color' 		=> '#f8f8f8',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
			array(
                'id'       => 'footer-heading-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Footer heading color like widget, etc.', 'matjar' ),
                'default'  => '#212121',
            ),
            array(
                'id'       => 'footer-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' => esc_html__( 'Footer text color', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'footer-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
                'subtitle' => esc_html__( 'Footer link and hover color.', 'matjar' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#212121',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       => 'footer-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'matjar' ),
                'subtitle' => esc_html__( 'Footer border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),		
			array(
                'id'       => 'footer-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),	
			array(
                'id'       => 'footer-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle' => esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'    => 'copyright-notice1',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Copyright Colors', 'matjar' ),
            ),
			array(
                'id'       => 'copyright-background',
                'type'     => 'background',
                'title'    => esc_html__( 'Background Color', 'matjar' ),
				'subtitle' => esc_html__( 'Copyright background image or color', 'matjar' ),
				'output'   => array( '.site-footer .footer-copyright' ),
                'default'  => array(
					'background-color' => '#f8f8f8',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       => 'copyright-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' => esc_html__( 'Copyright text color', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'copyright-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
                'subtitle' => esc_html__( 'Copyright link and hover color.', 'matjar' ),
				'active'   => false,
                'default'  => array(
                    'regular' => '#212121',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       => 'copyright-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Copyright Border', 'matjar' ),
                'subtitle' => esc_html__( 'Copyright border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
		)
	) );
	
	/*
	* Buttons colors
	*/
	Redux::setSection( $opt_name, array(
        'title'      	=> esc_html__( 'Buttons', 'matjar' ),
        'id'         	=> 'section-buttons',
		'subsection'   	=> true,
        'fields'     	=> array(
			array(
                'id'    => 'site-button-color-info',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Site Buttons Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button background and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#1558E5',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       		=> 'button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
			
			//Shop Page Buttons Colors
			array(
                'id'    => 'shop-page-button-color-info',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Shop Page Buttons Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'shop-cart-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button background and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#f5f5f5',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       		=> 'shop-cart-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#545454',
                    'hover'   	=> '#ffffff',
                )
            ),
			
			//Product Page Buttons Colors
			array(
                'id'    => 'product-page-button-color-info',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Product Page Buttons Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'product-cart-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button background and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#1558E5',
                    'hover'   	=> '#1558E5',
                )
            ),
			array(
                'id'       		=> 'product-cart-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Add To Cart Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set add to cart button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
			array(
                'id'       		=> 'buy-now-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Buy Now Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set buy now button background and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#9e7856',
                    'hover'   	=> '#ae8866',
                )
            ),
			array(
                'id'       		=> 'buy-now-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Buy Now Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set buy now button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
			array(
                'id'    => 'checkout-button-color-info',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Checkout Buttons Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'checkout-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Checkout & Place Order Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set checkout button background and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#9e7856',
                    'hover'   	=> '#ae8866',
                )
            ),
			array(
                'id'       		=> 'checkout-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Checkout & Place Order Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set checkout button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
			
		),
	) );
	
	/*
	* Header
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Header', 'matjar' ),
        'id'         => 'header',
		'icon'		 => 'el el-photo',
        'fields'     => array(
			array(
                'id'   				=> 'header-phone-number',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Phone Number', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide phone number on header.', 'matjar' ),
				'default'  			=> '+(123) 4567 890',
            ),			
			array(
                'id'   				=> 'header-email',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Email Address', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide email address on header.', 'matjar' ),
				'default'  			=> 'support@matjar.com',
            ),
			array(
                'id'   				=> 'header-location',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Store Location', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide store location on header.', 'matjar' ),
				'default'  			=> '123 Street, New York, US',
            ),
			array(
                'id'   				=> 'header-welcome-message',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Welcome Message', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide welcom message on header.', 'matjar' ),
				'default'  			=> 'Welcome to Our Store!',
            ),
			array(
                'id'   				=> 'header-newsletter',
                'type'      		=> 'text',
                'title'     		=> esc_html__( 'Newsletter', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Leave empty for hide newsletter on header.', 'matjar' ),
				'default'  			=> 'Newsletter',
            ),
			array(
                'id'       			=> 'header-language-switcher',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Language Switcher', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show language switcher on header topbar or not.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-currency-switcher',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Currency Switcher', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show currency switcher on header topbar or not.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'      			=> 'header-language-switcher-style',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Language Switcher Style', 'matjar' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'This option will work if you have used <a href="%1$s" target="_blank">Polylang</a> Or <a href="%2$s" target="_blank">TranslatePress</a> plugin.', 'matjar' ), esc_url( 'https://wordpress.org/plugins/polylang/' ),esc_url( 'https://wordpress.org/plugins/translatepress-multilingual/' ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'options'  			=> array(
					'dropdown'		=> esc_html__( 'Dropdown', 'matjar' ),
                    'horizontal' 	=> esc_html__( 'Horizontal List', 'matjar' ),
                ),
                'default'  			=> 'dropdown',
            ),
			array(
                'id'       			=> 'header-language-switcher-view',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Language Country', 'matjar' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'This option will work if you have used <a href="%1$s" target="_blank">Polylang</a> Or <a href="%2$s" target="_blank">TranslatePress</a> plugin.', 'matjar' ), esc_url( 'https://wordpress.org/plugins/polylang/' ),esc_url( 'https://wordpress.org/plugins/translatepress-multilingual/' ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'options'  			=> array(
					'both'		=> esc_html__( 'Flag & Name', 'matjar' ),
                    'name' 		=> esc_html__( 'Name', 'matjar' ),
                    'flag' 		=> esc_html__( 'Flag', 'matjar' ),
                ),
                'default'  			=> 'both',
            ),			
			array(
				'id'       => 'header-myaccount',
                'type'     => 'switch',
                'title'    => esc_html__( 'My Account', 'matjar' ),
                'subtitle'     => esc_html__( 'Show my account on header.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       			=> 'login-register-popup',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Login/Register Popup', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show header login/register popup.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-minicart-popup',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Mini Cart Popup', 'matjar' ),
				'subtitle'     		=> esc_html__( 'Select header mini cart popup.', 'matjar' ),
                'options'  			=> array(
                    'slider' 		=> esc_html__( 'Slider', 'matjar' ),
                    'dropdow'		=> esc_html__( 'Dropdown', 'matjar' ),
                    'none' 			=> esc_html__( 'None', 'matjar' ),
                ),
                'default'  			=> 'slider',
            ),
			array(
                'id'       			=> 'header-cart-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Cart Style', 'matjar' ),
				'subtitle' 	   		=> esc_html__( 'Select cart style.', 'matjar' ),
                'options'  			=> array(					
					1	=> array(
                        'alt' 	=> '1',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/cart/1.jpg'
                    ),
                ),
                'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-cart-icon',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Cart Icon', 'matjar' ),
				'subtitle' 	   		=> esc_html__( 'Select cart icon.', 'matjar' ),
                'options'  			=> array(
					 'cart-icon'	=> array(
                        'alt' 		=> 'Icon Cart',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/cart/icon-1.jpg'
                    ),					
					'bag-icon' 		=> array(
                        'alt' 		=> 'Icon Bag',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/cart/icon-2.jpg'
                    ),                					
                ),
                'default'  			=> 'cart-icon',
            ),
			array(
                'id'       			=> 'header-wishlist',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Wishlist Icon', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show wishlist icon on header.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-compare',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Compare Icon', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show compare icon on header.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-icon-text',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Icon Text', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Show icon text on header.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       => 'categories-menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories Menu', 'matjar' ),
                'subtitle'     => esc_html__( 'Show shopping categories menu on header or not.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'categories-menu-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Categories Menu Title', 'matjar' ),
                'subtitle' => esc_html__( 'Enter categories menu title.', 'matjar' ),
				'default'  => 'Shopping By Categories',
            ),
			array(
                'id'       => 'open-categories-menu',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories(Vertical) Menu On Home Page', 'matjar' ),
                'subtitle' => esc_html__( 'You always want to keep the categories (vertical) menu open on the home page.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
		)
	) );
	
	/*
	* Header Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Manager', 'matjar' ),
        'id'         		=> 'header-manager',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-topbar',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Topbar', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show header topbar or not.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-transparent',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Transparent', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Make the header transparent/overlay the content.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-transparent-on',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Header Transparent On', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Make the header transparent/overlay the content on front page or all pages.', 'matjar' ),
                'options'  			=> array(
                    'front-page' 	=> esc_html__( 'Front Page', 'matjar' ),
                    'all-pages' 	=> esc_html__( 'All Pages', 'matjar' ),
                ),
                'default'  			=> 'front-page',
				'required' 			=> array( 'header-transparent', '=', 1 ),
            ),
			array(
                'id'       			=> 'header-select',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Select Header', 'matjar' ),
                'options'  			=> array(
                    'style' 		=> esc_html__( 'Header Style', 'matjar' ),
                    'builder' 		=> esc_html__( 'Header Builder', 'matjar' ),
                ),
                'default'  			=> 'style',
            ),
			array(
                'id'       			=> 'header-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Header Style', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Select a header style.', 'matjar' ),
				'full_width' 		=> true,
				'options'  			=> array(
					'1' => array( 'title' => '1', 'alt' => 'Header 1', 'img' => MATJAR_ADMIN_IMAGES.'header/header-1.png' ),
                    '2' => array( 'title' => '2', 'alt' => 'Header 2', 'img' => MATJAR_ADMIN_IMAGES.'header/header-2.png' ),
                    '3' => array( 'title' => '3', 'alt' => 'Header 3', 'img' => MATJAR_ADMIN_IMAGES.'header/header-3.png' ),
                    '4' => array( 'title' => '4', 'alt' => 'Header 4', 'img' => MATJAR_ADMIN_IMAGES.'header/header-4.png' ),
                    '5' => array( 'title' => '5', 'alt' => 'Header 5', 'img' => MATJAR_ADMIN_IMAGES.'header/header-5.png' ),
                ),
                'default'  			=> '1',				
				'required' 			=> array( 'header-select', '=', 'style' ),
            ),
			array(
                'id'    			=> 'header-topbar-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Topbar Manager', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-topbar-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Topbar Manager', 'matjar' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header topbar', 'matjar' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
						'email' 			=> esc_html__( 'Email', 'matjar' ),
                        'phone-number'		=> esc_html__( 'Phone Number', 'matjar' ),
                    ),
					'right' 	=> array(
						'welcome-message'	=> esc_html__( 'Welcome Message', 'matjar' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'matjar' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'matjar' ),
					),
					'disabled' 	=> array(							
						'topbar-menu'		=> esc_html__( 'Topbar Menu', 'matjar' ),
						'social-profile'	=> esc_html__( 'Social Profile', 'matjar' ),
						'location'			=> esc_html__( 'Location', 'matjar' ),
						'newsletter'		=> esc_html__( 'Newsletter', 'matjar' ),
						'mini-search'		=> esc_html__( 'Mini Search', 'matjar' ),
						/* 'topbar-widget'		=> 'Widget', */
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-topbar-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Topbar Left', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-topbar-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Topbar Right', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'    			=> 'header-main-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Main Manager', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-main-manager',
                'type'     			=> 'sorter',
                'title'    			=> 'Header Main Manager',
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header main', 'matjar' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
                        'logo' 			=> esc_html__( 'Logo', 'matjar' ),
                    ),
                    'center' 	=> array(
						'ajax-search'	=> esc_html__( 'Ajax Search', 'matjar' ),
					),
					'right' 	=> array(
						'myaccount'			=> esc_html__( 'My Account', 'matjar' ),					
						'wishlist'			=> esc_html__( 'Wishlist', 'matjar' ),
						'cart'				=> esc_html__( 'Cart', 'matjar' ),						
					),
					'disabled' 	=> array(
						'primary-menu'		=> esc_html__( 'Primary Menu', 'matjar' ),
						'secondary-menu'	=> esc_html__( 'Secondary Menu', 'matjar' ),
						'compare'			=> esc_html__( 'Compare', 'matjar' ),	
						'mini-search'		=> esc_html__( 'Mini Search', 'matjar' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'matjar' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'matjar' ),
						'customer-support'	=> esc_html__( 'Customer Support', 'matjar' ),
						'custom-html'		=> esc_html__( 'Custom HTML', 'matjar' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-main-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Left', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-main-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Center', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '6',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-main-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Align center for above section.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-main-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Main Right', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'      			=> 'header-main-custom-html',
				'type'    		 	=> 'editor',
                'title'    			=> esc_html__( 'Custom HTML', 'matjar' ),
				'default'  			=>'',
				'subtitle' 			=> esc_html__( 'Add your custom html here.', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'    			=> 'header-navigation-info1',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Navigation Manager', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-navigation',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Navigation', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show header navigation.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-navigation-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Navigation Manager', 'matjar' ),
                'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header navigation', 'matjar' ),
				'full_width' 		=> true,
                'options'  			=> array(
                   'left'  		=> array(
                       'category-menu'		=> esc_html__( 'Category Menu', 'matjar' ),
                    ),
                    'center' 	=> array(
						'primary-menu'			=> esc_html__( 'Primary Menu', 'matjar' ),
					),
					'right' 	=> array(
					),
					'disabled' => array(
						'secondary-menu'	=> esc_html__( 'Secondary Menu', 'matjar' ),	
						'ajax-search'		=> esc_html__( 'Ajax Search', 'matjar' ),
						'myaccount'			=> esc_html__( 'My Account', 'matjar' ),
						'cart'				=> esc_html__( 'Cart', 'matjar' ),					
						'wishlist'			=> esc_html__( 'Wishlist', 'matjar' ),
						'customer-support'	=> esc_html__( 'Customer Support', 'matjar' ),
						'custom-html'		=> esc_html__( 'Custom HTML', 'matjar' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-navigation-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Left', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '3',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'       			=> 'header-navigation-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Center', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '9',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-navigation-align',
				'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Align center for above section.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-navigation-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Navigation Right', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
				'id'      			=> 'header-navigation-custom-html',
				'type'    		 	=> 'editor',
                'title'    			=> esc_html__( 'Custom HTML', 'matjar' ),
				'default'  			=> '',
				'subtitle' 			=> esc_html__( 'Add your custom html here.', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
		)
	) );

	/*
	* Header Sticky Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Sticky Manager', 'matjar' ),
        'id'         		=> 'header-sticky-manager',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-sticky',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Enable header sticky.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-sticky-part',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Make Header Sticky', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Select header section and make header sticky.', 'matjar' ),
                'options'  			=> array(
					'topbar'		=>	esc_html__( 'Topbar', 'matjar' ),
					'main'			=>	esc_html__( 'Middle(Main)', 'matjar' ),
					'navigation'	=>	esc_html__( 'Navigation', 'matjar' ),					
				),
                'default'  			=> 'main',
				'required' 			=> array( 'header-sticky', '=', 1 )
            ),
			array(
                'id'          		=> 'header-sticky-main-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Middle(Main) Height', 'matjar' ),
				'subtitle'    		=> esc_html__( 'Set middle(|Main) header sticky height.', 'matjar' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array( 
                    'height' 		=> 65,
                ),
				'required' 			=> array( 'header-sticky-part', '=', 'main' ),
            ),	
			array(
                'id'       			=> 'header-sticky-scroll-up',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky Scroll-up', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show header sticky on scroll up.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
				'required' 			=> array( 'header-sticky', '=', 1 ),
            ),
		)
	) );
	
	/*
	* Header Mobile Manager options
	*/
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Header Mobile Manager', 'matjar' ),
        'id'         		=> 'header-mobile',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       			=> 'header-sticky-tablet',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky On Tablet', 'matjar' ),
                'subtitle' 	  		=> esc_html__( 'Header sticky on tablet width < 992px.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'header-sticky-mobile',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Header Sticky On Mobile', 'matjar' ),
                'subtitle' 	 		=> esc_html__( 'Header sticky mobile width < 480px.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'          		=> 'header-mobile-height',
                'type'          	=> 'dimensions',
                'title'          	=> esc_html__( 'Height', 'matjar' ),
				'subtitle'    		=> esc_html__( 'Set mobile header height.', 'matjar' ),
				'units_extended'	=> false,
                'width'        	 	=> false,
                'default'        	=> array(
                    'height' 		=> 60,
                )
            ),			
			array(
                'id'    			=> 'header-mobile-topbar-info',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Mobile Topbar Manager', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-mobile-topbar-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Mobile Topbar Manager', 'matjar' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header topbar', 'matjar' ),
				'full_width' 		=> true,
                'options'  			=> array(
					'center' 	=> array(
						'welcome-message'	=> esc_html__( 'Welcome Message', 'matjar' ),
						'language-switcher'	=> esc_html__( 'Language Switcher', 'matjar' ),
						'currency-switcher'	=> esc_html__( 'Currency Switcher', 'matjar' ),
					),
					'disabled' 	=> array(
						'email' 			=> esc_html__( 'Email', 'matjar' ),
                        'phone-number'		=> esc_html__( 'Phone Number', 'matjar' ),
						'topbar-menu'		=> esc_html__( 'Topbar Menu', 'matjar' ),
						'social-profile'	=> esc_html__( 'Social Profile', 'matjar' ),
						'location'			=> esc_html__( 'Location', 'matjar' ),
						'newsletter'		=> esc_html__( 'Newsletter', 'matjar' ),
						/* 'topbar-widget'		=> 'Widget', */
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'       			=> 'header-mobile-topbar-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show align center for mobile topbar section.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),			
			array(
                'id'    			=> 'header-mobile-main-info',
                'type'  			=> 'info',
				'notice' 			=> false,
                'title' 			=> esc_html__( 'Header Mobile Main Manager', 'matjar' ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
                'id'       			=> 'header-mobile-manager',
                'type'     			=> 'sorter',
                'title'    			=> esc_html__( 'Header Mobile Manager', 'matjar' ),
				'subtitle'			=> esc_html__( 'Organize how you want the layout to appear on the header mobile', 'matjar' ),
				'full_width' 		=> true,
                'options'  			=> array(
                    'left'  	=> array(
						'mobile-navbar'		=> esc_html__( 'Mobile Nav', 'matjar' ),				
                    ),
					'center' 	=> array(
						'logo'				=> esc_html__( 'Logo', 'matjar' ),
					),
					'right' 	=> array(
						'mini-search'		=> esc_html__( 'Mini Search', 'matjar' ),
						'cart'				=> esc_html__( 'Cart', 'matjar' ),
					),
					'disabled' 	=> array(
						'myaccount'			=> esc_html__( 'My Account', 'matjar' ),
                        'wishlist'			=> esc_html__( 'Wishlist', 'matjar' ),
					),
                ),
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-mobile-left',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Left', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			
			array(
				'id'       			=> 'header-mobile-center',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Center', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
			array(
                'id'       			=> 'header-mobile-align',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Align Center', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show Header Mobile Center section in align center.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
				'required' 			=> array( 'header-select', '=', 'builder' ),
            ),
			array(
				'id'       			=> 'header-mobile-right',
				'type'     			=> 'select',
				'title'    			=> esc_html__( 'Header Mobile Right', 'matjar' ),
				'options' 			=> array(
					'1'  => esc_html__( '1 column - 1/12', 'matjar' ),
					'2'  => esc_html__( '2 columns - 1/6', 'matjar' ),
					'3'  => esc_html__( '3 columns - 1/4', 'matjar' ),
					'4'  => esc_html__( '4 columns - 1/3', 'matjar' ),
					'5'  => esc_html__( '5 columns - 5/12', 'matjar' ),
					'6'  => esc_html__( '6 columns - 1/2', 'matjar' ),
					'7'  => esc_html__( '7 columns - 7/12', 'matjar' ),
					'8'  => esc_html__( '8 columns - 2/3', 'matjar' ),
					'9'  => esc_html__( '9 columns - 3/4', 'matjar' ),
					'10' => esc_html__( '10 columns - 5/6', 'matjar' ),
					'11' => esc_html__( '11 columns - 11/12', 'matjar' ),
					'12' => esc_html__( '12 columns - 1/1', 'matjar' ),
				),
				'default'  			=> '4',
				'required' 			=> array( 'header-select', '=', 'builder' ),
			),
		)
	) );
	
	// Header Ajax Search
    Redux::setSection( $opt_name, array(
        'title'     	 	=> esc_html__( 'Ajax Search', 'matjar' ),
        'id'         		=> 'header-ajax-search',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       => 'product-ajax-search',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Live/Ajax Search', 'matjar' ),
                'subtitle'     => esc_html__( 'Live product search or not on header.', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       			=> 'header-ajax-search-style',
                'type'     			=> 'image_select',
                'title'    			=> esc_html__( 'Ajax Search Style', 'matjar' ),
				'subtitle' 	   		=> esc_html__( 'Select ajax search box style.', 'matjar' ),
                'options'  			=> array(
					'ajax-search-style-1' 	=> array(
                        'alt' 	=> '1',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/search/1.png'
                    ), 
					'ajax-search-style-2' 	=> array(
                        'alt' 	=> '2',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/search/2.png'
                    ), 
					'ajax-search-style-3' 	=> array(
                        'alt' 	=> '2',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/search/3.png'
                    ), 
					'ajax-search-style-4' 	=> array(
                        'alt' 	=> '2',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/search/4.png'
                    ), 
                ),
                'default'  			=> 'ajax-search-style-1',
            ),
			array(
                'id'       			=> 'ajax-search-shape',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Ajax Search Shape', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Select ajax search box shape.', 'matjar' ),
                'options'  			=> array(
                    'ajax-search-square'	=> esc_html__( 'Square', 'matjar' ),
                    'ajax-search-radius' 	=> esc_html__( 'Radius', 'matjar' ),
                ),
                'default'  			=> 'ajax-search-square',
            ),
			array(
                'id'       			=> 'search-content-type',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Search Content Type', 'matjar' ),
				'subtitle'     		=> esc_html__( 'Select content type you want to use in the search box.', 'matjar' ),
                'options'  			=> array(
                    'all'			=> esc_html__( 'All', 'matjar' ),
                    'product' 		=> esc_html__( 'Product', 'matjar' ),
                    'post' 			=> esc_html__( 'Post', 'matjar' ),
                    'portfolio' 	=> esc_html__( 'Portfolio', 'matjar' ),
                ),
                'default'  			=> 'product',
            ),
			array(
                'id'       => 'show-categories-dropdow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories Dropdown', 'matjar' ),
                'subtitle' 	   => esc_html__( 'Show categories dropdow in product search.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'search-categories',
                'type'     => 'radio',
                'title'    => esc_html__( 'Search Categories Dropdown', 'matjar' ),
                'subtitle'     => esc_html__( 'Display categories in search categories dropdow.', 'matjar' ),
                'options'  => array(
								'all' 	 => esc_html__( 'Show All Categories', 'matjar' ),
								'parent' => esc_html__( 'Only Parent(top level) Categories', 'matjar' ),
							),
				'default'  => 'all',
				'required' => array( 'show-categories-dropdow', '=', 1 ),
            ),
			array(
                'id'       => 'categories-hierarchical',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories Hierarchical', 'matjar' ),
                'subtitle' 	   => esc_html__( 'Show categories in hierarchical (Must be need to select above option Show All Categories).', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
				'required' => array( 'search-categories', '=', 'all' )
            ),
			array(
                'id'       			=> 'search-placeholder-text',
                'type'     			=> 'text',
                'title'    			=> esc_html__('Search Palceholder Text', 'matjar' ),
                'subtitle'     		=> esc_html__('Enter search palceholder text', 'matjar' ),
				'default'  			=> esc_html__('Search for products, categories, brands, sku...', 'matjar' ),
            ),
			array(
                'id'       			=> 'header-search-image',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Image', 'matjar' ),
                'subtitle' 	   		=> esc_html__('Show product Image in search results.', 'matjar' ),
                'on'       			=> esc_html__('Yes', 'matjar' ),
				'off'      			=> esc_html__('No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-search-price',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Price', 'matjar' ),
                'subtitle' 	   		=> esc_html__('Show product price in search results.', 'matjar' ),
                'on'       			=> esc_html__('Yes', 'matjar' ),
				'off'      			=> esc_html__('No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'header-search-rating',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Search Rating', 'matjar' ),
                'subtitle' 	   		=> esc_html__('Show product raing in search results.', 'matjar' ),
                'on'       			=> esc_html__('Yes', 'matjar' ),
				'off'      			=> esc_html__('No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'trending-search',
                'type'     			=> 'switch',
                'title'    			=> esc_html__('Trending Search', 'matjar' ),
                'subtitle' 	   		=> esc_html__('Enable trending search.It will show when focus on search box.', 'matjar' ),
                'on'       			=> esc_html__('Yes', 'matjar' ),
				'off'      			=> esc_html__('No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
				'id'       			=> 'trending-search-categories',
				'type'     			=> 'select',
				'multi'    			=> true,
				'data' 	   			=> 'terms',
				'args' 				=> array( 'taxonomies'=>'product_cat' ),
				'title'    			=> esc_html__('Trending Categories', 'matjar' ),
				'subtitle'     		=> esc_html__( 'Select your trending search categories.', 'matjar' ),
				'placeholder' 		=> esc_attr__('Choose product categories', 'matjar' ),
				'required' 			=> array( 'trending-search', '=', 1),
			),
		)
	) );
	
	/*
	* Page Heading options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page Heading', 'matjar' ),
        'id'         => 'page-heading',
		'icon'		 => 'el el-icon-website',
        'fields'     => array(
			array(
                'id'       		=> 'page-title-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Title Layout', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select page title layout.Disable for hide title area', 'matjar' ),
                'options'  		=> array(
                    'left' => array(
                        'title' 	=> 'Default',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/page-title-default.png',
                    ),
					'center' => array(
                        'title' 	=> 'Centered',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/page-title-centered.png',
                    ),
					'disable' => array(
                        'title' 	=> 'Disable',
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/page-title-none.png',
                    )
                ),
                'default'  		=> 'center',
            ),
			array(
                'id'       		=> 'page-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show/Hide page title.', 'matjar' ),
                'default'  		=> 1,
                'on'       		=> esc_html__( 'Show', 'matjar' ),
                'off'      		=> esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       		=> 'page-breadcrumb',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Breadcrumbs', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Show/Hide the breadcrumbs.', 'matjar' ),
                'default'  		=> 1,
                'on'      		=> esc_html__( 'Show', 'matjar' ),
                'off'      		=> esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       		=> 'breadcrumbs-delimiter',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Breadcrumbs Delimiter', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select breadcrumb seperator', 'matjar' ),
                'options'  		=> array(
                    'forward-slash' 	=> esc_html__( '/', 'matjar' ),
                    'greater-than'		=> esc_html__( '>', 'matjar' ),
                ),
                'default'  		=> 'forward-slash',
            ),			
		)
	) );
	
	//Footer Options
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Footer', 'matjar' ),
        'id'         => 'footer',
		'icon'		 => 'el el-photo',
        'fields'     => array(
			array(
                'id'       		=> 'site-footer',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Footer', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show website footer.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			
			array(
                'id'       		=> 'footer-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Footer Layout', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select footer layout.', 'matjar' ),
                'options'  		=> array(
                    '1' => array(
                        'title' 	=> esc_html__( '1', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-1.png',
                        'alt' 		=> esc_html__( 'Layout 1', 'matjar' ),
                    ),
					'2' => array(
                        'title' 	=> esc_html__( '2', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-2.png',
                        'alt' 		=> esc_html__( 'Layout 2', 'matjar' ),
                    ),
					'3' => array(
                        'title' 	=> esc_html__( '3', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-3.png',
                        'alt' 		=> esc_html__( 'Layout 3', 'matjar' ),
                    ),
					'4' => array(
                        'title' 	=> esc_html__( '4', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-4.png',
                        'alt' 		=> esc_html__( 'Layout 4', 'matjar' ),
                    ),					
					'5' => array(
                        'title' 	=> esc_html__( '5', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-5.png',
                        'alt' 		=> esc_html__( 'Layout 5', 'matjar' ),
                    ),
					'6' => array(
                        'title' 	=> esc_html__( '6', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-6.png',
                        'alt' 		=> esc_html__( 'Layout 6', 'matjar' ),
                    ),
					'7' => array(
                        'title' 	=> esc_html__( '7', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/footer-7.png',
                        'alt' 		=> esc_html__( 'Layout 7', 'matjar' ),
                    ),
                ),
                'default'  			=> '2',
				'required'			=> array( 'site-footer', '=', 1 )
            ),
			array(
				'id'             	=> 'footer-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer section.', 'matjar' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.site-footer .footer-main' ),
				'default'            => array(
					'padding-top'     	=> '4', 
					'padding-bottom'  	=> '4',
					'units'          	=> 'rem', 
				)
			),
			array(
                'id'       		=> 'footer-widget-collapse',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Collapse Widgets on Mobile', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Yes/No collapse footer widgets on mobile device.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
				'required'		=> array( 'site-footer', '=', 1 )
            ),
		)
	) );	
	
	/*
	* Footer Subscribe
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Subscribe', 'matjar' ),
        'id'         		=> 'section-footer-subscribe',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-subscribe',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Subscribe', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show subscribe section in footer.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0
            ),
			array(
                'id'       		=> 'footer-subscribe-layout',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Layout', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select subscribe layout.', 'matjar' ),
                'options'  		=> array(
                    'columns' 		=> esc_html__( '2 Columns', 'matjar' ),
                    'centered'		=> esc_html__( 'Centered', 'matjar' ),
                ),
                'default'  		=> 'columns',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'footer-subscribe-title',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Title', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Enter subscribe title.', 'matjar' ),
				'default'  		=> esc_html__( ' Subscribe to Our Newsletter', 'matjar'),
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'footer-subscribe-subtitle',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Subtitle', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Enter subscribe subtitle.', 'matjar' ),
				'default'  		=> esc_html__( 'Subscribe today and get special offers, coupons and news.', 'matjar'),
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'subscribe-form-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Subscribe Form Style', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Select subscribe form style.', 'matjar' ),
				'options'  		=> array(
                    'overlay-form' 		=> array(
                        'title' 	=> esc_html__( 'Overlay Form', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/overlay-form.png',
                    ),
                    'simple-form' 		=> array(
                        'title' 	=> esc_html__( 'Simple Form', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/subscribe-form.png',
                    ),
                ),
                'default'  		=> 'overlay-form',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			array(
                'id'       		=> 'subscribe-field-shape',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Field Shape', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Select subscribe form field shape.', 'matjar' ),
                'options'  		=> array(
					'shape-round' 	=> esc_html__( 'Round', 'matjar' ),
                    'shape-square' 	=> esc_html__( 'Square', 'matjar' ),
                ),
                'default'  		=> 'shape-round',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ),
			/* array(
                'id'       			=> 'footer-subscribe-style',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Subscribe Input Style', 'matjar' ),
				'subtitle'     		=> esc_html__( 'Select subscribe textbox and button shape style.', 'matjar' ),
                'options'  			=> array(
                    'default'	=> esc_html__( 'Default', 'matjar' ),
                    'rounded' 	=> esc_html__( 'Rounded', 'matjar' ),
                    'round' 	=> esc_html__( 'Round', 'matjar' ),
                ),
                'default'  			=> 'round',
				'required'		=> array( 'footer-subscribe', '=', 1 )
            ), */
			array(
                'id'    => 'subscribe-notice',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Subscribe Colors', 'matjar' ),
            ),
			array (
				'id'       		=> 'footer-subscribe-background',
				'type'     		=> 'background',
				'title'    		=> esc_html__( 'Background', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Footer subscribe background image or color', 'matjar' ),
				'output' 		=> array( '.footer-subscribe' ),
				'default'  		=> array(
					'background-color'	 	=> '#1558E5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> ''
				),
			),
			array(
                'id'       => 'footer-subscribe-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),	
			array(
                'id'       		=> 'subscribe-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button text color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                )
            ),
			array(
                'id'       		=> 'subscribe-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button background color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#9e7856',
                    'hover'   	=> '#9e7856',
                )
            ),
			array(
                'id'       => 'footer-subscribe-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color', 'matjar' ),
                'subtitle' => esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),	
			array(
                'id'       => 'footer-subscribe-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background', 'matjar' ),
                'subtitle' => esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
				'id'             	=> 'footer-subscribe-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer subscribe section.', 'matjar' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.footer-subscribe' ),
				'default'            => array(
					'padding-top'     	=> '3', 
					'padding-bottom'  	=> '3',
					'units'          	=> 'rem', 
				)
			),
		)
	) );
	
	/*
	* Footer Link
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Categories', 'matjar' ),
        'id'         		=> 'section-footer-link',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-categories',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Footer Categories', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show popular categories in footer.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0
            ),			
			array(
				'id'       			=> 'footer-popular-categories',
				'type'     			=> 'select',
				'multi'    			=> true,
				'data' 	   			=> 'terms',
				'args' 				=> array( 'taxonomies'=>'product_cat' ),
				'title'    			=> esc_html__('Select Categories', 'matjar' ),
				'subtitle'     		=> esc_html__( 'Please select parent category these have child categories.', 'matjar' ),
				'placeholder' 		=> esc_attr__('Choose product categories', 'matjar' ),
				'required' 			=> array( 'footer-categories', '=', 1),
			),
		)
	) );
	/*
	* Footer Copyright
	*/
	Redux::setSection( $opt_name, array(
        'title'      		=> esc_html__( 'Footer Copyright', 'matjar' ),
        'id'         		=> 'section-footer-copyright',
		'subsection'		=> true,
        'fields'     		=> array(
			array(
                'id'       		=> 'footer-copyright',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Copyright', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show website copyright.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1
            ),
			array(
                'id'       		=> 'copyright-layout',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Copyright Layout', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select copyright layout.', 'matjar' ),
                'options'  		=> array(
                    'columns' 		=> esc_html__( 'Columns', 'matjar' ),
                    'centered'		=> esc_html__( 'Centered', 'matjar' ),
                ),
                'default'  		=> 'columns',
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'copyright-text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Copyright', 'matjar' ),
				'subtitle' => esc_html__( 'Enter copyright text. Use {current_year} for get dynamic current year.', 'matjar' ),
				'default'  => wp_kses( sprintf( __( 'Matjar &copy; {current_year} by <a href="%s" target="_blank">ThemeJR</a> All Rights Reserved.', 'matjar' ), esc_url( 'https://www.templatemonster.com/store/themejr/' ) ),
						array(
							'a' => array(
								'href'   => array(),
								'target' => array(),
							),
						) 
				),
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'show-payments-logo',
                'type'     => 'switch',
                'title'    => esc_html__( 'Payments Logo', 'matjar' ),
				'subtitle' => esc_html__( 'Show payment logo.', 'matjar' ),
                'default'  => 0,
                'on'       => esc_html__( 'Yes', 'matjar' ),
                'off'      => esc_html__( 'No', 'matjar' ),
				'required'		=> array( 'footer-copyright', '=', 1 )
            ),
			array(
                'id'       => 'payments-logo',
                'type'     => 'media',
                'url'      => false,
                'title'    => esc_html__( 'Payments Logo Image', 'matjar' ),
                'subtitle' => esc_html__( 'Upload payments logo image.', 'matjar' ),
				'required' => array( 'show-payments-logo', '=', 1 )
            ),
			array(
				'id'             	=> 'footer-copyright-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Set top bottom padding for footer copyright section.', 'matjar' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'left'        	 	=> false,
                'right'        	 	=> false,
				'output' 			=> array( '.site-footer .footer-copyright' ),
				'default'            => array(
					'padding-top'     	=> '2', 
					'padding-bottom'  	=> '2',
					'units'          	=> 'rem', 
				)
			),
		)
	) );
	
	/*
	* Shop Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__('Shop','matjar'),
        'id'         => 'section-shop',
		'icon'		 => 'el el-shopping-cart',
		'fields'     => array(
			array(
                'id'       		=> 'order-tracking-page',
                'type'     		=> 'select',
                'data'     		=> 'pages',
                'title'    		=> esc_html__( 'Order Tracking Page', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set your order tracking page.', 'matjar' ),
                'desc' 			=> esc_html__( 'Page contents: [woocommerce_order_tracking]', 'matjar' ),
            ),
			array(
                'id'       => 'product-search-by-sku',
                'type'     => 'switch',
                'title'    => esc_html__( 'Search By Product SKU', 'matjar' ),
				'subtitle' => esc_html__( 'Ajax search product by  sku.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'manage-password-strength',
                'type'     => 'switch',
                'title'    => esc_html__( 'Manage Password Strength', 'matjar' ),
				'subtitle' => esc_html__( 'Reduce the strength requirement on the woocommerce user login/signup password', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'user-password-strength',
                'type'     => 'button_set',
                'title'    => esc_html__( 'User Password Strength', 'matjar' ),
                'options'  => array(
                    '3' => esc_html__( 'Strong (default)', 'matjar' ),
                    '2' => esc_html__( 'Medium', 'matjar' ),
					'1' => esc_html__( 'Weak', 'matjar' ),
					'0' => esc_html__( 'Very Weak', 'matjar' ),
                ),
                'default'  => '3',
				'required' => array( 'manage-password-strength', '=', 1 )
            ),
			array(
                'id'       		=> 'single-line-product-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Single Line Title', 'matjar' ),
				'subtitle' 	   	=> esc_html__( 'Show product/category/widget  title in single line.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       => 'mini-cart-quantity',
                'type'     => 'switch',
                'title'    => esc_html__( 'Quantity Field in Mini Cart', 'matjar' ),
				'subtitle'     => esc_html__( 'Show quantity field in mini cart. ', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
		),
	) );
	
	/*
	* Product labels		
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Product labels', 'matjar' ),
        'id'         => 'section-product-labels',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'product-labels',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Labels', 'matjar' ),
                'subtitle' => esc_html__( 'Show labels sale, featured, new and out of stock on product.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sale-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sale Product Label', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'      		=> 'sale-product-label-after-price',
                'type'     		=> 'button_set',
				'desc' 			=> esc_html__( 'Show sale product label after price or on product image in shop/listing page.', 'matjar' ),
                'options'  		=> array(
                    'after-price' 		=> esc_html__( 'After Price', 'matjar' ),
                    'on-product-image'	=> esc_html__( 'On Product Image', 'matjar' ),
                ),
                'default'  		=> 'on-product-image',
				'required' 		=> array( 'sale-product-label', '=', 1 )
            ),
			array(
                'id'       => 'sale-product-label-text-options',
                'type'     => 'button_set',
				'desc' => esc_html__( 'sale product label in percentage or text.', 'matjar' ),
                'options'  => array(
                    'percentages' => esc_html__( 'Percentages', 'matjar' ),
                    'text' => esc_html__( 'Text', 'matjar' ),
                ),
                'default'  => 'percentages',
				'required' => array( 'sale-product-label', '=', 1 )
            ),
			array(
                'id'       => 'sale-product-label-percentage-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Sale label percentage text.', 'matjar' ),
				'default'  => esc_html__( 'Off', 'matjar' ),
				'required' => array( 'sale-product-label-text-options', '=', 'percentages' )
            ),
			array(
                'id'       => 'sale-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Sale product label text.', 'matjar' ),
				'default'  => esc_html__( 'Sale', 'matjar' ),
				'required' => array( 'sale-product-label-text-options', '=', 'text' )
            ),
			array(
                'id'       => 'sale-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'Sale product label color.', 'matjar' ),
                'default'  => '#388E3C',
				'required' => array( 'sale-product-label', '=', 1 )
            ),
			array(
                'id'       => 'product-new-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'New Product Label', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'new-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'New product label text.', 'matjar' ),
				'default'  => esc_html__( 'New', 'matjar' ),
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'            => 'product-newness-days',
                'type'          => 'slider',
                'subtitle'          => esc_html__( 'Enter number of days to newness.', 'matjar' ),
                'default'       => 30,
                'min'           => 1,
                'step'          => 1,
                'max'           => 90,
                'display_value' => 'text',
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'       => 'new-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'New product label color.', 'matjar' ),
                'default'  => '#82B440',
				'required' => array( 'product-new-label', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Featured Product Label', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label-text',
                'type'     => 'text',
                'subtitle'    => esc_html__( 'Featured product label text.', 'matjar' ),
				'default'  => esc_html__( 'Featured', 'matjar' ),
				'required' => array( 'featured-product-label', '=', 1 )
            ),
			array(
                'id'       => 'featured-product-label-color',
                'type'     => 'color',
                'subtitle'     => esc_html__( 'Featured product label color.', 'matjar' ),
                'default'  => '#ff9f00',
				'required' => array( 'featured-product-label', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label',
                'type'     => 'switch',
                'title'    => esc_html__( 'Out Of Stock Product Label', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'product-labels', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label-text',
                'type'     => 'text',
                'subtitle'     => esc_html__( 'out of stock product label text.', 'matjar' ),
				'default'  => esc_html__( 'Out Of Stock', 'matjar' ),
				'required' => array( 'outofstock-product-label', '=', 1 )
            ),
			array(
                'id'       => 'outofstock-product-label-color',
                'type'     => 'color',
                'subtitle'    => esc_html__( 'Out of stock product label color.', 'matjar' ),
                'default'  => '#ff6161',
				'required' => array( 'outofstock-product-label', '=', 1 )
            ),		
		),
	) );
		
	/*
	* Free Shipping Bar		
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Free Shipping Bar', 'matjar' ),
        'id'         => 'section-freeshipping',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'free-shipping-bar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Free Shipping Bar', 'matjar' ),
				'subtitle' 		=> esc_html__( 'You want to enable free shipping bar or not?', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
				'id'      		=> 'free-shipping-amount',
				'type'    		=> 'text',
				'title'   		=> esc_html__( 'Enter Required Amount', 'matjar' ), 
				'subtitle'   	=> wp_kses( sprintf( __( 'You can set frees hipping method amount from Woocommerce => settings => shipping => shipping zones => manage shipping method.For more read <a href="%s" target="_blank"> WooCommerce documentation </a> guide.', 'matjar' ), esc_url( 'https://docs.woocommerce.com/document/free-shipping/' ) ),
				array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),     
				'default' 		=> '',								  
			),
			array(
				'id'      		=> 'free-shipping-msg',
				'type'    		=> 'textarea',
				'subtitle'    	=> esc_html__( 'Enter free shipping message text. Use {missing_amount} - The remaing amount for free shipping.', 'matjar' ),
				'title'  		=> esc_html__( 'Free Shipping Message', 'matjar' ),               
				'default' 		=> 'Spend {missing_amount} to get <strong>free shipping</strong>',
			),
			array(
				'id'      		=> 'free-shipping-complete-msg',
				'type'    		=> 'textarea',
				'title'   		=> esc_html__( 'Free Shipping Success Message', 'matjar' ), 
				'subtitle'    	=> esc_html__( 'Message show after reaching progress bar 100%.', 'matjar' ),
				'default' 		=> esc_html__( 'Congratulation! You have got free shipping', 'matjar' ),	  
			),
			array(
				'id'      		=> 'shipping-bar-bg-color',
				'type'    		=> 'color',
				'title'   		=> esc_html__( 'Shipping Bar Background Color', 'matjar' ),               
				'default' 		=> '#efefef',								  
			),
			array(
				'id'      		=> 'shipping-bar-color',
				'type'    		=> 'color',
				'title'   		=> esc_html__( 'Shipping Bar Color', 'matjar' ),               
				'default' 		=> '#1558E5',								  
			),
		),
	) );
	/*
	* Login to see prices
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Login To See Price', 'matjar' ),
        'id'         => 'section-login-to-see-price',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'login-to-see-price',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Login To See Price', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Only logged in users can see the pricing.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 0,
            ),
		),
	) );
		
	/*
	* Cart Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Cart', 'matjar' ),
        'id'         => 'section-cart-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'cart-auto-update',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Auto Update Cart ', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Auto update cart when change product quantity.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
		)
	) );
	
	/*
	* Checkout Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Checkout', 'matjar' ),
        'id'         => 'section-checkout-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'checkout-steps',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Checkout Steps', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show checkout steps on Cart, Checkout and Order complete pages.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'checkout-product-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Image', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product image on checkout page.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'checkout-product-quantity',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Quantity Filed', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product quantity filed on checkout page.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 0,
            ),
		)
	) );
	
	/*
	* Shop Pages Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Archive(Shop) Pages', 'matjar' ),
        'id'         => 'section-shop-page',
		'icon'		 => 'el el-shopping-cart',
        'fields'     => array(
			array(
                'id'       		=> 'shop-page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Select shop/archive page layout with sidebar postion.', 'matjar' ),
                'options'  		=> array(
                    'full-width' 	=> array(
                        'alt' 	=> esc_html__( 'Full Width', 'matjar' ),
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' 	=> array(
                        'alt' 	=> esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' 	=> esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'left-sidebar'
            ),
			array(
                'id'       		=> 'shop-page-sidebar-widget',
                'type'     		=> 'select',
                'title'    		=> esc_html__( 'Sidebar Widget Area', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Select sidebar for shop page.', 'matjar' ),
                'data'     		=> 'sidebars',
                'default'  		=> 'shop-page',
                'required' 		=> array( 'shop-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       		=> 'shop-page-off-canvas-sidebar',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Off Canvas Sidebar', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Display off canvas sidebar.', 'matjar' ),
                'default'  		=> 0,
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'required' 		=> array( 'shop-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) ),
            ),
			array(
                'id'       		=> 'off-canvas-button-text',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Off Canvas Button Text', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Enter off canvas button text.', 'matjar' ),
                'default'  		=> esc_html__( 'Filters', 'matjar' ),
                'required' 		=> array( 'shop-page-off-canvas-sidebar', '=', 1 )
            ),
			array(
                'id'       		=> 'shop-page-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show shop page title.', 'matjar' ),
                'default'  		=> 1,
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
            ),
			array(
				'id'      		=> 'shop-page-top-content',
				'type'    		=> 'select',
				'title'   		=> esc_html__( 'Shop Page Top Content', 'matjar' ),
				'subtitle'		=> esc_html__( 'Select block that display on shop page top area. You can create new block from Blocks => Add New', 'matjar' ),
				'options'    	=> matjar_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'matjar' ) ),
				'default' 		=> ' ',
			),
			array(
				'id'      		=> 'shop-page-bottom-content',
				'type'    		=> 'select',
				'title'   		=> esc_html__( 'Shop Page Bottom Content', 'matjar' ),
				'subtitle'		=> esc_html__( 'Select block that display on shop page bottom area. You can create new block from Blocks => Add New', 'matjar' ),
				'options'    	=> matjar_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'matjar' ) ),
				'default' 		=> ' ',
			),
			array(
                'id'       		=> 'products-header',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Header', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show products header.', 'matjar' ),
                'default'  		=> 1,
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
            ),
			array(
                'id'       		=> 'products-view-icon',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product View Mode Icon', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show Product view mode icon on product header', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'products-view',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product View Mode', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Select by default product view mode.', 'matjar' ),
                'options'  		=> array(
                    'grid-view' => esc_html__( 'Grid', 'matjar' ),
                    'list-view' => esc_html__( 'List', 'matjar' ),
                ),
                'default'  		=> 'grid-view',
				'required' 		=> array( 'products-view-icon', '=', 1 )
            ),
			array(
                'id'            => 'products-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Products Per Page', 'matjar' ),
                'subtitle'      => esc_html__( 'Show number of products per page.', 'matjar' ),
                'min'           => 6,
                'step'          => 1,
                'max'           => 120,
                'display_value' => 'text',
                'default'       => 12,
            ),
			array(
                'id'       		=> 'products-per-page-dropdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Per Page Dropdown', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show products per page dropdown on products header', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'products-per-page-number',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Products Per Page Variations', 'matjar' ),
				'subtitle'     	=> esc_html__( 'Add product variations by comma. Ex. 9,12,24,36,48', 'matjar' ),
                'default'  		=> '6,9,12,24,36,48',
				'required' 		=> array( 'products-per-page-dropdown', '=', 1 )
            ),			
			array(
                'id'       		=> 'products-sorting',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Products Sorting', 'matjar' ),
				'subtitle' 	   	=> esc_html__( 'Show products sorting on shop page and archive pages.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),	
			array(
                'id'       		=> 'ajax-filter',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Ajax Filter', 'matjar' ),
				'subtitle' 	   	=> esc_html__( 'Enable ajax filter on shop and product archive pages.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'products-columns',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row', 'matjar' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
					4	 	=> esc_html__( '4', 'matjar' ),
					5	 	=> esc_html__( '5', 'matjar' ),
					6	 	=> esc_html__( '6', 'matjar' ),
                ),
                'default'  		=> 4,
            ),
			array(
                'id'       		=> 'products-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Tablet', 'matjar' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
					4	 	=> esc_html__( '4', 'matjar' ),
                ),
                'default'  		=> 3,
            ),
			array(
                'id'       		=> 'products-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Per Row Mobile', 'matjar' ),
				'subtitle'      => esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                ),
                'default'  		=> 2,
            ),
			array(
                'id'       		=> 'products-pagination-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Products Pagination', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Select product pagination type.', 'matjar' ),
                'options'  		=> array(
					'default'	=> esc_html__( 'Default', 'matjar' ),
					'infinity-scroll'		=> esc_html__( 'Infinity Scroll', 'matjar' ),
					'load-more-button'		=> esc_html__( 'Load More', 'matjar' ),
				),
                'default'  		=> 'default',
            ),
			array(
                'id'       		=> 'products-pagination-load-more-button-text',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Load More Button Text', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Enter load more button text.', 'matjar' ),
                'default'  		=> 'Load More',
				'required' 		=> array( 'products-pagination-style', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
			array(
                'id'       		=> 'products-pagination-finished-message',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Finished Message', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Text to display when no additional products are available.', 'matjar' ),
                'default'  		=> 'No More Products Available',
				'required' 		=> array( 'products-pagination-style', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
		)
	) );
	
	/*
	* Product Styles
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Product Styles', 'matjar' ),
        'id'         => 'product-styles',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'product-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Product Style', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Choose product style.', 'matjar' ),
				'full_width' 	=> true,
                'options'  		=> array(
                    'product-style-1' => array(
                        'alt' 	=> 'Product Style 1',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'product-style-1.png',
                    ),
					'product-style-2' => array(
                        'alt' 	=> 'Product Style 2',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'product-style-2.png',
                    ),
                    'product-style-3' => array(
                        'alt' 	=> 'Product Style 3',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'product-style-3.png',
                    ), 
					'product-style-4' => array(
                        'alt' 	=> 'Product Style 4',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'product-style-4.png',
                    ),
					'product-style-5' => array(
                        'alt' 	=> 'Product Style 5',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'product-style-5.png',
                    ),
                ),
                'default'  	=> 'product-style-1',
            ),
			array(
                'id'       		=> 'product-quantity-field',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Quantity Field', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show quantity filed on home and shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-style', '=', 'product-style-5' )
            ),
			array(
                'id'       		=> 'product-hover-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Hover Image', 'matjar' ),
				'subtitle'      => esc_html__( 'Show product hover image on products.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),		
			array(
                'id'       		=> 'product-countdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Countdown', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product countdown.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'product-category',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Category', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product category.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Title', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product title.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-rating',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product rating.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-rating-count',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating Count', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product rating count.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-rating', '=', 1 )
            ),
			array(
                'id'       		=> 'product-price',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Price', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product price.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),			
			array(
                'id'       		=> 'product-variations',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Variation(Options)', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product variation(attribute) on product hover. Like Color, Size, ...', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),				
			array(
                'id'       		=> 'product-short-description',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Short Description', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show product short description in list view.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),		
		)
	) );
	
	/*
	* Product category Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Categories Page', 'matjar' ),
        'id'         => 'product-categories-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'category-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Category Style', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Select category style', 'matjar' ),
                'options'  		=> array(                    
                    'category-style-1' => array(
                        'alt' 	=> 'Category Style 1',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/category-style-1.png',
                    ),
					'category-style-2' => array(
                        'alt' 	=> 'Category Style 2',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/category-style-2.png',
                    ),
					'category-style-3' => array(
                        'alt' 	=> 'Category Style 3',
                        'img' 	=> MATJAR_ADMIN_IMAGES . 'layout/category-style-3.png',
                    ),
                ),
                'default'  		=> 'category-style-1',
            ),
		)
	) );
	
	/*
	* Product Catalog Mode
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Catalog Mode', 'matjar' ),
        'id'         => 'product-catalog-mode',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'catalog-mode',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Catalog Mode', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Enable catalog mode.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'open-product-page-new-tab',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Open Product In New Tab', 'matjar' ),
				'subtitle'      => esc_html__( 'Open product page in new tab.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'product-buttons',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Buttons', 'matjar' ),
                'subtitle'      => esc_html__( 'Show product buttons cart, wishlist, compare and quick view in shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'product-cart-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Cart Button', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show cart button on shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-wishlist-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Wishlist Button', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show wishlist button on shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-compare-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Compare Button', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show compare button on shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 1,
				'required'		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'product-quickview-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Quick View Button', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show quick view button on shop page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 1,
				'required' 		=> array( 'product-buttons', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-quick-buy',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Quick Buy Button', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Show quick buy button on product page.', 'matjar' ),
                'on'       		=> esc_html__( 'Show', 'matjar' ),
				'off'      		=> esc_html__( 'Hide', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'type'      	=> 'text',
                'id'        	=> 'product-quickbuy-button-text',
                'title'     	=> esc_html__( 'Quick Buy Button Text', 'matjar' ),
                'subtitle'  	=> esc_html__( 'Enter quick buy button text.', 'matjar' ),
                'default'     	=> 'Buy Now',
                'required'  	=> array( 'single-product-quick-buy', '=', 1 ),
            ),
		)
	) );

	/*
	* Single Product Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Product', 'matjar' ),
        'id'         => 'single-product-page',
		'icon'		 => 'el el-shopping-cart',
        'fields'     => array(
			array(
                'id'       		=> 'product-page-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Select product page layout with sidebar postion.', 'matjar' ),
				'options'  		=> array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  		=> 'full-width'				
            ),
			array(
                'id'       		=> 'product-page-sidebar-widget',
                'type'     		=> 'select',
                'title'    		=> esc_html__( 'Sidebar Widget Area', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Select sidebar for product page.', 'matjar' ),
                'data'     		=> 'sidebars',
                'default'  		=> 'single-product',
                'required' 		=> array( 'product-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       		=> 'sticky-product-image',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Product Image', 'matjar' ),
				'subtitle' 		=> esc_html__( 'When you scroll the product page at this time you want to stick product image part or not.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'sticky-product-summary',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Product Summary', 'matjar' ),
				'subtitle' 		=> esc_html__( 'When you scroll the product page at this time you want to stick product summary part or not.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'sticky-add-to-cart-button',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Sticky Add to Cart Button', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Sticky add to cart button on bottom when scroll the page.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 0,
            ),
		)
		));
		
		/*
		* Product Images/Gallery
		*/
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Images/Gallery', 'matjar' ),
			'id'         => 'product-images-gallery',
			'subsection' => true,
			'fields'     => array(
				array(
					'id'       	=> 'product-gallery-style',
					'type'     	=> 'image_select',
					'title'    	=> esc_html__( 'Gallery Layout', 'matjar' ),
					'options'  	=> array(
						'product-gallery-left' 	=> array(
							'title' 	=> esc_html__( 'Thumbnail Left', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-left.png',
						),                   
						'product-gallery-bottom' 	=> array(
							'title' 	=> esc_html__( 'Thumbnail Bottom', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-bottom.png',
						),
						'product-gallery-horizontal' 	=> array(
							'title' 	=> esc_html__( 'Gallery Horizontal', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-horizontal.png',
						),
						'product-gallery-center' 	=> array(
							'title' 	=> esc_html__( 'Gallery Center', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-center.png',
						),
						'product-gallery-grid' 	=> array(
							'title' 	=> esc_html__( 'Gallery Grid', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-gallery-grid.png',
						),
						'product-sticky-info' 	=> array(
							'title' 	=> esc_html__( 'Sticky Info', 'matjar' ),
							'img' 	=> MATJAR_ADMIN_IMAGES . 'product-page/product-sticky-info.png',
						),
					),
					'default'  	=> 'product-gallery-left'
				),
				array(
					'id'       => 'product-gallery-zoom',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Gallery Zoom', 'matjar' ),
					'on'       => esc_html__( 'Enable', 'matjar' ),
					'off'      => esc_html__( 'Disable', 'matjar' ),
					'default'  => 1,
				),
				array(
					'id'       => 'product-gallery-lightbox',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Gallery Lightbox', 'matjar' ),
					'on'       => esc_html__( 'Enable', 'matjar' ),
					'off'      => esc_html__( 'Disable', 'matjar' ),
					'default'  => 0,
				),
				array(
					'id'       => 'product-video',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product Video', 'matjar' ),
					'subtitle' => esc_html__( ' You want to show product video?', 'matjar' ),
					'on'       => esc_html__( 'Yes', 'matjar' ),
					'off'      => esc_html__( 'No', 'matjar' ),
					'default'  => 1,
				),
				array(
					'id'       => 'product-360-degree',
					'type'     => 'switch',
					'title'    => esc_html__( 'Product 360 degree Image', 'matjar' ),
					'subtitle' => esc_html__( ' You want to show product video?', 'matjar' ),
					'on'       => esc_html__( 'Yes', 'matjar' ),
					'off'      => esc_html__( 'No', 'matjar' ),
					'default'  => 1,
				),				
			),
		) );
		
		/*
		* Product Summary
		*/
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Summary', 'matjar' ),
			'id'         => 'product-summary',
			'subsection' => true,
			'fields'     => array(
			array(
                'id'       		=> 'single-product-breadcrumbs',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Breadcrumbs', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product breadcrumbs. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-breadcrumbs-position',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Breadcrumbs Position', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select breadcrumbs position. ', 'matjar' ),
                'options'  		=> array(
                    'above-summary' 	=> esc_html__( 'Above Summary', 'matjar' ),
                    'above-image'		=> esc_html__( 'Above Image', 'matjar' ),
                ),
                'default'  		=> 'above-summary',
				'required' 		=> array( 'single-product-breadcrumbs', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-navigation',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Navigation', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product navigation. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-rating',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Rating', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product rating. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-countdown',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Countdown', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product countdown. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-countdown-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Countdown Style', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Select countdown style. ', 'matjar' ),
                'options'  		=> array(
					'countdown-box'		=> esc_html__( 'Box', 'matjar' ),
					'countdown-text'  	=> esc_html__( 'Text', 'matjar' ),					
				),
                'default'  		=> 'countdown-box',
				'required' 		=> array( 'single-product-countdown', '=', 1 )
            ),
			array(
                'id'        	=> 'single-product-countdown-tag',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Countdown Tag', 'matjar' ),
                'default' 		=> 'Special price ends in less than',
				'required' 		=> array( 'single-product-countdown-style', '=', 'countdown-text' )
            ),
			array(
                'id'      		=> 'sale-single-product-label-after-price',
                'type'     		=> 'button_set',
				'title'     	=> esc_html__( 'Sale Product Label', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Show sale product label after price or on product image in product page.', 'matjar' ),
                'options'  		=> array(
                    'after-price' 		=> esc_html__( 'After Price', 'matjar' ),
                    'on-product-image'	=> esc_html__( 'On Product Image', 'matjar' ),
                ),
                'default'  		=> 'on-product-image',
            ),
			array(
                'id'       		=> 'single-product-availability',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Availability', 'matjar' ),
				'subtitle'     	=> esc_html__( 'Show Product availability message like In Stock, Out Of Stock, Hurry left, etc...', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'        	=> 'single-product-availability-instock-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'In Stock Message', 'matjar' ),
				'subtitle'		=> esc_html__( 'Use {qty} for show number of quantity.', 'matjar' ),
                'default' 		=> 'In Stock',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'            => 'single-product-availability-lowstock-qty',
                'type'          => 'slider',
                'title'         => esc_html__( 'Low Stock Qty', 'matjar' ),
                'subtitle'		=> esc_html__( 'How many numbers you want to display below low stock messages. like Hurry, Only {qty} left.', 'matjar' ),
                'default'       => 5,
                'min'           => 1,
                'step'          => 1,
                'max'           => 25,
                'display_value' => 'text',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'        	=> 'single-product-availability-hurry-left-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Stock Hurry Left Message', 'matjar' ),
				'subtitle'		=> esc_html__( 'Default template is: Hurry, Only {qty} left.Here {qty} is number of item available in stock', 'matjar' ),
                'default' 		=> 'Hurry, Only {qty} left.',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'        	=> 'single-product-availability-outstock-msg',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Out of Stock Message', 'matjar' ),
                'default' 		=> 'Out of Stock',
				'required' 		=> array( 'single-product-availability', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-brands',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Brands', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product brand. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-short-description',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Short Description(Highlight)', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product short description/highlight. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'        	=> 'single-product-short-description-label',
                'type'      	=> 'text',
                'title'     	=> esc_html__( 'Short Description(Highlight) Label', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product short description/highlight label text. ', 'matjar' ),
                'default' 		=> 'Highlight',
				'required' 		=> array( 'single-product-short-description', '=', 1 )
            ),
			array(
                'id'       		=> 'product-add-to-cart-ajax',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Add to Cart Using Ajax', 'matjar' ),
				'subtitle'    	 => esc_html__( 'Add to cart product using ajax without load page. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-size-chart',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Size Guide', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show size guide. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'single-product-meta',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Meta', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show or hide product brand, category, tag, etc...', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),		
			array(
                'id'       		=> 'single-product-share',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Share', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Show product share. ', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
		)
	) );
	
	/*
	* Product Bought Together
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Bought Together', 'matjar' ),
        'id'         => 'product-bought-together',
		'subsection' => true,
        'fields'     => array(
			
			array(
                'id'       		=> 'single-product-bought-together',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Bought Together', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'type'     		=> 'text',
                'id'			=> 'product-bought-together-title',
                'title'			=> esc_html__( 'Bought Together Title', 'matjar' ),
				'default'  		=> 'Frequently Bought Together',
                'required' 		=> array( 'single-product-bought-together', '=', 1 )
            ),
			array(
                'id'       		=> 'product-bought-together-location',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Bought Together Location', 'matjar' ),
                'options'  		=> array(
					'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'matjar' ),
					'after-summary'		=> esc_html__( 'After Summary', 'matjar' ),					
					'in-tab'  			=> esc_html__( 'In Tab', 'matjar' ),
				),
                'default'  		=> 'summary-bottom',
				'required' 		=> array( 'single-product-bought-together', '=', 1 )
            ),			
		),
	) );
	
	/*
	* Product Tags
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Tabs', 'matjar' ),
        'id'         => 'product-tabs',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'single-product-tabs',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Tabs', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'single-product-tabs-style',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product Tabs Style', 'matjar' ),
                'options'  		=> array(
					'tabs'  		=> esc_html__( 'Tabs', 'matjar' ),
					'accordion'		=> esc_html__( 'Accordion', 'matjar' ),					
					'toggle'  		=> esc_html__( 'Toggle', 'matjar' ),
				),
                'default'  		=> 'tabs',
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-tabs-location',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Product Tabs Location', 'matjar' ),
                'options'  		=> array(
					'after-summary'		=> esc_html__( 'After Summary', 'matjar' ),	
					'summary-bottom'  	=> esc_html__( 'Summary Bottom', 'matjar' ),
				),
                'default'  		=> 'after-summary',
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
			array(
                'id'       		=> 'single-product-tabs-titles',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Product Tabs Titles', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
				'required' 		=> array( 'single-product-tabs', '=', 1 )
            ),
		),
	) );
	
	/*
	* Product Related/Up-Sells/Recently-Viewed
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Related/Up-Sells/Rviewed', 'matjar' ),
        'id'         => 'product-related-upsells-rv',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       		=> 'upsells-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Up Sells Products', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'related-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Related Products', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'recently-viewed-products',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Recently Viewed Products', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'            	=> 'related-upsells-products',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Show Number Of Products', 'matjar' ),
				'subtitle'     		=> esc_html__( 'How many products you want to display?', 'matjar' ),
                'default'       	=> 12,
                'min'           	=> 1,
                'step'          	=> 1,
                'max'           	=> 24,
                'display_value' 	=> 'text',
            ),
			array(
                'id'       			=> 'related-upsell-auto-play',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Carousel Autoplay', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'related-upsells-loop',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Carousel Inifnity Loop', 'matjar' ),
                'subtitle' 			=> esc_html__( 'Enables related/up sells products carousel Inifnity loop. Duplicate last and first products to get loop illusion.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'related-upsell-navigation',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Carousel Navigation', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),
			array(
                'id'       			=> 'related-upsell-product-dots',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Carousel Dots Navigation', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 1,
            ),			
			array(
                'id'       			=> 'related-upsell-products-columns',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Products Per Row', 'matjar' ),
				'subtitle'      	=> esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  			=> array(
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
					4	 	=> esc_html__( '4', 'matjar' ),
					5	 	=> esc_html__( '5', 'matjar' ),
					6	 	=> esc_html__( '6', 'matjar' ),
                ),
                'default'  			=> 5,
            ),
			array(
                'id'       			=> 'related-upsell-products-columns-tablet',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Products Per Row Tablet', 'matjar' ),
				'subtitle'      	=> esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  			=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
					4	 	=> esc_html__( '4', 'matjar' ),
                ),
                'default'  			=> 3,
            ),
			array(
                'id'       			=> 'related-upsell-products-columns-mobile',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Products Per Row Mobile', 'matjar' ),
				'subtitle'      	=> esc_html__( 'How many products should be shown per row?', 'matjar' ),
                'options'  			=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                ),
                'default'  			=> 2,
            ),
		),
	) );
	
	/**
	* Advance Options
	*/ 
    Redux::setSection( $opt_name, array(
        'title'   		=> esc_html__( 'Advance Options ', 'matjar' ),
		'id'         	=> 'section-advance-options',
		'subsection' 	=> true,
        'fields'  		=> array(
			array(
                'id'    			=> 'delivery-return-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Delivery & Return', 'matjar' ),
            ),
			array(
                'id'       			=> 'product-delivery-return',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Delivery & Return', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show delivery & return terms on product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'delivery-return-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Delivery & Return Label', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter your own delivery & return label.', 'matjar' ),
				'default'  			=> 'Delivery & Return',
				'required'			=> array( 'product-delivery-return', '=', 1 )
            ),
			array(
				'id'       			=> 'delivery-return-terms',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'block','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Terms Block', 'matjar' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'Choose delivery & retund terms block. You can add custom block from <a href="%s" target="_blank">here</a>', 'matjar' ), esc_url( admin_url( 'post-new.php?post_type=block' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__( 'Choose terms block', 'matjar' ),
				'required'			=> array( 'product-delivery-return', '=', 1 )
			),
			array(
                'id'    			=> 'ask-quetion-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Ask a Question', 'matjar' ),
            ),
			array(
                'id'       			=> 'product-ask-quetion',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Ask a Question', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show ask a question form on product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'ask-quetion-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Ask a Question Label', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter ask a question label text.', 'matjar' ),
				'default'  			=> 'Ask a Question',
				'required'			=> array( 'product-ask-quetion', '=', 1 )
            ),
			array(
                'id'       			=> 'ask-quetion-form-title',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Ask a Question Form Title', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter ask a question form(popup) title.', 'matjar' ),
				'default'  			=> 'Ask a Question',
				'required'			=> array( 'product-ask-quetion', '=', 1 )
            ),
			array(
				'id'       			=> 'ask-question-form',
				'type'     			=> 'select',
				'data' 	   			=> 'posts',
				'args' 				=> array( 'post_type'=>'wpcf7_contact_form','posts_per_page' => -1 ),
				'title'    			=> esc_html__('Select Ask Question Form', 'matjar' ),
				'subtitle'   		=> wp_kses( sprintf( __( 'Choose ask a question form. You can add custom form  from <a href="%s" target="_blank">here</a>', 'matjar' ), esc_url( admin_url( 'admin.php?page=wpcf7-new' ) ) ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
				'placeholder' 		=> esc_attr__( 'Choose form block', 'matjar' ),
				'required'			=> array( 'product-ask-quetion', '=', 1 )
			),
			array(
                'id'    			=> 'estimated-delivery-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Estimated Delivery Time', 'matjar' ),
            ),
			array(
                'id'       			=> 'product-estimated-delivery',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Estimated Delivery', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show estimated delivery on product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),			
			array(
                'id'       			=> 'estimated-delivery-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Estimated Delivery Label', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter your own estimated delivery label.', 'matjar' ),
				'default'  			=> 'Estimated Delivery:',
				'required'			=> array( 'product-estimated-delivery', '=', 1 )
            ),
			array(
				'id' 				=> 'estimated-delivery-days',
				'type' 				=> 'slider',
				'title' 			=> esc_html__( 'Set Estimated Days', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Set estimated delivery days. Ex. 3-7 days', 'matjar' ),
				"min" 				=> 1,
				"step" 				=> 1,
				"max" 				=> 30,
				'display_value' 	=> 'text',
				'handles' 			=> 2,
				"default" 			=> array(
					1 		=> 3,
					2 		=> 7,
				),
				'required' 			=> array( 'product-estimated-delivery', '=', 1 ),
			),
			array(
                'id'    			=> 'product-visitor-count-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Visitor Count', 'matjar' ),
            ),
			array(
                'id'       			=> 'single-product-visitor-count',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Visitor Count', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show the number of fake visitors currently viewing a product on product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
				'id' 				=> 'random-visitor-number',
				'type' 				=> 'slider',
				'title' 			=> esc_html__( 'Set Random Number', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Set min and max range to get random number between these value.', 'matjar' ),
				"min" 				=> 1,
				"step" 				=> 1,
				"max" 				=> 200,
				'display_value' 	=> 'text',
				'handles' 			=> 2,
				"default" 			=> array(
					1 		=> 20,
					2 		=> 50,
				),
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
			),
			array(
                'id'       			=> 'visitor-count-text',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Enter Visitor Text', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter visitor text. Use {visitor_count} for display visitor count number.', 'matjar' ),
				'default'  			=> '{visitor_count} People viewing this product right now!',
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
            ),
			array(
				'id'       			=> 'visitor-count-delay-time',
				'type'     			=> 'slider', 
				'title'    			=> esc_html__( 'Update Visitors Count Number', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Select seconds to delay update the number of visitors count.', 'matjar' ),
				'default'  			=> 5,
				'min'      			=> 1,
				'step'     			=> 1,
				'max'      			=> 60,
				'display_value' 	=> 'text',
				'required' 			=> array( 'single-product-visitor-count', '=', 1 ),
			),
			array(
                'id'    			=> 'product-policy-notice',
                'type'   			=> 'info',
                'notice' 			=> false,
                'title' 			=> esc_html__( 'Product Policy', 'matjar' ),
            ),
			array(
                'id'       			=> 'single-product-policies',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Product Policy', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show product policy on single product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
				'id'				=> 'product-policies',
				'type'				=> 'repeater',
				'title'				=> esc_html__( 'Product Policy List', 'matjar' ),
				'bind_title'		=> 'policy_title',
				'group_values'		=> true,
				'fields'     		=> array(
					array(
						'id'          	=> 'policy_title',
						'title'   		=> esc_html__( 'Enter Title', 'matjar' ),
						'type'        	=> 'text',
						'placeholder' 	=> esc_html__( 'Tile', 'matjar' ),
					),
					array(
						'id'			=> 'policy_icon_class',
						'title'   		=> esc_html__( 'Enter Font Class', 'matjar' ),
						'type'			=> 'text',
						'placeholder'	=> esc_html__( 'Font icon class', 'matjar' ),
					),               
					array(
						'id'      		=> 'policy_block',
						'type'    		=> 'select',
						'title'   		=> esc_html__( 'Select Block', 'matjar' ),
						'options' 		=> matjar_get_posts_by_post_type( 'block', esc_html__( 'Select Block', 'matjar' ) ),
						'placeholder' 	=> esc_html__( 'Select Block', 'matjar' ),
					),
				),
				'default'			=> array(
					'redux_repeater_data' 	=> array(
						array(
							'title' => '',
						),
						array(
							'title' => '',
						),
						array(
							'title' => '',
						),
						array(
							'title' => '',
						)
					),
					'policy_title'      	=> array(
						'Free Shipping',
						'1 Year Warranty',
						'Secure payment',
						'30 Days Return',
					),
					'policy_icon_class'   	=> array(
						'jricon-truck',
						'jricon-shield-check',
						'jricon-handshake',
						'jricon-reload',
					),				
					'policy_block'          => array(
						'',
						'',
						'',
						'',
					),
				),
				'required' 			=> array( 'single-product-policies', '=', 1 ),
			),
			array(
                'id'    		=> 'product-trust-badge-notice',
                'type'   		=> 'info',
                'notice' 		=> false,
                'title' 		=> esc_html__( 'Trust Badge Image', 'matjar' ),
            ),
			array(
                'id'       			=> 'single-product-trust-badge',
                'type'     			=> 'switch',
                'title'    			=> esc_html__( 'Trust Badge', 'matjar' ),
				'subtitle'			=> esc_html__( 'Show trust badge image on single product page.', 'matjar' ),
                'on'       			=> esc_html__( 'Yes', 'matjar' ),
				'off'      			=> esc_html__( 'No', 'matjar' ),
				'default'  			=> 0,
            ),
			array(
                'id'       			=> 'trust-badge-label',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Trust Badge Label', 'matjar' ),
				'subtitle' 			=> esc_html__( 'Enter your own trust badge label.', 'matjar' ),
				'default'  			=> 'Guaranteed Safe Checkout',
				'required'			=> array( 'single-product-trust-badge', '=', 1 )
            ),
			array(
                'id'       		=> 'trust-badge-image',
                'type'     		=> 'media',
                'url'      		=> true,
                'title'    		=> esc_html__( 'Trust Badge Image', 'matjar' ),
                'compiler' 		=> 'true',
                'subtitle' 		=>  esc_html__( 'Upload trust badge image.', 'matjar' ),
                'default'  		=> array(),
				'required' 		=> array( 'single-product-trust-badge', '=', 1 ),
            ),
		)
    ));
	
	/**
	* Login/Register 
	*/ 
    Redux::setSection( $opt_name, array(
        'title'   		=> esc_html__( 'Login/Register', 'matjar' ),
		'id'         	=> 'section-login-register',
		'icon'		 	=> 'el el-user',
        'fields'  		=> array(
			array(
				'id'       		=> 'login-information',
				'type'     		=> 'editor',
				'title'    		=> esc_html__( 'Login Information', 'matjar' ),
				'subtitle'		=> esc_html__( 'Display login information in login form.', 'matjar' ),
				'args'   		=> array(
					'teeny'   => true,
				),
				'default'  		=> esc_html__( 'Get access to your Orders, Wishlist and Recommendations.', 'matjar' ),
			)
		)
    ));
	
	if ( function_exists( 'matjar_vendor_theme_options' ) && ( class_exists( 'WeDevs_Dokan' ) || class_exists( 'WC_Vendors' ) || class_exists( 'WCMp' ) || class_exists( 'WCFMmp' ) ) ) {
		/*
		* Vendor Options
		*/
		$vendor_options = matjar_vendor_theme_options();
		Redux::setSection( $opt_name, array(
			'title'      => esc_html__( 'Vendor Options', 'matjar' ),
			'id'         => 'vendor-options',
			'icon'		 => 'el-icon-broom',
			'fields'     => $vendor_options,
		) );
	}
	
	/*
	* Page Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'matjar' ),
        'id'         => 'page',
		'icon'		 => 'el el-list-alt',
        'fields'     => array(
			array(
                'id'       => 'page-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' => esc_html__( 'Select page layout with sidebar postion.', 'matjar' ),
				'options'  => array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  => 'full-width'
            ),
			array(
                'id'       => 'page-sidebar-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Widget Area', 'matjar' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'page-comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comment', 'matjar' ),
                'subtitle' => esc_html__( 'Show comments and comment form on page.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
		)
	) );
	
	/*
	* Page Widget Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sidebar Widget', 'matjar' ),
        'id'         => 'page-widget',
        'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'sticky-sidebar',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sidebar Sticky', 'matjar' ),
                'subtitle' => esc_html__( 'When you scroll the page at this time you want to sticky sidebar part in all pages or not.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'widget-toggle',
                'type'     => 'switch',
                'title'    => esc_html__( 'Widget Toggle', 'matjar' ),
                'subtitle'     => esc_html__( 'Enable page widget toggle or not.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'widget-menu-toggle',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Widget Menu Toggle', 'matjar' ),
                'subtitle'     => esc_html__( 'Enable page widget menu toggle or not.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'widget-items-hide-max-limit',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Widget Items Hide', 'matjar' ),
                'subtitle'     => esc_html__( 'Enable widget items hide max limit.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'            => 'number-of-show-widget-items',
                'type'          => 'slider',
                'title'         => esc_html__( 'Show Number Of Widget Items', 'matjar' ),
                'default'       => 8,
                'min'           => 5,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'text',
				'required' => array( 'widget-items-hide-max-limit', '=', 1 )
            ),
			array(
                'id'       => 'sidebar-canvas-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sidebar Canvas In Mobile', 'matjar' ),
                'subtitle' => esc_html__( 'Display sidebar canvas in mobile.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
		)
	) );
	
	/*
	* 404 Page
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'matjar' ),
        'id'         => '404-page',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => '404-use-image-text',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Use Text Or Image', 'matjar' ),
                'desc' => esc_html__( 'What a show on 404 page? Text or Image.', 'matjar' ),
                'options'  => array(
                    '404-text'     => 'Text',
                    '404-image' => 'Image',
                ),
                'default'  => '404-text'
            ),
			array(
                'id'       => '404-page-title',
                'type'     => 'textarea',
                'title'    => esc_html__( '404 Page Title', 'matjar' ),
				'default'  => 'Oops! That page can&rsquo;t be found.',
				'required' => array( '404-use-image-text', '=', '404-text' )
            ),
			array(
                'id'       => 'show-previous-link',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Previous Page Link', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( '404-use-image-text', '=', '404-text' )
            ),
			array(
                'id'       => '404-page-tagline',
                'type'     => 'textarea',
                'title'    => esc_html__( '404 Page Tag Line', 'matjar' ),
				'default'  => 'Try using the button below to go to back previous page.',
				'required' => array( 'show-previous-link', '=', 1 )
            ),
			array(
                'id'       => 'previous-link-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Previous Page Link Title', 'matjar' ),
				'default'  => 'Go to Back',
				'required' => array( 'show-previous-link', '=', 1 )
            ),
			array(
                'id'       => '404-page-image',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( '404 Page Image', 'matjar' ),
                'compiler' => 'true',
                'desc' =>  esc_html__( 'Upload 404 page image and show on 404 page.', 'matjar' ),
                'default'  => array(),
				'required' => array( '404-use-image-text', '=', '404-image' )
            ),
		)
	) );

	/*
	* Post options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog / Post', 'matjar' ),
        'id'         => 'blog',
		'icon'		 => 'el el-edit',
        'fields'     => array(
			
			array(
                'id'       => 'post-date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Date', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post date', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'post-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Categories', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post categories', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'sticky-post-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Post Icon', 'matjar' ),
                'subtitle'    => esc_html__( 'Show sticky post icon', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'post-format-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Format Icon', 'matjar' ),
                'subtitle'    => esc_html__( 'show post format icon', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'post-meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post meta', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'specific-post-meta',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Specific Post Meta', 'matjar' ),
                'subtitle' => esc_html__( 'Select specific post meta to dispaly on post.', 'matjar' ),
                'multi'    => true,
                'options'  => array(
					'post-author' 		=> esc_html__( 'Author', 'matjar' ),
                    'post-date' 		=> esc_html__( 'Date', 'matjar' ),
                    'post-category' 	=> esc_html__( 'Category', 'matjar' ),					
                    'post-tags' 		=> esc_html__( 'Tags', 'matjar' ),
					'post-comments' 	=> esc_html__( 'Comments', 'matjar' ),
					'post-views' 		=> esc_html__( 'Views', 'matjar' ),
					'post-rtime' 		=> esc_html__( 'Read Time', 'matjar' ),
					'post-share' 		=> esc_html__( 'Share', 'matjar' ),
					'post-edit' 		=> esc_html__( 'Edit', 'matjar' ),
				),
                'default'  => array( 'post-author', 'post-date', 'post-comments' ),
				'required' => array( 'post-meta', '=', 1 )
            ),
			array(
                'id'       => 'post-meta-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Meta Icon', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post meta icon', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
                'off'      => esc_html__( 'No', 'matjar' ),
                'default'  => 1,
				'required' => array( 'post-meta', '=', 1 )
            ),
			array(
                'id'       => 'post-meta-separator',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Meta Separator', 'matjar' ),
                'subtitle'    => esc_html__( 'Select post meta separator', 'matjar' ),
                'options'  => array(
					'meta-separator-slash'	=> esc_html( '/' ),
					'meta-separator-colon'	=> esc_html( ':' ),
					'meta-separator-dot'	=> esc_html( '.' ),
					'meta-separator-bar'	=> esc_html( '|' ),
					'meta-separator-hyphen'	=> esc_html( '-' ),
					'meta-separator-tilde'	=> esc_html( '~' ),
				),
                'default'  => 'meta-separator-colon',
				'required' => array( 'post-meta', '=', 1 )
            ),
		)
	) );
	
	/*
	* Blog/Archives options
	*/
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog/Archive Page', 'matjar' ),
        'id'         => 'blog-archive',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       => 'blog-page-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' => esc_html__( 'Select blog/archive page layout with sidebar postion.', 'matjar' ),
				'options'  => array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  => 'right-sidebar'
            ),
			array(
                'id'       => 'blog-page-sidebar-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Widget Area', 'matjar' ),
                'subtitle'    => esc_html__( 'Choose sidebar widget area', 'matjar' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'blog-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       		=> 'blog-page-title',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Title', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Show blog page title.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'          	=> 'blog-page-title-text',
                'type'        	=> 'text',
                'title'       	=> esc_html__( 'Page Title Text', 'matjar' ),
                'subtitle' 	  	=> esc_html__( 'Enter blog page title.', 'matjar' ),
                'default'       => esc_html__( 'Blog', 'matjar' ),
                'placeholder' 	=> esc_attr__( 'Enter blog post title here', 'matjar' ),
				'required' 		=> array( 'blog-page-title', '=', 1 )
            ),
			array(
                'id'       		=> 'blog-page-breadcrumb',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Page Breadcrumb', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Show blog page breadcrumb.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
                'id'       		=> 'blog-post-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Post Style', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Select post style', 'matjar' ),
                'options'  		=> array(
					'blog-classic' => array(
                        'title' 	=> esc_html__( 'Blog Classic', 'matjar' ),
                        'alt' 		=> esc_html__( 'Blog Classic', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/blog-classic.png',
                    ),
					'blog-listing' => array(
                        'title' 	=> esc_html__( 'Blog Listing', 'matjar' ),
                        'alt' 		=> esc_html__( 'Blog Listing', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/blog-listing.png',
                    ),
					'blog-chess' => array(
                        'title' 	=> esc_html__( 'Blog Chess', 'matjar' ),
                        'alt' 		=> esc_html__( 'Blog Chess', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/blog-chess.png',
                    ),
					'blog-grid' => array(
                        'title' 	=> esc_html__( 'Blog Grid', 'matjar' ),
                        'alt' 		=> esc_html__( 'Blog Grid', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/blog-grid.png',
                    ),
                ),
                'default'  	=> 'blog-classic',
            ),
			array(
                'id'       => 'blog-grid-layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gird Layout', 'matjar' ),
                'subtitle'    => esc_html__( 'Select blog gird layout', 'matjar' ),
                'options'  => array(
                    'simple-grid' 		=> esc_html__( 'Simple', 'matjar' ),
                    'masonry-grid' 		=> esc_html__( 'Masonry', 'matjar' ),
                ),
                'default'  => 'simple-grid',
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),
			array(
                'id'       		=> 'blog-grid-columns',
                'type'    		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns', 'matjar' ),
                'subtitle' 		=> esc_html__( 'If you have choosed post style grid or masonry grid layout, so you can manage here number of grid columns display.', 'matjar' ),
                'options'  		=> array(
                    2 			=> esc_html__( '2', 'matjar' ),
                    3 			=> esc_html__( '3', 'matjar' ),
					4 			=> esc_html__( '4', 'matjar' ),
                ),
                'default'  		=> 2,
				'required' 		=> array( 'blog-post-style', '=', 'blog-grid' )
            ),			
			array(
                'id'       		=> 'blog-grid-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Tablet', 'matjar' ),
				'subtitle'      => esc_html__( 'How many post should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
                ),
                'default'  		=> 2,
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),
			array(
                'id'       		=> 'blog-grid-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Mobile', 'matjar' ),
				'subtitle'      => esc_html__( 'How many post should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                ),
                'default'  		=> 1,
				'required' => array( 'blog-post-style', '=', 'blog-grid' )
            ),			
			array(
                'id'       => 'blog-post-thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Thumbnail', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post thumbnail', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'blog-post-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Title', 'matjar' ),
                'subtitle'    => esc_html__( 'Show post title', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
                'off'      => esc_html__( 'No', 'matjar' ),
                'default'  => 1,
            ),
			array(
                'id'       => 'show-blog-post-content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Content', 'matjar' ),
                'subtitle' => esc_html__( 'Show blog post content.', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Yes', 'matjar' ),
                'off'      => esc_html__( 'No', 'matjar' ),
            ),
			array(
                'id'       		=> 'blog-post-content',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Post Content', 'matjar' ),
                'subtitle'    	=> esc_html__( 'Select post content', 'matjar' ),
                'options'  		=> array(
					'excerpt-content' 	=> esc_html__( 'Excerpt Content', 'matjar' ),
					'full-content' 		=> esc_html__( 'Full Content', 'matjar' ),
				),
                'default'  		=> 'full-content',
				'required' 		=> array( 'show-blog-post-content', '=', 1 )
            ),
			array(
                'id'            => 'blog-excerpt-length',
                'type'          => 'slider',
                'title'         => esc_html__( 'Excerpt Length (words)', 'matjar' ),
                'subtitle'      => esc_html__( 'Show blog listing excerpt content length (words).', 'matjar' ),
                'default'       => 30,
                'min'           => 10,
                'step'          => 1,
                'max'           => 100,
                'display_value' => 'text',
				'required' => array( 'blog-post-content', '=', 'excerpt-content' )
            ),
			array(
                'id'       => 'read-more-button',
                'type'     => 'switch',
                'title'    => esc_html__( 'Read More Button', 'matjar' ),
                'subtitle'    => esc_html__( 'Show read more button', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),			
			array(
                'id'       => 'read-more-button-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Button Style', 'matjar' ),
                'subtitle'    => esc_html__( 'Select read more button style', 'matjar' ),
                'options'  => array(
					'read-more-link' => esc_html__( 'Link', 'matjar' ),
					'read-more-button' => esc_html__( 'Button', 'matjar' ),
					'read-more-button-fill' => esc_html__( 'Button Fill', 'matjar' ),
				),
                'default'  => 'read-more-link',
				'required' => array( 'read-more-button', '=', 1 )
            ),
			array(
                'id'       => 'post-readmore-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Read More Button Text', 'matjar' ),
                'subtitle'    => esc_html__( 'Enter read more button text', 'matjar' ),
				'default'  => 'Read More',
				'required' => array( 'read-more-button', '=', 1 )
            ),
			array(
                'id'       => 'blogs-pagination-type',
                'type'     => 'button_set',
                'title'    => esc_html__( ' Pagination Style', 'matjar' ),
                'subtitle'    => esc_html__( ' Select pagination style', 'matjar' ),
                'options'  => array(
					'default' 				=> esc_html__( 'Default', 'matjar' ),
					'infinity-scroll'		=> esc_html__( 'Infinity Scroll', 'matjar' ),
					'load-more-button' 		=> esc_html__( 'Load More', 'matjar' ),
				),
                'default'  => 'default',
            ),
			array(
                'id'       => 'blog-pagination-load-more-button-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Load More Button Text', 'matjar' ),
				'subtitle' => esc_html__( 'Enter load more button text.', 'matjar' ),
                'default'  => 'Load More Posts',
				'required' => array( 'blogs-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
			array(
                'id'       => 'blog-pagination-finished-message',
                'type'     => 'text',
                'title'    => esc_html__( 'Finished Message', 'matjar' ),
				'subtitle' => esc_html__( 'Text to display when no additional items are available.', 'matjar' ),
                'default'  => 'No More Posts Available',
				'required' => array( 'blogs-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),			
		)
	) );
	
	/*
	* Single Post options
	*/
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Post', 'matjar' ),
        'id'         => 'single-post',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       => 'single-post-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' => esc_html__( 'Select single post page layout with sidebar postion.', 'matjar' ),
				'options'  => array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  => 'right-sidebar'
            ),
			array(
                'id'       => 'single-post-sidebar-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Widget Area', 'matjar' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'single-post-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'single-post-thumbnail',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Thumbnail', 'matjar' ),
                'subtitle' => esc_html__( 'Show post thumbnail or not.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-gallery-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Gallery Style', 'matjar' ),
                'options'  => array(
					'slider'		=>esc_html__( 'Slider', 'matjar' ),
					'grid'			=>esc_html__( 'Grid', 'matjar' ),
					'one-column'	=>esc_html__( 'One Column', 'matjar' ),					
				),
                'default'  => 'slider',
				'required' => array( 'single-post-thumbnail', '=', 1 )
            ),
			array(
                'id'       => 'single-post-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Title', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'         	=> 'single-post-title-text',
                'type'        	=> 'text',
                'title'       	=> esc_html__( 'Page Title Text', 'matjar' ),
                'default'       => esc_html__( 'Our Blog', 'matjar' ),
                'placeholder' 	=> esc_attr__( 'Enter post title here', 'matjar' ),
				'required' 		=> array( 'single-post-title', '=', 1 )
            ),
			array(
                'id'       => 'single-post-author-info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Author Info', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       => 'single-post-tag',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Tags', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       => 'single-post-social-share-link',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share Links', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       => 'single-post-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Navigation', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-comment',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Post Comment', 'matjar' ),
                'subtitle' => esc_html__( 'Show post comments and comment form or not.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-post-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Post', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       	=> 'single-posts-related',
                'type'     	=> 'slider',
                'title'    	=> esc_html__( 'Show Related Posts', 'matjar' ),
				'subtitle'  => esc_html__( 'Show/display number of related posts.', 'matjar' ),
                'default'   => 6,
                'min'       => 2,
                'step'      => 1,
                'max'       => 12,
                'display_value' => 'text',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-taxonomy',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Taxonomy', 'matjar' ),
				'subtitle' => esc_html__( 'Get related posts by post taxonomy category or tag.', 'matjar' ),
                'options'  => array(
					'post_tag'=>esc_html__( 'Tag', 'matjar' ),
					'category'=>esc_html__( 'Category', 'matjar' ),					
				),
                'default'  => 'post_tag',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-orderby',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Orderby', 'matjar' ),
                'options'  => array(
					'none'=>esc_html__( 'None', 'matjar' ),
					'rand'=>esc_html__( 'Random', 'matjar' ),
					'ID'=>esc_html__( 'ID', 'matjar' ),
					'name'=>esc_html__( 'Name', 'matjar' ),
					'date'=>esc_html__( 'Date', 'matjar' ),
					'modified'=>esc_html__( 'Modified Date', 'matjar' ),					
					'comment_count'=>esc_html__( 'Comment Count', 'matjar' ),
				),
                'default'  => 'rand',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-order',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Post Order', 'matjar' ),
                'options'  => array(
					'DESC'=>esc_html__( 'DESC', 'matjar' ),
					'ASC'=>esc_html__( 'ASC', 'matjar' ),					
				),
                'default'  => 'DESC',
				'required' => array( 'single-post-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-posts-display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display Posts In', 'matjar' ),
				'subtitle' => esc_html__( 'Display related posts in slider or grid.', 'matjar' ),
                'options'  => array(
					'slider'=>esc_html__( 'Slider', 'matjar' ),
					'grid'=>esc_html__( 'Grid', 'matjar' ),					
				),
                'default'  => 'slider',
				'required' => array( 'single-post-related', '=', 1 ),
            ),			
		)
	) );
	
	/*
	* Portfolio options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio', 'matjar' ),
        'id'         => 'portfolio',
		'icon'		 => 'el el-th',
        'fields'     => array(
			array(
                'id'       => 'enable-portfolio',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Enable', 'matjar' ),
                'off'      => esc_html__( 'Disable', 'matjar' ),
            ),
			array(
                'id'       => 'portfolio-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Slug Name', 'matjar' ),
                'default'  => '',
                'placeholder'  => esc_attr( 'portfolio' ),
            ),
			array(
                'id'       => 'portfolio-name',
                'type'     => 'text',
                'title'    => esc_html__( 'Name', 'matjar' ),
                'default'  => '',
                'placeholder'  => esc_attr__( 'Portfolios', 'matjar' ),
            ),
			array(
                'id'       => 'portfolio-singular-name',
                'type'     => 'text',
                'title'    => esc_html__( 'Singular Name', 'matjar' ),
                'default'  => '',
                'placeholder'  => esc_attr__( 'Portfolio', 'matjar' ),
            ),
			array(
                'id'       => 'portfolio-cat-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Category Slug', 'matjar' ),
                'default'  => '',
                'placeholder'  => esc_attr( 'portfolio_cat' ),
            ),
			array(
                'id'       => 'portfolio-skill-slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Skill Slug', 'matjar' ),
                'default'  => '',
                'placeholder'  => esc_attr( 'portfolio_skill' ),
            ),
			array(
                'id'       => 'portfolio-meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Meta', 'matjar' ),
                'default'  => 1,
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
            ),
			array(
                'id'       => 'specific-portfolio-meta',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Specific Portfolio Meta', 'matjar' ),
                'subtitle' => esc_html__( 'Show/hide specific meta.', 'matjar' ),
                'multi'    => true,
                'options'  => array(
                    'categories' 	=> esc_html__( 'Category', 'matjar' ),
                    'skills' 		=> esc_html__( 'Skill', 'matjar' ),
                ),
                'default'  => array( 'categories', 'skills' ),
				'required' => array( 'portfolio-meta', '=', 1 ),
            ),		
		)
	) );
	
	/*
	* Portfolio Archive Page options
	*/
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Portfolio Archive', 'matjar' ),
        'id'         => 'portfolio-archive',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       => 'portfolio-page-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Archive Page Layout', 'matjar' ),
                'desc'     => esc_html__( 'Select portfolio archive page layout with sidebar postion.', 'matjar' ),
				'options'  => array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  => 'full-width'
            ),
			array(
                'id'       => 'portfolio-sidebar-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Widget Area', 'matjar' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'portfolio-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'portfolio-page-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Title', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'        => 'portfolio-page-title-text',
                'type'      => 'text',
                'title'     => esc_html__( 'Page Title Text', 'matjar' ),
                'placeholder' => esc_attr__( 'Enter portfolio title here', 'matjar' ),
				'default'  	=> 'Portfolio',
				'required' 	=> array( 'portfolio-page-title', '=', 1 )
            ),
			array(
                'id'       => 'portfolio-page-breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Breadcrumb', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'portfolio-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Hover Style', 'matjar' ),
                'options'  => array(
                    'portfolio-style-1' => array(
                        'alt' => 'Style 1',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/style-1.png',
                    ),
					'portfolio-style-2' => array(
                        'alt' => 'Style 2',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/style-2.png',
                    ),
					'portfolio-style-3' => array(
                        'alt' => 'Style 3',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/style-3.png',
                    ),
				),
				'default'  => 'portfolio-style-1',
			),
			array(
                'id'       => 'portfolio-grid-layout',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Portfolio Grid Layout', 'matjar' ),
                'options'  => array(
                    'simple-grid' 	=> esc_html__( 'Simple', 'matjar' ),
                    'masonry-grid' 	=> esc_html__( 'Masonry', 'matjar' ),
                ),
                'default'  => 'masonry-grid',
            ),
			array(
                'id'       		=> 'portfolio-grid-columns',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Grid Columns', 'matjar' ),
				'subtitle'      => esc_html__( 'How many portfolio should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    2 		=> esc_html__( '2', 'matjar' ),
                    3 		=> esc_html__( '3', 'matjar' ),
					4 		=> esc_html__( '4', 'matjar' ),
                ),
                'default'  => 3,
            ),	
			array(
                'id'       		=> 'portfolio-grid-columns-tablet',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Tablet', 'matjar' ),
				'subtitle'      => esc_html__( 'How many portfolio should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                    3	 	=> esc_html__( '3', 'matjar' ),
                ),
                'default'  		=> 2,
            ),
			array(
                'id'       		=> 'portfolio-grid-columns-mobile',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Gird Columns Mobile', 'matjar' ),
				'subtitle'      => esc_html__( 'How many portfolio should be shown per row?', 'matjar' ),
                'options'  		=> array(
                    1		=> esc_html__( '1', 'matjar' ),
                    2		=> esc_html__( '2', 'matjar' ),
                ),
                'default'  		=> 1,
            ),
			array(
                'id'            => 'portfolio-grid-gap',
                'type'          => 'slider',
                'title'         => esc_html__( 'Grid Gapping', 'matjar' ),
                'subtitle'      => esc_html__( 'Grid gapping/spacing between portfolio.', 'matjar' ),
                'default'       => 15,
                'min'           => 0,
                'step'          => 5,
                'max'           => 15,
				'required' => array( 'portfolio-style', '=', array( 'portfolio-style-2', 'portfolio-style-3' ) ),
            ),
			array(
                'id'       => 'portfolio-filter',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Filter', 'matjar' ),
				'subtitle' => esc_html__( 'Show portfolios filter or not.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'            => 'portfolio-per-page',
                'type'          => 'slider',
                'title'         => esc_html__( 'Portfolio Per Page', 'matjar' ),
                'subtitle'      => esc_html__( 'Show number of portfolio per page.', 'matjar' ),
                'default'       => 9,
                'min'           => 3,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'text',
            ),
			array(
                'id'       => 'portfolio-button-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hover Button Icon', 'matjar' ),
				'subtitle' => esc_html__( 'Portfolio hover button icon show or hide.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'portfolio-link-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Link Button Icon', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
                'default'  => 1,
				'required' => array( 'portfolio-button-icon', '=', 1 ),
            ),
			array(
                'id'       => 'portfolio-zoom-icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Zoom Image Icon', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'portfolio-button-icon', '=', 1 ),
            ),
			array(
                'id'       => 'portfolio-content-part',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Content Part', 'matjar' ),
				'subtitle' => esc_html__( 'Portfolio bottom content part( title and category) show or hide.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
				 'default'  => 1,
            ),
			array(
                'id'       => 'portfolio-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Category', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
				'required' => array( 'portfolio-content-part', '=', 1 ),
            ),
			array(
                'id'       => 'portfolio-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Portfolio Title', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
                'off'      => esc_html__( 'Hide', 'matjar' ),
                'default'  => 1,
				'required' => array( 'portfolio-content-part', '=', 1 ),
            ),
			array(
                'id'       => 'portfolio-pagination-type',
                'type'     => 'button_set',
                'title'    => esc_html__( ' Pagination Style', 'matjar' ),
                'options'  => array(
					'default'			=> esc_html__( 'Default', 'matjar' ),
					'infinity-scroll'	=> esc_html__( 'Infinity Scroll', 'matjar' ),
					'load-more-button'	=> esc_html__( 'Load More', 'matjar' ),
				),
                'default'  => 'default',
            ),
			array(
                'id'       => 'portfolio-pagination-load-more-button-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Load More Button Text', 'matjar' ),
				'subtitle' => esc_html__( 'Add Load More Button Text.', 'matjar' ),
                'default'  => 'Load More Portfolios',
				'required' => array( 'portfolio-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),
			array(
                'id'       => 'portfolio-pagination-finished-message',
                'type'     => 'text',
                'title'    => esc_html__( 'Finished Message', 'matjar' ),
				'subtitle' => esc_html__( 'Text to display when no additional items are available.', 'matjar' ),
                'default'  => 'No More Portfolios Available',
				'required' => array( 'portfolio-pagination-type', '=', array( 'infinity-scroll', 'load-more-button' ) ),
            ),		
		)
	) );
	
	/*
	* Single Portfolio options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Portfolio', 'matjar' ),
        'id'         => 'single-portfolio',
		'subsection'	 => true,
        'fields'     => array(
			array(
                'id'       => 'single-portfolio-page-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Layout', 'matjar' ),
                'subtitle' => esc_html__( 'Select single post sidebar layout.', 'matjar' ),
				'options'  => array(
                    'full-width' => array(
                        'alt' => esc_html__( 'Full Width', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-none.png',
                    ),                   
                    'left-sidebar' => array(
                        'alt' => esc_html__( 'Left Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-left.png',
                    ), 
					'right-sidebar' => array(
                        'alt' => esc_html__( 'Right Sidebar', 'matjar' ),
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/sidebar-right.png',
                    ), 
                ),
                'default'  => 'full-width'
            ),
			array(
                'id'       => 'single-portfolio-sidebar-widget',
                'type'     => 'select',
                'title'    => esc_html__( 'Sidebar Widget Area', 'matjar' ),
                'data'     => 'sidebars',
                'default'  => 'sidebar-1',
                'required' => array( 'single-portfolio-page-layout', '=', array( 'left-sidebar', 'right-sidebar' ) )
            ),
			array(
                'id'       => 'single-portfolio-layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Layout', 'matjar' ),
               'options'  => array(
                    '4' 	=> array(
                        'alt' => '4 8 Column',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/4_8-layout.png',
                    ),
					'6' 	=> array(
                        'alt' => '6 6 Column',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/6_6-layout.png',
                    ),                   
                    '8' => array(
                        'alt' => '8 4 Column',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/8_4-layout.png',
                    ), 
					'12' => array(
                        'alt' => '12 12 Column',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/portfolio/12_12-layout.png',
                    ),
                ),
                'default'  => '8',
            ),
			array(
                'id'       => 'single-portfolio-gallery',
                'type'     => 'switch',
                'title'    => esc_html__( 'Thumbnail/Gallery', 'matjar' ),
                'subtitle' => esc_html__( 'Show/hide portfolio thumbnail/gallery.', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-gallery-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Gallery Style', 'matjar' ),
                'options'  => array(
					'slider'		=>esc_html__( 'Slider', 'matjar' ),
					'grid'			=>esc_html__( 'Grid', 'matjar' ),
					'one-column'	=>esc_html__( 'One Column', 'matjar' ),					
				),
                'default'  => 'slider',
				'required' => array( 'single-portfolio-gallery', '=', 1 )
            ),
			array(
                'id'       => 'single-portfolio-information-title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Information Title', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Description', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-preview-button',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preview Button', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-client',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Client', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Date', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-category',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Category', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-skill',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Skill', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Share Links', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Project Navigation', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Comment', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'single-portfolio-related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Projects', 'matjar' ),
                'on'       => esc_html__( 'Show', 'matjar' ),
				'off'      => esc_html__( 'Hide', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       	=> 'show-related-portfolios',
                'type'     	=> 'slider',
                'title'    	=> esc_html__( 'Show Related Portfolios', 'matjar' ),
				'subtitle'  => esc_html__( 'Show/display number of related Portfolios.', 'matjar' ),
                'default'   => 6,
                'min'       => 2,
                'step'      => 1,
                'max'       => 12,
                'display_value' => 'text',
				'required' => array( 'single-portfolio-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-portfolios-taxonomy',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Taxonomy', 'matjar' ),
				'subtitle' => esc_html__( 'Get related Portfolios by post taxonomy category or skill.', 'matjar' ),
                'options'  => array(
					'portfolio_cat'=>esc_html__( 'Category', 'matjar' ),
					'portfolio_skill'=>esc_html__( 'Skill', 'matjar' ),					
				),
                'default'  => 'portfolio_cat',
				'required' => array( 'single-portfolio-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-Portfolios-orderby',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Portfolios Orderby', 'matjar' ),
                'options'  => array(
					'none'=>esc_html__( 'None', 'matjar' ),
					'rand'=>esc_html__( 'Random', 'matjar' ),
					'ID'=>esc_html__( 'ID', 'matjar' ),
					'name'=>esc_html__( 'Name', 'matjar' ),
					'date'=>esc_html__( 'Date', 'matjar' ),
					'modified'=>esc_html__( 'Modified Date', 'matjar' ),					
					'comment_count'=>esc_html__( 'Comment Count', 'matjar' ),
				),
                'default'  => 'rand',
				'required' => array( 'single-portfolio-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-portfolios-order',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Portfolios Order', 'matjar' ),
                'options'  => array(
					'DESC'=>esc_html__( 'DESC', 'matjar' ),
					'ASC'=>esc_html__( 'ASC', 'matjar' ),					
				),
                'default'  => 'DESC',
				'required' => array( 'single-portfolio-related', '=', 1 ),
            ),
			array(
                'id'       => 'related-portfolios-display',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Display Portfolios In', 'matjar' ),
				'subtitle' => esc_html__( 'Display related portfolios in slider or grid.', 'matjar' ),
                'options'  => array(
					'slider'=>esc_html__( 'Slider', 'matjar' ),
					'grid'=>esc_html__( 'Grid', 'matjar' ),					
				),
                'default'  => 'slider',
				'required' => array( 'single-portfolio-related', '=', 1 ),
            ),
		)
	) );
	
	/*
	* Social
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'matjar' ),
        'id'         => 'social',
		'icon'		 => 'el el-group',
        'fields'     => array(
		)
	) );
	
	/*
	* Social Profile
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Profile', 'matjar' ),
        'id'         => 'social-profile-section',
		'icon'		 => '',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'social-profile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Social Profile Icon', 'matjar' ),
				'subtitle' => esc_html__( 'Show social profile icon in header and footer.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'social-profile-icons-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Icons Style', 'matjar' ),
                'options'  => array(
					'icons-default' 	=> array(
                        'title' => 'Default',
                        'alt' => 'Default',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/default.png',
                    ),
					'icons-colour'	=> array(
                        'title' => 'Colour',
                        'alt' => 'Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/colour.png',
                    ),                   
                    'icons-bordered'  => array(
                        'title' => 'Bordered',
                        'alt' => 'Bordered',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/bordered.png',
                    ), 
					'icons-fill-colour' => array(
                        'title' => 'Fill Colour',
                        'alt' => 'Fill Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/fill-color.png',
                    ),
					'icons-theme-colour' => array(
                        'title' => 'Theme Colour',
                        'alt' => 'Theme Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/theme-color.png',
                    ),
										
                ),
                'default'  => 'icons-default',
				'required' => array( 'social-profile', '=', 1 )
            ),
			array(
                'id'       => 'profile-icons-size',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Icons Size', 'matjar' ),
                'options'  => array(
                    'icons-size-default'=> esc_html__( 'Default', 'matjar' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'matjar' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'matjar' ),
                ),
                'default'  => 'icons-size-default',
				'required' => array( 'social-profile', '=', 1 )
            ),
			array(
                'id'       => 'facebook-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Facebook', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the facebook icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'twitter-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Twitter', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the twitter icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'instagram-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Instagram', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the instagram icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'linkedin-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Linkedin', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the linkedin icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'flickr-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Flickr', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the flickr icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),			
			array(
                'id'       => 'rss-link',
                'type'     => 'text',
                'title'    => esc_html__( 'RSS', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the rss icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'pinterest-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Pinterest', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the pinterest icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'youtube-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Youtube', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the youtube icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '#',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'tiktok-link',
                'type'     => 'text',
                'title'    => esc_html__( 'TikTok', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the tiktok icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'github-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Github', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the github icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'whatsapp-link',
                'type'     => 'text',
                'title'    => esc_html__( 'WhatsApp', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the whatsapp icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'telegram-link',
                'type'     => 'text',
                'title'    => esc_html__( 'Telegram', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the telegram icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
			array(
                'id'       => 'vk-link',
                'type'     => 'text',
                'title'    => esc_html__( 'VK', 'matjar' ),
                'subtitle' => esc_html__( 'Enter your custom link to show the VK icon. Leave blank to hide icon.', 'matjar' ),
				'default'  => '',
				'required' => array( 'social-profile', '=', 1 ),
            ),
		)
	) );
	
	/*
	* Social Share
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social Share', 'matjar' ),
        'id'         => 'social-share-section',
		'icon'		 => '',
		'subsection' => true,
        'fields'     => array(
			array(
                'id'       => 'social-sharing',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share Icons', 'matjar' ),
				'subtitle' => esc_html__( 'Show social share icons in blog, posts, products, portfolios, etc...', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'social-sharing-icons-style',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Icons Style', 'matjar' ),
                'options'  => array(
					'icons-default' 	=> array(
                        'title' => 'Default',
                        'alt' => 'Default',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/default.png',
                    ),
					'icons-colour'	=> array(
                        'title' => 'Colour',
                        'alt' => 'Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/colour.png',
                    ),                   
                    'icons-bordered'  => array(
                        'title' => 'Bordered',
                        'alt' => 'Bordered',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/bordered.png',
                    ), 
					'icons-fill-colour' => array(
                        'title' => 'Fill Colour',
                        'alt' => 'Fill Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/fill-color.png',
                    ),
					'icons-theme-colour' => array(
                        'title' => 'Theme Colour',
                        'alt' => 'Theme Colour',
                        'img' => MATJAR_ADMIN_IMAGES . 'layout/social-icon/theme-color.png',
                    ),
										
                ),
                'default'  => 'icons-bordered',
				'required' => array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'       => 'sharing-icons-shape',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Icons Shape', 'matjar' ),
                'options'  => array(
					'icons-shape-circle' => esc_html__( 'Circle', 'matjar' ),
                    'icons-shape-square' => esc_html__( 'Square', 'matjar' ),
                ),
                'default'  => 'icons-shape-circle',
				'required' => array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'       => 'sharing-icons-size',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Icons Size', 'matjar' ),
                'options'  => array(
                    'icons-size-default'=> esc_html__( 'Default', 'matjar' ),
					'icons-size-small' 	=> esc_html__( 'Small', 'matjar' ),
					'icons-size-large' 	=> esc_html__( 'Large', 'matjar' ),
                ),
                'default'  => 'icons-size-default',
				'required' => array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'       => 'social-share-manager',
                'type'     => 'sorter',
                'title'    => 'Share Icons Manager',
                'compiler' => 'true',
                'options'  => array(
                    'enabled'  => array(
                        'facebook' 		=> 'Facebook',
                        'twitter'     	=> 'Twitter',
                        'linkedin'   	=> 'Linkedin',
						'telegram'		=> 'Telegram',
						'pinterest'		=> 'Pinterest',
                    ),
                    'disabled' => array(
						'stumbleupon'	=> 'StumbleUpon',
						'tumblr'   		=> 'Tumblr',
						'reddit'   		=> 'Reddit',
						'vk'   			=> 'VK',
						'odnoklassniki' => 'Odnoklassniki',
						'pocket'   		=> 'Pocket',
						'whatsapp'  	=> 'WhatsApp',
						'email'   		=> 'Email',
						'print'   		=> 'Print',
					),
                ),
				'required' => array( 'social-sharing', '=', 1 )
            ),			
		)
	) );/* End Social sections */
	
	/*
	* Newsletter Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Newsletter', 'matjar' ),
        'id'         => 'newsletter',
		'icon'       => 'el el-envelope',
        'fields'     => array(
			array(
                'id'       => 'newsletter-popup',
                'type'     => 'switch',
                'title'    => esc_html__( 'Newsletter', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Newsletter popup enable or disable in your site.', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       			=> 'newsletter-popup-on',
                'type'     			=> 'button_set',
                'title'    			=> esc_html__( 'Newsletter Popup On', 'matjar' ),
                'subtitle' 	   		=> esc_html__( 'Show newsletter popup on front page or all pages.', 'matjar' ),
                'options'  			=> array(
                    'front-page' 	=> esc_html__( 'Front Page', 'matjar' ),
                    'all-pages' 	=> esc_html__( 'All Pages', 'matjar' ),
                ),
                'default'  			=> 'all-pages',
            ),
			array(
                'id'       => 'newsletter-show-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'subtitle' => esc_html__( 'You want to show newsletter for mobile devices.', 'matjar' ),
				'default'  => 1,
            ),
			array(
				'id'      	=> 'newsletter-when-appear',
				'type'    	=> 'button_set',
				'title'   	=> esc_html__( 'When Popup Appear?', 'matjar' ),                    
				'options' 	=> array(
					'page_load' 	=> esc_html__( 'On Page Load', 'matjar' ),
					'scroll' 		=> esc_html__( 'When Page Scroll', 'matjar' ),
					'exit' 			=> esc_html__( 'On Exit Intent', 'matjar' ),
				), 
				'default' 	=> 'page_load',
			),
			array(
				'id'       => 'newsletter-delay',
				'type'     => 'text',
				'title'    => esc_html__( 'Popup Delay', 'matjar' ),
				'default'  => '5',
				'subtitle' =>  esc_html__( 'Enter no of second to open popup after page load.', 'matjar' ),
				'required' => array( 'newsletter-when-appear', '=', 'page_load' ),
			),
			array(
				'id'       => 'newsletter-version',
				'type'     => 'text',
				'title'    => esc_html__( 'Popup Version', 'matjar' ),
				'default'  => '1',
				'subtitle' =>  esc_html__( 'Increase version number, for show forcefully popup who already closed it.', 'matjar' ),
			),
			array(
				'id'       => 'newsletter-x-scroll',
				'type'     => 'text',
				'title'    => esc_html__( 'Open When User Scroll % of Page', 'matjar' ),
				'default'  => '30',
				'subtitle' =>  esc_html__( '100% - For end of page', 'matjar' ),
				'required' => array( 'newsletter-when-appear', '=', 'scroll' ),
			),
			array(
                'id'       => 'newsletter-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Newsletter Logo', 'matjar' ),
                'compiler' => 'true',
                'subtitle' =>  esc_html__( 'Upload newsletter logo.', 'matjar' ),
                'default'  => array(),
				'required' => array( 'newsletter-popup', '=', 1 ),
            ),
			array(
                'id'       => 'newsletter-title',
                'type'     => 'text',
                'title'    => esc_html__( 'Newsletter Title', 'matjar' ),
				'default'  => esc_html__( 'Upto 45% Off!', 'matjar' ),
            ),
			array(
                'id'       => 'newsletter-tag-line',
                'type'     => 'editor',
                'title'    => esc_html__( 'Newsletter Tag Line', 'matjar' ),
				'default'  => esc_html__( 'Subscribe today and get special offers, coupons and top news.', 'matjar' ),
            ),
			array(
                'id'       => 'newsletter-dont-show',
                'type'     => 'text',
                'title'    => esc_html__( 'Newsletter Don\'t Show Msg', 'matjar' ),
				'default'  => esc_html__( 'Don\'t show this popup again', 'matjar' ),
            ),			
			array(
                'id'    => 'newsletter-popup-layout',
                'type'   => 'info',
                'notice' => false,
                'title' => esc_html__( 'Newsletter Layout & Style', 'matjar' ),
            ),
			array(
                'id'       		=> 'newsletter-layout',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Newsletter Layout', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Select newsletter popup layout.', 'matjar' ),
				'options'  		=> array(
                    'full-content' 	=> array(
                        'title' 	=> esc_html__( 'Full Content', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/newsletter-full-content.png',
                    ),
                    'banner-left' 	=> array(
                        'title' 	=> esc_html__( 'Banner Left', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/newsletter-banner-left.png',
                    ),
					'banner-right' 	=> array(
                        'title' 	=> esc_html__( 'Banner Right', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/newsletter-banner-right.png',
                    ),
                ),
                'default'  => 'banner-left',
            ),
			array(
                'id'       => 'newsletter-banner',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Newsletter Banner', 'matjar' ),
                'compiler' => 'true',
                'subtitle' =>  esc_html__( 'Upload newsletter banner.', 'matjar' ),
                'default'  => array(),
				'required' => array( 'newsletter-layout', '=', array ( 'banner-left', 'banner-right' ) ),
            ),
			array(
                'id'            	=> 'newsletter-popup-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Newsletter Width (px)', 'matjar' ),
				'subtitle'          => esc_html__( 'Newsletter popup width in pixels', 'matjar' ),
				'output'   			=> array( '.matjar-newsletter-popup' ),
                'default'       	=> 750,
                'min'           	=> 300,
                'step'          	=> 1,
                'max'           	=> 840,
            ),
			array(
				'id'             	=> 'newsletter-content-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Content Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Set newsletter content padding.', 'matjar' ),
				'mode'           	=> 'padding',
				'units_extended' 	=> 'false',
				'units'          	=> array('rem', '%', 'px'),
				'output' 			=> array( '.matjar-newsletter-content' ),
				'default'            => array(
					'padding-top'     	=> '2', 
					'padding-right'    	=> '2', 
					'padding-bottom'  	=> '2',
					'padding-left'  	=> '2',
					'units'          	=> 'rem', 
				),
			),
			array(
                'id'       		=> 'newsletter-form-style',
                'type'     		=> 'image_select',
                'title'    		=> esc_html__( 'Newsletter Form Style', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Select newsletter form style.', 'matjar' ),
				'options'  		=> array(
                    'overlay-form' 		=> array(
                        'title' 	=> esc_html__( 'Overlay Form', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/overlay-form.png',
                    ),
                    'simple-form' 		=> array(
                        'title' 	=> esc_html__( 'Simple Form', 'matjar' ),
                        'img' 		=> MATJAR_ADMIN_IMAGES . 'layout/simple-form.png',
                    ),
                ),
                'default'  => 'overlay-form',
            ),
			array(
                'id'       		=> 'newsletter-field-shape',
                'type'     		=> 'button_set',
                'title'    		=> esc_html__( 'Field Shape', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Select newsletter form field shape.', 'matjar' ),
                'options'  		=> array(
					'shape-round' 	=> esc_html__( 'Round', 'matjar' ),
                    'shape-square' 	=> esc_html__( 'Square', 'matjar' ),
                ),
                'default'  		=> 'shape-round',
				'required' 		=> array( 'social-sharing', '=', 1 )
            ),
			array(
                'id'		=> 'newsletter-popup-color',
                'type'		=> 'info',
                'notice'	=> false,
                'title'		=> esc_html__( 'Newsletter Colors', 'matjar' ),
            ),
			array(
                'id'       		=> 'newsletter-background',
                'type'     		=> 'background',
                'title'    		=> esc_html__( 'Background Color', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Newsletter background with image, color, etc.', 'matjar' ),
				'output'   		=> array( '.matjar-newsletter-content' ),
                'default'  		=> array(
					'background-color' 		=> '#1558E5',
					'background-image' 		=> '',
					'background-repeat' 	=> '',
					'background-size' 		=> '',
					'background-attachment' => '',
					'background-position' 	=> '',
				),
            ),
            array(
                'id'       		=> 'newsletter-text-color',
                'type'     		=> 'color',
                'title'    		=> esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Set text color', 'matjar' ),
                'default'  		=> '#ffffff',
            ),
			array(
                'id'       		=> 'newsletter-button-bg-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Set button background color', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#9e7856',
                    'hover'   	=> '#9e7856',
                ),
            ),
			array(
                'id'       		=> 'newsletter-button-text-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Set button text color', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#f1f1f1',
                ),
            ),
			array(
                'id'       		=> 'newsletter-border',
                'type'     		=> 'border',
                'title'    		=> esc_html__( 'Border', 'matjar' ),                
                'subtitle' 		=> esc_html__( 'Set border color, style and width.', 'matjar' ),
                'default'  		=> array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                ),
            ),
			array(
                'id'            => 'newsletter-border-radius',
                'type'          => 'slider',
                'title'         => esc_html__( 'Border Radius', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Newsletter popup border radius.', 'matjar' ),
                'default'       => 0,
                'min'           => 0,
                'step'          => 1,
                'max'           => 22,
                'display_value' => 'label'
            ),
		)
	) );

	/*
	* Cookie Options
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Cookie Notice', 'matjar' ),
        'id'         => 'section-cookie-notice',
		'icon'       => 'el el-dashboard',
        'fields'     => array(
			array(
                'id'       => 'cookie-notice',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cookie', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Cookie notice enable or disable in your site.', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-title',
                'type'     => 'text',
                'title'    => 'Cookie Title',
                'subtitle' => esc_html__( 'Enter the Cookie Title/Name.', 'matjar' ),
				'default'  => esc_html__( 'Cookies Notice', 'matjar' ),
            ),
			array(
                'id'       => 'cookie-message-text',
                'type'     => 'textarea',
                'title'    => esc_html__( 'Message', 'matjar' ),
				'subtitle' => esc_html__( 'Enter the cookie notice message.', 'matjar' ),
				'default'  => esc_html__( 'We use cookies to ensure that we give you the best experience on our website. If you continue to use this site we will assume that you are happy with it.', 'matjar' ),
            ),
			array(
                'id'       => 'cookie-accept-text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'matjar' ),
                'subtitle' => esc_html__( 'The text of the option to accept the usage of the cookies and make the notification disappear.', 'matjar' ),
				'default'  => esc_html__( 'Yes, I\'m Accept', 'matjar' ),
            ),
			array(
                'id'       => 'cookie-see-more-opt',
                'type'     => 'switch',
                'title'    => esc_html__( 'More Info Link', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Enable Read more link.', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-see-more-text',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'The text of the more info button.', 'matjar' ),
				'default'  => esc_html__( 'Read more', 'matjar' ),
				'required' => array( 'cookie-see-more-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-see-more-link-type',
                'type'     => 'radio',
                'title'    => '',
                'subtitle' => esc_html__( 'Select where to redirect user for more information about cookies.', 'matjar' ),
                'options'  => array(
								'custom' 	 => esc_html__( 'Custom link', 'matjar' ),
								'page' => esc_html__( 'Page link', 'matjar' ),
							),
				'default'  => 'custom',
				'required' => array( 'cookie-see-more-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-see-more-link-custom',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'Enter the full URL starting with http://', 'matjar' ),
				'default'  => 'http://empty',
				'placeholder' => esc_attr( 'http://#' ),
				'required' => array( 'cookie-see-more-link-type', '=', 'custom' ),
            ),
			array(
                'id'       => 'cookie-see-more-link-pages',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => '',
                'subtitle' => esc_html__( 'Select from one of your site\'s pages', 'matjar' ),
				'required' => array( 'cookie-see-more-link-type', '=', 'page' ),
            ),
			array(
                'id'       => 'cookie-see-more-link-target',
                'type'     => 'select',
                'title'    => esc_html__( 'Link Target', 'matjar' ),
                'subtitle' => esc_html__( 'Select the link target for more info page.', 'matjar' ),
                'options'  => array(
                    '_blank' 	=> esc_html__( 'New Page', 'matjar' ),
                    '_self' 	=> esc_html__( 'This page', 'matjar' ),
                ),
                'default'  => '_blank',
            ),
			array(
                'id'       => 'cookie-refuse-opt',
                'type'     => 'switch',
                'title'    => esc_html__( 'Refuse Button', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Give to the user the possibility to refuse third party non functional cookies.', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-refuse-text',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'The text of the option to refuse the usage of the cookies. To get the cookie notice status use matjar_cn_cookies_accepted() function.', 'matjar' ),
				'default'  => esc_html__( 'Dismiss', 'matjar' ),
				'required' => array( 'cookie-refuse-opt', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-refuse-code',
                'type'     => 'textarea',
                'title'    => '',
				'subtitle' => esc_html__( 'Enter non functional cookies Javascript code here (for e.g. Google Analitycs). It will be used after cookies are accepted.', 'matjar' ),
				'required' => array( 'cookie-refuse-opt', '=', 1 ),
				
            ),
			array(
                'id'       => 'cookie-on-scroll',
                'type'     => 'switch',
                'title'    => esc_html__( 'On Scroll', 'matjar' ),
                'on'       => esc_html__( 'Enable', 'matjar' ),
				'off'      => esc_html__( 'Disable', 'matjar' ),
				'subtitle' => esc_html__( 'Enable cookie notice acceptance when users scroll.', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'cookie-on-scroll-offset',
                'type'     => 'text',
                'title'    => '',
                'subtitle' => esc_html__( 'Number of pixels user has to scroll to accept the usage of the cookies and make the notification disappear.', 'matjar' ),
				'default'  => 100,
				'required' => array( 'cookie-on-scroll', '=', 1 ),
            ),
			array(
                'id'       => 'cookie-expiry-times',
                'type'     => 'select',
                'title'    => esc_html__( 'Cookie Expiry', 'matjar' ),
                'subtitle' => esc_html__( 'Select the link target for more info page.', 'matjar' ),
                'options'  => array(
					'86400'	 	=> esc_html__( '1 day', 'matjar' ),
					'604800'	=> esc_html__( '1 week', 'matjar' ),
					'2592000'	=> esc_html__( '1 month', 'matjar' ),
					'7862400'	=> esc_html__( '3 months', 'matjar' ),
					'15811200'	=> esc_html__( '6 months', 'matjar' ),
					'31536000'	=> esc_html__( '1 year', 'matjar' ),
					'31337313373' => esc_html__( 'infinity', 'matjar' ),
                ),
                'default'  => '2592000',
            ),
			array(
                'id'       => 'cookie-script-placements',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Script Placement', 'matjar' ),
                'subtitle' => esc_html__( 'Select where all the plugin scripts should be placed.', 'matjar' ),
                'options'  => array(
                    'header' => esc_html__( 'Header', 'matjar' ),
                    'footer' => esc_html__( 'Footer', 'matjar' ),
                ),
                'default'  => 'footer',
            ),
			array(
                'id'       => 'cookie-positions',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Position', 'matjar' ),
                'subtitle' => esc_html__( 'Select location for your cookie notice.', 'matjar' ),
                'options'  => array(
                    'top' 		=> esc_html__( 'Top', 'matjar' ),
                    'bottom' 	=> esc_html__( 'Bottom', 'matjar' ),
                ),
                'default'  => 'bottom'
            ),
			array(
                'id'       => 'cookie-style',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Cookie Style', 'matjar' ),
                'subtitle' => esc_html__( 'Select style of cookie notice on bottom.', 'matjar' ),
                'options'  => array(
                    'bar' 		=> esc_html__( 'Bar', 'matjar' ),
                    'box' 	=> esc_html__( 'Box', 'matjar' ),
                ),
                'default'  => 'bar',
				'required' => array( 'cookie-positions', '=', 'bottom' ),
            ),
			array(
                'id'       => 'cookie-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
                'default'  => '#212121',
            ),
			array(
                'id'       => 'cookie-background-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Bar Background Color', 'matjar' ),
                'default'  => '#f8f8f8',
            ),
		)
	) );
	
	
	/*
	* Slider Config
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Slider Config', 'matjar' ),
        'id'         => 'slider-config',
		'icon'		 => 'el el-picture',
        'fields'     => array(
			array(
                'id'       => 'slider-loop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Loop', 'matjar' ),
				'subtitle' => esc_html__( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-autoplay',
                'type'     => 'switch',
                'title'    => esc_html__( 'Autoplay', 'matjar' ),
                'subtitle' => esc_html__( 'Autoplay.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),			
			array(
                'id'       => 'slider-autoplay-hover-pause',
                'type'     => 'switch',
                'title'    => esc_html__( 'autoplayHoverPause', 'matjar' ),
				'subtitle' => esc_html__( 'Pause on mouse hover.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
				'required' => array( 'slider-autoplay', '=', 1 )
            ),
			array(
                'id'       => 'slider-autoplaytimeout',
                'type'     => 'text',
                'title'    => esc_html__( 'autoplayTimeout', 'matjar' ),
				'subtitle' => esc_html__( 'Autoplay interval timeout.', 'matjar' ),
                'default'  => 3500,
				'validate' => 'numeric',
				'required' => array( 'slider-autoplay', '=', 1 )
            ),
			array(
                'id'       => 'slider-center',
                'type'     => 'switch',
                'title'    => esc_html__( 'Center', 'matjar' ),
				'subtitle' => esc_html__( 'Center item. Works well with even an odd number of items.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-smartspeed',
                'type'     => 'text',
                'title'    => esc_html__( 'smartSpeed', 'matjar' ),
				'subtitle' => esc_html__( 'Speed Calculate. More info to come..', 'matjar' ),
                'default'  => 750,
				'validate' => 'numeric',
            ),			
			array(
                'id'       => 'slider-rewind',
                'type'     => 'switch',
                'title'    => esc_html__( 'Rewind', 'matjar' ),
				'subtitle' => esc_html__( 'Go backwards when the boundary has reached.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-auto-height',
                'type'     => 'switch',
                'title'    => esc_html__( 'AutoHeight', 'matjar' ),
                'subtitle' => esc_html__( 'AutoHeight.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navigation', 'matjar' ),
				'subtitle' => esc_html__( 'Show next/prev navigation.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-navigation-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navigation in Mobile', 'matjar' ),
				'subtitle' => esc_html__( 'Show next/prev navigation in mobile.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-dots-navigation',
                'type'     => 'switch',
                'title'    => esc_html__( 'Dots Navigation', 'matjar' ),
				'subtitle' => esc_html__( 'Show dots navigation.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-touchDrag',
                'type'     => 'switch',
                'title'    => esc_html__( 'TouchDrag', 'matjar' ),
				'subtitle' => esc_html__( 'Touch drag enabled.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 0,
            ),
			array(
                'id'       => 'slider-touchDrag-mobile',
                'type'     => 'switch',
                'title'    => esc_html__( 'TouchDrag In Mobile', 'matjar' ),
				'subtitle' => esc_html__( 'Touch drag enabled in mobile.', 'matjar' ),
                'on'       => esc_html__( 'Yes', 'matjar' ),
				'off'      => esc_html__( 'No', 'matjar' ),
				'default'  => 1,
            ),
			array(
                'id'       => 'slider-animate-in',
                'type'     => 'text',
                'title'    => esc_html__( 'Animate In', 'matjar' ),
				'subtitle' => wp_kses( sprintf( __( 'Please input animation. Please reference <a href="%s" target="_blank">animate.css</a>. ex: fadeIn', 'matjar' ), esc_url( 'http://daneden.github.io/animate.css' ) ),
				array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'default'  => '',
            ),
			array(
                'id'       => 'slider-animate-out',
                'type'     => 'text',
                'title'    => esc_html__( 'Animate Out', 'matjar' ),
				'subtitle' => wp_kses( sprintf( __( 'Please input animation. Please reference <a href="%s" target="_blank">animate.css</a>. ex: fadeIn', 'matjar' ), esc_url( 'http://daneden.github.io/animate.css' ) ),
				array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) 
				),
                'default'  => '',
            ),
		)
	) );/* END SLIDER CONFIG SECTIONS */
	
	/*
	* Optimize
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Optimize(Performance)', 'matjar' ),
        'id'         => 'site-optimize',
		'icon'		 => 'el el-dashboard',
        'fields'     => array(
			array(
                'id'       		=> 'disable-fontawesome',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Font Awesome', 'matjar' ),
				'subtitle'		=> esc_html__( 'Disable font awesome style from plugins.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 1,
            ),
			array(
                'id'       		=> 'disable-gutenberg',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Gutenberg', 'matjar' ),
				'subtitle'		=> esc_html__( 'Disable gutenberg styles.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 0,
            ),
			array(
                'id'       		=> 'disable-wc-blocks',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'WC Blocks', 'matjar' ),
				'subtitle'		=> esc_html__( 'Disable default WooCommerce blocks styles.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
                'off'      		=> esc_html__( 'No', 'matjar' ),
                'default'  		=> 0,
            ),
		)
	) );
	
	/*
	* Maintenance Mode
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Maintenance Mode', 'matjar' ),
        'id'         => 'site-maintenance-mode',
		'icon'		 => 'el el-icon-website',
        'fields'     => array(
			array(
                'id'       		=> 'maintenance-mode',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Maintenance Mode', 'matjar' ),
				'subtitle'		=> esc_html__( 'Status of Maintenance Mode.', 'matjar' ),
                'default'  		=> 0,
                'on'       		=> esc_html__( 'On', 'matjar' ),
                'off'      		=> esc_html__( 'Off', 'matjar' ),
            ),
			array(
				'id'      	=> 'maintenance-page',
				'type'    	=> 'select',
				'title'   	=> esc_html__( 'Page', 'matjar' ),
				'subtitle'	=> esc_html__( 'Select page to display as maintenance page.', 'matjar' ),
				'data'    	=> 'pages',
			),
		)
	) );
	
	/*
	* White Label
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'White Label', 'matjar' ),
        'id'         => 'white-label',
		'icon'       => 'el el-tag',
        'fields'     => array(
			array(
                'id'       		=> 'white-label-enable',
                'type'     		=> 'switch',
                'title'    		=> esc_html__('Enable White Label?','matjar'),
                'on'       		=> esc_html__('Enable','matjar'),
				'off'      		=> esc_html__('Disable','matjar'),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'theme-name',
                'type'     		=> 'text',
                'title'    		=> esc_html__( 'Theme Name', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Replace all the theme name in admin dashboard.', 'matjar' ),
            ),
			array(
                'id'       			=> 'theme-screenshot',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Theme Screenshot', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Replace the theme screenshot in Appearance > Themes. Recommended size 1200x900px.', 'matjar' ),
				'default'  			=> array(),
			),
			array(
                'id'       			=> 'theme-menu-icon',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Theme Menu Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Replace the theme menu icon. Recommended size 32x32px.', 'matjar' ),
				'default'  			=> array(),
			),
			array(
                'id'       			=> 'theme-welcome-page-title',
                'type'     			=> 'text',
                'title'    			=> esc_html__( 'Welcome Page Title', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page title.', 'matjar' ),
				'default'  			=> '',
			),
			array(
                'id'       			=> 'theme-welcome-page-description',
                'type'     			=> 'textarea',
                'title'    			=> esc_html__( 'Welcome Page Description','matjar'),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page description.', 'matjar' ),
				'default'  			=> '',
            ),
			array(
                'id'       			=> 'theme-welcome-page-icon',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Welcome Page Icon', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Replace the theme welcome page icon. Recommended size 150x150px.', 'matjar' ),
				'default'  			=> array()
			),
			array(
                'id'       		=> 'disable-welcome-page',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Disable Welcome Menu','matjar' ),
                'subtitle'     	=> esc_html__( 'Disable welcome/dashboard menu.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'       		=> 'disable-demo-import',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Disable Demo Import Menu','matjar' ),
                'subtitle'     	=> esc_html__( 'Disable Demo Import Menu.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 0,
            ),
			array(
                'id'    	=> 'section-wodpress-login-page',
                'type'   	=> 'info',
                'notice' 	=> false,
                'title' 	=> esc_html__( 'WordPress Login Page Design', 'matjar' ),
            ),
			array(
                'id'       			=> 'wp-login-page-logo',
                'type'     			=> 'media',
                'url'      			=> false,
                'title'    			=> esc_html__( 'Wordpress Logo', 'matjar' ),
                'subtitle'     		=> esc_html__( 'Replace the wordpress logo.', 'matjar' ),
				'default'  			=> array()
			),
			array(
                'id'            	=> 'wp-login-page-logo-width',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Width', 'matjar' ),
				'subtitle'          => esc_html__( 'Logo width in pixels', 'matjar' ),
                'default'       	=> 150,
                'min'           	=> 50,
                'step'          	=> 1,
                'max'           	=> 300,
                'display_value' 	=> 'text',
            ),
			array(
                'id'            	=> 'wp-login-page-logo-height',
                'type'          	=> 'slider',
                'title'         	=> esc_html__( 'Logo Height', 'matjar' ),
				'subtitle'          => esc_html__( 'Logo height in pixels', 'matjar' ),
                'default'       	=> 84,
                'min'           	=> 25,
                'step'          	=> 1,
                'max'           	=> 250,
                'display_value' 	=> 'text',
            ),
			array(
                'id'       		=> 'wp-login-page-background',
                'type'    	 	=> 'background',
                'title'    		=> esc_html__( 'Page Background', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Set wordpress login page background.', 'matjar' ),
                'default'  		=> array(
					'background-color' => '#f0f0f1'
				),
            ),
			
			array(
                'id'       		=> 'wp-login-form-background',
                'type'    	 	=> 'color',
                'title'    		=> esc_html__( 'Login Form Background', 'matjar' ),
                'subtitle'     	=> esc_html__( 'Set wordpress login form background color.', 'matjar' ),
                'default'  		=> '#ffffff',
            ),
			array(
                'id'       		=> 'wp-login-form-box-shadow',
                'type'     		=> 'switch',
                'title'    		=> esc_html__( 'Login Form Box Shadow','matjar' ),
                'subtitle'     	=> esc_html__( 'Set login form box shadow.', 'matjar' ),
                'on'       		=> esc_html__( 'Yes', 'matjar' ),
				'off'      		=> esc_html__( 'No', 'matjar' ),
				'default'  		=> 1,
            ),
			array(
				'id'             	=> 'wp-login-form-padding',
				'type'           	=> 'spacing',
				'title'          	=> esc_html__( 'Login Form Padding', 'matjar' ),
				'subtitle'       	=> esc_html__( 'Add login form spacing using padding.', 'matjar' ),
				'mode'           	=> 'padding',
				'units'          	=> array( 'em', '%', 'px' ),
				'default'           => array(
					'padding-top' 		=> '2',
					'padding-right' 	=> '2',
					'padding-bottom' 	=> '2',
					'padding-left' 		=> '2',
					'units'         	=> 'em', 
				)
			),
			array(
                'id'       => 'wp-login-text-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Text Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Set text color.', 'matjar' ),
                'default'  => '#545454',
            ),
			array(
                'id'       => 'wp-login-link-color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Link Color', 'matjar' ),
				'subtitle' 		=> esc_html__( 'Set link and hover color.', 'matjar' ),
				'active'    	=> false,
                'default'  => array(
                    'regular' => '#494949',
                    'hover'   => '#1558E5',
                )
            ),
			array(
                'id'       => 'wp-login-border',
                'type'     => 'border',
                'title'    => esc_html__( 'Border', 'matjar' ),                
                'subtitle' 		=> esc_html__( 'Set border color, style and width.', 'matjar' ),
                'default'  => array(
                    'border-color'  => '#e9e9e9',
                    'border-style'  => 'solid',
                    'border-top'    => '1px',
                    'border-right'  => '1px',
                    'border-bottom' => '1px',
                    'border-left'   => '1px'
                )
            ),
			array(
                'id'            => 'wp-login-border-radius',
                'type'          => 'slider',
                'title'         => esc_html__( 'Border Radius', 'matjar' ),
				'subtitle' 		=> esc_html__( 'site border radius.', 'matjar' ),
                'default'       => 4,
                'min'           => 0,
                'step'          => 1,
                'max'           => 50,
                'display_value' => 'label'
            ),
			array(
                'id'       => 'wp-login-input-color',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Color( TextBox, SelectBox, etc..)', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Set color input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#545454',
            ),
			 array(
                'id'       => 'wp-login-input-background',
                'type'     => 'color',
                'title'    => esc_html__( 'Input Field Background( TextBox, SelectBox, etc..)', 'matjar' ),
				'subtitle'    	=> esc_html__( 'Set background input field like TextBox, Textarea, SelectBox, etc..', 'matjar' ),
                'default'  => '#ffffff',
            ),
			array(
                'id'       		=> 'wp-login-button-background',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Background', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button background color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#1558E5',
                    'hover'   	=> '#199377',
                )
            ),
			array(
                'id'       		=> 'wp-login-button-color',
                'type'     		=> 'link_color',
                'title'    		=> esc_html__( 'Button Color', 'matjar' ),
                'subtitle' 		=> esc_html__( 'Set button text color and hover color.', 'matjar' ),
                'active'    	=> false,
                'default'  		=> array(
                    'regular' 	=> '#ffffff',
                    'hover'   	=> '#fcfcfc',
                )
            ),
		)
	) );
	
	/*
	* Custom CSS/JS Code
	*/
	Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom JS/CSS', 'matjar' ),
        'id'         => 'custom-code',
		'icon'		 => 'el-icon-broom',
        'fields'     => array(
			array(
                'id'       => 'custom-css',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'CSS Code', 'matjar' ),
                'subtitle' => esc_html__( 'Paste your CSS code here.', 'matjar' ),
                'mode'     => 'css',
                'theme'    => 'monokai',
                'default'  => ""
            ),	
			array(
				'id'       => 'custom-js-header',
				'type'     => 'ace_editor',
				'title'    => esc_html__( 'JS Code before &lt;/head&gt;', 'matjar' ),
				'subtitle' => esc_html__( 'Paste your JS code here.', 'matjar' ),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'default'  => '',
			),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'JS Code before &lt;/body&gt;', 'matjar' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'matjar' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => "jQuery(document).ready(function(){\n\n});"
            ),
		)
	) );
	
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

      /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'matjar' ),
                'subtitle'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'matjar' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }