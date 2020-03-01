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
$employees_view = new employees_view();

// Run the page
$employees_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employees_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employees_view->isExport()) { ?>
<script>
var femployeesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	femployeesview = currentForm = new ew.Form("femployeesview", "view");
	loadjs.done("femployeesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$employees_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $employees_view->ExportOptions->render("body") ?>
<?php $employees_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $employees_view->showPageHeader(); ?>
<?php
$employees_view->showMessage();
?>
<?php if (!$employees_view->IsModal) { ?>
<?php if (!$employees_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employees_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="femployeesview" id="femployeesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employees">
<input type="hidden" name="modal" value="<?php echo (int)$employees_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($employees_view->emp_id->Visible) { // emp_id ?>
	<tr id="r_emp_id">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_id"><?php echo $employees_view->emp_id->caption() ?></span></td>
		<td data-name="emp_id" <?php echo $employees_view->emp_id->cellAttributes() ?>>
<span id="el_employees_emp_id">
<span<?php echo $employees_view->emp_id->viewAttributes() ?>><?php echo $employees_view->emp_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_branch_id->Visible) { // emp_branch_id ?>
	<tr id="r_emp_branch_id">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_branch_id"><?php echo $employees_view->emp_branch_id->caption() ?></span></td>
		<td data-name="emp_branch_id" <?php echo $employees_view->emp_branch_id->cellAttributes() ?>>
<span id="el_employees_emp_branch_id">
<span<?php echo $employees_view->emp_branch_id->viewAttributes() ?>><?php echo $employees_view->emp_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_designation_id->Visible) { // emp_designation_id ?>
	<tr id="r_emp_designation_id">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_designation_id"><?php echo $employees_view->emp_designation_id->caption() ?></span></td>
		<td data-name="emp_designation_id" <?php echo $employees_view->emp_designation_id->cellAttributes() ?>>
<span id="el_employees_emp_designation_id">
<span<?php echo $employees_view->emp_designation_id->viewAttributes() ?>><?php echo $employees_view->emp_designation_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_name->Visible) { // emp_name ?>
	<tr id="r_emp_name">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_name"><?php echo $employees_view->emp_name->caption() ?></span></td>
		<td data-name="emp_name" <?php echo $employees_view->emp_name->cellAttributes() ?>>
<span id="el_employees_emp_name">
<span<?php echo $employees_view->emp_name->viewAttributes() ?>><?php echo $employees_view->emp_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_father->Visible) { // emp_father ?>
	<tr id="r_emp_father">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_father"><?php echo $employees_view->emp_father->caption() ?></span></td>
		<td data-name="emp_father" <?php echo $employees_view->emp_father->cellAttributes() ?>>
<span id="el_employees_emp_father">
<span<?php echo $employees_view->emp_father->viewAttributes() ?>><?php echo $employees_view->emp_father->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_cnic->Visible) { // emp_cnic ?>
	<tr id="r_emp_cnic">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_cnic"><?php echo $employees_view->emp_cnic->caption() ?></span></td>
		<td data-name="emp_cnic" <?php echo $employees_view->emp_cnic->cellAttributes() ?>>
<span id="el_employees_emp_cnic">
<span<?php echo $employees_view->emp_cnic->viewAttributes() ?>><?php echo $employees_view->emp_cnic->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_address->Visible) { // emp_address ?>
	<tr id="r_emp_address">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_address"><?php echo $employees_view->emp_address->caption() ?></span></td>
		<td data-name="emp_address" <?php echo $employees_view->emp_address->cellAttributes() ?>>
<span id="el_employees_emp_address">
<span<?php echo $employees_view->emp_address->viewAttributes() ?>><?php echo $employees_view->emp_address->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_city_id->Visible) { // emp_city_id ?>
	<tr id="r_emp_city_id">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_city_id"><?php echo $employees_view->emp_city_id->caption() ?></span></td>
		<td data-name="emp_city_id" <?php echo $employees_view->emp_city_id->cellAttributes() ?>>
<span id="el_employees_emp_city_id">
<span<?php echo $employees_view->emp_city_id->viewAttributes() ?>><?php echo $employees_view->emp_city_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_contact->Visible) { // emp_contact ?>
	<tr id="r_emp_contact">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_contact"><?php echo $employees_view->emp_contact->caption() ?></span></td>
		<td data-name="emp_contact" <?php echo $employees_view->emp_contact->cellAttributes() ?>>
<span id="el_employees_emp_contact">
<span<?php echo $employees_view->emp_contact->viewAttributes() ?>><?php echo $employees_view->emp_contact->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_email->Visible) { // emp_email ?>
	<tr id="r_emp_email">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_email"><?php echo $employees_view->emp_email->caption() ?></span></td>
		<td data-name="emp_email" <?php echo $employees_view->emp_email->cellAttributes() ?>>
<span id="el_employees_emp_email">
<span<?php echo $employees_view->emp_email->viewAttributes() ?>><?php echo $employees_view->emp_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($employees_view->emp_photo->Visible) { // emp_photo ?>
	<tr id="r_emp_photo">
		<td class="<?php echo $employees_view->TableLeftColumnClass ?>"><span id="elh_employees_emp_photo"><?php echo $employees_view->emp_photo->caption() ?></span></td>
		<td data-name="emp_photo" <?php echo $employees_view->emp_photo->cellAttributes() ?>>
<span id="el_employees_emp_photo">
<span><?php echo GetFileViewTag($employees_view->emp_photo, $employees_view->emp_photo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$employees_view->IsModal) { ?>
<?php if (!$employees_view->isExport()) { ?>
<?php echo $employees_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$employees_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employees_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$employees_view->terminate();
?>