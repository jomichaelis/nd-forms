<?php

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table = $wpdb->prefix . 'nd_forms_lulags';

$result = $wpdb->get_results( 'SELECT * FROM ' . $table . ' WHERE published = 1 ORDER BY title' );
?>
<h2>Mitmachen</h2>
<form action="" method="post" >
    <label for="title-predefined">Aktion</label><br>
    <select name="title-predefined" id="title-predefined">
        <option value=0>-- neuer Vorschlag --</option>
		<?php
		for($i = 0; $i < count($result); $i++) {
			if( $result[$i]->status == 1) {
				echo("<option value=" . $result[$i]->id . " disabled>" . $result[$i]->title . "</option>");
			} else {
				echo("<option value=" . $result[$i]->id . ">" . $result[$i]->title . "</option>");
			}
		}
		?>
    </select>

    <label for="title">Aktion:</label><br>
    <input type="text" id="title" name="title" value="" placeholder="Kurztitel der Aktion"><br>
    <label for="description">Beschreibung:</label><br>
    <textarea type="text" id="description" name="description" value="" row=4 placeholder="Genauere Beschreibung der Aktion"></textarea><br>
    <label for="event_type">Aktionsart:</label><br>
    <select name="event_type" id="event_type">
        <option value=0>Land & Leute Aktion</option>
        <option value=1>AG am Lagerplatz</option>
    </select>
    <label for="altersstufe">Geeignete Altersstufen:</label><br>
    <input type="text" id="altersstufe" name="altersstufe" value="" placeholder="z.B. Sipplinge & Rover"><br>
    <label for="attendees">Maximale Anzahl Teilnehmer*innen:</label><br>
    <input type="number" id="attendees" name="attendees" value=0 min=0><br>
    <label for="singinrightnow">Ich möchte diese Aktion betreuen:</label><br>
    <input type="checkbox" id="singinrightnow" name="singinrightnow" checked="checked"><br>


    <label for="host_name">Dein Name:</label><br>
    <input type="text" id="host_name" name="host_name"><br>
    <label for="host_mail">Deine E-Mail-Adresse:</label><br>
    <input type="text" id="host_mail" name="host_mail"><br>
    <label for="host_stamm">Dein Stamm/Ring:</label><br>
    <input type="text" id="host_stamm" name="host_stamm"><br>

    <input type="submit" value="Absenden">
</form>