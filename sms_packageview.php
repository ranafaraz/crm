<?php
namespace PHPMaker2020\project1;

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
$sms_package_view = new sms_package_view();

// Run the page
$sms_package_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_package_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_package_view->isExport()) { ?>
<script>
var fsms_packageview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsms_packageview = currentForm = new ew.Form("fsms_packageview", "view");
	loadjs.done("fsms_packageview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_package_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sms_package_view->ExportOptions->render("body") ?>
<?php $sms_package_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sms_package_view->showPageHeader(); ?>
<?php
$sms_package_view->showMessage();
?>
<form name="fsms_packageview" id="fsms_packageview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_package">
<input type="hidden" name="modal" value="<?php echo (int)$sms_package_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sms_package_view->sms_pkg_id->Visible) { // sms_pkg_id ?>
	<tr id="r_sms_pkg_id">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_id"><?php echo $sms_package_view->sms_pkg_id->caption() ?></span></td>
		<td data-name="sms_pkg_id" <?php echo $sms_package_view->sms_pkg_id->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_id">
<span<?php echo $sms_package_view->sms_pkg_id->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
	<tr id="r_sms_pkg_sms_api_id">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_sms_api_id"><?php echo $sms_package_view->sms_pkg_sms_api_id->caption() ?></span></td>
		<td data-name="sms_pkg_sms_api_id" <?php echo $sms_package_view->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_sms_api_id">
<span<?php echo $sms_package_view->sms_pkg_sms_api_id->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_sms_api_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
	<tr id="r_sms_pkg_branch_id">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_branch_id"><?php echo $sms_package_view->sms_pkg_branch_id->caption() ?></span></td>
		<td data-name="sms_pkg_branch_id" <?php echo $sms_package_view->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_branch_id">
<span<?php echo $sms_package_view->sms_pkg_branch_id->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
	<tr id="r_sms_pkg_total_allowed_sms">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_total_allowed_sms"><?php echo $sms_package_view->sms_pkg_total_allowed_sms->caption() ?></span></td>
		<td data-name="sms_pkg_total_allowed_sms" <?php echo $sms_package_view->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_total_allowed_sms">
<span<?php echo $sms_package_view->sms_pkg_total_allowed_sms->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_total_allowed_sms->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
	<tr id="r_sms_pkg_expiry_date">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_expiry_date"><?php echo $sms_package_view->sms_pkg_expiry_date->caption() ?></span></td>
		<td data-name="sms_pkg_expiry_date" <?php echo $sms_package_view->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_expiry_date">
<span<?php echo $sms_package_view->sms_pkg_expiry_date->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_expiry_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
	<tr id="r_sms_pkg_per_sms_cost">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_per_sms_cost"><?php echo $sms_package_view->sms_pkg_per_sms_cost->caption() ?></span></td>
		<td data-name="sms_pkg_per_sms_cost" <?php echo $sms_package_view->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_per_sms_cost">
<span<?php echo $sms_package_view->sms_pkg_per_sms_cost->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_per_sms_cost->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_package_view->sms_pkg_deal_details->Visible) { // sms_pkg_deal_details ?>
	<tr id="r_sms_pkg_deal_details">
		<td class="<?php echo $sms_package_view->TableLeftColumnClass ?>"><span id="elh_sms_package_sms_pkg_deal_details"><?php echo $sms_package_view->sms_pkg_deal_details->caption() ?></span></td>
		<td data-name="sms_pkg_deal_details" <?php echo $sms_package_view->sms_pkg_deal_details->cellAttributes() ?>>
<span id="el_sms_package_sms_pkg_deal_details">
<span<?php echo $sms_package_view->sms_pkg_deal_details->viewAttributes() ?>><?php echo $sms_package_view->sms_pkg_deal_details->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sms_package_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_package_view->isExport()) { ?>
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
$sms_package_view->terminate();
?>