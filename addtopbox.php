<?php
add_action( 'load-post.php', 'pcamp_top_meta_boxes_setup' );
add_action( 'load-post-new.php', 'pcamp_top_meta_boxes_setup' );
function pcamp_top_meta_boxes_setup() {

add_action( 'add_meta_boxes', 'pcamp_top_caption_add_meta_box' );
add_action( 'save_post', 'pcamp_top_caption_save_meta_box_data' );
}


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function pcamp_top_caption_add_meta_box() {

	  add_meta_box(
		'pcamp_top_caption_sectionid',      // Unique ID
		esc_html__( 'Top-Meldung', 'example' ),    // Title
		'pcamp_top_caption_meta_box_callback',   // Callback function
		'post',         // Admin page (or post type)
		'side',         // Context
		'default'         // Priority
	  );
}

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function pcamp_top_caption_meta_box_callback( $post ) {

	// Add a nonce field so we can check for it later.
	wp_nonce_field( 'pcamp_top_caption_save_meta_box_data', 'pcamp_top_caption_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_pcamp_top', true );
	if ($value === "false") $vtext = "checked=\"checked\""; else $vtext = "";
	echo '<input id="pcamp_top" name="pcamp_top" value="false" type="checkbox" '.$vtext.'><label for="pcamp_top">';
	_e( 'Keine Top-Meldung', 'pcamp_top_caption_textdomain' );
	echo '</label> ';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function pcamp_top_caption_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['pcamp_top_caption_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['pcamp_top_caption_meta_box_nonce'], 'pcamp_top_caption_save_meta_box_data' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	if (  $_POST['pcamp_top'] == "false" )  {
		update_post_meta( $post_id, '_pcamp_top', "false" );
	} else {
		update_post_meta( $post_id, '_pcamp_top', "" );
	}

}

?>
