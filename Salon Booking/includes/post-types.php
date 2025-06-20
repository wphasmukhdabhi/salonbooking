<?php

// includes/post-types.php

/**
 * Registers the 'appointment' custom post type.
 */

function sbp_register_appointment_post_type()
{

    $labes = [
        'name' => _x( 'Appointments', 'Post type general name', 'salon-booking' ),
        'singular_name' => _x( 'Appointment', 'Post type singular name', 'salon-booking' ),
        'menu_name' => _x( 'Appointments', 'Admin Menu text', 'salon-booking' ),
        'name_admin_bar' => _x( 'Appointment', 'Add New on Toolbar', 'salon-booking' ),
        'add_new' => __( 'Add New', 'salon-booking' ),
        'add_new_item' => __( 'Add New Appointment', 'salon-booking' ),
        'new_item' => __( 'New Appointment', 'salon-booking' ),
        'edit_item' => __( 'Edit Appointment', 'salon-booking' ),
        'view_item' => __( 'View Appointment', 'salon-booking' ),
        'all_items' => __( 'All Appointments', 'salon-booking' ),
        'search_items' => __( 'Search Appointments', 'salon-booking' ),
        'parent_item_colon' => __( 'Parent Appointments:', 'salon-booking' ),
        'not_found' => __( 'No appointments found.', 'salon-booking' ),
        'not_found_in_trash' => __( 'No appointments found in Trash.', 'salon-booking' ),

    ];

    $args = [
        'labels' => $labes,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ],
        'taxonomies' => [ 'category', 'post_tag' ],
        'show_in_rest' => true,
        'rest_base' => 'appointments',
        'rest_controller_class' => 'WP_REST_Posts_Controller',

    ];
       register_post_type( 'appointment', $args );
}
add_action( 'init', 'sbp_register_appointment_post_type' );