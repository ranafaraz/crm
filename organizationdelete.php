<?php
namespace PHPMaker2020\dexdevs_crm;

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
$organization_delete = new organization_delete();

// Run the page
$organization_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$organization_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var forganizationdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	forganizationdelete = currentForm = new ew.Form("forganizationdelete", "delete");
	loadjs.done("forganizationdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $organization_delete->showPageHeader(); ?>
<?php
$organization_delete->showMessage();
?>
<form name="forganizationdelete" id="forganizationdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="organization">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($organization_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($organization_delete->org_id->Visible) { // org_id ?>
		<th class="<?php echo $organization_delete->org_id->headerCellClass() ?>"><span id="elh_organization_org_id" class="organization_org_id"><?php echo $organization_delete->org_id->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_city_id->Visible) { // org_city_id ?>
		<th class="<?php echo $organization_delete->org_city_id->headerCellClass() ?>"><span id="elh_organization_org_city_id" class="organization_org_city_id"><?php echo $organization_delete->org_city_id->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_name->Visible) { // org_name ?>
		<th class="<?php echo $organization_delete->org_name->headerCellClass() ?>"><span id="elh_organization_org_name" class="organization_org_name"><?php echo $organization_delete->org_name->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_head_office->Visible) { // org_head_office ?>
		<th class="<?php echo $organization_delete->org_head_office->headerCellClass() ?>"><span id="elh_organization_org_head_office" class="organization_org_head_office"><?php echo $organization_delete->org_head_office->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_owner->Visible) { // org_owner ?>
		<th class="<?php echo $organization_delete->org_owner->headerCellClass() ?>"><span id="elh_organization_org_owner" class="organization_org_owner"><?php echo $organization_delete->org_owner->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_contact_no->Visible) { // org_contact_no ?>
		<th class="<?php echo $organization_delete->org_contact_no->headerCellClass() ?>"><span id="elh_organization_org_contact_no" class="organization_org_contact_no"><?php echo $organization_delete->org_contact_no->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_logo->Visible) { // org_logo ?>
		<th class="<?php echo $organization_delete->org_logo->headerCellClass() ?>"><span id="elh_organization_org_logo" class="organization_org_logo"><?php echo $organization_delete->org_logo->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_bank_acc->Visible) { // org_bank_acc ?>
		<th class="<?php echo $organization_delete->org_bank_acc->headerCellClass() ?>"><span id="elh_organization_org_bank_acc" class="organization_org_bank_acc"><?php echo $organization_delete->org_bank_acc->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_ntn->Visible) { // org_ntn ?>
		<th class="<?php echo $organization_delete->org_ntn->headerCellClass() ?>"><span id="elh_organization_org_ntn" class="organization_org_ntn"><?php echo $organization_delete->org_ntn->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_email->Visible) { // org_email ?>
		<th class="<?php echo $organization_delete->org_email->headerCellClass() ?>"><span id="elh_organization_org_email" class="organization_org_email"><?php echo $organization_delete->org_email->caption() ?></span></th>
<?php } ?>
<?php if ($organization_delete->org_website->Visible) { // org_website ?>
		<th class="<?php echo $organization_delete->org_website->headerCellClass() ?>"><span id="elh_organization_org_website" class="organization_org_website"><?php echo $organization_delete->org_website->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$organization_delete->RecordCount = 0;
$i = 0;
while (!$organization_delete->Recordset->EOF) {
	$organization_delete->RecordCount++;
	$organization_delete->RowCount++;

	// Set row properties
	$organization->resetAttributes();
	$organization->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$organization_delete->loadRowValues($organization_delete->Recordset);

	// Render row
	$organization_delete->renderRow();
?>
	<tr <?php echo $organization->rowAttributes() ?>>
<?php if ($organization_delete->org_id->Visible) { // org_id ?>
		<td <?php echo $organization_delete->org_id->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_id" class="organization_org_id">
<span<?php echo $organization_delete->org_id->viewAttributes() ?>><?php echo $organization_delete->org_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_city_id->Visible) { // org_city_id ?>
		<td <?php echo $organization_delete->org_city_id->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_city_id" class="organization_org_city_id">
<span<?php echo $organization_delete->org_city_id->viewAttributes() ?>><?php echo $organization_delete->org_city_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_name->Visible) { // org_name ?>
		<td <?php echo $organization_delete->org_name->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_name" class="organization_org_name">
<span<?php echo $organization_delete->org_name->viewAttributes() ?>><?php echo $organization_delete->org_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_head_office->Visible) { // org_head_office ?>
		<td <?php echo $organization_delete->org_head_office->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_head_office" class="organization_org_head_office">
<span<?php echo $organization_delete->org_head_office->viewAttributes() ?>><?php echo $organization_delete->org_head_office->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_owner->Visible) { // org_owner ?>
		<td <?php echo $organization_delete->org_owner->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_owner" class="organization_org_owner">
<span<?php echo $organization_delete->org_owner->viewAttributes() ?>><?php echo $organization_delete->org_owner->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_contact_no->Visible) { // org_contact_no ?>
		<td <?php echo $organization_delete->org_contact_no->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_contact_no" class="organization_org_contact_no">
<span<?php echo $organization_delete->org_contact_no->viewAttributes() ?>><?php echo $organization_delete->org_contact_no->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_logo->Visible) { // org_logo ?>
		<td <?php echo $organization_delete->org_logo->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_logo" class="organization_org_logo">
<span><?php echo GetFileViewTag($organization_delete->org_logo, $organization_delete->org_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_bank_acc->Visible) { // org_bank_acc ?>
		<td <?php echo $organization_delete->org_bank_acc->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_bank_acc" class="organization_org_bank_acc">
<span<?php echo $organization_delete->org_bank_acc->viewAttributes() ?>><?php echo $organization_delete->org_bank_acc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_ntn->Visible) { // org_ntn ?>
		<td <?php echo $organization_delete->org_ntn->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_ntn" class="organization_org_ntn">
<span<?php echo $organization_delete->org_ntn->viewAttributes() ?>><?php echo $organization_delete->org_ntn->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_email->Visible) { // org_email ?>
		<td <?php echo $organization_delete->org_email->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_email" class="organization_org_email">
<span<?php echo $organization_delete->org_email->viewAttributes() ?>><?php echo $organization_delete->org_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($organization_delete->org_website->Visible) { // org_website ?>
		<td <?php echo $organization_delete->org_website->cellAttributes() ?>>
<span id="el<?php echo $organization_delete->RowCount ?>_organization_org_website" class="organization_org_website">
<span<?php echo $organization_delete->org_website->viewAttributes() ?>><?php echo $organization_delete->org_website->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$organization_delete->Recordset->moveNext();
}
$organization_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $organization_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$organization_delete->showPageFooter();
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
$organization_delete->terminate();
?>