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
$invoices_delete = new invoices_delete();

// Run the page
$invoices_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$invoices_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var finvoicesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	finvoicesdelete = currentForm = new ew.Form("finvoicesdelete", "delete");
	loadjs.done("finvoicesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $invoices_delete->showPageHeader(); ?>
<?php
$invoices_delete->showMessage();
?>
<form name="finvoicesdelete" id="finvoicesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($invoices_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($invoices_delete->invoice_id->Visible) { // invoice_id ?>
		<th class="<?php echo $invoices_delete->invoice_id->headerCellClass() ?>"><span id="elh_invoices_invoice_id" class="invoices_invoice_id"><?php echo $invoices_delete->invoice_id->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_branch_id->Visible) { // invoice_branch_id ?>
		<th class="<?php echo $invoices_delete->invoice_branch_id->headerCellClass() ?>"><span id="elh_invoices_invoice_branch_id" class="invoices_invoice_branch_id"><?php echo $invoices_delete->invoice_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_business_id->Visible) { // invoice_business_id ?>
		<th class="<?php echo $invoices_delete->invoice_business_id->headerCellClass() ?>"><span id="elh_invoices_invoice_business_id" class="invoices_invoice_business_id"><?php echo $invoices_delete->invoice_business_id->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_service_id->Visible) { // invoice_service_id ?>
		<th class="<?php echo $invoices_delete->invoice_service_id->headerCellClass() ?>"><span id="elh_invoices_invoice_service_id" class="invoices_invoice_service_id"><?php echo $invoices_delete->invoice_service_id->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_amount->Visible) { // invoice_amount ?>
		<th class="<?php echo $invoices_delete->invoice_amount->headerCellClass() ?>"><span id="elh_invoices_invoice_amount" class="invoices_invoice_amount"><?php echo $invoices_delete->invoice_amount->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_issue_date->Visible) { // invoice_issue_date ?>
		<th class="<?php echo $invoices_delete->invoice_issue_date->headerCellClass() ?>"><span id="elh_invoices_invoice_issue_date" class="invoices_invoice_issue_date"><?php echo $invoices_delete->invoice_issue_date->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_due_date->Visible) { // invoice_due_date ?>
		<th class="<?php echo $invoices_delete->invoice_due_date->headerCellClass() ?>"><span id="elh_invoices_invoice_due_date" class="invoices_invoice_due_date"><?php echo $invoices_delete->invoice_due_date->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_status->Visible) { // invoice_status ?>
		<th class="<?php echo $invoices_delete->invoice_status->headerCellClass() ?>"><span id="elh_invoices_invoice_status" class="invoices_invoice_status"><?php echo $invoices_delete->invoice_status->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
		<th class="<?php echo $invoices_delete->invoice_collected_amount->headerCellClass() ?>"><span id="elh_invoices_invoice_collected_amount" class="invoices_invoice_collected_amount"><?php echo $invoices_delete->invoice_collected_amount->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
		<th class="<?php echo $invoices_delete->invoice_remaining_amount->headerCellClass() ?>"><span id="elh_invoices_invoice_remaining_amount" class="invoices_invoice_remaining_amount"><?php echo $invoices_delete->invoice_remaining_amount->caption() ?></span></th>
<?php } ?>
<?php if ($invoices_delete->invoice_collection_date->Visible) { // invoice_collection_date ?>
		<th class="<?php echo $invoices_delete->invoice_collection_date->headerCellClass() ?>"><span id="elh_invoices_invoice_collection_date" class="invoices_invoice_collection_date"><?php echo $invoices_delete->invoice_collection_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$invoices_delete->RecordCount = 0;
$i = 0;
while (!$invoices_delete->Recordset->EOF) {
	$invoices_delete->RecordCount++;
	$invoices_delete->RowCount++;

	// Set row properties
	$invoices->resetAttributes();
	$invoices->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$invoices_delete->loadRowValues($invoices_delete->Recordset);

	// Render row
	$invoices_delete->renderRow();
?>
	<tr <?php echo $invoices->rowAttributes() ?>>
<?php if ($invoices_delete->invoice_id->Visible) { // invoice_id ?>
		<td <?php echo $invoices_delete->invoice_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_id" class="invoices_invoice_id">
<span<?php echo $invoices_delete->invoice_id->viewAttributes() ?>><?php echo $invoices_delete->invoice_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_branch_id->Visible) { // invoice_branch_id ?>
		<td <?php echo $invoices_delete->invoice_branch_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_branch_id" class="invoices_invoice_branch_id">
<span<?php echo $invoices_delete->invoice_branch_id->viewAttributes() ?>><?php echo $invoices_delete->invoice_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_business_id->Visible) { // invoice_business_id ?>
		<td <?php echo $invoices_delete->invoice_business_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_business_id" class="invoices_invoice_business_id">
<span<?php echo $invoices_delete->invoice_business_id->viewAttributes() ?>><?php echo $invoices_delete->invoice_business_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_service_id->Visible) { // invoice_service_id ?>
		<td <?php echo $invoices_delete->invoice_service_id->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_service_id" class="invoices_invoice_service_id">
<span<?php echo $invoices_delete->invoice_service_id->viewAttributes() ?>><?php echo $invoices_delete->invoice_service_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_amount->Visible) { // invoice_amount ?>
		<td <?php echo $invoices_delete->invoice_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_amount" class="invoices_invoice_amount">
<span<?php echo $invoices_delete->invoice_amount->viewAttributes() ?>><?php echo $invoices_delete->invoice_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_issue_date->Visible) { // invoice_issue_date ?>
		<td <?php echo $invoices_delete->invoice_issue_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_issue_date" class="invoices_invoice_issue_date">
<span<?php echo $invoices_delete->invoice_issue_date->viewAttributes() ?>><?php echo $invoices_delete->invoice_issue_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_due_date->Visible) { // invoice_due_date ?>
		<td <?php echo $invoices_delete->invoice_due_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_due_date" class="invoices_invoice_due_date">
<span<?php echo $invoices_delete->invoice_due_date->viewAttributes() ?>><?php echo $invoices_delete->invoice_due_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_status->Visible) { // invoice_status ?>
		<td <?php echo $invoices_delete->invoice_status->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_status" class="invoices_invoice_status">
<span<?php echo $invoices_delete->invoice_status->viewAttributes() ?>><?php echo $invoices_delete->invoice_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
		<td <?php echo $invoices_delete->invoice_collected_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_collected_amount" class="invoices_invoice_collected_amount">
<span<?php echo $invoices_delete->invoice_collected_amount->viewAttributes() ?>><?php echo $invoices_delete->invoice_collected_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
		<td <?php echo $invoices_delete->invoice_remaining_amount->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_remaining_amount" class="invoices_invoice_remaining_amount">
<span<?php echo $invoices_delete->invoice_remaining_amount->viewAttributes() ?>><?php echo $invoices_delete->invoice_remaining_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($invoices_delete->invoice_collection_date->Visible) { // invoice_collection_date ?>
		<td <?php echo $invoices_delete->invoice_collection_date->cellAttributes() ?>>
<span id="el<?php echo $invoices_delete->RowCount ?>_invoices_invoice_collection_date" class="invoices_invoice_collection_date">
<span<?php echo $invoices_delete->invoice_collection_date->viewAttributes() ?>><?php echo $invoices_delete->invoice_collection_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$invoices_delete->Recordset->moveNext();
}
$invoices_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $invoices_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$invoices_delete->showPageFooter();
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
$invoices_delete->terminate();
?>