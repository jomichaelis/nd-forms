<?php

/**
 * Get all LulagsSuggestionRecords
 *
 * @param $args array
 *
 * @return array
 */
function _get_all_LulagsSuggestionRecords( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'     => 20,
		'offset'     => 0,
		'orderby'    => 'id',
		'order'      => 'ASC',
	);

	$args      = wp_parse_args( $args, $defaults );
	$cache_key = 'LulagsSuggestionRecord-all';
	$items     = wp_cache_get( $cache_key, 'nd-forms-lulags-suggestion-record' );

	if ( false === $items ) {
		$items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'nd_forms_lulags_suggestions ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

		wp_cache_set( $cache_key, $items, 'LulagsSuggestionRecord-all' );
	}

	return $items;
}

/**
 * Fetch all LulagsSuggestionRecords from database
 *
 * @return array
 */
function _get_LulagsSuggestionRecord_count() {
	global $wpdb;

	return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'nd_forms_lulags_suggestions' );
}

/**
 * Fetch a single LulagsSuggestionRecord from database
 *
 * @param int   $id
 *
 * @return array
 */
function _get_LulagsSuggestionRecord( $id = 0 ) {
	global $wpdb;

	return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'nd_forms_lulags_suggestions WHERE id = %d', $id ) );
}

/**
 * Insert a new LulagsSuggestionRecord
 *
 * @param array $args
 */
function _insert_LulagsSuggestionRecord( $args = array() ) {

	global $wpdb;

	$defaults = array(
		'id'			=> null,
		'published'    	=> 0,
		'title'			=> '',
		'description' 	=> '',
		'event_type'   	=> 0,
		'altersstufe'  	=> 0,
		'attendees'  	=> 0
	);

	$args       = wp_parse_args( $args, $defaults );
	$table_name = $wpdb->prefix . 'nd_forms_lulags_suggestions';

	// remove row id to determine if new or update
	$row_id = (int) $args['id'];
	unset( $args['id'] );

	if ( ! $row_id ) {
		// insert a new
		if ( $wpdb->insert( $table_name, $args ) ) {
			return $wpdb->insert_id;
		}
	} else {
		// do update method here
		if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
			return $row_id;
		}
	}

	return false;
}

/**
 * Delete a LulagsSuggestionRecord
 *
 * @param array $args
 */
function _delete_LulagsSuggestionRecord( $id = 0 ) {

	global $wpdb;

	$status = $wpdb->delete(
		$wpdb->prefix."nd_forms_lulags_suggestions",
		[ 'ID' => $id ],
		[ '%d' ]
	);
}