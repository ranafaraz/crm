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
$quotation_view = new quotation_view();

// Run the page
$quotation_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quotation_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$quotation_view->isExport()) { ?>
<script>
var fquotationview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fquotationview = currentForm = new ew.Form("fquotationview", "view");
	loadjs.done("fquotationview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$quotation_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $quotation_view->ExportOptions->render("body") ?>
<?php $quotation_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $quotation_view->showPageHeader(); ?>
<?php
$quotation_view->showMessage();
?>
<form name="fquotationview" id="fquotationview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quotation">
<input type="hidden" name="modal" value="<?php echo (int)$quotation_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($quotation_view->quote_id->Visible) { // quote_id ?>
	<tr id="r_quote_id">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_id"><?php echo $quotation_view->quote_id->caption() ?></span></td>
		<td data-name="quote_id" <?php echo $quotation_view->quote_id->cellAttributes() ?>>
<span id="el_quotation_quote_id">
<span<?php echo $quotation_view->quote_id->viewAttributes() ?>><?php echo $quotation_view->quote_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_branch_id->Visible) { // quote_branch_id ?>
	<tr id="r_quote_branch_id">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_branch_id"><?php echo $quotation_view->quote_branch_id->caption() ?></span></td>
		<td data-name="quote_branch_id" <?php echo $quotation_view->quote_branch_id->cellAttributes() ?>>
<span id="el_quotation_quote_branch_id">
<span<?php echo $quotation_view->quote_branch_id->viewAttributes() ?>><?php echo $quotation_view->quote_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_business_id->Visible) { // quote_business_id ?>
	<tr id="r_quote_business_id">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_business_id"><?php echo $quotation_view->quote_business_id->caption() ?></span></td>
		<td data-name="quote_business_id" <?php echo $quotation_view->quote_business_id->cellAttributes() ?>>
<span id="el_quotation_quote_business_id">
<span<?php echo $quotation_view->quote_business_id->viewAttributes() ?>><?php echo $quotation_view->quote_business_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_service_id->Visible) { // quote_service_id ?>
	<tr id="r_quote_service_id">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_service_id"><?php echo $quotation_view->quote_service_id->caption() ?></span></td>
		<td data-name="quote_service_id" <?php echo $quotation_view->quote_service_id->cellAttributes() ?>>
<span id="el_quotation_quote_service_id">
<span<?php echo $quotation_view->quote_service_id->viewAttributes() ?>><?php echo $quotation_view->quote_service_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_issue_date->Visible) { // quote_issue_date ?>
	<tr id="r_quote_issue_date">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_issue_date"><?php echo $quotation_view->quote_issue_date->caption() ?></span></td>
		<td data-name="quote_issue_date" <?php echo $quotation_view->quote_issue_date->cellAttributes() ?>>
<span id="el_quotation_quote_issue_date">
<span<?php echo $quotation_view->quote_issue_date->viewAttributes() ?>><?php echo $quotation_view->quote_issue_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_due_date->Visible) { // quote_due_date ?>
	<tr id="r_quote_due_date">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_due_date"><?php echo $quotation_view->quote_due_date->caption() ?></span></td>
		<td data-name="quote_due_date" <?php echo $quotation_view->quote_due_date->cellAttributes() ?>>
<span id="el_quotation_quote_due_date">
<span<?php echo $quotation_view->quote_due_date->viewAttributes() ?>><?php echo $quotation_view->quote_due_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_amount->Visible) { // quote_amount ?>
	<tr id="r_quote_amount">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_amount"><?php echo $quotation_view->quote_amount->caption() ?></span></td>
		<td data-name="quote_amount" <?php echo $quotation_view->quote_amount->cellAttributes() ?>>
<span id="el_quotation_quote_amount">
<span<?php echo $quotation_view->quote_amount->viewAttributes() ?>><?php echo $quotation_view->quote_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_content->Visible) { // quote_content ?>
	<tr id="r_quote_content">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_content"><?php echo $quotation_view->quote_content->caption() ?></span></td>
		<td data-name="quote_content" <?php echo $quotation_view->quote_content->cellAttributes() ?>>
<span id="el_quotation_quote_content">
<span<?php echo $quotation_view->quote_content->viewAttributes() ?>><?php echo $quotation_view->quote_content->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($quotation_view->quote_comments->Visible) { // quote_comments ?>
	<tr id="r_quote_comments">
		<td class="<?php echo $quotation_view->TableLeftColumnClass ?>"><span id="elh_quotation_quote_comments"><?php echo $quotation_view->quote_comments->caption() ?></span></td>
		<td data-name="quote_comments" <?php echo $quotation_view->quote_comments->cellAttributes() ?>>
<span id="el_quotation_quote_comments">
<span<?php echo $quotation_view->quote_comments->viewAttributes() ?>><?php echo $quotation_view->quote_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$quotation_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$quotation_view->isExport()) { ?>
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
$quotation_view->terminate();
?>