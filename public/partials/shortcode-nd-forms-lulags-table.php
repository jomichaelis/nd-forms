<?php

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table_sug = $wpdb->prefix . 'nd_forms_lulags_suggestions';
$table = $wpdb->prefix . 'nd_forms_lulags';

$result_sug = $wpdb->get_results( 'SELECT * FROM ' . $table_sug . ' WHERE published = 1 ORDER BY title' );
// $result = $wpdb->get_results( 'SELECT * FROM ' . $table . ' WHERE published = 1 ORDER BY title' );

?>
<figure class="wp-block-table is-style-stripes">
	<table>
		<tbody>
<?php
for($i = 0; $i < count($result_sug); $i++) {
	// if( $result_sug[$i]->status == 1) {
	// 	echo("<tr><td><s>" . $result_sug[$i]->title) . "</s>*</s></td></tr>";
	// } else {
		echo("<tr><td>" . $result_sug[$i]->title) . "</td></tr>";
	// }
}
?>
		</tbody>
	</table>
</figure>

<p>* Dafür hat sich bereits eine Person gemeldet.</p>
