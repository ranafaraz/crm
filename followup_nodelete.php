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
$followup_no_delete = new followup_no_delete();

// Run the page
$followup_no_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_no_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ffollowup_nodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	ffollowup_nodelete = currentForm = new ew.Form("ffollowup_nodelete", "delete");
	loadjs.done("ffollowup_nodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $followup_no_delete->showPageHeader(); ?>
<?php
$followup_no_delete->showMessage();
?>
<form name="ffollowup_nodelete" id="ffollowup_nodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup_no">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($followup_no_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($followup_no_delete->followup_no_id->Visible) { // followup_no_id ?>
		<th class="<?php echo $followup_no_delete->followup_no_id->headerCellClass() ?>"><span id="elh_followup_no_followup_no_id" class="followup_no_followup_no_id"><?php echo $followup_no_delete->followup_no_id->caption() ?></span></th>
<?php } ?>
<?php if ($followup_no_delete->followup_no_caption->Visible) { // followup_no_caption ?>
		<th class="<?php echo $followup_no_delete->followup_no_caption->headerCellClass() ?>"><span id="elh_followup_no_followup_no_caption" class="followup_no_followup_no_caption"><?php echo $followup_no_delete->followup_no_caption->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$followup_no_delete->RecordCount = 0;
$i = 0;
while (!$followup_no_delete->Recordset->EOF) {
	$followup_no_delete->RecordCount++;
	$followup_no_delete->RowCount++;

	// Set row properties
	$followup_no->resetAttributes();
	$followup_no->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$followup_no_delete->loadRowValues($followup_no_delete->Recordset);

	// Render row
	$followup_no_delete->renderRow();
?>
	<tr <?php echo $followup_no->rowAttributes() ?>>
<?php if ($followup_no_delete->followup_no_id->Visible) { // followup_no_id ?>
		<td <?php echo $followup_no_delete->followup_no_id->cellAttributes() ?>>
<span id="el<?php echo $followup_no_delete->RowCount ?>_followup_no_followup_no_id" class="followup_no_followup_no_id">
<span<?php echo $followup_no_delete->followup_no_id->viewAttributes() ?>><?php echo $followup_no_delete->followup_no_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($followup_no_delete->followup_no_caption->Visible) { // followup_no_caption ?>
		<td <?php echo $followup_no_delete->followup_no_caption->cellAttributes() ?>>
<span id="el<?php echo $followup_no_delete->RowCount ?>_followup_no_followup_no_caption" class="followup_no_followup_no_caption">
<span<?php echo $followup_no_delete->followup_no_caption->viewAttributes() ?>><?php echo $followup_no_delete->followup_no_caption->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$followup_no_delete->Recordset->moveNext();
}
$followup_no_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $followup_no_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$followup_no_delete->showPageFooter();
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
$followup_no_delete->terminate();
?>