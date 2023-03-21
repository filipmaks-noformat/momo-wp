<?php 
/**
 * The theme includes file
 *
 * @package momo_wp_theme
 */

// THEME CONSTANTS
define('BASE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('THEME_ASSETS', get_template_directory_uri() . '/assets/');

// THEME ASSETS
function enqueueStylesAndScripts() {
    
    // STYLES
    wp_register_style('main', THEME_ASSETS . 'css/main.css');
    wp_enqueue_style('main');
    
    // HEADER SCRIPTS
    wp_register_script('modernizr', THEME_ASSETS . 'js/libs/modernizr.js');
    wp_enqueue_script('modernizr');
    
    // FOOTER SCRIPTS
    wp_deregister_script('jquery'); 
    wp_register_script('jquery', THEME_ASSETS . 'js/libs/jquery.min.js', FALSE, '3.6.3', TRUE);
    wp_enqueue_script('jquery');
    wp_register_script('device', THEME_ASSETS . 'js/libs/jquery.device.js', FALSE, '3.6.3', TRUE);
    wp_enqueue_script('device');
    wp_register_script('preloading', THEME_ASSETS . 'js/libs/jquery.preloading.js', FALSE, '3.6.3', TRUE);
    wp_enqueue_script('preloading');
    wp_register_script('lottie', THEME_ASSETS . 'js/libs/lottie.js', FALSE, '1.11.0', TRUE);
    wp_enqueue_script('lottie');
	
    wp_register_script('init', THEME_ASSETS . 'js/init.js', array(), false, true);
    wp_enqueue_script('init');
    
}
add_action('wp_enqueue_scripts', 'enqueueStylesAndScripts');

if (is_admin()) {
    // load backend functionalitites (hooked functions, modules, metaboxes etc)
    wp_register_style('admin', THEME_ASSETS . 'css/admin/admin.css');
    wp_enqueue_style('admin');
}

