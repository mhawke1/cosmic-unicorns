<?php
/*
Plugin Name: WP Speed Visit
Plugin URI: https://marketinginunderwear.com/
Description: In 1-Click speed up your site for visitors.
Version: 1.4.3
Author: Mark Hess
Author URI: https://marketinginunderwear.com/
*/

if (version_compare(PHP_VERSION, '5.3.0') < 0) {
    function wp_hyper_speed_php_too_old_admin_notice(){
        echo '<div class="error"><p>WP Hyper Speed requires PHP version 5.3 or higher to operate. Please contact your web host</p></div>';
    }
    add_action( 'admin_notices', 'wp_hyper_speed_php_too_old_admin_notice' );
}else{
    require_once 'core.php';
}

