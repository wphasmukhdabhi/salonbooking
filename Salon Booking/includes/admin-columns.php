<?php
// includes/admin-columns.php

/**
 * Adds custom columns to the 'appointment' post type list in the admin dashboard.
 */
function sbp_set_custom_edit_appointment_columns($columns)
{
    // Create a new, ordered array of columns
    $new_columns = [];
    $new_columns['cb'] = $columns['cb']; // Checkbox
    $new_columns['title'] = __('Booking Summary', 'salon-booking');
    $new_columns['customer_name'] = __('Customer Name', 'salon-booking');
    $new_columns['service'] = __('Service', 'salon-booking');
    $new_columns['booking_date'] = __('Booking Date', 'salon-booking');
    $new_columns['booking_time'] = __('Booking Time', 'salon-booking');
    $new_columns['customer_phone'] = __('Phone', 'salon-booking');

    return $new_columns;
}
add_filter('manage_appointment_posts_columns', 'sbp_set_custom_edit_appointment_columns');


/**
 * Populates the custom columns with data from post meta.
 */
function sbp_custom_appointment_column($column, $post_id)
{
    // Use a switch statement to display data for each custom column
    switch ($column) {
        case 'customer_name':
            echo esc_html(get_post_meta($post_id, '_customer_name', true));
            break;
        case 'service':
            echo esc_html(get_post_meta($post_id, '_service', true));
            break;
        case 'booking_date':
            echo esc_html(get_post_meta($post_id, '_booking_date', true));
            break;
        case 'booking_time':
            echo esc_html(get_post_meta($post_id, '_booking_time', true));
            break;
        case 'customer_phone':
            echo esc_html(get_post_meta($post_id, '_customer_phone', true));
            break;
    }
}
add_action('manage_appointment_posts_custom_column', 'sbp_custom_appointment_column', 10, 2);
