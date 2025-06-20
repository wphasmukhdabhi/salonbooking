<?php
// includes/deactivation.php

/**
 * Function that runs on plugin deactivation.
 */
function sbp_deactivate_plugin() {
    // Flush rewrite rules on deactivation to clean up the permalinks.
    flush_rewrite_rules();
}

add_action('deactivated_plugin', 'sbp_deactivate_plugin');