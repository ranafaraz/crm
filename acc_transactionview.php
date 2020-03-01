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
$acc_transaction_view = new acc_transaction_view();

// Run the page
$acc_transaction_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acc_transaction_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acc_transaction_view->isExport()) { ?>
<script>
var facc_transactionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facc_transactionview = currentForm = new ew.Form("facc_transactionview", "view");
	loadjs.done("facc_transactionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acc_transaction_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acc_transaction_view->ExportOptions->render("body") ?>
<?php $acc_transaction_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acc_transaction_view->showPageHeader(); ?>
<?php
$acc_transaction_view->showMessage();
?>
<?php if (!$acc_transaction_view->IsModal) { ?>
<?php if (!$acc_transaction_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acc_transaction_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="facc_transactionview" id="facc_transactionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acc_transaction">
<input type="hidden" name="modal" value="<?php echo (int)$acc_transaction_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acc_transaction_view->acc_trans_id->Visible) { // acc_trans_id ?>
	<tr id="r_acc_trans_id">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_id"><?php echo $acc_transaction_view->acc_trans_id->caption() ?></span></td>
		<td data-name="acc_trans_id" <?php echo $acc_transaction_view->acc_trans_id->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_id">
<span<?php echo $acc_transaction_view->acc_trans_id->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_transaction_view->acc_trans_branch_id->Visible) { // acc_trans_branch_id ?>
	<tr id="r_acc_trans_branch_id">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_branch_id"><?php echo $acc_transaction_view->acc_trans_branch_id->caption() ?></span></td>
		<td data-name="acc_trans_branch_id" <?php echo $acc_transaction_view->acc_trans_branch_id->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_branch_id">
<span<?php echo $acc_transaction_view->acc_trans_branch_id->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_branch_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_transaction_view->acc_trans_acc_head_id->Visible) { // acc_trans_acc_head_id ?>
	<tr id="r_acc_trans_acc_head_id">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_acc_head_id"><?php echo $acc_transaction_view->acc_trans_acc_head_id->caption() ?></span></td>
		<td data-name="acc_trans_acc_head_id" <?php echo $acc_transaction_view->acc_trans_acc_head_id->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_acc_head_id">
<span<?php echo $acc_transaction_view->acc_trans_acc_head_id->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_acc_head_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_transaction_view->acc_trans_narration->Visible) { // acc_trans_narration ?>
	<tr id="r_acc_trans_narration">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_narration"><?php echo $acc_transaction_view->acc_trans_narration->caption() ?></span></td>
		<td data-name="acc_trans_narration" <?php echo $acc_transaction_view->acc_trans_narration->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_narration">
<span<?php echo $acc_transaction_view->acc_trans_narration->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_narration->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_transaction_view->acc_trans_amount->Visible) { // acc_trans_amount ?>
	<tr id="r_acc_trans_amount">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_amount"><?php echo $acc_transaction_view->acc_trans_amount->caption() ?></span></td>
		<td data-name="acc_trans_amount" <?php echo $acc_transaction_view->acc_trans_amount->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_amount">
<span<?php echo $acc_transaction_view->acc_trans_amount->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_amount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acc_transaction_view->acc_trans_date->Visible) { // acc_trans_date ?>
	<tr id="r_acc_trans_date">
		<td class="<?php echo $acc_transaction_view->TableLeftColumnClass ?>"><span id="elh_acc_transaction_acc_trans_date"><?php echo $acc_transaction_view->acc_trans_date->caption() ?></span></td>
		<td data-name="acc_trans_date" <?php echo $acc_transaction_view->acc_trans_date->cellAttributes() ?>>
<span id="el_acc_transaction_acc_trans_date">
<span<?php echo $acc_transaction_view->acc_trans_date->viewAttributes() ?>><?php echo $acc_transaction_view->acc_trans_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$acc_transaction_view->IsModal) { ?>
<?php if (!$acc_transaction_view->isExport()) { ?>
<?php echo $acc_transaction_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$acc_transaction_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acc_transaction_view->isExport()) { ?>
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
$acc_transaction_view->terminate();
?>