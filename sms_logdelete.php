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
$sms_log_delete = new sms_log_delete();

// Run the page
$sms_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_log_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_logdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsms_logdelete = currentForm = new ew.Form("fsms_logdelete", "delete");
	loadjs.done("fsms_logdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_log_delete->showPageHeader(); ?>
<?php
$sms_log_delete->showMessage();
?>
<form name="fsms_logdelete" id="fsms_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sms_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sms_log_delete->sms_log_id->Visible) { // sms_log_id ?>
		<th class="<?php echo $sms_log_delete->sms_log_id->headerCellClass() ?>"><span id="elh_sms_log_sms_log_id" class="sms_log_sms_log_id"><?php echo $sms_log_delete->sms_log_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_log_delete->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
		<th class="<?php echo $sms_log_delete->sms_log_branch_id->headerCellClass() ?>"><span id="elh_sms_log_sms_log_branch_id" class="sms_log_sms_log_branch_id"><?php echo $sms_log_delete->sms_log_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_log_delete->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
		<th class="<?php echo $sms_log_delete->sms_log_sms_api_id->headerCellClass() ?>"><span id="elh_sms_log_sms_log_sms_api_id" class="sms_log_sms_log_sms_api_id"><?php echo $sms_log_delete->sms_log_sms_api_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_log_delete->sms_log_date->Visible) { // sms_log_date ?>
		<th class="<?php echo $sms_log_delete->sms_log_date->headerCellClass() ?>"><span id="elh_sms_log_sms_log_date" class="sms_log_sms_log_date"><?php echo $sms_log_delete->sms_log_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sms_log_delete->RecordCount = 0;
$i = 0;
while (!$sms_log_delete->Recordset->EOF) {
	$sms_log_delete->RecordCount++;
	$sms_log_delete->RowCount++;

	// Set row properties
	$sms_log->resetAttributes();
	$sms_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sms_log_delete->loadRowValues($sms_log_delete->Recordset);

	// Render row
	$sms_log_delete->renderRow();
?>
	<tr <?php echo $sms_log->rowAttributes() ?>>
<?php if ($sms_log_delete->sms_log_id->Visible) { // sms_log_id ?>
		<td <?php echo $sms_log_delete->sms_log_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_delete->RowCount ?>_sms_log_sms_log_id" class="sms_log_sms_log_id">
<span<?php echo $sms_log_delete->sms_log_id->viewAttributes() ?>><?php echo $sms_log_delete->sms_log_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_log_delete->sms_log_branch_id->Visible) { // sms_log_branch_id ?>
		<td <?php echo $sms_log_delete->sms_log_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_delete->RowCount ?>_sms_log_sms_log_branch_id" class="sms_log_sms_log_branch_id">
<span<?php echo $sms_log_delete->sms_log_branch_id->viewAttributes() ?>><?php echo $sms_log_delete->sms_log_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_log_delete->sms_log_sms_api_id->Visible) { // sms_log_sms_api_id ?>
		<td <?php echo $sms_log_delete->sms_log_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_log_delete->RowCount ?>_sms_log_sms_log_sms_api_id" class="sms_log_sms_log_sms_api_id">
<span<?php echo $sms_log_delete->sms_log_sms_api_id->viewAttributes() ?>><?php echo $sms_log_delete->sms_log_sms_api_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_log_delete->sms_log_date->Visible) { // sms_log_date ?>
		<td <?php echo $sms_log_delete->sms_log_date->cellAttributes() ?>>
<span id="el<?php echo $sms_log_delete->RowCount ?>_sms_log_sms_log_date" class="sms_log_sms_log_date">
<span<?php echo $sms_log_delete->sms_log_date->viewAttributes() ?>><?php echo $sms_log_delete->sms_log_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sms_log_delete->Recordset->moveNext();
}
$sms_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sms_log_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$sms_log_delete->terminate();
?>