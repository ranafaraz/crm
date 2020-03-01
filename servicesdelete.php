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
$services_delete = new services_delete();

// Run the page
$services_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservicesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fservicesdelete = currentForm = new ew.Form("fservicesdelete", "delete");
	loadjs.done("fservicesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $services_delete->showPageHeader(); ?>
<?php
$services_delete->showMessage();
?>
<form name="fservicesdelete" id="fservicesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($services_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($services_delete->service_id->Visible) { // service_id ?>
		<th class="<?php echo $services_delete->service_id->headerCellClass() ?>"><span id="elh_services_service_id" class="services_service_id"><?php echo $services_delete->service_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_delete->service_branch_id->Visible) { // service_branch_id ?>
		<th class="<?php echo $services_delete->service_branch_id->headerCellClass() ?>"><span id="elh_services_service_branch_id" class="services_service_branch_id"><?php echo $services_delete->service_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_delete->service_caption->Visible) { // service_caption ?>
		<th class="<?php echo $services_delete->service_caption->headerCellClass() ?>"><span id="elh_services_service_caption" class="services_service_caption"><?php echo $services_delete->service_caption->caption() ?></span></th>
<?php } ?>
<?php if ($services_delete->service_logo->Visible) { // service_logo ?>
		<th class="<?php echo $services_delete->service_logo->headerCellClass() ?>"><span id="elh_services_service_logo" class="services_service_logo"><?php echo $services_delete->service_logo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$services_delete->RecordCount = 0;
$i = 0;
while (!$services_delete->Recordset->EOF) {
	$services_delete->RecordCount++;
	$services_delete->RowCount++;

	// Set row properties
	$services->resetAttributes();
	$services->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$services_delete->loadRowValues($services_delete->Recordset);

	// Render row
	$services_delete->renderRow();
?>
	<tr <?php echo $services->rowAttributes() ?>>
<?php if ($services_delete->service_id->Visible) { // service_id ?>
		<td <?php echo $services_delete->service_id->cellAttributes() ?>>
<span id="el<?php echo $services_delete->RowCount ?>_services_service_id" class="services_service_id">
<span<?php echo $services_delete->service_id->viewAttributes() ?>><?php echo $services_delete->service_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_delete->service_branch_id->Visible) { // service_branch_id ?>
		<td <?php echo $services_delete->service_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_delete->RowCount ?>_services_service_branch_id" class="services_service_branch_id">
<span<?php echo $services_delete->service_branch_id->viewAttributes() ?>><?php echo $services_delete->service_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_delete->service_caption->Visible) { // service_caption ?>
		<td <?php echo $services_delete->service_caption->cellAttributes() ?>>
<span id="el<?php echo $services_delete->RowCount ?>_services_service_caption" class="services_service_caption">
<span<?php echo $services_delete->service_caption->viewAttributes() ?>><?php echo $services_delete->service_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_delete->service_logo->Visible) { // service_logo ?>
		<td <?php echo $services_delete->service_logo->cellAttributes() ?>>
<span id="el<?php echo $services_delete->RowCount ?>_services_service_logo" class="services_service_logo">
<span><?php echo GetFileViewTag($services_delete->service_logo, $services_delete->service_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$services_delete->Recordset->moveNext();
}
$services_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $services_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$services_delete->showPageFooter();
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
$services_delete->terminate();
?>