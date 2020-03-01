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
$employees_delete = new employees_delete();

// Run the page
$employees_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var femployeesdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	femployeesdelete = currentForm = new ew.Form("femployeesdelete", "delete");
	loadjs.done("femployeesdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $employees_delete->showPageHeader(); ?>
<?php
$employees_delete->showMessage();
?>
<form name="femployeesdelete" id="femployeesdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($employees_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($employees_delete->emp_id->Visible) { // emp_id ?>
		<th class="<?php echo $employees_delete->emp_id->headerCellClass() ?>"><span id="elh_employees_emp_id" class="employees_emp_id"><?php echo $employees_delete->emp_id->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_branch_id->Visible) { // emp_branch_id ?>
		<th class="<?php echo $employees_delete->emp_branch_id->headerCellClass() ?>"><span id="elh_employees_emp_branch_id" class="employees_emp_branch_id"><?php echo $employees_delete->emp_branch_id->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_designation_id->Visible) { // emp_designation_id ?>
		<th class="<?php echo $employees_delete->emp_designation_id->headerCellClass() ?>"><span id="elh_employees_emp_designation_id" class="employees_emp_designation_id"><?php echo $employees_delete->emp_designation_id->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_city_id->Visible) { // emp_city_id ?>
		<th class="<?php echo $employees_delete->emp_city_id->headerCellClass() ?>"><span id="elh_employees_emp_city_id" class="employees_emp_city_id"><?php echo $employees_delete->emp_city_id->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_name->Visible) { // emp_name ?>
		<th class="<?php echo $employees_delete->emp_name->headerCellClass() ?>"><span id="elh_employees_emp_name" class="employees_emp_name"><?php echo $employees_delete->emp_name->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_father->Visible) { // emp_father ?>
		<th class="<?php echo $employees_delete->emp_father->headerCellClass() ?>"><span id="elh_employees_emp_father" class="employees_emp_father"><?php echo $employees_delete->emp_father->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_cnic->Visible) { // emp_cnic ?>
		<th class="<?php echo $employees_delete->emp_cnic->headerCellClass() ?>"><span id="elh_employees_emp_cnic" class="employees_emp_cnic"><?php echo $employees_delete->emp_cnic->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_address->Visible) { // emp_address ?>
		<th class="<?php echo $employees_delete->emp_address->headerCellClass() ?>"><span id="elh_employees_emp_address" class="employees_emp_address"><?php echo $employees_delete->emp_address->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_contact->Visible) { // emp_contact ?>
		<th class="<?php echo $employees_delete->emp_contact->headerCellClass() ?>"><span id="elh_employees_emp_contact" class="employees_emp_contact"><?php echo $employees_delete->emp_contact->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_email->Visible) { // emp_email ?>
		<th class="<?php echo $employees_delete->emp_email->headerCellClass() ?>"><span id="elh_employees_emp_email" class="employees_emp_email"><?php echo $employees_delete->emp_email->caption() ?></span></th>
<?php } ?>
<?php if ($employees_delete->emp_photo->Visible) { // emp_photo ?>
		<th class="<?php echo $employees_delete->emp_photo->headerCellClass() ?>"><span id="elh_employees_emp_photo" class="employees_emp_photo"><?php echo $employees_delete->emp_photo->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$employees_delete->RecordCount = 0;
$i = 0;
while (!$employees_delete->Recordset->EOF) {
	$employees_delete->RecordCount++;
	$employees_delete->RowCount++;

	// Set row properties
	$employees->resetAttributes();
	$employees->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$employees_delete->loadRowValues($employees_delete->Recordset);

	// Render row
	$employees_delete->renderRow();
?>
	<tr <?php echo $employees->rowAttributes() ?>>
<?php if ($employees_delete->emp_id->Visible) { // emp_id ?>
		<td <?php echo $employees_delete->emp_id->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_id" class="employees_emp_id">
<span<?php echo $employees_delete->emp_id->viewAttributes() ?>><?php echo $employees_delete->emp_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_branch_id->Visible) { // emp_branch_id ?>
		<td <?php echo $employees_delete->emp_branch_id->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_branch_id" class="employees_emp_branch_id">
<span<?php echo $employees_delete->emp_branch_id->viewAttributes() ?>><?php echo $employees_delete->emp_branch_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_designation_id->Visible) { // emp_designation_id ?>
		<td <?php echo $employees_delete->emp_designation_id->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_designation_id" class="employees_emp_designation_id">
<span<?php echo $employees_delete->emp_designation_id->viewAttributes() ?>><?php echo $employees_delete->emp_designation_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_city_id->Visible) { // emp_city_id ?>
		<td <?php echo $employees_delete->emp_city_id->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_city_id" class="employees_emp_city_id">
<span<?php echo $employees_delete->emp_city_id->viewAttributes() ?>><?php echo $employees_delete->emp_city_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_name->Visible) { // emp_name ?>
		<td <?php echo $employees_delete->emp_name->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_name" class="employees_emp_name">
<span<?php echo $employees_delete->emp_name->viewAttributes() ?>><?php echo $employees_delete->emp_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_father->Visible) { // emp_father ?>
		<td <?php echo $employees_delete->emp_father->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_father" class="employees_emp_father">
<span<?php echo $employees_delete->emp_father->viewAttributes() ?>><?php echo $employees_delete->emp_father->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_cnic->Visible) { // emp_cnic ?>
		<td <?php echo $employees_delete->emp_cnic->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_cnic" class="employees_emp_cnic">
<span<?php echo $employees_delete->emp_cnic->viewAttributes() ?>><?php echo $employees_delete->emp_cnic->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_address->Visible) { // emp_address ?>
		<td <?php echo $employees_delete->emp_address->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_address" class="employees_emp_address">
<span<?php echo $employees_delete->emp_address->viewAttributes() ?>><?php echo $employees_delete->emp_address->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_contact->Visible) { // emp_contact ?>
		<td <?php echo $employees_delete->emp_contact->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_contact" class="employees_emp_contact">
<span<?php echo $employees_delete->emp_contact->viewAttributes() ?>><?php echo $employees_delete->emp_contact->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_email->Visible) { // emp_email ?>
		<td <?php echo $employees_delete->emp_email->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_email" class="employees_emp_email">
<span<?php echo $employees_delete->emp_email->viewAttributes() ?>><?php echo $employees_delete->emp_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($employees_delete->emp_photo->Visible) { // emp_photo ?>
		<td <?php echo $employees_delete->emp_photo->cellAttributes() ?>>
<span id="el<?php echo $employees_delete->RowCount ?>_employees_emp_photo" class="employees_emp_photo">
<span<?php echo $employees_delete->emp_photo->viewAttributes() ?>><?php echo $employees_delete->emp_photo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$employees_delete->Recordset->moveNext();
}
$employees_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $employees_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$employees_delete->showPageFooter();
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
$employees_delete->terminate();
?>