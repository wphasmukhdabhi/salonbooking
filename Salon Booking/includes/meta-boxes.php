<?php
// includes/meta-boxes.php

/**
 * Add meta box to appointment post type
 */
function sbp_add_appointment_meta_box()
{
    add_meta_box(
        'sbp_appointment_details',
        __('Appointment Details', 'salon-booking'),
        'sbp_render_appointment_meta_box',
        'appointment',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'sbp_add_appointment_meta_box');

/**
 * Render the meta box content
 */
function sbp_render_appointment_meta_box($post)
{
    // Add nonce for security
    wp_nonce_field('sbp_save_appointment_meta', 'sbp_appointment_meta_nonce');

    // Get existing values
    $customer_name = get_post_meta($post->ID, '_customer_name', true);
    $customer_email = get_post_meta($post->ID, '_customer_email', true);
    $customer_phone = get_post_meta($post->ID, '_customer_phone', true);
    $service = get_post_meta($post->ID, '_service', true);
    $booking_date = get_post_meta($post->ID, '_booking_date', true);
    $booking_time = get_post_meta($post->ID, '_booking_time', true);

?>
    <p>
        <label><strong>Customer Name:</strong></label><br>
        <input type="text" name="sbp_customer_name" value="<?php echo esc_attr($customer_name); ?>" class="widefat" />
    </p>
    <p>
        <label><strong>Customer Email:</strong></label><br>
        <input type="email" name="sbp_customer_email" value="<?php echo esc_attr($customer_email); ?>" class="widefat" />
    </p>
    <p>
        <label><strong>Customer Phone:</strong></label><br>
        <input type="text" name="sbp_customer_phone" value="<?php echo esc_attr($customer_phone); ?>" class="widefat" />
    </p>
    <p>
        <label><strong>Service:</strong></label><br>
        <input type="text" name="sbp_service" value="<?php echo esc_attr($service); ?>" class="widefat" />
    </p>
    <p>
        <label><strong>Booking Date:</strong></label><br>
        <input type="date" name="sbp_booking_date" value="<?php echo esc_attr($booking_date); ?>" />
    </p>
    <p>
        <label><strong>Booking Time:</strong></label><br>
        <input type="time" name="sbp_booking_time" value="<?php echo esc_attr($booking_time); ?>" />
    </p>
<?php
}

/**
 * Save meta box data
 */
function sbp_save_appointment_meta_box($post_id)
{
    // Check nonce
    if (!isset($_POST['sbp_appointment_meta_nonce']) || !wp_verify_nonce($_POST['sbp_appointment_meta_nonce'], 'sbp_save_appointment_meta')) {
        return;
    }

    // Prevent autosave overwrite
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check post type
    if (get_post_type($post_id) !== 'appointment') {
        return;
    }

    // Save each field
    if (isset($_POST['sbp_customer_name'])) {
        update_post_meta($post_id, '_customer_name', sanitize_text_field($_POST['sbp_customer_name']));
    }

    if (isset($_POST['sbp_customer_email'])) {
        update_post_meta($post_id, '_customer_email', sanitize_email($_POST['sbp_customer_email']));
    }

    if (isset($_POST['sbp_customer_phone'])) {
        update_post_meta($post_id, '_customer_phone', sanitize_text_field($_POST['sbp_customer_phone']));
    }

    if (isset($_POST['sbp_service'])) {
        update_post_meta($post_id, '_service', sanitize_text_field($_POST['sbp_service']));
    }

    if (isset($_POST['sbp_booking_date'])) {
        update_post_meta($post_id, '_booking_date', sanitize_text_field($_POST['sbp_booking_date']));
    }

    if (isset($_POST['sbp_booking_time'])) {
        update_post_meta($post_id, '_booking_time', sanitize_text_field($_POST['sbp_booking_time']));
    }
}
add_action('save_post', 'sbp_save_appointment_meta_box');
