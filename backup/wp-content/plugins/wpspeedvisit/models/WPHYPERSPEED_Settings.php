<?php

require_once WPHYPERSPEED_INCLUDE_DIR . '/Metatick/WP/Model/Metatick_WP_Model_Option_1_0.php';

class WPHYPERSPEED_Settings extends Metatick_WP_Model_Option_1_0 {

    protected $_default = array(
        'enable_hyper_speed' => false,
        'posts_enabled' => false,
        'pages_enabled' => false,
        'other_enabled' => false,
        'loading_bar' => false,
        'cleanup_address_bar' => false,
        'additional_domains' => '',
        'cache_version' => 1,
        'use_advanced_cache' => false,
        'ignore' => '',
        'ignore_regex' => ''
    );

    public function __construct() {
        parent::__construct(WPHYPERSPEED_SLUG);
    }
}