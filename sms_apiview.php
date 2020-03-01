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
$sms_api_view = new sms_api_view();

// Run the page
$sms_api_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_api_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sms_api_view->isExport()) { ?>
<script>
var fsms_apiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fsms_apiview = currentForm = new ew.Form("fsms_apiview", "view");
	loadjs.done("fsms_apiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$sms_api_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $sms_api_view->ExportOptions->render("body") ?>
<?php $sms_api_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $sms_api_view->showPageHeader(); ?>
<?php
$sms_api_view->showMessage();
?>
<form name="fsms_apiview" id="fsms_apiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_api">
<input type="hidden" name="modal" value="<?php echo (int)$sms_api_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($sms_api_view->sms_api_id->Visible) { // sms_api_id ?>
	<tr id="r_sms_api_id">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_id"><?php echo $sms_api_view->sms_api_id->caption() ?></span></td>
		<td data-name="sms_api_id" <?php echo $sms_api_view->sms_api_id->cellAttributes() ?>>
<span id="el_sms_api_sms_api_id">
<span<?php echo $sms_api_view->sms_api_id->viewAttributes() ?>><?php echo $sms_api_view->sms_api_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_user->Visible) { // sms_api_user ?>
	<tr id="r_sms_api_user">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_user"><?php echo $sms_api_view->sms_api_user->caption() ?></span></td>
		<td data-name="sms_api_user" <?php echo $sms_api_view->sms_api_user->cellAttributes() ?>>
<span id="el_sms_api_sms_api_user">
<span<?php echo $sms_api_view->sms_api_user->viewAttributes() ?>><?php echo $sms_api_view->sms_api_user->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_pass->Visible) { // sms_api_pass ?>
	<tr id="r_sms_api_pass">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_pass"><?php echo $sms_api_view->sms_api_pass->caption() ?></span></td>
		<td data-name="sms_api_pass" <?php echo $sms_api_view->sms_api_pass->cellAttributes() ?>>
<span id="el_sms_api_sms_api_pass">
<span<?php echo $sms_api_view->sms_api_pass->viewAttributes() ?>><?php echo $sms_api_view->sms_api_pass->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_url->Visible) { // sms_api_url ?>
	<tr id="r_sms_api_url">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_url"><?php echo $sms_api_view->sms_api_url->caption() ?></span></td>
		<td data-name="sms_api_url" <?php echo $sms_api_view->sms_api_url->cellAttributes() ?>>
<span id="el_sms_api_sms_api_url">
<span<?php echo $sms_api_view->sms_api_url->viewAttributes() ?>><?php echo $sms_api_view->sms_api_url->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_mask->Visible) { // sms_api_mask ?>
	<tr id="r_sms_api_mask">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_mask"><?php echo $sms_api_view->sms_api_mask->caption() ?></span></td>
		<td data-name="sms_api_mask" <?php echo $sms_api_view->sms_api_mask->cellAttributes() ?>>
<span id="el_sms_api_sms_api_mask">
<span<?php echo $sms_api_view->sms_api_mask->viewAttributes() ?>><?php echo $sms_api_view->sms_api_mask->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_reg_date->Visible) { // sms_api_reg_date ?>
	<tr id="r_sms_api_reg_date">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_reg_date"><?php echo $sms_api_view->sms_api_reg_date->caption() ?></span></td>
		<td data-name="sms_api_reg_date" <?php echo $sms_api_view->sms_api_reg_date->cellAttributes() ?>>
<span id="el_sms_api_sms_api_reg_date">
<span<?php echo $sms_api_view->sms_api_reg_date->viewAttributes() ?>><?php echo $sms_api_view->sms_api_reg_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_expiry_date->Visible) { // sms_api_expiry_date ?>
	<tr id="r_sms_api_expiry_date">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_expiry_date"><?php echo $sms_api_view->sms_api_expiry_date->caption() ?></span></td>
		<td data-name="sms_api_expiry_date" <?php echo $sms_api_view->sms_api_expiry_date->cellAttributes() ?>>
<span id="el_sms_api_sms_api_expiry_date">
<span<?php echo $sms_api_view->sms_api_expiry_date->viewAttributes() ?>><?php echo $sms_api_view->sms_api_expiry_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($sms_api_view->sms_api_total_sms->Visible) { // sms_api_total_sms ?>
	<tr id="r_sms_api_total_sms">
		<td class="<?php echo $sms_api_view->TableLeftColumnClass ?>"><span id="elh_sms_api_sms_api_total_sms"><?php echo $sms_api_view->sms_api_total_sms->caption() ?></span></td>
		<td data-name="sms_api_total_sms" <?php echo $sms_api_view->sms_api_total_sms->cellAttributes() ?>>
<span id="el_sms_api_sms_api_total_sms">
<span<?php echo $sms_api_view->sms_api_total_sms->viewAttributes() ?>><?php echo $sms_api_view->sms_api_total_sms->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$sms_api_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sms_api_view->isExport()) { ?>
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
$sms_api_view->terminate();
?>