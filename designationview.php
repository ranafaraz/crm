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
$designation_view = new designation_view();

// Run the page
$designation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$designation_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$designation_view->isExport()) { ?>
<script>
var fdesignationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdesignationview = currentForm = new ew.Form("fdesignationview", "view");
	loadjs.done("fdesignationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$designation_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $designation_view->ExportOptions->render("body") ?>
<?php $designation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $designation_view->showPageHeader(); ?>
<?php
$designation_view->showMessage();
?>
<?php if (!$designation_view->IsModal) { ?>
<?php if (!$designation_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $designation_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fdesignationview" id="fdesignationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="designation">
<input type="hidden" name="modal" value="<?php echo (int)$designation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($designation_view->designation_id->Visible) { // designation_id ?>
	<tr id="r_designation_id">
		<td class="<?php echo $designation_view->TableLeftColumnClass ?>"><span id="elh_designation_designation_id"><?php echo $designation_view->designation_id->caption() ?></span></td>
		<td data-name="designation_id" <?php echo $designation_view->designation_id->cellAttributes() ?>>
<span id="el_designation_designation_id">
<span<?php echo $designation_view->designation_id->viewAttributes() ?>><?php echo $designation_view->designation_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($designation_view->designation_caption->Visible) { // designation_caption ?>
	<tr id="r_designation_caption">
		<td class="<?php echo $designation_view->TableLeftColumnClass ?>"><span id="elh_designation_designation_caption"><?php echo $designation_view->designation_caption->caption() ?></span></td>
		<td data-name="designation_caption" <?php echo $designation_view->designation_caption->cellAttributes() ?>>
<span id="el_designation_designation_caption">
<span<?php echo $designation_view->designation_caption->viewAttributes() ?>><?php echo $designation_view->designation_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($designation_view->designation_desc->Visible) { // designation_desc ?>
	<tr id="r_designation_desc">
		<td class="<?php echo $designation_view->TableLeftColumnClass ?>"><span id="elh_designation_designation_desc"><?php echo $designation_view->designation_desc->caption() ?></span></td>
		<td data-name="designation_desc" <?php echo $designation_view->designation_desc->cellAttributes() ?>>
<span id="el_designation_designation_desc">
<span<?php echo $designation_view->designation_desc->viewAttributes() ?>><?php echo $designation_view->designation_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$designation_view->IsModal) { ?>
<?php if (!$designation_view->isExport()) { ?>
<?php echo $designation_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$designation_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$designation_view->isExport()) { ?>
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
$designation_view->terminate();
?>