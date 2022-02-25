<?php

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table = $wpdb->prefix . 'nd_forms_lulags';

$result = $wpdb->get_results( 'SELECT * FROM ' . $table . ' WHERE published = 1' );

?>
<figure class="wp-block-table is-style-stripes">
	<table>
		<tbody>
<?php
for($i = 0; $i < count($result); $i++) {
	if( $result[$i]->status == 1) {
		echo("<tr><td><s>" . $result[$i]->title) . "</s>*</s></td></tr>";
	} else {
		echo("<tr><td>" . $result[$i]->title) . "</td></tr>";
	}
}
?>
		</tbody>
	</table>
</figure>
