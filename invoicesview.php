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
$invoices_view = new invoices_view();

// Run the page
$invoices_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$invoices_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$invoices_view->isExport()) { ?>
<script>
var finvoicesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	finvoicesview = currentForm = new ew.Form("finvoicesview", "view");
	loadjs.done("finvoicesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$invoices_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $invoices_view->ExportOptions->render("body") ?>
<?php $invoices_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $invoices_view->showPageHeader(); ?>
<?php
$invoices_view->showMessage();
?>
<form name="finvoicesview" id="finvoicesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="invoices">
<input type="hidden" name="modal" value="<?php echo (int)$invoices_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($invoices_view->invoice_id->Visible) { // invoice_id ?>
	<tr id="r_invoice_id">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_id"><?php echo $invoices_view->invoice_id->caption() ?></span></td>
		<td data-name="invoice_id" <?php echo $invoices_view->invoice_id->cellAttributes() ?>>
<span id="el_invoices_invoice_id">
<span<?php echo $invoices_view->invoice_id->viewAttributes() ?>><?php echo $invoices_view->invoice_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_branch_id->Visible) { // invoice_branch_id ?>
	<tr id="r_invoice_branch_id">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_branch_id"><?php echo $invoices_view->invoice_branch_id->caption() ?></span></td>
		<td data-name="invoice_branch_id" <?php echo $invoices_view->invoice_branch_id->cellAttributes() ?>>
<span id="el_invoices_invoice_branch_id">
<span<?php echo $invoices_view->invoice_branch_id->viewAttributes() ?>><?php echo $invoices_view->invoice_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_business_id->Visible) { // invoice_business_id ?>
	<tr id="r_invoice_business_id">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_business_id"><?php echo $invoices_view->invoice_business_id->caption() ?></span></td>
		<td data-name="invoice_business_id" <?php echo $invoices_view->invoice_business_id->cellAttributes() ?>>
<span id="el_invoices_invoice_business_id">
<span<?php echo $invoices_view->invoice_business_id->viewAttributes() ?>><?php echo $invoices_view->invoice_business_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_service_id->Visible) { // invoice_service_id ?>
	<tr id="r_invoice_service_id">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_service_id"><?php echo $invoices_view->invoice_service_id->caption() ?></span></td>
		<td data-name="invoice_service_id" <?php echo $invoices_view->invoice_service_id->cellAttributes() ?>>
<span id="el_invoices_invoice_service_id">
<span<?php echo $invoices_view->invoice_service_id->viewAttributes() ?>><?php echo $invoices_view->invoice_service_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_amount->Visible) { // invoice_amount ?>
	<tr id="r_invoice_amount">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_amount"><?php echo $invoices_view->invoice_amount->caption() ?></span></td>
		<td data-name="invoice_amount" <?php echo $invoices_view->invoice_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_amount">
<span<?php echo $invoices_view->invoice_amount->viewAttributes() ?>><?php echo $invoices_view->invoice_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_issue_date->Visible) { // invoice_issue_date ?>
	<tr id="r_invoice_issue_date">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_issue_date"><?php echo $invoices_view->invoice_issue_date->caption() ?></span></td>
		<td data-name="invoice_issue_date" <?php echo $invoices_view->invoice_issue_date->cellAttributes() ?>>
<span id="el_invoices_invoice_issue_date">
<span<?php echo $invoices_view->invoice_issue_date->viewAttributes() ?>><?php echo $invoices_view->invoice_issue_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_due_date->Visible) { // invoice_due_date ?>
	<tr id="r_invoice_due_date">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_due_date"><?php echo $invoices_view->invoice_due_date->caption() ?></span></td>
		<td data-name="invoice_due_date" <?php echo $invoices_view->invoice_due_date->cellAttributes() ?>>
<span id="el_invoices_invoice_due_date">
<span<?php echo $invoices_view->invoice_due_date->viewAttributes() ?>><?php echo $invoices_view->invoice_due_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_status->Visible) { // invoice_status ?>
	<tr id="r_invoice_status">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_status"><?php echo $invoices_view->invoice_status->caption() ?></span></td>
		<td data-name="invoice_status" <?php echo $invoices_view->invoice_status->cellAttributes() ?>>
<span id="el_invoices_invoice_status">
<span<?php echo $invoices_view->invoice_status->viewAttributes() ?>><?php echo $invoices_view->invoice_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_collected_amount->Visible) { // invoice_collected_amount ?>
	<tr id="r_invoice_collected_amount">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_collected_amount"><?php echo $invoices_view->invoice_collected_amount->caption() ?></span></td>
		<td data-name="invoice_collected_amount" <?php echo $invoices_view->invoice_collected_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_collected_amount">
<span<?php echo $invoices_view->invoice_collected_amount->viewAttributes() ?>><?php echo $invoices_view->invoice_collected_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_remaining_amount->Visible) { // invoice_remaining_amount ?>
	<tr id="r_invoice_remaining_amount">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_remaining_amount"><?php echo $invoices_view->invoice_remaining_amount->caption() ?></span></td>
		<td data-name="invoice_remaining_amount" <?php echo $invoices_view->invoice_remaining_amount->cellAttributes() ?>>
<span id="el_invoices_invoice_remaining_amount">
<span<?php echo $invoices_view->invoice_remaining_amount->viewAttributes() ?>><?php echo $invoices_view->invoice_remaining_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_collection_date->Visible) { // invoice_collection_date ?>
	<tr id="r_invoice_collection_date">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_collection_date"><?php echo $invoices_view->invoice_collection_date->caption() ?></span></td>
		<td data-name="invoice_collection_date" <?php echo $invoices_view->invoice_collection_date->cellAttributes() ?>>
<span id="el_invoices_invoice_collection_date">
<span<?php echo $invoices_view->invoice_collection_date->viewAttributes() ?>><?php echo $invoices_view->invoice_collection_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_content->Visible) { // invoice_content ?>
	<tr id="r_invoice_content">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_content"><?php echo $invoices_view->invoice_content->caption() ?></span></td>
		<td data-name="invoice_content" <?php echo $invoices_view->invoice_content->cellAttributes() ?>>
<span id="el_invoices_invoice_content">
<span<?php echo $invoices_view->invoice_content->viewAttributes() ?>><?php echo $invoices_view->invoice_content->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($invoices_view->invoice_comments->Visible) { // invoice_comments ?>
	<tr id="r_invoice_comments">
		<td class="<?php echo $invoices_view->TableLeftColumnClass ?>"><span id="elh_invoices_invoice_comments"><?php echo $invoices_view->invoice_comments->caption() ?></span></td>
		<td data-name="invoice_comments" <?php echo $invoices_view->invoice_comments->cellAttributes() ?>>
<span id="el_invoices_invoice_comments">
<span<?php echo $invoices_view->invoice_comments->viewAttributes() ?>><?php echo $invoices_view->invoice_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$invoices_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$invoices_view->isExport()) { ?>
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
$invoices_view->terminate();
?>