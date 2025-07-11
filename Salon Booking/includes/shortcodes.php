<?php

// includes/shortcodes.php

/**
 * Handles the processing of the booking form submission.
 */

function sbp_handle_form_submission()
{
    // Check if the form was submitted and the nonce is valid for security
    // if (isset($_POST['sbp_submit_booking']) && wp_verify_nonce($_POST['sbp_booking_nonce'], 'sbp_booking_action')) {
    // if (isset($_POST['sbp_submit_booking'], $_POST['sbp_booking_nonce']) && wp_verify_nonce($_POST['sbp_booking_nonce'], 'sbp_booking_action')) {
    if (isset($_POST['sbp_submit_booking'], $_POST['sbp_booking_nonce']) && wp_verify_nonce($_POST['sbp_booking_nonce'], 'sbp_booking_action')) {

        // Sanitize all form data to prevent security issues
        $name = sanitize_text_field($_POST['customer_name']);
        $email = sanitize_email($_POST['customer_email']);
        $phone = sanitize_text_field($_POST['customer_phone']);
        $service = sanitize_text_field($_POST['service']);
        $date = sanitize_text_field($_POST['booking_date']);
        $time = sanitize_text_field($_POST['booking_time']);

        // Prepare data for creating a new post
        $post_title = "Booking for {$name} on {$date} at {$time}";
        $post_content = "Service: {$service}\nEmail: {$email}\nPhone: {$phone}";

        $appointment_data = [
            'post_title'    => $post_title,
            'post_content'  => $post_content,
            'post_type'     => 'appointment',
            'post_status'   => 'publish', // Use 'pending' if you want to approve appointments manually
        ];

        // Insert the new appointment post into the database
        $post_id = wp_insert_post($appointment_data);

        // If the post was created successfully, add the individual fields as post meta
        if ($post_id) {
            update_post_meta($post_id, '_customer_name', $name);
            update_post_meta($post_id, '_customer_email', $email);
            update_post_meta($post_id, '_customer_phone', $phone);
            update_post_meta($post_id, '_service', $service);
            update_post_meta($post_id, '_booking_date', $date);
            update_post_meta($post_id, '_booking_time', $time);

            // Debug log
            error_log('New appointment created: ' . $post_id);
            // Redirect the user to a 'Thank You' page
            $redirect_url = home_url('/thank-you'); // Make sure you create a page with this slug
            wp_redirect($redirect_url);
            exit;
        } else {
            error_log('Failed to create new appointment.');
        }
    }
}
add_action('template_redirect', 'sbp_handle_form_submission');




/**
 * Creates the [salon_booking_form] shortcode to display the booking form.
 */

function sbp_booking_form_shortcode()
{

    ob_start();
?>
    <div id="salon-booking-form-wrapper">
        <form id="salon-booking-form" method="POST" action="">
            <?php
            // wp_nonce_field('salon-booking-form', 'salon-booking-form-nonce');
            wp_nonce_field('sbp_booking_action', 'sbp_booking_nonce');
            ?>
            <div class="form-row">
                <label for="customer_name">Your Name <span class="required">*</span></label>
                <input type="text" id="customer_name" name="customer_name" required>
            </div>

            <div class="form-row">
                <label for="customer_email">Your Email <span class="required">*</span></label>
                <input type="email" id="customer_email" name="customer_email" required>
            </div>

            <div class="form-row">
                <label for="customer_phone">Your Phone <span class="required">*</span></label>
                <input type="tel" id="customer_phone" name="customer_phone" required>
            </div>

            <div class="form-row">
                <label for="service">Select Service <span class="required">*</span></label>
                <select id="service" name="service" required>
                    <option value="">-- Select a Service --</option>
                    <option value="Haircut">Haircut</option>
                    <option value="Hair Coloring">Hair Coloring</option>
                    <option value="Manicure">Manicure</option>
                    <option value="Pedicure">Pedicure</option>
                    <option value="Facial">Facial</option>
                </select>
            </div>

            <div class="form-row">
                <label for="booking_date">Select Date <span class="required">*</span></label>
                <input type="date" id="booking_date" name="booking_date" required>
            </div>

            <div class="form-row">
                <label for="booking_time">Select Time <span class="required">*</span></label>
                <input type="time" id="booking_time" name="booking_time" required>
            </div>

            <div class="form-row">
                <input type="submit" name="sbp_submit_booking" value="Book Appointment">
                <input type="hidden" name="sbp_booking_form_submitted" value="1">

            </div>

        </form>
    </div>
<?php
    return ob_get_clean();
    if ($post_id) {
        error_log('Appointment created with ID: ' . $post_id);
    } else {
        error_log('Appointment creation failed!');
    }
}

add_shortcode('salon_booking_form', 'sbp_booking_form_shortcode');
