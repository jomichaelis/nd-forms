<div class="wrap">
    <h1>Angebot bearbeiten</h1>

	<?php $item = _get_LulagsRecord( $id ); ?>
    <form action="" method="post">

        <table class="form-table">
            <tbody>
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
                <tr class="row-altersstufe">
                    <th scope="row">
                        <label for="altersstufe">Altersgruppe</label>
                    </th>
                    <td>
                        <input type="text" name="altersstufe" id="altersstufe" class="regular-text" placeholder="z.B. Sipplinge, Rover" value="<?php echo esc_attr( $item->altersstufe ); ?>" />
                    </td>
                </tr>
                <tr class="row-attendees">
                    <th scope="row">
                        <label for="attendees">TN-Anzahl</label>
                    </th>
                    <td>
                        <input type="number" name="attendees" id="attendees" value=<?php echo stripslashes( esc_attr( $item->attendees ) ); ?> min=0 />
                    </td>
                </tr>
                <tr class="row-host-name">
                    <th scope="row">
                        <label for="host_name">Host Name</label>
                    </th>
                    <td>
                        <input type="text" name="host_name" id="host_name" class="regular-text" value="<?php echo stripslashes( esc_attr( $item->host_name ) ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-host-mail">
                    <th scope="row">
                        <label for="host_mail">Host E-Mail</label>
                    </th>
                    <td>
                        <input type="email" name="host_mail" id="host_mail" class="regular-text" value="<?php echo stripslashes( esc_attr( $item->host_mail ) ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-host-stamm">
                    <th scope="row">
                        <label for="host_stamm">Host Stamm</label>
                    </th>
                    <td>
                        <input type="text" name="host_stamm" id="host_stamm" class="regular-text" value="<?php echo stripslashes( esc_attr( $item->host_stamm ) ); ?>" required="required" />
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

		<?php wp_nonce_field( 'nd_forms_lulags' ); ?>
		<?php submit_button( 'Speichern', 'primary', 'nd_forms_lulags_action' ); ?>

    </form>
</div>