<?php
//Get the active tab from the $_GET param
$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;
$action = isset( $_GET['action'] ) ? $_GET['action'] : '';

?>
<!-- Our admin page content should all be inside .wrap -->
<div class="wrap">
    <h1>Norddeutschland-Forms</h1>
    <!-- Here are our tabs -->
    <nav class="nav-tab-wrapper">
        <a href="?page=nd-forms" class="nav-tab <?php if($tab===null):?>nav-tab-active<?php endif; ?>">Allgemein</a>
        <a href="?page=nd-forms&tab=lulags" class="nav-tab <?php if($tab==='lulags'):?>nav-tab-active<?php endif; ?>">L&L/AGs</a>
        <a href="?page=nd-forms&tab=dpas" class="nav-tab <?php if($tab==='dpas'):?>nav-tab-active<?php endif; ?>">Dorfplatz</a>
        <a href="?page=nd-forms&tab=mbs" class="nav-tab <?php if($tab==='mbs'):?>nav-tab-active<?php endif; ?>">Mittagsangebote</a>
    </nav>

    <div class="tab-content">
		<?php
		switch($tab) :
			case 'lulags':
				include dirname(__FILE__) . '/tabs/lulags/main-view.php';
				break;
			case 'dpas':
				include dirname(__FILE__) . '/tabs/dpas/main-view.php';
				break;
            case 'mbs':
				include dirname(__FILE__) . '/tabs/mbs/main-view.php';
				break;
			default:
				include dirname(__FILE__) . '/tabs/frontpage.php';
				break;
		endswitch; ?>
    </div>
</div>