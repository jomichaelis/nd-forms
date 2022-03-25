<?php
$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
$page   = isset( $_GET['page'] ) ? $_GET['page'] : 0;
$id     = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

$template = '';

switch ($action) {
	case 'edit':
		$template = dirname( __FILE__ ) . '/views/edit.php';
		break;

	case 'new':
		$template = dirname( __FILE__ ) . '/views/new.php';
		break;

	case 'delete':
		_delete_LulagsSuggestionRecord( $id );
		$template = dirname( __FILE__ ) . '/views/list.php';
		break;

	default:
		$template = dirname( __FILE__ ) . '/views/list.php';
		break;
}

if ( file_exists( $template ) ) {
	include $template;
} else {
	echo "something went wrong";
}
?>