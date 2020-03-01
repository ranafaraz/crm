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
$sms_log_view = new sms_log_view();

// Run the page
$sms_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_log_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_log_view->isExport()) { ?>
<script>
var fsms_logview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsms_logview = currentForm = new ew.Form("fsms_logview", "view");
	loadjs.done("fsms_logview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_log_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sms_log_view->ExportOptions->render("body") ?>
<?php $sms_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sms_log_view->showPageHeader(); ?>
<?php
$sms_log_view->showMessage();
?>
<?php if (!$sms_log_view->IsModal) { ?>
<?php if (!$sms_log_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sms_log_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fsms_logview" id="fsms_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_log">
<input type="hidden" name="modal" value="<?php echo (int)$sms_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sms_log_view->sms_log_id->Visible) { // sms_log_id ?>
	<tr id="r_sms_log_id">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_id"><?php echo $sms_log_view->sms_log_id->caption() ?></span></td>
		<td data-name="sms_log_id" <?php echo $sms_log_view->sms_log_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_id">
<span<?php echo $sms_log_view->sms_log_id->viewAttributes() ?>><?php echo $sms_log_view->sms_log_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_log_view->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
	<tr id="r_sms_log_branch_id">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_branch_id"><?php echo $sms_log_view->sms_log_branch_id->caption() ?></span></td>
		<td data-name="sms_log_branch_id" <?php echo $sms_log_view->sms_log_branch_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_branch_id">
<span<?php echo $sms_log_view->sms_log_branch_id->viewAttributes() ?>><?php echo $sms_log_view->sms_log_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_log_view->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
	<tr id="r_sms_log_sms_api_id">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_sms_api_id"><?php echo $sms_log_view->sms_log_sms_api_id->caption() ?></span></td>
		<td data-name="sms_log_sms_api_id" <?php echo $sms_log_view->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el_sms_log_sms_log_sms_api_id">
<span<?php echo $sms_log_view->sms_log_sms_api_id->viewAttributes() ?>><?php echo $sms_log_view->sms_log_sms_api_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_log_view->sms_log_message->Visible) { // sms_log_message ?>
	<tr id="r_sms_log_message">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_message"><?php echo $sms_log_view->sms_log_message->caption() ?></span></td>
		<td data-name="sms_log_message" <?php echo $sms_log_view->sms_log_message->cellAttributes() ?>>
<span id="el_sms_log_sms_log_message">
<span<?php echo $sms_log_view->sms_log_message->viewAttributes() ?>><?php echo $sms_log_view->sms_log_message->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_log_view->sms_log_to->Visible) { // sms_log_to ?>
	<tr id="r_sms_log_to">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_to"><?php echo $sms_log_view->sms_log_to->caption() ?></span></td>
		<td data-name="sms_log_to" <?php echo $sms_log_view->sms_log_to->cellAttributes() ?>>
<span id="el_sms_log_sms_log_to">
<span<?php echo $sms_log_view->sms_log_to->viewAttributes() ?>><?php echo $sms_log_view->sms_log_to->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_log_view->sms_log_date->Visible) { // sms_log_date ?>
	<tr id="r_sms_log_date">
		<td class="<?php echo $sms_log_view->TableLeftColumnClass ?>"><span id="elh_sms_log_sms_log_date"><?php echo $sms_log_view->sms_log_date->caption() ?></span></td>
		<td data-name="sms_log_date" <?php echo $sms_log_view->sms_log_date->cellAttributes() ?>>
<span id="el_sms_log_sms_log_date">
<span<?php echo $sms_log_view->sms_log_date->viewAttributes() ?>><?php echo $sms_log_view->sms_log_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$sms_log_view->IsModal) { ?>
<?php if (!$sms_log_view->isExport()) { ?>
<?php echo $sms_log_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$sms_log_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_log_view->isExport()) { ?>
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
$sms_log_view->terminate();
?>