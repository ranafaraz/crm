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
$designation_delete = new designation_delete();

// Run the page
$designation_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$designation_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdesignationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdesignationdelete = currentForm = new ew.Form("fdesignationdelete", "delete");
	loadjs.done("fdesignationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $designation_delete->showPageHeader(); ?>
<?php
$designation_delete->showMessage();
?>
<form name="fdesignationdelete" id="fdesignationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="designation">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($designation_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($designation_delete->designation_id->Visible) { // designation_id ?>
		<th class="<?php echo $designation_delete->designation_id->headerCellClass() ?>"><span id="elh_designation_designation_id" class="designation_designation_id"><?php echo $designation_delete->designation_id->caption() ?></span></th>
<?php } ?>
<?php if ($designation_delete->designation_caption->Visible) { // designation_caption ?>
		<th class="<?php echo $designation_delete->designation_caption->headerCellClass() ?>"><span id="elh_designation_designation_caption" class="designation_designation_caption"><?php echo $designation_delete->designation_caption->caption() ?></span></th>
<?php } ?>
<?php if ($designation_delete->designation_desc->Visible) { // designation_desc ?>
		<th class="<?php echo $designation_delete->designation_desc->headerCellClass() ?>"><span id="elh_designation_designation_desc" class="designation_designation_desc"><?php echo $designation_delete->designation_desc->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$designation_delete->RecordCount = 0;
$i = 0;
while (!$designation_delete->Recordset->EOF) {
	$designation_delete->RecordCount++;
	$designation_delete->RowCount++;

	// Set row properties
	$designation->resetAttributes();
	$designation->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$designation_delete->loadRowValues($designation_delete->Recordset);

	// Render row
	$designation_delete->renderRow();
?>
	<tr <?php echo $designation->rowAttributes() ?>>
<?php if ($designation_delete->designation_id->Visible) { // designation_id ?>
		<td <?php echo $designation_delete->designation_id->cellAttributes() ?>>
<span id="el<?php echo $designation_delete->RowCount ?>_designation_designation_id" class="designation_designation_id">
<span<?php echo $designation_delete->designation_id->viewAttributes() ?>><?php echo $designation_delete->designation_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($designation_delete->designation_caption->Visible) { // designation_caption ?>
		<td <?php echo $designation_delete->designation_caption->cellAttributes() ?>>
<span id="el<?php echo $designation_delete->RowCount ?>_designation_designation_caption" class="designation_designation_caption">
<span<?php echo $designation_delete->designation_caption->viewAttributes() ?>><?php echo $designation_delete->designation_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($designation_delete->designation_desc->Visible) { // designation_desc ?>
		<td <?php echo $designation_delete->designation_desc->cellAttributes() ?>>
<span id="el<?php echo $designation_delete->RowCount ?>_designation_designation_desc" class="designation_designation_desc">
<span<?php echo $designation_delete->designation_desc->viewAttributes() ?>><?php echo $designation_delete->designation_desc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$designation_delete->Recordset->moveNext();
}
$designation_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $designation_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$designation_delete->showPageFooter();
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
$designation_delete->terminate();
?>