<?php

if( !class_exists('Metatick_WP_Plugin_1_0')) {
	class Metatick_WP_Plugin_1_0 {

		//all WP plugins are singletons
		protected static $_instance = null;

		public static function instance($class = null) {
			if (self::$_instance == null) {
				if( $class == null ){
					throw new Exception('Metatick_WP_Plugin_1_0::instance must be called with class name first');
				}
				self::$_instance = new $class();
			}
			return self::$_instance;
		}
	}
}