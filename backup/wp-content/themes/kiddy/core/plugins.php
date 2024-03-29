<?php
	require_once( get_template_directory() . '/core/class-tgm-plugin-activation.php' );

	add_action( 'tgmpa_register', 'cws_register_required_plugins' );

// Check plugin's version
function cws_check_plugin_version ( $plugin ){

	$opt_res = get_option('cws_plugin_ver', true);

	if (!empty($opt_res['data']) ){
		$cws_chk_ver = array();
		wp_parse_str( $opt_res['data'], $cws_chk_ver );
	}

	if(!empty($cws_chk_ver[$plugin])){
		return $cws_chk_ver[$plugin];
	} else {
		switch ($plugin) {
			case 'revslider':
				$cws_chk_ret = "5.4.8";
				break;
			case 'js_composer':
				$cws_chk_ret = "5.7";
				break;			
			default:
				break;
		}
		return $cws_chk_ret;
	}
}
// \Check plugin's version

function cws_register_required_plugins() {

	$plugins = array(
		array(
			'name'						=> 'CWS Page Builder', // The plugin name
			'slug'						=> 'cws-pb', // The plugin slug (typically the folder name)
			'source'					=> get_template_directory() . '/plugins/cws-pb.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.6', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'Kiddy Essentials', // The plugin name
			'slug'						=> 'kiddy-essentials', // The plugin slug (typically the folder name)
			'source'					=> get_template_directory() . '/plugins/kiddy-essentials.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'CWS Portfolio and Staff', // The plugin name
			'slug'						=> 'cws-portfolio-staff', // The plugin slug (typically the folder name)
			'source'					=> get_template_directory() . '/plugins/cws-portfolio-staff.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'Revolution Slider Plugin', // The plugin name
			'slug'						=> 'revslider', // The plugin slug (typically the folder name)
			'source'					=> 'http://up.cwsthemes.com/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> cws_check_plugin_version('revslider'), 
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> 'http://up.cwsthemes.com/plugins/', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'Responsive Schedule For WordPress', // The plugin name
			'slug'						=> 'timetable', // The plugin slug (typically the folder name)
			'source'					=> get_template_directory() . '/plugins/timetable.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'CWS Demo Importer Plugin', // The plugin name
			'slug'						=> 'cws-demo-importer', // The plugin slug (typically the folder name)
			'source'					=> get_template_directory() . '/plugins/cws-demo-importer.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'						=> 'WP Flexible Map', // The plugin name
			'slug'						=> 'wp-flexible-map', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'					=> esc_html__( 'Contact Form 7', 'kiddy' ), // The plugin name
			'slug'					=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'					=> esc_html__( 'oAuth Twitter Feed for Developers', 'kiddy' ), // The plugin name
			'slug'					=> 'oauth-twitter-feed-for-developers', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
	);

	/**
		* Array of configuration settings. Amend each line as needed.
		* If you want the default strings to be available under your own theme domain,
		* leave the strings uncommented.
		* Some of the strings are added into a sprintf, so see the comments at the
		* end of each line for what each argument will be.
		*/
	$config = array(
		'domain'						=> KIDDY_SLUG,					// Text domain - likely want to be the same as your theme.
		'default_path' 			=> '',									// Default absolute path to pre-packaged plugins
		'menu'							=> 'install-required-plugins', 	// Menu slug
		'has_notices'				=> true,												// Show admin notices or not
		'is_automatic'			=> false,							// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'				=> array(
			'page_title'											=> esc_html__( 'Install Required Plugins', 'kiddy' ),
			'menu_title'											=> esc_html__( 'Install Plugins', 'kiddy' ),
			'installing'											=> esc_html__( 'Installing Plugin: %s', 'kiddy' ), // %1$s = plugin name
			'oops'													=> esc_html__( 'Something went wrong with the plugin API.', 'kiddy' ),
			'notice_can_install_required'			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'	=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_cannot_install'						=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_can_activate_required'		=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'	=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 		=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 			=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'kiddy' ), // %1$s = plugin name(s)
			'notice_cannot_update' 			=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'kiddy' ), // %1$s = plugin name(s)
			'install_link' 							=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'kiddy' ),
			'activate_link' 						=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'kiddy' ),
			'return'										=> esc_html__( 'Return to Required Plugins Installer', 'kiddy' ),
			'plugin_activated'					=> esc_html__( 'Plugin activated successfully.', 'kiddy' ),
			'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'kiddy' ), // %1$s = dashboard link
			'nag_type'									=> 'updated',// Determines admin notice type - can only be 'updated' or 'error'
		),
	);

	tgmpa( $plugins, $config );

}
?>
