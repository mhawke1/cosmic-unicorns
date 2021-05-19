<?php

class WPHYPERSPEED_SettingsController {

    public function __construct() {
        add_action('admin_init', array($this, 'save'));
        add_action('admin_head', array($this, 'fix_icon_size'));
        add_action('admin_menu', array($this, 'add_settings_menu'));
    }

    function add_settings_menu() {
        add_menu_page(
            WPHYPERSPEED_TITLE, WPHYPERSPEED_TITLE, 'manage_options', WPHYPERSPEED_SLUG, array($this, 'render'),
            WPHYPERSPEED_ASSETS_URL . '/icon.png'
        );
    }

    function fix_icon_size() {
        ?>
        <style>
            .toplevel_page_wphyperspeed .wp-menu-image img {
                height: 25px;
                top: -5px;
                position: relative;
            }
        </style>
        <?php
    }

    public function save() {

        if (!current_user_can('manage_options')) {
            return;
        }

        if (isset($_POST['action']) && $_POST['action'] == 'update' && isset($_GET['page']) && $_GET['page'] == WPHYPERSPEED_SLUG) {
            $nonce = $_POST['_wpnonce'];
            if (!wp_verify_nonce($nonce, 'update')) {
                wp_die('Nice Try...');
            }

            $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;

            $settings->enable_hyper_speed = array_key_exists('enable_hyper_speed', $_POST);
            if($settings->enable_hyper_speed) {
                $settings->use_advanced_cache = array_key_exists('use_advanced_cache', $_POST);
                $settings->posts_enabled = array_key_exists('posts_enabled', $_POST);
                $settings->pages_enabled = array_key_exists('pages_enabled', $_POST);
                $settings->other_enabled = array_key_exists('other_enabled', $_POST);
                $settings->cleanup_address_bar = array_key_exists('cleanup_address_bar', $_POST);
                $settings->loading_bar = array_key_exists('loading_bar', $_POST);
                $settings->additional_domains = stripslashes($_POST['additional_domains']);
                $settings->ignore = stripslashes($_POST['ignore']);
                $settings->ignore_regex = stripslashes($_POST['ignore_regex']);
            }

            flush_rewrite_rules(true);

            wp_redirect($_SERVER['REQUEST_URI']);
        }
    }

    public function render() {
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;
        require WPHYPERSPEED_VIEW_DIR . '/settings.php';
    }
}