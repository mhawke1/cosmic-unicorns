<?php

class WPHYPERSPEED_RuleEngine {
    public function __construct() {
        add_filter( 'mod_rewrite_rules', array($this,'mod_rewrite_rules') );
    }

    public function deactivate(){
        remove_filter( 'mod_rewrite_rules', array($this,'mod_rewrite_rules') );
    }

    public function mod_rewrite_rules($rules){
        $settings = WPHYPERSPEED_WPHyperSpeed::instance()->settings;

        if(!$settings->enable_hyper_speed){
            return $rules;
        }

        $lines = array();

        $lines[] = '# BEGIN ' . WPHYPERSPEED_TITLE;

        $lines[] = '<IfModule mod_rewrite.c>';
        $lines[] = '<IfModule mod_headers.c>';
        $lines[] = 'RewriteCond %{QUERY_STRING} wphyperspeed [NC]';
        $lines[] = 'RewriteRule ^ - [E=wphyperspeed:1]';
        $lines[] = 'Header set Vary User-Agent,Accept-Encoding  env=wphyperspeed';
        $lines[] = 'Header set Cache-Control public,max-age=315360000  env=wphyperspeed';
        $lines[] = 'Header unset Pragma  env=wphyperspeed';
        $lines[] = '</IfModule>';
        $lines[] = '</IfModule>';

        $lines[] = '<IfModule mod_expires.c>';
        $lines[] = 'ExpiresActive On';
        $lines[] = 'ExpiresByType text/css "access plus 1 month"';
        $lines[] = 'ExpiresByType image/gif "access plus 1 month"';
        $lines[] = 'ExpiresByType image/png "access plus 1 month"';
        $lines[] = 'ExpiresByType image/jpeg "access plus 1 month"';
        $lines[] = 'ExpiresByType application/x-javascript "access plus 1 month"';
        $lines[] = 'ExpiresByType application/javascript "access plus 1 month"';
        $lines[] = '</IfModule>';
        $lines[] = '# END ' . WPHYPERSPEED_TITLE;

        $lines[] = $rules;

        return implode("\n", $lines);
    }
}