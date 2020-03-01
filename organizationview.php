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
$organization_view = new organization_view();

// Run the page
$organization_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$organization_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$organization_view->isExport()) { ?>
<script>
var forganizationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	forganizationview = currentForm = new ew.Form("forganizationview", "view");
	loadjs.done("forganizationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$organization_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $organization_view->ExportOptions->render("body") ?>
<?php $organization_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $organization_view->showPageHeader(); ?>
<?php
$organization_view->showMessage();
?>
<?php if (!$organization_view->IsModal) { ?>
<?php if (!$organization_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $organization_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="forganizationview" id="forganizationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="organization">
<input type="hidden" name="modal" value="<?php echo (int)$organization_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($organization_view->org_id->Visible) { // org_id ?>
	<tr id="r_org_id">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_id"><?php echo $organization_view->org_id->caption() ?></span></td>
		<td data-name="org_id" <?php echo $organization_view->org_id->cellAttributes() ?>>
<span id="el_organization_org_id">
<span<?php echo $organization_view->org_id->viewAttributes() ?>><?php echo $organization_view->org_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_city_id->Visible) { // org_city_id ?>
	<tr id="r_org_city_id">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_city_id"><?php echo $organization_view->org_city_id->caption() ?></span></td>
		<td data-name="org_city_id" <?php echo $organization_view->org_city_id->cellAttributes() ?>>
<span id="el_organization_org_city_id">
<span<?php echo $organization_view->org_city_id->viewAttributes() ?>><?php echo $organization_view->org_city_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_name->Visible) { // org_name ?>
	<tr id="r_org_name">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_name"><?php echo $organization_view->org_name->caption() ?></span></td>
		<td data-name="org_name" <?php echo $organization_view->org_name->cellAttributes() ?>>
<span id="el_organization_org_name">
<span<?php echo $organization_view->org_name->viewAttributes() ?>><?php echo $organization_view->org_name->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_head_office->Visible) { // org_head_office ?>
	<tr id="r_org_head_office">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_head_office"><?php echo $organization_view->org_head_office->caption() ?></span></td>
		<td data-name="org_head_office" <?php echo $organization_view->org_head_office->cellAttributes() ?>>
<span id="el_organization_org_head_office">
<span<?php echo $organization_view->org_head_office->viewAttributes() ?>><?php echo $organization_view->org_head_office->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_owner->Visible) { // org_owner ?>
	<tr id="r_org_owner">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_owner"><?php echo $organization_view->org_owner->caption() ?></span></td>
		<td data-name="org_owner" <?php echo $organization_view->org_owner->cellAttributes() ?>>
<span id="el_organization_org_owner">
<span<?php echo $organization_view->org_owner->viewAttributes() ?>><?php echo $organization_view->org_owner->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_contact_no->Visible) { // org_contact_no ?>
	<tr id="r_org_contact_no">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_contact_no"><?php echo $organization_view->org_contact_no->caption() ?></span></td>
		<td data-name="org_contact_no" <?php echo $organization_view->org_contact_no->cellAttributes() ?>>
<span id="el_organization_org_contact_no">
<span<?php echo $organization_view->org_contact_no->viewAttributes() ?>><?php echo $organization_view->org_contact_no->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_logo->Visible) { // org_logo ?>
	<tr id="r_org_logo">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_logo"><?php echo $organization_view->org_logo->caption() ?></span></td>
		<td data-name="org_logo" <?php echo $organization_view->org_logo->cellAttributes() ?>>
<span id="el_organization_org_logo">
<span><?php echo GetFileViewTag($organization_view->org_logo, $organization_view->org_logo->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_bank_acc->Visible) { // org_bank_acc ?>
	<tr id="r_org_bank_acc">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_bank_acc"><?php echo $organization_view->org_bank_acc->caption() ?></span></td>
		<td data-name="org_bank_acc" <?php echo $organization_view->org_bank_acc->cellAttributes() ?>>
<span id="el_organization_org_bank_acc">
<span<?php echo $organization_view->org_bank_acc->viewAttributes() ?>><?php echo $organization_view->org_bank_acc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_ntn->Visible) { // org_ntn ?>
	<tr id="r_org_ntn">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_ntn"><?php echo $organization_view->org_ntn->caption() ?></span></td>
		<td data-name="org_ntn" <?php echo $organization_view->org_ntn->cellAttributes() ?>>
<span id="el_organization_org_ntn">
<span<?php echo $organization_view->org_ntn->viewAttributes() ?>><?php echo $organization_view->org_ntn->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_email->Visible) { // org_email ?>
	<tr id="r_org_email">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_email"><?php echo $organization_view->org_email->caption() ?></span></td>
		<td data-name="org_email" <?php echo $organization_view->org_email->cellAttributes() ?>>
<span id="el_organization_org_email">
<span<?php echo $organization_view->org_email->viewAttributes() ?>><?php echo $organization_view->org_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($organization_view->org_website->Visible) { // org_website ?>
	<tr id="r_org_website">
		<td class="<?php echo $organization_view->TableLeftColumnClass ?>"><span id="elh_organization_org_website"><?php echo $organization_view->org_website->caption() ?></span></td>
		<td data-name="org_website" <?php echo $organization_view->org_website->cellAttributes() ?>>
<span id="el_organization_org_website">
<span<?php echo $organization_view->org_website->viewAttributes() ?>><?php echo $organization_view->org_website->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$organization_view->IsModal) { ?>
<?php if (!$organization_view->isExport()) { ?>
<?php echo $organization_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$organization_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$organization_view->isExport()) { ?>
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
$organization_view->terminate();
?>