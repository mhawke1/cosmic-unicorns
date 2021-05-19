<?php

add_action( 'after_setup_theme', 'kiddy_child_theme_setup' );
function kiddy_child_theme_setup() {
    load_child_theme_textdomain( 'kiddy', get_stylesheet_directory() . '/language' );
}

?>
