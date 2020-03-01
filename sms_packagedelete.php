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
$sms_package_delete = new sms_package_delete();

// Run the page
$sms_package_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sms_package_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fsms_packagedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fsms_packagedelete = currentForm = new ew.Form("fsms_packagedelete", "delete");
	loadjs.done("fsms_packagedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $sms_package_delete->showPageHeader(); ?>
<?php
$sms_package_delete->showMessage();
?>
<form name="fsms_packagedelete" id="fsms_packagedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sms_package">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($sms_package_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($sms_package_delete->sms_pkg_id->Visible) { // sms_pkg_id ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_id->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_id" class="sms_package_sms_pkg_id"><?php echo $sms_package_delete->sms_pkg_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_branch_id->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_branch_id" class="sms_package_sms_pkg_branch_id"><?php echo $sms_package_delete->sms_pkg_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_sms_api_id->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_sms_api_id" class="sms_package_sms_pkg_sms_api_id"><?php echo $sms_package_delete->sms_pkg_sms_api_id->caption() ?></span></th>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_total_allowed_sms->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_total_allowed_sms" class="sms_package_sms_pkg_total_allowed_sms"><?php echo $sms_package_delete->sms_pkg_total_allowed_sms->caption() ?></span></th>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_expiry_date->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_expiry_date" class="sms_package_sms_pkg_expiry_date"><?php echo $sms_package_delete->sms_pkg_expiry_date->caption() ?></span></th>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
		<th class="<?php echo $sms_package_delete->sms_pkg_per_sms_cost->headerCellClass() ?>"><span id="elh_sms_package_sms_pkg_per_sms_cost" class="sms_package_sms_pkg_per_sms_cost"><?php echo $sms_package_delete->sms_pkg_per_sms_cost->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$sms_package_delete->RecordCount = 0;
$i = 0;
while (!$sms_package_delete->Recordset->EOF) {
	$sms_package_delete->RecordCount++;
	$sms_package_delete->RowCount++;

	// Set row properties
	$sms_package->resetAttributes();
	$sms_package->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$sms_package_delete->loadRowValues($sms_package_delete->Recordset);

	// Render row
	$sms_package_delete->renderRow();
?>
	<tr <?php echo $sms_package->rowAttributes() ?>>
<?php if ($sms_package_delete->sms_pkg_id->Visible) { // sms_pkg_id ?>
		<td <?php echo $sms_package_delete->sms_pkg_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_id" class="sms_package_sms_pkg_id">
<span<?php echo $sms_package_delete->sms_pkg_id->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_branch_id->Visible) { // sms_pkg_branch_id ?>
		<td <?php echo $sms_package_delete->sms_pkg_branch_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_branch_id" class="sms_package_sms_pkg_branch_id">
<span<?php echo $sms_package_delete->sms_pkg_branch_id->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_sms_api_id->Visible) { // sms_pkg_sms_api_id ?>
		<td <?php echo $sms_package_delete->sms_pkg_sms_api_id->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_sms_api_id" class="sms_package_sms_pkg_sms_api_id">
<span<?php echo $sms_package_delete->sms_pkg_sms_api_id->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_sms_api_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_total_allowed_sms->Visible) { // sms_pkg_total_allowed_sms ?>
		<td <?php echo $sms_package_delete->sms_pkg_total_allowed_sms->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_total_allowed_sms" class="sms_package_sms_pkg_total_allowed_sms">
<span<?php echo $sms_package_delete->sms_pkg_total_allowed_sms->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_total_allowed_sms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_expiry_date->Visible) { // sms_pkg_expiry_date ?>
		<td <?php echo $sms_package_delete->sms_pkg_expiry_date->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_expiry_date" class="sms_package_sms_pkg_expiry_date">
<span<?php echo $sms_package_delete->sms_pkg_expiry_date->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_expiry_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($sms_package_delete->sms_pkg_per_sms_cost->Visible) { // sms_pkg_per_sms_cost ?>
		<td <?php echo $sms_package_delete->sms_pkg_per_sms_cost->cellAttributes() ?>>
<span id="el<?php echo $sms_package_delete->RowCount ?>_sms_package_sms_pkg_per_sms_cost" class="sms_package_sms_pkg_per_sms_cost">
<span<?php echo $sms_package_delete->sms_pkg_per_sms_cost->viewAttributes() ?>><?php echo $sms_package_delete->sms_pkg_per_sms_cost->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$sms_package_delete->Recordset->moveNext();
}
$sms_package_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $sms_package_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$sms_package_delete->showPageFooter();
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
$sms_package_delete->terminate();
?>