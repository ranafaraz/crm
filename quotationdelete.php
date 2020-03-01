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
$quotation_delete = new quotation_delete();

// Run the page
$quotation_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quotation_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquotationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fquotationdelete = currentForm = new ew.Form("fquotationdelete", "delete");
	loadjs.done("fquotationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $quotation_delete->showPageHeader(); ?>
<?php
$quotation_delete->showMessage();
?>
<form name="fquotationdelete" id="fquotationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quotation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($quotation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($quotation_delete->quote_id->Visible) { // quote_id ?>
		<th class="<?php echo $quotation_delete->quote_id->headerCellClass() ?>"><span id="elh_quotation_quote_id" class="quotation_quote_id"><?php echo $quotation_delete->quote_id->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_branch_id->Visible) { // quote_branch_id ?>
		<th class="<?php echo $quotation_delete->quote_branch_id->headerCellClass() ?>"><span id="elh_quotation_quote_branch_id" class="quotation_quote_branch_id"><?php echo $quotation_delete->quote_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_business_id->Visible) { // quote_business_id ?>
		<th class="<?php echo $quotation_delete->quote_business_id->headerCellClass() ?>"><span id="elh_quotation_quote_business_id" class="quotation_quote_business_id"><?php echo $quotation_delete->quote_business_id->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_service_id->Visible) { // quote_service_id ?>
		<th class="<?php echo $quotation_delete->quote_service_id->headerCellClass() ?>"><span id="elh_quotation_quote_service_id" class="quotation_quote_service_id"><?php echo $quotation_delete->quote_service_id->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_issue_date->Visible) { // quote_issue_date ?>
		<th class="<?php echo $quotation_delete->quote_issue_date->headerCellClass() ?>"><span id="elh_quotation_quote_issue_date" class="quotation_quote_issue_date"><?php echo $quotation_delete->quote_issue_date->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_due_date->Visible) { // quote_due_date ?>
		<th class="<?php echo $quotation_delete->quote_due_date->headerCellClass() ?>"><span id="elh_quotation_quote_due_date" class="quotation_quote_due_date"><?php echo $quotation_delete->quote_due_date->caption() ?></span></th>
<?php } ?>
<?php if ($quotation_delete->quote_amount->Visible) { // quote_amount ?>
		<th class="<?php echo $quotation_delete->quote_amount->headerCellClass() ?>"><span id="elh_quotation_quote_amount" class="quotation_quote_amount"><?php echo $quotation_delete->quote_amount->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$quotation_delete->RecordCount = 0;
$i = 0;
while (!$quotation_delete->Recordset->EOF) {
	$quotation_delete->RecordCount++;
	$quotation_delete->RowCount++;

	// Set row properties
	$quotation->resetAttributes();
	$quotation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$quotation_delete->loadRowValues($quotation_delete->Recordset);

	// Render row
	$quotation_delete->renderRow();
?>
	<tr <?php echo $quotation->rowAttributes() ?>>
<?php if ($quotation_delete->quote_id->Visible) { // quote_id ?>
		<td <?php echo $quotation_delete->quote_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_id" class="quotation_quote_id">
<span<?php echo $quotation_delete->quote_id->viewAttributes() ?>><?php echo $quotation_delete->quote_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_branch_id->Visible) { // quote_branch_id ?>
		<td <?php echo $quotation_delete->quote_branch_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_branch_id" class="quotation_quote_branch_id">
<span<?php echo $quotation_delete->quote_branch_id->viewAttributes() ?>><?php echo $quotation_delete->quote_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_business_id->Visible) { // quote_business_id ?>
		<td <?php echo $quotation_delete->quote_business_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_business_id" class="quotation_quote_business_id">
<span<?php echo $quotation_delete->quote_business_id->viewAttributes() ?>><?php echo $quotation_delete->quote_business_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_service_id->Visible) { // quote_service_id ?>
		<td <?php echo $quotation_delete->quote_service_id->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_service_id" class="quotation_quote_service_id">
<span<?php echo $quotation_delete->quote_service_id->viewAttributes() ?>><?php echo $quotation_delete->quote_service_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_issue_date->Visible) { // quote_issue_date ?>
		<td <?php echo $quotation_delete->quote_issue_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_issue_date" class="quotation_quote_issue_date">
<span<?php echo $quotation_delete->quote_issue_date->viewAttributes() ?>><?php echo $quotation_delete->quote_issue_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_due_date->Visible) { // quote_due_date ?>
		<td <?php echo $quotation_delete->quote_due_date->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_due_date" class="quotation_quote_due_date">
<span<?php echo $quotation_delete->quote_due_date->viewAttributes() ?>><?php echo $quotation_delete->quote_due_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($quotation_delete->quote_amount->Visible) { // quote_amount ?>
		<td <?php echo $quotation_delete->quote_amount->cellAttributes() ?>>
<span id="el<?php echo $quotation_delete->RowCount ?>_quotation_quote_amount" class="quotation_quote_amount">
<span<?php echo $quotation_delete->quote_amount->viewAttributes() ?>><?php echo $quotation_delete->quote_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$quotation_delete->Recordset->moveNext();
}
$quotation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $quotation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$quotation_delete->showPageFooter();
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
$quotation_delete->terminate();
?>