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
$acc_transaction_delete = new acc_transaction_delete();

// Run the page
$acc_transaction_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_transaction_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_transactiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facc_transactiondelete = currentForm = new ew.Form("facc_transactiondelete", "delete");
	loadjs.done("facc_transactiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_transaction_delete->showPageHeader(); ?>
<?php
$acc_transaction_delete->showMessage();
?>
<form name="facc_transactiondelete" id="facc_transactiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_transaction">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acc_transaction_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acc_transaction_delete->acc_trans_id->Visible) { // acc_trans_id ?>
		<th class="<?php echo $acc_transaction_delete->acc_trans_id->headerCellClass() ?>"><span id="elh_acc_transaction_acc_trans_id" class="acc_transaction_acc_trans_id"><?php echo $acc_transaction_delete->acc_trans_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_branch_id->Visible) { // acc_trans_branch_id ?>
		<th class="<?php echo $acc_transaction_delete->acc_trans_branch_id->headerCellClass() ?>"><span id="elh_acc_transaction_acc_trans_branch_id" class="acc_transaction_acc_trans_branch_id"><?php echo $acc_transaction_delete->acc_trans_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_acc_head_id->Visible) { // acc_trans_acc_head_id ?>
		<th class="<?php echo $acc_transaction_delete->acc_trans_acc_head_id->headerCellClass() ?>"><span id="elh_acc_transaction_acc_trans_acc_head_id" class="acc_transaction_acc_trans_acc_head_id"><?php echo $acc_transaction_delete->acc_trans_acc_head_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_amount->Visible) { // acc_trans_amount ?>
		<th class="<?php echo $acc_transaction_delete->acc_trans_amount->headerCellClass() ?>"><span id="elh_acc_transaction_acc_trans_amount" class="acc_transaction_acc_trans_amount"><?php echo $acc_transaction_delete->acc_trans_amount->caption() ?></span></th>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_date->Visible) { // acc_trans_date ?>
		<th class="<?php echo $acc_transaction_delete->acc_trans_date->headerCellClass() ?>"><span id="elh_acc_transaction_acc_trans_date" class="acc_transaction_acc_trans_date"><?php echo $acc_transaction_delete->acc_trans_date->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acc_transaction_delete->RecordCount = 0;
$i = 0;
while (!$acc_transaction_delete->Recordset->EOF) {
	$acc_transaction_delete->RecordCount++;
	$acc_transaction_delete->RowCount++;

	// Set row properties
	$acc_transaction->resetAttributes();
	$acc_transaction->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acc_transaction_delete->loadRowValues($acc_transaction_delete->Recordset);

	// Render row
	$acc_transaction_delete->renderRow();
?>
	<tr <?php echo $acc_transaction->rowAttributes() ?>>
<?php if ($acc_transaction_delete->acc_trans_id->Visible) { // acc_trans_id ?>
		<td <?php echo $acc_transaction_delete->acc_trans_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_delete->RowCount ?>_acc_transaction_acc_trans_id" class="acc_transaction_acc_trans_id">
<span<?php echo $acc_transaction_delete->acc_trans_id->viewAttributes() ?>><?php echo $acc_transaction_delete->acc_trans_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_branch_id->Visible) { // acc_trans_branch_id ?>
		<td <?php echo $acc_transaction_delete->acc_trans_branch_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_delete->RowCount ?>_acc_transaction_acc_trans_branch_id" class="acc_transaction_acc_trans_branch_id">
<span<?php echo $acc_transaction_delete->acc_trans_branch_id->viewAttributes() ?>><?php echo $acc_transaction_delete->acc_trans_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_acc_head_id->Visible) { // acc_trans_acc_head_id ?>
		<td <?php echo $acc_transaction_delete->acc_trans_acc_head_id->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_delete->RowCount ?>_acc_transaction_acc_trans_acc_head_id" class="acc_transaction_acc_trans_acc_head_id">
<span<?php echo $acc_transaction_delete->acc_trans_acc_head_id->viewAttributes() ?>><?php echo $acc_transaction_delete->acc_trans_acc_head_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_amount->Visible) { // acc_trans_amount ?>
		<td <?php echo $acc_transaction_delete->acc_trans_amount->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_delete->RowCount ?>_acc_transaction_acc_trans_amount" class="acc_transaction_acc_trans_amount">
<span<?php echo $acc_transaction_delete->acc_trans_amount->viewAttributes() ?>><?php echo $acc_transaction_delete->acc_trans_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_transaction_delete->acc_trans_date->Visible) { // acc_trans_date ?>
		<td <?php echo $acc_transaction_delete->acc_trans_date->cellAttributes() ?>>
<span id="el<?php echo $acc_transaction_delete->RowCount ?>_acc_transaction_acc_trans_date" class="acc_transaction_acc_trans_date">
<span<?php echo $acc_transaction_delete->acc_trans_date->viewAttributes() ?>><?php echo $acc_transaction_delete->acc_trans_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acc_transaction_delete->Recordset->moveNext();
}
$acc_transaction_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_transaction_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acc_transaction_delete->showPageFooter();
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
$acc_transaction_delete->terminate();
?>