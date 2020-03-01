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
$followup_delete = new followup_delete();

// Run the page
$followup_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffollowupdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ffollowupdelete = currentForm = new ew.Form("ffollowupdelete", "delete");
	loadjs.done("ffollowupdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_delete->showPageHeader(); ?>
<?php
$followup_delete->showMessage();
?>
<form name="ffollowupdelete" id="ffollowupdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($followup_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($followup_delete->followup_id->Visible) { // followup_id ?>
		<th class="<?php echo $followup_delete->followup_id->headerCellClass() ?>"><span id="elh_followup_followup_id" class="followup_followup_id"><?php echo $followup_delete->followup_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_branch_id->Visible) { // followup_branch_id ?>
		<th class="<?php echo $followup_delete->followup_branch_id->headerCellClass() ?>"><span id="elh_followup_followup_branch_id" class="followup_followup_branch_id"><?php echo $followup_delete->followup_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_business_id->Visible) { // followup_business_id ?>
		<th class="<?php echo $followup_delete->followup_business_id->headerCellClass() ?>"><span id="elh_followup_followup_business_id" class="followup_followup_business_id"><?php echo $followup_delete->followup_business_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
		<th class="<?php echo $followup_delete->followup_by_emp_id->headerCellClass() ?>"><span id="elh_followup_followup_by_emp_id" class="followup_followup_by_emp_id"><?php echo $followup_delete->followup_by_emp_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_no_id->Visible) { // followup_no_id ?>
		<th class="<?php echo $followup_delete->followup_no_id->headerCellClass() ?>"><span id="elh_followup_followup_no_id" class="followup_followup_no_id"><?php echo $followup_delete->followup_no_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_date->Visible) { // followup_date ?>
		<th class="<?php echo $followup_delete->followup_date->headerCellClass() ?>"><span id="elh_followup_followup_date" class="followup_followup_date"><?php echo $followup_delete->followup_date->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_comments->Visible) { // followup_comments ?>
		<th class="<?php echo $followup_delete->followup_comments->headerCellClass() ?>"><span id="elh_followup_followup_comments" class="followup_followup_comments"><?php echo $followup_delete->followup_comments->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->followup_response->Visible) { // followup_response ?>
		<th class="<?php echo $followup_delete->followup_response->headerCellClass() ?>"><span id="elh_followup_followup_response" class="followup_followup_response"><?php echo $followup_delete->followup_response->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->nxt_FU_date->Visible) { // nxt_FU_date ?>
		<th class="<?php echo $followup_delete->nxt_FU_date->headerCellClass() ?>"><span id="elh_followup_nxt_FU_date" class="followup_nxt_FU_date"><?php echo $followup_delete->nxt_FU_date->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
		<th class="<?php echo $followup_delete->nxt_FU_plans->headerCellClass() ?>"><span id="elh_followup_nxt_FU_plans" class="followup_nxt_FU_plans"><?php echo $followup_delete->nxt_FU_plans->caption() ?></span></th>
<?php } ?>
<?php if ($followup_delete->current_FU_status->Visible) { // current_FU_status ?>
		<th class="<?php echo $followup_delete->current_FU_status->headerCellClass() ?>"><span id="elh_followup_current_FU_status" class="followup_current_FU_status"><?php echo $followup_delete->current_FU_status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$followup_delete->RecordCount = 0;
$i = 0;
while (!$followup_delete->Recordset->EOF) {
	$followup_delete->RecordCount++;
	$followup_delete->RowCount++;

	// Set row properties
	$followup->resetAttributes();
	$followup->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$followup_delete->loadRowValues($followup_delete->Recordset);

	// Render row
	$followup_delete->renderRow();
?>
	<tr <?php echo $followup->rowAttributes() ?>>
<?php if ($followup_delete->followup_id->Visible) { // followup_id ?>
		<td <?php echo $followup_delete->followup_id->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_id" class="followup_followup_id">
<span<?php echo $followup_delete->followup_id->viewAttributes() ?>><?php echo $followup_delete->followup_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_branch_id->Visible) { // followup_branch_id ?>
		<td <?php echo $followup_delete->followup_branch_id->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_branch_id" class="followup_followup_branch_id">
<span<?php echo $followup_delete->followup_branch_id->viewAttributes() ?>><?php echo $followup_delete->followup_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_business_id->Visible) { // followup_business_id ?>
		<td <?php echo $followup_delete->followup_business_id->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_business_id" class="followup_followup_business_id">
<span<?php echo $followup_delete->followup_business_id->viewAttributes() ?>><?php echo $followup_delete->followup_business_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
		<td <?php echo $followup_delete->followup_by_emp_id->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_by_emp_id" class="followup_followup_by_emp_id">
<span<?php echo $followup_delete->followup_by_emp_id->viewAttributes() ?>><?php echo $followup_delete->followup_by_emp_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_no_id->Visible) { // followup_no_id ?>
		<td <?php echo $followup_delete->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_no_id" class="followup_followup_no_id">
<span<?php echo $followup_delete->followup_no_id->viewAttributes() ?>><?php echo $followup_delete->followup_no_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_date->Visible) { // followup_date ?>
		<td <?php echo $followup_delete->followup_date->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_date" class="followup_followup_date">
<span<?php echo $followup_delete->followup_date->viewAttributes() ?>><?php echo $followup_delete->followup_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_comments->Visible) { // followup_comments ?>
		<td <?php echo $followup_delete->followup_comments->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_comments" class="followup_followup_comments">
<span<?php echo $followup_delete->followup_comments->viewAttributes() ?>><?php echo $followup_delete->followup_comments->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->followup_response->Visible) { // followup_response ?>
		<td <?php echo $followup_delete->followup_response->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_followup_response" class="followup_followup_response">
<span<?php echo $followup_delete->followup_response->viewAttributes() ?>><?php echo $followup_delete->followup_response->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->nxt_FU_date->Visible) { // nxt_FU_date ?>
		<td <?php echo $followup_delete->nxt_FU_date->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_nxt_FU_date" class="followup_nxt_FU_date">
<span<?php echo $followup_delete->nxt_FU_date->viewAttributes() ?>><?php echo $followup_delete->nxt_FU_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
		<td <?php echo $followup_delete->nxt_FU_plans->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_nxt_FU_plans" class="followup_nxt_FU_plans">
<span<?php echo $followup_delete->nxt_FU_plans->viewAttributes() ?>><?php echo $followup_delete->nxt_FU_plans->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_delete->current_FU_status->Visible) { // current_FU_status ?>
		<td <?php echo $followup_delete->current_FU_status->cellAttributes() ?>>
<span id="el<?php echo $followup_delete->RowCount ?>_followup_current_FU_status" class="followup_current_FU_status">
<span<?php echo $followup_delete->current_FU_status->viewAttributes() ?>><?php echo $followup_delete->current_FU_status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$followup_delete->Recordset->moveNext();
}
$followup_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $followup_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$followup_delete->showPageFooter();
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
$followup_delete->terminate();
?>