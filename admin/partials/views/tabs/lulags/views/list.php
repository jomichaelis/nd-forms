<div class="wrap">
    <h2>Alle Land & Leute- und AG-Angebote<a href="<?php echo admin_url( 'admin.php?page=nd-forms&tab=lulags&action=new' ); ?>" class="add-new-h2">Erstellen</a></h2>

    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

		<?php
		$list_table = new ND_Forms_Lulags_List();
		$list_table->prepare_items();
		// $list_table->search_box( 'Suche', 'search_id' );
		$list_table->display();
		?>
    </form>

    <style>
        .wp-list-table .column-status { width: 5%; }
        .wp-list-table .column-published { width: 7%; }
    </style>
</div>