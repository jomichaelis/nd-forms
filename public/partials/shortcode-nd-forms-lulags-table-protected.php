<?php

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table = $wpdb->prefix . 'nd_forms_lulags';
$results = $wpdb->get_results( 'SELECT * FROM ' . $table . ' ORDER BY title' );
?>
<figure class="wp-block-table is-style-stripes">
	<table>
        <thead>
            <tr>
                <th>Kurzbeschreibung</th>
                <th>Beschreibung</th>
                <th>Ereignis-Typ</th>
                <th>Altersstufe</th>
                <th>TN-Zahl</th>
                <th>Verantwortliche*r</th>
                <th>E-Mail</th>
                <th>Stamm</th>
            </tr>
        </thead>
		<tbody>
<?php
for($i = 0; $i < count($results); $i++) {
    echo("<tr>");
    echo("<td>" . $results[$i]->title . "</td>");
    echo("<td>" . $results[$i]->description . "</td>");
    echo("<td>" . ( $results[$i]->event_type === "0" ? "Land & Leute Aktion" : "AG am Lagerplatz") . "</td>");
    echo("<td>" . $results[$i]->altersstufe . "</td>");
    echo("<td>" . $results[$i]->attendees . "</td>");
    echo("<td>" . $results[$i]->host_name . "</td>");
    echo("<td>" . $results[$i]->host_mail . "</td>");
    echo("<td>" . $results[$i]->host_stamm . "</td>");
	echo("</tr>");
}
?>
		</tbody>
	</table>
</figure>

<style>
    td {
        min-width: 150px;
        max-width: 300px;
    }
</style>