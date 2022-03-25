<?php

if ( ! class_exists ( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List table class
 */
class ND_Forms_Lulags_Suggestion_List extends \WP_List_Table {

	function __construct() {
		parent::__construct( array(
			'singular' => 'LulagsSuggestionRecord',
			'plural'   => 'LulagsSuggestionRecords',
			'ajax'     => false
		) );
	}

	function get_table_classes() {
		return array( 'widefat', 'fixed', 'striped', $this->_args['plural'] );
	}

	/**
	 * Message to show if no lulags records found
	 *
	 * @return void
	 */
	function no_items() {
		_e( 'Keine Einträge gefunden', 'nd-forms' );
	}

	/**
	 * Default column values if no callback found
	 *
	 * @param  object  $item
	 * @param  string  $column_name
	 *
	 * @return string
	 */
	function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'published':
				return $item->published;
			case 'title':
				return $item->title;
			case 'description':
				return $item->description;
			case 'event_type':
				return $item->event_type;
			case 'altersstufe':
				return $item->altersstufe;
			case 'attendees':
				return $item->attendees;
			default:
				return isset( $item->$column_name ) ? $item->$column_name : '';
		}
	}

	/**
	 * Get the column names
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = array(
			'published'    	=> 'öffentlich',
			'title'			=> 'Kurzbeschreibung',
			'description' 	=> 'Beschreibung',
			'event_type'   	=> 'Ereignis-Typ',
			'altersstufe'  	=> 'Altersstufe',
			'attendees'  	=> 'max. Teilnehmer',
		);

		return $columns;
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	function column_title( $item ) {

		$delete_nonce = wp_create_nonce( 'nd-forms-lulags-suggestion-delete' );

		$actions           = array();
		$actions['edit']   = sprintf( '<a href="%s" data-id="%d" title="%s">%s</a>', admin_url( 'admin.php?page=nd-forms-lulags&tab=vorschlaege&action=edit&id=' . $item->id ), $item->id, 'Edit this item', 'Bearbeiten' );
		$actions['delete'] = sprintf( '<a href="?page=%s&tab=%s&action=%s&id=%s&_wpnonce=%s" onclick="return confirm(\'Ganz sicher löschen?\')">Löschen</a>', esc_attr( $_REQUEST['page'] ), 'vorschlaege', 'delete', absint( $item->id ), $delete_nonce );

		return sprintf( '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url( 'admin.php?page=nd-forms-lulags&tab=vorschlaege&action=edit&id=' . $item->id ), stripslashes( $item->title ), $this->row_actions( $actions ) );
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	function column_status( $item ) {
		$value = $item->status;
		if( $value == 0 ) {
			return "<p style='color:blue;'>Offen</p>";
		} else if ( $value == 1 ) {
			return "<p style='color:orange;'>Belegt</p>";
		} else {
			return "<p style='background-color:red; color:white'>ERROR</p>";
		}
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	function column_published( $item ) {
		$value = $item->published;
		if( $value == 0 ) {
			return "<p style='color:red;'>Nein</p>";
		} else if ( $value == 1 ) {
			return "<p style='color:green;'>Ja</p>";
		} else {
			return "<p style='background-color:red; color:white'>ERROR</p>";
		}
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	function column_event_type( $item ) {

		$value = $item->event_type;
		if( $value == 0 ) {
			return "Land & Leute Aktion";
		} else if ( $value == 1 ) {
			return "AG am Lagerplatz";
		} else {
			return "ERROR";
		}
	}

	/**
	 * Render the designation name column
	 *
	 * @param  object  $item
	 *
	 * @return string
	 */
	function column_description( $item ) {

		$text = $item->description;
		if( strlen( $text ) > 30 ) {
			$text = substr($text, 0, 30) . "...";
		}

		return stripslashes( $text );
	}

	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'published' 	=> array( 'published', true ),
			'title' 		=> array( 'title', false ),
			'event_type' 	=> array( 'event_type', false ),
			'altersstufe' 	=> array( 'altersstufe', false ),
			'attendees' 	=> array( 'attendees', false )
		);
		return $sortable_columns;
	}

	/**
	 * Set the views
	 *
	 * @return array
	 */
	public function get_views_() {
		$status_links   = array();
		$base_link      = admin_url( 'admin.php?page=sample-page' );

		foreach ($this->counts as $key => $value) {
			$class = ( $key == $this->page_status ) ? 'current' : 'status-' . $key;
			$status_links[ $key ] = sprintf( '<a href="%s" class="%s">%s <span class="count">(%s)</span></a>', add_query_arg( array( 'status' => $key ), $base_link ), $class, $value['label'], $value['count'] );
		}

		return $status_links;
	}

	/**
	 * Prepare the class items
	 *
	 * @return void
	 */
	function prepare_items() {

		$columns               = $this->get_columns();
		$hidden                = array( );
		$sortable              = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		$per_page              = 100;
		$current_page          = $this->get_pagenum();
		$offset                = ( $current_page -1 ) * $per_page;
		$this->page_status     = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '2';

		// only ncessary because we have sample data
		$args = array(
			'offset' => $offset,
			'number' => $per_page,
		);

		if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
			$args['orderby'] = $_REQUEST['orderby'];
			$args['order']   = $_REQUEST['order'] ;
		}

		$this->items  = _get_all_LulagsSuggestionRecords( $args );

		$this->set_pagination_args( array(
			'total_items' => _get_LulagsSuggestionRecord_count(),
			'per_page'    => $per_page
		) );
	}
}