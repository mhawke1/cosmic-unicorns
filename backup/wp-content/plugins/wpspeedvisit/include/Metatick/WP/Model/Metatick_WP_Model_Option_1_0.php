<?php

require_once 'Metatick_WP_Model_1_0.php';

if( !class_exists('Metatick_WP_Model_Option_1_0')) {
	class Metatick_WP_Model_Option_1_0
			extends Metatick_WP_Model_1_0 {

		//$_option is the name of the option used to store serialized data
		protected $_option = '';

		//$_network is true of the option should be network vs. current blog
		protected $_network = false;

		public function __construct($option, $network = false) {
			$this->_option  = $option;
			$this->_network = $network;

			if ($this->_network) {
				$this->_properties = get_site_option($this->_option, array());
			} else {
				$this->_properties = get_option($this->_option, array());
			}
		}

		public function save() {
			if ($this->_network) {
				update_site_option($this->_option, $this->_properties);
			} else {
				update_option($this->_option, $this->_properties);
			}
		}
	}
}