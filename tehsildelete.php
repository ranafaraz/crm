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
$tehsil_delete = new tehsil_delete();

// Run the page
$tehsil_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tehsil_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftehsildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ftehsildelete = currentForm = new ew.Form("ftehsildelete", "delete");
	loadjs.done("ftehsildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $tehsil_delete->showPageHeader(); ?>
<?php
$tehsil_delete->showMessage();
?>
<form name="ftehsildelete" id="ftehsildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tehsil">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($tehsil_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($tehsil_delete->tehsil_id->Visible) { // tehsil_id ?>
		<th class="<?php echo $tehsil_delete->tehsil_id->headerCellClass() ?>"><span id="elh_tehsil_tehsil_id" class="tehsil_tehsil_id"><?php echo $tehsil_delete->tehsil_id->caption() ?></span></th>
<?php } ?>
<?php if ($tehsil_delete->tehsil_district_id->Visible) { // tehsil_district_id ?>
		<th class="<?php echo $tehsil_delete->tehsil_district_id->headerCellClass() ?>"><span id="elh_tehsil_tehsil_district_id" class="tehsil_tehsil_district_id"><?php echo $tehsil_delete->tehsil_district_id->caption() ?></span></th>
<?php } ?>
<?php if ($tehsil_delete->tehsil_name->Visible) { // tehsil_name ?>
		<th class="<?php echo $tehsil_delete->tehsil_name->headerCellClass() ?>"><span id="elh_tehsil_tehsil_name" class="tehsil_tehsil_name"><?php echo $tehsil_delete->tehsil_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$tehsil_delete->RecordCount = 0;
$i = 0;
while (!$tehsil_delete->Recordset->EOF) {
	$tehsil_delete->RecordCount++;
	$tehsil_delete->RowCount++;

	// Set row properties
	$tehsil->resetAttributes();
	$tehsil->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$tehsil_delete->loadRowValues($tehsil_delete->Recordset);

	// Render row
	$tehsil_delete->renderRow();
?>
	<tr <?php echo $tehsil->rowAttributes() ?>>
<?php if ($tehsil_delete->tehsil_id->Visible) { // tehsil_id ?>
		<td <?php echo $tehsil_delete->tehsil_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_delete->RowCount ?>_tehsil_tehsil_id" class="tehsil_tehsil_id">
<span<?php echo $tehsil_delete->tehsil_id->viewAttributes() ?>><?php echo $tehsil_delete->tehsil_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tehsil_delete->tehsil_district_id->Visible) { // tehsil_district_id ?>
		<td <?php echo $tehsil_delete->tehsil_district_id->cellAttributes() ?>>
<span id="el<?php echo $tehsil_delete->RowCount ?>_tehsil_tehsil_district_id" class="tehsil_tehsil_district_id">
<span<?php echo $tehsil_delete->tehsil_district_id->viewAttributes() ?>><?php echo $tehsil_delete->tehsil_district_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($tehsil_delete->tehsil_name->Visible) { // tehsil_name ?>
		<td <?php echo $tehsil_delete->tehsil_name->cellAttributes() ?>>
<span id="el<?php echo $tehsil_delete->RowCount ?>_tehsil_tehsil_name" class="tehsil_tehsil_name">
<span<?php echo $tehsil_delete->tehsil_name->viewAttributes() ?>><?php echo $tehsil_delete->tehsil_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$tehsil_delete->Recordset->moveNext();
}
$tehsil_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $tehsil_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$tehsil_delete->showPageFooter();
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
$tehsil_delete->terminate();
?>