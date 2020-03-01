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
$sms_template_view = new sms_template_view();

// Run the page
$sms_template_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_template_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_template_view->isExport()) { ?>
<script>
var fsms_templateview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsms_templateview = currentForm = new ew.Form("fsms_templateview", "view");
	loadjs.done("fsms_templateview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_template_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sms_template_view->ExportOptions->render("body") ?>
<?php $sms_template_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sms_template_view->showPageHeader(); ?>
<?php
$sms_template_view->showMessage();
?>
<form name="fsms_templateview" id="fsms_templateview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_template">
<input type="hidden" name="modal" value="<?php echo (int)$sms_template_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sms_template_view->sms_temp_id->Visible) { // sms_temp_id ?>
	<tr id="r_sms_temp_id">
		<td class="<?php echo $sms_template_view->TableLeftColumnClass ?>"><span id="elh_sms_template_sms_temp_id"><?php echo $sms_template_view->sms_temp_id->caption() ?></span></td>
		<td data-name="sms_temp_id" <?php echo $sms_template_view->sms_temp_id->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_id">
<span<?php echo $sms_template_view->sms_temp_id->viewAttributes() ?>><?php echo $sms_template_view->sms_temp_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_template_view->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
	<tr id="r_sms_temp_branch_id">
		<td class="<?php echo $sms_template_view->TableLeftColumnClass ?>"><span id="elh_sms_template_sms_temp_branch_id"><?php echo $sms_template_view->sms_temp_branch_id->caption() ?></span></td>
		<td data-name="sms_temp_branch_id" <?php echo $sms_template_view->sms_temp_branch_id->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_branch_id">
<span<?php echo $sms_template_view->sms_temp_branch_id->viewAttributes() ?>><?php echo $sms_template_view->sms_temp_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_template_view->sms_temp_caption->Visible) { // sms_temp_caption ?>
	<tr id="r_sms_temp_caption">
		<td class="<?php echo $sms_template_view->TableLeftColumnClass ?>"><span id="elh_sms_template_sms_temp_caption"><?php echo $sms_template_view->sms_temp_caption->caption() ?></span></td>
		<td data-name="sms_temp_caption" <?php echo $sms_template_view->sms_temp_caption->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_caption">
<span<?php echo $sms_template_view->sms_temp_caption->viewAttributes() ?>><?php echo $sms_template_view->sms_temp_caption->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_template_view->sms_temp_msg->Visible) { // sms_temp_msg ?>
	<tr id="r_sms_temp_msg">
		<td class="<?php echo $sms_template_view->TableLeftColumnClass ?>"><span id="elh_sms_template_sms_temp_msg"><?php echo $sms_template_view->sms_temp_msg->caption() ?></span></td>
		<td data-name="sms_temp_msg" <?php echo $sms_template_view->sms_temp_msg->cellAttributes() ?>>
<span id="el_sms_template_sms_temp_msg">
<span<?php echo $sms_template_view->sms_temp_msg->viewAttributes() ?>><?php echo $sms_template_view->sms_temp_msg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sms_template_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_template_view->isExport()) { ?>
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
$sms_template_view->terminate();
?>