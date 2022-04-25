<?php

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table_sug = $wpdb->prefix . 'nd_forms_lulags_suggestions';
$table = $wpdb->prefix . 'nd_forms_lulags';

$results_sug = $wpdb->get_results(
        'SELECT *, CASE WHEN EXISTS (SELECT * FROM ' . $table
              . ' WHERE ' . $table . '.suggestion = ' . $table_sug . '.id ) THEN 1 ELSE 0 END AS belegt FROM '
              . $table_sug . ' WHERE published = 1 ORDER BY title' );
?>
<figure class="wp-block-table is-style-stripes">
	<table>
		<tbody>
<?php
for($i = 0; $i < count($results_sug); $i++) {
	if( $results_sug[$i]->belegt == 1) {
		if( $results_sug[$i]->event_type == 0 ) {
			echo(' style="color: #0c4200;"');
		}
		echo("<tr><td><s>" . $results_sug[$i]->title) . "</s>*</s></td></tr>";
	} else {
		echo("<tr><td>" . $results_sug[$i]->title) . "</td></tr>";
	}
}
?>
		</tbody>
	</table>
</figure>

<p>* Dafür hat sich bereits eine Person gemeldet.</p>
