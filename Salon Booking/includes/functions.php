
<?php 
// Add custom column to appointment post type
// function sbp_add_appointment_columns($columns)
// {
//     // Insert new column after title
//     $new_columns = [];

//     foreach ($columns as $key => $value) {
//         $new_columns[$key] = $value;
//         if ($key === 'title') {
//             $new_columns['appointment_details'] = 'Appointment Details';
//         }
//     }

//     return $new_columns;
// }
// add_filter('manage_appointment_posts_columns', 'sbp_add_appointment_columns');


// Populate the custom column with meta values
// function sbp_render_appointment_column($column, $post_id)
// {
//     if ($column === 'appointment_details') {
//         $name   = get_post_meta($post_id, '_customer_name', true);
//         $phone  = get_post_meta($post_id, '_customer_phone', true);
//         $email  = get_post_meta($post_id, '_customer_email', true);
//         $service = get_post_meta($post_id, '_service', true);
//         $date   = get_post_meta($post_id, '_booking_date', true);
//         $time   = get_post_meta($post_id, '_booking_time', true);

//         echo "<strong>Name:</strong> $name<br>";
//         echo "<strong>Phone:</strong> $phone<br>";
//         echo "<strong>Email:</strong> $email<br>";
//         echo "<strong>Service:</strong> $service<br>";
//         echo "<strong>Date:</strong> $date<br>";
//         echo "<strong>Time:</strong> $time<br>";
//     }
// }
// add_action('manage_appointment_posts_custom_column', 'sbp_render_appointment_column', 10, 2);
