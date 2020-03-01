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
$division_delete = new division_delete();

// Run the page
$division_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$division_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdivisiondelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdivisiondelete = currentForm = new ew.Form("fdivisiondelete", "delete");
	loadjs.done("fdivisiondelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $division_delete->showPageHeader(); ?>
<?php
$division_delete->showMessage();
?>
<form name="fdivisiondelete" id="fdivisiondelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="division">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($division_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($division_delete->division_id->Visible) { // division_id ?>
		<th class="<?php echo $division_delete->division_id->headerCellClass() ?>"><span id="elh_division_division_id" class="division_division_id"><?php echo $division_delete->division_id->caption() ?></span></th>
<?php } ?>
<?php if ($division_delete->division_state_id->Visible) { // division_state_id ?>
		<th class="<?php echo $division_delete->division_state_id->headerCellClass() ?>"><span id="elh_division_division_state_id" class="division_division_state_id"><?php echo $division_delete->division_state_id->caption() ?></span></th>
<?php } ?>
<?php if ($division_delete->division_name->Visible) { // division_name ?>
		<th class="<?php echo $division_delete->division_name->headerCellClass() ?>"><span id="elh_division_division_name" class="division_division_name"><?php echo $division_delete->division_name->caption() ?></span></th>
<?php } ?>
<?php if ($division_delete->division_desc->Visible) { // division_desc ?>
		<th class="<?php echo $division_delete->division_desc->headerCellClass() ?>"><span id="elh_division_division_desc" class="division_division_desc"><?php echo $division_delete->division_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$division_delete->RecordCount = 0;
$i = 0;
while (!$division_delete->Recordset->EOF) {
	$division_delete->RecordCount++;
	$division_delete->RowCount++;

	// Set row properties
	$division->resetAttributes();
	$division->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$division_delete->loadRowValues($division_delete->Recordset);

	// Render row
	$division_delete->renderRow();
?>
	<tr <?php echo $division->rowAttributes() ?>>
<?php if ($division_delete->division_id->Visible) { // division_id ?>
		<td <?php echo $division_delete->division_id->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_division_id" class="division_division_id">
<span<?php echo $division_delete->division_id->viewAttributes() ?>><?php echo $division_delete->division_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division_delete->division_state_id->Visible) { // division_state_id ?>
		<td <?php echo $division_delete->division_state_id->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_division_state_id" class="division_division_state_id">
<span<?php echo $division_delete->division_state_id->viewAttributes() ?>><?php echo $division_delete->division_state_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division_delete->division_name->Visible) { // division_name ?>
		<td <?php echo $division_delete->division_name->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_division_name" class="division_division_name">
<span<?php echo $division_delete->division_name->viewAttributes() ?>><?php echo $division_delete->division_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($division_delete->division_desc->Visible) { // division_desc ?>
		<td <?php echo $division_delete->division_desc->cellAttributes() ?>>
<span id="el<?php echo $division_delete->RowCount ?>_division_division_desc" class="division_division_desc">
<span<?php echo $division_delete->division_desc->viewAttributes() ?>><?php echo $division_delete->division_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$division_delete->Recordset->moveNext();
}
$division_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $division_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$division_delete->showPageFooter();
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
$division_delete->terminate();
?>