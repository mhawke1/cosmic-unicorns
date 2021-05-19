<?php

if( !class_exists('Metatick_WP_Plugin_Autoupdater_1_2')) {
	class Metatick_WP_Plugin_Autoupdater_1_2 {

		private $plugin_file = null;
		private $slug = null;
		private $remote_slug = null;
		private $plugin_data = null;
		private $remote = array();

		function __construct($plugin_file, $remote_slug, $frequency = 86400) {
			$this->plugin_file = $plugin_file;
			$this->slug = $remote_slug; //plugin_basename( $plugin_file );
			$this->remote_slug = $remote_slug;

			add_filter( 'pre_set_site_transient_update_plugins', array( $this, 'pre_set_site_transient_update_plugins' ) );
			add_filter( 'plugins_api', array( $this, 'plugins_api' ), 10, 3 );

			$this->remote = get_site_option($this->slug . '_update');
			if( ! $this->remote ){
				$this->remote = array(
					'version' => '0.0',
					'download_link' => '',
					'log' => '',
					'last_update' => 0,
				);
			}
			$this->maybe_update_remote($frequency);
		}

		function maybe_update_remote($frequency){
			if( time() - $frequency > $this->remote['last_update'] || isset($_GET['force-check']))
				$this->update_remote_version_information();
		}

		function update_remote_version_information(){
			$url = 'http://update.metatick.net/update/' . $this->remote_slug;
			$response = wp_remote_get($url);
			if( !is_wp_error($response) ) {
				$remote = json_decode($response['body']);
				if ($remote->result == 'success') {
					$this->remote['version']       = $remote->version_major . '.' . $remote->version_minor;
					$this->remote['download_link'] = $remote->download_link;
					$this->remote['log']           = $remote->description;
					$this->remote['last_update']   = time();
					update_site_option($this->slug . '_update', $this->remote);
				}
			}
		}

		function pre_set_site_transient_update_plugins($transient){
			$this->plugin_data = get_plugin_data( $this->plugin_file );
			if (! empty($transient->checked)) {
				if (version_compare($this->plugin_data['Version'], $this->remote['version'], '<')) {
					$obj                 = new stdClass();
					//$obj->id             = 0;
					$obj->slug           = $this->slug;
					$obj->plugin         = $this->plugin_file;
					$obj->new_version    = $this->remote['version'];
					$obj->url            = $this->plugin_data['PluginURI'];
					$obj->package        = $this->remote['download_link'];
					$transient->response[plugin_basename( $this->plugin_file )] = $obj;
				}
			}
			return $transient;
		}

		function plugins_api( $false, $action, $response ){
			if ( empty( $response->slug ) || $response->slug != $this->slug )
			{
				return $false;
			}
			$this->plugin_data = get_plugin_data( $this->plugin_file );

			return $this->get_plugin_information();
		}

		function get_plugin_information(){
			$plugin_information = new StdClass;
			$plugin_information->name = $this->plugin_data["Name"];
			$plugin_information->slug = $this->slug;
			$plugin_information->version = $this->remote['version'];
			$plugin_information->requires = null;
			$plugin_information->tested = null;
			$plugin_information->rating = null;
			$plugin_information->upgrade_notice = null;
			$plugin_information->num_ratings = null;
			$plugin_information->downloaded = null;
			$plugin_information->homepage = null;
			$plugin_information->last_updated = null;

			$plugin_information->sections = array(
				'Description'   => $this->plugin_data["Description"],
				'changelog'     => '<p>'  . str_replace("\n", '</p><p>', $this->remote['log']) . '</p>'
			);

			return $plugin_information;
		}
	}
}