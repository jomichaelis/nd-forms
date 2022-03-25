<?php
// Filter POST data
$data = array();

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table_sug = $wpdb->prefix . 'nd_forms_lulags_suggestions';
$table = $wpdb->prefix . 'nd_forms_lulags';

if( filter_var( $_POST["signinrightnow"], FILTER_VALIDATE_BOOLEAN ) === true ) {
	// create eintrag
	$result = $wpdb->insert($table, array(
			'suggestion'	=> filter_var( trim( $_POST["title_predefined"] ), FILTER_SANITIZE_NUMBER_INT),
			'title'			=> filter_var( trim( $_POST["title"] ), FILTER_SANITIZE_STRING),
			'description'	=> filter_var( trim( $_POST["description"] ), FILTER_SANITIZE_STRING),
			'altersstufe'	=> filter_var( trim( $_POST["altersstufe"] ), FILTER_SANITIZE_STRING),
			'attendees'		=> filter_var( trim( $_POST["attendees"] ), FILTER_SANITIZE_NUMBER_INT),
			'event_type'	=> filter_var( trim( $_POST["event_type"] ), FILTER_SANITIZE_NUMBER_INT),
			'host_name'		=> filter_var( trim( $_POST["host_name"] ), FILTER_SANITIZE_STRING),
			'host_mail'		=> filter_var( trim( $_POST["host_mail"] ), FILTER_SANITIZE_EMAIL),
			'host_stamm'	=> filter_var( trim( $_POST["host_stamm"] ), FILTER_SANITIZE_STRING),
		)
	);
	if( $result ) {
		$response = array(
			'status' => 'success',
			'message' => 'Danke für deine Anmeldung!'
		);
	} else {
		$response = array(
			'status' => 'error',
			'message' => 'Da ist etwas schiefgelaufen! Schreib einfach mal an bundesfahrt@dpbm.de'
		);
	}

} else {
	// create suggestion
	$result = $wpdb->insert($table_sug, array(
			'title'			=> filter_var( trim( $_POST["title"] ), FILTER_SANITIZE_STRING),
			'description'	=> filter_var( trim( $_POST["description"] ), FILTER_SANITIZE_STRING),
			'altersstufe'	=> filter_var( trim( $_POST["altersstufe"] ), FILTER_SANITIZE_STRING),
			'event_type'	=> filter_var( trim( $_POST["event_type"] ), FILTER_SANITIZE_NUMBER_INT),
			'attendees'		=> filter_var( trim( $_POST["attendees"] ), FILTER_SANITIZE_NUMBER_INT),
		)
	);
	if( $result ) {
		$response = array(
			'status' => 'success',
			'message' => 'Danke für deinen Vorschlag! Wir überprüfen ihn noch und stellen ihn dann zur Auswahl.'
		);
	} else {
		$response = array(
			'status' => 'error',
			'message' => 'Da ist etwas schiefgelaufen! Schreib einfach mal an bundesfahrt@dpbm.de'
		);
	}
}

wp_send_json($response);