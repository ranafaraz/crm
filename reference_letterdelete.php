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
$reference_letter_delete = new reference_letter_delete();

// Run the page
$reference_letter_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reference_letter_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freference_letterdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	freference_letterdelete = currentForm = new ew.Form("freference_letterdelete", "delete");
	loadjs.done("freference_letterdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reference_letter_delete->showPageHeader(); ?>
<?php
$reference_letter_delete->showMessage();
?>
<form name="freference_letterdelete" id="freference_letterdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reference_letter">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($reference_letter_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($reference_letter_delete->ref_letter_id->Visible) { // ref_letter_id ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_id->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_id" class="reference_letter_ref_letter_id"><?php echo $reference_letter_delete->ref_letter_id->caption() ?></span></th>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_branch_id->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_branch_id" class="reference_letter_ref_letter_branch_id"><?php echo $reference_letter_delete->ref_letter_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_to_whom->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_to_whom" class="reference_letter_ref_letter_to_whom"><?php echo $reference_letter_delete->ref_letter_to_whom->caption() ?></span></th>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_by_whom->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_by_whom" class="reference_letter_ref_letter_by_whom"><?php echo $reference_letter_delete->ref_letter_by_whom->caption() ?></span></th>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_scanned->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_scanned" class="reference_letter_ref_letter_scanned"><?php echo $reference_letter_delete->ref_letter_scanned->caption() ?></span></th>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_date->Visible) { // ref_letter_date ?>
		<th class="<?php echo $reference_letter_delete->ref_letter_date->headerCellClass() ?>"><span id="elh_reference_letter_ref_letter_date" class="reference_letter_ref_letter_date"><?php echo $reference_letter_delete->ref_letter_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$reference_letter_delete->RecordCount = 0;
$i = 0;
while (!$reference_letter_delete->Recordset->EOF) {
	$reference_letter_delete->RecordCount++;
	$reference_letter_delete->RowCount++;

	// Set row properties
	$reference_letter->resetAttributes();
	$reference_letter->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$reference_letter_delete->loadRowValues($reference_letter_delete->Recordset);

	// Render row
	$reference_letter_delete->renderRow();
?>
	<tr <?php echo $reference_letter->rowAttributes() ?>>
<?php if ($reference_letter_delete->ref_letter_id->Visible) { // ref_letter_id ?>
		<td <?php echo $reference_letter_delete->ref_letter_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_id" class="reference_letter_ref_letter_id">
<span<?php echo $reference_letter_delete->ref_letter_id->viewAttributes() ?>><?php echo $reference_letter_delete->ref_letter_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_branch_id->Visible) { // ref_letter_branch_id ?>
		<td <?php echo $reference_letter_delete->ref_letter_branch_id->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_branch_id" class="reference_letter_ref_letter_branch_id">
<span<?php echo $reference_letter_delete->ref_letter_branch_id->viewAttributes() ?>><?php echo $reference_letter_delete->ref_letter_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_to_whom->Visible) { // ref_letter_to_whom ?>
		<td <?php echo $reference_letter_delete->ref_letter_to_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_to_whom" class="reference_letter_ref_letter_to_whom">
<span<?php echo $reference_letter_delete->ref_letter_to_whom->viewAttributes() ?>><?php echo $reference_letter_delete->ref_letter_to_whom->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_by_whom->Visible) { // ref_letter_by_whom ?>
		<td <?php echo $reference_letter_delete->ref_letter_by_whom->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_by_whom" class="reference_letter_ref_letter_by_whom">
<span<?php echo $reference_letter_delete->ref_letter_by_whom->viewAttributes() ?>><?php echo $reference_letter_delete->ref_letter_by_whom->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_scanned->Visible) { // ref_letter_scanned ?>
		<td <?php echo $reference_letter_delete->ref_letter_scanned->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_scanned" class="reference_letter_ref_letter_scanned">
<span><?php echo GetFileViewTag($reference_letter_delete->ref_letter_scanned, $reference_letter_delete->ref_letter_scanned->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($reference_letter_delete->ref_letter_date->Visible) { // ref_letter_date ?>
		<td <?php echo $reference_letter_delete->ref_letter_date->cellAttributes() ?>>
<span id="el<?php echo $reference_letter_delete->RowCount ?>_reference_letter_ref_letter_date" class="reference_letter_ref_letter_date">
<span<?php echo $reference_letter_delete->ref_letter_date->viewAttributes() ?>><?php echo $reference_letter_delete->ref_letter_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$reference_letter_delete->Recordset->moveNext();
}
$reference_letter_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reference_letter_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$reference_letter_delete->showPageFooter();
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
$reference_letter_delete->terminate();
?>