<?php

require_once 'Metatick_WP_Model_1_0.php';

if (!class_exists('Metatick_WP_Model_PostMeta_1_0')) {
	class Metatick_WP_Model_PostMeta_1_0
			extends Metatick_WP_Model_1_0 {

		protected $_meta_key = '';
		public $post_id = -1;

		public function __construct($meta_key, $post_id) {
			$this->_meta_key = $meta_key;
			$this->post_id  = $post_id;

			$this->_properties = get_post_meta($this->post_id, $this->_meta_key, true);
			if ($this->_properties == null) {
				$this->_properties = array();
			}
		}

		public function save() {
			update_post_meta($this->post_id, $this->_meta_key, $this->_properties);
		}
	}
}