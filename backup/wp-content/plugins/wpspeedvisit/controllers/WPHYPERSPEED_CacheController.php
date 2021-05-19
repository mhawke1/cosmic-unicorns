<?php

class WPHYPERSPEED_CacheController {
    public function __construct() {
        add_action( 'wp_ajax_' . WPHYPERSPEED_SLUG . '_flush', array('WPHYPERSPEED_CacheController', 'flush'));

        if (defined('DOING_AJAX') && DOING_AJAX) {
            return;
        }

        session_cache_limiter('');

        add_action('template_redirect', array($this, 'add_cache_headers'));
        add_action('wp_footer', array($this, 'wp_footer'));
        add_action('init', array($this, 'manage_cookies'));

        add_action('admin_bar_menu', array($this, 'admin_bar_menu'), 10000);
        add_action('admin_head', array($this, 'admin_head'));

        $actions = array(
            'switch_theme',
            'customize_save_after',
            'publish_post',
            'future_to_publish',
            'autoptimize_action_cachepurged',
            'deleted_post',
            'edit_post',
            'delete_attachment',
        );

        foreach ($actions as $action) {
            add_action($action, array('WPHYPERSPEED_CacheController', 'flush'), 10, 2);
        }
    }

    function admin_head(){
        ?>
        <script>
            function <?php echo WPHYPERSPEED_SLUG; ?>_flush(){
                jQuery.post(ajaxurl, {'action': '<?php echo WPHYPERSPEED_SLUG; ?>_flush'}, function(response) {
                    alert('Cache Flushed!');
                });
            }
        </script>
        <?php
    }

    function admin_bar_menu( $wp_admin_bar ) {
        $image = WPHYPERSPEED_ASSETS_URL . '/icon.png';
        $html = "<p><img src='$image' style='height: 20px!important;position: relative;top: 5px;'> Flush Cache</p>";

        $args = array(
            'id'    => WPHYPERSPEED_SLUG . '_flush',
            'title' => $html,
            'href'  => '#',
            'meta'  => array(
                'class' => 'my-toolbar-page',
                'onclick' => WPHYPERSPEED_SLUG . '_flush()'
            )
        );
        $wp_admin_bar->add_node( $args );
    }

    public function manage_cookies(){
        $path = parse_url(home_url(), PHP_URL_PATH);
        $host = parse_url(home_url(), PHP_URL_HOST);
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;

        if($path == ''){
            $path = '/';
        }

        if(is_user_logged_in() || !$settings->enable_hyper_speed) {
            setcookie(WPHYPERSPEED_SLUG, "disable", time() + 3600, $path, $host, false, false);
        }else{
            setcookie(WPHYPERSPEED_SLUG, $settings->cache_version, time() + WPHYPERSPEED_COOKIE_LIFE, $path, $host, false, false);
            setcookie(WPHYPERSPEED_SLUG . '_cleanup_address_bar', $settings->cleanup_address_bar, time() + WPHYPERSPEED_COOKIE_LIFE, $path, $host, false, false);
            setcookie(WPHYPERSPEED_SLUG . '_refresh', 1, time() + WPHYPERSPEED_COOKIE_REFRESH, $path, $host, false, false);
        }
    }

    public function add_cache_headers(){
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;

        if(
            is_user_logged_in()
            || !array_key_exists(WPHYPERSPEED_SLUG, $_GET)
            || !array_key_exists(WPHYPERSPEED_SLUG, $_COOKIE)
            || !$settings->enable_hyper_speed){
            return;
        }
        if($_GET[WPHYPERSPEED_SLUG] == 'refresh') {
            exit;
        }

        if(is_singular( 'post' )){
            $cache = $settings->posts_enabled;
        }elseif(is_singular( 'page' )){
            $cache = $settings->pages_enabled;
        }else{
            $cache = $settings->other_enabled;
        }

        if(defined("DONOTCACHEPAGE") && DONOTCACHEPAGE){
            return;
        }

        if($cache) {
            header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + WPHYPERSPEED_PAGE_LIFE));
            header('Vary: User-Agent');
        }
    }

    public function clean_domain($url_or_domain){
        if(parse_url($url_or_domain, PHP_URL_SCHEME)){
            $url = $url_or_domain;
        }else{
            $url = 'http://' . trim($url_or_domain, '/');
        }

        return parse_url($url, PHP_URL_HOST);
    }

    public function get_domains(){
        $domains = array();

        $domains[] = $this->clean_domain(home_url());

        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;

        foreach($this->cleanup_lines($settings->additional_domains) as $domain){
            $domain = trim($domain);
            $domain = $this->clean_domain($domain);
            if($domain !== false && strlen($domain) > 0){
                $domains[] = $domain;
            }
        }

        return $domains;
    }

    public function cleanup_lines($lines){
        return array_filter(array_map('trim', explode("\n", $lines)), 'strlen');
    }

    public function is_headless(){
        if(!array_key_exists('HTTP_USER_AGENT', $_SERVER)){
            return true;
        }

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $agents = array(
            'Google Page Speed Insights', //self explanatory..
            'Linux x86_64' //screen shoting tools, favicons, etc..
        );

        foreach($agents as $agent){
            if(strpos($user_agent, $agent) !== false){
                return true;
            }
        }
        return false;
    }

    public function wp_footer(){
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;
        if(!$settings->enable_hyper_speed || $this->is_headless() || is_user_logged_in()){
            return;
        }

        $domains = $this->get_domains();

        if($settings->use_advanced_cache){
            include WPHYPERSPEED_VIEW_DIR . '/wphyperspeed_advanced.php';
        }else {
            include WPHYPERSPEED_VIEW_DIR . '/wphyperspeed.php';
        }

        if($settings->loading_bar) {
            include WPHYPERSPEED_VIEW_DIR . '/progress.php';
        }
    }

    public static function flush(){
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;
        $settings->cache_version = time();
    }
}