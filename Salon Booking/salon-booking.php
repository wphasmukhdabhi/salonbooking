<?php

/**
 * Plugin Name: Salon Booking
 * Description: A custom plugin for booking salon appointments
 * Version: 1.0
 * Author: Hasmukh Dabhi
 * Author URI: https://yourwebsite.com
 * Text Domain: salon-booking
 * Domain Path: /languages
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * 
 */

if (! defined('WPINC')) {
    die; // Exit if accessed directly.
}

// Define plugin path and URL constants.
define('SBP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SBP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SBP_PLUGIN_PATH . 'functions.php';
require_once SBP_PLUGIN_PATH . 'includes/functions.php';
require_once SBP_PLUGIN_PATH . 'includes/activation.php';
require_once SBP_PLUGIN_PATH . 'includes/deactivation.php';
require_once SBP_PLUGIN_PATH . 'includes/post-types.php';
require_once SBP_PLUGIN_PATH . 'includes/shortcodes.php';
require_once SBP_PLUGIN_PATH . 'includes/admin-columns.php';

// Register activation and deactivation hooks
register_activation_hook(__FILE__, 'sbp_activate_plugin');
register_deactivation_hook(__FILE__, 'sbp_deactivate_plugin');

// Enqueue Scripts and Styles
// add_action('wp_enqueue_scripts', 'sbp_enqueue_scripts');

function sbp_enqueue_assets()
{
    // Enqueue frontend styles
    wp_enqueue_style(
        'sbp-style',
        SBP_PLUGIN_URL . 'assets/css/style.css',
        [],
        '1.0.0',
        'all'
    );

    // Enqueue frontend scripts (if any)
    wp_enqueue_script(
        'sbp-script',
        SBP_PLUGIN_URL . 'assets/js/script.js',
        ['jquery'],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'sbp_enqueue_assets');
