<?php

class Square {

    //Class properties.
    protected $accessToken;
    protected $app_id;
    protected $squareURL;
    protected $locationId;
    protected $mainSquareURL;

    /**
     * Constructor
     *
     * @param object $accessToken
     *
     */
    public function __construct($accessToken, $locationId="me",$app_id) {
        $this->accessToken = $accessToken;
        $this->app_id = $app_id;
        if(empty($locationId)){ $locationId = 'me'; }
        $this->locationId = $locationId;
        $this->squareURL = "https://connect.squareup.com/v1/" . $this->locationId;
        $this->mainSquareURL = "https://connect.squareup.com/v1/me";
    }

    
    public function getAccessToken(){
        return $this->accessToken;
    }
    
    public function setAccessToken($access_token){
        $this->accessToken = $access_token;
    }
    
    public function getapp_id(){
        return $this->app_id;
    }
    
    public function setapp_id($app_id){
        $this->app_id = $app_id;
    }
    
    public function getSquareURL(){
        return $this->squareURL;
    }
    

    public function setLocationId($location_id){        
        $this->locationId = $location_id;
        $this->squareURL = "https://connect.squareup.com/v1/".$location_id;
    }
    
    public function getLocationId(){
        return $this->locationId;
    }
    
    /*
     * authoirize the connect to Square with the given token
     */

    public function authorize() {
        Helpers::debug_log('info', "-------------------------------------------------------------------------------");
        Helpers::debug_log('info', "Authorize square account with Token: " . $this->accessToken);
		$accessToken = explode('-',$this->accessToken);
		delete_option('woo_square_account_type' ); 
		delete_option('woo_square_account_currency_code' ); 
		delete_option('wc_square_version', '1.0.11', 'yes');
		delete_option('woocommerce_square_merchant_access_token');
		delete_option('woo_square_access_token');
		delete_option('woo_square_locations');
		delete_option('woo_square_business_name');
		delete_option('woo_square_location_id');
		$woocommerce_square_settings = get_option('woocommerce_square_settings');
		if(@$woocommerce_square_settings['enable_sandbox'] != 'yes'){
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $this->mainSquareURL );
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->accessToken)
			);
			$response = curl_exec($curl);
			Helpers::debug_log('info', "The response of authorize curl request" . $response);
			curl_close($curl);
			$response_v_1 = json_decode($response, true); 
			update_option('woo_square_account_type', $response_v_1['account_type']);
			update_option('woo_square_account_currency_code', $response_v_1['currency_code']);
		} else {
			// live/production app id from Square account
			update_option('woo_square_account_type', 'BUSINESS');
			update_option('woo_square_account_currency_code',get_option('woocommerce_currency'));
		}
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://connect.squareup.com/v2/locations",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
					"authorization: Bearer ".$this->accessToken,
					"cache-control: no-cache",
					"postman-token: f39c2840-20f3-c3ba-554c-a1474cc80f12"
				),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				Helpers::debug_log('info', "cURL Error #:" . $err);
			} else {
				$response = json_decode($response, true);
				$response = $response['locations'][0];
				Helpers::debug_log('info', "The response of authorize curl request" . json_encode( $response ));
			}
			if (isset($response['id'])) {
				update_option('wc_square_version', '1.0.11', 'yes');
				update_option('woocommerce_square_merchant_access_token', $this->accessToken, 'yes');
				update_option('woo_square_access_token', $this->accessToken);
				update_option('woo_square_app_id',WOOSQU_PAY_APPID);
				$result = $this->getAllLocations();
				
				
				if(!empty($result['locations']) and is_array($result['locations'])){
					$woocommerce_square_settings = get_option('woocommerce_square_settings');
					foreach($result['locations'] as $key => $value){
						if 	(
								$value['status'] == 'ACTIVE'
							){
							$accurate_result['locations'][] =  $result['locations'][$key];
						} elseif($woocommerce_square_settings['enable_sandbox'] == 'yes'){
							$accurate_result['locations'][] =  $result['locations'][$key];
						}
					}
				}
				$results =  $accurate_result['locations'];
				if(!empty($results)){
					foreach($results as $result){
						$locations = $result;
						$location_id = ($locations['id']);
						$str[] = array(
						$location_id => $locations['name']
						);
					}
					update_option('woo_square_locations', $str);
					update_option('woo_square_business_name', $locations['name']);
				}
				$this->setupWebhook("PAYMENT_UPDATED");
				return true;
			} else {
				return false;
			}
    }

    
    /*
     * get currency code by location id
     */
    public function getCurrencyCode(){
        Helpers::debug_log('info', "Getting currency code for square token: {$this->getAccessToken()}, url: {$this->squareURL} "
        . "and location: {$this->locationId}");
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->squareURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->accessToken)
        );
        $response = curl_exec($curl);
        Helpers::debug_log('info', "The response of current location curl request" . $response);
        curl_close($curl);
        $response = json_decode($response, true);
        if (isset($response['id'])) {
            update_option('woo_square_account_currency_code', $response['currency_code']);
        }
    }
    
    /*
     * get all locations if account type is business
	 */
	public function getAllLocations() {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://connect.squareup.com/v2/locations",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"authorization: Bearer ".$this->accessToken,
				"cache-control: no-cache",
				"postman-token: f39c2840-20f3-c3ba-554c-a1474cc80f12"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			Helpers::debug_log('info', "cURL Error #:" . $err);
		} else {
			Helpers::debug_log('info', "The response of authorize curl request" . $response);
		}
		return json_decode($response, true);	
	}

    /*
     * setup webhook with Square
     */

    public function setupWebhook($type) {
        // setup notifications
        $data = array($type);
        $data_json = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->squareURL . "/webhooks");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json),
            'Authorization: Bearer ' . $this->accessToken)
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        $response = curl_exec($curl);
        Helpers::debug_log('info', "The response of setup webhook curl request " . $response);
        Helpers::debug_log('info', "-------------------------------------------------------------------------------");
        curl_close($curl);
        return true;
    }

 
    /*
     * Update Square inventory based on this order 
     */

    public function completeOrder($order_id) {
        Helpers::debug_log('info', "Complete Order: " . $order_id);
        $order = new WC_Order($order_id);
        $items = $order->get_items();
        Helpers::debug_log('info', "Order's items" . json_encode($items));
        foreach ($items as $item) {
            if ($item['variation_id']) {
                Helpers::debug_log('info', "Variable item");
                if (get_post_meta($item['variation_id'], '_manage_stock', true) == 'yes') {
                    Helpers::debug_log('info', "Item allow manage stock");
                    $product_variation_id = get_post_meta($item['variation_id'], 'variation_square_id', true);
                    Helpers::debug_log('info', "Item variation square id: " . $product_variation_id);
                    $this->updateInventory($product_variation_id, -1 * $item['qty'], 'SALE');
                }
            } else {
                Helpers::debug_log('info', "Simple item");
                if (get_post_meta($item['product_id'], '_manage_stock', true) == 'yes') {
                    Helpers::debug_log('info', "Item allow manage stock");
                    $product_variation_id = get_post_meta($item['product_id'], 'variation_square_id', true);
                    Helpers::debug_log('info', "Item variation square id: " . $product_variation_id);
                    $this->updateInventory($product_variation_id, -1 * $item['qty'], 'SALE');
                }
            }
        }
    }

    

    /*
     * create a refund to Square
     */

    public function refund($order_id, $refund_id) {
       
		$order    = wc_get_order( $order_id );
		
		$woocommerce_square_settings = get_option('woocommerce_square_settings');
		$token           = get_option( 'woocommerce_square_merchant_access_token' );
		$location = get_option('woo_square_location_id');
		if(@$woocommerce_square_settings['enable_sandbox'] == 'yes'){
			$token = $woocommerce_square_settings['sandbox_access_token'];
			$location = $woocommerce_square_settings['sandbox_location_id'];
		}
		$woosquare_transaction_id = get_post_meta($order_id, 'woosquare_transaction_id', true);
		
		
		$WooSquare_Gateway = new WooSquare_Gateway();
		$_order_currency = get_post_meta($order_id, '_order_currency', true);
		$fields = array(
			"idempotency_key" => uniqid(),
			"type" => "PARTIAL",
			"payment_id" => $woosquare_transaction_id,
			"reason" => "Returned Goods",
			"amount_money" => array(
				  "amount" => $WooSquare_Gateway->format_amount( $order->get_total(), $_order_currency ),
				  "currency" => $_order_currency,
				),
		);
		
		$url = "https://connect.".WC_SQUARE_STAGING_URL.".com/v2/refunds";
		$headers = array(
			'Accept' => 'application/json',
			'Authorization' => 'Bearer '.$token,
			'Content-Type' => 'application/json',
			'Cache-Control' => 'no-cache'
		);
	
		$refund_obj = json_decode(wp_remote_retrieve_body(wp_remote_post($url, array(
				'method' => 'POST',
				'headers' => $headers,
				'httpversion' => '1.0',
				'sslverify' => false,
				'body' => json_encode($fields)
				)
			)
		)
		);
		
		if('APPROVED' === $refund_obj->refund->status || 'PENDING' === $refund_obj->refund->status ){
			$refund_message = sprintf( __( 'Refunded %s - Refund ID: %s ', 'wpexpert-square' ), wc_price( $refund_obj->refund->amount_money->amount / 100 ), $refund_obj->refund->id);
			update_post_meta($order_id, "refund_created_at", $refund_obj->refund->created_at);
			update_post_meta($order_id, "refund_created_id", $refund_obj->refund->id);
			$order->add_order_note( $refund_message );
		}
        
    }
	
	
	/*
	* Update Inventory with stock amount
	*/

	public function updateInventory($variation_id, $stock, $adjustment_type = "RECEIVE_STOCK") {
		$data_string = '{
		"quantity_delta": ' . $stock . ',
		"adjustment_type": "' . $adjustment_type . '"
		}';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $this->getSquareURL() . '/inventory/' . $variation_id);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data_string),
		'Authorization: Bearer ' . $this->getAccessToken())
		);
		$response = curl_exec($curl);
		Helpers::debug_log('info', "The response of updating inventory curl request" . $response);
		curl_close($curl);

		return $response;
	}
   
    
}
