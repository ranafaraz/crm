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
$acc_head_delete = new acc_head_delete();

// Run the page
$acc_head_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_head_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_headdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facc_headdelete = currentForm = new ew.Form("facc_headdelete", "delete");
	loadjs.done("facc_headdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_head_delete->showPageHeader(); ?>
<?php
$acc_head_delete->showMessage();
?>
<form name="facc_headdelete" id="facc_headdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_head">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acc_head_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acc_head_delete->acc_head_id->Visible) { // acc_head_id ?>
		<th class="<?php echo $acc_head_delete->acc_head_id->headerCellClass() ?>"><span id="elh_acc_head_acc_head_id" class="acc_head_acc_head_id"><?php echo $acc_head_delete->acc_head_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_head_delete->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
		<th class="<?php echo $acc_head_delete->acc_head_acc_nature_id->headerCellClass() ?>"><span id="elh_acc_head_acc_head_acc_nature_id" class="acc_head_acc_head_acc_nature_id"><?php echo $acc_head_delete->acc_head_acc_nature_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_head_delete->acc_head_caption->Visible) { // acc_head_caption ?>
		<th class="<?php echo $acc_head_delete->acc_head_caption->headerCellClass() ?>"><span id="elh_acc_head_acc_head_caption" class="acc_head_acc_head_caption"><?php echo $acc_head_delete->acc_head_caption->caption() ?></span></th>
<?php } ?>
<?php if ($acc_head_delete->acc_head_desc->Visible) { // acc_head_desc ?>
		<th class="<?php echo $acc_head_delete->acc_head_desc->headerCellClass() ?>"><span id="elh_acc_head_acc_head_desc" class="acc_head_acc_head_desc"><?php echo $acc_head_delete->acc_head_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acc_head_delete->RecordCount = 0;
$i = 0;
while (!$acc_head_delete->Recordset->EOF) {
	$acc_head_delete->RecordCount++;
	$acc_head_delete->RowCount++;

	// Set row properties
	$acc_head->resetAttributes();
	$acc_head->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acc_head_delete->loadRowValues($acc_head_delete->Recordset);

	// Render row
	$acc_head_delete->renderRow();
?>
	<tr <?php echo $acc_head->rowAttributes() ?>>
<?php if ($acc_head_delete->acc_head_id->Visible) { // acc_head_id ?>
		<td <?php echo $acc_head_delete->acc_head_id->cellAttributes() ?>>
<span id="el<?php echo $acc_head_delete->RowCount ?>_acc_head_acc_head_id" class="acc_head_acc_head_id">
<span<?php echo $acc_head_delete->acc_head_id->viewAttributes() ?>><?php echo $acc_head_delete->acc_head_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_head_delete->acc_head_acc_nature_id->Visible) { // acc_head_acc_nature_id ?>
		<td <?php echo $acc_head_delete->acc_head_acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_head_delete->RowCount ?>_acc_head_acc_head_acc_nature_id" class="acc_head_acc_head_acc_nature_id">
<span<?php echo $acc_head_delete->acc_head_acc_nature_id->viewAttributes() ?>><?php echo $acc_head_delete->acc_head_acc_nature_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_head_delete->acc_head_caption->Visible) { // acc_head_caption ?>
		<td <?php echo $acc_head_delete->acc_head_caption->cellAttributes() ?>>
<span id="el<?php echo $acc_head_delete->RowCount ?>_acc_head_acc_head_caption" class="acc_head_acc_head_caption">
<span<?php echo $acc_head_delete->acc_head_caption->viewAttributes() ?>><?php echo $acc_head_delete->acc_head_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_head_delete->acc_head_desc->Visible) { // acc_head_desc ?>
		<td <?php echo $acc_head_delete->acc_head_desc->cellAttributes() ?>>
<span id="el<?php echo $acc_head_delete->RowCount ?>_acc_head_acc_head_desc" class="acc_head_acc_head_desc">
<span<?php echo $acc_head_delete->acc_head_desc->viewAttributes() ?>><?php echo $acc_head_delete->acc_head_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acc_head_delete->Recordset->moveNext();
}
$acc_head_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_head_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acc_head_delete->showPageFooter();
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
$acc_head_delete->terminate();
?>