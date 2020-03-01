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
$state_delete = new state_delete();

// Run the page
$state_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$state_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstatedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fstatedelete = currentForm = new ew.Form("fstatedelete", "delete");
	loadjs.done("fstatedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $state_delete->showPageHeader(); ?>
<?php
$state_delete->showMessage();
?>
<form name="fstatedelete" id="fstatedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="state">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($state_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($state_delete->state_id->Visible) { // state_id ?>
		<th class="<?php echo $state_delete->state_id->headerCellClass() ?>"><span id="elh_state_state_id" class="state_state_id"><?php echo $state_delete->state_id->caption() ?></span></th>
<?php } ?>
<?php if ($state_delete->state_country_id->Visible) { // state_country_id ?>
		<th class="<?php echo $state_delete->state_country_id->headerCellClass() ?>"><span id="elh_state_state_country_id" class="state_state_country_id"><?php echo $state_delete->state_country_id->caption() ?></span></th>
<?php } ?>
<?php if ($state_delete->state_name->Visible) { // state_name ?>
		<th class="<?php echo $state_delete->state_name->headerCellClass() ?>"><span id="elh_state_state_name" class="state_state_name"><?php echo $state_delete->state_name->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$state_delete->RecordCount = 0;
$i = 0;
while (!$state_delete->Recordset->EOF) {
	$state_delete->RecordCount++;
	$state_delete->RowCount++;

	// Set row properties
	$state->resetAttributes();
	$state->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$state_delete->loadRowValues($state_delete->Recordset);

	// Render row
	$state_delete->renderRow();
?>
	<tr <?php echo $state->rowAttributes() ?>>
<?php if ($state_delete->state_id->Visible) { // state_id ?>
		<td <?php echo $state_delete->state_id->cellAttributes() ?>>
<span id="el<?php echo $state_delete->RowCount ?>_state_state_id" class="state_state_id">
<span<?php echo $state_delete->state_id->viewAttributes() ?>><?php echo $state_delete->state_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($state_delete->state_country_id->Visible) { // state_country_id ?>
		<td <?php echo $state_delete->state_country_id->cellAttributes() ?>>
<span id="el<?php echo $state_delete->RowCount ?>_state_state_country_id" class="state_state_country_id">
<span<?php echo $state_delete->state_country_id->viewAttributes() ?>><?php echo $state_delete->state_country_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($state_delete->state_name->Visible) { // state_name ?>
		<td <?php echo $state_delete->state_name->cellAttributes() ?>>
<span id="el<?php echo $state_delete->RowCount ?>_state_state_name" class="state_state_name">
<span<?php echo $state_delete->state_name->viewAttributes() ?>><?php echo $state_delete->state_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$state_delete->Recordset->moveNext();
}
$state_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $state_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$state_delete->showPageFooter();
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
$state_delete->terminate();
?>