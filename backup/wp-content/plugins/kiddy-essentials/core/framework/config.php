<?php
	/**
	 * ReduxFramework Sample Config File
	 * For full documentation, please visit: http://docs.reduxframework.com/
	 */
	if ( ! class_exists( 'Redux' ) ) {
		return;
	}

	// This is your option name where all the Redux data is stored.
	$theme = wp_get_theme();

	$opt_name = $theme->get( 'TextDomain' );

	// This line is only for altering the demo. Can be easily removed.
	// $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

	/*
	 *
	 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
	 *
	 */

	// \REDUX FRAMEWORK
	function kiddy_get_all_fa_icons() {
		$meta = get_option('cws_fa');
		if (empty($meta) || (time() - $meta['t']) > 3600*7 ) {
			global $wp_filesystem;
			if( empty( $wp_filesystem ) ) {
				require_once( ABSPATH .'/wp-admin/includes/file.php' );
				WP_Filesystem();
			}
			$file = get_template_directory() . '/css/font-awesome.css';
			$fa_content = '';
			if ( $wp_filesystem && $wp_filesystem->exists($file) ) {
				$fa_content = $wp_filesystem->get_contents($file);
				if ( preg_match_all( "/fa-((\w+|-?)+):before/", $fa_content, $matches, PREG_PATTERN_ORDER ) ){
					return $matches[1];
				}
			} else {
				$fa_content = file_get_contents($file);
				if ( preg_match_all( "/fa-((\w+|-?)+):before/", $fa_content, $matches, PREG_PATTERN_ORDER ) ){
					return $matches[1];
				}
			}
		} else {
			return $meta['fa'];
		}
	}

	/* \FA ICONS */

	$icons = kiddy_get_all_fa_icons();

	sort( $icons );
	$iconArray = array();
	foreach ( $icons as $icon ) {
	$name                       = ucwords( str_replace( '-', ' ', str_replace( array(
			'fa-',
			'-play',
			'-square',
			'-alt',
			'-circle'
	), '', $icon ) ) );
	$iconArray[$icon ] = $name;
	}



	$sampleHTML = '';
	if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
		Redux_Functions::initWpFilesystem();

		global $wp_filesystem;

		$sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
	}

	// Background Patterns Reader
	$sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
	$sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) {

		if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
			$sample_patterns = array();

			while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

				if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
					$name              = explode( '.', $sample_patterns_file );
					$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
					$sample_patterns[] = array(
						'alt' => $name,
						'img' => $sample_patterns_url . $sample_patterns_file
					);
				}
			}
		}
	}

	/**
	 * ---> SET ARGUMENTS
	 * All the possible arguments for Redux.
	 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	 * */

	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		// TYPICAL -> Change these values as you need/desire
		'opt_name'             => $opt_name,
		// This is where your data is stored in the database and also becomes your global variable name.
		'display_name'         => $theme->get( 'Name' ),
		// Name that appears at the top of your panel
		'display_version'      => $theme->get( 'Description' ) . ' (v.' . $theme->get( 'Version' ). ')',
		// Version that appears at the top of your panel
		'menu_type'            => 'menu',
		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
		'allow_sub_menu'       => true,
		// Show the sections below the admin menu item or not
		'menu_title'           => esc_html__('Theme Options', 'kiddy-essentials' ),
		'page_title'           => esc_html__('Theme Options', 'kiddy-essentials' ),
		// You will need to generate a Google API key to use this feature.
		// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
		'google_api_key'       => '',
		// Set it you want google fonts to update weekly. A google_api_key value is required.
		'google_update_weekly' => false,
		// Must be defined to add google fonts to the typography module
		'async_typography'     => true,
		// Use a asynchronous font on the front end or font string
		//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
		'admin_bar'            => true,
		// Show the panel pages on the admin bar
		'admin_bar_icon'       => 'dashicons-admin-generic',
		// Choose an icon for the admin bar menu
		'admin_bar_priority'   => 50,
		// Choose an priority for the admin bar menu
		'global_variable'      => '',
		// Set a different name for your global variable other than the opt_name
		'dev_mode'             => false,
		// Show the time the page took to load, etc
		'update_notice'        => true,
		// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
		'customizer'           => false,
		// Enable basic customizer support
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
		// OPTIONAL -> Give you extra features
		'page_priority'        => null,
		// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
		'page_parent'          => 'themes.php',
		// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
		'page_permissions'     => 'manage_options',
		// Permissions needed to access the options panel.
		'menu_icon'            => '',
		// Specify a custom URL to an icon
		'last_tab'             => '',
		// Force your panel to always open to a specific tab (by id)
		'page_icon'            => 'icon-themes',
		// Icon displayed in the admin panel next to your menu_title
		'page_slug'            => '',
		// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
		'save_defaults'        => true,
		// On load save the defaults to DB before user clicks save or not
		'default_show'         => false,
		// If true, shows the default value next to each field that is not the default value.
		'default_mark'         => '',
		// What to print by the field's title if the value shown is default. Suggested: *
		'show_import_export'   => true,
		// Shows the Import/Export panel when not used as a field.

		// CAREFUL -> These options are for advanced use only
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
		'output_tag'           => true,
		// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
		// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

		// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
		'database'             => '',
		// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
		'use_cdn'              => true,
		// If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

		// HINTS
		'hints'                => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'dark',
				'shadow'  => true,
				'rounded' => true,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '300',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '300',
					'event'    => 'click mouseleave',
				),
			),
		)
	);

	$args['share_icons'][] = array(
		'url' => '//twitter.com/Creative_WS',
		'title' => 'Follow us on Twitter',
		'icon' => 'fa fa-twitter'
	);
	$args['share_icons'][] = array(
		'url' => '//www.facebook.com/CreaWS',
		'title' => 'Like us on Facebook',
		'icon' => 'fa fa-facebook'
	);
	$args['share_icons'][] = array(
		'url' => '//www.behance.net/CreativeWS',
		'title' => 'Find us on Behance',
		'icon' => 'fa fa-behance'
	);

	// Panel Intro text -> before the form
	$allowed_html = wp_kses_allowed_html( 'post' );
	if (( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) && ( $args['dev_mode'] == true )) {
		if ( ! empty( $args['global_variable'] ) ) {
			$v = $args['global_variable'];
		} else {
			$v = str_replace( '-', '_', $args['opt_name'] );
		}
		$args['intro_text'] = sprintf(wp_kses(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'kiddy-essentials'), $allowed_html ), $v);
	}

	// Add content after the form.
	/*$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );*/

	Redux::setArgs( $opt_name, $args );

	$redux_img = get_template_directory_uri() . '/img/framework_added_img/';

	/*
		As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
	 */

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('General Settings', 'kiddy-essentials' ),
		'id'               => 'general_setting',
		'customizer_width' => '400px',
		'icon'             => 'el-icon-adjust-alt'
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Logotype', 'kiddy-essentials' ),
		'id'               => 'logo_cont',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'       => 'logo',
				'type' => 'media',
				'title' => esc_html__( 'Logo', 'kiddy-essentials' ),
				'url'      => true,
				'compiler' => 'true',
			),
			array(
				'id'       => 'logo_option',
				'type'     => 'checkbox',
				'title'    => esc_html__( 'Options', 'kiddy-essentials' ),
				'options'  => array(
					'logo_is_high_dpi' => esc_html__( 'This is a High-Resolution logo', 'kiddy-essentials' ),
					'logo-with-border' => esc_html__('Add logotype border', 'kiddy-essentials' ),
				),
				'hint' => array(
				    'title'     => 'High-Resolution logo',
				    'content'   => 'This option applies two logo variants for your site: a big one that is loaded on Retina displays (this one is supposed to be uploaded above if the checkbox is checked), and one that is half the size which is loaded on non-Retina displays (it will be generated automatically).',
				),
				//See how std has changed? you also don't need to specify opts that are 0.
				'default'  => array(
					'logo_is_high_dpi' => '0',
					'logo-with-border' => '0'
				)
			),
			array(
				'id'             => 'logo-dimensions',
				'type'           => 'dimensions',
				'units'          => false,    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title' => esc_html__('Dimensions', 'kiddy-essentials' ),
				'default' => array(
					'width'  => '',
					'height' => '',
				)
			),
			array(
				'id' => 'logo-position',
				'type' => 'image_select',
				'title' => esc_html__('Position', 'kiddy-essentials' ),
				'options' => array(
								'left' => array('alt' => esc_html__('Left', 'kiddy-essentials' ), 'img' => $redux_img .'align-left.png'),
								'center' => array('alt' => esc_html__('Center', 'kiddy-essentials' ), 'img' => $redux_img .'align-center.png'),
								'right' => array('alt' => esc_html__('Right', 'kiddy-essentials' ), 'img' => $redux_img .'align-right.png'),
								'in-menu' => array('alt' => esc_html__('Inner', 'kiddy-essentials' ), 'img' => $redux_img .'align-inner.png')
								),
				'default' => 'left'
				),
			array(
				'id' => 'logo_number_item',
				'type' => 'spinner',
				'title' => esc_html__('Inner position', 'kiddy-essentials' ),
				"default" => 1,
				'required' => array( 'logo-position', '=', 'in-menu' ),
				"min" => "1",
				"step" => "1",
				"max" => "100",
				'hint' => array(
				    'title'     => 'Inner Logo position',
				    'content'   => 'This option inserts the logo into the appropriate menu item position.',
				),
				),
			array(
				'id'       => 'logo-margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'all'      => false,
				'title' => esc_html__('Spacings', 'kiddy-essentials' ),
				'default'  => array(
					'margin-top'    => '0',
					'margin-right'  => '0',
					'margin-bottom' => '0',
					'margin-left'   => '0'
				)
			),
			array(
				'id' => 'logo_sticky',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__( 'Sticky logo', 'kiddy-essentials' ),
				'required' => array( 'menu_option', 'equals', 'menu-stick' ),
				'compiler' => true
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Mobile & Sticky', 'kiddy-essentials' ),
		'id'               => 'mnstl_cont',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'menu-stick',
				'type' => 'checkbox',
				'title' => esc_html__('Apply sticky menu', 'kiddy-essentials' ),
				'default' => '1'// 1 = on | 0 = off
			),
			array(
				'id' => 'logo_sticky',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__( 'Sticky logo', 'kiddy-essentials' ),
				'required' => array( 'menu-stick', '=', '1' ),
				'compiler' => true,
				),
			array(
				'id' => 'logo_sticky_is_high_dpi',
				'type' => 'checkbox',
				'title' => esc_html__( 'High-Resolution sticky logo', 'kiddy-essentials' ),
				'required' => array( 'menu-stick', '=', '1' ),
				'default' => '0'
				),
			array(
				'id' => 'logo_mobile',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__( 'Mobile logo', 'kiddy-essentials' ),
				'compiler' => true,
				),
			array(
				'id' => 'logo_mobile_is_high_dpi',
				'type' => 'checkbox',
				'title' => esc_html__( 'High-Resolution logo', 'kiddy-essentials' ),
				'default' => '0'
			),

		)
	) );
		Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Menu', 'kiddy-essentials' ),
		'id'               => 'menu_cont',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'menu-position',
				'type' => 'image_select',
				'title' => esc_html__('Position', 'kiddy-essentials' ),
				'options' => array(
					'left' => array('title' => esc_html__('Left', 'kiddy-essentials' ), 'img' => $redux_img .'align-left.png'),
					'center' => array('title' => esc_html__('Center', 'kiddy-essentials' ), 'img' => $redux_img .'align-center.png'),
					'right' => array('title' => esc_html__('Right', 'kiddy-essentials' ), 'img' => $redux_img .'align-right.png')
					),//Must provide key => value(array:title|img) pairs for radio options
				'default' => 'left'
			),
			array(
				'id' => 'show_header_outside_slider',
				'title' => esc_html__( 'Header hovers slider', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'default' => '0',
				'hint' => array(
				    'title'     => 'Header hovers image slider',
				    'content'   => 'Check this checkbox if you wish the homepage header to overlay image slider.',
				),
			),
			array(
				'id' => 'menu-with-bees',
				'type' => 'checkbox',
				'title' => esc_html__('Add bees to the menu', 'kiddy-essentials' ),
				'default' => '0'// 1 = on | 0 = off
				),
			array(
				'id' => 'enable_mob_menu',
				'title' => esc_html__( 'Enable mobile menu', 'kiddy-essentials' ),
				'type' => 'checkbox',
				'default' => '1',
				'hint' => array(
				    'title'     => 'Mobile Menu (Sandwich)',
				    'content'   => 'Check this checkbox if you wish enable mobile menu on all touch-enabled devices. <br> Please note, it still will be applied if the menu width won\'t fit page width.',
				)
			)
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('TopBar', 'kiddy-essentials' ),
		'id'               => 'top_bar_cont',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'top_panel_switcher',
				'title' => esc_html__( 'TopBar appearance', 'kiddy-essentials' ),
				'type' => 'select',
				'options' => array(
					'none' => esc_html__( 'Hidden', 'kiddy-essentials' ),
					'toggled' => esc_html__( 'Toggled', 'kiddy-essentials' ),
					'static' => esc_html__( 'Static', 'kiddy-essentials' )
				),
				'width' => '250px',
				'default' => 'toggled',
				'hint' => array(
				    'title'     => 'TopBar',
				    'content'   => 'TopBar is a special message that you can show at the top of your website. ',
				),
			),
			array(
				'id' => 'top_panel_search',
				'type' => 'switch',
				'title' => esc_html__('Show search icon', 'kiddy-essentials' ),
				"default" => 1
			),
			array(
				'id' => 'top_panel_text',
				'type' => 'textarea',
				'title' => esc_html__( 'Content', 'kiddy-essentials' ),
				'default' => ''
				),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Meta & Slugs', 'kiddy-essentials' ),
		'id'               => 'meta_slugs',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'breadcrumbs',
				'type' => 'checkbox',
				'title' => esc_html__('Show breadcrumbs', 'kiddy-essentials' ),
				'default' => '1'// 1 = on | 0 = off
				),
			array(
				'id' => 'blog_author',
				'type' => 'checkbox',
				'title' => esc_html__('Show post author', 'kiddy-essentials' ),
				'default' => '1'// 1 = on | 0 = off
				),
			array(
				'id' => 'portfolio_slug',
				'type' => 'text',
				'title' => esc_html__('Portfolio slug', 'kiddy-essentials' ),
				'default' => 'portfolio'
			),
			array(
				'id' => 'staff_slug',
				'type' => 'text',
				'title' => esc_html__( 'Staff slug', 'kiddy-essentials' ),
				'default' => 'staff'
			)
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Theme Updates', 'kiddy-essentials' ),
		'id'               => 'theme_updates',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => '_theme_purchase_code',
				'type' => 'text',
				'title' => esc_html__( 'Theme purchase code', 'kiddy-essentials' ),
				'desc' => esc_html__( 'Fill in this field to get automatic theme updates and import Demo content. It\'s not needed if you got this theme from Envato Elemets.', 'kiddy-essentials' ),
				'default' => '',
				'customizer' => false,
			)
		)
	) );


	// -> START Styling Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Styling Options', 'kiddy-essentials' ),
		'id'               => 'styling_options',
		'customizer_width' => '400px',
		'icon' => 'el-icon-brush'
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Colors', 'kiddy-essentials' ),
		'id'               => 'styling_options_color',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'        => 'theme-custom-color',
				'type'      => 'color',
				'title'     => esc_html__('Theme Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#26b4d7',
				'validate'  => 'color',
				),
			array(
				'id'        => 'theme-custom-secondary-color',
				'type'      => 'color',
				'title'     => esc_html__('Secondary Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#f8f2dc',
				'validate'  => 'color',
				),
			array(
				'id'        => 'theme-custom-outline-color',
				'type'      => 'color',
				'title'     => esc_html__('Outline Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#f9e8b2',
				'validate'  => 'color',
				),
			array(
				'id'        => 'theme-menu-color',
				'type'      => 'color',
				'title'     => esc_html__('Menu Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#fec20b',
				'validate'  => 'color',
			),
			array(
				'id'        => 'theme-menu-color-hover',
				'type'      => 'color',
				'title'     => esc_html__('Hover Menu Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#fd8e00',
				'validate'  => 'color',
			),
			array(
				'id'        => 'theme-custom-footer-color',
				'type'      => 'color',
				'title'     => esc_html__('Footer Color', 'kiddy-essentials' ),
				'transparent' => false,
				'default'   => '#26b4d7',
				'validate'  => 'color',
			),			
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Patterns', 'kiddy-essentials' ),
		'id'               => 'styling_options_pattern',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'side_pattern',
				'type' => 'image_select',
				'title' => esc_html__('Theme patterns', 'kiddy-essentials' ),
				'options' => array(
					'0' => array('alt' => esc_html__('0', 'kiddy-essentials' ), 'img' => $redux_img .'no_layout.png' ),
					'1' => array('alt' => esc_html__('1', 'kiddy-essentials' ), 'img' =>$redux_img .'pattern_icon/1.png' ),
					'2' => array('alt' => esc_html__('2', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/2.png' ),
					'3' => array('alt' => esc_html__('3', 'kiddy-essentials' ), 'img' => $redux_img .'pattern_icon/3.png' ),
					'4' => array('alt' =>  esc_html__('4', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/4.png'),
					'5' => array('alt' => esc_html__('5', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/5.png'),
					'6' => array('alt' => esc_html__('6', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/6.png'),
					'7' => array('alt' => esc_html__('7', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/7.png'),
					'8' => array('alt' => esc_html__('8', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/8.png'),
					'9' => array('alt' => esc_html__('9', 'kiddy-essentials' ), 'img' => $redux_img . 'pattern_icon/9.png'),
					'10' => array('alt' => esc_html__('custom', 'kiddy-essentials' ), 'img' => $redux_img . 'search-icon.png'),
				),
				'default' => '2',
				'width' => '250px',
			),
			array(
				'id' => 'side_pattern_custom',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Add custom pattern', 'kiddy-essentials' ),
				'compiler' => true,
				'required' => array( 'side_pattern', '=', '10' ),
			),
			array(
				'id' => 'side_pattern_custom_is_high_dpi',
				'type' => 'checkbox',
				'title' => esc_html__( 'High-Resolution pattern', 'kiddy-essentials' ),
				'default' => '0',
				'required' => array( 'side_pattern', '=', '10' ),
			),

			array(
				'id' => 'benefits_pattern',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Benefits pattern', 'kiddy-essentials' ),
				'compiler' => true,
				),
			array(
				'id' => 'footer_pattern',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Footer pattern', 'kiddy-essentials' ),
				'compiler' => true,
				),
			array(
				'id' => 'content_pattern',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Content items pattern', 'kiddy-essentials' ),
				'compiler' => true,
				),
			array(
				'id' => 'footer_img',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Footer image', 'kiddy-essentials' ),
				'compiler' => true,
				),
			array(
				'id' => 'footer_img_is_high_dpi',
				'type' => 'checkbox',
				'title' => esc_html__( 'High-Resolution footer img', 'kiddy-essentials' ),
				'default' => '0'
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Layout', 'kiddy-essentials' ),
		'id'               => 'styling_options_costomizations',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'boxed-layout',
				'type' => 'switch',
				'title' => esc_html__('Apply Boxed Layout', 'kiddy-essentials' ),
				"default" => 0,
			),
			array(
				'id'    => 'url_background',
				'type'  => 'info',
				'style' => 'info',
				'required' => array( 'boxed-layout', '=', '1' ),
				'icon'  => 'el el-icon-link',
				'title' => esc_html__('Background Settings', 'kiddy-essentials' ),
				'desc'  => '<a href="themes.php?page=custom-background" target="_blank">Click this link to customize your background settings</a>',
			),
			array(
				'id' => 'wave-style',
				'type' => 'switch',
				'title' => esc_html__('Apply cloud style', 'kiddy-essentials' ),
				"default" => 0,
			),
			array(
				'id' => 'customize_headers',
				'title' => esc_html__( 'Customize headers', 'kiddy-essentials' ),
				'type' => 'switch',
				'default' => 0
			),
			array(
				'id' => 'header_img',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Header image', 'kiddy-essentials' ),
				'required' => array( 'customize_headers', '=', '1' ),
				'compiler' => true,
				),
			array(
				'id' => 'header_pattern',
				'type' => 'media',
				'url'=> true,
				'title' => esc_html__('Header pattern', 'kiddy-essentials' ),
				'required' => array( 'customize_headers', '=', '1' ),
				'compiler' => true,
			),
			array(
				'id'       => 'header_margin',
				'type'     => 'spacing',
				'mode'     => 'margin',
				'right'         => false,
				'left'          => false,
				'display_units' => 'false',
				'title'    => esc_html__('Header Spacings', 'kiddy-essentials' ),
				'default'  => array(
					'margin-top'    => '',
					'margin-bottom' => '',
				)
			)
		)
	) );

	// -> START Layout Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Layout Options', 'kiddy-essentials' ),
		'id'               => 'layout_options',
		'customizer_width' => '400px',
		'icon' => 'el-icon-magic'
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Sidebars', 'kiddy-essentials' ),
		'id'               => 'layout_options_page',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(


			array(
				'id' => 'def-page-layout',
				'type' => 'image_select',
				'compiler' => true,
				'title' => esc_html__('Page Sidebar Position', 'kiddy-essentials' ),
				'desc' => esc_html__('You can override these settings on each page individually.', 'kiddy-essentials' ),
				'options' => array(
						'none' => array('alt' => esc_html__('No Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'none.png'),
						'left' => array('alt' => esc_html__('Left Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'left.png'),
						'right' => array('alt' => esc_html__('Right Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'right.png'),
						'both' => array('alt' => esc_html__('Double Sidebars', 'kiddy-essentials' ), 'img' => $redux_img . 'both.png'),
				),
				'default' => 'none'
			),
			array(
				'id' => 'def-page-sidebar1',
				'type' => 'select',
				'width' => '250px',
				'data' => 'sidebars',
				'required' => array('def-page-layout', '!=', 'none'),
				'title' => esc_html__('Sidebar', 'kiddy-essentials' ),
				),
			array(
				'id' => 'def-page-sidebar2',
				'type' => 'select',
				'width' => '250px',
				'data' => 'sidebars',
				'required' => array('def-page-layout', '=', 'both'),
				'title' => esc_html__('Right Sidebar', 'kiddy-essentials' ),
				),
			array(
				'id' => 'def-blog-layout',
				'type' => 'image_select',
				'compiler' => true,
				'title' => esc_html__('Blog Sidebar Position', 'kiddy-essentials' ),
				'desc' => esc_html__('You can override this settings on each page individually.', 'kiddy-essentials' ),
				'options' => array(
					'none' => array('alt' => esc_html__('No Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'none.png'),
						'left' => array('alt' => esc_html__('Left Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'left.png'),
						'right' => array('alt' => esc_html__('Right Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'right.png'),
						'both' => array('alt' => esc_html__('Double Sidebars', 'kiddy-essentials' ), 'img' => $redux_img . 'both.png'),
				),
				'default' => 'none'
			),
			array(
				'id' => 'def-blog-sidebar1',
				'type' => 'select',
				'width' => '250px',
				'required' => array('def-blog-layout', '!=', 'none'),
				'data' => 'sidebars',
				'title' => esc_html__('Sidebar', 'kiddy-essentials' ),
				),
			array(
				'id' => 'def-blog-sidebar2',
				'type' => 'select',
				'width' => '250px',
				'required' => array('def-blog-layout', '=', 'both'),
				'data' => 'sidebars',
				'title' => esc_html__('Right Sidebar', 'kiddy-essentials' ),
				),
			array(
				'id' => 'def_blogtype',
				'type' => 'image_select',
				'title' => esc_html__('Blog Layout', 'kiddy-essentials' ),
				'options' => array(
					'small' => array('title' => esc_html__('Small', 'kiddy-essentials' ), 'img' => $redux_img .'small.png' ),
					'medium' => array('title' => esc_html__('Medium', 'kiddy-essentials' ), 'img' => $redux_img . 'medium.png' ),
					'large' => array('title' => esc_html__('Large', 'kiddy-essentials' ), 'img' => $redux_img .'large.png' ),
					'2' => array('title' =>  esc_html__('Two', 'kiddy-essentials' ), 'img' => $redux_img . 'pinterest_2_columns.png'),
					'3' => array('title' => esc_html__('Three', 'kiddy-essentials' ), 'img' => $redux_img . 'pinterest_3_columns.png'),
				),
				'default' => 'medium',
				'width' => '250px',
			)

		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Sidebar Generator', 'kiddy-essentials' ),
		'id'               => 'layout_options_sidebar_generator',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'=>'sidebars',
				'type' => 'multi_text',
				'title' => esc_html__('Sidebar Generator', 'kiddy-essentials' ),
				'desc' => wp_kses(__('Please note: dot\'t forget to remove all the <a href="widgets.php">widgets</a> within the sidebar before deleting!', 'kiddy-essentials' ), $allowed_html),
				'options' => array('Main Sidebar', 'Footer Sidebar'),
			)
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Footer', 'kiddy-essentials' ),
		'id'               => 'layout_options_footer',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'footer-sidebar-top',
				'type' => 'select',
				'width' => '250px',
				'data' => 'sidebars',
				'title' => esc_html__('Footer\'s sidebar area', 'kiddy-essentials' ),
				'desc' => esc_html__('This options will set the default Footer widget area, unless you override it on each page.', 'kiddy-essentials' ),
				),
			array(
				'id' => 'footer_copyrights_text',
				'type' => 'textarea',
				'title' => esc_html__( 'Footer Copyrights content', 'kiddy-essentials' ),
				'default' => ''
			)
		)
	) );

	// -> START Layout Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Typography', 'kiddy-essentials' ),
		'id'               => 'typography_options',
		'customizer_width' => '400px',
		'icon' => 'el-icon-font',
		'fields'           => array(
			array(
				'id' => 'menu-font',
				'type' => 'typography',
				'title' => esc_html__('Menu Font', 'kiddy-essentials' ),
				'google' => true,
				'color' => true,
				'line-height' => true,
				'font-size' => true,
				'font-backup' => true,
				'default' => array(
					'font-size' => '24px',
					'line-height' => '34px',
					'color' => '#ffffff',
					'google' => true,
					'font-family' => 'Patrick Hand',
					'font-weight' => '400',
					'font-backup' => 'Helvetica, Arial, sans-serif'
				),
			),
			array(
				'id' => 'header-font',
				'type' => 'typography',
				'title' => esc_html__('Headers Font', 'kiddy-essentials' ),
				'google' => true,
				'font-backup' => true,
				'font-size' => true,
				'line-height' => true,
				'color' => true,
				'word-spacing' => false,
				'letter-spacing' => false,
				'text-transform' => true,
				'default' => array(
					'font-size' => '50px',
					'line-height' => '50px',
					'color' => '#26b4d7',
					'google' => true,
					'font-family' => 'Patrick Hand',
					'font-weight' => '400',
					'font-backup' => 'Helvetica, Arial, sans-serif'
				),
			),
			array(
				'id' => 'body-font',
				'type' => 'typography',
				'title' => esc_html__('Content Text Font', 'kiddy-essentials' ),
				'google' => true,
				'font-backup' => true,
				'font-size' => true,
				'line-height' => true,
				'color' => true,
				'word-spacing' => true,
				'letter-spacing' => true,
				'default' => array(
					'font-size' => '19px',
					'line-height' => '26px',
					'color' => '#9f9e9e',
					'google' => true,
					'font-family' => 'Dosis',
					'font-weight' => '400',
					'word-spacing' => '0',
					'letter-spacing' => '0',
					'font-backup' => 'Helvetica, Arial, sans-serif'
				),
			)
		)
	) );

	// -> START Homepage Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Home Page', 'kiddy-essentials' ),
		'id'               => 'homepage_options',
		'customizer_width' => '400px',
		'icon' => 'el-icon-home',
		'fields'           => array(
			array(
				'id' => 'home-slider-type',
				'type' => 'radio',
				'title' => esc_html__('Slider', 'kiddy-essentials' ),
				'options' => array('none' => 'None', 'img-slider' => 'Image Slider', 'video-slider' => 'Video', 'stat-img-slider' => 'Static Image'), //Must provide key => value pairs for radio options
				'default' => 'none',
			),
			array(
				'id' => 'home-header-slider-options',
				'type' => 'text',
				'required' => array('home-slider-type', '=', 'img-slider'),
				'title' => esc_html__('Slider shortcode', 'kiddy-essentials' ),
				'default' => '[rev_slider general]',
			),
			array(
				'id'       => 'slidersection-start',
				'type'     => 'section',
				'required' => array( 'home-slider-type', '=', 'video-slider' ),
				'title'    => esc_html__('Video Slider Setting', 'kiddy-essentials' ),
				'indent'   => true, // Indent all options below until the next 'section' option is set.
			),
					array(
						'id' => 'slider_switch',
						'type' => 'switch',
						'title' => esc_html__('Slider', 'kiddy-essentials' ),
						"default" => 0,
					),
					array(
						'id' => 'slider_shortcode',
						'title' => esc_html__( 'Slider shortcode', 'kiddy-essentials' ),
						'type' => 'text',
						'default' => '',
						'required' => array( 'slider_switch', '=', '1' ),
					),
					array(
						'id' => 'video_header_height',
						'title' => esc_html__( 'Video height', 'kiddy-essentials' ),
						'type' => 'text',
						'default' => '600',
						'required' => array( 'slider_switch', '=', '0' ),
					),
					array(
						'id' => 'video_type',
						'title' => esc_html__( 'Video type', 'kiddy-essentials' ),
						'type' => 'radio',
						'options' => array(
							'self_hosted' => esc_html__( 'Self hosted', 'kiddy-essentials' ),
							'youtube' => esc_html__( 'Youtube', 'kiddy-essentials' ),
							'vimeo' => esc_html__( 'Vimeo', 'kiddy-essentials' )
						),
						'default' => 'self_hosted'
					),
					array(
						'id' => 'sh_source',
						'title' => esc_html__( 'Add video', 'kiddy-essentials' ),
						'type' => 'media',
						'mode' => 'video',
						'required' => array( 'video_type', '=', 'self_hosted' ),
						'url' => true
					),
					array(
						'id' => 'youtube_source',
						'title' => esc_html__( 'Youtube video code', 'kiddy-essentials' ),
						'type' => 'text',
						'required' => array( 'video_type', '=', 'youtube' ),
						'default' => ''
					),
					array(
						'id' => 'vimeo_source',
						'title' => esc_html__( 'Vimeo embed url', 'kiddy-essentials' ),
						'type' => 'text',
						'required' => array( 'video_type', '=', 'vimeo' ),
						'default' => ''
					),
					array(
						'id' => 'overlay_color',
						'title' => esc_html__( 'Overlay color', 'kiddy-essentials' ),
						'type' => 'color',
						'transparent' => false,
						'default'   => '#26b4d7',
						'validate'  => 'color',
						'customizer' => false
					),
					array(
						'id' => 'color_overlay_opacity',
						'title' => esc_html__( 'Opacity', 'kiddy-essentials' ),
						'desc' => esc_html__( 'In percents', 'kiddy-essentials' ),
						'type' => 'text',
						'default' => '40'
					),
					array(
						'id' => 'use_pattern',
						'title' => esc_html__( 'Use pattern image', 'kiddy-essentials' ),
						'type' => 'checkbox',
						'default' => false
					),
					array(
						'id' => 'pattern_image',
						'title' => esc_html__( 'Pattern image', 'kiddy-essentials' ),
						'type' => 'media',
						'required' => array( 'use_pattern', '=', true )
					),
			array(
				'id'     => 'slidersection-end',
				'type'   => 'section',
				'indent' => false, // Indent all options below until the next 'section' option is set.
			),
			array(
				'id' => 'home-header-image-options',
				'type' => 'media',
				'required' => array('home-slider-type', '=', 'stat-img-slider'),
				'url'=> true,
				'readonly' => false,
				'title' => esc_html__('Static Image', 'kiddy-essentials' ),
				'compiler' => 'true',
				),

			array(
				'id' => 'static_image_height',
				'title' => esc_html__( 'Static Image Height', 'kiddy-essentials' ),
				'type' => 'text',
				'default' => '600',
				'required' => array('home-slider-type', '=', 'stat-img-slider'),
			),
			array(
				'id' => 'def-home-layout',
				'type' => 'image_select',
				'compiler' => true,
				'title' => esc_html__('HomePage Sidebar', 'kiddy-essentials' ),
				'options' => array(
					'none' => array('alt' => esc_html__('No Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'none.png'),
					'left' => array('alt' => esc_html__('Left Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'left.png'),
					'right' => array('alt' => esc_html__('Right Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'right.png'),
					'both' => array('alt' => esc_html__('Double Sidebars', 'kiddy-essentials' ), 'img' => $redux_img . 'both.png'),
				),
				'default' => 'none'
			),
			array(
				'id' => 'def-home-sidebar1',
				'type' => 'select',
				'required' => array('def-home-layout', '!=', 'none'),
				'data' => 'sidebars',
				'title' => esc_html__('Sidebar', 'kiddy-essentials' ),
				'width' => '250px',
				),
			array(
				'id' => 'def-home-sidebar2',
				'type' => 'select',
				'required' => array('def-home-layout', '=', 'both'),
				'data' => 'sidebars',
				'title' => esc_html__('Left Sidebar', 'kiddy-essentials' ),
				'width' => '250px',
				),
			array(
				'id' => 'def-home-category',
				'type' => 'select',
				'data' => 'categories',
				'title' => esc_html__('Posts Category', 'kiddy-essentials' ),
				'width' => '250px',
				'multi' => true,
				'default' => array()
				),
			array(
				'id' => 'benefits-sidebar',
				'type' => 'select',
				'data' => 'sidebar',
				'title' => esc_html__('Benefits Area', 'kiddy-essentials' ),
				'desc' => esc_html__('Show widgets of this sidebar under the slider on the Home Page.', 'kiddy-essentials' ),
				'width' => '250px',
				),
		)
	) );

$cws_is_woo_active = false;

if(is_multisite()){
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( class_exists( 'woocommerce' ) ) {
		$cws_is_woo_active = true;
	}
}elseif(in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )) {
	$cws_is_woo_active = true;
}

if ( $cws_is_woo_active )  {
	// -> START WOOCOMMERCE Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('WooCommerce', 'kiddy-essentials' ),
		'id'               => 'wooCommerce_options',
		'customizer_width' => '400px',
		'icon' => 'el-icon-shopping-cart',
		'fields'           => array(
			array(
				'id' => 'def-woo-layout',
				'type' => 'image_select',
				'compiler' => true,
				'title' => esc_html__('Default WooCommerce Sidebar', 'kiddy-essentials' ),
				'options' => array(
					'none' => array('alt' => esc_html__('No Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'none.png'),
					'left' => array('alt' => esc_html__('Left Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'left.png'),
					'right' => array('alt' => esc_html__('Right Sidebar', 'kiddy-essentials' ), 'img' => $redux_img . 'right.png'),
				),
				'default' => 'none'
			),
			array(
				'id' => 'def-woo-sidebar',
				'type' => 'select',
				'width' => '250px',
				'data' => 'sidebars',
				'required' => array('def-woo-layout', '!=', 'none'),
				'title' => esc_html__('WooCommerce Sidebar', 'kiddy-essentials' ),
				),
			array(
				'id' => 'woo-cart-enable',
				'type' => 'switch',
				'title' => esc_html__('Show WooCommerce Cart', 'kiddy-essentials' ),
				"default" => 1
			),			
			array(
				'id' => 'woo-num-products',
				'type' => 'spinner',
				'title' => esc_html__('Products per page', 'kiddy-essentials' ),
				"default" => get_option('posts_per_page'),
				"min" => "1",
				"step" => "1",
				"max" => "200",
				),
			array(
				'id' => 'woo-resent-num-products',
				'type' => 'spinner',
				'title' => esc_html__('Recent products per page', 'kiddy-essentials' ),
				"default" => 3,
				"min" => "1",
				"step" => "1",
				"max" => "200",
				),
		)
	) );
}



// -> START Social Options
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Social Networks', 'kiddy-essentials' ),
		'id'               => 'social_options',
		'customizer_width' => '400px',
		'icon' => 'el el-icon-twitter',
		'fields'           => array(
			array(
				'id'=>"social_group",
				'type' => 'group',//doesn't need to be called for callback fields
				'multi' => true,
				'title' => esc_html__('Social networks', 'kiddy-essentials' ),
				'groupname' => esc_html__('Social network', 'kiddy-essentials' ), // Group name
				'fields' =>
					array(
						array(
							'id' => 'title',
							'type' => 'text',
							'title' => esc_html__('Title', 'kiddy-essentials' ),
							'validate' => 'no_html',
							),
						array(
							'id'=>'soc-select-fa',
							'type' => 'select',
							'select2'  => array( 'containerCssClass' => 'fa' ),
							'class'    => ' font-icons fa',
							'data' => 'fa-icons',
							'title' => esc_html__('Icon', 'kiddy-essentials' ),
							'options'  => $iconArray
							),
						array(
							'id' => 'soc-url',
							'type' => 'text',
							'title' => esc_html__('Url', 'kiddy-essentials' ),
							'validate' => 'url',
							),
						),
					),
			array(
				'id' => 'social_links_location',
				'title' => esc_html__( 'Icons Location', 'kiddy-essentials' ),
				'type' => 'select',
				'options' => array(
					'none' => esc_html__( 'None', 'kiddy-essentials' ),
					'top' => esc_html__( 'Top panel', 'kiddy-essentials' ),
					'bottom' => esc_html__( 'Copyrights area', 'kiddy-essentials' ),
					'top_bottom' => esc_html__( 'Top and Copyrights', 'kiddy-essentials' )
				),
				'width' => '250px',
				'default' => 'top'
			)
		)
	) );

if ( in_array( 'oauth-twitter-feed-for-developers/twitter-feed-for-developers.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )  {

	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Twitter Feed', 'kiddy-essentials' ),
		'id'               => 'twitter_setting',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id' => 'turn-twitter',
				'type' => 'switch',
				'title' => esc_html__('Enable Twitter Feed', 'kiddy-essentials' ),
				'default' => '0',
				'on' => 'On',
				'off' => 'Off',
			),
			array(
				'id' => 'tw-username',
				'type' => 'text',
				'required' => array('turn-twitter', '=', '1'),
				'title' => esc_html__( 'Twitter username', 'kiddy-essentials' ),
				'default' => ''
			),

			)
	) );
}else{
	Redux::setSection( $opt_name, array(
		'title'            => esc_html__('Twitter Feed', 'kiddy-essentials' ),
		'id'               => 'twitter_setting',
		'subsection'       => true,
		'customizer_width' => '450px',
		'fields'           => array(
			array(
				'id'    => 'twitter_active_plugin_msg',
				'type'  => 'info',
				'style' => 'info',
				'icon'  => 'el el-icon-link',
				'title' => esc_html__('oAuth Twitter Feed for Developers plugin needed!', 'kiddy-essentials' ),
				'desc'  => 'You need to install and activate <a href="https://wordpress.org/plugins/oauth-twitter-feed-for-developers/" target="_blank">oAuth Twitter Feed for Developers</a> plugin in order to display your twitter feed.',
			),

		)
	) );
}


Redux::setSection( $opt_name, array(
	'title'            => esc_html__('Theme Manual', 'kiddy-essentials' ),
	'id'               => 'kiddy-tuts',
	'customizer_width' => '450px',
	'icon' => 'el-icon-book',
	'fields' => array(
		array(
			'id' => 'help_online',
			'type' => 'info',
			'title' => esc_html__('Select tutorial', 'kiddy-essentials' ),
			'desc' => '<a class="button" href="http://kiddy.cwsthemes.com/manual/" target="_blank"><i class="fa fa-life-bouy"></i>&nbsp;&nbsp;Online</a>&nbsp;<a class="button" href="https://www.youtube.com/user/cwsvideotuts/playlists" target="_blank"><i class="fa fa-video-camera"></i>&nbsp;&nbsp;Video</a>'
			)
		),
	) );


	/*
	 * <--- END SECTIONS
	 */


	/*
	 *
	 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
	 *
	 */

	/*
	*
	* --> Action hook examples
	*
	*/

	// If Redux is running as a plugin, this will remove the demo notice and links
	//add_action( 'redux/loaded', 'remove_demo' );

	// Function to test the compiler hook and demo CSS output.
	// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
	//add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

	// Change the arguments after they've been declared, but before the panel is created
	//add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

	// Change the default value of a field after it's been set, but before it's been useds
	//add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

	// Dynamically add a section. Can be also used to modify sections/fields
	//add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field	set with compiler=>true is changed.
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
				$return['error'] = $field;
				$field['msg']    = 'your custom error message';
			}

			if ( $warning == true ) {
				$return['warning'] = $field;
				$field['msg']      = 'your custom warning message';
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
				'title'  => __( 'Section via hook', 'redux-framework-demo' ),
				'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
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

	/**
	 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
	 */
	if ( ! function_exists( 'remove_demo' ) ) {
		function remove_demo() {
			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::instance(),
					'plugin_metalinks'
				), null, 2 );

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}
	}
