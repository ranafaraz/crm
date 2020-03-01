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
$division_view = new division_view();

// Run the page
$division_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$division_view->isExport()) { ?>
<script>
var fdivisionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdivisionview = currentForm = new ew.Form("fdivisionview", "view");
	loadjs.done("fdivisionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$division_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $division_view->ExportOptions->render("body") ?>
<?php $division_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $division_view->showPageHeader(); ?>
<?php
$division_view->showMessage();
?>
<?php if (!$division_view->IsModal) { ?>
<?php if (!$division_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $division_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdivisionview" id="fdivisionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="modal" value="<?php echo (int)$division_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($division_view->division_id->Visible) { // division_id ?>
	<tr id="r_division_id">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_division_id"><?php echo $division_view->division_id->caption() ?></span></td>
		<td data-name="division_id" <?php echo $division_view->division_id->cellAttributes() ?>>
<span id="el_division_division_id">
<span<?php echo $division_view->division_id->viewAttributes() ?>><?php echo $division_view->division_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($division_view->division_state_id->Visible) { // division_state_id ?>
	<tr id="r_division_state_id">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_division_state_id"><?php echo $division_view->division_state_id->caption() ?></span></td>
		<td data-name="division_state_id" <?php echo $division_view->division_state_id->cellAttributes() ?>>
<span id="el_division_division_state_id">
<span<?php echo $division_view->division_state_id->viewAttributes() ?>><?php echo $division_view->division_state_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($division_view->division_name->Visible) { // division_name ?>
	<tr id="r_division_name">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_division_name"><?php echo $division_view->division_name->caption() ?></span></td>
		<td data-name="division_name" <?php echo $division_view->division_name->cellAttributes() ?>>
<span id="el_division_division_name">
<span<?php echo $division_view->division_name->viewAttributes() ?>><?php echo $division_view->division_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($division_view->division_desc->Visible) { // division_desc ?>
	<tr id="r_division_desc">
		<td class="<?php echo $division_view->TableLeftColumnClass ?>"><span id="elh_division_division_desc"><?php echo $division_view->division_desc->caption() ?></span></td>
		<td data-name="division_desc" <?php echo $division_view->division_desc->cellAttributes() ?>>
<span id="el_division_division_desc">
<span<?php echo $division_view->division_desc->viewAttributes() ?>><?php echo $division_view->division_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$division_view->IsModal) { ?>
<?php if (!$division_view->isExport()) { ?>
<?php echo $division_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$division_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$division_view->isExport()) { ?>
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
$division_view->terminate();
?>