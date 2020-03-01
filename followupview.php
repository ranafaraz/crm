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
$followup_view = new followup_view();

// Run the page
$followup_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$followup_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$followup_view->isExport()) { ?>
<script>
var ffollowupview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	ffollowupview = currentForm = new ew.Form("ffollowupview", "view");
	loadjs.done("ffollowupview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$followup_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $followup_view->ExportOptions->render("body") ?>
<?php $followup_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $followup_view->showPageHeader(); ?>
<?php
$followup_view->showMessage();
?>
<form name="ffollowupview" id="ffollowupview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="followup">
<input type="hidden" name="modal" value="<?php echo (int)$followup_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($followup_view->followup_id->Visible) { // followup_id ?>
	<tr id="r_followup_id">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_id"><?php echo $followup_view->followup_id->caption() ?></span></td>
		<td data-name="followup_id" <?php echo $followup_view->followup_id->cellAttributes() ?>>
<span id="el_followup_followup_id">
<span<?php echo $followup_view->followup_id->viewAttributes() ?>><?php echo $followup_view->followup_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_branch_id->Visible) { // followup_branch_id ?>
	<tr id="r_followup_branch_id">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_branch_id"><?php echo $followup_view->followup_branch_id->caption() ?></span></td>
		<td data-name="followup_branch_id" <?php echo $followup_view->followup_branch_id->cellAttributes() ?>>
<span id="el_followup_followup_branch_id">
<span<?php echo $followup_view->followup_branch_id->viewAttributes() ?>><?php echo $followup_view->followup_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_business_id->Visible) { // followup_business_id ?>
	<tr id="r_followup_business_id">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_business_id"><?php echo $followup_view->followup_business_id->caption() ?></span></td>
		<td data-name="followup_business_id" <?php echo $followup_view->followup_business_id->cellAttributes() ?>>
<span id="el_followup_followup_business_id">
<span<?php echo $followup_view->followup_business_id->viewAttributes() ?>><?php echo $followup_view->followup_business_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_by_emp_id->Visible) { // followup_by_emp_id ?>
	<tr id="r_followup_by_emp_id">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_by_emp_id"><?php echo $followup_view->followup_by_emp_id->caption() ?></span></td>
		<td data-name="followup_by_emp_id" <?php echo $followup_view->followup_by_emp_id->cellAttributes() ?>>
<span id="el_followup_followup_by_emp_id">
<span<?php echo $followup_view->followup_by_emp_id->viewAttributes() ?>><?php echo $followup_view->followup_by_emp_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_no_id->Visible) { // followup_no_id ?>
	<tr id="r_followup_no_id">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_no_id"><?php echo $followup_view->followup_no_id->caption() ?></span></td>
		<td data-name="followup_no_id" <?php echo $followup_view->followup_no_id->cellAttributes() ?>>
<span id="el_followup_followup_no_id">
<span<?php echo $followup_view->followup_no_id->viewAttributes() ?>><?php echo $followup_view->followup_no_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_date->Visible) { // followup_date ?>
	<tr id="r_followup_date">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_date"><?php echo $followup_view->followup_date->caption() ?></span></td>
		<td data-name="followup_date" <?php echo $followup_view->followup_date->cellAttributes() ?>>
<span id="el_followup_followup_date">
<span<?php echo $followup_view->followup_date->viewAttributes() ?>><?php echo $followup_view->followup_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_comments->Visible) { // followup_comments ?>
	<tr id="r_followup_comments">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_comments"><?php echo $followup_view->followup_comments->caption() ?></span></td>
		<td data-name="followup_comments" <?php echo $followup_view->followup_comments->cellAttributes() ?>>
<span id="el_followup_followup_comments">
<span<?php echo $followup_view->followup_comments->viewAttributes() ?>><?php echo $followup_view->followup_comments->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->followup_response->Visible) { // followup_response ?>
	<tr id="r_followup_response">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_followup_response"><?php echo $followup_view->followup_response->caption() ?></span></td>
		<td data-name="followup_response" <?php echo $followup_view->followup_response->cellAttributes() ?>>
<span id="el_followup_followup_response">
<span<?php echo $followup_view->followup_response->viewAttributes() ?>><?php echo $followup_view->followup_response->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->nxt_FU_date->Visible) { // nxt_FU_date ?>
	<tr id="r_nxt_FU_date">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_nxt_FU_date"><?php echo $followup_view->nxt_FU_date->caption() ?></span></td>
		<td data-name="nxt_FU_date" <?php echo $followup_view->nxt_FU_date->cellAttributes() ?>>
<span id="el_followup_nxt_FU_date">
<span<?php echo $followup_view->nxt_FU_date->viewAttributes() ?>><?php echo $followup_view->nxt_FU_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->nxt_FU_plans->Visible) { // nxt_FU_plans ?>
	<tr id="r_nxt_FU_plans">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_nxt_FU_plans"><?php echo $followup_view->nxt_FU_plans->caption() ?></span></td>
		<td data-name="nxt_FU_plans" <?php echo $followup_view->nxt_FU_plans->cellAttributes() ?>>
<span id="el_followup_nxt_FU_plans">
<span<?php echo $followup_view->nxt_FU_plans->viewAttributes() ?>><?php echo $followup_view->nxt_FU_plans->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($followup_view->current_FU_status->Visible) { // current_FU_status ?>
	<tr id="r_current_FU_status">
		<td class="<?php echo $followup_view->TableLeftColumnClass ?>"><span id="elh_followup_current_FU_status"><?php echo $followup_view->current_FU_status->caption() ?></span></td>
		<td data-name="current_FU_status" <?php echo $followup_view->current_FU_status->cellAttributes() ?>>
<span id="el_followup_current_FU_status">
<span<?php echo $followup_view->current_FU_status->viewAttributes() ?>><?php echo $followup_view->current_FU_status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$followup_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$followup_view->isExport()) { ?>
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
$followup_view->terminate();
?>