<?php
//Get the active tab from the $_GET param
$default_subtab = null;
$subtab = isset($_GET['subtab']) ? $_GET['subtab'] : $default_subtab;
$action = isset( $_GET['action'] ) ? $_GET['action'] : '';

?>
<!-- Our admin page content should all be inside .wrap -->
<div class="wrap">
	<h1>Land & Leute Aktionen und AGs</h1>
	<!-- Here are our tabs -->
	<nav class="nav-tab-wrapper">
		<a href="?page=nd-forms&tab=lulags" class="nav-tab <?php if($subtab===null):?>nav-tab-active<?php endif; ?>">Einträge</a>
		<a href="?page=nd-forms&tab=lulags&subtab=vorschlaege" class="nav-tab <?php if($subtab==='vorschlaege'):?>nav-tab-active<?php endif; ?>">Vorschläge</a>
	</nav>

	<div class="tab-content">
		<?php
		switch($subtab) :
			case 'vorschlaege':
				include dirname(__FILE__) . '/vorschlaege/main-view.php';
				break;
			default:
				include dirname(__FILE__) . '/angebote/main-view.php';
				break;
		endswitch; ?>
	</div>
</div>