<?php
namespace PHPMaker2020\dexdevs_crm;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tehsil_view = new tehsil_view();

// Run the page
$tehsil_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tehsil_view->isExport()) { ?>
<script>
var ftehsilview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ftehsilview = currentForm = new ew.Form("ftehsilview", "view");
	loadjs.done("ftehsilview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tehsil_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tehsil_view->ExportOptions->render("body") ?>
<?php $tehsil_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tehsil_view->showPageHeader(); ?>
<?php
$tehsil_view->showMessage();
?>
<?php if (!$tehsil_view->IsModal) { ?>
<?php if (!$tehsil_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tehsil_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftehsilview" id="ftehsilview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tehsil">
<input type="hidden" name="modal" value="<?php echo (int)$tehsil_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tehsil_view->tehsil_id->Visible) { // tehsil_id ?>
	<tr id="r_tehsil_id">
		<td class="<?php echo $tehsil_view->TableLeftColumnClass ?>"><span id="elh_tehsil_tehsil_id"><?php echo $tehsil_view->tehsil_id->caption() ?></span></td>
		<td data-name="tehsil_id" <?php echo $tehsil_view->tehsil_id->cellAttributes() ?>>
<span id="el_tehsil_tehsil_id">
<span<?php echo $tehsil_view->tehsil_id->viewAttributes() ?>><?php echo $tehsil_view->tehsil_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tehsil_view->tehsil_district_id->Visible) { // tehsil_district_id ?>
	<tr id="r_tehsil_district_id">
		<td class="<?php echo $tehsil_view->TableLeftColumnClass ?>"><span id="elh_tehsil_tehsil_district_id"><?php echo $tehsil_view->tehsil_district_id->caption() ?></span></td>
		<td data-name="tehsil_district_id" <?php echo $tehsil_view->tehsil_district_id->cellAttributes() ?>>
<span id="el_tehsil_tehsil_district_id">
<span<?php echo $tehsil_view->tehsil_district_id->viewAttributes() ?>><?php echo $tehsil_view->tehsil_district_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tehsil_view->tehsil_name->Visible) { // tehsil_name ?>
	<tr id="r_tehsil_name">
		<td class="<?php echo $tehsil_view->TableLeftColumnClass ?>"><span id="elh_tehsil_tehsil_name"><?php echo $tehsil_view->tehsil_name->caption() ?></span></td>
		<td data-name="tehsil_name" <?php echo $tehsil_view->tehsil_name->cellAttributes() ?>>
<span id="el_tehsil_tehsil_name">
<span<?php echo $tehsil_view->tehsil_name->viewAttributes() ?>><?php echo $tehsil_view->tehsil_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tehsil_view->IsModal) { ?>
<?php if (!$tehsil_view->isExport()) { ?>
<?php echo $tehsil_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$tehsil_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tehsil_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$tehsil_view->terminate();
?>