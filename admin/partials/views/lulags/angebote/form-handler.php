<?php

/**
 * Handle the form submissions
 *
 * @package Package
 * @subpackage Sub Package
 */
class ND_Forms_Form_Handler {

	/**
	 * Hook 'em all
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'nd_forms_lulags_handle_form' ) );
	}

	/**
	 * Handle the LulagsRecord new and edit form
	 *
	 * @return void
	 */
	public function nd_forms_lulags_handle_form() {
		if ( ! isset( $_POST['nd_forms_lulags_action'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'nd_forms_lulags' ) ) {
			die( 'Are you cheating?' );
		}

		if ( ! current_user_can( 'read' ) ) {
			wp_die( 'Permission Denied!' );
		}

		$errors   = array();
		$page_url = admin_url( 'admin.php?page=nd-forms-lulags' );
		$field_id = isset( $_POST['field_id'] ) ? intval( $_POST['field_id'] ) : 0;

		$published = isset( $_POST['published'] ) ? sanitize_text_field( $_POST['published'] ) : '';
		$title = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : '';
		$description = isset( $_POST['description'] ) ? wp_kses_post( $_POST['description'] ) : '';
		$event_type = isset( $_POST['event_type'] ) ? intval($_POST['event_type']) : 0;
		$altersstufe = isset( $_POST['altersstufe'] ) ? sanitize_text_field($_POST['altersstufe']) : '';
		$attendees = isset( $_POST['attendees'] ) ? intval( $_POST['attendees'] ) : 0;
		$material_notes = isset( $_POST['material_notes'] ) ? sanitize_text_field($_POST['material_notes']) : '';
		$host_name = isset( $_POST['host_name'] ) ? sanitize_text_field( $_POST['host_name'] ) : '';
		$host_mail = isset( $_POST['host_mail'] ) ? sanitize_text_field( $_POST['host_mail'] ) : '';
		$host_stamm = isset( $_POST['host_stamm'] ) ? sanitize_text_field( $_POST['host_stamm'] ) : '';

		// bail out if error found

		$fields = array(
			'title' 		=> $title,
			'description' 	=> $description,
			'event_type' 	=> $event_type,
			'altersstufe' 	=> $altersstufe,
			'attendees'		=> $attendees,
			'material_notes'=> $material_notes,
			'host_name'		=> $host_name,
			'host_mail'		=> $host_mail,
			'host_stamm'	=> $host_stamm
		);

		// New or edit?
		if ( $field_id ) {
			$fields['id'] = $field_id;
		}
		$insert_id = _insert_LulagsRecord( $fields );

		error_log($page_url);

		if ( is_wp_error( $insert_id ) ) {
			$redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
		} else {
			$redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
		}

		wp_safe_redirect( $redirect_to );
		exit;
	}
}

new ND_Forms_Form_Handler();