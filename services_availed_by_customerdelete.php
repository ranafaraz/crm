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
$services_availed_by_customer_delete = new services_availed_by_customer_delete();

// Run the page
$services_availed_by_customer_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_availed_by_customer_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservices_availed_by_customerdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fservices_availed_by_customerdelete = currentForm = new ew.Form("fservices_availed_by_customerdelete", "delete");
	loadjs.done("fservices_availed_by_customerdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $services_availed_by_customer_delete->showPageHeader(); ?>
<?php
$services_availed_by_customer_delete->showMessage();
?>
<form name="fservices_availed_by_customerdelete" id="fservices_availed_by_customerdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services_availed_by_customer">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($services_availed_by_customer_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($services_availed_by_customer_delete->sabc_id->Visible) { // sabc_id ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_id->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_id" class="services_availed_by_customer_sabc_id"><?php echo $services_availed_by_customer_delete->sabc_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_branch_id->Visible) { // sabc_branch_id ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_branch_id->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_branch_id" class="services_availed_by_customer_sabc_branch_id"><?php echo $services_availed_by_customer_delete->sabc_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_business_id->Visible) { // sabc_business_id ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_business_id->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_business_id" class="services_availed_by_customer_sabc_business_id"><?php echo $services_availed_by_customer_delete->sabc_business_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_service_id->Visible) { // sabc_service_id ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_service_id->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_service_id" class="services_availed_by_customer_sabc_service_id"><?php echo $services_availed_by_customer_delete->sabc_service_id->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_pkg->Visible) { // sabc_pkg ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_pkg->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_pkg" class="services_availed_by_customer_sabc_pkg"><?php echo $services_availed_by_customer_delete->sabc_pkg->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_amount->Visible) { // sabc_amount ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_amount->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_amount" class="services_availed_by_customer_sabc_amount"><?php echo $services_availed_by_customer_delete->sabc_amount->caption() ?></span></th>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_signed_on->Visible) { // sabc_signed_on ?>
		<th class="<?php echo $services_availed_by_customer_delete->sabc_signed_on->headerCellClass() ?>"><span id="elh_services_availed_by_customer_sabc_signed_on" class="services_availed_by_customer_sabc_signed_on"><?php echo $services_availed_by_customer_delete->sabc_signed_on->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$services_availed_by_customer_delete->RecordCount = 0;
$i = 0;
while (!$services_availed_by_customer_delete->Recordset->EOF) {
	$services_availed_by_customer_delete->RecordCount++;
	$services_availed_by_customer_delete->RowCount++;

	// Set row properties
	$services_availed_by_customer->resetAttributes();
	$services_availed_by_customer->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$services_availed_by_customer_delete->loadRowValues($services_availed_by_customer_delete->Recordset);

	// Render row
	$services_availed_by_customer_delete->renderRow();
?>
	<tr <?php echo $services_availed_by_customer->rowAttributes() ?>>
<?php if ($services_availed_by_customer_delete->sabc_id->Visible) { // sabc_id ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_id" class="services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_delete->sabc_id->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_branch_id->Visible) { // sabc_branch_id ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_branch_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_branch_id" class="services_availed_by_customer_sabc_branch_id">
<span<?php echo $services_availed_by_customer_delete->sabc_branch_id->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_business_id->Visible) { // sabc_business_id ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_business_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_business_id" class="services_availed_by_customer_sabc_business_id">
<span<?php echo $services_availed_by_customer_delete->sabc_business_id->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_business_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_service_id->Visible) { // sabc_service_id ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_service_id->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_service_id" class="services_availed_by_customer_sabc_service_id">
<span<?php echo $services_availed_by_customer_delete->sabc_service_id->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_service_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_pkg->Visible) { // sabc_pkg ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_pkg->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_pkg" class="services_availed_by_customer_sabc_pkg">
<span<?php echo $services_availed_by_customer_delete->sabc_pkg->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_pkg->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_amount->Visible) { // sabc_amount ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_amount->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_amount" class="services_availed_by_customer_sabc_amount">
<span<?php echo $services_availed_by_customer_delete->sabc_amount->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_amount->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($services_availed_by_customer_delete->sabc_signed_on->Visible) { // sabc_signed_on ?>
		<td <?php echo $services_availed_by_customer_delete->sabc_signed_on->cellAttributes() ?>>
<span id="el<?php echo $services_availed_by_customer_delete->RowCount ?>_services_availed_by_customer_sabc_signed_on" class="services_availed_by_customer_sabc_signed_on">
<span<?php echo $services_availed_by_customer_delete->sabc_signed_on->viewAttributes() ?>><?php echo $services_availed_by_customer_delete->sabc_signed_on->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$services_availed_by_customer_delete->Recordset->moveNext();
}
$services_availed_by_customer_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $services_availed_by_customer_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$services_availed_by_customer_delete->showPageFooter();
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
$services_availed_by_customer_delete->terminate();
?>