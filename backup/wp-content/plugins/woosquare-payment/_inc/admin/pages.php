<?php

// don't load directly
if ( !defined('ABSPATH') )
	die('-1');

/**
 * settings page
 */
function woo_square_settings_page() {
    add_menu_page('Woo Square Settings', 'Woo-Square', 'manage_options', 'square-settings', 'square_settings_page', "dashicons-store");
    add_submenu_page('square-settings', "Square-Payment-Settings", "Square Payment", 'manage_options', 'Square-Payment-Settings', 'square_payment_plugin_page');
	
}

/**
 * Settings page action
 */
function square_settings_page() {
    $square = new Square(get_option('woo_square_access_token'), get_option('woo_square_location_id'),WOOSQU_PAY_APPID);
    $errorMessage = '';
    $successMessage = '';
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['terminate_sync'])) {
        //clear session variables if exists
        if (isset($_SESSION["square_to_woo"])){ unset($_SESSION["square_to_woo"]); };
        if (isset($_SESSION["woo_to_square"])){ unset($_SESSION["woo_to_square"]); };
        update_option('woo_square_running_sync', false);
        update_option('woo_square_running_sync_time', 0);
        Helpers::debug_log('info', "Synchronization terminated due to admin request");
        $successMessage = 'Sync terminated successfully!';
    }
	
	
	if(
		!empty($_REQUEST['access_token']) and 
		!empty($_REQUEST['token_type']) and 
		$_REQUEST['token_type'] == 'bearer' 
		){
			
		
			if ( function_exists( 'wp_verify_nonce' ) && ! wp_verify_nonce( $_GET['wc_woosquare_token_nonce'], 'connect_woosquare' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'woosquare-square' ) );
			}

			$existing_token = get_option( 'woo_square_access_token' );
			// if token already exists, don't continue
				update_option('woo_square_auth_response',$_REQUEST);
				update_option('woo_square_access_token',$_REQUEST['access_token']);
				update_option('woocommerce_square_merchant_access_token',$_REQUEST['access_token']);
				update_option('woo_square_access_token_cauth',$_REQUEST['access_token']);
				update_option('woo_square_update_msg_dissmiss','connected');
				delete_option('woo_square_auth_notice');
				delete_option('woo_square_location_id');
			wp_redirect(add_query_arg(
				array(
					'page'    => 'square-settings',
				),
				admin_url( 'admin.php' )
			));
			exit;
		}
	if(
		!empty($_REQUEST['disconnect_woosquare']) and 
		!empty($_REQUEST['wc_woosquare_token_nonce']) 
	){
		if ( function_exists( 'wp_verify_nonce' ) && ! wp_verify_nonce( $_GET['wc_woosquare_token_nonce'], 'disconnect_woosquare' ) ) {
			wp_die( __( 'Cheatin&#8217; huh?', 'woocommerce-square' ) );
		}
		
		
		
		//revoke token
		$oauth_connect_url = WOOSQU_PAY_CONNECTURL;
		$headers = array(
			'Authorization' => 'Bearer '.get_option('woo_square_access_token'), // Use verbose mode in cURL to determine the format you want for this header
			'Content-Type'  => 'application/json;',
		);		
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

		$redirect_url = wp_nonce_url( $redirect_url, 'connect_wcsrs', 'wc_wcsrs_token_nonce' );
		$site_url = ( urlencode( $redirect_url ) );
		$args_renew = array(
			'body' => array(
				'header' => $headers,
				'action' => 'revoke_token',
				'site_url'    => $site_url,
			),
			'timeout' => 45,
		);

		$oauth_response = wp_remote_post( $oauth_connect_url, $args_renew );

		$decoded_oauth_response = json_decode( wp_remote_retrieve_body( $oauth_response ) );
		update_option('WOOSQUARE_APPVERSION','2020-02-26');
		delete_option('woo_square_access_token');
		delete_option('woo_square_location_id');
		delete_option('woo_square_access_token_cauth');
		delete_option('woo_square_locations');
		delete_option('woo_square_business_name');
		wp_redirect(add_query_arg(
			array(
				'page'    => 'square-settings',
			),
			admin_url( 'admin.php' )
		));
			exit;
	}
	
	
    // check if the location is not setuped
    if (
		get_option('woo_square_access_token') 
			&& 
		!get_option('woo_square_location_id')
			&&
		!get_option('woo_square_locations')	
			) {
        $square->authorize();
		$square->getCurrencyCode();
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // setup account
		
       
        // save settings
        if (isset($_POST['woo_square_settings'])) {
            //update location id
            if( !empty($_POST['woo_square_location_id'])){
                $location_id = sanitize_text_field($_POST['woo_square_location_id']);
                update_option('woo_square_location_id', $location_id);               
                $square->setLocationId($location_id);
            }
            $successMessage = 'Settings updated successfully!';
        }
    }
    $wooCurrencyCode    = get_option('woocommerce_currency');
    $squareCurrencyCode = get_option('woo_square_account_currency_code');
    
    if(!$squareCurrencyCode){
        $square->getCurrencyCode();
        $square->getapp_id();
        $squareCurrencyCode = get_option('woo_square_account_currency_code');
    }
    if ( $currencyMismatchFlag = ($wooCurrencyCode != $squareCurrencyCode) ){
        Helpers::debug_log('info', "Currency code mismatch between Square [$squareCurrencyCode] and WooCommerce [$wooCurrencyCode]");

    }
    include WOO_SQUARE_PLUGIN_PATH . 'views/settings.php';
}

/**
 * square payment plugin page action
 * @global type $wpdb
 */
function square_payment_plugin_page(){
     $square_payment_settin = get_option('woocommerce_square_settings');
 
      include WOO_SQUARE_PLUGIN_PATH . 'views/payment-settings.php';
}
/**
* Initialize Gateway Settings Form Fields
*/
	 function init_form_fields() {
	$form = array(
			'enabled' => array(
				'title'       => __( 'Enable/Disable', 'wpexpert-square' ),
				'label'       => __( 'Enable Square', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => '',
				'default'     => 'no'
			),
			'title' => array(
				'title'       => __( 'Title', 'wpexpert-square' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'wpexpert-square' ),
				'default'     => __( 'Credit card (Square)', 'wpexpert-square' )
			),
			'description' => array(
				'title'       => __( 'Description', 'wpexpert-square' ),
				'type'        => 'textarea',
				'description' => __( 'This controls the description which the user sees during checkout.', 'wpexpert-square' ),
				'default'     => __( 'Pay with your credit card via Square.', 'wpexpert-square')
			),
			'capture' => array(
				'title'       => __( 'Delay Capture', 'wpexpert-square' ),
				'label'       => __( 'Enable Delay Capture', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => __( 'When enabled, the request will only perform an Auth on the provided card. You can then later perform either a Capture or Void.', 'wpexpert-square' ),
				'default'     => 'no'
			),
			'create_customer' => array(
				'title'       => __( 'Create Customer', 'wpexpert-square' ),
				'label'       => __( 'Enable Create Customer', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => __( 'When enabled, processing a payment will create a customer profile on Square.', 'wpexpert-square' ),
				'default'     => 'no'
			),
			'logging' => array(
				'title'       => __( 'Logging', 'wpexpert-square' ),
				'label'       => __( 'Log debug messages', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => __( 'Save debug messages to the WooCommerce System Status log.', 'wpexpert-square' ),
				'default'     => 'no'
			),
			'Send_customer_info' => array(
				'title'       => __( 'Send Customer Info', 'wpexpert-square' ),
				'label'       => __( 'Send First Name Last Name', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => __( 'Send First Name Last Name with order to square.', 'wpexpert-square' ),
				'default'     => 'no'
			),
			'enable_sandbox' => array( 
				'title'       => __( 'Enable/Disable', 'wpexpert-square' ),
				'label'       => __( 'Enable Sandbox', 'wpexpert-square' ),
				'type'        => 'checkbox',
				'description' => __( 'Test your transaction through sandbox mode.', 'wpexpert-square' ),
				'default'     => 'no'
			),
			'api_details'           => array(
				'title'       => __( 'Sandbox API credentials', 'wpexpert-square' ),
				'type'        => 'title',
				/* translators: %s: URL */
				'description' => sprintf( __( '<div class="squ-sandbox-description" style="%s"><p>%s</p></div> <div class="squ-sandbox-description"><p>If you don\'t have an account, go to <a target="_blank" href="%s">https://squareup.com/signup</a> to create one. You need a Square account to register an application with Square. 
													Register your application with Square
												</p>
												<p>
													Then go to <a  target="_blank" href="%s">https://connect.squareup.com/apps</a> and sign in to your Square account. Then <b>click New Application</b> and give the name for your application to Create App.

													The application dashboard displays your new app\'s sandbox credentials. Insert below these sandbox credentials.   
												</p></div>
												', 'wpexpert-square' ), '	padding: 3px 0px 3px 10px;
																			background-color: #0085ba;
																			color: white; 
																			font-size: medium;
																			font-weight: 400;
																			margin-bottom: 15px;'
																		,   'These settings are required only for sandbox!','https://squareup.com/signup','https://connect.squareup.com/apps' ),
			),
			'sandbox_application_id' => array(
				'title'       => __( 'Sandbox application id', 'wpexpert-square' ),
				'label'       => __( '', 'wpexpert-square' ),
				'type'        => 'textbox',
				'description' => __( 'Add Square Application ID settings to integrate with square payment with sandbox.', 'wpexpert-square' ),
				'default'     => ''
			),
			'sandbox_access_token' => array(
				'title'       => __( 'Sandbox access token', 'wpexpert-square' ),
				'label'       => __( '', 'wpexpert-square' ),
				'type'        => 'textbox',
				'description' => __( 'Add Square Access token settings to integrate with square payment with sandbox.', 'wpexpert-square' ),
				'default'     => ''
			),
			'sandbox_location_id' => array(
				'title'       => __( 'Sandbox location id', 'wpexpert-square' ),
				'label'       => __( 'Enable Sandbox', 'wpexpert-square' ),
				'type'        => 'textbox',
				'description' => __( 'Add Square Location ID settings to integrate with square payment with sandbox.', 'wpexpert-square' ),
				'default'     => ''
			),
		);
		
		
	}
