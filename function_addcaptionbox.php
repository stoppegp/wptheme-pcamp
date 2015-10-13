<?php
add_action( 'load-post.php', 'pcamp_meta_boxes_setup' );
add_action( 'load-post-new.php', 'pcamp_meta_boxes_setup' );
function pcamp_meta_boxes_setup() {

add_action( 'add_meta_boxes', 'pcamp_caption_add_meta_box' );
add_action( 'save_post', 'pcamp_caption_save_meta_box_data' );
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function pcamp_caption_add_meta_box() {

	  add_meta_box(
		'pcamp_caption_sectionid',      // Unique ID
		esc_html__( 'Caption', 'example' ),    // Title
		'pcamp_caption_meta_box_callback',   // Callback function
		'page',         // Admin page (or post type)
		'side',         // Context
		'default'         // Priority
	  );
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function pcamp_caption_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'pcamp_caption_save_meta_box_data', 'pcamp_caption_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_pcamp_caption', true );

	echo '<label for="pcamp_caption_new_field">';
	_e( 'Beschriftung des Beitragsbildes', 'pcamp_caption_textdomain' );
	echo '</label> ';
	echo '<input type="text" id="pcamp_caption_new_field" name="pcamp_caption_new_field" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function pcamp_caption_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['pcamp_caption_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['pcamp_caption_meta_box_nonce'], 'pcamp_caption_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
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

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['pcamp_caption_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['pcamp_caption_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_pcamp_caption', $my_data );
}

?>
