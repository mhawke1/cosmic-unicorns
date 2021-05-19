<?php

if( !class_exists('Metatick_WP_Model_1_0')) {
	class Metatick_WP_Model_1_0 {

		//$options stores all our serializable fields
		protected $_properties = null;

		//$_suspend_autosave is used to prevent auto saving
		protected $_suspend_autosave = false;

		public function __set($name, $value) {
			$this->_properties[$name] = $value;
			if ($this->_suspend_autosave)
				return;

			$this->save();
		}

		public function __get($name) {
			if (array_key_exists($name, $this->_properties)) {
				return $this->_properties[$name];
			}

			if (isset($this->_default)) {
				if (array_key_exists($name, $this->_default)) {
					return $this->_default[$name];
				}
			}

			throw new Exception('Attempt to access non-existent property: ' . $name);
		}

		public function __isset($name) {
			return isset($this->_properties[$name]);
		}

		public function __unset($name) {
			unset($this->_properties[$name]);
		}

		public function suspend_autosave() {
			$this->_suspend_autosave = true;
		}

		public function resume_autosave() {
			$this->_suspend_autosave = false;
			$this->save();
		}

		public function save() {
			throw new Exception('save() not implemented');
		}
	}
}