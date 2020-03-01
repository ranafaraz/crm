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
$sms_api_delete = new sms_api_delete();

// Run the page
$sms_api_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_api_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_apidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsms_apidelete = currentForm = new ew.Form("fsms_apidelete", "delete");
	loadjs.done("fsms_apidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_api_delete->showPageHeader(); ?>
<?php
$sms_api_delete->showMessage();
?>
<form name="fsms_apidelete" id="fsms_apidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_api">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sms_api_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sms_api_delete->sms_api_id->Visible) { // sms_api_id ?>
		<th class="<?php echo $sms_api_delete->sms_api_id->headerCellClass() ?>"><span id="elh_sms_api_sms_api_id" class="sms_api_sms_api_id"><?php echo $sms_api_delete->sms_api_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_user->Visible) { // sms_api_user ?>
		<th class="<?php echo $sms_api_delete->sms_api_user->headerCellClass() ?>"><span id="elh_sms_api_sms_api_user" class="sms_api_sms_api_user"><?php echo $sms_api_delete->sms_api_user->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_pass->Visible) { // sms_api_pass ?>
		<th class="<?php echo $sms_api_delete->sms_api_pass->headerCellClass() ?>"><span id="elh_sms_api_sms_api_pass" class="sms_api_sms_api_pass"><?php echo $sms_api_delete->sms_api_pass->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_url->Visible) { // sms_api_url ?>
		<th class="<?php echo $sms_api_delete->sms_api_url->headerCellClass() ?>"><span id="elh_sms_api_sms_api_url" class="sms_api_sms_api_url"><?php echo $sms_api_delete->sms_api_url->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_mask->Visible) { // sms_api_mask ?>
		<th class="<?php echo $sms_api_delete->sms_api_mask->headerCellClass() ?>"><span id="elh_sms_api_sms_api_mask" class="sms_api_sms_api_mask"><?php echo $sms_api_delete->sms_api_mask->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_reg_date->Visible) { // sms_api_reg_date ?>
		<th class="<?php echo $sms_api_delete->sms_api_reg_date->headerCellClass() ?>"><span id="elh_sms_api_sms_api_reg_date" class="sms_api_sms_api_reg_date"><?php echo $sms_api_delete->sms_api_reg_date->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_expiry_date->Visible) { // sms_api_expiry_date ?>
		<th class="<?php echo $sms_api_delete->sms_api_expiry_date->headerCellClass() ?>"><span id="elh_sms_api_sms_api_expiry_date" class="sms_api_sms_api_expiry_date"><?php echo $sms_api_delete->sms_api_expiry_date->caption() ?></span></th>
<?php } ?>
<?php if ($sms_api_delete->sms_api_total_sms->Visible) { // sms_api_total_sms ?>
		<th class="<?php echo $sms_api_delete->sms_api_total_sms->headerCellClass() ?>"><span id="elh_sms_api_sms_api_total_sms" class="sms_api_sms_api_total_sms"><?php echo $sms_api_delete->sms_api_total_sms->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sms_api_delete->RecordCount = 0;
$i = 0;
while (!$sms_api_delete->Recordset->EOF) {
	$sms_api_delete->RecordCount++;
	$sms_api_delete->RowCount++;

	// Set row properties
	$sms_api->resetAttributes();
	$sms_api->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sms_api_delete->loadRowValues($sms_api_delete->Recordset);

	// Render row
	$sms_api_delete->renderRow();
?>
	<tr <?php echo $sms_api->rowAttributes() ?>>
<?php if ($sms_api_delete->sms_api_id->Visible) { // sms_api_id ?>
		<td <?php echo $sms_api_delete->sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_id" class="sms_api_sms_api_id">
<span<?php echo $sms_api_delete->sms_api_id->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_user->Visible) { // sms_api_user ?>
		<td <?php echo $sms_api_delete->sms_api_user->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_user" class="sms_api_sms_api_user">
<span<?php echo $sms_api_delete->sms_api_user->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_user->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_pass->Visible) { // sms_api_pass ?>
		<td <?php echo $sms_api_delete->sms_api_pass->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_pass" class="sms_api_sms_api_pass">
<span<?php echo $sms_api_delete->sms_api_pass->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_pass->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_url->Visible) { // sms_api_url ?>
		<td <?php echo $sms_api_delete->sms_api_url->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_url" class="sms_api_sms_api_url">
<span<?php echo $sms_api_delete->sms_api_url->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_mask->Visible) { // sms_api_mask ?>
		<td <?php echo $sms_api_delete->sms_api_mask->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_mask" class="sms_api_sms_api_mask">
<span<?php echo $sms_api_delete->sms_api_mask->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_mask->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_reg_date->Visible) { // sms_api_reg_date ?>
		<td <?php echo $sms_api_delete->sms_api_reg_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_reg_date" class="sms_api_sms_api_reg_date">
<span<?php echo $sms_api_delete->sms_api_reg_date->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_reg_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_expiry_date->Visible) { // sms_api_expiry_date ?>
		<td <?php echo $sms_api_delete->sms_api_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_expiry_date" class="sms_api_sms_api_expiry_date">
<span<?php echo $sms_api_delete->sms_api_expiry_date->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_expiry_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_api_delete->sms_api_total_sms->Visible) { // sms_api_total_sms ?>
		<td <?php echo $sms_api_delete->sms_api_total_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_api_delete->RowCount ?>_sms_api_sms_api_total_sms" class="sms_api_sms_api_total_sms">
<span<?php echo $sms_api_delete->sms_api_total_sms->viewAttributes() ?>><?php echo $sms_api_delete->sms_api_total_sms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sms_api_delete->Recordset->moveNext();
}
$sms_api_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_api_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sms_api_delete->showPageFooter();
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
$sms_api_delete->terminate();
?>