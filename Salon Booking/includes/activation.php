<?php
// Activation hook for the plugin
// includes/activation.php
/**
 * Function that runs on plugin activation.
 */
function sbp_activate_plugin() {
    // Register the custom post type to ensure it's available
    // sbp_register_appointment_post_type();
    
    // Flush rewrite rules to make sure the post type URLs (e.g., /appointment/your-booking) work correctly.
    flush_rewrite_rules();
}

add_action('activated_plugin', 'sbp_activate_plugin');
