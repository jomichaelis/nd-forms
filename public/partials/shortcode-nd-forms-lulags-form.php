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
$results = $wpdb->get_results( 'SELECT * FROM ' . $table . ' ORDER BY title' );
?>
<h2>Mitmachen</h2>
<div class="nd_forms_lulags_form_div" id="nd_forms_lulags_form_div">
    <form action="javascript:void(0);" id="nd_forms_lulags_form">
        <label for="title-predefined">Aktion:</label>
        <select name="title-predefined" id="title-predefined">
            <option value=0>-- eigener Vorschlag --</option>
			<?php
			for($i = 0; $i < count($results_sug); $i++) {
				if( $results_sug[$i]->belegt == 1) {
				 	// echo("<option value=" . $results_sug[$i]->id . " disabled>" . $results_sug[$i]->title . "</option>");
				} else {
				    echo("<option value=" . $results_sug[$i]->id . ">" . $results_sug[$i]->title . "</option>");
				}
			}
			?>
        </select><br>

        <label for="title">Aktion:</label>
        <input type="text" id="title" name="title" placeholder="Kurztitel der Aktion"><br>
        <label for="description">Beschreibung:</label>
        <textarea type="text" id="description" name="description" rows=4 placeholder="Genauere Beschreibung der Aktion"></textarea><br>
        <label for="event_type">Aktionsart:</label>
        <select name="event_type" id="event_type">
            <option value=0>Land & Leute Aktion</option>
            <option value=1>AG am Lagerplatz</option>
        </select><br>
        <label for="altersstufe">Geeignete Altersstufen:</label>
        <input type="text" id="altersstufe" name="altersstufe" placeholder="z.B. Sipplinge & Rover, oder: vor allem Wölflinge, etc."><br>
        <label for="attendees">Maximale Anzahl Teilnehmer*innen: (0 heißt egal)</label>
        <input type="number" id="attendees" name="attendees" value=0 min=0><br>
        <label for="material_notes">Anmerkungen zu Material:</label>
        <textarea type="text" id="material_notes" name="material_notes" rows=4 placeholder="was wird benötigt? Wer besorgt es?"></textarea><br>
        <label for="singinrightnow">Ich möchte diese Aktion betreuen:</label>
        <input type="checkbox" id="singinrightnow" name="singinrightnow" checked="checked"><br>
        <br>
        <div id="personal_information">
            <label for="host_name">Dein Name:</label>
            <input type="text" id="host_name" name="host_name"><br>
            <label for="host_mail">Deine E-Mail-Adresse:</label>
            <input type="text" id="host_mail" name="host_mail"><br>
            <label for="host_stamm">Dein Stamm/Ring:</label>
            <input type="text" id="host_stamm" name="host_stamm"><br>
        </div>
        <div class="error_div">
            <span></span>
        </div>

        <input type="submit" name="formular" value="Absenden">
    </form>
</div>

<script>
    var convertAmpersand = function(str) {
        return str.replace(/&amp;/g, "&").replace(/\\"/g, '"').replace(/\\'/g, "'");
    };

    $('select#title-predefined').on('change', function() {
        if( this.value === "0" ) {
            // clear fields
            $('input[name=title]').val('');
            $('textarea[name=description]').val('');
            $('input[name=altersstufe]').val('');
            $('input[name=attendees]').val(0);
            $('select[name=event_type]').val(0);
            $('textarea[name=material_notes]').val('');
            $('input[name=singinrightnow]').prop('checked', true);
        } else {
            let id = this.value;
            let angebote = <?php echo json_encode($results_sug, JSON_UNESCAPED_UNICODE); ?>;
            let angebot = angebote.find(angebot => angebot.id === id);
            $('input[name=title]').val(convertAmpersand(angebot.title));
            $('textarea[name=description]').val(convertAmpersand(angebot.description));
            $('input[name=altersstufe]').val(convertAmpersand(angebot.altersstufe));
            $('select[name=event_type]').val(parseInt(angebot.event_type));
            $('input[name=attendees]').val(parseInt(angebot.attendees));
            $('textarea[name=material_notes]').val(convertAmpersand(angebot.material_notes));
            $('input[name=singinrightnow]').prop('checked', true);
            $('input[name=title]').change(function() {
                $('select#title-predefined').val('0');
            })
            $('#personal_information').slideDown(400, () => {});
        }
    });

    $(':checkbox[name=singinrightnow]').change(function() {
        if(this.checked) {
            $('#personal_information').slideDown(400, () => {});
        } else {
            $('#personal_information').slideUp(400, () => {});
        }
    });

    $("#nd_forms_lulags_form").change(function() {
        if( $(':checkbox[name=singinrightnow]').is(":checked") === false && parseInt( $('select#title-predefined').val() ) !== 0 ) {
            $("#nd_forms_lulags_form :submit").attr("disabled", true);
        } else {
            $("#nd_forms_lulags_form :submit").attr("disabled", false);
        }
        $('.error_div').css({display: "none"});
    })

    $("#nd_forms_lulags_form").validate({
        rules: {
            title: "required",
            altersstufe: "required",
            attendees: {
                required: true,
                min: 0,
                max: 100
            },
            host_name: {
                required: "#singinrightnow:checked"
            },
            host_mail: {
                required: "#singinrightnow:checked",
                email: true
            },
            host_stamm: {
                required: "#singinrightnow:checked"
            }
        },
        messages: {
            title: "Bitte gib einen aussagekräftigen Titel der Aktion an.",
            altersstufe: "Bitte beschreibe, für welche Altersstufe die Aktion geeignet ist.",
            attendees: {
                required: "Bitte gib an, für wie viele Personen die Aktion maximal geeignet ist.",
                min: "Es müssen mindestens 0 Teilnehmer sein.",
                max: "Mehr als 100? Bist du sicher? Wir halten das für unwahrscheinlich."
            },
            host_name: "Bitte gib deinen Namen an.",
            host_mail: {
                required: "Bitte gib eine E-Mail-Adresse an.",
                email: "Bitte gib eine gültige E-Mail-Adresse an."
            },
            host_stamm: "Bitte gib deinen Stamm mit an."
        },
        submitHandler: function(form) {
            // Contact Form
            var form_div = $('#nd_forms_lulags_form_div');
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    action: 'nd_forms_lulags',
                    title_predefined: parseInt( $('select#title-predefined').val() ),
                    title: $('input[name="title"]', form).val(),
                    description: $('textarea[name=description]', form).val(),
                    altersstufe: $('input[name=altersstufe]', form).val(),
                    attendees: parseInt( $('input[name=attendees]', form).val() ),
                    event_type: parseInt( $('select[name=event_type]', form).val() ),
                    material_notes: $('textarea[name=material_notes]', form).val(),
                    signinrightnow: $('input[name=singinrightnow]', form).prop('checked'),
                    host_name: $('input[name=host_name]', form).val(),
                    host_mail: $('input[name=host_mail]', form).val(),
                    host_stamm: $('input[name=host_stamm]', form).val()
                },
                success: function (data, textStatus, XMLHttpRequest) {
                    $('.loader', form).css('visibility','hidden');
                    console.log(data);
                    if ( data.status === 'error' ) {
                        $('.error_div').css({display: "block"});
                        $('.error_div span').text(data.message);
                    } else if ( data.status === 'success' ) {
                        $('form', form_div).slideUp(400, function(){
                            form_div.append('<div class="success_div"><span class="success">'+data.message+'</span></div>');
                        })
                    }
                }
            });
        }
    });
</script>

<style>
    input[type=submit]:disabled {
        background-color: grey;
        pointer-events: none;
    }
    .error_div {
        background-color: #ff690033;
        border-left: 4px solid orange;
        padding: 2px 5px 2px 5px;
        margin-bottom: 10px;
        display: none;
    }
    label {
        margin-top: 20px;
    }
    .success_div {
        background-color: #00A32A33;
        border-left: 4px solid green;
        padding: 2px 5px 2px 5px;
        margin-bottom: 10px;
    }
</style>