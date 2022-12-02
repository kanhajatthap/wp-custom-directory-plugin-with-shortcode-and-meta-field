<?php

// Custom Fields
function directory_add_meta_box() {
    $screens = array( 'directory' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'directory_sectionid',
            __( 'Directory Details', 'directory_textdomain' ),
            'directory_meta_box_callback',
            $screen
        );
     }
    }
    add_action( 'add_meta_boxes', 'directory_add_meta_box' );
    
    function directory_meta_box_callback( $post ) {
    wp_nonce_field( 'directory_save_meta_box_data', 'directory_meta_box_nonce' );
    

    echo '<div class="directoryAdminContainer">';
    echo '<div class="directoryBox">';

    // This is for Capacity 
    $value1 = get_post_meta( $post->ID, '_my_meta_value_key', true );
    echo '<label for="directory_capacity">';
    _e( 'Capacity (number)', 'directory_capacity' );
    echo '</label> ';
    echo '<input type="text" id="directory_capacity" name="directory_capacity" value="' . esc_attr( $value1 ) . '" size="25" />';

    // This is for Website
    $value2 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for="directory_website">';
    _e( 'Website', 'directory_website' );
    echo '</label> ';
    echo '<input type="text" id="directory_website" name="directory_website" value="' . esc_attr( $value2 ) . '" size="25" />';

    // This is for Website URL
    $value3 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for="directory_website_url">';
    _e( 'Website URL', 'directory_website_url' );
    echo '</label> ';
    echo '<input type="text" id="directory_website_url" name="directory_website_url" value="' . esc_attr( $value3 ) . '" size="25" />';

    // This is for Contact Name
    $value4 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for="contact_names">';
    _e( 'Contact Name', 'contact_names' );
    echo '</label> ';
    echo '<input type="text" id="contact_names" name="contact_names" value="' . esc_attr( $value4 ) . '" size="25" />';

    // This is for Contact Name
    $value5 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for=" job_titles">';
    _e( 'Job title', 'job_titles' );
    echo '</label> ';
    echo '<input type="text" id="job_titles" name="job_titles" value="' . esc_attr( $value5 ) . '" size="25" />';

    // This is for Emails
    $value6 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for=" emails">';
    _e( 'Emails', 'emails' );
    echo '</label> ';
    echo '<input type="text" id="emails" name="emails" value="' . esc_attr( $value6 ) . '" size="25" />';

    // This is for Phone Numbers
    $value7 = get_post_meta( $post->ID, '_my_meta_value_keys', true );
    echo '<label for=" phone_numbers">';
    _e( 'Phone Numbers', 'phone_numbers' );
    echo '</label> ';
    echo '<input type="text" id="phone_numbers" name="phone_numbers" value="' . esc_attr( $value7 ) . '" size="25" />';

    }

    echo '</div>';
    echo '</div>';


     function directory_save_meta_box_data( $post_id ) {
    
     if ( ! isset( $_POST['directory_meta_box_nonce'] ) ) {
        return;
     }
     if ( ! wp_verify_nonce( $_POST['directory_meta_box_nonce'], 'directory_save_meta_box_data' ) ) {
        return;
     }
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
     }
     // Check the user's permissions.
     if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
    
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
     } else {
    
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
     }
     if ( ! isset( $_POST['directory_new_field'] ) ) {
        return;
     }


     $my_data1 = sanitize_text_field( $_POST['directory_new_field'] );
     update_post_meta( $post_id, '_my_meta_value_key', $my_data1 );

     $my_data2 = sanitize_text_field( $_POST['directory_website'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data2 );

     $my_data3 = sanitize_text_field( $_POST['directory_website_url'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data2 );

     $my_data4 = sanitize_text_field( $_POST['contact_names'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data4 );

     $my_data5 = sanitize_text_field( $_POST['job_titles'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data5 );

     $my_data6 = sanitize_text_field( $_POST['emails'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data6 );

     $my_data7 = sanitize_text_field( $_POST['phone_numbers'] );
     update_post_meta( $post_id, '_my_meta_value_keys', $my_data7 );



    }
    add_action( 'save_post', 'directory_save_meta_box_data' );