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
$cus_support_delete = new cus_support_delete();

// Run the page
$cus_support_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cus_support_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcus_supportdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcus_supportdelete = currentForm = new ew.Form("fcus_supportdelete", "delete");
	loadjs.done("fcus_supportdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cus_support_delete->showPageHeader(); ?>
<?php
$cus_support_delete->showMessage();
?>
<form name="fcus_supportdelete" id="fcus_supportdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cus_support">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cus_support_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cus_support_delete->cus_sup_id->Visible) { // cus_sup_id ?>
		<th class="<?php echo $cus_support_delete->cus_sup_id->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_id" class="cus_support_cus_sup_id"><?php echo $cus_support_delete->cus_sup_id->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
		<th class="<?php echo $cus_support_delete->cus_sup_branch_id->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_branch_id" class="cus_support_cus_sup_branch_id"><?php echo $cus_support_delete->cus_sup_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
		<th class="<?php echo $cus_support_delete->cus_sup_emp_id->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_emp_id" class="cus_support_cus_sup_emp_id"><?php echo $cus_support_delete->cus_sup_emp_id->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_query->Visible) { // cus_sup_query ?>
		<th class="<?php echo $cus_support_delete->cus_sup_query->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_query" class="cus_support_cus_sup_query"><?php echo $cus_support_delete->cus_sup_query->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_date->Visible) { // cus_sup_date ?>
		<th class="<?php echo $cus_support_delete->cus_sup_date->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_date" class="cus_support_cus_sup_date"><?php echo $cus_support_delete->cus_sup_date->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_status->Visible) { // cus_sup_status ?>
		<th class="<?php echo $cus_support_delete->cus_sup_status->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_status" class="cus_support_cus_sup_status"><?php echo $cus_support_delete->cus_sup_status->caption() ?></span></th>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
		<th class="<?php echo $cus_support_delete->cus_sup_resolved_on->headerCellClass() ?>"><span id="elh_cus_support_cus_sup_resolved_on" class="cus_support_cus_sup_resolved_on"><?php echo $cus_support_delete->cus_sup_resolved_on->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cus_support_delete->RecordCount = 0;
$i = 0;
while (!$cus_support_delete->Recordset->EOF) {
	$cus_support_delete->RecordCount++;
	$cus_support_delete->RowCount++;

	// Set row properties
	$cus_support->resetAttributes();
	$cus_support->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cus_support_delete->loadRowValues($cus_support_delete->Recordset);

	// Render row
	$cus_support_delete->renderRow();
?>
	<tr <?php echo $cus_support->rowAttributes() ?>>
<?php if ($cus_support_delete->cus_sup_id->Visible) { // cus_sup_id ?>
		<td <?php echo $cus_support_delete->cus_sup_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_id" class="cus_support_cus_sup_id">
<span<?php echo $cus_support_delete->cus_sup_id->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_branch_id->Visible) { // cus_sup_branch_id ?>
		<td <?php echo $cus_support_delete->cus_sup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_branch_id" class="cus_support_cus_sup_branch_id">
<span<?php echo $cus_support_delete->cus_sup_branch_id->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_emp_id->Visible) { // cus_sup_emp_id ?>
		<td <?php echo $cus_support_delete->cus_sup_emp_id->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_emp_id" class="cus_support_cus_sup_emp_id">
<span<?php echo $cus_support_delete->cus_sup_emp_id->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_emp_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_query->Visible) { // cus_sup_query ?>
		<td <?php echo $cus_support_delete->cus_sup_query->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_query" class="cus_support_cus_sup_query">
<span<?php echo $cus_support_delete->cus_sup_query->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_query->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_date->Visible) { // cus_sup_date ?>
		<td <?php echo $cus_support_delete->cus_sup_date->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_date" class="cus_support_cus_sup_date">
<span<?php echo $cus_support_delete->cus_sup_date->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_status->Visible) { // cus_sup_status ?>
		<td <?php echo $cus_support_delete->cus_sup_status->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_status" class="cus_support_cus_sup_status">
<span<?php echo $cus_support_delete->cus_sup_status->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cus_support_delete->cus_sup_resolved_on->Visible) { // cus_sup_resolved_on ?>
		<td <?php echo $cus_support_delete->cus_sup_resolved_on->cellAttributes() ?>>
<span id="el<?php echo $cus_support_delete->RowCount ?>_cus_support_cus_sup_resolved_on" class="cus_support_cus_sup_resolved_on">
<span<?php echo $cus_support_delete->cus_sup_resolved_on->viewAttributes() ?>><?php echo $cus_support_delete->cus_sup_resolved_on->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cus_support_delete->Recordset->moveNext();
}
$cus_support_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cus_support_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cus_support_delete->showPageFooter();
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
$cus_support_delete->terminate();
?>