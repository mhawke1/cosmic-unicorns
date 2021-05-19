<?php

if( ! class_exists('Metatick_WP_Licensing_1_5') ){
	class Metatick_WP_Licensing_1_5{
		protected $product = null;
		protected $secret = null;
		protected $name = null;
		protected $options = null;
		protected $per_site_licensing = false;

		protected $changed = false;

		private $default_options = array(
				'error' => null,
				'license' => '',
				'expire' => '0000-00-00',
				'verify' => '',
				'notified' => false,
				'features' => array()
		);

		public function __construct($product,$secret,$name,$per_site_licensing = false, $no_alert = false){
			$this->product = $product;
			$this->secret = $secret;
			$this->name = $name;
			$this->per_site_licensing = $per_site_licensing;
			$this->no_alert = $no_alert;
			add_action( 'admin_notices', array($this,'admin_notices') );
			if ( ! wp_next_scheduled( 'Metatick_WP_Licensing_1_5_do_check' ) ) {
				wp_schedule_event( time(), 'daily', 'Metatick_WP_Licensing_1_5_do_check' );
			}
			add_action( 'Metatick_WP_Licensing_1_5_do_check', array($this,'update'));
		}

		public function admin_notices(){
			if( $this->is_licensed() || $this->no_alert){
				return;
			}
			$message = "{$this->name} is unlicensed";

			if( $this->has_error() )
				$message .= ': ' . $this->get_error();

			echo '<div class="error">';
			echo "<p>$message</p>";
			echo '</div>';
		}

		function set_option($name, $value) {
			if ($this->options == null)
				$this->get_option('license');

			$this->options[$name] = $value;

			if (is_multisite() && !$this->per_site_licensing)
				update_site_option($this->product . '_licensing', $this->options);
			else
				update_option($this->product . '_licensing', $this->options, true);
		}

		function get_option($name) {
			if ($this->options == null)
				if (is_multisite() && !$this->per_site_licensing)
					$this->options = get_site_option($this->product . '_licensing', array());
				else
					$this->options = get_option($this->product . '_licensing', array());

			if (isset($this->options[$name]))
				return $this->options[$name];

			return $this->default_options[$name];
		}

		function get_license(){
			return $this->get_option('license');
		}

		function set_license($license){
			if( $license != $this->get_license() ){
				$this->changed = true;
			}
			$this->set_option('license',$license);

			if( ! $this->is_licensed() )
				$this->update();
		}

		function get_expire(){
			return $this->get_option('expire');
		}

		function set_expire($expire){
			$this->set_option('expire',$expire);
		}

		function get_verify(){
			return $this->get_option('verify');
		}

		function set_verify($verify){
			$this->set_option('verify',$verify);
		}

		function get_error(){
			$license = $this->get_option('license');
			if( ! $license || $license == ''){
				return "No License Key";
			}
			return $this->get_option('error');
		}

		function has_error(){
			$error = $this->get_option('error');

			if( $error != null )
				return ! empty($error);

			return false;
		}

		function set_error($error){
			$this->set_option('error',$error);
		}

		function get_features(){
			return $this->get_option('features');
		}

		function set_features($features){
			$this->set_option('features',$features);
		}

        function set_name($name){
            $this->name = $name;
        }

        function get_name(){
            return $this->name;
        }

		function get_uid(){
			if( $this->per_site_licensing ) {
				$data = AUTH_KEY . get_current_blog_id();
			}else{
				$data = AUTH_KEY;
			}
			$hash = strtolower(md5(strtolower($data)));
			return $hash;
		}

		function is_licensed(){
			$data = $this->get_uid() . $this->get_license() . $this->secret . $this->get_expire();
			$hash = strtolower(md5(strtolower($data)));
			return $hash === $this->get_verify();
		}

		function update_features(){
			try{
				$url = "http://licensing.metatick.net/features/{$this->product}/{$this->get_license()}";
				$response = wp_remote_get($url);
				$json = json_decode(wp_remote_retrieve_body( $response ));
				if( isset($json->result) ){
					if( $json->result === 'success' ){
						$this->set_features($json->features);
					}
				}
			}catch (Exception $e){
			}
		}

		function update(){
			try{
				$url = "http://licensing.metatick.net/activate/{$this->product}/{$this->get_license()}/";
				$response = wp_remote_post( $url, array(
						'method' => 'POST',
						'timeout' => 45,
						'redirection' => 5,
						'blocking' => true,
						'body' => array( 'uid' => $this->get_uid(), 'device' => get_site_url() ),
					)
				);
				$json = json_decode(wp_remote_retrieve_body( $response ));
				if( isset($json->result) ){
					if( $json->result === 'success' ){
						$this->set_expire($json->expire);
						$this->set_verify($json->verify);
						$this->set_error(null);

						$this->update_features();
					}
					if( $json->result === 'error' )	{
						if( isset($json->remove) )	{
							$this->set_expire('2001-01-01');
							$this->set_verify('');
						}
						throw new Exception($json->error);
					}
				}else {
					throw new Exception("Unknown Error");
				}
			}catch (Exception $e){
				$this->set_error($e->getMessage());
			}
		}

		function notify($subject,$email){
			wp_mail( get_option('admin_email'), $subject, $email );
		}

		function has_changed(){
			return $this->changed;
		}

		function get_remaining_seconds(){
			$expire = new DateTime($this->get_expire());
			$now = new DateTime();
			return $expire->format('U') - $now->format('U');
		}

		function get_status(){
			if( $this->is_licensed() ){
				return 'Licensed';
			}
			if( $this->has_error() )
				return $this->get_error();

			return 'Not Licensed';
		}

		function has_feature($check){
			foreach( $this->get_features() as $feature ){
				if( $check === $feature )
					return true;
			}
			return false;
		}
	}
}