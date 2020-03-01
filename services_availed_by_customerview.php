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
$services_availed_by_customer_view = new services_availed_by_customer_view();

// Run the page
$services_availed_by_customer_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$services_availed_by_customer_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$services_availed_by_customer_view->isExport()) { ?>
<script>
var fservices_availed_by_customerview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fservices_availed_by_customerview = currentForm = new ew.Form("fservices_availed_by_customerview", "view");
	loadjs.done("fservices_availed_by_customerview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$services_availed_by_customer_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $services_availed_by_customer_view->ExportOptions->render("body") ?>
<?php $services_availed_by_customer_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $services_availed_by_customer_view->showPageHeader(); ?>
<?php
$services_availed_by_customer_view->showMessage();
?>
<?php if (!$services_availed_by_customer_view->IsModal) { ?>
<?php if (!$services_availed_by_customer_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $services_availed_by_customer_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fservices_availed_by_customerview" id="fservices_availed_by_customerview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="services_availed_by_customer">
<input type="hidden" name="modal" value="<?php echo (int)$services_availed_by_customer_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($services_availed_by_customer_view->sabc_id->Visible) { // sabc_id ?>
	<tr id="r_sabc_id">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_id"><?php echo $services_availed_by_customer_view->sabc_id->caption() ?></span></td>
		<td data-name="sabc_id" <?php echo $services_availed_by_customer_view->sabc_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_id">
<span<?php echo $services_availed_by_customer_view->sabc_id->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_branch_id->Visible) { // sabc_branch_id ?>
	<tr id="r_sabc_branch_id">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_branch_id"><?php echo $services_availed_by_customer_view->sabc_branch_id->caption() ?></span></td>
		<td data-name="sabc_branch_id" <?php echo $services_availed_by_customer_view->sabc_branch_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_branch_id">
<span<?php echo $services_availed_by_customer_view->sabc_branch_id->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_business_id->Visible) { // sabc_business_id ?>
	<tr id="r_sabc_business_id">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_business_id"><?php echo $services_availed_by_customer_view->sabc_business_id->caption() ?></span></td>
		<td data-name="sabc_business_id" <?php echo $services_availed_by_customer_view->sabc_business_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_business_id">
<span<?php echo $services_availed_by_customer_view->sabc_business_id->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_business_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_service_id->Visible) { // sabc_service_id ?>
	<tr id="r_sabc_service_id">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_service_id"><?php echo $services_availed_by_customer_view->sabc_service_id->caption() ?></span></td>
		<td data-name="sabc_service_id" <?php echo $services_availed_by_customer_view->sabc_service_id->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_service_id">
<span<?php echo $services_availed_by_customer_view->sabc_service_id->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_service_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_pkg->Visible) { // sabc_pkg ?>
	<tr id="r_sabc_pkg">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_pkg"><?php echo $services_availed_by_customer_view->sabc_pkg->caption() ?></span></td>
		<td data-name="sabc_pkg" <?php echo $services_availed_by_customer_view->sabc_pkg->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_pkg">
<span<?php echo $services_availed_by_customer_view->sabc_pkg->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_pkg->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_amount->Visible) { // sabc_amount ?>
	<tr id="r_sabc_amount">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_amount"><?php echo $services_availed_by_customer_view->sabc_amount->caption() ?></span></td>
		<td data-name="sabc_amount" <?php echo $services_availed_by_customer_view->sabc_amount->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_amount">
<span<?php echo $services_availed_by_customer_view->sabc_amount->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_desc->Visible) { // sabc_desc ?>
	<tr id="r_sabc_desc">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_desc"><?php echo $services_availed_by_customer_view->sabc_desc->caption() ?></span></td>
		<td data-name="sabc_desc" <?php echo $services_availed_by_customer_view->sabc_desc->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_desc">
<span<?php echo $services_availed_by_customer_view->sabc_desc->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_desc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($services_availed_by_customer_view->sabc_signed_on->Visible) { // sabc_signed_on ?>
	<tr id="r_sabc_signed_on">
		<td class="<?php echo $services_availed_by_customer_view->TableLeftColumnClass ?>"><span id="elh_services_availed_by_customer_sabc_signed_on"><?php echo $services_availed_by_customer_view->sabc_signed_on->caption() ?></span></td>
		<td data-name="sabc_signed_on" <?php echo $services_availed_by_customer_view->sabc_signed_on->cellAttributes() ?>>
<span id="el_services_availed_by_customer_sabc_signed_on">
<span<?php echo $services_availed_by_customer_view->sabc_signed_on->viewAttributes() ?>><?php echo $services_availed_by_customer_view->sabc_signed_on->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$services_availed_by_customer_view->IsModal) { ?>
<?php if (!$services_availed_by_customer_view->isExport()) { ?>
<?php echo $services_availed_by_customer_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$services_availed_by_customer_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$services_availed_by_customer_view->isExport()) { ?>
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
$services_availed_by_customer_view->terminate();
?>