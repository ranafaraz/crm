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
$acc_nature_delete = new acc_nature_delete();

// Run the page
$acc_nature_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_nature_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var facc_naturedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	facc_naturedelete = currentForm = new ew.Form("facc_naturedelete", "delete");
	loadjs.done("facc_naturedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $acc_nature_delete->showPageHeader(); ?>
<?php
$acc_nature_delete->showMessage();
?>
<form name="facc_naturedelete" id="facc_naturedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_nature">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($acc_nature_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($acc_nature_delete->acc_nature_id->Visible) { // acc_nature_id ?>
		<th class="<?php echo $acc_nature_delete->acc_nature_id->headerCellClass() ?>"><span id="elh_acc_nature_acc_nature_id" class="acc_nature_acc_nature_id"><?php echo $acc_nature_delete->acc_nature_id->caption() ?></span></th>
<?php } ?>
<?php if ($acc_nature_delete->acc_nature_name->Visible) { // acc_nature_name ?>
		<th class="<?php echo $acc_nature_delete->acc_nature_name->headerCellClass() ?>"><span id="elh_acc_nature_acc_nature_name" class="acc_nature_acc_nature_name"><?php echo $acc_nature_delete->acc_nature_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$acc_nature_delete->RecordCount = 0;
$i = 0;
while (!$acc_nature_delete->Recordset->EOF) {
	$acc_nature_delete->RecordCount++;
	$acc_nature_delete->RowCount++;

	// Set row properties
	$acc_nature->resetAttributes();
	$acc_nature->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$acc_nature_delete->loadRowValues($acc_nature_delete->Recordset);

	// Render row
	$acc_nature_delete->renderRow();
?>
	<tr <?php echo $acc_nature->rowAttributes() ?>>
<?php if ($acc_nature_delete->acc_nature_id->Visible) { // acc_nature_id ?>
		<td <?php echo $acc_nature_delete->acc_nature_id->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_delete->RowCount ?>_acc_nature_acc_nature_id" class="acc_nature_acc_nature_id">
<span<?php echo $acc_nature_delete->acc_nature_id->viewAttributes() ?>><?php echo $acc_nature_delete->acc_nature_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($acc_nature_delete->acc_nature_name->Visible) { // acc_nature_name ?>
		<td <?php echo $acc_nature_delete->acc_nature_name->cellAttributes() ?>>
<span id="el<?php echo $acc_nature_delete->RowCount ?>_acc_nature_acc_nature_name" class="acc_nature_acc_nature_name">
<span<?php echo $acc_nature_delete->acc_nature_name->viewAttributes() ?>><?php echo $acc_nature_delete->acc_nature_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$acc_nature_delete->Recordset->moveNext();
}
$acc_nature_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $acc_nature_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$acc_nature_delete->showPageFooter();
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
$acc_nature_delete->terminate();
?>