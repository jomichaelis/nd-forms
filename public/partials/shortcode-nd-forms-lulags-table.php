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
	$class = $results_sug[$i]->event_type == 0 ? "nd_aktion" : "nd_ag";
	echo("<tr><td class='$class'>");
	if( $results_sug[$i]->belegt == 1) {
		echo("<s>" . $results_sug[$i]->title) . "</s>*";
	} else {
		echo( $results_sug[$i]->title);
	}
    echo("</td></tr>");
}
echo("<style>.nd_aktion{color: #167500;}</style>");
echo("<style>.nd_ag{color: #470675;}</style>");
?>
		</tbody>
	</table>
</figure>

<p>* Dafür hat sich bereits eine Person gemeldet.</p>
<p class="nd_aktion">● Aktion abseits des Lagerplatzes.</p>
<p class="nd_ag">● AG auf dem Lagerplatz.</p>