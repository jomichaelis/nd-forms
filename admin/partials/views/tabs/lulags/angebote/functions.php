<?php

/**
 * Get all LulagsRecord
 *
 * @param $args array
 *
 * @return array
 */
function _get_all_LulagsRecord( $args = array() ) {
	global $wpdb;

	$defaults = array(
		'number'     => 20,
		'offset'     => 0,
		'orderby'    => 'id',
		'order'      => 'ASC',
	);

	$args      = wp_parse_args( $args, $defaults );
	$cache_key = 'LulagsRecord-all';
	$items     = wp_cache_get( $cache_key, 'nd-forms-lulags-record' );

	if ( false === $items ) {
		$items = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'nd_forms_lulags ORDER BY ' . $args['orderby'] .' ' . $args['order'] .' LIMIT ' . $args['offset'] . ', ' . $args['number'] );

		wp_cache_set( $cache_key, $items, 'LulagsRecord-all' );
	}

	return $items;
}

/**
 * Fetch all LulagsRecord from database
 *
 * @return array
 */
function _get_LulagsRecord_count() {
	global $wpdb;

	return (int) $wpdb->get_var( 'SELECT COUNT(*) FROM ' . $wpdb->prefix . 'nd_forms_lulags' );
}

/**
 * Fetch a single LulagsRecord from database
 *
 * @param int   $id
 *
 * @return array
 */
function _get_LulagsRecord( $id = 0 ) {
	global $wpdb;

	return $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'nd_forms_lulags WHERE id = %d', $id ) );
}

/**
 * Insert a new LulagsRecord
 *
 * @param array $args
 */
function _insert_LulagsRecord( $args = array() ) {

	global $wpdb;

	$defaults = array(
		'id'			=> null,
		'title'			=> '',
		'description' 	=> '',
		'event_type'   	=> 0,
		'group_type'  	=> 0,
		'attendees'   	=> 0,
	);

	$args       = wp_parse_args( $args, $defaults );
	$table_name = $wpdb->prefix . 'nd_forms_lulags';

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
 * Delete a LulagsRecord
 *
 * @param array $args
 */
function _delete_LulagsRecord( $id = 0 ) {

	global $wpdb;

	$status = $wpdb->delete(
		$wpdb->prefix."nd_forms_lulags",
		[ 'ID' => $id ],
		[ '%d' ]
	);
}