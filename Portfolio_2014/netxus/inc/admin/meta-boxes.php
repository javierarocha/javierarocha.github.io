<?php
/**
 * This fucntion is responsible for rendering metaboxes in single post area
 *
 * @package ThemeGrill
 * @subpackage Ample Pro
 * @since Ample 1.0
 */

 add_action( 'add_meta_boxes', 'ample_add_custom_box' );
/**
 * Add Meta Boxes.
 */
function ample_add_custom_box() {
	// Adding layout meta box for Page
	add_meta_box( 'page-layout', __( 'Select Layout', 'ample' ), 'ample_page_layout', 'page', 'side', 'default' );
	// Adding layout meta box for Post
	add_meta_box( 'page-layout', __( 'Select Layout', 'ample' ), 'ample_page_layout', 'post', 'side', 'default' );
}

/****************************************************************************************/

global $ample_page_layout;
$ample_page_layout = array(
							'default-layout' 	=> array(
														'id'			=> 'ample_page_layout',
														'value' 		=> 'default_layout',
														'label' 		=> __( 'Default Layout', 'ample' )
														),
							'right-sidebar' 	=> array(
														'id'			=> 'ample_page_layout',
														'value' 		=> 'right_sidebar',
														'label' 		=> __( 'Right Sidebar', 'ample' )
														),
							'left-sidebar' 	=> array(
														'id'			=> 'ample_page_layout',
														'value' 		=> 'left_sidebar',
														'label' 		=> __( 'Left Sidebar', 'ample' )
														),
							'no-sidebar-full-width' => array(
															'id'			=> 'ample_page_layout',
															'value' 		=> 'no_sidebar_full_width',
															'label' 		=> __( 'No Sidebar Full Width', 'ample' )
															),
							'no-sidebar-content-centered' => array(
															'id'			=> 'ample_page_layout',
															'value' 		=> 'no_sidebar_content_centered',
															'label' 		=> __( 'No Sidebar Content Centered', 'ample' )
															),
                     'both-sidebar'    => array(
                                             'id'        => 'ample_page_layout',
                                             'value'     => 'both_sidebar',
                                             'label'     => __( 'Both Sidebar', 'ample' )
                                             )
						);

/****************************************************************************************/

/**
 * Displays metabox to for select layout option
 */
function ample_page_layout() {
	global $ample_page_layout, $post;

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );

	foreach ($ample_page_layout as $field) {
		$layout_meta = get_post_meta( $post->ID, $field['id'], true );
		if( empty( $layout_meta ) ) { $layout_meta = 'default_layout'; }
		?>
			<input class="post-format" type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $layout_meta ); ?>/>
			<label class="post-format-icon"><?php echo $field['label']; ?></label><br/>
		<?php
	}
}

/****************************************************************************************/

add_action('pre_post_update', 'ample_save_custom_meta');
/**
 * save the custom metabox data
 * @hooked to pre_post_update hook
 */
function ample_save_custom_meta( $post_id ) {
	global $ample_page_layout, $post;

	// Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'custom_meta_box_nonce' ] ) || !wp_verify_nonce( $_POST[ 'custom_meta_box_nonce' ], basename( __FILE__ ) ) )
      return;

	// Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)
      return;

	if ('page' == $_POST['post_type']) {
      if (!current_user_can( 'edit_page', $post_id ) )
         return $post_id;
   }
   elseif (!current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
   }

	foreach ($ample_page_layout as $field) {
		//Execute this saving function
		$old = get_post_meta( $post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}