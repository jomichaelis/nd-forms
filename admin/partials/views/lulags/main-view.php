<?php
//Get the active tab from the $_GET param
$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
$action = isset( $_GET['action'] ) ? $_GET['action'] : '';

?>
<!-- Our admin page content should all be inside .wrap -->
<div class="wrap">
    <h1>Land & Leute Aktionen und AGs</h1>
    <!-- Here are our tabs -->
    <nav class="nav-tab-wrapper">
        <a href="?page=nd-forms-lulags" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Einträge</a>
        <a href="?page=nd-forms-lulags&tab=vorschlaege" class="nav-tab <?php if($tab==='vorschlaege'):?>nav-tab-active<?php endif; ?>">Vorschläge</a>
    </nav>

    <div class="tab-content">
		<?php
		switch($tab) :
			case 'vorschlaege':
				include dirname(__FILE__) . '/vorschlaege/main-view.php';
				break;
			default:
				include dirname(__FILE__) . '/angebote/main-view.php';
				break;
		endswitch; ?>
    </div>
</div>