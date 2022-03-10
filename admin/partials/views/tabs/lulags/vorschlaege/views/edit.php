<div class="wrap">
    <h1>Vorschlag bearbeiten</h1>

	<?php $item = _get_LulagsSuggestionRecord( $id ); ?>
    <form action="" method="post">

        <table class="form-table">
            <tbody>
                <tr class="row-published">
                    <th scope="row">
                        <label for="published">Öffentlich</label>
                    </th>
                    <td>
                        <select name="published" id="published">
                            <option value=0 <?php selected( $item->published, '0' ); ?>>Nein</option>
                            <option value=1 <?php selected( $item->published, '1' ); ?>>Ja</option>
                        </select>
                    </td>
                </tr>
                <tr class="row-title">
                    <th scope="row">
                        <label for="title">Titel*</label>
                    </th>
                    <td>
                        <input type="text" name="title" id="title" class="regular-text" value="<?php echo stripslashes( esc_attr( $item->title ) ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description">Beschreibung</label>
                    </th>
                    <td>
                        <textarea name="description" id="description" rows="3" cols="30" ><?php echo stripslashes( esc_attr( $item->description ) ); ?></textarea>
                    </td>
                </tr>
                <tr class="row-event-type">
                    <th scope="row">
                        <label for="event_type">Angebots-Typ</label>
                    </th>
                    <td>
                        <select name="event_type" id="event_type" value=<?php echo stripslashes( esc_attr( $item->event_type ) ); ?>>
                            <option value=0 <?php selected( $item->event_type, '0' ); ?>>Land & Leute Aktion</option>
                            <option value=1 <?php selected( $item->event_type, '1' ); ?>>AG am Lagerplatz</option>
                        </select>
                    </td>
                </tr>
                <tr class="row-group-type">
                    <th scope="row">
                        <label for="group_type">Altersgruppe</label>
                    </th>
                    <td>
                        <input type="text" name="group_type" id="group_type" class="regular-text" placeholder="z.B. Sipplinge, Rover" value="<?php echo esc_attr( $item->group_type ); ?>" />
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

		<?php wp_nonce_field( 'nd_forms_lulags_suggestion' ); ?>
		<?php submit_button( 'Speichern', 'primary', 'nd_forms_lulags_suggestion_action' ); ?>

    </form>
</div>