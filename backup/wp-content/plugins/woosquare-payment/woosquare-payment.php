<?php
/*
  Plugin Name: Woosquare Payment
  Plugin URI: https://codecanyon.net/item/woocommerce-square-up-payment-gateway/19692778
  Description: WooCommerce Square Up Payment Gateway helps you to pay with Square at WooCommerce checkout. With this plugin you can even manage refunds between WooCommerce and Square. Keeping the testing phase in mind we have integrated Sandbox support as well for making things easy for developers.  
  Version: 2.9
  Author: wpexperts.io
  Author URI: https://wpexperts.io/
  License: GPL
 */

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
if (!in_array('woosquare/woocommerce-square-integration.php', apply_filters('active_plugins', get_option('active_plugins')))) {

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('WOO_SQUARE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WOO_SQUARE_PLUGIN_PATH', plugin_dir_path(__FILE__));

define('WOO_SQUARE_TABLE_DELETED_DATA','woo_square_integration_deleted_data');
define('WOO_SQUARE_TABLE_SYNC_LOGS','woo_square_integration_logs');

//max sync running time
define('WOO_SQUARE_MAX_SYNC_TIME',60*20);
define( 'WooSquare_VERSION', '1.0.11' );
define( 'WooSquare_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WooSquare_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );


// if using staging, define this in wp-config.php

$woocommerce_square_settings = get_option('woocommerce_square_settings');


if(@$woocommerce_square_settings['enable_sandbox'] == 'yes'){
	if ( ! defined( 'WC_SQUARE_ENABLE_STAGING' ) ) {
		define( 'WC_SQUARE_ENABLE_STAGING', true );
		define( 'WC_SQUARE_STAGING_URL', 'squareupsandbox' );
	}
} else {
	if ( ! defined( 'WC_SQUARE_ENABLE_STAGING' ) ) {
		define( 'WC_SQUARE_ENABLE_STAGING', false );
		define( 'WC_SQUARE_STAGING_URL', 'squareup' );
	}
}


//connection auth credentials
if( !function_exists('get_plugin_data') ){
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
$plugin_data = get_plugin_data( __FILE__ );

$WOOSQU_PAY_PLUGIN_NAME = $plugin_data['Name'];
if (!defined('WOOSQU_PAY_PLUGIN_NAME')) define('WOOSQU_PAY_PLUGIN_NAME',$WOOSQU_PAY_PLUGIN_NAME);
if (!defined('WOOSQU_PAY_CONNECTURL')) define('WOOSQU_PAY_CONNECTURL','http://connect.apiexperts.io');


function set_woosquare_apps(){
	if(get_option('WOOSQUARE_APPVERSION') == '2019-08-14'){
		$WCSRS_APPID = 'sq0idp-OkzqrnM_vuWKYJUvDnwT-g';
		$WCSRS_APPNAME = 'API Experts';
		update_option('WOOSQU_PAY_APPID',$WCSRS_APPID);
		update_option('WOOSQU_PAY_APPNAME',$WCSRS_APPNAME);
		
	} else if (get_option('WOOSQUARE_APPVERSION') == '2020-02-26'){
		$WCSRS_APPID = 'sq0idp-rLd8Ep3zDXXCvZEje7qh5w';
		$WCSRS_APPNAME = 'Woo Payment';
		update_option('WOOSQU_PAY_APPID',$WCSRS_APPID);
		update_option('WOOSQU_PAY_APPNAME',$WCSRS_APPNAME);
		
	}
}

if(!get_option('woo_square_access_token')){
	update_option('WOOSQUARE_APPVERSION','2020-02-26');
}


if(!get_option('WOOSQUARE_APPVERSION')){
	update_option('WOOSQUARE_APPVERSION','2019-08-14');
}

set_woosquare_apps();

if (!defined('WOOSQU_PAY_APPID')) define('WOOSQU_PAY_APPID',get_option('WOOSQU_PAY_APPID'));
if (!defined('WOOSQU_PAY_APPNAME')) define('WOOSQU_PAY_APPNAME',get_option('WOOSQU_PAY_APPNAME'));


// if using staging, define this in wp-config.php
if ( ! defined( 'WC_SQUARE_ENABLE_STAGING' ) ) {
	define( 'WC_SQUARE_ENABLE_STAGING', false );
}

add_action('admin_menu', 'woo_square_settings_page');
add_action('admin_enqueue_scripts', 'woo_square_script');
add_action('woocommerce_order_refunded', 'woo_square_create_refund', 10, 2);
add_action('woocommerce_order_status_completed', 'woo_square_complete_order');
add_action( 'wp_loaded','post_savepage_load_admin_notice' );
add_action( 'admin_post_add_foobar', 'prefix_admin_Square_payment_settings_save' );
add_action( 'admin_post_nopriv_add_foobar', 'prefix_admin_Square_payment_settings_save' );

add_action('init', 'woo_square_check_renew_token_action');
add_filter('cron_schedules', 'cron_add_3min');


register_activation_hook(__FILE__, 'square_plugin_activation');

//import classes
require_once WOO_SQUARE_PLUGIN_PATH . '_inc/square.class.php';
require_once WOO_SQUARE_PLUGIN_PATH . '_inc/Helpers.class.php';
require_once WOO_SQUARE_PLUGIN_PATH . '/_inc/admin/pages.php';
require_once WOO_SQUARE_PLUGIN_PATH . '/_inc/SquareClient.class.php' ;
require_once WOO_SQUARE_PLUGIN_PATH . '/_inc/SquareSyncLogger.class.php' ;
require_once WOO_SQUARE_PLUGIN_PATH . '/_inc/payment/SquarePaymentLogger.class.php' ;
require_once WOO_SQUARE_PLUGIN_PATH . '/_inc/payment/SquarePayments.class.php' ;



/*
 * square activation
 */

function square_plugin_activation() {
    $user_id = username_exists('square_user');
    if (!$user_id) {
        $random_password = wp_generate_password(12);
        $user_id = wp_create_user('square_user', $random_password);
        wp_update_user(array('ID' => $user_id, 'first_name' => 'Square', 'last_name' => 'User'));
    }
}
/**
 * include script
 */
function woo_square_script() {
    wp_enqueue_script('woo_square_script', WOO_SQUARE_PLUGIN_URL . '_inc/js/script.js', array('jquery')); 
    wp_localize_script('woo_square_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
	 wp_enqueue_style('woo_square_pop-up', WOO_SQUARE_PLUGIN_URL . '_inc/css/pop-up.css');
}
/*
 * Ajax action to execute manual sync
 */
function post_savepage_load_admin_notice() {
	// Use html_compress($html) function to minify html codes.
	
			if(!empty($_GET['post'])){
				$admin_notice_square = get_post_meta($_GET['post'], 'admin_notice_square', true);
		
				if(!empty($admin_notice_square)){
					ob_start();
					echo __('<div  id="message" class="notice notice-error  is-dismissible"><p>'.$admin_notice_square.'</p></div>','error-sql-syn-on-update');
					delete_post_meta($_GET['post'], 'admin_notice_square', 'Product enable to sync to Square due to Sku missing ');
					
				}
			}
			
}


/*
 * Create Refund
 */

function woo_square_create_refund($order_id, $refund_id) {
    if(!get_option('woo_square_access_token')){
        return;
    }
    //Avoid auto save from calling Square APIs.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (get_post_meta($order_id, 'woosquare_transaction_id', true) and empty(get_post_meta($order_id, 'refund_created_at', true))) {
        $square = new Square(get_option('woo_square_access_token'),get_option('woo_square_location_id'),WOOSQU_PAY_APPID);
        $square->refund($order_id, $refund_id);
    }
}

/*
 * update square inventory on complete order 
 */

function woo_square_complete_order($order_id) {
    if(!get_option('woo_square_access_token')){
        return;
    }
    //Avoid auto save from calling Square APIs.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    $square = new Square(get_option('woo_square_access_token'),get_option('woo_square_location_id'),WOOSQU_PAY_APPID);
    $square->completeOrder($order_id);
}



function woo_square_check_renew_token_action(){
	
	$woo_square_auth_response = get_option('woo_square_auth_response');
	if (!is_object($woo_square_auth_response)) {
		$woo_square_auth_response = (object) $woo_square_auth_response;
	}
	
	if(!empty($woo_square_auth_response->expires_at)){
		if (strtotime($woo_square_auth_response->expires_at)-100000 <= time()) {
			//refresh token when token come to expire before one day...
				$oauth_connect_url = WOOSQU_PAY_CONNECTURL;
				$redirect_url = add_query_arg(
					array(
						'page'    => 'wc-settings',
						'tab'    => 'checkout',
						'section'    => 'square',
						'app_name'    => WOOSQU_PAY_APPNAME,
						'plug'    => WOOSQU_PAY_PLUGIN_NAME,
					),
					admin_url( 'admin.php' )
				);

				$redirect_url = wp_nonce_url( $redirect_url, 'connect_woosquare', 'wc_woosquare_token_nonce' );
				$site_url = ( urlencode( $redirect_url ) );

				$args_renew = array(
					'body' => array( 
						'header' => array(
										'refresh_token' => $woo_square_auth_response->refresh_token,
										'content-type' => 'application/json'
									),
						'action' => 'renew_token',
						'site_url'    => $site_url,
					),
					'timeout' => 45,
				);
				$oauth_response = wp_remote_post( $oauth_connect_url, $args_renew );
				$decoded_oauth_response = json_decode( wp_remote_retrieve_body( $oauth_response ) );
				if(!empty($decoded_oauth_response->access_token)){
					update_option('woo_square_auth_response',$decoded_oauth_response);
					update_option('woo_square_access_token',$decoded_oauth_response->access_token);
					update_option('woo_square_access_token_cauth',$decoded_oauth_response->access_token);
					update_option('woocommerce_square_merchant_access_token',$decoded_oauth_response->access_token);
				}
		}
	}
}


function cron_add_3min($schedules) {
	
   
	$schedules[ 'weekly' ] = array( 
        'interval' => 60 * 60 * 24 * 7, # 604,800, seconds in a week
        'display' => __( 'Weekly' ) 
	);
    return $schedules;
}





/*
* form submit to save data of payment settings 
*/

function prefix_admin_Square_payment_settings_save() {
    // Handle request then generate response using echo or leaving PHP and using HTML
		$arraytosave = array(
			'enabled' => ($_POST['woocommerce_square_enabled'] == 1 ? 'yes' : 'no'),
			'title' => (!empty($_POST['woocommerce_square_title']) ? $_POST['woocommerce_square_title'] : ''),
			'description' => (!empty($_POST['woocommerce_square_description']) ? $_POST['woocommerce_square_description'] : ''),
			'capture' => ($_POST['woocommerce_square_capture'] == 1 ? 'yes' : 'no'),
			'create_customer' => ($_POST['woocommerce_square_create_customer'] == 1 ? 'yes' : 'no'),
			'logging' => ($_POST['woocommerce_square_logging'] == 1 ? 'yes' : 'no'),
			'Send_customer_info' => ($_POST['Send_customer_info'] == 1 ? 'yes' : 'no')
		);
		$arraytosave_serialize =  ($arraytosave);
		
		if($_POST['woocommerce_square_enable_sandbox'] == '1'){
			$woocommerce_square_enable_sandbox_array = array(
				'enable_sandbox' => ($_POST['woocommerce_square_enable_sandbox'] == 1 ? 'yes' : 'no'),
				'sandbox_application_id' => (!empty($_POST['woocommerce_square_sandbox_application_id']) ? $_POST['woocommerce_square_sandbox_application_id'] : ''),
				'sandbox_access_token' => (!empty($_POST['woocommerce_square_sandbox_access_token']) ? $_POST['woocommerce_square_sandbox_access_token'] : ''),
				'sandbox_location_id' => (!empty($_POST['woocommerce_square_sandbox_location_id']) ? $_POST['woocommerce_square_sandbox_location_id'] : '')
			);
			$arraytosave_serialize = array_merge($arraytosave_serialize,$woocommerce_square_enable_sandbox_array);
		}
		
		update_option( 'woocommerce_square_settings', $arraytosave_serialize );
		wp_redirect(get_admin_url( ).'admin.php?page=Square-Payment-Settings');
}

/**
		 * Check required environment
		 *
		 * @access public
		 * @since 1.0.10
		 * @version 1.0.10
		 * @return null
		 */
		add_action( 'admin_notices', 'check_environment' );

		 function check_environment() {
			if ( ! is_allowed_countries() ) {
				$admin_page = 'wc-settings';

				echo '<div class="error">
					<p>' . sprintf( __( 'To enable payment gateway Square requires that the <a href="%s">base country/region</a> is the United States,United kingdom,Japan, Canada or Australia.', 'woosquare' ), admin_url( 'admin.php?page=' . $admin_page . '&tab=general' ) ) . '</p>
				</div>';
			}

			if ( ! is_allowed_currencies() ) {
				$admin_page = 'wc-settings';

				echo '<div class="error">
					<p>' . sprintf( __( 'To enable payment gateway Square requires that the <a href="%s">currency</a> is set to USD,GBP,JPY, CAD or AUD.', 'woosquare' ), admin_url( 'admin.php?page=' . $admin_page . '&tab=general' ) ) . '</p>
				</div>';
			}
		}


		
		 function is_allowed_countries() {
			 
			 
			 if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				if ( 
					'US' !== WC()->countries->get_base_country() && 
					'CA' !== WC()->countries->get_base_country() && 
					'AU' !== WC()->countries->get_base_country() &&
					'JP' !== WC()->countries->get_base_country() &&
					'GB' !== WC()->countries->get_base_country() 
					) {
					return false;
				}
			} else {
				$class = 'notice notice-error';
				$message = __( 'To use Woosquare WooCommerce must be installed and activated!',  'woosquare');

				printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
				deactivate_plugins( plugin_basename( __FILE__ ) );
			}
			 
			 
			

			return true;
		}
		
		 function is_allowed_currencies() {
			 
			 
			  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				if ( 
				'US' !== WC()->countries->get_base_country() && 
				'CA' !== WC()->countries->get_base_country() && 
				'AU' !== WC()->countries->get_base_country() &&
				'JP' !== WC()->countries->get_base_country() &&
				'GB' !== WC()->countries->get_base_country() 
				) {
					return false;
				}
			} else {
				$class = 'notice notice-error';
				$message = __( 'To use Woosquare. WooCommerce Currency must be USD,CAD,AUD',  'woosquare');

				printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message ); 
				deactivate_plugins( plugin_basename( __FILE__ ) );
			}
			 
			 
			 
			

			return true;
		}
		
function payment_gateway_disable_country( $available_gateways ) {
	global $woocommerce;
	if ( isset( $available_gateways['square'] ) && !is_ssl()) {
		unset( $available_gateways['square'] );
	}
	$woocommerce_square_settings = get_option('woocommerce_square_settings');
	if($woocommerce_square_settings['enabled'] == 'no'){
		unset( $available_gateways['square'] );
	} else if(@$woocommerce_square_settings['enable_sandbox'] == 'yes'){
		$current_user = wp_get_current_user();
		if(user_can( $current_user, 'administrator' ) != 1){
				//For sandbox testing user must be is an admin
				unset( $available_gateways['square'] );
		} 
	} else if(empty(get_option('woo_square_access_token_cauth'))){
		//If user not authenticated yet..
		unset( $available_gateways['square'] );
	} else if(empty(get_option('woo_square_location_id'))){
		//If user not setup location id..
		unset( $available_gateways['square'] );
	}
	return $available_gateways;
}
 
add_filter( 'woocommerce_available_payment_gateways', 'payment_gateway_disable_country' );	

} else {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	deactivate_plugins('woosquare/woocommerce-square-integration.php');
	activate_plugin('woosquare-payment/woosquare-payment.php');
		
}
} else {
	function report_error() {
		$class = 'notice notice-error';
		$message = __( 'To use "WooSquare Pro - WooCommerce Square Integration" WooCommerce must be activated or installed!', 'woosquare' );
		deactivate_plugins('woosquare-payment/woosquare-payment.php');
		printf( '<br><div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
		wp_die('','Plugin Activation Error',  array( 'response'=>200, 'back_link'=>TRUE ) );

	}
	add_action( 'admin_notices', 'report_error' );
}

		