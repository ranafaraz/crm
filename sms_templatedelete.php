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
$sms_template_delete = new sms_template_delete();

// Run the page
$sms_template_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_template_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_templatedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsms_templatedelete = currentForm = new ew.Form("fsms_templatedelete", "delete");
	loadjs.done("fsms_templatedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_template_delete->showPageHeader(); ?>
<?php
$sms_template_delete->showMessage();
?>
<form name="fsms_templatedelete" id="fsms_templatedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_template">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sms_template_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sms_template_delete->sms_temp_id->Visible) { // sms_temp_id ?>
		<th class="<?php echo $sms_template_delete->sms_temp_id->headerCellClass() ?>"><span id="elh_sms_template_sms_temp_id" class="sms_template_sms_temp_id"><?php echo $sms_template_delete->sms_temp_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_template_delete->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
		<th class="<?php echo $sms_template_delete->sms_temp_branch_id->headerCellClass() ?>"><span id="elh_sms_template_sms_temp_branch_id" class="sms_template_sms_temp_branch_id"><?php echo $sms_template_delete->sms_temp_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_template_delete->sms_temp_caption->Visible) { // sms_temp_caption ?>
		<th class="<?php echo $sms_template_delete->sms_temp_caption->headerCellClass() ?>"><span id="elh_sms_template_sms_temp_caption" class="sms_template_sms_temp_caption"><?php echo $sms_template_delete->sms_temp_caption->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sms_template_delete->RecordCount = 0;
$i = 0;
while (!$sms_template_delete->Recordset->EOF) {
	$sms_template_delete->RecordCount++;
	$sms_template_delete->RowCount++;

	// Set row properties
	$sms_template->resetAttributes();
	$sms_template->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sms_template_delete->loadRowValues($sms_template_delete->Recordset);

	// Render row
	$sms_template_delete->renderRow();
?>
	<tr <?php echo $sms_template->rowAttributes() ?>>
<?php if ($sms_template_delete->sms_temp_id->Visible) { // sms_temp_id ?>
		<td <?php echo $sms_template_delete->sms_temp_id->cellAttributes() ?>>
<span id="el<?php echo $sms_template_delete->RowCount ?>_sms_template_sms_temp_id" class="sms_template_sms_temp_id">
<span<?php echo $sms_template_delete->sms_temp_id->viewAttributes() ?>><?php echo $sms_template_delete->sms_temp_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_template_delete->sms_temp_branch_id->Visible) { // sms_temp_branch_id ?>
		<td <?php echo $sms_template_delete->sms_temp_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_template_delete->RowCount ?>_sms_template_sms_temp_branch_id" class="sms_template_sms_temp_branch_id">
<span<?php echo $sms_template_delete->sms_temp_branch_id->viewAttributes() ?>><?php echo $sms_template_delete->sms_temp_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_template_delete->sms_temp_caption->Visible) { // sms_temp_caption ?>
		<td <?php echo $sms_template_delete->sms_temp_caption->cellAttributes() ?>>
<span id="el<?php echo $sms_template_delete->RowCount ?>_sms_template_sms_temp_caption" class="sms_template_sms_temp_caption">
<span<?php echo $sms_template_delete->sms_temp_caption->viewAttributes() ?>><?php echo $sms_template_delete->sms_temp_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sms_template_delete->Recordset->moveNext();
}
$sms_template_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_template_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sms_template_delete->showPageFooter();
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
$sms_template_delete->terminate();
?>