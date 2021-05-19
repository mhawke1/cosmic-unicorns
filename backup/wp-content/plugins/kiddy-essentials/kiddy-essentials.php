<?php
/*
Plugin Name: Kiddy Essentials
Description: This plugin extends functionality of Kiddy theme.
Text Domain: kiddy-essentials
Version: 1.0.2
*/

/**
 * Load plugin textdomain.
 */
function cws_ess_load_textdomain() {
  load_plugin_textdomain( 'kiddy-essentials', false, basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'cws_ess_load_textdomain' );

/**
 * Load Theme Options panel
 */
require_once( 'core/framework/rc/framework.php' );
require_once( 'core/framework/config.php' );
include_once( 'core/scg.php' );
include_once( 'core/shortcodes.php' );
require_once( 'core/metaboxes.php' );
include_once( 'core/breadcrumbs.php' );

function kiddy_admin_init( $hook ) {
	global $typenow;
	wp_register_style( 'fa-icon', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_register_style( 'admin-css', get_template_directory_uri() . '/core/css/mb-post-styles.css' );
	wp_register_style( 'cws-redux-style', get_template_directory_uri() . '/core/css/cws-redux-style.css' );
	wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'admin-css' );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'font-awesome' );

	if (('toplevel_page_Kiddy' == $hook) || ('toplevel_page_KiddyChildTheme' == $hook)) {
		wp_enqueue_style( 'cws-redux-style' );
	}

	wp_enqueue_script( 'custom-admin', get_template_directory_uri() . '/core/js/custom-admin.js', array( 'jquery' ) );

	if ( 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook && 'nav-menus.php' != $hook ) {
		return;
	}
	if($typenow != 'product'){
		wp_enqueue_script( 'select2-js', plugin_dir_url( __FILE__ ) . 'core/framework/rc/assets/js/vendor/select2/select2.js', array( 'jquery' ) );
	}
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'kiddy_admin_init' );

//Add Widgets
add_action( "widgets_init", "cws_register_widgets" );
function cws_register_widgets() {
	require_once ('widgets/cws_text.php');
	require_once ('widgets/cws_latest_posts.php');
	require_once ('widgets/cws_portfolio.php');
	require_once ('widgets/cws_twitter.php');

	register_widget('CWS_Text');
	register_widget('CWS_Latest_Posts');
	register_widget('CWS_Portfolio');
	register_widget('CWS_Text');
}

?>