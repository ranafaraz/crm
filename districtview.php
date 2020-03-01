<?php
namespace PHPMaker2020\crm_live;

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
$district_view = new district_view();

// Run the page
$district_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$district_view->isExport()) { ?>
<script>
var fdistrictview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdistrictview = currentForm = new ew.Form("fdistrictview", "view");
	loadjs.done("fdistrictview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$district_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $district_view->ExportOptions->render("body") ?>
<?php $district_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $district_view->showPageHeader(); ?>
<?php
$district_view->showMessage();
?>
<form name="fdistrictview" id="fdistrictview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="district">
<input type="hidden" name="modal" value="<?php echo (int)$district_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($district_view->district_id->Visible) { // district_id ?>
	<tr id="r_district_id">
		<td class="<?php echo $district_view->TableLeftColumnClass ?>"><span id="elh_district_district_id"><?php echo $district_view->district_id->caption() ?></span></td>
		<td data-name="district_id" <?php echo $district_view->district_id->cellAttributes() ?>>
<span id="el_district_district_id">
<span<?php echo $district_view->district_id->viewAttributes() ?>><?php echo $district_view->district_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($district_view->district_division_id->Visible) { // district_division_id ?>
	<tr id="r_district_division_id">
		<td class="<?php echo $district_view->TableLeftColumnClass ?>"><span id="elh_district_district_division_id"><?php echo $district_view->district_division_id->caption() ?></span></td>
		<td data-name="district_division_id" <?php echo $district_view->district_division_id->cellAttributes() ?>>
<span id="el_district_district_division_id">
<span<?php echo $district_view->district_division_id->viewAttributes() ?>><?php echo $district_view->district_division_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($district_view->district_name->Visible) { // district_name ?>
	<tr id="r_district_name">
		<td class="<?php echo $district_view->TableLeftColumnClass ?>"><span id="elh_district_district_name"><?php echo $district_view->district_name->caption() ?></span></td>
		<td data-name="district_name" <?php echo $district_view->district_name->cellAttributes() ?>>
<span id="el_district_district_name">
<span<?php echo $district_view->district_name->viewAttributes() ?>><?php echo $district_view->district_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$district_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$district_view->isExport()) { ?>
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
$district_view->terminate();
?>