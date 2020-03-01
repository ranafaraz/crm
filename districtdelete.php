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
$district_delete = new district_delete();

// Run the page
$district_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$district_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdistrictdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdistrictdelete = currentForm = new ew.Form("fdistrictdelete", "delete");
	loadjs.done("fdistrictdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $district_delete->showPageHeader(); ?>
<?php
$district_delete->showMessage();
?>
<form name="fdistrictdelete" id="fdistrictdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="district">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($district_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($district_delete->district_id->Visible) { // district_id ?>
		<th class="<?php echo $district_delete->district_id->headerCellClass() ?>"><span id="elh_district_district_id" class="district_district_id"><?php echo $district_delete->district_id->caption() ?></span></th>
<?php } ?>
<?php if ($district_delete->district_division_id->Visible) { // district_division_id ?>
		<th class="<?php echo $district_delete->district_division_id->headerCellClass() ?>"><span id="elh_district_district_division_id" class="district_district_division_id"><?php echo $district_delete->district_division_id->caption() ?></span></th>
<?php } ?>
<?php if ($district_delete->district_name->Visible) { // district_name ?>
		<th class="<?php echo $district_delete->district_name->headerCellClass() ?>"><span id="elh_district_district_name" class="district_district_name"><?php echo $district_delete->district_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$district_delete->RecordCount = 0;
$i = 0;
while (!$district_delete->Recordset->EOF) {
	$district_delete->RecordCount++;
	$district_delete->RowCount++;

	// Set row properties
	$district->resetAttributes();
	$district->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$district_delete->loadRowValues($district_delete->Recordset);

	// Render row
	$district_delete->renderRow();
?>
	<tr <?php echo $district->rowAttributes() ?>>
<?php if ($district_delete->district_id->Visible) { // district_id ?>
		<td <?php echo $district_delete->district_id->cellAttributes() ?>>
<span id="el<?php echo $district_delete->RowCount ?>_district_district_id" class="district_district_id">
<span<?php echo $district_delete->district_id->viewAttributes() ?>><?php echo $district_delete->district_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($district_delete->district_division_id->Visible) { // district_division_id ?>
		<td <?php echo $district_delete->district_division_id->cellAttributes() ?>>
<span id="el<?php echo $district_delete->RowCount ?>_district_district_division_id" class="district_district_division_id">
<span<?php echo $district_delete->district_division_id->viewAttributes() ?>><?php echo $district_delete->district_division_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($district_delete->district_name->Visible) { // district_name ?>
		<td <?php echo $district_delete->district_name->cellAttributes() ?>>
<span id="el<?php echo $district_delete->RowCount ?>_district_district_name" class="district_district_name">
<span<?php echo $district_delete->district_name->viewAttributes() ?>><?php echo $district_delete->district_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$district_delete->Recordset->moveNext();
}
$district_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $district_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$district_delete->showPageFooter();
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
$district_delete->terminate();
?>