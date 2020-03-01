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
$services_view = new services_view();

// Run the page
$services_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$services_view->isExport()) { ?>
<script>
var fservicesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fservicesview = currentForm = new ew.Form("fservicesview", "view");
	loadjs.done("fservicesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$services_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $services_view->ExportOptions->render("body") ?>
<?php $services_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $services_view->showPageHeader(); ?>
<?php
$services_view->showMessage();
?>
<?php if (!$services_view->IsModal) { ?>
<?php if (!$services_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fservicesview" id="fservicesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services">
<input type="hidden" name="modal" value="<?php echo (int)$services_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($services_view->service_id->Visible) { // service_id ?>
	<tr id="r_service_id">
		<td class="<?php echo $services_view->TableLeftColumnClass ?>"><span id="elh_services_service_id"><?php echo $services_view->service_id->caption() ?></span></td>
		<td data-name="service_id" <?php echo $services_view->service_id->cellAttributes() ?>>
<span id="el_services_service_id">
<span<?php echo $services_view->service_id->viewAttributes() ?>><?php echo $services_view->service_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_view->service_branch_id->Visible) { // service_branch_id ?>
	<tr id="r_service_branch_id">
		<td class="<?php echo $services_view->TableLeftColumnClass ?>"><span id="elh_services_service_branch_id"><?php echo $services_view->service_branch_id->caption() ?></span></td>
		<td data-name="service_branch_id" <?php echo $services_view->service_branch_id->cellAttributes() ?>>
<span id="el_services_service_branch_id">
<span<?php echo $services_view->service_branch_id->viewAttributes() ?>><?php echo $services_view->service_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_view->service_caption->Visible) { // service_caption ?>
	<tr id="r_service_caption">
		<td class="<?php echo $services_view->TableLeftColumnClass ?>"><span id="elh_services_service_caption"><?php echo $services_view->service_caption->caption() ?></span></td>
		<td data-name="service_caption" <?php echo $services_view->service_caption->cellAttributes() ?>>
<span id="el_services_service_caption">
<span<?php echo $services_view->service_caption->viewAttributes() ?>><?php echo $services_view->service_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_view->service_desc->Visible) { // service_desc ?>
	<tr id="r_service_desc">
		<td class="<?php echo $services_view->TableLeftColumnClass ?>"><span id="elh_services_service_desc"><?php echo $services_view->service_desc->caption() ?></span></td>
		<td data-name="service_desc" <?php echo $services_view->service_desc->cellAttributes() ?>>
<span id="el_services_service_desc">
<span<?php echo $services_view->service_desc->viewAttributes() ?>><?php echo $services_view->service_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_view->service_logo->Visible) { // service_logo ?>
	<tr id="r_service_logo">
		<td class="<?php echo $services_view->TableLeftColumnClass ?>"><span id="elh_services_service_logo"><?php echo $services_view->service_logo->caption() ?></span></td>
		<td data-name="service_logo" <?php echo $services_view->service_logo->cellAttributes() ?>>
<span id="el_services_service_logo">
<span><?php echo GetFileViewTag($services_view->service_logo, $services_view->service_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$services_view->IsModal) { ?>
<?php if (!$services_view->isExport()) { ?>
<?php echo $services_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$services_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$services_view->isExport()) { ?>
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
$services_view->terminate();
?>