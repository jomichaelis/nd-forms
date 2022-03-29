<div class="wrap">
    <h1>Neuen Vorschlag erstellen</h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-published">
                    <th scope="row">
                        <label for="published">Öffentlich</label>
                    </th>
                    <td>
                        <select name="published" id="published">
                            <option value=0>Nein</option>
                            <option value=1>Ja</option>
                        </select>
                    </td>
                </tr>
                <tr class="row-title">
                    <th scope="row">
                        <label for="title">Titel*</label>
                    </th>
                    <td>
                        <input type="text" name="title" id="title" class="regular-text" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description">Beschreibung</label>
                    </th>
                    <td>
                        <textarea name="description" id="description" rows="3" cols="30"></textarea>
                    </td>
                </tr>
                <tr class="row-event-type">
                    <th scope="row">
                        <label for="event_type">Angebots-Typ</label>
                    </th>
                    <td>
                        <select name="event_type" id="event_type">
                            <option value=0>Land & Leute Aktion</option>
                            <option value=1>AG am Lagerplatz</option>
                        </select>
                    </td>
                </tr>
                <tr class="row-attendees">
                    <th scope="row">
                        <label for="attendees">max. TN-Anzahl</label>
                    </th>
                    <td>
                        <input type="number" name="attendees" id="attendees" value=0 min=0 />
                    </td>
                </tr>
                <tr class="row-material_notes">
                    <th scope="row">
                        <label for="material_notes">Anmerkungen zu Material</label>
                    </th>
                    <td>
                        <textarea name="material_notes" id="material_notes" rows="3" cols="30" placeholder="z.B. 10m Seil / 50 Teelichter"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" name="field_id" value="0">

		<?php wp_nonce_field( 'nd_forms_lulags_suggestion' ); ?>
		<?php submit_button( 'Erstellen', 'primary', 'nd_forms_lulags_suggestion_action' ); ?>

    </form>
</div>