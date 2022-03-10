<?php

function get_el_from_results( $array, $id ) {
    $ids = array_column($array, 'id');
    return "";
}

// Datenbankverbindung
global $wpdb;

// Tabellendefinition
$table_sug = $wpdb->prefix . 'nd_forms_lulags_suggestions';
$table = $wpdb->prefix . 'nd_forms_lulags';

$results_sug = $wpdb->get_results( 'SELECT * FROM ' . $table_sug . ' WHERE published = 1 ORDER BY title' );
$results = $wpdb->get_results( 'SELECT * FROM ' . $table . ' ORDER BY title' );

if( isset($_POST["formular"] ) && $_POST["formular"] == "Absenden") {
    $id = $_POST["title-predefined"];
    if( $id == 0 ) {
        echo "<p>eigen</p>";
        if( isset( $_POST["singinrightnow"] ) ) {
            // create full thing
			$wpdb->insert($table, array(
					'title' => $_POST["title"],
					'description' => $_POST["description"],
					'event_type' => $_POST["event_type"],
					'group_type' => $_POST["altersstufe"],
					'host_name' => $_POST["host_name"],
					'host_mail' => $_POST["host_mail"],
					'host_stamm' => $_POST["host_stamm"],
				)
			);
			echo "<p>Danke für deinen Eintrag!</p>";
        } else {
            // create suggestion
            $wpdb->insert($table_sug, array(
                    'published' => 0,
                    'title' => $_POST["title"],
                    'description' => $_POST["description"],
                    'event_type' => $_POST["event_type"],
                    'group_type' => $_POST["altersstufe"]
                )
            );
			echo "<p>Danke für deinen Eintrag!</p>";
		}
    } else {
        // create new lulag
        $sugg = 0;
        if( intval($_POST["title-predefined"]) != 0 ) {
            $sugg = intval($_POST["title-predefined"]);
        }
		$wpdb->insert($table, array(
                'suggestion' => $sugg,
				'title' => $_POST["title"],
				'description' => $_POST["description"],
				'event_type' => $_POST["event_type"],
				'group_type' => $_POST["altersstufe"],
				'host_name' => $_POST["host_name"],
				'host_mail' => $_POST["host_mail"],
				'host_stamm' => $_POST["host_stamm"],
			)
		);
		echo "<p>Danke für deinen Eintrag!</p>";
    }
}


?>
<h2>Mitmachen</h2>
<form action="" method="post" >
    <label for="title-predefined">Aktion:</label><br>
    <select name="title-predefined" id="title-predefined">
        <option value=0>-- neuer Eintrag --</option>
		<?php
		for($i = 0; $i < count($results_sug); $i++) {
			// if( $results_sug[$i]->status == 1) {
			// 	echo("<option value=" . $results_sug[$i]->id . " disabled>" . $results_sug[$i]->title . "</option>");
			// } else {
			echo("<option value=" . $results_sug[$i]->id . ">" . $results_sug[$i]->title . "</option>");
            // }
		}
		?>
    </select>

    <label for="title">Aktion:</label><br>
    <input type="text" id="title" name="title" placeholder="Kurztitel der Aktion"><br>
    <label for="description">Beschreibung:</label><br>
    <textarea type="text" id="description" name="description" row=4 placeholder="Genauere Beschreibung der Aktion"></textarea><br>
    <label for="event_type">Aktionsart:</label><br>
    <select name="event_type" id="event_type">
        <option value=0>Land & Leute Aktion</option>
        <option value=1>AG am Lagerplatz</option>
    </select>
    <label for="altersstufe">Geeignete Altersstufen:</label><br>
    <input type="text" id="altersstufe" name="altersstufe" placeholder="z.B. Sipplinge & Rover, oder: vor allem Wölflinge, etc."><br>
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

    <input type="submit" name="formular" value="Absenden">
</form>

<script>
    jQuery('select#title-predefined').on('change', function() {
        if( this.value === "0" ) {
            // clear fields
            jQuery('input[name=title]').val('');
            jQuery('textarea[name=description]').val('');
            jQuery('input[name=altersstufe]').val('');
            jQuery('input[name=attendees]').val(0);
            jQuery('select[name=event_type]').val(0);
            jQuery('input[name=singinrightnow]').prop('checked', true);
        } else {
            let id = this.value;
            let angebote = <?php echo json_encode($results_sug); ?>;
            let angebot = angebote.find(angebot => angebot.id === id);
            console.log(angebot);
            jQuery('input[name=title]').val(angebot.title);
            jQuery('textarea[name=description]').val(angebot.description);
            jQuery('input[name=altersstufe]').val(angebot.group_type);
            jQuery('input[name=attendees]').val(angebot.attendees);
            jQuery('select[name=event_type]').val(parseInt(angebot.event_type));
            jQuery('input[name=singinrightnow]').prop('checked', true);
            jQuery('input[name=title]').change(function() {
                jQuery('select#title-predefined').val('0');
            })
        }
    });
</script>