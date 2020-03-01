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
$business_status_delete = new business_status_delete();

// Run the page
$business_status_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_status_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_statusdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbusiness_statusdelete = currentForm = new ew.Form("fbusiness_statusdelete", "delete");
	loadjs.done("fbusiness_statusdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_status_delete->showPageHeader(); ?>
<?php
$business_status_delete->showMessage();
?>
<form name="fbusiness_statusdelete" id="fbusiness_statusdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_status">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($business_status_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($business_status_delete->business_status_id->Visible) { // business_status_id ?>
		<th class="<?php echo $business_status_delete->business_status_id->headerCellClass() ?>"><span id="elh_business_status_business_status_id" class="business_status_business_status_id"><?php echo $business_status_delete->business_status_id->caption() ?></span></th>
<?php } ?>
<?php if ($business_status_delete->business_status_caption->Visible) { // business_status_caption ?>
		<th class="<?php echo $business_status_delete->business_status_caption->headerCellClass() ?>"><span id="elh_business_status_business_status_caption" class="business_status_business_status_caption"><?php echo $business_status_delete->business_status_caption->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$business_status_delete->RecordCount = 0;
$i = 0;
while (!$business_status_delete->Recordset->EOF) {
	$business_status_delete->RecordCount++;
	$business_status_delete->RowCount++;

	// Set row properties
	$business_status->resetAttributes();
	$business_status->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$business_status_delete->loadRowValues($business_status_delete->Recordset);

	// Render row
	$business_status_delete->renderRow();
?>
	<tr <?php echo $business_status->rowAttributes() ?>>
<?php if ($business_status_delete->business_status_id->Visible) { // business_status_id ?>
		<td <?php echo $business_status_delete->business_status_id->cellAttributes() ?>>
<span id="el<?php echo $business_status_delete->RowCount ?>_business_status_business_status_id" class="business_status_business_status_id">
<span<?php echo $business_status_delete->business_status_id->viewAttributes() ?>><?php echo $business_status_delete->business_status_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($business_status_delete->business_status_caption->Visible) { // business_status_caption ?>
		<td <?php echo $business_status_delete->business_status_caption->cellAttributes() ?>>
<span id="el<?php echo $business_status_delete->RowCount ?>_business_status_business_status_caption" class="business_status_business_status_caption">
<span<?php echo $business_status_delete->business_status_caption->viewAttributes() ?>><?php echo $business_status_delete->business_status_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$business_status_delete->Recordset->moveNext();
}
$business_status_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_status_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$business_status_delete->showPageFooter();
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
$business_status_delete->terminate();
?>