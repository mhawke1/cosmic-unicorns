<?php



define('WPHYPERSPEED_TITLE', 'WP Speed Visit');
define('WPHYPERSPEED_SLUG', 'wphyperspeed');
define('WPHYPERSPEED_SECRET', 'e0c416c7-cb1a-475a-bc62-9d0fdc4b549d');
define('WPHYPERSPEED_PATH', dirname(__FILE__));
define('WPHYPERSPEED_DIR', basename(WPHYPERSPEED_PATH));
define('WPHYPERSPEED_FILE', plugin_basename(__FILE__));
define('WPHYPERSPEED_INCLUDE_DIR', WPHYPERSPEED_PATH . '/include');
define('WPHYPERSPEED_CONTROLLER_DIR', WPHYPERSPEED_PATH . '/controllers');
define('WPHYPERSPEED_MODEL_DIR', WPHYPERSPEED_PATH . '/models');
define('WPHYPERSPEED_VIEW_DIR', WPHYPERSPEED_PATH . '/views');
define('WPHYPERSPEED_ASSETS_DIR', WPHYPERSPEED_PATH . '/assets');
define('WPHYPERSPEED_ASSETS_URL', plugin_dir_url(__FILE__) . 'assets');

define('WPHYPERSPEED_COOKIE_LIFE', 24 * 60 * 60);
define('WPHYPERSPEED_PAGE_LIFE', 30 * 24 * 60 * 60);
define('WPHYPERSPEED_COOKIE_REFRESH', 5 * 60);

require_once WPHYPERSPEED_INCLUDE_DIR . '/WPHYPERSPEED_RuleEngine.php';

require_once WPHYPERSPEED_MODEL_DIR . '/WPHYPERSPEED_Settings.php';

require_once WPHYPERSPEED_CONTROLLER_DIR . '/WPHYPERSPEED_SettingsController.php';
require_once WPHYPERSPEED_CONTROLLER_DIR . '/WPHYPERSPEED_CacheController.php';

require_once dirname(__FILE__) . '/vendor/autoload.php';



class WPHYPERSPEED_WPHyperSpeed {
    private static $_instance = null;

    function __construct() {
    }

    function init()
    {
        $this->settings = new WPHYPERSPEED_Settings();
        $this->settings_controller = new WPHYPERSPEED_SettingsController();

        //the rule engine must always be present, otherwise disabling the plugin might not clear up the .htaccess
        $this->rule_engine = new WPHYPERSPEED_RuleEngine();

        $this->cache_controller = new WPHYPERSPEED_CacheController();
    }

    public static function instance() {
        if (self::$_instance == null) {
            self::$_instance = new WPHYPERSPEED_WPHyperSpeed();
            self::$_instance->init();
        }
        return self::$_instance;
    }
}

WPHYPERSPEED_WPHyperSpeed::instance();