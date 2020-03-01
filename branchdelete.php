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
$branch_delete = new branch_delete();

// Run the page
$branch_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$branch_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbranchdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fbranchdelete = currentForm = new ew.Form("fbranchdelete", "delete");
	loadjs.done("fbranchdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $branch_delete->showPageHeader(); ?>
<?php
$branch_delete->showMessage();
?>
<form name="fbranchdelete" id="fbranchdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="branch">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($branch_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($branch_delete->branch_id->Visible) { // branch_id ?>
		<th class="<?php echo $branch_delete->branch_id->headerCellClass() ?>"><span id="elh_branch_branch_id" class="branch_branch_id"><?php echo $branch_delete->branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($branch_delete->branch_org_id->Visible) { // branch_org_id ?>
		<th class="<?php echo $branch_delete->branch_org_id->headerCellClass() ?>"><span id="elh_branch_branch_org_id" class="branch_branch_org_id"><?php echo $branch_delete->branch_org_id->caption() ?></span></th>
<?php } ?>
<?php if ($branch_delete->branch_name->Visible) { // branch_name ?>
		<th class="<?php echo $branch_delete->branch_name->headerCellClass() ?>"><span id="elh_branch_branch_name" class="branch_branch_name"><?php echo $branch_delete->branch_name->caption() ?></span></th>
<?php } ?>
<?php if ($branch_delete->branch_manager->Visible) { // branch_manager ?>
		<th class="<?php echo $branch_delete->branch_manager->headerCellClass() ?>"><span id="elh_branch_branch_manager" class="branch_branch_manager"><?php echo $branch_delete->branch_manager->caption() ?></span></th>
<?php } ?>
<?php if ($branch_delete->branch_contact->Visible) { // branch_contact ?>
		<th class="<?php echo $branch_delete->branch_contact->headerCellClass() ?>"><span id="elh_branch_branch_contact" class="branch_branch_contact"><?php echo $branch_delete->branch_contact->caption() ?></span></th>
<?php } ?>
<?php if ($branch_delete->branch_address->Visible) { // branch_address ?>
		<th class="<?php echo $branch_delete->branch_address->headerCellClass() ?>"><span id="elh_branch_branch_address" class="branch_branch_address"><?php echo $branch_delete->branch_address->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$branch_delete->RecordCount = 0;
$i = 0;
while (!$branch_delete->Recordset->EOF) {
	$branch_delete->RecordCount++;
	$branch_delete->RowCount++;

	// Set row properties
	$branch->resetAttributes();
	$branch->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$branch_delete->loadRowValues($branch_delete->Recordset);

	// Render row
	$branch_delete->renderRow();
?>
	<tr <?php echo $branch->rowAttributes() ?>>
<?php if ($branch_delete->branch_id->Visible) { // branch_id ?>
		<td <?php echo $branch_delete->branch_id->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_id" class="branch_branch_id">
<span<?php echo $branch_delete->branch_id->viewAttributes() ?>><?php echo $branch_delete->branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($branch_delete->branch_org_id->Visible) { // branch_org_id ?>
		<td <?php echo $branch_delete->branch_org_id->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_org_id" class="branch_branch_org_id">
<span<?php echo $branch_delete->branch_org_id->viewAttributes() ?>><?php echo $branch_delete->branch_org_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($branch_delete->branch_name->Visible) { // branch_name ?>
		<td <?php echo $branch_delete->branch_name->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_name" class="branch_branch_name">
<span<?php echo $branch_delete->branch_name->viewAttributes() ?>><?php echo $branch_delete->branch_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($branch_delete->branch_manager->Visible) { // branch_manager ?>
		<td <?php echo $branch_delete->branch_manager->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_manager" class="branch_branch_manager">
<span<?php echo $branch_delete->branch_manager->viewAttributes() ?>><?php echo $branch_delete->branch_manager->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($branch_delete->branch_contact->Visible) { // branch_contact ?>
		<td <?php echo $branch_delete->branch_contact->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_contact" class="branch_branch_contact">
<span<?php echo $branch_delete->branch_contact->viewAttributes() ?>><?php echo $branch_delete->branch_contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($branch_delete->branch_address->Visible) { // branch_address ?>
		<td <?php echo $branch_delete->branch_address->cellAttributes() ?>>
<span id="el<?php echo $branch_delete->RowCount ?>_branch_branch_address" class="branch_branch_address">
<span<?php echo $branch_delete->branch_address->viewAttributes() ?>><?php echo $branch_delete->branch_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$branch_delete->Recordset->moveNext();
}
$branch_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $branch_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$branch_delete->showPageFooter();
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
$branch_delete->terminate();
?>